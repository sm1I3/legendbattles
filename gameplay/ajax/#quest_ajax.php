<?php
header('Content-type: text/html; charset=UTF-8');
session_start();
include($_SERVER["DOCUMENT_ROOT"]."/includes/config.inc.php");
include($_SERVER["DOCUMENT_ROOT"]."/includes/functions.php");

$pers = GetUser($user['login']);

list($pers['x'], $pers['y']) = explode('_', $pers['pos']);

$ShowQuestDialog = 0;

$Query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `quests` WHERE `loc`='".$pers['loc']."' AND `x`='".$pers['x']."' AND `y`='".$pers['y']."' AND `level_max`>='".$pers['level']."' AND `level_min`<='".$pers['level']."'");
$EndQuests = mysqli_query($GLOBALS['db_link'],"SELECT `quest_completed`.*,  `quests`.* FROM `quests` INNER JOIN `quest_completed` ON `quests`.`id` = `quest_completed`.`que_id` WHERE `quest_completed`.`usr_id`='".$pers['id']."' AND `quest_completed`.`que_st`>'0' AND `quests`.`loc`='".$pers['loc']."' AND `quests`.`x`='".$pers['x']."' AND `quests`.`y`='".$pers['y']."' AND `quests`.`level_max`>='".$pers['level']."' AND `quests`.`level_min`<='".$pers['level']."'");

if(mysqli_num_rows($Query) == mysqli_num_rows($EndQuests)){
    exit('QUEST@["Здравствуй ' . $pers['login'] . ', для Вас сейчас нет никаких поручений."]@["",[0,"",]]');
}

if(empty($_GET['qid'])){
	while($row = mysqli_fetch_assoc($Query)){
		$QuestStepOne = true;
		include($_SERVER["DOCUMENT_ROOT"]."/includes/quests/quest-".$row['id'].".php");
		$Quest = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `quest_completed` WHERE `que_id`='".$row['id']."' AND `usr_id`='".$pers['id']."' AND `que_st` = '0'"));
		echo'QUEST@['.(($Quest)?$Quest_Yes:$Quest_No).']@["'.$row['face'].'",['.(($Quest)?2:1).',"'.vCode().'",'.$row['id'].']]';
	}
}else{
	switch($_GET['act']){
		case'1':
			$GetQuest = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `quests` WHERE `loc`='".$pers['loc']."' AND `x`='".$pers['x']."' AND `y`='".$pers['y']."' AND `id`='".intval($_GET['qid'])."'"));
			if(!empty($GetQuest)){
				$StatusQuest = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `quest_completed` WHERE `usr_id`='".$pers['id']."' AND `que_id`='".$GetQuest['id']."' AND `que_st` = '0'"));
				if(empty($StatusQuest)){
					$QuestStepTwo = true;
					include($_SERVER["DOCUMENT_ROOT"]."/includes/quests/quest-".$GetQuest['id'].".php");
					mysqli_query($GLOBALS['db_link'],"INSERT INTO `quest_completed` (`usr_id`,`que_id`,`que_time_start`,`que_time_finish`,`que_query`,`que_name`,`que_desc`,`que_face`) VALUES ('".$pers['id']."','".$GetQuest['id']."','".time()."','".(time()+$GetQuest['time'])."','".$Need."','".$Quest_Name."','".$Quest_Desc."','".$GetQuest['face']."');");
					echo'QUEST@['.$Quest_Get.']@["'.$GetQuest['face'].'",[0,"",'.$GetQuest['id'].']]';
				}else{
					echo'ERR';
				}
			}
		break;
		case'2':
			$GetQuest = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `quests` WHERE `loc`='".$pers['loc']."' AND `x`='".$pers['x']."' AND `y`='".$pers['y']."' AND `id`='".intval($_GET['qid'])."'"));
			if(!empty($GetQuest)){
				$StatusQuest = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `quest_completed` WHERE `usr_id`='".$pers['id']."' AND `que_id`='".$GetQuest['id']."' AND `que_st` = '0'"));
				if(!empty($StatusQuest)){
					include($_SERVER["DOCUMENT_ROOT"]."/includes/quests/quest-".$GetQuest['id'].".php");
					$Items = explode("@",$StatusQuest['que_query']);
					$NumsQuest = 0;$NumsInvent = 0;$MoneyError = 0;
					for($i=0;$i<count($Items);$i++){
						$ItemNeed = explode(";",$Items[$i]);
						switch($ItemNeed[0]){
							case'money_nv':
								$GetMoney = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `nv` FROM `user` WHERE `id`='".$pers['id']."' LIMIT 1;"));
								if($GetMoney['nv'] < $ItemNeed[1]){
									$MoneyError = 1;
								}
								$NumsQuest += $ItemNeed[1];
								$NumsInvent += $ItemNeed[1];
							break;
							case'money_dd':
								$GetMoney = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `dd` FROM `user` WHERE `id`='".$pers['id']."' LIMIT 1;"));
								if($GetMoney['dd'] < $ItemNeed[1]){
									$MoneyError = 1;
								}
								$NumsQuest += $ItemNeed[1];
								$NumsInvent += $ItemNeed[1];
							break;
							case'money_baks':
								$GetMoney = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `baks` FROM `user` WHERE `id`='".$pers['id']."' LIMIT 1;"));
								if($GetMoney['baks'] < $ItemNeed[1]){
									$MoneyError = 1;
								}
								$NumsQuest += $ItemNeed[1];
								$NumsInvent += $ItemNeed[1];
							break;
							default:
								$NumsQuest += $ItemNeed[1];
								$NumsInvent += mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `invent` WHERE `pl_id`='".$pers['id']."' AND `protype`='".$ItemNeed[0]."' AND `used`='0' AND `clan`='0' AND `gift_from`='' LIMIT ".$ItemNeed[1].""));
							break;
						}
					}
					if($NumsQuest == $NumsInvent and $MoneyError == 0){
						echo'QUEST@['.$Quest_Status_ok.']@["'.$StatusQuest['que_face'].'",[0,"",'.$StatusQuest['que_id'].']]@';

                        // Выдаем призы збираем вещи
						for($i=0;$i<count($Items);$i++){
							$ItemNeed = explode(";",$Items[$i]);
							mysqli_query($GLOBALS['db_link'],"DELETE FROM `invent` WHERE `pl_id`='".$pers['id']."' AND `protype`='".$ItemNeed[0]."' AND `used`='0' AND `clan`='0' AND `gift_from`='' LIMIT ".$ItemNeed[1]."");
						}
						$exp = explode("|",$pers['exp']);
						$QuestStepThree = true;
						include($_SERVER["DOCUMENT_ROOT"]."/includes/quests/quest-".$GetQuest['id'].".php");
                        //Закончили с призами
						exit;
					}elseif($NumsQuest != $NumsInvent or $MoneyError == 1){
						echo'QUEST@['.$Quest_Status_err.']@["'.$StatusQuest['que_face'].'",[0,"",'.$StatusQuest['que_id'].']]@';
					}
				}else{
					echo'ERR';
				}
			}
		break;
	}
}