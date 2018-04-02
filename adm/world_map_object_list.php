<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_object_code']) && $_GET['delete_object_code']!='') 
{
    $object_code = $_GET['delete_object_code'];
    mysqli_query($GLOBALS['db_link'], 'delete from world_objects where object_code = \'' . mysqli_real_escape_string($GLOBALS['db_link'], $object_code) . '\'');
    header('Location: '.$_SESSION['pages']['world_map_object_list']);
}

$zones = array();
$res = mysqli_query($GLOBALS['db_link'], 'select * from world_zones');
while ($row = mysqli_fetch_assoc($res))
    $zones[$row['zone_code']] = $row['zone_name'];
mysqli_free_result($res);

$object_array = array();
$res = mysqli_query($GLOBALS['db_link'], 'select * from world_objects');
while ($row = mysqli_fetch_assoc($res))
    $object_array[$row['object_code']] = $row['object_name'].' ('.$row['object_code'].')';
mysqli_free_result($res);

if (isset($_GET['zone_code']))
    $zone_code = $_GET['zone_code'];
else
    $zone_code = '';

// PAGE NAVIGATOR
$query = 'select count(*) from world_objects '.
    ($zone_code != '' ? 'where zone_code = \'' . mysqli_escape_string($GLOBALS['db_link'], $zone_code) . '\'' : '');
$res = mysqli_query($GLOBALS['db_link'], $query, $db);
$row = mysqli_fetch_row($res);
$records_count = $row[0];

$pages_count = ceil($records_count / $recs_per_page);
if (!isset($_GET['page']) || $_GET['page'] == '')
    $cur_page = 1;
else
    $cur_page = (int)$_GET['page'];
if ($cur_page < 0) $cur_page = 1;
elseif ($cur_page > $pages_count) $cur_page = $pages_count;
// END PAGE NAVIGATOR


$objects = '';
$query = 'select * from world_objects '.
    ($zone_code != '' ? 'where zone_code = \'' . mysqli_escape_string($GLOBALS['db_link'], $zone_code) . '\'' : '') .
        generateMysqlOrder().
        generateMysqlLimit($cur_page, $recs_per_page);

$res = mysqli_query($GLOBALS['db_link'], $query, $db);
while ($row = mysqli_fetch_assoc($res))
{
    $objects.='
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Вы уверены что хотите удалить объект?\');" href="world_map_object_list.php?delete_object_code=' . $row['object_code'] . '" title="Delete Item"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="world_map_object_edit.php?object_code=' . $row['object_code'] . '" title="Изменить объект"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$zones[$row['zone_code']].'</td>
      <td align="left" class="cms_middle">'.$row['object_module'].'</td>
      <td align="left" class="cms_middle">'.(isset($row['parent_code']) && isset($object_array[$row['parent_code']])?$object_array[$row['parent_code']]: (isset($row['parent_code'])?$row['parent_code']:'') ).'</td>
      <td align="left" class="cms_middle">'.$row['object_code'].'</td>
      <td align="left" class="cms_middle"><a href="world_map_object_edit.php?object_code=' . $row['object_code'] . '" title="Изменить объект">' . _htext($row['object_name']) . '</a></td>
    </tr>
    ';
}

$_SESSION['pages']['world_map_object_list'] = $_SERVER['REQUEST_URI'];

?>
    <h3>Список объектов</h3>
<form name="filter" id="filter" action="" method="get">
<input type="hidden" name="sort_by" value="<?=(isset($_GET['sort_by'])?$_GET['sort_by']:'')?>" />
<input type="hidden" name="sort_order" value="<?=(isset($_GET['sort_order'])?$_GET['sort_order']:'')?>" />
    <div id="filter"><h4>Фильтр: </h4>
<div id="cms_filter"> 
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
      <td>Зона:</td>
    <td>
        <?=createSelectFromArray('zone_code', $zones, (isset($_GET['zone_code'])?$_GET['zone_code']:''))?>
    </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
<script language="javascript">
function clearFilter()
{
    d.forms['filter'].zone_code.selectedIndex = 0;
}
</script>
<input type="submit" name="filter" value="OK" style="width: 100px;" /><input type="button" onclick="clearFilter(); return false;" name="clear" value="Clear" style="width: 80px;" />
</div>  
</div>
</form>
<div id="results">
    <div id="cms_navigator"><?= createPageNavigator($records_count, $cur_page, 'Объекты') ?></div>

    <div class="cms_ind">
        <br />
        Предметы: <br/>
         <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
            <tr >
                <td class="cms_cap2 normal"> Удалить</td>
                <td class="cms_cap2 normal"> Изменить</td>

                <td class="cms_cap2">Зона</td>
                <td class="cms_cap2"><a href="<?= sortby('object_module') ?>">Модуль</a></td>
                <td class="cms_cap2">Где находится</td>
                <td class="cms_cap2"><a href="<?= sortby('object_code') ?>">Код объекта</a></td>
                <td class="cms_cap2"><a href="<?= sortby('object_name') ?>">Название объекта</a></td>
            </tr>
            
            <?=$objects?>
            
            </table>
            <br />
    </div>
    <div id="cms_navigator"><?= createPageNavigator($records_count, $cur_page, 'Объекты') ?></div>
</div>
<br />
    <img src="images/cms_icons/cms_add.gif" alt="Добавить объект"/><a href="world_map_object_edit.php"
                                                                      title="Добавить объект">Добавить объект</a><br/>
<br />
<? require('kernel/after.php'); ?>