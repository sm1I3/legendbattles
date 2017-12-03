<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

$workers = array();
$res = mysql_query('SELECT * FROM z_worker ORDER BY worker_name');
while($row = mysql_fetch_assoc($res))
    $workers[$row['worker_id']] = $row['worker_name'];

if (!isset($_GET['vacation_id']) || $_GET['vacation_id'] == '')
    $vacation_id = '';
else
    $vacation_id = $_GET['vacation_id'];
    
if (isset($_POST['date_from'])) 
{
    
    if ($vacation_id == '') 
    {
        $query = '
        insert into z_vacations
        (
            date_from,
            date_to,
            worker_id
        ) values (
            "'.mysql_escape_string($_POST['date_from']).'",
            "'.mysql_escape_string($_POST['date_to']).'",
            '.(int)$_POST['worker_id'].'
        )'  ;
        
        mysql_query($query);
    } 
    else 
    {
        $query = '
        update z_vacations set
            date_from = \''.mysql_escape_string($_POST['date_from']).'\',
            date_to = \''.mysql_escape_string($_POST['date_to']).'\',
            worker_id = '.(int)$_POST['worker_id'].'
        where
            vacation_id = '.intval($vacation_id).'
        ';
        mysql_query($query);
    }    
    
    header('Location: report_vacation.php');
    
}

if ($vacation_id == '') 
{
    $vacation = array(
        'date_from' => '',
        'date_to' => '',
        'worker_id' => '',
    );
} 
else 
{
    $vacation = array();
    $res = mysql_query('select * from z_vacations where vacation_id = '.intval($vacation_id).'');
    if($row = mysql_fetch_assoc($res))
        $vacation = $row;
    mysql_free_result($res);
}

$types = array(1 => 'Выходной', 2 => 'Рабочий');
?>
<h3><?=($vacation_id == ''?'Добавить отпуск':'Изменить отпуск')?></h3>
<script type="text/javascript" src="jscript/calendar/calendar_stripped.js" charset="windows-1251"></script> 
<script type="text/javascript" src="jscript/calendar/lang/calendar-ru_win_.js" charset="windows-1251"></script>     
<script type="text/javascript" src="jscript/calendar/calendar-setup_stripped.js" charset="windows-1251"></script>
<link rel="stylesheet" type="text/css" media="all" href="jscript/calendar/calendar-system.css" title="system" />
<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td>Работник:</td>
    <td><?=createSelectFromArray('worker_id', $workers, $vacation['worker_id'])?></td>
</tr>
<tr>
  <td>С: &nbsp;  </td>
  <td><input name="date_from" id="date_from" type="text" class="cms_fieldstyle1" value="<?=$vacation['date_from']?>" size="22" maxlength="255" />
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
    <img src="images/cms_icons/cms_calendar_clear.gif" align="absmiddle" onclick='document.getElementById("date_from").value=""; ' title="Clear Date" style="cursor: pointer;" ></td>
</tr>
<tr>
  <td>По: &nbsp;  </td>
  <td><input name="date_to" id="date_to" type="text" class="cms_fieldstyle1" value="<?=$vacation['date_to']?>" size="22" maxlength="255" />
    <img src="images/cms_icons/cms_calendar.gif" align="absmiddle" id="awcawdcc12e12e" title="Set Date" alt="Set Date" style="cursor: pointer;" border="0">
    <script type="text/javascript">
    
    Calendar.setup({
        inputField : "date_to",     // id of the input field
        ifFormat   : "%Y-%m-%d",      // format of the input field
        button     : "awcawdcc12e12e",  // trigger for the calendar (button ID)
        align      : "Br",        // alignment (defaults to "Bl")
        //showOthers : true,          // if "true" (but default: "false") it will show days from other months too
        weekNumbers: false,          // (true/false) if it's true (default) the calendar will display week numbers
        //showsTime   : true,               // show time
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
    <img src="images/cms_icons/cms_calendar_clear.gif" align="absmiddle" onclick='document.getElementById("date_to").value=""; ' title="Clear Date" style="cursor: pointer;" ></td>
</tr>
</table>

<p></p>
  <input name="submit"  type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
  <input name="cancel" type="submit" onclick="document.location='report_days.php'; return false;" class="cms_button1" value="Отмена" />
<p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>