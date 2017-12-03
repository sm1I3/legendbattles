<?php
#GLOBALS OFF
header('Content-type: text/html; charset=windows-1251');
session_start();
include($_SERVER["DOCUMENT_ROOT"] . "/includes/config.inc.php");
include($_SERVER["DOCUMENT_ROOT"] . "/includes/functions.php");
foreach ($_POST as $keypost => $valp) {
    $valp = varcheck($valp);
    $_POST[$keypost] = $valp;
}
foreach ($_GET as $keyget => $valg) {
    $valg = varcheck($valg);
    $_GET[$keyget] = $valg;
}
$sk = 'kgTvx2WrEZ';
$pers = GetUser($_SESSION['user']['login']);
if (new_array($pers) == 'ok') {
    $pers['sign'] = $sk;
    $pers['fish_skill'] += 200;
}
if ($pers['id']) {
    $pt = explode("|", $pers['st']);
    $trav = $pers['trav'] + $pt[70];
    $fish = $pers['fish_skill'] + $pt[59];
    $les = $pers['les'] + $pt[60];
    $trvtimer[1] = 15 - round($trav / 20);
    $trvtimer[2] = 90 - round($trav / 5);
    $trvtimer[3] = 15 - round($fish / 20);
    $trvtimer[4] = 180 - round($fish / 5);
    $trvtimer[5] = 15 - round($les / 20);
    $trvtimer[6] = 180 - round($les / 5);
    if ($trvtimer[1] < 5) {
        $trvtimer[1] = 5;
    }
    if ($trvtimer[2] < 5) {
        $trvtimer[2] = 5;
    }
    if ($trvtimer[3] < 5) {
        $trvtimer[3] = 5;
    }
    if ($trvtimer[4] < 5) {
        $trvtimer[4] = 5;
    }
    if ($trvtimer[5] < 5) {
        $trvtimer[5] = 5;
    }
    if ($trvtimer[6] < 5) {
        $trvtimer[6] = 5;
    }
    $mf = 0;
    if ($pers['login'] == 'Администрация' or $pers['login'] == 'm0ne' or $pers['sign'] == $sk) {
        for ($i = 0; $i < count($trvtimer); $i++) {
            $trvtimer[$i] = 5;
            $mf = 20;
        }
        $navi = 1;
    }
    $pers['fish_skill'] += $pt[59];
    //////////////////////
    $Travm = explode("|", $pers['affect']);
    $Trv = 0;
    for ($i = 0; $i <= count($Travm); $i++) {
        $trvm = explode("@", $Travm[$i]);
        if ($trvm[2] > 2 and $trvm[2] < 5) {
            $Trv++;
        }
    }
    if ($Trv > 0) {
        exit('MESS@["Вы обессилены и не можете осмотреться вокруг.<br /> У вас травма, позовите доктора.",0,0]');
    }
    //////////////////////////////////

    switch (intval($_GET['act'])) {
        case 1:
            list($pers['x'], $pers['y']) = explode('_', $pers['pos']);
            if ($pers['login'] == 'Администрация' or $pers['login'] == 'm0ne') {
                $timer = 20;
            }
            mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `lastbattle`='" . (time() + 180) . "',`wait_prof`='" . (time() + $trvtimer[4]) . "' WHERE `id`='" . $pers['id'] . "' LIMIT 1;");
            $grasssql = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `nature_fish` WHERE `x`='" . $pers['x'] . "' AND `y`='" . $pers['y'] . "';");
            if (mysqli_num_rows($grasssql) < 1) {
                $error = "Тут рыбы нет, или уровень вашего навыка недостаточен для ловли рыбы в этом месте.";
            } else {
                $error = "";
                $grassrow = "";
                while ($row = mysqli_fetch_assoc($grasssql)) {
                    $grass = explode("|", $row['grass']);
                    foreach ($grass as $val) {
                        $grn = explode("@", $val);
                        if ($grn[1] <= $pers['fish_skill']) {
                            $allgrass = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT `items`.`id`,`items`.`name`,`items`.`gif` FROM `items` WHERE `id`='" . $grn[0] . "' LIMIT 1;"));
                            $grassrow .= '[' . $allgrass['id'] . ',"' . $allgrass['name'] . '","' . $allgrass['gif'] . '","' . vCode() . '"],';
                        }
                    }
                }
                if ($allgrass == "") {
                    $error = "Тут рыбы нет, или уровень вашего навыка недостаточен для ловли рыбы в этом месте.";
                }
            }
            $serp = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], 'SELECT `invent`.*,  `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`="' . $pers['id'] . '" AND `items`.`type`="w69" AND `items`.`slot`="3" AND `invent`.`used`="1" LIMIT 1;'));
            $priman = mysqli_query($GLOBALS['db_link'], 'SELECT `invent`.*,`items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`="' . $pers['id'] . '" AND `items`.`type`="w69" AND `items`.`slot`!="3" AND `items`.`num_a`="34" AND `invent`.`used`="0" AND `invent`.`bank`="0";');
            if (mysqli_num_rows($priman) > 0) {
                $primnames = "";
                $iz = 0;
                while ($primrow = mysqli_fetch_assoc($priman)) {
                    $primrowToOne[$primrow['id'] + $primrow['arenda'] + $primrow['rassrok']][md5($iz . '/' . $primrow['dolg'] . $primrow['mod'] . $primrow['clan'] . $primrow['grav'])] += 1;
                    if ($primrowToOne[$primrow['id'] + $primrow['arenda'] + $primrow['rassrok']][md5($iz . '/' . $primrow['dolg'] . $primrow['mod'] . $primrow['clan'] . $primrow['grav'])] == 1) {
                        $count = mysqli_num_rows(mysqli_query($GLOBALS['db_link'], "SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`='" . $pers['id'] . "' and `invent`.`used`='0' and `dolg`='" . $primrow['dolg'] . "' and `iznos`='" . $primrow['iznos'] . "' and `items`.`id`='" . $primrow['id'] . "' and `invent`.`arenda`='" . $primrow['arenda'] . "' and `invent`.`rassrok`='" . $primrow['rassrok'] . "' and `invent`.`mod`='" . $primrow['mod'] . "' and `invent`.`clan`='" . $primrow['clan'] . "' and `invent`.`grav`='" . $primrow['grav'] . "' and `invent`.`bank`='0';"));
                        $primnames .= '[' . $primrow['id'] . ',"' . $primrow['name'] . '","' . $primrow['gif'] . '","' . vCode() . '","' . $count . '"],';
                    }
                }
            } else {
                $primnames = '';
            }
            $primnames = substr($primnames, 0, strlen($primnames) - 1);
            $grassrow = substr($grassrow, 0, strlen($grassrow) - 1);
            $captcha = "00000";
            header("Content-type: text/html; charset=windows-1251");
            exit('FISH@["' . ($error ? $error : '') . '",""]@[0,"' . $captcha . '","' . (($serp) ? $serp['id_item'] : '') . '",1,1000,' . $grassrow . ']@[' . $primnames . ']');
            break;
        case 2:
            $tst = $pers['wait_prof'] - time() - 2;
            if ($tst <= 0) {
                list($pers['x'], $pers['y']) = explode('_', $pers['pos']);
                $grasssql = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `nature_fish` WHERE `x`='" . $pers['x'] . "' AND `y`='" . $pers['y'] . "';");
                if (mysqli_num_rows($grasssql) < 1) {
                    $error = "<font class=proce>Тут рыбы нет, или уровень вашего навыка недостаточен для ловли рыбы в этом месте.</font>";
                } else {
                    $serp = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], 'SELECT `invent`.*,  `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`="' . $pers['id'] . '" AND `items`.`type`="w69" AND `items`.`slot`="3" AND `invent`.`used`="1" AND `invent`.`id_item`="' . intval($_GET['serp']) . '" LIMIT 1;'));
                    $priman = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], 'SELECT `invent`.*,`items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`="' . $pers['id'] . '" AND `items`.`type`="w69" AND `items`.`slot`!="3" AND `items`.`num_a`="34" AND `invent`.`used`="0" AND `invent`.`bank`="0"  AND `invent`.`protype`="' . intval($_GET['gid']) . '" LIMIT 1;'));
                    if ($serp['id_item'] and $priman['id_item']) {
                        $error .= "<font class=proce style='color:black';>Снасти: <b>" . $serp['name'] . "</b><br>Приманка: <b>" . $priman['name'] . "</b></font>";
                        $dolg = $serp['dolg'] - $serp['iznos'] - 1;
                        if ($dolg <= 0) {
                            $error .= "<br><font class=proce style='color:black';><b>" . $serp['name'] . " </b>истратила всю долговечность, приобретите новую.</font>";
                        }
                        it_break($serp['id_item']);
                        it_break($priman['id_item']);
                        while ($row = mysqli_fetch_assoc($grasssql)) {
                            $grass = explode("|", $row['grass']);
                            $grn = "";
                            for ($i = 0; $i < count($grass); $i++) {
                                $grn = explode("@", $grass[$i]);
                                if ($grn[1] <= $pers['fish_skill']) {
                                    $checkfish = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `items` WHERE `id`='" . intval($grn[0]) . "' AND `effect`='" . $priman['effect'] . "' LIMIT 1;"));
                                    if ($checkfish['id']) {
                                        $grnadd[] = $checkfish;
                                    }
                                }
                            }
                            if (count($grnadd) > 0) {
                                $rndgr = rand(0, (count($grnadd) - 1));
                                $allgrass = $grnadd[$rndgr];
                                if ($allgrass['dd_price'] > 0) {
                                    $pr = $allgrass['dd_price'];
                                    $filt = "`dd_price`";
                                } else {
                                    $pr = $allgrass['price'];
                                    $filt = "`price`";
                                }
                                $par = explode("|", $allgrass['param']);
                                foreach ($par as $value) {
                                    $stat = explode("@", $value);
                                    switch ($stat[0]) {
                                        case 2:
                                            $dolg = $stat[1];
                                            break;
                                    }
                                }
                                if (rand(1, 9) == 1) {
                                    $error .= "<br><font class=proce style='color:black';>Рыбка сорвалась: </font><font class=proce><b>" . $allgrass['name'] . "</b></font>";
                                } else {
                                    $rndtrav = round(($pers['fish_skill'] / 40) + 2);
                                    if ($rndtrav > 3) {
                                        $rndtrav = 3;
                                    }
                                    if ($mf > 0) {
                                        $rndtrav = $mf;
                                    }
                                    $rand = rand(1, $rndtrav);
                                    for ($i = 0; $i < $rand; $i++) {
                                        $insert .= "('" . $allgrass['id'] . "','" . $pers['id'] . "','" . $dolg . "','" . $pr . "','0','" . (time() + 604800) . "'),";
                                    }
                                    $insert = substr($insert, 0, strlen($insert) - 1);
                                    mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype`,`pl_id`,`dolg`," . $filt . ",`mod_color`,`death`) VALUES " . $insert . ";");
                                    $error .= "<br><font class=proce style='color:black';>Поймано: </font><font class=proce style='color:#006600;'><b>" . $allgrass['name'] . " </b>(" . $rand . " шт.)</font>";
                                    $upcoeff = round(($pers['fish_skill'] - $pt[59] + 15) / 2);
                                    if ($upcoeff > 250) {
                                        $upcoeff = 250;
                                    }
                                    if ($upcoeff < 25) {
                                        $upcoeff = 25;
                                    }
                                    $rndtravup = rand(1, $upcoeff);
                                    if ($rndtravup == 1) {
                                        mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `fish_skill`=`fish_skill`+'1' WHERE `id`='" . $pers['id'] . "' LIMIT 1;");
                                        $error .= "<br><br><font class=proce>Поздравляем, вы подняли навык:</font><br><font class=proce style='color:black';><b>Рыболов </font><font class=proce style='color:#006600;'>+1</font>.</b>";
                                    }
                                }

                            } else {
                                $error .= "<br><font class=proce>Тут рыбы нет, или вы использовали неправильную приманку.</font>";
                            }
                        }
                    }
                }
                $captcha = "00000";
                header("Content-type: text/html; charset=windows-1251");
                exit('FISH@["' . ($error ? $error : 'test') . '"]');
            }
            break;
    }
}
//exit('FISH@["Неизвестная ошибка, сообщите m0ne скопировав это сообщение: '.date("d.m.Y H:i:s").' <> '.time().' >>> '.getIP().'."]');	