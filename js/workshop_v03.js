var Category = 0;
var d = document;

function view_build_top() {
    if (build[11]) {
        parent.frames["ch_list"].location = "/ch.php?lo=1";
    }

    ins_HP();
    d.write('<table cellpadding=4 cellspacing=0 border=0 width=100%><tr><td bgcolor=#FCFAF3><table cellpadding=0 cellspacing=0 border=0>');
    d.write('<tr><td rowspan=3><font class=nick>' + sh_align(build[2], 0) + sh_sign(build[3], build[4], build[5]) + '<B>' + build[0] + '</B>[' + build[1] + ']&nbsp;</font></td><td><img src=http://image.legendbattles.ru/1x1.gif width=1 height=2><br><img src=http://image.legendbattles.ru/gameplay/hp.gif width=0 height=6 border=0 id=fHP vspace=0 align=absmiddle><img src=http://image.legendbattles.ru/gameplay/nohp.gif width=0 height=6 border=0 id=eHP vspace=0 align=absmiddle></td><td rowspan=3 class=hpbar><div id=hbar></div></td></tr>');
    d.write('<tr><td bgcolor=#ffffff><img src=http://image.legendbattles.ru/1x1.gif width=1 height=1></td></tr>');
    d.write('<tr><td><img src=http://image.legendbattles.ru/gameplay/ma.gif width=0 height=6 border=0 id=fMP vspace=0 align=absmiddle><img src=http://image.legendbattles.ru/gameplay/noma.gif width=0 height=6 border=0 id=eMP vspace=0 align=absmiddle></td></tr>');
    d.write('</table></td><td bgcolor="#FCFAF3"><div align="center" id="ButtonPlace">' + ButtonGen() + '</div></td><td bgcolor=#FCFAF3><div align=right><a href="javascript: top.exit_redir()"><img src=http://image.legendbattles.ru/exit.gif align=absmiddle width=15 height=15 border=0></a></div></td></tr></table>');
    cha_HP();

    d.write('<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#FFFFFF><img src=http://image.legendbattles.ru/1x1.gif width=1 height=1></td></tr><tr><td bgcolor=#B9A05C><img src=http://image.legendbattles.ru/1x1.gif width=1 height=1></td></tr><tr><td bgcolor=#F3ECD7><img src=http://image.legendbattles.ru/1x1.gif width=1 height=2></td></tr><tr><td bgcolor=#FFFFFF><img src=http://image.legendbattles.ru/1x1.gif width=1 height=10></td></tr></table>');
}

function view_build_bottom() {
    d.write('<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#FFFFFF><img src=http://image.legendbattles.ru/1x1.gif width=1 height=4></td></tr><tr><td align=center>' + view_t() + '</td></tr><tr><td bgcolor=#FFFFFF><img src=http://image.legendbattles.ru/1x1.gif width=1 height=10></td></tr></table>');
}

function ButtonGen() {
    var str = '';
    bavail = new Array();
    for (var i = 0; i < mapbt.length; i++) {
        bavail[mapbt[i][0]] = [mapbt[i][2], mapbt[i][3]];
        str += ' <input type=button class=fr_but id="' + mapbt[i][0] + '" value="' + mapbt[i][1] + '" onclick=\'ButClick("' + mapbt[i][0] + '")\'>';
    }
    return str;
}

function ButClick(id) {
    var goloc = '';
    switch (id) {
        case 'inf':
            goloc = 'main.php?get_id=56&act=10&go=inf&vcode=' + bavail[id][0];
            break;
        case 'inv':
            goloc = 'main.php?get_id=56&act=10&go=inv&vcode=' + bavail[id][0];
            break;
        case 'up':
            goloc = 'main.php?get_id=56&act=10&go=up&vcode=' + bavail[id][0];
            break;
    }
    if (goloc) {
        for (var j = 0; j < bavail[id][1].length; j++) goloc += '&' + bavail[id][1][j][0] + '=' + bavail[id][1][j][1];
        location = goloc;
    }
}

function StateReady() {
    switch (arr_res[0]) {
        case 'ITEMS':

            ItemsView();

            break;
    }
}

function ajaxParse(data) {
    var arr = data.split('^');

    var butt = arr[0].split('@');
    bavail['inf'][0] = butt[0];
    bavail['inv'][0] = butt[1];
    bavail['up'][0] = butt[2];

    var bact = arr[1].split('@');
    for (var i = 0; i < bact.length; i++) {
        workshop[i] = bact[i];
    }

    var aact = arr[2].split('@')
    items[0] = aact[0];

    var struct = arr[3].split('@');
    if (struct[0] == 'ERROR')
        MessBoxDiv(struct[1]);

    return arr[4];
}

function view_workshop() {
    view_build_top();
    var Title = ['', 'Магазин инструментов', 'Рабочая мастерская', 'Ремонт оружия', 'Ремонтная мастерская'];
    d.write('<div id="tooltip"></div><table cellpadding=0 cellspacing=0 border=0 align=center width=760><tr><td><img src=http://image.legendbattles.ru/gameplay/workshop.jpg width=760 height=255 border=0></td></tr><tr><td><img src=http://image.legendbattles.ru/1x1.gif width=1 height=2></td></tr><tr><td bgcolor=#CCCCCC><table cellpadding=4 cellspacing=1 border=0 width=100%><tr>');
    for (var i = 1; i < 5; i++) d.write('<td bgcolor=#FFFFFF align=center width=25% id="Cat' + i + '"><b><a href="javascript: WorkshopClick(' + i + ');"><font class=category>' + Title[i] + '</font></a></b></td>');
    d.write('</tr></table></td></tr><tr><td><img src=http://image.legendbattles.ru/1x1.gif width=1 height=2></td></tr></table><table cellpadding=0 cellspacing=0 border=0 align=center width=760><tr><td bgcolor=#CCCCCC id="DynamicFilter" width="100%" align="center"></td></tr><tr><td bgcolor=#CCCCCC id="Dynamic" width="100%"></td></tr></table>');
    view_build_bottom();
}

