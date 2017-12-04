<?php
define('INSIDE'  , true);
session_start ();
$v=time()+microtime();
foreach($_POST as $keypost=>$val){$_POST[$keypost] = varcheck($val);}
foreach($_GET as $keyget=>$val){$_GET[$keyget] = varcheck($val);}
foreach($_GET as $keyget=>$val){$_GET[$keyget] = varcheck($val);}
db_open();
$player=player();
// Реклама
$check3 = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `config` WHERE `reklama` LIMIT 1;"));
$time = time();

	if($check3['reklama'] <$time){
	$time2 = time()+1800;
        //mysqli_query($GLOBALS['db_link'],"INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('".time()."','sys','".addslashes("top.frames['chmain'].add_msg('<font class=massm>&nbsp;Полезная информация&nbsp;</font>    <img src=\"/img/image/chat/smiles/smiles_570.gif\">  <font color=000000><b>Возникли проблемы, а помочь некому?Наши консультанты с радостью помогут вам! Для этого зайдите на форум в раздел Жизнь в Мире Легенд /«Тех Поддержка» и отправьте нам сообщение!  </b></font><BR>'+'');")."');");
        //mysqli_query($GLOBALS['db_link'],"INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('".time()."','sys','".addslashes("top.frames['chmain'].add_msg('<font class=massm>&nbsp;Ментор&nbsp;</font>    <img src=\"/img/image/chat/smiles/smiles_656.gif\">  <font color=6600FF><b>Уважаемые игроки! Сотрудники структуры Ментор ответят на ваши вопросы - СТРОГО по игре! Строго в приват!   </b></font><BR>'+'');")."');");
        mysqli_query($GLOBALS['db_link'], "INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('" . time() . "','sys','" . addslashes("top.frames['chmain'].add_msg('<font class=massm>&nbsp;New Курс валюты !&nbsp;</font>     <font color=6600FF><b> 10 <img src=/img/razdor/emerald.png width=14 height=14> <font color=009900><b> = 1 (WMZ) 24 грн (WMU) 24.5 грн (Киевстар) 80 руб (Wmr) usd (wmz,WesternUnion) eur (wme, WesternUnion) 23000 или 2 рубля 3 копейки  (WMB) Быстро и Надежно! Подробнее в инфе(Администрация)   </b></font><BR>'+'');") . "');");
        //mysqli_query($GLOBALS['db_link'],"INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('".time()."','sys','".addslashes("top.frames['chmain'].add_msg('<font class=massm>&nbsp;Официальная группа VK&nbsp;</font>     <font color=FF9900><b>http://vk.com/public76407285   </b></font><BR>'+'');")."');");
        mysqli_query($GLOBALS['db_link'], "INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('" . time() . "','sys','" . addslashes("top.frames['chmain'].add_msg('<font class=massm>&nbsp;Официальный Дилер&nbsp;</font>    <img src=\"/img/image/chat/smiles/smiles_570.gif\">  <font color=000000><b>Пополни свой игровой счёт через мобильный терминал (смс пополнения)(легко и быстро) (МTC,БИЛАЙН,МЕГАФОН) (Россия и Украина) </b></font><BR>'+'');") . "');");
	mysqli_query($GLOBALS['db_link'],"UPDATE `config` SET `reklama`='".$time2."'");
	}

if(date("H") == '05' and date("i") == '11'){
	mysqli_query($GLOBALS['db_link'],"DELETE FROM `podarki` WHERE `srok`<='".time()."';");
	mysqli_query($GLOBALS['db_link'],"DELETE FROM `invent` WHERE `death`<='".time()."' AND `death`>'0';");
	mysqli_query($GLOBALS['db_link'],"DELETE FROM `invent` WHERE `arenda`<'".time()."' AND `arenda`!='0' AND `pl_id`='".$player['id']."';");
  mysqli_query($GLOBALS['db_link'],"DELETE FROM `invent` WHERE `srok`<'".time()."' AND `srok`!='0' AND `pl_id`='".$player['id']."';");
}
// чистка
if(date("H") == '12' and date("i") == '53'){
	mysqli_query($GLOBALS['db_link'],"TRUNCATE `instant`");
	//mysqli_query($GLOBALS['db_link'],"TRUNCATE `chat`");
	mysqli_query($GLOBALS['db_link'],"TRUNCATE `arena`");
	mysqli_query($GLOBALS['db_link'],"TRUNCATE `fight`");
    mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `battle`='0',`fight`='0'");
	mysqli_query($GLOBALS['db_link'],"DELETE FROM `user` WHERE `type`='0'");
}


if(date("H") == '07' and date("i") == '30'){
		$clan = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `clans` WHERE `vote`<'".time()."' AND `vote`>'0';");
		while($row = mysqli_fetch_assoc($clan)){
			$query = mysqli_query($GLOBALS['db_link'],"SELECT `user`.`id` FROM `user` WHERE `clan_id`='".$row['clan_id']."';");
			$win=0;$last=0;
			while($urow = mysqli_fetch_assoc($query)){
				$ucnt=count_vote($urow['id']);
				if($win==0 and $last==0){if($ucnt>0){$win=$urow['id'];$last=$ucnt;}}
				elseif($ucnt>0 and $ucnt>$last){$win=$urow['id'];$last=$ucnt;}
				mysqli_query($GLOBALS['db_link'],"DELTE FROM `clans_vote` WHERE `upoll`='".$urow['id']."'");
			}			
			if($last>0 and $win>0){			
				if(mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT `user`.`id` FROM `user` WHERE `clan_id`='".$row['clan_id']."' AND `clan_status`='9'"))>0){
					mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `clan_status`='0',`clan_accesses`='0|0|0|0' WHERE `clan_id`='".$row['clan_id']."' AND `clan_status`='9';");
				}
				mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET clan_status='9',`clan_accesses`='1|2|4|8' WHERE `clan_id`='".$row['clan_id']."' AND `id`='".$win."' LIMIT 1;");
				mysqli_query($GLOBALS['db_link'],"DELETE * FROM `clans_vote` WHERE `clan_id`='".$row['clan_id']."';");
				mysqli_query($GLOBALS['db_link'],"UPDATE `clans` SET `vote`='0' WHERE `clan_id`='".$row['clan_id']."';");
			}
		}
}

