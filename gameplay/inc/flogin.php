<?	
if($_SESSION["user"]!='' and $player['firstlogin']==0){
	$prem="4|".(time()+86400*14);
	$gfrom="<font color=000000><b><font color=#377596>Legend</font><font color=#b5170b>Battles.ru</font></b>";
	$item1="<b>���</b>";
	mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price` ,`curslot` ,`clan` ,`gift` ,`gift_from`) VALUES ('3563',  '".$player['id']."',  '0',  '0',  '100',  '100',  '0',  '0',  '0',  '0',  '".$gfrom."');");
	echo"
	<script>
	top.frames['chmain'].add_msg('".$gfrom."<b>:</b>&nbsp;<font color=#003399><b>����� ����������.</b></font></font><BR>'+'');
	top.frames['chmain'].add_msg('".$gfrom."<b>:</b>&nbsp;<font color=#CC0033><b>� ���  ���� ����������� ����� �����. <img src=http://i.imgur.com/ihfnGdr.png width=60 height=60> </b></font></font><BR>'+'');
	top.frames['chmain'].add_msg('".$gfrom."<b>:</b>&nbsp;<font color=#6600FF><b>����� + 250 ��������� ������</b></font></font><BR>'+'');
	top.frames['chmain'].add_msg('".$gfrom."<b>:</b>&nbsp;� ������ ������� ������������� <b>����: +3, ��������: +3, �������: +3, ���������: +3</b>.</font><BR>'+'');
	top.frames['chmain'].add_msg('".$gfrom."<b>:</b>&nbsp;<font color=#993399><b>������������� ������� ��� ���������� ����������� ��� �������������� � ����������� ��������: ����������� ���� �� ������� ����������� ��������� ������ �� 1 �����.</b></font></font><BR>'+'');
	top.frames['chmain'].add_msg('".$gfrom."<b>:</b>&nbsp;<font color=#499399>������� ������������� ������� LegendBattles ,<b><font color=#CC0033> ��� ���������� ����������� ������������ �������� <img src=/img/razdor/emerald.png width=14 height=14> . �� ������ 10 ����� �� ������ �������� �� 1 <img src=/img/razdor/emerald.png width=14 height=14> �������� ,������� ������� ��������� � </b> <font color=#993399> ���� ���������. </b> <a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" onclick=\"window.open(\'../taimer.php\',\'\');\" title=\"�������\">������������ ����� ���������<font style=\"font-size: 10px;\">>>></b></b></font></font><BR>'+'');
	top.frames['chmain'].add_msg('".$gfrom."<b>:</b>&nbsp;������ ��� �������� <b>�����</b>.</font><BR>'+'');
	top.set_lmid(8);
	</script>";
	mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `firstlogin`='1',`Premium`='".$prem."' WHERE `id`='".$player['id']."' LIMIT 1;");
	$newplayerms="top.frames['chmain'].add_msg('<font class=massm>&nbsp;&nbsp;<b>News.legendbattles.ru</b>&nbsp;&nbsp;</font>� ���� ����� ������ ����� ������� ����� <b>".$player['login']."</b><a style=\"COLOR: #336699;text-decoration : none;cursor: pointer;\" href=\"/ipers.php?".$player['login']."\" target=\"_blank\"><img src=/img/image/chat/info.gif width=11 height=12 border=0 onClick=\"window.open(\'http://legendbattles.ru/ipers.php?".$player['login']."\');\" ></a>, ������ �������������� ���������� � ����� ����.</font><BR>'+'');";
	chmsg($newplayerms,"");
}
?>