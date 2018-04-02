<? session_start();
$_SESSION['filter']; ?>
<HTML>
<HEAD>
<LINK href="../../../css/game.css" rel=STYLESHEET type=text/css>
    <META Http-Equiv=Content-Type Content="text/html; charset=utf-8">
<META Http-Equiv=Cache-Control Content=No-Cache>
<META Http-Equiv=Pragma Content=No-Cache>
<META Http-Equiv=Expires Content=0>
</HEAD>
<BODY bgcolor=#FFFFFF topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0>
<table width="60%" border="0" cellspacing="0" cellpadding="0" align=center>
  <tr>
    <td align=center>
        <input type=button class=lbut onClick="location='adm.php'" value="Вернуться">
        <input type=button class=lbut onClick="location='errors.php'" value="обновить">
        <input type=button class=lbut onClick="location='errors.php?fl=1'" value="скрыть исправленные ошибки">
	</td>
   </tr>
</table>
<? 
require_once($_SERVER["DOCUMENT_ROOT"]."/includes/func/connect.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/includes/func/sql_func.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/inc/bbcodes.inc.php");
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
db_open();

if($_GET['addtz']==1){
	mysqli_query($GLOBALS['db_link'],"INSERT INTO `bug_reports` (`text`,`date`,`srok`) VALUES ('".bbCodes($tztext)."','".time()."','".$srok."')");
    echo 'Тз добавлено';
}

if($_GET['addtz']==2){
	mysqli_query($GLOBALS['db_link'],"UPDATE `bug_reports` SET `status`='1',`who`='".$_SESSION['user']['login']."' WHERE `id`='".$tzid."';");
}

if($_GET['addtz']==3){
	mysqli_query($GLOBALS['db_link'],"UPDATE `bug_reports` SET `status`='0',`who`='' WHERE `id`='".$tzid."';");
}	
if($_GET['addtz']==4){
	mysqli_query($GLOBALS['db_link'],"DELETE FROM `bug_reports` WHERE `id`='".$tzid."';");
}
if($_GET['addtz']==5){
	mysqli_query($GLOBALS['db_link'],"UPDATE `bug_reports` SET `status`='3',`who`='".$_SESSION['user']['login']."',`startdate`='".time()."' WHERE `id`='".$tzid."';");
}

$filt="";
if($fl==1){
	$filt="WHERE status='0' OR `status`='3'";
}
if($fl==2){
	$filt="WHERE srok='1'";
}
$tzsql=mysqli_query($GLOBALS['db_link'],"SELECT * FROM `bug_reports` $filt ORDER BY `id` ASC;");
$tzsqlcount=mysqli_num_rows($tzsql);
$readycount=0;
if(mysqli_num_rows($tzsql)>0){
echo  '<br>
<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
<tr><td>
<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
		<tr class=nickname bgcolor=#EAEAEA>
			<td align=center width=60%><b>Текст задания</b></td>
			<td align=center><b>Тип ошибки</b></td>
			<td align=center><b>Дата</b></td>
			<td align=center><b>Сообщил</b></td>
			<td align=center><b>Выполнил</b></td>
			<td align=center><b>Статус</b></td>
			<td align=center><b>Изменить статус</b></td>
		</tr>';
	while($row = mysqli_fetch_assoc($tzsql)){
		if($row['status']==1){
			$readycount++;
		}
		$count[$row['from']]+=1;
		switch($row['srok']){
            case 0:
                $srok = 'Вещи и их параметры';
                break;
            case 1:
                $srok = 'Умения,навыки,статы';
                break;
            case 2:
                $srok = 'Локации';
                break;
            case 3:
                $srok = 'Профессии';
                break;
            case 4:
                $srok = 'Другое';
                break;
            default:
                $srok = 'Не определено';
                break;
		}
		echo'
		<tr class=nickname bgcolor=white>
			<td>'.$row['text'].'</td>
			<td align=center>'.$srok.'</td>
			<td align=center>'.date("d.m.Y H:i:s",$row['date']).'</td>
			<td align=center><b>'.(($row['from'])?$row['from']:'---').'</b></td>
			<td align=center><b>'.(($row['who'])?$row['who']:'---').'</b></td>
			<td align=center><b>
			' . ($row['status'] == 1 ? '<font color=green>Выполнено</font>' : (($row['status'] == 0) ? '<font color=red>Не выполнено</font>' : '<font color=silver>Забронированно<br />' . date('d.m.y H:i:s', $row['startdate']) . '</font>')) . '</b>
			<td align=center>
			'.(	$row['status']==1?
			'
			<form method="post" action="errors.php?addtz=3'.($fl?'&fl='.$fl:'').'">
				<input type=submit class=lbut value=" не выполнено ">
				<input type=hidden name=tzid value="'.$row['id'].'">
			</form>'
			:(($row['status']==0)?
			'<form method="post" action="errors.php?addtz=5'.($fl?'&fl='.$fl:'').'">
				<input type=submit class=lbut value=" взять ">
				<input type=hidden name=tzid value="'.$row['id'].'">
			</form>':'<form method="post" action="errors.php?addtz=2'.($fl?'&fl='.$fl:'').'">
				<input type=submit class=lbut value=" выполнено ">
				<input type=hidden name=tzid value="'.$row['id'].'">
			</form>')).'
			<form method="post" action="errors.php?addtz=4'.($fl?'&fl='.$fl:'').'">
				<input type=submit class=lbut value=" удалить ">
				<input type=hidden name=tzid value="'.$row['id'].'">
			</form>
			</td>
		</tr>';		
	}
echo'</table></td></tr></table><br>';
if(!$fl){
	echo'
	<br>
	<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
	<tr><td>
	<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
			<tr class=nickname bgcolor=#EAEAEA>
				<td align=center width=60%><b>Всего сообщений</b></td>
				<td align=center><b>Исправлено</b></td>
			</tr>';
			echo'
			<tr class=nickname bgcolor=white>
				<td align=center><b>'.$tzsqlcount.'</b></td>
				<td align=center><b>'.$readycount.'</b></td>
			</tr></table></td></tr></table>';	
	echo'
	<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
	<tr><td>
	<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
			<tr class=nickname bgcolor=#EAEAEA>
				<td align=center width=60%><b>Ник</b></td>
				<td align=center><b>Количество</b></td>
			</tr>';
	foreach($count as $key=>$val){
			echo'
			<tr class=nickname bgcolor=white>
				<td><b>'.$key.'</b></td>
				<td align=center><b>'.$val.'</b></td>
			</tr>';	
	}	
}
}
else{
	echo '<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
<tr><td align=center>не найдено ни одной ошибки</td></tr>';
}	  
?>

</body>
</html>
