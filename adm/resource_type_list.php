<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_resource_type_id']) && $_GET['delete_resource_type_id']!='' && is_numeric($_GET['delete_resource_type_id'])) 
{
    $resource_type_id = (int)$_GET['delete_resource_type_id'];
    mysql_query('delete from resource_types where resource_type_id = '.intval($resource_type_id));
    header('Location: resource_type_list.php');
}

$resource_types = '';
$res = mysql_query('select * from resource_types'); 
while ($row = mysql_fetch_assoc($res))
{
    $resource_types .= '
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Are you sure you want to delete this resource type?\');" href="resource_type_list.php?delete_resource_type_id='.$row['resource_type_id'].'" title="Delete Resource Type"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="resource_type_edit.php?resource_type_id='.$row['resource_type_id'].'" title="Edit Resource Type"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$row['resource_type_id'].'</td>
      <td align="left" class="cms_middle"><a href="resource_type_edit.php?resource_type_id='.$row['resource_type_id'].'" title="Edit Resource Type">'._htext($row['resource_type_name']).'</a></td>
    </tr>
    ';
}

?>
<h3>Список типов ресурсов</h3>
<div class="cms_ind">
<br />
Типы ресурсов: <br />
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
      <td class="cms_cap2 normal"> Удалить </td>
      <td class="cms_cap2 normal"> Изменить </td>

      <td class="cms_cap2">ID Типа ресурса</td>
      <td class="cms_cap2">Название типа ресурса</td>
    </tr>
    
    <?=$resource_types?>
    
    </table>
    <br />
 </div>
 <img src="images/cms_icons/cms_add.gif" alt="Добавить тип ресурса" /><a href="resource_type_edit.php" title="Добавить тип ресурса">Добавить тип ресурса</a> &nbsp;<br />
 <br />

<? require('kernel/after.php'); ?>