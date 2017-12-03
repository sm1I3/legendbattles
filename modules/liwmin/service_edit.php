<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

$row_id = 0;

if (!isset($_GET['service_id']) || !is_numeric($_GET['service_id']))
    $service_id = '';
else
    $service_id = (int)$_GET['service_id'];
    
$service_types_array = array();
$res = mysql_query('select * from service_types'); 
while ($row = mysql_fetch_assoc($res))
    $service_types_array[$row['service_type']] = $row['service_name'];
mysql_free_result($res);
    
if (isset($_POST['service_type'])) {
    
    if ($service_id == '') {
        $query = '
        insert into service_list
        (
            service_type,
            service_days,
            service_dnv
        ) values (
            '.(int)$_POST['service_type'].',
            '.(int)$_POST['service_days'].',
            '.(float)$_POST['service_dnv'].'
        )';
    } else {
        $query = '
        update service_list set
            service_type = '.(int)$_POST['service_type'].',
            service_days = '.(int)$_POST['service_days'].',
            service_dnv = '.(float)$_POST['service_dnv'].'
        where
            list_id = '.intval($service_id).'
        ';
    }    
    mysql_query($query);
    header('Location: service_list.php');
    
}

if ($service_id == '') {
    $service = array(
        'service_type' => '',
        'service_days' => '',
        'service_dnv' => '',
    );
} else {
    $service = array();
    $res = mysql_query('select * from service_list where list_id = '.intval($service_id));
    if($row = mysql_fetch_assoc($res))
        $service = $row;
    mysql_free_result($res);
}

?>
<h3><?=($service_id == ''?'Добавить сервис':'Изменить сервис')?></h3>

<form name="edit_service" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
  <td>Сервис: &nbsp;  </td>
  <td><?=createSelectFromArray('service_type', $service_types_array, $service['service_type'])?></td>
</tr>
<tr>
  <td>Кол-во дней: &nbsp;  </td>
  <td><input name="service_days" type="text" class="cms_fieldstyle1" value="<?=$service['service_days']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
  <td>Цена: &nbsp;  </td>
  <td><input name="service_dnv" type="text" class="cms_fieldstyle1" value="<?=$service['service_dnv']?>" size="10" maxlength="255" /></td>
</tr>
</table>

<p></p>
  <input name="submit"  type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
  <input name="cancel" type="submit" onclick="document.location='service_list.php'; return false;" class="cms_button1" value="Отмена" />
<p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>