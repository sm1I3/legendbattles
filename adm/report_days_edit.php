<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['date']) || $_GET['date'] == '')
    $date = '';
else
    $date = $_GET['date'];
    
if (isset($_POST['date'])) 
{
    
    if ($date == '') 
    {
        $query = '
        insert into z_days
        (
            date,
            type
        ) values (
            "'.mysql_escape_string($_POST['date']).'",
            '.(int)$_POST['type'].'
        )'  ;
        
        mysql_query($query);
    } 
    else 
    {
        $query = '
        update z_days set
            date = \''.mysql_escape_string($_POST['date']).'\',
            type = '.(int)$_POST['type'].'
        where
            date = \''.mysql_escape_string($_POST['date']).'\'
        ';
        mysql_query($query);
    }    
    
    header('Location: report_days.php');
    
}

if ($date == '') 
{
    $rep_date = array(
        'date' => '',
        'type' => 1,
    );
} 
else 
{
    $rep_date = array();
    $res = mysql_query('select * from z_days where date = \''.mysql_escape_string($date).'\'');
    if($row = mysql_fetch_assoc($res))
        $rep_date = $row;
    mysql_free_result($res);
}

$types = array(1 => 'Выходной', 2 => 'Рабочий');
?>
    <h3><?= ($date == '' ? 'Добавить день' : 'Изменить день') ?></h3>
    <script type="text/javascript" src="jscript/calendar/calendar_stripped.js" charset="utf-8"></script>
    <script type="text/javascript" src="jscript/calendar/lang/calendar-ru_win_.js" charset="utf-8"></script>
    <script type="text/javascript" src="jscript/calendar/calendar-setup_stripped.js" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" media="all" href="jscript/calendar/calendar-system.css" title="system" />
<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td><span class="cms_star">*</span>День: &nbsp;</td>
  <td><input name="date" id="date" type="text" class="cms_fieldstyle1" value="<?=$rep_date['date']?>" size="22" maxlength="255" />
    <img src="images/cms_icons/cms_calendar.gif" align="absmiddle" id="kl1jhjhdj12d1jk2" title="Set Date" alt="Set Date" style="cursor: pointer;" border="0">
    <script type="text/javascript">
    
    Calendar.setup({
        inputField : "date",     // id of the input field
        ifFormat   : "%Y-%m-%d",      // format of the input field
        button     : "kl1jhjhdj12d1jk2",  // trigger for the calendar (button ID)
        align      : "Br",        // alignment (defaults to "Bl")
        //showOthers : true,          // if "true" (but default: "false") it will show days from other months too
        weekNumbers: false,          // (true/false) if it's true (default) the calendar will display week numbers
        //showsTime   : true,               // show time
        timeFormat  : 24 
        
    });
    Calendar.setup({
        inputField : "date",     
        ifFormat   : "%Y-%m-%d",
        align      : "Br",
        //showOthers : true,
        weekNumbers: false,
        //showsTime   : true,               // show time
        timeFormat  : 24
        
    });
    </script>
    <img src="images/cms_icons/cms_calendar_clear.gif" align="absmiddle" onclick='document.getElementById("date").value=""; ' title="Clear Date" style="cursor: pointer;" ></td>
</tr>
<tr>
    <td>Тип: &nbsp;</td>
  <td><?=createSelectFromArray('type', $types, $rep_date['type'], '', false)?></td>
</tr>
</table>

<p></p>
    <input name="submit" type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
    <input name="cancel" type="submit" onclick="document.location='report_days.php'; return false;" class="cms_button1"
           value="Отмена"/>
    <p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>