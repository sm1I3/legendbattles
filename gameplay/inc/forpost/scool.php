
<html>
<META content="text/html; charset=windows-1251" Http-Equiv=Content-type>
<META Http-Equiv=Cache-Control Content=no-cache>
<META Http-Equiv=PRAGMA content=NO-CACHE>
<META Http-Equiv=Expires Content=0>
<HEAD>
<LINK href=./css/info_loc.css rel=STYLESHEET type=text/css>
<script type="text/javascript" src="/js/interface/get_windows2.js"></script>
<script type="text/javascript" src="/js/frame_loc.js"></script>

<SCRIPT>
var clevel='';
var currentID=1078509722;
function dw(s) {document.write(s);}
function highl(nm, i)
{	if (clevel == nm) { document.all(nm).className = 'lbut' }
	else {
		if (i==1) { document.all(nm).className = 'lbut' }
		else { document.all(nm).className = 'lbut' }
	}
}
</SCRIPT>
</HEAD>
<body>
<script>
d.write('<TABLE cellpadding=0 cellspacing=0 width=100%><TR><TD>');

	d.write('<table cellpadding=0 cellspacing=0 border=0 align=center width=760><tr valign=top><td>');
</script>
<div class="block info">
	<div class="header">
		<span>������� ��������</span>
	
<table width=100% cellspacing=0 border=0 cellpadding=0>
<td valign=top>

<img border="0" src="/img/image/scool.gif" width="450" height="250">

<td width=0 valign=top style="width: 100%;">
<div class="block info">
	<div class="header">
		<span><?
echo "<center>� ��� � ����� <b>".lr($player["nv"])."  ".$player["baks"]." <img src=/img/razdor/emerald.png width=14 height=14 valign=middle title=�������></b></center>";
?></span></div>
<table width=80% cellspacing=0 cellpadding=0  border=0 style="width: 550;" align=center>

</table>
<script>
function learn_um(params) {
w = params.split('|');
inner = '<form action=main.php method=get id=learn_um><input type=hidden name=um_name value="'+w[0]+'"><input type=hidden name=learn_um value="'+w[1]+'"><input type=hidden name=mode value=um><table width=100% cellpadding=7><tr><td width=10></td><td valign=top><b>�������  &laquo;'+w[0]+'&raquo;</b></td></tr></table></FORM>';
message_window ('confirm','<b>�������  &laquo;'+w[0]+'&raquo;</b>',inner,'accept|cancel','click|d.getElementById(\'learn_um\').submit();')
}
</script>

<?
if (@$_GET["mode"]=='' and (@$_GET["mode"]!='um' or @$_GET["mode"]!='pr')) {
echo "<center><b><font color='#990000'>�������� ��������</font></b></center>";
}
## ���� ��������.


