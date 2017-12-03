<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_service_type_id']) && $_GET['delete_service_type_id']!='' && is_numeric($_GET['delete_service_type_id'])) {
    $service_type = (int)$_GET['delete_service_type_id'];
    mysql_query('delete from service_add where service_type = '.$service_type);
    mysql_query('delete from service_types where service_type = '.$service_type);
    header('Location: service_list.php');
}

if (isset($_GET['delete_service_id']) && $_GET['delete_service_id']!='' && is_numeric($_GET['delete_service_id'])) {
    $service_id = (int)$_GET['delete_service_id'];
    mysql_query('delete from service_list where list_id = '.$service_id);
    header('Location: service_list.php');
}


$service_types = '';
$service_types_array = array();
$res = mysql_query('select * from service_types'); 
while ($row = mysql_fetch_assoc($res))
{
    $service_types .= '
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Are you sure you want to delete this service type?\');" href="service_list.php?delete_service_type_id='.$row['service_type'].'" title="Delete Service Type"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="service_type_edit.php?service_type_id='.$row['service_type'].'" title="Edit Service Type"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$row['service_type'].'</td>
      <td align="left" class="cms_middle">'.pow(2, $row['service_type']).'</td>
      <td align="left" class="cms_middle">'.$row['service_class'].'</td>
      <td align="left" class="cms_middle"><a href="service_type_edit.php?service_type_id='.$row['service_type'].'" title="Edit Service Type">'._htext($row['service_name']).'</a></td>
    </tr>
    ';
    $service_types_array[$row['service_type']] = $row['service_name'];
}
mysql_free_result($res);


$services = '';
$res = mysql_query('select * from service_list'); 
while ($row = mysql_fetch_assoc($res))
{
    $services .= '
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Are you sure you want to delete this service?\');" href="service_list.php?delete_service_id='.$row['list_id'].'" title="Delete Service"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="service_edit.php?service_id='.$row['list_id'].'" title="Edit Service"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$row['list_id'].'</td>
      <td align="left" class="cms_middle"><a href="service_edit.php?service_id='.$row['list_id'].'" title="Edit Service">'.$service_types_array[$row['service_type']].'</a></td>
      <td align="left" class="cms_middle">'.$row['service_days'].'</td>
      <td align="left" class="cms_middle">'.$row['service_dnv'].'</td>
    </tr>
    ';
}
mysql_free_result($res);

?>
    <h3>Список платных сервисов</h3>
<div class="cms_ind">
    <br />
    Сервисы: <br/>
    <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
        <td class="cms_cap2 normal"> Удалить</td>
        <td class="cms_cap2 normal"> Изменить</td>

        <td class="cms_cap2">ID Сервиса</td>
        <td class="cms_cap2">&nbsp;</td>
        <td class="cms_cap2">Класс сервиса</td>
        <td class="cms_cap2">Название сервиса</td>
    </tr>

    <?=$service_types?>

    </table>
    <img src="images/cms_icons/cms_add.gif" alt="Добавить сервис"/><a href="service_type_edit.php"
                                                                      title="Добавить сервис">Добавить сервис</a> &nbsp;<br/>
    <br />
    Продолжительность и цены: <br/>
    <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
        <td class="cms_cap2 normal"> Удалить</td>
        <td class="cms_cap2 normal"> Изменить</td>

        <td class="cms_cap2">ID</td>
        <td class="cms_cap2">Сервис</td>
        <td class="cms_cap2">Количество дней</td>
        <td class="cms_cap2">Цена DNV</td>
    </tr>

    <?=$services?>

    </table>
    <img src="images/cms_icons/cms_add.gif" alt="Добавить сервис"/><a href="service_edit.php" title="Добавить сервис">Добавить
        сервис</a> &nbsp;<br/>
    <br />
</div>
<br />

<? require('kernel/after.php'); ?>