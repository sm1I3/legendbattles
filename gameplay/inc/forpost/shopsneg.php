
<?php

foreach($_POST as $keypost=>$val){$_POST[$keypost] = varcheck($val);}
foreach($_GET as $keyget=>$val){$_GET[$keyget] = varcheck($val);}

/* ���������� */
if(!empty($_POST['min_lev']) or !empty($_POST['max_lev']) or !empty($_POST['max_nv']) or !empty($_POST['sorttype'])){
	$_SESSION['min_lev'] = intval($_POST['min_lev']);
	$_SESSION['max_lev'] = intval($_POST['max_lev']);
	$_SESSION['max_nv'] = intval($_POST['max_nv']);
	if($_POST['sorttype'] == '0'){
		$_SESSION['sorttype'] = 'price';
	}elseif($_POST['sorttype'] == '1'){
		$_SESSION['sorttype'] = 'level';
	}else{
		$_SESSION['sorttype'] = 'price';
	}
}
if(empty($_SESSION['min_lev'])){
	$_SESSION['min_lev'] = '0';
}
if(empty($_SESSION['max_lev'])){
	$_SESSION['max_lev'] = '33';
}
if(empty($_SESSION['sorttype'])){
	$_SESSION['sorttype'] = 'level';
}
/* ��������� */
if(isset($_GET['weapon_category'])){
	$_SESSION['mark']=$_GET['weapon_category'];
}
if($_SESSION['mark']!=''){
	$_GET['weapon_category']=$_SESSION['mark'];
}
?>
<LINK href="/css/stl.css" rel="STYLESHEET" type="text/css">
<?
if($msg){
echo "<SCRIPT>MessBoxDiv('".$msg."',0,0,0,0);</SCRIPT>";
}
?>
<table cellpadding=0 cellspacing=0 border=0 align=center width=760>
<tr><td><img src=/img/image/1x1.gif width=1 height=10>
<br></td></tr>
<tr><td>

<table cellpadding=0 cellspacing=1 border=0 align=center width=100%>
<tr align=center><td align=center><?$locname = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `loc` WHERE `id`='".$player['loc']."' LIMIT 1;"));?><fieldset><legend align="center"><b><font color="gray"><?=$locname['loc'];?></font></b></legend><img src=/img/image/shops/tower4.jpg width=760 height=255 border=0 align=center></fieldset></td></tr>
<!----><tr><td bgcolor=#f5f5f5><?php 
echo'<form method=post><div align=center><font class=freetxt><font color=#3564A5><b>������: </b></font>������� �� <select name=min_lev class=zayavki>';
for($i=0;$i<=33;$i++){
	echo'<option value='.$i.(($_SESSION['min_lev']==$i)?' SELECTED':'').'>'.$i.'</option>';
}
echo'</select> �� <select name=max_lev class=zayavki>';
for($i=0;$i<=33;$i++){
	echo'<option value='.$i.(($_SESSION['max_lev']==$i)?' SELECTED':'').'>'.$i.'</option>';
}
echo'</select> �� ������ <input type=text size=2 name=max_nv value="'.(($_SESSION['max_nv']=='0')?'':$_SESSION['max_nv']).'" class=LogintextBox6><b>��������</b> ���������� �� <select name=sorttype class=zayavki><option value=1'.(($_SESSION['sorttype']=='level')?' SELECTED':'').'>������</option><option value=0'.(($_SESSION['sorttype']=='price')?' SELECTED':'').'>���������</option></select> <input type=submit value=" ok " class=lbut></font></div></form>';
?></td></tr><tr><td bgcolor=#CCCCCC width=100%><img src=/img/image/1x1.gif width=1 height=1 width=40 height=50></td></tr><!---->
<tr><td>
<div align=center>
<input input type=image src=/img/image/gameplay/shop/helm.gif onClick="location='?weapon_category=w23'" title="�����" width=40 height=50><input type=image src=/img/image/gameplay/shop/armor_hard.gif onClick="location='?weapon_category=w19'" title="�������" width=40 height=50>
<input type=image src=/img/image/gameplay/invent/8.gif onClick="location='?weapon_category=w61'" title="��������"  border="0">
<input type=image src=/img/image/gameplay/invent/1.gif onClick="location='?weapon_category=w66'" title="�������"  border="0">
<input type=image src=/img/image/gameplay/invent/cat/21.gif onClick="location='?weapon_category=w0'" title="�����"  border="0">

