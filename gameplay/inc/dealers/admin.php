<?
echo "
</form>
<script language=Javascript>
function artRename(e){
document.getElementById('artname').value = e;
}
function deleteArt(){
	document.getElementById('post_id').value = 87;
}
</script>
";
$timer=time()-604800;
mysqli_query($GLOBALS['db_link'],"DELETE FROM art_zayav WHERE cr_time<=".$timer.";");
$nar = Array ('���������� ���','�������� ������','�������� ��������','�������� �������� �������','�������� ������','�������� ������� � ����������� �������','�������� ������� ����������','�������� ����������� ��������','�������� ������������ �������','�������� ��������� �������','�������� ����� ������','�������������� ���� �������� � ���','����� ����','����� ����','����� �������','����� �����','������������� ����� ����','������������� ����� ����','������������� ����� �������','������������� ����� �����','������������� ������������','���������','������������','����������','����������������','��������','��������','�������','�������','��������� ����','�����������','���������','������','������� �������������� ����','���������','�������� ����� ��������','�������� ������� ����');
$query=mysqli_query($GLOBALS['db_link'],"SELECT * FROM art_zayav ".$filter.";");
if(mysqli_num_rows($query)>0){
while($row = mysqli_fetch_assoc($query)){
	switch($row['type']){
		case '': 
			$type = "zero"; 
		break;
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
		default: $type = "zero"; break;		
		}
	$gamer=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM user WHERE id=".$row['pl_id'].";"));
	echo "<form method=post><font class=proce><font color=#222222><FIELDSET><LEGEND align=center><B><font color=gray>&nbsp;������ �� <a href='http://www.legendbattles.ru/ipers.php?".$gamer['login']."' target='_blank'>".$gamer['login']."</a>&nbsp;[".$type."]&nbsp;</font></B></LEGEND>
	<table cellpadding=10 cellspacing=0 border=0 width=100%>
		<tr><td class=nickname2>";	
		echo "<b>�������� ���������:</b> <input type=text value=\"".$row['name']."\" onkeyup=\"artRename(this.value);\">&nbsp;&nbsp;".($row['compl']==0 ? "<input align=right type=submit class=klbut value=\"�������\" />" : "<font color=gray>�������� ������</font>")."&nbsp;";
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
		echo "<font class=proce><font color=#222222><FIELDSET name=field_dealers id=field_dealers><LEGEND align=center><B><font color=gray>&nbsp;����� � ������ �����&nbsp;</font></B></LEGEND>";
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
echo "</FIELDSET>
<input type=hidden id=artname name=artname value=".$row['name']." />
<input type=hidden name=id value=".$row['id'].">
<input type=hidden id=post_id name=post_id value=86 />
<input type=hidden name=vcode value=";echo scod();echo" />
</form>
";
		echo'	
</td></tr>
</table></FIELDSET><br><br>';
}
}
else{
		echo'<FIELDSET name=field_dealers id=field_dealers>
		<table cellpadding=0 cellspacing=0 border=0 width=100%>
			<tr><td align=center>
				<font  class=nickname2 style="color:#336699"><b>������ �� �������</b></font>
			</td></tr>
		</table>
		</FIELDSET>
		';
}
?>