var d = document;
var align = [[], ["darks.gif", "Дети Тьмы"], ["lights.gif", "Дети Света"], ["sumers.gif", "Дети Сумерек"], ["chaoss.gif", "Дети Хаоса"], ["light.gif", "Истинный Свет"], ["dark.gif", "Истинная Тьма"], ["sumer.gif", "Нейтральные Сумерки"], ["chaos.gif", "Абсолютный Хаос"], ["angel.gif", "Ангел"]];

switch_block = function (id, next) {
    var obj = document.getElementById(id);
    var val = (next == true ? 1 : -1);
    var length = obj.children.length;
    if (length < 2) return;
    for (var i = 0; i < length; i++) {
        var cur = obj.children[i];
        if (cur.style.display == 'block') {
            if (i == 0 && val < 0) {
                var need = obj.children[length - 1];
            }
            else if (i == (length - 1) && val > 0) {
                var need = obj.children[0];
            }
            else {
                var need = obj.children[i + val];
            }
            cur.style.display = 'none';
            need.style.display = 'block';
            return;
        }
    }
}

zero_put = function (cur, max) {
    var max_zero = 4;
    var cur_l = cur.length;
    var max_l = max.length;
    if (max_l > 4) max_zero = max_l;
    var str_temp = '', i;
    for (i = cur_l; i < max_zero; i++) str_temp += '0';
    str_temp += cur + '/';
    for (i = max_l; i < max_zero; i++) str_temp += '0';
    str_temp += max;
    return str_temp;
}

sl_view = function (m, w, h) {
    var arr = m.split(':', 3);
    var alt = '<b>' + arr[1] + '</b>';
    if (arr[2]) alt += sl_alts(arr[2]);
    return '<img src=http://image.guild-honor.ru/weapon/' + arr[0] + ' width=' + w + ' height=' + h + ' onmouseover="tooltip(this,\'' + alt + '\')" onmouseout="hide_info(this)">';
}

sl_alts = function (p) {
    var temp = '';
    var params = p.split('|');
    params[4] = parseInt(params[4]);
    if (params[0]) temp += ' (' + params[0] + ')';
    if (parseInt(params[1]) != 0) temp += '<br>' + 'Удар: ' + params[1] + '-' + params[2];
    if (parseInt(params[3]) != 0) temp += '<br>' + 'Класс брони: +' + params[3];
    if (params[4] > 0) temp += '<br>' + 'Пробой брони: +' + params[4];
    else if (params[4] < 0) temp += '<br>' + 'Пробой брони: ' + params[4];
    if (parseInt(params[5]) != 0) temp += '<br>' + 'HP: +' + params[5];
    if (parseInt(params[6]) != 0) temp += '<br>' + 'MP: +' + params[6];
    return temp;
}

top_small = function (t) {
    switch (t) {
        case 1:
            return '<a href="http://top.mail.ru/jump?from=1514311" target="_blank"><img src="http://d6.c2.ba.a0.top.mail.ru/counter?id=1514311;t=69;js=13;r=' + r + ';j=' + navigator.javaEnabled() + ';s=' + sfo + ';d=' + dep + ';rand=' + Math.random() + '" border="0" height="31" width="38" style="filter:alpha(opacity=50);"></a>';
        case 2:
            return '<a href="http://www.liveinternet.ru/click" target="_blank"><img src="http://counter.yadro.ru/hit?t44.2;r' + r + ((typeof(s) == 'undefined') ? '' : ';s' + sfo + '*' + dep) + ';u' + escape(d.URL) + ';' + Math.random() + '" border="0" width="31" height="31" style="filter:alpha(opacity=50);"></a>';
    }
}