function count_vote($uid){
	$count = mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `clans_vote` WHERE `upoll`='".$uid."'"));
	return $count;
}

mysqli_query($GLOBALS['db_link'],"DELETE FROM `verification` WHERE `vTime` < '".time()."' AND `status` = '1'");

// Аукцион
$Query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `auction_system` WHERE `status`='active' and `time`<'".time()."'");
while( $row = mysqli_fetch_assoc($Query) ){
	if( $row['bet'] != 'none' ){
        mysqli_query($GLOBALS['db_link'], "INSERT INTO `chat` (`time`,`login`,`dlya`,`msg`) VALUES ('" . time() . "','sys','<" . mysqli_result(mysqli_query($GLOBALS['db_link'], "SELECT `login` FROM `user` WHERE `id`='" . $row['userID'] . "'"), 0) . ">','" . addslashes("top.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;Ваш лот был продан за <b>" . ($row['price'] * 0.95) . "</b> .</font><BR>'+'');") . "');");
        mysqli_query($GLOBALS['db_link'], "INSERT INTO `chat` (`time`,`login`,`dlya`,`msg`) VALUES ('" . time() . "','sys','<" . $row['bet'] . ">','" . addslashes("top.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;Курьер вам доставил вещь с аукциона.</font><BR>'+'');") . "');");
		mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `nv`=`nv`+'".($row['price']*0.95)."' WHERE `id`='".$row['userID']."'");
		mysqli_query($GLOBALS['db_link'],"UPDATE `auction_system` SET `status`='finished' WHERE `id`='".$row['id']."'");
		mysqli_query($GLOBALS['db_link'],"UPDATE `invent` SET `auction`='0',`pl_id`='".mysqli_result(mysqli_query($GLOBALS['db_link'],"SELECT `id` FROM `user` WHERE `login`='".$row['bet']."'"),0)."' WHERE `id_item`='".$row['itemID']."'");
		
	}else{
        mysqli_query($GLOBALS['db_link'], "INSERT INTO `chat` (`time`,`login`,`dlya`,`msg`) VALUES ('" . time() . "','sys','<" . mysqli_result(mysqli_query($GLOBALS['db_link'], "SELECT `login` FROM `user` WHERE `id`='" . $row['userID'] . "'"), 0) . ">','" . addslashes("top.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;Курьер вам доставил вещь с аукциона.</font><BR>'+'');") . "');");
		mysqli_query($GLOBALS['db_link'],"UPDATE `auction_system` SET `status`='finished' WHERE `id`='".$row['id']."'");
		mysqli_query($GLOBALS['db_link'],"UPDATE `invent` SET `auction`='0' WHERE `id_item`='".$row['itemID']."'");
	}
}
$sql=mysqli_query($GLOBALS['db_link'],"SELECT user.battle FROM (arena LEFT JOIN user ON arena.id_battle = user.battle)  WHERE  arena.t2+arena.timeout<".time().";");
if(mysqli_num_rows($sql)>0){
    $log = ",[[0,\"" . date("H:i") . "\"],\"<b>Бой закончен по таймауту</b>.\"]";
	$time300=time()+300;
	while ($r = mysqli_fetch_assoc($sql)) {
		mysqli_query($GLOBALS['db_link'],"UPDATE arena SET vis=3 WHERE `id_battle`=".$r['battle'].";");
		mysqli_query($GLOBALS['db_link'],"UPDATE user SET fight=0,battle=0,lastbattle=".$time300." WHERE `battle`=".$r['battle'].";");
	}	
}
//эфекты
$Query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `effects`");
if(mysqli_num_rows($Query)>0){
	while($row = mysqli_fetch_assoc($Query)){
		if($row['time'] <= time() and $row['s_time'] == '0' and $row['s_params'] == ''){
			mysqli_query($GLOBALS['db_link'],"DELETE FROM `effects` WHERE `id`='".$row['id']."'");
		}elseif($row['time'] <= time() and $row['s_time'] != '0'  and $row['s_params'] != ''){
			mysqli_query($GLOBALS['db_link'],"UPDATE `effects` SET `time`='".(time()+$row['s_time'])."',`s_time`='0',`f_params`='".$row['s_params']."',`s_params`='' WHERE `id`='".$row['id']."'");
		}
	}
}
// Таверна
$Query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `tavern_eff` WHERE `updateTime` < '".time()."'");
while($row = mysqli_fetch_assoc($Query)){
	$oldAff = test_affect(mysqli_result(mysqli_query($GLOBALS['db_link'],"SELECT `affect` FROM `user` WHERE `id` = '" . $row['userId'] . "'"),0));
	mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `affect`='" . $oldAff . $row['params'] . "' WHERE `id`='" . $row['userId'] . "'");
	mysqli_query($GLOBALS['db_link'],"DELETE FROM `tavern_eff` WHERE `id`='" . $row['id'] . "'");
	calcstat($row['userId']);
}
// включения  осады
if(date("H") == '20' and date("i") == '00'){
    mysqli_query($GLOBALS['db_link'],"UPDATE `config` SET `osada`='1'");
}
// выключения  осады
if(date("H") == '21' and date("i") == '00'){
    mysqli_query($GLOBALS['db_link'],"UPDATE `config` SET `osada`='0'");
}


?>