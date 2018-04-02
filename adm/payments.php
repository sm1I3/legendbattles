<?php

require('kernel/before.php');

if (!userHasPermission(65536)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['stat_type']) && $_GET['stat_type'] == 2)
    $subquery = 'FROM_UNIXTIME(time, \'%Y-%m\') as date';
else
    $subquery = 'FROM_UNIXTIME(time, \'%Y-%m-%d\') as date';
    
$qdate_from = $qdate_to = '';

if (!isset($_GET['date_from']))
    $_GET['date_from'] = date('Y-m-d', strtotime('- 2 weeks'));
if (!isset($_GET['date_to']))
    $_GET['date_to'] = date('Y-m-d');

if (isset($_GET['date_from']) && $_GET['date_from'] != '')
    $qdate_from = strtotime($_GET['date_from']);
if (isset($_GET['date_to']) && $_GET['date_to'] != '')
    $qdate_to = strtotime($_GET['date_to']);

if (isset($_GET['use_source']))
    $query = 'SELECT SUM(oper_sum) as sum, '.$subquery.', comment FROM dnv_operations WHERE 
        oper_sum > 0 AND comment != \'WEAPON RETURN\' AND comment != \'TR FROM DNV-ACC\'
        '.($qdate_from != '' ? 'AND time >= '.$qdate_from : '').'
        '.($qdate_to != '' ? 'AND time <= '.$qdate_to : '').'
        GROUP BY date, comment ORDER BY date, comment';
else
    $query = 'SELECT SUM(oper_sum) as sum, '.$subquery.' FROM dnv_operations WHERE 
        oper_sum > 0 AND comment != \'WEAPON RETURN\' AND comment != \'TR FROM DNV-ACC\' 
        '.($qdate_from != '' ? 'AND time >= '.$qdate_from : '').'
        '.($qdate_to != '' ? 'AND time <= '.$qdate_to : '').'
        GROUP BY date ORDER BY date';

include 'ofc/open-flash-chart.php';

$chart = new open_flash_chart();
$title = new title( date("D M d Y") );    

$values = $axis = array();
$max = 0;
$res = mysqli_query($GLOBALS['db_link'], $query, $db);
$now_date = '';
while ($row = mysqli_fetch_assoc($res))
{
    if ($now_date != $row['date'])
    {
        if (isset($_GET['stat_type']) && $_GET['stat_type'] == 2)
            $axis[] = $row['date'];
        else
            $axis[] = $row['date'];
        $now_date = $row['date'];
    }
    if (!isset($row['comment']))
        $row['comment'] = 'total';
        
    if (!isset($values[$row['comment']]))
        $values[$row['comment']] = array();
    $values[$row['comment']][$row['date']] = floatval($row['sum']);
    if ($row['sum'] > $max)
        $max = $row['sum'];
}

$i = 0;
$colors = array(
    1 => '#1466EB',
    2 => '#F52828',
    3 => '#20C82E',
    4 => '#EBF528',
    5 => '#CA8C19',
    6 => '#CA19B8',
);

foreach($values as $comment => &$arr)
{
    $i++;
    $barval = 'bar'.$i;
    $bar1 = new bar();
    $bar1->set_colour($colors[$i]);
    $vals = array();
    $bar1->set_tooltip($comment.'<br>#val#');
    foreach($axis as &$date)
    {
        if (isset($arr[$date]))
            $vals[] = $arr[$date];
        else
            $vals[] = 0;
    }
    $bar1->set_values( $vals );
    $chart->add_element( $bar1 );
}

$x_axis = new x_axis();
$x_axis->set_labels_from_array($axis);

$y_axis = new y_axis();
$y_axis->set_range(0, $max, floor($max / 20));

$chart->set_x_axis($x_axis);
$chart->set_y_axis($y_axis);
$chart->set_title( $title );

$data = $chart->toPrettyString();

/*<td align="left" class="cms_middle"><a href="bot_edit.php?bot_id='.$row['inf_bot'].'" title="Изменить">'._htext($row['nickname']).'</a></td>*/

$_SESSION['pages']['bot_list'] = $_SERVER['REQUEST_URI'];

$stat_type = array(
    1 => 'По дням',
    2 => 'По месяцам',
);

?>
    <h3>Статистика по оплатам</h3>
