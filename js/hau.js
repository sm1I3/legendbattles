var i,j,str;

function view_hau()
{
    view_build_top();
    d.write('<table cellpadding=0 cellspacing=0 border=0 align=center width=760><tr><td><fieldset><legend align="center"><b><font color="gray">Аукцион</font></b></legend><img src=http://img.legendbattles.ru/image/gameplay/hau/hau_' + build[9] + '.jpg width=760 height=255 border=0></fieldset></td></tr><tr><td><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=2></td></tr><tr><td><table cellpadding=0 cellspacing=0 border=0 align=center width=760><tr><td bgcolor=#CCCCCC><table cellpadding=4 cellspacing=1 border=0 width=100%><tr><td bgcolor=#FFFFFF align=center width=30%><b><a href="?type=1"><font class=category>Раритетные вещи</font></a></b> | <b><a href="?type=1&sell=1"><font class=category>Продать</font></a></b></td><td bgcolor=#FFFFFF align=center width=30%><b><a href="?type=2"><font class=category>Вещи NPC</font></a></b> | <b><a href="?type=2&sell=1"><font class=category>Продать</font></a></b></td><td bgcolor=#FFFFFF align=center width=15%><b><a href="?type=3"><font class=category>Артефакты</font></a></b></td><td bgcolor=#FFFFFF align=center width=10%><b><a href="?type=4"><font class=category>Другое</font></a></b></td><td bgcolor=#FFFFFF align=center width=15%><b><a href="?type=5&sell=1"><font class=category>Статистика</font></a></b></td></tr></table></td></tr></table></td></tr>');
    if(haupa[2] > 0)
    {
        if(!haupa[3])
        {
	    if(haupa[2] != 5)
	    {
	        view_hau_filter();
	    	view_hau_items();
	    }
        }
        else view_hau_sell_form();
    }
    d.write('</table>');
    view_build_bottom();
}

function view_hau_filter()
{
    var cat_name = ["Все", "Мечи", "Топоры", "Дробящие", "Ножи", "Метательное", "Алебарды и копья", "Посохи", "Кольчуги", "Доспехи", "Щиты", "Сапоги", "Кольца", "Шлемы", "Перчатки", "Кулоны", "Пояса", "Наручи"];
    var cat_id = [0,1,2,3,4,5,6,7,18,19,20,21,22,23,24,25,26,80];
    d.write('<tr><td><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=2></td></tr><tr><td><table cellpadding=0 cellspacing=0 border=0 align=center width=760><tr><td bgcolor=#CCCCCC><table cellpadding=4 cellspacing=1 border=0 width=100%><tr><td bgcolor=#F9F9F9 align=center colspan=2><FORM action="" method=GET><input type=hidden name=type value=' + haupa[2] + '><input type=hidden name=filter value=1><font class=inv><b>Доступные вещи для покупки через аукцион</b></font><br><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=3><br><font class=freetxt><font color=#3564A5><b>Фильтр: </b></font>уровень от <select name=minl class=freetxt>');
    view_lev(4);
    d.write('</select> до <select name=maxl class=freetxt>');
    view_lev(5);
    d.write('</select> категория <select name=cat class=freetxt>');
    for(i=0; i<18; i++) d.write('<option value='+cat_id[i]+(haupa[6] != cat_id[i] ? '' : ' SELECTED')+'>'+cat_name[i]+'</option>');
    d.write('</select> <input type=submit value=" ok " class=fr_but></FORM></td></tr>');
}

function view_lev(pid)
{
    for(i=0; i<23; i++) d.write('<option value='+i+(haupa[pid] != i ? '' : ' SELECTED')+'>'+i+'</option>');
}   

function view_hau_stats()
{
    d.write('<tr><td><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=2></td></tr><tr><td><table cellpadding=0 cellspacing=0 border=0 align=center width=760><tr><td bgcolor=#CCCCCC><table cellpadding=4 cellspacing=1 border=0 width=100%>');
    d.write('<tr><td colspan=6 bgcolor=#F9F9F9 align=center class=inv><b>Статистика продаж вещей на аукционе</b></td></tr>');
    d.write('<tr><td bgcolor=#FFFFFF></td><td align=center bgcolor=#FFFFFF class=freetxt><b>Раритетные вещи</b></td><td align=center bgcolor=#FFFFFF class=freetxt><b>Вещи NPC</b></td><td align=center bgcolor=#FFFFFF class=freetxt><b>Артефакты</b></td><td align=center bgcolor=#FFFFFF class=freetxt><b>Другое</b></td><td align=center bgcolor=#FFFFFF class=freetxt><b>Всего</b></td></tr>');
    d.write('<tr><td align=center bgcolor=#FFFFFF class=ftia><b>Кол-во вещей</b></td><td align=center bgcolor=#FFFFFF>' + adata[0] + '</td><td align=center bgcolor=#FFFFFF>' + adata[1] + '</td><td align=center bgcolor=#FFFFFF>' + adata[2] + '</td><td align=center bgcolor=#FFFFFF>' + adata[3] + '</td><td align=center bgcolor=#FFFFFF>' + adata[4] + '</td></tr>');
    d.write('<tr><td align=center bgcolor=#FFFFFF class=ftia><b>Сумма в LR</b></td><td align=center bgcolor=#FFFFFF>' + adata[5] + '</td><td align=center bgcolor=#FFFFFF>' + adata[6] + '</td><td align=center bgcolor=#FFFFFF>' + adata[7] + '</td><td align=center bgcolor=#FFFFFF>' + adata[8] + '</td><td align=center bgcolor=#FFFFFF>' + adata[9] + '</td></tr>');
    d.write('</table></td></tr></table></td></tr>');
}

