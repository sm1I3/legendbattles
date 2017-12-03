<?
db_query('DELETE FROM invent WHERE id_item=' . AP . $uid . AP . ' and pl_id=' . AP . $player[id] . AP . 'LIMIT 1;');
db_query('UPDATE user SET dnv=dnv+' . AP . $sum . AP . ' WHERE id=' . AP . $player['id'] . AP . 'LIMIT 1;');
db_query('UPDATE market SET kol=kol+1 WHERE id=' . AP . $prot . AP . ' and market=' . AP . $player[loc] . AP . ' LIMIT 1;');
$msg = "<b><font class=proce>Вы удачно продали <font class=proceg>" . $wn . "</font> за " . $sum . " DLR!</font></font></b>";
log_write("sell", $wn, $sum, "market");
?>
