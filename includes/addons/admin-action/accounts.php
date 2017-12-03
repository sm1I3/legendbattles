<? session_start();session_register('filter');?>
<HTML>
<HEAD>
<LINK href="../../../css/game.css" rel=STYLESHEET type=text/css>
<META Http-Equiv=Content-Type Content="text/html; charset=windows-1251">
<META Http-Equiv=Cache-Control Content=No-Cache>
<META Http-Equiv=Pragma Content=No-Cache>
<META Http-Equiv=Expires Content=0>
</HEAD>
<BODY bgcolor=#FFFFFF topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0>
<table width="60%" border="0" cellspacing="0" cellpadding="0" align=center>
  <tr>
    <td align=center>
        <input type=button class=lbut onClick="location='adm.php'" value="Вернуться">
        <input type=button class=lbut onClick="location='accounts.php'" value="обновить">
	</td>
   </tr>
</table>
<? 
require_once($_SERVER["DOCUMENT_ROOT"]."/includes/config.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/includes/sql_func.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/bbcodes.inc.php");
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
$accsql=mysqli_query($GLOBALS['db_link'],"SELECT `premium_info`.`id` FROM `premium_info`;");
echo '
<form method="post" action="accounts.php?add=1">
<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
<tr align=center><td>
<select name=acc>
<option value="none" ' . (($_POST['acc'] != 'none' and $_POST['acc'] != '') ? '' : 'selected=selected') . '>Выберите аккаунт</option>
';
while($acc = mysqli_fetch_assoc($accsql)){
	switch($acc['id']){
        case 1:
            $name = "Базовый";
            break;
		 case 2: $name="Premium";break;
		 case 3: $name="Gold";break;
		 case 4: $name="VIP";break;
		 case 5: $name="Platinum";break;
	}
	echo '<option value="'.$acc['id'].'" '.(($_POST['acc']==$acc['id'])?'selected=selected':'').'>'.$name.'</option>';
}
echo '
</select>
<input class=lbut type=submit value="Выбрать">
</td></tr>
</table>
</form>
';
if($_GET['save']==1 and $_POST['acc']!='none'){
	$savesql='';
	foreach($_POST as $key=>$val){
		if($key=='acc'){
			$where="`id`='".intval($val)."'";
		}
		else{
			$what.="`".$key."`='".intval($val)."',";
		}
	}
	$what=substr($what,0,strlen($what)-1);
	if(mysqli_query($GLOBALS['db_link'],"UPDATE `premium_info` SET ".$what." WHERE ".$where."  LIMIT 1;")){
        $msg = '<b><font class=nickname style="color:green">Аккаунт успешно сохранен.</font></b>';
	}
	else{
        $msg = '<b><font class=nickname style="color:red">Ошибка при сохранении аккаунта!</font></b>';
	}
}
if($_POST['acc']!='none' and $_GET['add']==1){
$val_acc=varcheck($_POST['acc']);
	$account=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `premium_info`  WHERE `id`='".$val_acc."' LIMIT 1;"));
	switch($_POST['acc']){
        case 1:
            $name = "Базовый";
            break;
		 case 2: $name="Premium";break;
		 case 3: $name="Gold";break;
		 case 4: $name="VIP";break;
		 case 5: $name="Platinum";break;
	}
	switch($account['exit']){
		case 0: $w[0]="selected=selected";break;
		case 1: $w[1]="selected=selected";break;
		case 2: $w[2]="selected=selected";break;
	}
	switch($account['seif']){
		case 0: $s[0]="selected=selected";break;
		case 1: $s[1]="selected=selected";break;
	}
	switch($account['auto']){
		case 0: $a[0]="selected=selected";break;
		case 1: $a[1]="selected=selected";break;
	}
	switch($account['smiles']){
		case 0: $b[0]="selected=selected";break;
		case 1: $b[1]="selected=selected";break;
	}
		echo'
		<form method="post" action="accounts.php?add=1&save=1">
		<br><table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
			<tr><td>
			<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
				<tr class=nickname bgcolor=#EAEAEA>
					<td align=center width=30%><b>Аккаунт</b></td>
					<td align=center><b>Масса рюкзака<br>Выход из города<br>Сейф в банке</b></td>
					<td align=center><b>Опыт</b><br><font class=freetxt> обычный, пвп, склонности </font></td>
					<td align=center><b>Цена (dlr)</b><br><font class=freetxt> 10,30,60,90 дней </font></td>
		
				</tr>';

		echo'
		<tr class=freetxt bgcolor=white>
			<td align=center width=30%>
				<font class=weaponchart><b>'.$name.'</b></font><br><br>
				<b>Автобой:</b><br><select name="auto"><option value="0" ' . $a[0] . '>Нет</option><option value="1" ' . $a[1] . '>Да</option></select><br>
				<b>Смайлы:</b><br><select name="smiles"><option value="0" ' . $b[0] . '>Нет</option><option value="1" ' . $b[1] . '>Да</option></select>
				'.($msg?'<br>'.$msg:'').'
			</td>
			<td align=center>
				<b>Расширенный дроп (+\- уровень):</b><br><input type=text class=logintextbox6 name="drop" value="' . $account['drop'] . '" /><br>
				<b>Масса:</b><br><input type=text class=logintextbox6 name="mass" value="' . $account['mass'] . '" /><br>
				<b>Выход из города:</b><br><select name="exit"><option value="0" ' . $w[0] . '>Нет</option><option value="1" ' . $w[1] . '>Выход</option><option value="2" ' . $w[2] . '>Вход/Выход</option></select><br>
				<b>Сейф в банке:</b><br><select name="seif"><option value="0" ' . $s[0] . '>Нет</option><option value="1" ' . $s[1] . '>Да</option></select>
				
			</td>
			<td align=center>
				<b>Опыт:</b><br><input type=text class=logintextbox6 name="exp" value="' . $account['exp'] . '" /><br>
				<b>Опыт(пвп):</b><br><input type=text class=logintextbox6 name="exp_pvp" value="' . $account['exp_pvp'] . '" /><br>
				<b>Опыт(склонности):</b><br><input type=text class=logintextbox6 name="exp_sklon" value="' . $account['exp_sklon'] . '" /><br>
				<b>Ограничение:</b><br><input type=text class=logintextbox6 name="exp_max" value="' . $account['exp_max'] . '" />
			</td>
			<td align=center>
				<b>10 дней:</b><br><input type=text class=logintextbox6 name="price_10" value="' . $account['price_10'] . '" /><br>
				<b>30 дней:</b><br><input type=text class=logintextbox6 name="price_30" value="' . $account['price_30'] . '" /><br>
				<b>60 дней:</b><br><input type=text class=logintextbox6 name="price_60" value="' . $account['price_60'] . '" /><br>
				<b>90 дней:</b><br><input type=text class=logintextbox6 name="price_90" value="' . $account['price_90'] . '" />
			</td>
		</tr>
		<tr class=freetxt bgcolor=white>
			<td align=center width=100% colspan=8>
			<input class=lbut type=submit value="Сохранить">
			<input type=hidden name=acc value="'.$_POST['acc'].'">
			</td>
		</tr>	
		</table></form></td></tr></table>';	
}

























?>































