var sr,ri,fst,pi,rst,abut = '',ftmp_pic,ftmp;
var r_color = ["EEF5FF","FFEBED","EEF5FF","FFEBED","EEF5FF","FFEBED","EEF5FF","FFEBED","EEF5FF","FFEBED"];
var r_names = ["Зал Помощи", "Тренировочный зал", "Врата хаоса", "Зал Посвящения", "Зал Покровителей", "<img src=http://img.legendbattles.ru/image/signs/2_5.gif width=15 height=12 border=0 align=absmiddle> Зал Закона", "<img src=http://img.legendbattles.ru/image/signs/lights.gif width=15 height=12 border=0 align=absmiddle> Зал Света", "<img src=http://img.legendbattles.ru/image/signs/sumers.gif width=15 height=12 border=0 align=absmiddle> Зал Равновесия", "<img src=http://img.legendbattles.ru/image/signs/chaoss.gif width=15 height=12 border=0 align=absmiddle> Зал Хаоса", "<img src=http://img.legendbattles.ru/image/signs/darks.gif width=15 height=12 border=0 align=absmiddle> Зал Тьмы"];
var r_level = ["0-33","2-33","5-33","9-33","16-33","0-33","0-33","0-33","0-33","0-33"];
var r_avail = [0,0,0,0,0,0,0,0,0,0];

