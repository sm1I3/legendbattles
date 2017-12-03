<?php
require('kernel/before.php');

if (!userHasPermission(32)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_resource_group_id']) && $_GET['delete_resource_group_id']!='' && is_numeric($_GET['delete_resource_group_id'])) {
    $resource_group_id = (int)$_GET['delete_resource_group_id'];
    mysql_query('delete from resource_group_cont where resource_group_id = '.$resource_group_id);
    mysql_query('delete from resource_group where resource_group_id = '.$resource_group_id);
    header('Location: '.$_SESSION['pages']['resource_group_list']);
}

// PAGE NAVIGATOR
$query = 'select count(*) from resource_group ';
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

$query = 'select * from resource_group '.
        generateMysqlOrder().
        generateMysqlLimit($cur_page, $recs_per_page);



$resource_groups = '';
$res = mysql_query($query); 
while ($row = mysql_fetch_assoc($res))
{
    $resource_groups.='
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'�� ������� ��� ������ ������� ��� ������ ��������?\');" href="resource_group_list.php?delete_resource_group_id='.$row['resource_group_id'].'" title="�������"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="resource_group_edit.php?resource_group_id='.$row['resource_group_id'].'" title="��������"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$row['resource_group_id'].'</td>
      <td align="left" class="cms_middle">'.$row['resource_group_name'].'</td>
    </tr>
    ';
}

$_SESSION['pages']['resource_group_list'] = $_SERVER['REQUEST_URI'];

?>
<h3>������ ����� ��������</h3>

<div id="results">
    <div id="cms_navigator"><?=createPageNavigator($records_count, $cur_page, '������ ��������')?></div>

    <div class="cms_ind">
        <br />
        �������: <br />
         <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
            <tr >
              <td class="cms_cap2 normal"> ������� </td>
              <td class="cms_cap2 normal"> �������� </td>

              <td class="cms_cap2"><a href="<?=sortby('resource_group_id')?>">ID ������</a></td>
              <td class="cms_cap2"><a href="<?=sortby('resource_group_name')?>">�������� �������</a></td>
            </tr>
            <?=$resource_groups?>   
         </table>
         <br />
    </div>
    <div id="cms_navigator"><?=createPageNavigator($records_count, $cur_page, '������ ��������')?></div> 
</div>
 
 <br />
 <img src="images/cms_icons/cms_add.gif" alt="�������� ������" /><a href="resource_group_edit.php" title="�������� ������ ��������">�������� ������ ��������</a> &nbsp;
 <br />

<? require('kernel/after.php'); ?>