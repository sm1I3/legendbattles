<?
if ($_SESSION["user"] != '' and $player['firstlogin'] == 0) {
    $prem = "4|" . (time() + 86400 * 14);
    $gfrom = "<font color=000000><b><font color=#377596>Legend</font><font color=#b5170b>Battles.ru</font></b>";
    $item1 = "<b>Еда</b>";
    mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price` ,`curslot` ,`clan` ,`gift` ,`gift_from`) VALUES ('3563',  '" . $player['id'] . "',  '0',  '0',  '100',  '100',  '0',  '0',  '0',  '0',  '" . $gfrom . "');");
    echo "
	<script>
	top.frames['chmain'].add_msg('" . $gfrom . "<b>:</b>&nbsp;<font color=#003399><b>Добро пожаловать.</b></font></font><BR>'+'');
	top.frames['chmain'].add_msg('" . $gfrom . "<b>:</b>&nbsp;<font color=#CC0033><b>У вас  есть возможность взять квест. <img src=http://i.imgur.com/ihfnGdr.png width=60 height=60> </b></font></font><BR>'+'');
	top.frames['chmain'].add_msg('" . $gfrom . "<b>:</b>&nbsp;<font color=#6600FF><b>Бонус + 250 репутации города</b></font></font><BR>'+'');
	top.frames['chmain'].add_msg('" . $gfrom . "<b>:</b>&nbsp;В первую очередь рекомендуется <b>Силы: +3, Ловкость: +3, Везение: +3, Живучесть: +3</b>.</font><BR>'+'');
	top.frames['chmain'].add_msg('" . $gfrom . "<b>:</b>&nbsp;<font color=#993399><b>Администрация проекта даёт уникальную возможность для перспективного и увлекающего развития: активирован один из платных расширенных аккаунтов сроком на 1 месяц.</b></font></font><BR>'+'');
	top.frames['chmain'].add_msg('" . $gfrom . "<b>:</b>&nbsp;<font color=#499399>Команда разработчиков проекта LegendBattles ,<b><font color=#CC0033> даёт уникальную возможность зарабатывать изумруды <img src=/img/razdor/emerald.png width=14 height=14> . За каждые 10 часов Вы будете получать по 1 <img src=/img/razdor/emerald.png width=14 height=14> изумруду ,которые сможете потратить в </b> <font color=#993399> Доме Ценителей. </b> <a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" onclick=\"window.open(\'../taimer.php\',\'\');\" title=\"Перейте\">Ознакомиться более подробнее<font style=\"font-size: 10px;\">>>></b></b></font></font><BR>'+'');
	top.frames['chmain'].add_msg('" . $gfrom . "<b>:</b>&nbsp;Желаем вам побольше <b>Побед</b>.</font><BR>'+'');
	top.set_lmid(8);
	</script>";
    mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `firstlogin`='1',`Premium`='" . $prem . "' WHERE `id`='" . $player['id'] . "' LIMIT 1;");
    $newplayerms = "top.frames['chmain'].add_msg('<font class=massm>&nbsp;&nbsp;<b>News.legendbattles.ru</b>&nbsp;&nbsp;</font>В свет наших земель вышел будущий герой <b>" . $player['login'] . "</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?" . $player['login'] . "\" target=\"_blank\"><img src=/img/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?" . $player['login'] . "\');\" ></a>, желаем увлекательного пребывания в нашем мире.</font><BR>'+'');";
    chmsg($newplayerms, "");
}
