<HTML>
<HEAD>
<LINK href="../../../css/game.css" rel=STYLESHEET type=text/css>
<META Http-Equiv=Content-Type Content="text/html; charset=windows-1251">
<META Http-Equiv=Cache-Control Content=No-Cache>
<META Http-Equiv=Pragma Content=No-Cache>
<META Http-Equiv=Expires Content=0>
		<script>
			changeForm = function(select,val){
				select.style.background = '#'+val;
			}
		</script>
</HEAD>
<BODY bgcolor=#FFFFFF topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0>
<table width="60%" border="0" cellspacing="0" cellpadding="0" align=center>
  <tr>
    <td align=center>
		<input type=button class=lbut onClick="location='adm.php'" value="���������">
		<input type=button class=lbut onClick="location='real_dd_adm.php'" value="��������">
	</td>
   </tr>
</table>
<?
require_once($_SERVER["DOCUMENT_ROOT"]."/includes/func/connect.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/includes/func/sql_func.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/inc/bbcodes.inc.php");

if($_POST['post_id']){
	switch(intval($_POST['post_id'])){
	 case 1:
		$pr = $_POST['pr'];
		for($i=1;$i<=71;$i++){
			if($pr[$i]!=""){$par.="$i@$pr[$i]|";}
			else{$par.="$i@0|";}
		}
		if($pr['expbonus']!=""){$par.="expbonus@$pr[expbonus]|";}
		if($pr['massbonus']!=""){$par.="massbonus@$pr[massbonus]|";}
		mysqli_query($GLOBALS['db_link'],"UPDATE `real_dd_adm` SET `param_price`='".$par."',`kf`='".intval($_POST['kf'])."' WHERE `id`='1' LIMIT 1;");
		$par='';
	 break;
	}
}


$getstats = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `real_dd_adm` WHERE `id`='1' LIMIT 1;"));
$stats = explode("|",$getstats['param_price']);
foreach($stats as $val){
	$param = explode("@",$val);
	$par[$param[0]] = $param[1];
}
echo'
<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
	<tr><td>
	<form method=post> 	
	<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
		<tr class=nickname bgcolor=#EAEAEA>
			<td align=center width=100%  colspan=4><b>���� �� ������� ������</b><br><font class=proceb>���� � DLR</font></td>
		</tr>
		<tr class=nickname bgcolor=#EAEAEA>
			<td align=center width=100%  colspan=4>
				�����. ���������� ��������� ���� [<font class=proce><b>�� ������ ���.���� � %</b></font>]: <input class=Logintextbox8 name=kf type=text value="'.$getstats['kf'].'">
			</td>
		</tr>
		<tr class=nickname bgcolor=#EAEAEA>
		';
