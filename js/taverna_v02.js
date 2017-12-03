var Category = 0;
var TDataL = 0;
var DTAB = false;

function StateReady() {
    switch (arr_res[0]) {
        case '1':

            var i, j, tr_obj, table_obj, td_obj, str_pr;
            var all_i = arr_res.length - 1;
            var s = Math.floor(all_i / 4);

            var dynamic = document.getElementById('Dynamic');
            while (dynamic.children.length > 0) {
                dynamic.removeChild(dynamic.lastChild);
            }

            DTAB = document.createElement('table');
            DTAB.id = 'TDyn';
            DTAB.cellPadding = '5';
            DTAB.cellSpacing = '1';
            DTAB.border = '0';
            DTAB.width = '100%';
            dynamic.appendChild(DTAB);

            table_obj = DTAB;

            var k = 0;

            for (i = 0; i <= s; i++) {
                tr_obj = table_obj.insertRow(i);
                for (j = 0; j < 4; j++) {
                    k += 1;
                    td_obj = tr_obj.insertCell(j);

                    if (all_i >= k) {
                        str_pr = arr_res[k].split('|');
                        td_obj.innerHTML = '<img src=/img/image/1x1.gif width=1 height=5><br><img src=/img/image/tools/' + str_pr[2] + '.gif width=60 height=60 onmouseover="tooltip(this,\'' + TavernaToolTip(eval(str_pr[5])) + '\')" onmouseout="hide_info(this)"><br><img src=/img/image/1x1.gif width=1 height=5><br><b>Стоимость: ' + str_pr[4] + ' </b><br>Остаток: ' + str_pr[1] + '<br><br>' + AddButton(eval(str_pr[6]));
                    }

                    td_obj.bgColor = '#FFFFFF';
                    td_obj.align = 'center';
                    td_obj.width = '25%';
                    td_obj.className = 'filt';
                }
            }
            break;
        case 'ITEMS':
            ItemsView();
            break;
    }
}

function view_taverna() {
    view_build_top();
    var Title = ['', 'Выпивка', 'Еда/Закуска'];
    d.write('<div id="tooltip"></div><table cellpadding=0 cellspacing=0 border=0 align=center width=760><tr><td><legend align="center"><b><table cellpadding=0 cellspacing=1 border=0 align=center width=760><tr><td bgcolor=#f1f1f1 width=100%><a name="top"></a><img src=/img/1x1.gif width=1 height=3></td></tr><tr><td bgcolor=#3564A5 width=100%><img src=/img/1x1.gif width=1 height=3></td></tr><tr><td><img src=/img/image/gameplay/taverna/taverna.jpg width=760 height=255 border=0></td></tr><tr><td><img src=/img/1x1.gif width=1 height=2></td></tr><tr><td bgcolor=#CCCCCC><table cellpadding=0 cellspacing=0 border=0 width=100%></td></tr><tr><td><img src=/img/image/1x1.gif width=1 height=2></td></tr><tr><td bgcolor=#CCCCCC><table cellpadding=4 cellspacing=1 border=0 width=100%><tr>');
    for (var i = 1; i < 3; i++) d.write('<td bgcolor=#FFFFFF align=center width=25% id="Cat' + i + '"><b><a href="javascript: TavernaShow(' + i + ');"><font class=category>' + Title[i] + '</font></a></b></td>');
    d.write('</tr></table></td></tr><tr><td><img src=/img/image/1x1.gif width=1 height=2></td></tr><tr><td bgcolor=#CCCCCC></td></tr><tr><td><img src=/img/image/1x1.gif width=1 height=2></td></tr></table><table cellpadding=0 cellspacing=0 border=0 align=center width=760><tr><td bgcolor=#CCCCCC id="Dynamic" width="100%"></td></tr></table>');
    view_build_bottom();
}

