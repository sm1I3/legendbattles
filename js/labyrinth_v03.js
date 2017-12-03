var Elixir = ["", "Эликсир Силы", "Эликсир Ловкости", "Эликсир Удачи", "Эликсир Гения", "Эликсир Жизни", "Эликсир Восстановления", "Эликсир Разрушения", "Эликсир Неуязвимости", "Эликсир Коварства", "Эликсир Берсеркера", "Эликсир Невидимости", "Эликсир Наблюдательности", "Эликсир Быстроты", "Эликсир Колкости", "Эликсир Мгновенного Исцеления"];
var ActionFormUse;
var TimeSet;
var TimeInt;
var TimeTik;
var PxSize = 0;

function LabTimeBar()
{
    if(TimeSet > 0) 
    {
        TimeSet = TimeSet - TimeTik;
        PxSize += 1;
        d.getElementById("BARTD").width = PxSize;
        d.getElementById("BAR").width = PxSize;
    }
    else
    {
        clearInterval(TimeInt);
        d.getElementById("barBgPlace").style.display = "none";
        d.getElementById("b1").style.display = "block";
        d.getElementById("b2").style.display = "block";
        d.getElementById("b3").style.display = "block";
        d.getElementById("b4").style.display = "block";
    }
}

function view_labyrinth()
{
	view_build_top();
	switch(param[0][0])
	{
		case 0:
		
		var arr = [param[0][2][0],"","",""];
		d.write('<table cellpadding=0 cellspacing=0 border=0 align=center><tr>'+view_lab_room(0,param[0][1],arr)+'</tr></table>');
		
		break;
		case 1:
              
        var other = ["","","L_grill_","L_lever_","L_door_","L_key_","L_guard_","L_chest_","L_portal_","L_laz_","L_water_","L_exit_","L_bg_"];
		var corid = ["L_turn_","L_end_","L_tun_","L_3way_","L_4way"];       
		var dir = [0,0,0,0];
		var Lpic;
		var sum;
		
		d.write('<table cellpadding=0 cellspacing=0 border=0 align=center><tr><td width=250 align=right valign=top>'+view_lab_inventory()+'</td>'+view_lab_room(1,param[0][1],param[0][2])+'<td width=250 valign=top>');
		
		if(param[5].length > 0)
		{
			d.write('<table cellpadding=0 cellspacing=0 border=0><tr><td colspan=3><img src="http://img.legendbattles.ru/image/gameplay/dialogs/spacer.gif" width="1" height="52" border="0"></td></tr><tr><td><img src="http://img.legendbattles.ru/image/gameplay/labyrinth/corner_a.gif" width=6 heigth=6></td><td background="http://img.legendbattles.ru/image/gameplay/labyrinth/border_b.gif"></td><td><img src="http://img.legendbattles.ru/image/gameplay/labyrinth/corner_b.gif" width=6 heigth=6></td></tr><tr><td background="http://img.legendbattles.ru/image/gameplay/labyrinth/border_a.gif"></td><td><table cellpadding=0 cellspacing=0 border=0 align=center>');
			for(y=1; y<6; y++)
			{
				d.write('<tr>');
				for(x=1; x<6; x++)
				{	
					if(param[5][y][x][0])
					{
						
						dir[0] = param[5][y - 1][x][0] > 0 ? 1 : 0; // forward
						dir[1] = param[5][y + 1][x][0] > 0 ? 1 : 0; // back
						dir[2] = param[5][y][x - 1][0] > 0 ? 1 : 0; // left
						dir[3] = param[5][y][x + 1][0] > 0 ? 1 : 0; // right
						sum = dir[0] + dir[1] + dir[2] + dir[3];
						switch(sum)
						{
							case 1: Lpic = dir[0] ? '1' : (dir[1] ? '2' : (dir[3] ? '3' : '4')); break;
							case 2:
							
							if(dir[0] && dir[1]) Lpic = '1';
							else if(dir[2] && dir[3]) Lpic = '2';
							else 
							{
								if(dir[0] && dir[3]) Lpic = '4';
								else if(dir[0] && dir[2]) Lpic = '3';
								else if(dir[1] && dir[2]) Lpic = '2';
								else Lpic = '1';
								sum = 0;
							}
							
							break;
							case 3:
							
      						if(dir[2] && dir[3])
			        		{
			        			if(dir[0]) Lpic = '1';
			        			else Lpic = '2';
				        	}
				        	else
				        	{
			        			if(dir[2]) Lpic = '3';
			        			else Lpic = '4';
				        	}
					        	
							break;
							case 4: Lpic = ''; break;
						}
						Lpic = (param[5][y][x][0] == 1 ? corid[sum] : other[param[5][y][x][0]])+Lpic;
						if(param[5][y][x][0] == 4 || param[5][y][x][0]==5) Lpic += '_'+param[5][y][x][1];
					}
					else Lpic = 'L_bg';
					
					d.write('<td background="http://img.legendbattles.ru/image/gameplay/labyrinth/'+Lpic+'.jpg" width=38 height=38>'+(x != 3 ? '' : (y != 3 ? '' : '<img src="http://img.legendbattles.ru/image/gameplay/labyrinth/arrow'+(param[0][5][0] ? param[0][5][0] : '')+'.gif" width=38 height=38>'))+'</td>');
				}
				d.write('</tr>');
			} 
			d.write('</table></td><td background="http://img.legendbattles.ru/image/gameplay/labyrinth/border_c.gif"></td></tr><tr><td><img src="http://img.legendbattles.ru/image/gameplay/labyrinth/corner_d.gif" width=6 heigth=6></td><td background="http://img.legendbattles.ru/image/gameplay/labyrinth/border_d.gif"></td><td><img src="http://img.legendbattles.ru/image/gameplay/labyrinth/corner_c.gif" width=6 heigth=6></td></tr></table><br><br>');
		}
		
		if(param[1].length > 0) d.write('<input type=button value="'+param[1][0]+'" onclick="location=\'?get_id=5&act='+param[1][1]+'&vcode='+param[1][2]+'\'" class=gr_but><br><br>');
		
		var brl = 0;
		if(param[3][0].length > 0) 
		{
			brl = 1;
			d.write('<input type=image src="http://img.legendbattles.ru/image/gameplay/labyrinth/map'+param[3][0][0]+'.gif" width=60 height=60 onclick="location=\'?get_id=5&act=81&vcode='+param[3][0][1]+'\'" hspace=2 vspace=2>');
		}
		if(param[3][1].length > 0) 
		{
			brl = 1;
			var i;
			var leng = param[3][1].length;
			for(i=0; i<leng; i++) d.write('<input type=image src="http://img.legendbattles.ru/image/gameplay/labyrinth/'+param[3][1][i][2]+'_'+param[3][1][i][0]+'.gif" onclick="location=\'?get_id=5&act=85&uid='+param[3][1][i][1]+'&vcode='+param[3][1][i][3]+'\'" width=60 height=60 hspace=2 vspace=2>');
		}
		if(param[3][2].length > 0) 
		{
			brl = 1;
			var i;
			var leng = param[3][2].length;
			for(i=0; i<leng; i++) d.write('<input type=image src="http://img.legendbattles.ru/image/gameplay/labyrinth/'+param[3][2][i][1]+'_'+param[3][2][i][2]+'.gif" onclick="location=\'?get_id=5&act=83&wid='+param[3][2][i][0]+'&vcode='+param[3][2][i][3]+'\'" width=60 height=60 hspace=2 vspace=2>');
		}
		d.write((!brl ? '' : '<br><br>')+view_lab_nicks()+'</td></tr></table>');
		
		if(param[7] > 0)
		{
			PxSize = 0;
            TimeSet = param[7];
			TimeTik = TimeSet/144.5;
			d.getElementById("barBgPlace").style.display = "block";
			d.getElementById("b1").style.display = "none";
			d.getElementById("b2").style.display = "none";
			d.getElementById("b3").style.display = "none";
			d.getElementById("b4").style.display = "none";
            TimeInt = setInterval("LabTimeBar()",(1000*TimeTik)); 
		}
		
		break;
	}
	view_build_bottom();
}

