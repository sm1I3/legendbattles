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
function lr($lr)
{
    $b = $lr % 100;
    $s = intval(($lr % 10000) / 100);
    $g = intval($lr / 10000);
    return (($g) ? $g . ' <img src=http://img.legendbattles.ru/image/gold.png width=14 height=14 valign=middle title=Золото>  ' : '') . (($s) ? $s . ' <img src=http://img.legendbattles.ru/image/silver.png width=14 height=14 valign=middle title=Серебро> ' : '') . (($b) ? $b . ' <img src=http://img.legendbattles.ru/image/bronze.png width=14 height=14 valign=middle title=Бронза> ' : '');
}

$pers = GetUser($_SESSION['user']['login']);

$timenow = time();

$check_que = $QuestID = $descr = $log_aj = $qd = $EndMSG = '';
$step = false;
switch ($_GET['act']) {
    case 1:
        if (md5($pers['id'] . '.1.' . (isset($_GET['qid']) ? $_GET['qid'] : '')) == $_GET['vcode']) {
            $qres = mysqli_query($GLOBALS['db_link'], "SELECT quest_serilize FROM quest_list WHERE quest_id=" . intval(isset($_GET['qid']) ? $_GET['qid'] : false));
            $fault = false;
            if (mysqli_num_rows($qres) > 0) {
                $qrow = mysqli_fetch_assoc($qres);
                $QuestArr = unserialize($qrow['quest_serilize']);
                if ($QuestArr[13]) {
                    $descr = $QuestArr[13];
                }
                $ArrP = array();
                if (isset($QuestArr[2])) {
                    foreach ($QuestArr[2] as $key => $value) {
                        switch ($key) {
                            case 'MON':// Требуемые средства для квеста (Снимаем)
                                if ($pers['nv'] < $value) {
                                    $fault = true;
                                } else {
                                    if (!mysqli_query($GLOBALS['db_link'], "UPDATE user SET nv=nv-" . $value . " WHERE id=" . $pers['id'] . " AND nv>=" . $value)) {
                                        $fault = true;
                                    }
                                }
                                break;
                            case 'BAKS':// Требуемые средства для квеста (Снимаем)
                                if ($pers['baks'] < $value) {
                                    $fault = true;
                                } else {
                                    if (!mysqli_query($GLOBALS['db_link'], "UPDATE user SET baks=baks-" . $value . " WHERE id=" . $pers['id'] . " AND baks>=" . $value)) {
                                        $fault = true;
                                    }
                                }
                                break;
                            case 'NV':// Требуемые средства при завершении (ACT 2)
                                $ArrP['NV'] = intval($value);
                                break;
                            case 'WEA':// Требуемые предметы (ACT 2)
                                $size = sizeof($value) - 1;
                                $ind = mt_rand(0, $size);
                                $ArrP['WEA'] = $value[$ind];
                                break;
                            case 'NPC':// Кол-во побед в PvE с момента взятия квеста
                                $wins = explode("|", $pers['wins']);
                                $ArrP['NPC'] = ($wins[2] + intval($value));
                                break;
                            case 'PVP':// Кол-во побед в PvP с момента взятия квеста
                                $wins = explode("|", $pers['wins']);
                                $ArrP['PVP'] = ($wins[0] + intval($value));
                                break;
                            case 'QD'://Требование скрытие квестов из журнала заданий:
                                $QD = '';
                                foreach ($value as $key2 => $quest_id) {
                                    $QD .= ($QD ? ',' : '') . $quest_id;
                                }
                                mysqli_query($GLOBALS['db_link'], 'UPDATE quest_tasks SET task_hide=1 WHERE playerid=' . $pers['id'] . ' AND quest_id IN (' . $QD . ')');
                                break;
                        }
                    }
                }
                if ($fault == false) {
                    $end = $timenow + 3600 * $QuestArr[0][2];
                    $close = $timenow + 3600 * $QuestArr[0][4];
                    if ($close < $end) {
                        $close = $end;
                    }
                    if (mysqli_query($GLOBALS['db_link'], 'INSERT INTO quest_tasks (task_id,playerid,quest_id,task_start,task_time,task_close,task_params,task_description) VALUES (NULL,' . $pers['id'] . ',' . $_GET['qid'] . ',' . $timenow . ',' . $end . ',' . $close . ',\'' . serialize($ArrP) . '\',\'' . $descr . '\')')) {
                        $step = 5;
                        $check_que = intval($_GET['qid']);
                    }
                } else {
                    $step = 8;
                }
            }
        }
        break;
    case 2:
        $log_aj = ' STEP';
        if (md5($pers['id'] . '.2.' . $_GET['qid']) == $_GET['vcode']) {
            $tres = mysqli_query($GLOBALS['db_link'], 'SELECT task_id,task_start,task_time,task_close,task_params FROM quest_tasks WHERE playerid=' . $pers['id'] . ' AND quest_id=' . intval($_GET['qid']));
            if (mysqli_num_rows($tres) > 0) {
                $mass = 0;
                $fault = 0;
                $trow = mysqli_fetch_row($tres);
                if ($timenow < $trow[2]) {
                    $ArrP = unserialize($trow[4]);
                    foreach ($ArrP as $key => $value) {
                        switch ($key) {
                            case 'WEA':
                                $NumsQuest = $NumsInvent = 0;
                                foreach ($value as $wid => $warr) {
                                    $NumsQuest += $warr[0];
                                    $NumsInvent += mysqli_num_rows(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `invent` WHERE `pl_id`='" . $pers['id'] . "' AND `protype`='" . $wid . "' AND `used`='0' AND `clan`='0' AND `gift_from`='' LIMIT " . $warr[0] . ""));
                                }
                                if ($NumsQuest == $NumsInvent) {
                                    foreach ($value as $wid => $warr) {
                                        mysqli_query($GLOBALS['db_link'], "DELETE FROM `invent` WHERE `pl_id`='" . $pers['id'] . "' AND `protype`='" . $wid . "' AND `used`='0' AND `clan`='0' AND `gift_from`='' LIMIT " . $warr[0] . "");
                                    }
                                } else {
                                    $fault = true;
                                }
                                break;
                            case 'PVP':
                                $wins = explode("|", $pers['wins']);
                                if ($value > $wins[0]) {
                                    $fault = true;
                                }
                                break;
                            case 'NPC':
                                $wins = explode("|", $pers['wins']);
                                if ($value > $wins[2]) {
                                    $fault = true;
                                }
                                break;
                            case 'NV':
                                if ($pers['nv'] < $value) {
                                    $fault = true;
                                } else {
                                    mysqli_query($GLOBALS['db_link'], 'UPDATE user SET nv=nv-' . $value . ' WHERE id=' . $pres['id'] . ' AND nv>=' . $value);
                                    if (mysqli_affected_rows($link) != 1) {
                                        $fault = true;
                                    }
                                }
                                break;
                        }
                    }
                    if ($fault == false) {
                        $qres = mysqli_query($GLOBALS['db_link'], 'SELECT quest_serilize FROM quest_list WHERE quest_id=' . intval($_GET['qid']));
                        if (mysqli_num_rows($qres) > 0) {
                            $qrow = mysqli_fetch_assoc($qres);
                            $QuestArr = unserialize($qrow['quest_serilize']);
                            $SQLArrPlus = array();
                            if (isset($QuestArr[12])) {
                                foreach ($QuestArr[12] as $key => $value) {
                                    switch ($key) {
                                        case 'M_EXP':
                                            if ($value) {
                                                $exp = explode("|", $pers['exp']);
                                                $EndMSG[] = "Мирный (<b>{$value}</b>)";
                                                $SQLArrPlus['exp'] = $exp[0] . '|' . ($exp[1] + $value) . '|' . $exp[2];
                                            }
                                            break;
                                        case 'M_EXP1':
                                            if ($value) {
                                                $exp = explode("|", $pers['exp']);
                                                $EndMSG[] = "Доблесть (<b>{$value}</b>)";
                                                $SQLArrPlus['exp'] = $exp[0] . '|' . $exp[1] . '|' . ($exp[2] + $value);
                                            }
                                            break;
                                        case 'EXP':
                                            if ($value) {
                                                $exp = explode("|", $pers['exp']);
                                                $EndMSG[] = "Боевой опыт (<b>{$value}</b>)";
                                                $SQLArrPlus['exp'] = ($exp[0] + $value) . '|' . $exp[1] . '|' . $exp[2];
                                            }
                                            break;
                                        case 'PRE':
                                            if ($value) {
                                                $SQLArrPlus['vzlomshik_nav'] = $value;
                                                $EndMSG[] = "Навык взломщика<b>{$value}</b>";
                                            }
                                            break;
                                        case 'PRE2':
                                            if ($value) {
                                                $SQLArrPlus['baks'] = $value;
                                                $EndMSG[] = "<b>{$value}</b>";
                                            }
                                            break;
                                        case 'PRE3':
                                            if ($value) {
                                                $SQLArrPlus['reput'] = $value;
                                                $EndMSG[] = "<b>{$value}</b>";
                                            }
                                            break;
                                        case 'MONEY':
                                            if ($value) {
                                                $SQLArrPlus['nv'] = $value;
                                                $EndMSG[] = "<b>{$value}</b>";
                                            }
                                            break;
                                        case 'W_UID':
                                            foreach ($value as $key => $wea_uid) {
                                                $EndMSG[] = "&laquo;<b>" . insertInventory($pers['id'], $wea_uid) . "</b>&raquo;";
                                            }
                                            break;
                                        case 'QHA':
                                            $QHA = '';
                                            foreach ($value as $key2 => $quest_id) {
                                                $QHA .= ($QHA ? ',' : '') . $quest_id;
                                            }
                                            mysqli_query($GLOBALS['db_link'], 'UPDATE quest_tasks SET task_hide=1 WHERE playerid=' . $pers['id'] . ' AND quest_id IN (' . $QHA . ')');
                                            break;
                                    }
                                }
                            }
                            $sql = array();
                            foreach ($SQLArrPlus as $key => $value) {
                                $sql[] = $key . '=' . (($key == 'exp') ? "'" . $value . "'" : $key . '+' . $value);
                            }
                            if (mysqli_query($GLOBALS['db_link'], 'UPDATE user SET ' . implode(",", $sql) . ' WHERE id=' . $pers['id'])) {
                                $log_aj .= ' 4';
                                foreach ($SQLArrPlus as $key => $value) {
                                    $pers[$key] += $value;
                                }
                                $step = 4;
                            } else {
                                if ($QuestArr[0][3]) {
                                    $step = 4;
                                }
                            }
                            $check_que = intval($_GET['qid']);
                            break;
                        }
                    } else {
                        $step = 9;
                        break;
                    }
                } else {
                    $step = 10;
                    if ($trow[3] < $timenow) {
                        mysqli_query($GLOBALS['db_link'], 'DELETE FROM quest_tasks WHERE task_id=' . $trow[0]);
                        break;
                    }
                }
            }
        }

        break;
}

// Фильтруем определенный квест ИД
$QSQL = '';
if (isset($_GET['qid'])) {
    $QSQL .= ' AND quest_list.quest_id=' . intval($_GET['qid']);
}

$qres = mysqli_query($GLOBALS['db_link'], 'SELECT quest_list.quest_id,quest_list.quest_serilize FROM quest_list,quest_to_place WHERE quest_to_place.place_code="' . $pers['loc'] . '" AND quest_list.quest_id = quest_to_place.quest_id' . $QSQL);
if (mysqli_num_rows($qres) > 0) {
    while ($qrow = mysqli_fetch_assoc($qres)) {
        $queTasks = mysqli_query($GLOBALS['db_link'], 'SELECT * FROM quest_tasks WHERE task_complete=1 AND playerid=' . $pers['id'] . ' AND quest_id=' . $qrow['quest_id'] . ' LIMIT 1;');
        if (mysqli_num_rows($queTasks) == 0) {
            $QuestArr = unserialize($qrow['quest_serilize']);
            $fault = false;
            if (isset($QuestArr[1])) {
                foreach ($QuestArr[1] as $key => $value) {
                    switch ($key) {
                        case 'LV':
                            if ($pers['level'] < $value) {
                                $fault = true;
                            }
                            break;
                        case 'QE':
                            unset($QE);
                            $QES = 0;
                            $QE = '';
                            foreach ($value as $key2 => $quest_id) {
                                $QE .= ($QE ? ',' : '') . $quest_id;
                                ++$QES;
                            }
                            $tres = mysqli_query($GLOBALS['db_link'], 'SELECT task_id FROM quest_tasks WHERE playerid=' . $pers['id'] . ' AND quest_id IN (' . $QE . ') AND task_complete=1');
                            if (mysqli_num_rows($tres) != $QES) {
                                $fault = true;
                            }
                            break;
                        case 'QA':
                            unset($QA);
                            $QAS = 0;
                            $QA = '';
                            foreach ($value as $key2 => $quest_id) {
                                $QA .= ($QA ? ',' : '') . $quest_id;
                                ++$QAS;
                            }
                            $tres = mysqli_query($GLOBALS['db_link'], 'SELECT task_id FROM quest_tasks WHERE playerid=' . $pers['id'] . ' AND quest_id IN (' . $QA . ') AND task_time>' . $timenow);
                            if (mysqli_num_rows($tres) != $QAS) {
                                $fault = true;
                            }
                            break;
                        case 'QU':
                            unset($QU);
                            $QUS = 0;
                            $QU = '';
                            foreach ($value as $key2 => $quest_id) {
                                $QU .= ($QU ? ',' : '') . $quest_id;
                                ++$QUS;
                            }
                            $tres = mysqli_query($GLOBALS['db_link'], 'SELECT task_id FROM quest_tasks WHERE playerid=' . $pers['id'] . ' AND quest_id IN (' . $QU . ') AND task_complete=0');
                            if (mysqli_num_rows($tres) != $QUS) {
                                $fault = true;
                            }
                            break;
                        case 'UM':
                            $um_x = $pers['add_um_' . $value[0]];
                            $um_add = ($um_x <= 100 ? $um_x : floor(5 + sqrt($um_x & log10($um_x)) + log10($um_x)));
                            if ($pers['um_' . $value[0]] & $um_add < $value[1]) {
                                $fault = true;
                            }
                            break;
                    }
                }
            }
            if (!$fault) {
                if ($check_que != $qrow['quest_id']) {
                    if (0 < $QuestArr[0][4]) {
                        $tres = mysqli_query($GLOBALS['db_link'], 'SELECT task_id FROM quest_tasks WHERE playerid=' . $pers['id'] . ' AND quest_id=' . $qrow['quest_id'] . ' AND task_close>' . $timenow . ' AND task_hide=1');
                        if (mysqli_num_rows($tres)) {
                            $fault = 1;
                        }
                    }
                }
                if (!$fault) {
                    $QuestBin = intval($qrow['quest_id']) - 1;
                    if (!($QuestPass[intval($QuestBin / 8)] >> $QuestBin & 8 & 1)) {
                        $QuestPOS[] = array($QuestArr[0][0], $qrow['quest_id'], $QuestArr);
                    }
                }
            }
        }
    }
    $PS = sizeof($QuestPOS);
    $QPERS = '';
    if ($PS) {
        if ($PS == 1) {
            $QPERS = $QuestPOS[0][2][0][1];
            if (!$QuestID) {
                $QuestID = $QuestPOS[0][1];
            }
            if (!$step) {
                $tres = mysqli_query($GLOBALS['db_link'], 'SELECT task_id,task_time,task_close,task_params,task_description FROM quest_tasks WHERE playerid=' . $pers['id'] . ' AND quest_id=' . $QuestPOS[0][1]);
                if (mysqli_num_rows($tres) > 0) {
                    $trow = mysqli_fetch_row($tres);
                    if ($trow[1] > $timenow) {
                        $step = 7;
                    } else {
                        if ($timenow > $trow[2]) {
                            mysqli_query($GLOBALS['db_link'], 'DELETE FROM quest_tasks WHERE task_id=' . $trow[0]);
                        } else {
                            $step = 6;
                        }
                    }
                }
            }
            if (!$step) {
                $step = 3;
            }
            $nick = str_replace('@', '&#064', $pers['login']);
            $sear = array('%NICK%', '%DESCR%', '%TIME%', '%A%', '%EN%', '%S%', '%LA%');
            $repl = array($nick, $descr, $QuestPOS[0][2][0][2], ($pers['sex'] == 'male' ? '' : 'а'), ($pers['sex'] == 'male' ? 'ен' : 'на'), ($pers['sex'] == 'male' ? 'ся' : 'ась'), ($pers['sex'] == 'male' ? '' : 'ла'));
            $QuestDia = $QuestPOS[0][2][$step];
            $qd = '';
            foreach ($QuestDia as $key => $value) {
                $qd .= ($qd ? ',' : '') . '"' . str_replace($sear, $repl, $value)/* . $log_aj*/ . '"';
            }
            if ($step == 4) {
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `chat` (`time`,`login`,`dlya`,`msg`) VALUES ('" . time() . "','sys','%<" . $pers['login'] . ">','" . addslashes("parent.frames['chmain'].add_msg('<font color=#FF0000><b>Системная информация!</b></font> <font color=#000000><b>Квест выполнен.</b> Вы получили: " . implode(", ", $EndMSG) . ".</font><br />'+'');") . "');");
                mysqli_query($GLOBALS['db_link'], 'UPDATE quest_tasks SET task_complete=1 WHERE playerid=' . $pers['id'] . ' AND quest_id=' . $QuestPOS[0][1]);
            }
        } else {
            $qd = '';
            foreach ($QuestPOS as $key => $value) {
                $qd .= ($qd ? '<BR>' : '"') . 'Квест <a href=\'javascript: QSel(' . $value[1] . ');\'>' . $value[0] . '</a>';
            }
            $qd .= /*$log_aj . */
                '"';
        }
    } else {
        $qd = '"Здравствуй ' . str_replace('@', '&#064', $pers['login']) . ', для Вас сейчас нет никаких поручений."';
    }
    exit('QUEST@[' . $qd . ']@["' . $QPERS . '",[' . (in_array($step, array(3, 10)) ? '1,"' . md5($pers['id'] . '.1.' . $QuestID) . '"' : ($step == 7 ? '2,"' . md5($pers['id'] . '.2.' . $QuestID) . '"' : '0,""')) . ',' . $QuestID . ']]');
} else {
    exit('QUEST@["Здравствуй ' . str_replace('@', '&#064', $pers['login']) . ', для Вас сейчас нет никаких поручений."]@["",[0,"",0]]');
}
exit('ERR');