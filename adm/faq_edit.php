<?php
require('kernel/before.php');

if (!userHasPermission(2)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['page_id']) || !is_numeric($_GET['page_id']))
    $page_id = '';
else
    $page_id = (int)$_GET['page_id'];
    
$row_id = 0;

function build_pages_tree($rows, $parent = 0, $level = 0)
{
    $pages = array();
    if (isset($rows[$parent]))
    {
        foreach($rows[$parent] as $row)
        {
            $pages[$row['page_id']] = str_repeat('. . ', $level).$row['title'];
            $pages = $pages + build_pages_tree($rows, $row['page_id'], $level+1);
        }
        return $pages;
    }
    else
    {
        return array();
    }
}
    
// list of all pages
$pages_array = $rows =  array();
$res = mysqli_query($GLOBALS['db_link'], 'select * from faq_pages order by sort_order asc');
while ($row = mysqli_fetch_assoc($res))
    if (isset($row['parent_page_id']))
        $rows[$row['parent_page_id']][] = $row;
    else
        $rows[0][] = $row;
mysqli_free_result($res);

$pages_array = build_pages_tree($rows);
    
if (isset($_POST['page_title'])) 
{
    
    if ($page_id == '') 
    {
        
        $query = '
        insert into faq_pages
        (
            parent_page_id,
            title,
            text,
            sort_order
        ) values (
            '.($_POST['parent_page_id']=='' ? 'NULL' : (int)$_POST['parent_page_id']).',
            \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['page_title']) . '\',
            \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['text']) . '\',
            '.(int)$_POST['sort_order'].'
        )';


        if (!mysqli_query($GLOBALS['db_link'], $query))
            die(mysqli_error($GLOBALS['db_link']));


        $page_id = mysqli_insert_id($GLOBALS['db_link']);
        
    } else {
        
        $query = '
        update faq_pages set
            parent_page_id = '.($_POST['parent_page_id']=='' ? 'NULL' : (int)$_POST['parent_page_id']).',
            title = \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['page_title']) . '\',
            text = \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['text']) . '\',
            sort_order = '.(int)$_POST['sort_order'].'
        where
            page_id = '.intval($page_id).'
        '  ;
        mysqli_query($GLOBALS['db_link'], $query);
    }    
    
    
    header('Location: faq_list.php');    
}


if ($page_id == '') 
{
    $page = array(
        'parent_page_id' => '',
        'page_title' => '',
        'text' => '',
        'sort_order' => '0'
    );
} 
else 
{
    $page = array();
    $res = mysqli_query($GLOBALS['db_link'], 'select * from faq_pages where page_id = ' . intval($page_id));
    if ($row = mysqli_fetch_assoc($res))
        $page = $row;
    mysqli_free_result($res);
    
    $page['page_title'] = $page['title'];
}

?>
    <h3><?= ($page_id == '' ? 'Добавить страницу' : 'Изменить станицу') ?></h3>
<script type="text/javascript" src="jscript/ckeditor/ckeditor.js"></script>
<form name="edit_page" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td width="20%">Родительская страница: &nbsp;</td>
  <td><?=createSelectFromArray('parent_page_id', $pages_array, $page['parent_page_id'])?></td>
</tr>
<tr>
    <td width="20%">Заголовок: &nbsp;</td>
  <td><input type="text" name="page_title" value="<?=_htext($page['page_title'])?>" /></td>
</tr>
<tr>
    <td colspan="2">Текст: &nbsp;<br/>
  <textarea name="text" id="text"><?=_htext($page['text'])?></textarea>
  <script>
  CKEDITOR.replace('text');
  </script>
  </td>
</tr>
<tr>
    <td width="20%">Порядок сортировки: &nbsp;</td>
  <td><input type="text" name="sort_order" value="<?=_htext($page['sort_order'])?>" /></td>
</tr>
</table>
<br />
<p></p>
    <input name="submit" type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
    <input name="cancel" type="submit" onclick="document.location='faq_list.php'; return false;" class="cms_button1"
           value="Отмена"/>
    <p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>