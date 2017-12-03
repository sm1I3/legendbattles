var Category = 0;
var TDataL = 0;

$ = function(id){
	return document.getElementById(id);
}

StateReady = function(){
	
	switch(arr_res[0]){
	case'Get':
		
		var all_i = arr_res.length - 1;
		var count = Math.floor(all_i / 1);
		
		
		if(count > 0){
			s = '<table cellpadding=3 cellspacing=1 border=0 align=center width=100% bgcolor=#e0e0e0>';
			for(i=1; i<=count; i++){
				str_pr = arr_res[i].split(';');
                var buy = '<input type=button class=fr_but_dis value="Купить за ' + str_pr[10] + ' HPV">';
						
					
				if(shop[2]<shop[1]-str_pr[7]){
                    buy = '<input type=button class=fr_but onclick="BuyItems(' + str_pr[0] + ');scroll(0,0)" value="Купить за ' + str_pr[10] + ' HPV"> ';
				}
                s += '<tr id="itemid_' + str_pr[0] + '"><td bgcolor=#f9f9f9><div align=center><img src=http://image.gamele.ru/weapon/' + str_pr[2] + ' border=0></div></td><td width=100% bgcolor=#ffffff valign=top><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#ffffff width=100%><font class=nickname><b>' + buy + buy_c + (shop[3] ? ShopEditor(str_pr[0], 1) : '') + str_pr[1] + '</b><font class=weaponch> </font></font><br><img src=http://image.gamele.ru/1x1.gif width=1 height=3></td><td><br><img src=http://image.gamele.ru/1x1.gif width=1 height=3></td></tr><tr><td colspan=2 width=100%><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#D8CDAF width=50%><div align=center><font class=invtitle>свойства</font></div></td><td bgcolor=#B9A05C><img src=http://image.gamele.ru/1x1.gif width=1 height=1></td><td bgcolor=#D8CDAF width=50%><div align=center><font class=invtitle>требования</font></div></td></tr><tr><td bgcolor=#FCFAF3><font class=weaponch>' + ((str_pr[5] == 16) ? '<b><font color=#cc0000>&nbsp;Можно одевать на кольчуги</font></b><br>' : '') + blocks(str_pr[8]) + ((str_pr[9] == 1) ? '<b><font color=#cc0000>&nbsp;Двуручное оружие</font></b><br>' : '') + '&nbsp;Цена: <b>' + ((shop[0] > str_pr[4]) ? str_pr[4] + ' ER' : '<font color=#cc0000>' + str_pr[4] + ' ER</font>') + '</b><br>' + ViewItem_sv(str_pr[11]) + '</font></td><td bgcolor=#B9A05C><img src=http://image.gamele.ru/1x1.gif width=1 height=1></td><td bgcolor=#FCFAF3><font class=weaponch>' + ViewItem_tr(str_pr[12], str_pr[7], str_pr[6], shop[2]) + '</font></td></tr></table></td></tr></table></td></tr>';
			}
			s += '</table>';
		}else{
			d.getElementById('DynTableData').bgColor = '#FFFFFF';
            s = '<font class=freemain><font color=#3564A5><b>Вещей этой категории нет в продаже</b></font></font>';
		}
		
		d.getElementById('DynTableData').innerHTML = s;	
			
	break;
	case'Buy':
		FormPopUp('darker');
		$('DarkSize').style.width = '500px';
		$('ContentPopUp').innerHTML = '<div align=center><font class=nickname><font color=#cc0000><b>'+arr_res[1]+'</b></font></font></div>';
	break;
	}
}