function view_arena() {
    if (curHP < (maxHP * 0.7)) arpar[12] = "Вы слишком ослаблены для боев!";
    if(arpar[16])
    {
        parent.frames['ch_list'].location = './ch.php?lo=1';
    	parent.clr_chat();
    }
    
    var col_a = ["","F0F0F0","F0F0F0","F0F0F0","F0F0F0"];
    sr = arpar[9];
    col_a[arpar[8]] = 'EAEAEA';
    che_RS();

    d.write('<table cellpadding=0 cellspacing=1 border=0 align=center width=90%><tr><td bgcolor=#FFFFFF width=50% class=filt>' + (arpar[8] != 4 ? '<b>Фильтр заявок:</b> <a href="?sh=1">' + (arpar[13] == 1 ? '<b>Ваш уровень</b>' : 'Ваш уровень') + '</a> <a href="?sh=2">' + (arpar[13] == 2 ? '<b>Все</b>' : 'Все') + '</a>&nbsp;&nbsp;|&nbsp;&nbsp;' + (data.length ? 'Количество заявок: <b>' + data.length + '</b>' : '<font color=#CC0000><b>Заявок не найдено</b></font>') : '<b>Статистика</b>&nbsp;&nbsp;|&nbsp;&nbsp;' + (data.length ? 'Количество боев: <b>' + data.length + '</b>' : '<font color=#CC0000><b>Ничего не найдено</b></font>')) + '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="./main.php">Обновить</a></td><td bgcolor=#FFFFFF width=50% align=right id=rooms class=filt>' + (sr != -1 ? '<a href="javascript: view_rooms()"><b>Показать схему здания</b></a>' : '') + '</td></tr><tr><td colspan=2 id=srooms></td></tr></table>');
    d.write('<table cellpadding=0 cellspacing=1 border=0 align=center width=90%><tr><td colspan=6><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=9></td></tr><tr><td colspan=6 bgcolor=#3564A5><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=3></td></tr><tr><td width=17% bgcolor=#' + col_a[1] + ' align=center><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=18 align=absmiddle><a href="main.php?ft=1"><font class=category><b>Дуэли</b></font></a></td><td width=17% bgcolor=#' + col_a[2] + ' align=center><a href="main.php?ft=2"><font class=category><b>Групповые</b></font></a></td><td width=17% bgcolor=#' + col_a[3] + ' align=center><a href="main.php?ft=3"><font class=category><b>Жертвенные</b></font></a></td><td width=17% bgcolor=#F0F0F0 align=center><font class=category><b>Тактические</b></font></td><td width=17% bgcolor=#F0F0F0 align=center><font class=category><b>Тотализатор</b></font></td><td width=17% bgcolor=#' + col_a[4] + ' align=center><a href="main.php?ft=4"><font class=category><b>Статистика</b></font></a></td></tr><tr><td colspan=6 bgcolor=#CCCCCC><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1></td></tr>');
    if(!arpar[12])
    {
        if(arpar[8])
        {
	    d.write('<tr><td bgcolor=#FCFAF3 colspan=6>');
	    switch(arpar[8])
            {
            case 1:
                d.write(arena_html(0) + '<select name=fkind class=freetxt><option value=n> Вид боя </option><option value=0>Без вооружения</option><option value=1>Произвольный</option></select> <select name=ftime class=freetxt><option value=n> Таймаут </option><option value=1>2 мин</option><option value=2>3 мин</option><option value=3>4 мин</option><option value=4>5 мин</option></select> <select name=ftrvm class=freetxt><option value=n> % Травматичности </option><option value=1>малый (10%)</option><option value=2>средний (30%)</option><option value=3>высокий (50%)</option><option value=4>оч. высокий (80%)</option></select> <input type=button value="подать заявку" class=gr_but OnClick="Check_form(1)"> <input type=button class=gr_but value="обновить" onclick="location=\'main.php\'">' + arena_html(1));
                break;
            case 2:
                d.write(arena_html(0) + '<select name=fkind class=freetxt><option value=n> Вид боя </option><option value=0>Без вооружения</option><option value=1>Произвольный</option></select> <select name=ftime class=freetxt><option value=n> Таймаут </option><option value=1>2 мин</option><option value=2>3 мин</option><option value=3>4 мин</option><option value=4>5 мин</option></select> <select name=ftrvm class=freetxt><option value=n> % Травматичности </option><option value=1>малый (10%)</option><option value=2>средний (30%)</option><option value=3>высокий (50%)</option><option value=4>оч. высокий (80%)</option></select> <input type=button value="подать заявку" class=gr_but OnClick="Check_form(2)"> <input type=button class=gr_but value="обновить" onclick="location=\'main.php\'"><br><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=6><br><select name=fwait class=freetxt><option value=n> Ожидание </option><option value=5>5 мин</option><option value=1>10 мин</option><option value=15>15 мин</option><option value=2>30 мин</option><option value=45>45 мин</option><option value=60>60 мин</option></select> <b>Ваша группа:</b> кол-во <input type=text class=freetxt name=gfco size=2 maxlength=2> уровни от <input type=text class=freetxt name=gfmi size=2 maxlength=2> до <input type=text class=freetxt name=gfma size=2 maxlength=2> <b>Группа противника:</b> кол-во <input type=text class=freetxt name=gsco size=2 maxlength=2> уровни от <input type=text class=freetxt name=gsmi size=2 maxlength=2> до <input type=text class=freetxt name=gsma size=2 maxlength=2>' + arena_html(1));
                break;
//    <option value=2>Клан на клан</option><option value=3>Склонность на склонность</option><option value=4>Клан против всех</option><option value=5>Склонность против всех</option><option value=6>Закрытый бой (10 на 10)</option>
                case 3:
                    d.write(arena_html(0) + '<select name=ftime class=freetxt><option value=n> Таймаут </option><option value=1>2 мин</option><option value=2>3 мин</option><option value=3>4 мин</option><option value=4>5 мин</option></select> <select name=ftrvm class=freetxt><option value=n> % Травматичности </option><option value=3>высокий (50%)</option><option value=4>оч. высокий (80%)</option></select> <select name=fwait class=freetxt><option value=n> Ожидание </option><option value=15>15 мин</option><option value=2>30 мин</option><option value=45>45 мин</option><option value=60>60 мин</option></select> <font class=nickname>[<input type=checkbox name=fall value=1> 0-33] <input type=button value="подать заявку" class=gr_but OnClick="Check_form(3)"> <input type=button class=gr_but value="обновить" onclick="location=\'main.php\'">' + arena_html(1));
                    break;
                case 4:
                    d.write('<FORM action="main.php" method=POST><table cellpadding=6 cellspacing=0 border=0 align=center><tr><td align=center><font class=category><b>Текущие бои</b></font>&nbsp;&nbsp;|&nbsp;&nbsp;<font class=nick><b>Завершенные бои</b></font> <input type=text name=st_nick size=13 maxlength=20 value="' + arpar[19] + '" class=fr_but> <input type=text name=st_date size=10 maxlength=10 value="' + arpar[20] + '" class=fr_but> <input type=submit value="ПОИСК" class=gr_but></td></tr></table></td></tr></FORM>');
                    break;
	    }
            d.write('<tr><td bgcolor=#CCCCCC width=100% colspan=6><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1></td></tr>');
            abut = '<input type=submit class=gr_but value="принять заявку">';
        }
    }
    else d.write('<tr><td bgcolor=#FCFAF3 colspan=6><table cellpadding=6 cellspacing=0 border=0 align=center><tr><td class=nick align=center><font color=#CC0000><b>'+arpar[12]+'</b></font></td></tr></table></td></tr><tr><td bgcolor=#CCCCCC width=100% colspan=6><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1></td></tr>');
    if(data.length)
    {
        switch(arpar[8])
    	{
            case 1:
            d.write('<tr><td bgcolor=#FFFFFF colspan=6><FORM action=main.php method=POST name="PZAF"><input type=hidden name=post_id value=19><input type=hidden name=act value=2><input type=hidden name=vcode value="'+vcode[4]+'"><input type=hidden name=wb value="'+arpar[11]+'"><input type=hidden name=bonus value="'+arpar[21]+'"><input type=hidden name=mhp value="'+inshp[1]+'"><table cellpadding=3 cellspacing=0 border=0>');
    	    for(ri=0; ri<data.length; ri++) 
	    {
	        if(data[ri][0] == arpar[10])
	        {
                if (!data[ri][23].length) abut = '<input type=button class=gr_but value="отозвать Вашу заявку на участие в поединке" onclick="location=\'main.php?post_id=61&act=1&vcode=' + vcode[5] + '\'">';
                else if (arpar[0] == data[ri][22][0][1]) abut = '<input type=button class=gr_but value="отказаться" onclick="location=\'main.php?post_id=61&act=3&vcode=' + vcode[5] + '\'"> <input type=button class=gr_but value="начать поединок" onclick="location=\'main.php?post_id=61&act=4&vcode=' + vcode[5] + '\'">';
                else abut = '<input type=button class=gr_but value="отказаться от возможного поединка" onclick="location=\'main.php?post_id=61&act=2&vcode=' + vcode[5] + '\'">';
	        }
		d.write('<tr><td>'+fsign(data[ri][1],data[ri][4],data[ri][5])+'<font class=fti'+(data[ri][0] == arpar[10] ? 'y' : 'a')+'> '+data[ri][2]+' </font>&nbsp;'+view_pl(ri,22,0)+' <img src=https://yt3.ggpht.com/-MVuO-kx8M4w/AAAAAAAAAAI/AAAAAAAAAAA/uwl4baEQxJU/s48-c-k-no/photo.jpg width=30 height=20> ');
	        if(data[ri][23].length) d.write(view_pl(ri,23,0));
            else d.write('<input type=radio name=pza value="2:' + data[ri][0] + '"' + radio_st(data[ri][12], data[ri][13], data[ri][14], data[ri][15], data[ri][16], data[ri][17]) + '> <B>нет соперников</B>');
		d.write('</td></tr>');
	    }
	    d.write('<tr><td>'+abut+'</td></tr></table></FORM></td></tr>');	
	    break;
    	    case 2:
    	    d.write('<tr><td bgcolor=#FFFFFF colspan=6><FORM action=main.php method=POST name="PZAF"><input type=hidden name=post_id value=19><input type=hidden name=act value=2><input type=hidden name=vcode value="'+vcode[4]+'"><input type=hidden name=wb value="'+arpar[11]+'"><input type=hidden name=bonus value="'+arpar[21]+'"><input type=hidden name=mhp value="'+inshp[1]+'"><table cellpadding=3 cellspacing=0 border=0>');
    	    for(ri=0; ri<data.length; ri++) 
	    {
            if (data[ri][0] == arpar[10] && data[ri][10] == 1 && data[ri][16] == 0) abut = '<input type=button class=gr_but value="удалить заявку" onclick="location=\'main.php?post_id=61&act=1&vcode=' + vcode[5] + '\'">';
            d.write('<tr><td>' + fsign(data[ri][1], data[ri][4], data[ri][5]) + '<font class=fti' + (data[ri][0] == arpar[10] ? 'y' : 'a') + '> ' + data[ri][2] + ' </font>&nbsp;[ ' + data[ri][11] + ' (<B>' + data[ri][6] + '-' + data[ri][7] + '</B>) на ' + data[ri][17] + ' (<B>' + data[ri][12] + '-' + data[ri][13] + '</B>) ] <input type=radio name=pza value="1:' + data[ri][0] + '"' + radio_st(data[ri][6], data[ri][7], data[ri][8], data[ri][9], data[ri][10], data[ri][11]) + '> ');
		if(data[ri][22].length) for(pi=0; pi<data[ri][22].length; pi++) d.write((pi != 0 ? ', ' : '')+view_pl(ri,22,pi));
        else d.write('<B>нет соперников</B>');
		d.write(' <img src=https://yt3.ggpht.com/-MVuO-kx8M4w/AAAAAAAAAAI/AAAAAAAAAAA/uwl4baEQxJU/s48-c-k-no/photo.jpg width=30 height=20> <input type=radio name=pza value="2:'+data[ri][0]+'"'+radio_st(data[ri][12],data[ri][13],data[ri][14],data[ri][15],data[ri][16],data[ri][17])+'> '); 
		if(data[ri][23].length) for(pi=0; pi<data[ri][23].length; pi++) d.write((pi != 0 ? ', ' : '')+view_pl(ri,23,pi));
        else d.write('<B>нет соперников</B>');
            d.write(time_to_go(2, arpar[18], data[ri][3]) + (!data[ri][21] ? '' : ' <font class=filt><font color=#CC0000><b>[закрытый бой]</b></font></font>') + '</td></tr>');
            }
            d.write('<tr><td>'+abut+'</td></tr></table></FORM></td></tr>');
	    break;
	    case 3:
	    d.write('<tr><td bgcolor=#FFFFFF colspan=6><FORM action=main.php method=POST name="PZAF"><input type=hidden name=post_id value=19><input type=hidden name=act value=2><input type=hidden name=vcode value="'+vcode[4]+'"><input type=hidden name=wb value="'+arpar[11]+'"><input type=hidden name=bonus value="'+arpar[21]+'"><input type=hidden name=mhp value="'+inshp[1]+'"><table cellpadding=3 cellspacing=0 border=0>');
    	    for(ri=0; ri<data.length; ri++) 
	    {
            if (data[ri][0] == arpar[10] && data[ri][10] == 1 && data[ri][16] == 0) abut = '<input type=button class=gr_but value="удалить заявку" onclick="location=\'main.php?post_id=61&act=1&vcode=' + vcode[5] + '\'">';
            d.write('<tr><td>' + fsign(data[ri][1], data[ri][4], data[ri][5]) + '<font class=fti' + (data[ri][0] == arpar[10] ? 'y' : 'a') + '> ' + data[ri][2] + ' </font>&nbsp;бойцов: ' + (data[ri][10] + data[ri][16]) + ' [ уровни: <B>' + data[ri][6] + '-' + data[ri][7] + '</B> ] <input type=radio name=pza value="1:' + data[ri][0] + '"' + radio_st(data[ri][6], data[ri][7], data[ri][8], data[ri][9], data[ri][10], data[ri][11]) + '>' + time_to_go(3, arpar[18], data[ri][3]) + '</td></tr>');
    	    }
	    d.write('<tr><td>'+abut+'</td></tr></table></FORM></td></tr>');
	    break;
	    case 4:
	    d.write('<tr><td bgcolor=#FFFFFF colspan=6><table cellpadding=3 cellspacing=0 border=0>');
	    for(ri=0; ri<data.length; ri++) 
	    {
	        if(data[ri][22].length && data[ri][23].length)
	        {
		    d.write('<tr><td>'+fsign(data[ri][1],data[ri][4],data[ri][5])+'&nbsp;');
		    for(pi=0; pi<data[ri][22].length; pi++) d.write((pi != 0 ? ', ' : '')+view_pl(ri,22,pi));
		    d.write(' <img src=https://yt3.ggpht.com/-MVuO-kx8M4w/AAAAAAAAAAI/AAAAAAAAAAA/uwl4baEQxJU/s48-c-k-no/photo.jpg width=30 height=20> '); 
		    for(pi=0; pi<data[ri][23].length; pi++) d.write((pi != 0 ? ', ' : '')+view_pl(ri,23,pi));
                d.write(' <A href="./logs.php?fid=' + data[ri][0] + '" target="_blank">Лог боя</A></td></tr>');
		}
            }
	    d.write('</table></td></tr>');
	    break;	    
 	}
    }
    d.write('<tr><td colspan=6 align=right>');
    counterview('null');
    d.write('</td></tr></table>');
}

