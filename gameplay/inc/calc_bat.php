<?
$enemyid = $enemyid ?? varcheck($_POST['enemyid']) ?? varcheck($_GET['enemyid']) ?? '';
$tg = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM user WHERE id='" . intval($enemyid) . "' LIMIT 1;"));
$pl_st = allparam($player);
$tg_st = allparam($tg);
if ($player['fcolor_time'] > time() or $player['fcolor_time'] == 0) {
    $nickclr = $player['fcolor'];
} else {
    $nickclr = '000000';
}

if ($player['invisible'] < time()) {
    $logpl = "[1,$player[side],\"<font style=\'color: #" . $nickclr . ";\'>$player[login]</font>\",$player[level],$player[sklon],\"$player[clan_gif]\"]";
} else {
    $logpl = '[4,' . $player['side'] . ']';
}
$oldlogin = $tg['login'];
$newlogin = str_replace(" [Лидер]", "", $tg['login']);
if ($oldlogin != $newlogin) {
    $champ = 1;
} else {
    $champ = 0;
}
if ($tg['invisible'] < time()) {
    $logtg = "[1,$tg[side],\"" . ($champ ? "<font style=\'color: #CC0000;\'>" : "") . $tg['login'] . ($champ ? "</font>" : "") . "\",$tg[level],$tg[sklon],\"$tg[clan_gif]\"]";
} else {
    $logtg = '[4,' . $tg['side'] . ']';
}


function endb_t($bat)
{
    $hpt = mysqli_query($GLOBALS['db_link'], "SELECT user.battle, user.side, Sum( user.hp ) AS hpp, Sum( user.level ) AS level FROM user GROUP BY user.side, user.battle HAVING (((user.battle) = '" . $bat . "')) ORDER BY user.side LIMIT 2");
    while ($hp = mysqli_fetch_assoc($hpt)) {
        $sid[$hp['side']] = $hp['hpp'];
        $win[$hp['side']] = $hp['level'];
    }
    if ($sid[1] == 0 and $sid[2] != 0) {
        $win[0] = 2;
    } else if ($sid[2] == 0 and $sid[1] != 0) {
        $win[0] = 1;
    } else if ($sid[1] == 0 and $sid[2] == 0) {
        $win[0] = 3;
    } else {
        $win[0] = 0;
    }
    return $win;
}

function sqr($x)
{
    return $x * $x;
}

$go_place = $go_place ?? varcheck($_POST['go_place']) ?? varcheck($_GET['go_place']) ?? '';
if ($go_place != '') {
    mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `pos_fight`='" . $go_place . "' WHERE `id`='" . $player['id'] . "';");
    $player['pos_fight'] = $go_place;
}
$enemy = $enemy ?? varcheck($_POST['enemy']) ?? varcheck($_GET['enemy']) ?? '';
if ($enemy == '3') {
    $bplace = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `battle_places` WHERE `id`='1'"));
    $sql = mysqli_query($GLOBALS['db_link'], "SELECT `pos_fight` FROM `user` WHERE `battle` = '" . $player['battle'] . "'))");
    $go_no_p = '';
    if (mysqli_num_rows($sql) > 0) {
        while ($p = mysqli_fetch_assoc($sql)) {
            $go_no_p .= $p['pos_fight'] . "|";
        }
    }
    list($player['yf'], $player['xf']) = explode('_', $player['pos_fight']);
    list($tg['y'], $tg['x']) = explode('_', $tg['pos_fight']);
    $r = round(sqrt(sqr($tg["x"] - $player["xf"]) + sqr($tg["y"] - $player["yf"])));
    if ($r > 1) {
        $lg = 90;
        for ($i = $tg["x"] - 3; $i <= $tg["x"] + 3; $i++) {
            for ($j = 0; $j <= 4; $j++) {
                if (!substr_count("|" . $bplace["xy"] . "|" . $go_no_p, "|" . $i . "_" . $j . "|")
                    and round(sqrt(sqr($player["xf"] - $i) + sqr($player["yf"] - $j))) <= $lg
                    and round(sqrt(sqr($tg["x"] - $i) + sqr($tg["y"] - $j))) <= 1) {
                    $xtemp = $i;
                    $ytemp = $j;
                    $lg = round(sqrt(sqr($player["xf"] - $i) + sqr($player["yf"] - $j)));
                }
            }
        }
        if ($lg < 90) {
            $go_no_p = str_replace("|" . $tg["x"] . "_" . $tg["y"] . "|", "|" . $xtemp . "_" . $ytemp . "|", $go_no_p);
            $tg["x"] = $xtemp;
            $tg["y"] = $ytemp;
        }
        mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `pos_fight`='" . $xtemp . "_" . $ytemp . "' WHERE `id`='" . $tg['id'] . "';");
    } else { ## ходить по полю боя пока нельзя, а у ботов проерка находтся ли игрок рядом = они не бьют. ботфикс ниже.
        $s = bot($tg_st[28], $tg['hp'], $tg['hp_all'], $tg['mp'], $tg['znan'], $tg['sila']);
        $ftr = 60;
    }
    ## bot fix by mozg 17-11-2013 (боты бьют в любом случае, проверки закомменчивать не стал, надо допиливать систему переходов по полю боя)
    $s = bot($tg_st[28], $tg['hp'], $tg['hp_all'], $tg['mp'], $tg['znan'], $tg['sila']);
    $ftr = 60;
    ##
}