view_shop = function(){
	view_build_top();
    var cats_art = [["10", "333333", "Расходники<br />"], ["7", "333333", "Стандартные артефакты<br />"], ["3", "333333", "Комплект Дракона"], ["4", "333333", "Комплект Мертвеца"], ["5", "333333", "Комплект Заката"], ["6", "333333", "Комплект Пустынных Ветров<br />"], ["1", "333333", "Комплект Героя [15]"], ["2", "333333", "Комплект Варвара [15]"]];
	d.write('<div id="tooltip"></div><table cellpadding=0 cellspacing=1 border=0 align=center width=760><tr><td width=100%><a name="top"></a></td></tr></table></td></tr><tr><td><img src=http://image.gamele.ru/1x1.gif width=1 height=2></td></tr></table><table cellpadding=0 cellspacing=0 border=0 align=center width=760><tr><td><table cellpadding=0 cellspacing=0 border=0 align=center width=760><tr></tr><tr> <td><table cellpadding=1 cellspacing=0 border=0 align=center width=100%><tr><td><FIELDSET><LEGEND align=center></LEGEND><table cellpadding=10 cellspacing=0 border=0 width=100%><tr><td><font class=nickname>');
    d.write('<a href="javascript:ShowItems(99)"><b><font color=#333333>Вещи Представителей Власти</font></b></a><br />');
    d.write('</font></td></tr></table></FIELDSET><br /><FIELDSET><div align=center id="DynTableData"><font class=nickname><font color=#3564A5><b>Выберите раздел</b></font></font></div></FIELDSET></td></tr></table></td></tr></table></td></tr></table>');
	view_build_bottom();
}

ShowItems = function(act){
	$('DynTableData').innerHTML = '<img src="http://image.gamele.ru/loader.gif">';
	AjaxGet('dhouse_ajax.php?act=Get&cat='+act+'&vcode='+ajaxp[0]+'&r='+Math.random());
}

BuyItems = function(id){
	AjaxGet('dhouse_ajax.php?act=Buy&id='+id+'&vcode='+ajaxp[0]+'&r='+Math.random());
}		

ViewItem_sv = function(params){
	var str_params = '';
	var str_pr = params.split('|');
	for (var str_val in str_pr){
		str_par = str_pr[str_val].split(':');	
		switch(str_par[0]){
            case '0':
                str_params += "&nbsp;Гравировка: <b>" + str_par[1] + "</b><br />";
                break;
            case '1':
                str_params += "&nbsp;Удар: <b>" + str_par[1] + "</b><br />";
                break;
            case '2':
                str_params += "&nbsp;Долговечность: <b>" + str_par[1] + "/" + str_par[1] + "</b><br />";
                break;
            case '3':
                str_params += "&nbsp;Карманов: <b>" + str_par[1] + "</b><br />";
                break;
            case '4':
                str_params += "&nbsp;Материал: <b>" + str_par[1] + "</b><br />";
                break;
            case '5':
                str_params += "&nbsp;Уловка: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case '6':
                str_params += "&nbsp;Точность: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case '7':
                str_params += "&nbsp;Сокрушение: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case '8':
                str_params += "&nbsp;Стойкость: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case '9':
                str_params += "&nbsp;Класс брони: <b>" + str_par[1] + "</b><br />";
                break;
            case'10':
                str_params += "&nbsp;Пробой брони: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'11':
                str_params += "&nbsp;Пробой колющим ударом: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'12':
                str_params += "&nbsp;Пробой режущим ударом: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'13':
                str_params += "&nbsp;Пробой проникающим ударом: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'14':
                str_params += "&nbsp;Пробой пробивающим ударом: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'15':
                str_params += "&nbsp;Пробой рубящим ударом: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'16':
                str_params += "&nbsp;Пробой карающим ударом: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'17':
                str_params += "&nbsp;Пробой отсекающим ударом: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'18':
                str_params += "&nbsp;Пробой дробящим ударом: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'19':
                str_params += "&nbsp;Защита от колющих ударов: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br />";
                break;
            case'20':
                str_params += "&nbsp;Защита от режущих ударов: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br />";
                break;
            case'21':
                str_params += "&nbsp;Защита от проникающих ударов: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br />";
                break;
            case'22':
                str_params += "&nbsp;Защита от пробивающих ударов: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br />";
                break;
            case'23':
                str_params += "&nbsp;Защита от рубящих ударов: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br />";
                break;
            case'24':
                str_params += "&nbsp;Защита от карающих ударов: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br />";
                break;
            case'25':
                str_params += "&nbsp;Защита от отсекающих ударов: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br />";
                break;
            case'26':
                str_params += "&nbsp;Защита от дробящих ударов: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br />";
                break;
            case'27':
                str_params += "&nbsp;НР: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br />";
                break;
            case'28':
                str_params += "&nbsp;Очки действия: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br />";
                break;
            case'29':
                str_params += "&nbsp;Мана: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br />";
                break;
            case'30':
                str_params += "&nbsp;Cила: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br />";
                break;
            case'31':
                str_params += "&nbsp;Ловкость: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br />";
                break;
            case'32':
                str_params += "&nbsp;Удача: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br />";
                break;
            case'33':
                str_params += "&nbsp;Здоровье: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br />";
                break;
            case'34':
                str_params += "&nbsp;Знания: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br />";
                break;
            case'35':
                str_params += "&nbsp;Мудрость: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br />";
                break;
            case'36':
                str_params += "&nbsp;Владение мечами: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'37':
                str_params += "&nbsp;Владение топорами: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'38':
                str_params += "&nbsp;Владение дробящим оружием: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'39':
                str_params += "&nbsp;Владение ножами: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'40':
                str_params += "&nbsp;Владение метательным оружием: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'41':
                str_params += "&nbsp;Владение алебардами и копьями: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'42':
                str_params += "&nbsp;Владение посохами: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'43':
                str_params += "&nbsp;Владение экзотическим оружием: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'44':
                str_params += "&nbsp;Владение двуручным оружием: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'45':
                str_params += "&nbsp;Магия огня: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'46':
                str_params += "&nbsp;Магия воды: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'47':
                str_params += "&nbsp;Магия воздуха: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'48':
                str_params += "&nbsp;Магия земли: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'49':
                str_params += "&nbsp;Сопротивление магии огня: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'50':
                str_params += "&nbsp;Сопротивление магии воды: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'51':
                str_params += "&nbsp;Сопротивление магии воздуха: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'52':
                str_params += "&nbsp;Сопротивление магии земли: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'53':
                str_params += "&nbsp;Воровство: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'54':
                str_params += "&nbsp;Осторожность: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'55':
                str_params += "&nbsp;Скрытность: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'56':
                str_params += "&nbsp;Наблюдательность: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'57':
                str_params += "&nbsp;Торговля: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'58':
                str_params += "&nbsp;Странник: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'59':
                str_params += "&nbsp;Языковедение: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'60':
                str_params += "&nbsp;Каллиграфия: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'61':
                str_params += "&nbsp;Ювелирное дело: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'62':
                str_params += "&nbsp;Самолечение: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'63':
                str_params += "&nbsp;Оружейник: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'64':
                str_params += "&nbsp;Доктор: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'65':
                str_params += "&nbsp;Самолечение: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'66':
                str_params += "&nbsp;Быстрое восстановление маны: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'67':
                str_params += "&nbsp;Лидерство: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'68':
                str_params += "&nbsp;Алхимия: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'69':
                str_params += "&nbsp;Развитие горного дела: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
            case'70':
                str_params += "&nbsp;Рыбалка: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br />";
                break;
		}
	}
	return str_params;
}

