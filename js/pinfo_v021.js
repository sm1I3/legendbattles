var d = document;
var prNum=1;
var prminNum=114;
var divRC = '';
var divminRC = '';
var mprNum=1;
var mprminNum=114;
var mdivRC = '';
var mdivminRC = '';
var last_str = '';
var prem_inf = ['','','<font color=black>Silver</font>','<font color=black>Gold</font>','<font color=black>VIP</font>','<font color=#FF9911>Platinum</font>'];
var align = [[], ["darks.gif", "Дети Тьмы"], ["lights.gif", "Дети Света"], ["sumers.gif", "Дети Сумерек"], ["chaoss.gif", "Дети Хаоса"], ["light.gif", "Истинный Свет"], ["dark.gif", "Истинная Тьма"], ["sumer.gif", "Нейтральные Сумерки"], ["chaos.gif", "Абсолютный Хаос"], ["angel.gif", "Ангел"]];
var rome_nums = ["","I","II","III","IV","V","VI","VII","VIII","IX","X"];
var ach_titles = [
    {id: 1, title: "Гладиатор"},
    {id: 2, title: "Охотник за головами"},
    {id: 3, title: "Солдат удачи"},
    {id: 11, title: "Разбойник"},
    {id: 12, title: "Слуга Локара"},
    {id: 13, title: "Вивисектор"},
    {id: 14, title: "Защитник"},
    {id: 4, title: "Поцелуй Витель"},
    {id: 5, title: "Наставник"},
    {id: 6, title: "Ветеран"},
    {id: 7, title: "Полоса Везения"},
    {id: 8, title: "Любимец Ирдиса"},
    {id: 9, title: "Кладоискатель"},
    {id: 20, title: "Травник"},
    {id: 30, title: "Лесоруб"},
    {id: 40, title: "Рыбак"},
    {id: 50, title: "Купец"},
    {id: 60, title: "Шахтер"},
    {id: 80, title: "Ювелир"},
    {id: 100, title: "Алхимик"},
    {id: 150, title: "Доктор"}
     ];
		 
admWindow = function(login){	
    $('#basic-modal-content').html('<iframe src="http://www.legendbattles.ru/includes/addons/admin-action/player.php?loginp='+login+'&load=1" id="useaction" name="useaction" scrolling="auto" style="width:'+(screen.width-100)+'px;height:'+(screen.height-300)+'px;" frameborder="0"></iframe>');
    ShowModal();
}

closeList = function() {
	$('#ShowLists').hide('slow');
}

updateList = function(Response) {
	if (Response == "Close"){
		closeList();
	} else {
		$('#ShowLists').html(Response);
		$('#ShowLists').show('slow');
	}
}


getList = function() {
	var s = $('#FormLists').val();
	if(s) {
		if (last_str != s) {
			$.post("/ipers.php?Ajax=yes&r=" + Math.random(), 
			{
				login:s,
			},
			function (result){
				updateList(result);
			},"html");

			last_str = s;
		}
	}
}

hpLoad = function(hp){
	var divRC = d.getElementById('hpimg');
	var divminRC = d.getElementById('nohp');
	var a=setInterval (function() {
	prNum+=6;
	prminNum-=6;
	divRC.style.height = prNum+"px";
	divminRC.style.height = prminNum+"px";
		if (prNum >= hp ) {
			divRC.style.height = hp+"px";
			divminRC.style.height = (114-hp)+"px";
			clearInterval(a);
		}
	},75);
}
mpLoad = function(mp){
	var mdivRC = d.getElementById('mpimg');
	var mdivminRC = d.getElementById('nomp');
	var n=setInterval (function() {
	mprNum+=6;
	mprminNum-=6;
	mdivRC.style.height = mprNum+"px";
	mdivminRC.style.height = mprminNum+"px";
		if (mprNum >= mp ) {
			mdivRC.style.height = mp+"px";
			mdivminRC.style.height = (114-mp)+"px";
			clearInterval(n);
		}
	},75);
}

switch_block = function(id,next)
{
    var obj = document.getElementById(id);
    var val = (next == true ? 1 : -1);
    var length = obj.children.length;
    if(length < 2) return;
    for(var i = 0; i < length; i++)
    {
        var cur = obj.children[i];
        if(cur.style.display == 'block')
        {
            if(i == 0 && val < 0)
            {
                var need =  obj.children[length - 1];
            }
            else if(i == (length - 1) && val > 0)
            {
                var need =  obj.children[0];
            }
            else
            {
                var need =  obj.children[i + val];
            }
            cur.style.display = 'none';
            need.style.display = 'block';
            return;
        }
    }
}

zero_put = function(cur,max)
{
    var max_zero = 4;
    var cur_l = cur.length;
    var max_l = max.length;
    if(max_l > 4) max_zero = max_l;
    var str_temp = '<b>',i;
    for(i=cur_l; i<max_zero; i++) str_temp += '0';
    str_temp += cur + '</b> из <b>';
    for(i=max_l; i<max_zero; i++) str_temp += '0';
    str_temp += max;
    return str_temp+'</b>';    
}

