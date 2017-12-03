<? 
//рассчитываем реферальные бонусы
$ref = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `ref_adm` WHERE `id`='1' LIMIT 1;"));
	$bonus['all'] = explode("|",$ref['bonus_all']);
	$bonus[5] = explode("|",$ref['bonus_5']);
	$bonus[10] = explode("|",$ref['bonus_10']);
	$bonus[15] = explode("|",$ref['bonus_15']);
	$LR='';$DLR='';$ACCTYPE='';$ACCTIME='';$w='';
	for($i=5;$i<=20;$i+=5){
		if($i==20){$i='all';}
		foreach($bonus[$i] as $val){
			$par = explode("@",$val);
			switch($par[0]){
				case 'LR': $LR['bonus_'.$i] = $par[1]; break;
				case 'DLR': $DLR['bonus_'.$i] = $par[1]; break;
				case 'ACCTYPE': 
					$ACCTYPE['bonus_'.$i] = $par[1];
					$w['bonus_'.$i][$par[1]] = " selected=selected";
				break;
				case 'ACCTIME': $ACCTIME['bonus_'.$i] = $par[1]; break;
			}
		}
		if($i=='all'){$i=20;}
	}		
//конец
	
echo 
'<tr><td width=100%>
<tr><td align=center><font class=weaponch>Ваша реферальная ссылка:<b> http://www.legendbattles.ru/ref.php?'.$player['login'].'</b></font><br>
<font class=proce>
<fieldset>
<LEGEND align=center><B><font color=gray>&nbsp;Ваши рефералы&nbsp;</font></B></LEGEND>
<table cellpadding=0 cellspacing=1 border=0 width=100% bgcolor=#e0e0e0 align=center>
<tr><td>
<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>';

			$i='all';
 			echo'<tr class=nickname bgcolor=#EAEAEA>
				<td colspan=7 align=center>
					<b>Бонус за каждого реферала</b>
				</td>
			</tr>
			<tr class=freetxt bgcolor=white>
				<td align=center  colspan=3>
					<b>Аккаунт:</b>
					<select name="ACCTYPE'.$i.'" DISABLED>
						<option value=0'.$w['bonus_'.$i][0].' >Нет</option>
						<option value=2'.$w['bonus_'.$i][2].' >SILVER</option>
						<option value=3'.$w['bonus_'.$i][3].' >GOLD</option>
						<option value=4'.$w['bonus_'.$i][4].' >VIP</option>
					</select> | 
					<b>Время аккаунта (дней):</b> '.$ACCTIME['bonus_'.$i].'
					'.($ACCTIME['bonus_'.$i]?'<br><font class=proce>если у вас уже есть аккаунт - он будет заменен этим!</font>':'').'
				</td>
				<td align=center colspan=2>
					';
					if($ref['items_'.$i]==''){$ref['items_'.$i]='||||';}
					if($ref['items_'.$i]!='||||'){
						echo'
						<table cellpadding=0 cellspacing=0 border=0 width=100% bgcolor=#e0e0e0 align=center>
						<tr><td>
						<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
						';
						$itemsin=explode("|",$ref['items_'.$i]);
						foreach($itemsin as $val){
							if($val!=''){
								$name=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `items`.`name`,`items`.`id`,`items`.`level` FROM `items` WHERE `id`='".$val."' LIMIT 1;"));
								echo '
								<tr class=freetxt bgcolor=white>							
									<td>
									'.$name['name'].'<a href="iteminfo.php?'.$name['name'].'" target="_blank"> ['.$name['level'].']<img src="http://img.legendbattles.ru/image/chat/info.gif" width="11" height="12" border="0"></a>							
									</td>
								</tr>';
							}
						}
						echo'
						</table>
						</td></tr>
						</table>';
					}else{echo 'Бонусные вещи: нет';}
					echo'
				</td>
				<td align=center><b>LR:</b> '.$LR['bonus_'.$i].'</td>
				<td align=center><b>DLR:</b> '.$DLR['bonus_'.$i].'</td>
			</tr>';
 
		echo'
		<tr class=nickname bgcolor=#EAEAEA>
			<td align=center width=15%><b>Приглашен</b></td>
			<td align=center><b>Имя приглашенного</b></td>
			<td align=center><b>Доступные бонусы</b></td>
			<td align=center><b>Условия для получения бонуса</b></td>
			<td align=center><b>Получить бонус</b></td>
			<td align=center><b>Получено LR</b></td>
			<td align=center><b>Получено DLR</b></td>
		</tr>';

		
		
		$refbig=0;
		$referals=mysqli_query($GLOBALS['db_link'],"SELECT * FROM `ref_system` WHERE `who_id`='".$player['id']."';");
		while($referal = mysqli_fetch_assoc($referals)){	
				//выдаем бонус за каждого реферала
					//обрабатываем получение бонуса
			$bonus_ref=0;
			$reflvl=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `user`.`id`,`user`.`level` FROM `user` WHERE `id`='".$referal['ref_id']."' LIMIT 1;"));
			if($_POST['getbonus_ref']){
				$u = intval($_POST['getbonus_ref']);
				$query ='';	$dd=''; $lr =''; $insprem='';$itnames='';$insert='';
				if($u==$reflvl['id'] and $referal['bonus']==0 and $reflvl['level']>=15){
					$b='all';
					if($ACCTYPE['bonus_'.$b] and $ACCTIME['bonus_'.$b]){
						$insprem = $ACCTYPE['bonus_'.$b]."|".(time()+($ACCTIME['bonus_'.$b]*86400));
						$insprem = "`premium`='".$insprem."',";
					}
					$dd = ($DLR['bonus_'.$b]>0?$DLR['bonus_'.$b]:0);
					$lr = ($LR['bonus_'.$b]>0?$LR['bonus_'.$b]:0);
					if($ref['items_'.$b]==''){$ref['items_'.$b]='||||';}
					if($dd or $lr or $insprem or $ref['items_'.$b]!='||||'){			
						if(mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET ".$insprem."`dd`=`dd`+'".$dd."',`nv`=`nv`+'".$lr."' WHERE `id`='".$player['id']."';") and mysqli_query($GLOBALS['db_link'],"UPDATE `ref_system` SET `bonus`='1',`bonus_dlr`=`bonus_dlr`+'".$dd."',`bonus_lr`=`bonus_lr`+'".$lr."' WHERE `who_id`='".$player['id']."' AND `ref_id`='".$referal['ref_id']."' LIMIT 1;")){
							$referal['bonus']=1;
							$referal['bonus_lr']+=$lr;
							$referal['bonus_dlr']+=$dd;							
							$ms="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><font color=#000000><b>Системная информация.</b></font> Вы получили бонус за реферала <b>".$referal['ref_login']."</b>:</font><BR>'+'');";
							chmsg($ms,$player['login']);
							if($dd){
								$ms="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><font color=#000000><b>Системная информация.</b></font> DLR: <b>".$dd."<b></font><BR>'+'');";
								chmsg($ms,$player['login']);
							}
							if($lr){
								$ms="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><font color=#000000><b>Системная информация.</b></font> LR: <b>".$lr."</b></font><BR>'+'');";
								chmsg($ms,$player['login']);
							}
							if($insprem){
								switch($ACCTYPE['bonus_'.$b]){
									case 2: $msg = "SILVER аккаунт на ".$ACCTIME['bonus_'.$b]." дней"; break;
									case 3: $msg = "GOLD аккаунт на ".$ACCTIME['bonus_'.$b]." дней"; break;
									case 4: $msg = "VIP аккаунт на ".$ACCTIME['bonus_'.$b]." дней"; break;
								}
								$ms="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><font color=#000000><b>Системная информация.</b></font> ".$msg."</font><BR>'+'');";
								chmsg($ms,$player['login']);
							}
							//выдаем вещи если таковые есть
							if($ref['items_'.$b]!='||||'){
								$itemsin=explode("|",$ref['items_'.$b]);
								foreach($itemsin as $val){
									if($val!=''){
										$IT=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE `id`='".$val."' LIMIT 1;"));
										$pr=explode("|",$IT['param']);
										foreach ($pr as $value) {$stat=explode("@",$value);switch($stat[0]){case 2: $dolg=$stat[1];break;}}				
										$insert.="('".$IT['id']."','".$player['id']."','".$dolg."','".$IT['price']."'),";
										$itnames[] = $IT['name'];
									}
								}
								if($insert){
									$insert=substr($insert,0,strlen($insert)-1);
									mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype`,`pl_id`,`dolg`,`price`) VALUES ".$insert.";");
									for($i=0;$i<count($itnames);$i++){
										$msg='Получено: <b>'.$itnames[$i].'</b>';
										$ms="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><font color=#000000><b>Системная информация.</b></font> ".$msg."</font><BR>'+'');";
										chmsg($ms,$player['login']);
									}						
								}					
							}
						}
					}
				}
			}
			//
					//
			if($reflvl['level']>=15){
				$refbig++;
				if($referal['bonus']==0){$bonus_ref=1;}
				if($referal['bonus']==1){$bonus_ref=2;}
			}			
			echo '
			<tr class=nickname bgcolor=white>
			<td align=center>'.date("Y.m.d",$referal['time']).'</td>
			<td align=center><b>'.$referal['ref_login'].'</b>['.$reflvl['level'].']<a href="/ipers.php?'.$referal['ref_login'].'" target="_blank"><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0" ></a></td>
			<td align=center>'.($bonus_ref==1?'<font color=green><b>есть</b></font>':($bonus_ref==2?'<font class="klbut" style="cursor: default;">Бонус получен!</font>':'<font color=red><b>отсутствуют</b></font>')).'</td>
			<td align=center><b>'.($bonus_ref?'<font color=green><b>Получение рефералом 15 уровня</b></font>':'<font color=red><b>Получение рефералом 15 уровня</b></font>').'</b></td>
			<td align=center><b>';
			if($bonus_ref){
				if($bonus_ref==1){
					echo'	
						<form method=post>
							<input type=hidden name="getbonus_ref" value="'.$reflvl['id'].'">
							<input type=submit class="lbut" value="ПОЛУЧИТЬ">
						</form>';
				}elseif($bonus_ref==2){
					echo'<font class="klbut" style="cursor: default;">Бонус получен!</font>';
				}	
			}else{echo'<font color=red><b>недоступно</b></font>';}			
			echo'</b></td>
			<td align=center><b>'.$referal['bonus_lr'].'</b></td>
			<td align=center><b>'.$referal['bonus_dlr'].'</b></td>
			';
		}
echo'</table></td></tr></table><br>
</fieldset>
</td></tr>
';
//проверяем количество рефералов 15+ уровня
$ref_bonus[5] = 'DISABLED';
$ref_bonus[10] = 'DISABLED';
$ref_bonus[15] = 'DISABLED';

//обрабатываем получение бонуса
if($_POST['getbonus']){
	$b = intval($_POST['getbonus']);
	$query ='';	$dd=''; $lr =''; $insprem='';$itnames='';$insert='';
	if(($b==5 or $b==10 or $b==15) and $player['ref_bonus_'.$b] == 0 and $refbig>=$b){
		if($ACCTYPE['bonus_'.$b] and $ACCTIME['bonus_'.$b]){
			$insprem = $ACCTYPE['bonus_'.$b]."|".(time()+($ACCTIME['bonus_'.$b]*86400));
			$insprem = "`premium`='".$insprem."',";
		}
		$dd = ($DLR['bonus_'.$b]>0?$DLR['bonus_'.$b]:0);
		$lr = ($LR['bonus_'.$b]>0?$LR['bonus_'.$b]:0);
		if($ref['items_'.$b]==''){$ref['items_'.$b]='||||';}
		if($dd or $lr or $insprem or $ref['items_'.$b]!='||||'){			
			if(mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET ".$insprem."`dd`=`dd`+'".$dd."',`nv`=`nv`+'".$lr."',`ref_bonus_".$b."`='1' WHERE `id`='".$player['id']."';")){
				$player['ref_bonus_'.$b] = 1;				
				$ms="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><font color=#000000><b>Системная информация.</b></font> Вы получили бонус за ".$b." рефералов:</font><BR>'+'');";
				chmsg($ms,$player['login']);
				if($dd){
					$ms="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><font color=#000000><b>Системная информация.</b></font> DLR: <b>".$dd."<b></font><BR>'+'');";
					chmsg($ms,$player['login']);
				}
				if($lr){
					$ms="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><font color=#000000><b>Системная информация.</b></font> LR: <b>".$lr."</b></font><BR>'+'');";
					chmsg($ms,$player['login']);
				}
				if($insprem){
					switch($ACCTYPE['bonus_'.$b]){
						case 2: $msg = "SILVER аккаунт на ".$ACCTIME['bonus_'.$b]." дней"; break;
						case 3: $msg = "GOLD аккаунт на ".$ACCTIME['bonus_'.$b]." дней"; break;
						case 4: $msg = "VIP аккаунт на ".$ACCTIME['bonus_'.$b]." дней"; break;
					}
					$ms="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><font color=#000000><b>Системная информация.</b></font> ".$msg."</font><BR>'+'');";
					chmsg($ms,$player['login']);
				}
				//выдаем вещи если таковые есть
				if($ref['items_'.$b]!='||||'){
					$itemsin=explode("|",$ref['items_'.$b]);
					foreach($itemsin as $val){
						if($val!=''){
							$IT=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE `id`='".$val."' LIMIT 1;"));
							$pr=explode("|",$IT['param']);
							foreach ($pr as $value) {$stat=explode("@",$value);switch($stat[0]){case 2: $dolg=$stat[1];break;}}				
							$insert.="('".$IT['id']."','".$player['id']."','".$dolg."','".$IT['price']."'),";
							$itnames[] = $IT['name'];
						}
					}
					if($insert){
						$insert=substr($insert,0,strlen($insert)-1);
						mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype`,`pl_id`,`dolg`,`price`) VALUES ".$insert.";");
						for($i=0;$i<count($itnames);$i++){
							$msg='Получено: <b>'.$itnames[$i].'</b>';
							$ms="parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."&nbsp;</font> <font color=000000><font color=#000000><b>Системная информация.</b></font> ".$msg."</font><BR>'+'');";
							chmsg($ms,$player['login']);
						}						
					}					
				}
			}
		}
	}
}
//

