var c_showed = 0;
var wX=0,wY=0;
var waiterMode = 1;
var D2=0;


document.write('<div style="position:absolute; left:-2px; top:-2px; z-index: 65200; width:0px; height:0px; visibility:visible;" id="center" class="but"></div><div style="position:absolute; left:-2px; top:-2px; z-index: 65300; width:0px; height:0px;display:none;" id="info"></div><div style="position:absolute; left:-2px; top:-2px; z-index: 65200; width:0px; height:0px;" id="zcenter"></div><div style="position:absolute; left:0px; top:0px; z-index: 65100; width:100%; height:100%; display:none; text-align:center;" id="center2" class=news>&nbsp;</div><div style="position:absolute; left:0px; top:0px; z-index: 65200; width:100%; height:100%; display:none; text-align:center;" id="center3" class=news>&nbsp;</div>');
$("#zcenter").hide(1);
$("#center").hide(5);
var map_load = 1;

function view_nature(params)
{
	parent.frames['updater'].location = 'mod_nature/_nature.php?'+params+'&'+Math.random();
	wX = aX;
	wY = aY;

}

function ready_nature(a1,a2,a3,a4,a5,a6)
{
	document.getElementById('_top').innerHTML = "<table border=0 cellspacing=0 cellspadding=0 width=1%></table>";
	document.getElementById("loc").innerHTML = sbox2(parent.frames['updater'].document.getElementById("loc").innerHTML);
	document.getElementById("resource").innerHTML = sbox2(parent.frames['updater'].document.getElementById("resource").innerHTML);
	if (map_load)
	{
	//var column = ''+'<div style="position: absolute; width:39; height:337; top:67px; left:80px; z-index:2;"></div>'+'<div style="position: absolute; width:39; height:337; top:67px; left:640px; z-index:2;"></div>';
	var column = '';
	column = '';
        // Размер мапы
	//document.getElementById("map").innerHTML = column+"<div id=mapl style='width: 560px;height: 350px;display: block;overflow: hidden;'></div>";
	document.getElementById("map").innerHTML = "<div id=mapl style='width: 560px;height: 350px;display: block;overflow: hidden;'></div>";
	map_load = 0;
	ready_map();
	}
	else
	ready_map();
	if (document.getElementById("outer").innerHTML)
	{
		waiterMode = 0;
		$("#info").css({left:'21%',top:'70px',width:'60%',height:'0px'});
        document.getElementById("info").innerHTML = sbox3('<center class=but_view style="overflow-y:auto;z-index:10;"><a href="javascript:hide_info()" class=blocked>Убрать</a><hr>' + document.getElementById("outer").innerHTML + '</center>');
		$("#info").fadeIn(500);
		$("#center3").css("visibility","visible");
	}
}

function hide_info()
{
	document.getElementById("outer").innerHTML = '';
	document.getElementById("info").innerHTML = '';
	$("#center3").css("visibility","hidden");
	$("#info").fadeOut(300);
}

function hps(a1,a2,a3,a4,a5,a6)
{
	document.getElementById("d1").innerHTML = document.getElementById("d1").innerHTML;
}

function ready_map()
{
	scrollmap();
}

function go_nature(x,y)
{
	view_nature("go_nature=1&gox="+x+"&goy="+y);
	parent.chat_frame['list'].location='ch.php'
	document.getElementById("outer").innerHTML = '';
	document.getElementById("info").innerHTML = '';

}

function waiterSPEC(t,info)
{
	if (info==undefined) info = '';
	allTime = t;
	if (!t) return;
	wtwt();
	setTimeout("wtwt()",t*1000);
	waiter(t,1,info);
}

function wtwt()
{
	if (!c_showed)
	{
	 $("#zcenter").css({left:'40%',top:'60px',width:'210px',height:'30px'});
	 $("#center2").css("display","block");
	 c_showed=1;
	 $("#zcenter").html('<center id=waiter class=go_out></center>');
	 $("#zcenter").slideDown(300);
	 }
	else
	{
	 $("#center2").css("display","none");
	 $("#zcenter").slideUp(300);
	 c_showed=0;
	}
}

var go_str;

function Minus(a)
{
	if(a<0) a = "M"+Math.abs(a);
	return a;
}

