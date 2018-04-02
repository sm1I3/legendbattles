<?
mysqli_query($GLOBALS['db_link'],'INSERT INTO clan_kazna (id_item,protype,pl_id,clan_id) VALUES ('.AP.$uid.AP.','.AP.$prot.AP.','.AP.$player[id].AP.','.AP.$player[clan_id].AP.')');
mysqli_query($GLOBALS['db_link'],'UPDATE invent SET gift=1,gift_from='.AP.$player[login].AP.',clan=1 WHERE pl_id='.AP.$player[id].AP.' AND id_item='.AP.$uid.AP.'');
$msg = "<b><font class=nickname><font color=#cc0000>Вы положили $wn в казну!</font></font></b>";
