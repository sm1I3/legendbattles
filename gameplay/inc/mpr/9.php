<script type="text/javascript" src="js/infos.js?"></script>
<script>
function give_birja(id,kolvo,price) {
	inner = '<form action=main.php method=get id=give_birja><input type=hidden name=mselect value=9><input type=hidden name=kolvo value='+kolvo+'><input type=hidden name=give_birja value='+id+'><table width=100% cellpadding=7><tr><td width=10>&nbsp;</td><td valign=top>����: <b>'+price+'</b><br>���-��: <b>'+kolvo+' <img src="<?=IMG;?>/razdor/emerald.png" width=14 title="�������" height=14></b></td></tr></table></FORM>';
	message_window ('confirm','������� <b>&laquo;�������&raquo;</b>',inner,'accept|cancel','click|d.getElementById(\'give_birja\').submit();')
}
</script>
<form name="addbirja" action="main.php?mselect=9" method="POST">
<tr><td>
<div class="block info">
	<div class="header">
		<span>����� ��������</span></div>
<table cellpadding=0 cellspacing=0 border=0 width=75% align=center>
<tr align=center><td align=center>��������� ������� �� �������:</tr>
</table>
<table cellpadding=0 cellspacing=0 border=0 width=100% class=freemain align=center>
<tr><td class="tbl l b">������� �������� �� ������ � 14-�� ������<td>��������� 20 ����� �������� �����������</td></tr>
<tr><td class="tbl l b">����������� ����� ��� �������: 30 <img src="<?=IMG;?>/razdor/emerald.png" width=14 title="�������" height=14></td><td> ������������ ����� ��� �������: 1000 <img src="<?=IMG;?>/razdor/emerald.png" width=14 title="�������" height=14></td></tr>
<tr><td class="tbl l b">����������� ����: 30 <img src=http://img.legendbattles.ru/image/gold.png width=14 height=14 valign=middle title=������></td><td> ������������ ����: 50 <img src=http://img.legendbattles.ru/image/gold.png width=14 height=14 valign=middle title=������></td></tr>
<tr><td class="tbl l b">����� � �������: <font class=weaponch style="color:#dd0000">16%<td>���������� ������: 1</td></tr>
<tr><td class="tbl l b">&nbsp;�������: <img src="<?=IMG;?>/razdor/emerald.png" width=14 title="�������" height=14>&nbsp;&nbsp;<input type=text class=guest name="gold_birja" title="������� ������ ����� (������ �����) ����������� ��������"></td></tr>
<tr><td class="tbl l b">&nbsp;����: <img src="http://img.legendbattles.ru/image/gold.png" width="14" height="14" valign="middle" title="������"><input type=text name=gold style="width: 60;"><img src="http://img.legendbattles.ru/image/silver.png" width="14" height="14" valign="middle" title="������"><input type=text name=silver style="width: 60;"><img src="http://img.legendbattles.ru/image/bronze.png" width="14" height="14" valign="middle" title="������"><input type=text name=bronze style="width: 60;"></td></tr>
<input type=hidden name="mselect" value="9">
<tr><td class="tbl l b"><input type=submit class=lbut value="��������� �� �������" name="addbirja"></td></tr>
</td>
</tr>
</table>
</form>




<?
################### Made by LastDays #########################

