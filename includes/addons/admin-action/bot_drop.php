<?php
session_start();
//$_POST['bot']=varcheck($_POST['bot']); // Илья не знаю причину, но выдавало белый экран
?>
<HTML>
<HEAD>
<LINK href="../../../css/game.css" rel=STYLESHEET type=text/css>
<META Http-Equiv=Content-Type Content="text/html; charset=windows-1251">
<META Http-Equiv=Cache-Control Content=No-Cache>
<META Http-Equiv=Pragma Content=No-Cache>
<META Http-Equiv=Expires Content=0>
<script type="text/javascript" src="../../../js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="../../../js/ui.min.js"></script>
</HEAD>
<BODY bgcolor=#FFFFFF topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0>
<script>
$(document).ready(function(){
	$("tr.itemstr").hide(1);
	$("tr.bottletr").hide(1);
	$("tr.leathertr").hide(1);
	$("tr.paramsitr").hide(1);
	$("tr.paramstr").hide(1);
});
showHide = function(e,ev,a){
	switch(ev){
		case 'Показать': $("tr."+a).show(250); $(e).val('Скрыть');break;
		case 'Скрыть':  $("tr."+a).hide(250); $(e).val('Показать');break;
	}
}
</script>
<table width="60%" border="0" cellspacing="0" cellpadding="0" align=center>
  <tr>
    <td align=center>
		<input type=button class=lbut onClick="location='adm.php'" value="Вернуться">
		<input type=button class=lbut onClick="location='bot_drop.php'" value="обновить">
	</td>
   </tr>
