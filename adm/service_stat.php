<?php

$login = 'root';
$pass  = 'Hv40JK5A';
$server = 'localhost';

if (!$db = mysql_connect($server, $login, $pass))
    die('Cannot connect to MySQL server.');

mysql_select_db('legend', $db);
mysql_set_charset('cp1251');
date_default_timezone_set('Europe/Moscow');
session_start();
function generateMysqlLimit($page, $recs_per_page) { return ' LIMIT '.(($page-1)*$recs_per_page).', '.$recs_per_page.' '; }
function createPageNavigator($records_count, $cur_page = 1, $nav_name = 'Записи', $link = '', $recs_per_page = 10)
{
    if ($link == '') $link = $_SERVER['REQUEST_URI'];
    
    $pages_count = ceil($records_count / $recs_per_page);
    $first = (($cur_page-1)*$recs_per_page + 1);
    if ($records_count == 0) $first = 0;
    $last = ($cur_page*$recs_per_page);
    if ($last > $records_count) $last = $records_count;
    
    $nav = $nav_name.' '.$first.'-'.$last.' из '.$records_count.'<br />';
    
    $link = preg_replace('/\&?page=\d{1,5}/i', '', $link);
    if (strpos($link, '?')===false) 
        $link .= '?';
    
    if ($cur_page > 1)
        $nav .= '<a href="'.$link.'&page=1">Первая</a> | <a href="'.$link.'&page='.($cur_page-1).'">Пред.</a> | ';
    else
        $nav .= '<span class="red">Первая</span> | <span class="red">Пред.</span> | ';
    
    for($i=1; $i<=$pages_count; $i++) {
        if ($cur_page == $i)
            $nav .= '<span class="red">'.$i.'</span> | ';
        else
            $nav .= '<a href="'.$link.'&page='.$i.'">'.$i.'</a> | ';
    }
    
    if ($cur_page < $pages_count)
        $nav .= '<a href="'.$link.'&page='.($cur_page+1).'">След.</a> | <a href="'.$link.'&page='.$pages_count.'">Последняя</a>';
    else
        $nav .= '<span class="red">След.</span> | <span class="red">Последняя</span>';
    
    return $nav;
}

// player_id => array of types
$access = array(
    1 => array(18,19,20),
    2 => array(1,2),
    3 => array(1),
);

// for test only
if (isset($_GET['id'])) 
    $_SESSION['id'] = $_GET['id'];


if (!isset($_SESSION['id']))
    die('Access denied');
    
$cur_id = $_SESSION['id'];

if (isset($_GET['date_from']) && $_GET['date_from']!='')
    $date_from = strtotime($_GET['date_from'].' 00:00:00');
    
if (isset($_GET['date_to']) && $_GET['date_to']!='')
    $date_to = strtotime($_GET['date_to'].' 00:00:00');
    
if (isset($_GET['service_type']) && $_GET['service_type']!='' && in_array($_GET['service_type'], $access[$cur_id]))
    $type = (int)$_GET['service_type'];
    
// PAGE NAVIGATOR
$recs_per_page = 10;
$query = 'SELECT COUNT(*) as count, SUM(service_dnv) as sum FROM service_clients WHERE 1>0'.
        (isset($date_from)?' AND service_time >= '.$date_from:'').
        (isset($date_to)?' AND service_time <= '.$date_to:'').
        (isset($type)?' AND service_type = '.$type:' AND service_type in ('.implode(',', $access[$cur_id]).')');
$res = mysql_query($query);
$row = mysql_fetch_assoc($res);
$records_count = $row['count'];
$total_dnv = $row['sum'];

$pages_count = ceil($records_count / $recs_per_page);
if (!isset($_GET['page']) || $_GET['page'] == '')
    $cur_page = 1;
else
    $cur_page = (int)$_GET['page'];

if ($cur_page > $pages_count) $cur_page = $pages_count;
if ($cur_page <= 0) $cur_page = 1;
// END PAGE NAVIGATOR

$query = 'SELECT 
                sc.*, 
                (select nickname from e_players_table where playerid = sc.playerid) as nickname
         FROM service_clients sc WHERE 1>0'.
        (isset($date_from)?' AND sc.service_time >= '.$date_from:'').
        (isset($date_to)?' AND sc.service_time <= '.$date_to:'').
        (isset($type)?' AND sc.service_type = '.$type:' AND sc.service_type in ('.implode(',', $access[$cur_id]).')').
        generateMysqlLimit($cur_page, $recs_per_page);
        
$res = mysql_query($query);

