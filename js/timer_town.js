var d = document;
var world = false;
var transport_img = false;
var timer_img = false;
var timer_sec = false;
var width = 3;
var height = 1;
var move_interval = 50;
var current_x = 0;
var current_y = 0;
var time_left = 0;
var time_left_sec = 0;
var pause = 0;
var t = 0;
var tsec = 0;
var cur_margin_top = 0;
var cur_margin_left = 0;
var moving_status = 0;
var finStatus = 0;
var classn = false;
var MESSD = false;
var MDARK = false;
var rinit = 0;
var vcode = 'no';
var col = 0;
var ddt = 0;
var nddt = 0;

var pngAlpha = 1;
var ua = navigator.userAgent.toLowerCase();

function timerst(mess,protype,timer)
{
    time_left_sec -= 1000;
    if(time_left_sec <= 0)
    {
        timer_img.src = 'http://img.legendbattles.ru/image/1x1.gif';
        d.getElementById('tdsec').innerHTML = '';
        d.getElementById('timerdiv').style.display = 'none';
        d.getElementById('timerfon').style.display = 'none';
        clearInterval(tsec);
		writebutmess(mess,protype,timer);	
    }
    else
    {
        d.getElementById('tdsec').innerHTML = (time_left_sec / 1000); 
    }    
}

function TimerStart(mess,secgo,protype)
{
    if(time_left_sec <= 0)
    {
        time_left_sec = secgo*1000;
        if(!timer_img) createCursor();
        timer_img.src = 'http://img.legendbattles.ru/image/map/world/timer.png';
        d.getElementById('timerfon').style.display = 'block';
        d.getElementById('timerdiv').style.display = 'block';
        d.getElementById('tdsec').innerHTML = secgo;
        tsec = setInterval('timerst(\''+mess+'\','+protype+','+secgo+')', 1000);
    }
    else time_left_sec += secgo*1000;     
}

function createCursor()
{
    var div = d.createElement('DIV');
    div.id = 'cursor';

    div.style.display = 'block';
    div.style.position = 'absolute';
    div.style.marginLeft = (1 + (width)*50) + 'px';
    div.style.marginTop = (1 + (height)*50) + 'px';

    div = d.createElement('DIV');
    div.id = 'timerfon';
    
    div.style.display = 'none';
    div.style.position = 'absolute';
    div.style.marginLeft = ((width)*50) + 'px';
    div.style.marginTop = ((height - 1)*50) + 'px';
    
    timer_img = d.createElement('IMG');
    timer_img.width = 100;
    timer_img.height = 100;
    
    div.appendChild(timer_img);
    d.getElementById('world_cont2').appendChild(div);
    
    div = d.createElement('DIV');
    div.id = 'timerdiv';

    div.style.display = 'none';
    div.style.position = 'absolute';
    div.style.marginLeft = ((width)*50) + 'px';
    div.style.marginTop = (42 + (height - 1)*50) + 'px';
    div.innerHTML = '<table cellpadding=0 cellspacing=0 border=0 width=100><tr><td align=center id="tdsec" class="timer_s"></td></tr></table>';
    
    d.getElementById('world_cont2').appendChild(div);
}

function RetClass()
{
    var userAgent = navigator.userAgent.toLowerCase();
    if(userAgent.indexOf('mac') != -1 && userAgent.indexOf('firefox')!=-1) classn = 'TB_overlayMacFFBGHack';
    else classn = 'TB_overlayBG';
    return classn;    
}

