<? require('kernel/before.php');?>
<HTML>
<HEAD>
<META Http-Equiv=Content-Type Content="text/html; charset=windows-1251">
<META Http-Equiv=Cache-Control Content=No-Cache>
<META Http-Equiv=Pragma Content=No-Cache>
<META Http-Equiv=Expires Content=0>
</HEAD>
<BODY bgcolor=#FFFFFF topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0>
<table width="60%" border="0" cellspacing="0" cellpadding="0" align=center>
  <tr>
    <td align=center>
		<input type=button class=lbut onClick="location='tz.php?fl=1'" value="������ ���������� ��">
		<input type=button class=lbut onClick="location='tz.php?fl=2'" value="������ ������� ��">
	</td>
   </tr>
</table>
<? 
require_once($_SERVER["DOCUMENT_ROOT"]."/includes/sql_func.php");
foreach($_POST as $keypost=>$valp){
	$valp = varcheck($valp);
	$_POST[$keypost] = $valp;
	$$keypost = $valp;
}
foreach($_GET as $keyget=>$valg){
	$valg = varcheck($valg);
	$_GET[$keyget] = $valg;
	$$keyget = $valg;

}
foreach($_SESSION as $keyses=>$vals){
	$$keyses = $vals;
}

if($_GET['addtz']==1){
	mysql_query("INSERT INTO `tzamin` (`text`,`date`,`srok`) VALUES ('".bbCodes($tztext)."','".time()."','".$srok."')");
	echo '�� ���������';
}

if($_GET['addtz']==2){
	mysql_query("UPDATE `tzamin` SET `status`='1',`who`='".$_SESSION['user']['login']."' WHERE `id`='".$tzid."';");
}

if($_GET['addtz']==3){
	mysql_query("UPDATE `tzamin` SET `status`='0',`who`='' WHERE `id`='".$tzid."';");
}	
if($_GET['addtz']==4){
	mysql_query("DELETE FROM `tzamin` WHERE `id`='".$tzid."';");
}
if($_GET['addtz']==5){
	mysql_query("UPDATE `tzamin` SET `status`='3',`who`='".$_SESSION['user']['login']."',`startdate`='".time()."' WHERE `id`='".$tzid."';");
}

$filt="";
if($fl==1){
	$filt="WHERE status='0'";
}
if($fl==2){
	$filt="WHERE srok='1'";
}
$tzsql=mysql_query("SELECT * FROM tzamin $filt ORDER BY `srok` DESC, `id` ASC;");
if(mysql_num_rows($tzsql)>0){
echo  '<br>
<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
<tr><td>
<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
		<tr class=nickname bgcolor=#EAEAEA>
			<td align=center width=60%><b>����� �������</b></td>
			<td align=center><b>���������</b></td>
			<td align=center><b>����</b></td>
			<td align=center><b>��������</b></td>
			<td align=center><b>������</b></td>
			<td align=center><b>�������� ������</b></td>
		</tr>';
	while($row = mysql_fetch_assoc($tzsql)){
		echo'
		<tr class=nickname bgcolor=white>
			<td>'.$row['text'].'</td>
			<td align=center>'.($row['srok']>0?'<font color=red><b>����� ������</b></font>':'� ������� �������').'</td>
			<td align=center>'.date("d.m.Y H:i:s",$row['date']).'</td>
			<td align=center><b>'.(($row['who'])?$row['who']:'---').'</b></td>
			<td align=center><b>
			'.($row['status']==1?'<font color=green>���������</font>':(($row['status']==0)?'<font color=red>�� ���������</font>':'<font color=silver>��������������<br />'.date('d.m.y H:i:s',$row['startdate']).'</font>')).'</b>
			<td align=center>
			'.(	$row['status']==1?
			'
			<form method="post" action="tz.php?addtz=3">
				<input type=submit class=lbut value=" �� ��������� ">
				<input type=hidden name=tzid value="'.$row['id'].'">
			</form>'
			:(($row['status']==0)?
			'<form method="post" action="tz.php?addtz=5">
				<input type=submit class=lbut value=" ����� ">
				<input type=hidden name=tzid value="'.$row['id'].'">
			</form>':'<form method="post" action="tz.php?addtz=2">
				<input type=submit class=lbut value=" ��������� ">
				<input type=hidden name=tzid value="'.$row['id'].'">
			</form>')).'
			'.($_SESSION['user']['login']=='SANTA'?				'
			<form method="post" action="tz.php?addtz=4">
				<input type=submit class=lbut value=" ������� ">
				<input type=hidden name=tzid value="'.$row['id'].'">
			</form>'
			:'').'	
			</td>
		</tr>';		
	}
echo'</table></td></tr></table><br>';	
}
else{
echo '�� ������ �� ������ ��';
}
echo'<form action="tz.php?addtz=1" method=post>

<table border=0 cellpadding=2 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=45%>
		<tr class=nickname bgcolor=white>
			<td align=center colspan=2>
				<textarea cols=100 rows=15 title="������� ����� ��" name="tztext">
				</textarea>
			</td>
		</tr>
		<tr class=nickname bgcolor=white>
			<td align=center width=50%> 
			���������: 
				<select name="srok">
					<option value="0" selected>� ������� �������</option>
					<option value="1" >����� ������</option>
				</select>
			</td>
			<td align=center width=50%>
				<input type=submit class=lbut value=" �������� �� ">
			</td>	
		</tr>		
			

	';
echo'</table></form>';		  
?>

</body>
</html>
<? require('kernel/after.php'); ?>