sl_view = function(m,w,h)
{
    var arr = m.split(':',3);
    var alt = '<b>'+arr[1]+'</b>';
    if(arr[2]) alt += sl_alts(arr[2]);
    return '<img class="SlotsIMG" src=http://img.legendbattles.ru/image/weapon/'+arr[0]+' width='+w+' height='+h+' onmouseover="tooltip(this,\''+alt+'\')" onmouseout="hide_info(this)">';
}

sl_alts = function(p)
{
    var temp = '';
    var params = p.split('|');
    params[4] = parseInt(params[4]);
   // if(params[0]) temp += ' ('+params[0]+')';
   	if(parseInt(params[0]) == 2) temp += ' <img src=http://img.legendbattles.ru/image/ddb.png height=18 width=27> ';
	else if(parseInt(params[0]) == 1) temp += ' <img src=http://img.legendbattles.ru/image/ddb2.png height=20 width=20> ';
    if (parseInt(params[1]) != 0) temp += '<br>' + 'Удар: ' + params[1] + '-' + params[2];
    if (parseInt(params[3]) != 0) temp += '<br>' + 'Класс брони: +' + params[3];
    if (params[4] > 0) temp += '<br>' + 'Пробой брони: +' + params[4];
    else if (params[4] < 0) temp += '<br>' + 'Пробой брони: ' + params[4];
    if(parseInt(params[5]) != 0) temp += '<br>'+'HP: +'+params[5];
    if(parseInt(params[6]) != 0) temp += '<br>'+'MP: +'+params[6];
    //if(parseInt(params[0]) != 0) temp += '<br><font color=red><b>Предмет является артефактом.</b></font>';

    return temp; 
}

top_small = function(t)
{
    switch(t)
    {
        case 1: return '<a href="http://top.mail.ru/jump?from=2330323" target="_blank"><img src="https://top-fwz1.mail.ru/counter?id=2126703;t=69;js=13;r='+r+';j='+navigator.javaEnabled()+';s='+sfo+';d='+dep+';rand='+Math.random()+'" border="0" height="31" width="38" style="filter:alpha(opacity=50);"></a>';
        case 2: return '<a href="http://www.liveinternet.ru/click" target="_blank"><img src="https://counter.yadro.ru/hit?t44.2;r'+r+((typeof(s) == 'undefined') ? '' : ';s'+sfo+'*'+dep)+';u'+escape(d.URL)+';'+Math.random()+'" border="0" width="31" height="31" style="filter:alpha(opacity=50);"></a>';
    }
}

function slots_runes(slots_arr){
	var innerhtml = '<table border=0 cellpadding=0 cellspacing=0><tr>';
	for(var i=19;i<=22;i++){
		innerhtml += '<td>'+
		sl_view(slots_arr[i],31,31)
		+'</td>';
	}
	innerhtml += '</tr></table>';
	return innerhtml;
}