function show_nature(x,y,A){
var f='"';
var tmp = '#FFFFFF';
if (parent.frames["updater"].m_name)
{
	f='cursor:pointer" title="'+parent.frames["updater"].m_name+'" '+parent.frames["updater"].m_code;
	tmp = '#AAFFAA';
}

if (parent.frames["updater"].go_str)
	eval(parent.frames["updater"].go_str);
if (parent.frames["updater"].bd_str)
	eval(parent.frames["updater"].bd_str);
x+=22;
y+=26;
var text;
var colorTd,tmpTd,tipTd;
var bdTd,btmpTd;
var tmpStr;
var onclicktxt = '';
var name = '';
text = '<table border="0" cellspacing="0" cellpadding="0" style="width:650px;height:350px;">';
var cx,cy;
var h=(new Date()).getHours();
if (h > 23 || h < 7) var dir = 'map/night';
if (h > 6 && h < 12) var dir = 'map/day';
if (h > 11 && h < 19) var dir = 'map/day';
if (h > 18 && h < 24) var dir = 'map/night';

 for(cy=y-3;cy<=y+3;cy++)
 {
 text+='<tr>';
 for (cx=x-5;cx<=x+4;cx++)
 {
 name = '';
 eval("if(typeof NAME"+Minus(cx-22)+"_"+Minus(cy-26)+" != 'undefined')name=NAME"+Minus(cx-22)+"_"+Minus(cy-26)+";");
 eval("if(typeof X"+Minus(cx-22)+"_"+Minus(cy-26)+" != 'undefined')tmpTd=X"+Minus(cx-22)+"_"+Minus(cy-26)+"; else tmpTd=-1;");
 eval("if(typeof B"+Minus(cx-22)+"_"+Minus(cy-26)+" != 'undefined')btmpTd=B"+Minus(cx-22)+"_"+Minus(cy-26)+"; else btmpTd=-1;");
	if (cx==x && cy==y)
	{
		colorTd = tmp;
		if ((tmpTd&3)==1) colorTd = '#FFFFFF';
		if ((tmpTd&3)==2) colorTd = '#0000FF';
		if ((tmpTd&3)==3) colorTd = '#FFFFFF';
		if ((tmpTd&4)==4) colorTd = '#00FFFF';

		if (btmpTd!=-1)                                                                                                               // solid #d60000
            building = '<div title="Ваше местоположение[' + name + ']" style="position:absolute;z-index:3;width:78px;height:78px;border:1px;' + f + '>&nbsp;</div><img src=http://img.legendbattles.ru/images/buildings/' + btmpTd + '.gif title="Ваше местоположение[' + name + ']">';
		else
            building = '<div title="Ваше местоположение[' + name + ']" style="width:78px;height:78px;border:1px solid #d60000;' + f + '>&nbsp;</div>';
		    text+='<td style=\'width:80px;height:80px;cursor:pointer;background-image: url("http://img.legendbattles.ru/images/'+dir+'/'+cx+'_'+cy+'.jpg");\' valign=top>'+building+'</td>';
	}
	else
	if (tmpTd!=-1 && ((cx-x)*(cx-x)+(cy-y)*(cy-y))<=(50+A*6))
	{
		colorTd = '#FFFFFF';
		tipTd = "";
        if ((tmpTd & 3) == 1) {
            colorTd = '#FFFFFF';
            tipTd = ',&nbsp;Дикая местность';
        }
        if ((tmpTd & 3) == 2) {
            colorTd = '#0000FF';
            tipTd = ',&nbsp;Пригодна для строительства';
        }
        if ((tmpTd & 3) == 3) {
            colorTd = '#FFFFFF';
            tipTd = ',&nbsp;Дикая местность[Пригодна для строительства]';
        }
        if ((tmpTd & 4) == 4) {
            colorTd = '#00FFFF';
            tipTd = ',&nbsp;Ваша местность';
        }

		if (btmpTd!=-1)
			building = '<div style="position:absolute;z-index:3;width:78px;height:78px;border:1px;">&nbsp;</div><img src=http://img.legendbattles.ru/images/buildings/'+btmpTd+'.gif>';
		else
			building = '<div style="width:78px;height:78px;border:1px solid #600000;">&nbsp;</div>';

		if(tmpTd!=-1 && ((cx-x)*(cx-x)+(cy-y)*(cy-y))<=2)
			onclicktxt = 'onclick="go_nature('+(cx-22)+','+(cy-26)+')"';
		else
			onclicktxt = '';


		if (((cx-x)*(cx-x)+(cy-y)*(cy-y))<=2)
            text += '<td ' + onclicktxt + ' style=\'width:80px;height:80px;cursor:pointer;background-image:url("http://img.legendbattles.ru/images/' + dir + '/' + cx + '_' + cy + '.jpg");\' valign=top title="[' + name + ']Перейти' + tipTd + '">' + building + '</td>';
		else if(colorTd!='#FFFFFF')
		{
			if (btmpTd!=-1)
				building = '<div style="width:78px;height:78px;border:2px solid #0A8900;border-style:none;position:absolute;z-index:3;">&nbsp;</div><img src=http://img.legendbattles.ru/images/buildings/'+btmpTd+'.gif>';
			else
				building = '<div style="width:78px;height:78px;border:2px solid #0A8900;border-style:none;" title="'+tipTd+'">&nbsp;</div>';
            text += '<td title="[' + name + ']Недоступно" style=\'width:78px;height:78px;background-image:url("http://img.legendbattles.ru/images/' + dir + '/' + cx + '_' + cy + '.jpg");\'>' + building + '</td>';
		}else
		{
			if (btmpTd!=-1)
				building = '<img src=http://img.legendbattles.ru/images/buildings/'+btmpTd+'.gif>';
			else
				building = '&nbsp;';
				// close
            text += '<td title="[' + name + ']Недоступно" style=\'width:78px;height:78px;background-image:url("http://img.legendbattles.ru/images/' + dir + '/' + cx + '_' + cy + '.jpg");\'>' + building + '</td>';
		}
	}
	else
	{
		if (btmpTd!=-1)
			building = '<img src=http://img.legendbattles.ru/images/buildings/'+btmpTd+'.gif>';
		else
			building = '<div style="width:80px;height:80px;border-style:none;">&nbsp;</div>';
        text += '<td title="[' + name + ']Недоступно" style=\'width:80px;height:80px;background-image:url("http://img.legendbattles.ru/images/' + dir + '/' + cx + '_' + cy + '.jpg");\'>' + building + '</td>';
	}
 }
 text+='</tr>';
 }
  text+='</table>';
 return text;
}


