<?php
#GLOBALS OFF
header('Content-type: text/html; charset=windows-1251');
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

$pers = GetUser($_SESSION['user']['login']);

if(accesses($pers['id'],'out')){
	switch($_GET['act']){
		case'EditName':
			if(mysqli_query($GLOBALS['db_link'],"UPDATE `nature` SET `name`='".htmlspecialchars($_GET['locname'])."' WHERE `x`='".intval($_GET['x'])."' AND `y`='".intval($_GET['y'])."'")){
				echo"OK2";	
			}
		break;
		case'GoTo':
			if(mysqli_query($GLOBALS['db_link'],"UPDATE `nature` SET `dep`='".intval($_GET['locid'])."' WHERE `x`='".intval($_GET['x'])."' AND `y`='".intval($_GET['y'])."'")){
				echo"OK3@";
				if(intval($_GET['locid'])){
					$locname = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `loc` WHERE `id`='".intval($_GET['locid'])."'"));
					echo '<br>'.$locname['city'].'<br>['.$locname['loc']?$locname['loc']:$locname['loc'].'-'.$locname['room'].']';
				}else{
                    echo 'Никуда';
				}
			}
		break;
		case'Create':
			if(mysqli_query($GLOBALS['db_link'],"INSERT INTO `nature` (`x`, `y`) VALUES ('".intval($_GET['x'])."', '".intval($_GET['y'])."');")){
				echo"OK4";
			}
		break;
		case'Delete':
			if(mysqli_query($GLOBALS['db_link'],"DELETE FROM `nature` WHERE `x` = '".intval($_GET['x'])."' AND `y` = '".intval($_GET['y'])."'")){
				echo"OK4";
			}
		break;
		case'BotEdit':
			if(mysqli_query($GLOBALS['db_link'],"UPDATE `nature_bots` SET `lvlmin`='".intval($_GET['lvlmin'])."',`lvlmax`='".intval($_GET['lvlmax'])."' WHERE `x` = '".intval($_GET['x'])."' AND `y` = '".intval($_GET['y'])."'")){
				echo"OK4";
			}
		break;
		case'BotAdd':
			if(mysqli_query($GLOBALS['db_link'],"INSERT INTO `nature_bots` (`x`,`y`,`lvlmin`,`lvlmax`) VALUES ('".intval($_GET['x'])."','".intval($_GET['y'])."','".intval($_GET['lvlmin'])."','".intval($_GET['lvlmax'])."');")){
				echo"OK4";
			}
		break;
		case'BotDelete':
			if(mysqli_query($GLOBALS['db_link'],"DELETE FROM `nature_bots` WHERE `x` = '".intval($_GET['x'])."' AND `y` = '".intval($_GET['y'])."'")){
				echo"OK4";
			}
		break;
		case'GrassAdd':
			$oldgrass = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `nature_grass` WHERE `x`='".intval($_GET['x'])."' AND `y`='".intval($_GET['y'])."';");
			if(mysqli_num_rows($oldgrass)<1){
				if(mysqli_query($GLOBALS['db_link'],"INSERT INTO `nature_grass` (`x`,`y`,`grass`) VALUES ('".intval($_GET['x'])."','".intval($_GET['y'])."','".intval($_GET['grass'])."@".intval($_GET['rost'])."@0');")){
					echo"OK4";
				}
			}
			else{
				$newconf="";
				$oldgrass=mysqli_fetch_assoc($oldgrass);
				$conf=explode("|",$oldgrass['grass']);
				foreach($conf as $val){
					$confirm=explode("@",$val);
					$newconf.=$confirm[0]."|";
				}
				$newconf=substr($newconf,0,strlen($newconf)-1);
				$newconfirm=explode("|",$newconf);
				if(in_array(intval($_GET['grass']),$newconfirm)){$newgrass = $oldgrass['grass'];}
				else{$newgrass = $oldgrass['grass']."|".intval($_GET['grass'])."@".intval($_GET['rost'])."@0";}
				if(mysqli_query($GLOBALS['db_link'],"UPDATE `nature_grass` SET `grass`='".$newgrass."' WHERE `x`='".intval($_GET['x'])."' AND `y`='".intval($_GET['y'])."';")){
					echo"OK4";
				}
			}
		break;		
		case'GrassDelete':
			if(mysqli_query($GLOBALS['db_link'],"DELETE FROM `nature_grass` WHERE `x` = '".intval($_GET['x'])."' AND `y` = '".intval($_GET['y'])."'")){
				echo"OK4";
			}
		break;
		case'TeleAdd':
		$val_telex=varcheck($_GET['telex']);
			if(mysqli_query($GLOBALS['db_link'],"UPDATE `nature` SET `tele_coord`='".$val_telex."' WHERE `x`='".intval($_GET['x'])."' AND `y`='".intval($_GET['y'])."'")){
				echo"OK5@";
				if($_GET['telex']){
				  list($tele['x'], $tele['y']) = explode('_', $_GET['telex']);
				  $locname = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `nature` WHERE `x`='".$tele['x']."' AND `y`='".$tele['y']."' LIMIT 1;"));
				  echo '<br>'.$locname['city'].'<br>['.($locname['name']?$locname['name']:'').']';
				}else{
                    echo 'Никуда';
				}
			}
		break;
		case'LesAdd':
			$oldgrass = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `nature_les` WHERE `x`='".intval($_GET['x'])."' AND `y`='".intval($_GET['y'])."';");
			if(mysqli_num_rows($oldgrass)<1){
				if(mysqli_query($GLOBALS['db_link'],"INSERT INTO `nature_les` (`x`,`y`,`grass`) VALUES ('".intval($_GET['x'])."','".intval($_GET['y'])."','".intval($_GET['grass'])."@".intval($_GET['rost'])."@0@".(rand(3,5))."');")){
					echo"OK4";
				}
			}
			else{
				$newconf="";
				$oldgrass=mysqli_fetch_assoc($oldgrass);
				$conf=explode("|",$oldgrass['grass']);
				foreach($conf as $val){
					$confirm=explode("@",$val);
					$newconf.=$confirm[0]."@".(rand(3,5))."|";
				}
				$newconf=substr($newconf,0,strlen($newconf)-1);
				$newconfirm=explode("|",$newconf);
				if(in_array(intval($_GET['grass']),$newconfirm)){$newgrass = $oldgrass['grass'];}
				else{$newgrass = $oldgrass['grass']."|".intval($_GET['grass'])."@".intval($_GET['rost'])."@0@".(rand(3,5))."";}
				if(mysqli_query($GLOBALS['db_link'],"UPDATE `nature_les` SET `grass`='".$newgrass."' WHERE `x`='".intval($_GET['x'])."' AND `y`='".intval($_GET['y'])."';")){
					echo"OK4";
				}
			}
		break;		
		case'LesDelete':
			if(mysqli_query($GLOBALS['db_link'],"DELETE FROM `nature_les` WHERE `x` = '".intval($_GET['x'])."' AND `y` = '".intval($_GET['y'])."'")){
				echo"OK4";
			}
		break;
		case'FishAdd':
			$oldgrass = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `nature_fish` WHERE `x`='".intval($_GET['x'])."' AND `y`='".intval($_GET['y'])."';");
			if(mysqli_num_rows($oldgrass)<1){
				if(mysqli_query($GLOBALS['db_link'],"INSERT INTO `nature_fish` (`x`,`y`,`grass`) VALUES ('".intval($_GET['x'])."','".intval($_GET['y'])."','".intval($_GET['grass'])."@".intval($_GET['rost'])."@0');")){
					echo"OK4";
				}
			}
			else{
				$newconf="";
				$oldgrass=mysqli_fetch_assoc($oldgrass);
				$conf=explode("|",$oldgrass['grass']);
				foreach($conf as $val){
					$confirm=explode("@",$val);
					$newconf.=$confirm[0]."|";
				}
				$newconf=substr($newconf,0,strlen($newconf)-1);
				$newconfirm=explode("|",$newconf);
				if(in_array(intval($_GET['grass']),$newconfirm)){$newgrass = $oldgrass['grass'];}
				else{$newgrass = $oldgrass['grass']."|".intval($_GET['grass'])."@".intval($_GET['rost'])."@0";}
				if(mysqli_query($GLOBALS['db_link'],"UPDATE `nature_fish` SET `grass`='".$newgrass."' WHERE `x`='".intval($_GET['x'])."' AND `y`='".intval($_GET['y'])."';")){
					echo"OK4";
				}
			}
		break;		
		case'FishDelete':
			if(mysqli_query($GLOBALS['db_link'],"DELETE FROM `nature_fish` WHERE `x` = '".intval($_GET['x'])."' AND `y` = '".intval($_GET['y'])."'")){
				echo"OK4";
			}
		break;
		
	}
}
?>