$table = '<table border="1">';
while($row = mysql_fetch_assoc($res))
{
    $table .= '
    <tr>
        <td>'.$row['nickname'].' ('.$row['playerid'].')</td>
        <td>'.$row['service_dnv'].'</td>
        <td>'.date('d.m.Y H:i:s', $row['service_time']).'</td>
    </tr>
    ';
}

$table .= '
    <tr>
        <td>Total: </td>
        <td colspan="2">'.$total_dnv.'</td>
    </tr>
    ';

$table .= '</table>';



?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<meta http-equiv="content-language" content="en">
<title>Filter</title>
<link rel="stylesheet" type="text/css" href="my.css">
</head>
<body>
<script type="text/javascript" src="jscript/calendar/calendar_stripped.js" charset="windows-1251"></script> 
<script type="text/javascript" src="jscript/calendar/lang/calendar-ru_win_.js" charset="windows-1251"></script>     
<script type="text/javascript" src="jscript/calendar/calendar-setup_stripped.js" charset="windows-1251"></script>
<link rel="stylesheet" type="text/css" media="all" href="jscript/calendar/calendar-system.css" title="system" />
<form name="filter" action="" method="get">
Date from: <input type="text" name="date_from" id="date_from" value="<?=(isset($_GET['date_from'])?$_GET['date_from']:'')?>" /><img src="images/cms_icons/cms_calendar.gif" align="absmiddle" id="zdcec13f12f1" title="Set Date" alt="Set Date" style="cursor: pointer;" border="0">
    <script type="text/javascript">
    
    Calendar.setup({
        inputField : "date_from",     // id of the input field
        ifFormat   : "%Y-%m-%d",      // format of the input field
        button     : "zdcec13f12f1",  // trigger for the calendar (button ID)
        align      : "Br",        // alignment (defaults to "Bl")
        //showOthers : true,          // if "true" (but default: "false") it will show days from other months too
        weekNumbers: false,          // (true/false) if it's true (default) the calendar will display week numbers
        showsTime   : false,               // show time
        timeFormat  : 24 
        
    });
    Calendar.setup({
        inputField : "date_from",     
        ifFormat   : "%Y-%m-%d",
        align      : "Br",
        //showOthers : true,
        weekNumbers: false,
        showsTime   : false,               // show time
        timeFormat  : 24
        
    });
    </script>
    <img src="images/cms_icons/cms_calendar_clear.gif" align="absmiddle" onclick='document.getElementById("date_from").value=""; ' title="Clear Date" style="cursor: pointer;" ><br />
Date to: <input type="text" name="date_to" id="date_to" value="<?=(isset($_GET['date_to'])?$_GET['date_to']:'')?>" /><img src="images/cms_icons/cms_calendar.gif" align="absmiddle" id="jhgdjk1hjdk1l2mkkl12" title="Set Date" alt="Set Date" style="cursor: pointer;" border="0">
    <script type="text/javascript">
    
    Calendar.setup({
        inputField : "date_to",     // id of the input field
        ifFormat   : "%Y-%m-%d",      // format of the input field
        button     : "jhgdjk1hjdk1l2mkkl12",  // trigger for the calendar (button ID)
        align      : "Br",        // alignment (defaults to "Bl")
        //showOthers : true,          // if "true" (but default: "false") it will show days from other months too
        weekNumbers: false,          // (true/false) if it's true (default) the calendar will display week numbers
        showsTime   : true,               // show time
        timeFormat  : 24 
        
    });
    Calendar.setup({
        inputField : "date_to",     
        ifFormat   : "%Y-%m-%d",
        align      : "Br",
        //showOthers : true,
        weekNumbers: false,
        showsTime   : true,               // show time
        timeFormat  : 24
        
    });
    </script>
    <img src="images/cms_icons/cms_calendar_clear.gif" align="absmiddle" onclick='document.getElementById("date_to").value=""; ' title="Clear Date" style="cursor: pointer;" ><br />
<? if (sizeof($access[$cur_id]) > 1) { ?>
<select name="service_type">
    <option value="">All</option>
    <? foreach($access[$cur_id] as $t) { ?>
    <option <?=(isset($type) && $type==$t?'selected':'')?> value="<?=$t?>"><?=$t?></option>
    <? } ?>
</select><br />
<? } ?>
<input type="submit" name="submit" value="OK" />
</form>
<br />
<?=createPageNavigator($records_count, $cur_page, 'Записи')?>
<?=$table?>
<?=createPageNavigator($records_count, $cur_page, 'Записи')?>
</body>
</html>