function view_lab_room(mode,img,arr)
{
    return '<td width=20></td><td valign=top><table cellpadding=0 cellspacing=0 width=406>' + (!param[6] ? '' : '<tr><td colspan=3 width=100%><table cellpadding="0" cellspacing="0" border="0" width="100%" align="center"><tr><td width="10"><img src="http://img.legendbattles.ru/image/gameplay/dialogs/c1.gif" width="10" height="10" border="0"></td><td class="cbg1"><img src="http://img.legendbattles.ru/image/gameplay/dialogs/spacer.gif" width="10" height="10" border="0"></td><td width="10"><img src="http://img.legendbattles.ru/image/gameplay/dialogs/c2.gif" width="10" height="10" border="0"></td></tr><tr><td class="cbg2"><img src="http://img.legendbattles.ru/image/gameplay/dialogs/spacer.gif" width="10" height="10" border="0"></td><td class="tCont" bgcolor="#ffffff">' + param[6] + '</td><td class="cbg3"><img src="http://img.legendbattles.ru/image/gameplay/dialogs/spacer.gif" width="10" height="10" border="0"></td></tr><tr><td width="10"><img src="http://img.legendbattles.ru/image/gameplay/dialogs/c3.gif" width="10" height="10" border="0"></td><td class="cbg4" align="left"><img src="http://img.legendbattles.ru/image/gameplay/dialogs/cc1.gif" width="14" height="10" border="0"></td><td width="10"><img src="http://img.legendbattles.ru/image/gameplay/dialogs/c4.gif" width="10" height="10" border="0"></td></tr><tr><td colspan="2" align="left" class="cbg5"><img src="http://img.legendbattles.ru/image/gameplay/dialogs/cc.gif" width="25" height="8" border="0"></td><td><img src="http://img.legendbattles.ru/image/gameplay/dialogs/cc2.gif" width="10" height="8" border="0"></td></tr></table></td></tr>') + '<tr><td><div id="mainContainer"><div id="barBgPlace"><div id="textPlace">Подождите пожалуйста...</div><div id="barPlace"><table cellpadding="0" cellspacing="0" width="160" border="0"><tr><td width="7"><img src="http://img.legendbattles.ru/image/gameplay/labyrinth/ll1.gif" width="7" height="13" border="0"></td><td class="bbg" id="BARTD"><img src="http://img.legendbattles.ru/image/gameplay/labyrinth/spacer.gif" width="1" height="13" border="0" id="BAR"></td><td width="7"><img src="http://img.legendbattles.ru/image/gameplay/labyrinth/rr1.gif" width="7" height="13" border="0"></td><td><img src="http://img.legendbattles.ru/image/gameplay/labyrinth/spacer.gif" width="40" height="13" border="0"></td></tr></table></div>' + PNGImage('gameplay/labyrinth/barbg.gif', 'gameplay/labyrinth/barbg.png', 210, 70) + '</div><div id="TEST"></div><table cellpadding="0" cellspacing="0" width="406" height="365" border="0" align="center"><tr><td width="53"><img src="http://img.legendbattles.ru/image/gameplay/labyrinth/c1.gif" width="53" height="52" border="0"></td><td class="l1">&nbsp;</td><td width="56"><img src="http://img.legendbattles.ru/image/gameplay/labyrinth/c2.gif" width="56" height="52" border="0"></td></tr><tr><td class="l2">&nbsp;</td><td width="297" height="204" class="rbg">' + img + '</td><td class="l3">&nbsp;</td></tr><tr><td width="53"><img src="http://img.legendbattles.ru/image/gameplay/labyrinth/c3.jpg" width="53" height="109" border="0"></td><td><table cellpadding="0" cellspacing="0" width="100%" border="0"><tr><td width="99"><img src="http://img.legendbattles.ru/image/gameplay/labyrinth/b1.jpg" width="99" height="109" border="0"></td><td><div id="buttonsPlace">' + ((param[0][5][1]) ? '<div id="r1"><a href="?get_id=5&act=90&di=0&vcode=' + param[0][5][1] + '"><img src="http://img.legendbattles.ru/image/gameplay/labyrinth/r_left_a.gif" width="34" height="34" border="0"></a></div>' : '') + ((param[0][5][2]) ? '<div id="r2"><a href="?get_id=5&act=90&di=1&vcode=' + param[0][5][2] + '"><img src="http://img.legendbattles.ru/image/gameplay/labyrinth/r_right_a.gif" width="34" height="34" border="0"></a></div>' : '') + '<div id="b1">' + (!arr[0] ? '<img src="http://img.legendbattles.ru/image/gameplay/labyrinth/b_top_n.gif" width="34" height="34" border="0">' : '<a href="' + (mode ? '?get_id=5&act=80&vcode=' + arr[0] + '&di=0' + (!param[0][4] ? '' : '&key=' + param[0][4]) : '?get_id=5&act=0&vcode=' + arr[0]) + '"><img src="http://img.legendbattles.ru/image/gameplay/labyrinth/b_top_a.gif" width="34" height="34" border="0"></a>') + '</div><div id="b2">' + (!arr[1] ? '<img src="http://img.legendbattles.ru/image/gameplay/labyrinth/b_down_n.gif" width="34" height="34" border="0">' : '<a href="?get_id=5&act=80&vcode=' + arr[1] + '&di=1"><img src="http://img.legendbattles.ru/image/gameplay/labyrinth/b_down_a.gif" width="34" height="34" border="0"></a>') + '</div><div id="b3">' + (!arr[2] ? '<img src="http://img.legendbattles.ru/image/gameplay/labyrinth/b_left_n.gif" width="34" height="34" border="0">' : '<a href="?get_id=5&act=80&vcode=' + arr[2] + '&di=2"><img src="http://img.legendbattles.ru/image/gameplay/labyrinth/b_left_a.gif" width="34" height="34" border="0"></a>') + '</div><div id="b4">' + (!arr[3] ? '<img src="http://img.legendbattles.ru/image/gameplay/labyrinth/b_right_n.gif" width="34" height="34" border="0">' : '<a href="?get_id=5&act=80&vcode=' + arr[3] + '&di=3"><img src="http://img.legendbattles.ru/image/gameplay/labyrinth/b_right_a.gif" width="34" height="34" border="0"></a>') + '</div></div></td><td width="102"><img src="http://img.legendbattles.ru/image/gameplay/labyrinth/b2.jpg" width="102" height="109" border="0"></td></tr></table></td><td width="56"><img src="http://img.legendbattles.ru/image/gameplay/labyrinth/c4.jpg" width="56" height="109" border="0"></td></tr></table></div></td></tr></table></td><td width=20></td>';
}

