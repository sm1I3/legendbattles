d = document;

function slots_inv(image, nick, sl_main, sl_uids, sl_vcod, sl_csol, wsize) {
    var main = sl_main.split("@");
    var uids = sl_uids.split("@");
    var vcod = sl_vcod.split("@");
    var csol = sl_csol.split("@");
    d.write('<table width=300 id="slots"><tr>');
    d.write('<td>' + sl_butt(main[9], uids[9], vcod[9], csol[9], 62, 40) + '</td>');
    d.write('<td>' + sl_butt(main[0], uids[0], vcod[0], csol[0], 66, 66) + '</td>');
    d.write('<td>' + sl_butt(main[11], uids[11], vcod[11], csol[11], 62, 40) + '</td></tr>');

    d.write('<tr><td>' + sl_butt(main[2], uids[2], vcod[2], csol[2], 62, 91) + '</td>');
    d.write('<td rowspan="3"><img class="slot" src=img/image/obrazy/' + image + ' border=0 width=' + wsize + ' height=240 title="' + nick + '"></td>');
    d.write('<td>' + sl_butt(main[12], uids[12], vcod[12], csol[12], 62, 91) + '</td></tr>');

    d.write('<tr><td>' + sl_butt(main[15], uids[15], vcod[15], csol[15], 62, 83) + '</td>');
    d.write('<td>' + sl_butt(main[16], uids[16], vcod[16], csol[16], 62, 83) + '</td></tr>');

    d.write('<tr><td>' + sl_butt(main[3], uids[3], vcod[3], csol[3], 62, 40) + '</td>');
    d.write('<td>' + sl_butt(main[8], uids[8], vcod[8], csol[8], 62, 40) + '</td></tr>');


    d.write('<tr><td colspan=3 class="over">' + sl_butt(main[4], uids[4], vcod[4], csol[4], 30, 30) + sl_butt(main[5], uids[5], vcod[5], csol[5], 30, 30) + sl_butt(main[6], uids[6], vcod[6], csol[6], 30, 30) + '</td></tr>');
    d.write('<tr><td>' + sl_butt(main[10], uids[10], vcod[10], csol[13], 66, 66) + '</td>\
			<td>' + sl_butt(main[19], uids[19], vcod[19], csol[19], 30, 30) + sl_butt(main[20], uids[20], vcod[20], csol[20], 30, 30) + sl_butt(main[21], uids[21], vcod[21], csol[21], 30, 30) + sl_butt(main[22], uids[22], vcod[22], csol[22], 30, 30) + sl_butt(main[13], uids[13], vcod[13], csol[13], 30, 30) + sl_butt(main[1], uids[1], vcod[1], csol[1], 66, 30) + sl_butt(main[14], uids[14], vcod[14], csol[14], 30, 30) + '</td>\
			<td>' + sl_butt(main[7], uids[7], vcod[7], csol[7], 66, 66) + '</td></tr></table>');
}

function slots_pla(image, nick, sl_main, sl_csol, wsize) {
    var main = sl_main.split("@");
    var csol = sl_csol.split("@");
    d.write('<td width=62 valign=top><table cellpadding=0 cellspacing=0 border=0 width=62><table width=300 id="slots"><tr>');
    d.write('<td>' + sl_view(main[9], csol[9], 62, 40) + '</td>');
    d.write('<td>' + sl_view(main[0], csol[0], 66, 66) + '</td>');
    d.write('<td>' + sl_view(main[11], csol[11], 62, 40) + '</td></tr>');

    d.write('<tr><td>' + sl_view(main[2], csol[2], 62, 91) + '</td>');
    d.write('<td rowspan="3"><img class="slot" src=img/image/obrazy/' + image + ' border=0 width=' + wsize + ' height=240 title="' + nick + '"></td>');
    d.write('<td>' + sl_view(main[12], csol[12], 62, 91) + '</td></tr>');

    d.write('<tr><td>' + sl_view(main[15], csol[15], 62, 83) + '</td>');
    d.write('<td>' + sl_view(main[16], csol[16], 62, 83) + '</td></tr>');

    d.write('<tr><td>' + sl_view(main[3], csol[3], 62, 40) + '</td>');
    d.write('<td>' + sl_view(main[8], csol[8], 62, 40) + '</td></tr>');


    d.write('<tr><td>' + sl_view(main[17], csol[17], 66, 66) + '</td>\
			<td>' + sl_view(main[19], csol[19], 30, 30) + sl_view(main[20], csol[20], 30, 30) + sl_view(main[21], csol[21], 30, 30) + sl_view(main[22], csol[22], 30, 30) + sl_view(main[13], csol[13], 30, 30) + sl_view(main[1], csol[1], 66, 30) + sl_view(main[14], csol[14], 30, 30) + '</td>\
			<td>' + sl_view(main[7], csol[7], 66, 66) + '</td></tr></table>');
}

