d = document;

function slots_inv(image,nick,sl_main,sl_uids,sl_vcod,sl_csol,wsize)
{
       var main = sl_main.split("@");
       var uids = sl_uids.split("@");
       var vcod = sl_vcod.split("@");
       var csol = sl_csol.split("@");
       d.write(sl_html(2)+'<tr><td>'+sl_butt(main[0],uids[0],vcod[0],csol[0],62,65)+'</td></tr><tr><td>'+sl_butt(main[1],uids[1],vcod[1],csol[1],62,35)+'</td></tr><tr><td>'+sl_butt(main[2],uids[2],vcod[2],csol[2],62,91)+'</td></tr><tr><td>'+sl_butt(main[3],uids[3],vcod[3],csol[3],62,30)+'</td></tr><tr><td>'+sl_butt(main[4],uids[4],vcod[4],csol[4],20,20)+sl_html(3)+sl_butt(main[5],uids[5],vcod[5],csol[5],20,20)+sl_html(3)+sl_butt(main[6],uids[6],vcod[6],csol[6],20,20)+'</td></tr><tr><td>'+sl_butt(main[7],uids[7],vcod[7],csol[7],62,63)+'</td></tr></table></td>');
       d.write(sl_html(1)+sl_image(image,nick,wsize));
       d.write(sl_html(1)+sl_html(2)+'<tr><td>'+sl_butt(main[8],uids[8],vcod[8],csol[8],20,20)+sl_butt(main[9],uids[9],vcod[9],csol[9],42,20)+'</td></tr><tr><td>'+sl_butt(main[10],uids[10],vcod[10],csol[10],62,40)+'</td></tr><tr><td>'+sl_butt(main[11],uids[11],vcod[11],csol[11],62,40)+'</td></tr><tr><td>'+sl_butt(main[12],uids[12],vcod[12],csol[12],62,91)+'</td></tr><tr><td>'+sl_butt(main[13],uids[13],vcod[13],csol[13],31,31)+sl_butt(main[14],uids[14],vcod[14],csol[14],31,31)+'</td></tr><tr><td>'+sl_butt(main[15],uids[15],vcod[15],csol[15],62,83)+'</td></tr></table></td>');
	    }



function slots_pla(image,nick,sl_main,sl_csol)
{
       var main = sl_main.split("@");
       var csol = sl_csol.split("@");
      d.write(sl_html(2)+'<tr><td>'+sl_view(main[0],csol[0],62,65)+'</td></tr><tr><td>'+sl_view(main[1],csol[1],62,38)+'</td></tr><tr><td>'+sl_view(main[2],csol[2],62,91)+'</td></tr><tr><td>'+sl_view(main[3],csol[3],20,20)+sl_html(3)+sl_view(main[4],csol[4],20,20)+sl_html(3)+sl_view(main[5],csol[5],20,20)+'</td></tr><tr><td>'+sl_view(main[6],csol[6],62,85)+'</td></tr></table></td>');
       d.write(sl_html(1)+sl_image(image,nick,115));
       d.write(sl_html(2)+'<tr><td>'+sl_view(main[7],csol[7],20,20)+sl_html(3)+sl_view(main[8],csol[8],20,20)+sl_html(3)+sl_view(main[9],csol[9],20,20)+'</td></tr><tr><td>'+sl_view(main[10],csol[10],62,38)+'</td></tr><tr><td>'+sl_view(main[11],csol[11],62,38)+'</td></tr><tr><td>'+sl_view(main[12],csol[12],62,91)+'</td></tr><tr><td>'+sl_view(main[13],csol[13],62,30)+'</td></tr><tr><td>'+sl_view(main[14],csol[14],20,20)+sl_html(3)+sl_view(main[15],csol[15],20,20)+sl_html(3)+sl_view(main[16],csol[16],20,20)+'</td></tr><tr><td>'+sl_view(main[17],csol[17],62,64)+'</td></tr></table></td></tr><td colspan="5">'+sl_view(main[18],csol[18],60,20)+sl_view(main[19],csol[19],60,20)+sl_view(main[20],csol[20],60,20)+sl_view(main[21],csol[21],60,20)+'</td>');
}

