<?php
if ($_POST['post_id'] == '1' and in_array($_POST['vcode'], $_SESSION['vcodes'])) {
    $err = 1;
    if ($pers['clan_id'] != 'none') {
        $clsql = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM clans WHERE clan_id='" . $pers['clan_id'] . "';"));
        if (intval($_POST['param']) == 100) {
            if ($clsql['cl_buyup'] >= 10) {
                $sql = "SET cl_up=cl_up+10,cl_buyup=cl_buyup-10 WHERE clan_id='" . $pers['clan_id'] . "' ";
                $err = 0;
                $msg = "<font class=travma style='color:red'><b>Вы удачно приобрели 10 дополнительных клановых усилений.";
                $sum = 125;
            } else {
                $msg = "<font class=travma style='color:red'><b>Вы уже приобрели максимальное количество апов.";
            }
        } else {
            if ($clsql['cl_up'] >= 1) {
                switch (intval($_POST['param'])) {
                    case 1:
                        $sql = "SET cl_sila=cl_sila+1,cl_up=cl_up-1 WHERE clan_id='" . $pers['clan_id'] . "' ";
                        $msg = "<font class=travma style='color:red'><b>Вы удачно приобрели клановое усиление +1 силы.";
                        $err = 0;
                        break;
                    case 2:
                        $sql = "SET cl_lovkost=cl_lovkost+1,cl_up=cl_up-1 WHERE clan_id='" . $pers['clan_id'] . "' ";
                        $msg = "<font class=travma style='color:red'><b>Вы удачно приобрели клановое усиление +1 ловкости.";
                        $err = 0;
                        break;
                    case 3:
                        $sql = "SET cl_ydacha=cl_ydacha+1,cl_up=cl_up-1 WHERE clan_id='" . $pers['clan_id'] . "' ";
                        $msg = "<font class=travma style='color:red'><b>Вы удачно приобрели клановое усиление +1 удачи.";
                        $err = 0;
                        break;
                    case 4:
                        $sql = "SET cl_zdorov=cl_zdorov+1,cl_up=cl_up-1 WHERE clan_id='" . $pers['clan_id'] . "' ";
                        $msg = "<font class=travma style='color:red'><b>Вы удачно приобрели клановое усиление +1 здоровья.";
                        $err = 0;
                        break;
                    case 5:
                        $sql = "SET cl_znan=cl_znan+1,cl_up=cl_up-1 WHERE clan_id='" . $pers['clan_id'] . "' ";
                        $msg = "<font class=travma style='color:red'><b>Вы удачно приобрели клановое усиление +1 знаний.";
                        $err = 0;
                        break;
                    case 6:
                        $sql = "SET cl_hp=cl_hp+25,cl_up=cl_up-1 WHERE clan_id='" . $pers['clan_id'] . "' ";
                        $msg = "<font class=travma style='color:red'><b>Вы удачно приобрели клановое усиление +25 хп.";
                        $err = 0;
                        break;
                    case 7:
                        $sql = "SET cl_mp=cl_mp+10,cl_up=cl_up-1 WHERE clan_id='" . $pers['clan_id'] . "' ";
                        $msg = "<font class=travma style='color:red'><b>Вы удачно приобрели клановое усиление +10 маны.";
                        $err = 0;
                        break;
                }
            } else {
                $msg = "<font class=travma style='color:red'><b>Использованы все доступные очки повышений.";
            }
            $sum = 104 - $clsql['cl_up'] - $clsql['cl_buyup'];
        }

        if ($pers['baks'] < $sum) {
            $err = 1;
            $msg = "<font class=travma style='color:red'><b>Недостаточно денег.";
        }
    }
    if ($err == 0) {
        mysqli_query($GLOBALS['db_link'], "UPDATE clans " . $sql . ";");
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET baks=baks-" . $sum . " WHERE id=" . $pers['id'] . ";");
    }
    return $msg;
}
if ($_POST['post_id'] == '47' and in_array($_POST['vcode'], $_SESSION['vcodes'])) {
    $cuser = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT `id`,`clan_id`,`clan_check`,`login`,`level` FROM `user` WHERE `login`='" . mysqli_real_escape_string($GLOBALS['db_link'], $_POST['fnick']) . "'"));
    $clan = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `clans` WHERE `clan_id` = '" . $pers['clan_id'] . "'"));
    $warn = '0';
    if ($cuser['clan_id'] != 'none') {
        $warn = '1';
    }
    if ($warn == 0) {
        if ($pers['nv'] < 1000) {
            echo "<script>alert('У вас нехватает денег');</script>";
        } else {
            if ($cuser['clan_check'] == 1) {
                mysqli_query($GLOBALS['db_link'], "DELETE FROM `verification` WHERE `uid` = '" . $cuser['id'] . "' LIMIT 1;");
                mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `clan`='" . $clan['clan_name'] . "',`clan_id`='" . $clan['clan_id'] . "',`clan_gif`='" . $clan['clan_gif'] . "',`sklon`='" . $clan['clan_sclon'] . "',`clan_check`=0 WHERE `id`='" . $cuser['id'] . "'");
                event_to_log(date("H:i:s"), 3, 0, $pers['clan_gif'] . ':' . $pers['clan'] . ':' . $pers['clan_d'], $cuser["login"], $cuser["level"], $pers['sklon'], 0);
                mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET nv=nv-1000 WHERE id='" . $pers['id'] . "' LIMIT 1;");
            } else if ($cuser['id'] < 10000) {
                echo "<script>alert('Нельзя принимать в клан Ботов!');</script>";
            } else if ($clan['vote'] > time()) {
                echo "<script>alert('Невозможно изменить состав клана во время перевыборов!');</script>";
            } else {
                echo "<script>alert('Игрок не прошел проверку. Обратитесь к ПВ!');</script>";
            }
        }
    }
}

