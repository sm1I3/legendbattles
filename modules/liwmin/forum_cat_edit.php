<?php
require('kernel/before.php');
require('library/forum.php');

if (!userHasPermission(2)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['cat_id']) || !is_numeric($_GET['cat_id']))
    $cat_id = '';
else
    $cat_id = (int)$_GET['cat_id'];
    
if (isset($_POST['cat_name'])) 
{
    
    if ($cat_id == '') 
        $result = frm_add_categ($_POST['cat_name'], $_POST['cat_img'], $_POST['cat_priority']);
    else 
        $result = frm_edit_categ($cat_id, $_POST['cat_name'], $_POST['cat_img'], $_POST['cat_priority']);
        
    if ($result == 0)
        die('Error');
    header('Location: forum_list.php');
    
}

if ((string)$cat_id == '') 
{
    $cat = array(
        'cat_name' => '',
        'cat_img' => '',
    );
} 
else 
{
    $cat_array = array();
    frm_get_categ_info($cat_id, $cat_array);
    
    $cat = array(
        'cat_name' => $cat_array[0],
        'cat_img' => $cat_array[1],
        'cat_priority' => $cat_array[2],
    );
}

?>
<h3><?=($cat_id == ''?'Добавить категорию форума':'Изменить категорию форума')?></h3>

<form name="edit_cat" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
  <td>Название категории: &nbsp;  </td>
  <td><input name="cat_name" type="text" class="cms_fieldstyle1" value="<?=$cat['cat_name']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Картинка категории: &nbsp;  </td>
  <td><input name="cat_img" type="text" class="cms_fieldstyle1" value="<?=$cat['cat_img']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Приоритет категории: &nbsp;  </td>
  <td><input name="cat_priority" type="text" class="cms_fieldstyle1" value="<?=$cat['cat_priority']?>" size="10" maxlength="255" /></td>
</tr>
</table>

<p></p>
  <input name="submit"  type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
  <input name="cancel" type="submit" onclick="document.location='forum_list.php'; return false;" class="cms_button1" value="Отмена" />
<p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>