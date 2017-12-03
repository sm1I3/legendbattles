<?php
function lr($lr) {
	$b = $lr % 100;
	$s = intval(($lr % 10000) / 100);
	$g = intval($lr / 10000);
	return (($g)?$g.' <img src=/img/image/gold.png width=14 height=14 valign=middle title=Золото>  ':'').(($s)?$s.' <img src=/img/image/silver.png width=14 height=14 valign=middle title=Серебро> ':'').(($b)?$b.' <img src=/img/image/bronze.png width=14 height=14 valign=middle title=Бронза> ':'');
}	
function GetInventId($uId){
	return mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*,  `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `invent`.`auction` = '1' AND `invent`.`id_item` = '".$uId."'"));
}
if($_POST['del'] == 1){
mysqli_query($GLOBALS['db_link'],"UPDATE `invent` SET `auction`='0' WHERE `id_item`='".$uId."'");
}
$Query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `auction_system` WHERE `status`='active' AND `userID` = '".$pers['id']."'");
?><table border="0" cellpadding="0" cellspacing="0" width="100%">
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
						<b>Время</b>
					</font>
				</td>
				<td align="center" bgcolor="#D8D8D8">
					<font class="nickname">
						<b>Снять</b>
					</font>
				</td>
				<td align="center" bgcolor="#D8D8D8">
					<font class="nickname">
						<b>Выкуп</b>
					</font>
				</td>
			</tr>';
$i = 0;
while( $row = mysqli_fetch_assoc($Query) ){
	$i++;
	// Отсчитваем время до конца
	$thisrow = $row['time'];
	$row['time']-=time();
	$ch=floor($row['time']/3600);
	$min=floor(($row['time']-($ch*3600))/60);
	$sec=floor(($row['time']-($ch*3600))%60);
	// Далее
	$bgcolor = (($i%2)?'f0f0f0':'ffffff'); 
	$ItemInfo = GetInventId($row['itemID']);
	if($ItemInfo['mod_color']!='0' or $ItemInfo['modified'] == '1') $ItemInfo['name'] .= '[ап]';
	
	echo'			<tr>
				<td align="center" width="66" bgcolor="#'.$bgcolor.'">
					<font class="nickname">
						<b><img src="/img/image/weapon/' . $ItemInfo['gif'] . '" onmouseover="tooltip(this,ShowInfo(\''.$ItemInfo['name'].'\',\''.$ItemInfo['gif'].'\',\''.$ItemInfo['price'].'\',\''.$ItemInfo['slot'].'\',\''.$ItemInfo['block'].'\',\''.$ItemInfo['hand'].'\',\''.preg_replace('/@/',':',$ItemInfo['param']).'\',\''.preg_replace('/@/',':',$ItemInfo['need']).'\',\''.$ItemInfo['massa'].'\',\''.$ItemInfo['level'].'\'));" onmouseout="hide_info(this);" /></b>
					</font>
				</td>
				<td bgcolor="#'.$bgcolor.'">
					<font class="nickname">
						<b>'.$ItemInfo['name'].'</b><br />
						Уровень: <b>'.$ItemInfo['level'].'</b><br />
						Масса: <b>'.$ItemInfo['massa'].'</b><br />
					</font>
				</td>
				<td align="center" bgcolor="#'.$bgcolor.'">
					<font class="nickname">
						<b>'.($thisrow > time() ? (($ch<10)?'0'.$ch:$ch).":".(($min<10)?'0'.$min:$min).":".(($sec<10)?'0'.$sec:$sec) : 'окончено' ).'</b>
					</font>
				</td>
				<td align="center" bgcolor="#'.$bgcolor.'">
					<font class="nickname">
						<input type="hidden" name="del" value="1" />
						<input type="hidden" name="'.$uId.'" value="'.$row['id_item'].'" />
						<input type="submit" class="lbut" value="Отменить" />
					</font>
				</td><font color="' . (($row['bet'] == $pers['login']) ? 'green' : 'red' ) . '">' . lr($row['price']) . '</font></b><br />
					</font>
				</td>
				<td align="center" bgcolor="#'.$bgcolor.'">
					<font class="nickname">
						<b>'.lr($row['maxprice']).'</b><br />
					</font>
				</td>
			</tr>';
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