if ($_POST['post_id'] == '13' and in_array($_POST['vcode'], $_SESSION['vcodes'])) {
    settype($_POST['idit'], "int");
    settype($_POST['idpl'], "int");
    $val_idit = varcheck($_POST['idit']);
    $val_idpl = varcheck($_POST['idpl']);

    $inv = mysqli_query($GLOBALS['db_link'], "SELECT * FROM invent WHERE `id_item`='" . $val_idit . "' AND `pl_id`='" . $val_idpl . "';");
    if (mysqli_num_rows($inv) > 0) {
        mysqli_query($GLOBALS['db_link'], "UPDATE invent SET `used`=0 WHERE `id_item`='" . $val_idit . "' AND `pl_id`='" . $val_idpl . "' LIMIT 1");
        $newid = $_POST['idpl'];
        calcstat($newid);
    }
}

if ($_POST['post_id'] == '14' and in_array($_POST['vcode'], $_SESSION['vcodes'])) {
    settype($_POST['idit'], "int");
    settype($_POST['idpl'], "int");
    settype($_POST['idnewpl'], "int");
    $val_idit = varcheck($_POST['idit']);
    $val_idpl = varcheck($_POST['idpl']);
    $val_idnewpl = varcheck($_POST['idnewpl']);

    $inv = mysqli_query($GLOBALS['db_link'], "SELECT * FROM invent WHERE `id_item`='" . $val_idit . "' AND `pl_id`='" . $val_idpl . "';");
    if (mysqli_num_rows($inv) > 0 and $pers['id'] == $_POST['idnewpl']) {
        mysqli_query($GLOBALS['db_link'], "UPDATE invent SET `used`=0,pl_id='" . $val_idnewpl . "' WHERE `id_item`='" . $val_idit . "' AND `pl_id`='" . $val_idpl . "' LIMIT 1");
        mysqli_query($GLOBALS['db_link'], "UPDATE clan_kazna SET pl_id='" . $val_idnewpl . "' WHERE `id_item`='" . $val_idit . "' AND `pl_id`='" . $val_idpl . "' LIMIT 1");
        $msg = "Вы забрали вещь себе!";
        $newid = $_POST['idpl'];
        calcstat($newid);
        return $msg;
    }
}
if ($_POST['post_id'] == '15' and in_array($_POST['vcode'], $_SESSION['vcodes'])) {
    settype($_POST['idit'], "int");
    settype($_POST['idpl'], "int");
    settype($_POST['idnewpl'], "int");
    $val_idit = varcheck($_POST['idit']);
    $val_idpl = varcheck($_POST['idpl']);
    $val_idnewpl = varcheck($_POST['idnewpl']);
    $inv = mysqli_query($GLOBALS['db_link'], "SELECT * FROM invent WHERE `id_item`='" . $val_idit . "' AND `pl_id`='" . $val_idpl . "';");
    if (mysqli_num_rows($inv) > 0 and $pers['id'] == $_POST['idnewpl']) {
        mysqli_query($GLOBALS['db_link'], "UPDATE invent SET `used`=0,pl_id='" . $val_idnewpl . "',clan=0 WHERE `id_item`='" . $val_idit . "' AND `pl_id`='" . $val_idpl . "' LIMIT 1");
        mysqli_query($GLOBALS['db_link'], "DELETE FROM clan_kazna WHERE `id_item`='" . $val_idit . "' LIMIT 1");
        $msg = "Вы удалили вещь из казны!";
        $newid = $_POST['idpl'];
        calcstat($newid);
        return $msg;
    }
}
if ($_POST['post_id'] == '16') {
    $msg = '';
    if (empty($_POST['doc_title'])) {
        $msg = 'Неверно указано название документа';
    }
    if (empty($_POST['doc_subj']) or !empty($msg)) {
        $msg = 'Неверно указано содержание документа';
    }
    if (empty($msg) and $pers['clan_status'] == '9') {
        include(DROOT . "/gameplay/inc/bbcodes.inc.php");
        mysqli_query($GLOBALS['db_link'], "INSERT INTO `clan_documents` (`clan_id`, `date`, `title`, `msg`) VALUES ('" . $pers['clan_id'] . "', '" . time() . "', '" . mysqli_real_escape_string($GLOBALS['db_link'], $_POST['doc_title']) . "', '" . bbCodes($_POST['doc_subj'], 1) . "');");
    }
}
if ($_POST['post_id'] == '28' and in_array($_POST['vcode'], $_SESSION['vcodes'])) {
    $VoteUser = GetUserFID(intval($_POST['nums']), 1);
    if ($VoteUser['clan_id'] == $pers['clan_id']) {
        mysqli_query($GLOBALS['db_link'], "INSERT INTO `clans_vote` (`userid`,`upoll`,`clan_id`) VALUES ('" . $pers['id'] . "','" . $VoteUser['id'] . "','" . $pers['clan_id'] . "');");
    }
}