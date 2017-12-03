<?php

require('kernel/before.php');

if (!userHasPermission(1024)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['bots_items']))
{
    $res = mysql_query('select * from d_bots_items');
    while($row = mysql_fetch_assoc($res))
    {
        unset($row['item_id']);
        unset($row['w_addid']);
        unset($row['w_material']);
        //dump($row);
        $query = 'INSERT INTO weapons_template ('.implode(',', array_keys($row)).') VALUES (';
        $values = array();
        foreach ($row as $key => $val)
        {
            if (in_array($key, array('w_name', 'w_image', 'w_category', 'w_id', 'w_material')))
                $values[] = '\''.mysql_escape_string($val).'\'';
            else
                $values[] = $val;
        }
        $query .= implode(',', $values).');';
        echo $query.'<br>';
    }
}

if (isset($_GET['delete_bot_id']) && $_GET['delete_bot_id']!='' && is_numeric($_GET['delete_bot_id'])) {
    $bot_id = (int)$_GET['delete_bot_id'];
    mysql_query('delete from bots_templates where inf_bot = '.intval($bot_id));
    header('Location: '.$_SESSION['pages']['bot_list']);
}
/*
if (isset($_GET['normalize']))
{
    $bots = array();
    $tables = array('bots_drops', 'bots_fights', 'bots_kicks', 'bots_slots', 'bots_templates', 'bots_zones', 'e_players_table');
    $i = 0;
    $res = mysql_query('SELECT * FROM bots_templates ORDER BY inf_bot');
    while($row = mysql_fetch_assoc($res))
        $bots[++$i] = $row['inf_bot'];
        
    foreach($bots as $new_id => $old_id)
    {
        foreach($tables as $table)
        mysql_query('UPDATE '.$table.' SET inf_bot = '.$new_id.' WHERE inf_bot = '.$old_id);
    }
    header('Location: '.$_SESSION['pages']['bot_list']);
}
*/
if (isset($_GET['bot_class_id']) && $_GET['bot_class_id'] != '')
    $bot_class_id = intval($_GET['bot_class_id']);
else
    $bot_class_id = '';
    
$bot_classes = array();
$res = mysql_query('select * from bots_classes');
while($row = mysql_fetch_assoc($res))
    $bot_classes[$row['bot_class_id']] = $row['nickname'];
mysql_free_result($res);

// PAGE NAVIGATOR
$query = 'select count(*) from bots_templates '.($bot_class_id!=''?'where bot_class_id = '.intval($bot_class_id):'');
$res = mysql_query($query, $db);
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

$query = 'select bt.*, bc.nickname from bots_templates bt inner join bots_classes bc ON (bt.bot_class_id = bc.bot_class_id) '.
        ($bot_class_id!=''?'where bt.bot_class_id = '.intval($bot_class_id):'').
        generateMysqlOrder().
        generateMysqlLimit($cur_page, $recs_per_page);
        
$bots = '';
$res = mysql_query($query, $db); 
while ($row = mysql_fetch_assoc($res))
{
    $bots.='
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'�� ������� ��� ������ ������� ����� ����?\');" href="bot_list.php?delete_bot_id='.$row['inf_bot'].'" title="�������"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="bot_edit.php?bot_id='.$row['inf_bot'].'" title="��������"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="bot_edit.php?copy_bot_id='.$row['inf_bot'].'" title="�����������"><img src="images/cms_icons/cms_add.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$row['inf_bot'].'</td>
      <td align="left" class="cms_middle">'.$row['nickname'].'</td>
      
      <td align="left" class="cms_middle">'.$row['level'].'</td>
      <td align="left" class="cms_middle">'.$row['comment'].'</td>
    </tr>
    ';
}

/*<td align="left" class="cms_middle"><a href="bot_edit.php?bot_id='.$row['inf_bot'].'" title="��������">'._htext($row['nickname']).'</a></td>*/

$_SESSION['pages']['bot_list'] = $_SERVER['REQUEST_URI'];

?>
<h3>������ �����</h3>
<link rel="stylesheet" href="files/modalwindow.css" type="text/css" />

<form name="filter" id="filter" action="" method="get">
<input type="hidden" name="sort_by" value="<?=(isset($_GET['sort_by'])?$_GET['sort_by']:'')?>" />
<input type="hidden" name="sort_order" value="<?=(isset($_GET['sort_order'])?$_GET['sort_order']:'')?>" />
<div id="filter"><h4>������: </h4>
<div id="cms_filter"> 
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td>������ ����:</td>
    <td>
        <?=createSelectFromArray('bot_class_id', $bot_classes, (isset($_GET['bot_class_id'])?$_GET['bot_class_id']:''))?>
    </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
<script language="javascript">
function clearFilter()
{
    d.forms['filter'].bot_template.selectedIndex = 0;
}
</script>
<input type="submit" name="filter" value="OK" style="width: 100px;" /><input type="button" onclick="clearFilter(); return false;" name="clear" value="Clear" style="width: 80px;" />
</div>  
</div>
</form>

<div id="results">
    <div id="cms_navigator"><?=createPageNavigator($records_count, $cur_page, '����')?></div>

    <div class="cms_ind">
        <br />
        ����: <br />
        <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
            <tr >
                <td class="cms_cap2 normal"> ������� </td>
                <td class="cms_cap2 normal"> �������� </td>
                <td class="cms_cap2 normal"> ����������� </td>

                <td class="cms_cap2"><a href="<?=sortby('inf_bot')?>">ID ����</a></td>
                <td class="cms_cap2"><a href="<?=sortby('nickname')?>">��� ����</a></td>
                <!--<td class="cms_cap2"><a href="<?=sortby('nickname')?>">��� ����</a></td>-->
                <td class="cms_cap2"><a href="<?=sortby('level')?>">�������</a></td>
                <td class="cms_cap2"><a href="<?=sortby('comment')?>">�����������</a></td>
            </tr>
            <?=$bots?>   
        </table>
        <br />
    </div>
    <div id="cms_navigator"><?=createPageNavigator($records_count, $cur_page, '����')?></div> 
</div>
 
 <br />
 <img src="images/cms_icons/cms_add.gif" alt="�������� ����" /><a href="bot_edit.php" title="�������� ����">�������� ����</a> &nbsp;
 <br />

<? require('kernel/after.php'); ?>