view_pinfo_top = function()
{
    var i;
    if(hpmp[0] > hpmp[1]){hpmp[0]=hpmp[1];}
	if(hpmp[2] > hpmp[3]){hpmp[2]=hpmp[3];}
    var h_hp = Math.round(114*hpmp[0]/hpmp[1]);
    var h_mp = (hpmp[3] ? Math.round(114*hpmp[2]/hpmp[3]) : 0);
    
    var slots_arr = slots[0].split('@');
    var places = params[0][5].split('@');
    
    d.write('<div id="darker" style="display:none;"><table cellspacing="0" cellpadding="0" width="300" style="position:fixed; width:300px; margin:-100px 0 0 -150px;top:50%;left:50%; auto;"">  <tr>    <td style="width:18px;height:18px;"><div style="position:absolute; width:30px; height:30px; background:url(http://img.legendbattles.ru/image/closebox.png) no-repeat;right:0px;top:0px;cursor:pointer;" onclick="pInfoPopUp(\'darker\');">&nbsp;</div><img src="http://img.legendbattles.ru/image/FormUp/left_top.png" width="18" height="18"></td>    <td style="height:18px;background-image:url(\'http://img.legendbattles.ru/image/FormUp/top.png\');"></td>    <td style="width:18px;height:18px;"><img src="http://img.legendbattles.ru/image/FormUp/right_top.png" width="18" height="18"></td>  </tr>  <tr>    <td style="width:18px;background-image:url(\'http://img.legendbattles.ru/image/FormUp/left.png\');"></td>    <td style="background-image:url(\'http://img.legendbattles.ru/image/FormUp/bg.png\');" align="center"><div id="ContentPopUp"><img src="http://img.legendbattles.ru/image/loader.gif"></div></td>    <td style="width:18px;background-image:url(\'http://img.legendbattles.ru/image/FormUp/right.png\');"></td>  </tr>  <tr>    <td style="width:18px;height:18px;"><img src="http://img.legendbattles.ru/image/FormUp/left_bottom.png" width="18" height="18"></td>    <td style="height:18px;background-image:url(\'http://img.legendbattles.ru/image/FormUp/bottom.png\');"></td>    <td style="width:18px;height:18px;"><img src="http://img.legendbattles.ru/image/FormUp/right_bottom.png" width="18" height="18"></td>  </tr></table></div>');
    
    d.write('<div id="tooltip"></div><div id="main"><div id="effects">');
    for(i=0; i<effects.length; i++) d.write('<img src="http://img.legendbattles.ru/image/pinfo/eff_'+effects[i][0]+'.gif" width="29" height="29" onmouseover="tooltip(this,\''+effects[i][1]+'\')" onmouseout="hide_info(this)">');
    d.write('</div><div id="znaki">');
    for(i=0; i<ability.length; i++) d.write('<img src="http://img.legendbattles.ru/image/pinfo/t'+ability[i][0]+'.gif" width="44" height="45" onmouseover="tooltip(this,\'<b>'+ability[i][1]+((ability[i][2] && ability[i][3])?'</b><br>'+ability[i][2]+'<br>'+ability[i][3]:'</b>')+'\')" onmouseout="hide_info(this)">');
    d.write('</div><table cellspacing="0" cellpadding="0" border="0" width="1004px"><tr><td style="width:296px"><table style="margin:' + (premium > 1 ? '' : '1') + '25px 0 0 35px;" cellspacing="0" cellpadding="0" border="0"><tr><td colspan=5>' + (premium > 1 ? '<div align=center><img src="http://img.legendbattles.ru/image/pinfo/p' + premium + '.png" onmouseover="tooltip(this,\'Персонаж является владельцем расширенного аккаунта<br><b><div align=center>' + prem_inf[premium] + '</div></b>\')" onmouseout="hide_info(this)"  /></div>' : '') + '</td></tr><tr><td></td><td><div></div></td><td class="center" style="width:310px;"><div id="liw_table"><div id="liw_table_top"></div><div id="liw_table_title"><B><font color=000000>Показатели: Статы и Модификаторы</font></div><div id="liw_table_content">');
    var stats = 0;
    for(i=0; i<params[1].length; i++) 
    {
        stats = params[1][i][1] + params[1][i][2];
        d.write((i ? '<div class="underline"></div>' : '')+'<div class="char_item"><div>'+params[1][i][0]+':</div><span class="tb"><b><font color=black>'+(stats > 1 ? stats : 1)+'</font></b>'+(params[1][i][2] ? '&nbsp;('+params[1][i][1]+(params[1][i][2] > 0 ? '+<font color=red>' : '')+params[1][i][2]+'</font>)' : '')+'</span></div>');    
    }
    d.write('<div class="uzor"></div>');
    for(i=0; i<params[2].length; i++) d.write((i ? '<div class="underline"></div>' : '')+'<div class="char_item"><div>'+params[2][i][0]+':</div><span><strong><font color=black>'+params[2][i][1]+'</strong>%</font></strong></span></div>');
    d.write('</div><div id="liw_table_bottom"></div></div></td><td class="layer"><div></div></td><td class="right"><div class="top_right_left"></div></td></tr><tr><td class="bot_left"></td><td class="bot_layer"><div></div></td><td class="bot_center"></td><td class="bot_layer"><div></div></td><td class="bot_right"></td></tr><tr><td style="width:232px;" colspan=5 align=left><div id="liw_table"><div id="liw_table_top"></div><div id="liw_table_title"><B><font color=000000>Статистика: набранный опыт</font></div><div id="liw_table_content"><div align=left>&nbsp;Боевой опыт:<b>&nbsp;' + exp[1] + '</b><div class="underline"></div>&nbsp;Мирный опыт:<b>&nbsp;' + exp[2] + '</b></font><div class="underline"></div>&nbsp;Магический опыт:<b>&nbsp;' + exp[3] + '</b></font></div></div><div id="liw_table_bottom"></div></div></td></tr></table></td><td style="width:392px;height:508px; overflow:hidden;"><table cellpadding="0" cellspacing="0" border="0" width="341" height="470" align="center" style="position:relative;"><tr><td width="141" height="96" style="background:url(\'http://img.legendbattles.ru/image/NewDesign/char-menu-bord-top-left.png\') no-repeat;">&nbsp;</td><td style="background:url(\'http://img.legendbattles.ru/image/NewDesign/char-menu-border-top.png\') repeat-x;">&nbsp;</td><td width="141" height="96" style="background:url(\'http://img.legendbattles.ru/image/NewDesign/char-menu-bord-top-right.png\') no-repeat;">&nbsp;</td></tr><tr><td style="background:url(\'http://img.legendbattles.ru/image/NewDesign/character-border-left.png\') left repeat-y;" height="314">&nbsp;</td><td><div id=TEST><table cellpadding="0" cellspacing="0" border="0" width="303" align="center" style="position: fixed; height: 450px; max-height: 450px !important;position:absolute;left:16px;top:0px;background:url(\'http://img.legendbattles.ru/image/NewDesign/status-' + (params[0][6] ? 'online' : 'offline') + '.gif\') no-repeat center bottom;"><tr><td colspan="6" height="85" width="303"><div id="top_username">' + ((window.opener) ? '<a href=\"javascript:window.opener.parent.say_private(\'' + params[0][0] + '\')\"><img src=http://img.legendbattles.ru/image/chat/private.gif width=11 height=12 border=0 align=absmiddle></a>&nbsp;' : ((top.frames) ? '<a href=\"javascript:top.window.opener.parent.say_private(\'' + params[0][0] + '\')\"><img src=http://img.legendbattles.ru/image/chat/private.gif width=11 height=12 border=0 align=absmiddle></a>&nbsp;' : '')));
    if(params[0][1] > 0) d.write('<img src=http://img.legendbattles.ru/image/signs/'+align[params[0][1]][0]+' width=15 height=12 border=0 align=absmiddle onmouseover="tooltip(this,\''+align[params[0][1]][1]+'\')" onmouseout="hide_info(this)"> ');
    if(params[0][2] != 'none') d.write('<img src=http://img.legendbattles.ru/image/signs/'+params[0][2]+' width=15 height=12 border=0 align=absmiddle onmouseover="tooltip(this,\''+params[0][8]+'\')" onmouseout="hide_info(this)">&nbsp;');
         var ach = '';
    var i = 0;
    for(var j=0; j<achievements.length; j++)
    {
        if (achievements[j] && achievements[j] > 0)
            ach += (ach != '' ? '' : '')+'<img src="http://img.legendbattles.ru/achievement/'+ach_titles[j]['id']+'/a_'+ach_titles[j]['id']+'_'+achievements[j]+'.gif" onmouseover="tooltip(this,\''+ach_titles[j]['title']+' '+rome_nums[achievements[j]]+'\')" onmouseout="hide_info(this)" />';
    }
    if (ach == '') ach = '<br><font style="color:#666;font: 13px Verdana;font-weight:bold;"><center>нет достижений</font><br>';
    d.write('<font color="#666"><font style="color: #' + fcolor[0] + '">' + (info[13] ? '<a onClick="admWindow(\'' + params[0][0] + '\');" class=nickname>' + params[0][0] + '</a>' : params[0][0]) + '</font> [' + params[0][3] + ']' + ((hacker > 0) ? '<img src=http://img.legendbattles.ru/image/signs/key_quest.png width=11 height=12 border=0 onmouseover="tooltip(this,\'<b>Взломщик ' + hacker + ' ур.</b>\')" onmouseout="hide_info(this)" align=absmiddle>' : '') + ' <SUP> <SUP>' + hpmp[4] + '%</SUP></div></td></tr><tr>');
	
	// 

	//<img id=hpimg src="http://img.legendbattles.ru/image/NewDesign/hp/hp.jpg" width="12" height="'+(h_hp)+'" />
	d.write('<td rowspan="3" height="345">');
    //d.write('<table border="0" width="28" cellspacing="0" cellpadding="0" height="57"  onmouseover="tooltip(this,\'<b>Голод</b>\')" onmouseout="hide_info(this)" ><tr><td rowspan="5" background="http://img.legendbattles.ru/image/NewDesign/gl/left.gif" width="11" style="background-size: 11px 134px;">&nbsp;</td><td style="background:url(http://img.legendbattles.ru/image/NewDesign/gl/up.gif) no-repeat;" height="32">&nbsp;</td><td rowspan="5" background="http://img.legendbattles.ru/image/NewDesign/gl/right.gif" width="5">&nbsp;</td></tr><tr><td height="1" style="background:url(http://img.legendbattles.ru/image/NewDesign/gl/no.jpg);"><img src="http://img.legendbattles.ru/image/NewDesign/gl/no.jpg" width="12" height="57" /></td></tr><tr><td style="background:url(http://img.legendbattles.ru/image/NewDesign/gl/midle.jpg) no-repeat bottom;" height="17" width="12">&nbsp;</td></tr><tr><td background="http://img.legendbattles.ru/image/NewDesign/gl/gl.jpg" height="1"><img src="http://img.legendbattles.ru/image/NewDesign/gl/gl.jpg" width="12" height="1" /></td></tr><tr><td style="background:url(http://img.legendbattles.ru/image/NewDesign/gl/down.gif) no-repeat bottom;" height="35" width="12">&nbsp;</td></tr></table>');
    //d.write('<table border="0" width="28" cellspacing="0" cellpadding="0" height="198"  onmouseover="tooltip(this,\'<b>Уровень Жизни</b>\')" onmouseout="hide_info(this)" ><tr><td rowspan="5" background="http://img.legendbattles.ru/image/NewDesign/hp/left.gif" width="11">&nbsp;</td><td style="background:url(http://img.legendbattles.ru/image/NewDesign/hp/up.gif) no-repeat;" height="32">&nbsp;</td><td rowspan="5" background="http://img.legendbattles.ru/image/NewDesign/hp/right.gif" width="5">&nbsp;</td></tr><tr><td height="1" style="background:url(http://img.legendbattles.ru/image/NewDesign/hp/no.jpg);"><img src="http://img.legendbattles.ru/image/NewDesign/hp/no.jpg" id=nohp width="12" height="114" /></td></tr><tr><td style="background:url(http://img.legendbattles.ru/image/NewDesign/hp/midle.jpg) no-repeat bottom;" height="17" width="12">&nbsp;</td></tr><tr><td background="http://img.legendbattles.ru/image/NewDesign/hp/hp.jpg" height="1"><img id=hpimg src="http://img.legendbattles.ru/image/NewDesign/hp/hp.jpg" width="12" height="1" /></td></tr><tr><td style="background:url(http://img.legendbattles.ru/image/NewDesign/hp/down.gif) no-repeat bottom;" height="35" width="12">&nbsp;</td></tr></table><table><tr><td><div id="div_hme"><img src="http://img.legendbattles.ru/image/NewDesign/inf/nohp_nomn_nopw.gif" width="207" height="16" style="position:absolute;top:1px;left:56px;"><img src="http://img.legendbattles.ru/image/NewDesign/inf/line_left.png" width="56" height="16" style="position:absolute;top:0px;left:0px;"><img src="http://img.legendbattles.ru/image/NewDesign/inf/line_right.png" width="56" height="16" style="position:absolute;top:0px;left:263px;"><img src="http://img.legendbattles.ru/image/NewDesign/inf/hp.gif" id="img_hp" width="65" height="16" style="position:absolute;top:1px;left:56px;"><img src="http://img.legendbattles.ru/image/NewDesign/inf/mn.gif" id="img_ma" width="65" height="16" style="position:absolute;top:1px;left:127px;"><img src="http://img.legendbattles.ru/image/NewDesign/inf/pw.gif" id="img_en" width="65" height="16" style="position:absolute;top:1px;left:198px;"><img src="http://img.legendbattles.ru/image/NewDesign/inf/piece.gif" width="6" height="16" style="display:inline;position:absolute;top:1px;left:121px"><img src="http://img.legendbattles.ru/image/NewDesign/inf/piece.gif" width="6" height="16" style="display:inline;position:absolute;top:1px;left:192px"><div id="div_hp" style="left:56px;" class="hme"  onmouseover="tooltip(this,\'Состояние HP: [ <b>'+hpmp[0]+'</b> из <b>'+hpmp[1]+'</b> ]\')" onmouseout="hide_info(this)">'+hpmp[0]+'|'+hpmp[1]+'</div><div id="div_ma" style="left:127px;" class="hme" onmouseover="tooltip(this,\'Количество MP: [ <b>'+hpmp[2]+'</b> из <b>'+hpmp[3]+'</b> ]\')" onmouseout="hide_info(this)">'+hpmp[2]+'|'+hpmp[3]+'</div><div id="div_en" style="left:198px;" class="hme"  onmouseover="tooltip(this,\'Общая усталость: [ <b>0</b> из <b>'+hpmp[4]+'</b> ]\')" onmouseout="hide_info(this)">'+hpmp[4]+'</div></div></td></tr></table></td>');
	d.write('<td rowspan="3" width="62" class="transp">'+sl_view(slots_arr[0],62,65)+sl_view(slots_arr[1],62,35)+sl_view(slots_arr[2],62,91)+sl_view(slots_arr[3],62,30)+sl_view(slots_arr[4],20,20)+'<img src=http://img.legendbattles.ru/image/weapon/slots/1x1gr.gif width=1 height=20>'+sl_view(slots_arr[5],20,20)+'<img src=http://img.legendbattles.ru/image/weapon/slots/1x1gr.gif width=1 height=20>'+sl_view(slots_arr[6],20,20)+sl_view(slots_arr[8],62,40)+sl_view(slots_arr[7],62,63)+'</td><td>&nbsp;</td><td rowspan="3" width="62" class="transp">'+sl_view(slots_arr[17],20,19)+sl_view(slots_arr[18],42,19)+sl_view(slots_arr[9],62,40)+sl_view(slots_arr[10],62,40)+sl_view(slots_arr[12],62,91)+sl_view(slots_arr[11],62,40)+sl_view(slots_arr[13],31,31)+sl_view(slots_arr[14],31,31)+sl_view(slots_arr[15],62,83)+'</td>');
	d.write('<td rowspan="3" height="345">');
    //d.write('<table border="0" width="28" cellspacing="0" cellpadding="0" height="57"  onmouseover="tooltip(this,\'<b>Утомление</b>\')" onmouseout="hide_info(this)" ><tr><td rowspan="5" background="http://img.legendbattles.ru/image/NewDesign/ut/left.gif" width="5" style="background-size: 11px 134px;">&nbsp;</td><td style="background:url(http://img.legendbattles.ru/image/NewDesign/ut/up.gif) no-repeat;" height="32">&nbsp;</td><td rowspan="5" background="http://img.legendbattles.ru/image/NewDesign/ut/right.gif" width="11" style="background-size: 11px 130px;">&nbsp;</td></tr><tr><td height="1" style="background:url(http://img.legendbattles.ru/image/NewDesign/hp/no.jpg);"><img src="http://img.legendbattles.ru/image/NewDesign/hp/no.jpg" width="12" height="40" /></td></tr><tr><td style="background:url(http://img.legendbattles.ru/image/NewDesign/ut/midle.jpg) no-repeat bottom;" height="16" width="12">&nbsp;</td></tr><tr><td background="http://img.legendbattles.ru/image/NewDesign/ut/ut.jpg"><img src="http://img.legendbattles.ru/image/NewDesign/ut/ut.jpg" width="12" height="1" /></td></tr><tr><td style="background:url(http://img.legendbattles.ru/image/NewDesign/ut/down.gif) no-repeat bottom;" height="44" width="12">&nbsp;</td></tr></table>');
    //d.write('<table border="0" width="28" cellspacing="0" cellpadding="0" height="198"  onmouseover="tooltip(this,\'<b>Уровень Маны</b>\')" onmouseout="hide_info(this)" ><tr><td rowspan="5" background="http://img.legendbattles.ru/image/NewDesign/ma/left.gif" width="5">&nbsp;</td><td style="background:url(http://img.legendbattles.ru/image/NewDesign/ma/up.gif) no-repeat;" height="32">&nbsp;</td><td rowspan="5" background="http://img.legendbattles.ru/image/NewDesign/ma/right.gif" width="11">&nbsp;</td></tr><tr><td background="http://img.legendbattles.ru/image/NewDesign/ma/no.jpg" height="1"><img src="http://img.legendbattles.ru/image/NewDesign/hp/no.jpg" id=nomp width="12" height="1" /></td></tr><tr><td style="background:url(http://img.legendbattles.ru/image/NewDesign/ma/midle.jpg) no-repeat bottom;" height="16" width="12">&nbsp;</td></tr><tr><td background="http://img.legendbattles.ru/image/NewDesign/ma/ma.jpg"><img src="http://img.legendbattles.ru/image/NewDesign/ma/ma.jpg" id=mpimg width="12" height="1" /></td></tr><tr><td style="background:url(http://img.legendbattles.ru/image/NewDesign/ma/down.gif) no-repeat bottom;" height="44" width="12">&nbsp;</td></tr></table>');
    d.write('</td><td rowspan="3"></td></tr><tr><td align="center">' + ((params[0][0] == 'Администрация') ? '<div class="character-image"><div style="background:url(\'/images/background.png\') center;"></div><div style="background:url(\'/images/character-man.png\') center;"></div><!--aaaaaaaaaa novoje)) --><div id="slot8" style="' + ((slots_arr[16] != 'sl_r_6.gif:Слот для брони') ? 'background: url(\'/images/items/default-armor.png\') center;' : '') + '"></div><div id="slot2" style=""></div><div id="slot6" style=""></div><div id="slot7" style="' + ((slots_arr[7] != 'sl_l_5.gif:Слот для сапог') ? 'background:url(\'/images/items/default-boots.png\') center;' : '') + '"></div><div id="slot5" style="' + ((slots_arr[12] != 'sl_l_2.gif:Слот для оружия/щита') ? 'background:url(\'/images/items/sword_left.png\') center;' : '') + '"></div><div id="slot4" style="' + ((slots_arr[2] != 'sl_l_2.gif:Слот для оружия') ? 'background:url(\'/images/items/default-weapon.png\') center;' : '') + '"></div><!--aaaaaaaaaa novoje)) --></div>' : '<img src="http://img.legendbattles.ru/image/obrazy/' + params[0][4] + '" width="115" height="255"' + (!info[15] ? '' : ' onClick="CheangeAvatar();"') + ' alt="">') + '<form name=LoginForm method=post><div style="position:relative;top:12px;"><div style="position:absolute;left:-65px;top:0px;display:none;background:#FFFFFF;width:247px;" id="ShowLists"></div><input type=text id=FormLists class="LogintextBox2" style="text-align:center;" name=newnick onSubmit="javascript:  document.LoginForm.submit();" onBlur="if (value == \'\') {value=\'' + params[0][0] + '\'}" onFocus="if (value == \'' + params[0][0] + '\') {value =\'\'}" value="' + params[0][0] + '" onmouseover="tooltip(this,\'<b>Введите имя персонажа и нажмите &quot;Enter&quot;</b>\')" onmouseout="hide_info(this)" autocomplete="off"></div><div style="top:21px;position: relative;">' + slots_runes(slots_arr) + '</div></form></td><td><img src="http://img.legendbattles.ru/image/pinfo/spacer.gif" width="1" height="255" alt=""></td></tr><tr class="transp"><td colspan="3"><div align=center><!--' + ((window.opener) ? '<a href=\"javascript:window.opener.top.say_private(\'' + params[0][0] + '\')\" style="text-decoration: none;"><img src=http://img.legendbattles.ru/image/chat/private.gif width=11 height=12 border=0 align=absmiddle><font class=nickname style="color: black;"> приват </font></a>&nbsp;' : ((top.frames) ? '<a href=\"javascript:top.window.opener.top.say_private(\'' + params[0][0] + '\')\" style="text-decoration: none;"><img src=http://img.legendbattles.ru/image/chat/private.gif width=11 height=12 border=0 align=absmiddle><font class=nickname style="color: black;"> приват </font></a>&nbsp;' : '')) + '--></div></td><td><img src="http://img.legendbattles.ru/image/pinfo/spacer.gif" width="1" height="26" alt=""></td></tr>');

    if (params[0][9] == 'Вольный') {
        var xy = 'Статус';
        params[0][9] = (!info[3] ? 'Вольный' : 'Вольная');
    }
    else {
        var xy = 'Звание';
    }
	var ratingdiv = '';
	var superdiv = '';
    d.write('</table></div></td><td style="background:url(\'http://img.legendbattles.ru/image/NewDesign/character-border-right.png\') right repeat-y;">&nbsp;</td></tr><tr><td height="60" style="background:url(\'http://img.legendbattles.ru/image/NewDesign/char-border-bottom-left.png\') no-repeat;">&nbsp;</td><td height="60" style="background:url(\'http://img.legendbattles.ru/image/NewDesign/character-border-bottom.png\') repeat-x;">&nbsp;</td><td height="60" style="background:url(\'http://img.legendbattles.ru/image/NewDesign/char-border-bottom-right.png\') no-repeat;">&nbsp;</td></tr><tr><td colspan=7><div align=center style="position: relative; top: -29px;">' + superdiv + '<br>' + ratingdiv + '</div></td></tr></table><td style="width:296px"><table  style="margin:125px 0 0 0;" cellspacing="0" cellpadding="0" border="0"><tr><td></td><td><div></div></td><td class="center" style="width:310px;"><div id="liw_table"><div id="liw_table_top"></div><div id="liw_table_title"><B><font color=000000>Общие данные</font></div><div id="liw_table_content"><div class="line_text">Место рождения: <strong>' + params[0][10] + '</strong></div><div class="underline"></div><div class="line_text">Дата рождения: <strong>' + params[0][11] + '</strong></div>' + (params[0][12] ? '<div class="underline"></div><div class="line_text">В браке: <strong>' + params[0][12] + '</strong></div>' : '<div class="underline"></div><div class="line_text">В браке: <strong>' + (!info[3] ? 'не женат' : 'не замужем') + '</strong></div>') + (params[0][9] ? '<div class="underline"></div><div class="line_text">' + xy + ': <b>' + params[0][9] + '</b></div>' : '') + '</div><div id="liw_table_bottom"></div></div></td><td class="layer"><div></div></td><td class="right"></td></tr><tr><td class="bot_left"></td><td class="bot_layer"><div></div></td><td class="bot_center"></td><td class="bot_layer"><div></div></td><td class="bot_right"></td></tr></table><table style="margin:15px 0 0 0;" cellspacing="0" cellpadding="0" border="0"><tr><td class="left" style="vertical-align:middle;"></td><td class="center" style="width:232px;"><div id="liw_table"><div id="liw_table_top"></div><div id="liw_table_title"><B><font color=000000>Местоположение и Статус</font></div><div id="liw_table_content"><div align=center>' + (params[0][6] ? '<b>В игре: <font color=#33DD66>онлайн</font></b><div class="underline"></div><b>' + places[0] + '</b>' + (params[0][7] ? ' [ <a href="./logs.php?fid=' + params[0][7] + '" target=_blank style="color:#ff3036;"><b>в бою</b></a> ]' : '') + '<div class="underline"></div>' + places[1] : '<b>В игре: <font color=#cc0000>оффлайн</font></b><div class="underline"></div><b>Персонаж находится вне мира</b><div class="underline"></div>Местоположение: неизвестно') + '</div></div><div id="liw_table_bottom"></div></div></td><td style="vertical-align:middle;" class="right"></td></tr><tr><td class="bot_left"></td><td class="bot_center"></td><td class="bot_right"></td></tr></table><table style="margin:15px 0 0 0;" cellspacing="0" cellpadding="0" border="0"><tr><td class="left" style="vertical-align:middle;"></td><td class="center" style="width:232px;"><div id="liw_table"><div id="liw_table_top"></div><div id="liw_table_title"><B><font color=000000>Достижения</font></div><div id="liw_table_content"><div align=center>' + ach + '</div></div><div id="liw_table_bottom"></div></div></td><td style="vertical-align:middle;" class="right"></td></tr><tr><td class="bot_left"></td><td class="bot_center"></td><td class="bot_right"></td></tr></table><table style="margin:15px 0 0 0;" cellspacing="0" cellpadding="0" border="0"><tr><td class="left" style="vertical-align:middle;"></td><td class="center" style="width:232px;"><div id="liw_table"><div id="liw_table_top"></div><div id="liw_table_title"><B><font color=000000>Сражения</font></div><div id="liw_table_content"><div align=left>&nbsp;Побед над игроками:<b>&nbsp;' + warstats[0] + '</b><div class="underline"></div>&nbsp;Поражений от игроков:<b>&nbsp;' + warstats[1] + '</b></font><div class="underline"></div>&nbsp;Побед над ботами:<b>&nbsp;' + warstats[2] + '</b></font><div class="underline"></div>&nbsp;Поражений от ботов:<b>&nbsp;' + warstats[3] + '</b></font><div class="underline"></div>&nbsp;Выполнено квестов:<b>&nbsp;' + warstats[4] + '</b></font></div></div><div id="liw_table_bottom"></div></div></td><td style="vertical-align:middle;" class="right"></td></tr><tr><td class="bot_left"></td><td class="bot_center"></td><td class="bot_right"></td></tr><!--tr><td colspan=3><br><br>' + superdiv + '</td></tr--></table></td></tr></table><div class="div"><div class="div_block"><div class="div_right"><div class="div_gr" style="width: 850px;"><div class="div_center"></div></div></div></div></div><div class="presents">');
    
    var pr_c = presents.length;
    
    for(i=0; i<pr_c; i++) d.write('<img src=http://img.legendbattles.ru/image/presents/'+presents[i][0]+'.gif width=100 height=100 onmouseover="tooltip(this,\''+presents[i][1]+'\')" onmouseout="hide_info(this)">');
    d.write('</div>');
    if(pr_c) d.write('<div class="div"><div class="div_block"><div class="div_right"><div class="div_gr" style="width: 660px;"><div class="div_center2"></div></div></div></div></div>');

    d.write('<table class="infoblock2" cellspacing="0" cellpadding="0" border="0"><tr><td class="left_top"><div class="top_left_right"></div></td><td class="center_top"><div class="top_name_right">О Персонаже: Общие данные</div></td><td class="right_top"><div class="top_right_right"></div></td></tr><tr><td class="left_middle"></td><td class="center_middle" style="width: 660px;">' + (params[0][0] == '' ? '<div align=right style="float: right"><img src="http://img.legendbattles.ru/image/gdil.jpg" title="Талисман"></div>' : '') + '<div class="chars"><div class="char_item"><div>Имя:</div><span>' + info[0] + '</span></div><div class="char_item"><div>Страна:</div><span>' + info[1] + '</span></div><div class="char_item"><div>Город:</div><span>' + info[2] + '</span></div><div class="char_item"><div>Пол:</div><span>' + (!info[3] ? 'Мужской' : 'Женский') + '</span></div><div class="char_item"><div>Домашняя страница:</div><span><a href="http://' + info[4] + '" target=_blank>' + info[4] + '</a></span></div>' + (!info[5] ? '' : '<div class="char_item"><div>E-mail:</div><span>' + info[5] + '</span></div>') + (!info[6] ? '' : '<div class="char_item"><div>Дата рождения:</div><span>' + info[6] + '</span></div>') + (!info[7] ? '' : '<div class="char_item"><div>ICQ:</div><span>' + info[7] + '</span></div>') + (!info[8] ? '' : '<div class="char_item"><div>ID Персонажа:</div><span>' + info[8] + '</span></div>') + (!info[9] ? '' : '<div class="char_item"><div>IP:</div><span>' + info[9] + '</span></div>') + (!info[10] ? '' : '<div class="char_item"><div>Дата входа:</div><span>' + info[10] + '</span></div>') + (!info[12] ? '' : '<div class="char_item"><div>Деньги:</div><span>' + info[12] + '</span></div>') + (!info[13] ? '' : '<div class="char_item"><div>Валюта(DLR):</div><span>' + (info[13] == 'недоступно' ? info[13] : info[13] + '<input type=button class=lbut value="Выдать" onClick="AddDD();">') + '</span></div>') + (!info[14] ? '' : '<div class="char_item"><div>Валюта($):</div><span>' + info[14] + '</span></div>') + '</div></td><td class="right_middle"></td></tr><tr><td class="left_bot"></td><td class="center_bot"></td><td class="right_bot"></td></tr></table>');
    if(info[11].length > 0)
    {
        d.write(PInfoPVUMenu());
        PInfoCalendar();
    }
    d.write('<table class="infoblock2" cellspacing="0" cellpadding="0" border="0"><tr><td class="left_top"></div></td><td class="center_top"><div class="top_name_right">О себе</div></td><td class="right_top"></td></tr><tr><td class="left_middle"></td><td class="center_middle" style="width: 660px;"><div class="text" style="width:100%;">');
	hpLoad(h_hp);
	mpLoad(h_mp);
}

