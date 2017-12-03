<?php
function lr($lr) {
	$b = $lr % 100;
	$s = intval(($lr % 10000) / 100);
	$g = intval($lr / 10000);
	return (($g)?$g.' <img src=/img/image/gold.png width=14 height=14 valign=middle title=Золото>  ':'').(($s)?$s.' <img src=/img/image/silver.png width=14 height=14 valign=middle title=Серебро> ':'').(($b)?$b.' <img src=/img/image/bronze.png width=14 height=14 valign=middle title=Бронза> ':'');
}	

if($_POST['p_id'] == 1){
	$maxprice = (intval($_POST['gold'])) * 10000 + (intval($_POST['silver'])) * 100 + (intval($_POST['bronze']));
	$kolvo = intval($_POST["kolvo"]);
	if($kolvo > 1) {
		$protype = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT protype FROM invent WHERE `id_item`='".intval($_POST['itemId'])."' LIMIT 1;"));
		$r_kolvo = mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT protype FROM invent WHERE protype='".$protype['protype']."' AND pl_id = '".$pers['id']."'"));
		if($kolvo > $r_kolvo and $r_kolvo > 1) $kolvo = $r_kolvo;
		$sql = mysqli_query($GLOBALS['db_link'],"SELECT * FROM invent WHERE protype='".$protype['protype']."' AND pl_id = '".$pers['id']."' LIMIT $kolvo ;"); 
		while($assoc = mysqli_fetch_assoc($sql)){
			mysqli_query($GLOBALS['db_link'],"INSERT INTO `auction_system` (`itemID`, `userID`, `price`, `maxprice`, `anonymous`, `time`) VALUES ('".$assoc['id_item']."', '".$pers['id']."', '".intval($_POST['price'])."', '".intval($maxprice)."', '0', '".(time()+60*60*intval($_POST['time']))."');");
			mysqli_query($GLOBALS['db_link'],"UPDATE `invent` SET `auction`='1' WHERE `id_item`='".$assoc['id_item']."'");
		}
	}else{
	mysqli_query($GLOBALS['db_link'],"INSERT INTO `auction_system` (`itemID`, `userID`, `price`, `maxprice`, `anonymous`, `time`) VALUES ('".intval($_POST['itemId'])."', '".$pers['id']."', '".intval($_POST['price'])."', '".intval($maxprice)."', '0', '".(time()+60*60*intval($_POST['time']))."');");
	mysqli_query($GLOBALS['db_link'],"UPDATE `invent` SET `auction`='1' WHERE `id_item`='".intval($_POST['itemId'])."'");
	}
}
if (isset($_GET["weapon_category"]))
	$ext = " AND `items`.`type`='".preg_replace('/[^w0-9]/','',$_GET["weapon_category"])."'";
	else $ext = '';