if (@$_GET["learn_um"] == 'alhim'){
if ($player["alhim"]>0)
$message = '<strong>��� �������.</strong>';
elseif ($player["nv"]<100)
$message = '<strong>�� ������� �����.</strong>';
else {
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `alhim`=1,`nv`=`nv`-100 WHERE `id`='".$player["id"]."' LIMIT 1 ");
chmsg("top.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font><font color=000000><b><font color=#cc0000>��������! </font></b>�������� ������ <b>".$_GET["um_name"]."</b>.<BR>'+'');",$player['login']);
echo('<script>location = "main.php?mode=um";</script>');
}
}
if (@$_GET["learn_um"] == 'alhim1'){
if ($player["alhim"]<1)
$message = '<strong>��� �������.</strong>';
elseif ($player["nv"]<100)
$message = '<strong>�� ������� �����.</strong>';
else {
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `alhim`=0 WHERE `id`='".$player["id"]."' LIMIT 1 ");
chmsg("top.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font><font color=000000><b><font color=#cc0000>��������! </font></b>�������� ������ <b>".$_GET["um_name"]."</b>.<BR>'+'');",$player['login']);
echo('<script>location = "main.php?mode=um";</script>');
}
}
if (@$_GET["learn_um"] == 'trav'){
if ($player["trav"]>0)
$message = '<strong>��� �������.</strong>';
elseif ($player["nv"]<100)
$message = '<strong>�� ������� �����.</strong>';
else {
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `trav`=1,`nv`=`nv`-100 WHERE `id`='".$player["id"]."' LIMIT 1 ");
chmsg("top.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font><font color=000000><b><font color=#cc0000>��������! </font></b>�������� ������ <b>".$_GET["um_name"]."</b>.<BR>'+'');",$player['login']);
echo('<script>location = "main.php?mode=um";</script>');
}
}
if (@$_GET["learn_um"] == 'trav1'){
if ($player["trav"]<1)
$message = '<strong>��� �������.</strong>';
elseif ($player["nv"]<100)
$message = '<strong>�� ������� �����.</strong>';
else {
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `trav`=0 WHERE `id`='".$player["id"]."' LIMIT 1 ");
chmsg("top.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font><font color=000000><b><font color=#cc0000>��������! </font></b>�������� ������ <b>".$_GET["um_name"]."</b>.<BR>'+'');",$player['login']);
echo('<script>location = "main.php?mode=um";</script>');
}
}
if (@$_GET["learn_um"] == 'les'){
if ($player["les"]>0)
$message = '<strong>��� �������.</strong>';
elseif ($player["nv"]<100)
$message = '<strong>�� ������� �����.</strong>';
else {
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `les`=1,`nv`=`nv`-100 WHERE `id`='".$player["id"]."' LIMIT 1 ");
chmsg("top.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font><font color=000000><b><font color=#cc0000>��������! </font></b>�������� ������ <b>".$_GET["um_name"]."</b>.<BR>'+'');",$player['login']);
echo('<script>location = "main.php?mode=um";</script>');
}
}
if (@$_GET["learn_um"] == 'les1'){
if ($player["les"]<1)
$message = '<strong>��� �������.</strong>';
elseif ($player["nv"]<100)
$message = '<strong>�� ������� �����.</strong>';
else {
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `les`=0 WHERE `id`='".$player["id"]."' LIMIT 1 ");
chmsg("top.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font><font color=000000><b><font color=#cc0000>��������! </font></b>�������� ������ <b>".$_GET["um_name"]."</b>.<BR>'+'');",$player['login']);
echo('<script>location = "main.php?mode=um";</script>');
}
}
if (@$_GET["learn_um"] == 'koldyn'){
if ($player["koldyn"]>0)
$message = '<strong>��� �������.</strong>';
elseif ($player["nv"]<100)
$message = '<strong>�� ������� �����.</strong>';
else {
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `koldyn`=1,`nv`=`nv`-100 WHERE `id`='".$player["id"]."' LIMIT 1 ");
chmsg("top.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font><font color=000000><b><font color=#cc0000>��������! </font></b>�������� ������ <b>".$_GET["um_name"]."</b>.<BR>'+'');",$player['login']);
echo('<script>location = "main.php?mode=um";</script>');
}
}
if (@$_GET["learn_um"] == 'koldyn1'){
if ($player["koldyn"]<1)
$message = '<strong>��� �������.</strong>';
elseif ($player["nv"]<100)
$message = '<strong>�� ������� �����.</strong>';
else {
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `koldyn`=0 WHERE `id`='".$player["id"]."' LIMIT 1 ");
chmsg("top.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font><font color=000000><b><font color=#cc0000>��������! </font></b>�������� ������ <b>".$_GET["um_name"]."</b>.<BR>'+'');",$player['login']);
echo('<script>location = "main.php?mode=um";</script>');
}
}
if (@$_GET["learn_um"] == 'fish_skill'){
if ($player["fish_skill"]>0)
$message = '<strong>��� �������.</strong>';
elseif ($player["nv"]<100)
$message = '<strong>�� ������� �����.</strong>';
else {
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `fish_skill`=1,`nv`=`nv`-100 WHERE `id`='".$player["id"]."' LIMIT 1 ");
chmsg("top.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font><font color=000000><b><font color=#cc0000>��������! </font></b>�������� ������ <b>".$_GET["um_name"]."</b>.<BR>'+'');",$player['login']);
echo('<script>location = "main.php?mode=um";</script>');
}
}
if (@$_GET["learn_um"] == 'fish_skill1'){
if ($player["fish_skill"]<1)
$message = '<strong>��� �������.</strong>';
elseif ($player["nv"]<100)
$message = '<strong>�� ������� �����.</strong>';
else {
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `fish_skill`=0 WHERE `id`='".$player["id"]."' LIMIT 1 ");
chmsg("top.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font><font color=000000><b><font color=#cc0000>��������! </font></b>�������� ������ <b>".$_GET["um_name"]."</b>.<BR>'+'');",$player['login']);
echo('<script>location = "main.php?mode=um";</script>');
}
}
if (@$_GET["learn_um"] == 'vzlomshik_nav'){
if ($player["vzlomshik_nav"]>0)
$message = '<strong>��� �������.</strong>';
elseif ($player["baks"]<5)
$message = '<strong>�� ������� �������.</strong>';
else {
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `vzlomshik_nav`=1,`baks`=`baks`-5 WHERE `id`='".$player["id"]."' LIMIT 1 ");
chmsg("top.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font><font color=000000><b><font color=#cc0000>��������! </font></b>�������� ������ <b>".$_GET["um_name"]."</b>.<BR>'+'');",$player['login']);
echo('<script>location = "main.php?mode=um";</script>');
}
}

