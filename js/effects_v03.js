var d = document;
var effects = ['', 'Легкая травма', 'Средняя травма', 'Тяжелая травма', 'Осложненная травма', 'Излечение', '', '', 'Темное проклятие', 'Благословение ангела', 'Магическое зеркало', 'Берсеркер', 'Милосердие Создателя', 'Алкогольное опьянение', 'Свиток Покровительства', 'Блок', 'Тюрьма', 'Молчанка', 'Форумная молчанка', 'Свиток Неизбежности', 'Зелье Колкости', 'Зелье Загрубелой Кожи', 'Зелье Просветления', 'Зелье Гения', 'Яд', 'Зелье Иммунитета', 'Зелье Силы', 'Зелье Защиты От Ожогов', 'Зелье Арктических Вьюг', 'Зелье Жизни', 'Зелье Сокрушительных Ударов', 'Зелье Стойкости', 'Зелье Недосягаемости', 'Зелье Точного Попадания', 'Зелье Ловкости', 'Зелье Удачи', 'Зелье Огненного Ореола', 'Зелье Метаболизма', 'Зелье Медитации', 'Зелье Громоотвода', 'Зелье Сильной Спины', 'Зелье Скорбь Лешего', 'Зелье Боевой Славы', 'Зелье Ловких Ударов', 'Зелье Спокойствия', 'Зелье Мужества', 'Зелье Человек-Гора', 'Зелье Секрет Волшебника', 'Зелье Инквизитора', 'Зелье Панциря', '', 'Секретное Зелье', 'Зелье Скорости', 'Зелье Соколиный Взор', 'Зелье Подвижности', 'Фронтовые 100 грамм', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Зелье Кровожадности', 'Зелье Быстроты', 'Свиток Величия', 'Свиток Каменной кожи', 'Слеза Создателя', 'Гнев Локара', 'Дар Иланы', 'Новогодний бонус', 'Эликсир из Подснежника', 'Молодильное яблочко', 'Благословение Иланы', 'День всех влюбленных', 'Галантный кавалер', 'Рыбный Самогон', 'Рыбная Водка', 'Баалагорский Травяной Настой', 'Рыбный Шнапс', 'Грибной Джин', 'Цветочный Пунш', 'Коньяк «Дубовый', 'Пойло Волшебника', '', '', '', '', '', ''];

function effects_view(elementid)
{
    var i;
    var a = cureff.length;
    
    if(a)
    {
        tid = d.getElementById(elementid);
        for(i=0; i<a; i++)
        {
            if(effects[cureff[i][0]]) tid.innerHTML += '<img src="/img/image/pinfo/eff_'+cureff[i][0]+'.gif" width="29" height="29" onmouseover="tooltip(this,\'<b>'+effects[cureff[i][0]]+'</b> '+effects_time(cureff[i][1])+((cureff[i][2])?'<br />'+effect_params(cureff[i][2]):'')+'\')" onmouseout="hide_info(this)"> ';
        }
    }
}

function effects_time(time)
{
    var h,m,s;
    h = m = 0;
    if(time > 0) h = parseInt(time / 3600);
    time -= 3600 * h;
    if(time > 0) m = parseInt(time / 60);
    time -= 60 * m;
    s = time;
    return '(еще ' + (h < 10 ? '0' + h : h) + ':' + (m < 10 ? '0' + m : m) + ':' + (s < 10 ? '0' + s : s) + ')';
}

function effect_params(params){
	var str_params = '';
	var str_pr = params.split(';');
	for (var str_val in str_pr){
		str_par = str_pr[str_val].split('/');	
		switch(str_par[0]){
            case'1':
                str_params += "&nbsp;Удар: <b>" + str_par[1] + "</b><br>";
                break;
            case'5':
                str_params += "&nbsp;Уловка: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br>";
                break;
            case'6':
                str_params += "&nbsp;Точность: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br>";
                break;
            case'7':
                str_params += "&nbsp;Сокрушение: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br>";
                break;
            case'8':
                str_params += "&nbsp;Стойкость: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br>";
                break;
            case'9':
                str_params += "&nbsp;Класс брони: <b>" + str_par[1] + "</b><br>";
                break;
            case'10':
                str_params += "&nbsp;Пробой брони: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br>";
                break;
            case'11':
                str_params += "&nbsp;Пробой колющим ударом: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'12':
                str_params += "&nbsp;Пробой режущим ударом: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'13':
                str_params += "&nbsp;Пробой проникающим ударом: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'14':
                str_params += "&nbsp;Пробой пробивающим ударом: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'15':
                str_params += "&nbsp;Пробой рубящим ударом: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'16':
                str_params += "&nbsp;Пробой карающим ударом: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'17':
                str_params += "&nbsp;Пробой отсекающим ударом: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'18':
                str_params += "&nbsp;Пробой дробящим ударом: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'19':
                str_params += "&nbsp;Защита от колющих ударов: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br>";
                break;
            case'20':
                str_params += "&nbsp;Защита от режущих ударов: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br>";
                break;
            case'21':
                str_params += "&nbsp;Защита от проникающих ударов: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br>";
                break;
            case'22':
                str_params += "&nbsp;Защита от пробивающих ударов: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br>";
                break;
            case'23':
                str_params += "&nbsp;Защита от рубящих ударов: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br>";
                break;
            case'24':
                str_params += "&nbsp;Защита от карающих ударов: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br>";
                break;
            case'25':
                str_params += "&nbsp;Защита от отсекающих ударов: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br>";
                break;
            case'26':
                str_params += "&nbsp;Защита от дробящих ударов: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br>";
                break;
            case'27':
                str_params += "&nbsp;НР: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br>";
                break;
            case'28':
                str_params += "&nbsp;Очки действия: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br>";
                break;
            case'29':
                str_params += "&nbsp;Мана: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br>";
                break;
            case'30':
                str_params += "&nbsp;Мощь: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br>";
                break;
            case'31':
                str_params += "&nbsp;Проворность: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br>";
                break;
            case'32':
                str_params += "&nbsp;Везение: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br>";
                break;
            case'33':
                str_params += "&nbsp;Здоровье: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br>";
                break;
            case'34':
                str_params += "&nbsp;Разум: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br>";
                break;
            case'35':
                str_params += "&nbsp;Сноровка: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</b><br>";
                break;
            case'36':
                str_params += "&nbsp;Владение мечами: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'37':
                str_params += "&nbsp;Владение топорами: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'38':
                str_params += "&nbsp;Владение дробящим оружием: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'39':
                str_params += "&nbsp;Владение ножами: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'40':
                str_params += "&nbsp;Владение метательным оружием: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'41':
                str_params += "&nbsp;Владение алебардами и копьями: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'42':
                str_params += "&nbsp;Владение посохами: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'43':
                str_params += "&nbsp;Владение экзотическим оружием: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'44':
                str_params += "&nbsp;Владение двуручным оружием: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'45':
                str_params += "&nbsp;Магия огня: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'46':
                str_params += "&nbsp;Магия воды: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'47':
                str_params += "&nbsp;Магия воздуха: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'48':
                str_params += "&nbsp;Магия земли: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'49':
                str_params += "&nbsp;Сопротивление магии огня: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'50':
                str_params += "&nbsp;Сопротивление магии воды: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'51':
                str_params += "&nbsp;Сопротивление магии воздуха: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'52':
                str_params += "&nbsp;Сопротивление магии земли: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'53':
                str_params += "&nbsp;Воровство: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'54':
                str_params += "&nbsp;Осторожность: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'55':
                str_params += "&nbsp;Скрытность: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'56':
                str_params += "&nbsp;Наблюдательность: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'57':
                str_params += "&nbsp;Торговля: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'58':
                str_params += "&nbsp;Странник: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'59':
                str_params += "&nbsp;Рыболов: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'60':
                str_params += "&nbsp;Лесоруб: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'61':
                str_params += "&nbsp;Ювелирное дело: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'62':
                str_params += "&nbsp;Самолечение: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'63':
                str_params += "&nbsp;Оружейник: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'64':
                str_params += "&nbsp;Доктор: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'65':
                str_params += "&nbsp;Самолечение: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'66':
                str_params += "&nbsp;Быстрое восстановление маны: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'67':
                str_params += "&nbsp;Лидерство: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'68':
                str_params += "&nbsp;Алхимия: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'69':
                str_params += "&nbsp;Развитие горного дела: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'70':
                str_params += "&nbsp;Травничество: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'99':
                str_params += "&nbsp;Понижения урона: " + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</b><br>";
                break;
            case'expbonus':
                str_params += "&nbsp;Бонус Опыта: <font color=#BB0000>" + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "%</font></b><br>";
                break;
            case'massbonus':
                str_params += "&nbsp;Масса: <font color=#BB0000>" + ((str_par[1]) > 0 ? '+' : '') + "<b>" + str_par[1] + "</font></b><br>";
                break;
		}
	}
	return str_params;
}