for($i=0;$i<=71;$i++){
	if(!$par[$i]){$par[$i]=0;}
	switch($i){
		case 1: echo '<td align=left width=20% bgcolor=white>'; break;
		case 35: echo '</td><td align=left width=20% bgcolor=white>'; break;
		case 50: echo '</td><td align=left width=20% bgcolor=white>'; break;
		case 60: echo '</td><td align=left width=20% bgcolor=white>'; break;
		
	}
	$fr="";	
	switch($i){
		case 1: $fr="���� [<font class=proce><b>�� 1-1</b></font>]:";break;
		case 5: $fr="������  [<font class=proce><b>�� 1%</b></font>]:";break;
		case 6: $fr="��������  [<font class=proce><b>�� 1%</b></font>]:";break;
		case 7: $fr="����������  [<font class=proce><b>�� 1%</b></font>]:";break;
		case 8: $fr="���������  [<font class=proce><b>�� 1%</b></font>]:";break;
		case 9: $fr="����� �����  [<font class=proce><b>�� 1��</b></font>]:";break;
		case 10: $fr="������ �����  [<font class=proce><b>�� 1%</b></font>]:";break;
		/*case 11: $fr="������ ������� ������:";break;
		case 12: $fr="������ ������� ������:";break;
		case 13: $fr="������ ����������� ������:";break;
		case 14: $fr="������ ����������� ������:";break;
		case 15: $fr="������ ������� ������:";break;
		case 16: $fr="������ �������� ������:";break;
		case 17: $fr="������ ���������� ������:";break;
		case 18: $fr="������ �������� ������:";break;
		case 19: $fr="������ �� ������� ������:";break;
		case 20: $fr="������ �� ������� ������:";break;
		case 21: $fr="������ �� ����������� ������:";break;
		case 22: $fr="������ �� ����������� ������:";break;
		case 23: $fr="������ �� ������� ������:";break;
		case 24: $fr="������ �� �������� ������:";break;
		case 25: $fr="������ �� ���������� ������:";break;
		case 26: $fr="������ �� �������� ������:";break;*/
		case 27: $fr="�� [<font class=proce><b>�� +1</b></font>]:";break;
		case 28: $fr="���� ��������:  [<font class=proce><b>�� +1</b></font>]";break;
		case 29: $fr="����  [<font class=proce><b>�� +1</b></font>]:";break;
		case 30: $fr="����  [<font class=proce><b>�� +1</b></font>]:";break;
		case 31: $fr="�����������  [<font class=proce><b>�� +1</b></font>]:";break;
		case 32: $fr="�������  [<font class=proce><b>�� +1</b></font>]:";break;
		case 33: $fr="��������  [<font class=proce><b>�� +1</b></font>]:";break;
		case 34: $fr="����� [<font class=proce><b>�� +1</b></font>]:";break;
		//case 35: $fr="��������:";break;
		case 36: $fr="����. ������ [<font class=proce><b>�� +1</b></font>]:";break;
		case 37: $fr="����. �������� [<font class=proce><b>�� +1</b></font>]:";break;
		case 38: $fr="����. �������� ������� [<font class=proce><b>�� +1</b></font>]:";break;
		case 39: $fr="����. ������ [<font class=proce><b>�� +1</b></font>]:";break;
		case 40: $fr="����. ����������� ������� [<font class=proce><b>�� +1</b></font>]:";break;
		case 41: $fr="����. ���������� � ������� [<font class=proce><b>�� +1</b></font>]:";break;
		case 42: $fr="����. �������� [<font class=proce><b>�� +1</b></font>]:";break;
		case 43: $fr="����. ������������ ������� [<font class=proce><b>�� +1</b></font>]:";break;
		case 44: $fr="����. ��������� ������� [<font class=proce><b>�� +1</b></font>]:";break;
		case 45: $fr="����� ���� [<font class=proce><b>�� +1</b></font>]:";break;
		case 46: $fr="����� ���� [<font class=proce><b>�� +1</b></font>]:";break;
		case 47: $fr="����� ������� [<font class=proce><b>�� +1</b></font>]:";break;
		case 48: $fr="����� ����� [<font class=proce><b>�� +1</b></font>]:";break;
		case 49: $fr="������������� ����� ���� [<font class=proce><b>�� +1</b></font>]:";break;
		case 50: $fr="������������� ����� ���� [<font class=proce><b>�� +1</b></font>]:";break;
		case 51: $fr="������������� ����� ������� [<font class=proce><b>�� +1</b></font>]:";break;
		case 52: $fr="������������� ����� ����� [<font class=proce><b>�� +1</b></font>]:";break;
		case 53: $fr="��������� [<font class=proce><b>�� +1</b></font>]:";break;
		case 54: $fr="������������ [<font class=proce><b>�� +1</b></font>]:";break;
		case 55: $fr="���������� [<font class=proce><b>�� +1</b></font>]:";break;
		case 56: $fr="���������������� [<font class=proce><b>�� +1</b></font>]:";break;
		case 57: $fr="�������� [<font class=proce><b>�� +1</b></font>]:";break;
		case 58: $fr="�������� [<font class=proce><b>�� +1</b></font>]:";break;
		case 59: $fr="������� [<font class=proce><b>�� +1</b></font>]:";break;
		case 60: $fr="������� [<font class=proce><b>�� +1</b></font>]:";break;
		case 61: $fr="��������� ���� [<font class=proce><b>�� +1</b></font>]:";break;
		case 62: $fr="����������� [<font class=proce><b>�� +1</b></font>]:";break;
		case 63: $fr="��������� [<font class=proce><b>�� +1</b></font>]:";break;
		case 64: $fr="������ [<font class=proce><b>�� +1</b></font>]:";break;
		case 65: $fr="����������� [<font class=proce><b>�� +1</b></font>]:";break;
		case 66: $fr="������� �������������� ���� [<font class=proce><b>�� +1</b></font>]:";break;
		case 67: $fr="��������� [<font class=proce><b>�� +1</b></font>]:";break;
		case 68: $fr="������� [<font class=proce><b>�� +1</b></font>]:";break;
		case 69: $fr="�������� ������� ���� [<font class=proce><b>�� +1</b></font>]:";break;
		case 70: $fr="������������ [<font class=proce><b>�� +1</b></font>]:";break;
		case 71: $fr="�����������(new) [<font class=proce><b>�� +1</b></font>]:";break;
	}
	if($fr!="")echo '<font class=weaponch><b>'.$fr.'</b></font>&nbsp;<input class=Logintextbox8 name=pr['.$i.'] type=text value="'.$par[$i].'"><br>';
}
//���� � �����
if(!$par['expbonus']){$par['expbonus']=0;}
if(!$par['massbonus']){$par['massbonus']=0;}
echo '<font class=weaponch><b>����� ����� (� %) [<font class=proce><b>�� 1%</b></font>]:</b></font>&nbsp;<input class=Logintextbox8 name=pr[expbonus] type=text value="'.$par['expbonus'].'"><br>';
echo '<font class=weaponch><b>����� ����� [<font class=proce><b>�� +1</b></font>]:</b></font>&nbsp;<input class=Logintextbox8 name=pr[massbonus] type=text value="'.$par['massbonus'].'"><br>';
echo '</td></tr>
		<tr class=nickname bgcolor=#EAEAEA>
			<td align=center width=100%  colspan=4>
				<input type=hidden name=post_id value=1>
				<input class=lbut name=koeffpercent type=submit value="���������">
			</td>
		</tr>
</table></form></td></tr></table>';
?>