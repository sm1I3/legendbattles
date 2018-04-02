<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['fort_class_id']) || !is_numeric($_GET['fort_class_id']))
    $fort_class_id = '';
else
    $fort_class_id = (int)$_GET['fort_class_id'];
    
if (isset($_POST['fort_class'])) {
    
    if ($fort_class_id == '') {
        $query = '
        insert into forts_classes
        (
            fort_class,
            class_name,
            teleport,
            hp,
            mp,
            massa
        ) values (
            '.(int)$_POST['fort_class'].',
            \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['class_name']) . '\',
            '.(int)$_POST['teleport'].',
            '.(int)$_POST['hp'].',
            '.(int)$_POST['mp'].',
            '.(int)$_POST['massa'].'
        )'  ;
    } else {
        $query = '
        update forts_classes set
            fort_class = '.(int)$_POST['fort_class'].',
            class_name = \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['class_name']) . '\',
            teleport = '.(int)$_POST['teleport'].',
            hp = '.(int)$_POST['hp'].',
            mp = '.(int)$_POST['mp'].',
            massa = '.(int)$_POST['massa'].'
        where
            fort_class = '.intval($fort_class_id).'
        '  ;
    }
    if (!mysqli_query($GLOBALS['db_link'], $query))
        die(mysqli_error($GLOBALS['db_link']));
    header('Location: fort_class_list.php');
    
}

if ((string)$fort_class_id == '') 
{
    $fort_class = array(
        'fort_class' => '',
        'class_name' => '',
        'teleport' => '0',
        'hp' => '0',
        'mp' => '0',
        'massa' => '0',
    );
} 
else 
{
    $ability = array();
    $res = mysqli_query($GLOBALS['db_link'], 'select * from forts_classes where fort_class = ' . intval($fort_class_id));
    if ($row = mysqli_fetch_assoc($res))
        $fort_class = $row;
    mysqli_free_result($res);
}

?>
    <h3><?= ($fort_class_id == '' ? 'Добавить класс замков' : 'Изменить класс замков') ?></h3>

<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td>ID Класса: &nbsp;</td>
  <td><input name="fort_class" type="text" class="cms_fieldstyle1" value="<?=$fort_class['fort_class']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
    <td>Название класса: &nbsp;</td>
  <td><input name="class_name" type="text" class="cms_fieldstyle1" value="<?=$fort_class['class_name']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td>Телепорт: &nbsp;</td>
  <td><input name="teleport" type="text" class="cms_fieldstyle1" value="<?=$fort_class['teleport']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
  <td>HP: &nbsp;  </td>
  <td><input name="hp" type="text" class="cms_fieldstyle1" value="<?=$fort_class['hp']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
  <td>MP: &nbsp;  </td>
  <td><input name="mp" type="text" class="cms_fieldstyle1" value="<?=$fort_class['mp']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
    <td>Масса: &nbsp;</td>
  <td><input name="massa" type="text" class="cms_fieldstyle1" value="<?=$fort_class['massa']?>" size="10" maxlength="255" /></td>
</tr>
</table>

<p></p>
    <input name="submit" type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
    <input name="cancel" type="submit" onclick="document.location='fort_class_list.php'; return false;"
           class="cms_button1" value="Отмена"/>
    <p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>