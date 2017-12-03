<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

$labyrinth_classes = array(
    1 => 'Поиск сундука',
    2 => 'Клановое соревнование',
);

if (!isset($_GET['event_id']) || !is_numeric($_GET['event_id']))
    $event_id = '';
else
    $event_id = (int)$_GET['event_id'];
    
date_default_timezone_set('Europe/Moscow');
    
if (isset($_POST['min_lvl'])) 
{
    $params = array(
        'round_max_level' => $_POST['round_max_level'],
        'round_step' => $_POST['round_step'],
        'labyrinth_type' => $_POST['labyrinth_type'],
        'labyrinth_class' => $_POST['labyrinth_class'],
    );
    $serialized_params = serialize($params);
    
    
    if ($event_id == '') 
    {
        
        $query = '
        insert into labyrinth_schedule 
        (
            lab_id,
            min_lvl,
            max_lvl,
            date_from,
            date_to,
            opened_from,
            opened_to,
            labyrinth_params,
            system_message,
            started,
            notification_time,
            start_point
        ) values (
            '.(int)$_POST['lab_id'].',
            '.(int)$_POST['min_lvl'].',
            '.(int)$_POST['max_lvl'].',
            '.strtotime($_POST['date_from']).',
            '.strtotime($_POST['date_to']).',
            '.strtotime($_POST['opened_from']).',
            '.strtotime($_POST['opened_to']).',
            \''.mysql_escape_string($serialized_params).'\',
            '.(isset($_POST['system_message']) && $_POST['system_message'] == '1' ? 1 : 0).',
            0,
            '.strtotime($_POST['notification_time']).',
            \''.mysql_escape_string($_POST['start_point']).'\'
        )';
        
        mysql_query($query);
        
        $lab_id = mysql_insert_id($db);
        header('Location: labyrinth_schedule.php');
    } else {
        $query = '
        update labyrinth_schedule set
            lab_id = '.(int)$_POST['lab_id'].',
            min_lvl = '.(int)$_POST['min_lvl'].',
            max_lvl = '.(int)$_POST['max_lvl'].',
            notification_time = '.strtotime($_POST['notification_time']).',
            date_from = '.strtotime($_POST['date_from']).',
            date_to = '.strtotime($_POST['date_to']).',
            opened_from = '.strtotime($_POST['opened_from']).',
            opened_to = '.strtotime($_POST['opened_to']).',
            labyrinth_params = \''.mysql_escape_string($serialized_params).'\',
            system_message = '.(isset($_POST['system_message']) && $_POST['system_message'] == '1' ? 1 : 0).',
            started = 0,
            start_point = \''.mysql_escape_string($_POST['start_point']).'\'
        where
            event_id = '.intval($event_id).'
        ';
        
        
        if (!mysql_query($query))
            die(mysql_error());
            
        header('Location: labyrinth_schedule.php');
    }    
    
    
}


if ($event_id == '' && !isset($_GET['copy_event_id'])) {
    $event = array(
        'lab_id' => '',
        'min_lvl' => '1',
        'max_lvl' => '100',
        'date_from' => date('Y-m-d H:i:00', strtotime('+1 day')),
        'date_to' => date('Y-m-d H:i:00', strtotime('+10 days')),
        'opened_from' => date('Y-m-d H:i:00', strtotime('+1 day')),
        'opened_to' => date('Y-m-d H:i:00', strtotime('+2 days')),
        'system_message' => 0,
        'start_point' => '',
        'notification_time' => date('Y-m-d H:i:00', strtotime('+2 days')),
    );
    $params = array(
        'round_max_level' => 99,
        'round_step' => 1,
        'labyrinth_type' => 0,
        'labyrinth_class' => 1,
    );
} else {
    $event = array();
    if (isset($_GET['copy_event_id']) && $_GET['copy_event_id']!='')
        $res = mysql_query('select * from labyrinth_schedule where event_id = '.(int)$_GET['copy_event_id']);
    else
        $res = mysql_query('select * from labyrinth_schedule where event_id = '.(int)$event_id);
    if($row = mysql_fetch_assoc($res))
        $event = $row;
    $event['date_from'] = date('Y-m-d H:i:s', $event['date_from']);
    $event['date_to'] = date('Y-m-d H:i:s', $event['date_to']);
    $event['opened_from'] = date('Y-m-d H:i:s', $event['opened_from']);
    $event['opened_to'] = date('Y-m-d H:i:s', $event['opened_to']);
    $event['notification_time'] = date('Y-m-d H:i:s', $event['notification_time']);
    $params = unserialize($row['labyrinth_params']);
    mysql_free_result($res);
}

$labs = array();
$res = mysql_query('select * from labyrinth_list order by labyrinth_name asc');
while($row = mysql_fetch_assoc($res))
    $labs[$row['labyrinth_id']] = $row['labyrinth_name'];
mysql_free_result($res);

?>
    <h3><?= ($event_id == '' ? 'Добавить событие' : 'Изменить событие') ?></h3>

    <script type="text/javascript" src="jscript/calendar/calendar_stripped.js" charset="utf-8"></script>
    <script type="text/javascript" src="jscript/calendar/lang/calendar-ru_win_.js" charset="utf-8"></script>
    <script type="text/javascript" src="jscript/calendar/calendar-setup_stripped.js" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" media="all" href="jscript/calendar/calendar-system.css" title="system" />

