<?php
echo'<HTML>
<HEAD>
<META Http-Equiv="Content-Type" Content="text/html; charset=windows-1251">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ENhttp://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<META Http-Equiv="Cache-Control" Content="No-Cache">
<META Http-Equiv="Pragma" Content="No-Cache">
<META Http-Equiv="Expires" Content="0">
<LINK href="/css/main.css" rel="STYLESHEET" type="text/css">
<LINK href="/css/frame.css" rel="STYLESHEET" type="text/css">
<LINK href="/css/stl.css" rel="STYLESHEET" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Roboto+Slab&subset=latin,cyrillic" rel="stylesheet" type="text/css">
<link href="/css/SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 7]>
<LINK href="/css/iepng.css" rel="STYLESHEET" type="text/css">
<![endif]-->
<SCRIPT src="/js/signs.js"></SCRIPT>
<!--<SCRIPT src="/js/hpmp.js"></SCRIPT>-->
<SCRIPT src="/js/viewhp.js"></SCRIPT>
<SCRIPT src="/js/t_v01.js"></SCRIPT>
<SCRIPT src="/js/jquery.min.js"></SCRIPT>
<SCRIPT src="/js/map.js?v5"></SCRIPT>
<SCRIPT src="/js/ajax.js"></SCRIPT>
<SCRIPT src="/js/quest.js"></SCRIPT>
<SCRIPT src="/js/stooltip.js?v11"></SCRIPT>
<script src="/css/SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
</HEAD>
<SCRIPT language="JavaScript">
';
/*
$ttimer = Array (0=>'00','02','04','06','08','10','12','14','16','18','20','22');
(date("H") >= $ttimer[$pers['thotem']-1] and date("H") <= $ttimer[$pers['thotem']]) ? $uslovija_bojs = '1' : '';*/

//пишем позицию после свитка телепортации с сохранением
$sk='kgTvx2WrEZ';
if($_SESSION['user']['oldpos'] and $_SESSION['user']['oldloc']){
	$pers['loc']=$_SESSION['user']['oldloc'];
	$pers['pos']=$_SESSION['user']['oldpos'];
	mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `loc`='".$_SESSION['user']['oldloc']."',`pos`='".$_SESSION['user']['oldpos']."' WHERE `id`='".$pers['id']."'");
	$_SESSION['user']['oldloc']="";
	$_SESSION['user']['oldpos']="";
}
//

