<div style="position:absolute; left:-2px; top:-2px; z-index: 65200; width:0px; height:0px;" id="zcenter"></div>
<div id="back" style="position: absolute; left: 0; top: 0; width: 100%; z-index: 50;"></div>
<div style="padding-left:39px; text-align:left; padding-top:0px;" id="draw_pers_info"></div>
<div style="position: absolute; left: 0; top: 0; width: 100%; z-index: 50;" id="popup"></div>
<html>
<META content="text/html; charset=windows-1251" Http-Equiv=Content-type>
<META Http-Equiv=Cache-Control Content=no-cache>
<META Http-Equiv=PRAGMA content=NO-CACHE>
<META Http-Equiv=Expires Content=0>
<HEAD>
<script type="text/javascript" src="js/interface/get_windows2.js?"></script>
<LINK href=./css/info_loc.css rel=STYLESHEET type=text/css>
<SCRIPT type="text/javascript" src="js/frame_loc.js"></SCRIPT>
<script language="JavaScript" type="text/JavaScript" src="js/png.js"></script>
</HEAD>
<body>

<TABLE cellpadding=0 cellspacing=0 width=100%><TR><TD>
<table cellpadding=0 cellspacing=0 border=0 align=center width=760><tr valign=top><td>


<table width=100% cellspacing=0 border=0 cellpadding=0>
<td valign=top>
<FIELDSET>
<img  src='http://tltonline.ru/img/avatars/511_small.jpg' width='500' height='362'>
</FIELDSET>


<td width=0 valign=top style="width: 100%;">
<table width=80% cellspacing=0 cellpadding=0  border=0 style="width: 100;">
<tr><td align=center>

<?
$bot_id=array("3","4");
echo $bot_id[0] ;
foreach($_POST as $keypost=>$val){$_POST[$keypost] = varcheck($val);}
foreach($_GET as $keyget=>$val){$_GET[$keyget] = varcheck($val);}
## ��������� ��������� � �����.
$prizes2 = mysql_fetch_assoc(mysql_query("SELECT `id`,`uid`,`login`,`level`,`time`,`type`,`ohr` FROM `logovo` WHERE uid=".$player["id"]." and type=0 LIMIT 1"));

## ���� ��� ���������, ��������� �����.
if (!$prizes2){
mysql_query("INSERT INTO `instant` (`id`,`uid`,`login`,`level`,`time`,`type`,`ohr`) VALUES (NULL,'".$player["id"]."','".$player["login"]."','0','0','0','0')");
echo "<script>location='main.php';</script>";
}




## ���� ����� �������� ���������
if ($prizes2["time"]>time()){
echo "��������� ��������� ��������: <b>".tp($prizes2["time"]-time())."</b>";
}
## ���� ������ ��������� ��.
if ($prizes2["level"]>=6){
$time_in = time()+21600;
sql("UPDATE `instant` SET `level`='0',`time`='".$time_in."' WHERE `uid`='".$player['id']."' and `type`=0");
echo "<script>location='main.php';</script>";
}
?>

<FIELDSET>
<form method="post" action="">
<input name="att_dom" type="submit" class=lbut value="������ ������ � ������" style='width:180px;'>
<? echo "<center>(<b>".$prizes2["level"]."</b> �������)</center>"; ?>
</form>
<form method="post" action="">
<input name="priroda" type="submit" class=lbut value="����� �� ������" style='width:180px;'>
</from>

</FIELDSET>
<?
if ($_POST["priroda"]){
mysql_query("UPDATE `user` SET `loc`=28,`pos`='7_15' WHERE `id`='".$player["id"]."' LIMIT 1");
echo "<script>location='main.php';</script>";
}
?>



