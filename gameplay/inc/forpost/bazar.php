
<?
/* СОРТИРОВКА */
if(!empty($_POST['min_lev']) or !empty($_POST['max_lev']) or !empty($_POST['max_nv']) or !empty($_POST['sorttype'])){
	$_SESSION['min_lev'] = intval($_POST['min_lev']);
	$_SESSION['max_lev'] = intval($_POST['max_lev']);
	$_SESSION['max_nv'] = intval($_POST['max_nv']);
	if($_POST['sorttype'] == '0'){
		$_SESSION['sorttype'] = 'price';
	}elseif($_POST['sorttype'] == '1'){
		$_SESSION['sorttype'] = 'level';
	}else{
		$_SESSION['sorttype'] = 'price';
	}
}
if(empty($_SESSION['min_lev'])){
	$_SESSION['min_lev'] = '0';
}
if(empty($_SESSION['max_lev'])){
	$_SESSION['max_lev'] = '33';
}
if(empty($_SESSION['sorttype'])){
	$_SESSION['sorttype'] = 'level';
}
/* КАТЕГОРИИ */
if(isset($_GET['weapon_category'])){
	$_SESSION['mark']=$_GET['weapon_category'];
}
if($_SESSION['mark']!=''){
	$_GET['weapon_category']=$_SESSION['mark'];
}
echo '<LINK href="/css/stl.css" rel="STYLESHEET" type="text/css">';
if($msg){

echo "<SCRIPT>MessBoxDiv('".$msg."',0,0,0,0);</SCRIPT>";
}
function namebyid($id){
	$plname = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `user`.`login`,`user`.`id` FROM `user` WHERE `id`='".$id."' LIMIT 1;"));
	return $plname['login'];
}
$locname = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `loc` WHERE `id`='".$player['loc']."' LIMIT 1;"));
if((empty($_GET['palatka']) and empty($_GET['ob'])) or $_GET['back']==1){
echo'
<table cellpadding=0 cellspacing=0 border=0 align=center width=760>
<tr><td><fieldset><legend align="center"><b><font color="gray">'.$locname['loc'].'</font></b></legend><div align=center name="focusdiv"><img src="/img/image/gameplay/market/market'.((date("H")>21 and date("H")<7)?'_night':'').'.jpg" width=760 height=255 border=0></div></fieldset></td></tr>
<tr><td valign=top>
<table cellspacing="0" width="100%" cellpadding="0" border="0" align="center">
	<tr><td bgcolor="#CCCCCC">
	<table cellspacing="1" width="100%" cellpadding="3" border="0" align="center" class=weaponch>
		<tr><td bgcolor="#f5f5f5" colspan=5><div align=center><b>Городской Базар</b></div></td></tr>';
		$i=0;
		for($tr=0;$tr<=5;$tr++){
			echo '<tr>';
			for($td=0;$td<5;$td++){
				$i++;
				$palatka = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `rinok_palatki` WHERE `id`='".$i."' LIMIT 1;"));
				if(!$palatka){mysqli_query($GLOBALS['db_link'],"INSERT INTO `rinok_palatki` (id) VALUES ('".$i."')");}
                echo '<td width="20%" bgcolor="#f5f5f5" class=proceb><div align=center><a href="?palatka=' . $i . '" >Палатка №' . $i . '</a></div></td>';
			}
			echo '</tr>';
		}

    echo '	<tr><td bgcolor="#f5f5f5" colspan=5 class=weaponch><div align=center><b>Общий рынок</b> [ <a href="?ob=1">Войти</a> ] </div></td></tr>
		</table>
	<tr></td>
</table>';
}
elseif(intval($_GET['palatka'])){
	$palatka = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `rinok_palatki` WHERE `id`='".intval($_GET['palatka'])."' LIMIT 1;"));
	if($palatka['id']){
	echo'
	<table cellpadding=0 cellspacing=0 border=0 align=center width=760>
	<tr><td><fieldset><legend align="center"><b><font color="gray">'.$locname['loc'].'</font></b></legend><div align=center name="focusdiv"><img src="/img/image/gameplay/market/market'.((date("H")>21 and date("H")<7)?'_night':'').'.jpg" width=760 height=255 border=0></div></fieldset></td></tr>
	<tr><td valign=top>
	<table cellspacing="0" width="100%" cellpadding="0" border="0" align="center">
		<tr><td bgcolor="#CCCCCC">
		<table cellspacing="1" width="100%" cellpadding="3" border="0" align="center" class=weaponch>
			<tr><td bgcolor="#f5f5f5" colspan=3><div align=center><b>Городской Базар - Палатка №' . intval($_GET['palatka']) . '</b> [ <a href="?back=1">Вернуться</a> ]</div></td></tr></table>
			<table cellspacing="0" width="100%" cellpadding="1" border="0" align="center" class=weaponch>
			';
			$i=0;
			for($tr=0;$tr<2;$tr++){
				echo '<tr>';
				for($td=0;$td<3;$td++){
					$i++;
					echo '
						<td class="freetxt" valign="top" width="34%" bgcolor=white>
						<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100">
							<tr><td bgcolor="#B9A05C" valign="top">
								<table cellpadding="3" cellspacing="1" border="0" width="100%">
									<tr><td class="weaponch" valign="top" height="15" bgcolor="#FCFAF3">
										<div align="center"><b>Торговое место №' . $i . '</b></div>
									</td></tr>
									<tr><td class="freetxt" valign="top" bgcolor="#FCFAF3" height="85"><div align=center>';
									if($palatka['owner_'.$i]){
										$owner = explode("@",$palatka['owner_'.$i]);
										if($owner[1]>time()){
											if($owner[0]==$player['id']){
                                                echo '<br><br>Это ваше место.<br>Аренда действительна до <font class=proce><b>' . (date("d.m.Yг.", $owner[1])) . '</b></font><br>';
												echo'
												<form method=post>
													<input type=hidden name=vcode value="'.scode().'" />
													<input type=hidden name=post_id value="109" />
													<input type=hidden name=act value="2" />
													<input type=hidden name=palatka value="'.$palatka['id'].'" />
													<input type=hidden name=palatka_type value="1" />
													<input type=submit class=lbut value=" Выставить вещи на продажу " />
												</form>
												';											
											}
											else{
												$ownername = namebyid($owner[0]);
                                                echo '<br><br>Принадлежит: <br><b>' . $ownername . '</b><a href="http://www.test.legendbattles.ru/ipers.php?' . $ownername . '" title=' . $ownername . ' target="_blank"><img src="/img/image/chat/info.gif" width="11" height="12" border="0" title=' . $ownername . '></a>';
											}
										}else{
											mysqli_query($GLOBALS['db_link'],"UPDATE `rinok_palatki` SET `owner_".$i."`='' WHERE `id`='".$palatka['id']."' LIMIT 1;");
											echo'
											<form method=post>
												<font class=proceg><br>Торговое место свободно</font><br>
												<input type=hidden name=palatka value="'.$palatka['id'].'" />
												<input type=hidden name=mesto value="'.$i.'" />
												<input type=hidden name=vcode value="'.scode().'" />
												<input type=hidden name=post_id value="109" />
												<input type=hidden name=act value="1" />
												<input type=hidden name=time value="1" />
												<input type=submit class=lbut value=" Купить на 30 дней [ 1200 LR ] " />
											</form>
											<form method=post>
												<input type=hidden name=palatka value="'.$palatka['id'].'" />
												<input type=hidden name=mesto value="'.$i.'" />
												<input type=hidden name=vcode value="'.scode().'" />
												<input type=hidden name=post_id value="109" />
												<input type=hidden name=act value="1" />
												<input type=hidden name=time value="2" />
												<input type=submit class=lbut value=" Купить на 365 дней [ 15 DLR ] " />
											</form>
											';
										}
										
									}
									else{
										echo'
										<form method=post>
											<font class=proceg><br>Торговое место свободно</font><br>
											<input type=hidden name=palatka value="'.$palatka['id'].'" />
											<input type=hidden name=mesto value="'.$i.'" />
											<input type=hidden name=vcode value="'.scode().'" />
											<input type=hidden name=post_id value="109" />
											<input type=hidden name=act value="1" />
											<input type=hidden name=time value="1" />
											<input type=submit class=lbut value=" Купить на 30 дней [ 1200 LR ] " />
										</form>
										<form method=post>
											<input type=hidden name=palatka value="'.$palatka['id'].'" />
											<input type=hidden name=mesto value="'.$i.'" />
											<input type=hidden name=vcode value="'.scode().'" />
											<input type=hidden name=post_id value="109" />
											<input type=hidden name=act value="1" />
											<input type=hidden name=time value="2" />
											<input type=submit class=lbut value=" Купить на 365 дней [ 15 DLR ] " />
										</form>
										';
									}
									echo'</div></td></tr>
									</table>
							</td></tr>
						</table>
						</td>';
	
				}
				echo '</tr>';
			}
			echo '<tr><td bgcolor=#f5f5f5 colspan=3><br>';
			echo'
			<form method=post>
				<div align=center><font class=freetxt><font color=#3564A5><b>Фильтр: </b></font>уровень от <select name=min_lev class=zayavki>';
				for($i=0;$i<=33;$i++){
					echo'<option value='.$i.(($_SESSION['min_lev']==$i)?' SELECTED':'').'>'.$i.'</option>';
				}
echo '</select> до <select name=max_lev class=zayavki>';
				for($i=0;$i<=33;$i++){
					echo'<option value='.$i.(($_SESSION['max_lev']==$i)?' SELECTED':'').'>'.$i.'</option>';
				}
echo '</select> не дороже 
				<input type=text size=2 name=max_nv value="' . (($_SESSION['max_nv'] == '0') ? '' : $_SESSION['max_nv']) . '" class=LogintextBox6><b>LR</b> сортировка по 
				<select name=sorttype class=zayavki>
				<option value=1' . (($_SESSION['sorttype'] == 'level') ? ' SELECTED' : '') . '>уровню</option>
				<option value=0' . (($_SESSION['sorttype'] == 'price') ? ' SELECTED' : '') . '>стоимости</option></select>
				<input type=submit value=" ok " class=lbut>
				</font></div>
			</form></td></tr>';
		echo'
		<tr><td bgcolor=#f5f5f5 colspan=3>
		<div align=center>
		<input type=image src=/img/image/gameplay/shop/knife.gif onClick="location=\'?weapon_category=w4&palatka=' . $palatka['id'] . '\'" title="Ножи" width=36 height=45>
		<input type=image src=/img/image/gameplay/shop/sword.gif onClick="location=\'?weapon_category=w1&palatka=' . $palatka['id'] . '\'" title="Мечи" width=36 height=45>
		<input type=image src=/img/image/gameplay/shop/axe.gif onClick="location=\'?weapon_category=w2&palatka=' . $palatka['id'] . '\'" title="Топоры" width=36 height=45>
		<input type=image src=/img/image/gameplay/shop/crushing.gif onClick="location=\'?weapon_category=w3&palatka=' . $palatka['id'] . '\'" title="Дробящие" width=36 height=45>
		<input type=image src=/img/image/gameplay/shop/spears_helbeards.gif onClick="location=\'?weapon_category=w6&palatka=' . $palatka['id'] . '\'" title="Алебарды и двуручное" width=36 height=45>
		<input type=image src=/img/image/gameplay/shop/missle.gif onClick="location=\'?weapon_category=w5&palatka=' . $palatka['id'] . '\'" title="Копья и метательное" width=36 height=45>
		<input type=image src=/img/image/gameplay/shop/wand.gif onClick="location=\'?weapon_category=w7&palatka=' . $palatka['id'] . '\'" title="Посохи" width=36 height=45>
		<input type=image src=/img/image/gameplay/shop/shield.gif onClick="location=\'?weapon_category=w20&palatka=' . $palatka['id'] . '\'" title="Щиты" width=36 height=45>
		<input type=image src=/img/image/gameplay/shop/helm.gif onClick="location=\'?weapon_category=w23&palatka=' . $palatka['id'] . '\'" title="Шлемы" width=36 height=45>
		<input type=image src=/img/image/gameplay/shop/belt.gif onClick="location=\'?weapon_category=w26&palatka=' . $palatka['id'] . '\'" title="Пояса" width=36 height=45>
		<input type=image src=/img/image/gameplay/shop/armor_light.gif onClick="location=\'?weapon_category=w18&palatka=' . $palatka['id'] . '\'" title="Кольчуги" width=36 height=45>
		<input type=image src=/img/image/gameplay/shop/armor_hard.gif onClick="location=\'?weapon_category=w19&palatka=' . $palatka['id'] . '\'" title="Доспехи" width=36 height=45>
		<input type=image src=/img/image/gameplay/shop/gloves.gif onClick="location=\'?weapon_category=w24&palatka=' . $palatka['id'] . '\'" title="Перчатки" width=36 height=45>
		<input type=image src=/img/image/gameplay/shop/armlet.gif onClick="location=\'?weapon_category=w80&palatka=' . $palatka['id'] . '\'" title="Наручи" width=36 height=45>
		<input type=image src=/img/image/gameplay/shop/boots.gif onClick="location=\'?weapon_category=w21&palatka=' . $palatka['id'] . '\'" title="Сапоги" width=36 height=45>
		<input type=image src=/img/image/gameplay/shop/amulet.gif onClick="location=\'?weapon_category=w25&palatka=' . $palatka['id'] . '\'" title="Кулоны" width=36 height=45>
		<input type=image src=/img/image/gameplay/shop/ring.gif onClick="location=\'?weapon_category=w22&palatka=' . $palatka['id'] . '\'" title="Кольца" width=36 height=45>
		<input type=image src=/img/image/gameplay/shop/spaudler.gif onClick="location=\'?weapon_category=w28&palatka=' . $palatka['id'] . '\'" title="Наплечники" width=36 height=45>
		<input type=image src=/img/image/gameplay/shop/knee_guard.gif onClick="location=\'?weapon_category=w90&palatka=' . $palatka['id'] . '\'" title="Поножи" width=36 height=45>
		</div>
		</td></tr>';
		if(isset($_GET['weapon_category']) and intval($_GET['palatka'])){
			$ITEMS = mysqli_query($GLOBALS['db_link'],"SELECT `rinok`.*, `items`.*
			FROM `rinok` LEFT JOIN `items` ON `rinok`.`protype` = `items`.`id`
			WHERE `items`.`dd_price`='0' AND `level`>='".$_SESSION["min_lev"]."' AND `level`<='".$_SESSION["max_lev"]."'".(($_SESSION["max_nv"]>'0')?" AND `rinok`.`sellprice`<='".$_SESSION["max_nv"]."'":"")." AND `items`.`type`='".preg_replace('/[^w0-9]/','',$_GET["weapon_category"])."' AND `rinok`.`palatka`='".intval($_GET['palatka'])."' AND `rinok`.`palatka_type`='".(1)."' ORDER BY `items`.`".$_SESSION['sorttype']."` ASC");
			$num = (mysqli_num_rows($ITEMS)); 
			if($num>0){?>
				<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#e0e0e0>
                            <table cellpadding=3 cellspacing=1 border=0 width=100%>
                                <tr>
                                    <td colspan=2 bgcolor=#F9f9f9>
                                        <div align=center><font class=inv><b> У Вас с собой <?= $player['nv'] ?> LR и
                                                    вещей массой: <?= $plstt[71] ?> Максимальный вес: <?= $mass ?></b>
                                        </div>
                                    </td>
                                </tr>
				<?
				$freemass=$plstt[71];
					while ($ITEM = mysqli_fetch_assoc($ITEMS)) {
					$bt=0;$tr_b='';$par_i='';$pararr ='';$m=1;
					$pararr = itemparams(1,$ITEM,$player,$plstt,$mass);
                        $tr_b = $pararr[1][0];
                        $iz = $pararr[2];//требования
                        $bt = $pararr[1][1]; //доступность кнопок
                        $par_i = $pararr[0]; //параметры
					if($ITEM['grav']){$ITEM['name'] = $ITEM['name']." (".$ITEM['grav'].")";}
					$vcod=scode();
					$ItemToOne[$ITEM['id']+$ITEM['arenda']+$ITEM['rassrok']][md5($ITEM['iznos'].'/'.$ITEM['dolg'].$ITEM['mod'].$ITEM['clan'].$ITEM['grav'].$ITEM['pl_id'].$ITEM['sellprice'])] += 1;
					if($ItemToOne[$ITEM['id']+$ITEM['arenda']+$ITEM['rassrok']][md5($ITEM['iznos'].'/'.$ITEM['dolg'].$ITEM['mod'].$ITEM['clan'].$ITEM['grav'].$ITEM['pl_id'].$ITEM['sellprice'])] == 1){
						$count = mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT `rinok`.*, `items`.* FROM `items` INNER JOIN `rinok` ON `items`.`id` = `rinok`.`protype` WHERE `pl_id`='".$ITEM['pl_id']."' and `rinok`.`used`='0' and `dolg`='".$ITEM['dolg']."' and `iznos`='".$ITEM['iznos']."' and `items`.`id`='".$ITEM['id']."' and `rinok`.`arenda`='".$ITEM['arenda']."' and `rinok`.`rassrok`='".$ITEM['rassrok']."' and `rinok`.`mod`='".$ITEM['mod']."' and `rinok`.`clan`='".$ITEM['clan']."' and `rinok`.`grav`='".$ITEM['grav']."' and `rinok`.`sellprice`='".$ITEM['sellprice']."' and `rinok`.`bank`='0' $sq $sq2;"));
					?>
					<tr><td bgcolor=#f9f9f9><div align=center><img src=/img/image/weapon/<?=$ITEM['gif']?> border=0></div></td>
					<td width=100% bgcolor=#ffffff valign=top><table cellpadding=0 cellspacing=0 border=0 width=100%>
					<tr><td bgcolor=#ffffff width=100%><font class=nickname>
					<?
					if($ITEM['pl_id']==$player['id']){?>
                        <b><input type=button class=invbut
                                  onclick="if(confirm('При отмене лота взимается комиссия 5% от цены лота. Вы уверены, что хотите отменить лот?')) { location='main.php?post_id=110&act=2&uid=<?= $ITEM['id_item'] ?>&vcode=<?= scod() ?>' }"
                                  value="Отменить продажу"></b>
					<? }	
					elseif($player['nv']>=$ITEM['sellprice'] and $m!=0){?>
                        Количество: <input type=text class=logintextbox7 name=col value=1
                                           onkeyup="writeBuy(this.value,'<?= $ITEM['id_item'] ?>','<?= scod() ?>');">&nbsp;
                        <b id="buybutton_<?= $ITEM['id_item'] ?>"><input type=button class=invbut
                                                                         onclick="location='main.php?post_id=110&act=1&col=1&uid=<?= $ITEM['id_item'] ?>&vcode=<?= scod() ?>'"
                                                                         value="Купить"></b>
					<? }?>
					<b>
					<?
                    if ($ITEM[mod_color] == 0) {
                        echo $ITEM[name] . ($ITEM[modified] == 1 ? " [ап]" : "") . "</b>";
                    }
						    else
							  {
                                  if ($ITEM[mod_color] == 1) {
                                      echo "<font color=#006600>" . $ITEM[name] . "</font> [мод]" . ($ITEM[modified] == 1 ? " [ап]" : "") . "</font></b>";
                                  }
                                  if ($ITEM[mod_color] == 2) {
                                      echo "<font color=#3333CC>" . $ITEM[name] . "</font> [мод]" . ($ITEM[modified] == 1 ? " [ап]" : "") . "</font></b>";
                                  }
                                  if ($ITEM[mod_color] == 3) {
                                      echo "<font color=#993399>" . $ITEM[name] . "</font> [мод]" . ($ITEM[modified] == 1 ? " [ап]" : "") . "</font></b>";
                                  }
	    					  }
                    echo '<font class=proceb> (в наличии: ' . $count . ') продавец: <b>' . (namebyid($ITEM['pl_id'])) . '</b></font>';
					?>
					</b><font class=weaponch>
					<br><img src=/img/image/1x1.gif width=1 height=3></td>
					<td><br><img src=/img/image/1x1.gif width=1 height=3</td></tr>
					<tr><td colspan=2 width=100%><table cellpadding=0 cellspacing=0 border=0 width=100%>
                                <tr>
                                    <td bgcolor=#D8CDAF width=50%>
                                        <div align=center><font class=invtitle>свойства</div>
                                    </td>
					<td bgcolor=#B9A05C><img src=/img/image/1x1.gif width=1 height=1></td>
                                    <td bgcolor=#D8CDAF width=50%>
                                        <div align=center><font class=invtitle>требования</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td bgcolor=#FCFAF3><font class=weaponch>&nbsp;Цена:
                                            <b><? if ($ITEM['sellprice'] > $player['nv']) {
                                                    echo "<font color=#cc0000>" . $ITEM['sellprice'] . " LR</font>";
                                                } else {
                                                    echo $ITEM['sellprice'] . " LR";
                                                }
                                                echo " [ <font class=proceg>гос.цена: " . $ITEM['price'] . " LR </font>]"; ?></b><br>
                                            <? if ($ITEM['slot'] == 16) echo "<font class=weaponch><b><font color=#cc0000>Можно одевать на кольчуги</font></b><br>";
					blocks($ITEM['block']);
					echo $par_i;
					?>
					</td><td bgcolor=#B9A05C><img src=/img/image/1x1.gif width=1 height=1></td><td bgcolor=#FCFAF3>
					<font class=weaponch><?=$tr_b?>
					</font>
					</td></tr></table></td></tr></table></td></tr>
				<? }}
			}
                else {
                    echo '<table cellpadding=5 cellspacing=1 border=0 width=100% align=center><tr><td bgcolor=#F5F5F5 align=center colspan=2><font class=inv><b>Нет товаров в данной категории.</b></font></td></tr>';
                }
			echo '</table>';
		}	
		echo'
		</table>
		<tr></td>
	</table>';			
	}
}
elseif(intval($_GET['ob'])==1){
		echo'
	<table cellpadding=0 cellspacing=0 border=0 align=center width=760>
	<tr><td><fieldset><legend align="center"><b><font color="gray">'.$locname['loc'].'</font></b></legend><div align=center name="focusdiv"><img src="/img/image/gameplay/market/market'.((date("H")>21 and date("H")<7)?'_night':'').'.jpg" width=760 height=255 border=0></div></fieldset></td></tr>
	<tr><td valign=top>
	<table cellspacing="0" width="100%" cellpadding="0" border="0" align="center">
		<tr><td bgcolor="#CCCCCC">
		<table cellspacing="1" width="100%" cellpadding="3" border="0" align="center" class=weaponch>
			<tr><td bgcolor="#f5f5f5" colspan=3><div align=center><b>Общий рынок</b> [ <a href="?back=1">Вернуться</a> ]</div></td></tr></table>
			<table cellspacing="0" width="100%" cellpadding="1" border="0" align="center" class=weaponch>
			';
			$i=0;
				echo '<tr>';
				for($td=0;$td<1;$td++){
					$i++;
					echo '
						<td class="freetxt" valign="top" width="34%" bgcolor=white>
						<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100">
							<tr><td bgcolor="#B9A05C" valign="top">
								<table cellpadding="3" cellspacing="1" border="0" width="100%">
									<tr><td class="weaponch" valign="top" height="15" bgcolor="#FCFAF3">
										<div align="center"><b>Правила общего рынка</b></div>
									</td></tr>
									<tr><td class="freetxt" valign="top" bgcolor="#FCFAF3" height="85"><div align=center>
									<br>Максимальная гос.цена вещи 500 LR. Комиссия с продажи или отмены лота 5%<br>Количество лотов неограничено. Можно продать только полностью целые вещи.<br>На рынке действуют законы о торговле между персонажами. Нарушители будут наказаны.<br>
									';
									echo'
											<form method=post>
												<input type=hidden name=vcode value="'.scode().'" />
												<input type=hidden name=post_id value="109" />
												<input type=hidden name=act value="2" />
												<input type=hidden name=palatka value="'.(0).'" />
												<input type=hidden name=palatka_type value="2" />
												<input type=submit class=lbut value=" Выставить вещи на продажу " />
											</form>
									';	
									echo '									
									</div>
									</td></tr>
									</table>
							</td></tr>
						</table>
						</td>';
	
				}
				echo '</tr>';			
			echo '<tr><td bgcolor=#f5f5f5 colspan=3><br>';
			echo'
			<form method=post>
				<div align=center><font class=freetxt><font color=#3564A5><b>Фильтр: </b></font>уровень от <select name=min_lev class=zayavki>';
				for($i=0;$i<=33;$i++){
					echo'<option value='.$i.(($_SESSION['min_lev']==$i)?' SELECTED':'').'>'.$i.'</option>';
				}
                echo '</select> до <select name=max_lev class=zayavki>';
				for($i=0;$i<=33;$i++){
					echo'<option value='.$i.(($_SESSION['max_lev']==$i)?' SELECTED':'').'>'.$i.'</option>';
				}
                echo '</select> не дороже 
				<input type=text size=2 name=max_nv value="' . (($_SESSION['max_nv'] == '0') ? '' : $_SESSION['max_nv']) . '" class=LogintextBox6><b>LR</b> сортировка по 
				<select name=sorttype class=zayavki>
				<option value=1' . (($_SESSION['sorttype'] == 'level') ? ' SELECTED' : '') . '>уровню</option>
				<option value=0' . (($_SESSION['sorttype'] == 'price') ? ' SELECTED' : '') . '>стоимости</option></select>
				<input type=submit value=" ok " class=lbut>
				</font></div>
			</form></td></tr>';
		echo'
		<tr><td bgcolor=#f5f5f5 colspan=3>
		<div align=center>
			<input type="image" src="/img/image/gameplay/invent/0.gif" onclick="location=\'?weapon_category=all&ob=1\'" title="Все вещи" width="40" height="50">
			<input type="image" src="/img/image/gameplay/invent/8.gif" onclick="location=\'?weapon_category=w61&ob=1\'" title="Приманки для ботов" width="40" height="50">
			<input type="image" src="/img/image/gameplay/invent/1.gif" onclick="location=\'?weapon_category=w66&ob=1\'" title="Алхимия и травничество" width="40" height="50">
			<input type="image" src="/img/image/gameplay/invent/cat/2.gif" onclick="location=\'?weapon_category=w68&ob=1\'" title="Лесоруб" width="40" height="50">
			<input type="image" src="/img/image/gameplay/invent/2.gif" onclick="location=\'?weapon_category=w69&ob=1\'" title="Рыбалка" width="40" height="50">
			<input type="image" src="/img/image/gameplay/invent/cat/21.gif" onclick="location=\'?weapon_category=w0&ob=1\'" title="Зелья" width="40" height="50">
		</div>
		</td></tr>';
		if(isset($_GET['weapon_category']) and intval($_GET['ob'])==1){			
			$ITEMS = mysqli_query($GLOBALS['db_link'],"SELECT `rinok`.*, `items`.*
			FROM `rinok` LEFT JOIN `items` ON `rinok`.`protype` = `items`.`id`
			WHERE `items`.`dd_price`='0' AND `level`>='".$_SESSION["min_lev"]."' AND `level`<='".$_SESSION["max_lev"]."'".(($_SESSION["max_nv"]>'0')?" AND `rinok`.`sellprice`<='".$_SESSION["max_nv"]."'":"")." ".($_GET['weapon_category']=='all'?"":" AND `items`.`type`='".preg_replace('/[^w0-9]/','',$_GET["weapon_category"])."' ")." AND `rinok`.`palatka_type`='".(2)."' ORDER BY `items`.`".$_SESSION['sorttype']."` ASC");
			$num = (mysqli_num_rows($ITEMS)); 
			if($num>0){?>
				<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#e0e0e0>
                            <table cellpadding=3 cellspacing=1 border=0 width=100%>
                                <tr>
                                    <td colspan=2 bgcolor=#F9f9f9>
                                        <div align=center><font class=inv><b> У Вас с собой <?= $player['nv'] ?> LR и
                                                    вещей массой: <?= $plstt[71] ?> Максимальный вес: <?= $mass ?></b>
                                        </div>
                                    </td>
                                </tr>
				<?
				$freemass=$plstt[71];
					while ($ITEM = mysqli_fetch_assoc($ITEMS)) {
					$bt=0;$tr_b='';$par_i='';$pararr ='';$m=1;
					$pararr = itemparams(1,$ITEM,$player,$plstt,$mass);
                        $tr_b = $pararr[1][0];
                        $iz = $pararr[2];//требования
                        $bt = $pararr[1][1]; //доступность кнопок
                        $par_i = $pararr[0]; //параметры
					//==== END ====
					$ItemToOne[$ITEM['id']+$ITEM['arenda']+$ITEM['rassrok']][md5($ITEM['iznos'].'/'.$ITEM['dolg'].$ITEM['mod'].$ITEM['clan'].$ITEM['grav'].$ITEM['pl_id'].$ITEM['sellprice'])] += 1;
					if($ItemToOne[$ITEM['id']+$ITEM['arenda']+$ITEM['rassrok']][md5($ITEM['iznos'].'/'.$ITEM['dolg'].$ITEM['mod'].$ITEM['clan'].$ITEM['grav'].$ITEM['pl_id'].$ITEM['sellprice'])] == 1){
						$count = mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT `rinok`.*, `items`.* FROM `items` INNER JOIN `rinok` ON `items`.`id` = `rinok`.`protype` WHERE `pl_id`='".$ITEM['pl_id']."' and `rinok`.`used`='0' and `dolg`='".$ITEM['dolg']."' and `iznos`='".$ITEM['iznos']."' and `items`.`id`='".$ITEM['id']."' and `rinok`.`arenda`='".$ITEM['arenda']."' and `rinok`.`rassrok`='".$ITEM['rassrok']."' and `rinok`.`mod`='".$ITEM['mod']."' and `rinok`.`clan`='".$ITEM['clan']."' and `rinok`.`grav`='".$ITEM['grav']."' and `rinok`.`sellprice`='".$ITEM['sellprice']."' and `rinok`.`bank`='0' $sq $sq2;"));
					?>
					<tr><td bgcolor=#f9f9f9><div align=center><img src=/img/image/weapon/<?=$ITEM['gif']?> border=0></div></td>
					<td width=100% bgcolor=#ffffff valign=top><table cellpadding=0 cellspacing=0 border=0 width=100%>
					<tr><td bgcolor=#ffffff width=100%><font class=nickname>
					<?
					if($ITEM['pl_id']==$player['id']){?>
                        <b><input type=button class=invbut
                                  onclick="if(confirm('При отмене лота взимается комиссия 5% от цены лота. Вы уверены, что хотите отменить лот?')) { location='main.php?post_id=110&act=2&uid=<?= $ITEM['id_item'] ?>&vcode=<?= scod() ?>' }"
                                  value="Отменить продажу"></b>
					<? }	
					elseif($player['nv']>=$ITEM['sellprice'] and $m!=0){?>
                        Количество: <input type=text class=logintextbox7 name=col value=1
                                           onkeyup="writeBuy(this.value,'<?= $ITEM['id_item'] ?>','<?= scod() ?>');">&nbsp;
                        <b id="buybutton_<?= $ITEM['id_item'] ?>"><input type=button class=invbut
                                                                         onclick="location='main.php?post_id=110&act=1&col=1&uid=<?= $ITEM['id_item'] ?>&vcode=<?= scod() ?>'"
                                                                         value="Купить"></b>
					<? }?>
					<b>
					<?
                    if ($ITEM[mod_color] == 0) {
                        echo $ITEM[name] . ($ITEM[modified] == 1 ? " [ап]" : "") . "</b>";
                    }
						    else
							  {
                                  if ($ITEM[mod_color] == 1) {
                                      echo "<font color=#006600>" . $ITEM[name] . "</font> [мод]" . ($ITEM[modified] == 1 ? " [ап]" : "") . "</font></b>";
                                  }
                                  if ($ITEM[mod_color] == 2) {
                                      echo "<font color=#3333CC>" . $ITEM[name] . "</font> [мод]" . ($ITEM[modified] == 1 ? " [ап]" : "") . "</font></b>";
                                  }
                                  if ($ITEM[mod_color] == 3) {
                                      echo "<font color=#993399>" . $ITEM[name] . "</font> [мод]" . ($ITEM[modified] == 1 ? " [ап]" : "") . "</font></b>";
                                  }
	    					  }
                    echo '<font class=proceb> (в наличии: ' . $count . ') продавец: <b>' . (namebyid($ITEM['pl_id'])) . '</b></font>';
					?>
					</b>
					<font class=weaponch>
					<br><img src=/img/image/1x1.gif width=1 height=3></td>
					<td><br><img src=/img/image/1x1.gif width=1 height=3</td></tr>
					<tr><td colspan=2 width=100%><table cellpadding=0 cellspacing=0 border=0 width=100%>
                                <tr>
                                    <td bgcolor=#D8CDAF width=50%>
                                        <div align=center><font class=invtitle>свойства</div>
                                    </td>
					<td bgcolor=#B9A05C><img src=/img/image/1x1.gif width=1 height=1></td>
                                    <td bgcolor=#D8CDAF width=50%>
                                        <div align=center><font class=invtitle>требования</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td bgcolor=#FCFAF3><font class=weaponch>&nbsp;Цена:
                                            <b><? if ($ITEM['sellprice'] > $player['nv']) {
                                                    echo "<font color=#cc0000>" . $ITEM['sellprice'] . " LR</font>";
                                                } else {
                                                    echo $ITEM['sellprice'] . " LR";
                                                }
                                                echo " [ <font class=proceg>гос.цена: " . $ITEM['price'] . " LR </font>]"; ?></b><br>
                                            <? if ($ITEM['slot'] == 16) echo "<font class=weaponch><b><font color=#cc0000>Можно одевать на кольчуги</font></b><br>";
					blocks($ITEM['block']);
					echo $par_i;
					?>
					</td><td bgcolor=#B9A05C><img src=/img/image/1x1.gif width=1 height=1></td><td bgcolor=#FCFAF3>
					<font class=weaponch><?=$tr_b?>
					</font>
					</td></tr></table></td></tr></table></td></tr>
				<? }}
			}
                else {
                    echo '<table cellpadding=5 cellspacing=1 border=0 width=100% align=center><tr><td bgcolor=#F5F5F5 align=center colspan=2><font class=inv><b>Нет товаров в данной категории.' . $category . '</b></font></td></tr>';
                }
			echo '</table>';
		}
			echo'
		</table>
	<tr></td>
</table>';

}
function blocks($bl){
	if($bl!="") {
	switch($bl)
       	{
        case 40:
            echo "<font class=weaponch><b><font color=#cc0000>Блокировка 1-ой точки</font></b><br>";
            break;
        case 70:
            echo "<font class=weaponch><b><font color=#cc0000>Блокировка 2-х точек</font></b><br>";
            break;
        case 90:
            echo "<font class=weaponch><b><font color=#cc0000>Блокировка 3-х точек</font></b><br>";
            break;
    	}}}
?>
<SCRIPT language='JavaScript'>
NewLinksView();
</SCRIPT>



