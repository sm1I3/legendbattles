<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['set_active']))
{
    mysqli_query($GLOBALS['db_link'], 'UPDATE bots_fights SET bot_active = 1 WHERE playerid = ' . (int)$_GET['set_active']);
    header('Location: '.$_SESSION['fight_stat_url']);
}

if (isset($_GET['set_inactive']))
{
    mysqli_query($GLOBALS['db_link'], 'UPDATE bots_fights SET bot_active = 0 WHERE playerid = ' . (int)$_GET['set_inactive']);
    header('Location: '.$_SESSION['fight_stat_url']);
}

if (isset($_GET['action']) && $_GET['action'] == 'delete_all_inactive')
{
    $ids = array();
    $res = mysqli_query($GLOBALS['db_link'], 'SELECT playerid FROM bots_fights WHERE bot_active = 0');
    while ($row = mysqli_fetch_assoc($res))
    {
        $ids[] = $row['playerid'];
    }
    mysqli_query($GLOBALS['db_link'], 'DELETE FROM e_players_table WHERE playerid IN (' . implode(',', $ids) . ')');
    mysqli_query($GLOBALS['db_link'], 'DELETE FROM e_players_modify WHERE playerid IN (' . implode(',', $ids) . ')');
    mysqli_query($GLOBALS['db_link'], 'DELETE FROM e_players_slots WHERE playerid IN (' . implode(',', $ids) . ')');
    mysqli_query($GLOBALS['db_link'], 'DELETE FROM e_players_info WHERE playerid IN (' . implode(',', $ids) . ')');
    mysqli_query($GLOBALS['db_link'], 'DELETE FROM bots_fights WHERE playerid IN (' . implode(',', $ids) . ')');
    header('Location: '.$_SESSION['fight_stat_url']);
}

if (isset($_GET['action']) && $_GET['action'] == 'activate_all_inactive')
{
    mysqli_query($GLOBALS['db_link'], 'UPDATE bots_fights SET bot_active = 1 WHERE bot_active = 0');
    header('Location: '.$_SESSION['fight_stat_url']);
}


if (isset($_GET['inf_bot']) && $_GET['inf_bot'] != '')
    $inf_bot = $_GET['inf_bot'];
else
    $inf_bot = '';
    
if (isset($_GET['bot_class_id']) && $_GET['bot_class_id'] != '')
    $bot_class_id = $_GET['bot_class_id'];
else
    $bot_class_id = '';
    
if (isset($_GET['bot_type']) && $_GET['bot_type'] != '')
    $bot_type = $_GET['bot_type'];
else
    $bot_type = '';
    
if (isset($_GET['is_active']) && $_GET['is_active'] != '')
    $is_active = $_GET['is_active'];
else
    $is_active = ''; 
    
$bot_classes = array();
$res = mysqli_query($GLOBALS['db_link'], 'select * from bots_classes ');
while ($row = mysqli_fetch_assoc($res))
    $bot_classes[$row['bot_class_id']] = $row['nickname'];
mysqli_free_result($res);
    
$bots = $bots_inf = $bot_class_ids = array();
$res = mysqli_query($GLOBALS['db_link'], 'select * from bots_templates ' . ($bot_class_id != '' ? 'where bot_class_id = ' . intval($bot_class_id) : ''));
while ($row = mysqli_fetch_assoc($res))
{
    $bots[$row['inf_bot']] = $bot_classes[$row['bot_class_id']].' '.(isset($row['comment']) && $row['comment']!=''?' ('.$row['comment'].')':'');
    $bots_inf[$row['inf_bot']] = $row;
    $bot_class_ids[$row['bot_class_id']][] = $row['inf_bot'];
}
mysqli_free_result($res);
    