function view_pl(vri,vind,vpi)
{
    switch(data[vri][vind][vpi][0])
    {
        case 1: return sh_align(data[vri][vind][vpi][4],0)+sh_sign_s(data[vri][vind][vpi][3])+'<B>'+data[vri][vind][vpi][1]+'</B>['+data[vri][vind][vpi][2]+']<a href="./ipers.php?'+data[vri][vind][vpi][1]+'" target=_blank><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 align=absmiddle></a>'; break;
        case 3: return '<B>'+data[vri][vind][vpi][1]+'</B>['+data[vri][vind][vpi][2]+']'; break;
        case 4:
            return '<B><I>невидимка</I></B>';
            break;
    }
}

function arena_html(apos)
{
    switch(apos)
    {
        case 0: return '<table cellpadding=6 cellspacing=0 border=0 align=center><tr><td class=freetxt align=center><FORM action=main.php method=POST name="FIGHTF"><input type=hidden name=post_id value=19><input type=hidden name=act value=1><input type=hidden name=vcode value="'+vcode[4]+'"><input type=hidden name=wb value="'+arpar[11]+'"><input type=hidden name=bonus value="'+arpar[21]+'"><input type=hidden name=mhp value="'+inshp[1]+'">'; break;
        case 1: return '</td></tr></table></td></tr></FORM>'; break;
    }
}

