<?php

echo'<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#e0e0e0><table cellpadding=3 cellspacing=1 border=0 width=100%>';
$par=explode("|",$ITEM['param']);
$need=explode("|",$ITEM['need']);
$bt=0;$tr_b='';$m=1;
foreach ($need as $value) {
$treb=explode("@",$value);
if($treb[0]==72){$treb[1]=$ITEM['level'];}
if($treb[0]==71){$treb[1]=$ITEM['massa'];}
if($treb[0]!=28){if($treb[0]==71){$m=0;}}
switch($treb[0])
{
case 28: $tr_b.="&nbsp;���� ��������: <b>$treb[1]</b><br>";break;
case 30: $tr_b.="&nbsp;����: <b>$treb[1]</b><br>";break;
case 31: $tr_b.="&nbsp;�����������: <b>$treb[1]</b><br>";break;
case 32: $tr_b.="&nbsp;�������: <b>$treb[1]</b><br>";break;
case 33: $tr_b.="&nbsp;��������: <b>$treb[1]</b><br>";break;
case 34: $tr_b.="&nbsp;�����: <b>$treb[1]</b><br>";break;
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
case 70: $tr_b.="&nbsp;�������: <b>$treb[1]</b><br>";break;
case 71: $tr_b.="&nbsp;�����: <b>$treb[1]</b><br>";break;
case 72: $tr_b.="&nbsp;�������: <b>$treb[1]</b><br>";break;
}
}
echo'
<tr>
<td bgcolor=#f9f9f9>
	<div align=center>
		<img src=/img/image/weapon/'.$ITEM['gif'].' border=0>
	</div>
</td>
<td width=100% bgcolor=#ffffff valign=top>
	<table cellpadding=0 cellspacing=0 border=0 width=100%>
		<tr>
			<td bgcolor=#ffffff width=100%>
				<font class=weaponch><b>'.$ITEM['name'].'</b><font class=weaponch><br>
				<img src=/img/image/1x1.gif width=1 height=3></td><td><br><img src=/img/image/1x1.gif width=1 height=3
			</td>
		</tr>
		<tr>
			<td colspan=2 width=100%>
				<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#D8CDAF width=50%>
					<div align=center><font class=invtitle>��������</div></td><td bgcolor=#B9A05C>
					<img src=/img/image/1x1.gif width=1 height=1></td><td bgcolor=#D8CDAF width=50%>
					<div align=center><font class=invtitle>����������</div>
				</td></tr>
<tr><td bgcolor=#FCFAF3><font class=weaponch>&nbsp;����: <b>'.$ITEM['price'].' ������</b><br>';
if($ITEM['slot']==16) {echo "<font class=weaponch><b><font color=#cc0000>����� ������� �� ��������</font></b><br>";}
blocks($ITEM['block']);
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
case 11: echo "������ ������� ������: $plus<b>$stat[1]%</b><br>";break;
case 12: echo "������ ������� ������: $plus<b>$stat[1]%</b><br>";break;
case 13: echo "������ ����������� ������: $plus<b>$stat[1]%</b><br>";break;
case 14: echo "������ ����������� ������: $plus<b>$stat[1]%</b><br>";break;
case 15: echo "������ ������� ������: $plus<b>$stat[1]%</b><br>";break;
case 16: echo "������ �������� ������: $plus<b>$stat[1]%</b><br>";break;
case 17: echo "������ ���������� ������: $plus<b>$stat[1]%</b><br>";break;
case 18: echo "������ �������� ������: $plus<b>$stat[1]%</b><br>";break;
case 19: echo "������ �� ������� ������: $plus<b>$stat[1]</b><br>";break;
case 20: echo "������ �� ������� ������: $plus<b>$stat[1]</b><br>";break;
case 21: echo "������ �� ����������� ������: $plus<b>$stat[1]</b><br>";break;
case 22: echo "������ �� ����������� ������: $plus<b>$stat[1]</b><br>";break;
case 23: echo "������ �� ������� ������: $plus<b>$stat[1]</b><br>";break;
case 24: echo "������ �� �������� ������: $plus<b>$stat[1]</b><br>";break;
case 25: echo "������ �� ���������� ������: $plus<b>$stat[1]</b><br>";break;
case 26: echo "������ �� �������� ������: $plus<b>$stat[1]</b><br>";break;
case 27: echo "��: $plus<b>$stat[1]</b><br>";break;
case 28: echo "���� ��������: $plus<b>$stat[1]</b><br>";break;
case 29: echo "����: $plus<b>$stat[1]</b><br>";break;
case 30: echo "����: $plus<b>$stat[1]</b><br>";break;
case 31: echo "�����������: $plus<b>$stat[1]</b><br>";break;
case 32: echo "�������: $plus<b>$stat[1]</b><br>";break;
case 33: echo "��������: $plus<b>$stat[1]</b><br>";break;
case 34: echo "�����: $plus<b>$stat[1]</b><br>";break;
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
case 70: echo "�������: $plus<b>$stat[1]%</b><br>";break;
}
}
echo'</td><td bgcolor=#B9A05C><img src=/img/image/1x1.gif width=1 height=1></td><td bgcolor=#FCFAF3><font class=weaponch>'.$tr_b.'</font></td></tr></table></td></tr></table></td></tr></table>';
echo'</td></tr></table></td>';

?>