if (isset($_GET['deactivate_group']) && (int)$_GET['deactivate_group'] > 0)
{
    $count = (int)$_GET['deactivate_group'];

    mysqli_query($GLOBALS['db_link'], 'UPDATE bots_fights SET bot_active = 0 WHERE bot_active = 1 ' .
    ($inf_bot!=''?' and inf_bot = '.intval($inf_bot):'').' '.
    ($bot_type!=''?' and bot_type = '.intval($bot_type):'').' '.
    ($is_active!=''?' and bot_active = '.intval($is_active):'').' '.
    ($bot_class_id!=''?' and inf_bot IN ('.implode(',',$bot_class_ids[$bot_class_id]).')':'').'
    LIMIT '.$count);
    header('Location: '.$_SESSION['fight_stat_url']);
}

// PAGE NAVIGATOR
$query = 'select count(*) from bots_fights where 1=1 '.
    ($inf_bot!=''?' and inf_bot = '.intval($inf_bot):'').' '.
    ($bot_type!=''?' and bot_type = '.intval($bot_type):'').' '.
    ($is_active!=''?' and bot_active = '.intval($is_active):'').' '.
    ($bot_class_id!=''?' and inf_bot IN ('.implode(',',$bot_class_ids[$bot_class_id]).')':'').' ';
$res = mysqli_query($GLOBALS['db_link'], $query, $db);
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

$query = 'select * from bots_fights where 1=1 '.
        ($inf_bot!=''?' and inf_bot = '.intval($inf_bot):'').
        ($bot_type!=''?' and bot_type = '.intval($bot_type):'').
        ($is_active!=''?' and bot_active = '.intval($is_active):'').
        ($bot_class_id!=''?' and inf_bot IN ('.implode(',',$bot_class_ids[$bot_class_id]).') ':' ').
        generateMysqlOrder().
        generateMysqlLimit($cur_page, $recs_per_page);

$stats = '';
$res = mysqli_query($GLOBALS['db_link'], $query, $db);
while ($row = mysqli_fetch_assoc($res))
{
    $stats.='
    <tr>
      <td align="left" class="cms_middle">'.$row['playerid'].'</td>
      <td align="left" class="cms_middle">'.$row['inf_bot'].'</a></td>
      <td align="left" class="cms_middle">'.$bots[$row['inf_bot']].'</a></td>
      <td align="left" class="cms_middle">'.$bots_inf[$row['inf_bot']]['level'].'</td>
      <td align="left" class="cms_middle">'.$row['bot_type'].'</td>
      <td align="center" class="cms_middle"><a href="?'.($row['bot_active']==1?'set_inactive':'set_active').'='.$row['playerid'].'"><img src="images/cms_icons/'.($row['bot_active']==1?'cms_checked':'cms_checkbox').'.gif" /></a></td>
    </tr>
    ';
}

$fill_types = Array(
    0 => 'Природа',
    1 => 'Нападение на город',
    2 => 'Нападение по свитку',
    3 => 'Лабиринт',
);

?>
    <h3>Распределение в мире</h3>

<form name="filter" id="filter" action="" method="get">
<input type="hidden" name="sort_by" value="<?=(isset($_GET['sort_by'])?$_GET['sort_by']:'')?>" />
<input type="hidden" name="sort_order" value="<?=(isset($_GET['sort_order'])?$_GET['sort_order']:'')?>" />
    <div id="filter"><h4>Фильтр: </h4>
<div id="cms_filter"> 
<table border="0" cellspacing="3" cellpadding="0">
    <tr>
        <td>Класс бота:</td>
        <td>
            <?=createSelectFromArray('bot_class_id', $bot_classes, (isset($_GET['bot_class_id'])?$_GET['bot_class_id']:''))?>
        </td>
    </tr>
    <tr>
        <td>Бот:</td>
        <td>
            <?=createSelectFromArray('inf_bot', $bots, (isset($_GET['inf_bot'])?$_GET['inf_bot']:''))?>
        </td>
    </tr>
    <tr>
        <td>Bot type:</td>
        <td><?=createSelectFromArray('bot_type', $fill_types, (isset($_GET['bot_type'])?$_GET['bot_type']:''))?></td>
    </tr>
    <tr>
        <td>Active:</td>
        <td><?=createSelectFromArray('is_active', array(1 => 'Active', 0 => 'Inactive'), (isset($_GET['is_active'])?$_GET['is_active']:''))?></td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
</table>
<script language="javascript">
function clearFilter()
{
    d.forms['filter'].bot_uid.selectedIndex = 0;
    d.forms['filter'].bot_template_id.selectedIndex = 0;
    d.forms['filter'].bot_type.selectedIndex = 0;
}
</script>
<input type="submit" name="filter" value="OK" style="width: 100px;" /><input type="button" onclick="clearFilter(); return false;" name="clear" value="Clear" style="width: 80px;" />
</div>  
</div>
</form>

<div id="results">
    <div id="cms_navigator"><?= createPageNavigator($records_count, $cur_page, 'Бои') ?></div>

    <div class="cms_ind">
        <br />
        Боты: <br/>
        <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
            <tr>
                <td class="cms_cap2"><a href="<?=sortby('playerid')?>">Player ID</a></td>
                <td class="cms_cap2"><a href="<?= sortby('bot_uid') ?>">ID бота</a></td>
                <td class="cms_cap2"><a href="<?= sortby('nickname') ?>">Имя бота</a></td>
                <td class="cms_cap2"><a href="<?= sortby('level') ?>">Уровень</a></td>
                <td class="cms_cap2"><a href="<?=sortby('bot_type')?>">Bot Type</a></td>
                <td class="cms_cap2"><a href="<?=sortby('bot_type')?>">Active</a></td>
            </tr>
            <?=$stats?>   
        </table>
        <br />
        <a onclick="document.location='?bot_type=<?= $bot_type ?>&bot_class_id=<?= $bot_class_id ?>&inf_bot=<?= $inf_bot ?>&deactivate_group='+prompt('Сколько деактивировать ботов?', '10'); return false;"
           href="#">Деактивировать группу</a><br/>
        <a onclick="return confirm('Вы действительно хотите удалить всех неактивных ботов?');"
           href="?action=delete_all_inactive">Удалить всех неактивных</a><br/>
        <a onclick="return confirm('Вы действительно хотите активировать всех неактивных ботов?');"
           href="?action=activate_all_inactive">Активировать всех неактивных</a><br/>
        <br />
    </div>
    <div id="cms_navigator"><?= createPageNavigator($records_count, $cur_page, 'Бои') ?></div>
</div>
<br />

<? 
$_SESSION['fight_stat_url'] = $_SERVER['REQUEST_URI'];
require('kernel/after.php'); 
?>