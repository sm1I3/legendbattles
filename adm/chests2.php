<?php require('kernel/before.php');?>
<? session_start();session_register('filter');?>
<HTML>
<HEAD>
<LINK href="../../../css/game.css" rel=STYLESHEET type=text/css>
    <META Http-Equiv=Content-Type Content="text/html; charset=utf-8">
<META Http-Equiv=Cache-Control Content=No-Cache>
<META Http-Equiv=Pragma Content=No-Cache>
<META Http-Equiv=Expires Content=0>
</HEAD>
<BODY bgcolor=#FFFFFF topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0>
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

$Newchests2 = mysql_query("SELECT * FROM `items` WHERE `chests`='2';");
while($row = mysql_fetch_array($Newchests2)){
	if(mysql_num_rows(mysql_query("SELECT * FROM `chests2` WHERE `cid`='".$row['id']."'")) == 0){
		mysql_query("INSERT INTO `chests2` (`cid`, `name`) VALUES ('".$row['id']."', '".$row['name']."');");
	}
}
$chests2 = mysql_query("SELECT * FROM `chests2`;");
echo '
<form method="post" action="?useaction=admin-action&addid=chests2&add=1">
<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
<tr align=center><td>
<select name=present>
<option value="none" ' . (($_POST['present'] != 'none' and $_POST['present'] != '') ? '' : 'selected=selected') . '>Выберите сундук</option>
';
while($present = mysql_fetch_array($chests2)){
	if(mysql_num_rows(mysql_query("SELECT * FROM `items` WHERE `chests`='2' and `id`='".$present['cid']."'")) > 0){
		echo '<option value="'.$present['id'].'" '.(($_POST['present']==$present['id'])?'selected=selected':'').'>'.$present['name'].'</option>';
	}else{
		mysql_query("DELETE FROM `chests2` WHERE `cid`='".$present['cid']."'");
	}
}
echo '
</select>
<input class=lbut type=submit value="Выбрать">
</td></tr>
</table>
</form>
';
$err=0;
if($_POST['present']!='none' and !empty($_POST['present'])){
	if(!empty($_POST['delete'])){
		$items=mysql_fetch_array(mysql_query("SELECT * FROM `chests2` WHERE `id`='".$_POST['present']."' LIMIT 1;"));
		$additem="";
		switch($_POST['delete_id']){
			case 'items':
				$item=explode("|",$items['items']);
				foreach($item as $val){
					if($val!='' and $val!=$_POST['delete']){
						$additem.=$val."|";
					}
				}
				if($additem==""){$additem=0;}
				mysql_query("UPDATE `chests2` SET `items`='".$additem."'  WHERE `id`='".$_POST['present']."'  LIMIT 1;");				
			break;
		}
	}
	if($_POST['idit']){
		$items=mysql_fetch_array(mysql_query("SELECT * FROM `chests2` WHERE `id`='".$_POST['present']."' LIMIT 1;"));
		if($items['items']=='0'){
			$additem=intval($_POST['idit'])."|";
			mysql_query("UPDATE `chests2` SET `items`='".$additem."' WHERE  `id`='".$_POST['present']."' LIMIT 1;");
		}
		else{
			$item=explode("|",$items['items']);
			if(in_array(intval($_POST['idit']),$item)==false){
				$additem=$items['items'].intval($_POST['idit'])."|";
				mysql_query("UPDATE `chests2` SET `items`='".$additem."'  WHERE `id`='".$_POST['present']."'  LIMIT 1;");
			}
		}
	}
	if($_GET['add']==1){
	$present=mysql_fetch_array(mysql_query("SELECT * FROM `chests2` WHERE `id`='".$_POST['present']."';"));
	echo'
			<form method="post" action="?useaction=admin-action&addid=chests2&add=1&save=1">
			<br><table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
				<tr><td>
				<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
					<tr class=nickname bgcolor=#EAEAEA>
						<td align=center width=30%><b>Имя</b></td>
					</tr>';
			echo'
			<tr class=freetxt bgcolor=white>
				<td align=center width=30%>
					Имя: <input type=text class=logintextbox6 name="present_name" value="' . $present['name'] . '" /><br>
					Ид: ' . $present['cid'] . '
				</td>
			</tr>
			<tr class=freetxt bgcolor=white>
				<td align=center width=100% colspan=5>
				<input class=lbut type=submit value="Сохранить">
				<input type=hidden name=present value="'.$_POST['present'].'">
				</td>
			</tr>	
			</table></form></td></tr></table>';
	}
	if($err==0){	
			echo'
			<form method="post" action="?useaction=admin-action&addid=chests2&add=1">
			<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
			<tr align=left class=nickname><td align=center>
			<b>Добавить вещи в сундук:</b> 
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
				  <option value="w60">Квесты</option>
			      <option value="w29">Свитки</option>
					<option value="w71">Руны</option>
				  <option value="w70">Мази</option>
				  <option value="w100">Ресурсы</option>
				 </select>  <input name="smb7" type="submit" class="lbut" value="Применить фильтр" />';
				 $filter2="WHERE master=''";
				 if($smb7){
					if($type==""){
						$filter="";$filter2="WHERE master=''";
					}
					else $filter="WHERE type='".$type."'";
					$filter2=" AND master=''";
				}
				echo'    
				  <select name="idit" >
				  <option value=0';
				if($idit==""){echo " selected=selected";}
        echo '>Выберите тип</option>';
				$it=mysql_query("SELECT * FROM `items` ".$filter." ".$filter2." ORDER BY type,name,level;");
				  while ($row = mysql_fetch_assoc($it)) {
					echo "<option value=".$row['id']."";if($idit==$row['id']){echo " selected=selected";}echo">".$row['name']." [ ".$row['level']." ]</option>";
				  }
				  echo'
			<input type=hidden name=present value="'.$_POST['present'].'">
			<input class=lbut type=submit value="Добавить в дроп">
			</td></tr>
			</table>
			</form><br>
			';
			if($present['items']!='0'){
			echo'
				<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
				<tr><td>
				<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
				<tr align=center class=nickname><td><b>Добавленные вещи:</b></td></tr>';
				$itemsin=explode("|",$present['items']);
				foreach($itemsin as $val){
					if($val!=''){
						$name=mysql_fetch_array(mysql_query("SELECT `items`.`name`,`items`.`id` FROM `items` WHERE `id`='".$val."' LIMIT 1;"));
						echo'
						<tr class=freetxt bgcolor=white>							
							<td>
							<form method="post" action="?useaction=admin-action&addid=chests2&add=1" id="itdel_'.$name['id'].'">
							'.$name['name'].'							
								<input type=hidden name=present value="'.$_POST['present'].'">
								<input type=hidden name=delete value="'.$name['id'].'">
								<input type=hidden name=delete_id value="items">
								<input type=image src=http://img.legendbattles.ru/image/del.gif width=14 height=14 border=0 onClick="javasctipt: document.getElementById(\'itdel_'.$name['id'].'\').submit()" value="x" />
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
?>
<? require('kernel/after.php'); ?>