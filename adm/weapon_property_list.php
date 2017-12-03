<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

$property_types = array(
    1 => 'Основные требования',
    2 => 'Требования умений',
    3 => 'Основные хар-ки',
    4 => 'Дополнительные умения'
);

if (isset($_GET['delete_property_code']) && $_GET['delete_property_code']!='') {
    $weapon_property_code = $_GET['delete_property_code'];
    mysql_query('delete from weapon_properties where property_code = \''.mysql_real_escape_string($weapon_property_code).'\'');
    header('Location: weapon_property_list.php');
}

$weapon_properties = '';
$res = mysql_query('select * from weapon_properties'); 
while ($row = mysql_fetch_assoc($res))
{
    $weapon_properties .= '
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Вы уверены что хотите удалить этот параметр оружия?\');" href="weapon_property_list.php?delete_property_code='.$row['property_code'].'" title="Удалить параметр оружия"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="weapon_property_edit.php?property_code='.$row['property_code'].'" title="Изменить параметр оружия"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$property_types[$row['property_type']].'</td>
      <td align="left" class="cms_middle">'.$row['property_code'].'</td>
      <td align="left" class="cms_middle"><a href="weapon_property_edit.php?property_code='.$row['property_code'].'" title="Изменить параметр оружия">'._htext($row['property_name']).'</a></td>
    </tr>
    ';
}

?>
<h3>Список параметров оружия</h3>
<div class="cms_ind">
<br />
Параметры оружия: <br />
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
      <td class="cms_cap2 normal"> Удалить </td>
      <td class="cms_cap2 normal"> Изменить </td>

      <td class="cms_cap2">Тип параметра</td>
      <td class="cms_cap2">Код параметра</td>
      <td class="cms_cap2">Название параметра</td>
    </tr>
    
    <?=$weapon_properties?>
    
    </table>
    <br />
 </div>
 <img src="images/cms_icons/cms_add.gif" alt="Добавить параметр" /><a href="weapon_property_edit.php" title="Добавить параметр">Добавить параметр</a> &nbsp;<br />
 <br />

<? require('kernel/after.php'); ?>