<?
$nar = Array ('���������� ���','�������� ������','�������� ��������','�������� �������� �������','�������� ������','�������� ������� � ����������� �������','�������� ������� ����������','�������� ����������� ��������','�������� ������������ �������','�������� ��������� �������','�������� ����� ������','�������������� ���� �������� � ���','����� ����','����� ����','����� �������','����� �����','������������� ����� ����','������������� ����� ����','������������� ����� �������','������������� ����� �����','������������� ������������','���������','������������','����������','����������������','��������','��������','�������','�������','��������� ����','�����������','���������','������','������� �������������� ����','���������','�������� ����� ��������','�������� ������� ����');
$timer=time()-604800;
$query=mysqli_query($GLOBALS['db_link'],"SELECT * FROM art_zayav WHERE pl_id=".$player['id']." AND cr_time>=".$timer.";");
if(mysqli_num_rows($query)>0){
while($row = mysqli_fetch_assoc($query)){
	switch($row['type']){
		 case 'w1': 
			$type = "���"; 
		break;
		case 'w2': 
			$type = "�����";
		break;
		case 'w3': 
			$type = "��������";
		break;
		case 'w4': 
			$type = "���";
		break;
		case 'w5': 
			$type = "�����������";
		break;
		case 'w6': 
			$type = "��������";
		break;
		case 'w7': 
			$type = "�����";
		break;
		case 'w18': 		 
			 $type = "��������";			 
		break;
		case 'w19': 
			 $type = "������";			
		break;
		case 'w20': 
			 $type = "���";			 
		break;
		case 'w21': 		 
			 $type = "������";			 
		break;
		case 'w22': 
			 $type = "������";			 
		break;
		case 'w23': 		 
			 $type = "����";			
		break;
		case 'w24': 		 
			 $type = "��������";			
		break;
		case 'w25':			 
			 $type = "�����";			 
		break;
		case 'w26': 		 
			 $type = "����";			 
		break;
		case 'w28': 		 
			 $type = "����������";			 
		break;
		case 'w80': 		 
			 $type = "������";			
		break;	
		case 'w90': 		 
			 $type = "�����������";			 
		break;	
		}
	$gamer=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM user WHERE id=".$row['pl_id'].";"));
	echo "<font class=proce><font color=#222222><FIELDSET><LEGEND align=center><B><font color=gray>&nbsp;������ �� ".$gamer['login']."&nbsp;[".$type."]&nbsp;</font></B></LEGEND>
	<table cellpadding=10 cellspacing=0 border=0 width=100%>
		<tr><td class=nickname2>";	
		echo "<font class=weaponch><b>�������� ���������:</b> ".$row['name']."&nbsp;&nbsp;<br><b>������:</b>"; if($row['compl']==0){echo"<font style='color:red'> ������ �� ���������</font></font>";}else if($row['compl']==1){echo"<font style='color:green'>������ ���������</font></font>";}
		echo "<font class=proce><font color=#222222><FIELDSET><LEGEND align=center><B><font color=gray>&nbsp;��� � ����&nbsp;</font></B></LEGEND>".$type."</b><br>����: <b>".$row['price']." $</b><br>";if ($row['damage']!=0){echo "����: <b>".$row['damage']."</b><br>";}if ($row['koeff']!=0){echo "�����������: <b>".$row['koeff']."</b><br>";}if ($row['hp']!=0){echo "�����: <b>".$row['hp']."</b><br>";}echo"</FIELDSET>";
		//�����
		echo "<font class=proce><font color=#222222><FIELDSET><LEGEND align=center><B><font color=gray>&nbsp;����� � ��&nbsp;</font></B></LEGEND>";
		if($row['sila']!=0){
			echo "����: <b>".$row['sila']."</b><br>";
		}
		if($row['lovkost']!=0){
			echo "�����������: <b>".$row['lovkost']."</b><br>";
		}	
		if($row['udacha']!=0){
			echo "�������: <b>".$row['udacha']."</b><br>";
		}	
		if($row['znan']!=0){
			echo "�����: <b>".$row['znan']."</b><br>";
		}	
		//��
		if($row['ylov']!=0){
			echo "������: <b>".$row['ylov']."</b><br>";
		}	
		if($row['toch']!=0){
			echo "��������: <b>".$row['toch']."</b><br>";
		}	
		if($row['sokr']!=0){
			echo "����������: <b>".$row['sokr']."</b><br>";
		}	
		if($row['stoi']!=0){
			echo "���������: <b>".$row['stoi']."</b><br>";
		}
		echo "</FIELDSET>";
//������ � �����
		echo "<font class=proce><font color=#222222><FIELDSET><LEGEND align=center><B><font color=gray>&nbsp;����� � ������ �����&nbsp;</font></B></LEGEND>";
		if($row['armor']!=0){
			echo "�����: <b>".$row['armor']."</b><br>";
		}
		if($row['proboi']!=0){
			echo "������ �����: <b>".$row['proboi']."</b><br>";
		}
		echo "</FIELDSET>";
$i=0;
echo "<font class=proce><font color=#222222><FIELDSET><LEGEND align=center><B><font color=gray>&nbsp;������&nbsp;</font></B></LEGEND>";
if($row['nav']!=''){
	$nav=explode("|",$row['nav']);
	while($i <= 33){
		if($nav[$i]!=''){
			echo $nar[$i].": <b>".$nav[$i]."</b><br>";
		}
		$i++;
	}
}		
echo "</FIELDSET>";
		echo'	
</td></tr>
</table></FIELDSET><br><br>';
}
}
else{
mysqli_query($GLOBALS['db_link'],"DELETE FROM art_zayav WHERE cr_time<=".$timer.";");
		echo'	<font class=proce><font color=#222222><FIELDSET>
		<table cellpadding=0 cellspacing=0 border=0 width=100%>
			<tr><td align=center>
				<font  class=nickname2 style="color:#336699"><b>������ �� �������</b></font>
			</td></tr>
		</table>
		</FIELDSET>
		';
}
?>