<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td>Лабиринт: &nbsp;</td>
    <td><?=createSelectFromArray('lab_id', $labs, $event['lab_id'])?></td>
</tr>
<tr>
    <td>Минимальный уровень: &nbsp;</td>
    <td><input name="min_lvl" type="text" class="cms_fieldstyle1" value="<?=$event['min_lvl']?>" size="8" maxlength="5" /></td>
</tr>
<tr>
    <td>Максимальный уровень: &nbsp;</td>
    <td><input name="max_lvl" type="text" class="cms_fieldstyle1" value="<?=$event['max_lvl']?>" size="8" maxlength="5" /></td>
</tr>
<tr>
    <td>Активен с: &nbsp;</td>
  <td>
    <input name="date_from" id="date_from" type="text" class="cms_fieldstyle1" value="<?=$event['date_from']?>" size="22" maxlength="255" />
    <img src="images/cms_icons/cms_calendar.gif" align="absmiddle" id="kl1jhjhdj12d1jk2" title="Set Date" alt="Set Date" style="cursor: pointer;" border="0">
    <script type="text/javascript">
    
    Calendar.setup({
        inputField : "date_from",     // id of the input field
        ifFormat   : "%Y-%m-%d %H:%M:00",      // format of the input field
        button     : "kl1jhjhdj12d1jk2",  // trigger for the calendar (button ID)
        align      : "Br",        // alignment (defaults to "Bl")
        //showOthers : true,          // if "true" (but default: "false") it will show days from other months too
        weekNumbers: false,          // (true/false) if it's true (default) the calendar will display week numbers
        showsTime   : true,               // show time
        timeFormat  : 24 
        
    });
    Calendar.setup({
        inputField : "date_from",     
        ifFormat   : "%Y-%m-%d %H:%M:00",
        align      : "Br",
        //showOthers : true,
        weekNumbers: false,
        showsTime   : true,               // show time
        timeFormat  : 24
        
    });
    </script>
    <img src="images/cms_icons/cms_calendar_clear.gif" align="absmiddle" onclick='document.getElementById("date_from").value=""; ' title="Clear Date" style="cursor: pointer;" >
  </td>
</tr>
<tr>
    <td>Активен по: &nbsp;</td>
  <td>
    <input name="date_to" id="date_to" type="text" class="cms_fieldstyle1" value="<?=$event['date_to']?>" size="22" maxlength="255" />
    <img src="images/cms_icons/cms_calendar.gif" align="absmiddle" id="kjkjdnakjdnakwnjkd2" title="Set Date" alt="Set Date" style="cursor: pointer;" border="0">
    <script type="text/javascript">
    
    Calendar.setup({
        inputField : "date_to",     // id of the input field
        ifFormat   : "%Y-%m-%d %H:%M:00",      // format of the input field
        button     : "kjkjdnakjdnakwnjkd2",  // trigger for the calendar (button ID)
        align      : "Br",        // alignment (defaults to "Bl")
        //showOthers : true,          // if "true" (but default: "false") it will show days from other months too
        weekNumbers: false,          // (true/false) if it's true (default) the calendar will display week numbers
        showsTime   : true,               // show time
        timeFormat  : 24 
        
    });
    Calendar.setup({
        inputField : "date_to",     
        ifFormat   : "%Y-%m-%d %H:%M:00",
        align      : "Br",
        //showOthers : true,
        weekNumbers: false,
        showsTime   : true,               // show time
        timeFormat  : 24
        
    });
    </script>
    <img src="images/cms_icons/cms_calendar_clear.gif" align="absmiddle" onclick='document.getElementById("date_to").value=""; ' title="Clear Date" style="cursor: pointer;" >
  </td>
</tr>
<tr>
    <td>Вход открыт с: &nbsp;</td>
  <td>
    <input name="opened_from" id="opened_from" type="text" class="cms_fieldstyle1" value="<?=$event['opened_from']?>" size="22" maxlength="255" />
    <img src="images/cms_icons/cms_calendar.gif" align="absmiddle" id="jhgdjk1hjdk1l2mkkl12" title="Set Date" alt="Set Date" style="cursor: pointer;" border="0">
    <script type="text/javascript">
    
    Calendar.setup({
        inputField : "opened_from",     // id of the input field
        ifFormat   : "%Y-%m-%d %H:%M:00",      // format of the input field
        button     : "jhgdjk1hjdk1l2mkkl12",  // trigger for the calendar (button ID)
        align      : "Br",        // alignment (defaults to "Bl")
        //showOthers : true,          // if "true" (but default: "false") it will show days from other months too
        weekNumbers: false,          // (true/false) if it's true (default) the calendar will display week numbers
        showsTime   : true,               // show time
        timeFormat  : 24 
        
    });
    Calendar.setup({
        inputField : "opened_from",     
        ifFormat   : "%Y-%m-%d %H:%M:00",
        align      : "Br",
        //showOthers : true,
        weekNumbers: false,
        showsTime   : true,               // show time
        timeFormat  : 24
        
    });
    </script>
    <img src="images/cms_icons/cms_calendar_clear.gif" align="absmiddle" onclick='document.getElementById("opened_from").value=""; ' title="Clear Date" style="cursor: pointer;" >
  </td>