if (@$_GET["learn_um"] == 'vzlomshik_nav1'){
if ($player["vzlomshik_nav"]<1)
$message = '<strong>��� �������.</strong>';
elseif ($player["baks"]<5)
$message = '<strong>�� ������� �������.</strong>';
else {
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `vzlomshik_nav`=0 WHERE `id`='".$player["id"]."' LIMIT 1 ");
chmsg("top.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font><font color=000000><b><font color=#cc0000>��������! </font></b>�������� ������ <b>".$_GET["um_name"]."</b>.<BR>'+'');",$player['login']);
echo('<script>location = "main.php?mode=um";</script>');
}
}

if (@$_GET["learn_um"] == 'palac'){
if ($player["palac"]>0)
$message = '<strong>��� �������.</strong>';
elseif ($player["baks"]<5)
$message = '<strong>�� ������� �������.</strong>';
else {
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `palac`=1,`baks`=`baks`-5 WHERE `id`='".$player["id"]."' LIMIT 1 ");
chmsg("top.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font><font color=000000><b><font color=#cc0000>��������! </font></b>�������� ������ <b>".$_GET["um_name"]."</b>.<BR>'+'');",$player['login']);
echo('<script>location = "main.php?mode=um";</script>');
}
}

if (@$_GET["learn_um"] == 'palac1'){
if ($player["palac"]<1)
$message = '<strong>��� �������.</strong>';
elseif ($player["baks"]<5)
$message = '<strong>�� ������� �������.</strong>';
else {
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `palac`=0 WHERE `id`='".$player["id"]."' LIMIT 1 ");
chmsg("top.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font><font color=000000><b><font color=#cc0000>��������! </font></b>�������� ������ <b>".$_GET["um_name"]."</b>.<BR>'+'');",$player['login']);
echo('<script>location = "main.php?mode=um";</script>');
}
}

?>

<?
echo"
<table class='block info' cellspacing=0 cellpadding=3 bordercolor=FFFFFF border=0 width=100% style='background-image: url(\"./image//fon3.jpg\");' align=center>
<tr align=center>
<td width=180><b><font color=red>������</font></b></td>
<td width=150><b><font color=red>��������</font></b></td>
<td width=140><b><font color=red>������</font></b></td>
</tr>";
if ($player["alhim"]<1) $sb10 = '��������'; else $sb10 = '<input type=button class=lbut value="��������" onclick="learn_um(\'�������|alhim1\');">';
if ($player["alhim"]>0) $sb1 = '�������'; else $sb1 = '<input type=button class=lbut value="�������" onclick="learn_um(\'�������|alhim\');">';
echo"<tr style='background-image: url(\"./image//fon3.jpg\");'>
	<td class='tbl b' align=center>�������</td>
	<td class='tbl b' align=center>".$sb1."</td>
	<td class='tbl b' align=center>".$sb10."</td>
