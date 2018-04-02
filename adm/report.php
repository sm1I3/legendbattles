<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

$workers = array();
$res = mysqli_query($GLOBALS['db_link'], 'SELECT * FROM z_worker ORDER BY worker_name');
while ($row = mysqli_fetch_assoc($res))
    $workers[$row['worker_id']] = $row['worker_name'];
    
$vizor_days = array();
$res = mysqli_query($GLOBALS['db_link'], 'SELECT * FROM z_days ');
while ($row = mysqli_fetch_assoc($res))
    $vizor_days[$row['date']] = $row['type'];

$days_arr = array();

if (isset($_POST['upload']) && isset($_FILES['input_file']))
{
    $file = file_get_contents($_FILES['input_file']['tmp_name']);
    $farr = explode("\n", $file);
    foreach($farr as $str) 
    {
        $arr = explode(';', $str);
        if (isset($arr[3]) && ($arr[3] == 62 || $arr[3] == 63))
        {
            mysqli_query($GLOBALS['db_link'], 'INSERT IGNORE INTO z_worker_event (event_id, worker_id, event_type, datetime) VALUES (
            ' . intval($arr[0]) . ', ' . intval($arr[4]) . ', ' . intval($arr[3]) . ', \'' . mysqli_escape_string($GLOBALS['db_link'], $arr[1] . ' ' . $arr[2]) . '\'
            )');
            
            if (!isset($workers[$arr[4]]))
            {
                mysqli_query($GLOBALS['db_link'], 'INSERT IGNORE INTO z_worker (worker_id, worker_name) VALUES (' . intval($arr[4]) . ', \'' . mysqli_escape_string($GLOBALS['db_link'], $arr[5]) . '\')');
            }
        }
    }
}