function view_lab_inventory()
{
	var i;
    var temp = '<img src="http://img.legendbattles.ru/image/gameplay/dialogs/spacer.gif" width="1" height="52" border="0"><br>' + (param[0][3] > 0 ? 'Масса инвентаря ' + param[0][3] + '/20<br>' : '');

    // Ключи
	for(i=0; i<param[2][0].length; i++)
	{
		temp += '<div style="position: relative; float: right; width: 60px; height: 60px; margin-left: 4px; margin-top: 4px;"><img src="http://img.legendbattles.ru/image/gameplay/labyrinth/key'+param[2][0][i][0]+param[2][0][i][1]+'.gif" width=60 height=60></div>';	
	}

    // Карты
	for(i=0; i<param[2][1].length; i++)
	{
		temp += '<div style="position: relative; float: right; width: 60px; height: 60px; margin-left: 4px; margin-top: 4px;"><img src="http://img.legendbattles.ru/image/gameplay/labyrinth/map'+param[2][1][i]+'.gif" width=60 height=60></div>';	
	}

    // Зелья
	for(i=0; i<param[2][2].length; i++)
	{
		temp += '<div style="position: relative; float: right; width: 60px; height: 60px; margin-left: 4px; margin-top: 4px;"><a style="position:absolute; float:left; top:0; left:0;" href="?get_id=5&act=87&wid='+param[2][2][i][0]+'&vcode='+param[2][2][i][3]+'"><img style="border:0;" src="http://img.legendbattles.ru/image/gameplay/labyrinth/nl_del.gif"></a><input type=image src="http://img.legendbattles.ru/image/gameplay/labyrinth/'+param[2][2][i][1]+'_'+param[2][2][i][2]+'.gif" width=60 height=60 onclick="location=\'?get_id=5&act=84&wid='+param[2][2][i][0]+'&vcode='+param[2][2][i][3]+'\'" alt="'+Elixir[param[2][2][i][1]]+'" title="'+Elixir[param[2][2][i][1]]+'"></div>';
	}

    // Вещи
    for(i=0; i<param[2][3].length; i++)
    {
        temp += '<div style="position: relative; float: right; width: 60px; height: 60px; margin-left: 4px; margin-top: 4px;"><a style="position:absolute; float:left; top:0; left:0;" href="?get_id=5&act=86&uid='+param[2][3][i][1]+'&vcode='+param[2][3][i][3]+'"><img style="border:0;" src="http://img.legendbattles.ru/image/gameplay/labyrinth/nl_del.gif"></a><input type=image src="http://img.legendbattles.ru/image/gameplay/labyrinth/'+param[2][3][i][2]+'_'+param[2][3][i][0]+'.gif" width=60 height=60 onclick="location=\'?get_id=5&act=82&uid='+param[2][3][i][1]+'&s=1&vcode='+param[2][3][i][3]+'\'"></div>';   
    }
	
	return temp;
}


