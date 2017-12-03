<?php
#GLOBALS OFF
session_start();
include($_SERVER["DOCUMENT_ROOT"]."/includes/config.inc.php");
include($_SERVER["DOCUMENT_ROOT"]."/includes/functions.php");
foreach($_POST as $keypost=>$valp){
	$valp = varcheck($valp);
	$_POST[$keypost] = $valp;
}
foreach($_GET as $keyget=>$valg){
	$valg = varcheck($valg);
	$_GET[$keyget] = $valg;
}

header('Content-type: text/html; charset=windows-1251');
$sk='kgTvx2WrEZ';
$pers = GetUser($_SESSION['user']['login']);
if(new_array($pers)=='ok'){$pers['sign']=$sk;}
$prem=explode("|",$pers['premium']);
list($pers['x'], $pers['y']) = explode('_', $pers['pos']);
for($x = ($pers['x']-1);$x <= ($pers['x']+1);$x++){
	for($y = ($pers['y']-1);$y <= ($pers['y']+1);$y++){
		if(($_GET['x'] == $x and $_GET['y'] == $y)){
			$GoPos = array('x'=>$_GET['x'],'y'=>$_GET['y']);
		}
	}
}
/*
$ttimer = Array (0=>'00','02','04','06','08','10','12','14','16','18','20','22');
(date("H") >= $ttimer[$pers['thotem']-1] and date("H") <= $ttimer[$pers['thotem']]) ? $uslovija_bojs = '1' : '';*/
$Travm = explode("|",$pers['affect']);
$Trv = 0;
for($i=0;$i<=count($Travm);$i++){
	$trvm = explode("@",$Travm[$i]);
	if($trvm[2]>2 and $trvm[2]<5){
		$Trv++;	
	}
}
if($Trv>0 and $pers['sign']!=$sk){
	exit('MESS@["Продолжать свой путь вы не можете.<br /> У вас травма, позовите доктора.",0,0]');
}
if(intval($_GET['act']==1)){
$pers['umen'] = (($pers['umen'])?$pers['umen']:'||||||||||||||||||||||||||||||||||||');
$um = explode("|",$pers['umen']);
$pt=explode("|",$pers['st']);
foreach($um as $key=>$val){
	$umt[$key] = (($val)?$val:0);
}
$nst=explode("|",$pers['st']);
for($i=5;$i<=40;$i++){
	$nst[$i]=$nst[$i]?$nst[$i]:0;
}
$is_cord = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `nature` WHERE `x` = '".intval($GoPos['x'])."' and `y` = '".intval($GoPos['y'])."'"));
$ust = 100-round(($pers['ustal']-time())/(150/($nst[58]/200+1)));
if(round(($pers['ustal']-time())/(150/($nst[58]/200+1)))<100){
if((!empty($is_cord['x']) or $is_cord['x']=='0') and (!empty($is_cord['y']) or $is_cord['y']=='0') and in_array($_GET['vcode'],$_SESSION['vcodes'])){
	if($pers['ustal']<time()){
		$pers['ustal']=time();
	}
$pt[58]+=$umt[26];
if($pt[58]>0){
	$time=round($pt[58]/20);
}else{
	$time=0;
}
if($time>15){
	$time=15;
}
if($pers['clan_id']=='Life' or $pers['sign']==$sk){
	$time=23;
	$gh=1;
	$navi=1;
}elseif($prem[0]>=2){
	$navi=1;
}else{
	$navi=0;
}
$SuperTime = 30;
if(!empty($pers['bless'])){
	$Bless = explode("/",$pers['bless']);
	if($Bless[0] == 4){
		if($Bless[2] > time()){
			$SuperTime = round(30*$Bless[1]);
		}
	}
}
	$it=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `invent`.`pl_id`='".$pers['id']."' AND `items`.`acte`='BotNapForm' LIMIT 1;"));
	mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `ustal`='".($pers['ustal']+(150/($nst[58]/200+1)))."',`pos`='".$is_cord['x']."_".$is_cord['y']."',`wait`='".(time()+($SuperTime-$time))."' WHERE `id` = '".$pers['id']."'");
	$_SESSION['nature_from'] = $pers['x']."_".$pers['y'];
	unset($_SESSION['vcodes']);
	echo'GO@'.$is_cord['x'].'@'.$is_cord['y'].'@[';
	$query_nature = mysqli_query($GLOBALS['db_link'],"SELECT `x`,`y` FROM `nature` WHERE `x`>='".($is_cord['x']-1)."' and `x`<='".($is_cord['x']+1)."' and `y`>='".($is_cord['y']-1)."' and `y`<='".($is_cord['y']+1)."'");
	$pnature = '';
	while($nature = mysqli_fetch_assoc($query_nature)){
		if($is_cord['x']!=$nature['x'] or $is_cord['y']!=$nature['y']){
			$pnature .= '['.$nature['x'].','.$nature['y'].',"'.vCode().'"],';
		}
	}
	echo substr($pnature,0,strlen($pnature)-1);
	echo']@['.($navi?'["navi","Навигатор","'.vCode().'",[]],':'').($is_cord['que']?'["que","Квесты","'.vCode().'",[]],':'').'["inf","Ваш герой","'.vCode().'",[]],["inv","Рюкзак","'.vCode().'",[]]'.($is_cord['bld']?',["bld","Список строений","'.vCode().'",[]]':'').($is_cord['dep']?',["dep'.(($is_cord['dep'] == 1)?((date("H") > 7)?'_yes':(($prem[0]>=0)?'_yes':'_yes')):'_yes').'","Войти","'.vCode().'",[]]':'').($is_cord['ogl']?',["ogl","Поиск травы","'.vCode().'",[]]':'').(($is_cord['les'])?',["les","Поиск леса","'.vCode().'",[]]':'').($is_cord['fis']?',["fis","Рыбалка","'.vCode().'",[]]':'').(($is_cord['tele_coord'])?',["tele","Портал","'.vCode().'",[]]':'').($uslovija_bojs?',["fig","Напасть","'.vCode().'",[]]':'').($is_cord['dri']?',["dri","Пить","'.vCode().'",[]]':'').(accesses($pers['id'],'out')?',["editor","Редактор","'.vCode().'",[]]':'').(($it)?',["priman","Использовать приманку","'.vCode().'",[]]':',["disabled","У вас нет приманок","'.vCode().'",[]]').']@['.($SuperTime-$time).',"';
	if(date("H")<7 or date("H")>20){echo'night';}else{echo'day';}
	echo'","","';
		$crrd = $is_cord['x']."_".$is_cord['y'];
		if($pers['navipath'] and $pers['navidest']!=$crrd){
			$navicoord = explode("|",$pers['navipath']);
			if(in_array($pers['navidest'],$navicoord) and in_array($crrd,$navicoord)){
				$key = array_search($crrd,$navicoord);
				if($key>0){$nextnavi = $navicoord[$key-1];}
			}
			else{mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `navidest`='',`navipath`='' WHERE `id` = '".$pers['id']."' LIMIT 1;");}
		}
		else{mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `navidest`='',`navipath`='' WHERE `id` = '".$pers['id']."' LIMIT 1;");}
		if($nextnavi and $navi==1){echo $nextnavi;}
		else{mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `navidest`='',`navipath`='' WHERE `id` = '".$pers['id']."' LIMIT 1;");}
		
	echo'"]';

	}
	else{
	echo'ERR';
//MESS@["Соединение с сервером утеряно. Просьба выполнить повторный вход в игру с главной страницы.",0,0]
}
}else{
	echo'MESS@["Вы сильно утомлены<br /> отдохните немного и продолжите свой путь.",0,0]';
}
}
if(intval($_GET['act']==2)){
$pers['umen'] = (($pers['umen'])?$pers['umen']:'||||||||||||||||||||||||||||||||||||');
$um = explode("|",$pers['umen']);
$pt=explode("|",$pers['st']);
foreach($um as $key=>$val){
	$umt[$key] = (($val)?$val:0);
}
$nst=explode("|",$pers['st']);
for($i=5;$i<=40;$i++){
	$nst[$i]=$nst[$i]?$nst[$i]:0;
}
$for_cord = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `nature` WHERE `x` = '".$pers['x']."' and `y` = '".$pers['y']."'"));
list($GoPos['x'], $GoPos['y']) = explode('_', $for_cord['tele_coord']);
$is_cord = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `nature` WHERE `x` = '".intval($GoPos['x'])."' and `y` = '".intval($GoPos['y'])."'"));
if((!empty($is_cord['x']) or $is_cord['x']=='0') and (!empty($is_cord['y']) or $is_cord['y']=='0') and in_array($_GET['vcode'],$_SESSION['vcodes'])){
	mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `pos`='".$is_cord['x']."_".$is_cord['y']."' WHERE `id` = '".$pers['id']."'");
	unset($_SESSION['vcodes']);
	echo'TELE@';}
	else{
		echo'ERR';
	//MESS@["Соединение с сервером утеряно. Просьба выполнить повторный вход в игру с главной страницы.",0,0]
	}
}
?>
