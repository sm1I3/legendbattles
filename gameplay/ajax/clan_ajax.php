<?php
#GLOBALS OFF
header('Content-type: text/html; charset=UTF-8');
include($_SERVER["DOCUMENT_ROOT"] . "/app/system/config.php");
include($_SERVER["DOCUMENT_ROOT"] . "/includes/functions.php");

$pers = GetUser($_SESSION['user']['login']);
switch ($_GET['act']) {
    case'get':
        if (!in_array($_GET['vcode'], $_SESSION['vcodes'])) {
            exit("ERR@4");
        }
        $access = explode("|", $pers['clan_accesses']);
        if (!in_array('4', $access)) {
            exit("ERR@3");
        }
        $plid = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT `id`,`clan_d`,`clan_accesses`,`clan_status` FROM `user` WHERE `id`='" . intval($_GET['plid']) . "' AND `clan_id`='" . $pers['clan_id'] . "';"));
        if (empty($plid['id'])) {
            exit("ERR@2");
        }
        if ($plid['clan_status'] != '0') {
            exit("ERR@1");
        }
        $placcess = explode("|", $plid['clan_accesses']);
        echo "OK@" . $plid['id'] . "|" . $plid['clan_d'] . "|" . (in_array('1', $placcess) ? '1' : '0') . "|" . (in_array('2', $placcess) ? '1' : '0') . "|" . (in_array('4', $placcess) ? '1' : '0') . "|" . (in_array('8', $placcess) ? '1' : '0');
        break;
    case'edit':
        $access = explode("|", $pers['clan_accesses']);
        if (!in_array('4', $access)) {
            exit("ERR@3");
        }
        $plid = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT `id`,`clan_status` FROM `user` WHERE `id`='" . intval($_GET['plid']) . "' AND `clan_id`='" . $pers['clan_id'] . "';"));
        if (empty($plid['id'])) {
            exit("ERR@2");
        }
        if ($plid['clan_status'] != '0') {
            exit("ERR@1");
        }
//		$clan_accesses = ($_GET['access_1']?'1':'0').'|'.($_GET['access_2']?'2':'0').'|'.($_GET['access_3']?'4':'0').'|'.($_GET['access_4']?'8':'0');
        mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `clan_d`='" . htmlspecialchars($_GET['clan_d']) . "',`clan_accesses`='" . ($_GET['access_1'] ? '1' : '0') . '|' . ($_GET['access_2'] ? '2' : '0') . '|' . ($_GET['access_3'] ? '4' : '0') . '|' . ($_GET['access_4'] ? '8' : '0') . "' WHERE `id`='" . $plid['id'] . "'");
        break;
}
