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
    
if (!isset($_GET['forum_id']) || !is_numeric($_GET['forum_id']))
    $forum_id = '';
else
    $forum_id = (int)$_GET['forum_id'];
    
if ($cat_id == '')
{
    header('Location: forum_list.php');
    die();
}
    
if (isset($_POST['forum_name'])) 
{
    
    if ($forum_id == '') 
        $result = frm_add_forum(
            $_POST['forum_cat'],
            $_POST['forum_name'],
            $_POST['forum_img'],
            $_POST['forum_description'],
            $_POST['forum_align'],
            (isset($_POST['forum_dealer']) ? 1 : 0),
            (isset($_POST['forum_developer']) ? 1 : 0),
            $_POST['forum_min_level'],
            $_POST['forum_read'],
            $_POST['forum_write'],
            $_POST['forum_max_page'],
            $_POST['forum_max_total'],
            $_POST['forum_priority']
        );
    else 
        $result = frm_edit_forum(
            $forum_id,
            $_POST['forum_cat'],
            $_POST['forum_name'],
            $_POST['forum_img'],
            $_POST['forum_description'],
            $_POST['forum_align'],
            (isset($_POST['forum_dealer']) ? 1 : 0),
            (isset($_POST['forum_developer']) ? 1 : 0),
            $_POST['forum_min_level'],
            $_POST['forum_read'],
            $_POST['forum_write'],
            $_POST['forum_max_page'],
            $_POST['forum_max_total'],
            $_POST['forum_priority']
        );
        
    if ($result == 0)
        die('Error');
    header('Location: forum_list.php');
}

if ((string)$forum_id == '') 
{
    $forum = array(
        'forum_cat' => $cat_id,
        'forum_name' => '',
        'forum_img' => '',
        'forum_description' => '',
        'forum_align' => '',
        'forum_dealer' => '',
        'forum_developer' => '',
        'forum_min_level' => '',
        'forum_read' => '',
        'forum_write' => '',
        'forum_max_page' => '',
        'forum_max_total' => '',
        'forum_priority' => '',
    );
} 
else 
{
    $forum_array = $forum = array();
    frm_get_forum_info($forum_id, $forum_array);
    
    $forum = array(
        'forum_cat' => $forum_array[0],
        'forum_name' => $forum_array[1],
        'forum_img' => $forum_array[2],
        'forum_description' => $forum_array[3],
        'forum_align' => $forum_array[4],
        'forum_dealer' => $forum_array[5],
        'forum_developer' => $forum_array[6],
        'forum_min_level' => $forum_array[7],
        'forum_read' => $forum_array[8],
        'forum_write' => $forum_array[9],
        'forum_max_page' => $forum_array[10],
        'forum_max_total' => $forum_array[11],
        'forum_priority' => $forum_array[12],
    );
}

$categories = $cat_array = array();
frm_get_categ_list($categories);
foreach($categories as $cat)
    $cat_array[$cat[0]] = $cat[1];

?>
    <h3><?= ($cat_id == '' ? 'Добавить категорию форума' : 'Изменить категорию форума') ?></h3>

<form name="edit_cat" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td>Категория: &nbsp;</td>
  <td><?=createSelectFromArray('forum_cat', $cat_array, $forum['forum_cat'])?></td>
</tr>
<tr>
    <td>Название форума: &nbsp;</td>
  <td><input name="forum_name" type="text" class="cms_fieldstyle1" value="<?=$forum['forum_name']?>" size="20" maxlength="255" /></td>
</tr>
<tr>
    <td>Картинка форума: &nbsp;</td>
  <td><input name="forum_img" type="text" class="cms_fieldstyle1" value="<?=$forum['forum_img']?>" size="20" maxlength="255" /></td>
</tr>
<tr>
    <td>Описание: &nbsp;</td>
  <td><input name="forum_description" type="text" class="cms_fieldstyle1" value="<?=$forum['forum_description']?>" size="40" maxlength="255" /></td>
</tr>
<tr>
    <td>Склонность: &nbsp;</td>
  <td><input name="forum_align" type="text" class="cms_fieldstyle1" value="<?=$forum['forum_align']?>" size="40" maxlength="255" /></td>
</tr>
<tr>
    <td colspan="2"><label><input type="checkbox" name="forum_dealer"
                                  value="1" <?= ($forum['forum_dealer'] == 1 ? 'checked="checked"' : '') ?> > Только для
            дилеров</label></td>
</tr>
<tr>
    <td colspan="2"><label><input type="checkbox" name="forum_developer"
                                  value="1" <?= ($forum['forum_developer'] == 1 ? 'checked="checked"' : '') ?> > Только
            для разработчиков</label></td>
</tr>
<tr>
    <td>Мин уровень: &nbsp;</td>
  <td><input name="forum_min_level" type="text" class="cms_fieldstyle1" value="<?=$forum['forum_min_level']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
    <td>Права на чтение: &nbsp;</td>
  <td><input name="forum_read" type="text" class="cms_fieldstyle1" value="<?=$forum['forum_read']?>" size="20" maxlength="255" /></td>
</tr>
<tr>
    <td>Права на запись: &nbsp;</td>
  <td><input name="forum_write" type="text" class="cms_fieldstyle1" value="<?=$forum['forum_write']?>" size="20" maxlength="255" /></td>
</tr>
<tr>
    <td>Макс тем на страницу: &nbsp;</td>
  <td><input name="forum_max_page" type="text" class="cms_fieldstyle1" value="<?=$forum['forum_max_page']?>" size="20" maxlength="255" /></td>
</tr>
<tr>
    <td>Макс тем всего: &nbsp;</td>
  <td><input name="forum_max_total" type="text" class="cms_fieldstyle1" value="<?=$forum['forum_max_total']?>" size="20" maxlength="255" /></td>
</tr>
<tr>
    <td>Приоритет форума: &nbsp;</td>
  <td><input name="forum_priority" type="text" class="cms_fieldstyle1" value="<?=$forum['forum_priority']?>" size="10" maxlength="255" /></td>
</tr>
</table>

<p></p>
    <input name="submit" type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
    <input name="cancel" type="submit" onclick="document.location='forum_list.php'; return false;" class="cms_button1"
           value="Отмена"/>
    <p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>