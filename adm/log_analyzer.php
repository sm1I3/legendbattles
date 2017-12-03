<?php
require('kernel/before.php');

if (!userHasPermission(2)) {
    header('Location: index.php');
    die();
}

function getIdByNickname($nickname)
{
    //GET запрос указывается в строке URL
    $data = file_get_contents('http://www.neverlands.ru/modules/api/getid.cgi?'.rawurlencode(urldecode($nickname)));
    $arr = explode('|', $data);
    if (sizeof($arr) == 2)
        return $arr[0];
    return false;
}

function getNicknameById($id)
{
    $data = file_get_contents('http://www.neverlands.ru/modules/api/info.cgi?playerid='.$id.'&info=1');
    $arr = explode('|', $data);
    return $arr[1];
}
/*
function getIdByNickname($nickname)http://www.neverlands.ru/modules/api/getid.cgi?
{
    $ch = curl_init();
    //GET запрос указывается в строке URL
    curl_setopt($ch, CURLOPT_URL, 'http://www.neverlands.ru/modules/api/getid.cgi?'.$nickname);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Adminka');
    $data = curl_exec($ch);
    $arr = explode('|', $data);
    curl_close($ch);
    if (sizeof($arr) == 2)
        return $arr[0];
    return false;
}

function getNicknameById($id)
{
    $ch = curl_init();
    //GET запрос указывается в строке URL
    curl_setopt($ch, CURLOPT_URL, 'http://www.neverlands.ru/modules/api/info.cgi?playerid='.$id.'&info=1');
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Adminka');
    $data = curl_exec($ch);
    $arr = explode('|', $data);
    curl_close($ch);
    return $arr[1];
}
 */
$actions = array(
    1 => 'Отчет безопасности',
    2 => 'Передача NV',
    4 => 'Передача/Подарок вещей',
    8 => 'Сдача в гос',
    16 => 'Выкидывание вещей',
    32 => 'Продажа/Покупка вешей',
    64 => 'Сдача в казну',
    128 => 'Переводы NV (счета)',
    256 => 'Счета/Сейф (Операции)',
    512 => 'Депозиты/Ссуды/Кредиты',
    1024 => 'Подарки',
    2048 => 'Лицензии',
    4096 => 'Входы с одного компьютера',
    8192 => 'Молчанки/Тюрьма/Блок',
    16384 => 'Проверки на чистоту',
    32768 => 'Семьи/кланы (Движение)',
    65536 => 'Семьи/кланы (Списания)',
    131072 => 'Пароль/Flash/E-mail (Смена)',
    262144 => 'Подозрительные бои',
    1048576 => 'Лечение/нападения/абилити',
    2097152 => 'Модификация вещей',
    4194304 => 'Получение уровней',
    8388608 => 'NV/Вещи (Боты)',
);