if (isset($_POST['date_from']) && $_POST['date_from'] != '' && $_POST['date_to'] != '')
{
    $short = (isset($_POST['short']));
    
    $vacations = array();
    $res = mysqli_query($GLOBALS['db_link'], 'SELECT * FROM z_vacations WHERE 1 > 0' .
        ($_POST['date_from'] != '' ? ' AND date_to >= \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['date_from'] . ' 00:00:00') . '\'' : '') .
        ($_POST['date_to'] != '' ? ' AND date_from <= \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['date_to'] . ' 23:59:59') . '\'' : '') .
            ($_POST['worker_id'] != '' ? ' AND worker_id = '.intval($_POST['worker_id']).'' : '').
            ' ORDER BY date_from ASC'
    );
    while ($row = mysqli_fetch_assoc($res))
    {
        $i = 0;
        $date_from = $row['date_from'];
        $date_to = $row['date_to'];
        
        $vacations[$row['worker_id']] = array();
        while($date_from <= $date_to && $i < 1000)
        {
            $i++;
            $vacations[$row['worker_id']][$date_from] = true;
            $date_from = date('Y-m-d', strtotime($date_from) + 24*60*60);
        }        
    }
    
    $report = array();

    $res = mysqli_query($GLOBALS['db_link'], 'SELECT * FROM z_worker_event WHERE 1 > 0' .
        ($_POST['date_from'] != '' ? ' AND datetime >= \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['date_from'] . ' 00:00:00') . '\'' : '') .
        ($_POST['date_to'] != '' ? ' AND datetime <= \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['date_to'] . ' 23:59:59') . '\'' : '') .
            ($_POST['worker_id'] != '' ? ' AND worker_id = '.intval($_POST['worker_id']).'' : '').
            ' ORDER BY event_id ASC'
    );
    
    $date_from = $_POST['date_from'];
    $date_to = $_POST['date_to'];
    
    $days_arr = array();
    while($date_from <= $date_to)
    {
        $days_arr[$date_from] = true;
        $date_from = date('Y-m-d', strtotime($date_from) + 24*60*60);
    }

    while ($row = mysqli_fetch_array($res))
    {
        $date = date('Y-m-d', strtotime($row['datetime']));
        $report[ $row['worker_id'] ][ $date ][] = $row;
    }

    define('EVENT_ENTER', 63);
    define('EVENT_EXIT', 62);

    $resources = '';
    $i = 0;

    $cur_user = -1;
    foreach($report as $user_id => $tarr) 
    {
        
        $days = 0;
        foreach($days_arr as $date => $x) 
        {
            $wday = date('w', strtotime($date.' 12:00:00'));
            if (isset($vacations[$user_id][$date]))
                $weekend = true;
            elseif (isset($vizor_days[$date]) && $vizor_days[$date] == 1)
                $weekend = true;
            elseif (isset($vizor_days[$date]) && $vizor_days[$date] == 2)
                $weekend = false;
            else
                $weekend = ($wday == 0 || $wday == 6);
            
            if (!$weekend)
                $days++;
        }
    
        $i++;
        $total_time_all = 0;
        $total_time_work = 0;
        $total_time_def = 0;
        
        if (isset($_POST['export']))
            $resources .='
            <td style="padding: 10px;" valign="top">
            <b>'.$workers[$user_id].'</b>
            <table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" class="cms_table1" >
                    <tr >
                      <td class="cms_cap2">Дата</td>
                      <td class="cms_cap2">Приход</a></td>
                      <td class="cms_cap2">Уход</a></td>
                      <td class="cms_cap2">Общее время</a></td>
                      <td class="cms_cap2">Засчитанное время</a></td>
                    </tr>';
        
        //foreach($tarr as $date => $arr)
        
        $total_days_late = $total_days_early = $total_days_missed = 0;
        
        foreach($days_arr as $date => $x)
        {
            $arr = (isset($tarr[$date]) ? $tarr[$date] : array());
            
            $time_total = 0;
            $time_work = 0;
            $time_penalty = 0;
            
            $tx = $ty = 0;
            
            $total_start = 0;
            $total_end = 0;
            $work_start = 0;
            $work_end = 0;
            
            $periods = array();
            
            foreach($arr as $trow)
            {
                if ($trow['event_type'] == EVENT_ENTER && $tx == 0) 
                {
                    $tx = strtotime($trow['datetime']);
                }
                
                if ($trow['event_type'] == EVENT_EXIT && $tx > 0) 
                {
                    $ty = strtotime($trow['datetime']);
                    $periods[] = array($tx, $ty);
                    $tx = 0;
                }
                $row = $trow;
            }
            
            $work_day_start = strtotime($date.' 9:00:00');
            $work_day_start_penalty = strtotime($date.' 11:00:00');
            $work_day_end = strtotime($date.' 20:00:00');
            $work_day_end_penalty = strtotime($date.' 18:00:00');
            
            foreach($periods as $period)
            {
                list($start, $end) = $period;
                $time_total += ($end - $start);
                
                if ($work_start == 0)
                    $work_start = $start;
                $work_end = $end;
                
                if ($start < $work_day_end && $end > $work_day_start)
                {
                    if ($start < $work_day_start && $end > $work_day_start)
                        $start = $work_day_start;
                    if ($start < $work_day_end && $end > $work_day_end)
                        $end = $work_day_end;
                        
                    $time_work += ($end - $start);
                }
            }
            
            $wday = date('w', strtotime($date.' 12:00:00'));
            if (isset($vacations[$user_id][$date]))
                $weekend = true;
            elseif (isset($vizor_days[$date]) && $vizor_days[$date] == 1)
                $weekend = true;
            elseif (isset($vizor_days[$date]) && $vizor_days[$date] == 2)
                $weekend = false;
            else
                $weekend = ($wday == 0 || $wday == 6);
            
            if (!$weekend && $work_start > 0 && $work_end > 0)
            {
                if ($work_start > $work_day_start_penalty)
                    $time_penalty += ($work_start - $work_day_start_penalty);
                if ($work_end < $work_day_end_penalty)
                    $time_penalty += ($work_day_end_penalty - $work_end);
            }
            
            
            $h = floor($time_total/3600);
            $m = ceil( ($time_total - $h*3600) / 60 );
            if ($m == 60) { $h++; $m = 0; }
            $str_time_all = ($h<10?'0'.$h:$h).':'.($m<10?'0'.$m:$m);
            
            $h = floor($time_work/3600);
            $m = ceil( ($time_work - $h*3600) / 60 );
            if ($m == 60) { $h++; $m = 0; }
            $str_time_work = ($h<10?'0'.$h:$h).':'.($m<10?'0'.$m:$m);
            
            if (!$weekend)
            {
                if ($work_start == 0)
                    $total_days_missed++;
                else
                {
                    if ($work_start > $work_day_start_penalty)
                        $total_days_late++;
                    if ($work_end < $work_day_end_penalty)
                        $total_days_early++;
                }
            }
            
            if (!$short)
            {
                if (isset($_POST['export'])) 
                {
                    $resources.='
                        <tr>
                          <td '.($weekend?'style="background:#ddd;"':'').' align="left" class="cms_middle">'.$date.'</td>
                          <td '.($weekend?'style="background:#ddd;"':'').' align="left" class="cms_middle">'.($work_start == 0 ? '-' : ($work_start > $work_day_start_penalty ? '<span style="font-weight: bold;">' : '').date('H:i:s', $work_start)).($work_start > $work_day_start_penalty ? '</span>' : '').'</td>
                          <td '.($weekend?'style="background:#ddd;"':'').' align="left" class="cms_middle">'.($work_end == 0 ? '-' : ($work_end < $work_day_end_penalty ? '<span style="font-weight: bold;">' : '').date('H:i:s', $work_end)).($work_end < $work_day_end_penalty ? '</span>' : '').'</td>
                          <td '.($weekend?'style="background:#ddd;"':'').' align="left" class="cms_middle">'.$str_time_all.'</td>
                          <td '.($weekend?'style="background:#ddd;"':'').' align="left" class="cms_middle">'.$str_time_work.'</td>
                        </tr>
                        ';
                } 
                else 
                {
                    $resources.='
                        <tr>
                          '.($cur_user!=$user_id?'<td align="left" rowspan="'.(sizeof($days_arr)+3).'" class="cms_middle">'.$workers[$user_id].'</td>':'').'
                          <td '.($weekend?'style="background:#ddd;"':'').' align="left" class="cms_middle"  >'.$date.'</td>
                          <td '.($weekend?'style="background:#ddd;"':'').' align="left" class="cms_middle">'.($work_start == 0 ? '-' : ($work_start > $work_day_start_penalty ? '<span style="color: red;">' : '').date('H:i:s', $work_start)).($work_start > $work_day_start_penalty ? '</span>' : '').'</td>
                          <td '.($weekend?'style="background:#ddd;"':'').' align="left" class="cms_middle">'.($work_end == 0 ? '-' : ($work_end < $work_day_end_penalty ? '<span style="color: red;">' : '').date('H:i:s', $work_end)).($work_end < $work_day_end_penalty ? '</span>' : '').'</td>
                          <td '.($weekend?'style="background:#ddd;"':'').' align="left" class="cms_middle">'.$str_time_all.'</td>
                          <td '.($weekend?'style="background:#ddd;"':'').' align="left" class="cms_middle">'.$str_time_work.'</td>
                        </tr>
                        ';
                }
            }
            
            $cur_user = $user_id;
            
            if (!$weekend)
            {
                $total_time_all += $time_total;
                $total_time_work += $time_work;
                $total_time_def += $time_penalty;
            }
        }
        
        $h = floor($total_time_all/3600);
        $m = ceil( ($total_time_all - $h*3600) / 60 );
        if ($m == 60) { $h++; $m = 0; }
        $str_time_all = ($h<10?'0'.$h:$h).':'.($m<10?'0'.$m:$m);
        
        $h = floor($total_time_work/3600);
        $m = ceil( ($total_time_work - $h*3600) / 60 );
        if ($m == 60) { $h++; $m = 0; }
        $str_time_work =($h<10?'0'.$h:$h).':'.($m<10?'0'.$m:$m);
        
        $h = floor($total_time_def/3600);
        $m = ceil( ($total_time_def - $h*3600) / 60 );
        if ($m == 60) { $h++; $m = 0; }
        $str_time_def =($h<10?$h:$h).':'.($m<10?'0'.$m:$m);
        
        $pos = (($total_time_work - ($days*8*3600)) > 0);
        $total_time_work = abs($total_time_work - ($days*8*3600));
        $h = floor($total_time_work/3600);
        $m = ceil( ($total_time_work - $h*3600) / 60 );
        if ($m == 60) { $h++; $m = 0; }
        $str_sub_time_work = $h.':'.($m<10?'0'.$m:$m);
        
        if (isset($_POST['export']))
            $resources.='
                <tr>
                    <td align="left" colspan="2" class="cms_middle">Время для отработки</td>
                    <td align="left" class="cms_middle">' . ($days * 8) . ' часов</td>
                </tr>
                <tr>
                    <td align="left" colspan="2" class="cms_middle">Засчитанное время:</td>
                    <td align="left" class="cms_middle">'.$str_time_work.'</td>
                </tr>
                <tr>
                    <td align="left" colspan="2" class="cms_middle">Баланс</td>
                    <td align="left" class="cms_middle">'.($pos?'':'-').$str_sub_time_work.'</td>
                </tr>
                <tr>
                    <td align="left" colspan="2" class="cms_middle">Опоздания и ранний выход</td>
                    <td align="left" class="cms_middle">'.($pos?'':'-').$str_time_def.'</td>
                </tr>
                <tr>
                    <td align="left" colspan="2" class="cms_middle">Пропущенных дней</td>
                    <td align="left" class="cms_middle">'.$total_days_missed.'</td>
                </tr>
                <tr>
                    <td align="left" colspan="2" class="cms_middle">Дней с опозданием</td>
                    <td align="left" class="cms_middle">'.$total_days_late.'</td>
                </tr>
                <tr>
                    <td align="left" colspan="2" class="cms_middle">Дней с ранним уходом</td>
                    <td align="left" class="cms_middle">'.$total_days_early.'</td>
                </tr>
            </table></td>'.($i%4 == 0?'</tr><tr>':'');
                
        else
            $resources.='
                <tr>
                    '.($short ? '<td class="cms_middle" rowspan="3">'.$workers[$user_id].'</td>' : '').'
                  <td align="left" class="cms_middle">' . ($days * 8) . ' часов</td>
                  <td align="left" class="cms_middle">&nbsp;</td>
                  <td align="left" class="cms_middle">&nbsp;</td>
                  <td align="left" class="cms_middle">'.$str_time_all.'</td>
                  <td align="left" class="cms_middle">'.$str_time_work.'</td>
                </tr>
                <tr>
                  <td align="right" class="cms_middle">Штраф:</td>
                  <td align="left" class="cms_middle">'.($pos?'':'-').$str_time_def.'</td>
                  <td align="right" colspan="2" class="cms_middle">Баланс:</td>
                  <td align="left" class="cms_middle" style="color: '.($pos ? 'green' : 'red').';">'.($pos?'':'-').$str_sub_time_work.'</td>
                </tr>
                <tr>
                  <td align="right" class="cms_middle">Пропущенных:</td>
                  <td align="left" class="cms_middle">'.$total_days_missed.'</td>
                  <td align="right" colspan="2" class="cms_middle">Опозданий + ранних уходов:</td>
                  <td align="left" class="cms_middle">'.$total_days_late.' + '.$total_days_early.'</td>
                </tr>
                ';
    }
}

