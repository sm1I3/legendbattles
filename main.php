<?php
session_start ();
$v=time()+microtime();
error_reporting(E_ERROR);
ini_set("display_errors", "on");
require_once ($_SERVER["DOCUMENT_ROOT"]."/includes/common.php");
require_once ($_SERVER["DOCUMENT_ROOT"]."/includes/sql_func.php");
require_once ($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/bbcodes.inc.php");
require_once ($_SERVER["DOCUMENT_ROOT"]."/includes/cron.php");
db_open();
foreach($_POST as $keypost=>$valp){$valp = varcheck($valp);$_POST[$keypost] = $valp;$$keypost = $valp;}
foreach($_GET as $keyget=>$valg){$valg = varcheck($valg);$_GET[$keyget] = $valg;$$keyget = $valg;}
foreach($_SESSION as $keyses=>$vals){$$keyses = $vals;}
$player=player();
$rt = '<script type="text/javascript"> function locs(){window.location = window.location;}setTimeout("locs()", 60000);</script>';
if($player["rframe"]==1){echo"$rt";}
## DLR logs by mozg
if($_SESSION['bakspl']==''){$_SESSION['bakspl'] = $player['baks'];}
if($_SESSION['lrpl']==''){$_SESSION['lrpl'] = $player['nv'];}
## проверяем значения
$typetolog = '0';
$abouttolog = '0';  # переменные для логов: первая всегда 0
	if($_SESSION['bakspl']!=$player['baks']){
		$typetolog .= '@4';
        $abouttolog .= '@старое: <b><font color=#004BBB>' . $_SESSION['bakspl'] . '</font></b> | новое: <b><font color=#CC0000>' . $player['baks'] . '</font></b>';
		$_SESSION['bakspl']=$player['baks'];
	}
# пишем в лог все что произошло
		if($typetolog!='0' and $abouttolog!='0'){
			player_actions($player['id'],$typetolog,$abouttolog);
		}
	# 
##
if($_SESSION['user']['pchange']==''){$_SESSION['user']['pchange']=$player['pass'];}
if($_SESSION['user']['pchange']!=$player['pass']){
	log_write("WARNING","md5_old: [".$_SESSION['user']['pchange']."] | md5_new: [".$player['pass']."]",0);
}
if($player['mov']==1){
	$_SESSION['user']['pos']=3;
	unset($_SESSION['secur']);
	mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `mov`=DEFAULT WHERE `id`='".$player['id']."' LIMIT 1;");
}
$check = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `blocklist` WHERE `ip`='".$player['ip']."',`ip`='".$player['lastip']."' LIMIT 1;"));
if(!preg_match("/{$HTTP_HOST}/" ,getenv ('HTTP_REFERER' )) or $_SESSION['user']['login']=='' or $_COOKIE['UID']!=$player['pcid'] or $player['block']!='' or $check['id']){
if($player['block']!=''){echo "<script>parent.location = 'index.php?act=logout';</script>";}else{echo "<script>parent.location = 'error.php';</script>";}}
if(isset($_POST['newabout']) and $_POST['post_id']==49){
	$tmptext = $_POST['newabout'];
}
if(isset($_POST['opass']) and isset($_POST['npass']) and isset($_POST['vpass']) and $_POST['post_id']==49){
$tmpopass=$_POST['opass'];
$tmpvpass=$_POST['vpass'];
$tmpnpass=$_POST['npass'];
}
foreach($_POST as $keypost=>$valp){$valp = varcheck($valp);$_POST[$keypost] = $valp;$$keypost = $valp;}
foreach($_GET as $keyget=>$valg){$valg = varcheck($valg);$_GET[$keyget] = $valg;$$keyget = $valg;}
foreach($_SESSION as $keyses=>$vals){$$keyses = $vals;}
if(isset($_POST['newabout']) and $_POST['post_id']==49){
	$_POST['newabout'] = $tmptext;
	$newabout = $tmptext;
}
if(isset($_POST['opass']) and isset($_POST['npass']) and isset($_POST['vpass']) and $_POST['post_id']==49){
$_POST['opass'] = $tmpopass;
$_POST['vpass'] = $tmpvpass;
$_POST['npass'] = $tmpnpass;
$opass = $tmpopass;
$vpass = $tmpvpass;
$npass = $tmpnpass;
}

#GET CHECKS
if(isset($_GET['get']) and in_array($_GET['vcode'],$_SESSION['secur'])){
	$_SESSION['user']['pos']=$_GET['get'];
	mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `useaction`='".addslashes($_GET['get'])."' WHERE `id`='".$player['id']."'");
}
if(isset($_GET['get_id'])and in_array($_GET['vcode'],$_SESSION['secur'])){
	include"./gameplay/inc/get_id.php";
}
if(isset($_GET['go']) and in_array($_GET['vcode'],$_SESSION['secur'])){
	$pris=explode("|",$player['prison']);
	if($pris[0]<time()){change_get($_GET['go']);}
}
if(isset($_GET['post_id'])){
	if($_GET['post_id']==98 or $_GET['post_id']==109 or $_GET['post_id']==112 or $_GET['post_id']==114 or $_GET['post_id']==118){include"./gameplay/inc/post_id.php";}
	else if(in_array($_GET['vcode'],$_SESSION['secur'])){include"./gameplay/inc/post_id.php";}	
}

#end check get
#POST CHECKS 
if(!isset($_GET['get']) and isset($_POST['get']) and in_array($_POST['vcode'],$_SESSION['secur'])){
	$_SESSION['user']['pos']=$_POST['get'];
	mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `useaction`='".addslashes($_POST['get'])."' WHERE `id`='".$player['id']."'");
}
if(!isset($_GET['get_id']) and isset($_POST['get_id'])	and in_array($_POST['vcode'],$_SESSION['secur'])){
	include("./gameplay/inc/get_id.php");
}
if(!isset($_GET['go']) and isset($_POST['go']) and in_array($_POST['vcode'],$_SESSION['secur'])){
	$pris=explode("|",$player['prison']);
	if($pris[0]<time()){change_get($_POST['go']);}
}
if(!isset($_GET['post_id']) and isset($_POST['post_id'])){
	if($_POST['post_id']==98 or $_POST['post_id']==109 or $_POST['post_id']==112){include"./gameplay/inc/post_id.php";}
	else if(in_array($_POST['vcode'],$_SESSION['secur'])){include"./gameplay/inc/post_id.php";}	
}
if(isset($_POST['fightmagicstart']) and (in_array($_POST['fmc'],$_SESSION['secur']) or in_array($_POST['fmc'],$_SESSION['vcodes']))){include "./gameplay/inc/post_attack.php";}
#end check post
$player=player();
$plst=explode("|",$player['st']);
$plstt=allparam($player);
unset($_SESSION['secur']);
#calc rank
list($uronMin, $uronMax) = explode("-", $plst[1]);
$player['rank_i'] = (($plstt[30]+$plstt[31]+$plstt[32]+$plstt[33]+$plstt[34]+($plst[9]+($perk[32]*30)))*0.3 + (($plst[7]+($perk[5]*30))+($plst[5]+($perk[19]*30))+($plst[6]+($perk[0]*30))+($plst[8]+($perk[15]*30)))*0.03 + ($player["hp_all"]+$player["mp_all"])*0.04+($uronMin+$uronMax)*0.3);
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `rank_i` = '".$player['rank_i']."' WHERE `id` = '".$player['id']."'");
#end cals
if($player['battle']!=0 and $player['fight']!=0 and $_GET['useaction'] != 'admin-action' and $_GET['useaction'] != 'client-action'){
	require "./gameplay/inc/battle.php";
	exit;
}
if($_GET["change"]){
	$sneginv = mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT protype, pl_id FROM invent WHERE protype='2735' and pl_id='".$player['id']."' "));
	if(!$sneginv) $sneginv = 0;
	$_GET["sncount"] = intval($_GET["sncount"]);
		if(!$_GET["sncount"]){
            echo "<script>parent.jAlert('Укажите кол-во  для обмена.');</script>";
		exit(include"./includes/addons/addon-action.php");
		}
		elseif($_GET["sncount"]>$sneginv or $sneginv==0){
            echo "<script>parent.jAlert('Недостаточно снежинок.');</script>";
		
		exit(include"./includes/addons/addon-action.php");
		}
		else{
            if ($_GET["sncount"] == 1) $n = 'ка';
            elseif ($_GET["sncount"] > 1 and $_GET["sncount"] <= 4) $n = 'ки';
            elseif ($_GET["sncount"] > 4 or $_GET["sncount"] == 0) $n = 'ок';
			mysqli_query($GLOBALS['db_link'],"DELETE FROM invent WHERE protype='2735' and pl_id='".$player['id']."' LIMIT ".intval($_GET['sncount']).";");
			mysqli_query($GLOBALS['db_link'],"UPDATE user SET sneg=sneg + ".intval($_GET['sncount'])." where id='".$player['id']."' LIMIT 1;");
            echo "<script>parent.jAlert('На ваш счет зачислено " . $_GET['sncount'] . " снежинок');</script>";
		
		exit(include"./includes/addons/addon-action.php");
		}
}
if(isset($_GET['useaction']) and $player['waitprof']<=time()){
    $usea = array('addon-action','menu-action','client-action','trade'); 
    for ($i=0;$i<=4;$i++)
		switch($_GET['useaction']){
			case $usea[$i] :
				exit(include"./includes/addons/".$usea[$i].".php");
			break;
			case'clan-action':
				if($_SESSION['user']['clan'] == '') {
				exit("<meta http-equiv='refresh' content='0; url= /core2.php?useaction=clan-action'>");
				}
			break;
			case'auction-action':
			exit("<meta http-equiv='refresh' content='0; url= /core2.php?useaction=auction-action'>");
			break;
		}
}
if($player['battle']!=0 or $player['wait']>time())$_SESSION['user']['pos']=3;
include"./gameplay/inc/hedder.php";
if($_SESSION['user']['pos']<2){$inc="/mpers.php";}
if ($_SESSION['user']['pos'] > 1) {
    $inc = $ret[3] . "/" . pl_loc($player['loc']);
} // pl_loc($player['loc']) - пхп файл локации.
include("./gameplay/inc/".$inc);
?>
</BODY>
</HTML>