<script type="text/javascript" src="jscript/json2.js"></script>
<script type="text/javascript" src="jscript/swfobject.js"></script>

    <script type="text/javascript" src="jscript/calendar/calendar_stripped.js" charset="utf-8"></script>
    <script type="text/javascript" src="jscript/calendar/lang/calendar-ru_win_.js" charset="utf-8"></script>
    <script type="text/javascript" src="jscript/calendar/calendar-setup_stripped.js" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" media="all" href="jscript/calendar/calendar-system.css" title="system" />

<script type="text/javascript">
var data_1 = <?=$data?>;
swfobject.embedSWF(
  "files/open-flash-chart.swf", "my_chart",
  "1000", "700", "9.0.0", "expressInstall.swf",
  {"get-data":"get_data_1"} );

function ofc_ready()
{
    // alert('ofc_ready');
}
 
 
function get_data_1()
{
    return JSON.stringify(data_1);
}
</script>

<form name="filter" id="filter" action="" method="get">
<input type="hidden" name="sort_by" value="<?=(isset($_GET['sort_by'])?$_GET['sort_by']:'')?>" />
<input type="hidden" name="sort_order" value="<?=(isset($_GET['sort_order'])?$_GET['sort_order']:'')?>" />
    <div id="filter"><h4>Фильтр: </h4>
<div id="cms_filter"> 
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
      <td>Статистика:</td>
    <td>
        <?=createSelectFromArray('stat_type', $stat_type, (isset($_GET['stat_type'])?$_GET['stat_type']:1), '', false)?>
    </td>
  </tr>
  <tr>
      <td>Разбить по источникам:</td>
    <td><input type="checkbox" name="use_source" value="Y" <?=(isset($_GET['use_source'])?'checked="checked"':'')?> /></td>
  </tr>
  <tr>
      <td>Дата с:</td>
    <td>
        <input name="date_from" id="date_from" type="text" class="cms_fieldstyle1" value="<?=(isset($_GET['date_from'])?$_GET['date_from']:'')?>" size="22" maxlength="255" />
        <img src="images/cms_icons/cms_calendar.gif" align="absmiddle" id="kl1jhjhdj12d1jk2" title="Set Date" alt="Set Date" style="cursor: pointer;" border="0">
        <script type="text/javascript">
        
        Calendar.setup({
            inputField : "date_from",     // id of the input field
            ifFormat   : "%Y-%m-%d",      // format of the input field
            button     : "kl1jhjhdj12d1jk2",  // trigger for the calendar (button ID)
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
        <img src="images/cms_icons/cms_calendar_clear.gif" align="absmiddle" onclick='document.getElementById("date_from").value=""; ' title="Clear Date" style="cursor: pointer;" >
        
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        Дата по: <input name="date_to" id="date_to" type="text" class="cms_fieldstyle1"
                        value="<?= (isset($_GET['date_to']) ? $_GET['date_to'] : '') ?>" size="22" maxlength="255"/>
        <img src="images/cms_icons/cms_calendar.gif" align="absmiddle" id="kjkjdnakjdnakwnjkd2" title="Set Date" alt="Set Date" style="cursor: pointer;" border="0">
        <script type="text/javascript">
        
        Calendar.setup({
            inputField : "date_to",     // id of the input field
            ifFormat   : "%Y-%m-%d",      // format of the input field
            button     : "kjkjdnakjdnakwnjkd2",  // trigger for the calendar (button ID)
            align      : "Br",        // alignment (defaults to "Bl")
            //showOthers : true,          // if "true" (but default: "false") it will show days from other months too
            weekNumbers: false,          // (true/false) if it's true (default) the calendar will display week numbers
            showsTime   : false,               // show time
            timeFormat  : 24 
            
        });
        Calendar.setup({
            inputField : "date_to",     
            ifFormat   : "%Y-%m-%d",
            align      : "Br",
            //showOthers : true,
            weekNumbers: false,
            showsTime   : false,               // show time
            timeFormat  : 24
            
        });
        </script>
        <img src="images/cms_icons/cms_calendar_clear.gif" align="absmiddle" onclick='document.getElementById("date_to").value=""; ' title="Clear Date" style="cursor: pointer;" >
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

<div id="my_chart">
    
</div>
 

<? require('kernel/after.php'); ?>