function WorkshopClick(t) {
    if (Category != t) {
        if (Category) d.getElementById('Cat' + Category).bgColor = '#FFFFFF';
        d.getElementById('Cat' + t).bgColor = '#E0E0E0';
        Category = t;
    }
    document.getElementById('DynamicFilter').innerHTML = '';

    switch (t) {
        case 1:

            AjaxGet('items_ajax.php?vcode=' + items[0] + '&r=' + Math.random());

            break;
        case 2:

            location = 'main.php?get_id=56&act=10&go=build&pl=' + workshop[0] + '+&vcode=' + workshop[1] + '&r=' + Math.random();

            break;
        case 3:

            show_items();

            break;
        case 4:

            var filter = '<table cellpadding=3 cellspacing=1 border=0 width=100%><tr><td align="center" colspan="2" bgcolor="#F9f9f9"><font class="freetxt"><font color="#3564A5"><b>Фильтр: </b></font>уровень от <select name="min_level" id="min_level" class="freetxt"><option value="0" selected="">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option></select> до <select name="max_level" id="max_level" class="freetxt"><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21" selected="">21</option><option value="22">22</option></select> <input value=" ok " class="fr_but" type="button" onclick="filter_items(0);"></font></td></tr></table>';
            //var filter = '<table cellpadding=3 cellspacing=1 border=0 width=100%><tr><td align="left" colspan="2" bgcolor="#F9f9f9">Уровень: <input type="text" name="min_level" id="min_level" value="0" size="3"> - <input type="text" name="max_level" id="max_level" value="33" size="3">&nbsp;&nbsp;&nbsp;<input type=button class=invbut onclick="filter_items(0);" value="Применить"></td></tr></table>';
            document.getElementById('DynamicFilter').innerHTML = filter;
            document.getElementById('Dynamic').innerHTML = '';

            break;
    }
}

function filter_items(cat) {
    show_rep_items();
}

function show_items() {
    document.getElementById('Dynamic').innerHTML = '<center>Загрузка...</center>';
    AjaxGet('workshop_ajax.php?action=show_items&vcode=' + workshop[2] + '&r=' + Math.random() + '', function (xdata) {
        var data = ajaxParse(xdata);
        document.getElementById('Dynamic').innerHTML = data;
    });
}

function show_rep_items() {
    document.getElementById('Dynamic').innerHTML = '<center>Загрузка...</center>';
    var min_level = parseInt(document.getElementById('min_level').value);
    var max_level = parseInt(document.getElementById('max_level').value);
    AjaxGet('workshop_ajax.php?action=show_rep_items&vcode=' + workshop[3] + '&min_level=' + min_level + '&max_level=' + max_level + '&r=' + Math.random() + '', function (xdata) {
        var data = ajaxParse(xdata);
        document.getElementById('Dynamic').innerHTML = data;
    });
}

function workshop_rep_leave(uid, price, nickname, vcode) {
    var inputs = document.getElementById('Dynamic').getElementsByTagName('INPUT');
    for (var i in inputs)
        inputs[i].disabled = true;

    data = new Array();
    data['action'] = 'repair_leave';
    data['uid'] = uid;
    data['price'] = price;
    data['nickname'] = nickname;
    data['vcode'] = vcode;
    AjaxPost('workshop_ajax.php', data, function (xdata) {
        var data = ajaxParse(xdata);
        document.getElementById('Dynamic').innerHTML = data;
    });
}

function workshop_rep_refund(uid, vcode) {
    var inputs = document.getElementById('Dynamic').getElementsByTagName('INPUT');
    for (var i in inputs)
        inputs[i].disabled = true;

    data = new Array();
    data['action'] = 'repair_refund';
    data['uid'] = uid;
    data['vcode'] = vcode;
    AjaxPost('workshop_ajax.php', data, function (xdata) {
        var data = ajaxParse(xdata);
        document.getElementById('Dynamic').innerHTML = data;
    });
}

function workshop_rep_get(uid, vcode) {
    var inputs = document.getElementById('Dynamic').getElementsByTagName('INPUT');
    for (var i in inputs)
        inputs[i].disabled = true;

    data = new Array();
    data['action'] = 'repair_get';
    data['uid'] = uid;
    data['vcode'] = vcode;
    AjaxPost('workshop_ajax.php', data, function (xdata) {
        var data = ajaxParse(xdata);
        document.getElementById('Dynamic').innerHTML = data;
    });
}

function workshop_repair(uid, price, vcode) {
    var inputs = document.getElementById('Dynamic').getElementsByTagName('INPUT');
    for (var i in inputs)
        inputs[i].disabled = true;

    data = new Array();
    data['action'] = 'repair';
    data['uid'] = uid;
    data['price'] = price;
    data['vcode'] = vcode;
    var min_level = parseInt(document.getElementById('min_level').value);
    var max_level = parseInt(document.getElementById('max_level').value);
    AjaxPost('workshop_ajax.php?min_level=' + min_level + '&max_level=' + max_level + '', data, function (xdata) {
        var data = ajaxParse(xdata);
        document.getElementById('Dynamic').innerHTML = data;
    });
}