if (isset($_POST['export'])) {
    ob_end_clean();
    echo '
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="files/print.css" type="text/css" />
    <title>Система управления Neverlands.ru</title>
    </head>

    <body class="cms_BODY" style="padding: 10px;">
    Отчёт: <br />
    
    <table border="0" cellpadding="0" cellspacing="0">
        <tr>
            '.$resources.'
        </tr>
    </table>
        
    </body>
    </html>
    ';
    die();
}

?>
    <h3>Отчёт</h3>
    <a href="report_days.php">Рабочие/Выходные дни</a>&nbsp;&nbsp;&nbsp;<a href="report_vacation.php">Отпуска</a>
    <script type="text/javascript" src="jscript/calendar/calendar_stripped.js" charset="utf-8"></script>
    <script type="text/javascript" src="jscript/calendar/lang/calendar-ru_win_.js" charset="utf-8"></script>
    <script type="text/javascript" src="jscript/calendar/calendar-setup_stripped.js" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" media="all" href="jscript/calendar/calendar-system.css" title="system" />
<form name="filter" id="filter" action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="sort_by" value="<?=(isset($_GET['sort_by'])?$_GET['sort_by']:'')?>" />
<input type="hidden" name="sort_order" value="<?=(isset($_GET['sort_order'])?$_GET['sort_order']:'')?>" />
    <div id="filter"><h4>Фильтр: </h4>
