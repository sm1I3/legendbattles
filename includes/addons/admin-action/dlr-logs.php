<? session_start();
$_SESSION['filter'];
echo'
<HTML>
<HEAD>
<LINK href="../../../css/game.css?v2" rel=STYLESHEET type=text/css>
<SCRIPT src="../../../js/slots.js"></SCRIPT>
<META Http-Equiv=Content-Type Content="text/html; charset=UTF-8">
<META Http-Equiv=Cache-Control Content=No-Cache>
<META Http-Equiv=Pragma Content=No-Cache>
<META Http-Equiv=Expires Content=0>
</HEAD>
<BODY bgcolor=#FFFFFF topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0>
<table width="60%" border="0" cellspacing="0" cellpadding="0" align=center>
  <tr>
    <td align=center>
		<input type=button class=lbut onClick="location=\'adm.php\'" value="Вернуться">
		<input type=button class=lbut onClick="location=\'dlr-logs.php\'" value="обновить">
	</td>
   </tr>
   <tr>
    <td align=center>
		<form method=post>
			Введите ник: <input type=text class=logintextbox6 name=perslogin> <input type=submit class=lbut value="Ok">
		</form>
	</td>
   </tr>
</table>
';
require($_SERVER["DOCUMENT_ROOT"] . "/app/system/config.php");
require($_SERVER["DOCUMENT_ROOT"] . "/includes/sql_func.php");
require($_SERVER["DOCUMENT_ROOT"] . "/gameplay/inc/bbcodes.inc.php");

$player=player();

if($_POST['perslogin']){
	$zapros = mysqli_query($GLOBALS['db_link'],"SELECT * FROM mlog WHERE (`login`='".$_POST['perslogin']."' or `tologin`='".$_POST['perslogin']."');");
			echo'<table width="60%" border="0" cellspacing="0" cellpadding="0" align=center>
		  <tr>
			<td align=center><b>тип действия</b></td>
			<td align=center><b>время</b></td>
			<td align=center><b>ип</b></td>
			<td align=center><b>что и куда изменилось</b></td>
			<td align=center><b>сумма</b></td>
			<td align=center><b>от кого</b></td>
			<td align=center><b>кому</b></td>	
		   </tr>';
	while($row = mysqli_fetch_assoc($zapros)){
		if($row['action']=='DLR-change' or $row['action']=='BKS-change'){
			$ep=1;
		}else{$ep=0;}
		echo'
		 <tr '.($ep==1?' style="background: gray;"':'').'>
			<td align=center >'.($ep==1?'<b>':'').''.$row['action'].'</b></td>
			<td align=center>'.$row['time'].'</td>
			<td align=center>'.$row['ip'].'</td>
			<td align=center>'.$row['id_item'].'</td>
			<td align=center>'.$row['sum'].'</td>
			<td align=center>'.$row['login'].'</td>
			<td align=center>'.$row['tologin'].'</td>				
		   </tr>';

	}
			echo '</table><br><br><br>';
}




?>