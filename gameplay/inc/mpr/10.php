<? echo '<tr><td width=100% bgcolor=white>
<font class=proce>
<FIELDSET>
<LEGEND align=center><B><font color=gray>&nbsp;������� �����&nbsp;</font></B></LEGEND>
<table cellpadding=0 cellspacing=0 border=0 width=100% bgcolor=#FF3300>
<tr><td>
<table border=0 cellpadding=2 cellspacing=1 bordercolor=#FF3300 align=center class="smallhead" width=100%>
  <tr bgcolor=#EAEAEA align=center>
    <td> ��.</td>
    <td> ����� �� ������</td>
    <td> ������� ����</td>
    <td> ���������� c�����</td>
    <td> ������</td>
    <td> ������</td>
    <td> ������ ������</td>
    <td> ������ ������</td>
  </tr>
  <tr valign=middle class=nickname bgcolor=FF3301>
    <td height=20><div align=center>0</div></td>
    <td height=20><div align=center>100</div></td>
    <td height=20><div align=center>1</div></td>
    <td height=20><div align=center>12</div></td>
    <td height=20><div align=center>100</div></td>
    <td height=20><div align=center>1</div></td>
    <td height=20><div align=center>3</div></td>
    <td height=20><div align=center>8</div></td>
  </tr>
  ';
 //case 1: $arr=array("exp"=>200,"ma"=>12,"ex"=>2,"frs"=>3,"nv"=>200,"nav"=>1,"mum"=>3,"bum"=>4);break;
 $exp=100;
 $nav=1;
 $mum=3;
 $bum=8;
 $frs=12;
 $nv=100;
  $i=1;
  while($i <= 29){
  echo '<tr valign=middle class=nickname bgcolor=white>';
	$arr=exp_level($i);
	$nav+=$arr['nav'];
	$mum+=$arr['mum'];
	$bum+=$arr['bum'];
	$nv+=$arr['nv'];
	$frs+=$arr['frs'];
	echo '<td height=20><div align=center>'.$i.'</div></td>'; //�������
	echo '<td height=20><div align=center>'.$arr['exp'].'</div></td>'; //����� �� ������
	echo '<td height=20><div align=center>'.$arr['ex'].'</div></td>'; //������� ����
	echo '<td height=20><div align=center>'.$arr['frs'].'('.$frs.')</div></td>'; //���������� c�����
	echo '<td height=20><div align=center>'.$arr['nv'].'('.$nv.')</div></td>'; //������
	echo '<td height=20><div align=center>'.$arr['nav'].'('.$nav.')</div></td>'; //������
	echo '<td height=20><div align=center>'.$arr['mum'].'('.$mum.')</div></td>'; //������ ������
	echo '<td height=20><div align=center>'.$arr['bum'].'('.$bum.')</div></td>'; //������ ������	
  echo '</tr>';
  $i++;
  }

echo'
</table>
</td></tr>
</table>
</FIELDSET>
</td></tr>
';