//echo "<b>ID:".$player["id"].", LOGIN:".$player["login"]." </b>";
## ������� DLR, �� �����. ( �� 3 �� 30) DLR.
if (!empty($_POST['addbirja'])){
$bcount = mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `dlr_birja` WHERE `uid`='".$player["id"]."';"));
$gold_sale = ereg_replace("[^0-9]", "", $_POST['gold_birja']);
$silver_sale = (intval($_POST['gold'])) * 10000 + (intval($_POST['silver'])) * 100 + (intval($_POST['bronze']));
## ��������� ���-�� ������ ��������.
if ($bcount>=1)
$err_bg = '<strong>���������� �� ������� ������ 1-� ������ ������.</strong>';
## ��������� ������
elseif (!preg_match("/^[0-9\-_ ]*$/",$gold_sale))
$err_bg = '<strong>�������� ������ ���-�� ��������� ���� �������� �� �������</strong>';
## ��������� ������
elseif (!preg_match("/^[0-9\-_ ]*$/",$silver_sale))
$err_bg = '<strong>�������� ������ ���-�� ��������� ���� ����� �� 1 �������</strong>';
## ������� �� LR?
elseif ($player["baks"]<($gold_sale))
$err_bg = '<strong>�� ������� ��������.</strong>';
## ���������� �� �������?.
elseif ($player["level"]<14)
$err_bg = '<b><font color=#99000>�� ���� �������</font></b> ';
## �� ������ �� 3 ����������� DLR?
elseif ($gold_sale<3)
$err_bg = '<strong>����������� ����� ��� ������� 3 ��������.</strong>';
## �� ������ �� 30 ����������� DLR?
elseif ($gold_sale>100)
$err_bg = '<strong>������������ ����� ��� ������� 100 ��������.</strong>';
## �� ������ �� 2000� ���� DLR?
elseif ($silver_sale<300000)
$err_bg = '<strong>����������� ���� 30 <img src=http://img.legendbattles.ru/image/gold.png width=14 height=14 valign=middle title=������>.</strong>';
## �� ������ �� 5000 ���� DLR?
elseif ($silver_sale>500000)
$err_bg = '<strong>������������ ���� 50 �������.</strong>';
else{ ## ���� �� ������, �� ������ ��� ������ :))
echo '<strong>�� ����� �� ����� <b>'.$gold_sale.' �������</b> �� ����� <b>'.$silver_sale.'������</b></strong>';
## �������� �����
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `baks`=`baks`-".$gold_sale." WHERE `id`='".$player["id"]."' LIMIT 1;");
## �������� �����
mysqli_query($GLOBALS['db_link'],"INSERT INTO `dlr_birja`(`id`,`uid`,`lr`,`dlr`,`user`) VALUES (NULL, '".$player["id"]."', '".$silver_sale."', '".$gold_sale."','".$player["login"]."');");
echo "<script>location='main.php?mselect=9';</script>";
}
}

## ������� DLR, �� �����. ( �� 3 �� 100) DLR.
if(!empty($_GET['give_birja']) and !empty($_GET["kolvo"]) and $_GET["kolvo"]>=3 and $_GET["kolvo"]<=100) {
## ���������, ��� ��������.
$val_give_birja=varcheck($_GET['give_birja']);
$bgive = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `id`,`uid`,`lr`,`dlr`,`time`,`user` FROM `dlr_birja` WHERE `id`='".$val_give_birja."' ;"));
## ���������, �� ����� �� ������ ����������
if ($player["id"]==$bgive["uid"])
$err_bg = '<b>����� �������� ���� �� ������?</b> ';
## ���� �� ����������.
elseif (!$bgive)
$err_bg = '<b><font color=#99000>��, ��� �� ��������� ������ ? ��� �������� � �������...</font></b> ';
## ���������� �� �������?.
elseif ($player["level"]<14)
$err_bg = '<b><font color=#99000>�� ���� �������</font></b> ';
## ������� �� �����?
elseif ($player["nv"]<($bgive["lr"]*$bgive["dlr"]))
$err_bg = '<strong>�� ������� �����.</strong>';
else{ ## ���� �� ������, �� ������ ��� ������ :))
## ����. ������
$gold_koef = 0.94; ## 10%
## ����������� � ������� ����������.
$ms="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font><font color=000000><font color=#000000><b>��������� ����������.</b></font> �� ������ <b>".$bgive["dlr"]." <img src=http://img.legendbattles.ru/razdor/emerald.png width=14 title=������� height=14></b> �� <b>".lr($bgive["lr"])*$bgive["dlr"]." <img src=http://img.legendbattles.ru/image/gold.png width=14 height=14 valign=middle title=������></b> <BR>'+'');";
chmsg($ms,$_SESSION['user'][login]);
## �������� ����������
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `nv`=`nv`-'".$bgive["lr"]*$bgive["dlr"]."',`baks`=`baks`+".$bgive["dlr"]." WHERE `id`='".$player["id"]."' LIMIT 1;");
## �������� ��������
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `nv`=`nv`+'".($bgive["lr"]*$bgive["dlr"])*$gold_koef."' WHERE `id`='".$bgive["uid"]."' LIMIT 1;");
## ����������� ��������.
$mss="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font><font color=000000><font color=#000000><b>��������� ����������.</b></font><strong> � ��� ������: <b>".$bgive["dlr"]."</b> <img src=http://img.legendbattles.ru/razdor/emerald.png width=14 title=������� height=14>, ��������� �� ����: <b>".(lr($bgive["lr"])*$bgive["dlr"])*$gold_koef."</b> <img src=http://img.legendbattles.ru/image/gold.png width=14 height=14 valign=middle title=������> , �����: 16% <BR>'+'');";
chmsg($mss,$bgive[user]);
## �������� �����
$val_give_birja=varcheck($_GET['give_birja']);
mysqli_query($GLOBALS['db_link'],"DELETE FROM `dlr_birja` WHERE `id`=".$val_give_birja." LIMIT 1");
echo "<script>location='main.php?mselect=9';</script>";
}
}
	## ������� DLR, ����������� �� ������� � �����.
	$gold = mysqli_query($GLOBALS['db_link'],"SELECT `id`,`uid`,`lr`,`dlr` FROM `dlr_birja` WHERE id>0 ORDER BY `lr` ASC LIMIT 20");
	## �������.
	echo "<table cellspacing=4 cellpadding=1 width=100% bgcolor=#F0F0F0 class=freemain>
	<td width=50>����� ��������</td>
	<td width=100>���� �������� �� ����</td>
	<td width=80>����� �����</td>
	<td width=70>��������</td></tr></table>";