function view_hau_sell_form()
{
    var about_a,need_a;
    var sell_n = ["", "раритетные вещи", "вещи NPC", "артефакты", "артефакты"];
    var sell_a = ["", "Продавец получает начальную ставку в полном объёме + <b>30%</b> от добавленной ставки на лот.", "Продавец получает <b>70%</b> от итоговой ставки на лот.", "Продавец получает <b>100%</b> от итоговой ставки на лот.", "Продавец получает <b>100%</b> от итоговой ставки на лот."];
    if(haupa[2] != 5)
    {
        d.write('<tr><td><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=2></td></tr><tr><td><table cellpadding=0 cellspacing=0 border=0 align=center width=760><tr><td bgcolor=#CCCCCC><table cellpadding=4 cellspacing=1 border=0 width=100%>');
	if(adata.length)
    	{
            d.write('<tr><td colspan=2 bgcolor=#F9F9F9 align=center><font class=inv><b>Доступные ' + sell_n[haupa[2]] + ' для продажи через аукцион</b></font><br><font class=freetxt>' + sell_a[haupa[2]] + '</font></td></tr>');
	    for(j=0; j<adata.length; j++)
            {
                about_a = adata[j][2].split("|");
                need_a = adata[j][3].split("|");
                s = Math.round(62*parseInt(about_a[6])/parseInt(about_a[7]));
                d.write('<tr><td bgcolor=#FFFFFF><div align=center><img src=http://img.legendbattles.ru/image/weapon/' + about_a[1] + ' border=0><br><img src=http://img.legendbattles.ru/image/1x1.gif width=62 height=1><br><img src=http://img.legendbattles.ru/image/solidst.gif width=' + s + ' height=2 border=0 alt="Долговечность: ' + about_a[6] + '/' + about_a[7] + '"><img src=http://img.legendbattles.ru/image/nosolidst.gif width=' + (62 - s) + ' height=2 border=0 alt="Долговечность: ' + about_a[6] + '/' + about_a[7] + '"></div></td><td width=100% bgcolor=#FFFFFF valign=top><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#FFFFFF width=100%><b><FORM action="" method=POST>&nbsp' + about_a[0] + '</b> | <input type=hidden name=post_id value=18><input type=hidden name=wuid value=' + adata[j][0] + '><input type=hidden name=wtype value=' + haupa[2] + '><input type=hidden name=act value=2><input type=hidden name=vcode value="' + adata[j][1] + '">&nbsp;<font class=freetxt>' + view_stavka() + '&nbsp;&nbsp;<input type=submit class=invbut value="Установить лот"></FORM></td><td><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=28></td></tr><tr><td colspan=2 width=100%><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#D8CDAF><img src=http://img.legendbattles.ru/image/1x1.gif width=5 height=1></td><td bgcolor=#D8CDAF width=50% class=hpbar align=center><b><font color=#f5f5f5>свойства</font></b></td><td bgcolor=#B9A05C><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1></td><td bgcolor=#D8CDAF><img src=http://img.legendbattles.ru/image/1x1.gif width=5 height=1></td><td bgcolor=#D8CDAF width=50% class=hpbar align=center><b><font color=#f5f5f5>требования</font></b></td></tr><tr><td bgcolor=#FCFAF3></td><td bgcolor=#FCFAF3 class=ftia><font color=#333333>' + view_about(about_a) + '</font></td><td bgcolor=#B9A05C><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1></td><td bgcolor=#FCFAF3></td><td bgcolor=#FCFAF3 class=ftia><font color=#333333>' + view_need(need_a) + '</font></td></tr></table></td></tr></table></td></tr>');
            }
    	}
    else d.write('<tr><td bgcolor=#FFFFFF align=center>Доступных для продажи вещей не обнаружено</td></tr>');
    	d.write('</table></td></tr></table></td></tr>');
    }
    else view_hau_stats();
}

function view_stavka()
{
    switch (haupa[2]) {
        case 2:
            return;
    }
}