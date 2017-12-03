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
var align = [[],["radio.gif","Dj на радио"],["litop.gif","Летописец"],["mentor.gif","Ментор"],["chaoss.gif","Дети Хаоса"],["light.gif","Истинный Свет"],["dark.gif","Истинная Тьма"],["sumer.gif","Нейтральные Сумерки"],["chaos.gif","Абсолютный Хаос"],["angel.gif","Ангел"]];
var rome_nums = ["","I","II","III","IV","V","VI","VII","VIII","IX","X"];
var ach_titles = [
    {id: 1,  title: "Гладиатор"},
    {id: 2,  title: "Охотник за головами"},
    {id: 3,  title: "Солдат удачи"},
    {id: 11, title: "Разбойник"},
    {id: 12, title: "Слуга Локара"},
    {id: 13, title: "Вивисектор"},
    {id: 14, title: "Защитник"},
	{id: 4,  title: "Поцелуй Витель"},
    {id: 5,  title: "Наставник"},
    {id: 6,  title: "Ветеран"},
    {id: 7,  title: "Полоса Везения"},
    {id: 8,  title: "Любимец Ирдиса"},
    {id: 9,  title: "Кладоискатель"},
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
    str_temp += cur+'</b> из <b>';
    for(i=max_l; i<max_zero; i++) str_temp += '0';
    str_temp += max;
    return str_temp+'</b>';    
}


function sl_html(cs){
	var temp;
	switch(cs){
		case 1: temp = '<td width=2 valign=top><img src=img/image/1x1.gif width=2 height=1></td>'; break;
		case 2: temp = '<td width=62 valign=top><table cellpadding=0 cellspacing=0 border=0 width=62>'; break;
		case 3: temp = '<img src=img/image/weapon/slots/1x1gr.gif width=1 height=20>'; break;
	}
	return temp;
}

function sl_image(image,nick,wsize){
	return '<td width='+wsize+' valign=top><img src=img/image/1x1.gif width=1 height=23><br><img src=img/image/obrazy/'+image+' border=0 width='+wsize+' height=255 title="'+nick+'"></td>';
}

function sl_butt(m,u,v,s,w,h){
	var arr = m.split(":");
	var alt = '<b>'+arr[1]+'</b>';
	if(arr[2]) alt += sl_alts(arr[2],s);
	if(arr[0] != w + 'x'+ h + '.png'){
		return '<div style="width:'+w+'px;height:'+h+'px;" class="slot">'+(v ?'<img src=img/image/weapon/'+arr[0]+' width='+(w-6)+' height='+(h-6)+' onmouseover="tooltip(this,\''+alt+'\')" onmouseout="hide_info(this)" onclick="location=\'main.php?post_id=57&act=0&wid='+u+'&vcode='+v+'\'" style="cursor:pointer;">':'')+'</div>';
	}
	return '<div style="float:left;"><img src=img/image/weapon/'+arr[0]+' width='+w+' height='+h+' onmouseover="tooltip(this,\''+alt+'\')" onmouseout="hide_info(this)"></div>';
}

sl_view = function(m,w,h)
{
	var arr = m.split(":");
	var alt = arr[1];
	if(arr[2]) alt += sl_alts(arr[2],s);
	if(arr[0] != w + 'x'+ h + '.png'){
		return '<div style="width:'+w+'px;height:'+h+'px;" class="slot">'+((arr[0].substr(0,2) != 'sl' && arr[0].substr(0,4) != 'rune')?'<img src=img/image/weapon/'+arr[0]+' width='+(w-6)+' height='+(h-6)+' onmouseover="tooltip(this,\''+alt+'\')" onmouseout="hide_info(this)">':'')+'</div>';
	}
	return '<div style="float:left;"><img src=img/image/weapon/'+arr[0]+' width='+w+' height='+h+' onmouseover="tooltip(this,\''+alt+'\')" onmouseout="hide_info(this)"></div>';
}

