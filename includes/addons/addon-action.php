<?php
save_hp();
$player=player();
if(!empty($_REQUEST['action'])){
	switch($_REQUEST['action']){
        case'5': // Встаем на проверку!
			$VeriF = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `verification` WHERE `uid` = '".$player['id']."'"));
			if(empty($VeriF)){
				switch($_REQUEST['ver_type']){
					case'1':
						if($player['nv'] >= 1500){
							mysqli_query($GLOBALS['db_link'],"INSERT INTO `verification` (`uid`, `vTime`, `type`) VALUES ('".$player['id']."', '".time()."','1');");
							mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `nv`=nv-1500 WHERE `id`='".$player['id']."'");
						}
					break;
					case'2':
						if($player['baks'] >= 5){
							mysqli_query($GLOBALS['db_link'],"INSERT INTO `verification` (`uid`, `vTime`, `type`) VALUES ('".$player['id']."', '".time()."','2');");
							mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `baks`=baks-5 WHERE `id`='".$player['id']."'");
						}
					break;
				}
			}
		break;
        case'6': // Удаляем заявку!
			mysqli_query($GLOBALS['db_link'],"DELETE FROM `verification` WHERE `uid` = '".$player['id']."' AND `status` = '0'");
		break;		
	}
}

?>
<HEAD>
    <LINK href=../css/game.css rel=STYLESHEET type=text/css>
    <LINK href=../css/stl.css rel=STYLESHEET type=text/css>
    <meta content="text/html; charset=UTF-8" http-equiv=Content-type>
    <META Http-Equiv=Cache-Control Content=no-cache>
    <meta http-equiv=PRAGMA content=NO-CACHE>
    <META Http-Equiv=Expires Content=0>
</HEAD>
<body bgcolor=#ffffff topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0 link=#336699
      alink=#336699 vlink=#336699>
	<div id="overDiv" style="position:absolute;visibility:hidden;z-index:1000;"></div>
    <div id="header">
        <table cellpadding=4 cellspacing=0 border=0 width=100%>
            <tr>
                <td><font class=nickname><b>Дополнительные возможности персонажа</b></font></td>
                <td align="right"><input type=button class=lbut onClick="location='/main.php'" value="Вернуться"></td>
                <td>
                    <div align=right>
                        <script language="JavaScript">
<!-- 
document.write("<a href='javascript:parent.exit_redir();'>");
// -->
</script>
</div></td></tr></table>
</div><br><br>
<table width=90% cellpadding=10 cellspacing=0 align=center>
  <tr>
    <td><table cellpadding=0 cellspacing=2 border=0 width=100% align=center>
      <tr>
        <td bgcolor=#cccccc><table cellpadding=0 cellspacing=1 width=100% border=0>
          <tr>
              <td bgcolor=<?php echo(($_GET['addid'] == '1') ? '#FFFFFF' : '#F0F0F0'); ?> width=25%>
                  <div align=center><a href=?useaction=addon-action&addid=1><font
                                  class=nickname><b>Возможности</b></font></a></div>
              </td>
              <td bgcolor=<?php echo(($_GET['addid'] == '2') ? '#FFFFFF' : '#F0F0F0'); ?> width=25%>
                  <div align=center><a href=?useaction=addon-action&addid=2><font class=nickname><b>Ваши
                                  лицензии</b></font></a></div>
              </td>
              <td bgcolor=<?php echo(($_GET['addid'] == '3') ? '#FFFFFF' : '#F0F0F0'); ?> width=25%>
                  <div align=center><a href=?useaction=addon-action&addid=3><font class=nickname><b>Проверка на
                                  чистоту</b></font></a></div>
              </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width=100% cellpadding=1 cellspacing=0>
          <tr>
            <td bgcolor=#CCCCCC><table width=100% cellpadding=10 cellspacing=0>
              <tr>
                <td bgcolor=#FFFFFF><?php
