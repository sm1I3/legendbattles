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
        <input type=button class=lbut onClick="location='adm.php'" value="Вернуться">
        <input type=button class=lbut onClick="location='real_dd_adm.php'" value="обновить">
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
			<td align=center width=100%  colspan=4><b>Цены за продажу статов</b><br><font class=proceb>цена в DLR</font></td>
		</tr>
		<tr class=nickname bgcolor=#EAEAEA>
			<td align=center width=100%  colspan=4>
				Коэфф. увеличения начальный цены [<font class=proce><b>за каждый доп.стат в %</b></font>]: <input class=Logintextbox8 name=kf type=text value="' . $getstats['kf'] . '">
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
        case 1:
            $fr = "Удар [<font class=proce><b>за 1-1</b></font>]:";
            break;
        case 5:
            $fr = "Уловка  [<font class=proce><b>за 1%</b></font>]:";
            break;
        case 6:
            $fr = "Точность  [<font class=proce><b>за 1%</b></font>]:";
            break;
        case 7:
            $fr = "Сокрушение  [<font class=proce><b>за 1%</b></font>]:";
            break;
        case 8:
            $fr = "Стойкость  [<font class=proce><b>за 1%</b></font>]:";
            break;
        case 9:
            $fr = "Класс брони  [<font class=proce><b>за 1кб</b></font>]:";
            break;
        case 10:
            $fr = "Пробой брони  [<font class=proce><b>за 1%</b></font>]:";
            break;
        /*case 11: $fr="Пробой колющим ударом:";break;
        case 12: $fr="Пробой режущим ударом:";break;
        case 13: $fr="Пробой проникающим ударом:";break;
        case 14: $fr="Пробой пробивающим ударом:";break;
        case 15: $fr="Пробой рубящим ударом:";break;
        case 16: $fr="Пробой карающим ударом:";break;
        case 17: $fr="Пробой отсекающим ударом:";break;
        case 18: $fr="Пробой дробящим ударом:";break;
        case 19: $fr="Защита от колющих ударов:";break;
        case 20: $fr="Защита от режущих ударов:";break;
        case 21: $fr="Защита от проникающих ударов:";break;
        case 22: $fr="Защита от пробивающих ударов:";break;
        case 23: $fr="Защита от рубящих ударов:";break;
        case 24: $fr="Защита от карающих ударов:";break;
        case 25: $fr="Защита от отсекающих ударов:";break;
        case 26: $fr="Защита от дробящих ударов:";break;*/
        case 27:
            $fr = "НР [<font class=proce><b>за +1</b></font>]:";
            break;
        case 28:
            $fr = "Очки действия:  [<font class=proce><b>за +1</b></font>]";
            break;
        case 29:
            $fr = "Мана  [<font class=proce><b>за +1</b></font>]:";
            break;
        case 30:
            $fr = "Мощь  [<font class=proce><b>за +1</b></font>]:";
            break;
        case 31:
            $fr = "Проворность  [<font class=proce><b>за +1</b></font>]:";
            break;
        case 32:
            $fr = "Везение  [<font class=proce><b>за +1</b></font>]:";
            break;
        case 33:
            $fr = "Здоровье  [<font class=proce><b>за +1</b></font>]:";
            break;
        case 34:
            $fr = "Разум [<font class=proce><b>за +1</b></font>]:";
            break;
        //case 35: $fr="Сноровка:";break;
        case 36:
            $fr = "Влад. мечами [<font class=proce><b>за +1</b></font>]:";
            break;
        case 37:
            $fr = "Влад. топорами [<font class=proce><b>за +1</b></font>]:";
            break;
        case 38:
            $fr = "Влад. дробящим оружием [<font class=proce><b>за +1</b></font>]:";
            break;
        case 39:
            $fr = "Влад. ножами [<font class=proce><b>за +1</b></font>]:";
            break;
        case 40:
            $fr = "Влад. метательным оружием [<font class=proce><b>за +1</b></font>]:";
            break;
        case 41:
            $fr = "Влад. алебардами и копьями [<font class=proce><b>за +1</b></font>]:";
            break;
        case 42:
            $fr = "Влад. посохами [<font class=proce><b>за +1</b></font>]:";
            break;
        case 43:
            $fr = "Влад. экзотическим оружием [<font class=proce><b>за +1</b></font>]:";
            break;
        case 44:
            $fr = "Влад. двуручным оружием [<font class=proce><b>за +1</b></font>]:";
            break;
        case 45:
            $fr = "Магия огня [<font class=proce><b>за +1</b></font>]:";
            break;
        case 46:
            $fr = "Магия воды [<font class=proce><b>за +1</b></font>]:";
            break;
        case 47:
            $fr = "Магия воздуха [<font class=proce><b>за +1</b></font>]:";
            break;
        case 48:
            $fr = "Магия земли [<font class=proce><b>за +1</b></font>]:";
            break;
        case 49:
            $fr = "Сопротивление магии огня [<font class=proce><b>за +1</b></font>]:";
            break;
        case 50:
            $fr = "Сопротивление магии воды [<font class=proce><b>за +1</b></font>]:";
            break;
        case 51:
            $fr = "Сопротивление магии воздуха [<font class=proce><b>за +1</b></font>]:";
            break;
        case 52:
            $fr = "Сопротивление магии земли [<font class=proce><b>за +1</b></font>]:";
            break;
        case 53:
            $fr = "Воровство [<font class=proce><b>за +1</b></font>]:";
            break;
        case 54:
            $fr = "Осторожность [<font class=proce><b>за +1</b></font>]:";
            break;
        case 55:
            $fr = "Скрытность [<font class=proce><b>за +1</b></font>]:";
            break;
        case 56:
            $fr = "Наблюдательность [<font class=proce><b>за +1</b></font>]:";
            break;
        case 57:
            $fr = "Торговля [<font class=proce><b>за +1</b></font>]:";
            break;
        case 58:
            $fr = "Странник [<font class=proce><b>за +1</b></font>]:";
            break;
        case 59:
            $fr = "Рыболов [<font class=proce><b>за +1</b></font>]:";
            break;
        case 60:
            $fr = "Лесоруб [<font class=proce><b>за +1</b></font>]:";
            break;
        case 61:
            $fr = "Ювелирное дело [<font class=proce><b>за +1</b></font>]:";
            break;
        case 62:
            $fr = "Самолечение [<font class=proce><b>за +1</b></font>]:";
            break;
        case 63:
            $fr = "Оружейник [<font class=proce><b>за +1</b></font>]:";
            break;
        case 64:
            $fr = "Доктор [<font class=proce><b>за +1</b></font>]:";
            break;
        case 65:
            $fr = "Самолечение [<font class=proce><b>за +1</b></font>]:";
            break;
        case 66:
            $fr = "Быстрое восстановление маны [<font class=proce><b>за +1</b></font>]:";
            break;
        case 67:
            $fr = "Лидерство [<font class=proce><b>за +1</b></font>]:";
            break;
        case 68:
            $fr = "Алхимия [<font class=proce><b>за +1</b></font>]:";
            break;
        case 69:
            $fr = "Развитие горного дела [<font class=proce><b>за +1</b></font>]:";
            break;
        case 70:
            $fr = "Травничество [<font class=proce><b>за +1</b></font>]:";
            break;
        case 71:
            $fr = "Коэффициент(new) [<font class=proce><b>за +1</b></font>]:";
            break;
	}
	if($fr!="")echo '<font class=weaponch><b>'.$fr.'</b></font>&nbsp;<input class=Logintextbox8 name=pr['.$i.'] type=text value="'.$par[$i].'"><br>';
}
//опыт и масса
if(!$par['expbonus']){$par['expbonus']=0;}
if(!$par['massbonus']){$par['massbonus']=0;}
echo '<font class=weaponch><b>Бонус опыта (в %) [<font class=proce><b>за 1%</b></font>]:</b></font>&nbsp;<input class=Logintextbox8 name=pr[expbonus] type=text value="' . $par['expbonus'] . '"><br>';
echo '<font class=weaponch><b>Бонус массы [<font class=proce><b>за +1</b></font>]:</b></font>&nbsp;<input class=Logintextbox8 name=pr[massbonus] type=text value="' . $par['massbonus'] . '"><br>';
echo '</td></tr>
		<tr class=nickname bgcolor=#EAEAEA>
			<td align=center width=100%  colspan=4>
				<input type=hidden name=post_id value=1>
				<input class=lbut name=koeffpercent type=submit value="Сохранить">
			</td>
		</tr>
</table></form></td></tr></table>';
?>