<?
$typetolog = '0';
$abouttolog = '0';  # переменные для логов: первая всегда 0
mysqli_query($GLOBALS['db_link'], "LOCK TABLES market READ, market WRITE;");
if ($act == 1) {
    $ITEM = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT invent.*, items.* FROM invent INNER JOIN items ON invent.protype = items.id WHERE invent.id_item='" . intval($id) . "' and invent.pl_id='" . intval($uid) . "' LIMIT 1;"));
    if ($ITEM != '') {
        mysqli_query($GLOBALS['db_link'], "UPDATE invent SET pl_id='" . $player['id'] . "' WHERE id_item='" . intval($id) . "' LIMIT 1;");
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET nv=nv+" . $ITEM['sellprice'] . " WHERE id='" . intval($uid) . "' LIMIT 1;");
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET nv=nv-" . $ITEM['sellprice'] . " WHERE id='" . $player['id'] . "' LIMIT 1;");
        $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> Персонаж <b>$player[login]</b> купил у вас <b>" . $ITEM['name'] . "</b>!</b></font><BR>'+'');" . $GLOBALS['redirect'];
        chmsg($ms, $login);
        log_write("buy", $ITEM['name'] . " (гос цена: " . $ITEM['price'] . ")", $ITEM['sellprice'], $login);
        $plmsg = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> Вы удачно купили <b>" . $ITEM['name'] . "</b> за <b>" . $price . "</b> LR!</b></font><BR>'+'');$redirect";
        chmsg($plmsg, $player['login']);
        exit;
    }
} else if ($act == 2) {
    chmsg("parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> Персонаж <b>" . $player["login"] . "</b> отказался от покупки!</b></font><BR>'+'');", $login);
    exit;
} else if ($act == 3) {
    $val_id = varcheck($_GET['id']);
    $val_uid = varcheck($_GET['uid']);
    $ITEM = mysqli_query($GLOBALS['db_link'], "SELECT `invent`.*, `items`.* FROM `invent` INNER JOIN `items` ON `invent`.`protype` = `items`.`id` WHERE `invent`.`protype`='" . $val_id . "' AND `pl_id`='" . $val_uid . "'  AND `invent`.`used`='0' AND `invent`.`bank`='0'  AND `invent`.`clan`='0';");
    if (mysqli_num_rows($ITEM) > 0) {
        $col = mysqli_num_rows($ITEM);
        $ITEM = mysqli_fetch_assoc($ITEM);
        $val_uid = varcheck($_GET['uid']);
        mysqli_query($GLOBALS['db_link'], "UPDATE `invent` SET `pl_id`='" . $player['id'] . "' WHERE `protype`='" . intval($_GET['id']) . "' AND `pl_id`='" . $val_uid . "' AND `invent`.`used`='0' AND `invent`.`bank`='0'  AND `invent`.`clan`='0';");
        mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `nv`=`nv`+'" . ($ITEM['sellprice'] * $col) . "' WHERE `id`='" . intval($uid) . "' LIMIT 1;");
        mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `nv`=`nv`-'" . ($ITEM['sellprice'] * $col) . "' WHERE `id`='" . $player['id'] . "' LIMIT 1;");
        $typetolog2 = '0@20';
        $abouttolog2 = '0@<b>' . $ITEM['name'] . '</b>(количество: ' . $col . ' шт.). По цене: <b>' . ($ITEM['sellprice'] * $col) . '</b> LR.';
        $typetolog3 = '0@21';
        $abouttolog3 = '0@<b>' . $ITEM['name'] . '</b>(количество: ' . $col . ' шт.). По цене: <b>' . ($ITEM['sellprice'] * $col) . '</b> LR.';
        if ($typetolog2 != '0' and $abouttolog2 != '0') {
            player_actions($player['id'], $typetolog, $abouttolog);
        }
        if ($typetolog3 != '0' and $abouttolog3 != '0') {
            player_actions(intval($uid), $typetolog, $abouttolog);
        }
        $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> Персонаж <b>" . $player['login'] . "</b> купил у вас <b>" . $ITEM['name'] . "</b> " . $col . " шт!</b></font><BR>'+'');" . $GLOBALS['redirect'];
        chmsg($ms, $login);
        log_write("buy", $ITEM['name'] . " (гос цена: " . $ITEM['price'] . ")" . "(количество: " . $col . " шт.)", ($ITEM['sellprice'] * $col), $login);
        $plmsg = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> Вы удачно купили <b>" . $ITEM['name'] . "</b> за <b>" . ($ITEM['sellprice'] * $col) . "</b> LR!</b></font><BR>'+'');$redirect";
        chmsg($plmsg, $player['login']);
    }
} else {
    $wsuid = intval($wsuid);
    $IT = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT market.*, items.*
	FROM market LEFT JOIN items ON market.id = items.id
	WHERE kol>0 AND items.dd_price=0 AND items.id=$wsuid LIMIT 1;"));
    if ($IT != '') {
        $pr = explode("|", $IT['param']);
        foreach ($pr as $value) {
            $stat = explode("@", $value);
            switch ($stat[0]) {
                case 2:
                    $dolg = $stat[1];
                    break;
            }
        }
        if ($col != 10 and $col != 50) {
            if ($player['nv'] >= $IT['price']) {
                mysqli_query($GLOBALS['db_link'], 'INSERT INTO invent (protype,pl_id,dolg,price) VALUES (' . AP . $IT['id'] . AP . ',' . AP . $player['id'] . AP . ',' . AP . $IT['dolg'] . AP . ',' . AP . $IT['price'] . AP . ');');
                mysqli_query($GLOBALS['db_link'], 'UPDATE market SET kol=kol-1 WHERE id=' . AP . $wsuid . AP . 'LIMIT 1;');
                mysqli_query($GLOBALS['db_link'], 'UPDATE user SET nv=nv-' . AP . $IT['price'] . AP . ' WHERE id=' . AP . $player['id'] . AP . 'LIMIT 1;');
                $msg = "<b><font class=proce>Вы удачно купили:<br><font class=proceg> " . $IT['name'] . " </font><br></font></b>";
                log_write("buy", $IT['name'], $IT['price'], "market");
                $typetolog .= '@12';
                $abouttolog .= '@<b>' . $IT['name'] . '</b>. По цене: <b>' . $IT['price'] . '</b> LR.';
            } else {
                $msg = "<b><font class=proce>Нехватает денег!</font></b>";
            }
        } elseif (($col == 10 or $col == 50) and $IT['kol'] >= $col) {
            if ($player['nv'] >= ($IT['price'] * $col)) {
                $insert = "";
                for ($i = 0; $i < $col; $i++) {
                    $insert .= "('" . $IT['id'] . "','" . $player['id'] . "','" . $IT['dolg'] . "','" . $IT['price'] . "'),";
                }
                $insert = substr($insert, 0, strlen($insert) - 1);
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype`,`pl_id`,`dolg`,`price`) VALUES " . $insert . ";");
                mysqli_query($GLOBALS['db_link'], "UPDATE `market` SET `kol`=`kol`-'" . $col . "' WHERE id='" . $wsuid . "';");
                mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `nv`=`nv`-'" . ($IT['price'] * $col) . "' WHERE `id`='" . $player['id'] . "' LIMIT 1;");
                $msg = "<b><font class=proce>Вы удачно купили:<br><font class=proceg> " . $IT['name'] . " </font><br> в количестве " . $col . " шт.</font></b>";
                log_write("buy", $IT['name'], $IT['price'], "market");
                $typetolog .= '@12';
                $abouttolog .= '@<b>' . $IT['name'] . '</b> (' . $col . ' шт.). По цене: <b>' . ($IT['price'] * $col) . '</b> LR.';
            } else {
                $msg = "<b><font class=proce>Нехватает денег!</font></b>";
            }
        }
    } else {
        $IT = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT market.*, items.*
		FROM market LEFT JOIN items ON market.id = items.id
		WHERE kol>0 AND items.dd_price>0 AND items.id=$wsuid LIMIT 1;"));
        if ($IT != '') {
            if ($player['baks'] >= $IT['dd_price']) {
                $pr = explode("|", $IT['param']);
                foreach ($pr as $value) {
                    $stat = explode("@", $value);
                    switch ($stat[0]) {
                        case 2:
                            $dolg = $stat[1];
                            break;
                    }
                }
                mysqli_query($GLOBALS['db_link'], 'INSERT INTO invent (protype,pl_id,dolg,dd_price) VALUES (' . AP . $IT['id'] . AP . ',' . AP . $player['id'] . AP . ',' . AP . $IT['dolg'] . AP . ',' . AP . $IT['dd_price'] . AP . ');');
                mysqli_query($GLOBALS['db_link'], 'UPDATE market SET kol=kol-1 WHERE id=' . AP . $wsuid . AP . 'LIMIT 1;');
                mysqli_query($GLOBALS['db_link'], 'UPDATE user SET baks=baks-' . AP . $IT['dd_price'] . AP . ' WHERE id=' . AP . $player['id'] . AP . 'LIMIT 1;');
                $typetolog .= '@10';
                $abouttolog .= '@<b>' . $IT['name'] . '</b>. По цене: <b>' . $IT['dd_price'] . '</b> $.';
                $msg = "<b><font class=proce>Вы удачно купили:<br><font class=proceg> " . $IT['name'] . " </font><br></font></b>";
                log_write("buy", $IT['name'], $IT['dd_price'], "market");
            } else {
                $msg = "<b><font class=proce>Нехватает денег!</font></b>";
            }
        }
    }
}
mysqli_query($GLOBALS['db_link'], "UNLOCK TABLES;");
if ($typetolog != '0' and $abouttolog != '0') {
    player_actions($player['id'], $typetolog, $abouttolog);
}