view_pinfo_top = function () {
    var i;

    var h_hp = Math.round(151 * hpmp[0] / hpmp[1]);
    var h_mp = (hpmp[3] ? Math.round(151 * hpmp[2] / hpmp[3]) : 0);

    var slots_arr = slots[0].split('@');
    var places = params[0][5].split('[');

    d.write('<div id="tooltip"></div><div id="main"><div id="effects">');
    for (i = 0; i < effects.length; i++) d.write('<img src="http://image.guild-honor.ru/pinfo/eff_' + effects[i][0] + '.gif" width="29" height="29" onmouseover="tooltip(this,\'' + effects[i][1] + '\')" onmouseout="hide_info(this)">');
    d.write('</div><div id="znaki">');
    for (i = 0; i < ability.length; i++) d.write('<img src="http://image.guild-honor.ru/pinfo/t' + ability[i][0] + '.gif" width="44" height="45" onmouseover="tooltip(this,\'' + ability[i][1] + '\')" onmouseout="hide_info(this)">');
    d.write('</div><table cellspacing="0" cellpadding="0" border="0" width="1004px"><tr><td style="width:296px"><table class="infoblock" style="margin:125px 0 0 35px;" cellspacing="0" cellpadding="0" border="0"><tr><td class="left"><div class="top_left_left"></div></td><td class="layer"><div></div></td><td class="center" style="width:232px;"><div class="top_name_left">Характеристики</div><div class="chars">');
    var stats = 0;
    for (i = 0; i < params[1].length; i++) {
        stats = params[1][i][1] + params[1][i][2];
        d.write((i ? '<div class="underline"></div>' : '') + '<div class="char_item"><div>' + params[1][i][0] + ':</div><span class="tb"><b>' + (stats > 1 ? stats : 1) + '</b>' + (params[1][i][2] ? '<u>(' + params[1][i][1] + (params[1][i][2] > 0 ? '+' : '') + params[1][i][2] + ')</u>' : '') + '</span></div>');
    }
    d.write('<div class="uzor"></div>');
    for (i = 0; i < params[2].length; i++) d.write((i ? '<div class="underline"></div>' : '') + '<div class="char_item"><div>' + params[2][i][0] + ':</div><span><strong>' + params[2][i][1] + '</strong></span></div>');
    d.write('</div></td><td class="layer"><div></div></td><td class="right"><div class="top_right_left"></div></td></tr><tr><td class="bot_left"></td><td class="bot_layer"><div></div></td><td class="bot_center"></td><td class="bot_layer"><div></div></td><td class="bot_right"></td></tr></table></td><td style="width:392px;height:508px; overflow:hidden;"><div id="top_username_block"><div id="top_username"><div><div>');
    if (params[0][1] > 0) d.write('<img src=http://image.guild-honor.ru/signs/' + align[params[0][1]][0] + ' width=15 height=12 border=0 align=absmiddle onmouseover="tooltip(this,\'' + align[params[0][1]][1] + '\')" onmouseout="hide_info(this)"> ');
    if (params[0][2] != 'none') d.write('<img src=http://image.guild-honor.ru/signs/' + params[0][2] + ' width=15 height=12 border=0 align=absmiddle onmouseover="tooltip(this,\'' + params[0][8] + '\')" onmouseout="hide_info(this)">&nbsp;');
    d.write(params[0][0] + ' [' + params[0][3] + '] <SUP>' + hpmp[4] + '%</SUP></div></div></div></div><table width="360" class="center_info" height="431" border="0" cellpadding="0" cellspacing="0"><tr><td class="top_left" rowspan="5"><div id="left_hp"><div style="height:' + h_hp + 'px; margin-top:' + (151 - h_hp) + 'px;"></div></div><img src="http://image.guild-honor.ru/pinfo/center_info_bg_01.png" width="52" height="350" alt=""></td><td class="top_center" colspan="5"><img src="http://image.guild-honor.ru/pinfo/center_info_bg_02.png" width="253" height="37" alt=""></td><td class="top_right" rowspan="5"><div id="right_mp"><div style="height:' + h_mp + 'px; margin-top:' + (151 - h_mp) + 'px;"></div></div><img src="http://image.guild-honor.ru/pinfo/center_info_bg_03.png" width="54" height="350" alt=""></td><td><img src="http://image.guild-honor.ru/pinfo/spacer.gif" width="1" height="37" alt=""></td></tr><tr><td rowspan="3">' + sl_view(slots_arr[0], 62, 65) + sl_view(slots_arr[1], 62, 35) + sl_view(slots_arr[2], 62, 91) + sl_view(slots_arr[3], 62, 30) + sl_view(slots_arr[4], 20, 20) + '<img src=http://image.guild-honor.ru/weapon/slots/1x1gr.gif width=1 height=20>' + sl_view(slots_arr[5], 20, 20) + '<img src=http://image.guild-honor.ru/weapon/slots/1x1gr.gif width=1 height=20>' + sl_view(slots_arr[6], 20, 20) + sl_view(slots_arr[7], 62, 63) + '</td><td rowspan="2"><img src="http://image.guild-honor.ru/pinfo/center_info_bg_05.jpg" width="7" height="278" alt=""></td><td><img src="http://image.guild-honor.ru/pinfo/center_info_bg_06.jpg" width="115" height="23" alt=""></td><td rowspan="2"><img src="http://image.guild-honor.ru/pinfo/center_info_bg_07.jpg" width="7" height="278" alt=""></td><td rowspan="3">' + sl_view(slots_arr[8], 20, 19) + sl_view(slots_arr[9], 42, 19) + sl_view(slots_arr[10], 62, 40) + sl_view(slots_arr[11], 62, 40) + sl_view(slots_arr[12], 62, 91) + sl_view(slots_arr[13], 31, 31) + sl_view(slots_arr[14], 31, 31) + sl_view(slots_arr[15], 62, 83) + '</td><td><img src="http://image.guild-honor.ru/pinfo/spacer.gif" width="1" height="23" alt=""></td></tr><tr><td><img src="http://image.guild-honor.ru/obrazy/' + params[0][4] + '" width="115" height="255" alt=""></td><td><img src="http://image.guild-honor.ru/pinfo/spacer.gif" width="1" height="255" alt=""></td></tr><tr><td colspan="3"><img src="http://image.guild-honor.ru/pinfo/center_info_bg_10.jpg" width="129" height="26" alt=""></td><td><img src="http://image.guild-honor.ru/pinfo/spacer.gif" width="1" height="26" alt=""></td></tr><tr><td class="bot_ind" colspan="5" rowspan="2"><div class="bot_hp">' + zero_put(hpmp[0].toString(), hpmp[1].toString()) + '</div><div class="bot_mp">' + zero_put(hpmp[2].toString(), hpmp[3].toString()) + '</div></td><td><img src="http://image.guild-honor.ru/pinfo/spacer.gif" width="1" height="9" alt=""></td></tr><tr><td class="bot_left" rowspan="2"><img src="http://image.guild-honor.ru/pinfo/center_info_bg_12.png" width="52" height="81" alt=""></td><td class="bot_right" rowspan="2"><img src="http://image.guild-honor.ru/pinfo/center_info_bg_05.png" width="54" height="81" alt=""></td><td><img src="http://image.guild-honor.ru/pinfo/spacer.gif" width="1" height="8" alt=""></td></tr><tr><td class="bot_center" colspan="5"><div class="text_block_cont"><div class="text_block"><div><div>' + (params[0][6] ? '<b>' + places[0].slice(0, -1) + '</b>' + (params[0][7] ? ' [ <a href="./logs.php?fid=' + params[0][7] + '" target=_blank style="color:#ff3036;"><b>в бою</b></a> ]' : '') + '<br>' + places[1].slice(0, -1) : '<b>Персонаж находится вне мира</b><br>Местоположение: неизвестно') + '</div></div></div></div><img src="http://image.guild-honor.ru/pinfo/center_info_bg_14.png" width="253" height="73" alt=""></td><td><img src="http://image.guild-honor.ru/pinfo/spacer.gif" width="1" height="73" alt=""></td></tr></table><td style="width:296px"><table class="infoblock" style="margin:125px 0 0 0;" cellspacing="0" cellpadding="0" border="0"><tr><td class="left"><div class="top_left_right"></div></td><td class="layer"><div></div></td><td class="center" style="width:232px;"><div class="top_name_right">Информация</div><div class="info_text"><div class="line_text">Место рождения: <strong>' + params[0][10] + '</strong></div><div class="underline"></div><div class="line_text">Дата рождения: <strong>' + params[0][11] + '</strong></div>' + (params[0][12] ? '<div class="underline"></div><div class="line_text">В браке: <strong><a href="http://www.guild-honor.ru/pinfo.cgi?' + params[0][12] + '">' + params[0][12] + '</a></strong></div>' : '') + (params[0][9] ? '<div class="underline"></div><div class="line_text"><b>' + params[0][9] + '</b></div>' : '') + '</div></td><td class="layer"><div></div></td><td class="right"><div class="top_right_right"></div></td></tr><tr><td class="bot_left"></td><td class="bot_layer"><div></div></td><td class="bot_center"></td><td class="bot_layer"><div></div></td><td class="bot_right"></td></tr></table><table class="infoblock" style="margin:15px 0 0 0;" cellspacing="0" cellpadding="0" border="0"><tr><td class="left" style="vertical-align:middle;"></td><td class="center" style="width:232px; padding:0 11px;"><div class="top_name_right">Документы</div><div id="progress" align=center><br><br><font style="color:#dcdcdc;font: 13px Verdana;font-weight:bold;">нет документов</font><br><br></div></td><td style="vertical-align:middle;" class="right"></td></tr><tr><td class="bot_left"></td><td class="bot_center"></td><td class="bot_right"></td></tr></table><table class="infoblock" style="margin:15px 0 0 0;" cellspacing="0" cellpadding="0" border="0"><tr><td class="left" style="vertical-align:middle;"></td><td class="center" style="width:232px; padding:0 11px;"><div class="top_name_right">Награды</div><div id="awards" align="center"><br><br><font style="color:#dcdcdc;font: 13px Verdana;font-weight:bold;">нет наград</font><br><br></div></td><td style="vertical-align:middle;" class="right"></td></tr><tr><td class="bot_left"></td><td class="bot_center"></td><td class="bot_right"></td></tr></table></td></tr></table><div class="div"><div class="div_block"><div class="div_right"><div class="div_gr" style="width: 860px;"><div class="div_center"></div></div></div></div></div><div class="presents">');

    var pr_c = presents.length;

    for (i = 0; i < pr_c; i++) d.write('<img src=http://image.guild-honor.ru/presents/' + presents[i][0] + '.gif width=100 height=100 onmouseover="tooltip(this,\'' + presents[i][1] + '\')" onmouseout="hide_info(this)">');
    d.write('</div>');
    if (pr_c) d.write('<div class="div"><div class="div_block"><div class="div_right"><div class="div_gr" style="width: 660px;"><div class="div_center2"></div></div></div></div></div>');

    d.write('<table class="infoblock2" cellspacing="0" cellpadding="0" border="0"><tr><td class="left_top"><div class="top_left_right"></div></td><td class="center_top"><div class="top_name_right">Информация</div></td><td class="right_top"><div class="top_right_right"></div></td></tr><tr><td class="left_middle"></td><td class="center_middle" style="width: 660px;"><div class="chars"><div class="char_item"><div>Имя:</div><span>' + info[0] + '</span></div><div class="char_item"><div>Страна:</div><span>' + info[1] + '</span></div><div class="char_item"><div>Город:</div><span>' + info[2] + '</span></div><div class="char_item"><div>Пол:</div><span>' + (!info[3] ? 'Мужской' : 'Женский') + '</span></div><div class="char_item"><div>Домашняя страница:</div><span><a href="http://' + info[4] + '" target=_blank>' + info[4] + '</a></span></div>' + (!info[5] ? '' : '<div class="char_item"><div>E-mail:</div><span>' + info[5] + '</span></div>') + (!info[6] ? '' : '<div class="char_item"><div>Дата рождения:</div><span>' + info[6] + '</span></div>') + (!info[7] ? '' : '<div class="char_item"><div>ICQ:</div><span>' + info[7] + '</span></div>') + (!info[8] ? '' : '<div class="char_item"><div>ID Персонажа:</div><span>' + info[8] + '</span></div>') + (!info[9] ? '' : '<div class="char_item"><div>IP:</div><span>' + info[9] + '</span></div>') + (!info[10] ? '' : '<div class="char_item"><div>Дата входа:</div><span>' + info[10] + '</span></div>') + (!info[12] ? '' : '<div class="char_item"><div>Деньги:</div><span>' + info[12] + '</span></div>') + '</div></td><td class="right_middle"></td></tr><tr><td class="left_bot"></td><td class="center_bot"></td><td class="right_bot"></td></tr></table>');
    if (info[11].length > 0) {
        d.write(PInfoPVUMenu());
        PInfoCalendar();
    }
    d.write('<table class="infoblock2" cellspacing="0" cellpadding="0" border="0"><tr><td class="left_top"></div></td><td class="center_top"><div class="top_name_right">О себе</div></td><td class="right_top"></td></tr><tr><td class="left_middle"></td><td class="center_middle" style="width: 660px;"><div class="text">');
}

view_pinfo_bottom = function () {
    d.write('</div></td><td class="right_middle"></td></tr><tr><td class="left_bot"></td><td class="center_bot"></td><td class="right_bot"></td></tr></table></div><div id="footer"><span class="left_counter">' + top_small(1) + '</span><span class="right_counter">' + top_small(2) + '</span><div><a href="http://www.guild-honor.ru/?qreg=1">Регистрация</a> <img  src="http://image.guild-honor.ru/pinfo/sep.jpg" alt="" /> <a href="http://forum.guild-honor.ru">Форум</a><br />© Copyright 2011-2012, Guild of Honor Ltd. Все права защищены.</div></div>');
}

view_pinfo_error = function () {

}