view_pinfo_bottom = function()
{
    d.write('<div id="footer"><span class="left_counter">' + top_small(1) + '</span><span class="right_counter">' + top_small(2) + '</span><div><a href="http://www.legendbattles.ru/?qreg=1">Регистрация</a> <img  src="http://img.legendbattles.ru/image/pinfo/sep.jpg" alt="" /> <a href="http://forum.legendbattles.ru">Форум</a><br />©  Команда «legend battles LLC. inc.», Copyright  2011-2013 | Все права защищены.</div></div>');
}
DDAdd = function(){
	var dd = $('#sumdlr').val();
	$('#ContentPopUp').html('Loading...');
	$.get("/includes/addons/admin-action/add_dlr_ajax.php", { login: params[0][0], dlr: dd }, function(data){
		$('#ContentPopUp').html(data);
	});
}

AddDD = function(){		
	pInfoPopUp('darker');
    $('#ContentPopUp').html('<div>Выдать DLR: <input type=text class=logintextbox8 name=sumdlr id=sumdlr value=""><input type=button value="выдать" class=lbut onClick="DDAdd();"><input type="hidden" name="userid" id="userid" value="' + info[8] + '" /></div>');
}

CheangeAvatar = function()
{
	pInfoPopUp('darker');
    $('#ContentPopUp').html('<form id="imageform" method="post" enctype="multipart/form-data" action="/gameplay/ajax/ajaximage.php"><div id="preview">Изображение:<input type="file" name="photoimg" id="photoimg" /><input type="hidden" name="userid" id="userid" value="' + info[8] + '" /></div></form>');
	$('#photoimg').live('change', function(){
		$("#imageform").ajaxForm({target: "#preview"}).submit();
		$("#preview").html('Uploading...');
	});
}
pInfoPopUp = function(id){
	$('#'+id).toggle('slow');
}
