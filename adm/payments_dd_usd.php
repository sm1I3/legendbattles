<?php

require('kernel/before.php');

if (!userHasPermission(65536)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['stat_type']) && $_GET['stat_type'] == 2)
    $subquery = '(0 - SUM(oper_sum))';
else
    $subquery = 'COUNT(*)';
    
$qdate_from = $qdate_to = '';

if (!isset($_GET['date_from']))
    $_GET['date_from'] = date('Y-m-d', strtotime('- 2 weeks'));
if (!isset($_GET['date_to']))
    $_GET['date_to'] = date('Y-m-d');

if (isset($_GET['date_from']) && $_GET['date_from'] != '')
    $qdate_from = strtotime($_GET['date_from']);
if (isset($_GET['date_to']) && $_GET['date_to'] != '')
    $qdate_to = strtotime($_GET['date_to']);

$query = 'SELECT '.$subquery.' AS value, item_id FROM dnv_operations WHERE 
    oper_sum < 0 AND module_id = 1 AND (action BETWEEN 1 AND 4)
    '.($qdate_from != '' ? 'AND time >= '.$qdate_from : '').'
    '.($qdate_to != '' ? 'AND time <= '.$qdate_to : '').'
    GROUP BY item_id ORDER BY value DESC';

include 'ofc/open-flash-chart.php';

$chart = new open_flash_chart();
$title = new title( date("D M d Y") );    

$values = $axis = array();
$max = 0;
$res = mysqli_query($GLOBALS['db_link'], $query);
$now_date = '';
while ($row = mysqli_fetch_assoc($res))
{
    $values[] = new bar_value(floatval($row['value']));
    $axis[] = $row['item_id'];
    if ($row['value'] > $max)
        $max = $row['value'];
}
$bar = new bar();
//$bar->set_tooltip('Item<br>#val#');

$chart->add_element( $bar );

$convert_names = array();
$query = 'SELECT wuid, w_name FROM d_dilers WHERE wuid IN ('.implode(',', $axis).')';
$res = mysqli_query($GLOBALS['db_link'], $query, $db);
while ($row = mysqli_fetch_assoc($res))
{
    $convert_names[$row['wuid']] = $row['w_name'];
}

foreach($axis as $k => &$v)
{
    $values[$k]->set_tooltip(iconv('utf-8', 'utf-8', $convert_names[$v]) . '<br>#val#');
}
  
$bar->set_values( $values );

$x_axis = new x_axis();
$x_axis->set_labels_from_array($axis);

$y_axis = new y_axis();
$y_axis->set_range(0, $max, ceil($max / 20));

$chart->set_x_axis($x_axis);
$chart->set_y_axis($y_axis);
$chart->set_title( $title );

$data = $chart->toPrettyString();

/*<td align="left" class="cms_middle"><a href="bot_edit.php?bot_id='.$row['inf_bot'].'" title="Изменить">'._htext($row['nickname']).'</a></td>*/

$_SESSION['pages']['bot_list'] = $_SERVER['REQUEST_URI'];

$stat_type = array(
    1 => 'По количеству',
    2 => 'По прибыли',
);

?>
    <h3>Статистика по Дому Дилеров (USD)</h3>
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
  "<?=(sizeof($axis)*50 > 500 ? sizeof($axis)*50 : 500)?>", "700", "9.0.0", "expressInstall.swf",
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