$Query = mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*,  `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `invent`.`auction` = '0' AND `invent`.`used` = '0' AND `invent`.`clan` = '0' AND `invent`.`pl_id` = '".$pers['id']."' ".$ext);
?>
	<tr><td>
<a href='?useaction=auction-action&addid=newlots&weapon_category=w4'>
	<img src=/img/image/gameplay/shop/knife.gif title="Ножи" width=40 height=50>
</a>
<a href='?useaction=auction-action&addid=newlots&weapon_category=w1'>
	<img src=/img/image/gameplay/shop/sword.gif title="Мечи" width=40 height=50>
</a>
<a href='?useaction=auction-action&addid=newlots&weapon_category=w2'>
	<img src=/img/image/gameplay/shop/axe.gif title="Топоры" width=40 height=50>
</a>
<a href='?useaction=auction-action&addid=newlots&weapon_category=w3'>
	<img src=/img/image/gameplay/shop/crushing.gif title="Дробящие" width=40 height=50>
</a>
<a href='?useaction=auction-action&addid=newlots&weapon_category=w6'>
	<img src=/img/image/gameplay/shop/spears_helbeards.gif title="Алебарды и двуручное" width=40 height=50>
</a>
<a href='?useaction=auction-action&addid=newlots&weapon_category=w5'>
	<img src=/img/image/gameplay/shop/missle.gif title="Копья и метательное" width=40 height=50>
</a>
<a href='?useaction=auction-action&addid=newlots&weapon_category=w7'>
	<img type=image src=/img/image/gameplay/shop/wand.gif title="Посохи" width=40 height=50>
</a>
<a href='?useaction=auction-action&addid=newlots&weapon_category=w20'>
	<img src=/img/image/gameplay/shop/shield.gif title="Щиты" width=40 height=50>
</a>
<a href='?useaction=auction-action&addid=newlots&weapon_category=w23'>
	<img src=/img/image/gameplay/shop/helm.gif title="Шлемы" width=40 height=50>
</a>
<a href='?useaction=auction-action&addid=newlots&weapon_category=w26'>
	<img src=/img/image/gameplay/shop/belt.gif title="Пояса" width=40 height=50>
</a>
<a href='?useaction=auction-action&addid=newlots&weapon_category=w18'>
	<img src=/img/image/gameplay/shop/armor_light.gif title="Кольчуги" width=40 height=50>
</a>
<a href='?useaction=auction-action&addid=newlots&weapon_category=w19'>
	<img src=/img/image/gameplay/shop/armor_hard.gif title="Доспехи" width=40 height=50>
</a>
<a href='?useaction=auction-action&addid=newlots&weapon_category=w24'>
	<img src=/img/image/gameplay/shop/gloves.gif title="Перчатки" width=40 height=50>
</a>
<a href='?useaction=auction-action&addid=newlots&weapon_category=w80'>
	<img src=/img/image/gameplay/shop/armlet.gif title="Наручи" width=40 height=50>
</a>
<a href='?useaction=auction-action&addid=newlots&weapon_category=w21'>
	<img src=/img/image/gameplay/shop/boots.gif title="Сапоги" width=40 height=50>
</a>
<a href='?useaction=auction-action&addid=newlots&weapon_category=w25'>
	<img src=/img/image/gameplay/shop/amulet.gif title="Кулоны" width=40 height=50>
</a>
<a href='?useaction=auction-action&addid=newlots&weapon_category=w22'>
	<img src=/img/image/gameplay/shop/ring.gif title="Кольца" width=40 height=50>
</a>
<a href='?useaction=auction-action&addid=newlots&weapon_category=w28'>
	<img src=/img/image/gameplay/shop/spaudler.gif title="Наплечники" width=40 height=50>
</a>
<a href='?useaction=auction-action&addid=newlots&weapon_category=w90'>
	<img src=/img/image/gameplay/shop/knee_guard.gif title="Поножи" width=40 height=50>
</a>
<a href='?useaction=auction-action&addid=newlots&weapon_category=w66'>
    <img src=/img/image/gameplay/invent/1.gif title="Алхимия" width=40 height=50>
</a>
<a href='?useaction=auction-action&addid=newlots&weapon_category=w70'>
    <img src=/img/image/gameplay/invent/6.gif title="Мази" width=40 height=50>
</a>
<a href='?useaction=auction-action&addid=newlots&weapon_category=w69'>
    <img src=/img/image/gameplay/invent/2.gif title="Рыба" width=40 height=50>
</a>
<a href='?useaction=auction-action&addid=newlots&weapon_category=w71'>
    <img src=/img/image/gameplay/invent/3.gif title="Руны" width=40 height=50>
</a>
<a href='?useaction=auction-action&addid=newlots&weapon_category=w68'>
    <img src=/img/image/gameplay/invent/4.gif title="Лес" width=40 height=50>
</a>
<a href='?useaction=auction-action&addid=newlots&weapon_category=w60'>
    <img src=/img/image/gameplay/invent/23.gif title="Квестовые предметы" width=40 height=50>
</a>
<a href='?useaction=auction-action&addid=newlots&weapon_category=w61'>
    <img src=/img/image/gameplay/invent/8.gif title="Приманка" width=40 height=50>
</a>
<a href='?useaction=auction-action&addid=newlots&weapon_category=w29'>
    <img src=/img/image/gameplay/shops/svit.gif title="Свитки" width=40 height=50>
</a>
<a href='?useaction=auction-action&addid=newlots&weapon_category=w30'>
    <img src=/img/image/gameplay/invent/10.gif title="Лицензии" width=40 height=50>
</a>
<a href='?useaction=auction-action&addid=newlots&weapon_category=w62'>
    <img src=/img/image/gameplay/invent/db.gif title="Сундуки" width=40 height=50>
</a>
<a href='?useaction=auction-action&addid=newlots&weapon_category=w0'>
    <img src=/img/image/gameplay/invent/cat/21.gif title="Зелья" width=40 height=50>
</a>
</td></tr>
		<td bgcolor="#FFFFFF"><img src="/img/image/1x1.gif" width="1" height="3"></td>
	</tr>
	<tr>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td bgcolor="#cccccc"><table width="100%" border="0" cellpadding="1" cellspacing="1">
			<tr>
				<td align="center" width="50%" bgcolor="#D8D8D8">
					<font class="nickname">
						Ваши деньги: <b><?php echo lr($pers['nv']); ?></b> 
					</font>
				</td>
				<td align="center" width="50%" bgcolor="#D8D8D8">
					<font class="nickname">
						<strong><em><a href="http://forum.legendbattles.ru/index.php?act=show_topic&amp;id=164" target="_blank">Закон о торговле (Аукцион)</a></em></strong> <b><?=lr(0)?></b> 
					</font>
				</td>
			</tr>
		</table></td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF"><img src="/img/image/1x1.gif" width="1" height="3"></td>
	</tr>
	<tr>
		<td bgcolor="#cccccc"><?php
if(mysqli_num_rows($Query) > 0){
		echo'<table width="100%" border="0" cellpadding="1" cellspacing="1">
			<tr>
				<td align="center" width="66" bgcolor="#D8D8D8">
					<font class="nickname">
						&nbsp;
					</font>
				</td>
				<td align="center" bgcolor="#D8D8D8">
					<font class="nickname">
						<b>Название</b>
					</font>
				</td>
				<td align="center" bgcolor="#D8D8D8">
					<font class="nickname">
						<b>Длительность торгов:</b>
					</font>
				</td>
				<td align="center" bgcolor="#D8D8D8">
					<font class="nickname">
						<b>Количество</b>
					</font>
				</td>
				<td align="center" bgcolor="#D8D8D8">
					<font class="nickname">
						<b>Цена за шт.</b>
					</font>
				</td>
				<td align="center" bgcolor="#D8D8D8">
					<font class="nickname">
						<b>Действие</b>
					</font>
				</td>
			</tr>';
$i = 0;
while( $row = mysqli_fetch_assoc($Query) ){
	$i++;
	if($row['mod_color']!='0' or $row['modified'] == '1') $row['name'] .= '[ап]';
	// Отсчитваем время до конца
//	$row['time']-=time();
	$ch=floor($row['time']/3600);
	$min=floor(($row['time']-($ch*3600))/60);
	$sec=floor(($row['time']-($ch*3600))%60);
	// Далее
	$bgcolor = (($i%2)?'f0f0f0':'ffffff'); 
	
	echo'<form method="POST" action="">
			<tr>
				<td align="center" width="66" bgcolor="#'.$bgcolor.'">
					<font class="nickname">
						<img src="/img/image/weapon/'.$row['gif'].'" onmouseovаer="tooltip(this,\'<b>'.$row['name'].'</b><br><b><font color=#336699>Щелкните по изображению для просмотра подробной информации о предмете.</font></b>\')" onmouseout="hide_info(this)" onclick="window.open(\'http://www.legendbattles.ru/iteminfo.php?i='.$row['id_item'].'&auc=1\');" style="cursor:pointer;" align=absmiddle>
					</font>
				</td>
				<td bgcolor="#'.$bgcolor.'">
					<font class="nickname">
					<b>' . $row['name'] . '' . $itemsql['name'].'</b> <br />
					</b><br />
					Стоимость :<b>'.lr($row['price']).'</b><br />
					Уровень: <b>'.$row['level'].'</b><br />
					Масса: <b>'.$row['massa'].'</b><br />
				</td>
				<td align="center" bgcolor="#'.$bgcolor.'">
					<font class="nickname">
						<select name="time">
							<option value="2" selected="select">2 часа</option>
							<option value="8">8 часов</option>
							<option value="24">24 часа</option>
						</select>
					</font>
				</td>
				<td align="center" bgcolor="#'.$bgcolor.'">
					<font class="nickname">
					<input type="text" title="Количество" name="kolvo" size = "2" value="1"/>
						</select>
					</font>
				</td>
				<td align="center" bgcolor="#'.$bgcolor.'">
					<font class="nickname">
					';
$b = $row['price'] % 100; $s = intval(($row['price'] % 10000) / 100); $g = intval($row['price'] / 10000);
						echo'<img src="/img/image/gold.png" width="14" height="14" valign="middle" title="Золото"><input type=text name=gold style="width: 40;" value='.$g.'><img src="/img/image/silver.png" width="14" height="14" valign="middle" title="Серебро"><input type=text name=silver style="width: 40;" value='.$s.'><img src="/img/image/bronze.png" width="14" height="14" valign="middle" title="Бронза"><input type=text name=bronze style="width: 40;" value='.$b.'>
					</font>
				</td>
				<td align="center" bgcolor="#'.$bgcolor.'">
					<font class="nickname">
						<input type="hidden" name="p_id" value="1" />
						<input type="hidden" name="itemId" value="'.$row['id_item'].'" />
						<input type="submit" class="lbut" value="Выставить лот" />
					</font>
				</td>
			</tr>
		</form>';
}
}else{
	echo'<table width="100%" border="0" cellpadding="1" cellspacing="1">
			<tr>
				<td align="center" width="100%" bgcolor="#D8D8D8">
					<b>Не найдено ни одного лота!</b>
				</td>
			</tr>
		</table>';
}
		?></table></td>
	</tr>
</table>