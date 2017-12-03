var i,j;
var f_pl = ["голова","торс","живот","ноги"];

function viewlh()
{
     for(i=1; i<logs.length; i++)
     {
          d.write('<P>');
	  for(j=0; j<logs[i].length; j++)
	  {
	       if(!isNaN(parseInt(logs[i][j][0])))
	       {
	            switch(logs[i][j][0])
		    {
		         case 0: d.write('<font class=ftime>'+logs[i][j][1]+'</font> '); break;
			 case 1: d.write(' '+sh_align(logs[i][j][4],0)+sh_sign_s(logs[i][j][5])+'<font color=#'+(logs[i][j][1] == 1 ? '0052A6' : '087C20')+'><b>'+logs[i][j][2]+'</b></font>['+logs[i][j][3]+']'); break;
			 case 6: d.write(' <font class=fpla>('+f_pl[logs[i][j][1]]+')</font>'); break;
			 case 2: d.write(' восстановил'+(!logs[i][j][3] ? '' : 'а')+' <font color=#E34242><b>«'+logs[i][j][1]+' '+logs[i][j][2]+'»</b></font>.'); break;
			 case 3: d.write(' использовал'+(!logs[i][j][2] ? '' : 'а')+' <font color=#E34242><b>«'+logs[i][j][1]+'»</b></font>.'); break;
			 case 4: d.write(' <font color=#'+(logs[i][j][1] == 1 ? '0052A6' : '087C20')+'><b><i>невидимка</i></b></font>'); break;
			 case 5: d.write(' '+sh_align(logs[i][j][3],0)+sh_sign_s(logs[i][j][4])+'<b>'+logs[i][j][1]+'</b>['+logs[i][j][2]+']'); break;
			 case 7: d.write(' применил'+(!logs[i][j][2] ? '' : 'а')+' <font color=#E34242><b>«'+logs[i][j][1]+'»</b></font>'); break;                  
		    } 
               }
	       else d.write(logs[i][j]);
          }
	  d.write('<P>');
     }

     if(!off)
     {
          d.write('<hr size="1" color="#cecece" width="100%">');
	  d.write('<P>Участники боя: ');
	  gr_det(lives_g1,1,0);
	  d.write(' против ');
	  gr_det(lives_g2,2,0);
	  d.write('</P>');
     }
     d.write('<BR>');
     if(params[0] > 0)
     {
          d.write('<P><font class=ftime>Страницы:</font>');
	  for(i=1; i<=params[0]; i++) d.write(' '+(i != params[3] ? '<A href="?fid='+params[2]+'&p='+i+'">'+i+'</A>' : '<B>'+i+'</B>'));
	  if(off) d.write(' | <A href="?fid='+params[2]+'&stat=1">Статистика боя</A>');
	  d.write('</P>');
     }
}

function viewsh()
{
     var stcou = list.length;
     if(stcou > 0)
     {
          d.write('<TABLE cellspacing=0 cellpadding=0 border=0 align=center><TR><TD bgcolor=#cccccc class=nick width=100%><TABLE cellspacing=1 cellpadding=4 border=0 width=100%><TR><TD colspan=8 class=nick bgcolor=#ffffff align=center><font color=#777777>Статистика боя</font></TD></TR><TR><TD align=center class=ftxt bgcolor=#ffffff><B>Персонаж</B></TD><TD align=center class=ftxt bgcolor=#ffffff><B>Обычный</B></TD><TD align=center bgcolor=#ffffff><B>'+sh_align(1,1)+'</B></TD><TD align=center bgcolor=#ffffff><B>'+sh_align(2,1)+'</B></TD><TD align=center bgcolor=#ffffff><B>'+sh_align(4,1)+'</B></TD><TD align=center bgcolor=#ffffff><B>'+sh_align(3,1)+'</B></TD><TD align=center class=ftxt bgcolor=#ffffff><B>Всего</B></TD><TD align=center class=ftxt bgcolor=#ffffff><B>Опыт</B></TD></TR>');
          for(i=1; i<stcou; i++) d.write('<TR><TD class=nick bgcolor=#ffffff nowrap>'+(list[i][0] == 1 ? sh_align(list[i][4])+sh_sign_s(list[i][5])+'<font color=#'+(list[i][1] == 1 ? '0052A6' : '087C20')+'><b>'+list[i][2]+'</b></font>['+list[i][3]+']<a href="./ipers.php?'+list[i][2]+'" target=_blank><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 align=absmiddle></a>' : '<font color=#'+(list[i][1] == 1 ? '0052A6' : '087C20')+'><b><i>невидимка</i></b></font>')+'</TD><TD class=nick bgcolor=#ffffff nowrap align=center>'+list[i][7]+'<font class=ftxt><sup>('+list[i][12]+')</sup></font></TD><TD class=nick bgcolor=#ffffff nowrap align=center>'+list[i][8]+'<font class=ftxt><sup>('+list[i][13]+')</sup></font></TD><TD class=nick bgcolor=#ffffff nowrap align=center>'+list[i][9]+'<font class=ftxt><sup>('+list[i][14]+')</sup></font></TD><TD class=nick bgcolor=#ffffff nowrap align=center>'+list[i][10]+'<font class=ftxt><sup>('+list[i][15]+')</sup></font></TD><TD class=nick bgcolor=#ffffff nowrap align=center>'+list[i][11]+'<font class=ftxt><sup>('+list[i][16]+')</sup></font></TD><TD class=nick bgcolor=#ffffff nowrap align=center>'+(list[i][7]+list[i][8]+list[i][9]+list[i][10]+list[i][11])+'<font class=ftxt><sup>('+(list[i][12]+list[i][13]+list[i][14]+list[i][15]+list[i][16])+')</sup></font></TD><TD class=nick bgcolor=#ffffff align=center>'+(list[i][17])+'</TD></TR>');
     	  d.write('</TABLE></TD></TR><TR><TD align=center><BR><A href="?fid='+params[2]+'&p=1">Лог боя</A></TD></TR></TABLE>');
     }
}

