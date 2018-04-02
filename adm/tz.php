<? require('kernel/before.php');?>
<HTML>
<HEAD>
    <META Http-Equiv=Content-Type Content="text/html; charset=utf-8">
<META Http-Equiv=Cache-Control Content=No-Cache>
<META Http-Equiv=Pragma Content=No-Cache>
<META Http-Equiv=Expires Content=0>
</HEAD>
<BODY bgcolor=#FFFFFF topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0>
<table width="60%" border="0" cellspacing="0" cellpadding="0" align=center>
  <tr>
    <td align=center>
        <input type=button class=lbut onClick="location='tz.php?fl=1'" value="скрыть выполенные Тз">
        <input type=button class=lbut onClick="location='tz.php?fl=2'" value="Только срочные Тз">
	</td>
   </tr>
</table>
<? 
require_once($_SERVER["DOCUMENT_ROOT"]."/includes/sql_func.php");
$tztext = varcheck($_POST['tztext']) ?? varcheck($_GET['tztext']) ?? '';
$srok = varcheck($_POST['srok']) ?? varcheck($_GET['srok']) ?? '';
$tzid = varcheck($_POST['tzid']) ?? varcheck($_GET['tzid']) ?? '';
if($_GET['addtz']==1){
    mysqli_query($GLOBALS['db_link'], "INSERT INTO `tzamin` (`text`,`date`,`srok`) VALUES ('" . bbCodes($tztext) . "','" . time() . "','" . $srok . "')");
    echo 'Тз добавлено';
}

if($_GET['addtz']==2){
    mysqli_query($GLOBALS['db_link'], "UPDATE `tzamin` SET `status`='1',`who`='" . $_SESSION['user']['login'] . "' WHERE `id`='" . $tzid . "';");
}

if($_GET['addtz']==3){
    mysqli_query($GLOBALS['db_link'], "UPDATE `tzamin` SET `status`='0',`who`='' WHERE `id`='" . $tzid . "';");
}	
if($_GET['addtz']==4){
    mysqli_query($GLOBALS['db_link'], "DELETE FROM `tzamin` WHERE `id`='" . $tzid . "';");
}
if($_GET['addtz']==5){
    mysqli_query($GLOBALS['db_link'], "UPDATE `tzamin` SET `status`='3',`who`='" . $_SESSION['user']['login'] . "',`startdate`='" . time() . "' WHERE `id`='" . $tzid . "';");
}

$filt="";
$fl = varcheck($_POST['fl']) ?? varcheck($_GET['fl']) ?? '';
if($fl==1){
	$filt="WHERE status='0'";
}
if($fl==2){
	$filt="WHERE srok='1'";
}
$tzsql = mysqli_query($GLOBALS['db_link'], "SELECT * FROM tzamin $filt ORDER BY `srok` DESC, `id` ASC;");
if (mysqli_num_rows($tzsql) > 0) {
echo  '<br>
<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
<tr><td>
<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
		<tr class=nickname bgcolor=#EAEAEA>
			<td align=center width=60%><b>Текст задания</b></td>
			<td align=center><b>Срочность</b></td>
			<td align=center><b>Дата</b></td>
			<td align=center><b>Выполнил</b></td>
			<td align=center><b>Статус</b></td>
			<td align=center><b>Изменить статус</b></td>
		</tr>';
    while ($row = mysqli_fetch_assoc($tzsql)) {
		echo'
		<tr class=nickname bgcolor=white>
			<td>'.$row['text'].'</td>
			<td align=center>' . ($row['srok'] > 0 ? '<font color=red><b>Очень срочно</b></font>' : 'В порядке очереди') . '</td>
			<td align=center>'.date("d.m.Y H:i:s",$row['date']).'</td>
			<td align=center><b>'.(($row['who'])?$row['who']:'---').'</b></td>
			<td align=center><b>
			' . ($row['status'] == 1 ? '<font color=green>Выполнено</font>' : (($row['status'] == 0) ? '<font color=red>Не выполнено</font>' : '<font color=silver>Забронированно<br />' . date('d.m.y H:i:s', $row['startdate']) . '</font>')) . '</b>
			<td align=center>
			'.(	$row['status']==1?
			'
			<form method="post" action="tz.php?addtz=3">
				<input type=submit class=lbut value=" не выполнено ">
				<input type=hidden name=tzid value="'.$row['id'].'">
			</form>'
			:(($row['status']==0)?
			'<form method="post" action="tz.php?addtz=5">
				<input type=submit class=lbut value=" взять ">
				<input type=hidden name=tzid value="'.$row['id'].'">
			</form>':'<form method="post" action="tz.php?addtz=2">
				<input type=submit class=lbut value=" выполнено ">
				<input type=hidden name=tzid value="'.$row['id'].'">
			</form>')).'
			'.($_SESSION['user']['login']=='SANTA'?				'
			<form method="post" action="tz.php?addtz=4">
				<input type=submit class=lbut value=" удалить ">
				<input type=hidden name=tzid value="'.$row['id'].'">
			</form>'
			:'').'	
			</td>
		</tr>';		
	}
echo'</table></td></tr></table><br>';	
}
else{
    echo 'не задано ни одного ТЗ';
}
echo'<form action="tz.php?addtz=1" method=post>

<table border=0 cellpadding=2 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=45%>
		<tr class=nickname bgcolor=white>
			<td align=center colspan=2>
				<textarea cols=100 rows=15 title="Введите текст ТЗ" name="tztext">
				</textarea>
			</td>
		</tr>
		<tr class=nickname bgcolor=white>
			<td align=center width=50%> 
			Срочность: 
				<select name="srok">
					<option value="0" selected>В порядке очереди</option>
					<option value="1" >Очень срочно</option>
				</select>
			</td>
			<td align=center width=50%>
				<input type=submit class=lbut value=" Добавить ТЗ ">
			</td>	
		</tr>		
			

	';
echo'</table></form>';		  
?>

</body>
</html>
<? require('kernel/after.php'); ?>