function time_to_go(t,timenow,timestart)
{
    var tr_otr, tr_tx = '';
    var tmp_t = timestart - timenow;
    if(tmp_t > 61)
    {
        tr_otr = Math.floor(tmp_t/60);
        if (tr_otr > 0) tr_tx = tr_otr + ' мин';
        tmp_t -= 60*tr_otr;
        return ' <font class=freetxt>[ До начала боя ' + tr_tx + ' ' + tmp_t + ' сек ]</font>';
    }
    else return ' <font class=freetxt>[ До начала боя менее 1 минуты ]</font>'; 
}

function view_rooms()
{
    d.getElementById('rooms').innerHTML = '<a href="javascript: close_rooms()"><b>Убрать схему здания</b></a>';
    d.getElementById('srooms').innerHTML = '<img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=10><BR><table cellpadding=4 cellspacing=1 border=0 width=100%><tr>'+rooms(0,4)+'</tr><tr>'+rooms(5,9)+'</tr></table>';
}

function close_rooms()
{
    d.getElementById('rooms').innerHTML = '<a href="javascript: view_rooms()"><b>Показать схему здания</b></a>';
    d.getElementById('srooms').innerHTML = '';
}

function rooms(st,en)
{ 
    var tst = '';

    for (ri = st; ri <= en; ri++) tst += '<td width=20% bgcolor=#' + r_color[ri] + '><div align=center><font class=freetxt><b><font color=#1959AF><font color=#222222>' + r_names[ri] + ' </b>[ ' + crcount[ri] + ' ]<b></font><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=20 align=absmiddle><br><input type=button value="Перейти" ' + (r_avail[ri] == 1 ? 'onclick="location=\'main.php?get=3&go=' + (ri + 6) + '&vcode=' + vcode[3] + '\'" class=fr_but' : (!r_avail[ri] ? 'class=fr_but DISABLED' : 'class=fr_but_dis DISABLED')) + '> <a href="javascript:parent.seeroom(' + (ri + sr + 6) + ')"><img src=http://img.legendbattles.ru/image/help/6.gif width=15 height=15 border=0 title="Просмотр комнаты" align=absmiddle></a><br>' + r_level[ri] + '</td>';
 return tst;
}

