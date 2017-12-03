<? session_start();session_register('filter');

?>
<HTML>
<HEAD>
<LINK href="../../../css/game.css" rel=STYLESHEET type=text/css>
<SCRIPT src="../../../js/stooltip.js?v11"></SCRIPT>
<META Http-Equiv=Content-Type Content="text/html; charset=windows-1251">
<META Http-Equiv=Cache-Control Content=No-Cache>
<META Http-Equiv=Pragma Content=No-Cache>
<META Http-Equiv=Expires Content=0>
</HEAD>
<BODY bgcolor=#FFFFFF topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0>
<table width="60%" border="0" cellspacing="0" cellpadding="0" align=center>
  <tr>
    <td align=center>
		<div id="tooltip"></div>
        <input type=button class=lbut onClick="location='adm.php'" value="Вернуться">
        <input type="button" class="lbut" onclick="location='alhim.php?create=1'"
               value="Создание Алхимического Рецепта"/>
        <input type="button" class="lbut" onclick="location='alhim.php?look=1'" value="Просмотр рецептов"/>
        <input type="button" class="lbut" onclick="location='alhim.php?look=2'" value="Просмотр игроков"/>
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
if($create==1){
	$itm="";
	if($_POST['idit']!=0){
		$itm=$_POST['idit'].((intval($_POST['col'])=='')?"@1":"@".intval($_POST['col'])).($_GET['items']?"|".$_GET['items']:"");
	}
	else{
		$itm=($_GET['items']?$_GET['items']:"");
	}	
	echo'
	<table width="60%" border="0" cellspacing="0" cellpadding="0" align=center>
	<tr><td>
	<form action="alhim.php?create=1&items='.$itm.'" method="post">
	<select name="idit" onmouseover="tooltip(this,\'<b>Выберите реагент и добавьте его в рецепт</b>\')" onmouseout="hide_info(this)">
	<option value="0" selected=selected>Выберите</option>';
	$it=mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE (`type`='w66' OR `type`='w69') AND `master`='' ORDER BY type,name,level;");
	 while ($row = mysqli_fetch_assoc($it)) {
		echo "<option value=\"$row[id]@$row[name]\">$row[name] [ $row[level] ]</option>";
	 }
	echo'
	<input type=hidden name=itemr value="'.$_POST['itemr'].'">
	<input type=hidden name=colr value="'.$_POST['colr'].'">
	<input type=hidden name=pricer value="'.$_POST['pricer'].'">
	<input type=hidden name=navr value="'.$_POST['navr'].'">
	<input type=text name=col onBlur="if (value == \'\') {value=\'Количество\'}" onFocus="if (value == \'Количество\') {value =\'\'}" value="Количество" onmouseover="tooltip(this,\'<b>Введите количество</b><br>по умолчанию: 1\')" onmouseout="hide_info(this)">
	<input name="setitem" type="submit" class="lbut" value="Добавить в рецепт" /></form>
	';
	if($itm!=""){		
		$i=0;
		$item=explode("|",$itm);
		foreach($item as $value){
			$param=explode("@",$value);
			$recipe[$param[0]]+=$param[2];
			$fullrec[$param[0]]=$param[0]."@".$recipe[$param[0]]."@".$param[1];
		}
		sort($fullrec);
		$forbd="";
        echo '<br><b>Рецепт:</b><br>';
		while (list($key,$val) = each($fullrec)) {
			$forp=explode("@",$val);
			$forbd.=$forp[0]."@".$forp[1]."|";
            echo $forp[2] . " (<b>" . $forp[1] . " шт</b>.)<br>";
		}
		$forbd=substr($forbd,0,strlen($forbd)-1);
		//echo $forbd;	
		echo '
		<br>
		<b>Что получается при помощи данных реагентов:</b>
		<form action="alhim.php?recipe=1" method="post">
		<select name="idit" onmouseover="tooltip(this,\'<b>Выберите зелье, которое будет создано по рецепту</b>\')" onmouseout="hide_info(this)">
		<option value="0" ' . ($_POST['itemr'] ? '' : 'selected=selected') . '>Выберите</option>';
		$it=mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE `type`='w0' AND `master`='' AND `dd_price`='0' ORDER BY type,name,level;");
		while ($row = mysqli_fetch_assoc($it)) {
			echo "<option value=\"$row[id]@$row[name]\" ".(($_POST['itemr']==$row['id'])?'selected=selected':'').">$row[name] [ $row[level] ]</option>";
		}
		echo'
		<input type=text name=col onBlur="if (value == \'\') {value=\'Количество\'}" onFocus="if (value == \'Количество\') {value =\'\'}" value="' . ($_POST['colr'] ? $_POST['colr'] : 'Количество') . '" onmouseover="tooltip(this,\'<b>Введите количество зелий которое получится при создании</b>\')" onmouseout="hide_info(this)"><font class=travma style="color: gray; font-size: 9px;"> (по умолчанию: 5)</font>
		<br><input type=text name=price onBlur="if (value == \'\') {value=\'Цена рецепта\'}" onFocus="if (value == \'Цена рецепта\') {value =\'\'}" value="' . ($_POST['pricer'] ? $_POST['pricer'] : 'Цена рецепта') . '" onmouseover="tooltip(this,\'<b>Введите цену рецепта</b>\')" onmouseout="hide_info(this)"><font class=travma style="color: gray; font-size: 9px;"> (по умолчанию: 100 LR)</font>
		<br><input type=text name=nav onBlur="if (value == \'\') {value=\'Навык алхимии\'}" onFocus="if (value == \'Навык алхимии\') {value =\'\'}" value="' . ($_POST['navr'] ? $_POST['navr'] : 'Навык алхимии') . '" onmouseover="tooltip(this,\'<b>Введите необходимый навык алхимии для использования и покупки данного рецепта</b>\')" onmouseout="hide_info(this)"><font class=travma style="color: gray; font-size: 9px;"> (по умолчанию: 1)</font>
		<input type=hidden name=recipe value="'.(($forbd=="")?"0":$forbd).'">	
		<br><input name="setitem" type="submit" class="lbut" value="Добавить рецепт в базу" /></form>
		<br><font class=travma style="color: red;"><b>&nbsp;Внимание: </font></b><font class=travma>Проверок на минусовые значения нет, не подставляйте значения типа "-200" в цену или количество. Если рецепт на эту вещь уже существует в базе - он будет заменен новым.
		
		';
	}
	echo'
	</td>
	</tr>
	</table>	
	';
	
}
if($_GET['recipe']==1){
	if($_POST['idit']=="0"){
        echo 'Не выбрана вещь для создания';
	}
	else if($_POST['recipe']=="0"){
        echo 'Не добавлено ни одного ингредиента';
	}
	else{
		$item=explode("@",$_POST['idit']);
		if(mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `alhim` WHERE `protype`='".$item[0]."';"))>0){
			mysqli_query($GLOBALS['db_link'],"UPDATE `alhim` SET `reagents`='".$_POST['recipe']."',`col`='".((intval($_POST['col'])=="")?"5":intval($_POST['col']))."',`nav`='".((intval($_POST['nav'])=="")?"1":intval($_POST['nav']))."',`price`='".((intval($_POST['price'])=="")?"100":intval($_POST['price']))."' WHERE `protype`='".$item[0]."';");
		}
		else{
			mysqli_query($GLOBALS['db_link'],"INSERT INTO `alhim` (protype,name,reagents,col,nav,price) VALUES ('".$item[0]."','".$item[1]."','".$_POST['recipe']."','".((intval($_POST['col'])=="")?"5":intval($_POST['col']))."','".((intval($_POST['nav'])=="")?"1":intval($_POST['nav']))."','".((intval($_POST['price'])=="")?"100":intval($_POST['price']))."')");
			echo 'test2';
		}
	}
}
if($_GET['look']==1){
if($_POST['delete']){
	mysqli_query($GLOBALS['db_link'],"DELETE FROM `alhim` WHERE `id`='".$_POST['delete']."' LIMIT 1;");
}
echo'
<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
<tr><td>
<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
		<tr class=nickname bgcolor=#EAEAEA>
			<td align=center width=10%><b>ID</b><br><font class=travma style="color: gray; font-size: 9px;">ид рецепта в базе</font></td>
			<td align=center width=50%><b>Имя предмета</b><br><font class=travma style="color: gray; font-size: 9px;">предмет который создаем</font></td>
			<td align=center width=10%><b>ID предмета</b><br><font class=travma style="color: gray; font-size: 9px;">ид предмета в базе</font></td>
			<td align=center width=20%><b>Реагенты</b><br><font class=travma style="color: gray; font-size: 9px;">Название (количество)</font></td>
			<td align=center width=10%><b>Количество</b><br><font class=travma style="color: gray; font-size: 9px;">сколько будет создано</font></td>
			<td align=center width=10%><b>Навык</b><br><font class=travma style="color: gray; font-size: 9px;">необходимый для создания</font></td>
			<td align=center width=10%><b>Цена</b><br><font class=travma style="color: gray; font-size: 9px;">цена рецепта</font></td>
			<td align=center width=10%><b>Действия</b><br><font class=travma style="color: gray; font-size: 9px;">редактировать или удалить</font></td>
		</tr>
		
		';
	$recipes=mysqli_query($GLOBALS['db_link'],"SELECT * FROM `alhim`");
	while ($row = mysqli_fetch_assoc($recipes)){
			$reg=explode("|",$row['reagents']);			
			echo '<tr class=nickname bgcolor=white>
			<td align=center>'.$row['id'].'</td>
			<td align=center>'.$row['name'].'</td>
			<td align=center>'.$row['protype'].'</td>
			<td align=center>';
			$itm="";
			foreach ($reg as $val){
				$reagent=explode("@",$val);
				$regit=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `items`.`name` FROM `items` WHERE `items`.`id`='".$reagent[0]."';"));
				echo "<b>".$regit['name']."</b> (".$reagent[1].")<br>";
				$itm.=$reagent[0]."@".$regit['name']."@".$reagent[1]."|";
			}
			$itm=substr($itm,0,strlen($itm)-1);
			echo'</td>
			<td align=center>'.$row['col'].'</td>
			<td align=center>'.$row['nav'].'</td>
			<td align=center>'.$row['price'].'</td>	
			<td align=center>
			<form action="alhim.php?create=1&items='.$itm.'" method="post">
			<input type=hidden name=itemr value="'.$row['protype'].'">
			<input type=hidden name=colr value="'.$row['col'].'">
			<input type=hidden name=pricer value="'.$row['price'].'">
			<input type=hidden name=navr value="'.$row['nav'].'">
			<input type="submit" class="lbut" value="редактировать" />
			</form>
			<form action="alhim.php?look=1" method="post">
			<input type=hidden name=delete value="'.$row['id'].'">
			<input type="submit" class="lbut" value="удалить" />
			</form>
			</td>				
			';

	}
	echo'</table></td></tr></table>';	
}
if($_GET['look']==2){
require_once($_SERVER["DOCUMENT_ROOT"]."/includes/sql_func.php");
echo'
<table cellpadding=0 cellspacing=0 border=0 width=65% bgcolor=#e0e0e0 align=center>
<tr><td>
<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
		<tr class=nickname bgcolor=#EAEAEA>
			<td align=center width=10%><b>Игрок</b><br><font class=travma style="color: gray; font-size: 9px;">имя</font></td>
			<td align=center width=50%><b>Навык алхимии</b><br><font class=travma style="color: gray; font-size: 9px;">у игрока</font></td>
			<td align=center width=50%><b>Рецепты</b><br><font class=travma style="color: gray; font-size: 9px;">(ид рецептов)</font></td>
		</tr>
		
		';
	$players=mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `alhim`>'1'");
	while ($row = mysqli_fetch_assoc($players)){
			$pt=allparam($row);
			echo '<tr class=nickname bgcolor=white>
			<td align=center>'.$row['login'].'</td>
			<td align=center>Алхимия: ' . $row['alhim'] . ' (' . $pt[68] . ' с вещами)<br>Травничество: ' . $row['trav'] . ' (' . $pt[70] . ' с вещами)</td><td>';
			$rec=explode("|",$row['alhim_rec']);
			foreach ($rec as $val){
				$recipe = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `alhim`.`name` FROM `alhim` WHERE `id`='".$val."' LIMIT 1;"));
				if($recipe!=""){
					echo $recipe['name']."<br>";
				}
			}
			echo "</td>";

	}
	echo'</table></td></tr></table>';	
}
echo'
</body>
</html>';

?>
