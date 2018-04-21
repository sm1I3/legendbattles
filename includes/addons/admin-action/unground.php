<? session_start();
$_SESSION['filter']; ?>
<HTML>
<HEAD>
<LINK href="../../../css/game.css" rel=STYLESHEET type=text/css>
    <META Http-Equiv=Content-Type Content="text/html; charset=UTF-8">
<META Http-Equiv=Cache-Control Content=No-Cache>
<META Http-Equiv=Pragma Content=No-Cache>
<META Http-Equiv=Expires Content=0>
</HEAD>
<BODY bgcolor=#FFFFFF topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0>
<table width="60%" border="0" cellspacing="0" cellpadding="0" align=center>
  <tr>
    <td align=center>
        <input type=button class=lbut onClick="location='adm.php'" value="Вернуться">
        <input type=button class=lbut onClick="location='unground.php'" value="обновить">
	</td>
   </tr>
</table>
<?
require($_SERVER["DOCUMENT_ROOT"] . "/app/system/config.php");
require($_SERVER["DOCUMENT_ROOT"] . "/includes/sql_func.php");
require($_SERVER["DOCUMENT_ROOT"] . "/gameplay/inc/bbcodes.inc.php");

echo '
<form method="post" action="unground.php?add=1">
<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
<tr align=center><td>
<select name=level>
<option value="none" ' . (($_POST['level'] != 'none' and $_POST['level'] != '') ? '' : 'selected=selected') . '>Выберите уровень</option>
';
for($i=0;$i<7;$i++){
    echo '<option value="' . $i . '" ' . (($_POST['level'] == $i) ? 'selected=selected' : '') . '>Уровень ' . $i . '</option>';
}
echo '
</select>
<input class=lbut type=submit value="Выбрать">
</td></tr>
</table>
</form>
';
$err=1;
if($_POST['level']!='none'){
	if($_GET['add']==1){
		$chbot=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `unground_levels`  WHERE `level_id`='".$_POST['level']."' LIMIT 1;"));
		if(!empty($chbot)){
            $chclr = "green";
            $msg = "Уровень не найден в базе!";
			$err=0;
		}
		else{
            $chclr = "red";
            $msg = "Уровень не найден в базе! Заполните нужные поля и нажмите \"сохранить\".";
			$err=0;
			$ich = 100;
			$lch = 100;
			echo '
			<table cellpadding=5 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
				<tr align=center class=freetxt>
					<td><font color='.$chclr.'><b>'.$msg.'</b></font><br></td>
				</tr>
			</table>
			';
		}
		echo'
		<form method="post" action="unground.php?add=1&save=1&update='.($err==0?'yes':'no').'">
		<br><table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
			<tr><td>
			<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
				<tr class=nickname bgcolor=#EAEAEA>
					<td align=center width=30%><b>Уровень подземелья</b></td>
					<td align=center><b>Опыт за прохождение</b></td>
					<td align=center><b>Деньги за прохождение</b></td>
				</tr>';
		echo'
		<tr class=freetxt bgcolor=white>
			<td align=center width=30%>
				Ид: ' . $chbot['level_id'] . '
			</td>
			<td align=center>
				<b>Опыт:</b> <input type=text class=logintextbox6 name="items_chance" value="' . $ich . '" />
			</td>
			<td align=center>
				<b>Деньги:</b> <input type=text class=logintextbox6 name="leather_chance" value="' . $lch . '" />
			</td>
		</tr>
		<tr class=freetxt bgcolor=white>
			<td align=center width=100% colspan=5>
			<input class=lbut type=submit value="Сохранить">
			<input type=hidden name=bot_login value="'.$botdrop['login'].'">
			<input type=hidden name=bot value="'.$_POST['level'].'">
			</td>
		</tr>	
		</table></form></td></tr></table>';	
		$bots=mysqli_query($GLOBALS['db_link'],"SELECT `user`.`id`,`user`.`login` FROM `user` WHERE `user`.`type`='3' AND `user`.`id`<'9999';");
		echo '
		<form method="post" action="bot_drop.php?add=1">
		<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
		<tr align=center><td>
		Добавить ботов на уровень:
		<select name=bot>
		<option value="none" ' . (($_POST['bot'] != 'none' and $_POST['bot'] != '') ? '' : 'selected=selected') . '>Выберите бота</option>
		';
		while($bot = mysqli_fetch_assoc($bots)){
			echo '<option value="'.$bot['id'].'" '.(($_POST['bot']==$bot['id'])?'selected=selected':'').'>'.$bot['login'].'</option>';
		}
		echo '
		</select>
		Количество: <input type=text class=logintextbox7 value="1">
		<input class=lbut type=submit value="Добавить">
		</td></tr>
		</table>
		</form>
		';		
	}
}













?>
