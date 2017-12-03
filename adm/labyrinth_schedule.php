<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_event_id']) && $_GET['delete_event_id']!='' && is_numeric($_GET['delete_event_id'])) 
{
    $event_id = (int)$_GET['delete_event_id'];
    mysql_query('delete from labyrinth_schedule where event_id = '.intval($event_id));
    header('Location: labyrinth_schedule.php');
}

if (isset($_GET['labyrinth_id']) && $_GET['labyrinth_id'] != '')
    $lab_id = $_GET['labyrinth_id'];
else
    $lab_id = '';
    
$labs = array();
$res = mysql_query('select * from labyrinth_list order by labyrinth_name asc');
while($row = mysql_fetch_assoc($res))
    $labs[$row['labyrinth_id']] = $row['labyrinth_name'];
mysql_free_result($res);

$events = '';
$i = 0;
$res = mysql_query('
    select * from labyrinth_schedule
    '.($lab_id!=''?'where lab_id = '.(int)($lab_id).'':'').'
'); 
while ($row = mysql_fetch_assoc($res))
{
   $i++;
    $events.='
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Вы действительно хотите удалить это событие?\');" href="labyrinth_schedule.php?delete_event_id=' . $row['event_id'] . '" title="Удалить"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="labyrinth_schedule_edit.php?event_id=' . $row['event_id'] . '" title="Изменить параметры"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="labyrinth_schedule_edit.php?copy_event_id=' . $row['event_id'] . '" title="Изменить параметры"><img src="images/cms_icons/cms_add.gif" width="18" height="18" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$labs[$row['lab_id']].'</td>
      <td align="left" class="cms_middle">'.$row['min_lvl'].'</td>
      <td align="left" class="cms_middle">'.$row['max_lvl'].'</td>
      <td align="left" class="cms_middle">'.date('Y-m-d H:i:s', $row['date_from']).'</td>
      <td align="left" class="cms_middle">'.date('Y-m-d H:i:s', $row['date_to']).'</td>
    </tr>
    ';
}

?>
    <h3>Расписание лабиринтов</h3>
<form name="filter" id="filter" action="" method="get">
<input type="hidden" name="sort_by" value="<?=(isset($_GET['sort_by'])?$_GET['sort_by']:'')?>" />
<input type="hidden" name="sort_order" value="<?=(isset($_GET['sort_order'])?$_GET['sort_order']:'')?>" />
    <div id="filter"><h4>Фильтр: </h4>
<div id="cms_filter"> 
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
      <td>Лабиринт:</td>
    <td>
        <?=createSelectFromArray('labyrinth_id', $labs, (isset($_GET['labyrinth_id'])?$_GET['labyrinth_id']:''))?>
    </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
<script language="javascript">
function clearFilter()
{
    d.forms['filter'].labyrinth_id.selectedIndex = 0;
}
</script>
<input type="submit" name="filter" value="OK" style="width: 100px;" /><input type="button" onclick="clearFilter(); return false;" name="clear" value="Clear" style="width: 80px;" />
</div>  
</div>
</form>

<div class="cms_ind">
<br />
    Расписание: <br/>
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
        <td class="cms_cap2 normal"> Удалить</td>
        <td class="cms_cap2 normal"> Изменить</td>
        <td class="cms_cap2 normal"> Копировать</td>

        <td class="cms_cap2">Лабиринт</td>
        <td class="cms_cap2">Мин. уровень</td>
        <td class="cms_cap2">Макс. уровень</td>
        <td class="cms_cap2">Время начала</td>
        <td class="cms_cap2">Время окончания</td>
    </tr>
    
    <?=$events?>
    
    </table>
    <br />
 </div>
    <img src="images/cms_icons/cms_add.gif" alt="Добавить событие"/><a href="labyrinth_schedule_edit.php"
                                                                       title="Добавить событие">Добавить
    событие</a> &nbsp;<br/>

<? require('kernel/after.php'); ?>