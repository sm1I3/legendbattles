<LINK href="/css/stl.css" rel="STYLESHEET" type="text/css">
<?
if(isset($_POST['lic'])){
	$check = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE `type`='w30' AND `id`='".intval($_POST['lic'])."' LIMIT 1;"));
	$check2 = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `meria` WHERE `uid`='".$player['id']."' LIMIT 1;"));
	if($check['id'] and !($check2['id'])){
		if(mysqli_query($GLOBALS['db_link'],"INSERT INTO `meria` (`uid`,`itemid`) VALUES ('".$player['id']."','".$check['id']."');")){
            $msg = '<font class=proceg>Заявка подана.</font>';
		}
	} elseif ($check2['id']) {
        $msg = '<font class=proce><b>Вы уже подавали заявку на выдачу лицензии.</b></font>';
    }
}
if (isset($_POST['fcheck']) and ($player['clan'] == 'Life' or $player['clan'] == 'Мэрия города')) {
	switch($_POST['fcheck']){
	 case 0:
		$check = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `meria` WHERE `id`='".intval($_POST['zay'])."' LIMIT 1;"));
         if ($check['id']) {
             mysqli_query($GLOBALS['db_link'], "DELETE FROM `meria` WHERE `id`='" . $check['id'] . "';");
             $msg = '<font class=proceg>Заявка удалена.</font>';
         }
	 break;
	 case 1:
		$check = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `meria` WHERE `id`='".intval($_POST['zay'])."' LIMIT 1;"));
		if($check['id']){
			$lcount = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `meria_items` WHERE `clan`='meria' LIMIT 1;"));
			if($lcount['licens']>0){
				$check2 = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `id`,`login`,`nv` FROM `user` WHERE `id`='".$check['uid']."' LIMIT 1;"));
				$check3 = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE `id`='".intval($check['itemid'])."' LIMIT 1;"));
				if($check2['nv']>=$check3['price'] and $check3['dd_price']==0){
					$pr=explode("|",$check3['param']);
					foreach ($pr as $value) {
					$stat=explode("@",$value);
					switch($stat[0]){case 2: $dolg=$stat[1];break;}}
                    mysqli_query($GLOBALS['db_link'], 'INSERT INTO invent (protype,pl_id,dolg,price) VALUES (' . AP . $check3['id'] . AP . ',' . AP . $check2['id'] . AP . ',' . AP . $dolg . AP . ',' . AP . $check3['price'] . AP . ');');
                    mysqli_query($GLOBALS['db_link'], 'UPDATE user SET nv=nv-' . AP . $check3['price'] . AP . ' WHERE id=' . AP . $check2['id'] . AP . 'LIMIT 1;');
					mysqli_query($GLOBALS['db_link'],"UPDATE `meria_items` SET `licens`=`licens`-'1' WHERE `clan`='meria' LIMIT 1;");
					mysqli_query($GLOBALS['db_link'],"DELETE FROM `meria` WHERE `id`='".$check['id']."';");
                    $msg = '<font class=proceg>Лицензия выдана. Заявка удалена.</font>';
				}
			}
		}
	 break;	 
	}
}
if (isset($_POST['load']) and ($player['clan'] == 'Life' or $player['clan'] == 'Мэрия города')) {
		$check = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `market` WHERE `id`='".intval($_POST['zay'])."' LIMIT 1;"));
		if($check['id']){
			$lcount = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `meria_items` WHERE `clan`='meria' LIMIT 1;"));
			if($lcount['items']>10){
				mysqli_query($GLOBALS['db_link'],"UPDATE `market` SET `kol`=`kol`+'1000' WHERE `id`='".intval($_POST['zay'])."' LIMIT 1;");
				mysqli_query($GLOBALS['db_link'],"UPDATE `meria_items` SET `items`=`items`-'10' WHERE `clan`='meria' LIMIT 1;");
                $msg = '<font class=proceg>Завоз произведен успешно.</font>';
			}
		}
}
if($msg){
echo "<SCRIPT>MessBoxDiv('".$msg."',0,0,0,0);</SCRIPT>";
}
?>
<table cellpadding=0 cellspacing=0 border=0 align=center width=760>
<tr><td><img src=/img/image/1x1.gif width=1 height=10><br></td></tr>
<tr><td>
<table cellpadding=0 cellspacing=0 border=0 align=center width=100%>
<tr><td colspan=4><?$locname = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `loc` WHERE `id`='".$player['loc']."' LIMIT 1;"));?><fieldset><legend align="center"><b><font color="gray"><?=$locname['loc'];?></font></b></legend><img src=/img/image/gameplay/ci_m.jpg width=760 height=255 border=0></fieldset></td></tr>
<tr><td bgcolor=#cccccc>
	<table cellpadding=5 cellspacing=1 border=0 align=center width=100%>
	<tr>
        <td width="25%" bgcolor="#f5f5f5" align="center"><a href="#" onClick="location='?weapon_category=1'"
                                                            title=""><font class="zaya"><b>Заявка на Лицензию</b></font></a>
        </td>
        <td width="25%" bgcolor="#f5f5f5" align="center"><a href="#" onClick="location='?weapon_category=2'"
                                                            title=""><font class="zaya" style="color: red;"><b>Заявка на
                        Пропуск</b></font></a></td>
        <td width="25%" bgcolor="#f5f5f5" align="center"><a href="#" onClick="location='?weapon_category=3'"
                                                            title=""><font class="zaya"><b>Просмотр Лицензий и
                        пропусков</b></font></a></td>
        <td width="25%" bgcolor="#f5f5f5" align="center"><a href="#" onClick="location='?weapon_category=4'"
                                                            title=""><font class="zaya"><b>Регистрация
                        бракосочетаний</b></font></a></td>
	</tr>
        <? if ($player['clan'] == 'Life' or $player['clan'] == 'Мэрия города') { ?>
            <tr>
                <td bgcolor="#f5f5f5" align="center" colspan=4><font class=proceg><b>только для сотрудников
                            мэрии</b></font></td>
            </tr>
	<tr>
        <td width="25%" bgcolor="#f5f5f5" align="center"><a href="#" onClick="location='?adm_category=1'" title=""><font
                        class="zaya"><b>Выдача лицензий</b></font></a></td>
        <td width="25%" bgcolor="#f5f5f5" align="center"><a href="#" onClick="location='?adm_category=2'" title=""><font
                        class="zaya"><b>Контроль товара в магазинах</b></font></a></td>
        <td width="25%" bgcolor="#f5f5f5" align="center"><a href="#" onClick="location='?adm_category=3'" title=""><font
                        class="zaya"><b>Состав мэрии</b></font></a></td>
        <td width="25%" bgcolor="#f5f5f5" align="center"><a href="#" onClick="location='?adm_category=4'" title=""><font
                        class="zaya" style="color: red;"><b>Заявки на бракосочетание</b></font></a></td>
	</tr>
	<?}?>
	</table>
