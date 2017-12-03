<?php
require('kernel/before.php');

if (!userHasPermission(32)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_resource_id']) && $_GET['delete_resource_id']!='' && is_numeric($_GET['delete_resource_id'])) 
{
    $resource_id = (int)$_GET['delete_resource_id'];
    mysql_query('delete from restore_resources where resource_id = '.intval($resource_id));
    header('Location: '.$_SESSION['pages']['resource_list']);
}

if (isset($_GET['resource_type']) && $_GET['resource_type'] != '')
    $resource_type = $_GET['resource_type'];
else
    $resource_type = '';
    
$resource_types = array();
$res = mysql_query('select * from resource_types');
while($row = mysql_fetch_assoc($res))
    $resource_types[$row['resource_type_id']] = $row['resource_type_name'];
mysql_free_result($res);

// PAGE NAVIGATOR
$query = 'select count(*) from restore_resources '.($resource_type!=''?'where resource_type = '.intval($resource_type):'');
$res = mysql_query($query);
$row = mysql_fetch_row($res);
$records_count = $row[0];

$pages_count = ceil($records_count / $recs_per_page);
if (!isset($_GET['page']) || $_GET['page'] == '')
    $cur_page = 1;
else
    $cur_page = (int)$_GET['page'];

if ($cur_page > $pages_count) $cur_page = $pages_count;
if ($cur_page <= 0) $cur_page = 1;
// END PAGE NAVIGATOR

$query = 'select * from restore_resources '.
        ($resource_type!=''?'where resource_type = '.$resource_type:'').
        generateMysqlOrder().
        generateMysqlLimit($cur_page, $recs_per_page);



$resources = '';
$res = mysql_query($query); 
while ($row = mysql_fetch_assoc($res))
{
    $resources.='
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'�� ������� ��� ������ ������� ���� ������?\');" href="resource_list.php?delete_resource_id='.$row['resource_id'].'" title="�������"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="resource_edit.php?resource_id='.$row['resource_id'].'" title="��������"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$row['resource_id'].'</td>
      <td align="left" class="cms_middle">'.$resource_types[$row['resource_type']].'</td>
      <td align="left" class="cms_middle"><a href="resource_edit.php?resource_id='.$row['resource_id'].'" title="��������">'._htext($row['resource_name']).'</a></td>
      <td align="left" class="cms_middle">'.$row['resource_cost'].'</td>
      <td align="left" class="cms_middle">'.$row['resource_store'].'</td>
      <td align="left" class="cms_middle">'.$row['resource_requirement'].'</td>
    </tr>
    ';
}

$_SESSION['pages']['resource_list'] = $_SERVER['REQUEST_URI'];

?>
<h3>������ ��������</h3>

<form name="filter" id="filter" action="" method="get">
<input type="hidden" name="sort_by" value="<?=(isset($_GET['sort_by'])?$_GET['sort_by']:'')?>" />
<input type="hidden" name="sort_order" value="<?=(isset($_GET['sort_order'])?$_GET['sort_order']:'')?>" />
<div id="filter"><h4>������: </h4>
<div id="cms_filter"> 
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td>��� �������:</td>
    <td>
        <?=createSelectFromArray('resource_type', $resource_types, (isset($_GET['resource_type'])?$_GET['resource_type']:''))?>
    </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
<script language="javascript">
function clearFilter()
{
    d.forms['filter'].resource_type.selectedIndex = 0;
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
        �������: <br />
         <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
            <tr >
              <td class="cms_cap2 normal"> ������� </td>
              <td class="cms_cap2 normal"> �������� </td>

              <td class="cms_cap2"><a href="<?=sortby('resource_id')?>">ID �������</a></td>
              <td class="cms_cap2">��� �������</td>
              <td class="cms_cap2"><a href="<?=sortby('resource_name')?>">�������� �������</a></td>
              <td class="cms_cap2"><a href="<?=sortby('resource_cost')?>">���������</a></td>
              <? //TODO: Translate Store ?>
              <td class="cms_cap2">Store</td>
              <td class="cms_cap2">Requirement</td>
            </tr>
            <?=$resources?>   
         </table>
         <br />
    </div>
    <div id="cms_navigator"><?=createPageNavigator($records_count, $cur_page, '�������')?></div> 
</div>
 
 <br />
 <img src="images/cms_icons/cms_add.gif" alt="�������� ������" /><a href="resource_edit.php" title="�������� ������">�������� ������</a> &nbsp;
 <br />

<? require('kernel/after.php'); ?>