ViewItem_tr = function(params,massa,level,freemass){
	var str_params = '';
	var str_pr = params.split('|');
	for (var str_val in str_pr){
		str_par = str_pr[str_val].split(':');	
		if(str_par[0]==72){
			str_par[1]=level;
		}
		if(str_par[0]==71){
			str_par[1]=massa;
			shop[4][71]=shop[1]-freemass;
		}
		if(str_par[0]!=28){
			if(shop[4][str_par[0]]<str_par[1]){
				str_par[1] = '<font color=#cc0000>'+str_par[1]+'</font>';
			}
		}
		switch(str_par[0]){
            case'28':
                str_params += "&nbsp;Очки действия: <b>" + str_par[1] + "</b><br />";
                break;
            case'30':
                str_params += "&nbsp;Cила: <b>" + str_par[1] + "</b><br />";
                break;
            case'31':
                str_params += "&nbsp;Ловкость: <b>" + str_par[1] + "</b><br />";
                break;
            case'32':
                str_params += "&nbsp;Удача: <b>" + str_par[1] + "</b><br />";
                break;
            case'33':
                str_params += "&nbsp;Здоровье: <b>" + str_par[1] + "</b><br />";
                break;
            case'34':
                str_params += "&nbsp;Знания: <b>" + str_par[1] + "</b><br />";
                break;
            case'35':
                str_params += "&nbsp;Мудрость: <b>" + str_par[1] + "</b><br />";
                break;
            case'36':
                str_params += "&nbsp;Владение мечами: <b>" + str_par[1] + "</b><br />";
                break;
            case'37':
                str_params += "&nbsp;Владение топорами: <b>" + str_par[1] + "</b><br />";
                break;
            case'38':
                str_params += "&nbsp;Владение дробящим оружием: <b>" + str_par[1] + "</b><br />";
                break;
            case'39':
                str_params += "&nbsp;Владение ножами: <b>" + str_par[1] + "</b><br />";
                break;
            case'40':
                str_params += "&nbsp;Владение метательным оружием: <b>" + str_par[1] + "</b><br />";
                break;
            case'41':
                str_params += "&nbsp;Владение алебардами и копьями: <b>" + str_par[1] + "</b><br />";
                break;
            case'42':
                str_params += "&nbsp;Владение посохами: <b>" + str_par[1] + "</b><br />";
                break;
            case'43':
                str_params += "&nbsp;Владение экзотическим оружием: <b>" + str_par[1] + "</b><br />";
                break;
            case'44':
                str_params += "&nbsp;Владение двуручным оружием: <b>" + str_par[1] + "</b><br />";
                break;
            case'45':
                str_params += "&nbsp;Магия огня: <b>" + str_par[1] + "</b><br />";
                break;
            case'46':
                str_params += "&nbsp;Магия воды: <b>" + str_par[1] + "</b><br />";
                break;
            case'47':
                str_params += "&nbsp;Магия воздуха: <b>" + str_par[1] + "</b><br />";
                break;
            case'48':
                str_params += "&nbsp;Магия земли: <b>" + str_par[1] + "</b><br />";
                break;
            case'53':
                str_params += "&nbsp;Воровство: <b>" + str_par[1] + "</b><br />";
                break;
            case'54':
                str_params += "&nbsp;Осторожность: <b>" + str_par[1] + "</b><br />";
                break;
            case'55':
                str_params += "&nbsp;Скрытность: <b>" + str_par[1] + "</b><br />";
                break;
            case'56':
                str_params += "&nbsp;Наблюдательность: <b>" + str_par[1] + "</b><br />";
                break;
            case'57':
                str_params += "&nbsp;Торговля: <b>" + str_par[1] + "</b><br />";
                break;
            case'58':
                str_params += "&nbsp;Странник: <b>" + str_par[1] + "</b><br />";
                break;
            case'59':
                str_params += "&nbsp;Языковедение: <b>" + str_par[1] + "</b><br />";
                break;
            case'60':
                str_params += "&nbsp;Каллиграфия: <b>" + str_par[1] + "</b><br />";
                break;
            case'61':
                str_params += "&nbsp;Ювелирное дело: <b>" + str_par[1] + "</b><br />";
                break;
            case'62':
                str_params += "&nbsp;Самолечение: <b>" + str_par[1] + "</b><br />";
                break;
            case'63':
                str_params += "&nbsp;Оружейник: <b>" + str_par[1] + "</b><br />";
                break;
            case'64':
                str_params += "&nbsp;Доктор: <b>" + str_par[1] + "</b><br />";
                break;
            case'65':
                str_params += "&nbsp;Самолечение: <b>" + str_par[1] + "</b><br />";
                break;
            case'66':
                str_params += "&nbsp;Быстрое восстановление маны: <b>" + str_par[1] + "</b><br />";
                break;
            case'67':
                str_params += "&nbsp;Лидерство: <b>" + str_par[1] + "</b><br />";
                break;
            case'68':
                str_params += "&nbsp;Алхимия: <b>" + str_par[1] + "</b><br />";
                break;
            case'69':
                str_params += "&nbsp;Развитие горного дела: <b>" + str_par[1] + "</b><br />";
                break;
            case'70':
                str_params += "&nbsp;Рыбалка: <b>" + str_par[1] + "</b><br />";
                break;
            case'71':
                str_params += "&nbsp;Масса: <b>" + str_par[1] + "</b><br />";
                break;
            case'72':
                str_params += "&nbsp;Уровень: <b>" + str_par[1] + "</b><br />";
                break;
		}
	}
	return str_params;
}

function blocks(bl){
	var str_params = '';
	if(bl!="") {
		switch(bl){
            case'40':
                str_params += '<b><font color=#cc0000>&nbsp;Блокировка 1-ой точки</font></b><br />';
                break;
            case'70':
                str_params += '<b><font color=#cc0000>&nbsp;Блокировка 2-х точек</font></b><br />';
                break;
            case'90':
                str_params += '<b><font color=#cc0000>&nbsp;Блокировка 3-х точек</font></b><br />';
                break;
		}
	}
	return str_params;
}