function slots_fight(image,nick,sl_main,sl_uids,sl_csol,vc1,vc2,vc3,wsize)
{
       var main = sl_main.split("@");
       var uids = sl_uids.split("@");
       var csol = sl_csol.split("@");
       d.write(sl_html(2)+'<tr><td>'+sl_view(main[0],csol[0],62,65)+'</td></tr><tr><td>'+sl_view(main[1],csol[1],62,35)+'</td></tr><tr><td>'+sl_view(main[2],csol[2],62,91)+'</td></tr><tr><td>'+sl_view(main[3],csol[3],62,30)+'</td></tr><tr><td>'+sl_fight(main[4],uids[4],csol[4],vc1,20,20,4)+sl_html(3)+sl_fight(main[5],uids[5],csol[5],vc2,20,20,5)+sl_html(3)+sl_fight(main[6],uids[6],csol[6],vc3,20,20,6)+'</td></tr><tr><td>'+sl_view(main[7],csol[7],62,63)+'</td></tr></table></td>');
       d.write(sl_html(1)+sl_image(image,nick,wsize));
       d.write(sl_html(1)+sl_html(2)+'<tr><td>'+sl_view(main[8],csol[8],20,20)+sl_view(main[9],csol[9],42,20)+'</td></tr><tr><td>'+sl_view(main[10],csol[10],62,40)+'</td></tr><tr><td>'+sl_view(main[11],csol[11],62,40)+'</td></tr><tr><td>'+sl_view(main[12],csol[12],62,91)+'</td></tr><tr><td>'+sl_view(main[13],csol[13],31,31)+sl_view(main[14],csol[14],31,31)+'</td></tr><tr><td>'+sl_view(main[15],csol[15],62,83)+'</td></tr></table></td>');
}

function sl_html(cs)
{
       var temp;
       switch(cs)
       {
              case 1: temp = '<td width=2 valign=top><img src=http://img.legendbattles.ru/image/1x1.gif width=2 height=1></td>'; break;
              case 2: temp = '<td width=62 valign=top><table cellpadding=0 cellspacing=0 border=0 width=62>'; break;
              case 3: temp = '<img src=http://img.legendbattles.ru/image/weapon/slots/1x1gr.gif width=1 height=20>'; break;
       }
       return temp;
}

function sl_image(image,nick,wsize)
{
       return '<td width='+wsize+' valign=top><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=23><br><img src=http://img.legendbattles.ru/image/obrazy/'+image+' border=0 width='+wsize+' height=255 title="'+nick+'"></td>';
}

function sl_butt(m,u,v,s,w,h)
{
       var arr = m.split(":");
       var alt = arr[1];
       if(arr[2]) alt += sl_alts(arr[2],s);
       return '<input type=image src=http://img.legendbattles.ru/image/weapon/'+arr[0]+' width='+w+' height='+h+' title="'+alt+'" '+(v ? 'onclick="location=\'main.php?post_id=57&act=0&wid='+u+'&vcode='+v+'\'"' : 'style="cursor: default"')+'>';
}

function sl_view(m,s,w,h)
{
       var arr = m.split(":");
       var alt = arr[1];
       if(arr[2]) alt += sl_alts(arr[2],s);
       return '<img src=http://img.legendbattles.ru/image/weapon/'+arr[0]+' width='+w+' height='+h+' title="'+alt+'">';
}

function sl_fight(m,u,s,v,w,h,p)
{
       var arr = m.split(":");
       var alt = arr[1];
       if(arr[2]) alt += sl_alts(arr[2],s);
       return '<input type=image src=http://img.legendbattles.ru/image/weapon/'+arr[0]+' width='+w+' height='+h+' title="'+alt+'" '+(v ? 'onclick="location=\'main.php?post_id=44&uid='+u+'&vcode='+v+'&p='+p+'&wsol='+s+'\'"' : 'style="cursor: default"')+'>';
}

function sl_alts(p,curs)
{
       var temp = '';
       var params = p.split("|");
       params[4] = parseInt(params[4]);
       if(params[0]) temp += ' ('+params[0]+')';
       if(params[1]) temp += "\n"+'Удар: '+params[1]+'-'+params[2];
       if(params[3]) temp += "\n"+'Класс брони: +'+params[3];
       if(params[4] > 0) temp += "\n"+'Пробой брони: +'+params[4];
       else if(params[4] < 0) temp += "\n"+'Пробой брони: '+params[4];
       if(params[5]) temp += "\n"+'HP: +'+params[5];
       if(params[6]) temp += "\n"+'Мана: +'+params[6];
       if(curs) temp += "\n"+'Долговечность: '+curs+'/'+params[7];
       return temp; 
}