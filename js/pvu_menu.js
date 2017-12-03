ShowHide_wtch = function(){
	if(parent.document.getElementById('frmset').rows == '*,25'){
		parent.document.getElementById('frmset').rows = "*,500";
		document.getElementById('wtch').innerHTML = '[Скрыть]';
	}else if(parent.document.getElementById('frmset').rows == '*,500'){
		parent.document.getElementById('frmset').rows = "*,25";
		document.getElementById('wtch').innerHTML = '[Показать]';
	}
}
ViewPage = function(){
	var r = '';
	if(fdata[0] & 1) r += '<tr><td align="center" width="450" class=nickname>Просмотр действий</td><td><select style="width:140px" size="1" name="pactions" class=LogintextBox6><option selected value="">Не смотреть</option><option value="1">Посмотреть</option></select></td></tr>';
	
	if(fdata[0] & 1) r += '<tr><td align="center" width="450" class=nickname>Заходы с 1 ип</td><td><select style="width:140px" size="1" name="pip" class=LogintextBox6><option selected value="">Не смотреть</option><option value="1">Посмотреть</option></select></td></tr>';
	
	if(fdata[0] & 1) r += '<td align="center" width="450" class=nickname>Отключить ботов</td><td><select style="width:140px" size="1" name="autobot" class=LogintextBox6><option selected value="">Время</option><option  value="-1">Снять</option><option value="5">5 минут</option><option value="10">10 минут</option><option value="15">15 минут</option><option value="30">30 минут</option><option value="60">1 час</option><option value="120">2 часa</option><option value="180">3 часa</option><option value="360">6 часов</option><option value="1440">24 часа</option></select></td>';
	
	if(fdata[0] & 1) r += '<tr><td align="center" width="450" class=nickname>Молчание</td><td><select style="width:140px" size="1" name="molch" class=LogintextBox6><option selected value="">Время</option><option  value="-1">Снять</option><option value="5">5 минут</option><option value="10">10 минут</option><option value="15">15 минут</option><option value="30">30 минут</option><option value="60">1 час</option><option value="120">2 часa</option><option value="180">3 часa</option><option value="360">6 часов</option><option value="1440">24 часа</option></select><input type=text class=LogintextBox4 name=reason1 title="Причина"></td></tr>';
	
	if(fdata[0] & 1) r += '<tr><td align="center" width="450" class=nickname>Форумная Молчанка</td><td><select style="width:140px" size="1" name="fmolch" class=LogintextBox6><option selected value="">Время</option><option  value="-1">Снять</option><option value="60">1 час</option><option value="360">6 часов</option><option value="1440">24 часа</option><option value="10080">1 Неделя</option><option value="259200">6 Месяцец</option><option value="525600">1 год</option></select><input type=text class=LogintextBox4 name=freason1 title="Причина"></td></tr>';
	
	if(fdata[0] & 2) r += '<tr><td align="center" width="450" class=nickname>Тюрьма</td><td><select style="width:140px" size="1" name="prisontime" class=LogintextBox6><option selected value="">Время</option><option value="-1">Выпустить</option><option value="1">1 день</option><option value="3">3 дня</option><option value="7">1 неделя</option><option value="14">2 недели</option><option value="30">1 месяц</option><option value="60">2 месяца</option><option value="365">1 год</option></select><input type=text class=LogintextBox4 name=prison title="Причина"></td></tr>';
	
	if(fdata[0] & 4) r += '<tr><td align="center" width="450" class=nickname>Блокирование</td><td width="500" colspan="2"><select style="width:140px" size="1" name="blockt" class=LogintextBox6><option selected value="">Выбор</option><option value="1">Заблокировать</option><option value="2">Разблокировать</option></select><input type=text class=LogintextBox4 name=block title="Причина"></td></tr>';	
	
	if(fdata[0] & 8) r += '<tr><td align="center" width="450" class=nickname>Выгнать</td><td><input type=button class=lbut value="Выгнать из клана" onclick="if (confirm(\'Выгнать?\'))location = \'/ipers.php?p='+fdata[1]+'&no_watch=yes&watch_menu=yes&clan_go_out=1\'"></td></tr>';
	
	if(fdata[0] & 16) r += '<tr><td align="center" width="450" class=nickname>Проверка</td><td width="500" colspan="2"><select style="width:140px" size="1" name="verif" class=LogintextBox6><option selected value="">Выбор</option><option value="1">Проверка пройдена</option><option value="2">Проверка пройдена (условно)</option><option value="3">Проверка не пройдена</option></select><input type=text class=LogintextBox4 name=verifr title="Причина"></td></tr>';
	
	if(fdata[0] & 32) r += '<tr><td align="center" width="450" class=nickname>Раздеть персонажа</td><td><input type=button class=lbut value="Раздеть" onclick="if(confirm(\'Раздеть?\'))location = \'/ipers.php?p='+fdata[1]+'&no_watch=yes&watch_menu=yes&wear_out=1\'"></td></tr>';
	
	if(fdata[0] & 64) r += '<tr><td align="center" width="450" class=nickname>Телепорт в тюрьму</td><td><input type=button class=lbut  value="Телепортировать" onclick="location = \'/ipers.php?p='+fdata[1]+'&no_watch=yes&watch_menu=yes&mprision=1\'" style="width:90%"></td></tr>';
	
	if(fdata[0] & 128) r += '<tr><td align="center" width="450" class=nickname>Пометка</td><td><input type=text class=LogintextBox4 name=pometka></td></tr>';
	
	if(fbut == 'невидимка' || fbut == 'Администрация') r += '<tr><td align="center" width="450" class=nickname>Кнопки СП</td><td><input type=button class=lbut value="Дать кнопки" onclick="location = \'/ipers.php?p='+fdata[1]+'&no_watch=yes&watch_menu=yes&give_buttons=1\'"><input type=button class=lbut value="Забрать кнопки" onclick="location = \'/ipers.php?p='+fdata[1]+'&no_watch=yes&watch_menu=yes&give_buttons=2\'"><input type=button class=lbut value="Дать доступ к форуму" onclick="location = \'/ipers.php?p='+fdata[1]+'&no_watch=yes&watch_menu=yes&give_buttons=3\'"><input type=button class=lbut value="Забрать доступ к форуму" onclick="location = \'/ipers.php?p='+fdata[1]+'&no_watch=yes&watch_menu=yes&give_buttons=4\'"><input type=button class=lbut value="дать СУПЕР доступы" onclick="location = \'/ipers.php?p='+fdata[1]+'&no_watch=yes&watch_menu=yes&give_buttons=5\'"></td></tr>';
																													
		
	if(fdata[0] & 256) r += '<tr><td align="center" width="450" class=nickname>Вытащить из бага</td><td><input type=button class=lbut  value="Вытащить" onclick="location = \'/ipers.php?p='+fdata[1]+'&no_watch=yes&watch_menu=yes&bugoff=1\'" style="width:15%"></td></td></tr>';
	
	if(fdata[0] & 1) r += '<tr><td align="center" width="450" class=nickname>Вытащить из боя</td><td><input type=button class=lbut  value="Вытащить" onclick="location = \'/ipers.php?p='+fdata[1]+'&no_watch=yes&watch_menu=yes&fightoff=1\'" style="width:15%"></td></td></tr>';
	
	document.write('<table cellpadding="0" cellspacing="3" border="0"><form method="post" action="?p='+fdata[1]+'&no_watch=yes&watch_menu=yes">'+r+'<tr><td colspan="2" align="center"><input type="submit" class="lbut" value="Выполнить"></td></tr></form></table>');
}