</td></tr>
<tr><td></td></tr>
<tr><td>
<? if(isset($weapon_category)){
$ITEMS = mysqli_query($GLOBALS['db_link'],"SELECT market.*, items.*
FROM market LEFT JOIN items ON market.id = items.id
WHERE items.dd_price=0 AND market='".$player['loc']."' AND `level`>='".$_SESSION["min_lev"]."' AND `level`<='".$_SESSION["max_lev"]."'".(($_SESSION["max_nv"]>'0')?" AND `price`<='".$_SESSION["max_nv"]."'":"")." AND type='".preg_replace('/[^w0-9]/','',$_GET["weapon_category"])."' ORDER BY `items`.`".$_SESSION['sorttype']."` ASC");
$num = (mysqli_num_rows($ITEMS)); 
if($num>0){?>
<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#e0e0e0><table cellpadding=3 cellspacing=1 border=0 width=100%><tr><td colspan=2 bgcolor=#F9f9f9><div align=center><font class=inv><b> � ��� � ����� <?=$player[sneg]?> �������� � ����� ������: <?=$plstt[71]?> ������������ ���: <?=$mass?></b></div></td></tr>
<?
$freemass=$plstt[71];
while ($ITEM = mysqli_fetch_assoc($ITEMS)) {
$par=explode("|",$ITEM['param']);
$need=explode("|",$ITEM[need]);
$bt=0;$tr_b='';$m=1;
foreach ($need as $value) {
$treb=explode("@",$value);
if($treb[0]==72)$treb[1]=$ITEM[level];
if($treb[0]==71){$treb[1]=$ITEM[massa];$plstt[71]=$mass-$freemass;}
if($treb[0]!=28){if($plstt[$treb[0]]<$treb[1]){$treb[1]="<font color=#cc0000>$treb[1]</font>";if($treb[0]==71){$m=0
;}}}
switch($treb[0])
{
case 28: $tr_b.="&nbsp;���� ��������: <b>$treb[1]</b><br>";break;
case 30: $tr_b.="&nbsp;C���: <b>$treb[1]</b><br>";break;
case 31: $tr_b.="&nbsp;��������: <b>$treb[1]</b><br>";break;
case 32: $tr_b.="&nbsp;�����: <b>$treb[1]</b><br>";break;
case 33: $tr_b.="&nbsp;��������: <b>$treb[1]</b><br>";break;
case 34: $tr_b.="&nbsp;������: <b>$treb[1]</b><br>";break;
case 35: $tr_b.="&nbsp;��������: <b>$treb[1]</b><br>";break;
case 36: $tr_b.="&nbsp;�������� ������: <b>$treb[1]</b><br>";break;
case 37: $tr_b.="&nbsp;�������� ��������: <b>$treb[1]</b><br>";break;
case 38: $tr_b.="&nbsp;�������� �������� �������: <b>$treb[1]</b><br>";break;
case 39: $tr_b.="&nbsp;�������� ������: <b>$treb[1]</b><br>";break;
case 40: $tr_b.="&nbsp;�������� ����������� �������: <b>$treb[1]</b><br>";break;
case 41: $tr_b.="&nbsp;�������� ���������� � �������: <b>$treb[1]</b><br>";break;
case 42: $tr_b.="&nbsp;�������� ��������: <b>$treb[1]</b><br>";break;
case 43: $tr_b.="&nbsp;�������� ������������ �������: <b>$treb[1]</b><br>";break;
case 44: $tr_b.="&nbsp;�������� ��������� �������: <b>$treb[1]</b><br>";break;
case 45: $tr_b.="&nbsp;����� ����: <b>$treb[1]</b><br>";break;
case 46: $tr_b.="&nbsp;����� ����: <b>$treb[1]</b><br>";break;
case 47: $tr_b.="&nbsp;����� �������: <b>$treb[1]</b><br>";break;
case 48: $tr_b.="&nbsp;����� �����: <b>$treb[1]</b><br>";break;
case 53: $tr_b.="&nbsp;���������: <b>$treb[1]</b><br>";break;
case 54: $tr_b.="&nbsp;������������: <b>$treb[1]</b><br>";break;
case 55: $tr_b.="&nbsp;����������: <b>$treb[1]</b><br>";break;
case 56: $tr_b.="&nbsp;����������������: <b>$treb[1]</b><br>";break;
case 57: $tr_b.="&nbsp;��������: <b>$treb[1]</b><br>";break;
case 58: $tr_b.="&nbsp;��������: <b>$treb[1]</b><br>";break;
case 59: $tr_b.="&nbsp;�������: <b>$treb[1]</b><br>";break;
case 60: $tr_b.="&nbsp;�������: <b>$treb[1]</b><br>";break;
case 61: $tr_b.="&nbsp;��������� ����: <b>$treb[1]</b><br>";break;
case 62: $tr_b.="&nbsp;�����������: <b>$treb[1]</b><br>";break;
case 63: $tr_b.="&nbsp;���������: <b>$treb[1]</b><br>";break;
case 64: $tr_b.="&nbsp;������: <b>$treb[1]</b><br>";break;
case 65: $tr_b.="&nbsp;�����������: <b>$treb[1]</b><br>";break;
case 66: $tr_b.="&nbsp;������� �������������� ����: <b>$treb[1]</b><br>";break;
case 67: $tr_b.="&nbsp;���������: <b>$treb[1]</b><br>";break;
case 68: $tr_b.="&nbsp;�������: <b>$treb[1]</b><br>";break;
case 69: $tr_b.="&nbsp;�������� ������� ����: <b>$treb[1]</b><br>";break;
case 70: $tr_b.="&nbsp;������������: <b>$treb[1]</b><br>";break;
case 71: $tr_b.="&nbsp;�����: <b>$treb[1]</b><br>";break;
case 72: $tr_b.="&nbsp;�������: <b>$treb[1]</b><br>";break;
}
}
?>
<tr><td bgcolor=#f9f9f9><div align=center><img src=/img/image/weapon/<?=$ITEM[gif]?> border=0></div></td><td width=100% bgcolor=#ffffff valign=top><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#ffffff width=100%><font class=nickname><b><? if($player[sneg]>=$ITEM[price] AND $ITEM[kol]>0 and $m!=0){?><input type=button class=invbut onclick="location='main.php?post_id=116&wsuid=<?=$ITEM[id]?>&vcode=<?=scod()?>'" value="������"> <? }if($player['access']=='admin'){
	echo '<input type=button class=invbut onclick="location=\'main.php?post_id=111&wsuid='.$ITEM['id'].'&market='.$ITEM['market'].'&vcode='.scode().'\'" value="������� �� ��������"><br>';
}?><?=$ITEM[name]?></b><font class=weaponch> (����������: <?=(($ITEM[kol]>0)?'<font color=green>'.$ITEM[kol].'</font>':'<font color=red>'.$ITEM[kol].'</font>')?>)<br><img src=/img/image/1x1.gif width=1 height=3></td><td><br><img src=/img/image/1x1.gif width=1 height=3</td></tr><tr><td colspan=2 width=100%><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#D8CDAF width=50%><div align=center><font class=invtitle>��������</div></td><td bgcolor=#B9A05C><img src=/img/image/1x1.gif width=1 height=1></td><td bgcolor=#D8CDAF width=50%><div align=center><font class=invtitle>����������</div></td></tr><tr><td bgcolor=#FCFAF3><font class=weaponch>&nbsp;����: <b><? if($ITEM[price]>$player[sneg]){echo "<font color=#cc0000>$ITEM[price] ��������</font>";}else{echo $ITEM[price]." ��������";}?></b><?php ?><br>
<? if($ITEM[slot]==16) echo "<font class=weaponch><b><font color=#cc0000>����� ������� �� ��������</font></b><br>";
blocks($ITEM[block]);
foreach ($par as $value) {
$stat=explode("@",$value);
if($stat[1]>0){$plus = "+";}else{$plus ="";}
switch($stat[0])
{
case 0: echo "����������: <b>$stat[1]</b><br>"; break;
case 1: echo "����: <b>$stat[1]</b><br>";break;
case 2: echo "�������������: <b>$stat[1]/$stat[1]</b><br>";break;
case 3: echo "��������: <b>$stat[1]</b><br>";break;
case 4: echo "��������: <b>$stat[1]</b><br>";break;
case 5: echo "������: $plus<b>$stat[1]%</b><br>";break;
case 6: echo "��������: $plus<b>$stat[1]%</b><br>";break;
case 7: echo "����������: $plus<b>$stat[1]%</b><br>";break;
case 8: echo "���������: $plus<b>$stat[1]%</b><br>";break;
case 9: echo "����� �����: <b>$stat[1]</b><br>";break;
case 10: echo "������ �����: $plus<b>$stat[1]%</b><br>";break;
case 27: echo "��: $plus<b>$stat[1]</b><br>";break;
case 28: echo "���� ��������: $plus<b>$stat[1]</b><br>";break;
case 29: echo "����: $plus<b>$stat[1]</b><br>";break;
case 30: echo "C���: $plus<b>$stat[1]</b><br>";break;
case 31: echo "��������: $plus<b>$stat[1]</b><br>";break;
case 32: echo "�����: $plus<b>$stat[1]</b><br>";break;
case 33: echo "��������: $plus<b>$stat[1]</b><br>";break;
case 34: echo "������: $plus<b>$stat[1]</b><br>";break;
case 35: echo "��������: $plus<b>$stat[1]</b><br>";break;
case 36: echo "�������� ������: $plus<b>$stat[1]%</b><br>";break;
case 37: echo "�������� ��������: $plus<b>$stat[1]%</b><br>";break;
case 38: echo "�������� �������� �������: $plus<b>$stat[1]%</b><br>";break;
case 39: echo "�������� ������: $plus<b>$stat[1]%</b><br>";break;
case 40: echo "�������� ����������� �������: $plus<b>$stat[1]%</b><br>";break;
case 41: echo "�������� ���������� � �������: $plus<b>$stat[1]%</b><br>";break;
case 42: echo "�������� ��������: $plus<b>$stat[1]%</b><br>";break;
case 43: echo "�������� ������������ �������: $plus<b>$stat[1]%</b><br>";break;
case 44: echo "�������� ��������� �������: $plus<b>$stat[1]%</b><br>";break;
case 45: echo "����� ����: $plus<b>$stat[1]%</b><br>";break;
case 46: echo "����� ����: $plus<b>$stat[1]%</b><br>";break;
case 47: echo "����� �������: $plus<b>$stat[1]%</b><br>";break;
case 48: echo "����� �����: $plus<b>$stat[1]%</b><br>";break;
case 49: echo "������������� ����� ����: $plus<b>$stat[1]%</b><br>";break;
case 50: echo "������������� ����� ����: $plus<b>$stat[1]%</b><br>";break;
case 51: echo "������������� ����� �������: $plus<b>$stat[1]%</b><br>";break;
case 52: echo "������������� ����� �����: $plus<b>$stat[1]%</b><br>";break;
case 53: echo "���������: $plus<b>$stat[1]%</b><br>";break;
case 54: echo "������������: $plus<b>$stat[1]%</b><br>";break;
case 55: echo "����������: $plus<b>$stat[1]%</b><br>";break;
case 56: echo "����������������: $plus<b>$stat[1]%</b><br>";break;
case 57: echo "��������: $plus<b>$stat[1]%</b><br>";break;
case 58: echo "��������: $plus<b>$stat[1]%</b><br>";break;
case 59: echo "�������: $plus<b>$stat[1]%</b><br>";break;
case 60: echo "�������: $plus<b>$stat[1]%</b><br>";break;
case 61: echo "��������� ����: $plus<b>$stat[1]%</b><br>";break;
case 62: echo "�����������: $plus<b>$stat[1]%</b><br>";break;
case 63: echo "���������: $plus<b>$stat[1]%</b><br>";break;
case 64: echo "������: $plus<b>$stat[1]%</b><br>";break;
case 65: echo "�����������: $plus<b>$stat[1]%</b><br>";break;
case 66: echo "������� �������������� ����: $plus<b>$stat[1]%</b><br>";break;
case 67: echo "���������: $plus<b>$stat[1]%</b><br>";break;
case 68: echo "�������: $plus<b>$stat[1]%</b><br>";break;
case 69: echo "�������� ������� ����: $plus<b>$stat[1]%</b><br>";break;
case 70: echo "������������: $plus<b>$stat[1]%</b><br>";break;
}
}
$dmod=explode("@",$ITEM['damage_mod']);
include($_SERVER["DOCUMENT_ROOT"]."/inc/sp_dmods.php");
?>



</td><td bgcolor=#B9A05C><img src=/img/image/1x1.gif width=1 height=1></td><td bgcolor=#FCFAF3>
<font class=weaponch><?
echo"$tr_b";
if($ITEM['srok']>0){echo'<br><font class=weaponch><b><font color=#cc0000>���� �������� ����� '.$ITEM['srok'].' ����.</font>';}
?>
</font>
</td></tr></table></td></tr></table></td></tr>
<? }}else{?>
<table cellpadding=5 cellspacing=1 border=0 width=100%><tr><td bgcolor=#F5F5F5 align=center colspan=2><font class=inv><b>��� ������� � ������ ���������.</b></font></td></tr>
<? }?>
</table>

<? }
function blocks($bl){
	if($bl!="") {
	switch($bl)
       	{
            case 40: echo "<font class=weaponch><b><font color=#cc0000>���������� 1-�� �����</font></b><br>"; break;
            case 70: echo "<font class=weaponch><b><font color=#cc0000>���������� 2-� �����</font></b><br>"; break;
	    	case 90: echo "<font class=weaponch><b><font color=#cc0000>���������� 3-� �����</font></b><br>"; break;
    	}}}
?>
</td></tr>
</table>
</td></tr>
</table>
</fieldset>
<SCRIPT src="./js/t_v01.js"></SCRIPT> 
<SCRIPT src="./js/tooltip.js"></SCRIPT> 
<SCRIPT language='JavaScript'>
NewLinksView();
</SCRIPT>