<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['fort_service_id']))
    $fort_service_id = '';
else
    $fort_service_id = $_GET['fort_service_id'];
    
if (isset($_POST['service_id']) && $_POST['service_id']!='') {
    
    if ($fort_service_id == '') {
        $query = '
        insert into forts_serv_lists
        (
            service_id,
            service_size,
            service_time,
            service_nv,
            service_dnv
        ) values (
            '.(int)$_POST['service_id'].',
            '.(int)$_POST['service_size'].',
            '.(int)$_POST['service_time'].',
            '.(int)$_POST['service_nv'].',
            '.(int)$_POST['service_dnv'].'
        )'  ;
    } else { 
        $query = '
        update forts_serv_lists set
            service_id = '.(int)$_POST['service_id'].',
            service_size = '.(int)$_POST['service_size'].',
            service_time = '.(int)$_POST['service_time'].',
            service_nv = '.(int)$_POST['service_nv'].',
            service_dnv = '.(int)$_POST['service_dnv'].'
        where
            list_id = '.intval($fort_service_id).'
        '  ;
    }
    if (!mysqli_query($GLOBALS['db_link'], $query))
        die(mysqli_error($GLOBALS['db_link']));
    header('Location: fort_service_list.php');
    
}

$service_classes = array();
$res = mysqli_query($GLOBALS['db_link'], 'select * from forts_serv_classes');
while ($row = mysqli_fetch_assoc($res))
    $service_classes[$row['service_id']] = $row['service_name'];
mysqli_free_result($res);

if ((string)$fort_service_id == '') {
    $fort_service = array(
        'service_id' => '',
        'service_size' => '',
        'service_time' => '',
        'service_nv' => '',
        'service_dnv' => '',
    );
} else {
    $fort_service = array();
    $res = mysqli_query($GLOBALS['db_link'], 'select * from forts_serv_lists where list_id = \'' . mysqli_real_escape_string($GLOBALS['db_link'], $fort_service_id) . '\'');
    if ($row = mysqli_fetch_assoc($res))
        $fort_service = $row;
    mysqli_free_result($res);
}

?>
    <h3><?= ($fort_service_id == '' ? 'Добавить сервис' : 'Изменить сервис') ?></h3>

<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td>Сервис: &nbsp;</td>
  <td><?=createSelectFromArray('service_id', $service_classes, $fort_service['service_id'])?></td>
</tr>
<tr>
    <td>Размер: &nbsp;</td>
  <td><input name="service_size" type="text" class="cms_fieldstyle1" value="<?=$fort_service['service_size']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
    <td>Время: &nbsp;</td>
  <td><input name="service_time" type="text" class="cms_fieldstyle1" value="<?=$fort_service['service_time']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
  <td>NV: &nbsp;  </td>
  <td><input name="service_nv" type="text" class="cms_fieldstyle1" value="<?=$fort_service['service_nv']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
  <td>DNV: &nbsp;  </td>
  <td><input name="service_dnv" type="text" class="cms_fieldstyle1" value="<?=$fort_service['service_dnv']?>" size="10" maxlength="255" /></td>
</tr>
</table>

<p></p>
    <input name="submit" type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
    <input name="cancel" type="submit" onclick="document.location='fort_service_list.php'; return false;"
           class="cms_button1" value="Отмена"/>
    <p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>