if($refbig>=15){
	if($player['ref_bonus_15']==0){
		$ref_bonus[15] = '';
	}
	if($player['ref_bonus_10']==0){
		$ref_bonus[10] = '';
	}
	if($player['ref_bonus_5']==0){
		$ref_bonus[5] = '';
	}	
}
elseif($refbig>=10){
	if($player['ref_bonus_10']==0){
		$ref_bonus[10] = '';
	}
	if($player['ref_bonus_5']==0){
		$ref_bonus[5] = '';
	}
}
elseif($refbig>=5){
	if($player['ref_bonus_5']==0){
		$ref_bonus[5] = '';
	}
}



echo'
		<tr><td width=100%>
		<fieldset>
		<LEGEND align=center><B><font class=nickname style="color:gray;">&nbsp;Дополнительные бонусы&nbsp;</font></B></LEGEND>
			<table cellpadding=0 cellspacing=0 border=0 width=100% bgcolor=#e0e0e0 align=center>
			<tr><td>
			<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
				<tr class=nickname bgcolor=#EAEAEA>
					<td align=center width=20%><b>Бонус за получение уровня рефералом</b></td>
					<td align=center width=20%><b>Бонус за 5 рефералов</b><br><font class=proceb style="font-size: 9px;">при достижении каждым 15 уровня</font></td>
					<td align=center width=20%><b>Бонус за 10 рефералов</b><br><font class=proceb style="font-size: 9px;">при достижении каждым 15 уровня</font></td>
					<td align=center width=20%><b>Бонус за 15 рефералов</b><br><font class=proceb style="font-size: 9px;">при достижении каждым 15 уровня</font></td>
				</tr>';
				echo'
				<tr class=freetxt bgcolor=white>
				<td align=center width=20%>
					<b>Бонус:</b> '.$ref['money_bonus'].'%<br>
					от полученных LR за уровень<br>
					<font class=proce>выдается автоматом при получении рефералом уровня.</font>				
				</td>';
				for($i=5;$i<=15;$i+=5){
					echo'
					<td align=center  width=20%>
						<b>Аккаунт:</b>
						<select name="ACCTYPE'.$i.'" DISABLED>
							<option value=0'.$w['bonus_'.$i][0].' >Нет</option>
							<option value=2'.$w['bonus_'.$i][2].' >SILVER</option>
							<option value=3'.$w['bonus_'.$i][3].' >GOLD</option>
							<option value=4'.$w['bonus_'.$i][4].' >VIP</option>
						</select><br>
						<b>Время аккаунта (дней):</b> '.$ACCTIME['bonus_'.$i].'<br>
						<font class=proce>если у вас уже есть аккаунт - он будет заменен этим!</font><br>
						-----------------------------<br>
						<b>DLR:</b> '.$DLR['bonus_'.$i].'<br><b>LR:</b> '.$LR['bonus_'.$i].'<br>
						';
						if($ref['items_'.$i]==''){$ref['items_'.$i]='||||';}
						if($ref['items_'.$i]!='||||' and $player['ref_bonus_'.$i]==0){
						echo'
						<table cellpadding=0 cellspacing=0 border=0 width=100% bgcolor=#e0e0e0 align=center>
						<tr><td align=center>
						<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
						';
						$itemsin=explode("|",$ref['items_'.$i]);
						foreach($itemsin as $val){
							if($val!=''){
								$name=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `items`.`name`,`items`.`id`,`items`.`level` FROM `items` WHERE `id`='".$val."' LIMIT 1;"));
								echo '
								<tr class=freetxt bgcolor=white >							
									<td align=center>
									'.$name['name'].'<a href="iteminfo.php?'.$name['name'].'" target="_blank"> ['.$name['level'].']<img src="http://img.legendbattles.ru/image/chat/info.gif" width="11" height="12" border="0"></a>							
									</td>
								</tr>';
							}
						}
						echo'
						</table>
						</td></tr>
						</table>';
					}else{echo 'Бонусные вещи: нет<br>';}
						if($player['ref_bonus_'.$i]==0){
							echo'	
							<form method=post>
								<input type=hidden name="getbonus" value="'.$i.'">
								<input type=submit class="'.($ref_bonus[$i]=='DISABLED'?'weaponchdis':'lbut').'" value="ПОЛУЧИТЬ БОНУС" '.$ref_bonus[$i].'>
							</form>';
						}else{
							echo'<font class="klbut" style="cursor: default;">Бонус получен!</font>';
						}						
						echo'						
					</td>';
				}
				echo'
			</tr>
			<tr>
				<td width=100% align=center bgcolor=#EAEAEA colspan=4>
					<font class=proceb style="font-size: 16px;"><b>Бонус:</b>&nbsp;<font class=proce style="font-size: 16px;"><b>'.$ref['money_dlr_bonus'].'%</b></font>&nbsp;от купленных рефералом DLR (Средства будут зачислены Вам автоматически.)</font>
				</td>
			</tr>
			</table>
		</td></tr></table></fieldset></td></tr>
		<tr><td width=100%>
		<fieldset>
		<LEGEND align=center><B><font class=nickname style="color:gray;">&nbsp;Бонусы вашему рефералу&nbsp;</font></B></LEGEND>
		<table cellpadding=0 cellspacing=0 border=0 width=100% bgcolor=#e0e0e0 align=center>
			<tr><td>
			<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>';
				echo'
				<tr class=nickname bgcolor=#EAEAEA>
					<td colspan=7 align=center>
						<b>Ваш реферал получит</b>
					</td>					
				</tr>
				<tr>
				<td align=center bgcolor=white>
					';
					$i='ref';
					if($ref['items_'.$i]==''){$ref['items_'.$i]='||||';}
					if($ref['items_'.$i]!='||||'){
						echo'
						<table cellpadding=0 cellspacing=0 border=0 width=100% bgcolor=#e0e0e0 align=center>
						<tr><td>
						<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
						';
						$itemsin=explode("|",$ref['items_'.$i]);
						foreach($itemsin as $val){
							if($val!=''){
								$name=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `items`.`name`,`items`.`id`,`items`.`level` FROM `items` WHERE `id`='".$val."' LIMIT 1;"));
								echo '
								<tr class=freetxt bgcolor=white>							
									<td>
									'.$name['name'].'<a href="iteminfo.php?'.$name['name'].'" target="_blank"> ['.$name['level'].']<img src="http://img.legendbattles.ru/image/chat/info.gif" width="11" height="12" border="0"></a> (<font class=proceb>срок годности: 30 дней</font>)							
									</td>
								</tr>';
							}
						}
						echo'
						</table>
						</td></tr>
						</table>';
					}else{echo 'Бонусные вещи: нет';}
					echo'
				</td>
				</tr>
			</table>	
			</td></tr>
		</table></fieldset></td></tr>
		';	

?>