</tr>
<tr>
    <td>Вход открыт по: &nbsp;</td>
  <td>
    <input name="opened_to" id="opened_to" type="text" class="cms_fieldstyle1" value="<?=$event['opened_to']?>" size="22" maxlength="255" />
    <img src="images/cms_icons/cms_calendar.gif" align="absmiddle" id="awdhauijowidj2mod" title="Set Date" alt="Set Date" style="cursor: pointer;" border="0">
    <script type="text/javascript">
    
    Calendar.setup({
        inputField : "opened_to",     // id of the input field
        ifFormat   : "%Y-%m-%d %H:%M:00",      // format of the input field
        button     : "awdhauijowidj2mod",  // trigger for the calendar (button ID)
        align      : "Br",        // alignment (defaults to "Bl")
        //showOthers : true,          // if "true" (but default: "false") it will show days from other months too
        weekNumbers: false,          // (true/false) if it's true (default) the calendar will display week numbers
        showsTime   : true,               // show time
        timeFormat  : 24 
        
    });
    Calendar.setup({
        inputField : "opened_to",     
        ifFormat   : "%Y-%m-%d %H:%M:00",
        align      : "Br",
        //showOthers : true,
        weekNumbers: false,
        showsTime   : true,               // show time
        timeFormat  : 24
        
    });
    </script>
    <img src="images/cms_icons/cms_calendar_clear.gif" align="absmiddle" onclick='document.getElementById("opened_to").value=""; ' title="Clear Date" style="cursor: pointer;" >
  </td>
</tr>
<tr>
    <td>Максимальный раунд (уровень) (0-99): &nbsp;</td>
  <td><input name="round_max_level" type="text" class="cms_fieldstyle1" value="<?=$params['round_max_level']?>" size="25" maxlength="255" /></td>
</tr>
<tr>
    <td>Шаг раунда (0.01 - 10): &nbsp;</td>
  <td><input name="round_step" type="text" class="cms_fieldstyle1" value="<?=$params['round_step']?>" size="25" maxlength="255" /></td>
</tr>
<tr>
    <td>Системное сообщение: &nbsp;</td>
  <td><input name="system_message" type="checkbox" value="1" <?=($event['system_message']==1 ? 'checked="checked"' : '')?> /></td>
</tr>
<tr>
    <td>Точка старта: &nbsp;</td>
    <td><input name="start_point" type="text" class="cms_fieldstyle1" value="<?= $event['start_point'] ?>" size="25"
               maxlength="255"/> (Пусто - по умолчанию)
    </td>
</tr>
<tr>
    <td>Время оповещения: &nbsp;</td>
  <td>
    <input name="notification_time" id="notification_time" type="text" class="cms_fieldstyle1" value="<?=$event['notification_time']?>" size="22" maxlength="255" />
    <img src="images/cms_icons/cms_calendar.gif" align="absmiddle" id="jklkj12v12" title="Set Date" alt="Set Date" style="cursor: pointer;" border="0">
    <script type="text/javascript">
    
    Calendar.setup({
        inputField : "notification_time",     // id of the input field
        ifFormat   : "%Y-%m-%d %H:%M:00",      // format of the input field
        button     : "jklkj12v12",  // trigger for the calendar (button ID)
        align      : "Br",        // alignment (defaults to "Bl")
        //showOthers : true,          // if "true" (but default: "false") it will show days from other months too
        weekNumbers: false,          // (true/false) if it's true (default) the calendar will display week numbers
        showsTime   : true,               // show time
        timeFormat  : 24 
        
    });
    Calendar.setup({
        inputField : "notification_time",     
        ifFormat   : "%Y-%m-%d %H:%M:00",
        align      : "Br",
        //showOthers : true,
        weekNumbers: false,
        showsTime   : true,               // show time
        timeFormat  : 24
        
    });
    </script>
    <img src="images/cms_icons/cms_calendar_clear.gif" align="absmiddle" onclick='document.getElementById("notification_time").value=""; ' title="Clear Date" style="cursor: pointer;" >
  </td>
</tr>
<tr>
    <td>Тип лабиринта: &nbsp;</td>
  <td><input name="labyrinth_type" type="text" class="cms_fieldstyle1" value="<?=(isset($params['labyrinth_type']) ? $params['labyrinth_type'] : 0)?>" size="25" maxlength="255" /></td>
</tr>
<tr>
    <td>Вид лабиринта: &nbsp;</td>
  <td><?=createSelectFromArray('labyrinth_class', $labyrinth_classes, (isset($params['labyrinth_class']) ? $params['labyrinth_class'] : 1))?></td>
</tr>
</table>
    
<p></p>

    <input name="submit" onclick="" type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
    <input name="cancel" type="submit" onclick="document.location='labyrinth_schedule.php'; return false;"
           class="cms_button1" value="Отмена"/>
    <p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>