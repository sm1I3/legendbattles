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
//if(new_array($pers)=='ok'){$pers['sign']=$sk;}
$pt=explode("|",$pers['st']);
$trav=$pers['trav']+$pt[70];
$fish=$pers['fish_skill']+$pt[59];
$les=$pers['les']+$pt[60];
$trvtimer[1]=15-round($trav/20);
$trvtimer[2]=90-round($trav/5);
$trvtimer[3]=15-round($fish/20);
$trvtimer[4]=180-round($fish/5);
$trvtimer[5]=15-round($les/20);
$trvtimer[6]=180-round($$les/5);
if($trvtimer[1]<5){$trvtimer[1]=5;}
if($trvtimer[2]<5){$trvtimer[2]=5;}
if($trvtimer[3]<5){$trvtimer[3]=5;}
if($trvtimer[4]<5){$trvtimer[4]=5;}
if($trvtimer[5]<5){$trvtimer[5]=5;}
if($trvtimer[6]<5){$trvtimer[6]=5;}
if ($pers['login'] == 'mozg' or $pers['login'] == 'Администрация' or $pers['sign'] == $sk) {
    for ($i = 0; $i < count($trvtimer); $i++) {
        $trvtimer[$i] = 5;
    }
    $navi = 1;
}
$pers['trav']+=$pt[70];
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
    if ($pers['login'] == 'mozg' or $pers['login'] == 'Администрация') {
        $trvtimer1 = 5;
        $trvtimer2 = 15;
    }
	mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `lastbattle`='".(time()+120)."',`wait_prof`='".(time()+$trvtimer[2])."' WHERE `id`='".$pers['id']."' LIMIT 1;");
	list($pers['x'], $pers['y']) = explode('_', $pers['pos']);
	$grasssql=mysqli_query($GLOBALS['db_link'],"SELECT * FROM `nature_grass` WHERE `x`='".$pers['x']."' AND `y`='".$pers['y']."';");
    if (mysqli_num_rows($grasssql) < 1) {
        $error = "Вы осмотрелись вокруг в поисках травы, но ничего не нашли.";
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
            $error = "Вы осмотрелись вокруг в поисках травы, но ничего не нашли.";
        }
	}
	$serp=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],'SELECT `invent`.*,  `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`="'.$pers['id'].'" AND `items`.`type`="w66" AND `items`.`slot`="3" AND `invent`.`used`="1" LIMIT 1;'));
	$grassrow=substr($grassrow,0,strlen($grassrow)-1);
	$captcha="00000";
    header("Content-type: text/html; charset=UTF-8");
	echo 'AL@["'.($error?$error:'').'",""]@[0,"'.$captcha.'","'.(($serp)?$serp['id_item']:'').'",1,1000,'.$grassrow.']';
break;
case 2:
	//$tst = $pers['wait_prof']-time()-2;
	$tst=0;
	if($tst<=0){	
		list($pers['x'], $pers['y']) = explode('_', $pers['pos']);
		$serp=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],'SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`="'.$pers['id'].'" AND `items`.`type`="w66" AND `items`.`slot`="3" AND `invent`.`used`="1" LIMIT 1;'));
		$grasssql=mysqli_query($GLOBALS['db_link'],"SELECT * FROM `nature_grass` WHERE `x`='".$pers['x']."' AND `y`='".$pers['y']."';");
        if (mysqli_num_rows($grasssql) < 1 and mysqli_num_rows($serp) < 1) {
            $error = "Вы осмотрелись вокруг в поисках травы, но ничего не нашли.";
        }
		else{
			$error="";
			while ($row = mysqli_fetch_assoc($grasssql)){
				$newgrass="";
				$grass = explode("|",$row['grass']);
				foreach ($grass as $val){
					$grn=explode("@",$val);
					$newtime=$grn[2];
					if($grn[2]<=time()){
						switch($grn[0]){
							case intval($_GET['gid']):
								$rndtrav=round(($pers['trav']/65)+1);
								$upcoeff=round(($pers['trav']+15)/2);
								if($upcoeff>50){$upcoeff=50;}
								$rndtravup=rand(1,$upcoeff);
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
								$rare=0;
								if((rand(1,100))==1){
									$raregrass = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE `id`='".(rand(2224,2225))."' LIMIT 1;"));
									$rare=1;								
								}
								else if((rand(1,300))==1){
									$raregrass = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE `id`='".(rand(2226,2227))."' LIMIT 1;"));
									$rare=2;
								}
								else if((rand(1,750))==1){
									$raregrass = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE `id`='".(rand(2228,2229))."' LIMIT 1;"));
									$rare=3;
								}
								if($rare>0){
									$pr=$raregrass['price'];
									$par=explode("|",$raregrass['param']);
									foreach ($par as $value) {
										$stat=explode("@",$value);
										switch($stat[0]){case 2: $dolg=$stat[1];break;}
									}
									$insert.="('".$raregrass['id']."','".$pers['id']."','".$dolg."','".$pr."','".$rare."','0'),";								
								}
								$insert=substr($insert,0,strlen($insert)-1);
								mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype`,`pl_id`,`dolg`,$filt,`mod_color`,`death`) VALUES ".$insert.";");
								$newtime=($grn[1]*60)+time()+(rand(1,12)*60);
							break;
						}
					}
					$newgrass.=$grn[0]."@".$grn[1]."@".$newtime."|";		
				}
			}
			$newgrass=substr($newgrass,0,strlen($newgrass)-1);
            if ($allgrass == "") {
                $error = "Вы осмотрелись вокруг в поисках травы, но ничего не нашли.";
            }
			else{
				$error="";			
				$dolg=$serp['dolg']-$serp['iznos']-1;
				if($dolg<=0){
                    $error .= "<br><b>" . $serp['name'] . " </b>сломался истратив всю долговечность, приобретите новый.";
				}
				it_break($serp['id_item']);
                $error .= '<br>Вы срезали: <b>' . $allgrass['name'] . '</b>, <b>' . $rand . '</b> шт.<br>' . (($raregrass) ? '<br>Вы получили редкую траву: <b><font color=green>' . $raregrass['name'] . '</b></font>, <b>1</b> шт.<br>' : '');
				mysqli_query($GLOBALS['db_link'],"UPDATE `nature_grass` SET `grass`='".$newgrass."' WHERE `x`='".$pers['x']."' AND `y`='".$pers['y']."';");
				if($rndtravup==1){
					mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `trav`=`trav`+'1' WHERE `id`='".$pers['id']."' LIMIT 1;");
                    $error .= '<b>Травничество <font color=red>+1</font>.</b>';
				}
			}
		}

        header("Content-type: text/html; charset=UTF-8");
		echo 'AL@["'.($error?$error:'').'"]';	
	}
break;	
}
//ingr 0 - всегда 0
//ingr 1 - капча, вырублена
//ingr 2 - ?
//ingr 3 - масса перса
//ingr 4 - вместимость рюкзака
//ingr 5 - аррей со списком травы


