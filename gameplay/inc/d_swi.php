<? 
if($_GET['grav'] and $_POST['item']){
	if($_POST['grav']){
		$name=trim($_POST['grav']);
		$name=addslashes($name);
		if(strlen($name) > 30){
			$name = substr($name,0,30);
		}
		$name=trim($name);
		$err=0;
		if (testchr($name) == 1){$message="<font style=\"color:red;\" class=nickname2><b>гравировка содержит недопустимые символы.</b></font>";$err=1;}
		else if($name == ''){$message="<font style=\"color:red;\" class=nickname2><b>гравировка не может состоять только из пробелов.</b></font>";$err=1;}
		else if($err == 0){
			$dditems=mysqli_query($GLOBALS['db_link'],'SELECT `invent`.*,`items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `invent`.`pl_id`="'.$player['id'].'" AND `items`.`dd_price`>"0" AND `invent`.`bank`="0" AND `invent`.`id_item`="'.intval($_POST['item']).'" LIMIT 1;');
			if(mysqli_num_rows($dditems)>0){
				if($player['baks']>=5){
					if(mysqli_query($GLOBALS['db_link'],"UPDATE `invent` SET `grav`='".$name."' WHERE `id_item`='".intval($_POST['item'])."' AND `pl_id`='".$player['id']."' LIMIT 1;") and mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `baks`=`baks`-'5' WHERE `id`='".$player['id']."' LIMIT 1;")){
						$message="<font style=\"color:#006600;\" class=nickname2><b>Гравировка выполнена.</b></font>";
					}else{$message="<font style=\"color:red;\" class=nickname2><b>Гравировка не выполнена.</b></font>";}
				}else{$message="<font style=\"color:red;\" class=nickname2><b>Гравировка не выполнена. Недостаточно денег.</b></font>";}
			}else{$message="<font style=\"color:red;\" class=nickname2><b>Гравировка не выполнена. Вещь не найдена.</b></font>";}
		}
	}
	/* Стираем гравировку, временно отключено
	
	else{
		$dditems=mysqli_query($GLOBALS['db_link'],'SELECT `invent`.*,`items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `invent`.`pl_id`="'.$player['id'].'" AND `items`.`dd_price`>"0" AND `invent`.`bank`="0" AND `invent`.`id_item`="'.intval($_POST['item']).'" LIMIT 1;');
		if(mysqli_num_rows($dditems)>0){
			if(mysqli_query($GLOBALS['db_link'],"UPDATE `invent` SET `grav`='0' WHERE `id_item`='".intval($_POST['item'])."' AND `pl_id`='".$player['id']."' LIMIT 1;")){
				$message="<font style=\"color:#006600;\" class=nickname2><b>Гравировка стерта.</b></font>";
			}else{$message="<font style=\"color:red;\" class=nickname2><b>Гравировка не стерта. Вещь не найдена.</b></font>";}
		}
	}	*/
}
if($_POST['colorchange']==1){
	if($_POST['font_nick']!='none'){
		$font = varcheck($_POST['font_nick']);
		if(strlen($font)==6){			
			switch(intval($_POST['buytype'])){
				case 1: break;
				case 2: 
					if($player['baks']>=9){
						mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `fcolor`='".$font."',`fcolor_time`='".(time()+2592000)."',`baks`=`baks`-'9' WHERE `id`='".$player['id']."' LIMIT 1;");
						echo
						'
						<script>	
							parent.$(\'#basic-modal-content\').html("Новый цвет ника: <font class=nickname style=\'color: #'.$font.'\'><b>'.$player['login'].'</b></font>.");
							parent.ShowModal();
						</script>
						';
					}					
				break;
				case 3:
					if($player['baks']>=99){
						mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `fcolor`='".$font."',`fcolor_time`='0',`baks`=`baks`-'99' WHERE `id`='".$player['id']."' LIMIT 1;");
						echo
						'
						<script>	
							parent.$(\'#basic-modal-content\').html("Новый цвет ника: <font class=nickname style=\'color: #'.$font.'\'><b>'.$player['login'].'</b></font>.");
							parent.ShowModal();
						</script>
						';
					}
				break;
			}
		}
	}
}
echo'<script language=Javascript src="../../../js/create_art.js"> </script><SCRIPT src="./js/transfer.js"></SCRIPT>';
echo '
	<font class=proce><font color=#FF9933>
	<FIELDSET style="background: white;">
	<LEGEND style="background: white; -moz-border-radius: 8px;-webkit-border-radius: 8px;border-radius: 8px;border: solid 1px gray;" align=center><B><font color=#00EE55>&nbsp;Раздел: Общая информация&nbsp;</font></B></LEGEND>
		<table cellpadding=10 cellspacing=0 border=0 width=100%>
			<tr><td class=nickname2 align=center><p><b>
                <a  href="?d_swi=901" class=nickname2><font  color=#9966BB>Найти информацию об индивидуальных Артефактах</font></a><br>
				<a  href="?d_swi=902" class=nickname2><font  color=#9966BB>Увидеть результаты данных Ваших заявок на Артефакты</font></a><br>		
				<a  href="?d_swi=98" class=nickname2 style="text-decoration:underline;"><font color=#CCCC99<b><i>Гравировка вещей</i></b></font></a><br>';
				echo "&nbsp;<a href=\"#\" onClick=\"transferform('2','0','»зумруд','".scode()."','0','0','0','0')\" style=\"color:#cc0000;text-decoration:underline;\"><i>?сли вы хотите  обмен¤ть изумруд <img src=/img/razdor/emerald.png width=14 height=14> на золото <img src=/img/image/gold.png width=14 height=14> вам  сюда. ќбмен валют</i></a>";
				echo'<br>&nbsp;<a  href="?d_swi=10" class=nickname2 style="text-decoration:underline;"><font color=#CCCC99><b><i>Цвет ника</i></b></font></a>';
				echo'
			</b></p>
		</td></tr>
		</table>
	</FIELDSET>';
		$div='<div style="position: relative; top: -17px;"><img src="/img/image/new.gif" title="[ГАРАНТИЯ САМОЙ НИЗКОЙ ЦЕНЫ]"></div>';
	    $style='<div style="position: relative;top: 23px;">';
	    $style2='<div style="position: relative;top: 21px;">';
	echo'
<font class=proce><font color=#222222>
<FIELDSET style="background: white;">
<LEGEND style="background: white; -moz-border-radius: 8px;-webkit-border-radius: 8px;border-radius: 8px;border: solid 1px gray;" align=center><B><font color=#00EE55>&nbsp;Перейти к покупке артефактов и других вещей&nbsp;</font></B></LEGEND>
<table cellpadding=5 cellspacing=0 border=0 width=100% align=center>

	<tr align=center>
		<td class=nickname2 align=center valign=top width=20%>'.$style.'<font  style="color: rgb(0, 204, 0);"><b></b></font></div></td>
		<td class=nickname2 align=center valign=top width=20%>'.$style.'<font  color=#993399><b></b></font></div><div style="position: relative;top: -10px;right:-1px;"><font  color=#FF3300><b>[Изумруда много не бывает!]</b></font></div></td>
		<td class=nickname2 align=center valign=top width=20% >'.$style.'<font  style="color: rgb(0, 204, 0);"><b></b></font></div></td>
	</tr>

	<tr align=center>
		<td class=nickname2 align=center width=33%><a  href="?d_swi=9" class=nickname2><font  color=#00DDFF><img src="/img/image/weapon/wdswwq.png" title="Артефакты" width=70 height=70></font></a><a  href="?d_swi=9" class=nickname2></a>'.$div.'</td>
		<td class=nickname2 align=center width=33%><a  href="?d_swi=104" class=nickname2><font  color=#00DDFF><img src="/img/image/art5.gif" title="Комплект Ведьмака" width=70 height=70></font></a><a  href="?d_swi=104" class=nickname2>'.$div.'</a></td>		
		<td class=nickname2 align=center width=33%><a  href="?d_swi=103" class=nickname2><font  color=#00DDFF><img src="/img/image/compdragon.png" title="Комплект дракона" width=70 height=70></font></a><a  href="?d_swi=103" class=nickname2></a>'.$div.'</td>	
	</tr>
	<tr align=center>
		<td class=nickname2 align=center valign=top width=33%><a  href="?d_swi=9" class=nickname2><font  color=#00DDFF><b>Артефакты</b></font></a><br></td>
		<td class=nickname2 align=center width=33%><a  href="?d_swi=104" class=nickname2><font  color=#00DDFF><b>Комплект Ведьмака</b><br><font class=proceb style="color: #ff7518"> </font></font></a><br></td>
		<td class=nickname2 align=center valign=top width=33%><a  href="?d_swi=103" class=nickname2><font  color=#00DDFF><b>Комплект амуниций Дракона</b></font></a><br></td>
	</tr>
	<tr align=center>
		<td class=nickname2 align=center width=33%><a  href="?d_swi=99" class=nickname2><font  color=#00DDFF><br><img src="/img/image/weapon/sdwsxs.png" title="Зелья, свитки и расходники" width=70 height=70></font></a>'.$div.'</td>	
		<td class=nickname2 align=center width=33%><a  href="?d_swi=2" class=nickname2><font  color=#00DDFF><br><img src="/img/image/weapon/sdef.png" title="Комплект Призыва" width=70 height=70></font></a><a  href="?d_swi=2" class=nickname2></a></td>
		<td class=nickname2 align=center><a  href="?d_swi=100" class=nickname2><font  color=#00DDFF><img src="/img/image/dpod.gif" title="Подарки"></font></a></td>
		</tr>
	<tr align=center>
		<td class=nickname2 align=center valign=top width=20%>'.$style2.'<font  style="color: #ff7518;"><b></b></font></div></td>
		<td class=nickname2 align=center valign=top width=20%>'.$style2.'<font  color=red><b></b></font></div><div style="position: relative;top: -10px;right:-1px;"></div></td>
		<td class=nickname2 align=center valign=top width=20% >'.$style2.'<font  style="color: #ff7518;"><b></b></font></div></td>
	</tr>
	<tr align=center>
		<td class=nickname2 align=center valign=top width=33%><a  href="?d_swi=99" class=nickname2><font  color=#00DDFF><b>Зелья, свитки и расходники</b></font></a></td>
		<td class=nickname2 align=center valign=top width=33%><a  href="?d_swi=2" class=nickname2><font  color=#00DDFF><b>Комплект Призыва</b></font></a></td>
		<td class=nickname2 align=center valign=top><a  href="?d_swi=100" class=nickname2><font  color=#00DDFF><b>Подарки</b></font></a></td>
		
	</tr>
</table>
</FIELDSET>

';	
$zapros="SELECT SQL_CACHE market. *, items.* FROM market LEFT JOIN items ON market.id = items.id WHERE kol>0 AND market=$player[loc] AND dilers=";
$order="ORDER by items.type,items.dd_price ASC";
settype($d_swi,"integer");
if(empty($d_swi)){$d_swi=0;}
switch($d_swi){
	case 0: 
		echo '<br>
		<font class=proce><font color=#222222>
		<FIELDSET style="background: white;">
		<table cellpadding=0 cellspacing=0 border=0 width=100%>
			<tr><td align=center>
				<font  class=nickname2 style="color:#666699"><b>Категории способов пополнения</b></font>
			</td></tr>
		</table>
		</FIELDSET>
		<br>
		';
	break;
	case 1: 
		$ITEMS = mysqli_query($GLOBALS['db_link'],"$zapros $d_swi $order;");
		$num = (mysqli_num_rows($ITEMS)); 
		if($num>0){
			include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/dealers/dealers".".php");
		}
	break;
	case 2: 
		$ITEMS = mysqli_query($GLOBALS['db_link'],"$zapros $d_swi $order;");
		$num = (mysqli_num_rows($ITEMS)); 
		if($num>0){
			include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/dealers/dealers".".php");
		}
	break;
	case 3: 
		$ITEMS = mysqli_query($GLOBALS['db_link'],"$zapros $d_swi $order;");
		$num = (mysqli_num_rows($ITEMS)); 
		if($num>0){
			include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/dealers/dealers".".php");
		}
	break;
	case 4: 
		$ITEMS = mysqli_query($GLOBALS['db_link'],"$zapros $d_swi $order;");
		$num = (mysqli_num_rows($ITEMS)); 
		if($num>0){
			include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/dealers/dealers".".php");
		}
	break;
	case 5: 
		$ITEMS = mysqli_query($GLOBALS['db_link'],"$zapros $d_swi $order;");
		$num = (mysqli_num_rows($ITEMS)); 
		if($num>0){
			include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/dealers/dealers".".php");
		}
	break;
	case 6: 
		$ITEMS = mysqli_query($GLOBALS['db_link'],"$zapros $d_swi $order;");
		$num = (mysqli_num_rows($ITEMS)); 
		if($num>0){
			include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/dealers/dealers".".php");
		}
	break;
	case 7: 
		$ITEMS = mysqli_query($GLOBALS['db_link'],"$zapros $d_swi $order;");
		$num = (mysqli_num_rows($ITEMS)); 
		if($num>0){
			include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/dealers/dealers".".php");
		}
	break;
	case 8: 
		$ITEMS = mysqli_query($GLOBALS['db_link'],"$zapros $d_swi $order;");
		$num = (mysqli_num_rows($ITEMS)); 
		if($num>0){
			include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/dealers/dealers".".php");
		}
	break;
	case 9: 
		$ITEMS = mysqli_query($GLOBALS['db_link'],"$zapros $d_swi $order;");
		$num = (mysqli_num_rows($ITEMS)); 
		if($num>0){
			include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/dealers/dealers".".php");
		}
	break;
	case 10:
		include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/dealers/nick_colors".".php");
	break;
	case 11:
		include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/dealers/buy_params".".php");
	break;
	case 98: 
		$dditems=mysqli_query($GLOBALS['db_link'],'SELECT `invent`.*,`items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `invent`.`pl_id`="'.$player['id'].'" AND `items`.`dd_price`>"0" AND `invent`.`bank`="0";');
		if(mysqli_num_rows($dditems)>0){
			echo'
			<FIELDSET name=field_dealers id=field_dealers  style="background: white;" ><LEGEND style="background: white; -moz-border-radius: 8px;-webkit-border-radius: 8px;border-radius: 8px;border: solid 1px gray;" align=center><b> <font color=gray>У Вас с собой '.$player['baks'].' <img src="/img/razdor/emerald.png" width=14 height=14></b></font> </b></LEGEND><table cellpadding=3 cellspacing=1 border=0 width=100%>
			<tr><td align=center>
			<font style=\"color:red;\" class=nickname2>Стоимость гравировки <b>5 <img src="/img/razdor/emerald.png" width=14 height=14></b>.<br> Если на вещи уже есть гравировка - она будет заменена.<br>Максимальная длинна 30 символов.<br></font>
			'.$message.'<br>
			<form method=POST action="?d_swi=98&grav=1&vcode='.scode().'">
			<font class=weaponchart><b>Выберите вещь:</b></font><select name=item>';
			while($row = mysqli_fetch_assoc($dditems)){
				echo '<option value="'.$row['id_item'].'">'.$row['name'].($row['grav']?' ('.$row['grav'].')':'').'</option>';
			}
			echo'
			</select>
			<font class=weaponchart><b>Гравировка:</b> <input type=text value="" name=grav><br>
			<input type=submit class=lbut value="Гравировать">
			';			
			echo'</form><br><font class=proce><b>Администрация оставляет за собой право удалить гравировки, которые нарушают правила игры.<br> Без компенсации затрат на их установку.</b></font><br></td></tr></table></FIELDSET>';
		}
	break;	
	case 99: 
		$ITEMS = mysqli_query($GLOBALS['db_link'],"$zapros $d_swi $order;");
		$num = (mysqli_num_rows($ITEMS)); 
		if($num>0){
			include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/dealers/dealers".".php");
		}
	break;	
	case 100:
		include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/dealers/deal_pod".".php");
	break;	
	case 101:
		include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/dealers/deal_create".".php");
	break;
	case 103:
		$ITEMS = mysqli_query($GLOBALS['db_link'],"$zapros $d_swi $order;");
		$num = (mysqli_num_rows($ITEMS)); 
		if($num>0){
			include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/dealers/dealers".".php");
		}
	break;
	case 104:
		$ITEMS = mysqli_query($GLOBALS['db_link'],"$zapros $d_swi $order;");
		$num = (mysqli_num_rows($ITEMS)); 
		if($num>0){
			include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/dealers/dealers".".php");
		}
	break;
	case 998:
		$filter="WHERE compl='0'";
		include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/dealers/admin".".php");
	break;
	case 999:
		$filter="WHERE compl='1'";
		include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/dealers/admin".".php");
	break;
	case 901:
		echo'
		<font class=proce><font color=#222222>
		<FIELDSET name=field_dealers id=field_dealers  style="background: white;">
		<table cellpadding=5 cellspacing=1 border=0 width=100%>
			<tr><td>
				<font  class=weaponch><b>1. При создании персональных артефактов старайтесь указывать корректное имя артефакта и его параметры.</b></font><br><br>
				<font  class=weaponch><b>2. После подачи заявки, она рассматривается в течении 3х суток Администрацией проекта, и, при наличии денег на счету персонажа, создается артефакт и передается подавшему заявку.</b></font><br><br>
				<font  class=weaponch><b>3. При некорректно введенном названии, в названии содержащем нецензурную лексику или другие запрещенные законами игры высказывания - Администрация вправе переименовать артефакт по своему усмотрению или удалить заявку без предупреждения.</b></font><br><br>
				<font  class=weaponch><b>4. Заявки автоматически удаляются в течении недели с момента подачи.</b></font><br><br>
			</td></tr>
		</table>
		</FIELDSET>
		';
	break;
	case 902:
		include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/dealers/p_admin".".php");
	break;
	case 903:
		include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/dealers/dealers_ya".".php");
	break;
	case 904:
		if(($_GET['del']==1 or $_GET['del']==2)  and $_GET['usr']!='' and $player['clan']=='Служители порядка' and $_GET['vkl']!=''){
			$checkusr = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `user`.`vklad_bank`,`user`.`login`,`user`.`id` FROM `user` WHERE `user`.`vklad_bank`!='0' AND `user`.`id`='".intval($_GET['usr'])."';"));
			if($checkusr['id']){
				$vkladu = explode("|",$checkusr['vklad_bank']);
				mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `vklad_bank`='0' ".($_GET['del']==1?", `dd`=`dd`+'".$vkladu[1]."'":"")." WHERE `id`='".$checkusr['id']."' LIMIT 1;");
			}
		}
		echo'
		<font class=proce><font color=#222222>
		<FIELDSET name=field_dealers id=field_dealers  style="background: white;"><LEGEND style="background: white; -moz-border-radius: 8px;-webkit-border-radius: 8px;border-radius: 8px;border: solid 1px gray;"> <b>Вклады персонажей</b> </LEGEND>
		<table cellpadding=0 cellspacing=0 border=0 width=100% bgcolor=#e0e0e0>
		<tr><td>
		<table cellpadding=1 cellspacing=1 border=0 width=100%>
		<tr bgcolor=white>
			<td align=center class=nickname2><b>Логин</b></td>
			<td align=center class=nickname2><b>Сумма вклада</b></td>
			<td align=center class=nickname2><b>Сумма к выдаче</b></td>
			<td align=center class=nickname2><b>Дата выдачи вклада</b></td>
			<td align=center class=nickname2><b>Действия</b></td>
		</tr>';	
		$plvklad=mysqli_query($GLOBALS['db_link'],"SELECT `user`.`vklad_bank`,`user`.`login`,`user`.`id` FROM `user` WHERE `user`.`vklad_bank`!='0';");
		if(mysqli_num_rows($plvklad) > 0){
			while($row = mysqli_fetch_assoc($plvklad)){
					$vklad = explode("|",$row['vklad_bank']);
					echo'
					<tr bgcolor=white>
						<td align=center class=nickname2>'.$row['login'].'</td>
						<td align=center class=nickname2>'.$vklad[1].'</td>
						<td align=center class=nickname2>'.$vklad[2].'</td>
						<td align=center class=nickname2>'.date("d.m.yг.",$vklad[0]).'</td>						
						<td align=center class=nickname2>В<input type=image src=/img/image/del.gif width=8 height=8 border=0 onClick="location= \'main.php?d_swi=904&del=1&usr='.$row['id'].'&vkl='.$vklad[1].'&vcode='.scode().'\'" value="x" title="Выдать деньги обратно" alt="Выдать деньги обратно" /> | У<input type=image src=/img/image/del.gif width=8 height=8 border=0 onClick="location= \'main.php?d_swi=904&del=2&usr='.$row['id'].'&vkl='.$vklad[1].'&vcode='.scode().'\'" value="x" title="УДАЛИТЬ ВКЛАД" alt="УДАЛИТЬ ВКЛАД" /></td>
					</tr>
					';
			}
		}
		else{
			echo'<tr><td align=center class=nickname2 colspan=5><div align=center>Не найдено игроков, сделавших вклад.</div></td></tr>';
		}
		echo'</table></td></tr></table></FIELDSET>';
	break;
	case 905:
		echo'
		<font class=proce><font color=#222222>
		<FIELDSET name=field_dealers id=field_dealers  style="background: white;"><LEGEND style="background: white; -moz-border-radius: 8px;-webkit-border-radius: 8px;border-radius: 8px;border: solid 1px gray;"> <b>Арендованные вещи</b> </LEGEND>
		<table cellpadding=0 cellspacing=0 border=0 width=100% bgcolor=#e0e0e0>
		<tr><td>
		<table cellpadding=3 cellspacing=1 border=0 width=100%>
		<tr bgcolor=white>
			<td align=center class=nickname2 width=25%><b>Логин</b></td>
			<td align=center class=nickname2 width=10%><b>Время окончания аренды</b></td>
			<td align=center class=nickname2 width=20%><b>ID invent | items</b></td>
			<td align=center class=nickname2 width=45%><b>Название</b></td>
		</tr>';	
		mysqli_query($GLOBALS['db_link'],"DELETE FROM invent WHERE invent.arenda<".time()." AND invent.arenda!=0;");
		$item=mysqli_query($GLOBALS['db_link'],'SELECT invent.*, user.login FROM user INNER JOIN invent ON user.id = invent.pl_id WHERE arenda!=0 ORDER BY user.login;');
		if(mysqli_num_rows($item) > 0){
			while($row = mysqli_fetch_assoc($item)){
					$itname=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT items.name FROM items WHERE id=".$row['protype']." LIMIT 1;"));
					echo'
					<tr bgcolor=white>
						<td align=center class=nickname2>'.$row['login'].'<a href="/ipers/'.$row['login'].'" target="_blank"><img src="/img/image/chat/info.gif" width="11" height="12" border="0" valign="absmiddle" /></a></td>
						<td align=center class=nickname2>'.date("d.m.yг.",$row['arenda']).'</td>
						<td align=center class=nickname2>'.$row['id_item'].' | '.$row['protype'].'</td>
						<td align=center class=nickname2>'.$itname['name'].'</td>
					</tr>
					';
			}
		}
		else{
			echo'<tr><td align=center class=nickname2>Не найдено игроков, взявших вещи в аренду.</td></tr>';
		}
		echo'</table></td></tr></table></FIELDSET>';
	break;
	case 102:
		echo '<br>
		<font class=proce><font color=#222222>
		<FIELDSET name=field_dealers id=field_dealers  style="background: white;">
		<table cellpadding=0 cellspacing=0 border=0 width=100%>
			<tr><td align=center>
				<font  class=nickname2 style="color:#666699"><b>Временно недоступно</b></font>
			</td></tr>
		</table>
		</FIELDSET>
		<br>
		';
	break;
	case 1000:
		include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/dealers/obraz_check".".php");
	break;
}
?>