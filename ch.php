<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/app/system/config.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/sql_func.php");

$textstr = $_POST['text'];
$text = $textstr;
if (isset($_GET['ch_mode'])) {
    switch (intval($_GET['ch_mode'])) {
        case 0:
            $_SESSION['chat']['mode'] = 0;
            break;
        case 1:
            $_SESSION['chat']['mode'] = 1;
            break;
        case 2:
            $_SESSION['chat']['mode'] = 2;
            break;
        case 3:
            $_SESSION['chat']['mode'] = 3;
            break;
        default:
            $_SESSION['chat']['mode'] = 0;
            break;
    }
}
switch ($_SESSION['chat']['mode']) {
    case 0:
        $ch_mode = 0;
        break;
    case 1:
        $ch_mode = 1;
        break;
    case 2:
        $ch_mode = 2;
        break;
    case 3:
        $ch_mode = 3;
        break; //Системный
    default:
        $ch_mode = 0;
        break;
}
$a = $a ?? varcheck($_POST['a']) ?? varcheck($_GET['a']) ?? '';
if ($a == "ign") {
    $u = $u ?? varcheck($_POST['u']) ?? varcheck($_GET['u']) ?? '';
    if ($u != $_SESSION['user']['login']) {
        if ($s == 0) ignor_rem($u);
        if ($s == 1) ignor_add($u);
    }
}
$player = player();

//Functions


function is_mat($m)
{
    global $player;
    $m = " " . strtolower(trim($m)) . " ";
    $mat = array('бля', 'пизд', 'fuck', 'сука', 'хуё', 'хуе', 'еба', 'ёба', 'бляд', 'лох', 'чмо', 'чёрт', 'мудак', 'уёбок', 'долбаёб', 'далбаеб', 'блят', 'блять');
    $a = explode(" ", $m);
    for ($i = 0; $i <= 18; $i++)// количество
        foreach ($a as $m) {
            if ($m) {
                $m = " " . $m . " ";
                if ((
                substr_count($m, $mat[$i])
                )
                ) return true;
            }
        }
    return false;
}

function is_rvs($m)
{
    global $player;
    $m = strtolower(trim($m));
    $rvs = array('http:', '.com', '.com.ua', 'рф', '.ru', '.by', '.org', '.ua', '.net', '.su', 'legbk', 'wow', 'old-combats', 'last-worlds', 'dark-lands', 'battleera', 'other-lands', 'alnoworld', 'antialoneislands', 'bkwar', 'qps', 'wonder-lands');
    $m = str_replace("/", "", $m);
    $a = explode(" ", $m);
    for ($i = 0; $i <= 22; $i++)// количество
        foreach ($a as $m) {
            $m = " " . $m . " ";
            if (substr_count($m, $rvs[$i])
                and !substr_count($m, "legendbattles.ru")
                and !substr_count($m, "forum.legendbattles.ru")
                and !substr_count($m, "radikal.ru")
                and !substr_count($m, "vk.com")
                and !substr_count($m, "odnoklassniki.ru")
                and !substr_count($m, "mail.ru")
            ) return true;
        }
    return false;
}


function is_rkp($m)
{
    global $player;
    $m = strtolower(trim($m));
    $rkp = array('escilon', 'chaosroad', 'neverlands', 'ereality', 'lastworlds', 'legendworld', 'legbk', 'neolands', 'l e g e n d w o r l d', 'windland', 'darktimes', 'vayworld', 'alinar', 'dark-lands', 'guild-honor', 'genesyx', 'world-chaos', 'dwar');
    $m = str_replace("/", "", $m);
    $a = explode(" ", $m);
    for ($i = 0; $i <= 18; $i++)// количество
        foreach ($a as $m) {
            $m = " " . $m . " ";
            if (substr_count($m, $rkp[$i])
                and !substr_count($m, "legendbattles.ru")
                and !substr_count($m, "forum.legendbattles.ru")
            ) return true;
        }
    return false;
}

//End Functions

if ($player['block'] != '' or $_SESSION['user']['login'] == '') {
    if ($player['block']) {
        exit("<script>parent.location='index.php?act=logout';</script>");
    }
    exit("<script>parent.location='error.php';</script>");
}

