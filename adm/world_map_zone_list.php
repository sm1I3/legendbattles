<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_zone_code']) && $_GET['delete_zone_code']!='') 
{
    $zone_code = $_GET['delete_zone_code'];
    mysql_query('delete from world_zones where zone_code = \''.mysql_real_escape_string($zone_code).'\'');
    header('Location: world_map_zone_list.php');
}

$zones = '';
$res = mysql_query('select * from world_zones'); 
while ($row = mysql_fetch_assoc($res))
{
    $zones .= '
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Вы уверены что хотите удалить эту зону?\');" href="world_map_zone_list.php?delete_zone_code=' . $row['zone_code'] . '" title="Удалить зону"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="world_map_zone_edit.php?zone_code=' . $row['zone_code'] . '" title="Изменить зону"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$row['zone_code'].'</td>
      <td align="left" class="cms_middle"><a href="world_map_zone_edit.php?zone_code=' . $row['zone_code'] . '" title="Изменить зону">' . _htext(substr($row['zone_name'], 0, 100)) . '</a></td>
    </tr>
    ';
}

?>
    <h3>Список зон</h3>
<div class="cms_ind">
    <br />
    Зоны: <br/>
    <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
        <tr >
            <td class="cms_cap2 normal"> Удалить</td>
            <td class="cms_cap2 normal"> Изменить</td>

            <td class="cms_cap2">Код зоны</td>
            <td class="cms_cap2">Название зоны</td>
        </tr>
    
        <?=$zones?>
    
    </table>
    <br />
</div>
    <img src="images/cms_icons/cms_add.gif" alt="Добавить зону"/><a href="world_map_zone_edit.php"
                                                                    title="Добавить зону">Добавить зону</a> &nbsp;<br/>
<br />

<? require('kernel/after.php'); ?>