sl_alts = function(p)
{
    var temp = '';
    var params = p.split('|');
    params[4] = parseInt(params[4]);

   	if(parseInt(params[0]) == 2) temp += ' <img src=img/image/ddb.png height=18 width=27> ';
	else if(parseInt(params[0]) == 1) temp += ' <img src=img/image/ddb2.png height=20 width=20> ';
    if(parseInt(params[1]) != 0) temp += '<br>'+'Удар: '+params[1]+'-'+params[2];
    if(parseInt(params[3]) != 0) temp += '<br>'+'Класс брони: +'+params[3];
    if(params[4] > 0) temp += '<br>'+'Пробой брони: +'+params[4];
    else if(params[4] < 0) temp += '<br>'+'Пробой брони: '+params[4];
    if(parseInt(params[5]) != 0) temp += '<br>'+'HP: +'+params[5];
    if(parseInt(params[6]) != 0) temp += '<br>'+'MP: +'+params[6];

    return temp; 
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
    
    //Эфекты
    d.write('<div id="tooltip"></div><div id="main"><div id="effects">');
   for(i=0; i<effects.length; i++) d.write('<img src="img/image/pinfo/eff_'+effects[i][0]+'.gif" width="29" height="29" onmouseover="tooltip(this,\''+effects[i][1]+'\')" onmouseout="hide_info(this)">');
   //аккаунты
    d.write('</div><div id="znaki">');
    for(i=0; i<ability.length; i++) d.write('<img src="img/image/pinfo/t'+ability[i][0]+'.gif" width="44" height="45" onmouseover="tooltip(this,ShowInfo,\'<b>'+ability[i][1]+((ability[i][2] && ability[i][3])?'</b><br>'+ability[i][2]+'<br>'+ability[i][3]:'</b>')+'\')" onmouseout="hide_info(this);"/>');
    d.write('</div><table cellspacing="0" cellpadding="0" border="0" width="1004px"><tr><td style="width:296px"><table style="margin:'+(premium>1?'':'1')+'25px 0 0 35px;" cellspacing="0" cellpadding="0" border="0"><tr><td colspan=5>'+(premium>1?'<div align=center><img src="img/image/pinfo/p'+premium+'.png" onmouseover="tooltip(this,\'Персонаж является владельцем расширенного аккаунта<br><b><div align=center>'+prem_inf[premium]+'</div></b>\')" onmouseout="hide_info(this)"  /></div>':'')+'</td></tr><tr><td></td><td><div></div></td><td class="center" style="width:310px;"><div id="liw_table"><div id="liw_table_top"></div><div id="liw_table_title"><B><font color=000000>Показатели: Статы и Модификаторы</font></div><div id="liw_table_content">');
    var stats = 0;
    for(i=0; i<params[1].length; i++) 
		//статы
    {
        stats = params[1][i][1] + params[1][i][2];
        d.write((i ? '<div class="underline"></div>' : '')+'<div class="char_item"><div>'+params[1][i][0]+':</div><span class="tb"><b><font color=black>'+(stats > 1 ? stats : 1)+'</font></b>'+(params[1][i][2] ? '&nbsp;('+params[1][i][1]+(params[1][i][2] > 0 ? '+<font color=red>' : '')+params[1][i][2]+'</font>)' : '')+'</span></div>');    
    }
	//модив
    d.write('<div class="uzor"></div>');
    for(i=0; i<params[2].length; i++) d.write((i ? '<div class="underline"></div>' : '')+'<div class="char_item"><div>'+params[2][i][0]+':</div><span><strong><font color=black>'+params[2][i][1]+'</strong>%</font></strong></span></div>');
   //Статистика: набранный опыт
    d.write('</div><div id="liw_table_bottom"></div></div></td><td class="layer"><div></div></td><td class="right"><div class="top_right_left"></div></td></tr><tr><td class="bot_left"></td><td class="bot_layer"><div></div></td><td class="bot_center"></td><td class="bot_layer"><div></div></td><td class="bot_right"></td></tr><tr><td style="width:232px;" colspan=5 align=left><div id="liw_table"><div id="liw_table_top"></div><div id="liw_table_title"><B><font color=000000>Статистика: набранный опыт</font></div><div id="liw_table_content"><div align=left>&nbsp;Боевой опыт:<b>&nbsp;'+exp[1]+'</b><div class="underline"></div>&nbsp;Мирный опыт:<b>&nbsp;'+exp[2]+'</b></font><div class="underline"></div>&nbsp;Магический опыт:<b>&nbsp;'+exp[3]+'</b></font></div></div><div id="liw_table_bottom"></div></div></td>');
	//логин
	d.write('</tr></table></td><td style="width:392px;height:508px;"><table cellpadding="0" cellspacing="0" border="0" width="341" height="470" style="position:relative;"><td width="141" height="96"  no-repeat;">&nbsp;</td><td  repeat-x;">&nbsp;</td><td width="141" height="96">&nbsp;</td></tr><tr><td  left repeat-y;" height="314">&nbsp;</td><td><div id=TEST><table cellpadding="0" cellspacing="0" border="0" width="303" align="center" style="position: fixed; height: 450px; max-height: 450px !important;position:absolute;left:347px;top:35px;background:url(\'img/image/NewDesign/status-'+'.gif\') no-repeat center bottom;"><tr><td colspan="6" height="85" width="303"<div id="top_username">');
    if(params[0][1] > 0) d.write('<img src=img/image/signs/'+align[params[0][1]][0]+' width=16 height=16 border=0 align=absmiddle onmouseover="tooltip(this,\''+align[params[0][1]][1]+'\')" onmouseout="hide_info(this)"> ');
    if(params[0][2] != 'none') d.write('<img src=img/image/signs/'+params[0][2]+' width=15 height=12 border=0 align=absmiddle onmouseover="tooltip(this,\''+params[0][8]+'\')" onmouseout="hide_info(this)">&nbsp;');
         var ach = '';
    var i = 0;
    for(var j=0; j<achievements.length; j++)
    {
        if (achievements[j] && achievements[j] > 0)
            ach += (ach != '' ? '' : '')+'<img src="img/achievement/'+ach_titles[j]['id']+'/a_'+ach_titles[j]['id']+'_'+achievements[j]+'.gif" onmouseover="tooltip(this,\''+ach_titles[j]['title']+' '+rome_nums[achievements[j]]+'\')" onmouseout="hide_info(this)" />';
   }
        if (ach == '') ach = '<br><font style="color:#666;font: 13px Verdana;font-weight:bold;"><center>нет достижений</font><br>';
		d.write('<font color="#666"><font style="color: #'+fcolor[0]+'">'+(info[13]?'<a onClick="admWindow(\''+params[0][0]+'\');" class=nickname>'+params[0][0]+'</a>':params[0][0])+'</font> ['+params[0][3]+']'+((hacker > 0) ? '<img src=img/image/signs/key_quest.png width=11 height=12 border=0 onmouseover="tooltip(this,\'<b>Взломщик '+hacker+' ур.</b>\')" onmouseout="hide_info(this)" align=absmiddle>' : '' )+' <SUP> <SUP>'+hpmp[4]+'%</SUP></div></td></tr><tr>');
	
	//жизнь
    d.write('<table><tr><td><img src="img/image/NewDesign/inf/nohp_nomn_nopw.gif" width="207" height="16" style="position:absolute;top:1px;left:56px;"><img src="img/image/NewDesign/inf/line_left.png" width="56" height="16" style="position:absolute;top:0px;left:0px;"><img src="img/image/NewDesign/inf/line_right.png" width="56" height="16" style="position:absolute;top:0px;left:263px;"><img src="img/image/NewDesign/inf/hp.gif" id="img_hp" width="65" height="16" style="position:absolute;top:1px;left:56px;"><img src="img/image/NewDesign/inf/mn.gif" id="img_ma" width="65" height="16" style="position:absolute;top:1px;left:127px;"><img src="img/image/NewDesign/inf/pw.gif" id="img_en" width="65" height="16" style="position:absolute;top:1px;left:198px;"><img src="img/image/NewDesign/inf/piece.gif" width="6" height="16" style="display:inline;position:absolute;top:1px;left:121px"><img src="img/image/NewDesign/inf/piece.gif" width="6" height="16" style="display:inline;position:absolute;top:1px;left:192px"><div id="div_hp" style="left:56px;" class="hme"  onmouseover="tooltip(this,\'Состояние HP: [ <b>'+hpmp[0]+'</b> из <b>'+hpmp[1]+'</b> ]\')" onmouseout="hide_info(this)">'+hpmp[0]+'|'+hpmp[1]+'</div><div id="div_ma" style="left:127px;" class="hme" onmouseover="tooltip(this,\'Количество MP: [ <b>'+hpmp[2]+'</b> из <b>'+hpmp[3]+'</b> ]\')" onmouseout="hide_info(this)">'+hpmp[2]+'|'+hpmp[3]+'</div><div id="div_en" style="left:198px;" class="hme"  onmouseover="tooltip(this,\'Общая усталость: [ <b>0</b> из <b>'+hpmp[4]+'</b> ]\')" onmouseout="hide_info(this)">'+hpmp[4]+'</td>');	
		
	//слоты под медальки
	//d.write('<tr><tr><table id="slots"><tr>');
	//d.write('<td>'+sl_view(slots_arr[19],54,50)+sl_view(slots_arr[20],54,50)+sl_view(slots_arr[21],54,50)+sl_view(slots_arr[21],54,50)+sl_view(slots_arr[21],54,50)+'</td>');
		
	// Пишим  слоты by solt
	d.write('<table width=300 id="slots"><tr>');
	d.write('<td>'+sl_view(slots_arr[9],62,40)+'</td>');
	d.write('<td>'+sl_view(slots_arr[0],66,66)+'</td>');
	d.write('<td>'+sl_view(slots_arr[11],62,40)+'</td></tr>');
	
	d.write('<tr><td>'+sl_view(slots_arr[2],62,91)+'</td>');
	d.write('<td rowspan="3"><img class="slot" src="img/image/obrazy/'+params[0][4]+'" border=0  height=240"></td>');
	d.write('<td>'+sl_view(slots_arr[12],62,91)+'</td></tr>');
	
	d.write('<tr><td>'+sl_view(slots_arr[15],62,83)+'</td>');
	d.write('<td>'+sl_view(slots_arr[16],62,83)+'</td></tr>');
	
	d.write('<tr><td>'+sl_view(slots_arr[3],62,40)+'</td>');
	d.write('<td>'+sl_view(slots_arr[8],62,40)+'</td></tr>');
	d.write('<tr><td colspan=3 class="over">'+sl_view(slots_arr[4],23,23)+sl_view(slots_arr[5],24,23)+sl_view(slots_arr[6],23,23)+'</td></tr>');
	d.write('<tr><td>'+sl_view(slots_arr[10],66,66)+'</td>\
			<td>'+sl_view(slots_arr[19],30,30)+sl_view(slots_arr[20],30,30)+sl_view(slots_arr[21],30,30)+sl_view(slots_arr[22],30,30)+sl_view(slots_arr[13],30,30)+sl_view(slots_arr[1],66,30)+sl_view(slots_arr[14],30,30)+'</td>\
			<td>'+sl_view(slots_arr[7],66,66)+'</td></tr></table>');
	
//соц кнопки
d.write('<div align=center><div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,moimir,gplus" data-counter=""></div>');			
//Достижения

d.write('</table><div align=center><table style="margin:15px 0 0 0;" cellspacing="0" cellpadding="0" border="0"><tr><td class="left" style="vertical-align:middle;"></td><div align=center><td class="center"><span><div align=center></b></font><div class="underline"></div><B><font color=000000>Достижения</span></font></div><div align=center>'+ach+'</div></div></td>');
				
	
	if(params[0][9] == 'Вольный'){
		var xy = 'Статус';
		params[0][9] = (!info[3] ? 'Вольный' : 'Вольная');
	}
	else {var xy = 'Звание';}
	var ratingdiv = '';
	var superdiv = '';
	//Общие данные
	d.write(''+superdiv+'<br>'+ratingdiv+'</div></td></tr></table><td style="width:296px"><table  style="margin:125px 0 0 0;" cellspacing="0" cellpadding="0" border="0"><tr><td></td><td><div></div></td><td class="center" style="width:310px;"><div id="liw_table"><div id="liw_table_top"></div><div id="liw_table_title"><B><font color=000000>Общие данные</font></div><div id="liw_table_content"><div class="line_text">Дата рождения: <strong>'+params[0][11]+'</strong></div>'+(params[0][12] ? '<div class="underline"></div><div class="line_text">В браке: <strong>'+params[0][12]+'</strong></div>':'<div class="underline"></div><div class="line_text">В браке: <strong>'+(!info[3] ? 'не женат' : 'не замужем')+'</strong></div>')+(params[0][9] ? '<div class="underline"></div><div class="line_text">'+xy+': <b>'+params[0][9]+'</b></div>' : '')+'</div><div id="liw_table_bottom"></div></div></td><td class="layer"><div></div></td><td class="right"></td></tr><tr><td class="bot_left"></td><td class="bot_layer"><div></div></td><td class="bot_center"></td><td class="bot_layer"><div>');
	//
	showHide = function(e,ev,a){
	switch(ev){
		case 'Показать': $("tr."+a).show(250); $(e).val('Скрыть');break;
		case 'Скрыть':  $("tr."+a).hide(250); $(e).val('Показать');break;
	}
}
    d.write(''+superdiv+'<br>'+ratingdiv+'</div></td></td></tr></table><table style="margin:15px 0 0 0;" cellspacing="0" cellpadding="0" border="0"><tr><td class="left" style="vertical-align:middle;"></td><td class="center" style="width:232px;"><div id="liw_table"><div id="liw_table_top"></div><div id="liw_table_title"><B><font color=000000>Местоположение и Статус</font></div><div id="liw_table_content"><div align=center>'+(params[0][6] ? '<b>В игре: <font color=#33DD66>онлайн</font></b><div class="underline"></div><b>'+places[0]+'</b>'+(params[0][7] ? ' [ <a href="./logs.php?fid='+params[0][7]+'" target=_blank style="color:#ff3036;"><b>в бою</b></a> ]' : '')+'<div class="underline"></div>'+places[1] : '<b>В игре: <font color=#cc0000>оффлайн</font></b><div class="underline"></div><b>Персонаж находится вне мира</b><div class="underline"></div>Местоположение: неизвестно')+'</div></div><div id="liw_table_bottom"></div></div></td><td style="vertical-align:middle;" class="right"></td></tr><tr><td class="bot_left"></td><td class="bot_center"></td><td class="bot_right"></td><td style="vertical-align:middle;" class="right"></td></tr><tr><td class="bot_left"></td><td class="bot_center"></td><td class="bot_right"></td></tr></table><table style="margin:15px 0 0 0;" cellspacing="0" cellpadding="0" border="0"><tr><td class="left" style="vertical-align:middle;"></td><td class="center" style="width:232px;"><div id="liw_table"><div id="liw_table_top"></div><div id="liw_table_title"><B><font color=000000>Сражения</font></div><div id="liw_table_content"><div align=left>&nbsp;Побед над игроками:<b>&nbsp;'+warstats[0]+'</b><div class="underline"></div>&nbsp;Поражений от игроков:<b>&nbsp;'+warstats[1]+'</b></font><div class="underline"></div>&nbsp;Побед над ботами:<b>&nbsp;'+warstats[2]+'</b></font><div class="underline"></div>&nbsp;Поражений от ботов:<b>&nbsp;'+warstats[3]+'</b></font><div class="underline"></div>&nbsp;Выполнено квестов:<b>&nbsp;'+warstats[4]+'</b></font></div></div><div id="liw_table_bottom"></div></div></td><td style="vertical-align:middle;" class="right"></td></tr><tr><td class="bot_left"></td><td class="bot_center"></td><td class="bot_right"></td></tr><!--tr><td colspan=3><br><br>'+superdiv+'</td></tr--></table></td></tr></table><div class="div"><div class="div_block"><div class="div_right"><div class="div_gr" style="width: 850px;"><div class="div_center"></div></div></div></div></div><div class="presents">');
    var pr_c = presents.length;
    //Подарки
	for(i=0; i<pr_c; i++) d.write('<img src=img/image/presents/'+presents[i][0]+'.gif width=100 height=100 onmouseover="tooltip(this,\''+presents[i][1]+'\')" onmouseout="hide_info(this)">');
	
    
    d.write('<table class="infoblock2" cellspacing="0" cellpadding="0" border="0"><tr><td class="left_top"><div class="top_left_right"></div></td><td class="center_top"><div class="top_name_right">О Персонаже: Общие данные</div></td><td class="right_top"><div class="top_right_right"></div></td></tr><tr><td class="left_middle"></td><td class="center_middle" style="width: 660px;">'+(params[0][0]==''?'<div align=right style="float: right"><img src="img/image/gdil.jpg" title="Талисман"></div>':'')+'<div class="chars"><div class="char_item"><div>Имя:</div><span>'+info[0]+'</span></div><div class="char_item"><div>Страна:</div><span>'+info[1]+'</span></div><div class="char_item"><div>Город:</div><span>'+info[2]+'</span></div><div class="char_item"><div>Пол:</div><span>'+(!info[3] ? 'Мужской' : 'Женский')+'</span></div><div class="char_item"><div>Домашняя страница:</div><span><a href="http://'+info[4]+'" target=_blank>'+info[4]+'</a></span></div>'+(!info[5] ? '' : '<div class="char_item"><div>E-mail:</div><span>'+info[5]+'</span></div>')+(!info[6] ? '' : '<div class="char_item"><div>Дата рождения:</div><span>'+info[6]+'</span><div>Возрост:</div><span>'+info[15]+'</span></div>')+(!info[7] ? '' : '<div class="char_item"><div>ICQ:</div><span>'+info[7]+'</span></div>')+(!info[8] ? '' : '<div class="char_item"><div>ID Персонажа:</div><span>'+info[8]+'</span></div>')+(!info[9] ? '' : '<div class="char_item"><div>IP:</div><span>'+info[9]+'</span></div>')+(!info[10] ? '' : '<div class="char_item"><div>Дата входа:</div><span>'+info[10]+'</span></div>')+(!info[12] ? '' : '<div class="char_item"><div>Деньги:</div><span>'+info[12]+'</span></div>')+(!info[13] ? '' : '<div class="char_item"><div>Валюта(Изумруд):</div><span>'+(info[13]=='недоступно'?info[13]:info[13]+'')+'</span></div>')+(!info[14] ? '' : '<div class="char_item"><div>Валюта($):</div><span>'+info[14]+'</span></div>')+'</div></td><td class="right_middle"></td></tr><tr><td class="left_bot"></td><td class="center_bot"></td><td class="right_bot"></td></tr></table>');
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
    d.write('<div id="footer"><span class="left_counter">'+top_small(1)+'</span><span class="right_counter">'+top_small(2)+'</span><div><a href="http://www.legendbattles.ru/?qreg=1">Регистрация</a> <img  src="img/image/pinfo/sep.jpg" alt="" /> <a href="http://forum.legendbattles.ru">Форум</a><br />©  Команда «legend battles LLC. inc.», Copyright  2011-2013 | Все права защищены.</div></div>');    
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
	$('#ContentPopUp').html('<input type=text class=logintextbox8 name=sumdlr id=sumdlr value=""><input type=button value="выдать" class=lbut onClick="DDAdd();"><input type="hidden" name="userid" id="userid" value="'+info[8]+'" /></div>');
}

CheangeAvatar = function()
{
	pInfoPopUp('darker');
	$('#ContentPopUp').html('<form id="imageform" method="post" enctype="multipart/form-data" action="/gameplay/ajax/ajaximage.php"><div id="preview">Изображение:<input type="file" name="photoimg" id="photoimg" /><input type="hidden" name="userid" id="userid" value="'+info[8]+'" /></div></form>');
	$('#photoimg').live('change', function(){
		$("#imageform").ajaxForm({target: "#preview"}).submit();
		$("#preview").html('Uploading...');
	});
}
pInfoPopUp = function(id){
	$('#'+id).toggle('slow');
}