<div id="cms_filter"> 
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
      <td>Для печати:</td>
    <td><input type="checkbox" name="export" value="Y" />&nbsp;&nbsp;
        Сокращенный отчет: <input type="checkbox" name="short" <?= (isset($_POST['short']) ? 'checked' : '') ?>
                                  value="Y"/>
    </td>
  </tr>
  <tr>
      <td>С: &nbsp;</td>
  <td>
    <input name="date_from" id="date_from" type="text" class="cms_fieldstyle1" value="<?=(isset($_POST['date_from'])?$_POST['date_from']:'')?>" size="22" maxlength="255" />
    <img src="images/cms_icons/cms_calendar.gif" align="absmiddle" id="kl1jhjhdj12d1jk2" title="Set Date" alt="Set Date" style="cursor: pointer;" border="0">
    <script type="text/javascript">
    
    Calendar.setup({
        inputField : "date_from",     // id of the input field
        ifFormat   : "%Y-%m-%d",      // format of the input field
        button     : "kl1jhjhdj12d1jk2",  // trigger for the calendar (button ID)
        align      : "Br",        // alignment (defaults to "Bl")
        //showOthers : true,          // if "true" (but default: "false") it will show days from other months too
        weekNumbers: false,          // (true/false) if it's true (default) the calendar will display week numbers
        //showsTime   : true,               // show time
        timeFormat  : 24 
        
    });
    Calendar.setup({
        inputField : "date_from",     
        ifFormat   : "%Y-%m-%d",
        align      : "Br",
        //showOthers : true,
        weekNumbers: false,
        //showsTime   : true,               // show time
        timeFormat  : 24
        
    });
    </script>
    <img src="images/cms_icons/cms_calendar_clear.gif" align="absmiddle" onclick='document.getElementById("date_from").value=""; ' title="Clear Date" style="cursor: pointer;" >
  </td>
