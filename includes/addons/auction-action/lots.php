<?php
function lr($lr)
{
    $b = $lr % 100;
    $s = intval(($lr % 10000) / 100);
    $g = intval($lr / 10000);
    return (($g) ? $g . ' <img src=/img/image/gold.png width=14 height=14 valign=middle title=Золото>  ' : '') . (($s) ? $s . ' <img src=/img/image/silver.png width=14 height=14 valign=middle title=Серебро> ' : '') . (($b) ? $b . ' <img src=/img/image/bronze.png width=14 height=14 valign=middle title=Бронза> ' : '');
}

// Functions
function ReturnTime($time)
{
    if ($time < 3600) {
        return "мало";
    }
    return "много";
}

function GetInventId($uId)
{
    return mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT `invent`.*,  `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `invent`.`id_item` = '" . $uId . "'"));
}

// Function
if ($_POST['p_id'] == 1) {
    print_r($_POST);
    echo '<center>Фильтр временно не работает</center>';
}
if ($_POST['p_id'] == 2) {
    $getItem = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `auction_system` WHERE `status`='active' AND `id`='" . intval($_POST['itemId']) . "'"));
    $_POST['price'] = intval($_POST['price']);
    if ($_POST['price'] <= $getItem['price']) {
        echo "<script>parent.jAlert('Ставка должна быть больше цены.');</script>";
    } else if ($_POST['price'] > $pers['nv']) {
        echo "<script>parent.jAlert('У вас недостаточно средств для этой ставки.');</script>";
    } else {
        if ($getItem['bet'] != 'none') {
            $Beters = explode('|', $getItem['oldbet']);
            if (!in_array($getItem['bet'], $Beters)) {
                $getItem['oldbet'] .= ($getItem['oldbet'] ? $getItem['bet'] . '|' : '|' . $getItem['bet'] . '|');
            }
            mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `nv`=`nv`+'" . $getItem['price'] . "' WHERE `login`='" . $getItem['bet'] . "'");
            chmsg("<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;Ваша ставка на аукционе была перебита.</font>", $getItem['bet']);
        }
        echo "<script>parent.jAlert('Все прошло удачно, ставка повышена.');</script>";
        mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `nv`=`nv`-'" . mysqli_real_escape_string($GLOBALS['db_link'], $_POST['price']) . "' WHERE `id`='" . $pers['id'] . "'");
        mysqli_query($GLOBALS['db_link'], "UPDATE `auction_system` SET `price`='" . mysqli_real_escape_string($GLOBALS['db_link'], $_POST['price']) . "',`bet`='" . $pers['login'] . "',`oldbet`='" . $getItem['oldbet'] . "' WHERE `id`='" . $getItem['id'] . "'");
        $pers['nv'] -= $_POST['price'];
    }
}
if ($_POST['p_id'] == 3) {
    $getItem = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `auction_system` WHERE `status`='active' AND `id`='" . intval($_POST['itemId']) . "'"));
    if ($getItem['maxprice'] > $pers['nv']) {
        echo "<script>parent.jAlert('У вас недостаточно средств для покупки.');</script>";
    } else {
        if ($getItem['bet'] != 'none') {
            $Beters = explode('|', $getItem['oldbet']);
            if (!in_array($getItem['bet'], $Beters)) {
                $getItem['oldbet'] .= ($getItem['oldbet'] ? $getItem['bet'] . '|' : '|' . $getItem['bet'] . '|');
            }
            mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `nv`=`nv`+'" . $getItem['price'] . "' WHERE `login`='" . $getItem['bet'] . "'");
            chmsg("<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;Ваша ставка на аукционе аннулирована, лот был выкуплен.</font>", $getItem['bet']);
        }
        echo "<script>parent.jAlert('Вы успешно купили лот.');</script>";
        chmsg("<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;Ваш лот был продан за <b>" . lr($getItem['maxprice'] * 0.95) . "</b>.</font>", mysqli_result(mysqli_query($GLOBALS['db_link'], "SELECT `login` FROM `user` WHERE `id`='" . $getItem['userID'] . "'"), 0));
        mysqli_query($GLOBALS['db_link'], "UPDATE `auction_system` SET `status`='finished',`bet`='" . $pers['login'] . "',`oldbet`='" . $getItem['oldbet'] . "' WHERE `id`='" . $getItem['id'] . "'");
        mysqli_query($GLOBALS['db_link'], "UPDATE `invent` SET `auction`='0',`pl_id`='" . $pers['id'] . "' WHERE `id_item`='" . $getItem['itemID'] . "'");
        mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `nv`=`nv`-'" . $getItem['maxprice'] . "' WHERE `id`='" . $pers['id'] . "'");
        mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `nv`=`nv`+'" . ($getItem['maxprice'] * 0.95) . "' WHERE `id`='" . $getItem['userID'] . "'");
        $pers['nv'] -= $getItem['maxprice'];
    }
}
if (isset($_GET["weapon_category"]))
    $ext = " AND `items`.`type`='" . preg_replace('/[^w0-9]/', '', $_GET["weapon_category"]) . "'";
else $ext = '';
$Query = mysqli_query($GLOBALS['db_link'], "SELECT `auction_system`.* FROM `auction_system` WHERE `auction_system`.`status`='active'" . $ext);
?>
<script>
    ShowRate = function (id, price) {
        document.getElementById('ContentPopUp').innerHTML = '<center><form method="POST" action=""><font class="nickname"><input type="hidden" name="p_id" value="2" /><input type="hidden" name="itemId" value="' + id + '" />Ваша ставка: <input type="text" name="price" class="lbut" width="100%" value="' + Math.floor(price * 0.15 + parseInt(price)) + '" /><br /><input type="submit" class="lbut" value="Ок" /></font></form></center>';
        FormPopUp('darker');
    }
</script>
<tr>
    <td>
        <a href='?useaction=auction-action&addid=lots&weapon_category=w4'>
            <img src=/img/image/gameplay/shop/knife.gif title="Ножи" width=40 height=50>
        </a>
        <a href='?useaction=auction-action&addid=lots&weapon_category=w1'>
            <img src=/img/image/gameplay/shop/sword.gif title="Мечи" width=40 height=50>
        </a>
        <a href='?useaction=auction-action&addid=lots&weapon_category=w2'>
            <img src=/img/image/gameplay/shop/axe.gif title="Топоры" width=40 height=50>
        </a>
        <a href='?useaction=auction-action&addid=lots&weapon_category=w3'>
            <img src=/img/image/gameplay/shop/crushing.gif title="Дробящие" width=40 height=50>
        </a>
        <a href='?useaction=auction-action&addid=lots&weapon_category=w6'>
            <img src=/img/image/gameplay/shop/spears_helbeards.gif title="Алебарды и двуручное" width=40 height=50>
        </a>
        <a href='?useaction=auction-action&addid=lots&weapon_category=w5'>
            <img src=/img/image/gameplay/shop/missle.gif title="Копья и метательное" width=40 height=50>
        </a>
        <a href='?useaction=auction-action&addid=lots&weapon_category=w7'>
            <img type=image src=/img/image/gameplay/shop/wand.gif title="Посохи" width=40 height=50>
        </a>
        <a href='?useaction=auction-action&addid=lots&weapon_category=w20'>
            <img src=/img/image/gameplay/shop/shield.gif title="Щиты" width=40 height=50>
        </a>
        <a href='?useaction=auction-action&addid=lots&weapon_category=w23'>
            <img src=/img/image/gameplay/shop/helm.gif title="Шлемы" width=40 height=50>
        </a>
        <a href='?useaction=auction-action&addid=lots&weapon_category=w26'>
            <img src=/img/image/gameplay/shop/belt.gif title="Пояса" width=40 height=50>
        </a>
        <a href='?useaction=auction-action&addid=lots&weapon_category=w18'>
            <img src=/img/image/gameplay/shop/armor_light.gif title="Кольчуги" width=40 height=50>
        </a>
        <a href='?useaction=auction-action&addid=lots&weapon_category=w19'>
            <img src=/img/image/gameplay/shop/armor_hard.gif title="Доспехи" width=40 height=50>
        </a>
        <a href='?useaction=auction-action&addid=lots&weapon_category=w24'>
            <img src=/img/image/gameplay/shop/gloves.gif title="Перчатки" width=40 height=50>
        </a>
        <a href='?useaction=auction-action&addid=lots&weapon_category=w80'>
            <img src=/img/image/gameplay/shop/armlet.gif title="Наручи" width=40 height=50>
        </a>
        <a href='?useaction=auction-action&addid=lots&weapon_category=w21'>
            <img src=/img/image/gameplay/shop/boots.gif title="Сапоги" width=40 height=50>
        </a>
        <a href='?useaction=auction-action&addid=lots&weapon_category=w25'>
            <img src=/img/image/gameplay/shop/amulet.gif title="Кулоны" width=40 height=50>
        </a>
        <a href='?useaction=auction-action&addid=lots&weapon_category=w22'>
            <img src=/img/image/gameplay/shop/ring.gif title="Кольца" width=40 height=50>
        </a>
        <a href='?useaction=auction-action&addid=lots&weapon_category=w28'>
            <img src=/img/image/gameplay/shop/spaudler.gif title="Наплечники" width=40 height=50>
        </a>
        <a href='?useaction=auction-action&addid=lots&weapon_category=w90'>
            <img src=/img/image/gameplay/shop/knee_guard.gif title="Поножи" width=40 height=50>
        </a>
        <a href='?useaction=auction-action&addid=lots&weapon_category=w66'>
            <img src=/img/image/gameplay/invent/1.gif title="Алхимия" width=40 height=50>
        </a>
        <a href='?useaction=auction-action&addid=lots&weapon_category=w70'>
            <img src=/img/image/gameplay/invent/6.gif title="Мази" width=40 height=50>
        </a>
        <a href='?useaction=auction-action&addid=lots&weapon_category=w69'>
            <img src=/img/image/gameplay/invent/2.gif title="Рыба" width=40 height=50>
        </a>
        <a href='?useaction=auction-action&addid=lots&weapon_category=w71'>
            <img src=/img/image/gameplay/invent/3.gif title="Руны" width=40 height=50>
        </a>
        <a href='?useaction=auction-action&addid=lots&weapon_category=w68'>
            <img src=/img/image/gameplay/invent/4.gif title="Лес" width=40 height=50>
        </a>
        <a href='?useaction=auction-action&addid=lots&weapon_category=w60'>
            <img src=/img/image/gameplay/invent/23.gif title="Квестовые предметы" width=40 height=50>
        </a>
        <a href='?useaction=auction-action&addid=lots&weapon_category=w61'>
            <img src=/img/image/gameplay/invent/8.gif title="Приманка" width=40 height=50>
        </a>
        <a href='?useaction=auction-action&addid=lots&weapon_category=w29'>
            <img src=/img/image/gameplay/shops/svit.gif title="Свитки" width=40 height=50>
        </a>
        <a href='?useaction=auction-action&addid=lots&weapon_category=w30'>
            <img src=/img/image/gameplay/invent/10.gif title="Лицензии" width=40 height=50>
        </a>
        <a href='?useaction=auction-action&addid=lots&weapon_category=w62'>
            <img src=/img/image/gameplay/invent/db.gif title="Сундуки" width=40 height=50>
        </a>
        <a href='?useaction=auction-action&addid=lots&weapon_category=w0'>
            <img src=/img/image/gameplay/invent/cat/21.gif title="Зелья" width=40 height=50>
        </a>
    </td>
</tr>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td bgcolor="#cccccc">
            <table width="100%" border="0" cellpadding="1" cellspacing="1">
                <tr>
                    <td align="center" width="50%" bgcolor="#D8D8D8">
                        <font class="nickname">
                            Ваши деньги: <b><?php echo lr($pers['nv']); ?></b>
                        </font>
                    </td>
                    <td align="center" width="50%" bgcolor="#D8D8D8">
                        <font class="nickname">
                            <strong><em><a href="http://forum.legendbattles.ru/index.php?act=show_topic&amp;id=164"
                                           target="_blank">Закон о торговле (Аукцион)</a></em></strong>
                            <b><?= lr(0) ?></b>
                        </font>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>

        <div class="block market">


    </tr>
    <tr>
        <td bgcolor="#cccccc"><?php
    if (mysqli_num_rows($Query) > 0) {
        echo '<table width="100%" border="0" cellpadding="1" cellspacing="1">
			<tr>
				<td align="center" width="66" bgcolor="#D8D8D8">
					<font class="nickname">
						&nbsp;
					</font>
				</td>
				<td align="center" bgcolor="#D8D8D8">
					<font class="nickname">
						<b>Название</b>
					</font>
				</td>
				<td align="center" bgcolor="#D8D8D8">
					<font class="nickname">
						<b>Время</b>
					</font>
				</td>
				<td align="center" bgcolor="#D8D8D8">
					<font class="nickname">
						<b>Продавец</b>
					</font>
				</td>
				<td align="center" bgcolor="#D8D8D8">
					<font class="count">
						<b>Количество</b>
					</font>
				</td>
				</td>
				<td align="center" bgcolor="#D8D8D8">
					<font class="nickname">
						<b>Цена за шт.</b>
					</font>
				</td>
				<td align="center" bgcolor="#D8D8D8">
					<font class="nickname">
						<b>Выкуп</b>
					</font>
				</td>
			</tr>';
        $i = 0;
        while ($row = mysqli_fetch_assoc($Query)) {
            $i++;
            $bgcolor = (($i % 2) ? 'f0f0f0' : 'ffffff');
            $UserInfo = GetUserFID($row['userID'], true);
            $ItemInfo = GetInventId($row['itemID']);
            if ($ItemInfo['mod_color'] != '0' or $ItemInfo['modified'] != '0') $ItemInfo['name'] .= '[ап]';
            echo '						<tr>
				<td align="center" width="66" bgcolor="#' . $bgcolor . '">
					<font class="nickname">
				<img src="/img/image/weapon/' . $ItemInfo['gif'] . '" onmouseover="tooltip(this,\'<b>' . $ItemInfo['name'] . '</b><br><b><font color=#336699>Щелкните по изображению для просмотра подробной информации о предмете.</font></b>\')" onmouseout="hide_info(this)" onclick="window.open(\'http://www.legendbattles.ru/iteminfo.php?i=' . $ItemInfo['id_item'] . '&auc=1\');" style="cursor:pointer;" align=absmiddle>
			</td>
				<td bgcolor="#' . $bgcolor . '">
					<font class="nickname">
					   <b>' . $ItemInfo['name'] . '' . $itemsql['name'] . '<a href="/iteminfo.php?i=' . $ItemInfo['id_item'] . '&auc=1" target="_blank"><img src="/img/chat/info.gif" width="11" height="12" border="0" align="absmiddle"></a>' . '</b>
						</b><br />
						Уровень: <b>' . $ItemInfo['level'] . '</b><br />
						Масса: <b>' . $ItemInfo['massa'] . '
						</b><br />
						Долговечность: <b>' . $ItemInfo['dolg'] . '' . $stat[1] / $stat[1] . '</b><br />
					</font>
				</td>
				<td align="center" bgcolor="#' . $bgcolor . '">
					<font class="nickname">
						<b>' . ReturnTime($row['time'] - time()) . '</b>
					</font>
				</td>
				<td align="center" bgcolor="#' . $bgcolor . '">
					<font class="nickname">
						<b>' . $UserInfo['login'] . '[' . $UserInfo['level'] . ']<a href="/ipers.php?' . $UserInfo['login'] . '" target="_blank"><img src="/img/chat/info.gif" width="11" height="12" border="0" align="absmiddle"></a>' . '</b>
					</font>
														</td>
				<td align="center" bgcolor="#' . $bgcolor . '">
					<font class="nickname">
						<b>' . $count . ' шт.</b>
					</font>
				</td>
				</td>
				<td align="center" bgcolor="#' . $bgcolor . '">
					<font class="nickname">
						' . ($UserInfo['login'] != $pers['login'] ? '<b>' . lr($row['maxprice']) . '</form>' : '---') . ' 
					</font>
				</td>
				</td>
				<td align="center" bgcolor="#' . $bgcolor . '">
					<font class="nickname">
						' . ($UserInfo['login'] != $pers['login'] ? '<b>' . lr($row['maxprice']) . '</b><br /><form method="POST" action=""><input type="hidden" name="p_id" value="3" /><input type="hidden" name="itemId" value="' . $row['id'] . '" /><input type="submit" class="lbut" value="купить" /></form>' : '---') . ' 
					</font>
				</td>
			</tr>';
        }
    } else {
        echo '<table width="100%" border="0" cellpadding="1" cellspacing="1">
			<tr>
				<td align="center" width="100%" bgcolor="#D8D8D8">
					<b>Не найдено ни одного лота!</b>
				</td>
			</tr>
		</table>';
    }
    ?></table></td>
</tr>
</table>