if ($player['sex'] == 'female') {
    $psex = array(0 => 1, "a", "ась");
} else {
    $psex = array(0 => 0, "", "ся");
}
if ($tg['sex'] == 'female') {
    $tsex = array(0 => 1, "a", "ась");
} else {
    $tsex = array(0 => 0, "", "ся");
}
$ina = $ina ?? varcheck($_POST['ina']) ?? varcheck($_GET['ina']) ?? '';
$inu = $inu ?? varcheck($_POST['inu']) ?? varcheck($_GET['inu']) ?? '';
if ($ina != '' or $s['mag'] != '') {
    include($_SERVER["DOCUMENT_ROOT"] . "/gameplay/inc/magic.php");
}
if ($inu != '') {
    $log .= udar($inu, $s['bl'], $player, $tg, $pl_st, $tg_st);
} else {
    $tg_hp = $tg['hp'];
}
$pl_hp = $tg_hp;
if ($s['ud'] != '') {
    $inb = $inb ?? varcheck($_POST['inb']) ?? varcheck($_GET['inb']) ?? '';
    $log .= udar($s['ud'], $inb, $tg, $player, $tg_st, $pl_st);
} else {
    $tg_hp = $player['hp'];
}
savelog($log, $player['battle']);
// Тут можно добавить дроп!
if ($pl_hp <= 0) {
    $death = ",[[0,\"" . date("H:i") . "\"],$logtg,\" <b> Проиграл$tsex[1] бой.</b>\"]";
    if ($tg['level'] > 0 and $tg['type'] == 3) {
        include($_SERVER["DOCUMENT_ROOT"] . "/gameplay/inc/calc_drop.php");
    }
    savelog($death, $player['battle']);
    if (rand(0, 100) <= $ftr and $tg['level'] > 5 and $tg['type'] == 1) {
        $death = ",[[0,\"" . date("H:i") . "\"],$logtg";
        $death = "" . $death . "" . add_trw($tg, $ftr) . "";
        savelog($death, $player['battle']);
    }
}
if ($tg_hp == 0) {
    $death = ",[[0,\"" . date("H:i") . "\"],$logpl,\" <b>Проиграл$psex[1] бой.</b>\"]";
    savelog($death, $player['battle']);
    if (rand(0, 100) <= $ftr and $player['level'] > 5 and $player['type'] == 1) {
        $death = ",[[0,\"" . date("H:i") . "\"],$logpl";
        $death = "" . $death . "" . add_trw($player, $ftr) . "";
        savelog($death, $player['battle']);
    }
}
//------------
$win = endb_t($player['battle']);
if ($win[0] != 0) {
    $win[999] = 0;
    endbat($player['battle'], $win, $pl_st[73]);
}
//-----------

