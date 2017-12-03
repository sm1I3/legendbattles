<?php
session_start();
error_reporting(0);
require_once("./includes/common.php");
require_once("./includes/sql_func.php");
require_once("./gameplay/inc/bbcodes.inc.php");

switch($_GET['act']){
	default:
		$PLAY = db_quer('user','login = "'.mysqli_real_escape_string($GLOBALS['db_link'],strip_tags($_POST['login'])).'" and pass = "'.md5($_POST['password']).'" LIMIT 1;');
	break;
}
function GetUserIDtoAutch($user){
	$user = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `id` FROM `user` WHERE `login` = '".mysqli_real_escape_string($GLOBALS['db_link'],$user)."'"));
	return $user['id'];
}
if(empty($_POST) or ($_POST['login']=='Логин' and $_POST['password']=='Пароль')) {
	header("Location: /?msg=noinf");
	exit;
}
if(!isset($PLAY['id'])) {
	if(GetUserIDtoAutch($_POST['login'])!=''){
		pvu_logs(GetUserIDtoAutch($_POST['login']),"1","|1|".getIP());
	}
	log_write("err: пароль",'','','',1);
	header("Location: /help.php?login=1");
	exit;
}
if(!empty($PLAY['block'])) {
	header("Location: /index.php?msg=block");
	exit;
}
$lch=mysqli_result(mysqli_query($GLOBALS['db_link'],"SELECT MAX(id) FROM chat LIMIT 1;"),0);
//--------заполняем сессии переменными----
$uin = md5(uniqid(rand(0,1000000000)));
setcookie("Hash", $PLAY['pass'],time()+86400, "", ".leg");
setcookie('UID',$uin,time()+86400);
setcookie("Puid", $PLAY['id'],time()+86400, "", ".leg");

$_SESSION['ignor'][] = '';
$_SESSION['user'] = array(
    "login"  => $PLAY["login"],
    "filt"   => $PLAY["filt"],
    "on_time"=> time()+200,
    "chcolor"=> $PLAY["chcolor"],
    "sh"=> "",
    "ft"=> "",
    "wait"=> 0,
    "pos"=>0,
    "lastch"=>$lch,
    "uin"=>$uin,
    "inv"=>'',
	"pchange"=> $PLAY['pass']
);
//--------пишем куки-----------
if(birthday($PLAY['bday'], true) > $PLAY['bprise']){
	mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `bprise`='".birthday($PLAY['bday'], true)."' WHERE `id`='".$PLAY['id']."' LIMIT 1;");
}
if(birthday($PLAY['bday'])){
	if(birthday($PLAY['bday']) > $PLAY['bprise']){
		mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `bprise`='".birthday($PLAY['bday'])."',`baks`=`baks`+'10',`nv`=`nv`+'".date("Y")."' WHERE `id`='".$PLAY['id']."' LIMIT 1;");
		mysqli_query($GLOBALS['db_link'],"INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('".time()."','sys','".addslashes("parent.frames['chmain'].add_msg('<font class=massm>&nbsp;День Рождения.&nbsp;</font> <font color=000000>Администрация Legendbattles поздравляет <b>".$PLAY["login"]."</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?".$PLAY["login"]."\" target=\"_blank\"><img src=http://img.legendbattles.ru/image/chat/info.gif onClick=\"window.open(\'http://legendbattles.ru/ipers.php?".$PLAY["login"]."\');\" width=11 height=12 border=0 align=absmiddle></a> с днем рождения, и в этот праздник приймите от нас скромный подарок: <b>" .lr(date("Y")) . "</b> и <b> 10 </b><img src=http://img.legendbattles.ru/razdor/emerald.png width=14 height=14 </b>.</font><BR>'+'');")."');");
	}
}
if($PLAY['last'] == '0'){
    mysqli_query($GLOBALS['db_link'], "INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('".time()."','sys','".addslashes("parent.frames['chmain'].add_msg('<font class=massm>&nbsp;News.legendbattles.ru&nbsp;</font> <font color=000000>В свет наших земель вышел будущий герой, <a href=\"#\"><img src=//img.legendbattles.ru/image/chat/private.gif width=11 height=12 border=0 align=absmiddle onClick=\"parent.say_private(\'".$PLAY["login"]."\')\"></a><b>".$PLAY["login"]."</b>[0]<a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?".$PLAY["login"]."\" target=\"_blank\"><img src=http//img.legendbattles.ru/image/chat/info.gif onClick=\"window.open(\'http://legendbattles.ru/ipers.php?".$PLAY["login"]."\');\" width=11 height=12 border=0 align=absmiddle></a>. Желаем увлекательного прибывания в нашем мире.</font><BR>'+'');")."');");
}
if($PLAY['autoobnul'] == 0){
    obnul_pl($PLAY);
    mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `obnul`=`obnul`+'1',`autoobnul`='1' WHERE `id`='".$PLAY['id']."' LIMIT 1;");
}
pvu_logs($PLAY['id'],"1","|0|".getIP());
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `lastip` = ip,`ip`='".getIP()."',`sig`='',`pcid`='".$uin."', `onlineBouns`='".(3600+time())."',`last`='".time()."' WHERE `id` = '".$PLAY['id']."'");
log_write("вход в игру",'','','',1);
if($PLAY['lastip'] != getIP()){
	$jAlert = 'jAlert(\'<font color="red"><b>Внимание!</b></font><hr />'.date("d.m.Y H.i.s", $PLAY['last']).' был зафиксирован вход с IP-адреса '.$PLAY['lastip'].'<br /><br />Ваш текущий IP-адрес: '.getIP().'\');';
}
?>
<!DOCTYPE html>
<html>
<head>
	<TITLE> Legendbattles - (<?=$PLAY['login']?>) </TITLE>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<meta http-equiv="Cache-Control" content="No-Cache" />
	<meta http-equiv="Pragma" content="No-Cache" />
	<meta http-equiv="Expires" content="0" />
	<link rel="stylesheet" type="text/css" href="/css/themes/jquery.jgrowl.css" />
	<link rel="stylesheet" type="text/css" href="/css/themes/default/game.css" />
	<link rel="stylesheet" type="text/css" href="/css/themes/smodal.css" />
	<link rel="stylesheet" type="text/css" href="/css/jquery-ui.min.css" />
	<script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="/js/jquery.jgrowl.js"></script>
	<script type="text/javascript" src="/js/jquery.smodal.js"></script>
	<script type="text/javascript" src="/js/jquery.game.js"></script>
	<script type="text/javascript" src="/js/AutoBot.js?v1"></script>
	<script type="text/javascript" src="/js/png.js"></script>
	<script type="text/javascript" src="/js/functions.js?v3"></script>
	<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
</head>
<body>

    <script type="text/javascript">
        $(document).ready(function(){
            view_loading();
            window.onresize = change_chatsize;
        });
        jAlert = function(text){
            $("#alert").jGrowl(text);
        }
    </script>
	
<div id="ViewFrames">&nbsp;</div>
<div id="alert" class="jGrowl bottom-right"></div>
<div id="basic-modal-content">
</div>
</body>
</html>