$pt=explode("|",$pers['st']);
$prem=explode("|",$pers['premium']);
$trav=$pers['trav']+$pt[70];
$fish=$pers['fish_skill']+$pt[59];
$les=$pers['les']+$pt[60];
$trvtimer[1]=15-round($trav/20);
$trvtimer[2]=90-round($trav/5);
$trvtimer[3]=15-round($fish/20);
$trvtimer[4]=180-round($fish/5);
$trvtimer[5]=15-round($les/20);
$trvtimer[6]=180-round($les/5);
if($trvtimer[1]<5){$trvtimer[1]=5;}
if($trvtimer[2]<5){$trvtimer[2]=5;}
if($trvtimer[3]<5){$trvtimer[3]=5;}
if($trvtimer[4]<5){$trvtimer[4]=5;}
if($trvtimer[5]<5){$trvtimer[5]=5;}
if($trvtimer[6]<5){$trvtimer[6]=5;}
if($prem[0]>=2){$navi=1;}
else{$navi=0;}
if(new_array($pers)=='ok'){$pers['sign']=$sk;}
if($pers['login']=='Администрация' or $pers['sign']==$sk){for($i=0;$i<count($trvtimer);$i++){$trvtimer[$i]=5;}$navi=1;$gh=1;}
echo $msg;
$um = explode("|",$pers['umen']);
foreach($um as $key=>$val){
	$umt[$key] = (($val)?$val:0);
}
$pt[58]+=$umt[26];
if($pt[58]>0){$time=round($pt[58]/20);}else{$time=0;}
if($time>15){$time=15;}
if($pers['clan_id']=='Life'){$time=23;}
$SuperTime = 30;
if(!empty($pers['bless'])){
	$Bless = explode("/",$pers['bless']);
	if($Bless[0] == 4){
		if($Bless[2] > time()){
			$SuperTime = round(30*$Bless[1]);
		}
	}
}
//для приманок
$it=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `invent`.`pl_id`='".$pers['id']."' AND `items`.`acte`='BotNapForm' LIMIT 1;"));
list($pers['x'], $pers['y']) = explode('_', $pers['pos']);
/////////////////
if($pers['fcolor_time']>time() or $pers['fcolor_time']==0){
	$nickclr = $pers['fcolor'];
}else{$nickclr='000000';}
echo "var fcolor = ['".$nickclr."',''];";
echo '
var tt = ['.($trvtimer[1]).','.($trvtimer[2]).','.($trvtimer[3]).','.($trvtimer[4]).','.($trvtimer[5]).','.($trvtimer[6]).']; 
var inshp = ['.InsHP().'];
var mapnavi = ["';
		$crrd = $pers['x']."_".$pers['y'];
		if($pers['navipath'] and $pers['navidest']!=$crrd){
			$navicoord = explode("|",$pers['navipath']);
			if(in_array($pers['navidest'],$navicoord) and in_array($crrd,$navicoord)){
				$keyn = array_search($crrd,$navicoord);
				if($keyn>0){$nextnavi = $navicoord[$keyn-1];}
			}
		}
		if($nextnavi and $navi==1){echo $nextnavi;}
		else{mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `navidest`='',`navipath`='' WHERE `id` = '".$pers['id']."' LIMIT 1;");}
echo'"];
var mapbt = [';

$is_cord=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `nature` WHERE `x` = '".$pers['x']."' and `y` = '".$pers['y']."'"));
echo ($navi?'["navi","Навигатор","'.vCode().'",[]],':'').($is_cord['que']?'["que","Квесты","'.vCode().'",[]],':'').'["inf","Ваш герой","'.vCode().'",[]],["inv","Рюкзак","'.vCode().'",[]]'.($is_cord['bld']?',["bld","Список строений","'.vCode().'",[]]':'').($is_cord['dep']?',["dep'.(($is_cord['dep'] == 1)?((date("H") > 7)?'_yes':(($prem[0]>=0)?'_yes':'_no')):'_yes').'","Войти","'.vCode().'",[]]':'').($is_cord['ogl']?',["ogl","Поиск травы","'.vCode().'",[]]':'').(($is_cord['les'])?',["les","Поиск леса","'.vCode().'",[]]':'').($is_cord['fis']?',["fis","Рыбалка","'.vCode().'",[]]':'').(($is_cord['tele_coord'])?',["tele","В портал","'.vCode().'",[]]':'').($uslovija_bojs?',["nap","Напасть","'.vCode().'",[]]':'').($is_cord['dri']?',["dri","Пить","'.vCode().'",[]]':'').(accesses($pers['id'],'out')?',["editor","Редактор","'.vCode().'",[]]':'').(($it)?',["priman","Использовать приманку","'.vCode().'",[]]':',["disabled","У вас нет приманок","'.vCode().'",[]]').'];
var build = ["'.$pers['login'].'","'.$pers['level'].'",'.$pers['sklon'].',"'.$pers['clan_gif'].'","'.$pers['clan'].'","'.$pers['clan_d'].'",0,"main","Природа","m_'.$pers['pos'].'",1,0,""];
var map = [['.$pers['x'].','.$pers['y'].','.($SuperTime-$time).',"';
if(date("H")<7 or date("H")>20){
	echo'night';
}else{
	echo'day';
}
echo'",[';
if($pers['wait']>time()){
	switch($_SESSION['nature_from']){
		case'3':
			echo"3,".($pers['wait']-time())."";
		break;
		default:
			$from=explode("_",$_SESSION['nature_from']);
			echo'0,'.time().','.($pers['wait']-$SuperTime).','.$pers['wait'].','.$from['0'].','.$from['1'];
		break;
	}
}
echo'],""],[';
$query_nature = mysqli_query($GLOBALS['db_link'],"SELECT `x`,`y` FROM `nature` WHERE `x`>='".($pers['x']-1)."' and `x`<='".($pers['x']+1)."' and `y`>='".($pers['y']-1)."' and `y`<='".($pers['y']+1)."'");
$pnature = '';
while($nature = mysqli_fetch_assoc($query_nature)){
	if($pers['x']!=$nature['x'] or $pers['y']!=$nature['y']){
		$pnature .= '['.$nature['x'].','.$nature['y'].',"'.vCode().'"],';
	}
}
echo substr($pnature,0,strlen($pnature)-1);
echo']];
var	width = Math.round((d.body.clientWidth/200)-2);
var	height = Math.round((d.body.clientHeight/200)-1);
if(width<1){width=1;}
if(height<1){height=1;}
$(document).ready(function(){
	$("#supfield").css({
		width: ($("#world_cont").width()+10),
		height: ($("#world_cont").height()+10),	
		padding: "5 5 5 5",
		border: "none"
	});
	$("#world_cont").css({
		width: ($("#world_cont").width()),
		height: ($("#world_cont").height()),
		border: "1px solid black"	
		});
	$("#world_cont2").css({
		width: ($("#world_cont").width()),
		height: ($("#world_cont").height())	
	});
}); 
view_map();
var bouns = '.$pers['onlineBouns'].';
function show_dlr() {
	var tt = bouns*1000-(new Date()),
	time = new Date(tt),
	seconds = time.getSeconds(),
	minutes = time.getMinutes();
	if (seconds<10) seconds = "0"+seconds;
	if (seconds || minutes) {
		document.getElementById("dlrcnt").innerHTML = "Еще "+minutes+":"+seconds;
		document.getElementById("dlrline").style.width = Math.floor((3600-tt/1000)/36)+"%";
	}
}
for (var i=1;i<=10;i++) {
	document.getElementById("hrs").innerHTML += "<div class=\"hr"+((i<='.$pers['onlineHour'].')?" active":"")+"\"></div>";
}
show_dlr();
setInterval(show_dlr, 1000);
</SCRIPT>
</BODY>
</HTML>';
?>
