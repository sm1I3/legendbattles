<?
echo '
<table border=0 cellpadding=4 cellspacing=1 align=center class="smallhead" width=100%>
<tr class=nickname align=center>
<td align=center width=100%>';
switch($message){
 case 1: 
	echo "�� ��������� ��������� ".$chrecipe['name'].".";
 break;
 case 2:
	echo '������������ ������ ��� ������� �������.';
 break;
  case 3:
	echo '��������� ����� ��� ������� �������.';
 break;
 case 4:
	echo '���� ������ ��� ����������.';
 break;
 case 5:
	echo '�� ������� ������� <b>'.$IT['name'].'</b> '.$chrecipe['col'].'��.</font>';
	$calcup=($pt[75]-$chrecipe['nav'])+3;
	if(rand(1,$calcup)==$calcup){
		mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `koldyn`=`koldyn`+'1' WHERE `id`='".$player['id']."'");
		echo '<br><b>��� ����� ������� ��������� �� <font color=red>+1</font>.</b>';
	}
 break;
 case 6:
	echo' <font color=red><b>������������ ���������</b></font><br>'.$regmiss;
 break;
 case 7:
	echo '������� �� ������ � ����';
 break;
 case 8:
	echo '������� ����� ���������� ������.';
 break;
}
echo'</td></tr></table>';
?>