function gr_det(garr,grn,grlive)
{
     var bgc;
     i = garr.length - 1; 
     for(j=0; j<garr.length; j++) 
     {
          bgc = grn == 1 ? '0052A6' : '087C20';
	  switch(garr[j][0])
          {
     	       case 1:
	       if(!grlive) bgc = pl_live(garr[j][7],bgc);
   	       d.write('<font color=#'+bgc+'>'+sh_align(garr[j][3])+sh_sign_s(garr[j][4])+'<b>'+garr[j][1]+'</b></font><a href="./ipers.php?'+garr[j][1]+'" target=_blank><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 align=absmiddle></a> ['+garr[j][5]+'/'+garr[j][6]+']');
	       break;
     	       case 3:
   	       if(!grlive) bgc = pl_live(garr[j][5],bgc); 
   	       d.write('<font color=#'+bgc+'><b>'+garr[j][1]+'</b></font>['+garr[j][2]+'/'+garr[j][3]+']');
	       break;
               case 4:
               if(!grlive) bgc = pl_live(garr[j][1],bgc);
	       d.write('<font color=#'+bgc+'><b><i>невидимка</i></b></font>');
	       break;
     	  }
     	  d.write((j != i ? ', ' : ''));
     }
}

function pl_live(pll,bgc)
{
     if(!pll) return '999999';
     else return bgc;
}

function viewlog()
{
     d.write('<div id="container">');
     d.write('<div id="headerPlace">'+PNGImage('gameplay/logs/header.gif','gameplay/logs/header.png',968,89)+'</div>');
     d.write('<div id="leftCol"><img src="http://img.legendbattles.ru/image/gameplay/logs/left_col.gif" width="33" height="174" border="0"></div>');
     d.write('<div id="rightCol"><img src="http://img.legendbattles.ru/image/gameplay/logs/right_col.gif" width="33" height="174" border="0"></div>');
     d.write('<table cellpadding="0" cellspacing="0" width="100%" height="100%" border="0"><tr>');
     d.write('<td class="lBg" width="7"><img src="http://img.legendbattles.ru/image/gameplay/logs/spacer.gif" width="7" height="1" border="0"></td>');
     d.write('<td align="center" width="100%" valign="top" style="background: url(\'http://img.legendbattles.ru/image/gameplay/logs/bottom_bg.gif\') repeat-x bottom; padding-top: 95px;">');
     d.write('<div id="content">');
     
     switch(show)
     {
          case 1: viewlh(); break;
     	  case 2: viewsh(); break;
     }
     
     d.write('</div>');		
     d.write('</td>');
     d.write('<td class="rBg" width="7"><img src="http://img.legendbattles.ru/image/gameplay/logs/spacer.gif" width="7" height="1" border="0"></td></tr>');
     d.write('<tr><td height="70" valign="bottom" colspan="3"><TABLE cellSpacing="0" cellPadding="0" border="0" align="center" width="100%"><tr><td align="left" rowspan="2"><img src="http://img.legendbattles.ru/image/gameplay/logs/b1.gif" width="157" height="38" border="0"></td><td align="center"><table cellpadding="3" cellspacing="0" align="center"><tr>');
     d.write('</tr></table></td><td align="right" rowspan="2"><img src="http://img.legendbattles.ru/image/gameplay/logs/b2.gif" width="157" height="38" border="0" title="" /></td></tr><tr><td align="center"><span class="copir">© Команда «Lifeiswar LLC. inc.», Copyright 2011-2013 | Все права защищены.</span></td></tr></TABLE></td></tr>');
     d.write('<tr><td colspan="3" height="1"><div style="position: relative;"><div id="lBot"><img src="http://img.legendbattles.ru/image/gameplay/logs/lbot.gif" width="23" height="67" border="0"></div><div id="rBot"><img src="http://img.legendbattles.ru/image/gameplay/logs/rbot.gif" width="23" height="67" border="0"></div></div></td></tr></table>');
     d.write('<div id="leftCounter">'+top_small(1)+'</div>');
     d.write('<div id="rightCounter">'+top_small(2)+'</div>');
     d.write('</div>');
     d.write('</div>');
}