</tr></td>	
<tr><td bgcolor=#cccccc colspan=4>
<?
$ITEMS = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE `type`='w30' and `acte`!='teleport' ORDER BY `name` DESC;");
if ($player['clan'] == 'Life' or $player['clan'] == 'Мэрия города') {
	function loginbyid($id){
		$check = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `id`,`login` FROM `user` WHERE `id`='".intval($id)."' LIMIT 1;"));
		if($check['login']){return $check['login'];} else {
            return 'Игрок не найден';
        }
	}
	function licinfo($id){
		$check = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `id`,`name`,`price` FROM `items` WHERE `id`='".intval($id)."' LIMIT 1;"));
		if($check['name']){return $check;} else {
            return 'Лицензия не найдена';
        }
	}
	$lcount = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `meria_items` WHERE `clan`='meria' LIMIT 1;"));
	$zayavki = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `meria` WHERE `status`='0';");
	switch($_GET['adm_category']){
	 case 1:
			echo'
			<table cellpadding=0 cellspacing=0 border=0 width=100% bgcolor=#e0e0e0>
			<tr><td>
			<table cellpadding=3 cellspacing=1 border=0 width=100%>
			<tr bgcolor=white><td align=center width=100% colspan=5><b><font class=proceb>Лицензий в наличии:</font> <b><font class=proce' . ($lcount['licens'] > 0 ? 'g' : '') . '>' . $lcount['licens'] . '</font></b></td></tr>
			<tr bgcolor=white>
				<td align=center class=nickname2 width=20%><font class=nickname><b>Ник персонажа</b></font></td>
				<td align=center class=nickname2 width=40%><font class=nickname><b>Название лицензии</b></font></td>
				<td align=center class=nickname2 width=10%><font class=nickname><b>Цена лицензии</b></font></td>
				<td align=center class=nickname2 width=30% colspan=2><b>Опции</b></td>
			</tr>';	
			$i=0;
			$num = mysqli_num_rows($zayavki);
			if($num<=0){
                echo '<tr bgcolor=white><td align=center width=100% colspan=5><b><font class=proceb>Заявок не найдено.</font></b></td></tr>';
			}
			else{
				while($r = mysqli_fetch_assoc($zayavki)){
					$lic = licinfo($r['itemid']);
					$licuser = loginbyid($r['uid']);
					if($i==1){echo '</tr>';$i=0;}
					if($i==0){echo '<tr>';}
					$i++;
					echo'
					<td bgcolor=white align=center><font class=nickname><b>'.$licuser.'<a href="/ipers.php?'.$licuser.'" target="_blank"><img src="/img/image/chat/info.gif" width="11" height="12" border="0" align="absmiddle"></a></b></font></td>
					<td bgcolor=white align=center><font class=nickname>'.$lic['name'].'</font></td>
					<td bgcolor=white align=center><font class=nickname>'.$lic['price'].' LR</font></td>
					<td bgcolor=white align=center>
						<form method=post><input type=hidden name=fcheck value=1><input type=hidden name=zay value="' . $r['id'] . '"><input type=submit class=klbut value="Принять" style="' . ($lcount['licens'] > 0 ? '' : 'color:gray;') . 'background: none;" ' . ($lcount['licens'] > 0 ? '' : 'DISABLED') . '></form>
					</td>
					<td bgcolor=white align=center>
						<form method=post><input type=hidden name=fcheck value=0><input type=hidden name=zay value="' . $r['id'] . '"><input type=submit class=klbut value="Отказать" style="color: red; background: none;"></form>
					</td>
					';
				}
				for($b=$i;$b<1;$b++){
					echo '<td bgcolor=#f9f9f9 width=25%>&nbsp;</td>';
				}
				echo'
				</tr></table>';
			}
	 break;
	 case 2:
		$ITEMS = mysqli_query($GLOBALS['db_link'],"SELECT market.*, items.* FROM market LEFT JOIN items ON market.id = items.id WHERE items.dd_price=0 AND (market='45' OR market='51' OR market='50' OR market='49') AND items.type!='w30' ORDER BY market,type,num_a");
	 	echo'
			<table cellpadding=0 cellspacing=0 border=0 width=100% bgcolor=#e0e0e0>
			<tr><td>
			<table cellpadding=3 cellspacing=1 border=0 width=100%>
			<tr bgcolor=white><td align=center width=100% colspan=5><b><font class=proceb>Количество завозов (1000шт за завоз):</font> <b><font class=proce' . ($lcount['items'] > 0 ? 'g' : '') . '>' . $lcount['items'] . '</font><font class=proce> [ -10 за 1 завоз ]</font></b></td></tr>
			<tr bgcolor=white>
				<td align=center class=nickname2 width=20%><font class=nickname><b>Магазин</b></font></td>
				<td align=center class=nickname2 width=40%><font class=nickname><b>Товар</b></font></td>
				<td align=center class=nickname2 width=10%><font class=nickname><b>Количество</b></font></td>
				<td align=center class=nickname2 width=30% colspan=2><b>Опции</b></td>
		</tr>';	
		$i=0;
		function nameloc($id){
			$check = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `loc` WHERE `id`='".intval($id)."' LIMIT 1;"));
			if($check['loc']){return $check['loc'];}
		}
		while($r = mysqli_fetch_assoc($ITEMS)){
					if($i==1){echo '</tr>';$i=0;}
					if($i==0){echo '<tr>';}
					$i++;
					echo'
					<td bgcolor=white align=center><font class=nickname><b>'.nameloc($r['market']).'</b></font></td>
					<td bgcolor=white align=center><font class=nickname>'.$r['name'].'</font></td>
					<td bgcolor=white align=center><font class=nickname>'.$r['kol'].'</font></td>
					<td bgcolor=white align=center>
						<form method=post><input type=hidden name=load value=1><input type=hidden name=zay value="' . $r['id'] . '"><input type=submit class=klbut value="Завезти" style="' . ($lcount['items'] > 0 ? '' : 'color:gray;') . 'background: none;" ' . ($lcount['items'] > 0 ? '' : 'DISABLED') . '></form>
					</td>
					';
				}
				for($b=$i;$b<1;$b++){
					echo '<td bgcolor=#f9f9f9 width=25%>&nbsp;</td>';
				}
				echo'
	</tr></table>';
	 break;
	}
}
switch($_GET['weapon_category']){
case 1:
	echo'
	<table cellpadding=15 cellspacing=1 border=0 align=center width=100%>
	<tr>
	<td width="100%" bgcolor="white" align="left">
	<font class=nickname>

	Чтобы получить лицензию на торговлю/докторство, необходимо заполнить <i>заявку</i>, заявка будет обработана сотрудниками <b>Мэрии</b> и при её обработке и одобрении,
	будет из вашего счета извлеченна сумма стоимости лицензии и в инвентарь помещена сама лицензия, где вы её сможете активировать. (в инвентаре может быть только одна лицензия одного типа)

	<br><br>Заявка для получения лицензии: <br><br>
	<form method=post>
		<table cellpadding=0 cellspacing=0 border=0 align=center width=100%>
			<tr><td width=33%>
			<font class=nickname><b>Выберите лицензию:</b></font>
			<select name=lic>
			<option value=0>Лицензия не выбрана</option>
			';
			while($lic = mysqli_fetch_assoc($ITEMS)){
				echo '<option value="'.$lic['id'].'">'.$lic['name'].'</option>';
			}
			echo'
			</select>
			<input type=submit class=lbut value="Подать заявку" >
		</tr></td></table>                 
	</form>                                          
	<br><font class=proce><b>Название лицензий, вы можете посмотреть в разделе “<i>Просмотр Лицензий и пропусков</i>”</b></font>
	<br><font class=proce><b>Количество дней и цен на лицензии указаны так же, в “<i>Просмотр Лицензий и пропусков</i>”</b></font>
	</font>
	</tr></td></table>
	';
break;
case 2:
	echo'
	<table cellpadding=15 cellspacing=1 border=0 align=center width=100%>
	<tr>
	<td width="100%" bgcolor="white" align="left">
	<font class=nickname>
	<div align=center><font class=proce>Временно недоступно.</font></div>
	</font>
	</tr></td></table>
	';
break;
case 3:
	echo'
	<table cellpadding=5 cellspacing=1 border=0 align=center width=100%>';
	$i=0;
	while($ITEM = mysqli_fetch_assoc($ITEMS)){	
			$bt=0;$tr_b='';$par_i='';$pararr ='';$m=1;
			$pararr = itemparams(0,$ITEM,$player,$plstt,$mass);
        $tr_b = $pararr[1][0];
        $iz = $pararr[2];//требования
        $bt = $pararr[1][1]; //доступность кнопок
        $par_i = $pararr[0]; //параметры
			if($i==2){echo '</tr>';$i=0;}
			if($i==0){echo '<tr>';}
			$i++;
			echo'<td bgcolor=#f9f9f9 width=50%>		
			<div align=center><font class=weaponch><b>'.$ITEM['name'].'</b></font></div>
			<div align=center><img src=/img/image/weapon/'.$ITEM['gif'].' border=0></div>
			<div align=center>
			<font class=weaponch>&nbsp;Цена: <b>';
			if($ITEM['dd_price']==0){
			 if($ITEM['price']>$player['nv']){echo "<font color=#cc0000>".$ITEM['price']." LR</font>";}else{echo $ITEM['price']." LR";}
			}
			else{
			if($ITEM['dd_price']>$player['baks']){echo '<font color=#cc0000>'.$ITEM['dd_price'].' $</font>';}else{echo ''.$ITEM['dd_price'].' $';}
			}		
			echo'
			</b>			
			</div>
			<div align=center>'.$tr_b.'</div>
			</td>';

	}
	echo'</tr></table>';
break;
}

?>

	</table>
</tr></td>	
</td></tr>
</table>
</td></tr>
</table>
<SCRIPT language='JavaScript'>
NewLinksView();
</SCRIPT>