if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name']))
{
    $tmp = file_get_contents($_FILES['file']['tmp_name']);
    $arr = explode("\n", $tmp);
    if ($_POST['month'] != '' && $_POST['year'] != '')
    {
        $from = strtotime($_POST['year'].'-'.$_POST['month'].'-01');
        $to = strtotime($_POST['year'].'-'.$_POST['month'].'-'.date('t', $from));
        mysql_query('DELETE FROM log_analyzer WHERE datetime >= '.intval($from).' AND datetime <= '.intval($to));
    }
    foreach($arr as &$ar1)
    {
        $row = explode('|', $ar1);
        $t1 = explode(' ', $row[0]);
        $t2 = explode(':', $t1[0]);
        $date = '20'.$t2[2].'-'.$t2[1].'-'.$t2[0].' '.$t1[1];
        mysql_query('INSERT INTO log_analyzer (datetime, user_id, view_user_id, view_params, view_from, view_to, user_ip)
        VALUES ('.strtotime($date).', '.intval($row[1]).', '.intval($row[2]).', '.intval($row[3]).', \''.mysql_escape_string($row[4].'-'.$row[6].'-00').'\', \''.mysql_escape_string($row[5].'-'.$row[7].'-00').'\', \''.mysql_escape_string($row[8]).'\' )');
    }
}

$log = '';
$qdate_from = $qdate_to = $action = '';
if (isset($_GET['date_from']) && $_GET['date_from'] != '')
    $qdate_from = strtotime($_GET['date_from'].' 00:00:00');
if (isset($_GET['date_to']) && $_GET['date_to'] != '')
    $qdate_to = strtotime($_GET['date_to'].' 23:59:59');
    
if (isset($_GET['action']) && $_GET['action'] != '')
    $action = intval($_GET['action']);
$from_id = $view_from_id = '';
if (isset($_GET['user_id']) && $_GET['user_id'] != '')
    $from_id = $_GET['user_id'];
if (isset($_GET['view_user_id']) && $_GET['view_user_id'] != '')
    $view_from_id = $_GET['view_user_id'];
    
$user_id = $view_user_id = '';
if (isset($_GET['user_login']) && $_GET['user_login'] != '' && !isset($_GET['noapi']))
{
    $t = getIdByNickname($_GET['user_login']);
    if ($t)
        $user_id = $t;
}

if (isset($_GET['view_user_login']) && $_GET['view_user_login'] != '' && !isset($_GET['noapi']))
{
    $t = getIdByNickname($_GET['view_user_login']);
    if ($t)
        $view_user_id = $t;
}

$query = 'SELECT * FROM log_analyzer WHERE 
    1 > 0
    '.($qdate_from != '' ? 'AND datetime >= '.$qdate_from : '').'
    '.($qdate_to != '' ? 'AND datetime <= '.$qdate_to : '').'
    '.($user_id != '' ? 'AND user_id = '.intval($user_id): '').'
    '.($view_user_id != '' ? 'AND view_user_id = '.intval($view_user_id): '').'
    '.($from_id != '' ? 'AND user_id = '.intval($from_id): '').'
    '.($view_from_id != '' ? 'AND view_user_id = '.intval($view_from_id): '').'
    '.($action != '' ? 'AND view_params = '.intval($action): '').'
    ORDER BY id DESC LIMIT 100';
$logs = $users = array();
$res = mysql_query($query, $db); 
while ($row = mysql_fetch_assoc($res))
{
    $logs[] = $row;
    $users[$row['user_id']] = true;
    $users[$row['view_user_id']] = true;
}

$user_names = array();
if (sizeof($users) > 0)
{
    /*$res = mysql_query('SELECT playerid, nickname FROM e_players_table WHERE playerid IN ('.implode(',', array_keys($users)).')');
    while($row = mysql_fetch_assoc($res))
        $user_names[$row['playerid']] = $row['nickname'];*/
    if (!isset($_GET['noapi']))
    foreach($users as $id=>$t)
    {
        $user_names[$id] = getNicknameById($id);
    }
}


foreach($logs as &$row)
{
    $log .= '
    <tr>
      <td align="left" class="cms_middle">'.date('Y-m-d H:i:s', $row['datetime']).'</td>
      <td align="left" class="cms_middle">'.$user_names[$row['user_id']].'</td>
      <td align="left" class="cms_middle">'.$row['user_id'].'</td>
      <td align="left" class="cms_middle">'.$user_names[$row['view_user_id']].'</td>
      <td align="left" class="cms_middle">'.$row['view_user_id'].'</td>
      <td align="left" class="cms_middle">'.$actions[$row['view_params']].'</td>
      <td align="left" class="cms_middle">'.$row['view_from'].'</td>
      <td align="left" class="cms_middle">'.$row['view_to'].'</td>
      <td align="left" class="cms_middle">'.$row['user_ip'].'</td>
    </tr>
    ';
}

$_SESSION['pages']['log_analyzer'] = $_SERVER['REQUEST_URI'];

?>
<h3>Анализатор логов</h3>
<script type="text/javascript" src="jscript/json2.js"></script>
<script type="text/javascript" src="jscript/swfobject.js"></script>

<script type="text/javascript" src="jscript/calendar/calendar_stripped.js" charset="windows-1251"></script> 
<script type="text/javascript" src="jscript/calendar/lang/calendar-ru_win_.js" charset="windows-1251"></script>     
<script type="text/javascript" src="jscript/calendar/calendar-setup_stripped.js" charset="windows-1251"></script>
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
    <td>Кто смотрел:</td>
    <td>
        <input type="text" name="user_login" value="<?=_htext($_GET['user_login'])?>" /> id: <input type="text" name="user_id" value="<?=_htext($_GET['user_id'])?>" />
    </td>
  </tr>
  <tr>
    <td>Кого смотрел:</td>
    <td>
        <input type="text" name="view_user_login" value="<?=_htext($_GET['view_user_login'])?>" /> id: <input type="text" name="view_user_id" value="<?=_htext($_GET['view_user_id'])?>" />
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
        
        Дата по: <input name="date_to" id="date_to" type="text" class="cms_fieldstyle1" value="<?=(isset($_GET['date_to'])?$_GET['date_to']:'')?>" size="22" maxlength="255" />
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
    <td>Действие:</td>
    <td>
        <?=createSelectFromArray('action', $actions, $_GET['action'])?>
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
Лог: <br />
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
      <td class="cms_cap2">Дата</td>
      <td class="cms_cap2">Кто</td>
      <td class="cms_cap2">ID</td>
      <td class="cms_cap2">Кого</td>
      <td class="cms_cap2">ID</td>
      <td class="cms_cap2">Действие</td>
      <td class="cms_cap2">С</td>
      <td class="cms_cap2">По</td>
      <td class="cms_cap2">IP</td>
    </tr>
    
    <?=$log?>
    
    </table>
    <br />
 </div>
<br>
<br>
Загрузить лог:
<form name="upload" action="" method="post" enctype="multipart/form-data">
Month: 
<?php 
$month = array (1=>"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
echo createSelectFromArray('month', $month, '');
?><br>
Year: <? 
$years = array(); 
for($i=intval(date('Y'))-1; $i<=intval(date('Y'))+5; $i++) 
    $years[$i] = $i;
echo createSelectFromArray('year', $years, ''); 
?><br>
File: <input type="file" name="file"><br>
<input type="submit" name="upload" value="Загрузить">
</form>
<? require('kernel/after.php'); ?>