if (isset($_GET['lo'])) {
    $FiltsList = array('a_z', 'z_a', '0_35', '35_0');
    if (in_array($_GET['order'], $FiltsList)) {
        $_SESSION['user']['filt'] = $_GET['order'];
    }
    if (!isset($_SESSION['user']['filt'])) {
        $_SESSION['user']['filt'] = $player['filt'];
    } else {
        $player['filt'] = $_SESSION['user']['filt'];
    }

    ?>
    <html>
<head>
    <LINK href="/ch/list.css?v4" rel=STYLESHEET type=text/css>
    <meta content="text/html; charset=utf-8" http-equiv=Content-type>
    <META Http-Equiv=Cache-Control Content=no-cache>
    <meta http-equiv=PRAGMA content=NO-CACHE>
    <META Http-Equiv=Expires Content=0>
</HEAD>
<script LANGUAGE="JavaScript" src='/js/jquery-1.7.2.min.js'></script>
<script type="text/javascript" src="/js/jquery.smodal.js"></script>
<SCRIPT LANGUAGE="JavaScript" src='/ch/ch_list.js?v4'></SCRIPT>
<body bgcolor=#FCFAF3 mardginheight=0 topmardgin=0 topmargin=0 marginheight=0 onscroll="parent.save_scroll_p()"
      onLoad="document.body.scrollTop=parent.OnlineScrollPosition">
<table border=0 cellpadding=0 cellspacing=0 width=100%>
    <tr>
        <td height="56" align="center" valign="middle"><?
            $r = $r ?? varcheck($_POST['r']) ?? varcheck($_GET['r']) ?? '';
            if ($r) {
                $player['loc'] = $r;
            }
            $on_room = locations($player["loc"], $player["pos"]); ?></td>
    </tr>
    <tr>
        <td><img src="/img/image/1x1.gif" width="1" height="5"></td>
    </tr>
    <tr>
        <td align="center" valign="middle">Авто:
            <script>
                document.write('<input type=checkbox onclick="parent.OnlineStop=!parent.OnlineStop;parent.reload(false);" ' + (parent.OnlineStop ? '' : 'checked') + '>');
            </script>
            <input type=button onClick="location='ch.php?lo=1&'" value='Обновить'><br>
            Сортировка:<a href="ch.php?lo=1&order=a_z" class="sort">
                <?php
                if ($_SESSION['user']['filt'] == "a_z") {
                    echo '<b>a-z</b>';
                } else {
                    echo 'a-z';
                }
                ?></a> <a href="ch.php?lo=1&order=z_a" class="sort">
                <?php
                if ($_SESSION['user']['filt'] == 'z_a') {
                    echo '<b>z-a</b>';
                } else {
                    echo 'z-a';
                }
                ?></a> <a href="ch.php?lo=1&order=0_35" class="sort">
                <?php
                if ($_SESSION['user']['filt'] == '0_35') {
                    echo '<b>0-35</b>';
                } else {
                    echo '0-35';
                }
                ?></a> <a href="ch.php?lo=1&order=35_0" class="sort">
                <?php
                if ($_SESSION['user']['filt'] == '35_0') {
                    echo '<b>35-0</b>';
                } else {
                    echo '35-0';
                }
                ?></a>
        </td>
    </tr>
    <tr>
        <td><img src="/img/image/1x1.gif" width="1" height="5"></td>
    </tr>
    <tr>
        <td nowrap>
            <SCRIPT>
                var ChatListU = new Array(
                    <?php
                    $tarr[] = '"страж порядка:Страж Порядка:35;15:botsp.gif;Верховная Инквизиция;Автобот Смотритель:0:0:0:0:0:0:0:Legendbattles.ru:0:0"';
                    if ($player['clan'] != 'Служители порядка') {
                        if ($player['loc'] != 28) {
                            $res = $GLOBALS['DBLink']->query("SELECT `user`.`login`,`user`.`invisible`,`user`.`sleep`,`user`.`loc`,`user`.`clan_d`,`user`.`level`,`user`.`clan`,`user`.`clan_gif`,`user`.`sklon`,`user`.`last`,`user`.`affect`,`user`.`pos`,`user`.`a_m`,`user`.`premium`,`user`.`id`,`user`.`u_lvl`,`user`.`fcolor`,`user`.`fcolor_time`,`user`.`vzlomshik_nav`,`user`.`semija`,`user`.`palac` FROM `user` LEFT JOIN `loc` ON `user`.`loc`=`loc`.`id` WHERE `user`.`loc`=? AND `user`.`last`> ? ;", array($player['loc'], (time() - 300)));
                        } else {
                            $res = $GLOBALS['DBLink']->query("SELECT `user`.`login`,`user`.`invisible`,`user`.`sleep`,`user`.`loc`,`user`.`clan_d`,`user`.`level`,`user`.`clan`,`user`.`clan_gif`,`user`.`sklon`,`user`.`last`,`user`.`affect`,`user`.`pos`,`user`.`a_m`,`user`.`premium`,`user`.`id`,`user`.`u_lvl`,`user`.`fcolor`,`user`.`fcolor_time`,`user`.`vzlomshik_nav`,`user`.`semija`,`user`.`palac` FROM `user` LEFT JOIN `loc` ON `user`.`loc`=`loc`.`id` WHERE `user`.`loc`=? AND `user`.`pos`=?  AND `user`.`last`> ? ;", array($player['loc'], $player['pos'], (time() - 300)));
                        }

                    } else {//полный список чата
                        $res = $GLOBALS['DBLink']->query("SELECT `user`.`login`,`user`.`invisible`,`user`.`sleep`,`user`.`loc`,`user`.`clan_d`,`user`.`level`,`user`.`clan`,`user`.`clan_gif`,`user`.`sklon`,`user`.`last`,`user`.`affect`,`user`.`pos`,`user`.`a_m`,`user`.`premium`,`user`.`id`,`user`.`u_lvl`,`user`.`fcolor`,`user`.`fcolor_time`,`user`.`vzlomshik_nav`,`user`.`semija`,`user`.`palac` FROM `user` LEFT JOIN `loc` ON `user`.`loc`=`loc`.`id` WHERE `user`.`last`> ?;", array((time() - 300)));
                    }
                    while ($row = $res->fetch()) {
                        $prem = explode("|", $row['premium']);
                        $dealer = 0;
                        if ($row['fcolor_time'] > time() or $row['fcolor_time'] == 0) {
                            $nickclr = $row['fcolor'];
                            if ($nickclr == '000000') {
                                $nickclr = '';
                            }
                        } else {
                            $nickclr = '';
                        }
                        if ($row['sleep'] > time()) {
                            $sleep = $row['sleep'] - time();
                        } else {
                            $sleep = 0;
                        }
                        if ($row['clan'] != '0') {
                            $row['clan_d'] = str_replace("/:/", "", $row['clan_d']);
                            $row['clan_d'] = str_replace("/;/", "", $row['clan_d']);
                            $clan = $row['clan_gif'] . ";" . $row['clan'] . ";" . $row['clan_d'];
                        } else {
                            $clan = '0';
                        }
                        if (array_key_exists($row['login'], varcheck($_SESSION['ignor']))) {
                            $ign = 1;
                        } else {
                            $ign = 0;
                        }
                        if (affect($row['affect'], 0) != '') {
                            $traw = affect($row['affect'], 0);
                        } else {
                            $traw = 0;
                        }
                        if ($row['invisible'] < time() or $player['clan'] == 'Служители порядка') {
                            $tarr[] = '"' . strtolower($row['login']) . ':' . $row['login'] . ':' . $row['level'] . ';' . $row['u_lvl'] . ':' . $clan . ':' . $sleep . ':' . $ign . ':' . $traw . ':' . (accesses($row['id'], 'dealer') ? ((accesses($row['id'], 'dealer', 1) != 3) ? "2" : "0") : "0") . ':' . $row['sklon'] . ':' . $prem[0] . ':' . $row['vzlomshik_nav'] . ':' . $row['semija'] . ':' . $row['palac'] . ':' . $row['u_lvl'] . ':' . $row['fcolor'] . ':' . $nickclr . ($player['clan'] == 'Служители порядка' ? ':1:' . scode() . '' : ':0') . "\"\n";
                        }
                    }
                    print implode(",", $tarr);
                    echo "); ";
                    $res->closeCursor();
                    ?>
                    chatlist_build('<?=$_SESSION['user']['filt']?>');
            </SCRIPT>
            <br>
        </td>
    </tr>
</table>
</body>
<? }
//-------пишем в чат-----------
$text = $text ?? varcheck($_POST['text']) ?? varcheck($_GET['text']) ?? '';
if ($text != '') {
    if ($player['sleep'] < time()) {
        $msg = ltrim($text);
        if ($player['clan_id'] != 'none') {
            $msg = str_replace("/%clan%/", "%<" . $player['clan_id'] . ">", $msg);
        }
        preg_match("/^((?:\%?\<[^\>]{2,20}\>\s?)+)(.*?)$/", $msg, $arr);
        if ($arr) {
            if ($arr[2]) {
                $message = htmlspecialchars(strip_tags($arr[2], ''));
                $to = $arr[1];
            } else {
                $message = '';
            }
        } else {
            $message = htmlspecialchars(strip_tags($msg, ''));
        }
        if (preg_match("/%<" . $player['clan_id'] . ">/i", $arr[1])) {
            $chtime = 'clchattime';
        } else if (preg_match("/%</i", $arr[1])) {
            $chtime = 'prchattime';
        } else {
            $chtime = 'yochattime';
        }
        if ($message != '') {
            $pactiondo = $pactiondo ?? varcheck($_POST['pactiondo']) ?? varcheck($_GET['pactiondo']) ?? '';
            if ($pactiondo == 1) {
                $message = "<i><b>" . $message . "</b></i>";
            }
            if ($player['fcolor_time'] > time() or $player['fcolor_time'] == 0) {
                $nickclr = $player['fcolor'];
                if ($nickclr == '000000') {
                    $nickclr = '';
                }
            } else {
                $nickclr = '';
            }
            $message = str_replace("/(\\\\[0-9]*)/i", '&acute;', $message);
            if (strlen($message) > 250) {
                $minus = (250 - strlen($message)) * (-1);
                $message = substr($message, 0, strlen($message) - $minus);
            }
            $message = "<font color=" . $player['chcolor'] . "> " . str_replace("/\'/", "&acute;", $message) . "</font> <BR>'+'');";
            if ($player['invisible'] > time() and $chtime == 'yochattime') {
                $users = $to ? '<SPL><b>невидимка</b><SPL>' . str_replace("<SPL>", "", $to) . '<SPL>' : '<b>невидимка</b>:';
            } else {
                $users = $to ? '<SPL><font style="color: #' . ($nickclr ? $nickclr : '000000') . '"><SPAN>' . $player['login'] . '</SPAN></font><SPL>' . str_replace("<SPL>", "", $to) . '<SPL>' : '<font style="color: #' . ($nickclr ? $nickclr : '000000') . '"><SPAN>' . $player['login'] . '</SPAN></font>:';
            }
            echo "<script>parent.clr_input();parent.frames['chmain'].add_msg" . ($ch_mode == 0 ? '' : ($ch_mode == 1 ? '_trade' : ($ch_mode == 3 ? '_system' : ''))) . "('<font class=" . $chtime . ">&nbsp;" . date("H:i:s") . "&nbsp;</font> " . $users . " " . $message . "</script>";
            if (time() < ($_SESSION['StopFlood']['time'] + 2)) {
                $_SESSION['StopFlood']['count']++;
            } else {
                $_SESSION['StopFlood']['count'] = 0;
            }
            $_SESSION['StopFlood']['time'] = time();
            if (is_rvs($message) and $player['login'] != 'Администрация' and $player['login'] != 'alexs') {
                $GLOBALS['DBLink']->unsafeQuery("INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('" . time() . "','sys','" . addslashes("parent.frames['chmain'].add_msg" . ($ch_mode == 0 ? '' : ($ch_mode == 1 ? '_trade' : '')) . "('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;На персонажа <b>" . $player['login'] . "</b> наложено заклятие молчания сроком на <b>5</b> мин. Подозрение на РВС. (<b>Страж Служителей Порядка</b>)</font><BR>'+'');") . "');");
                $GLOBALS['DBLink']->query("UPDATE `user` SET `sleep`=? WHERE `login`=? LIMIT 1;", array((time() + 5 * 60), $player['login']));
            } elseif (is_mat($message) and $player['login'] != 'Администрация' and $player['login'] != 'alexs') {
                $GLOBALS['DBLink']->unsafeQuery("INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('" . time() . "','sys','" . addslashes("parent.frames['chmain'].add_msg" . ($ch_mode == 0 ? '' : ($ch_mode == 1 ? '_trade' : '')) . "('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;На персонажа <b>" . $player['login'] . "</b> наложено заклятие молчания сроком на <b>10</b> мин. Подозрение на мат. (<b>Страж Служителей Порядка</b>)</font><BR>'+'');") . "');");
                $GLOBALS['DBLink']->query("UPDATE `user` SET `sleep`=? WHERE `login`=? LIMIT 1;", array((time() + 10 * 60), $player['login']));
            } elseif (is_rkp($message) and $player['login'] != 'Администрация' and $player['login'] != 'alexs') {
                $GLOBALS['DBLink']->unsafeQuery("INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('" . time() . "','sys','" . addslashes("parent.frames['chmain'].add_msg" . ($ch_mode == 0 ? '' : ($ch_mode == 1 ? '_trade' : '')) . "('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;На персонажа <b>" . $player['login'] . "</b> наложено заклятие молчания сроком на <b>10</b> мин. Подозрение на РКП. (<b>Страж Служителей Порядка</b>)</font><BR>'+'');") . "');");
                $GLOBALS['DBLink']->query("UPDATE `user` SET `sleep`=? WHERE `login`=? LIMIT 1;", array((time() + 10 * 60), $player['login']));
            } elseif ($_SESSION['StopFlood']['count'] > 2 and $player['login'] != 'Администрация' and $player['login'] != 'alexs') {
                $_SESSION['StopFlood']['count'] = 0;
                $GLOBALS['DBLink']->unsafeQuery("INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('" . time() . "','sys','" . addslashes("parent.frames['chmain'].add_msg" . ($ch_mode == 0 ? '' : ($ch_mode == 1 ? '_trade' : '')) . "('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;На персонажа <b>" . $player['login'] . "</b> наложено заклятие молчания сроком на <b>15</b> мин. Причина: Флуд. (<b>Страж Служителей Порядка</b>)</font><BR>'+'');") . "');");
                $GLOBALS['DBLink']->query("UPDATE `user` SET `sleep`=? WHERE `login`=? LIMIT 1;", array((time() + 15 * 60), $player['login']));
            } else {
                $GLOBALS['DBLink']->unsafeQuery("INSERT INTO `chat` (`time`,`login`,`ot_color`,`inv`,`dlya`,`loc`,`pos`,`msg`,`mode`) VALUES ('" . time() . "','" . varcheck($_SESSION['user']['login']) . "','" . ($nickclr ? $nickclr : '000000') . "','" . (($player['invisible'] < time()) ? '0' : '1') . "','" . $to . "','" . $player['loc'] . "','" . $player['pos'] . "','" . mysqli_real_escape_string($GLOBALS['db_link'], stripcslashes($message)) . "','" . $ch_mode . "')");
            }
            if ($to == '<Страж Порядка> ' or $to == '%<Страж Порядка> ') {
                include("includes/NewChatBot.php");
                if ($to != '%<Страж Порядка> ') {
                    if ($response != '') {

                        $response = "<font color=000000> " . $response . "</font> <BR>'+'');";
                        $GLOBALS['DBLink']->unsafeQuery("INSERT INTO `chat` (`time`,`login`,`inv`,`dlya`,`loc`,`pos`,`msg`) VALUES ('" . time() . "','Страж Порядка','0','<" . $player['login'] . "> ','" . $player['loc'] . "','" . $player['pos'] . "','" . mysqli_real_escape_string($GLOBALS['db_link'], stripcslashes($response)) . "');");
                        echo "<script>parent.frames['chmain'].add_msg" . ($ch_mode == 0 ? '' : ($ch_mode == 1 ? '_trade' : ($ch_mode == 3 ? '_system' : ''))) . " ('<font class=yochattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <SPL><SPAN>Страж Порядка</SPAN><SPL><" . $player['login'] . "> <SPL> " . $response . "\nparent.set_lmid(8);\n</script>";
                    }
                } elseif ($to == '%<Страж Порядка> ') {
                    if ($response != '') {
                        $response = "<font color=000000> " . $response . "</font> <BR>'+'');";
                        echo "<script>parent.frames['chmain'].add_msg" . ($ch_mode == 0 ? '' : ($ch_mode == 1 ? '_trade' : ($ch_mode == 3 ? '_system' : ''))) . " ('<font class=prchattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <SPL><SPAN>Страж Порядка</SPAN><SPL>%<" . $player['login'] . "> <SPL> " . $response . "</script>";
                    }
                }
            }
        }
    } else {
        echo "<script>parent.clr_input();</script>";
    }
}

if (isset($_GET['show'])) {
    if ($player['onlineBouns'] > (time() - 37000) and $player['onlineBouns'] < time()) {
        $player['onlineHour'] += 1;
        if ($player['onlineHour'] < 10) {
            $GLOBALS['DBLink']->query("UPDATE `user` SET `onlineHour` = `onlineHour`+'1',`onlineBouns` = ? WHERE `id`=? LIMIT 1;", array((3600 + time()), $player['id']));
            echo "<script>parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;Вы находитесь в игре уже более <b>" . ($player['onlineHour']) . "</b> ч.</font> <br />'+'');</script>";
        } else if ($player['onlineHour'] >= 10) {
            $GLOBALS['DBLink']->query("UPDATE `user` SET `onlineHour` = ?,`onlineBouns` = ?,`baks`=`baks`+'1' WHERE `id`=? LIMIT 1;", array(0, (3600 + time()), $player['id']));
            $GLOBALS['DBLink']->unsafeQuery("INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('" . time() . "','sys','" . addslashes("parent.frames['chmain'].add_msg('<font class=massm>&nbsp;Legend Battles&nbsp;</font>: <font color=\"#000000\">Персонаж <b>" . $player['login'] . "</b> находиться в игре 10 часов. За это достижение он получает бонус <b>1</b> <img src=/img/razdor/emerald.png width=14 title=Изумруд height=14>.</font><BR>'+'');") . "');");
        }
    }

    if ($player['battle'] > 0 and $player['fight'] == 2) {
        $sqltime = $GLOBALS['DBLink']->query("SELECT `user`.`battle` FROM `arena` LEFT JOIN `user` ON `arena`.`id_battle`=`user`.`battle` WHERE `user`.`id`=? AND `arena`.`vis`!=? AND `arena`.`t2`+`arena`.`timeout`<?;", array($player['id'], 3, time()));
        if ($sqltime->rowCount() > 0) {
            while ($r = $sqltime->fetch()) {
                $win[0] = 4;
                $win[1] = $player['level'];
                $win[999] = 1;
                endbat($player['battle'], $win);
            }
        }
    }
//Считаем время баффов\зелий игрока
    if ($player['buffs'] == '') {
        $player['buffs'] = "||||";
    }
    $buffs = explode("|", $player['buffs']);
    $rebuff = 0;
    foreach ($buffs as $value) {
        $buff = explode("@", $value);
        if ($buff[2] != '' and $buff[2] < time()) {
            $newbuff .= "";
            $rebuff = 1;
        } else {
            $newbuff .= implode("@", $buff) . "|";
        }
    }
    if ($rebuff == 1) {
        $GLOBALS['DBLink']->query("UPDATE `user` SET `buffs`=? WHERE `id`=?;", array($newbuff, $player['id']));
        calcstat($player['id']);
    }
    if ($player['firstlogin'] == '0') {
        include $_SERVER['DOCUMENT_ROOT'] . "/gameplay/inc/flogin.php";
    }
    if ($player['lastbattle'] < time() and $player['fight'] == '0' and $player['loc'] == '28' and $player['hp'] >= '1' and ($player['battle'] == '0' or $player['battle'] == '') and $player['wait'] < time()) {
        BotAttack($player);
    }

    if ($_SESSION['user']['on_time'] <= time()) {
        $_SESSION['user']['on_time'] = time() + 200;
        $GLOBALS['DBLink']->query("UPDATE `user` SET `last`=? WHERE `login`=? LIMIT 1;", array(time(), varcheck($_SESSION['user']['login'])));
    }
    if ($_SESSION['user']['wait'] == 1 and $player['fight'] > 0) {
        if ($player['side'] == 1) {
            $side = 2;
        } else {
            $side = 1;
        }
        $en = $GLOBALS['DBLink']->query("SELECT `user`.`id`,`user`.`side`,`user`.`battle`,`user`.`hp`,`fight`.`eid` FROM `user` LEFT JOIN `fight` ON `user`.`id`=`fight`.`eid` WHERE `user`.`battle`=? AND `user`.`side`=? AND `user`.`hp`>? AND `fight`.`eid` Is Null LIMIT 1;", array($player['battle'], $side, 0,))->rowCount();
        if ($en > 0) {
            echo "<script> parent.frames['main_top'].location='main.php';</script>";
        }
    }

//---------------ЧАТ-----------------

    /*

    */

    $result = $GLOBALS['DBLink']->unsafeQuery("SELECT * FROM `chat` WHERE ((`login`!='" . varcheck($_SESSION['user']['login']) . "' AND `chat`.`dlya` LIKE '%\%<" . varcheck($_SESSION['user']['login']) . ">%' AND `id`>'" . varcheck($_SESSION['user']['lastch']) . "') or (`login`!='" . varcheck($_SESSION['user']['login']) . "' AND `chat`.`dlya` LIKE '%" . varcheck($_SESSION['user']['login']) . "%' AND `id`>'" . varcheck($_SESSION['user']['lastch']) . "') OR (`login`!='" . varcheck($_SESSION['user']['login']) . "' AND (`chat`.`dlya` not LIKE '%\%<%>%' OR `dlya`='') AND `id`>'" . varcheck($_SESSION['user']['lastch']) . "')) OR ((`login`='sys' or `login`='mass') and `id`>'" . varcheck($_SESSION['user']['lastch']) . "') OR ((`login`='sys' or `login`='mass') and `id`>'" . varcheck($_SESSION['user']['lastch']) . "');");
    echo "<script>";
    while ($row = $result->fetch()) {
        $msg = $row['msg'];
        $dlya = $row['dlya'];
        $ot = $row['login'];
        $p = $p ?? varcheck($_POST['p']) ?? varcheck($_GET['p']) ?? '';
        $time = $p . date("H:i:s", $row['time']);
        $_SESSION['user']['lastch'] = $row['id'];
        if (array_key_exists($row['login'], varcheck($_SESSION['ignor']))) {
            continue;
        }
        $fyo = $fyo ?? varcheck($_POST['fyo']) ?? varcheck($_GET['fyo']) ?? '';
        if (($fyo != 2 and $fyo != 1) and $ot == 'mass' and (preg_match("/<" . varcheck($_SESSION['user']['login']) . ">/i", $dlya, $regs) or $dlya == '')) {
            echo "parent.frames['chmain'].add_msg" . ($row['mode'] == 0 ? '' : ($row['mode'] == 1 ? '_trade' : ($row['mode'] == 3 ? '_system' : ''))) . "('" . $msg . "<BR>'+'');";
        } else if ($ot == 'sys' and (preg_match("/<" . varcheck($_SESSION['user']['login']) . ">/i", $dlya, $regs) or $dlya == '')) {
            echo $msg;
        } else {
            if ($fyo == 2) {
                $msg = '';
            } else if ($fyo == 1) {
                if (preg_match("/%<" . $player['clan_id'] . ">/i", $dlya, $regs)) {
                    $ctimecolor = "clchattime";
                } else if (preg_match("/%<" . varcheck($_SESSION['user']['login']) . ">/i", $dlya, $regs)) {
                    $ctimecolor = "prchattime";
                } else if (preg_match("/<" . varcheck($_SESSION['user']['login']) . ">/i", $dlya, $regs)) {
                    $ctimecolor = "yochattime";
                } else {
                    $msg = '';
                }
            } else if ($fyo == 0) {
                if (preg_match("/%<" . $player['clan_id'] . ">/i", $dlya, $regs)) {
                    $ctimecolor = "clchattime";
                } else if (preg_match("/%<" . varcheck($_SESSION['user']['login']) . ">/i", $dlya, $regs)) {
                    $ctimecolor = "prchattime";
                } else if (preg_match("/<" . varcheck($_SESSION['user']['login']) . ">/i", $dlya, $regs)) {
                    $ctimecolor = "yochattime";
                } else if (!preg_match("/%</i", $dlya, $regs)) {
                    $ctimecolor = "chattime";
                } else {
                    $msg = '';
                }
            }
            if ($msg != '' and $ot != 'sys') {
                $ShowMsg = 1;
                if ($row['inv'] == '1' and ($ctimecolor == 'chattime' or $ctimecolor == 'yochattime')) {
                    $ot_1 = ((accesses($player['id'], 'pvu')) ? '<i>' . $ot . '</i>' : '');
                    $users = $dlya ? '<SPL>' . ((accesses($player['id'], 'pvu')) ? '<s><i><font style="color: #' . $row['ot_color'] . '"><SPAN>' . $ot . '</SPAN></font></i></s>' : 'невидимка') . '<SPL>' . $dlya . '<SPL>' : ((accesses($player['id'], 'pvu')) ? '<s><i><font style="color: #' . $row['ot_color'] . '"><SPAN>' . $ot . '</SPAN></font></i></s>' : 'невидимка:');
                } else {
                    $users = $dlya ? '<SPL><font style="color: #' . $row['ot_color'] . '"><SPAN>' . $ot . '</SPAN></font><SPL>' . $dlya . '<SPL>' : '<font style="color: #' . $row['ot_color'] . '"><SPAN>' . $ot . '</SPAN></font>:';
                }
                if ($ot == 'Страж Порядка' and $dlya == '<' . $player['login'] . '> ') {
                    $ShowMsg = 0;
                }
                if ($ShowMsg == 1) {
                    echo "\nparent.frames['chmain'].add_msg" . ($row['mode'] == 0 ? '' : ($row['mode'] == 1 ? '_trade' : ($row['mode'] == 3 ? '_system' : ''))) . " ('<font class=" . $ctimecolor . ">&nbsp;" . $time . "&nbsp;</font> " . $users . " " . $msg;
                }
            }
        }
    }
    echo "parent.set_lmid(8);
</script>";
    $result->closeCursor();

//-----------КЛАНЧАТ----------------
    $resultclan = $GLOBALS['DBLink']->query("SELECT * FROM `chat` WHERE `chat`.`dlya` LIKE ? AND `id`>? AND `login`!=?;", array("%\%<" . $player['clan_id'] . ">%", varcheck($_SESSION['user']['lastch']), varcheck($_SESSION['user']['login'])));
    echo "<script>";
    while ($row = $resultclan->fetch()) {
        $ctimecolor = "prchattime";
        $msg = $row["msg"];
        $dlya = $row["dlya"];
        $ot = $row["login"];
        $time = $p . date("H:i:s", $row["time"]);
        $_SESSION['user']['lastch'] = $row["id"];
        $ctimecolor = "clchattime";
        $checkuser = $GLOBALS['DBLink']->query("SELECT `user`.`clan_id` FROM `user` WHERE `login`=? LIMIT 1;", array($ot))->fetch();
        if ($checkuser['clan_id'] == $player['clan_id'] or $ot == 'Администрация') {
            $users = $dlya ? '<SPL><font style="color: #' . $row['ot_color'] . '"><SPAN>' . $ot . '</SPAN></font><SPL>' . $dlya . '<SPL>' : '<SPAN>' . $ot . '</SPAN>:';
            echo "parent.frames['chmain'].add_msg ('<font class=" . $ctimecolor . ">&nbsp;" . $time . "&nbsp;</font> " . $users . " " . $msg;
        }
    }
    echo "parent.set_lmid(8);
</script>";
    $resultclan->closeCursor();
}