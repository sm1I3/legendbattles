<script type="text/javascript" src="js/infos.js?"></script>
<script>
function give_birja(id,kolvo,price) {	inner = '<form action=main.php method=get id=give_birja><input type=hidden name=mselect value=rialto><input type=hidden name=kolvo value='+kolvo+'><input type=hidden name=give_birja value='+id+'><table width=100% cellpadding=7><tr><td width=10>&nbsp;</td><td valign=top>����: <b>'+price+' ������</b><br>���-��: <b>'+kolvo+' ��������</b></td></tr></table></FORM>';
	message_window ('confirm','������� <b>&laquo;DLR&raquo;</b>',inner,'accept|cancel','click|d.getElementById(\'give_birja\').submit();')
}
</script>
<form name="addbirja" action="main.php?mselect=rialto" method="POST">
<tr><td>
<font class=proce>
<FIELDSET>
<LEGEND align=center><B><font color=gray>&nbsp;�٨ �� �������� &nbsp;</font></B></LEGEND>
<table cellpadding=0 cellspacing=0 border=0 width=75% align=center>
<tr align=center><td align=center>�٨ �� ��������:</tr>
</table>
<table cellpadding=0 cellspacing=0 border=0 width=75% class=freemain align=center>
<tr><td class="tbl l b">������� ������� �� LR � 14-�� ������<td>��������� 20 ����� �������� �����������</td></tr>
<tr><td class="tbl l b">����������� ����� ��� �������: 3 �������</td><td> ������������ ����� ��� �������: 100 �������</td></tr>
<tr><td class="tbl l b">����������� ����: 2000 LR</td><td> ������������ ����: 5000 LR</td></tr>
<tr><td class="tbl l b">����� � �������: 3%<td>���������� ������: 1</td></tr>
<tr><td class="tbl l b">&nbsp;�������: �������&nbsp;&nbsp;<input type=text class=guest name="gold_birja" title="������� ������ ����� (������ �����) ����������� DLR"></td></tr>
<tr><td class="tbl l b">&nbsp;����: LR&nbsp;&nbsp;<input type=text class=guest name="silver_birja" title="������� ���� LR �� 1 DLR"></td></tr>
<input type=hidden name="mselect" value="rialto">
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
$silver_sale = ereg_replace("[^0-9]", "", $_POST['silver_birja']);
## ��������� ���-�� ������ ��������.
if ($bcount>=1)
$err_bg = '<strong>���������� �� ������� ������ 1-� ������ ������.</strong>';
## ��������� ������
elseif (!preg_match("/^[0-9\-_ ]*$/",$gold_sale))
$err_bg = '<strong>�������� ������ ���-�� ��������� ���� DLR �� �������</strong>';
## ��������� ������
elseif (!preg_match("/^[0-9\-_ ]*$/",$silver_sale))
$err_bg = '<strong>�������� ������ ���-�� ��������� ���� ����� �� 1 DLR</strong>';
## ������� �� LR?
elseif ($player["baks"]<($gold_sale))
$err_bg = '<strong>�� ������� DLR.</strong>';
## ���������� �� �������?.
elseif ($player["level"]<4)
$err_bg = '<b><font color=#99000>�� ���� �������</font></b> ';
## �� ������ �� 3 ����������� DLR?
elseif ($gold_sale<3)
$err_bg = '<strong>����������� ����� ��� ������� 3 DLR.</strong>';
## �� ������ �� 30 ����������� DLR?
elseif ($gold_sale>100)
$err_bg = '<strong>������������ ����� ��� ������� 100 DLR.</strong>';
## �� ������ �� 2000� ���� DLR?
elseif ($silver_sale<2000)
$err_bg = '<strong>����������� ���� 2000 LR.</strong>';
## �� ������ �� 5000 ���� DLR?
elseif ($silver_sale>5000)
$err_bg = '<strong>������������ ���� 5000 LR.</strong>';
else{ ## ���� �� ������, �� ������ ��� ������ :))
echo '<strong>�� ����� �� ����� <b>'.$gold_sale.' DLR</b> �� ����� <b>'.$silver_sale.'LR</b></strong>';
## �������� �����
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `baks`=`baks`-".$gold_sale." WHERE `id`='".$player["id"]."' LIMIT 1;");
## �������� �����
mysqli_query($GLOBALS['db_link'],"INSERT INTO `dlr_birja`(`id`,`uid`,`lr`,`dlr`,`user`) VALUES (NULL, '".$player["id"]."', '".$silver_sale."', '".$gold_sale."','".$player["login"]."');");
echo "<script>location='main.php?mselect=9';</script>";
}
}