<?
if(!empty($_POST['att_dom'])) {
if ($player["level"]<18 and $prizes2["ohr"] == 0)
$secrets = '�������� ��������� ������ � ������,<br /> ������������, <b>'.$player["login"].'</b>. <br />�� ������� ���� � �� ������� ��������� �� ��������� ���������� � �������.</b><br /><a href=main.php?vz=ok>���� ������ (10000 WMB).</a> ';
else{
$text = '�������� ��������� ������ � ������,<br />������������, <b>'.$player["login"].'</b>, ����� �����, ��� ������ ����� �������� �����,<br />�� ����� ��������� ������� �� ����������, ������� �������� ���,<br />�� ����� � ������������  ���������� �� ������� � ������...<br />��, � � ������, ������ ���.<br /><b><a href=main.php?target_dom=ok>� �� ����� ����� - �� ��� �������.</a><br /><a href=main.php?>������� ���, � �� ����� ����.</a></b> ';
}
}
## ������ =)
if ($_GET["vz"] == 'ok' and $player["level"]<19){
if ($player["nv"]<10000)
$secrets = '��-��, �� �� ������, ��� ��� �������...';
else{
mysql_query("UPDATE `user` SET `nv`=`nv`-10000 WHERE `id`='".$player["id"]."' LIMIT 1");
$secrets = '���� �������� �� ����� ������, �� ������ � ��� �� ���, ���� �� �������� ���� � ���! �������� ����� ��������� � ������� ������! ������� �� ������� <a href=main.php?vz=attack>������� �� ���������.</a>';
}
}
## ���� ����� ������ =)
if ($_GET["vz"] == 'attack' and $prizes2["ohr"] == 0 and $player["level"]<19){
mysql_query("UPDATE `instant` SET `ohr`=1 WHERE `uid`='".$player["id"]."' LIMIT 1");
if ($player["sex"] == 'female'){ $sex = '������'; }else{ $sex = '��������';}
$secrets = '� � ������, '.$sex.' . �� �� ������� �� ����� �������� � ��������. ����� - ������ ���������, ���� ������ ������� ������� �������. ';
}

## ����� �� ����. ���
$t_fight = 3600;

if(@$_GET['target_dom'] == 'ok') {
if ($player["level"]<=18 and $player["level"]>=26 and $prizes2["ohr"] == 0)
$secrets = '������� �������� ������ ��� �������������, ����� � ��� �������� �������..  ( ���� �������� ��� 19-25 ��.)';
elseif ($player["level"]>=26)
$secrets = '������� �������� ������ ��� �������������, ����� � ��� �������� �������..  ( ���� �������� ��� 19-25 ��.)';
elseif ($player["hp"]<$player["hp_all"]*0.6)
$secrets = '�� ������� �����, �������������.';
elseif ($prizes2["time"]>time())
$secrets = '��������� ��������� ��������: <b>'.tp($prizes2["time"]-time()).'</b>.';
//elseif ($player["id"]!=10033 and $player["id"]!=12896)
//$secrets = '������� �� ���. ��������.';
else{

## ����������� ���� ��� ��� ���� ���
$gds=mysql_fetch_assoc(mysql_query("SELECT * FROM `user` WHERE `loc`=26 and `battle`>0 and type!=3"));
$arenka = mysql_fetch_assoc(mysql_query("SELECT * FROM `arena` WHERE `id_battle`='".$gds["battle"]."' and `vis`=0"));

if($gds["id"] and $arenka["id_battle"]){
//$btls = mysql_fetch_array(sql('SELECT * FROM `fights` WHERE `id`='.$drug['battle'].''));
##����������� � ���

mysql_query("UPDATE `user` SET `side`='".$gds["side"]."',`battle`='".$gds["battle"]."',`fight`=2 WHERE `id`='".$player["id"]."'");
save_hp_roun($player);
echo '<script>location="main.php";</script>';
}else{

switch($prizes2['level']){
 case 0:
	$bot_id=array("3","4");
	$bot_kolvo=array("5","6");
break;
 case 1:
	$bot_id=array("3","4");
	$bot_kolvo=array("5","6");
break;
 case 2:
	$bot_id=array("3","4");
	$bot_kolvo=array("5","6");
break;
 case 3:
	$bot_id=array("3","4");
	$bot_kolvo=array("5","6");
break;
 case 4: 
	$bot_id=array("3","4");
	$bot_kolvo=array("5","6");
break;
 case 5:
	$bot_id=array("3","4");
	$bot_kolvo=array("5","6");
break;
 default: echo'<script>alert(\'������ ����..\');</script>'; break;
}
logovo_nap($player,$bot_id,$bot_kolvo); 
echo "<script>location='main.php';</script>";
}



}


}

?>




</div>
</table></td></table></tr></td></table>
</td></tr></table></TD></TR></TABLE>

<script type="text/javascript">
<? if (isset($secrets) && !empty($secrets)): ?>
message_window ('success','','<?=$secrets?>','ok','')
<? endif; ?>
</script>

<script type="text/javascript">
<? if (isset($text) && !empty($text)): ?>
message_window ('success','','<?=$text?>','','')
<? endif; ?>
</script>
</body>
</html>



