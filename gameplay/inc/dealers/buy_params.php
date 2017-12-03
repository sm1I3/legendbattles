<?

		function ShowParDD($i,$par,$type){
			$fr="";	
			$str="";			
			switch($i){
				case 1: $fr="Удар:";break;
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
					//case 35: $fr="Сноровка:";break;
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
				case 53: $fr="Воровство:";break;
				case 54: $fr="Осторожность";break;
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
				case 70: $fr="Травничество:";break;
				case 71: $fr="Коэффициент(new):";break;
				case 'expbonus': $fr="Бонус опыта (в %):";break;
				case 'massbonus': $fr="Бонус массы:";break;
			}
			if($type==1 and $par and $i){
				$str = '<font class=weaponch><b>'.$fr.'</b></font>&nbsp;<select  name=pr['.$i.']>'.getOptionsSt($i).'</select><br>';
			}elseif($par and $i){
				$str = '<font class=weaponch><b>'.$fr.'</b></font>&nbsp;'.$par.'<br>';
			}			
			return $str;
		}
		function getArraySt($type){			
			$dmg = Array('0','1-1','5-5','10-10','15-15','20-20','30-30','50-50','100-100');
			$other = Array('0','1','2','3','4','5','10','25','50','75','100','150');
			if($type==1){return $dmg;}
			if($type==2){return $other;}
		}
		
		function getOptionsSt($i){
			$dmg = getArraySt(1);
			$other = getArraySt(2);
			$options = "";
			if($i==1){	
				for($b=0;$b<count($dmg);$b++){
					$options.='<option value="'.$b.'">'.$dmg[$b].'</option>';
				}
			}else{
				for($b=0;$b<count($other);$b++){
					$options.='<option value="'.$b.'">'.$other[$b].'</option>';
				}		
			}
			return $options;
		}
		
		function checkOptionsSt($i){
			$dmg = getArraySt(1);
			$other = getArraySt(2);
		}
		
		function calcParamPrice($par_arr,$type){
			$getstats = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `real_dd_adm` WHERE `id`='1' LIMIT 1;"));
			$stats = explode("|",$getstats['param_price']);
			$stats_arr = explode("|",$par_arr);			
			foreach($stats as $val){
				$param = explode("@",$val);
				$par[$param[0]] = $param[1];
			}
			foreach($stats_arr as $val_arr){
				$param_arr = explode("@",$val_arr);
				$npar[$param_arr[0]] = $param_arr[1];
			}
			$price = 0;
			for($i=1;$i<=73;$i++){
				if($i==72){$i='expbonus';}
				if($i==73){$i='massbonus';}
				if($i==1){
					//echo '<br>test-i:'.$i.'|test-par:'.$par[$i].'|test-npar:'.$npar[$i];
					$dmg = explode("-",$npar[$i]);
					if($par[$i]>0 and $dmg[0]>0){						
						$npr=$par[$i];$k=($getstats['kf']/100);
						for($b=1;$b<=$dmg[0];$b++){
							if($type!=1){$k=0.01;}
							$koeff = ($k * $b)+1;
							$nprice = round(($npr * $koeff),2);
							$price += $nprice;
						}	
					}
				}
				else{
					if($par[$i]>0 and $npar[$i]>0){
						//echo '<br>test-i:'.$i.'|test-par:'.$par[$i].'|test-npar:'.$npar[$i];
						$npr=$par[$i];$k=($getstats['kf']/100);
						for($b=1;$b<=$npar[$i];$b++){
							if($type!=1){$k=0.01;}
							$koeff = ($k * $b)+1;
							$nprice = round(($npr * $koeff),2);
							$price += $nprice;
						}						
					}
				}
				if($i=='expbonus'){$i=72;}
				if($i=='massbonus'){$i=73;}	
			}			
			return $price;
		}
		function calcNewParams($p_post,$p_user){
			$stats_post = explode("|",$p_post);
			$stats_user = explode("|",$p_user);
			
			foreach($stats_post as $val_post){
				$par_p = explode("@",$val_post);
				$par_post[$par_p[0]] = $par_p[1];
			}
			
			foreach($stats_user as $val_user){
				$par_u = explode("@",$val_user);
				$par_user[$par_u[0]] = $par_u[1];
			}
			
			$par = "";
			$par_str = "";
			for($i=1;$i<=73;$i++){				
				if($i==72){$i='expbonus';}
				if($i==73){$i='massbonus';}
				$par_str .= ShowParDD($i,$par_post[$i],0);
				if($par_post[$i] and $par_user[$i]){
					if($i==1){
						$dmg_post = explode("-",$par_post[$i]);
						$dmg_user = explode("-",$par_user[$i]);
						$par_post[$i] = $dmg_post[0];
						$par_user[$i] = $dmg_user[0];
						$par.=$i."@".($par_post[$i]+$par_user[$i])."-".($par_post[$i]+$par_user[$i])."|";
					}
					else{
						$par.=$i."@".($par_post[$i]+$par_user[$i])."|";
					}
				}else{
					if($i==1){
						$dmg_post = explode("-",$par_post[$i]);
						$dmg_user = explode("-",$par_user[$i]);
						$par_post[$i] = $dmg_post[0];
						$par_user[$i] = $dmg_user[0];
						if($par_post[$i]){
							$par.=$i."@".$par_post[$i]."-".$par_post[$i]."|";
						}elseif($par_user[$i]){
							$par.=$i."@".$par_user[$i]."-".$par_user[$i]."|";
						}
					}else{
						if($par_post[$i]){
							$par.=$i."@".$par_post[$i]."|";
						}elseif($par_user[$i]){
							$par.=$i."@".$par_user[$i]."|";
						}
					}
				}	
				if($i=='expbonus'){$i=72;}
				if($i=='massbonus'){$i=73;}
			}
			//echo '<br>TEST-post-par'.$p_post;
			//echo '<br>TEST-user-par'.$p_user;
			//echo '<br>TEST-new-par'.$par;
			$arr[0]=$par;
			$arr[1]=$par_str;			
			return $arr;
		}
