<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

$row_id = 0;

if (!isset($_GET['service_type_id']) || !is_numeric($_GET['service_type_id']))
    $service_type_id = '';
else
    $service_type_id = (int)$_GET['service_type_id'];
    
if (isset($_POST['service_name'])) {
    
    if ($service_type_id == '') {
        $query = '
        insert into service_types
        (
            service_class,
            service_name
        ) values (
            '.(int)$_POST['service_class'].',
            \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['service_name']) . '\'
        )';
        mysqli_query($GLOBALS['db_link'], $query);
        $service_type_id = mysqli_insert_id($GLOBALS['db_link']);
    } else {
        $query = '
        update service_types set
            service_class = '.(int)$_POST['service_class'].',
            service_name = \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['service_name']) . '\'
        where
            service_type = '.intval($service_type_id).'
        ';
        mysqli_query($GLOBALS['db_link'], $query);
    }

    mysqli_query($GLOBALS['db_link'], 'DELETE FROM service_add WHERE service_type = ' . intval($service_type_id));
    
    if (isset($_POST['add_service']) && is_array($_POST['add_service']))
    foreach($_POST['add_service'] as $i=>$sid)
        if ($sid != '')
            mysqli_query($GLOBALS['db_link'], '
            INSERT INTO service_add (service_type, add_service_type, price)
            VALUES ('.(int)$service_type_id.', '.(int)$sid.', '.(float)$_POST['add_service_price'][$i].')
        ');
    
    
    header('Location: service_list.php');
    
}

if ($service_type_id == '') {
    $service_type = array(
        'service_class' => '',
        'service_name' => ''
    );
} else {
    $service_type = array();
    $res = mysqli_query($GLOBALS['db_link'], 'select * from service_types where service_type = ' . intval($service_type_id));
    if ($row = mysqli_fetch_assoc($res))
        $service_type = $row;
    mysqli_free_result($res);
}

$service_array = array();
$res = mysqli_query($GLOBALS['db_link'], 'select * from service_types');
while ($row = mysqli_fetch_assoc($res))
    $service_array[$row['service_type']] = $row['service_name'];
mysqli_free_result($res);

$add_services = '';
if ($service_type_id != '')
{
    $res = mysqli_query($GLOBALS['db_link'], 'SELECT * FROM service_add WHERE service_type = ' . intval($service_type_id));
    while ($row = mysqli_fetch_assoc($res))
        $add_services .= '
        <tr id="tr_service_'.(++$row_id).'">
          <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_service_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
          <td align="left" class="cms_middle">'.createSelectFromArray('add_service[]', $service_array, $row['add_service_type']).'</td>
          <td align="left" class="cms_middle"><input name="add_service_price[]" type="text" class="cms_fieldstyle1" value="'.$row['price'].'" size="10" maxlength="255" /></td>
        </tr>';
}

?>
    <h3><?= ($service_type == '' ? 'Добавить сервис' : 'Изменить сервис') ?></h3>
<script language="javascript">
var last_id = <?=$row_id?>;
<?=createJsArray('service_array', $service_array)?>
</script>
<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td>Класс сервиса: &nbsp;</td>
  <td><input name="service_class" type="text" class="cms_fieldstyle1" value="<?=$service_type['service_class']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td>Название сервиса: &nbsp;</td>
  <td><input name="service_name" type="text" class="cms_fieldstyle1" value="<?=$service_type['service_name']?>" size="30" maxlength="255" /></td>
</tr>
</table>
    Дополнительные сервисы:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_services" >
    <tr >
        <td class="cms_cap3 normal">Удалить</td>
        <td class="cms_cap3">Сервис</td>
        <td class="cms_cap3">Цена</td>
    </tr>
    <?=$add_services?>
</table>
    <a onclick="addItem_select('table_services', 'tr_service', 'add_service[]', service_array, 'add_service_price[]', ''); return false;"
       href="#">Добавить сервис</a><br/>
<br />

<p></p>
    <input name="submit" type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
    <input name="cancel" type="submit" onclick="document.location='service_list.php'; return false;" class="cms_button1"
           value="Отмена"/>
    <p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>