</tr>
<tr>
    <td>по: &nbsp;</td>
  <td>
    <input name="date_to" id="date_to" type="text" class="cms_fieldstyle1" value="<?=(isset($_POST['date_to'])?$_POST['date_to']:'')?>" size="22" maxlength="255" />
    <img src="images/cms_icons/cms_calendar.gif" align="absmiddle" id="kjkjdnakjdnakwnjkd2" title="Set Date" alt="Set Date" style="cursor: pointer;" border="0">
    <script type="text/javascript">
    
    Calendar.setup({
        inputField : "date_to",     // id of the input field
        ifFormat   : "%Y-%m-%d",      // format of the input field
        button     : "kjkjdnakjdnakwnjkd2",  // trigger for the calendar (button ID)
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
        //showsTime   : true,               // show time
        timeFormat  : 24
        
    });
    </script>
    <img src="images/cms_icons/cms_calendar_clear.gif" align="absmiddle" onclick='document.getElementById("date_to").value=""; ' title="Clear Date" style="cursor: pointer;" >
  </td>
</tr>
<tr>
    <td>Работник:</td>
  <td><?=createSelectFromArray('worker_id', $workers, (isset($_POST['worker_id'])?$_POST['worker_id']:''))?></td>
</tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
<script language="javascript">
function clearFilter()
{
    d.forms['filter'].w_category.selectedIndex = 0;
}
</script>
<input type="submit" name="filter" value="OK" style="width: 100px;" /><!--<input type="button" onclick="clearFilter(); return false;" name="clear" value="Clear" style="width: 80px;" />-->
</div>  
</div>
</form>

<div id="results">

    <div class="cms_ind">
        <br />
        Отчёт: <br/>
         <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
            <tr >
                <td class="cms_cap2">Пользователь</td>
                <td class="cms_cap2">Дата</td>
                <td class="cms_cap2">Приход</td>
                <td class="cms_cap2">Уход</td>
                <td class="cms_cap2">Общее время</td>
                <td class="cms_cap2">Засчитанное время</td>
            </tr>
            <?=(isset($resources) ? $resources : '')?>   
         </table>
         <br />
    </div>
    
</div>
<br />
<br>
<br>
<form action="" method="post" enctype="multipart/form-data">
<table>
<tr>
    <td>Файл:</td>
    <td>
        <input type="file" name="input_file" />
    </td>
  </tr>
</table>
<input type="submit" name="upload" value="Upload file">
</form>

<? require('kernel/after.php'); ?>