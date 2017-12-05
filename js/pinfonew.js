d = document;

function time_for(for_end)
{
     var tr_tx = '';
     var tlog = 0;
     var tr_otr = Math.floor(for_end/86400);
     if(tr_otr > 0)
     {
         tr_tx += tr_otr + ' дн ';
	  for_end -= 86400*tr_otr;
	  tlog = 1;
     }
     tr_otr = Math.floor(for_end/3600);
     if(tr_otr > 0)
     {
         tr_tx += tr_otr + ' ч ';
	  for_end -= 3600*tr_otr;
	  tlog = 1;
     }
     tr_otr = Math.floor(for_end/60);
    if (tr_otr > 0) tr_tx += tr_otr + ' мин';
    else if (tlog == 0) tr_tx += for_end + ' сек';
     return tr_tx;
}

function sh_align(alid)
{
     if(alid>0)
     {
         var al_ar = new Array("0;0", "darks.gif;Дети Тьмы", "lights.gif;Дети Света", "sumers.gif;Дети Сумерек", "chaoss.gif;Дети Хаоса", "light.gif;Истинный Свет", "dark.gif;Истинная Тьма", "sumer.gif;Нейтральные Сумерки", "chaos.gif;Абсолютный Хаос", "angel.gif;Ангел");
          var split_ar = al_ar[alid].split(";");
          return '<img src=http://img.legendbattles.ru/image/signs/'+split_ar[0]+' width=15 height=12 border=0 align=absmiddle title="'+split_ar[1]+'"> ';
     }
     return '';
}

function sh_ch_sleep(for_ch_sl)
{
    if (for_ch_sl > 0) return '<img src=http://img.legendbattles.ru/image/signs/molch.gif width=15 height=12 border=0 title="Будет молчать еще ' + time_for(for_ch_sl) + '" align=absmiddle>';
     else return '';
}

function sh_fo_sleep(for_fo_sl)
{
    if (for_fo_sl > 0) return '<img src=http://img.legendbattles.ru/image/signs/ignor/4.gif width=15 height=12 border=0 title="Форумная молчанка еще ' + time_for(for_fo_sl) + '" align=absmiddle>';
     else return '';
}

function sh_sign(sign,signn,signs)
{
     if(sign && sign!='none')
     {
          if(signs) return '<img src=http://img.legendbattles.ru/image/signs/'+sign+' width=15 height=12 border=0 align=absmiddle title=" '+signn+' ('+signs+') ">&nbsp;';
          else return '<img src=http://img.legendbattles.ru/image/signs/'+sign+' width=15 height=12 border=0 align=absmiddle title=" '+signn+' ">&nbsp;';
     }
     else return '';
}

function sh_dealer(did)
{
     if(did > 0)
     {
          var dea_a = new Array("","d3-3","","","","","","","","","","d0-1");
         return '<img src=http://img.legendbattles.ru/image/signs/' + dea_a[did] + '.gif title="Дилер" align=absmiddle vspace=2 hspace=2 width=40 height=20> ';
     }
     else return '';
}

function sh_prison(pr_s,pr_i,time)
{
     if(pr_s > time)
     {
         if (!pr_i) pr_i = 'так надо';
         return '<br><b><font class=nickname><font color=#cc0000>Персонаж в тюрьме</font></b><br><b><font class=nickname><font color=#cc0000>Причина: ' + pr_i + '</font></b><br><br>';
     }
     else return '';
}

function sh_block(bl)
{
    if (bl != '') return '<br><b><font class=nickname><font color=#cc0000>Персонаж заблокирован</font></b><br><b><font class=nickname><font color=#cc0000>Причина: ' + bl + '</font></b><br><br>';
     else return '';
}

function sh_fight(fid)
{
    if (parseInt(fid) > 0) return ' [ <a href="./logs.php?fid=' + fid + '" target=_blank><b>в бою</b></a> ]';
     else return '';
}

function var_init(v1,v2,label)
{
     v1 = parseInt(v1);
     v2 = parseInt(v2);
     var v = v1 + v2;
     if(v < 1) v = 1;
     var init = '<tr><td bgcolor=#FCFAF3><font class=nickname>&nbsp;'+label+':</td><td width=100% bgcolor=#fafafa><font class=nickname><b>&nbsp;'+v+'</b> ';
     if(v2 > 0) init += '('+v1+'+<font color=#cc0000>'+v2+'</font>)';
     else if(v2 < 0) init += '('+v1+'<font color=#cc0000>'+v2+'</font>)';
     init += '</td></tr>';
     return init;
}