function MessBoxDiv(mess,timer,protype,code,maxcol)
{
	vcode = code;
    if(!MESSD)
    {
		if(protype && code){
			col = d.getElementById(protype).value;
			if(col<1 || maxcol == 1){col = 1;}
			else if(col>maxcol){col=maxcol;}
		}
		ddt = new Date().getTime();
        MDARK = d.createElement('div');
        MDARK.id = 'darker';
        MDARK.className = (classn ? classn : RetClass());
		//MDARK.style.z-index = '9999';
        MDARK.style.display = 'block';
		MDARK.className = 'menu';
        d.body.appendChild(MDARK);
        
        MESSD = d.createElement('div');
        MESSD.className = 'png menu';
        MESSD.id = 'static_window';
        MESSD.innerHTML = '<div class="ws_top png"></div><div class="ws_right png"></div><div class="ws_bottom png"></div><div class="ws_middle" id="ws_middle"><div class="text" align="center" valign="absmiddle"><font class=proce>Идет переработка:<br>' + mess + '' + (protype && vcode && timer == 180 && col > 0 ? ' <font color=green>(' + col + ' шт.)</font>' : '') + '</div><br><br><br><br><div style="text-align: left;z-index:999;" id="world_cont2" align="center" valign="absmiddle"></div></div>';
        d.body.appendChild(MESSD); 
		if(timer>0){TimerStart(mess,timer,protype);}
		else{writebutmess(mess,protype,timer);}		
    }    
}

function buyItems(id,code,name,price){
    var mess = '<font class=proceb>' + name + ' (' + price + ' LR)<br>Количество: <input type=text class=logintextbox7 name=col value=1 onkeyup="writeBuy(this.value,' + id + ',\'' + code + '\');"><br><b id=buybutton><input type=button class=invbut onclick="location=\'main.php?post_id=110&act=1&col=1&uid=' + id + '&vcode=' + code + '\'" value="Купить"></b> ';
	MessBoxDiv(mess,0,0,0,0);
}

function writeBuy(val,id,code){
    d.getElementById('buybutton_' + id).innerHTML = '<input type=button class=invbut onclick="location=\'main.php?post_id=110&act=1&col=' + val + '&uid=' + id + '&vcode=' + code + '\'" value="Купить">';
}

function writeBuyShops(val,id,code){
    d.getElementById('buybutton_' + id).innerHTML = '<input type=button class=invbut onclick="location=\'main.php?post_id=110&act=3&col=' + val + '&uid=' + id + '&vcode=' + code + '\'" value="Купить">';
}

function editPrice(val,id,code){
    d.getElementById('edbutton_' + id).innerHTML = '<input type=button class=invbut onclick="location=\'main.php?post_id=110&act=4&pr=' + val + '&uid=' + id + '&vcode=' + code + '\'" value="Изменить цену">';
}

function editPriceShops(val,id,code){
    d.getElementById('edbutton_' + id).innerHTML = '<input type=button class=invbut onclick="location=\'main.php?post_id=110&act=5&pr=' + val + '&uid=' + id + '&vcode=' + code + '\'" value="Изменить цену">';
}




function writebutmess(mess,protype,timer){	
	nddt = new Date().getTime();
	parent.frames['ch_buttons'].document.FBT.text.focus();
    d.getElementById('ws_middle').innerHTML = '<div class="text" align="center" valign="absmiddle">' + (protype && vcode && timer == 180 && col > 0 ? '<font class=proce>Переработано:<br>' : '') + '' + mess + '' + (protype && vcode && timer == 180 && col > 0 ? ' <font color=green>(' + col + ' шт.)</font><br><br>Чтобы получить результат нажмите "Закрыть".' : '') + '</div><a class="cl_but" href="javascript: MessBoxDivClose(); ' + (protype && vcode && timer == 180 && col > 0 ? 'location=\'main.php?post_id=108&uid=' + protype + '&t=' + ddt + '&t2=' + nddt + '&act=1&col=' + col + '&vcode=' + vcode + '\';' : '') + '"></a>';
	d.all('col').focus();
	world = false;
	transport_img = false;
	timer_img = false;
	timer_sec = false;
	width = 3;
	height = 1;
	move_interval = 50;
	current_x = 0;
	current_y = 0;
	time_left = 0;
	time_left_sec = 0;
	pause = 0;
	t = 0;
	tsec = 0;
	cur_margin_top = 0;
	cur_margin_left = 0;
	moving_status = 0;
	finStatus = 0;
	classn = false;
	rinit = 0;
	vcode = 'no';
	col = 0;
	ddt = 0;
	nddt = 0;

	pngAlpha = 1;
	ua = navigator.userAgent.toLowerCase();
}

function MessBoxDivClose()
{
    d.body.removeChild(MESSD);
    d.body.removeChild(MDARK);
    MDARK = false;
    MESSD = false;    
}