if(empty($_GET['addid'])){
    //echo'<font class=freetxt><div align=center><font color=#cc0000><b>Выберите раздел</b></font></div></font>';
    //обменник снежинок от невидимка
$sneginv = mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT protype, pl_id FROM invent WHERE protype='2735' and pl_id='".$player["id"]."' "));
if(!$sneginv) $sneginv = 0;
    if ($sneginv == 1) $n = 'ка';
    elseif ($sneginv > 1 and $sneginv <= 4) $n = 'ки';
    elseif ($sneginv > 4 or $sneginv == 0) $n = 'ок';
echo"<div class='block info'>
	   <div class='header'>
		<span>Обменник снежинок</span>
	</div>
		<font>
			<p>
				На данный момент у вас в инвентаре <b>$sneginv</b> снежин$n. Обменять снежинки на новогоднюю валюту можно тут.
			</p>
			<p>
				<form type='get' action='main.php?'>
				Введите количество для обмена: <input type='text' name='sncount'> <input type='submit' name='change' value='Обменять'>
				</form>
			</p>
		</font>";

//конец обменника
}elseif($_GET['addid'] == '1'){
//склонки
if($_GET['act'] and $player['sklon']!=0 and $player['sklon']!=''){
	if($_POST['tologin']){
	$val_tologin=varcheck($_POST['tologin']);
		$target = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `login`='".$val_tologin."' LIMIT 1;"));
		list($nowa[1], $nowa[2]) = explode('@', $player['sklon_abil']);
		if($target['login'] and $target['id']){
			if(rand(0,100)<80){
				switch(intval($_GET['act'])){
					 case 1: 
						if($nowa[1]>0){
							switch($player['sklon']){
                                case 5:  //лечение
									if(mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `affect`='' WHERE `id`='".$target['id']."' LIMIT 1;")){
                                        echo '<div align=center><font class=proce><b>Персонаж ' . $target['login'] . ' успешно излечен от травм.</b></font></div>';
									}
								 break;
                                case 6: //Темное нападение
										$ret=PlayerAttack($target['login'],0,80,3);
                                    $msg = $ret['msg'];
										echo $msg;
								 break;
                                case 7: //Ускорение
									$insert = $target['buffs']."|16@100@".(time()+3600);
									if(mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `buffs`='".$insert."' WHERE `id`='".$target['id']."' LIMIT 1;")){
                                        echo '<div align=center><font class=proce><b>Персонаж ' . $target['login'] . ' успешно получил +100 к страннику.</b></font></div>';
									}
								 break;
                                case 8: //Облегчение
									if(mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `affect`='',`buffs`='' WHERE `id`='".$target['id']."' LIMIT 1;")){
                                        echo '<div align=center><font class=proce><b>Персонаж ' . $target['login'] . ' успешно излечен от травм и избавлен от эффектов зелий.</b></font></div>';
									} 
								 break; 
							}
							$nskact=($nowa[1]-1)."@".$nowa[2];
							mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `sklon_abil`='".$nskact."' WHERE `login`='".$player['login']."' LIMIT 1;");
						}
					 break;
					 case 2:
						if($nowa[2]>0){
							switch($player['sklon']){
                                case 5: //Аура света
									switch($target['sklon']){
										case 5: $params=25; break;
										case 6: $params=-15; break;
										case 7: $params=25; break;
										case 8: $params=-15; break;
										default: $params=20; break;
									}
									$insert = $target['buffs']."|14@".$params."@".(time()+3600);
									if(mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `buffs`='".$insert."' WHERE `id`='".$target['id']."' LIMIT 1;")){
                                        echo '<div align=center><font class=proce><b>Персонаж ' . $target['login'] . ' успешно получил ' . $params . '% к мф и статам.</b></font></div>';
									}
								break;
                                case 6: //Аура Тьмы
									switch($target['sklon']){
										case 5: $params=-15; break;
										case 6: $params=30; break;
										case 7: $params=-15; break;
										case 8: $params=30; break;
										default: $params=20; break;
									}
									$insert = $target['buffs']."|14@".$params."@".(time()+3600);
									if(mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `buffs`='".$insert."' WHERE `id`='".$target['id']."' LIMIT 1;")){
                                        echo '<div align=center><font class=proce><b>Персонаж ' . $target['login'] . ' успешно получил ' . $params . '% к мф и статам.</b></font></div>';
									}
								break;
                                case 7: //Аура Сумерек
									if($target['invisible']>time()){
										mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `invisible`='".($target['invisible']+1800)."' WHERE `id`='".$target['id']."'");
									}
									elseif($target['invisible']<=time()){
										mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `invisible`='".(time()+1800)."' WHERE `id`='".$target['id']."'");
									}
                                    echo '<div align=center><font class=proce><b>Персонаж ' . $target['login'] . ' успешно стал невидимкой.</b></font></div>';
								break;
                                case 8:
                                    echo '<div align=center><font class=proce><b>Недоступно!</b></font></div>';
                                    break; //Рука хаоса
							}
							$nskact=$nowa[1]."@".($nowa[2]-1);
							mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `sklon_abil`='".$nskact."' WHERE `login`='".$player['login']."' LIMIT 1;");
						}
					 break;
				}
			}else{
				$nskact=0;
				if(intval($_GET['act'])==1 and $nowa[1]>0){$nskact=($nowa[1]-1)."@".$nowa[2];}
				elseif(intval($_GET['act'])==2 and $nowa[2]>0){$nskact=$nowa[1]."@".($nowa[2]-1);}
				if($nskact){mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `sklon_abil`='".$nskact."' WHERE `login`='".$player['login']."' LIMIT 1;");}
                echo '<div align=center><font class=proce><b>Склонность не сработала!</b></font></div>';
			}
        } else {
            echo '<div align=center><font class=proce><b>Игрок с таким именем не найден!</b></font></div>';
        }
    } else {
        echo '<div align=center><font class=proce><b>Укажите имя цели!</b></font></div>';
    }

}
$player=player();
if($player['sklon']!=0 and $player['sklon']!=''){
    $allinputs = '<input type=hidden namve=vcode value="' . scode() . '">Ник:<input type=text name=tologin class=logintextbox8 value=""><input type=submit class=lbut value="Использовать"><br>';
	$formact[1]='<form method=post action="main.php?useaction=addon-action&addid=1&act=1"><font class=freetxt>';
	$formact[2]='<form method=post action="main.php?useaction=addon-action&addid=1&act=2"><font class=freetxt>';
    echo '<font class=freetxt><font class=nickname><font color=#222222><FIELDSET><LEGEND align=center><B>Возможности склонности</B></LEGEND>
	<table cellpadding=0 cellspacing=0 border=0 width=100%>
	<tr><td bgcolor=cccccc>	
	<table cellpadding=5 cellspacing=1 border=0 width=100% >
	<tr><td colspan=2 bgcolor=white><div align=center><font class=freetxt>Время действия способностей 30-60 минут.</font></div></td></tr>
	<tr>';
    if ($player['login'] == 'Администрация') {
        $player['sklon'] = 5;
    }
		list($nowa[1], $nowa[2]) = explode('@', $player['sklon_abil']);
		switch($player['sklon']){
            case 5: //свет
				echo '
				<td align=center bgcolor=white width=50%>
					'.$formact[1].'						
						<div align=center>
							<b>Лечение</b> [' . $nowa[1] . '/3]<br>
							<img src="http://img.legendbattles.ru/image/sklonab/light_doc.gif"><br>
							'.$allinputs.'
						</div>
						<div align=center>
						Возможность использовать на любого персонажа.<br>Лечение всех видов травм.<br>Шанс срабатывания 80%
						</div>
					</font></form>
				</td>
				<td align=center bgcolor=white width=50%>
					'.$formact[2].'	
						<div align=center>
							<b>Аура света</b> [' . $nowa[2] . '/3]<br>
							<img src="http://img.legendbattles.ru/image/sklonab/light_aura.gif"><br>
							'.$allinputs.'
						</div>
						<div align=center>
							<b>Свет и Сумерки</b> (Повышение МФ или Статов на 25%)<br>
							<b>Тьма и Хаос</b> (Понижение МФ или Статов на 15%)<br>
							<b>Игрок без склонности</b> (Повышение МФ или Статов на 20%)<br>
							Шанс срабатывания 80%
						</div>
					</font></form>
				</td>';
                if ($player['login'] != 'Администрация') {
                    break;
                }
				else{echo '</tr><tr>';}
            case 6: //тьма
				echo '
				<td align=center bgcolor=white width=50%>
					'.$formact[1].'	
						<div align=center>
							<b>Темное нападение</b> [' . $nowa[1] . '/3]<br>
							<img src="http://img.legendbattles.ru/image/sklonab/dark_attack.gif"><br>
							'.$allinputs.'
						</div>
						<div align=center>
							Темное нападение<br>Нападение, если даже персонаж находиться на другой клетке.<br>Шанс срабатывания 80%
						</div>
					</font></form>
				</td>
				<td align=center bgcolor=white width=50%>
					'.$formact[2].'	
						<div align=center>
							<b>Аура Тьмы</b> [' . $nowa[2] . '/3]<br>
							<img src="http://img.legendbattles.ru/image/sklonab/dark_aura.gif"><br>
							'.$allinputs.'
						</div>
						<div align=center>
							<b>Свет и Сумерки</b> (Понижение МФ или Статов на 15%)<br>
							<b>Тьма и Хаос</b> (Повышение МФ или Статов на 30%)<br>
							<b>Игрок без склонности</b> (Повышение МФ или Статов на 20%)<br>
							Шанс срабатывания 80%
						</div>
					</font></form>
				</td>';
                if ($player['login'] != 'Администрация') {
                    break;
                }
				else{echo '</tr><tr>';}
            case 7: //сумерки
				echo '
				<td align=center bgcolor=white width=50%>
					'.$formact[1].'	
						<div align=center>
							<b>Ускорение</b> [' . $nowa[1] . '/3]<br>
							<img src="http://img.legendbattles.ru/image/sklonab/neut_fast.gif"><br>
							'.$allinputs.'
						</div>
						<div align=center>
						Перемещение персонажа увеличивается в “+100” Странника.<br>Шанс срабатывания 80%
						</div>
					</font></form>
				</td>
				<td align=center bgcolor=white width=50%>
					'.$formact[2].'	
						<div align=center>
							<b>Аура Сумерек</b> [' . $nowa[2] . '/3]<br>
							<img src="http://img.legendbattles.ru/image/sklonab/neut_invis.gif"><br>
							'.$allinputs.'
						</div>
						<div align=center>
							Персонаж становится невидимым.<br>
							Шанс срабатывания 80%
						</div>
					</font></form>
				</td>';
                if ($player['login'] != 'Администрация') {
                    break;
                }
				else{echo '</tr><tr>';}
            case 8:  //хаос
				echo '
				<td align=center bgcolor=white width=50%>
					<form  method=post action="main.php?useaction=addon-action&addid=1&act=1"><font class=freetxt>
						<div align=center>
							<b>Облегчение</b> [' . $nowa[1] . '/3]<br>
							<img src="http://img.legendbattles.ru/image/sklonab/chaos_obl.gif"><br>
							'.$allinputs.'
						</div>
						<div align=center>
						Персонаж, который подвергся заклинанию Света или Тьмы, накинув “Облегчение”.<br> Убирает все эффекты в то числе и зелья.<br>Шанс срабатывания 80%
						</div>
					</font></form>
				</td>
				<td align=center bgcolor=white width=50%>
					<form method=post action="main.php?useaction=addon-action&addid=1&act=2"><font class=freetxt>
						<div align=center>
							<b>Рука хаоса</b> [' . $nowa[2] . '/3]<br>
							<img src="http://img.legendbattles.ru/image/sklonab/chaos_power.gif"><br>
							Временно недоступно.
						</div>
						<div align=center>
							Позволяет из любого боя изъять человека и начать закрытый бой.<br>
							Шанс срабатывания 80%
						</div>
					</font></form>
				</td>';
                if ($player['login'] != 'Администрация') {
                    break;
                }
			else{echo '</tr><tr>';}
		}
	echo'
	</tr>
	</table></td></tr></table></FIELDSET>';
}
//енд_склонки
    $thotems = array('0' => 'Час Сфинкса', '1' => 'Час Саблезубого тигра', '2' => 'Час Мудрого Льва', '3' => 'Час Изумрудного Дракона', '4' => 'Час Василиска', '5' => 'Час Скорпиона', '6' => 'Час Ужасающей Рыбы', '7' => 'Час мутанта-острозуба', '8' => 'Час Небесного кита', '9' => 'Час Древнего Ящера', '10' => 'Час Ворона Смерти', '11' => 'Час Острых Клинков', '17' => 'Официальный дилер');
    echo '<font class=freetxt><font class=nickname><font color=#222222><div class="block info"><div class="header"><span>Общие Возможности</span></div><table cellpadding=5 cellspacing=0 border=0 width=100%><tr><td><font class=freetxt><b>УСЛУГИ САНИТАРА</b> (помощь людям с тяжелыми травмами - перенос людей в больницу)<SCRIPT src=\'java/sanitar.js\'></SCRIPT><div id=sanitardiv><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1></div><a href="javascript:sanitar(\'' . scode() . '\')"><b>использовать</b></a><br><br><b>ВОССТАНОВИТЬ HP</b> (за счет маны - доступно ' . ceil($player['mp']) . ' маны)<SCRIPT src=\'java/addon.js\'></SCRIPT><div id=addondiv><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1></div><a href="javascript:addon_ma2hp(\'' . scode() . '\')"><b>использовать</b></a></font></td></tr></table></div>';
    if ($player['obnul'] > 0) {
        echo '<br><div class="block info"><div class="header"><span>Обнуление Вашего Персонажа</span></div><table cellpadding=5 cellspacing=0 border=0 width=100%><tr><td bgcolor=#ffffff width=100%><form method=POST><div align=center><table cellpadding=2 cellspacing=0 border=0><tr><td colspan=2><font class=freetxt>Вы можете сбросить статы или сменить тотем. Возможных действий: ' . $player["obnul"] . '</font></td></tr><tr><td><input type=button class=lbut onClick="location=\'main.php?get_id=14&vcode=' . scode() . '\'" value="Сбросить статы, умения и навыки"></td><td><font class=freetxt> <b>стоимость</b>: 1 действие</font></td></tr><tr><td>
<input type=hidden name=get_id value=11><input type=hidden name=vcode value='.scode().'><select name=ch_tot class=LogintextBox6>
<option value=n>Выберите тотем</option>';
foreach($thotems as $key=>$val){
	if($key<=11){echo '<option value="'.$key.'">'.$val.'</option>';}else{break;}
}
echo'
</select> <input type=submit value="Сменить тотем" class=lbut></td><td><font class=freetxt> <b>стоимость</b>: 1 действие</font></td></tr></table></div></form></td></tr></table></div>';
	}
	echo'</font></font></font>';
}elseif($_GET['addid'] == '2'){
	$lic=explode("|",$player['licens']);
	foreach($lic as $val){
		$arr=explode("@",$val);
		if($arr[1]<time()){
			continue;
		}else{
			$do=getdate($arr[1]);
			foreach($do as $key=>$val){
				if($val<10){
					$do[$key]="0".$val;
				}
			}
            $str .= '<img src=http://img.legendbattles.ru/image/weapon/' . ($arr[0] == 1 ? 'torg_lic_1' : 'doc_lic_3') . '.gif width=42 height=21 title="' . ($arr[0] == 1 ? 'Торговые' : 'Докторские') . ' лицензии"> Действительна до: <b>' . $do['mday'] . '.' . $do['mon'] . '.' . $do['year'] . ' ' . $do['hours'] . ':' . $do['minutes'] . ':' . $do['seconds'] . '</b>.<br>';
		}
	}
	if($str!=''){
		echo $str;
	}else{
        echo '<font class=freetxt><div align=center><b><font color=#cc0000>У Вас нет лицензий</font></b></div></font>';
	}
}elseif($_GET['addid'] == '3'){
	
	$verification = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `verification` WHERE `uid`='".$player['id']."'"));
	echo'<font class=freetxt>';
	if(!empty($verification['id']) and $verification['status'] == 0){
        echo 'Заявка на проверку принята.<br>Статус проверки: В ожидании (номер в очереди: ' . mysqli_num_rows(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `verification` WHERE `vTime`<='" . $verification['vTime'] . "' AND `status`!='1' AND `type`='" . $verification['type'] . "'")) . ') <a href="javascript: if(confirm(\'Вы точно хотите удалить заявку?\')) { location=\'main.php?useaction=addon-action&addid=3&pg_id=1&action=6&vcode=' . scode() . '\' }">Удалить</a>';
	}else if(!empty($verification['id']) and $verification['status'] == 1 and $verification['vTime']>time()){
        echo '<center>Проверка действительна до: ' . date("d.m.Y H:i:s", $verification['vTime']) . '</center>';
	}else if(!empty($verification['id']) and $verification['status'] == 2){
        echo 'Заявка на проверку принята.<br>Статус проверки: Условно пройдена (Скан паспорта на <a href="mailto:ork.order.legend battles@hotmail.com" target="_blank">ork.order.legend battles@hotmail.com</a>)';
	}else{
        echo '<form method="POST" action="">' . (($player['level'] > 5) ? '<input type=hidden name=action value=5><input type=hidden name=useaction value="addon-action"><input type=hidden name=addid value=3><input type=hidden name=vcode value=' . scode() . '><input type=hidden name=pg_id value=1>' : '') . '<select name="ver_type" class="textBox"><option value=0>Выбрать</option><option value=1>Обычная проверка (1500 LR)</option><option value=2>Коммерческая проверка (5 изумруд)</option></select> <input type=submit class="textBox" value="Ок"' . (($player['level'] < 5) ? ' DISABLED' : '') . '></form>';
	}
	echo'</font>';
}
?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
