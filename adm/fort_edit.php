<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['fort_id']))
    $fort_id = '';
else
    $fort_id = $_GET['fort_id'];
    
if (isset($_POST['fort_id'])) {
    
    if ($fort_id == '') {
        $query = '
        insert into forts
        (
            fort_id,
            fort_class,
            teleport,
            hp,
            mp,
            massa,
            cmassa
        ) values (
            \''.mysql_real_escape_string($_POST['fort_id']).'\',
            '.(int)$_POST['fort_class'].',
            '.(int)$_POST['teleport'].',
            '.(int)$_POST['hp'].',
            '.(int)$_POST['mp'].',
            '.(int)$_POST['massa'].',
            '.(int)$_POST['cmassa'].'
        )'  ;
    } else {
        $query = '
        update forts set
            fort_id = \''.mysql_escape_string($_POST['fort_id']).'\',
            fort_class = '.(int)$_POST['fort_class'].',
            teleport = '.(int)$_POST['teleport'].',
            hp = '.(int)$_POST['hp'].',
            mp = '.(int)$_POST['mp'].',
            massa = '.(int)$_POST['massa'].',
            cmassa = '.(int)$_POST['cmassa'].'
        where
            fort_id = \''.mysql_real_escape_string($fort_id).'\'
        '  ;
    }    
    if (!mysql_query($query))
        die(mysql_error());
    header('Location: fort_list.php');
    
}

$fort_classes = array();
$res = mysql_query('select * from forts_classes');
while($row = mysql_fetch_assoc($res))
    $fort_classes[$row['fort_class']] = $row['class_name'];
mysql_free_result($res);

if ((string)$fort_id == '') {
    $fort = array(
        'fort_id' => '',
        'fort_class' => 1,
        'teleport' => '0',
        'hp' => '0',
        'mp' => '0',
        'massa' => '0',
        'cmassa' => '0',
    );
} else {
    $fort = array();
    $res = mysql_query('select * from forts where fort_id = \''.mysql_real_escape_string($fort_id).'\'');
    if($row = mysql_fetch_assoc($res))
        $fort = $row;
    mysql_free_result($res);
}

?>
    <h3><?= ($fort_id == '' ? 'Добавить замок' : 'Изменить замок') ?></h3>

<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td>ID Замка: &nbsp;</td>
  <td><input name="fort_id" type="text" class="cms_fieldstyle1" value="<?=$fort['fort_id']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
    <td>Класс замка: &nbsp;</td>
  <td><?=createSelectFromArray('fort_class', $fort_classes, $fort['fort_class'])?></td>
</tr>
<tr>
    <td>Телепорт: &nbsp;</td>
  <td><input name="teleport" type="text" class="cms_fieldstyle1" value="<?=$fort['teleport']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
  <td>HP: &nbsp;  </td>
  <td><input name="hp" type="text" class="cms_fieldstyle1" value="<?=$fort['hp']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
  <td>MP: &nbsp;  </td>
  <td><input name="mp" type="text" class="cms_fieldstyle1" value="<?=$fort['mp']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
    <td>Масса: &nbsp;</td>
  <td><input name="massa" type="text" class="cms_fieldstyle1" value="<?=$fort['massa']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
    <td>Масса: &nbsp;</td>
  <td><input name="cmassa" type="text" class="cms_fieldstyle1" value="<?=$fort['cmassa']?>" size="10" maxlength="255" /></td>
</tr>
</table>

<p></p>
    <input name="submit" type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
    <input name="cancel" type="submit" onclick="document.location='fort_list.php'; return false;" class="cms_button1"
           value="Отмена"/>
    <p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>