</tr>";
if ($player["trav"]<1) $sb9 = '��������'; else $sb9 = '<input type=button class=lbut value="��������" onclick="learn_um(\'������������|trav1\');">';
if ($player["trav"]>0) $sb2 = '�������'; else $sb2 = '<input type=button class=lbut value="�������" onclick="learn_um(\'������������|trav\');">';
echo"<tr style='background-image: url(\"./image//fon3.jpg\");'>
	<td class='tbl b' align=center>������������</td>
	<td class='tbl b' align=center>".$sb2."</td>
	<td class='tbl b' align=center>".$sb9."</td>
</tr>";
if ($player["les"]<1) $sb9 = '��������'; else $sb9 = '<input type=button class=lbut value="��������" onclick="learn_um(\'�������|les1\');">';
if ($player["les"]>0) $sb2 = '�������'; else $sb2 = '<input type=button class=lbut value="�������" onclick="learn_um(\'�������|les\');">';
echo"<tr style='background-image: url(\"./image//fon3.jpg\");'>
	<td class='tbl b' align=center>�������</td>
	<td class='tbl b' align=center>".$sb2."</td>
	<td class='tbl b' align=center>".$sb9."</td>
</tr>";
if ($player["koldyn"]<1) $sb8 = '��������'; else $sb8 = '<input type=button class=lbut value="��������" onclick="learn_um(\'������|koldyn1\');">';
if ($player["koldyn"]>0) $sb3 = '�������'; else $sb3 = '<input type=button class=lbut value="�������" onclick="learn_um(\'������|koldyn\');">';
echo"<tr style='background-image: url(\"./image//fon3.jpg\");'>
	<td class='tbl b' align=center>������</td>
	<td class='tbl b' align=center>".$sb3."</td>
	<td class='tbl b' align=center>".$sb8."</td>
</tr>";
if ($player["fish_skill"]<1) $sb7 = '��������'; else $sb7 = '<input type=button class=lbut value="��������" onclick="learn_um(\'�������|fish_skill1\');">';
if ($player["fish_skill"]>0) $sb4 = '�������'; else $sb4 = '<input type=button class=lbut value="�������" onclick="learn_um(\'�������|fish_skill\');">';
echo"<tr style='background-image: url(\"./image//fon3.jpg\");'>
	<td class='tbl b' align=center>�������</td>
	<td class='tbl b' align=center>".$sb4."</td>
	<td class='tbl b' align=center>".$sb7."</td>
</tr>";
if ($player["vzlomshik_nav"]<1) $sb6 = '��������'; else $sb6 = '<input type=button class=lbut value="��������" onclick="learn_um(\'��������|vzlomshik_nav1\');">';
if ($player["palac"]<1){
if ($player["vzlomshik_nav"]>0) $sb5 = '�������'; else $sb5 = '<input type=button class=lbut value="�������" onclick="learn_um(\'��������|vzlomshik_nav\');">';
}
echo"
	<td class='tbl b' align=center>��������: <font color=red>��������� ��������:</font> <font color=Blue Green>5 </font> <font color=red><img src=/img/razdor/emerald.png width=14 height=14 valign=middle title=�������></font>
	<td class='tbl b' align=center>".$sb5."</td>
	<td class='tbl b' align=center>".$sb6."</td>
</tr>";
if ($player["palac"]<1) $sb12 = '��������'; else $sb12 = '<input type=button class=lbut value="��������" onclick="learn_um(\'�����|palac1\');">';
if ($player["vzlomshik_nav"]<1){
if ($player["palac"]>0) $sb11 = '�������'; else $sb11 = '<input type=button class=lbut value="�������" onclick="learn_um(\'�����|palac\');">';
}
echo"
	<td class='tbl b' align=center>�����: <font color=red>��������� ��������:</font> <font color=Blue Green>5 </font> <font color=red><img src=/img/razdor/emerald.png width=14 height=14 valign=middle title=�������></font>
	<td class='tbl b' align=center>".$sb11."</td>
	<td class='tbl b' align=center>".$sb12."</td>
</tr>";
echo "</table>";

?>

</tr>
</td></div></table>


<script type="text/javascript">
<? if (isset($message) && !empty($message)): ?>
message_window ('success','','<?=$message?>','ok','')
<? endif; ?>
</script>