function view_lab_nicks()
{
      var i;
      var temp;
      var leng = param[4].length;
      
      if(leng > 0) 
      {
          temp = '<font class=freetxt>Персонажи в комнате:</font><br>';
      	    for(i=0; i<leng; i++)
      	    {
                  temp += '<a href="http://www.legendbattles.ru/ipers.php?'+param[4][i][0]+'" target="_blank"><img src=http://img.legendbattles.ru/image/chat/ico_info.gif width=13 height=13 border=0></a><a href="javascript:parent.say_private(\''+param[4][i][0]+'\')"><img src=http://img.legendbattles.ru/image/chat/ico_private.gif width=13 height=13 border=0></a>&nbsp;'+sh_align(param[4][i][3],0)+sh_sign_s(param[4][i][2])+'<B><a href="javascript:parent.say_to(\''+param[4][i][0]+'\')" class=nick>'+param[4][i][0]+'</a></B> <font color="#999999">['+param[4][i][1]+']</font><br>';      
      	    }
          if (leng > 1) temp += '<div id="BarFight"><br><table cellpadding=0 cellspacing=0 border=0><tr><td><FORM action=main.php method=POST><input type=hidden name=post_id value=8><input type=hidden name=wsubid value=50><input type=hidden name=vcode value="' + param[0][2][4] + '"><input type=text name=pnick class=gr_text size=16> <input type=submit value="OK" class=gr_but> <input type=button value="X" OnClick="view_lab_form(0);" class=gr_but></FORM></td></tr></table></div><div id="BarFightBut"><br><input type=button value="Напасть" OnClick="view_lab_form(1);" class=gr_but><br></div>';
      }
      else temp = '';
      return temp;
}

function view_lab_form(v)
{
    if(!v)
    {
        d.getElementById("BarFight").style.display = "none";
        d.getElementById("BarFightBut").style.display = "block";
        ActionFormUse = '';
    }
    else
    {
        d.getElementById("BarFight").style.display = "block";
        d.getElementById("BarFightBut").style.display = "none";
        d.getElementById("pnick").focus();
        ActionFormUse = 'pnick';   
    }      
}
