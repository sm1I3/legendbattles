<?php
require('kernel/before.php');

if (!userHasPermission(2)) {
    header('Location: '.$_SESSION['pages']['quest_image_list']);
    die();
}

if (!isset($_GET['image_id']) || !is_numeric($_GET['image_id']))
    $image_id = '';
else
    $image_id = (int)$_GET['image_id'];
    
if (isset($_POST['image_name'])) {
    
    if ($image_id == '') {
        $query = '
        insert into quest_images
        (
            image,
            image_name
        ) values (
            \''.mysql_escape_string($_POST['image']).'\',
            \''.mysql_escape_string($_POST['image_name']).'\'
        )'  ;
    } else {
        $query = '
        update quest_images set
            image = \''.mysql_escape_string($_POST['image']).'\',
            image_name = \''.mysql_escape_string($_POST['image_name']).'\'
        where
            image_id = '.intval($image_id).'
        '  ;
    }    
    if (!mysql_query($query))
        die(mysql_error());
    header('Location: '.$_SESSION['pages']['quest_image_list']);
    
}

if ($image_id == '') 
{
    $image = array(
        'image' => '',
        'image_name' => '',
    );
} 
else 
{
    $image = array();
    $res = mysql_query('select * from quest_images where image_id = '.intval($image_id));
    if($row = mysql_fetch_assoc($res))
        $image = $row;
    mysql_free_result($res);
}

?>
    <h3><?= ($image_id == '' ? 'Добавить картинку' : 'Изменить картинку') ?></h3>

<form name="edit_bank" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td>Картинка: &nbsp;</td>
  <td><input name="image" type="text" class="cms_fieldstyle1" value="<?=$image['image']?>" size="30" maxlength="255" /></td>
</tr>
<? if ($image['image'] != '') { ?>
<tr>
  <td>&nbsp;  </td>
  <td><img src="http://image.neverlands.ru/gameplay/faces/<?=$image['image']?>" /></td>
</tr>
<? } ?>
<tr>
    <td>Название: &nbsp;</td>
  <td><input name="image_name" type="text" class="cms_fieldstyle1" value="<?=$image['image_name']?>" size="30" maxlength="255" /></td>
</tr>
</table>

<p></p>
    <input name="submit" type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
    <input name="cancel" type="submit"
           onclick="document.location='<?= $_SESSION['pages']['quest_image_list'] ?>'; return false;"
           class="cms_button1" value="Отмена"/>
    <p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>