<?
$typetolog = '0';
$abouttolog = '0';  # переменные для логов: первая всегда 0
mysqli_query($GLOBALS['db_link'], "LOCK TABLES market READ, market WRITE;");
if ($act == 1) {
    $ITEM = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT `invent`.*, `items`.* FROM `invent` INNER JOIN `items` ON `invent`.`protype` = `items`.`id` WHERE `invent`.`id_item`='" . intval($id) . "' and `invent`.`pl_id`='" . intval($uid) . "' LIMIT 1;"));
    if ($ITEM != '') {
        mysqli_query($GLOBALS['db_link'], "UPDATE `invent` SET `pl_id`='" . $player['id'] . "' WHERE `id_item`='" . intval($id) . "' LIMIT 1;");
        mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `nv`=`nv`+'" . intval($price) . "' WHERE `id`='" . intval($uid) . "' LIMIT 1;");
        mysqli_query($GLOBALS['db_link'], "UPDATE u`user` SET `nv`=`nv`-'" . intval($price) . "' WHERE `id`='" . $player['id'] . "' LIMIT 1;");
        chmsg($redirect, $login);
    }
} else {
    $wsuid = intval($wsuid);
    $IT = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT `market`.*, `items`.*
FROM `market` LEFT JOIN `items` ON `market`.`id` = `items`.`id`
WHERE `kol`>'0' AND `items`.`dd_price`>'0' AND `items`.`id`='" . intval($wsuid) . "' LIMIT 1;"));
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
            mysqli_query($GLOBALS['db_link'], 'INSERT INTO invent (protype,pl_id,dolg,dd_price) VALUES (' . AP . $IT[id] . AP . ',' . AP . $player[id] . AP . ',' . AP . $dolg . AP . ',' . AP . $IT[dd_price] . AP . ');');
            mysqli_query($GLOBALS['db_link'], 'UPDATE market SET kol=kol-1 WHERE id=' . AP . $wsuid . AP . 'LIMIT 1;');
            mysqli_query($GLOBALS['db_link'], 'UPDATE user SET baks=baks-' . AP . $IT[dd_price] . AP . ' WHERE id=' . AP . $player[id] . AP . 'LIMIT 1;');
            $msg = "<b><font class=proce>Вы удачно купили:<br><font class=proceg> " . $IT['name'] . " </font><br></font></b>";
            $typetolog .= '@10';
            $abouttolog .= '@<b>' . $IT['name'] . '</b>. По цене: ' . $IT['dd_price'];
            log_write("buy", $IT[name], $IT[dd_price], "market");
        } else {
            $msg = "<b><font class=proce>Нехватает денег</font></b>";
        }
    }
}
mysqli_query($GLOBALS['db_link'], "UNLOCK TABLES;");
if ($typetolog != '0' and $abouttolog != '0') {
    player_actions($player['id'], $typetolog, $abouttolog);
}
?>
