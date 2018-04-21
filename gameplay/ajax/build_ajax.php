<?php

include($_SERVER["DOCUMENT_ROOT"] . "/app/system/config.php");
include(DROOT . "/includes/functions.php");

$pers = GetUser();

function UserInfo($uid)
{
    $user = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'], "SELECT `login`,`level`,`sklon`,`clan`,`clan_d`,`clan_gif` FROM `user` WHERE `id`='" . $uid . "'"));
    return '["user","' . $user['login'] . '",' . $user['level'] . ',' . $user['sklon'] . ',"' . (($user['clan_gif'] == 'chaos.gif') ? '' : $user['clan_gif']) . '","' . $user['clan'] . '","' . (($user['clan_d'] == 'chaos.gif') ? '' : $user['clan_gif']) . '"]';
}

function ClanInfo($cid)
{
    $clan = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'], "SELECT `clan_sclon`,`clan_gif`,`clan_name` FROM `clans` WHERE `clan_id`='" . $cid . "'"));
    return '["clan","' . $clan['clan_sclon'] . '","' . $clan['clan_gif'] . '","' . $clan['clan_name'] . '"]';
}

$query = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `buildings` WHERE `pos` = '" . $pers['pos'] . "'");
if (mysqli_num_rows($query) > 0) {
    switch ($_GET['act']) {
        case '1':
            echo 'BD@[""]@[0,[';
            $buildings = '';
            while ($row = mysqli_fetch_array($query)) {
                $buildings .= '[' . $row['id'] . ',"' . $row['text'] . '",' . (($row['cid'] != 'none') ? ClanInfo($row['cid']) : UserInfo($row['uid'])) . ',"' . $row['zp'] . '"],';
            }
            echo substr($buildings, 0, strlen($buildings) - 1);
            echo '],"' . vCode() . '"]';
            break;
        case '2':
            $buildings = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `buildings` WHERE `pos` = '" . $pers['pos'] . "' AND `id`='" . intval($_GET['id']) . "'"));
            $Resources = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `buildings_resources` WHERE `bid`='" . $buildings['id'] . "' AND `resType`='made'"));
            echo 'BD@[""]@[1,[' . $buildings['id'] . ',"' . $buildings['text'] . '",' . (($buildings['cid'] != 'none') ? ClanInfo($buildings['cid']) : UserInfo($buildings['uid'])) . ',"' . $buildings['zp'] . '","' . $buildings['balance'] . '","' . $buildings['jobs'] . '",[';
            $users = '';
            $query = mysqli_query($GLOBALS['db_link'], "SELECT `login`,`level`,`sklon`,`clan`,`clan_d`,`clan_gif` FROM `user` WHERE `ProTime` > '" . time() . "' AND `ProBuild`='" . $buildings['id'] . "'");
            while ($row = mysqli_fetch_assoc($query)) {
                $users .= '["","' . $row['login'] . '",' . $row['level'] . ',' . $row['sklon'] . ',"' . (($row['clan_gif'] == 'chaos.gif') ? '' : $row['clan_gif']) . '","' . $row['clan'] . '","' . (($row['clan_d'] == 'chaos.gif') ? '' : $row['clan_gif']) . '"],';
            }
            echo substr($users, 0, strlen($users) - 1);
            echo '],["' . $Resources['res_name'] . '",' . $Resources['count_hour'] . ',' . $Resources['count'] . ',"' . $Resources['mass'] . '","' . $Resources['price'] . '","' . ((intval($pers['nv'] / $Resources['price']) > $Resources['count']) ? $Resources['count'] : intval($pers['nv'] / $Resources['price'])) . '","' . $Resources['res_id'] . '"],[';
            $Resources = '';
            $query = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `buildings_resources` WHERE `bid`='" . $buildings['id'] . "' AND `resType`='need'");
            while ($row = mysqli_fetch_assoc($query)) {
                $Resources .= '["' . $row['res_name'] . '",' . $row['count_hour'] . ',' . $row['count'] . ',' . $row['buy_count'] . ',' . $row['buy_price'] . ',"",""],';
            }
            echo substr($Resources, 0, strlen($Resources) - 1);
            echo ']],"' . vCode() . '"]';
            break;
        case '3':
            $Error = 0;

            $buildings = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `buildings` WHERE `pos` = '" . $pers['pos'] . "' AND `id`='" . intval($_GET['bid']) . "'"));

            if (!isset($_SESSION['captcha_keystring']) or $_SESSION['captcha_keystring'] != $_GET['code']) {
                echo 'BD@["Не верно введён проверочный код."]@[0]';
                $Error = 1;
            }
            unset($_SESSION['captcha_keystring']);
            if ($Error == 0 and $pers['ProTime'] > time()) {
                echo 'BD@["Вы еще не отработали в предыдущем месте."]@[0]';
                $Error = 1;
            }
            if ($Error == 0 and empty($buildings)) {
                echo 'BD@["Нет такого здания на этой локации."]@[0]';
                $Error = 1;
            }
            if ($Error == 0 and mysqli_num_rows(mysqli_query($GLOBALS['db_link'], "SELECT `id` FROM `user` WHERE `ProTime` > '" . time() . "' AND `ProBuild`='" . $buildings['id'] . "'")) >= $buildings['jobs']) {
                echo 'BD@["Все рабочие места заняты."]@[0]';
                $Error = 1;
            }
            if ($Error == 0) {
                echo 'BD@["Вы успешно устроились на работу."]@[0]';
                mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `ProTime`='" . (time() + 3600) . "',`ProBuild`='" . $buildings['id'] . "' WHERE `id`='" . $pers['id'] . "'");
                chmsg("<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Системная информация</font></b>:</font>&nbspВы удачно устроились на работу, з.п. вы получите сразу по окончанию работы.</font>", $pers['login']);
            }

            break;
        case '4':
            $Error = 0;

            $buildings = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `buildings` WHERE `pos` = '" . $pers['pos'] . "' AND `id`='" . intval($_GET['bid']) . "'"));
            $Resources = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `buildings_resources` WHERE `bid`='" . $buildings['id'] . "' AND `res_id`='" . intval($_GET['br']) . "'"));

            $_GET['ba'] = (($_GET['ba'] > 0) ? intval($_GET['ba']) : 1);

            if ($_GET['ba'] > ((intval($pers['nv'] / $Resources['price']) > $Resources['count']) ? $Resources['count'] : intval($pers['nv'] / $Resources['price']))) {
                $_GET['ba'] = ((intval($pers['nv'] / $Resources['price']) > $Resources['count']) ? $Resources['count'] : intval($pers['nv'] / $Resources['price']));
            }
            if ($Resources['count'] < 1) {
                echo 'BD@["Недостаточно ресурсов на складе."]@[0]';
                $Error = 1;
            }
            if ($Error == 0) {
                echo 'BD@["Покупка прошла удачно."]@[0]';
                if (mysqli_num_rows(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `invent_resources` WHERE `user_id`='" . $pers['id'] . "' and `res_id`='" . $Resources['res_id'] . "'")) > 0) {
                    mysqli_query($GLOBALS['db_link'], "UPDATE `invent_resources` SET `count`=`count`+'" . $_GET['ba'] . "' WHERE `user_id`='" . $pers['id'] . "' and `res_id`='" . $Resources['res_id'] . "'");
                } else {
                    mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent_resources` (`user_id`,`res_id`,`count`) VALUES ('" . $pers['id'] . "','" . $Resources['res_id'] . "','" . $_GET['ba'] . "');");
                }
                mysqli_query($GLOBALS['db_link'], "UPDATE `buildings_resources` SET `count`=`count`-'" . $_GET['ba'] . "' WHERE `bid`='" . $buildings['id'] . "' AND `res_id`='" . $Resources['res_id'] . "'");
                mysqli_query($GLOBALS['db_link'], "UPDATE `buildings` SET `balance`=`balance`+'" . ($_GET['ba'] * $Resources['price']) . "' WHERE `id`='" . $buildings['id'] . "'");
                mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `nv`=`nv`-'" . ($_GET['ba'] * $Resources['price']) . "' WHERE `id`='" . $pers['id'] . "'");
                chmsg("<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Системная информация</font></b>:</font>&nbspВы успешно купили <b>" . $_GET['ba'] . "</b> ед. &quot;<b>" . $Resources['res_name'] . "</b>&quot; за <b>" . ($_GET['ba'] * $Resources['price']) . "</b> RB.</font>", $pers['login']);
            }

            break;
    }
} else {
    echo 'BD@["Построек ещё нет."]@[0]';
}

