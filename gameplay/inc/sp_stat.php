<?php
if($stat[1]>0){
	$plus = "+";		
}else{
	$plus ="";
}
if ($stat[0]>4 and $stat[0]<11 and $stat[0]!=9){
	$percent="%";
}else{
	$percent="";
}
if($stat[0]==1){
	$pr=explode("-",$modstat[1]);		
	$pri=explode("-",$stat[1]);
	$modstroke="".($modstat[1]!='' ?  ($pr[0]+$pri[0])."-".($pr[1]+$pri[1])."$percent  </b>[".($modstat[1]>0 ? "<font color=green> <b>".$modstat[1]."</b>$percent" : "<font color=red><b>".$modstat[1]."</b>$percent")."</font></b> ]<b> " : "$stat[1]$percent")."";
}else{
	$modstroke="".($modstat[$stat[0]]!='' ?  $stat[1]+$modstat[$stat[0]]."$percent  </b>[".($modstat[$stat[0]]>0 ? "<font color=green>+<b>".$modstat[$stat[0]]."</b>$percent" : "<font color=red><b>".$modstat[$stat[0]]."</b>$percent")."</font></b> ]<b> " : "$stat[1]$percent")."";
}
switch($stat[0]){
	//case 0: echo "&nbsp;����������: <b>".$modstroke."</b><br>"; break;
	case 1: echo "&nbsp;����: <b>".$modstroke."</b><br>";break;
	case 2: echo "&nbsp;�������������: <b>".(($iz==1 and $ITEM[slot]!=5) ? "<font color=red>".$iz."</font>" : $iz)."/$ITEM[dolg]</b><br>";break;
	case 3: echo "&nbsp;��������: <b>".$modstroke."</b><br>";break;
	case 4: echo "&nbsp;��������: <b>".$modstroke."</b><br>";break;
	case 5: echo "&nbsp;������: $plus<b>".$modstroke."</b><br>";break;
	case 6: echo "&nbsp;��������: $plus<b>".$modstroke."</b><br>";break;
	case 7: echo "&nbsp;����������: $plus<b>".$modstroke."</b><br>";break;
	case 8: echo "&nbsp;���������: $plus<b>".$modstroke."</b><br>";break;
	case 9: echo "&nbsp;����� �����: <b>".$modstroke."</b><br>";break;
	case 10: echo "&nbsp;������ �����: $plus<b>".$modstroke."</b><br>";break;
	case 11: echo "&nbsp;������ ������� ������: $plus<b>".$modstroke."%</b><br>";break;
	case 12: echo "&nbsp;������ ������� ������: $plus<b>".$modstroke."%</b><br>";break;
	case 13: echo "&nbsp;������ ����������� ������: $plus<b>".$modstroke."%</b><br>";break;
	case 14: echo "&nbsp;������ ����������� ������: $plus<b>".$modstroke."%</b><br>";break;
	case 15: echo "&nbsp;������ ������� ������: $plus<b>".$modstroke."%</b><br>";break;
	case 16: echo "&nbsp;������ �������� ������: $plus<b>".$modstroke."%</b><br>";break;
	case 17: echo "&nbsp;������ ���������� ������: $plus<b>".$modstroke."%</b><br>";break;
	case 18: echo "&nbsp;������ �������� ������: $plus<b>".$modstroke."%</b><br>";break;
	case 19: echo "&nbsp;������ �� ������� ������: $plus<b>".$modstroke."</b><br>";break;
	case 20: echo "&nbsp;������ �� ������� ������: $plus<b>".$modstroke."</b><br>";break;
	case 21: echo "&nbsp;������ �� ����������� ������: $plus<b>".$modstroke."</b><br>";break;
	case 22: echo "&nbsp;������ �� ����������� ������: $plus<b>".$modstroke."</b><br>";break;
	case 23: echo "&nbsp;������ �� ������� ������: $plus<b>".$modstroke."</b><br>";break;
	case 24: echo "&nbsp;������ �� �������� ������: $plus<b>".$modstroke."</b><br>";break;
	case 25: echo "&nbsp;������ �� ���������� ������: $plus<b>".$modstroke."</b><br>";break;
	case 26: echo "&nbsp;������ �� �������� ������: $plus<b>".$modstroke."</b><br>";break;
	case 27: echo "&nbsp;��: $plus<b>".$modstroke."</b><br>";break;
	case 28: echo "&nbsp;���� ��������: $plus<b>".$modstroke."</b><br>";break;
	case 29: echo "&nbsp;����: $plus<b>".$modstroke."</b><br>";break;
	case 30: echo "&nbsp;����: $plus<b>".$modstroke."</b><br>";break;
	case 31: echo "&nbsp;�����������: $plus<b>".$modstroke."</b><br>";break;
	case 32: echo "&nbsp;�������: $plus<b>".$modstroke."</b><br>";break;
	case 33: echo "&nbsp;��������: $plus<b>".$modstroke."</b><br>";break;
	case 34: echo "&nbsp;�����: $plus<b>".$modstroke."</b><br>";break;
	case 35: echo "&nbsp;��������: $plus<b>".$modstroke."</b><br>";break;
	case 36: echo "&nbsp;�������� ������: $plus<b>".$modstroke."%</b><br>";break;
	case 37: echo "&nbsp;�������� ��������: $plus<b>".$modstroke."%</b><br>";break;
	case 38: echo "&nbsp;�������� �������� �������: $plus<b>".$modstroke."%</b><br>";break;
	case 39: echo "&nbsp;�������� ������: $plus<b>".$modstroke."%</b><br>";break;
	case 40: echo "&nbsp;�������� ����������� �������: $plus<b>".$modstroke."%</b><br>";break;
	case 41: echo "&nbsp;�������� ���������� � �������: $plus<b>".$modstroke."%</b><br>";break;
	case 42: echo "&nbsp;�������� ��������: $plus<b>".$modstroke."%</b><br>";break;
	case 43: echo "&nbsp;�������� ������������ �������: $plus<b>".$modstroke."%</b><br>";break;
	case 44: echo "&nbsp;�������� ��������� �������: $plus<b>".$modstroke."%</b><br>";break;
	case 45: echo "&nbsp;����� ����: $plus<b>".$modstroke."%</b><br>";break;
	case 46: echo "&nbsp;����� ����: $plus<b>".$modstroke."%</b><br>";break;
	case 47: echo "&nbsp;����� �������: $plus<b>".$modstroke."%</b><br>";break;
	case 48: echo "&nbsp;����� �����: $plus<b>".$modstroke."%</b><br>";break;
	case 49: echo "&nbsp;������������� ����� ����: $plus<b>".$modstroke."%</b><br>";break;
	case 50: echo "&nbsp;������������� ����� ����: $plus<b>".$modstroke."%</b><br>";break;
	case 51: echo "&nbsp;������������� ����� �������: $plus<b>".$modstroke."%</b><br>";break;
	case 52: echo "&nbsp;������������� ����� �����: $plus<b>".$modstroke."%</b><br>";break;
	case 53: echo "&nbsp;���������: $plus<b>".$modstroke."%</b><br>";break;
	case 54: echo "&nbsp;������������: $plus<b>".$modstroke."%</b><br>";break;
	case 55: echo "&nbsp;����������: $plus<b>".$modstroke."%</b><br>";break;
	case 56: echo "&nbsp;����������������: $plus<b>".$modstroke."%</b><br>";break;
	case 57: echo "&nbsp;��������: $plus<b>".$modstroke."%</b><br>";break;
	case 58: echo "&nbsp;��������: $plus<b>".$modstroke."%</b><br>";break;
	case 59: echo "&nbsp;�������: $plus<b>".$modstroke."%</b><br>";break;
	case 60: echo "&nbsp;�������: $plus<b>".$modstroke."%</b><br>";break;
	case 61: echo "&nbsp;��������� ����: $plus<b>".$modstroke."%</b><br>";break;
	case 62: echo "&nbsp;�����������: $plus<b>".$modstroke."%</b><br>";break;
	case 63: echo "&nbsp;���������: $plus<b>".$modstroke."%</b><br>";break;
	case 64: echo "&nbsp;������: $plus<b>".$modstroke."%</b><br>";break;
	case 65: echo "&nbsp;�����������: $plus<b>".$modstroke."%</b><br>";break;
	case 66: echo "&nbsp;������� �������������� ����: $plus<b>".$modstroke."%</b><br>";break;
	case 67: echo "&nbsp;���������: $plus<b>".$modstroke."%</b><br>";break;
	case 68: echo "&nbsp;�������: $plus<b>".$modstroke."%</b><br>";break;
	case 69: echo "&nbsp;�������� ������� ����: $plus<b>".$modstroke."%</b><br>";break;
	case 70: echo "&nbsp;������������: $plus<b>".$modstroke."%</b><br>";break;
	case 71: echo "&nbsp;<font color=#BB0000>�����������: $plus<b>".$modstroke."%</b></font><br>";break;
	case 'expbonus': echo "&nbsp;����� �����: <font color=#BB0000>$plus<b>".$modstroke."%</b></font><br>";break;
	case 'massbonus': echo "&nbsp;�����: <font color=#BB0000>$plus<b>".$modstroke."</b></font><br>";break;
}
?>