<?php


include($_SERVER["DOCUMENT_ROOT"] . '/includes/ks_antiddos.php');

$ksa = new ks_antiddos();
$ksa->doit(10,10);






foreach($_POST as $keypost=>$valp){
     //$valp = varcheck($valp);
     $_POST[$keypost] = $valp;
     $$keypost = $valp;
}
foreach($_GET as $keyget=>$valg){
    // $valg = varcheck($valg);
     $_GET[$keyget] = $valg;
     $$keyget = $valg;

}
foreach($_SESSION as $keyses=>$vals){
     $$keyses = $vals;
}
echo'<table cellpadding=0 cellspacing=0 border=0 width=800 align=center><tr>';
if($clear==1){
	session_start(  );
	$_SESSION = array(  );
	unset( $_COOKIE[session_name(  )] );
	session_destroy(  );
	setcookie( 'Hash' );
	setcookie( 'UID' );
	setcookie( 'Puid' );
	}
if($login==1){
    print '<HTML><HEAD><LINK href=./css/error.css rel=STYLESHEET type=text/css><META content="text/html; charset=utf-8" http-equiv=Content-type></HEAD><BODY><table width=600 border=0 cellpadding=0 cellspacing=0 align=center height=100%><tr><td><table width=600 border=0 cellpadding=1 cellspacing=0><tr><td bgcolor=#777777><table width=100% border=0 cellpadding=2 cellspacing=0><tr><td bgcolor=#FFFFFF><table width=100% border=0 cellpadding=5 cellspacing=0><tr><td bgcolor=#FFFFFF><b><center><font color=#dd0000>Неверный логин или пароль.</b></td></tr><tr><td bgcolor=#E0E0E0><font class=about><div align=center><a href=http://legendbattles.ru/ target=_top class=menu>главной страница</a>.</div></font></td></tr></table></td></tr></table></td></tr></table></td></tr></table></BODY></HTML>';
}
if($error==1){
    echo '<HTML><HEAD><LINK href="./css/error.css" rel=STYLESHEET type=text/css><META content="text/html; charset=utf-8" http-equiv=Content-type></HEAD><BODY><table width=600 border=0 cellpadding=0 cellspacing=0 align=center height=100%><tr><td><table width=600 border=0 cellpadding=1 cellspacing=0><tr><td bgcolor=#777777><table width=100% border=0 cellpadding=2 cellspacing=0><tr><td bgcolor=#FFFFFF><table width=100% border=0 cellpadding=5 cellspacing=0><tr><td bgcolor=#FFFFFF><b><font color=#dd0000>Внимание! Сеанс работы прерван.</b></td></tr><tr><td bgcolor=#E0E0E0><font class=about><b>Возможные причины:</b><br><b>1.</b> Плохое соединение с проектом. <a href=/ target=_top class=menu>legendbattles.ru</a><br><b>2.</b> Попытка войти в другом окне браузера. (возможно попытка взлома)<br><b>3.</b> Попытка доступа к ресурсам сайта с другого хоста<br><b>4.</b> Очистите Ваши cookies. <a href=clear.php target=_top class=menu>Очистить</a><br><b>5.</b> Проверьте Ваше время и дату на компьютере.<br><br><div align=center>Просьба войти с <a href=/ target=_top class=menu>главной страницы</a> еще раз.</div></font></td></tr></table></td></tr></table></td></tr></table></td></tr></table></BODY></HTML>';
}
if($clear==1){
	session_start(  );
	$_SESSION = array(  );
	unset( $_COOKIE[session_name(  )] );
	session_destroy(  );
	setcookie( 'Hash' );
	setcookie( 'UID' );
	setcookie( 'Puid' );
    print '<HTML><HEAD><LINK href=./css/error.css rel=STYLESHEET type=text/css><META content="text/html; charset=utf-8" http-equiv=Content-type></HEAD><BODY><table width=600 border=0 cellpadding=0 cellspacing=0 align=center height=100%><tr><td><table width=600 border=0 cellpadding=1 cellspacing=0><tr><td bgcolor=#777777><table width=100% border=0 cellpadding=2 cellspacing=0><tr><td bgcolor=#FFFFFF><table width=100% border=0 cellpadding=5 cellspacing=0><tr><td bgcolor=#FFFFFF><b><font color=#dd0000>Внимание! Очистка кэша закончена.</b></td></tr><tr><td bgcolor=#E0E0E0><font class=about><div align=center>Просьба войти с <a href=http://legendbattles.ru/ target=_top class=menu>главной страницы</a> еще раз.</div></font></td></tr></table></td></tr></table></td></tr></table></td></tr></table></BODY></HTML>';
}
if($stats==1){
echo'
<td bgcolor="#d9d9d9" style="padding: 5px 10px 5px 10px;" valign="top" width="100%"><p><font class="forumSubj">Полное описание работы характеристик персонажа</font></p><p></p><table cellpadding="0" cellspacing="0" border="0"><tbody><tr><td><font class="nick"><b>1 силы</b> = 0.4 мин.урона, 1.5 макс урона, влияет на шанс блока и пробой блока. <u>Если Мощь <b>больше</b> ловкости и удачи - урон увеличивается в 2 раза.</u><br><b>1 ловкости</b> = 3% мф уворота, 4% мф точности, 1.5кб, 0.33% пробоя брони. <u>Если Проворность <b>больше</b> силы и удачи - бонус пробоя брони еще +0.5% за каждое очко (суммируется со стандартным)</u><br><b>1 удачи</b> = 4% мф сокрушения, 2 урона при критическом ударе, 2% мф точности, 1% мф стойкости. <u>Если Везение <b>больше</b> ловкости и силы - критический урон увеличивается в 2 раза.</u><br><b>1 здоровья</b> = 9% мф стойкости, 5 жизни<br><b>1 заний</b> = 7 маны , увеличение магического урона персонажа на 0.6%, 3% мф точности <u>Магические удары полностью игнорируют броню противника</u><br><b>1% коэффициента</b> = +1% опыта за бой, -0.32% урона по персонажу, увеличение общих шансов увернуться и нанести критический удар на 1%, увеличение мин.урона на 2, увеличение макс урона на 3, увеличение общего урона персонажа на 1% (пример: при мф уворота 1000% и коэфф 10% - мф уворота в формуле будет считаться как 1100%). <b>Каждый уровень персонаж получает 1% коэффициента.</b><br><br><b>Все параметры не будут видны в информации о персонаже, но они прописаны в формулах боя и работают в бою.</b><br><br>Максимальный шанс увернуться: 80%<br>Минимальный шанс увернуться: 6%<br>Максимальный шанс критического удара: 94%<br>Минимальный шанс критического удара: 6%<br><br><b>МФ:</b><br><br><b>точность</b> - уменьшает шанс противника увернуться<br><b>уловка</b> - увеличивает шанс увернуться<br><b>стойкость</b> - уменьшает шанс получить критический удар<br><b>сокрушение</b> - увеличивает шанс нанести критический удар<br><b>уровень брони</b> - уменьшает получаемый урон<br><b>пробой брони</b> - позволяет игнорировать часть брони<br><br>Все мф работают 1 к 1:<br> то есть 100% точности против 100% уловки снизят шанс увернуться до минимального (6%). Так же и с сокрушением против стойкости.<br>Если захотите посчитать свои шансы против кого-либо, не забывайте, что надо учитывать не только мф, но еще и статы противника.<br></font></td></tr></tbody></table><p></p><br></td>
';
}
if($money==1){
    echo '<td bgcolor="#d9d9d9" style="padding: 5px 10px 5px 10px;" valign="top" width="100%"><p><font class="forumSubj">Информация о финансах персонажа</font></p><p></p><table cellpadding="0" cellspacing="0" border="0"><tbody><tr><td><font class="nick"><b>LR</b> - основная валюта персонажа, используется при рассчетах между игроками, покупках в магахинах.<br><b>DLR</b> - дилерская валюта, приобретается за реальные деньги или за LR у других игроков (с пмощью Биржи DLR). Нужна для покупки редких артефактов и расходников в Доме Ценителей (ДЦ). Может быть передана другим игрокам.<br><b>$</b> - можно получить при помощи обмена дилерской валюты (передаем DLR своему персонажу). Основаня валюта для рассчетов в Доме Ценителей. Не может быть передана другим игрокам.<br></font></td></tr></tbody></table></td>';
}
if($buffs==1){
    echo '<td bgcolor="#d9d9d9" style="padding: 5px 10px 5px 10px;" valign="top" width="100%"><p><font class="forumSubj">Краткое описание зелий и их эффектов</font></p><p></p><table cellpadding="0" cellspacing="0" border="0"><tbody><tr><td><font class="nick"><b>Добавлены новые зелья в лавку странника:</b><br>1. Зелье Изворотливости - 5,15,25,50,75 к уловке<br>2. Зелье Точных Ударов - 5,15,25,50,75 к точности<br>3. Зелье Сокрушительных Ударов - 5,15,25,50,75 к сокрушению<br>4. Зелье Защиты - 5,15,25,50,75 к стойкости<br><br><b>Добавлены новые зелья в Дом Ценителей:</b><br>1. Зелье Изворотливости - 175,255 к уловке<br>2. Зелье Точных Ударов - 175,255 к точности<br>3. Зелье Сокрушительных Ударов - 175,255 к сокрушению<br>4. Зелье Защиты - 175,255 к стойкости</font></td></tr></tbody></table><table cellpadding="0" cellspacing="0" border="0"><tbody><tr><td><font class="nick"><br><b>Все зелья действуют 1 час</b><br><br>Слабое зелье &lt;название стата&gt; = +5 к стату.<br>Слабое зелье урона = +7 к урону.<br>Слабое зелье брони = +50 к кб.<br>Слабое зелье пробоя = +25 к пробою брони.<br>Зелье наблюдательности = +15 к умению "наблюдательность".<br>Зелье Ангела = +10% к параметрам вещей (статы, мф, кб, пробой) и +10% к урону персонажа. (одновременно можно выпить только 1 глоток такого зелья)<br><br><br></font></td></tr></tbody></table></td>';
}
if($fish==1){
echo '<td bgcolor="#d9d9d9" style="padding: 5px 10px 5px 10px;" valign="top" width="100%"><div align=center><img src="http://img.legendbattles.ru/image/ribalka1.jpg"></div></td>';
}
if($taimer==1){
echo '<td bgcolor="#d9d9d9" style="padding: 5px 10px 5px 10px;" valign="top" width="100%">
<div class="content" style="text-align:center">
		<div>
            	<p class="main_text_aboutthegame">
                <font color=#003399><b>В игре существует бонусная система</b>
                </p>
                <p class="main_text_aboutthegame">
				<font color=#CC0033><b>"Команда разработчиков проекта LegendBattles"</b>
				<font color=#003399><b>Даёт уникальную возможность зарабатывать изумруды <img src=http://img.legendbattles.ru/razdor/emerald.png width=14 height=14> </b>
               </p>
<center><a href="http://img.prntscr.com/img?url=http://i.imgur.com/L9T71jU.png" rel="lightbox" title="Информация" onFocus="this.blur();"><img 
src="http://img.prntscr.com/img?url=http://i.imgur.com/L9T71jU.png" width="954" height="274" 
style="cursor:pointer;"></a></center>
				<p class="main_text_aboutthegame">
                <font color=#003399><b>Описания.</b>
				</p>
				<p class="main_text_aboutthegame">
				Каждый час вам будет приходить система,сколько времени вы находитесь в игре.
				</p>
				Внимание! Вы находитесь в игре уже более 1 ч. 
				</p>
				Внимание! Вы находитесь в игре уже более 2 ч.
				</p>
				Внимание! Вы находитесь в игре уже более 3 ч.
				</p>
				Внимание! Вы находитесь в игре уже более 4 ч.
				</p>
				Внимание! Вы находитесь в игре уже более 5 ч.
				</p>
				Внимание! Вы находитесь в игре уже более 6 ч.
				</p>
				Внимание! Вы находитесь в игре уже более 7 ч.
				</p>
				Внимание! Вы находитесь в игре уже более 8 ч.
				</p>
				Внимание! Вы находитесь в игре уже более 9 ч.
				</p>
				И на 10 час в общей чат придёт такое сообщение
				</p>
				 Legend Battles : Персонаж Администрация находиться в игре 10 часов. За это достижение он получает бонус 1 <img src=http://img.legendbattles.ru/razdor/emerald.png width=14 height=14> Изумруд.
				</p>
				<center><strong>Как соберёте вам нужную сумму , вы сможете приобрести себе Индивидуальные Артефакты в Дом Ценителей</strong></center>
<center><a href="http://i.imgur.com/Oh6yTMS.png" rel="lightbox" title="Информация." onFocus="this.blur();"><img 
src="http://i.imgur.com/Oh6yTMS.png" width="694" height="361"></a></center>
                </p>
<center><strong>Желаем вам удачи</strong></center>
<br></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	</tr>	
		<td bgcolor="#FFFFFF"><img src="http://img.legendbattles.ru/image/1x1.gif" width="1" height="3"></td>
	</tr>
	<tr>
<div style="background-color:#cacaca; width:100%;" align="center"><a class="button_register" 
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div></td>';
}
echo'</tr>';