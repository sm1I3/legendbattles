<?php
#GLOBALS OFF
header('Content-type: text/html; charset=UTF-8');
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
$sk='kgTvx2WrEZ';
$pers = GetUser($_SESSION['user']['login']);
$pt=explode("|",$pers['st']);
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
if ($pers['login'] == 'Администрация' or $pers['sign'] == $sk) {
    for ($i = 0; $i < count($trvtimer); $i++) {
        $trvtimer[$i] = 5;
    }
    $navi = 1;
}
$pers['les']+=$pt[60];
//////////////////////
$Travm = explode("|",$pers['affect']);
$Trv = 0;
for($i=0;$i<=count($Travm);$i++){
	$trvm = explode("@",$Travm[$i]);
	if($trvm[2]>2 and $trvm[2]<5){
		$Trv++;	
	}
}
if ($Trv > 0) {
    exit('MESS@["Вы обессилены и не можете осмотреться вокруг.<br /> У вас травма, позовите доктора.",0,0]');
}
//////////////////////////////////

switch(intval($_GET['act'])){
case 1:
	list($pers['x'], $pers['y']) = explode('_', $pers['pos']);
	mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `wait_prof`='".(time()+$trvtimer[6])."' WHERE `id`='".$pers['id']."' LIMIT 1;");
	$grasssql=mysqli_query($GLOBALS['db_link'],"SELECT * FROM `nature_les` WHERE `x`='".$pers['x']."' AND `y`='".$pers['y']."';");
	$serp=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],'SELECT `invent`.*,`items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`="'.$pers['id'].'" AND `items`.`type`="w68" AND `items`.`slot`="3" AND `invent`.`used`="1" LIMIT 1;'));
    if (mysqli_num_rows($grasssql) < 1 and $serp['id']) {
        $error = "Вы осмотрелись вокруг, но ничего не нашли.";
    }
	else{
		$error="";
		$grassrow="";
		while ($row = mysqli_fetch_assoc($grasssql)){	
			$grass = explode("|",$row['grass']);
			foreach ($grass as $val){
				$grn=explode("@",$val);
				if($grn[2]<=time()){
					$allgrass = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `items`.`id`,`items`.`name`,`items`.`gif` FROM `items` WHERE `id`='".$grn[0]."' LIMIT 1;"));
					$grassrow.='['.$allgrass['id'].',"'.$allgrass['name'].'","'.$allgrass['gif'].'","'.vCode().'"],';
				}
			}
		}
        if ($allgrass == "") {
            $error = "Вы осмотрелись вокруг, но ничего не нашли.";
        }
	}
	
	$grassrow=substr($grassrow,0,strlen($grassrow)-1);
	$captcha="00000";
    header("Content-type: text/html; charset=UTF-8");
	echo 'LES@["'.($error?$error:'').'",""]@[0,"'.$captcha.'","'.(($serp)?$serp['id_item']:'').'",1,1000,'.$grassrow.']';
break;
case 2:
	list($pers['x'], $pers['y']) = explode('_', $pers['pos']);
	$tst = $pers['wait_prof']-time()-2;
	if($tst<=0){
		$grasssql=mysqli_query($GLOBALS['db_link'],"SELECT * FROM `nature_les` WHERE `x`='".$pers['x']."' AND `y`='".$pers['y']."';");	
		$serp=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],'SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`="'.$pers['id'].'" AND `items`.`type`="w68" AND `items`.`slot`="3" AND `invent`.`used`="1" LIMIT 1;'));
		mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `wait_prof`='".(time()+$trvtimer6)."' WHERE `id`='".$pers['id']."' LIMIT 1;");
        if (mysqli_num_rows($grasssql) < 1 and $serp['id']) {
            $error = "Вы осмотрелись вокруг, но ничего не нашли.";
        }
		else{
			while ($row = mysqli_fetch_assoc($grasssql)){
				$newgrass="";
				$grass = explode("|",$row['grass']);
				foreach ($grass as $val){
					$grn=explode("@",$val);
					$newtime=$grn[2];
					if($grn[2]<=time()){
						switch($grn[0]){
							case intval($_GET['gid']):
								$rndtrav = 1;
								if($rndtrav>5){$rndtrav=5;}
								$rand=rand(1,$rndtrav);
								$allgrass = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE `id`='".intval($_GET['gid'])."' LIMIT 1;"));
								if($allgrass['dd_price']>0){$pr=$allgrass['dd_price'];$filt="`dd_price`";}
								else{$pr=$allgrass['price'];$filt="`price`";}
								$par=explode("|",$allgrass['param']);
								foreach ($par as $value) {
									$stat=explode("@",$value);
									switch($stat[0]){case 2: $dolg=$stat[1];break;}
								}
								$insert="";	
								for($i=0; $i<$rand;$i++){
									$insert.="('".$allgrass['id']."','".$pers['id']."','".$dolg."','".$pr."','0','".(time()+604800)."'),";
								}
								$insert=substr($insert,0,strlen($insert)-1);
								mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype`,`pl_id`,`dolg`,$filt,`mod_color`,`death`) VALUES ".$insert.";");
								$newtime=($grn[1]*60)+time()+(rand(1,12)*60);
							break;
						}
					}
					$newgrass.=$grn[0]."@".$grn[1]."@".($grn[3]>0?"0@".($grn[3]-1)."|":$newtime."@".(rand(3,5))."|");		
				}
			}
			$newgrass=substr($newgrass,0,strlen($newgrass)-1);
            if ($allgrass == "") {
                $error = "Вы осмотрелись вокруг, но ничего не нашли.";
            }
			else{
				$error="";
                $error .= "<font class=proce style='color:black';>Снаряжение: <b>" . $serp['name'] . "</b></font>";
				$dolg=$serp['dolg']-$serp['iznos']-1;
                if ($dolg <= 0) {
                    $error .= "<br><font class=proce style='color:black';><b>" . $serp['name'] . " </b>истратил всю долговечность, приобретите новую.</font>";
                }
				it_break($serp['id_item']);					
				mysqli_query($GLOBALS['db_link'],"UPDATE `nature_les` SET `grass`='".$newgrass."' WHERE `x`='".$pers['x']."' AND `y`='".$pers['y']."';");
                $error .= "<br><font class=proce style='color:black';>Вы срубили: </font><font class=proce style='color:#006600;'><b>" . $allgrass['name'] . " </b>(" . $rand . " шт.)</font>";
				$upcoeff=round(($pers['les']-$pt[60]+15)/2);
				if($upcoeff>50){$upcoeff=50;}
				$rndtravup=rand(1,$upcoeff);
                if ($rndtravup == 1 or $pers['login'] == 'Администрация') {
					mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `les`=`les`+'1' WHERE `id`='".$pers['id']."' LIMIT 1;");
                    $error .= "<br><br><font class=proce>Поздравляем, вы подняли навык:</font><br><font class=proce style='color:black';><b>Лесоруб </font><font class=proce style='color:#006600;'>+1</font>.</b>";
				}
			}
		}

        header("Content-type: text/html; charset=UTF-8");
		echo 'LES@["'.($error?$error:'').'"]';
}	
break;	
}
//ingr 0 - всегда 0
//ingr 1 - капча, вырублена
//ingr 2 - ?
//ingr 3 - масса перса
//ingr 4 - вместимость рюкзака
//ingr 5 - аррей со списком травы


?>