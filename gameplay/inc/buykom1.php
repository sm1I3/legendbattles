<?
mysqli_query($GLOBALS['db_link'], "LOCK TABLES market READ, market WRITE;");
if ($act == 1) {
    $ITEM = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT invent.*, items.* FROM invent INNER JOIN items ON invent.protype = items.id WHERE invent.id_item='" . intval($id) . "' and invent.pl_id='" . intval($uid) . "' LIMIT 1;"));
    if ($ITEM != '') {
        mysqli_query($GLOBALS['db_link'], "UPDATE invent SET pl_id='" . $player['id'] . "' WHERE id_item='" . intval($id) . "' LIMIT 1;");
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET reput1=reput1+" . $ITEM['sellprice'] . " WHERE id='" . intval($uid) . "' LIMIT 1;");
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET reput1=reput1-" . $ITEM['sellprice'] . " WHERE id='" . $player['id'] . "' LIMIT 1;");
        $ms = "top.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> Персонаж <b>$player[login]</b> купил у вас <b>" . $ITEM['name'] . "</b>!</b></font><BR>'+'');" . $GLOBALS['redirect'];
        chmsg($ms, $login);
        log_write("buy", $ITEM['name'] . " (гос цена: " . $ITEM['price'] . ")", $ITEM['sellprice'], $login);
        $plmsg = "top.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> Вы удачно купили <b>" . $ITEM['name'] . "</b> за <b>" . $price . "</b> LR!</b></font><BR>'+'');" . $GLOBALS['redirect'];
        chmsg($plmsg, $player['login']);

    }
} else if ($act == 2) {
    $ms = "top.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> Персонаж <b>$player[login]</b> отказался от покупки!</b></font><BR>'+'');$redirect";
    chmsg($ms, $login);
} else if ($act == 3) {
    $ITEM = mysqli_query($GLOBALS['db_link'], "SELECT `invent`.*, `items`.* FROM `invent` INNER JOIN `items` ON `invent`.`protype` = `items`.`id` WHERE `invent`.`protype`='" . $_GET['id'] . "' AND `pl_id`='" . $_GET['uid'] . "'  AND `invent`.`used`='0' AND `invent`.`bank`='0'  AND `invent`.`clan`='0';");
    if (mysqli_num_rows($ITEM) > 0) {
        $col = mysqli_num_rows($ITEM);
        $ITEM = mysqli_fetch_assoc($ITEM);
        mysqli_query($GLOBALS['db_link'], "UPDATE `invent` SET `pl_id`='" . $player['id'] . "' WHERE `protype`='" . intval($_GET['id']) . "' AND `pl_id`='" . $_GET['uid'] . "' AND `invent`.`used`='0' AND `invent`.`bank`='0'  AND `invent`.`clan`='0';");
        mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `reput1`=`reput1`+'" . ($ITEM['sellprice'] * $col) . "' WHERE `id`='" . intval($uid) . "' LIMIT 1;");
        mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `reput1`=`reput1`-'" . ($ITEM['sellprice'] * $col) . "' WHERE `id`='" . $player['id'] . "' LIMIT 1;");
        $ms = "top.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> Персонаж <b>" . $player['login'] . "</b> купил у вас <b>" . $ITEM['name'] . "</b> " . $col . " шт!</b></font><BR>'+'');$redirect";
        chmsg($ms, $login);
        log_write("buy", $ITEM['name'] . " (гос цена: " . $ITEM['price'] . ")" . "(количество: " . $col . " шт.)", ($ITEM['sellprice'] * $col), $login);
        $plmsg = "top.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> Вы удачно купили <b>" . $ITEM['name'] . "</b> за <b>" . ($ITEM['sellprice'] * $col) . "</b> LR!</b></font><BR>'+'');$redirect";
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
            if ($player['reput1'] >= $IT['price']) {
                if ($IT['srok'] > 0) {
                    $srok2 = 86400 * $IT['srok'];
                    $srok = time() + $srok2;
                    mysqli_query($GLOBALS['db_link'], 'INSERT INTO invent (protype,pl_id,dolg,price,arenda,srok) VALUES (' . AP . $IT['id'] . AP . ',' . AP . $player['id'] . AP . ',' . AP . $dolg . AP . ',' . AP . $IT['price'] . AP . ',' . AP . $srok . AP . ',' . AP . $srok . AP . ');');
                } else {
                    mysqli_query($GLOBALS['db_link'], 'INSERT INTO invent (protype,pl_id,dolg,price) VALUES (' . AP . $IT['id'] . AP . ',' . AP . $player['id'] . AP . ',' . AP . $dolg . AP . ',' . AP . $IT['price'] . AP . ');');
                }
                mysqli_query($GLOBALS['db_link'], 'UPDATE market SET kol=kol-1 WHERE id=' . AP . $wsuid . AP . 'LIMIT 1;');
                mysqli_query($GLOBALS['db_link'], 'UPDATE user SET reput1=reput1-' . AP . $IT['price'] . AP . ' WHERE id=' . AP . $player['id'] . AP . 'LIMIT 1;');
                $msg = "<b><font class=proce>Вы удачно купили:<br><font class=proceg> " . $IT['name'] . " </font><br></font></b>";
                log_write("buy", $IT['name'], $IT['price'], "market");
            } else {
                $msg = "<b><font class=proce>Нехватает денег!</font></b>";
            }
        } elseif (($col == 10 or $col == 50) and $IT['kol'] >= $col) {
            if ($player['reput1'] >= ($IT['price'] * $col)) {
                $insert = "";
                for ($i = 0; $i < $col; $i++) {
                    $insert .= "('" . $IT['id'] . "','" . $player['id'] . "','" . $dolg . "','" . $IT['price'] . "'),";
                }
                $insert = substr($insert, 0, strlen($insert) - 1);
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype`,`pl_id`,`dolg`,`price`) VALUES " . $insert . ";");
                mysqli_query($GLOBALS['db_link'], "UPDATE `market` SET `kol`=`kol`-'" . $col . "' WHERE id='" . $wsuid . "';");
                mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `reput1`=`reput1`-'" . ($IT['price'] * $col) . "' WHERE `id`='" . $player['id'] . "' LIMIT 1;");
                $msg = "<b><font class=proce>Вы удачно купили:<br><font class=proceg> " . $IT['name'] . " </font><br> в количестве " . $col . " шт.</font></b>";
                log_write("buy", $IT['name'], $IT['price'], "market");
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
                mysqli_query($GLOBALS['db_link'], 'INSERT INTO invent (protype,pl_id,dolg,dd_price) VALUES (' . AP . $IT['id'] . AP . ',' . AP . $player['id'] . AP . ',' . AP . $dolg . AP . ',' . AP . $IT['dd_price'] . AP . ');');
                mysqli_query($GLOBALS['db_link'], 'UPDATE market SET kol=kol-1 WHERE id=' . AP . $wsuid . AP . 'LIMIT 1;');
                mysqli_query($GLOBALS['db_link'], 'UPDATE user SET baks=baks-' . AP . $IT['dd_price'] . AP . ' WHERE id=' . AP . $player['id'] . AP . 'LIMIT 1;');
                $msg = "<b><font class=proce>Вы удачно купили:<br><font class=proceg> " . $IT['name'] . " </font><br></font></b>";
                log_write("buy", $IT['name'], $IT['dd_price'], "market");
            } else {
                $msg = "<b><font class=proce>Нехватает денег!</font></b>";
            }
        }
    }
}
mysqli_query($GLOBALS['db_link'], "UNLOCK TABLES;");