function udar($inu, $block, $player, $tg, $pl_st, $tg_st)
{
    if ($player['invisible'] < time()) {
        $logpl = "[1,$player[side],\"$player[login]\",$player[level],$player[sklon],\"$player[clan_gif]\"]";
    } else {
        $logpl = '[4,' . $player['side'] . ']';
    }
    if ($tg['invisible'] < time()) {
        $logtg = "[1,$tg[side],\"$tg[login]\",$tg[level],$tg[sklon],\"$tg[clan_gif]\"]";
    } else {
        $logtg = '[4,' . $tg['side'] . ']';
    }
    $log = $log ?? '';
    $log .= ",[[0,\"" . date("H:i") . "\"]";
    $exp = explode(",", $player['dmg']);
    $exx = exp_level($player['level']);
    if ($tg['bl'] > 0) {
        $ms[2] = " щитом";
        $ms[3] = " щит";
    } else {
        $ms[3] = " блок";
    }
    $cblock = ($pl_st[30] - $tg_st[30]) / 2 + (($player['level'] - $tg['level']) * 5) + rand(0, 50) + ($player['bl'] / 2);
    if ($cblock < 5) {
        $cblock = 5;
    } else if ($cblock > 95) {
        $cblock = 95;
    }
    if ($player['sex'] == 'female') {
        $psex = array(0 => 1, "a", "ась");
    } else {
        $psex = array(0 => 0, "", "ся");
    }
    if ($tg['sex'] == 'female') {
        $tsex = array(0 => 1, "a", "ась");
    } else {
        $tsex = array(0 => 0, "", "ся");
    }
    $bl = block($block);
    $arr = explode("@", $inu);
    for ($i = 0; $i <= count($arr) - 2; $i++) {
        $ud = explode("_", $arr[$i]);
//------
        if ($ud[2] < 0) {
            $ud[2] = 0;
        }
        if ($ud[2] > 0) {
            if ($exx['ma'] < $ud[2]) {
                $ud[2] = $exx['ma'];
            }
            if ($player['mp'] < $ud[2]) {
                $ud[2] = $player['mp'];
            }
            if ($ud[2] < 5) {
                $ud[2] = 5;
            }
        }
//$player['mp']-=$ud[2];
//------
        $ylov = 3 + ($tg_st[31] * 3 + $tg_st[5]) * (($tg_st[73] / 100) + 1) - ($pl_st[31] * 4 + $pl_st[6] + $pl_st[32] * 2 + $pl_st[34] * 3) * (($pl_st[73] / 100) + 1);
        if ($ylov > 80) {
            $ylov = 80;
        } else if ($ylov < 6) {
            $ylov = 6;
        }
        if (random($ylov) == 1) {

            $log .= ",$logpl,\" попытал$psex[2] поразить соперника, но\",$logtg,\" увернул$tsex[2] от удара\", [6,$ud[0]], \".\"";
        } else {
            if ($ud[2] >= 5 and ($player['mp'] - $ud[2]) < 0) {
                $log .= ",$logpl,\" неудачно использовал$psex[1] магию <B><font color=#CC0000> нехватает маны</font></B>.\"";
                continue;
            }
            $player['mp'] -= $ud[2];
            if (!in_array($ud[0], $bl)) {
                $s = 1;
                include($_SERVER["DOCUMENT_ROOT"] . "/gameplay/inc/udar_succ.php");
            } else {
                if (random($cblock) == 1 or $tg['hp'] == 0) {
                    $s = (rand(3, 6)) / 10;
                    if ($tg['hp'] <= 0) {
                        $s = 1;
                    }
                    include($_SERVER["DOCUMENT_ROOT"] . "/gameplay/inc/udar_succ.php");
                } else $log .= ",$logtg,\" заблокировал$tsex[1]$ms[2] удар\",[6,$ud[0]],\" от\",$logpl,\".\"";
            }
        }
    }
    global $tg_hp;
    $tg_hp = $tg['hp'];
    $i = 0;
    while ($i <= 10) {
        if ($exp[$i] == '') {
            $exp[$i] = 0;
        }
        $i++;
    }
    $expa = "$exp[0],$exp[1],$exp[2],$exp[3],$exp[4],$exp[5],$exp[6],$exp[7],$exp[8],$exp[9],$exp[10]";
    $query = '';
    $tgn = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM user WHERE id='" . $tg['id'] . "' LIMIT 1;"));
    if ($tgn['heal'] != '0' and $tg['hp'] > 0) {
        $clr = "6633CC";
        $tg['hp'] += $tgn['heal'];
        if ($tg['hp'] > $tg['hp_all']) {
            $tg['hp'] = $tg['hp_all'];
        }
        if ($tg['invisible'] < time()) {
            $log .= ",$logtg,\" получил$tsex[1] лечение на <B><font color=#FFBB88>+$tgn[heal]</font></B> [$tg[hp]/$tg[hp_all]].\"";
        } else {
            $log .= ",$logtg,\" получил$tsex[1] лечение на <B><font color=#FFBB88>+$tgn[heal]</font></B> [???/???].\"";
        }
        $query = ",heal='0' ";
    }
    mysqli_query($GLOBALS['db_link'], 'UPDATE user SET hp=' . AP . $tg['hp'] . AP . '' . $query . ' WHERE id =' . AP . $tg['id'] . AP . ' LIMIT 1;');
    mysqli_query($GLOBALS['db_link'], 'UPDATE user SET mp=' . AP . $player['mp'] . AP . ',dmg=' . AP . $expa . AP . ' WHERE id =' . AP . $player['id'] . AP . ' LIMIT 1;');
    return $log . "]";
}

