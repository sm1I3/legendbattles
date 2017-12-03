<?php
$dropsql = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `bot_drop` WHERE `bot_login`='" . $tg['login'] . "' LIMIT 1;");
if (mysqli_num_rows($dropsql) > 0) {
    $usrprem = explode("|", $player['premium']);
    if ($usrprem[1] < time()) {
        $usrprem[0] = 1;
    }
    $prem = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'], "SELECT `premium_info`.`drop` FROM `premium_info` WHERE `id`='" . (($usrprem[0]) ? $usrprem[0] : '1') . "' LIMIT 1;"));
    if ($player['nablud'] > 0) {
        $b = round($player['nablud'] / 10 + 1);
        $nkoeff = $player['nablud'] / 75;
        if ($nkoeff < 1) {
            $nkoeff = 1;
        }
    } else {
        $nkoeff = 1;
        $b = 1;
    }
    $dropsql = mysqli_fetch_array($dropsql);
    $lvlmin = $player['level'] - $prem['drop'];
    $lvlmax = $player['level'] + $prem['drop'];
    if ($tg['level'] >= $lvlmin and $tg['level'] <= $lvlmax) {
        $selectdrop = rand(1, 3);
    } else {
        $selectdrop = rand(2, 4);
    }
    switch ($selectdrop) {
        case 1:
            if ($dropsql['items_id'] != '0' and $dropsql['items_chance'] > 0) {
                $dropsql['items_chance'] = round($dropsql['items_chance'] / $nkoeff);
                if ($dropsql['items_chance'] < 2) {
                    $dropsql['items_chance'] = 2;
                }
                $drop = rand(1, $dropsql['items_chance']);
                if ($drop == 1) {
                    $items = explode("|", $dropsql['items_id']);
                    $i = 0;
                    foreach ($items as $val) {
                        if ($val != '') {
                            $item[] = $val;
                            $i++;
                        }
                    }
                    if ($i > 0) {
                        $itemsql = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `items` WHERE `id`='" . $item[rand(0, $i - 1)] . "' LIMIT 1;"));
                        $par = explode("|", $itemsql[param]);
                        foreach ($par as $value) {
                            $stat = explode("@", $value);
                            switch ($stat[0]) {
                                case 2:
                                    $dolg = $stat[1];
                                    break;
                            }
                        }
                        $srok2 = 86400 * $itemsql['srok'];
                        $srok = time() + $srok2;
                        if (mysqli_query($GLOBALS['db_link'], "INSERT INTO invent (`protype` ,`pl_id` ,`dolg` ,`price` ,`gift`,`gift_from`" . (($itemsql['srok'] > 0) ? ',`arenda`' : '') . ") VALUES ('" . $itemsql['id'] . "','" . $player['id'] . "','" . $dolg . "','" . $itemsql['price'] . "','0',''" . (($itemsql['srok'] > 0) ? ",'" . $srok . "'" : '') . ");")) {
                            $dropmsg = "Найдено на трупе противника: </font><b id=drop>" . $itemsql['name'] . "</b>.";
                            $death = ",[[0,\"" . date("H:i") . "\"],$logtg,\" <b> Проиграл$tsex[1] бой.</b> <font color=#CC0000><b>$dropmsg\"]";
                            echo "<script>
							top.frames['chmain'].add_msg_system('<font class=chattime>&nbsp;" . date("H:i:s") . "</font>&nbsp;<b><font color=#CC0000>Внимание!</font></b> $dropmsg </font><BR>'+'');
							top.set_lmid(8);
							</script>";
                        }
                    }
                }
            }
            break;
        case 2:
            if ($dropsql['bottle_id'] != '0' and $dropsql['bottle_chance'] > 0) {
                $dropsql['bottle_chance'] = round($dropsql['bottle_chance'] / $nkoeff);
                if ($dropsql['bottle_chance'] < 2) {
                    $dropsql['bottle_chance'] = 2;
                }
                $drop = rand(1, $dropsql['bottle_chance']);
                if ($drop == 1) {
                    $items = explode("|", $dropsql['bottle_id']);
                    $i = 0;
                    foreach ($items as $val) {
                        if ($val != '') {
                            $item[] = $val;
                            $i++;
                        }
                    }
                    if ($i > 0) {
                        $itemsql = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `items` WHERE `id`='" . $item[rand(0, $i - 1)] . "' LIMIT 1;"));
                        $par = explode("|", $itemsql[param]);
                        foreach ($par as $value) {
                            $stat = explode("@", $value);
                            switch ($stat[0]) {
                                case 2:
                                    $dolg = $stat[1];
                                    break;
                            }
                        }
                        if (mysqli_query($GLOBALS['db_link'], "INSERT INTO invent (`protype` ,`pl_id` ,`dolg` ,`price`) VALUES ('" . $itemsql['id'] . "','" . $player['id'] . "','" . $dolg . "','" . $itemsql['price'] . "');")) {
                            $dropmsg = "Найдено на трупе противника: </font><b id=drop>" . $itemsql['name'] . "</b>.";
                            $death = ",[[0,\"" . date("H:i") . "\"],$logtg,\" <b> Проиграл$tsex[1] бой.</b> <font color=#CC0000><b>$dropmsg\"]";
                            echo "<script>
							top.frames['chmain'].add_msg_system('<font class=chattime>&nbsp;" . date("H:i:s") . "</font>&nbsp;<b><font color=#CC0000>Внимание!</font></b> $dropmsg </font><BR>'+'');
							top.set_lmid(8);
							</script>";
                        }
                    }
                }
            }
            break;
        case 3:
            if ($dropsql['money_chance'] > 0) {
                $dropsql['money_chance'] = round($dropsql['money_chance'] / $nkoeff);
                if ($dropsql['money_chance'] < 2) {
                    $dropsql['money_chance'] = 2;
                }
                $drop = rand(1, $dropsql['money_chance']);
                if ($drop == 1) {
                    $lrdrop = round($tg['level'] + $b);
                    $drop = $dropsql['money'];
                    $dropmsg = "Найдено на трупе противника: <b>" . lr($drop) . "</b>";
                    echo "<script>
					top.frames['chmain'].add_msg_system('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp; $dropmsg. </font><BR>'+'');
					top.set_lmid(8);
					</script>";
                    mysqli_query($GLOBALS['db_link'], 'UPDATE user SET nv=nv+' . AP . $drop . AP . ' WHERE id =' . AP . $player['id'] . AP . 'LIMIT 1;');
                    $death = ",[[0,\"" . date("H:i") . "\"],$logtg,\" <b> Проиграл$tsex[1] бой. $dropmsg.</b>\"]";
                }
            }
            break;
    }
}