</table>
<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/includes/config.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/includes/sql_func.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/bbcodes.inc.php");
function ShowParBot($i,$par,$type){
			$fr="";	
			$str="";			
			switch($i){
				case 1: $fr="Удар (пример 20-30):";break;
				//case 2: $fr="Долговечность:";break;
				//case 3: $fr="Карманов(3 max для поясов):";break;
				//case 4: $fr="Материал:";break;
				case 5: $fr="Уловка:";break;
				case 6: $fr="Точность:";break;
				case 7: $fr="Сокрушение:";break;
				case 8: $fr="Стойкость:";break;
				case 9: $fr="Класс брони:";break;
				case 10: $fr="Пробой брони:";break;
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
				case 27: $fr="НР:";break;
				case 28: $fr="Очки действия:";break;
				case 29: $fr="Мана:";break;
				case 30: $fr="Мощь:";break;
				case 31: $fr="Проворность:";break;
				case 32: $fr="Везение:";break;
				case 33: $fr="Здоровье:";break;
				case 34: $fr="Разум:";break;
				case 35: $fr="Сноровка:";break;
				case 36: $fr="Влад. мечами:";break;
				case 37: $fr="Влад. топорами:";break;
				case 38: $fr="Влад. дробящим оружием:";break;
				case 39: $fr="Влад. ножами:";break;
				case 40: $fr="Влад. метательным оружием:";break;
				case 41: $fr="Влад. алебардами и копьями:";break;
				case 42: $fr="Влад. посохами:";break;
				case 43: $fr="Влад. экзотическим оружием:";break;
				case 44: $fr="Влад. двуручным оружием:";break;
				case 45: $fr="Магия огня:";break;
				case 46: $fr="Магия воды:";break;
				case 47: $fr="Магия воздуха:";break;
				case 48: $fr="Магия земли:";break;
				case 49: $fr="Сопротивление магии огня:";break;
				case 50: $fr="Сопротивление магии воды:";break;
				case 51: $fr="Сопротивление магии воздуха:";break;
				case 52: $fr="Сопротивление магии земли:";break;
				/*case 53: $fr="Воровство:";break;
				case 54: $fr="Осторожность:";break;
				case 55: $fr="Скрытность:";break;
				case 56: $fr="Наблюдательность:";break;
				case 57: $fr="Торговля:";break;
				case 58: $fr="Странник:";break;
				case 59: $fr="Рыболов:";break;
				case 60: $fr="Лесоруб:";break;
				case 61: $fr="Ювелирное дело:";break;
				case 62: $fr="Самолечение:";break;
				case 63: $fr="Оружейник:";break;
				case 64: $fr="Доктор:";break;
				case 65: $fr="Самолечение:";break;
				case 66: $fr="Быстрое восстановление маны:";break;
				case 67: $fr="Лидерство:";break;
				case 68: $fr="Алхимия:";break;
				case 69: $fr="Развитие горного дела:";break;
				case 70: $fr="Травничество:";break;*/
				case 71: $fr="Коэффициент(new):";break;
				/*case 'expbonus': $fr="Бонус опыта (в %):";break;
				case 'massbonus': $fr="Бонус массы:";break;*/
			}
			if($type==1 and $fr){
				$str = '<font class=weaponch><b>'.$fr.'</b></font>&nbsp;<input type=text name=pr['.$i.'] value="'.$par.'">';
			}elseif($par and $i){
				$str = '<font class=weaponch><b>'.$fr.'</b></font>&nbsp;'.$par.'<br>';
			}	
			return $str;
		}
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
$player=player();
$bots=mysqli_query($GLOBALS['db_link'],"SELECT `user`.`id`,`user`.`login` FROM `user` WHERE `user`.`type`='3' AND `user`.`id`<'9999';");
echo '
<form method="post" action="bot_drop.php?add=1">
<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
<tr align=center><td>
<select name=bot>
<option value="none" '.(($_POST['bot']!='none' and $_POST['bot']!='')?'':'selected=selected').'>Выберите бота</option>
';
while($bot = mysqli_fetch_assoc($bots)){
	echo '<option value="'.$bot['id'].'" '.(($_POST['bot']==$bot['id'])?'selected=selected':'').'>'.$bot['login'].'</option>';
}
echo '
</select>
<input class=lbut type=submit value="Выбрать">
</td></tr>
</table>
</form>
';
$err=1;
if($_POST['bot']!='none'){
	if(!empty($_POST['delete'])){
		$items=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `bot_drop` WHERE `bot_id`='".$_POST['bot']."' LIMIT 1;"));
		$additem="";
		switch($_POST['delete_id']){
			case 'items':
				$item=explode("|",$items['items_id']);
				foreach($item as $val){
					if($val!='' and $val!=$_POST['delete']){
						$additem.=$val."|";
					}
				}
				if($additem==""){$additem=0;}
				mysqli_query($GLOBALS['db_link'],"UPDATE `bot_drop` SET `items_id`='".$additem."'  WHERE `bot_id`='".$_POST['bot']."'  LIMIT 1;");				
			break;
			case 'bottles':
				$item=explode("|",$items['bottle_id']);
				foreach($item as $val){
					if($val!='' and $val!=$_POST['delete']){
						$additem.=$val."|";
					}
				}
				if($additem==""){$additem=0;}
				mysqli_query($GLOBALS['db_link'],"UPDATE `bot_drop` SET `bottle_id`='".$additem."'  WHERE `bot_id`='".$_POST['bot']."'  LIMIT 1;");			
			break;
			case 'leather': 
				$item=explode("|",$items['leather_id']);
				foreach($item as $val){
					if($val!='' and $val!=$_POST['delete']){
						$additem.=$val."|";
					}
				}
				if($additem==""){$additem=0;}
				mysqli_query($GLOBALS['db_link'],"UPDATE `bot_drop` SET `leather_id`='".$additem."' WHERE `bot_id`='".$_POST['bot']."' LIMIT 1;");				
			break;
		}
	}
	if($_GET['save']==1){
		switch($_GET['update']){
			case 'yes': 
				mysqli_query($GLOBALS['db_link'],"UPDATE `bot_drop` SET `items_chance`='".intval($_POST['items_chance'])."',`leather_chance`='".intval($_POST['leather_chance'])."',`bottle_chance`='".intval($_POST['bottle_chance'])."',`money_chance`='".intval($_POST['money_chance'])."' WHERE `bot_id`='".$_POST['bot']."' LIMIT 1;");
			break;
			case 'no': 
				mysqli_query($GLOBALS['db_link'],"INSERT INTO `bot_drop` (`bot_id`,`bot_login`,`items_chance`,`leather_chance`,`bottle_chance`,`money_chance`) VALUES ('".intval($_POST['bot'])."','".$_POST['bot_login']."','".intval($_POST['items_chance'])."','".intval($_POST['leather_chance'])."','".intval($_POST['bottle_chance'])."','".intval($_POST['money_chance'])."');");
			break;
		}		
	}
	if($_POST['idit'] and $_POST['dropadd']!='none'){
		$items=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `bot_drop` WHERE `bot_id`='".$_POST['bot']."' LIMIT 1;"));
		switch($_POST['dropadd']){
			case 1: 
				if($items['items_id']=='0'){
					$additem=intval($_POST['idit'])."|";
					mysqli_query($GLOBALS['db_link'],"UPDATE `bot_drop` SET `items_id`='".$additem."' WHERE  `bot_id`='".$_POST['bot']."' LIMIT 1;");
				}
				else{
					$item=explode("|",$items['items_id']);
					if(in_array(intval($_POST['idit']),$item)==false){
						$additem=$items['items_id'].intval($_POST['idit'])."|";
						mysqli_query($GLOBALS['db_link'],"UPDATE `bot_drop` SET `items_id`='".$additem."'  WHERE `bot_id`='".$_POST['bot']."'  LIMIT 1;");
					}
				}
			break;
			case 2:
				if($items['leather_id']=='0'){
					$additem=intval($_POST['idit'])."|";
					mysqli_query($GLOBALS['db_link'],"UPDATE `bot_drop` SET `leather_id`='".$additem."'  WHERE `bot_id`='".$_POST['bot']."'  LIMIT 1;");
				}
				else{
					$item=explode("|",$items['leather_id']);
					if(in_array(intval($_POST['idit']),$item)==false){
						$additem=$items['leather_id'].intval($_POST['idit'])."|";
						mysqli_query($GLOBALS['db_link'],"UPDATE `bot_drop` SET `leather_id`='".$additem."'  WHERE `bot_id`='".$_POST['bot']."'  LIMIT 1;");
					}
				}
			break;		
			case 3: 
				if($items['bottle_id']=='0'){
					$additem=intval($_POST['idit'])."|";
					mysqli_query($GLOBALS['db_link'],"UPDATE `bot_drop` SET `bottle_id`='".$additem."'  WHERE `bot_id`='".$_POST['bot']."'  LIMIT 1;");
				}
				else{
					$item=explode("|",$items['bottle_id']);
					if(in_array(intval($_POST['idit']),$item)==false){
						$additem=$items['bottle_id'].intval($_POST['idit'])."|";
						mysqli_query($GLOBALS['db_link'],"UPDATE `bot_drop` SET `bottle_id`='".$additem."'  WHERE `bot_id`='".$_POST['bot']."'  LIMIT 1;");
					}
				}			
			break;
		}
	}
	if($_GET['add']==1){
	$val_bot=varcheck($_POST['bot']);
		$chbot=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `bot_drop`  WHERE `bot_id`='".$val_bot."' LIMIT 1;"));
		if(!empty($chbot)){
			$chclr="green";$msg="Бот найден в базе!";
			$ich=$chbot['items_chance'];
			$lch=$chbot['leather_chance'];
			$bch=$chbot['bottle_chance'];
			$mch=$chbot['money_chance'];
			$err=0;
		}
		else{
			$chclr="red";$msg="Бот не найден в базе! Заполните нужные поля и нажмите \"сохранить\".";
			$ich=10;
			$lch=10;
			$bch=10;
			$mch=10;
			$err=1;
			echo '
			<table cellpadding=5 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
				<tr align=center class=freetxt>
					<td><font color='.$chclr.'><b>'.$msg.'</b></font><br></td>
				</tr>
			</table>
			';
		}
		echo'
		<form method="post" action="bot_drop.php?add=1&save=1&update='.($err==0?'yes':'no').'">
		<br><table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
			<tr><td>
			<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
				<tr class=nickname bgcolor=#EAEAEA>
					<td align=center width=30%><b>Имя и ид бота</b></td>
					<td align=center><b>Вещи</b></td>
					<td align=center><b>Кожа</b></td>
					<td align=center><b>Бутылки</b></td>
					<td align=center><b>Деньги</b></td>
				</tr>';
				$val_bot=varcheck($_POST['bot']);
		$botdrop=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `user`.`id`,`user`.`login` FROM `user` WHERE `user`.`type`='3' AND `user`.`id`='".$val_bot."' LIMIT 1;"));
		echo'
		<tr class=freetxt bgcolor=white>
			<td align=center width=30%>
				Имя: '.$botdrop['login'].'<br>
				Ид: '.$botdrop['id'].'
			</td>
			<td align=center>
				<b>Шанс выпадения вещей:</b><br> <b>1</b> из <input type=text class=logintextbox6 name="items_chance" value="'.$ich.'" />
			</td>
			<td align=center>
				<b>Шанс, что будет доступна опция "снять кожу":</b><br> <b>1</b> из <input type=text class=logintextbox6 name="leather_chance" value="'.$lch.'" />
			</td>
			<td align=center>
				<b>Шанс выпадения бутылок:</b><br> <b>1</b> из <input type=text class=logintextbox6 name="bottle_chance" value="'.$bch.'" />
			</td>
			<td align=center>
				<b>Шанс выпадения денег:</b><br> <b>1</b> из <input type=text class=logintextbox6 name="money_chance" value="'.$mch.'" />
			</td>
		</tr>
		<tr class=freetxt bgcolor=white>
			<td align=center width=100% colspan=5>
			<input class=lbut type=submit value="Сохранить">
			<input type=hidden name=bot_login value="'.$botdrop['login'].'">
			<input type=hidden name=bot value="'.$_POST['bot'].'">
			</td>
		</tr>	
		</table></form></td></tr></table>';	
		if($err==0){
			echo'
			<form method="post" action="bot_drop.php?add=1">
			<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
			<tr align=left class=nickname><td align=center>
			<b>Добавить вещи в дроп:</b> 
			<select name="type" >
				<option value="" selected="selected">все типы</option>
				  <option value="w4">Ножи</option>
				  <option value="w1">Мечи</option>
				  <option value="w2">Топоры</option>
				  <option value="w3">Дробящее</option>
				  <option value="w6">Алебарды и копья</option>
				  <option value="w5">Метательное</option>
				  <option value="w7">Посохи</option>
				  <option value="w20">Щиты</option>
				  <option value="w23">Шлемы</option>
				  <option value="w26">Пояса</option>
				  <option value="w18">Кольчуги</option>
				  <option value="w19">Доспехи</option>
				  <option value="w24">Перчатки</option>
				  <option value="w80">Наручи</option>
				  <option value="w21">Сапоги</option>
				  <option value="w25">Кулоны</option>
				  <option value="w22">Кольца</option>
				  <option value="w28">Наплечники</option>
				  <option value="w90">Поножи</option>
				  <option value="w61">Приманки</option>
				  <option value="w0">Эликсиры</option>
				  <option value="w66">Травы</option>
				  <option value="w67">Шкуры</option>
				  <option value="w69">Рыбалка</option>
				  <option value="w29">Свитки</option>
				  <option value="w60">Квесты</option>
				  <option value="w71">Руны</option>
				  <option value="w70">Мази</option>
				  <option value="w62">Сундуки</option>
				  <option value="w100">Ресурсы</option>
				 </select>  <input name="smb7" type="submit" class="lbut" value="Применить фильтр" />';
				 $filter2="WHERE master=''";
				 if($smb7){
					if($type==""){
						$filter="";$filter2="WHERE master='' AND dd_price=0";
					}
					else $filter="WHERE type='".$type."'";
					$filter2=" AND master=''  AND dd_price=0";
				}
				echo'    
				  <select name="idit" >
				  <option value=0';
				if($idit==""){echo " selected=selected";}
				echo'>Выберите тип</option>';
				$it=mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` ".$filter." ".$filter2." ORDER BY type,name,level;");
				  while ($row = mysqli_fetch_assoc($it)) {
					echo "<option value=".$row['id']."";if($idit==$row['id']){echo " selected=selected";}echo">".$row['name']." [ ".$row['level']." ]</option>";
				  }
				  echo'
			<input type=hidden name=bot value="'.$_POST['bot'].'">';
			if(!empty($_POST['type'])){
				echo'
				<select name=dropadd>
					<option value=none selected=selected>Выберите категорию</option>
					<option value=1>Вещи</option>
					<option value=2>Кожа</option>
					<option value=3>Бутылки</option>
				</select>
				<input class=lbut type=submit value="Добавить в дроп">
				';
			}
			echo'
			</td></tr>
			</table>
			</form><br>
			';
			if($chbot['items_id']!='0'){
			echo'
				<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
				<tr><td>
				<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
				<tr align=center class=nickname><td><b>Добавленные вещи:</b> <input type=button onClick="showHide(this,this.value,\'itemstr\');" value="Показать" class=klbut /></td></tr>';
				$itemsin=explode("|",$chbot['items_id']);
				foreach($itemsin as $val){
					if($val!=''){
						$name=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `items`.`name`,`items`.`id` FROM `items` WHERE `id`='".$val."' LIMIT 1;"));
						echo '
						<tr  bgcolor=white class="itemstr freetxt">							
							<td>
							<form method="post" action="bot_drop.php?add=1" id="itdel_'.$name['id'].'">
							[id:'.$name['id'].'] '.$name['name'].' <a href="http://legendbattles.ru//iteminfo.php?'.$name['name'].'" target="_blank"><img src="/img/image/chat/info1.gif" width="11" height="12" border="0" align="absmiddle"></a>							
								<input type=hidden name=bot value="'.$_POST['bot'].'">
								<input type=hidden name=delete value="'.$name['id'].'">
								<input type=hidden name=delete_id value="items">
								<input type=image src=/img/image/del.gif width=14 height=14 border=0 onClick="javasctipt: document.getElementById(\'itdel_'.$name['id'].'\').submit()" value="x" />
							</form>
							</td>
						</tr>';
					}
				}
				echo'
				</table>
				</td></tr>
				</table>';
			}
			if($chbot['bottle_id']!='0'){
				echo'		
				<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
				<tr><td>
				<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
				<tr align=center class=nickname><td><b>Добавленные бутылки:</b> <input type=button onClick="showHide(this,this.value,\'bottletr\');" value="Показать" class=klbut /></td></tr>';
				$itemsin=explode("|",$chbot['bottle_id']);
				foreach($itemsin as $val){
					if($val!=''){
						$name=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `items`.`name`,`items`.`id` FROM `items` WHERE `id`='".$val."' LIMIT 1;"));
						echo '
						<tr bgcolor=white class="bottletr freetxt">							
							<td>
							<form method="post" action="bot_drop.php?add=1" id="bdel_'.$name['id'].'">
							'.$name['name'].'							
								<input type=hidden name=bot value="'.$_POST['bot'].'">
								<input type=hidden name=delete value="'.$name['id'].'">
								<input type=hidden name=delete_id value="bottles">
								<input type=image src=/img/image/del.gif width=14 height=14 border=0 onClick="javasctipt: document.getElementById(\'bdel_'.$name['id'].'\').submit()" value="x" />
							</form>
							</td>
						</tr>';
					}
				}
								echo'
				</table>
				</td></tr>
				</table>';
			}
			if($chbot['leather_id']!='0'){
				echo'
				<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
				<tr><td>
				<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
				<tr align=center class=nickname><td><b>Добавленная кожа:</b> <input type=button onClick="showHide(this,this.value,\'leathertr\');" value="Показать" class=klbut /></td></tr>';
				$itemsin=explode("|",$chbot['leather_id']);
				foreach($itemsin as $val){
					if($val!=''){
						$name=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `items`.`name`,`items`.`id` FROM `items` WHERE `id`='".$val."' LIMIT 1;"));
						echo '
						<tr bgcolor=white class="leathertr freetxt">							
							<td>
							<form method="post" action="bot_drop.php?add=1" id="ldel_'.$name['id'].'">
							'.$name['name'].'							
								<input type=hidden name=bot value="'.$_POST['bot'].'">
								<input type=hidden name=delete value="'.$name['id'].'">
								<input type=hidden name=delete_id value="leather">
								<input type=image src=/img/image/del.gif width=14 height=14 border=0 onClick="javasctipt: document.getElementById(\'ldel_'.$name['id'].'\').submit()" value="x" />
							</form>
							</td>
						</tr>';
					}
				}
								echo'
				</table>
				</td></tr>
				</table>';
			}			
		}		
	}
	#а тут мы будем редактировать все статы бота
	if($player['login']=='alexs' and $_POST['bot']){
		$botparams = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `id`='".intval($_POST['bot'])."' LIMIT 1;"));
		$stats = explode("|",$botparams['st']);
		foreach($stats as $key=>$val){
			if($val!=''){$par[$key] = $val;}else{$par[$key] = 0;}
		}
		echo'
		<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 bordercolor=#e0e0e0 align=center>
			<tr><td>
			<form method=post>
			<table border=0 cellpadding=4 cellspacing=1 bordercolor=gray align=center class="smallhead" width=100%>
				<tr align=center class=nickname><td align=center colspan=2><b>Парамерты с вещей:</b> <input type=button onClick="showHide(this,this.value,\'paramsitr\');" value="Показать" class=klbut /></td></tr>';
				$t=array(0=> 0,2,3,4,72,73);
				$tr=0;
				for($i=1;$i<=73;$i++){
						if(!in_array ($i, $t)){	
							$str = "";
							$str = ShowParBot($i,$par[$i],1);
							if($str){							
								if($tr==0){echo"<tr bgcolor=white class='paramsitr freetxt'>";}
										echo"<td>";
										if($i==72){$i='expbonus';}
										if($i==73){$i='massbonus';}	
										if(!$par[$i]){$par[$i]=0;}
										echo $str;
										if($i=='expbonus'){$i=72;}
										if($i=='massbonus'){$i=73;}
										$tr++;
										echo"
										</td>";
								if($tr==2){echo"</tr>";$tr=0;}
							}
						}
				}
			echo'
			<tr bgcolor=white class="paramsitr freetxt">
				<td align=center width=100% colspan=5>
					<input class=lbut type=submit value="Сохранить">
					<input type=hidden name=post_id value="1">
					<input type=hidden name=bot value="'.$_POST['bot'].'">
				</td>
			</tr>	
			</table>
			</form>
			</td></tr>';
		echo'
		<br>
		<table cellpadding=0 cellspacing=0 border=0 bordercolor=#e0e0e0 width=65% bgcolor=#e0e0e0 align=center>
			<tr><td>
			<form method=post>
			<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
				<tr align=center class=nickname><td align=center colspan=2><b>Парамерты базовые:</b> <input type=button onClick="showHide(this,this.value,\'paramstr\');" value="Показать" class=klbut /></td></tr>';
				$str = "";
				$tr=0;
				for($i=30;$i<=35;$i++){
					$fr="";
					switch($i){
						case 30: $fr="Мощь:"; $stat=$botparams['sila']; $name='sila'; break;
						case 31: $fr="Проворность:"; $stat=$botparams['lovk']; $name='lovk';break;
						case 32: $fr="Везение:"; $stat=$botparams['uda4a']; $name='uda4a';break;
						case 33: $fr="Здоровье:"; $stat=$botparams['zdorov']; $name='zdorov';break;
						case 34: $fr="Разум:"; $stat=$botparams['znan']; $name='znan';break;
						case 35: $fr="Сноровка:"; $stat=$botparams['mudr']; $name='mudr';break;
					}
					if($fr){
						if($tr==0){echo '<tr bgcolor=white class="paramstr freetxt">';}
						$tr++;
						echo '<td><font class=weaponch><b>'.$fr.'</b></font>&nbsp;<input type=text name='.$name.' value="'.$stat.'"></td>';
						if($tr==2){echo '</tr>';$tr=0;}
					}
				}						
			echo'
			<tr bgcolor=white class="paramstr freetxt">
				<td align=center width=100% colspan=5>
					<input class=lbut type=submit value="Сохранить">
					<input type=hidden name=post_id value="2">
					<input type=hidden name=bot value="'.$_POST['bot'].'">
				</td>
			</tr>	
			</table>
			</form>
			</td></tr>';	
		echo'	
		</table>';
	}
}