function slots_fight(image, nick, sl_main, sl_uids, sl_csol, vc1, vc2, vc3, wsize) {
    var main = sl_main.split("@");
    var uids = sl_uids.split("@");
    var csol = sl_csol.split("@");
    d.write('<table width=300 id="slots"><tr>');
    d.write('<td>' + sl_view(main[9], csol[9], 62, 40) + '</td>');
    d.write('<td>' + sl_view(main[0], csol[0], 66, 66) + '</td>');
    d.write('<td>' + sl_view(main[11], csol[11], 62, 40) + '</td></tr>');

    d.write('<tr><td>' + sl_view(main[2], csol[2], 62, 91) + '</td>');
    d.write('<td rowspan="3"><img class="slot" src=img/image/obrazy/' + image + ' border=0 width=' + wsize + ' height=240 title="' + nick + '"></td>');
    d.write('<td>' + sl_view(main[12], csol[12], 62, 91) + '</td></tr>');

    d.write('<tr><td>' + sl_view(main[15], csol[15], 62, 83) + '</td>');
    d.write('<td>' + sl_view(main[16], csol[16], 62, 83) + '</td></tr>');

    d.write('<tr><td>' + sl_view(main[3], csol[3], 62, 40) + '</td>');
    d.write('<td>' + sl_view(main[8], csol[8], 62, 40) + '</td></tr>');


    d.write('<tr><td colspan=3 class="over">' + sl_fight(main[4], uids[4], csol[4], vc1, 23, 23, 4) + sl_fight(main[5], uids[5], csol[5], vc2, 24, 23, 5) + sl_fight(main[6], uids[6], csol[6], vc3, 23, 23, 6) + '</td></tr>');
    d.write('<tr><td>' + sl_view(main[17], csol[17], 66, 66) + '</td>\
			<td>' + sl_view(main[19], csol[19], 30, 30) + sl_view(main[20], csol[20], 30, 30) + sl_view(main[21], csol[21], 30, 30) + sl_view(main[22], csol[22], 30, 30) + sl_view(main[13], csol[13], 30, 30) + sl_view(main[1], csol[1], 66, 30) + sl_view(main[14], csol[14], 30, 30) + '</td>\
			<td>' + sl_view(main[7], csol[7], 66, 66) + '</td></tr></table>');
}

function slots_fight2(image, nick, sl_main, sl_uids, sl_csol, vc1, vc2, vc3, wsize) {
    var main = sl_main.split("@");
    var uids = sl_uids.split("@");
    var csol = sl_csol.split("@");
    d.write(sl_html(2) + '<tr><td>' + sl_view(main[0], csol[0], 70, 70) + '</td></tr><tr><td>' + sl_view(main[1], csol[1], 70, 35) + '</td></tr><tr><td>' + sl_view(main[2], csol[2], 70, 70) + '</td></tr><tr><td>' + sl_view(main[3], csol[3], 70, 30) + '</td></tr><tr><td>' + sl_fight(main[4], uids[4], csol[4], vc1, 23, 23, 4) + sl_fight(main[5], uids[5], csol[5], vc2, 24, 23, 5) + sl_fight(main[6], uids[6], csol[6], vc3, 23, 23, 6) + '</td></tr><tr><td>' + sl_view(main[8], csol[8], 70, 70) + '</td></tr><tr><td>' + sl_view(main[7], csol[7], 70, 70) + '</td></tr></table></td>');
    d.write(sl_html(1) + sl_image(image, nick, wsize));
    d.write(sl_html(1) + sl_html(2) + sl_view(main[9], csol[9], 70, 70) + '</td></tr><tr><td>' + sl_view(main[10], csol[10], 70, 70) + '</td></tr><tr><td>' + sl_view(main[12], csol[12], 70, 70) + '</td></tr><tr><td>' + sl_view(main[11], csol[11], 70, 70) + '</td></tr><tr><td>' + sl_view(main[13], csol[13], 35, 35) + sl_view(main[14], csol[14], 35, 35) + '</td></tr><tr><td>' + sl_view(main[15], csol[15], 70, 70) + '</td></tr></table></td>');
}

