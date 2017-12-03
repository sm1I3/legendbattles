<?
if ($_GET['identify']) {
    $_GET['identify'] = intval($_GET['identify']);
    $it = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `invent` WHERE `pl_id`='" . $player['id'] . "' and `protype`='" . $_GET['identify'] . "';");
    $itemcount = mysqli_num_rows($it);
    if ($itemcount > 0) {
        if ($player['nv'] >= ($itemcount * 100)) {
            $itemtype = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `items` WHERE `id`='" . $_GET['identify'] . "' LIMIT 1;"));
            $itemstogive = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `items` WHERE `type`='w100' AND `effect`='" . $itemtype['effect'] . "00' ORDER BY rand();");
            $itnames = array();
            $itemsarr = array();
            $b = 0;
            while ($row = mysqli_fetch_assoc($itemstogive)) {
                $itemsarr[] = $row;
                $b++;
            }
            for ($i = 0; $i < $itemcount; $i++) {
                $rndbot = rand(0, $b - 1);
                $row = $itemsarr[$rndbot];
                if ($row['id']) {
                    if (rand(1, 100) < 71 or $itemcount == 1) {
                        $pr = explode("|", $row['param']);
                        foreach ($pr as $value) {
                            $stat = explode("@", $value);
                            switch ($stat[0]) {
                                case 2:
                                    $dolg = $stat[1];
                                    break;
                            }
                        }
                        $insert .= "('" . $row['id'] . "','" . $player['id'] . "','" . $dolg . "','" . $row['price'] . "','" . (time() + 604800) . "','0'),";
                        $itnames[] = $row['name'];
                    } else {
                        echo "<div align=center><b><font class=proce>При попытке распознания ресурс был разрушен.</font></b></div>";
                    }
                }
            }
            if ($insert) {
                $insert = substr($insert, 0, strlen($insert) - 1);
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype`,`pl_id`,`dolg`,`price`,`death`,`clan`) VALUES " . $insert . ";");
                mysqli_query($GLOBALS['db_link'], "DELETE FROM `invent` WHERE `pl_id`='" . $player['id'] . "' AND `protype`='" . $_GET['identify'] . "';");
                mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `nv`=`nv`-'" . (100 * $itemcount) . "' WHERE `id`='" . $player['id'] . "' LIMIT 1;");
                for ($i = 0; $i < count($itnames); $i++) {
                    echo "<div align=center>Получено: <b>" . $itnames[$i] . " (<font class=proceb>срок годности: 7 дней</font>)</b></div>";
                }
            }
        } else {
            echo "<div align=center><b><font class=proce>Недостаточно денег.</font></b></div>";
        }
    } else {
        echo "<div align=center><b><font class=proce>Не найден ресурс для распознавания.</font></b></div>";
    }
}

$sq = "AND `items`.`type`='w100' AND `items`.`effect`<'100' AND `items`.`effect`>'0' ";
$ITEMS = mysqli_query($GLOBALS['db_link'], "SELECT `invent`.*,  `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`='" . $player['id'] . "' and `invent`.`used`='0' AND `invent`.`bank`='0' AND `invent`.`auction`='0' AND (`arenda`>='" . time() . "' OR `arenda`='0') $sq;");
$num = mysqli_num_rows($ITEMS);
if ($num > 0) {
    $inputs = "<input type=button class=invbut ";
    $inpute = "/> ";
    echo '<table cellpadding=0 cellspacing=0 border=0 width=100%>
	<tr><td bgcolor=#e0e0e0>
	<table cellpadding=3 cellspacing=1 border=0 width=100%>
	<tr><td colspan=4 bgcolor=#F9f9f9>
	<div align=center><font class=inv><b> У Вас с собой ' . $player['nv'] . ' LR и вещей массой: ' . $plstt[71] . ' Максимальный вес: ' . $mass . '</b></div></td></tr>';
    $i = 0;
    while ($ITEM = mysqli_fetch_assoc($ITEMS)) {
        $ItemToOne[$ITEM['id'] + $ITEM['arenda'] + $ITEM['rassrok']][md5($iz . '/' . $ITEM['dolg'] . $ITEM['mod'] . $ITEM['clan'] . $ITEM['grav'])] += 1;
        if ($ItemToOne[$ITEM['id'] + $ITEM['arenda'] + $ITEM['rassrok']][md5($iz . '/' . $ITEM['dolg'] . $ITEM['mod'] . $ITEM['clan'] . $ITEM['grav'])] == 1) {
            $count = mysqli_num_rows(mysqli_query($GLOBALS['db_link'], "SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`='" . $player['id'] . "' and `invent`.`used`='0' and `dolg`='" . $ITEM['dolg'] . "' and `iznos`='" . $ITEM['iznos'] . "' and `items`.`id`='" . $ITEM['id'] . "' and `invent`.`arenda`='" . $ITEM['arenda'] . "' and `invent`.`rassrok`='" . $ITEM['rassrok'] . "' and `invent`.`mod`='" . $ITEM['mod'] . "' and `invent`.`clan`='" . $ITEM['clan'] . "' and `invent`.`grav`='" . $ITEM['grav'] . "' and `invent`.`bank`='0'"));
            $buttons = $inputs . "onclick=\"javascript: if(confirm('Распознать все " . $ITEM['name'] . " по 100LR за шт?')) {location='?hospi_sel=5&identify=" . $ITEM['protype'] . "'}\" value=\" Распознать [ 100 LR ] за шт \"  " . $inpute;
            if ($i == 4) {
                echo '</tr>';
                $i = 0;
            }
            if ($i == 0) {
                echo '<tr>';
            }
            $i++;
            echo '<td bgcolor=#f9f9f9>
					<div align=center><b>' . $ITEM['name'] . '</b><br><font class=weaponch>(количество: ' . (($count > 1) ? '<font color=green>' . $count . '</font>' : '<font color=red>' . $count . '</font>') . ')</div>
					<div align=center><img src=http://img.legendbattles.ru/image/weapon/' . $ITEM['gif'] . ' border=0 title="' . $ITEM['name'] . '"></div>
					<div align=center>' . $buttons . '</div>
					<div align=center>Шанс распознавания 70%</div>
					</td>';
        }
    }

}
