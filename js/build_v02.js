function view_build_top()
{
	d.write('<div style="width:100%;height:11px;background:url(\'/imgs/linebg.gif\') 0px 0px;"></div>');
    ins_HP();
    d.write('<table cellpadding=4 cellspacing=0 border=0 width=100%><tr><td bgcolor=#e2e2e2><table cellpadding=0 cellspacing=0 border=0>');
    d.write('<tr><td rowspan=3><font class=nick>'+sh_align(build[2],0)+sh_sign(build[3],build[4],build[5])+'<B><font style="color:#'+fcolor[0]+'">'+build[0]+'</font></B>['+build[1]+']&nbsp;</font></td><td><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=2><br><img src=http://img.legendbattles.ru/image/gameplay/hp.gif width=0 height=6 border=0 id=fHP vspace=0 align=absmiddle><img src=http://img.legendbattles.ru/image/gameplay/nohp.gif width=0 height=6 border=0 id=eHP vspace=0 align=absmiddle></td><td rowspan=3 class=hpbar><div id=hbar></div></td></tr>');
    d.write('<tr><td bgcolor=#e2e2e2><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1></td></tr>');
    d.write('<tr><td><img src=http://img.legendbattles.ru/image/gameplay/ma.gif width=0 height=6 border=0 id=fMP vspace=0 align=absmiddle><img src=http://img.legendbattles.ru/image/gameplay/noma.gif width=0 height=6 border=0 id=eMP vspace=0 align=absmiddle></td></tr>');
    d.write('</table></td><td bgcolor=#e2e2e2><div align=center><input type=button class="menu-character" value=" "  '+(vcode[0]!='' ? 'onclick="location=\'?get_id=56&act=10&go=inf&vcode='+vcode[0]+'\'"' : 'DISABLED')+'> <input type=button class="menu-inventar" value=" " '+(vcode[1]!='' ? 'onclick="location=\'?get_id=56&act=10&go=inv&vcode='+vcode[1]+'\'"' : 'DISABLED')+'> <input type=button class="menu-back" value=" " '+(vcode[2]!='' ? 'onclick="location=\'?get_id=56&act=10&go=up&vcode='+vcode[2]+'\'"' : 'DISABLED')+'></div></td><td bgcolor=#e2e2e2><div align=right><a href="javascript: parent.exit_redir()"><img src=http://img.legendbattles.ru/image/exit.gif align=absmiddle width=15 height=15 border=0></a></div></td></tr></table>');
    cha_HP();
    d.write('<div style="width:100%;height:11px;background:url(\'/imgs/linebg.gif\') 0px 11px;"></div>');
}

function view_build_bottom()
{
    d.write('<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=2></td></tr><tr><td align=center>'+view_t()+'</td></tr><tr><td><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=10></td></tr></table>');
}