function mf_init(mftype,mf1,label)
{
     var symbol = '';
     if(mftype == '1') symbol = '%';
     mf1 = parseInt(mf1);
     if(mf1 != 0) return '<tr><td bgcolor=#fafafa  width=75% nowrap><font class=nickname><font class=proce>&nbsp;'+label+':</td><td bgcolor=#D16F67 nowrap><font class=proce><font color=#ffffff><b><div align=center>&nbsp;'+mf1+symbol+'&nbsp;</div></b></td></tr>';
     else return '';
}

function userinfo(nowtime,new_hp,all_hp,new_ma,all_ma,new_us,chatsleep,forumsleep,align,signimage,signname,signstatus,level,nickname,image,on_off,block,pr_status,pr_info,fightid,dealer,forcep,goodluck,adroitness,intellect,health,wisdom,addforce,addadroitness,addgoodluck,addintellect,uvorot,antiuvorot,krit,antikrit,proclass,broclass,sex,inf_totem,inf_borntime,inf_borncity,inf_url,inf_name,inf_country,inf_city,inf_place,inf_nowcity,travma,abil_tx,l_s,l_a,r_s,r_a,pcount,presents,wopener)
{
    d.write('<HTML><HEAD><TITLE>Жизнь сильнейших... [ Информация: ' + nickname + ' ]</TITLE>');
    d.write('<META http-equiv="Content-Type" content="text/html; charset=UTF-8">');
     d.write('<LINK href=../css/game.css rel=STYLESHEET type=text/css></HEAD>');
     d.write('<BODY link=#336699 alink=#336699 vlink=#336699 bgcolor=#ffffff topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0><table cellpadding=4 cellspacing=0 border=0 width=100%><tr><td bgcolor=#FCFAF3>');
     d.write('<form name=LoginForm method=post><TABLE cellpadding=0 cellspacing=0 border=0><tr><td rowspan=3><font class=nickname>');

     nowtime = parseInt(nowtime);
     all_hp = parseInt(all_hp);
     all_ma = parseInt(all_ma);
     new_us = parseInt(new_us);
     new_hp = parseInt(new_hp);
     new_ma = parseInt(new_ma);
     pcount = parseInt(pcount);

     var w1 = Math.round(160*(new_hp/all_hp));
     var m1 = 0;
     if(new_ma > all_ma) new_ma = all_ma;
     if(all_ma > 0) m1 = Math.round(160*(new_ma/all_ma));
     else m1 = 1;
     var for_c = parseInt(chatsleep)-nowtime;
     var for_f = parseInt(forumsleep)-nowtime;

    if (wopener == '1') d.write('<img src=http://img.legendbattles.ru/image/chat/private.gif width=11 height=12 title="Приват" onclick="window.opener.top.say_private(\'' + nickname + '\')" style="cursor:hand"> ');

     d.write(sh_align(parseInt(align)));
     d.write(sh_sign(signimage,signname,signstatus));
     d.write('<b>'+nickname+'</b> ['+level+']&nbsp;</font></td><td><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=2><br><img src=http://img.legendbattles.ru/image/gameplay/hp.gif width='+w1+' height=6 border=0 name=leftp vspace=0 align=absmiddle><img src=http://img.legendbattles.ru/image/gameplay/nohp.gif width='+(160-w1)+' height=6 border=0 name=rightp vspace=0 align=absmiddle></td><td rowspan=3> <div id=hbar><font class=hpfont>: [<font color=#bb0000><b>'+new_hp+'</b>/<b>'+all_hp+'</b></font> | <font color=#336699><b>'+new_ma+'</b>/<b>'+all_ma+'</b></font>] ');
     d.write(sh_ch_sleep(for_c));
     d.write(sh_fo_sleep(for_f));
     d.write('</div></td>');
	 d.write('</tr><tr>');
	 d.write('<td bgcolor=#ffffff><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1></td></tr><tr><td><img src=http://img.legendbattles.ru/image/gameplay/ma.gif width='+m1+' height=6 border=0 name=leftm vspace=0 align=absmiddle><img src=http://img.legendbattles.ru/image/gameplay/noma.gif width='+(160-m1)+' height=6 border=0 name=rightm vspace=0 align=absmiddle></td></tr>')
    d.write('<tr><td colspan=3><font class=nickname><b>Введите имя персонажа:</b>&nbsp;<input type=text class="LoginText" name=newnick onSubmit="javascript:  document.LoginForm.submit();"></td></tr>');
	 d.write('</table></form></td><td bgcolor=#FCFAF3 width=25><div align=right>');
     d.write('<a href=\'javascript:window.close();\'><img src=http://img.legendbattles.ru/image/exit.gif align=absmiddle width=15 height=15 border=0></a></div></td></tr>');
	 d.write('</table>');
     d.write('<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#FFFFFF><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1></td></tr><tr><td bgcolor=#B9A05C><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1></td></tr><tr><td bgcolor=#F3ECD7><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=2></td></tr>');
     d.write('<tr><td bgcolor=#FFFFFF nowrap><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=14><font class=hpfont>&nbsp;');
     d.write(sh_dealer(parseInt(dealer)));

    if (on_off == '1') d.write(' Статус: <b>Онлайн</b>' + sh_fight(fightid) + '&nbsp;&nbsp;Местоположение: <b>' + inf_nowcity + ' [' + inf_place + ']</b>');
    else d.write(' Статус: <b>Оффлайн</b>' + sh_fight(fightid) + '&nbsp;&nbsp;Местоположение: <b>' + inf_nowcity + '</b>');

     d.write('</td></tr></table><img src=http://img.legendbattles.ru/image/signs/totems/'+inf_totem+'.gif width=120 height=120 align=right border=0 hspace=10><table cellpadding=0 cellspacing=0 border=0><tr><td><img src=http://img.legendbattles.ru/image/1x1.gif width=10 height=1 border=0></td><td><img src=http://img.legendbattles.ru/image/1x1.gif width=290 height=10 border=0>');
     d.write(sh_prison(parseInt(pr_status),pr_info,nowtime));
     d.write(sh_block(block));
     d.write('</td><td><img src=http://img.legendbattles.ru/image/1x1.gif width=10 height=1 border=0></td></tr><tr><td></td><td valign=top><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td width=62 valign=top>');

     while(l_a.indexOf("=") != -1) l_a = l_a.replace("=","\n");
     while(r_a.indexOf("=") != -1) r_a = r_a.replace("=","\n");

     var left_slo_arr = l_s.split("@");
     var left_alt_arr = l_a.split("@");
     var right_slo_arr = r_s.split("@");
     var right_alt_arr = r_a.split("@");

     d.write('<table cellpadding=0 cellspacing=0 border=0 width=62><tr><td><img src=http://img.legendbattles.ru/image/weapon/'+left_slo_arr[0]+' width=62 height=65 title="'+left_alt_arr[0]+'"></td></tr><tr><td><img src=http://img.legendbattles.ru/image/weapon/'+left_slo_arr[1]+' width=62 height=35 title="'+left_alt_arr[1]+'"></td></tr><tr><td><img src=http://img.legendbattles.ru/image/weapon/'+left_slo_arr[2]+' width=62 height=91 title="'+left_alt_arr[2]+'"></td></tr><tr><td><img src=http://img.legendbattles.ru/image/weapon/'+left_slo_arr[3]+' width=62 height=30 title="'+left_alt_arr[3]+'"></td></tr><tr><td><img src=http://img.legendbattles.ru/image/weapon/'+left_slo_arr[4]+' width=20 height=20 title="'+left_alt_arr[4]+'"><img src=http://img.legendbattles.ru/image/weapon/slots/1x1gr.gif width=1 height=20><img src=http://img.legendbattles.ru/image/weapon/'+left_slo_arr[5]+' width=20 height=20 title="'+left_alt_arr[5]+'"><img src=http://img.legendbattles.ru/image/weapon/slots/1x1gr.gif width=1 height=20><img src=http://img.legendbattles.ru/image/weapon/'+left_slo_arr[6]+' width=20 height=20 title="'+left_alt_arr[6]+'"></td></tr><tr><td><img src=http://img.legendbattles.ru/image/weapon/'+right_slo_arr[0]+' width=62 height=40 title="'+right_alt_arr[0]+'"></td></tr><tr><td><img src=http://img.legendbattles.ru/image/weapon/'+left_slo_arr[7]+' width=62 height=63 title="'+left_alt_arr[7]+'"></td></tr></tr></table>');
     d.write('</td><td valign=top><img src=http://img.legendbattles.ru/image/1x1.gif width=2 height=1></td><td valign=top><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=23><br><img src=http://img.legendbattles.ru/image/obrazy/'+image+' border=0 width=115 height=255 title="'+nickname+'"></td><td valign=top><img src=http://img.legendbattles.ru/image/1x1.gif width=2 height=1></td><td width=62 valign=top>');
    d.write('<table cellpadding=0 cellspacing=0 border=0 width=62><tr><td><img src=http://img.legendbattles.ru/image/weapon/sl_r_0.gif width=20 height=20 title="Слот для кармана (В разработке)"><img src=http://img.legendbattles.ru/image/weapon/sl_r_1.gif width=42 height=20 title="Слот для содержимого кармана (В разработке)"></td></tr><tr><td><img src=http://img.legendbattles.ru/image/weapon/' + right_slo_arr[1] + ' width=62 height=40 title="' + right_alt_arr[1] + '"></td></tr><tr><td><img src=http://img.legendbattles.ru/image/weapon/' + right_slo_arr[2] + ' width=62 height=40 title="' + right_alt_arr[2] + '"></td></tr><tr><td><img src=http://img.legendbattles.ru/image/weapon/' + right_slo_arr[4] + ' width=62 height=91 title="' + right_alt_arr[4] + '"></td></tr><tr><td><img src=http://img.legendbattles.ru/image/weapon/' + right_slo_arr[3] + ' width=62 height=40 title="' + right_alt_arr[3] + '"></td></tr><tr><td><img src=http://img.legendbattles.ru/image/weapon/' + right_slo_arr[5] + ' width=31 height=31 title="' + right_alt_arr[5] + '"><img src=http://img.legendbattles.ru/image/weapon/' + right_slo_arr[6] + ' width=31 height=31 title="' + right_alt_arr[6] + '"></td></tr><tr><td><img src=http://img.legendbattles.ru/image/weapon/' + right_slo_arr[7] + ' width=62 height=83 title="' + right_alt_arr[7] + '"></td></tr></table>');
     d.write('</td><td valign=top><img src=http://img.legendbattles.ru/image/1x1.gif width=5 height=1></td><td valign=top width=100%><table cellpadding=0 cellspacing=1 border=0 width=180>');
    d.write(var_init(forcep, addforce, 'Сила'));
    d.write(var_init(adroitness, addadroitness, 'Ловкость'));
    d.write(var_init(goodluck, addgoodluck, 'Удача'));
    d.write(var_init(health, '0', 'Здоровье'));
    d.write(var_init(intellect, addintellect, 'Знания'));
    d.write(var_init(wisdom, '0', 'Сноровка'));
     d.write('</table>');
     
     if(travma) d.write('<table cellpadding=0 cellspacing=0 border=0 width=180><tr><td colspan=3><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=5></td></tr><tr><td bgcolor=#eaeaea><div align=center><img src=http://img.legendbattles.ru/image/redcross.gif width=19 height=19 hspace=2 vspace=2></div></td><td bgcolor=#cccccc><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1></td><td bgcolor=#f5f5f5><font class=travma><div align=center>'+travma+'</div></font></td></tr><tr><td colspan=3><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=5></td></tr></table>');

     d.write('<table cellpadding=0 cellspacing=1 border=0 width=180><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=2>');
    d.write('<tr><td bgcolor=#fafafa width=75% nowrap><font class=nickname><font class=proce><font color=#009933>&nbsp;Утомление:</td><td bgcolor=#009933 nowrap><font class=proce><font color=#ffffff><b><div align=center>&nbsp;<b>' + Math.round(100 - new_us) + '</b>%</b>&nbsp;</div></td></tr>');
    d.write(mf_init('0', broclass, 'Уровень брони'));
    d.write(mf_init('1', uvorot, 'Уловка'));
    d.write(mf_init('1', antiuvorot, 'Точность'));
    d.write(mf_init('1', krit, 'Сокрушение'));
    d.write(mf_init('1', antikrit, 'Стойкость'));
    d.write(mf_init('1', proclass, 'Пробой брони'));
    d.write('</table><table cellpadding=3 cellspacing=1 border=0 width=100%><tr><td bgcolor=#FFFFFF><font class=nickname>Место рождения:<b><br> ' + inf_borncity + '</b></td></tr><tr><td bgcolor=#FFFFFF><font class=nickname>Дата рождения:<b><br> ' + inf_borntime);

     if(signimage && signimage!="none") d.write('<br><br><font color=#cc0000>'+signstatus+'</font>');
     d.write('</b></td></tr>');
     if(abil_tx) d.write('<tr><td><font class=freetxt>'+abil_tx+'</td></tr>');
     d.write('</table></td></tr></table></td></tr></table><table width=100% cellspacing=0 cellpadding=20><tr><td><table width=100% cellspacing=0 cellpadding=1>');

     if(pcount>0)
     {
	  d.write('<tr><td>');
	  parray = presents.split("<");
	  for(var co=0; co<pcount; co++)
	  {
   	       items = parray[co].split("%");
	       d.write('<img src=http://img.legendbattles.ru/image/presents/f'+items[0]+'.gif width=80 height=80 title="'+items[1]+'" hspace=2 vspace=2> ');
          }
	  d.write('</td></tr>');
     }

    d.write('<tr><td><font class=nickname><b><br>Имя</b>: ' + inf_name + '</font></td></tr><tr><td><font class=nickname><b>Страна</b>: ' + inf_country + '</font></td></tr><tr><td><font class=nickname><b>Город</b>: ' + inf_city + '</font></td></tr><tr><td><font class=nickname><b>Пол</b>: ');
    if (sex == 'male') d.write('Мужской');
    else d.write('Женский');
    d.write('</font></td></tr><tr><td><font class=nickname><b>Домашняя страница</b>: ');
     if(inf_url) d.write('<a href=http://'+inf_url+' target=_blank>http://'+inf_url+'</a></td></tr>');
     else d.write('<a href=http://www.ru target=_blank>http://www.ru</a></td></tr>');
}