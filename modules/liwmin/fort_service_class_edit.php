<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['fort_service_class_id']) || !is_numeric($_GET['fort_service_class_id']))
    $fort_service_class_id = '';
else
    $fort_service_class_id = (int)$_GET['fort_service_class_id'];
    
if (isset($_POST['service_id'])) {
    
    if ($fort_service_class_id == '') {
        $query = '
        insert into forts_serv_classes
        (
            service_id,
            service_name
        ) values (
            '.(int)$_POST['service_id'].',
            \''.mysql_escape_string($_POST['service_name']).'\'
        )'  ;
    } else {
        $query = '
        update forts_serv_classes set
            service_id = '.(int)$_POST['service_id'].',
            service_name = \''.mysql_escape_string($_POST['service_name']).'\'
        where
            service_id = '.intval($fort_service_class_id).'
        '  ;
    }    
    if (!mysql_query($query))
        die(mysql_error());
    header('Location: fort_service_class_list.php');
    
}

if ((string)$fort_service_class_id == '') {
    $fort_service_class = array(
        'service_id' => '',
        'service_name' => '',
    );
} else {
    $fort_service_class = array();
    $res = mysql_query('select * from forts_serv_classes where service_id = '.intval($fort_service_class_id));
    if($row = mysql_fetch_assoc($res))
        $fort_service_class = $row;
    mysql_free_result($res);
}

?>
<h3><?=($fort_service_class_id == ''?'Добавить класс сервисов':'Изменить класс сервисов')?></h3>

<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
  <td>ID Класса: &nbsp;  </td>
  <td><input name="service_id" type="text" class="cms_fieldstyle1" value="<?=$fort_service_class['service_id']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
  <td>Название класса: &nbsp;  </td>
  <td><input name="service_name" type="text" class="cms_fieldstyle1" value="<?=$fort_service_class['service_name']?>" size="30" maxlength="255" /></td>
</tr>
</table>

<p></p>
  <input name="submit"  type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
  <input name="cancel" type="submit" onclick="document.location='fort_service_class_list.php'; return false;" class="cms_button1" value="Отмена" />
<p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>