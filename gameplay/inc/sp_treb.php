<?php
if($treb[0]==72){
	$treb[1]=$ITEM[level];
}
if($treb[0]==71){
	$treb[1]=$ITEM[massa];
	if($mass-$plstt[71]<$treb[1]){
		$treb[1]="<font color=#cc0000>$treb[1]</font>";
	}
}
if($treb[0]==73){
	$Doblest = array(0=>'������',1=>'����a�',2=>'��e�',3=>'����',4=>'������� ����',5=>'�e�����',6=>'��a��a���',7=>'��������e�',8=>'�a��e� �����',9=>'�e���',10=>'������� �������',11=>'������� �����',12=>'���������',13=>'������ �������',14=>'����������');
	$trtmp = $treb[1];
	$treb[1] = $Doblest[$treb[1]];
	if($player['u_lvl']<$trtmp){
		$treb[1]="<font color=#cc0000>".$treb[1]."</font>";
		$bt+=1;
	}
}
			if($treb[0]==74){
      $trtmp = $treb[1];
	    $treb[1] = $treb[1];
	    if($player['vzlomshik_nav']<$trtmp){
		  $treb[1]="<font color=#cc0000>".$treb[1]."</font>";
		  $bt+=1;
	      }
      }
if($treb[0]!=28 and $treb[0]!=71 and $treb[0]!=73 and $treb[0]!=74){
	if($plstt[$treb[0]]<$treb[1]){
		$treb[1]="<font color=#cc0000>$treb[1]</font>";
		$bt+=1;
	}
}
switch($treb[0]){
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
	case 73: $tr_b.="&nbsp;������: <b>$treb[1]</b><br>";break;
	case 74: $tr_b.="&nbsp;��������: <b>$treb[1]</b><br>";break;

}
?>