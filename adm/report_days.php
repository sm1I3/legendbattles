<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_date']))
{
    mysqli_query($GLOBALS['db_link'], 'DELETE FROM z_days WHERE date = \'' . mysqli_escape_string($GLOBALS['db_link'], $_GET['delete_date']) . '\'');
}

if (!isset($_GET['date_from']) || $_GET['date_from'] == '')
    $_GET['date_from'] = date('Y').'-01-01';
    
if (!isset($_GET['date_to']) || $_GET['date_to'] == '')
    $_GET['date_to'] = date('Y').'-12-31';

$vizor_days = array();
$res = mysqli_query($GLOBALS['db_link'], 'SELECT * FROM z_days WHERE date >= \'' . mysqli_escape_string($GLOBALS['db_link'], $_GET['date_from']) . '\' AND date <= \'' . mysqli_escape_string($GLOBALS['db_link'], $_GET['date_to']) . '\' ORDER BY date');

$types = array(1 => 'Выходной', 2 => 'Рабочий');
?>
    <h3>Отчёт</h3>
    <a href="report.php">Назад</a>
    <script type="text/javascript" src="jscript/calendar/calendar_stripped.js" charset="utf-8"></script>
    <script type="text/javascript" src="jscript/calendar/lang/calendar-ru_win_.js" charset="utf-8"></script>
    <script type="text/javascript" src="jscript/calendar/calendar-setup_stripped.js" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" media="all" href="jscript/calendar/calendar-system.css" title="system" />
<form name="filter" id="filter" action="" method="get" enctype="multipart/form-data">
<input type="hidden" name="sort_by" value="<?=(isset($_GET['sort_by'])?$_GET['sort_by']:'')?>" />
<input type="hidden" name="sort_order" value="<?=(isset($_GET['sort_order'])?$_GET['sort_order']:'')?>" />
    <div id="filter"><h4>Фильтр: </h4>
<div id="cms_filter"> 
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
      <td>С: &nbsp;</td>
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
    <input name="date_to" id="date_to" type="text" class="cms_fieldstyle1" value="<?=(isset($_GET['date_to'])?$_GET['date_to']:'')?>" size="22" maxlength="255" />
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
                <td class="cms_cap2">Удалить</td>
                <td class="cms_cap2">Изменить</td>
                <td class="cms_cap2">Дата</td>
                <td class="cms_cap2">Тип</td>
            </tr>
             <? while ($row = mysqli_fetch_assoc($res)) {
            echo '
            <tr>
                <td class="cms_middle" align="center"><a onclick="return confirm(\'Вы уверены что хотите удалить этот день?\');" href="report_days.php?delete_date=' . $row['date'] . '" title="Удалить"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
                <td class="cms_middle" align="center"><a href="report_days_edit.php?date=' . $row['date'] . '" title="Изменить"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
                <td align="left" class="cms_middle">'.$row['date'].'</td>
                <td align="left" class="cms_middle">'.$types[$row['type']].'</td>
            </tr>';
            } ?>
         </table>
         <br />
    </div>
    
</div>
<br />
    <a href="report_days_edit.php">Добавить день</a>

<? require('kernel/after.php'); ?>