<?
mysqli_query($GLOBALS['db_link'], "DELETE FROM `invent` WHERE `id_item`='" . $uid . "' LIMIT 1;");
mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `baks`=`baks`+'" . $sum . "' WHERE `id`='" . $player['id'] . "' LIMIT 1;");
mysqli_query($GLOBALS['db_link'], "UPDATE `market` SET `kol`=`kol`+'1' WHERE `id`='" . $prot . "' and `market`='" . $player['loc'] . "' LIMIT 1;");
$msg = "<b><font class=proce>Вы удачно продали <font class=proceg>" . $wn . "</font> за " . $sum . " $</font></b>";
$typetolog = '0';
$abouttolog = '0';  # переменные для логов: первая всегда 0
$typetolog .= '@11';
$abouttolog .= '@<b>' . $wn . '</b> (' . $numrow . ' шт.). По цене: <b>' . $sum . '</b> $.';
player_actions($player['id'], $typetolog, $abouttolog);
log_write("selldprise", $wn, $sum, "market");
?>