if($_POST['dswi_id']){
	switch(intval($_POST['dswi_id'])){
	 case 1:
		//считаем параметры приехавшие постом
		$pr = $_POST['pr'];
		$dmg = getArraySt(1);
		$other = getArraySt(2);
		for($i=1;$i<=73;$i++){
			if($i==72){$i='expbonus';}
			if($i==73){$i='massbonus';}
			if($pr[$i]!=""){
				if($i==1 and $dmg[$pr[$i]]){$par.=$i."@".$dmg[$pr[$i]]."|";}
				elseif($other[$pr[$i]]){$par.=$i."@".$other[$pr[$i]]."|";}
			}
			if($i=='expbonus'){$i=72;}
			if($i=='massbonus'){$i=73;}	
		}
		if($par){
		switch(intval($_POST['partype'])){
			case 1: $tp=1; break;
			case 2: $tp=2; break;
			default: $tp=2; break;
		}
		//проверяем параметры пользователя
		/*$getstatsusr = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `real_dd_bonus` WHERE `pl_id`='".$player['id']."' LIMIT 1;"));
		if($getstatsusr['id']){
			if($tp==1){
				calcNewParams($par,$getstatsusr['param']);
			}
		}*/
		//считаем цену статов
		//	
		//$fullprice = calcParamPrice($par,$tp);
		//а теперь надо проверить не было ли у юзера уже что-то куплено
		$usrprice = 0; $fullprice = 0;
		$getstatsusr = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `real_dd_bonus` WHERE `pl_id`='".$player['id']."' LIMIT 1;"));
		if($getstatsusr['id']){
			if($tp==1){
				$newparams = calcNewParams($par,$getstatsusr['param']);
				$par_str = $newparams[1];
				$par_new = $newparams[0];
				$fullprice = calcParamPrice($newparams[0],$tp);
				$usrprice = calcParamPrice($getstatsusr['param'],$tp);
			}elseif($getstatsusr['param_time']>time()){
				$newparams = calcNewParams($par,$getstatsusr['param_timed']);
				$par_str = $newparams[1];
				$par_new = $newparams[0];
				$fullprice = calcParamPrice($newparams[0],$tp);
				$usrprice = calcParamPrice($getstatsusr['param_timed'],$tp);
			}else{
				$newparams = calcNewParams($par,0);
				$par_str = $newparams[1];
				$par_new = $newparams[0];
				$fullprice = calcParamPrice($newparams[0],$tp);
				$usrprice = 0;
			}
			$price = round(($fullprice - $usrprice),2);
			$str = "";
			$hash = md5($tp.$_SESSION['user']['login'].$par_new.$price.$player['dd']);
			switch($tp){
				case 1: $str = "`tmp_hash`='".$hash."'"; break;
				case 2: $str = "`tmp_time_hash`='".$hash."'"; break;
			}
			mysqli_query($GLOBALS['db_link'],"UPDATE `real_dd_bonus` SET ".$str." WHERE `pl_id`='".$player['id']."' LIMIT 1;");
			echo'
				<script>
				parent.$(\'#basic-modal-content\').html(\'<div><input type=hidden name=type id=type value="'.$tp.'"><input type=hidden name=params id=params value="'.$par_new.'"><input type=hidden name=sum id=sum value="'.$price.'"><input type=hidden name=parstr id=parstr value="'.$par_str.'">Вы получите следующие параметры:<br>'.$par_str.'<br>Цена: '.$price.' $<br><input type=button class=lbut value="Оплатить" onClick="DDAdd();"></div>\');
				parent.ShowModal();
				</script>
			';
		}else{
			$newparams = calcNewParams($par,0);
			$par_str = $newparams[1];
			$par_new = $newparams[0];
			$fullprice = calcParamPrice($newparams[0],$tp);
			$usrprice = 0;
			$price = round(($fullprice - $usrprice),2);
			$str = "";
			$hash = md5($tp.$_SESSION['user']['login'].$par_new.$price.$player['dd']);
			switch($tp){
				case 1: $str = "(`pl_id`,`param`,`tmp_hash`) VALUES ('".$player['id']."','','".$hash."')"; break;
				case 2: $str = "(`pl_id`,`param_timed`,`param_time`,`tmp_time_hash`) VALUES ('".$player['id']."','','','".$hash."')"; break;
			}
			mysqli_query($GLOBALS['db_link'],"INSERT INTO `real_dd_bonus` ".$str.";");	
			echo'
				<script>
				parent.$(\'#basic-modal-content\').html(\'<div><input type=hidden name=type id=type value="'.$tp.'"><input type=hidden name=params id=params value="'.$par_new.'"><input type=hidden name=sum id=sum value="'.$price.'"><input type=hidden name=parstr id=parstr value="'.$par_str.'">Вы получите следующие параметры:<br>'.$par_str.'<br>Цена: '.$price.' $<br><input type=button class=lbut value="Оплатить" onClick="DDAdd();"></div>\');
				parent.ShowModal();
				</script>
			';
		}	
		}	
	 break;
	}
}

$getstatsusr = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `real_dd_bonus` WHERE `pl_id`='".$player['id']."' LIMIT 1;"));
$stats_user = explode("|",$getstatsusr['param']);
foreach($stats_user as $val_user){
	$par_u = explode("@",$val_user);
	$par_user[$par_u[0]] = $par_u[1];
}
if($getstatsusr['param_time']>time()){
	$stats_user_time = explode("|",$getstatsusr['param_timed']);
	foreach($stats_user_time as $val_user_time){
		$par_u_time = explode("@",$val_user_time);
		$par_user_time[$par_u_time[0]] = $par_u_time[1];
	}
}
$getstats = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `real_dd_adm` WHERE `id`='1' LIMIT 1;"));
$stats = explode("|",$getstats['param_price']);
foreach($stats as $val){
	$param = explode("@",$val);
	$par[$param[0]] = $param[1];
}
		echo '
		<font class=proce><font color=#222222>
		<FIELDSET style="background: white;" name="field_dealers" id="field_dealers">
		<LEGEND align=center style="background: white; -moz-border-radius: 8px;-webkit-border-radius: 8px;border-radius: 8px;border: solid 1px gray;"><b> <font color=gray>У Вас с собой '.$player['baks'].' $</font> </b></LEGEND>
		<table cellpadding=0 cellspacing=0 border=0 width=100% bgcolor=#e0e0e0 align=center>
			<tr><td align=center>
				<form method=post action="?d_swi=11">
				<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
					<tr class=nickname bgcolor=#EAEAEA>
						<td align=center width=100%><b>Тут вы можете приобрести дополнительные параметры своему персонажу</b></td>
					</tr>
					<tr class=nickname bgcolor=#EAEAEA><td>Приобретенные параметры:';
					$str = "";
					for($i=1;$i<=73;$i++){
						//echo '<br>test-i:'.$i.'<br>';
						if($i==72){$i='expbonus';}
						if($i==73){$i='massbonus';}
						if(!$par_user[$i]){$par_user[$i]=0;}
						$str .= ShowParDD($i,$par_user[$i],0);
						if($i=='expbonus'){$i=72;}
						if($i=='massbonus'){$i=73;}
					}
					if($str){echo '<br>'.$str;}else{echo ' <b>Нет</b>';}
					echo'
					</td>
					</tr>
					<tr class=nickname bgcolor=#EAEAEA><td>Арендованые параметры'.($str?' (окончание аренды: <b>'.date("d.m.y",$getstatsusr['param_time']).'</b>)':'').':';
					$str = "";
					for($i=1;$i<=73;$i++){
						//echo '<br>test-i:'.$i.'<br>';
						if($i==72){$i='expbonus';}
						if($i==73){$i='massbonus';}
						if(!$par_user_time[$i]){$par_user_time[$i]=0;}
						$str .= ShowParDD($i,$par_user_time[$i],0);
						if($i=='expbonus'){$i=72;}
						if($i=='massbonus'){$i=73;}
					}
					if($str){echo '<br>'.$str;}else{echo ' <b>Нет</b>';}
					echo'
					</td>
					</tr>
					<tr class=nickname bgcolor=#EAEAEA><td align=left width=100% bgcolor=white colspan=3>
					';
				for($i=1;$i<=73;$i++){
					//echo '<br>test-i:'.$i.'<br>';
					if($i==72){$i='expbonus';}
					if($i==73){$i='massbonus';}
					if(!$par[$i]){$par[$i]=0;}
					echo ShowParDD($i,$par[$i],1);
					if($i=='expbonus'){$i=72;}
					if($i=='massbonus'){$i=73;}
				}
		echo '</td></tr>
			<tr class=nickname bgcolor=#EAEAEA>
				<td align=center width=100%>
					<input type=hidden name=dswi_id value=1>
					Тип покупки: <select name=partype>
						<option value=1>Навсегда</option>
						<option value=2>Аренда на 30 дней</option>	
					</select>
					<input class=lbut name=koeffpercent type=submit value="Посчитать">
				</td>
			</tr>
			<tr class=nickname bgcolor=#EAEAEA>
				<td align=center width=100%>
					<b>Типы покупок</b><br>
					Навсегда: <font class=proce>Покупаемые параметры будут добавлены к уже купленным.</font><br>
					Аренда 30 дней: <font class=proce>Арендуемые параметры будут добавлены к уже арендованым.<br>Если у вас уже есть арендованные параметры - время продлено не будет!</font><br>
				</td>
			</tr>
		</table></form>	

			</td></tr>
		</table>
		</FIELDSET>
		';
		
		
		
		
		
		
		
		
		
		
?>