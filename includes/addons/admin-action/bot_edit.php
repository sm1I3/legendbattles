<?
session_start();
$_SESSION['filter'];
require_once($_SERVER["DOCUMENT_ROOT"] . "/app/system/config.php");
//=================== FUNC
function botslot($id,$s)
{
    $sl_free = array(1 => 'sl_l_0.gif:Слот для шлема', 'sl_l_1.gif:Слот для ожерелья', 'sl_l_2.gif:Слот для оружия', 'sl_l_3.gif:Слот для пояса', 'sl_l_4.gif:Слот для содержимого пояса', 'sl_l_4.gif:Слот для содержимого пояса', 'sl_l_4.gif:Слот для содержимого пояса', 'sl_l_6.gif:Слот для сапог', 'sl_l_7.gif:Слот для поножей', 'sl_r_4.gif:Слот для наплечников', 'sl_r_2.gif:Слот для наручей', 'sl_r_3.gif:Слот для перчаток', 'sl_l_2.gif:Слот для оружия/щита', 'sl_r_5.gif:Слот для кольца', 'sl_r_5.gif:Слот для кольца', 'sl_r_6.gif:Слот для брони', 'sl_r_6.gif:Слот для брони');
for($i=1; $i<=15; $i++){
$idd.=$sl_id[$i].'@';
$pr .= $sl_pr[$i].'@';
$item .= $sl_free[$i].'@';
$vcod.=$v_c[$i].'@';}

    if ($sl_free[16] != 'sl_r_6.gif:Слот для брони') {
        $pr .= $sl_pr[16];
        $item .= $sl_free[16];
        $idd .= $sl_id[16];
        $vcod .= scode();
    } elseif ($sl_free[17] != 'sl_r_6.gif:Слот для брони') {
        $pr .= $sl_pr[17];
        $item .= $sl_free[17];
        $idd .= $sl_id[17];
        $vcod .= scode();
    } else {
        $item .= $sl_free[17];
    }

if($s==1){$invs=",\"$idd\",\"$vcod\"";}
return "$item\"$invs,\"$pr";
//return substr_replace($ret, '', -1);
}
//END
$bots=mysqli_query($GLOBALS['db_link'],"
	SELECT * FROM `bot_sh`;
");
echo'
<HTML>
<HEAD>
<LINK href="../../../css/game.css?v2" rel=STYLESHEET type=text/css>
<SCRIPT src="../../../js/slots.js"></SCRIPT>
<META Http-Equiv=Content-Type Content="text/html; charset=utf-8">
<META Http-Equiv=Cache-Control Content=No-Cache>
<META Http-Equiv=Pragma Content=No-Cache>
<META Http-Equiv=Expires Content=0>
</HEAD>
<BODY bgcolor=#FFFFFF topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0>
<table width="60%" border="0" cellspacing="0" cellpadding="0" align=center>
  <tr>
    <td align=center>
		<input type=button class=lbut onClick="location=\'adm.php\'" value="Вернуться">
		<input type=button class=lbut onClick="location=\'bot_edit.php\'" value="обновить">
	</td>
   </tr>
</table>
';
echo '
<form method="post" action="bot_edit.php?add=1">
<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
<tr align=center><td>
<select name=bot>
<option value="none" ' . (($_POST['bot'] != 'none' and $_POST['bot'] != '') ? '' : 'selected=selected') . '>Выберите бота</option>
';
while($bot = mysqli_fetch_array($bots)){
	echo '<option name="" value="'.$bot['id'].'" '.(($_POST['bot']==$bot['id'])?'selected=selected':'').'>'.$bot['login'].'</option>';
}
echo '
</select>
<input class=lbut type=submit value="Выбрать">
</td></tr>
</table>
</form>
';
//бот выбран
if($_GET['add'] and $_POST['bot']!='none'){
$_POST['bot'] = intval($_POST['bot']);
switch(intval($_POST['post_id'])){
	case 1:
        $keyarr = array("sila", "lovk", "uda4a", "znan", "zdorov", "mudr", "hp", "mp", "kb", "uvorot", "tochn", "sokr", "stoik", "kb_ignore", "koeff"); //параметры которые добавляем
		$query='';
		foreach($_POST as $key=>$val){
			if(in_array($key,$keyarr)){
				($query==''?$query .= "`$key`='$val'":$query .= ",`$key`='$val'");				
			}
		}	
		echo $query;		
	break;
}
$bot=mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"
	SELECT * FROM `bot_sh` WHERE `id`='".$_POST['bot']."' LIMIT 1;
"));
$immunes = explode("|",$bot['immunes']);
foreach($immunes as $key=>$val){
	switch($key){
        case 0: //огонь
			switch($val){
				case 0: $fire[$val]=" selected=selected";break;
				case 1: $fire[$val]=" selected=selected";break;
			}
		break;
        case 1: //лед
			switch($val){
				case 0: $ice[$val]=" selected=selected";break;
				case 1: $ice[$val]=" selected=selected";break;
			}
		break;
        case 2://вампир
			switch($val){
				case 0: $vamp[$val]=" selected=selected";break;
				case 1: $vamp[$val]=" selected=selected";break;
			}		
		break;
        case 3: //яд
			switch($val){
				case 0: $poison[$val]=" selected=selected";break;
				case 1: $poison[$val]=" selected=selected";break;
			}	
		break;
        case 4: //физ. урон
			switch($val){
				case 0: $phys[$val]=" selected=selected";break;
				case 1: $phys[$val]=" selected=selected";break;
			}			
		break; 
	}
}
 echo '
<table cellpadding=0 cellspacing=3 border=1>
<tr>
	<SCRIPT language="JavaScript">
		slots_pla("mozg.gif","'.$bot['login'].'","'.botslot($bot['id'],2).'",115);
	</SCRIPT>
<td width=5 valign=top rowspan=2><img src=http://img.legendbattles.ru/image/1x1.gif width=5 height=1></td>
<td valign=top rowspan=2 align=left>
<table cellpadding=0 cellspacing=0 border=0 width=100%>
	<tr><td>
	<font class=proce>
	<form method="post" action="bot_edit.php?add=1">
			<table cellpadding=0 cellspacing=1 border=0 width=100% align=center>
			<tr><td class=nickname colspan=2 align=center><b>Статы<br /><font class=proceb style="font-size: 8;">(минус нельзя)</font></b></td>
			<tr><td colspan=5><div class="underline"></div></td></tr>
			<tr><td class=nickname>&nbsp;Мощь:</td><td><b><input type=text name="sila" value="' . $bot['sila'] . '" class="logintextbox7"></b></td>
			<tr><td colspan=5><div class="underline"></div></td></tr>
			<tr><td class=nickname>&nbsp;Проворность:</td><td><b><input type=text name="lovk" value="' . $bot['lovk'] . '" class="logintextbox7"></b></td>
			<tr><td colspan=5><div class="underline"></div></td></tr>
			<tr><td class=nickname>&nbsp;Везение:</td><td><b><input type=text name="uda4a" value="' . $bot['uda4a'] . '" class="logintextbox7"></b></td>
			<tr><td colspan=5><div class="underline"></div></td></tr>
			<tr><td class=nickname>&nbsp;Разум:</td><td><b><input type=text name="znan" value="' . $bot['znan'] . '" class="logintextbox7"></b></td>
			<tr><td colspan=5><div class="underline"></div></td></tr>
			<tr><td class=nickname>&nbsp;Здоровье:</td><td><b><input type=text name="zdorov" value="' . $bot['zdorov'] . '" class="logintextbox7"></b></td>
			<tr><td colspan=5><div class="underline"></div></td></tr>
			<tr><td class=nickname>&nbsp;Сноровка:</td><td><b><input type=text name="mudr" value="' . $bot['mudr'] . '" class="logintextbox7"></b></td>
			<tr><td colspan=5><div class="underline"></div></td></tr>
			<tr><td class=nickname>&nbsp;Жизнь:</td><td><b><input type=text name="hp" value="' . $bot['hp'] . '" class="logintextbox7"></b></td>
			<tr><td colspan=5><div class="underline"></div></td></tr>
			<tr><td class=nickname>&nbsp;Мана:</td><td><b><input type=text name="mp" value="' . $bot['mp'] . '" class="logintextbox7"></b></td>
			<tr><td colspan=5><div class="underline"></div></td></tr>
			<tr><td class=nickname>&nbsp;Броня:</td><td><b><input type=text name="kb" value="' . $bot['kb'] . '" class="logintextbox7"></b></td>
			<tr><td colspan=5><div class="underline"></div></td></tr>
			<tr><td class=nickname>&nbsp;Уворот:</td><td><b><input type=text name="uvorot" value="' . $bot['uvorot'] . '" class="logintextbox7"></b></td>
			<tr><td colspan=5><div class="underline"></div></td></tr>
			<tr><td class=nickname>&nbsp;Точность:</td><td><b><input type=text name="tochn" value="' . $bot['tochn'] . '" class="logintextbox7"></b></td>
			<tr><td colspan=5><div class="underline"></div></td></tr>
			<tr><td class=nickname>&nbsp;Сокрушение:</td><td><b><input type=text name="sokr" value="' . $bot['sokr'] . '" class="logintextbox7"></b></td>
			<tr><td colspan=5><div class="underline"></div></td></tr>
			<tr><td class=nickname>&nbsp;Стойкость:</td><td><b><input type=text name="stoik" value="' . $bot['stoik'] . '" class="logintextbox7"></b></td>
			<tr><td colspan=5><div class="underline"></div></td></tr>
			<tr><td class=nickname>&nbsp;Пробой брони:</td><td><b><input type=text name="kb_ignore" value="' . $bot['kb_ignore'] . '" class="logintextbox7"></b></td>
			<tr><td colspan=5><div class="underline"></div></td></tr>
			<tr><td class=nickname>&nbsp;Коэффициент:</td><td><b><input type=text name="koeff" value="' . $bot['koeff'] . '" class="logintextbox7"></b></td>
			<tr><td colspan=5><div class="underline"></div></td></tr>
			<tr><td colspan=5 align=center><input type=submit value="Сохранить" class="lbut"></td></tr>
			</table>
		<input type=hidden name="bot" value="'.$bot['id'].'" class="logintextbox7">
		<input type=hidden name="post_id" value="1" class="logintextbox7">
	</form>
	</td></tr>
</table>
</td>
<td valign=top rowspan=2 align=left>
<table cellpadding=0 cellspacing=0 border=0 width=100%>
	<tr><td>
	<font class=proce>
	<form method="post" action="bot_edit.php?add=1">
			<table cellpadding=0 cellspacing=1 border=0 width=100% align=center>
			<tr><td class=nickname colspan=2 align=center><b>Урон<br /><font class=proceb style="font-size: 8;">(пример: 1-5)</font></b></td>
			<tr><td colspan=5><div class="underline"></div></td></tr>
			<tr><td class=nickname>&nbsp;Обычный:</td><td><b><input type=text name="zdorov" value="' . $bot['damage'] . '" class="logintextbox8"></b></td>
			<tr><td colspan=5><div class="underline"></div></td></tr>
			<tr><td class=nickname>&nbsp;Огнем:</td><td><b><input type=text name="sila" value="' . $bot['fire_dmg'] . '" class="logintextbox8"></b></td>
			<tr><td colspan=5><div class="underline"></div></td></tr>
			<tr><td class=nickname>&nbsp;Льдом:</td><td><b><input type=text name="lovk" value="' . $bot['ice_dmg'] . '" class="logintextbox8"></b></td>
			<tr><td colspan=5><div class="underline"></div></td></tr>
			<tr><td class=nickname>&nbsp;Ядом:</td><td><b><input type=text name="uda4a" value="' . $bot['poison_dmg'] . '" class="logintextbox8"></b></td>
			<tr><td colspan=5><div class="underline"></div></td></tr>
			<tr><td class=nickname>&nbsp;Вампиризм:</td><td><b><input type=text name="znan" value="' . $bot['vamp_dmg'] . '" class="logintextbox8"></b></td>
			<tr><td colspan=5><div class="underline"></div></td></tr>
			<tr><td class=nickname colspan=2 align=center><b>Иммунки</b></td>
			<tr><td colspan=5><div class="underline"></div></td></tr>
			<tr><td class=nickname>&nbsp;Огонь</td><td><b>
				<select name="fire_immune">
					<option value="0"' . $fire[0] . '>Нет</option>
					<option value="1"' . $fire[1] . '>Да</option>
				</select>
			</b></td>
			<tr><td colspan=5><div class="underline"></div></td></tr>
			<tr><td class=nickname>&nbsp;Лед:</td><td><b>
			  <select name="ice_immune">
				  <option value="0"' . $ice[0] . '>Нет</option>
				  <option value="1"' . $ice[1] . '>Да</option>
			  </select>
			</b></td>
			<tr><td colspan=5><div class="underline"></div></td></tr>
			<tr><td class=nickname>&nbsp;Вампиризм:</td><td><b>
			  <select name="vamp_immune">
				  <option value="0"' . $vamp[0] . '>Нет</option>
				  <option value="1"' . $vamp[1] . '>Да</option>
			  </select>
			</b></td>
			<tr><td colspan=5><div class="underline"></div></td></tr>
			<tr><td class=nickname>&nbsp;Яд:</td><td><b>
			  <select name="poison_immune">
				  <option value="0"' . $poison[0] . '>Нет</option>
				  <option value="1"' . $poison[1] . '>Да</option>
			  </select>
			</b></td>
			<tr><td colspan=5><div class="underline"></div></td></tr>
			<tr><td class=nickname>&nbsp;Физ.урон:</td><td><b>
			  <select name="phys_immune">
				  <option value="0"' . $phys[0] . '>Нет</option>
				  <option value="1"' . $phys[1] . '>Да</option>
			  </select>
			</b></td>
			<tr><td colspan=5><div class="underline"></div></td></tr>
			<tr><td colspan=5 align=center><input type=submit value="Сохранить" class="lbut"></td></tr>
			</table>
		<input type=hidden name="bot" value="'.$bot['id'].'" class="logintextbox7">
		<input type=hidden name="post_id" value="1" class="logintextbox7">
	</form>
	</td></tr>
</table>
</td>
 ';

 
 echo'<td style="width:100%" valign=top rowspan=2 >test</td>	';
}