function upd_square()
{
var f='"';
var tmp = '#FFFFFF';
if (parent.frames["updater"].m_name)
{
f='cursor:pointer" title="'+parent.frames["updater"].m_name+'" '+parent.frames["updater"].m_code;
tmp = '#AAFFAA';
}
document.getElementById("mapl").innerHTML +='<div class=fader style="position:absolute;z-index:4;width:80px;height:80px;left:'+(240+$("#mapl").offset().left)+';top:'+(120+$("#mapl").offset().top)+';background-color:'+tmp+';border-style:none;'+f+' id=ml>&nbsp;</div>';
}

var allTime;
var zx,zy;
var Interval = -1;

function signum(a)
{
	if (a>0) return 1;
	else if(a==0) return 0;
	else return -1;
}

function scrollmap() // Hide при действии (die)
{
			zx = signum(aX-wX)*80;
			zy = signum(aY-wY)*80;
			reset_map();
}

function reset_map()
{
	document.getElementById("mapl").innerHTML = show_nature(aX,aY,0);
	$(function(){scroll_def();});
}

function scroll_def()
{
	resize_f = 1;
	document.getElementById("mapl").scrollLeft = 120;
	document.getElementById("mapl").scrollTop = 120;
	//alert(1);
}
function place_son_on(){
    if (confirm("Вы действительно хотите прилеч отдохнуть?")) location = 'main.php?son=on';
}
function place_son_off(){
    if (confirm("Вы действительно хотите проснутся?")) location = 'main.php?son=off';
}
function place_ogon_on(){
    if (confirm("Вы действительно хотите разжеч костёр?")) location = 'main.php?ogon=on';
}
function place_ogon_off(){
    if (confirm("Вы действительно хотите потушить костёр?")) location = 'main.php?ogon=off';
}
function place_voda(){
    if (confirm("Вы действительно испить воды из озера?")) location = 'main.php?voda=on';
}