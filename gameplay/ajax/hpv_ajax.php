<?php
#GLOBALS OFF
header('Content-type: text/html; charset=windows-1251');
session_start();
include($_SERVER["DOCUMENT_ROOT"]."/includes/config.inc.php");
include(DROOT."/includes/functions.php");
foreach($_POST as $keypost=>$valp){
	$valp = varcheck($valp);
	$_POST[$keypost] = $valp;
}
foreach($_GET as $keyget=>$valg){
	$valg = varcheck($valg);
	$_GET[$keyget] = $valg;

}

$pers = GetUser($_SESSION['user']['login']);

//Functions
function locations($loc,$pos){
	if($loc != '28'){
		$location = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `loc`,`room`,`city` FROM `loc` WHERE `id`='".$loc."' LIMIT 1;"));
	}elseif($loc == '28'){
		$pos = explode('_', $pos);
		$location = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `city`,`name` FROM `nature` WHERE `x`='".$pos[0]."' AND `y`='".$pos[1]."' LIMIT 1;"));
		$location['room'] = $location['name'];
	}
	return $location['city']." [".(($location['room'])?$location['room']:$location['loc'])."]";
}
//End Functions

$access = explode("|",$pers['clan_accesses']);

switch($_GET['act']){
	case'Sign':
		$ShowResult = 'ClanList';
        $query = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `user` WHERE `clan_id`='Служители порядка' ORDER BY `level` DESC");
		if(mysqli_num_rows($query)>0){
			while ($row = mysqli_fetch_assoc($query)) {
				$ShowResult .= '@'.(($row['last']>time()-300)?'1':'0').';'.preg_replace("/@/","[a_GuildHonor_t]",$row['login']).';'.$row['level'].';'.$row['clan_gif'].';'.$row['clan_status'].';'.$row['clan_d'].';'.(($row['last']>time()-300)?locations($row["loc"],$row["pos"]):'').';'.$row['id'];
			}
		}
	break;
	case'Verif':
		$ShowResult = 'VerifUsers';
		$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM  `verification` WHERE `status`!='1'".(($_GET['type']=='1')?" AND `type`='1'":(($_GET['type']=='2')?" AND `type`='2'":" AND `type`='0'"))." ORDER BY `id` ASC");
		if(mysqli_num_rows($query)>0){
			while ($row = mysqli_fetch_assoc($query)) {
				$UseR = GetUserFID($row['uid'],1);
				$ShowResult .= '@'.$UseR['login'].';'.$UseR['level'].';'.$row['status'];
			}
		}
	break;
	case'GoOut':
	if(in_array('8',$access)){
		$ShowResult = 'GoOut';
		$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `id` = '".intval($_GET['uid'])."'");
		if(mysqli_num_rows($query)>0){
			$row = mysqli_fetch_assoc($query);
            if ($row['clan_id'] == 'Служители порядка') {
				if(mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `clan`='0',`clan_id`='none',`clan_d`='',`clan_gif`='',`clan_accesses`='0',`clan_status`='0' WHERE `id`='".$row['id']."'")){
					mysqli_query($GLOBALS['db_link'],"DELETE FROM `accesses` WHERE `uid` = '".$row['id']."'");
					$ShowResult .= '@OK';
				}
			}
		}
	}
	break;
	case'EditUser':
	if(in_array('4',$access)){
		$ShowResult = 'EditUser';
		$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `id` = '".intval($_GET['uid'])."'");
		if(mysqli_num_rows($query)>0){
			$row = mysqli_fetch_assoc($query);
            if ($row['clan_id'] == 'Служители порядка') {
				$placcess = explode("|",accesses($row['id'],'pvu',1));
				$ShowResult .= "@".$row['id']."|".$row['clan_d']."|".$row['clan_gif']."|".(in_array('1',$placcess)?'1':'0')."|".(in_array('2',$placcess)?'1':'0')."|".(in_array('4',$placcess)?'1':'0')."|".(in_array('16',$placcess)?'1':'0');
			}
		}
	}
	break;
	case'SubmitForm':
		switch($_GET['sub']){
			case'1':
				if(in_array('8',$access)){
					$_GET['fnick'] = htmlspecialchars($_GET['fnick']);
					$val_fnick=varcheck($_GET['fnick']);
					$cuser = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `id`,`clan_id` FROM `user` WHERE `login`='".$val_fnick."'"));
					$clan = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `clans` WHERE `clan_id` = '".$pers['clan_id']."'"));
					if(!empty($cuser['id'])){
						$ShowResult = 'SubmitForm@1';
                        mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `clan`='" . $clan['clan_name'] . "',`clan_id`='" . $clan['clan_id'] . "',`clan_gif`='" . $clan['clan_gif'] . "',`sklon`='" . $clan['clan_sclon'] . "',`clan_d`='Стажёр' WHERE `id`='" . $cuser['id'] . "'");
						mysqli_query($GLOBALS['db_link'],"INSERT INTO `accesses` (`uid`, `pvu`) VALUES ('".$cuser['id']."', '1');");
					}
				}
			break;
			case'2';
				if(in_array('4',$access)){
					$ShowResult = 'SubmitForm@2';
					$GetUser = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `id` = '".intval($_GET['plid'])."'"));
                    if ($GetUser['clan_id'] == 'Служители порядка') {
					$val_section=varcheck($_GET['section']);
					$val_clan_d=varcheck($_GET['clan_d']);
						mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `clan_gif`='".$val_section."',`clan_d`='".$val_clan_d."' WHERE `id`='".$GetUser['id']."'");
						$ClanPVU = '';
						for($i=1;$i<=16;$i++){
							$ClanPVU .= (($_GET['access_'.$i])?$i.'|':'');
						}
						mysqli_query($GLOBALS['db_link'],"UPDATE `accesses` SET `pvu`='".substr($ClanPVU,0,strlen($s)-1)."' WHERE `uid`='".$GetUser['id']."'");
					}
				}
			break;
		}
	break;
}
echo $ShowResult;
?>