function Check_form(ft)
{
    var err = 0;
    var fli = d.FIGHTF;
    if(fli.elements['ftime'].value == 'n') err = 1;
    else if(fli.elements['ftrvm'].value == 'n') err = 1;
    switch(ft)
    {
        case 1: if(fli.elements['fkind'].value == 'n') err = 1; break;
        case 2: if(fli.elements['fkind'].value == 'n' || fli.elements['fwait'].value == 'n' || !fli.elements['gfco'].value || !fli.elements['gfmi'].value || !fli.elements['gfma'].value || !fli.elements['gsco'].value || !fli.elements['gsmi'].value || !fli.elements['gsma'].value) err = 1; break;
        case 3: if(fli.elements['fwait'].value == 'n') err = 1; break;
    }
    if (err) alert('Не заполнены необходимые поля!');
    else fli.submit();
}

function che_RS()
{
    var lev = arpar[1];
    var iin = arpar[15] - sr;
    if(vcode[2])
    {
        if(arpar[14] == 1) r_avail[0] = r_avail[1] = r_avail[2] = r_avail[3] = r_avail[4] = r_avail[6] = r_avail[7] = r_avail[8] = r_avail[9] = 1;
        else
        {
            if(lev < 2) r_avail[0] = 1;
            else if(lev < 5) r_avail[0] = r_avail[1] = 1;
            else if(lev < 9) r_avail[0] = r_avail[1] = r_avail[2] = 1;
            else if(lev < 16) r_avail[0] = r_avail[1] = r_avail[2] = r_avail[3] = 1;
            else r_avail[0] = r_avail[1] = r_avail[2] = r_avail[3] = r_avail[4] = 1;
            if(lev > 29) r_avail[6] = r_avail[7] = r_avail[8] = r_avail[9] = 1;
            else
            {
                switch(arpar[2])
                {
                    case 0: break;
                    case 1: r_avail[9] = 1; break;
                    case 2: r_avail[6] = 1; break;
                    case 3: r_avail[7] = 1; break;
                    case 4: r_avail[8] = 1; break;
                }
            }
        }
        if (arpar[4] == 'Представители Власти' || lev > 29) r_avail[5] = 1;
    }
    r_avail[iin] = 2;
}

function radio_st(rminl,rmaxl,ralig,rsign,rcurc,rmaxc)
{
    rst = 0;
    if(arpar[10]) rst = 1;
    else if(rcurc >= rmaxc) rst = 1;
    else if(arpar[1]<rminl || arpar[1]>rmaxl) rst = 1;
    else if(ralig>0 && ralig!=arpar[2]) rst = 1;
    else if(rsign!='' && rsing!='n' && rsign!=arpar[17]) rst = 1;
    return (!rst ? '' : ' DISABLED'); 
}