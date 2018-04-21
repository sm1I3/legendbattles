<?php
if ($_GET['get_id'] == '5' and in_array($_GET['vcode'], $_SESSION['vcodes'])) {// Лаберинт
    if ($pers['loc'] == 500 or $pers['loc'] == 501) {
        list($pers['y'], $pers['x']) = explode('_', $pers['pos']);
        switch ($_GET['act']) {
            case'0':
                $GetMove = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `labyrinth` WHERE `x`='" . ($pers['x']) . "' AND `y`='" . ($pers['y']) . "'"));
                if ($GetMove['L_img'] == 11) {
                    mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `pos`='" . ($pers['x']) . "_" . ($pers['y'] - 1) . "',`wait`='" . (time() + 10) . "' WHERE `id`='" . $pers['id'] . "'");
                    $pers['pos'] = ($pers['x']) . "_" . ($pers['y'] - 1);
                    $pers['wait'] = time() + 10;
                }
                break;
            case'10':
                $GetMove = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `labyrinth` WHERE `x`='" . ($pers['x']) . "' AND `y`='" . ($pers['y']) . "'"));
                if ($pers['wait'] < time()) {
                    if ($GetMove['L_img'] == '3' or $GetMove['L_img'] == '8' or $GetMove['L_img'] == '9') {
                        if (!empty($GetMove) and $GetMove['d_to'] != '0_0') {
                            if ($GetMove['L_img'] == '3') {
                                list($d_to['y'], $d_to['x']) = explode('_', $GetMove['d_to']);
                                $GetDoor = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `labyrinth` WHERE `x`='" . ($d_to['x']) . "' AND `y`='" . ($d_to['y']) . "'"));
                                $DialogMSG = 'Механизм успешно задействован.<br />Решетка ' . (($GetDoor['doors'] == 0) ? 'поднята' : 'опущена') . '.';
                                mysqli_query($GLOBALS['db_link'], "UPDATE `labyrinth` SET `doors`='" . (($GetDoor['doors'] == 0) ? 1 : 0) . "' WHERE `x`='" . ($d_to['x']) . "' AND `y`='" . ($d_to['y']) . "'");
                                $UsedTime = 30;
                                $UsedMove = false;
                            }
                            if ($GetMove['L_img'] == '8') {
                                $DialogMSG = 'Ваша плоть расщепилась на молекулы.<br />Вы успешно телепортировались.';
                                $UsedTime = 30;
                                $UsedMove = true;
                            }
                            if ($GetMove['L_img'] == '9') {
                                $DialogMSG = 'Тут очень тесно, темно и мокро.<br />Но вы успешно попали на ту сторону лаза.';
                                $UsedTime = 30;
                                $UsedMove = true;
                            }
                            mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET " . (($UsedMove) ? "`pos`='" . $GetMove['d_to'] . "'," : '') . "`wait`='" . (time() + $UsedTime) . "' WHERE `id`='" . $pers['id'] . "'");
                            $pers['pos'] = (($UsedMove) ? $GetMove['d_to'] : $pers['pos']);
                            $pers['wait'] = time() + $UsedTime;
                        } else {
                            if ($GetMove['L_img'] == '3') {
                                $DialogMSG = 'Похоже что механизм поломан.<br />Вам защемило руку.';
                            }
                            if ($GetMove['L_img'] == '8') {
                                $DialogMSG = 'Похоже что телепорт не работает.<br />Ваша нога застряла.';
                            }
                            if ($GetMove['L_img'] == '9') {
                                $DialogMSG = 'Вы застряли и пытаетесь выбраться.<br />Наверное, кому-то надо меньше есть...';
                            }
                            mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `wait`='" . (time() + 50) . "' WHERE `id`='" . $pers['id'] . "'");
                            $pers['wait'] = time() + 50;
                        }
                    }
                }

                break;
            // Соберите 4 куска старинной карты и принесите мне.
            case'80':
                switch ($_GET['di']) {
                    case'0':
                        $rotation = array('0' => array('0' => array('x' => 0, 'y' => -1)), '90' => array('0' => array('x' => 1, 'y' => 0)), '180' => array('0' => array('x' => 0, 'y' => 1)), '270' => array('0' => array('x' => -1, 'y' => 0)));
                        $GoTo = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `labyrinth` WHERE `x`='" . ($pers['x'] + $rotation[$pers['rotation']]['0']['x']) . "' AND `y`='" . ($pers['y'] + $rotation[$pers['rotation']]['0']['y']) . "'"));
                        if (!empty($GoTo) and $pers['wait'] < time()) {
                            mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `pos`='" . ($pers['x'] + $rotation[$pers['rotation']]['0']['x']) . "_" . ($pers['y'] + $rotation[$pers['rotation']]['0']['y']) . "'" . (($GoTo['L_img'] != 11) ? ",`wait`='" . (time() + 10) . "'" : "") . " WHERE `id`='" . $pers['id'] . "'");
                            $pers['pos'] = ($pers['x'] + $rotation[$pers['rotation']]['0']['x']) . "_" . ($pers['y'] + $rotation[$pers['rotation']]['0']['y']);
                            $pers['wait'] = (($GoTo['L_img'] != 11) ? time() + 10 : 0);
                        }
                        break;
                    case'1':
                        $rotation = array('0' => array('1' => array('x' => 0, 'y' => 1)), '90' => array('1' => array('x' => -1, 'y' => 0)), '180' => array('1' => array('x' => 0, 'y' => -1)), '270' => array('1' => array('x' => 1, 'y' => 0)));
                        $GoTo = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `labyrinth` WHERE `x`='" . ($pers['x'] + $rotation[$pers['rotation']]['1']['x']) . "' AND `y`='" . ($pers['y'] + $rotation[$pers['rotation']]['1']['y']) . "'"));
                        if (!empty($GoTo) and $pers['wait'] < time()) {
                            mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `pos`='" . ($pers['x'] + $rotation[$pers['rotation']]['1']['x']) . "_" . ($pers['y'] + $rotation[$pers['rotation']]['1']['y']) . "'" . (($GoTo['L_img'] != 11) ? ",`wait`='" . (time() + 10) . "'" : "") . " WHERE `id`='" . $pers['id'] . "'");
                            $pers['pos'] = ($pers['x'] + $rotation[$pers['rotation']]['1']['x']) . "_" . ($pers['y'] + $rotation[$pers['rotation']]['1']['y']);
                            $pers['wait'] = (($GoTo['L_img'] != 11) ? time() + 10 : 0);
                        }
                        break;
                    case'2':
                        $rotation = array('0' => array('2' => array('x' => -1, 'y' => 0)), '90' => array('2' => array('x' => 0, 'y' => -1)), '180' => array('2' => array('x' => 1, 'y' => 0)), '270' => array('2' => array('x' => 0, 'y' => 1)));
                        $GoTo = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `labyrinth` WHERE `x`='" . ($pers['x'] + $rotation[$pers['rotation']]['2']['x']) . "' AND `y`='" . ($pers['y'] + $rotation[$pers['rotation']]['2']['y']) . "'"));
                        if (!empty($GoTo) and $pers['wait'] < time()) {
                            mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `pos`='" . ($pers['x'] + $rotation[$pers['rotation']]['2']['x']) . "_" . ($pers['y'] + $rotation[$pers['rotation']]['2']['y']) . "'" . (($GoTo['L_img'] != 11) ? ",`wait`='" . (time() + 10) . "'" : "") . " WHERE `id`='" . $pers['id'] . "'");
                            $pers['pos'] = ($pers['x'] + $rotation[$pers['rotation']]['2']['x']) . "_" . ($pers['y'] + $rotation[$pers['rotation']]['2']['y']);
                            $pers['wait'] = (($GoTo['L_img'] != 11) ? time() + 10 : 0);
                        }
                        break;
                    case'3':
                        $rotation = array('0' => array('3' => array('x' => 1, 'y' => 0)), '90' => array('3' => array('x' => 0, 'y' => 1)), '180' => array('3' => array('x' => -1, 'y' => 0)), '270' => array('3' => array('x' => 0, 'y' => -1)));
                        $GoTo = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `labyrinth` WHERE `x`='" . ($pers['x'] + $rotation[$pers['rotation']]['3']['x']) . "' AND `y`='" . ($pers['y'] + $rotation[$pers['rotation']]['3']['y']) . "'"));
                        if (!empty($GoTo) and $pers['wait'] < time()) {
                            mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `pos`='" . ($pers['x'] + $rotation[$pers['rotation']]['3']['x']) . "_" . ($pers['y'] + $rotation[$pers['rotation']]['3']['y']) . "'" . (($GoTo['L_img'] != 11) ? ",`wait`='" . (time() + 10) . "'" : "") . " WHERE `id`='" . $pers['id'] . "'");
                            $pers['pos'] = ($pers['x'] + $rotation[$pers['rotation']]['3']['x']) . "_" . ($pers['y'] + $rotation[$pers['rotation']]['3']['y']);
                            $pers['wait'] = (($GoTo['L_img'] != 11) ? time() + 10 : 0);
                        }
                        break;
                }
                break;
            case'90':
                switch ($_GET['di']) {
                    case'0':
                        $pers['rotation'] -= 90;
                        if ($pers['rotation'] < 0) {
                            $pers['rotation'] = 270;
                        }
                        mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `rotation`='" . $pers['rotation'] . "' WHERE `id`='" . $pers['id'] . "'");
                        break;
                    case'1':
                        $pers['rotation'] += 90;
                        if ($pers['rotation'] > 270) {
                            $pers['rotation'] = 0;
                        }
                        mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `rotation`='" . $pers['rotation'] . "' WHERE `id`='" . $pers['id'] . "'");
                        break;
                }
                break;
        }
    }
}
if ($_GET['get_id'] == '26' and in_array($_GET['vcode'], $_SESSION['vcodes']) and $pers['nv'] >= 5000) {
    mysqli_query($GLOBALS['db_link'], "UPDATE `clans` SET `vote`='" . (time() + 259200) . "' WHERE `clan_id`='" . $pers['clan_id'] . "'");
    mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `nv`=`nv`-'5000' WHERE `id`='" . $pers['id'] . "' LIMIT 1;");
}
if ($_GET['get_id'] == '29' and in_array($_GET['vcode'], $_SESSION['vcodes'])) {
    $_GET['plid'] = intval($_GET['plid']);
    $cuser = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT `id`,`clan_id`,`login`,`level` FROM `user` WHERE `id`='" . $_GET['plid'] . "'"));
    $clan = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `clans` WHERE `clan_id` = '" . $pers['clan_id'] . "'"));
    if ($_GET['clan_act'] == '1') {

    } elseif ($_GET['clan_act'] == '2') {
        if ($cuser['clan_id'] == $clan['clan_id']) {
            if ($clan['vote'] < time()) {
                mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `clan`='0',`clan_id`='none',`clan_gif`='',`sklon`='0',`clan_d`='',`clan_accesses`='0' WHERE `id`='" . $cuser['id'] . "'");
                event_to_log(date("H:i:s"), 4, 0, $pers['clan_gif'] . ':' . $pers['clan'] . ':' . $pers['clan_d'], $cuser["login"], $cuser["level"], $pers['sklon'], 0);
            } elseif ($clan['vote'] > time()) {
                echo "<script>alert('Невозможно изменить состав клана во время перевыборов!');</script>";
            }
        }
    } elseif ($_GET['clan_act'] == '3' and $pers['clan_status'] == '9') {
        mysqli_query($GLOBALS['db_link'], "DELETE FROM `clan_documents` WHERE `id` = '" . intval($_GET['doc_id']) . "' AND `clan_id` = '" . $pers['clan_id'] . "'");
    }
}
if ($_GET['get_id'] == '56' and in_array($_GET['vcode'], $_SESSION['vcodes'])) {
    switch ($_GET['act']) {
        case'10':
            switch ($_GET['go']) {
                case'dep':
                    if ($pers['wite'] < time()) {
                        list($pers['y'], $pers['x']) = explode('_', $pers['pos']);
                        $LocID = $GLOBALS['DBLink']->query("SELECT `dep` FROM `nature` WHERE `x`= ? AND `y`= ? ", array($pers['x'], $pers['y']))->fetchColumn(0);
                        if ($LocID) {
                            $prem = explode("|", $pers['premium']);
                            if ($LocID != '1') {
                                mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `loc`='" . $LocID . "' WHERE `id`='" . $pers['id'] . "'");
                                header("Location: /main.php");
                            } elseif ($LocID == '1' and (date("H") > 7 or $prem[0] >= 0)) {
                                mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `loc`='" . $LocID . "' WHERE `id`='" . $pers['id'] . "'");
                                header("Location: /main.php");
                            } else {
                                echo '<script>alert(\'Вход воспрещён, ожидайте утра.\');</script>';
                            }
                        }
                    }
                    break;
                case'up':
                    $LocID = $GLOBALS['DBLink']->query("SELECT `go_id` FROM `locations` WHERE `id`=?", array($pers['loc']))->fetchColumn(0);
                    if ($LocID) {
                        mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `loc`='" . $LocID . "' WHERE `id`='" . $pers['id'] . "'");
                        header("Location: /main.php");
                    }
                    break;
            }
            break;
        case '11':
            if ($_GET['go']) {
                $val_go = varcheck($_GET['go']);
                mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `loc`='" . mysqli_real_escape_string($GLOBALS['db_link'], $val_go) . "' WHERE `id`='" . $pers['id'] . "'");
                header("Location: /main.php");
            }
            break;
    }
}

if ($_GET['get_id'] == '14' and $pers['obnul'] > 0) {
    obnul_pl($pers);
}
if ($_GET['get_id'] == '11' and $pers['obnul'] > 0) {
    $ch_tot = $ch_tot ?? varcheck($_POST['ch_tot']) ?? varcheck($_GET['ch_tot']) ?? '';
    mysqli_query($GLOBALS['db_link'], "UPDATE user SET thotem=$ch_tot, obnul=obnul-1 WHERE id=$player[id] LIMIT 1;");
}