## ������� DLR, �� �����. ( �� 3 �� 100) DLR.
if(!empty($_GET['give_birja']) and !empty($_GET["kolvo"]) and $_GET["kolvo"]>=3 and $_GET["kolvo"]<=100) {## ���������, ��� ��������.
$val_give_birja=varcheck($_GET['give_birja']);$bgive = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `id`,`uid`,`lr`,`dlr`,`time`,`user` FROM `dlr_birja` WHERE `id`='".$val_give_birja."' ;"));
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
$err_bg = '<strong>�� ������� LR.</strong>';
else{ ## ���� �� ������, �� ������ ��� ������ :))
## ����. ������
$gold_koef = 0.97; ## 10%
## ����������� � ������� ����������.
$ms="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font><font color=000000><font color=#000000><b>��������� ����������.</b></font> �� ������ <b>".$bgive["dlr"]." �������</b> �� <b>".$bgive["lr"]*$bgive["dlr"]." ������</b> <BR>'+'');";
chmsg($ms,$_SESSION['user'][login]);
## �������� ����������
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `nv`=`nv`-'".$bgive["lr"]*$bgive["dlr"]."',`baks`=`baks`+".$bgive["dlr"]." WHERE `id`='".$player["id"]."' LIMIT 1;");
## �������� ��������
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `nv`=`nv`+'".($bgive["lr"]*$bgive["dlr"])*$gold_koef."' WHERE `id`='".$bgive["uid"]."' LIMIT 1;");
## ����������� ��������.
$mss="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font><font color=000000><font color=#000000><b>��������� ����������.</b></font><strong> � ��� ������: <b>".$bgive["dlr"]."</b> ������� , ��������� �� ����: <b>".($bgive["lr"]*$bgive["dlr"])*$gold_koef."</b> ������, �����: 3% <BR>'+'');";
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
	echo "<table cellspacing=4 cellpadding=1 width=650 bgcolor=#F0F0F0 class=freemain >
	   <td width=50>����� ��������</td>
	   <td width=100>���� </td>
	   <td width=80>����� ����� ������</td>
	   <td width=70>��������</td></tr></table>";

## ��� ������
$un_count = mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `dlr_birja` WHERE `uid`='".$player["id"]."';"));
if ($un_count>=1){
echo '<table cellspacing=4 cellpadding=1 width=650 bgcolor=#990000><tr align=center>
<td width=50><b><font color=#FFFFFF>���� ������</font></b></td>
<td width=100><b>&nbsp;</b></td>
<td width=80><b>&nbsp;</b></td>
<td width=70><form name="unselect" action="main.php?mselect=9" method="POST"><input type=hidden name="mselect" value="9"><input type=submit class=lbut value="�������" name="unselect"></form></td></tr></table>';
}
## ����� ���� ������.
    while($gg = mysqli_fetch_assoc($gold))
	{
        echo "<table cellspacing=4 cellpadding=1 width=650><tr align=center>
        <td width=50><b>".$gg["dlr"]."</b></td>
        <td width=100><b>".$gg["lr"]."</b></td>
        <td width=80><b>".$gg["lr"]*$gg["dlr"]."</b></td>
        <td width=70><input type='button' class='lbut' value='��������'  onclick='give_birja(".$gg["id"].",".$gg["dlr"].",".$gg["dlr"]*$gg["lr"].");'></td></tr></table>";

	}
?>
<?
if (!empty($_POST['unselect'])){
$unselect = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `id`,`uid`,`lr`,`dlr`,`time`,`user` FROM `dlr_birja` WHERE `uid`='".$player["id"]."' LIMIT 1;"));
## ��������� ���-�� ����� ��������.
if ($un_count<1)
$err_bg = '<strong>� ��� ��� ������ �� �����.</strong>';
else{ ## ���� �� ������, �� ������ ��� ������ :))
$gold_koef = 0.90; ## 10%
$msst="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font><font color=000000><font color=#000000><b>��������� ����������.</b></font><strong> �� ����� � ������� <b>".$unselect["dlr"]*$gold_koef." ��������</b>, �����: 10% <BR>'+'');";
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
<tr><td align=center><b><font class=weaponch style="color:#dd0000">�������� ��� �������� ������ ���������� 10% �� �����.</font></b></tr></td>
</table></FIELDSET>
