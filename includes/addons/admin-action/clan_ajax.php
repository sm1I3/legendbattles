<?php
#GLOBALS OFF
header('Content-type: text/html; charset=utf-8');
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
switch($_GET['act']){
	case'get':
		$plid = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `id`='".intval($_GET['plid'])."';"));
        if ($pers['login'] == 'mozg' or $pers['login'] == 'Администрация') {
			$placcess = explode("|",$plid['clan_accesses']);
			echo"OK@".$plid['id']."|".$plid['clan_d']."|".(in_array('1',$placcess)?'1':'0')."|".(in_array('2',$placcess)?'1':'0')."|".(in_array('4',$placcess)?'1':'0')."|".(in_array('8',$placcess)?'1':'0')."|".$plid['clan_status'];
		}
	break;
	case'edit':
		$plid = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `id`,`clan_status` FROM `user` WHERE `id`='".intval($_GET['plid'])."';"));
		if(empty($plid['id'])){
			exit("ERR@2");
		}
//		$clan_accesses = ($_GET['access_1']?'1':'0').'|'.($_GET['access_2']?'2':'0').'|'.($_GET['access_3']?'4':'0').'|'.($_GET['access_4']?'8':'0');
		mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `clan_status`='".intval($_GET['clan_status'])."',`clan_d`='".htmlspecialchars($_GET['clan_d'])."',`clan_accesses`='".($_GET['access_1']?'1':'0').'|'.($_GET['access_2']?'2':'0').'|'.($_GET['access_3']?'4':'0').'|'.($_GET['access_4']?'8':'0')."' WHERE `id`='".$plid['id']."'");
	break;
	case 'additem':
        $_GET['clanname'] = iconv("UTF-8", "utf-8", urldecode($_GET['clanname']));
        $_GET['itemname'] = iconv("UTF-8", "utf-8", urldecode($_GET['itemname']));
		$glava = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `clan_id`='".mysqli_real_escape_string($GLOBALS['db_link'],$_GET['clanname'])."' AND `clan_status`='9' LIMIT 1;"));
		if($glava['id']){
			$it=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM items WHERE id='".intval($_GET['idit'])."';"));
			if($it['id']){
				if($it['dd_price']>0){$pr=$it['dd_price'];$filt="`dd_price`";}
				else{$pr=$it['price'];$filt="`price`";}
				$par=explode("|",$it['param']);
				foreach ($par as $value) {
					$stat=explode("@",$value);
					switch($stat[0]){case 2: $dolg=$stat[1];break;}
				}
				mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype`,`pl_id`,`dolg`,$filt) VALUES ('".$it['id']."','".$glava['id']."','".$dolg."','".$pr."');");
				$invit = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `invent` WHERE `id_item`='".mysqli_insert_id($GLOBALS['db_link'])."' LIMIT 1;"));
				if($invit['id_item']){
					mysqli_query($GLOBALS['db_link'],"INSERT INTO `clan_kazna` (`id_item`,`protype`,`pl_id`,`clan_id`) VALUES ('".$invit['id_item']."','".$invit['protype']."','".$glava['id']."','".$glava['clan_id']."')");
					mysqli_query($GLOBALS['db_link'],"UPDATE `invent` SET `gift`='1',`gift_from`='Lifeiswar.ru',`clan`='1' WHERE `pl_id`='".$glava['id']."' AND `id_item`='".$invit['id_item']."';");
                    echo '<br>Вещь успешно добавлена в клан: <b>' . $glava['clan_id'] . '</b>';
                    echo '<br>Лидеру клана: <b>' . $glava['login'] . '</b>';
                    echo '<br>Имя вещи: <b>' . $it['name'] . '</b>';
                } else {
                    echo '<br>FAIL 3 - написать mozg';
                }
            } else {
                echo '<br>Не найдена вещь: ' . $_GET['itemname'];
            }
        } else {
            echo '<br>Не найден глава клана: ' . $_GET['clanname'];
        }
	break;
}







?>