<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_object_code']) && $_GET['delete_object_code']!='') 
{
    $object_code = $_GET['delete_object_code'];
    mysql_query('delete from world_objects where object_code = \''.mysql_real_escape_string($object_code).'\'');
    header('Location: '.$_SESSION['pages']['world_map_object_list']);
}

$zones = array();
$res = mysql_query('select * from world_zones');
while($row = mysql_fetch_assoc($res))
    $zones[$row['zone_code']] = $row['zone_name'];
mysql_free_result($res);

$object_array = array();
$res = mysql_query('select * from world_objects');
while($row = mysql_fetch_assoc($res))
    $object_array[$row['object_code']] = $row['object_name'].' ('.$row['object_code'].')';
mysql_free_result($res);

if (isset($_GET['zone_code']))
    $zone_code = $_GET['zone_code'];
else
    $zone_code = '';

// PAGE NAVIGATOR
$query = 'select count(*) from world_objects '.
            ($zone_code!=''?'where zone_code = \''.mysql_escape_string($zone_code).'\'':'');
$res = mysql_query($query, $db);
$row = mysql_fetch_row($res);
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
        ($zone_code!=''?'where zone_code = \''.mysql_escape_string($zone_code).'\'':'').
        generateMysqlOrder().
        generateMysqlLimit($cur_page, $recs_per_page);
        
$res = mysql_query($query, $db); 
while ($row = mysql_fetch_assoc($res))
{
    $objects.='
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'�� ������� ��� ������ ������� ������?\');" href="world_map_object_list.php?delete_object_code='.$row['object_code'].'" title="Delete Item"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="world_map_object_edit.php?object_code='.$row['object_code'].'" title="�������� ������"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$zones[$row['zone_code']].'</td>
      <td align="left" class="cms_middle">'.$row['object_module'].'</td>
      <td align="left" class="cms_middle">'.(isset($row['parent_code']) && isset($object_array[$row['parent_code']])?$object_array[$row['parent_code']]: (isset($row['parent_code'])?$row['parent_code']:'') ).'</td>
      <td align="left" class="cms_middle">'.$row['object_code'].'</td>
      <td align="left" class="cms_middle"><a href="world_map_object_edit.php?object_code='.$row['object_code'].'" title="�������� ������">'._htext($row['object_name']).'</a></td>
    </tr>
    ';
}

$_SESSION['pages']['world_map_object_list'] = $_SERVER['REQUEST_URI'];

?>
<h3>������ ��������</h3>
<form name="filter" id="filter" action="" method="get">
<input type="hidden" name="sort_by" value="<?=(isset($_GET['sort_by'])?$_GET['sort_by']:'')?>" />
<input type="hidden" name="sort_order" value="<?=(isset($_GET['sort_order'])?$_GET['sort_order']:'')?>" />
<div id="filter"><h4>������: </h4>
<div id="cms_filter"> 
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td>����:</td>
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
    <div id="cms_navigator"><?=createPageNavigator($records_count, $cur_page, '�������')?></div>

    <div class="cms_ind">
        <br />
        ��������: <br />
         <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
            <tr >
              <td class="cms_cap2 normal"> ������� </td>
              <td class="cms_cap2 normal"> �������� </td>

              <td class="cms_cap2">����</td>
              <td class="cms_cap2"><a href="<?=sortby('object_module')?>">������</a></td>
              <td class="cms_cap2">��� ���������</td>
              <td class="cms_cap2"><a href="<?=sortby('object_code')?>">��� �������</a></td>
              <td class="cms_cap2"><a href="<?=sortby('object_name')?>">�������� �������</a></td>
            </tr>
            
            <?=$objects?>
            
            </table>
            <br />
    </div>
    <div id="cms_navigator"><?=createPageNavigator($records_count, $cur_page, '�������')?></div> 
</div>
<br />
<img src="images/cms_icons/cms_add.gif" alt="�������� ������" /><a href="world_map_object_edit.php" title="�������� ������">�������� ������</a><br />
<br />
<? require('kernel/after.php'); ?>