function TavernaShow(t) {
    if (Category != t) {
        if (Category) d.getElementById('Cat' + Category).bgColor = '#FFFFFF';
        d.getElementById('Cat' + t).bgColor = '#E0E0E0';
        Category = t;
    }

    switch (t) {
        case 1:
            AjaxGet('taverna_ajax.php?act=1&type=1&vcode=' + taverna[1] + '&r=' + Math.random());
            break;
        case 2:
            AjaxGet('taverna_ajax.php?act=1&type=2&vcode=' + taverna[1] + '&r=' + Math.random());
            break;
    }
}

function TavernaToolTip(descr) {
    var str_params = '';
    var st = '';
    if (descr[0]) str_params += '<B>' + descr[0] + '</B>';
    for (var i = 1; i < descr.length; i++) {
        st = descr[i][2] ? ' (' + (descr[i][2] / 60) + ' ч)' : '';
        switch (descr[i][0]) {
            case 'LI':
                str_params += '<BR>Лимит: <B>' + (!descr[i][1] ? 'без ограничений' : descr[i][1] + ' шт') + '</B>' + st;
                break;
            case 'EFF':
                str_params += '<BR><font color=#CC0000><B>Побочный эффект</B> (через <B>' + (descr[i][1] / 60) + '</B> ч):</font>';
                break;
            case 'HP':
                str_params += '<BR>Восстановление HP: +<B>' + descr[i][1] + '</B>' + st;
                break;
            case 'MP':
                str_params += '<BR>Восстановление MP: +<B>' + descr[i][1] + '</B>' + st;
                break;
            case 'US':
                str_params += '<BR>Усталость: -<B>' + descr[i][1] + '</B>' + st;
                break;
            case 'R_ST':
                str_params += '<BR>Случайный стат: +<B>' + descr[i][1] + '</B>' + st;
                break;
            case 'R_MF':
                str_params += '<BR>Случайный МФ: +<B>' + descr[i][1] + '</B>' + st;
                break;
            case 'RB_ST':
                str_params += '<BR>Случайный стат: ' + (descr[i][4] == '1' ? '+' : '-') + '<B>' + descr[i][1] + '-' + descr[i][3] + '</B>' + st;
                break;
            case 'RB_MF':
                str_params += '<BR>Случайный МФ: ' + (descr[i][4] == '1' ? '+' : '-') + '<B>' + descr[i][1] + '-' + descr[i][3] + '</B>' + st;
                break;
            case'1':
                str_params += '<BR>Удар: <B>' + descr[i][1] + '</B>' + st;
                break;
            case'5':
                str_params += '<BR>Уловка: +<B>' + descr[i][1] + '</B>' + st;
                break;
            case'6':
                str_params += '<BR>Точность: +<B>' + descr[i][1] + '</B>' + st;
                break;
            case'7':
                str_params += '<BR>Сокрушение: +<B>' + descr[i][1] + '</B>' + st;
                break;
            case'8':
                str_params += '<BR>Стойкость: +<B>' + descr[i][1] + '</B>' + st;
                break;
            case'9':
                str_params += '<BR>Класс брони: <B>' + descr[i][1] + '</B>' + st;
                break;
            case'10':
                str_params += '<BR>Пробой брони: +<B>' + descr[i][1] + '</B>' + st;
                break;
            case'11':
                str_params += '<BR>Пробой колющим ударом: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'12':
                str_params += '<BR>Пробой режущим ударом: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'13':
                str_params += '<BR>Пробой проникающим ударом: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'14':
                str_params += '<BR>Пробой пробивающим ударом: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'15':
                str_params += '<BR>Пробой рубящим ударом: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'16':
                str_params += '<BR>Пробой карающим ударом: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'17':
                str_params += '<BR>Пробой отсекающим ударом: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'18':
                str_params += '<BR>Пробой дробящим ударом: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'19':
                str_params += '<BR>Защита от колющих ударов: +<B>' + descr[i][1] + '</B>' + st;
                break;
            case'20':
                str_params += '<BR>Защита от режущих ударов: +<B>' + descr[i][1] + '</B>' + st;
                break;
            case'21':
                str_params += '<BR>Защита от проникающих ударов: +<B>' + descr[i][1] + '</B>' + st;
                break;
            case'22':
                str_params += '<BR>Защита от пробивающих ударов: +<B>' + descr[i][1] + '</B>' + st;
                break;
            case'23':
                str_params += '<BR>Защита от рубящих ударов: +<B>' + descr[i][1] + '</B>' + st;
                break;
            case'24':
                str_params += '<BR>Защита от карающих ударов: +<B>' + descr[i][1] + '</B>' + st;
                break;
            case'25':
                str_params += '<BR>Защита от отсекающих ударов: +<B>' + descr[i][1] + '</B>' + st;
                break;
            case'26':
                str_params += '<BR>Защита от дробящих ударов: +<B>' + descr[i][1] + '</B>' + st;
                break;
            case'27':
                str_params += '<BR>НР: +<B>' + descr[i][1] + '</B>' + st;
                break;
            case'28':
                str_params += '<BR>Очки действия: +<B>' + descr[i][1] + '</B>' + st;
                break;
            case'29':
                str_params += '<BR>Мана: +<B>' + descr[i][1] + '</B>' + st;
                break;
            case'30':
                str_params += '<BR>Мощь: +<B>' + descr[i][1] + '</B>' + st;
                break;
            case'31':
                str_params += '<BR>Проворность: +<B>' + descr[i][1] + '</B>' + st;
                break;
            case'32':
                str_params += '<BR>Везение: +<B>' + descr[i][1] + '</B>' + st;
                break;
            case'33':
                str_params += '<BR>Здоровье: +<B>' + descr[i][1] + '</B>' + st;
                break;
            case'34':
                str_params += '<BR>Разум: +<B>' + descr[i][1] + '</B>' + st;
                break;
            case'35':
                str_params += '<BR>Сноровка: +<B>' + descr[i][1] + '</B>' + st;
                break;
            case'36':
                str_params += '<BR>Владение мечами: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'37':
                str_params += '<BR>Владение топорами: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'38':
                str_params += '<BR>Владение дробящим оружием: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'39':
                str_params += '<BR>Владение ножами: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'40':
                str_params += '<BR>Владение метательным оружием: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'41':
                str_params += '<BR>Владение алебардами и копьями: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'42':
                str_params += '<BR>Владение посохами: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'43':
                str_params += '<BR>Владение экзотическим оружием: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'44':
                str_params += '<BR>Владение двуручным оружием: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'45':
                str_params += '<BR>Магия огня: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'46':
                str_params += '<BR>Магия воды: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'47':
                str_params += '<BR>Магия воздуха: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'48':
                str_params += '<BR>Магия земли: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'49':
                str_params += '<BR>Сопротивление магии огня: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'50':
                str_params += '<BR>Сопротивление магии воды: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'51':
                str_params += '<BR>Сопротивление магии воздуха: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'52':
                str_params += '<BR>Сопротивление магии земли: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'53':
                str_params += '<BR>Воровство: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'54':
                str_params += '<BR>Осторожность: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'55':
                str_params += '<BR>Скрытность: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'56':
                str_params += '<BR>Наблюдательность: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'57':
                str_params += '<BR>Торговля: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'58':
                str_params += '<BR>Странник: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'59':
                str_params += '<BR>Рыболов: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'60':
                str_params += '<BR>Лесоруб: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'61':
                str_params += '<BR>Ювелирное дело: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'62':
                str_params += '<BR>Самолечение: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'63':
                str_params += '<BR>Оружейник: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'64':
                str_params += '<BR>Доктор: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'65':
                str_params += '<BR>Самолечение: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'66':
                str_params += '<BR>Быстрое восстановление маны: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'67':
                str_params += '<BR>Лидерство: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'68':
                str_params += '<BR>Алхимия: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'69':
                str_params += '<BR>Развитие горного дела: +<B>' + descr[i][1] + '%</B>' + st;
                break;
            case'70':
                str_params += '<BR>Травничество: +<B>' + descr[i][1] + '%</B>' + st;
                break;
        }
    }
    return str_params;
}