## ��� ������
$un_count = mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `dlr_birja` WHERE `uid`='".$player["id"]."';"));
if ($un_count>=1){
echo '<table cellspacing=4 cellpadding=1 width=100% bgcolor=#990000><tr align=center>
<td width=50><b><font color=#FFFFFF>���� ������</font></b></td>
<td width=100><b>&nbsp;</b></td>
<td width=80><b>&nbsp;</b></td>
<td width=70><form name="unselect" action="main.php?mselect=9" method="POST"><input type=hidden name="mselect" value="9"><input type=submit class=lbut value="�������" name="unselect"></form></td></tr></table>';
}
## ����� ���� ������.
    while($gg = mysqli_fetch_assoc($gold))
	{
        echo "<table cellspacing=4 cellpadding=1 width=100%><tr align=center>
        <td width=120><b>".$gg["dlr"]."</b><img src=http://img.legendbattles.ru/razdor/emerald.png width=14 title=������� height=14></td>
        <td width=120><b>".lr($gg['lr'])."</b></td>
        <td width=100><b>".lr($gg["lr"])*$gg["dlr"]."</b> <img src=http://img.legendbattles.ru/image/gold.png width=14 height=14 valign=middle title=������></td>
        <td width=10><input type='button' class='lbut' value='��������'  onclick='give_birja(".$gg["id"].",".$gg["dlr"].",".$gg["dlr"]*$gg["lr"].");'></td></tr></table>";

	}
?>
<?
if (!empty($_POST['unselect'])){
$unselect = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `id`,`uid`,`lr`,`dlr`,`time`,`user` FROM `dlr_birja` WHERE `uid`='".$player["id"]."' LIMIT 1;"));
## ��������� ���-�� ����� ��������.
if ($un_count<1)
$err_bg = '<strong>� ��� ��� ������ �� �����.</strong>';
else{ ## ���� �� ������, �� ������ ��� ������ :))
$gold_koef = 0.87; ## 20%
$msst="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font><font color=000000><font color=#000000><b>��������� ����������.</b></font><strong> �� ����� � ������� <b>".$unselect["dlr"]*$gold_koef." <img src=http://img.legendbattles.ru/razdor/emerald.png width=14 title=������� height=14></b>, �����: 20% <BR>'+'');";
chmsg($msst,$_SESSION['user'][login]);
## �������� �����
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `baks`=`baks`+".($unselect["dlr"]*$gold_koef)." WHERE `id`='".$player["id"]."' LIMIT 1;");
## �������� �����
mysqli_query($GLOBALS['db_link'],"DELETE FROM `dlr_birja` WHERE uid=".$player["id"]." LIMIT 1");
echo "<script>location='main.php?mselect=9';</script>";
}
}
?>
<script type="text/javascript">
<? if (isset($err_bg) && !empty($err_bg)){ ?>
message_window ('success','','<?=$err_bg?>','ok','')
<? } ?>
</script>
<tr><td align=center><b><font class=weaponch style="color:#dd0000">�������� ��� �������� ������ ���������� <font class=weaponch style="color:#dd0000"> 20% �� �����.</font></b></tr></td>
</table></FIELDSET>