function block($p)
{
    if (isset($p)) {
        $bl = explode("_", $p);
        switch ($bl[1]) {
            case 4:
                return array(0);
                break; //голова
            case 5:
                return array(0, 1);
                break; //"Голова + торс"
            case 6:
                return array(0, 2);
                break; //,"Голова + живот"
            case 7:
                return array(1);
                break; //,"Торс"
            case 8:
                return array(1, 2);
                break; //,"Торс + живот",
            case 9:
                return array(1, 3);
                break; //"Торс + ноги"
            case 10:
                return array(2);
                break; //,"Живот"
            case 11:
                return array(2, 3);
                break; //,"Живот + ноги"
            case 12:
                return array(3);
                break; //,"Ноги"
            case 13:
                return array(0, 3);
                break; //"Ноги + голова"
            case 14:
                return array(0);
                break; //,,"Голова"
            case 15:
                return array(0, 1);
                break; //,"Голова + торс"
            case 16:
                return array(1);
                break; //,"Торс"
            case 17:
                return array(1, 2);
                break; //,"Торс + живот"
            case 18:
                return array(2);
                break; //,"Живот"
            case 19:
                return array(2, 3);
                break; //,"Живот + ноги
            case 20:
                return array(3);
                break; //","Ноги"
            case 21:
                return array(0, 3);
                break; //,"Ноги + голова"
            case 22:
                return array(0);
                break; //,"Голова"
            case 23:
                return array(0, 1);
                break; //,"Голова + торс"
            case 24:
                return array(1, 2);
                break; //,"Торс + живот"
            case 25:
                return array(2, 3);
                break; //,"Живот + ноги"
            case 26:
                return array(0, 2, 3);
                break; //,"Ноги + голова + живот"
            case 27:
                return array(0, 1, 2);
                break; //"Голова + торс + живот"
            case 28:
                return array(1, 2, 3);
                break; //,"Торс + живот + ноги"
        }
    }
}

function random($i)
{
    if (rand(0, 100) < $i) {
        return 1;
    } else return 0;
}

unset($tg_hp);