function sl_html(cs) {
    var temp;
    switch (cs) {
        case 1:
            temp = '<td width=2 valign=top><img src=img/image/1x1.gif width=2 height=1></td>';
            break;
        case 2:
            temp = '<td width=62 valign=top><table cellpadding=0 cellspacing=0 border=0 width=62>';
            break;
        case 3:
            temp = '<img src=img/image/weapon/slots/1x1gr.gif width=1 height=20>';
            break;
    }
    return temp;
}

function sl_image(image, nick, wsize) {
    return '<td width=' + wsize + ' valign=top><img src=img/image/1x1.gif width=1 height=23><br><img src=/img/image/obrazy/' + image + ' border=0 width=' + wsize + ' height=255 title="' + nick + '"></td>';
}

function sl_butt(m, u, v, s, w, h) {
    var arr = m.split(":");
    var alt = '<b>' + arr[1] + '</b>';
    if (arr[2]) alt += sl_alts(arr[2], s);
    if (arr[0] != w + 'x' + h + '.png') {
        return '<div style="width:' + w + 'px;height:' + h + 'px;" class="slot">' + (v ? '<img src=img/image/weapon/' + arr[0] + ' width=' + (w - 6) + ' height=' + (h - 6) + ' onmouseover="tooltip(this,\'' + alt + '\')" onmouseout="hide_info(this)" onclick="location=\'main.php?post_id=57&act=0&wid=' + u + '&vcode=' + v + '\'" style="cursor:pointer;">' : '') + '</div>';
    }
    return '<div style="float:left;"><img src=img/image/weapon/' + arr[0] + ' width=' + w + ' height=' + h + ' onmouseover="tooltip(this,\'' + alt + '\')" onmouseout="hide_info(this)"></div>';
}

function sl_view(m, s, w, h) {
    var arr = m.split(":");
    var alt = arr[1];
    if (arr[2]) alt += sl_alts(arr[2], s);
    if (arr[0] != w + 'x' + h + '.png') {
        return '<div style="width:' + w + 'px;height:' + h + 'px;" class="slot">' + ((arr[0].substr(0, 2) != 'sl' && arr[0].substr(0, 4) != 'rune') ? '<img src=/img/image/weapon/' + arr[0] + ' width=' + (w - 6) + ' height=' + (h - 6) + ' onmouseover="tooltip(this,\'' + alt + '\')" onmouseout="hide_info(this)">' : '') + '</div>';
    }
    return '<div style="float:left;"><img src=img/image/weapon/' + arr[0] + ' width=' + w + ' height=' + h + ' onmouseover="tooltip(this,\'' + alt + '\')" onmouseout="hide_info(this)"></div>';
}

function sl_fight(m, u, s, v, w, h, p) {
    var arr = m.split(":");
    var alt = arr[1];
    if (arr[2]) alt += sl_alts(arr[2], s);
    return '<input type=image src=img/image/weapon/' + arr[0] + ' width=' + w + ' height=' + h + ' title="' + alt + '" ' + (v ? 'onclick="location=\'main.php?post_id=44&uid=' + u + '&vcode=' + v + '&p=' + p + '&wsol=' + s + '\'"' : 'style="cursor: default"') + '>';
}

function sl_alts(p, curs) {
    var temp = '';
    var params = p.split("|");
    params[4] = parseInt(params[4]);
    if (params[0]) temp += ' (' + params[0] + ')';
    if (params[1]) temp += "<br />" + 'Удар: ' + params[1] + '-' + params[2];
    if (params[3]) temp += "<br />" + 'Класс брони: +' + params[3];
    if (params[4] > 0) temp += "<br />" + 'Пробой брони: +' + params[4];
    else if (params[4] < 0) temp += "<br />" + 'Пробой брони: ' + params[4];
    if (params[5]) temp += "<br />" + 'HP: +' + params[5];
    if (params[6]) temp += "<br />" + 'Мана: +' + params[6];
    if (curs) temp += "<br />" + 'Долговечность: ' + curs + '/' + params[7];
    return temp;
}