<?php

require('kernel/before.php');

if (!userHasPermission(1024)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['bots_items']))
{
    $res = mysqli_query($GLOBALS['db_link'], 'select * from d_bots_items');
    while ($row = mysqli_fetch_assoc($res))
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
                $values[] = '\'' . mysqli_escape_string($GLOBALS['db_link'], $val) . '\'';
            else
                $values[] = $val;
        }
        $query .= implode(',', $values).');';
        echo $query.'<br>';
    }
}

if (isset($_GET['delete_bot_id']) && $_GET['delete_bot_id']!='' && is_numeric($_GET['delete_bot_id'])) {
    $bot_id = (int)$_GET['delete_bot_id'];
    mysqli_query($GLOBALS['db_link'], 'delete from bots_templates where inf_bot = ' . intval($bot_id));
    header('Location: '.$_SESSION['pages']['bot_list']);
}
/*
if (isset($_GET['normalize']))
{
    $bots = array();
    $tables = array('bots_drops', 'bots_fights', 'bots_kicks', 'bots_slots', 'bots_templates', 'bots_zones', 'e_players_table');
    $i = 0;
    $res = mysqli_query($GLOBALS['db_link'],'SELECT * FROM bots_templates ORDER BY inf_bot');
    while($row = mysqli_fetch_assoc($res))
        $bots[++$i] = $row['inf_bot'];
        
    foreach($bots as $new_id => $old_id)
    {
        foreach($tables as $table)
        mysqli_query($GLOBALS['db_link'],'UPDATE '.$table.' SET inf_bot = '.$new_id.' WHERE inf_bot = '.$old_id);
    }
    header('Location: '.$_SESSION['pages']['bot_list']);
}
*/
if (isset($_GET['bot_class_id']) && $_GET['bot_class_id'] != '')
    $bot_class_id = intval($_GET['bot_class_id']);
else
    $bot_class_id = '';
    
$bot_classes = array();
$res = mysqli_query($GLOBALS['db_link'], 'select * from bots_classes');
while ($row = mysqli_fetch_assoc($res))
    $bot_classes[$row['bot_class_id']] = $row['nickname'];
mysqli_free_result($res);

// PAGE NAVIGATOR
$query = 'select count(*) from bots_templates '.($bot_class_id!=''?'where bot_class_id = '.intval($bot_class_id):'');
$res = mysqli_query($GLOBALS['db_link'], $query);
$row = mysqli_fetch_row($res);
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
$res = mysqli_query($GLOBALS['db_link'], $query);
while ($row = mysqli_fetch_assoc($res))
{
    $bots.='
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Вы уверены что хотите удалить этого бота?\');" href="bot_list.php?delete_bot_id=' . $row['inf_bot'] . '" title="Удалить"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="bot_edit.php?bot_id=' . $row['inf_bot'] . '" title="Изменить"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="bot_edit.php?copy_bot_id=' . $row['inf_bot'] . '" title="Клонировать"><img src="images/cms_icons/cms_add.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$row['inf_bot'].'</td>
      <td align="left" class="cms_middle">'.$row['nickname'].'</td>
      
      <td align="left" class="cms_middle">'.$row['level'].'</td>
      <td align="left" class="cms_middle">'.$row['comment'].'</td>
    </tr>
    ';
}

/*<td align="left" class="cms_middle"><a href="bot_edit.php?bot_id='.$row['inf_bot'].'" title="Изменить">'._htext($row['nickname']).'</a></td>*/

$_SESSION['pages']['bot_list'] = $_SERVER['REQUEST_URI'];

?>
    <h3>Список ботов</h3>
<link rel="stylesheet" href="files/modalwindow.css" type="text/css" />

<form name="filter" id="filter" action="" method="get">
<input type="hidden" name="sort_by" value="<?=(isset($_GET['sort_by'])?$_GET['sort_by']:'')?>" />
<input type="hidden" name="sort_order" value="<?=(isset($_GET['sort_order'])?$_GET['sort_order']:'')?>" />
    <div id="filter"><h4>Фильтр: </h4>
<div id="cms_filter"> 
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
      <td>Шаблон бота:</td>
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
    <div id="cms_navigator"><?= createPageNavigator($records_count, $cur_page, 'Боты') ?></div>

    <div class="cms_ind">
        <br />
        Боты: <br/>
        <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
            <tr >
                <td class="cms_cap2 normal"> Удалить</td>
                <td class="cms_cap2 normal"> Изменить</td>
                <td class="cms_cap2 normal"> Клонировать</td>

                <td class="cms_cap2"><a href="<?= sortby('inf_bot') ?>">ID Бота</a></td>
                <td class="cms_cap2"><a href="<?= sortby('nickname') ?>">Имя бота</a></td>
                <!--<td class="cms_cap2"><a href="<?= sortby('nickname') ?>">Имя бота</a></td>-->
                <td class="cms_cap2"><a href="<?= sortby('level') ?>">Уровень</a></td>
                <td class="cms_cap2"><a href="<?= sortby('comment') ?>">Комментарий</a></td>
            </tr>
            <?=$bots?>   
        </table>
        <br />
    </div>
    <div id="cms_navigator"><?= createPageNavigator($records_count, $cur_page, 'Боты') ?></div>
</div>
 
 <br />
    <img src="images/cms_icons/cms_add.gif" alt="Добавить бота"/><a href="bot_edit.php" title="Добавить бота">Добавить
    бота</a> &nbsp;
 <br />

<? require('kernel/after.php'); ?>