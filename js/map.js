var d = document;
var world = false;
var transport_img = false;
var timer_img = false;
var timer_sec = false;
var world_menu = false;
var clickStatus = false;
/*var width = 3;
var height = 1;*/
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
var dest_x = 0;
var dest_y = 0;
var loaded_left = 0;
var loaded_right = 0;
var loaded_top = 0;
var loaded_bottom = 0;
var moving_status = 0;
var finStatus = 0;
var gox = 0;
var goy = 0;
var gop = 0;
var avail = new Array();
var bavail = new Array();
var classn = false;
var MESSD = false;
var MDARK = false;
var rinit = 0;
var TabbedPanels1 = '';

var pngAlpha = 1;
var ua = navigator.userAgent.toLowerCase();

this.isIE = ((ua.indexOf('msie') != -1) && !(ua.indexOf('opera') != -1) && (ua.indexOf('webtv') == -1));
this.versionMinor = parseFloat(navigator.appVersion);
this.versionMajor = parseInt(navigator.appVersion);

if(this.isIE && this.versionMinor >= 4) this.versionMinor = parseFloat(ua.substring(ua.indexOf('msie ')+5));
if(this.isIE && parseInt(this.versionMinor)<7) pngAlpha = 0;


function view_build_top(){
	d.write('<div class="TopBar">\
		<div class="TopBar_left">\
			<div class="LEM fontSize_11px bold color_111">\
				<span class="MyName">\
				<center>\
					' + sh_align(build[2],0)+sh_sign(build[3],build[4],build[5]) + ' ' + build[0] + ' <span style="font-weight: normal;">[' + build[1] + ']</span>\
				</center>\
				</span>\
				<div class="LEM_bg fontSize_10px color_fff">\
					<div class="Health mainTooltip" id="Health" style="background-position:-0px 0px;">???</div>\
					<div class="Mana mainTooltip" id="Mana" style="background-position:-0px -13px;">???</div>\
				</div>\
			</div>\
		</div>\
		<div class="TopBar_right">\
			<a href="#" id="MovementMenu" class="MovementMenu mainTooltip" onmouseover="tooltip(this,\'<b>Войти</b>\');" onmouseout="hide_info(this);" style="display:none;"></a>\
			<div class="hours" style="float: right;margin-top:1px;margin-right: 121px;"><img src="img/razdor/emerald.png" width="14" height="14" title="+1 Изумруд"></div>\
			<div class="lines" style="float: right;">\
				<div class="dlr" style="margin-top: 8px;margin-right: 3px;">\
					<div class="line" id="dlrline" style="width:0"></div>\
					<div class="cnt" id="dlrcnt"></div>\
					<div class="hrs" id="hrs"></div>\
				</div>\
			</div>\
		</div>\
		<div class="TopBar_center">\
			<ul class="MainMenu">\
				<li class="CharacterMenu">\
					<a href="#" id="CharacterMenu" class="mainTooltip" onmouseover="tooltip(this,\'<b>Персонаж</b>\');" onmouseout="hide_info(this);"></a>\
				</li>\
				<li class="InventoryMenu">\
					<a href="#" id="InventoryMenu" class="mainTooltip" onmouseover="tooltip(this,\'<b>Инвентарь</b>\');" onmouseout="hide_info(this);"></a>\
				</li>\
				<li class="FightingMenu">\
					<a href="#" id="FightingMenu" class="mainTooltip" onmouseover="tooltip(this,\'<b>Поединки</b>\');" onmouseout="hide_info(this);"></a>\
				</li>\
				<li class="ClanMenu">\
					<a href="#" id="ClanMenu" class="mainTooltip" onmouseover="tooltip(this,\'<b>Клан</b>\');" onmouseout="hide_info(this);"></a>\
				</li>\
				<li class="InfoMenu">\
					<a href="#" id="InfoMenu" class="mainTooltip" onmouseover="tooltip(this,\'<b>Квесты</b>\');" onmouseout="hide_info(this);"></a>\
				</li>\
			</ul>\
		</div>\
	</div>');
	ButtonGen();
/*
	d.write('<div id="header">\
				<div class=nickname>'+sh_align(build[2],0)+sh_sign(build[3],build[4],build[5])+' '+build[0]+' ['+build[1]+'] </div>\
				<div class="lines">\
					<div class="hp">\
						<div class="line leftp" id="leftp"></div>\
						<div class="cnt" id="hpcnt"></div>\
					</div>\
					<div class="mana">\
						<div class="line leftm" id="leftm"></div>\
						<div class="cnt" id="manacnt"></div>\
					</div>\
				</div>\
				<div class="lines">\
					<div class="dlr">\
						<div class="line" id="dlrline" style="width:0"></div>\
						<div class="cnt" id="dlrcnt"></div>\
						<div class="hrs" id="hrs"></div>\
					</div>\
				</div>\
				<div class="hours"><img src="img/razdor/emerald.png" width="14" height="14" title="+1 Изумруд"></div>\
				<div class="menu">' + menu['header'] + '</div>\
			</div>\
			<div style="height:40px;width:100%"></div>');
*/
	ins_HP();
	cha_HP();
}

function view_build_bottom(){
	d.getElementById('world_menu').innerHTML = ButtonGen();
   // d.write('<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td ><img src=img/image/1x1.gif width=1 height=4></td></tr><tr><td align=center>'+view_t()+'</td></tr><tr><td ><img src=img/image/1x1.gif width=1 height=10></td></tr></table>');
}
function view_map()
{
	view_build_top();
    d.write('<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td align=center><div id="transfer"></div></td></tr><tr><td  align=center><fieldset id=supfield><legend><b><font color=gray>Природа</b></font></legend><div style="position: absolute; border: 1px solid black; overflow: hidden;" id="world_cont"></div><div style="text-align: left;" id="world_cont2"></div></fieldset></td></tr></table>');
	//d.write('<div class="map_Border_LeftTop"></div><div class="map_Border_Top" style="width: 594px;"></div><div class="map_Border_RightTop"></div><div class="map_Border_Bottom" style="width: 594px;"></div><div class="map_Border_RightBottom"></div><div class="map_Border_Right" style="height: 117px;"></div><div class="map_Border_Left" style="height: 117px;"></div></fieldset></td></tr></table>');
    for(var i=0; i<map[1].length; i++)
    {
        avail[map[1][i][0]+'_'+map[1][i][1]] = map[1][i][2];
    }
    
    if(!map[0][4].length) 
    {
        current_x = map[0][0];
        current_y = map[0][1];
        showCursor();
        showMap(current_x, current_y); 
		if(mapnavi){
			finStatus = 1;
			finFunction();
		} 		
    }
    else if(!map[0][4][0])
    {
        finStatus = 1;
        showTransport('man', map[0][4][4], map[0][4][5], map[0][0], map[0][1], 8, 'gif'); 
        loadPath(map[0][4][4], map[0][4][5], map[0][0], map[0][1], (map[0][4][3] - map[0][4][2]), (map[0][4][3] - map[0][4][1]));
        TimerStart((map[0][4][3] - map[0][4][1]),0);   
    }
    else
    {
        // Работа или защита от подбора
        finStatus = 2;
        current_x = map[0][0];
        current_y = map[0][1];
        showCursor();
        showMap(current_x, current_y); 
        TimerStart(map[0][4][1],1);
    } 
    if(map[0][5]) MessBoxDiv(map[0][5]);
    view_build_bottom(); 
}

function ButtonGen() {
	var newButtons = ["MovementMenu","CharacterMenu","InventoryMenu","FightingMenu","ClanMenu","InfoMenu"];
	var returned = genMenu = '';
    bavail = new Array();
	for(var i=0; i < newButtons.length; i++) {
		if( newButtons[i] == 'MovementMenu' ){
			$('#MovementMenu').hide();
		} else {
			$('#' + newButtons[i] )
			.css("cursor","default")
			.attr(
				"href","javascript:ButClick('disabled');"
			);
		}
	}
    for(var i=0; i<mapbt.length; i++) {
        bavail[mapbt[i][0]] = [mapbt[i][2],mapbt[i][3]];
		switch(mapbt[i][0]){
            case 'disabled':
                returned += '<img src="img/image/weapon/primanka.png" onclick=\'ButClick("' + (mapbt[i][0] == 'disabled' ? '' : mapbt[i][0]) + '")\' ' + (mapbt[i][0] == 'disabled' ? 'disabled title="У вас нет приманок"' : '') + '></a></div>';
                break;
            case 'dri':
                returned += '<div><img src="img/image/weapon/Vodopad.png" onmouseover="tooltip(this,\'<b>Пить воду</b>\');" onmouseout="hide_info(this);" onclick=\'ButClick("' + (mapbt[i][0] == 'disabled' ? '' : mapbt[i][0]) + '")\' /></div>';
                break;
                ;
            case 'editor':
                returned += '<div><img src="img/image/weapon/admin.png" onmouseover="tooltip(this,\'<b>Админка</b>\');" onmouseout="hide_info(this);" onclick=\'ButClick("' + (mapbt[i][0] == 'disabled' ? '' : mapbt[i][0]) + '")\' /></div>';
                break;
            case 'priman':
                returned += '<div><img src="img/image/weapon/primanka.png" onmouseover="tooltip(this,\'<b>Приманка</b>\');" onmouseout="hide_info(this);" onclick=\'ButClick("' + (mapbt[i][0] == 'disabled' ? '' : mapbt[i][0]) + '")\' /></div>';
                break;
            case 'tele':
                returned += '<div><img src="img/image/weapon/teleport.png" onmouseover="tooltip(this,\'<b>Телепорт</b>\');" onmouseout="hide_info(this);" onclick=\'ButClick("' + (mapbt[i][0] == 'disabled' ? '' : mapbt[i][0]) + '")\' /></div>';
                break;
            case 'navi':
                returned += '<div><img src="img/image/weapon/kompas.png" onmouseover="tooltip(this,\'<b>Навигатор</b>\');" onmouseout="hide_info(this);" onclick=\'ButClick("' + (mapbt[i][0] == 'disabled' ? '' : mapbt[i][0]) + '")\' /></div>';
                break;
            case 'ogl':
                returned += '<div><img src="img/image/weapon/travka.png" onmouseover="tooltip(this,\'<b>Поиск травы</b>\');" onmouseout="hide_info(this);" onclick=\'ButClick("' + (mapbt[i][0] == 'disabled' ? '' : mapbt[i][0]) + '")\' /></div>';
                break;
            case 'les':
                returned += '<div><img src="img/image/weapon/drava.png" onmouseover="tooltip(this,\'<b>Поиск леса</b>\');" onmouseout="hide_info(this);" onclick=\'ButClick("' + (mapbt[i][0] == 'disabled' ? '' : mapbt[i][0]) + '")\' /></div>';
                break;
			case 'que':
				$('#InfoMenu')
				.css("cursor","pointer")
				.attr(
					"href","javascript:ButClick('" +  mapbt[i][0] + "');"
				);
			break;
			case 'inv':
				$('#InventoryMenu')
				.css("cursor","pointer")
				.attr(
					"href","javascript:ButClick('" +  mapbt[i][0] + "');"
				);
			break; 
			case 'inf':
				$('#CharacterMenu')
				.css("cursor","pointer")
				.attr(
					"href","javascript:ButClick('" +  mapbt[i][0] + "');"
				);
				break; 
			case 'Clan':
				$('#ClanMenu')
				.css("cursor","pointer")
				.attr(
					"href","javascript:ButClick('" +  mapbt[i][0] + "');"
				);
			break;
            case 'fis':
                returned += '<div><img src="img/image/weapon/riba.png" onmouseover="tooltip(this,\'<b>Ловить</b>\');" onmouseout="hide_info(this);" onclick=\'ButClick("' + (mapbt[i][0] == 'disabled' ? '' : mapbt[i][0]) + '")\' /></div>';
                break;
            case 'bld':
                returned += '<div><a href="#" id="' + mapbt[i][0] + '" onclick=\'ButClick("' + (mapbt[i][0] == 'disabled' ? '' : mapbt[i][0]) + '")\' ' + (mapbt[i][0] == 'disabled' ? 'disabled' : '') + '>Строения</a></div>';
                break;
			case 'dep_yes':
				$('#MovementMenu')
				.attr(
					"href","javascript:ButClick('" +  mapbt[i][0] + "');"
				)
				.show();
			break; 
			default: returned += '<div><input type=button class="" style="font-family : Tahoma, Verdana, Arial, Helvetica, Tahoma, Verdana, sans-serif;	text-decoration : none; color : black;	font-size : 11px;" id="'+mapbt[i][0]+'" value="'+mapbt[i][1]+'" onclick=\'ButClick("'+(mapbt[i][0]=='disabled'?'':mapbt[i][0])+'")\' '+(mapbt[i][0]=='disabled'?'disabled':'')+'></div>'; break;
		}
    }
    return returned;
}
var ActionFormUse;
function closeform()
{
       document.all("transfer").style.visibility = "hidden";
       document.all("transfer").innerHTML = '<img src=image/1x1.gif width=1 height=1>';
       parent.frames['ch_buttons'].document.FBT.text.focus();
       ActionFormUse = '';
}
function fightmagicform(wuid,wnickname,wnametxt,wmcode)
{
       parent.frames['ch_buttons'].document.FBT.text.focus();
    document.all("transfer").innerHTML = '<form method=POST action="main.php"><input type=hidden name=magicrestart value="1"><input type=hidden name=magicreuid value=' + wuid + '><input type=hidden name=vcode value=' + wmcode + '><input type=hidden name=post_id value=63><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#B9A05C><table cellpadding=3 cellspacing=1 border=0 width=100%><tr><td width=100% bgcolor=#FCFAF3><font class=nickname><b>Выполнить "' + wnametxt + '" сейчас?</b></div></td></tr><tr><td bgcolor=#FCFAF3><font class=nickname><b>На кого:</b> <INPUT TYPE="text" name=fornickname class=LogintextBox value="' + wnickname + '" maxlength=25> <input type=submit value="напасть" class=fr_but> <input type=button class=fr_but onclick="closeform()" value=" x "></td></tr></table></td></tr></table></FORM>';
       document.all("transfer").style.visibility = "visible";
       document.all("fornickname").focus();
       ActionFormUse = 'fornickname';
}

function ButClick(id){
//	if(!ButtonSt('', true)){
		var goloc = '';
		switch(id) {
            case 'nap':
                fightmagicform('', '', 'тотемное нападение', bavail[id][0]);
                break;
			case 'inf': goloc = '?get_id=56&act=10&go=inf&vcode='+bavail[id][0]; break;
			case 'inv': goloc = '?get_id=56&act=10&go=inv&vcode='+bavail[id][0]; break;
			case 'ogl': Ogl(bavail[id][0]); break;
			case 'les': Les(bavail[id][0]); break;
			case 'sha': sha(bavail[id][0]); break;
			case 'fis': Fish(bavail[id][0]); break;
			case 'fig': fight_map(bavail[id][0]); break;
			case 'dep_yes': goloc = '?get_id=56&act=10&go=dep&vcode='+bavail[id][0]; break;
			case 'dep_no': Drink(bavail[id][0],2); break;
			case 'editor': window.location = '?useaction=map-action&addid=map'; break;
			case 'dri': Drink(bavail[id][0],1); break;
			case 'que': QActive(bavail[id][0]); break;
			case 'tele': teleMapTo(bavail[id][0]);break;
			case 'priman': BotNapForm(bavail[id][0]);break;
			case 'navi': NaviMapTo(bavail[id][0]);break;		
			case 'bld': Building(bavail[id][0],1,0); break;
		}
		if(goloc){
			for(var j=0; j<bavail[id][1].length; j++) goloc += '&'+bavail[id][1][j][0]+'='+bavail[id][1][j][1];
			location = goloc;
		}
//	}
}

function ButtonSt(st, info){
	if( !info ){
		console.log(clickStatus + ' > ' + st);
		clickStatus = st;
	}
	console.log(clickStatus);
	return clickStatus;
}

function ReInitBut(obj)
{
    for(var i=0; i<obj.length; i++) bavail[obj[i][0]] = [obj[i][2],obj[i][3]]; 
}

function ReAddBut(obj)
{
    var k = mapbt.length; 
    for(var i=0; i<obj.length; i++)
    {
        var nbutt = d.getElementById(obj[i][0]);
        if(!nbutt) 
        {
            mapbt[k] = [obj[i][0]];
            k++;
            bavail[obj[i][0]] = [obj[i][2],obj[i][3]];
        } 
    }        
}

function showMap(x, y) {
    if(!world) {
        world = d.createElement('DIV');
        world.id = 'world_map';
        d.getElementById('world_cont').appendChild(world);  
    }
    world.innerHTML = '<div id="world_menu">' + world_menu + '</div>';
    table = d.createElement('TABLE');
    world.appendChild(table);
    tbody = d.createElement('TBODY');
    table.appendChild(tbody);
    table.border = 0;
    table.cellPadding = 0;
    table.cellSpacing = 0;
    
    for(i=-height; i<=height; i++) {
        tr = d.createElement('TR');
        for(j=-width; j<=width; j++) {
            td = d.createElement('TD');
            td.style.backgroundImage = 'url(img/image/wmap/map/'+map[0][3]+'/'+(y+i)+'/'+(x+j)+'_'+(y+i)+'.gif)';
            
            img = d.createElement('IMG');
            img.src = 'img/image/1x1.gif';
            img.width = 100;
            img.height = 100;
            img.id = 'img_'+(x+j)+'_'+(y+i);
            
            dx = x+j;
            dy = y+i;
            
            if(avail[dx+'_'+dy] && !finStatus) {
                img.src = 'img/image/map/world/here.gif';
                img.onclick = function(dx, dy) { 
					return function() { 
						moveMapTo(dx, dy, map[0][2]); 
					} 
				}(dx, dy);
                img.style.cursor = 'pointer';
            }
            
            td.appendChild(img);
            tr.appendChild(td);
        }
        tbody.appendChild(tr);
    }
    
    current_x = x;
    current_y = y;
    
    loaded_left = x-width;
    loaded_right = x+width;
    loaded_top = y-height;
    loaded_bottom = y+height;
    
    return true;
}

function finFunction()
{
    moving_status = 0;
    switch(finStatus)
    {
        case 0:
        
        current_x = parseInt(arr_res[1]);
        current_y = parseInt(arr_res[2]);
        var objmap = eval(arr_res[5]);
        map[0][2] = objmap[0];
        map[0][3] = objmap[1];
        map[1] = eval(arr_res[3]);
		mapnavi = objmap[3];
		MapReInit(map[1]);
		mapbt = eval(arr_res[4]);
		// getButtons
		d.getElementById('world_menu').innerHTML = ButtonGen();

		if(objmap[2]) MessBoxDiv(objmap[2]);


        
        break;
        case 1:
        
        finStatus = 0;
        current_x = map[0][0];
        current_y = map[0][1];
        ButtonSt(false);
        MapReInit(map[1]);

        break; 
    }
    
    if(pngAlpha) transport_img.src = 'img/image/map/nl_cursor.png';
    else 
    {
        transport_img = ReInitCursor();
        transport_img.src = 'img/image/map/nl_cursor.png';
    }       
}

function MapReInit(obj)
{
	avail = new Array();
    for(var i=0; i<obj.length; i++)
    {
        avail[obj[i][0]+'_'+obj[i][1]] = obj[i][2];
    }
    
    for(i=-height; i<=height; i++) 
    {
        for(j=-width; j<=width; j++) 
        {
            imgid = d.getElementById('img_'+(current_x+j)+'_'+(current_y+i));

            dx = current_x + j;
            dy = current_y + i;
            
            if(avail[dx+'_'+dy]) 
            {
                imgid.src = 'img/image/map/world/here.gif';
                imgid.onclick = function(dx, dy) { return function() { moveMapTo(dx, dy, map[0][2]); } }(dx, dy);
                imgid.style.cursor = 'pointer';
				if(mapnavi && mapnavi == dx+'_'+dy){
					moveMapTo(dx, dy, map[0][2]);
				}
            }
            else
            {
                imgid.src = 'img/image/1x1.gif';
                imgid.onclick = function() {};
                imgid.style.cursor = 'default';
            }
        }
    }
}

function move()
{
    path = ((time_left) / (pause * 1000));
    
    if(time_left <= 0) 
    {
        clearInterval(t);
        finFunction();
    }
    
    if(dest_y < current_y)
    {
        app_y = dest_y + (Math.abs(dest_y - current_y) * path);
        if((app_y - height) <= (loaded_top + 0.2)) 
        {
            loaded_top -= 1;
            loadMap('top', loaded_top);
        }
        
        if((app_y + (height*2)) <= (loaded_bottom)) 
        {
            loaded_bottom -= 1;
            freeMap('bottom');
        }
        
        cur_margin_top += (Math.abs(dest_y - current_y) * 100) / (pause*1000 / move_interval);
    } 
    else if(dest_y > current_y)
    {
        app_y = dest_y - (Math.abs(dest_y - current_y) * path);
        if((app_y + height) >= (loaded_bottom - 0.2)) 
        {
            loaded_bottom += 1;
            loadMap('bottom', loaded_bottom);
        }
        
        if((app_y - (height*2)) >= (loaded_top)) 
        {
            loaded_top += 1;
            freeMap('top');
        }
        
        cur_margin_top -= (Math.abs(dest_y - current_y) * 100) / (pause*1000 / move_interval);
    }
    
    if(dest_x < current_x)
    {
        app_x = dest_x + (Math.abs(dest_x - current_x) * path);
        if((app_x - width) <= (loaded_left + 0.2)) 
        {
            loaded_left -= 1;
            loadMap('left', loaded_left);
        }
        
        if((app_x + (width*2)) <= (loaded_right)) 
        {
            loaded_right -= 1;
            freeMap('right');
        }
        
        cur_margin_left += (Math.abs(dest_x - current_x) * 100) / (pause*1000 / move_interval);
    } 
    else if(dest_x > current_x)
    {
        app_x = dest_x - (Math.abs(dest_x - current_x) * path);
        if((app_x + width) >= (loaded_right - 0.2)) 
        {
            loaded_right += 1;
            loadMap('right', loaded_right);
        }
        
        if((app_x - (width*2)) >= (loaded_left)) 
        {
            loaded_left += 1;
            freeMap('left');
        }
        
        cur_margin_left -= (Math.abs(dest_x - current_x) * 100) / (pause*1000 / move_interval);
    }
    
    world.style.marginTop = parseInt(cur_margin_top) + 'px';
    world.style.marginLeft = parseInt(cur_margin_left) + 'px';
    
    time_left -= move_interval;
}

function timerst(lp)
{
    time_left_sec -= 1000;
    if(time_left_sec <= 0)
    {
        if(lp)
        {
            ButtonSt(false);
            MapReInit(map[1]);
            finStatus = 0;
        }
        timer_img.src = 'img/image/1x1.gif';
        d.getElementById('tdsec').innerHTML = '';
        d.getElementById('timerdiv').style.display = 'none';
        d.getElementById('timerfon').style.display = 'none';
        clearInterval(tsec);  
    }
    else
    {
        d.getElementById('tdsec').innerHTML = (time_left_sec / 1000); 
    }    
}

function RetClass()
{
    var userAgent = navigator.userAgent.toLowerCase();
    if(userAgent.indexOf('mac') != -1 && userAgent.indexOf('firefox')!=-1) classn = 'TB_overlayMacFFBGHack';
    else classn = 'TB_overlayBG';
    return classn;    
}

function writebut(id,vcode,serp){
	buttons = '<a></a><a></a><a class="but lov" id="fish_start" name="fish_start" href="javascript: FishStart(\''+id+'\',\''+vcode+'\',\''+serp+'\'); RemoveDialogDiv();"></a>';
	d.getElementById('OkButFish').innerHTML = buttons;
}

function BuildPage(id){
	for (var i = 1; i <= 3; i++) {
		d.getElementById('BuildShowPage_' + i).style.display = ((i == id)?'block':'none');
		d.getElementById('BuildShowMenu_' + i).style.background = ((i == id)?'#FFFFFF':'#F0F0F0');
		d.getElementById('WorkBut').style.display = ((id == 2)?'block':'none');
	}
}

function StateReady()
{
    switch(arr_res[0])
    {
        case 'GO':
        
        MapReInit([]);
        
        //showTransport('dirizhopel', current_x, current_y, gox, goy, 16, 'png');
        showTransport('man', current_x, current_y, gox, goy, 8, 'gif');

        dest_x = gox;
        dest_y = goy;
        pause = gop;
        
        TimerStart(pause,0);
        time_left = pause*1000;
        moving_status = 1;

        ButtonSt(true);
        t = setInterval("move()", move_interval);
        
        break;
		case 'TELE':  
			window.location.reload();			
        break;
		case 'FISH':
        var messb = eval(arr_res[1]);
        if(ND === false)
        {
            if(!messb[0])
            {
                ND = d.createElement('div');
                ND.id = 'darker';
                ND.className = (classn ? classn : RetClass());
                ND.style.display = 'block';
                d.body.appendChild(ND);
            
                ND = d.createElement('div');
                ND.className = 'png';

                // окно с данными
                var buttons = '';
                var ingr = eval(arr_res[2]);
				var priman = eval(arr_res[3]);
                var did = 'uni';
                ND.id = 'uni';
                    var tr = 0;
                    var alt;
                var messal = '<FORM id="FISHF"><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#CCCCCC><table cellpadding=3 cellspacing=1 border=0 width=100%>' + (ingr[1] != '00000' ? '<tr><td bgcolor=#FFFFFF colspan=4 class="centr"><img src=img/image/1x1.gif width=1 height=10><br><img src="https://www.legendbattles.ru/modules/code/kcaptcha.php?' + ingr[1] + '" width=134 height=60><br><img src=img/image/1x1.gif width=1 height=10><br>Код: <input type=text name=code size=4 class=gr_text id=CAPCODE><br><img src=img/image/1x1.gif width=1 height=10></td></tr>' : '<tr><td bgcolor=#FFFFFF colspan=4 class="centr"><b>Кажется тут можно ловить рыбку!<br>С вашим уровнем навыка вы сможете поймать:</b></td></tr>');
                    for(var i=5; i<ingr.length; i++)
                    {
                        tr++;
                        if(tr == 1) messal += '<tr>';                 
                        messal += '<td bgcolor=#FFFFFF width=25%><div align=center><font class=nickname><b>'+ingr[i][1]+'</b></font></div></td>';
                        
                        if(tr == 4) 
                        {
                            messal += '</tr>';
                            tr = 0;
                        }    
                    }
                    
                    tr++;
                    if(tr != 1)
                    {
                        for (var i = tr; i < 5; i++) messal += '<td bgcolor=#FFFFFF width=25%><div valign=middle align=center><font class=proce style="color:#CCCCCC;">пусто</font></div></td>';
                        messal += '</tr>';
                    }
					if(!ingr[2]){
                        messal += '<tr align=center><td align=center colspan=4 bgcolor=#FFFFFF width=100%><div align=center id=nofishrod><font class=proce><b>Оденьте удочку для рыбалки!</b></font></div></td></tr>';
					}
					else if(priman.length>0){
                        messal += '<tr><td bgcolor=#FFFFFF width=100% colspan=4><div align=center><font class=proce><b>Выберите приманку из списка ниже:</b></font></div></td></tr>';
						var tr2 = 0;
						for(var b=0; b<priman.length; b++)
							{
								tr2++;
								if(tr2 == 1){ messal += '<tr>'; }
                                messal += '<td bgcolor=#FFFFFF  width=25%><div align=center id=havepriman><font class=nickname><b>' + priman[b][1] + '</b><br> ' + (priman[b][4] < 25 ? '<font class=proce style="color:#006600">(<b>' + priman[b][4] + ' шт.</b>)</font>' : '<font class=proce>(<b>' + priman[b][4] + ' шт.</b>)</font>') + '</font></div><div align=center><img src="img/image/weapon/' + priman[b][2] + '" onmouseover="tooltip(this,\'<b><font color=#336699>Щелкните по изображению для просмотра подробной информации о предмете.</font></b>\')" onmouseout="hide_info(this)" onclick="window.open(\'https://www.legendbattles.ru/iteminfo.php?' + priman[b][1] + '\');" style="cursor:pointer;"></div><div align=center><input type=radio name=selectprim value="' + priman[b][0] + '" onClick="javascript: writebut(this.value,\'' + priman[b][3] + '\',\'' + ingr[2] + '\');"></div></td>';
								if(tr2 == 4){messal += '</tr>';tr2 = 0;}  
 
							}
					}
					else{
                        messal += '<tr align=center><td align=center colspan=4 bgcolor=#FFFFFF width=100%><div align=center id=nopriman><font class=proce><b>Приманок нет.</b></font></div></td></tr>';
					}
                    tr2++;
                    if(tr2 != 1)
                    {
                        for (var i = tr2; i < 5; i++) messal += '<td bgcolor=#FFFFFF width=25%><div valign=middle align=center><font class=proce style="color:#CCCCCC;">пусто</font></div></td>';
                        messal += '</tr>';
                    }
						 	

                    messal += '</table></td></tr></table></FORM>';
                    
               // buttons = '<a class="but ok" href="javascript: FishStart(); RemoveDialogDiv();"></a>';
                var mhtml = '<table width="760" cellspacing="0" cellpadding="0" border="0" class="uni_window"><tr><td class="wu_top_left png"></td><td class="wu_top"></td><td class="wu_top_right png"></td></tr><tr><td class="wu_l_gr"></td><td class="wu_m_gr">'+messal+'<br><font class=nickname align=center><div id="tooltip"></div></font></td><td class="wu_r_gr"><a href="javascript: RemoveDialogDiv();" class="circ"></a></td> </tr><tr><td class="wu_b_l png"></td><td width="auto" class="wu_b_m"><table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td class="wu_b_m_l"></td><td><div id="OkButFish" name="OkButFish" align="center">&nbsp;</div></td><td class="wu_b_m_r"></td></tr></table></td><td class="wu_b_r png"></td></tr><tr><td colspan="3"><div class="wu_bb_l png"></div><div class="wu_bb_r png"></div></td></tr></table>'; 
                
                d.body.appendChild(ND);
            
                LD = d.getElementById(did);
                LD.innerHTML = mhtml; 
            
                DD = d.getElementById('darker');
                DD.style.height = getDocHeight()+'px';
             
            }
            else MessBoxDiv(messb[0]);
			}
        				
        break;
        case 'AL':
        var messb = eval(arr_res[1]);
        if(ND === false)
        {
            if(!messb[0])
            {
                ND = d.createElement('div');
                ND.id = 'darker';
                ND.className = (classn ? classn : RetClass());
                ND.style.display = 'block';
                d.body.appendChild(ND);
            
                ND = d.createElement('div');
                ND.className = 'png';

                // окно с данными
                var buttons = '';
                var ingr = eval(arr_res[2]);
                var did = 'uni';
                ND.id = 'uni';
                
                switch(ingr[0])
                {
                    case 0:
                    
                    var tr = 0;
                    var alt;
                        var messal = '<FORM id="ALHF"><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#CCCCCC><table cellpadding=3 cellspacing=1 border=0 width=100%>' + (ingr[1] != '00000' ? '<tr><td bgcolor=#FFFFFF colspan=4 class="centr"><img src=img/image/1x1.gif width=1 height=10><br><img src="img//modules/code/kcaptcha.php?' + ingr[1] + '" width=134 height=60><br><img src=img/image/1x1.gif width=1 height=10><br>Код: <input type=text name=code size=4 class=gr_text id=CAPCODE><br><img src=img/image/1x1.gif width=1 height=10></td></tr>' : '<tr><td bgcolor=#FFFFFF colspan=4 class="centr"><b>Вы осмотрелись вокруг в поисках травы.<br>Поздравляем, кажется вы что-то нашли!</b></td></tr>');
                    for(var i=5; i<ingr.length; i++)
                    {
                        tr++;
                        if(tr == 1) messal += '<tr>';
                        messal += '<td bgcolor=#FFFFFF width=25%><div align=center><font class=nickname><b>' + ingr[i][1] + '</b></font><br><img src="img/image/weapon/' + ingr[i][2] + '" onmouseover="tooltip(this,\'<b><font color=#336699>Щелкните по изображению для просмотра подробной информации о предмете.</font></b>\')" onmouseout="hide_info(this)" onclick="window.open(\'img//iteminfo.php?' + ingr[i][1] + '\');" style="cursor:pointer;"><br>' + (!ingr[2] ? '<input type=button class=fr_but value="Срезать" onmouseover="tooltip(this,\'<b><font color=red>Недоступно!</font><br>Оденьте серп для сбора трав.</b>\')" onmouseout="hide_info(this)">' : '<input type=button class=fr_but value="Срезать" onclick="AlhStart(\'' + ingr[i][0] + '\',\'' + ingr[i][3] + '\',\'' + ingr[2] + '\');RemoveDialogDiv();">') + '</div></td>';
                        
                        if(tr == 4) 
                        {
                            messal += '</tr>';
                            tr = 0;
                        }    
                    }
                    
                    tr++;
                    if(tr != 1)
                    {
                        for(var i=tr; i<5; i++) messal += '<td bgcolor=#FFFFFF width=25%>&nbsp;</td>';
                        messal += '</tr>';
                    }
                    messal += '</table></td></tr></table></FORM>';
                    
                    buttons = '<a class="but ok" href="javascript: RemoveDialogDiv();"></a>';
                   
                    break;
					/*
                    case 1:
                    
                    var messal = '<FORM id="FISHF"><table cellspacing=0 cellpadding=0 border=0 width=100%><tr><td bgcolor=#CCCCCC><table cellspacing=1 cellpadding=5 border=0 width=100%><tr><td bgcolor=#FFFFFF colspan=5 class="centr" class=nickname><font class=inv><b>'+((ingr[4] - ingr[3]) > 10 ? '' : '<font color=#CC0000>Внимание! Возможен перегруз.</font> ')+'Масса Вашего инвентаря: '+ingr[3]+'/'+ingr[4]+'</b></font></td></tr><tr><td bgcolor=#FFFFFF colspan=2></td><td bgcolor=#FFFFFF class="centr" width=60%><b>Название приманки</b></td><td bgcolor=#FFFFFF class="centr" width=40%><b>В наличии</b></td></tr>';
                    
                    for(var i=5; i<ingr.length; i++) messal += '<tr><td bgcolor=#FFFFFF class="centr"><input type=radio name=primid value='+ingr[i][0]+(ingr[i][2] > 4 ? '' : ' DISABLED')+'></td><td bgcolor=#FFFFFF><img src=img/image/tools/'+ingr[i][0]+'.gif width=60 height=60></td><td bgcolor=#FFFFFF class="centr"><b>'+ingr[i][1]+'</b></td><td bgcolor=#FFFFFF class="centr"><b>'+ingr[i][2]+'</b></td></tr>';
                    
                    messal += (ingr[1] ? '<tr><td bgcolor=#FFFFFF colspan=5 class="centr"><img src=img/image/1x1.gif width=1 height=10><br><img src="img//modules/code/code.php?'+ingr[1]+'" width=134 height=60><br><img src=img/image/1x1.gif width=1 height=10><br>Код: <input type=text name=code size=4 class=gr_text id=CAPCODE><br><img src=img/image/1x1.gif width=1 height=10></td></tr>' : '')+'</table></td></tr></table></FORM>';
                    
                    buttons = '<a class="but lov" href="javascript: FishStart(\''+ingr[2]+'\','+(ingr[1] ? 1 : 0)+');"></a>'; 
                    
                    break;*/
                }
                
                var mhtml = '<table width="760" cellspacing="0" cellpadding="0" border="0" class="uni_window"><tr><td class="wu_top_left png"></td><td class="wu_top"></td><td class="wu_top_right png"></td></tr><tr><td class="wu_l_gr"></td><td class="wu_m_gr">'+messal+'<br><font class=nickname align=center><div id="tooltip"></div></font></td><td class="wu_r_gr"><a href="javascript: RemoveDialogDiv();" class="circ"></a></td> </tr><tr><td class="wu_b_l png"></td><td width="auto" class="wu_b_m"><table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td class="wu_b_m_l"></td><td>'+buttons+'</td><td class="wu_b_m_r"></td></tr></table></td><td class="wu_b_r png"></td></tr><tr><td colspan="3"><div class="wu_bb_l png"></div><div class="wu_bb_r png"></div></td></tr></table>'; 
                
                d.body.appendChild(ND);
            
                LD = d.getElementById(did);
                LD.innerHTML = mhtml; 
            
                DD = d.getElementById('darker');
                DD.style.height = getDocHeight()+'px';
             
            }
            else MessBoxDiv(messb[0]);
			}
        				
        break;
		case 'SHA':
        var messb = eval(arr_res[1]);
        if(ND === false)
        {
            if(!messb[0])
            {
                ND = d.createElement('div');
                ND.id = 'darker';
                ND.className = (classn ? classn : RetClass());
                ND.style.display = 'block';
                d.body.appendChild(ND);
            
                ND = d.createElement('div');
                ND.className = 'png';

                // окно с данными
                var buttons = '';
                var ingr = eval(arr_res[2]);
                var did = 'uni';
                ND.id = 'uni';
                
                switch(ingr[0])
                {
                    case 0:
                    
                    var tr = 0;
                    var alt;
                        var messal = '<FORM id="ALHF"><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#CCCCCC><table cellpadding=3 cellspacing=1 border=0 width=100%>' + (ingr[1] != '00000' ? '<tr><td bgcolor=#FFFFFF colspan=4 class="centr"><img src=img/image/1x1.gif width=1 height=10><br><img src="img//modusha/code/kcaptcha.php?' + ingr[1] + '" width=134 height=60><br><img src=img/image/1x1.gif width=1 height=10><br>Код: <input type=text name=code size=4 class=gr_text id=CAPCODE><br><img src=img/image/1x1.gif width=1 height=10></td></tr>' : '<tr><td bgcolor=#FFFFFF colspan=4 class="centr"><b>Вы осмотрелись вокруг.<br>Поздравляем, кажется вы что-то нашли!</b></td></tr>');
                    for(var i=5; i<ingr.length; i++)
                    {
                        tr++;
                        if(tr == 1) messal += '<tr>';
                        messal += '<td bgcolor=#FFFFFF width=25%><div align=center><font class=nickname><b>' + ingr[i][1] + '</b></font><br><img src="img/image/weapon/' + ingr[i][2] + '" onmouseover="tooltip(this,\'<b><font color=#336699>Щелкните по изображению для просмотра подробной информации о предмете.</font></b>\')" onmouseout="hide_info(this)" onclick="window.open(\'img//iteminfo.php?' + ingr[i][1] + '\');" style="cursor:pointer;"><br>' + (!ingr[2] ? '<input type=button class=fr_but value="Добыть" onmouseover="tooltip(this,\'<b><font color=red>Недоступно!</font><br>Оденьте кирку шахтера.</b>\')" onmouseout="hide_info(this)">' : '<input type=button class=fr_but value="Добыть" onclick="shaStart(\'' + ingr[i][0] + '\',\'' + ingr[i][3] + '\',\'' + ingr[2] + '\');RemoveDialogDiv();">') + '</div></td>';
                        
                        if(tr == 4) 
                        {
                            messal += '</tr>';
                            tr = 0;
                        }    
                    }
                    
                    tr++;
                    if(tr != 1)
                    {
                        for(var i=tr; i<5; i++) messal += '<td bgcolor=#FFFFFF width=25%>&nbsp;</td>';
                        messal += '</tr>';
                    }
                    messal += '</table></td></tr></table></FORM>';
                    
                    buttons = '<a class="but ok" href="javascript: RemoveDialogDiv();"></a>';
                   
                    break;
                }
                
                var mhtml = '<table width="760" cellspacing="0" cellpadding="0" border="0" class="uni_window"><tr><td class="wu_top_left png"></td><td class="wu_top"></td><td class="wu_top_right png"></td></tr><tr><td class="wu_l_gr"></td><td class="wu_m_gr">'+messal+'<br><font class=nickname align=center><div id="tooltip"></div></font></td><td class="wu_r_gr"><a href="javascript: RemoveDialogDiv();" class="circ"></a></td> </tr><tr><td class="wu_b_l png"></td><td width="auto" class="wu_b_m"><table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td class="wu_b_m_l"></td><td>'+buttons+'</td><td class="wu_b_m_r"></td></tr></table></td><td class="wu_b_r png"></td></tr><tr><td colspan="3"><div class="wu_bb_l png"></div><div class="wu_bb_r png"></div></td></tr></table>'; 
                
                d.body.appendChild(ND);
            
                LD = d.getElementById(did);
                LD.innerHTML = mhtml; 
            
                DD = d.getElementById('darker');
                DD.style.height = getDocHeight()+'px';
             
            }
            else MessBoxDiv(messb[0]);
			}
        				
        break;
		case 'LES':
        var messb = eval(arr_res[1]);
        if(ND === false)
        {
            if(!messb[0])
            {
                ND = d.createElement('div');
                ND.id = 'darker';
                ND.className = (classn ? classn : RetClass());
                ND.style.display = 'block';
                d.body.appendChild(ND);
            
                ND = d.createElement('div');
                ND.className = 'png';

                // окно с данными
                var buttons = '';
                var ingr = eval(arr_res[2]);
                var did = 'uni';
                ND.id = 'uni';
                
                switch(ingr[0])
                {
                    case 0:
                    
                    var tr = 0;
                    var alt;
                        var messal = '<FORM id="ALHF"><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#CCCCCC><table cellpadding=3 cellspacing=1 border=0 width=100%>' + (ingr[1] != '00000' ? '<tr><td bgcolor=#FFFFFF colspan=4 class="centr"><img src=img/image/1x1.gif width=1 height=10><br><img src="img//modules/code/kcaptcha.php?' + ingr[1] + '" width=134 height=60><br><img src=img/image/1x1.gif width=1 height=10><br>Код: <input type=text name=code size=4 class=gr_text id=CAPCODE><br><img src=img/image/1x1.gif width=1 height=10></td></tr>' : '<tr><td bgcolor=#FFFFFF colspan=4 class="centr"><b>Вы осмотрелись вокруг.<br>Поздравляем, кажется вы что-то нашли!</b></td></tr>');
                    for(var i=5; i<ingr.length; i++)
                    {
                        tr++;
                        if(tr == 1) messal += '<tr>';
                        messal += '<td bgcolor=#FFFFFF width=25%><div align=center><font class=nickname><b>' + ingr[i][1] + '</b></font><br><img src="img/image/weapon/' + ingr[i][2] + '" onmouseover="tooltip(this,\'<b><font color=#336699>Щелкните по изображению для просмотра подробной информации о предмете.</font></b>\')" onmouseout="hide_info(this)" onclick="window.open(\'img//iteminfo.php?' + ingr[i][1] + '\');" style="cursor:pointer;"><br>' + (!ingr[2] ? '<input type=button class=fr_but value="Срубить" onmouseover="tooltip(this,\'<b><font color=red>Недоступно!</font><br>Оденьте топор лесоруба.</b>\')" onmouseout="hide_info(this)">' : '<input type=button class=fr_but value="Срубить" onclick="LesStart(\'' + ingr[i][0] + '\',\'' + ingr[i][3] + '\',\'' + ingr[2] + '\');RemoveDialogDiv();">') + '</div></td>';
                        
                        if(tr == 4) 
                        {
                            messal += '</tr>';
                            tr = 0;
                        }    
                    }
                    
                    tr++;
                    if(tr != 1)
                    {
                        for(var i=tr; i<5; i++) messal += '<td bgcolor=#FFFFFF width=25%>&nbsp;</td>';
                        messal += '</tr>';
                    }
                    messal += '</table></td></tr></table></FORM>';
                    
                    buttons = '<a class="but ok" href="javascript: RemoveDialogDiv();"></a>';
                   
                    break;
					/*
                    case 1:
                    
                    var messal = '<FORM id="FISHF"><table cellspacing=0 cellpadding=0 border=0 width=100%><tr><td bgcolor=#CCCCCC><table cellspacing=1 cellpadding=5 border=0 width=100%><tr><td bgcolor=#FFFFFF colspan=5 class="centr" class=nickname><font class=inv><b>'+((ingr[4] - ingr[3]) > 10 ? '' : '<font color=#CC0000>Внимание! Возможен перегруз.</font> ')+'Масса Вашего инвентаря: '+ingr[3]+'/'+ingr[4]+'</b></font></td></tr><tr><td bgcolor=#FFFFFF colspan=2></td><td bgcolor=#FFFFFF class="centr" width=60%><b>Название приманки</b></td><td bgcolor=#FFFFFF class="centr" width=40%><b>В наличии</b></td></tr>';
                    
                    for(var i=5; i<ingr.length; i++) messal += '<tr><td bgcolor=#FFFFFF class="centr"><input type=radio name=primid value='+ingr[i][0]+(ingr[i][2] > 4 ? '' : ' DISABLED')+'></td><td bgcolor=#FFFFFF><img src=img/image/tools/'+ingr[i][0]+'.gif width=60 height=60></td><td bgcolor=#FFFFFF class="centr"><b>'+ingr[i][1]+'</b></td><td bgcolor=#FFFFFF class="centr"><b>'+ingr[i][2]+'</b></td></tr>';
                    
                    messal += (ingr[1] ? '<tr><td bgcolor=#FFFFFF colspan=5 class="centr"><img src=img/image/1x1.gif width=1 height=10><br><img src="img//modules/code/code.php?'+ingr[1]+'" width=134 height=60><br><img src=img/image/1x1.gif width=1 height=10><br>Код: <input type=text name=code size=4 class=gr_text id=CAPCODE><br><img src=img/image/1x1.gif width=1 height=10></td></tr>' : '')+'</table></td></tr></table></FORM>';
                    
                    buttons = '<a class="but lov" href="javascript: FishStart(\''+ingr[2]+'\','+(ingr[1] ? 1 : 0)+');"></a>'; 
                    
                    break;*/
                }
                
                var mhtml = '<table width="760" cellspacing="0" cellpadding="0" border="0" class="uni_window"><tr><td class="wu_top_left png"></td><td class="wu_top"></td><td class="wu_top_right png"></td></tr><tr><td class="wu_l_gr"></td><td class="wu_m_gr">'+messal+'<br><font class=nickname align=center><div id="tooltip"></div></font></td><td class="wu_r_gr"><a href="javascript: RemoveDialogDiv();" class="circ"></a></td> </tr><tr><td class="wu_b_l png"></td><td width="auto" class="wu_b_m"><table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td class="wu_b_m_l"></td><td>'+buttons+'</td><td class="wu_b_m_r"></td></tr></table></td><td class="wu_b_r png"></td></tr><tr><td colspan="3"><div class="wu_bb_l png"></div><div class="wu_bb_r png"></div></td></tr></table>'; 
                
                d.body.appendChild(ND);
            
                LD = d.getElementById(did);
                LD.innerHTML = mhtml; 
            
                DD = d.getElementById('darker');
                DD.style.height = getDocHeight()+'px';
             
            }
            else MessBoxDiv(messb[0]);
			}
        				
        break;
		case 'NAVI':
        var messb = eval(arr_res[1]);
        if(ND === false)
        {
            if(!messb[0])
            {
                ND = d.createElement('div');
                ND.id = 'darker';
                ND.className = (classn ? classn : RetClass());
                ND.style.display = 'block';
                d.body.appendChild(ND);
            
                ND = d.createElement('div');
                ND.className = 'png';

                // окно с данными
                var buttons = '';
                var ingr = eval(arr_res[2]);
                var did = 'uni';
                ND.id = 'uni';
                
                switch(ingr[0])
                {
                    case 0:
                    
                    var tr = 0;
                    var alt;
                    var messal = '<FORM id="ALHF"><table cellpadding=0 cellspacing=0 border=0 width=700><tr><td bgcolor=#CCCCCC>';
					var fx=1;
					var fy=0;
					var i=5;
					messal += '<div id="TabbedPanels1" class="TabbedPanels">'+					
					'<ul class="TabbedPanelsTabGroup">'+
                        '<li class="TabbedPanelsTab" tabindex="0">Остров</li>' +
					'</ul>'+
					'<div class="TabbedPanelsContentGroup">';
					messal += '<div class="TabbedPanelsContent"><table cellpadding=0 cellspacing=1 border=0 align=center width=700>';
                    while(fx<=22 && fy<=20)
                    {						
						if(fx == 1){messal += '<tr>';}
						if(in_array(ingr,fx,fy)){
							i = in_array(ingr,fx,fy);
                            messal += '<td bgcolor=#FFFFFF width=25%><div align=center><img src="img/image/wmap/map/day/' + fy + '/' + fx + '_' + fy + '.gif" width=50 height=50 onclick="javascript: moveMapToNavi(' + fx + ', ' + fy + ',\'' + ingr[i][2] + '\');RemoveDialogDiv();" style="cursor:pointer;" title="' + (ingr[i][3] ? ingr[i][3] : 'Идти сюда') + '"></div></td>';
						}
						else{
                            messal += '<td bgcolor=#FFFFFF width=25%><div align=center><img src="img/image/wmap/map/night/' + fy + '/' + fx + '_' + fy + '.gif" width=50 height=50 title="прохода нет" onclick="javascript: moveMapToNavi(' + fx + ', ' + fy + ',\'\');RemoveDialogDiv();"></div></td>';
						}
						fx++;
						if(fx>22){fx=1;fy++;messal +='</tr>';}
						
                    }
                    messal += '</tr></table></div>';
					
                    messal += '</div></div></td></tr></table></FORM>';                    
                    buttons = '<a class="but ok" href="javascript: RemoveDialogDiv();"></a>';
                   
                    break;
                }
                var mhtml = '<table width="120" cellspacing="0" cellpadding="0" border="0" class="uni_window"><tr><td class="wu_top_left png"></td><td class="wu_top"></td><td class="wu_top_right png"></td></tr><tr><td class="wu_l_gr"></td><td class="wu_m_gr">'+messal+'<br><font class=nickname align=center><div id="tooltip"></div></font></td><td class="wu_r_gr"><a href="javascript: RemoveDialogDiv();" class="circ"></a></td> </tr><tr><td class="wu_b_l png"></td><td width="auto" class="wu_b_m"><table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td class="wu_b_m_l"></td><td>'+buttons+'</td><td class="wu_b_m_r"></td></tr></table></td><td class="wu_b_r png"></td></tr><tr><td colspan="3"><div class="wu_bb_l png"></div><div class="wu_bb_r png"></div></td></tr></table>'; 
                d.body.appendChild(ND);
            
                LD = d.getElementById(did);
                LD.innerHTML = mhtml; 
            
                DD = d.getElementById('darker');
                DD.style.height = getDocHeight()+'px';
				TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
             
            }
            else MessBoxDiv(messb[0]);
			}
        				
        break;
		case 'BD':
		var messb = eval(arr_res[1]);
		if(ND) RemoveDialogDiv();
		if(ND === false){
			if(!messb[0]){
				ND = d.createElement('div');
				ND.id = 'darker';
				ND.className = (classn ? classn : RetClass());
				ND.style.display = 'block';
				d.body.appendChild(ND);
				
				ND = d.createElement('div');
                ND.className = 'png';

                // окно с данными
				var buttons = '';
				var ingr = eval(arr_res[2]);
				var did = 'uni';
				ND.id = 'uni';
				switch(ingr[0]){
					case 0:

                        var messal = '<table cellspacing=0 cellpadding=0 border=0 width=100%><tr><td bgcolor=#CCCCCC><table cellspacing=1 cellpadding=5 border=0 width=100%><tr><td bgcolor="#FFFFFF" class="centr"><b>Строение</b></td><td bgcolor="#FFFFFF" class="centr"><b>Владелец</b></td><td bgcolor="#FFFFFF" class="centr" title="Зарплата за последний час"><b>З/П</b></td><td bgcolor="#FFFFFF" class="centr"><font color="#CCCCCC" style="font-size:9px;">(' + ingr[1].length + ')</font></td></tr>';
					
					for(var i=0; i<ingr[1].length; i++) messal += '<tr><td bgcolor=#FFFFFF>'+ingr[1][i][1]+'</td><td bgcolor=#FFFFFF>'+((ingr[1][i][2][0]=='clan')?sh_align(ingr[1][i][2][1],true)+' '+sh_sign(ingr[1][i][2][2],ingr[1][i][2][3])+'<font class=nick>'+ingr[1][i][2][3]+'</font>':ShowUser(ingr[1][i][2]))+'</td><td bgcolor=#FFFFFF class="centr"><b>'+ingr[1][i][3]+' LR</b></td><td bgcolor=#FFFFFF class="centr"><b onclick="Building(\''+ingr[2]+'\',2,'+ingr[1][i][0]+')" style="font-size:11px;cursor:pointer;">>>></b></td></tr>';
					
					messal += '</table></td></tr></table>';
					
					buttons = '&nbsp;';
					
					break;
					case 1:

                        var messal = '<table cellspacing=1 cellpadding=5 border=0 width=100%><tr><td style="background:#FFFFFF;" width=33% class="centr" id="BuildShowMenu_1"><b><a href="javascript:BuildPage(1)">Информация</a></b></td><td style="background:#F0F0F0;" width=33% class="centr" id="BuildShowMenu_3"><b><a href="javascript:BuildPage(3)">Ресурсы</a></b></td><td style="background:#F0F0F0;" width=33% class="centr" id="BuildShowMenu_2"><b><a href="javascript:BuildPage(2)">Работа</a></b></td></tr><tr><td colspan="3">';
					
					// Page 1
                        messal += '<div id="BuildShowPage_1" style="display:block;"><table width=100% align=center cellpadding=5 cellspacing=1><tr><td colspan=2 bgcolor="#FFFFFF"><b>' + ingr[1][1] + '<font color="#CCCCCC" style="font-size:9px;"> >> (Основная информация)</font></b></td></tr><tr><td bgcolor="#FFFFFF">Под контролем:</td><td bgcolor="#FFFFFF">' + ((ingr[1][2][0] == 'clan') ? sh_align(ingr[1][2][1], true) + ' ' + sh_sign(ingr[1][2][2], ingr[1][2][3]) + '<font class=nick>' + ingr[1][2][3] + '</font>' : ShowUser(ingr[1][2])) + '</td></tr><tr><td bgcolor="#FFFFFF">Баланс:</td><td bgcolor="#FFFFFF"><b>' + ingr[1][4] + '</b> LR</td></tr><tr><td colspan=2 bgcolor="#FFFFFF"><b><font color="#CCCCCC" style="font-size:9px;"> >> Дополнительная информация</font></b></td></tr><tr><td bgcolor="#FFFFFF">Премия за работу:</td><td bgcolor="#FFFFFF"><b>' + ingr[1][3] + '</b> LR, ' + ingr[1][5] + ' рабочих мест.</td></tr><tr><td bgcolor="#FFFFFF">Список работников:</td><td bgcolor="#FFFFFF">';
					if(ingr[1][6].length > 0){
						for(var i=0; i<ingr[1][6].length; i++){
							messal += ShowUser(ingr[1][6][i],true)+((i != (ingr[1][6].length-1))?', ':'.');
						}
						messal += '<font color="#CCCCCC" style="font-size:9px;">('+ingr[1][6].length+')</font>';
					}else if(ingr[1][6].length == 0){
                        messal += 'Никого, будете первым.';
					}
					messal += '</td></tr></table></div>';
					
					// Page 2
                        messal += '<div id="BuildShowPage_2" style="display:none;"><table width=100% align=center cellpadding=4 cellspacing=2><tr><td rowspan=2 valign="middle"><img src="/modules/code/code.php?' + Math.random() + '" border="0" width=196 height=126></td><td bgcolor=#FFFFFF><b>Здесь вы можете устроиться на работу</b></td></tr><tr><td valign=top><input type="hidden" id="BID" name="BID" value="' + ingr[1][0] + '"><br><table border=0 cellpadding=5 cellspacing=0><tr><td> Введите номер, нарисованный на картинке,<br>и нажмите на кнопку &quot;Работать&quot;.<br><br>Учтите, что если у объекта недостаточно ресурсов<br>для производства, то Вы не получите зарплату. </td></tr></table></td></tr><tr><td colspan="2" bgcolor="#FFFFFF" class="centr">Код: <input type=text name=code size=5 class=gr_text id=CAPCODE></td></tr></table></div>';
					
					// Page 3
                        messal += '<div id="BuildShowPage_3" style="display:none;"><table width=100% align=center cellpadding=5 cellspacing=1><tr><td bgcolor="#FFFFFF"><b>Производимые ресурсы</b></td><td bgcolor="#FFFFFF" class="centr"><b>Ед/ч</b></td><td bgcolor="#FFFFFF" class="centr"><b>Наличие</b></td><td bgcolor="#FFFFFF" class="centr"><b>Вес</b></td><td bgcolor="#FFFFFF" class="centr"><b>Цена</b></td><td bgcolor="#FFFFFF" class="centr">Максимум <b>' + ingr[1][7][5] + '</b> шт</td></tr>';

                        messal += '<tr><td bgcolor="#FFFFFF" style="vertical-align:middle;">' + ingr[1][7][0] + '</td><td bgcolor="#FFFFFF" class="centr">' + ingr[1][7][1] + '</td><td bgcolor="#FFFFFF" class="centr">' + ingr[1][7][2] + '</td><td bgcolor="#FFFFFF" class="centr">' + ingr[1][7][3] + '</td><td bgcolor="#FFFFFF" class="centr"><b>' + ingr[1][7][4] + '</b> LR</td><td bgcolor="#FFFFFF" class="centr"><input type="hidden" name="BuyResID" id="BuyResID" value="' + ingr[1][7][6] + '"><input class="lbut" style="FONT:12px Tahoma,Verdana,Helvetica;" type="text" name="BuyAmount" id="BuyAmount" value="0" size="5"> <input type=button class=lbut style="FONT:12px Tahoma,Verdana,Helvetica;" onClick="BuyResource();" value="Купить"></td></tr></table><table width=100% align=center cellpadding=5 cellspacing=1><tr><td bgcolor="#FFFFFF"><b>Используемые ресурсы</b></td><td bgcolor="#FFFFFF" class="centr"><b>Ед/ч</b></td><td bgcolor="#FFFFFF" class="centr"><b>Наличие</b></td><td bgcolor="#FFFFFF" class="centr"><b>Купит</b></td><td bgcolor="#FFFFFF" class="centr"><b>Цена/ед</b></td><td bgcolor="#FFFFFF" class="centr"><b>Продажа</b></td><td bgcolor="#FFFFFF" class="centr"><b>У вас, ед.</b></td></tr>';
					if(ingr[1][8].length > 0){
						for(var i=0; i<ingr[1][8].length; i++){
							messal += '<tr><td bgcolor="#FFFFFF" style="vertical-align:middle;">' + ingr[1][8][i][0] + '</td><td bgcolor="#FFFFFF" class="centr">' + ingr[1][8][i][1] + '</td><td bgcolor="#FFFFFF" class="centr">' + ingr[1][8][i][2] + '</td><td bgcolor="#FFFFFF" class="centr">' + ingr[1][8][i][3] + '</td><td bgcolor="#FFFFFF" class="centr">' + ingr[1][8][i][4] + '</td><td bgcolor="#FFFFFF" class="centr">-</td><td bgcolor="#FFFFFF" class="centr">0</td></tr>';
						}
					}else if(ingr[1][8].length == 0){
                        messal += '<tr><td colspan="7" bgcolor="#FFFFFF" class="centr">ресурсов не требуется</td></tr>';
					}
					messal += '</table></div>';

					messal += '</td></tr></table>';
					
					buttons = '<a class="but work" style="display:none;" href="javascript: StartWork(\''+ingr[2]+'\');" id="WorkBut"></a>';
					
					break;
				}
				
				var mhtml = '<table width="760" cellspacing="0" cellpadding="0" border="0" class="uni_window"><tr><td class="wu_top_left png"></td><td class="wu_top"></td><td class="wu_top_right png"></td></tr><tr><td class="wu_l_gr"></td><td class="wu_m_gr">'+messal+'</td><td class="wu_r_gr"><a href="javascript: RemoveDialogDiv();" class="circ"></a></td> </tr><tr><td class="wu_b_l png"></td><td width="auto" class="wu_b_m"><table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td class="wu_b_m_l"></td><td><center>&nbsp;'+buttons+'&nbsp;</center></td><td class="wu_b_m_r"></td></tr></table></td><td class="wu_b_r png"></td></tr><tr><td colspan="3"><div class="wu_bb_l png"></div><div class="wu_bb_r png"></div></td></tr></table>';
				
				d.body.appendChild(ND);
				
				LD = d.getElementById(did);
				LD.innerHTML = mhtml;
				
				DD = d.getElementById('darker');
				DD.style.height = getDocHeight()+'px';
			}
			else MessBoxDiv(messb[0]);
		}
		break;
        case 'MESS':
        
        if(ND) RemoveDialogDiv();
        var messb = eval(arr_res[1]);
        if(messb[2]) TimerStart(messb[2],1);
        MessBoxDiv(messb[0]);
        
        break;
		case 'NAVIGO':   
		var messb = eval(arr_res[1]);
        if(ND === false)
        {
            if(!messb[0])
            {
                var ingr = eval(arr_res[2]);                
                switch(ingr[0])
                {
                    case 0:
						var i = 0;
						var xnavi = 0;
						var ynavi = 0;
						xnavi = ingr[5][0];
						ynavi = ingr[5][1];
						moveMapTo(xnavi, ynavi, map[0][2]);
                    break;
                }
             
            }
            else MessBoxDiv(messb[0]);
			}
        	       
        break;
        case 'F5':
        
        location = 'main.php';
        
        break;
    }    
}


function in_array(ingr,fx,fy) {
    for(var i=5; i<ingr.length; i++){
        if(ingr[i][1] == fy && ingr[i][0] == fx) {return i;}
	}
	return false;	
}

function TimerStart(secgo,mrinit)
{
    if(time_left_sec <= 0)
    {
        if(mrinit)
        {
            ButtonSt(true);
            MapReInit([]);
        }
        time_left_sec = secgo*1000;
        if(!timer_img) createCursor();
        timer_img.src = 'img/image/map/world/timer.png';
        d.getElementById('timerfon').style.display = 'block';
        d.getElementById('timerdiv').style.display = 'block';
        d.getElementById('tdsec').innerHTML = secgo;
        tsec = setInterval('timerst('+mrinit+')', 1000);
    }
    else time_left_sec += secgo*1000;     
}

function MessBoxDiv(mess)
{
    if(!MESSD)
    {
        MDARK = d.createElement('div');
        MDARK.id = 'darker';
        MDARK.className = (classn ? classn : RetClass());
        MDARK.style.display = 'block';
        d.body.appendChild(MDARK);
        
        MESSD = d.createElement('div');
        MESSD.className = 'png';
        MESSD.id = 'static_window';
        MESSD.innerHTML = '<div class="ws_top png"></div><div class="ws_right png"></div><div class="ws_bottom png"></div><div class="ws_middle"><a href="javascript: MessBoxDivClose();" class="circ"></a><div class="text" align="center" valign="absmiddle">'+mess+'</div><a class="cl_but" href="javascript: MessBoxDivClose();"></a></div>';
        d.body.appendChild(MESSD);        
    }    
}

function MessBoxDivClose()
{
    d.body.removeChild(MESSD);
    d.body.removeChild(MDARK);
    MDARK = false;
    MESSD = false;    
}

function StartWork(vcode){
	var CAP;
	var errm = '';
	CAP = d.getElementById("CAPCODE").value;
    if (CAP) AjaxGet('build_ajax.php?act=3&code=' + CAP + '&bid=' + d.getElementById("BID").value + '&vcode=' + vcode + '&r=' + Math.random()); else errm = 'Введите защитный код.';
    if(errm) MessBoxDiv(errm);     
}

function BuyResource(vcode){
	if(d.getElementById("BuyAmount").value > 0 && d.getElementById("BID").value > 0){
		AjaxGet('build_ajax.php?act=4&bid='+d.getElementById("BID").value+'&ba='+d.getElementById("BuyAmount").value+'&br='+d.getElementById("BuyResID").value+'&vcode='+vcode+'&r='+Math.random());
	}
}

function fight_map(vcode)
{
    parent.frames['ch_buttons'].document.FBT.text.focus();
    MessBoxDiv('<form action= method=POST><input type=hidden name=post_id value="8"><input type=hidden name=vcode value=' + vcode + '><table cellpadding=5 cellspacing=0 border=0 width=100%><tr><td><b>Нападение на природе</b></td></tr><tr><td>На кого: <input type="text" name=pnick class=gr_text maxlength=20></td></tr><tr><td align=center><input type=submit value="Напасть" class=gr_but></td></tr></table></FORM>');
    d.all('pnick').focus();
    ActionFormUse = 'pnick';
}

function AlhStart(gid,vcode,serp)
{
   	setTimeout (function () {AjaxGet('alchemy_ajax.php?act=2&gid='+gid+'&vcode='+vcode+'&serp='+serp+'&r='+Math.random())},tt[1]*1000); 
	TimerStart(tt[1],1);   
}

function FishStart(gid,vcode,serp)
{
	
	//AjaxGet('fish_ajax.php?act=2&gid='+gid+'&vcode='+vcode+'&serp='+serp+'&r='+Math.random())
   	setTimeout (function () {AjaxGet('fish_ajax.php?act=2&gid='+gid+'&vcode='+vcode+'&serp='+serp+'&r='+Math.random())},tt[3]*1000); 
	TimerStart((tt[3]*1),1);   
}
function NaviGo(x,y,vcode){
	//AjaxGet('navigator_ajax.php?act=2&x='+x+'&y='+y+'&vcode='+vcode+'&r='+Math.random());
}

function LesStart(gid,vcode,serp)
{
   	setTimeout (function () {AjaxGet('les_ajax.php?act=2&gid='+gid+'&vcode='+vcode+'&serp='+serp+'&r='+Math.random())},tt[5]*1000); 
	TimerStart((tt[5]*1),1);   
}

function shaStart(gid,vcode,serp)
{
   	setTimeout (function () {AjaxGet('sha_ajax.php?act=2&gid='+gid+'&vcode='+vcode+'&serp='+serp+'&r='+Math.random())},tt[5]*1000); 
	TimerStart((tt[5]*1),1);   
}

function BotNapForm(vcode)
{
    d.write('<form action=main.php method=POST name="PrimanForm"><input type=hidden name=fightmagicstart value="1"><input type=hidden name=uid value="0"><input type=hidden name=fmc value='+vcode+'></FORM>');
	document.PrimanForm.submit();
}

function getDocHeight() 
{
    return Math.max(Math.max(d.body.scrollHeight,d.documentElement.scrollHeight),Math.max(d.body.offsetHeight,d.documentElement.offsetHeight),Math.max(d.body.clientHeight,d.documentElement.clientHeight));
}

function moveMapTo(x, y, ps)
{
    if(moving_status == 1) return false;
    gox = x;
    goy = y;
    gop = ps;
    AjaxGet('map_ajax.php?act=1&x='+x+'&y='+y+'&gti='+map[0][2]+'&vcode='+avail[x+'_'+y]+'&r='+Math.random());
    return true;
}

function moveMapToNavi(x, y, vcode)
{
    AjaxGet('navigator_ajax.php?act=2&x='+x+'&y='+y+'&vcode='+vcode+'&r='+Math.random());
}

function teleMapTo(code)
{
    AjaxGet('map_ajax.php?act=2&vcode='+code+'&r='+Math.random());
}

function NaviMapTo(code)
{
    AjaxGet('navigator_ajax.php?act=1&vcode='+code+'&r='+Math.random());
}

function Ogl(code)
{
    setTimeout (function () {AjaxGet('alchemy_ajax.php?act=1&vcode='+code+'&r='+Math.random())},tt[0]*1000);      
	TimerStart(tt[0],1);   
}

function Les(code)
{
    setTimeout (function () {AjaxGet('les_ajax.php?act=1&vcode='+code+'&r='+Math.random())},tt[4]*1000);      
	TimerStart(tt[4],1);   
}

function sha(code)
{
    setTimeout (function () {AjaxGet('sha_ajax.php?act=1&vcode='+code+'&r='+Math.random())},tt[4]*1000);      
	TimerStart(tt[4],1);   
}

function Fish(code)
{
	//AjaxGet('fish_ajax.php?act=1&vcode='+code+'&r='+Math.random());
    setTimeout (function () {AjaxGet('fish_ajax.php?act=1&vcode='+code+'&r='+Math.random())},tt[2]*1000);   
	TimerStart(tt[2],1); 
}

function Drink(code,act){
	AjaxGet('map_act_ajax.php?act='+act+'&vcode='+code+'&sm='+(map[1].length ? 1 : 0)+'&r='+Math.random());    
}

function Building(code,act,id){
	if(act == 1){
		AjaxGet('build_ajax.php?act=1&vcode='+code+'&r='+Math.random());
	}else if(act == 2){
		AjaxGet('build_ajax.php?act=2&id='+id+'&vcode='+code+'&r='+Math.random());
	}
}

function loadMap(dir)
{
    tbody = world.lastChild.lastChild;
    switch (dir) 
    {
        case 'bottom':
        
        tr = d.createElement('TR');
        for(i=loaded_left; i<=loaded_right; i++) 
        {
            td = d.createElement('TD');
            td.style.backgroundImage = 'url(img/image/wmap/map/'+map[0][3]+'/'+(loaded_bottom)+'/'+(i)+'_'+(loaded_bottom)+'.gif)';
            img = d.createElement('IMG');
            img.src = 'img/image/1x1.gif';
            img.width = 100;
            img.height = 100;
            img.id = 'img_'+(i)+'_'+(loaded_bottom);
            td.appendChild(img);
            tr.appendChild(td);
        }
        tbody.appendChild(tr);
        
        break
        case 'top':
        
        cur_margin_top -= 100; 
        tr = d.createElement('TR');
        for(i=loaded_left; i<=loaded_right; i++) 
        {
            td = d.createElement('TD');
            td.style.backgroundImage = 'url(img/image/wmap/map/'+map[0][3]+'/'+(loaded_top)+'/'+(i)+'_'+(loaded_top)+'.gif)';
            img = d.createElement('IMG');
            img.src = 'img/image/1x1.gif';
            img.width = 100;
            img.height = 100;
            img.id = 'img_'+(i)+'_'+(loaded_top);
            td.appendChild(img);
            tr.appendChild(td);
        }
            
        tbody.insertBefore(tr, tbody.firstChild);
        
        break
        case 'right':
        
        for(i=loaded_top; i<=loaded_bottom; i++) 
        {
            tr = tbody.childNodes[i-loaded_top];
            td = d.createElement('TD');
            td.style.backgroundImage = 'url(img/image/wmap/map/'+map[0][3]+'/'+(i)+'/'+(loaded_right)+'_'+(i)+'.gif)';
            img = d.createElement('IMG');
            img.src = 'img/image/1x1.gif';
            img.width = 100;
            img.height = 100;
            img.id = 'img_'+(loaded_right)+'_'+(i);
            td.appendChild(img);
            tr.appendChild(td);
        }
            
        break
        case 'left':
        
        cur_margin_left -= 100;
        for(i=loaded_top; i<=loaded_bottom; i++) 
        {
            tr = tbody.childNodes[i-loaded_top];
            td = d.createElement('TD');
            td.style.backgroundImage = 'url(img/image/wmap/map/'+map[0][3]+'/'+(i)+'/'+(loaded_left)+'_'+(i)+'.gif)';
            img = d.createElement('IMG');
            img.src = 'img/image/1x1.gif';
            img.width = 100;
            img.height = 100;
            img.id = 'img_'+(loaded_left)+'_'+(i);
            td.appendChild(img);
            tr.insertBefore(td, tr.firstChild);
        }
        
        break
    }
}

function freeMap(dir)
{
    tbody = world.lastChild.lastChild;
    switch(dir) 
    {
        case 'top':

        cur_margin_top += 100; 
        tr = tbody.firstChild;
        tbody.removeChild(tr);
        
        break
        case 'bottom':

        tr = tbody.lastChild;
        tbody.removeChild(tr);
        
        break
        case 'left':

        cur_margin_left += 100; 
        for (i=loaded_top; i<=loaded_bottom; i++) 
        {
            tr = tbody.childNodes[i-loaded_top];
            tr.removeChild(tr.firstChild);
        }
        
        break
        case 'right':
        
        for (i=loaded_top; i<=loaded_bottom; i++) 
        {
            tr = tbody.childNodes[i-loaded_top];
            tr.removeChild(tr.lastChild);
        }
        
        break
    }
    
    return true;
}

function loadPath(from_x, from_y, to_x, to_y, ptime_all, ptime_left)
{
    if(moving_status == 1) return false;
    path = ((ptime_all - ptime_left) / ptime_all);
    app_x = from_x + ((to_x - from_x) * path);
    app_y = from_y + ((to_y - from_y) * path);
    showMap( parseInt(app_x), parseInt(app_y) );
    
    if(to_x < from_x) 
    {
        loaded_right++;
        loadMap('right');
    }
        
    if(to_y < from_y) 
    {
        loaded_bottom++;
        loadMap('bottom');
    }
    
    current_x = app_x;
    current_y = app_y;
    dest_x = to_x;
    dest_y = to_y;
    
    cur_margin_left = -(Math.abs(parseInt(app_x) - app_x) * 100);
    cur_margin_top = -(Math.abs(parseInt(app_y) - app_y) * 100);
    
    pause = ptime_left;
    time_left = pause*1000;
    
    moving_status = 1;
    t = setInterval("move()", move_interval);
    return true;
}

function createCursor()
{
    var div = d.createElement('DIV');
    div.id = 'cursor';

    div.style.display = 'block';
    div.style.position = 'absolute';
    div.style.marginLeft = (-4+(width)*100) + 'px';
    div.style.marginTop = (1 + (height)*100) + 'px';
    
    transport_img = d.createElement('IMG');
    transport_img.width = 100;
    transport_img.height = 100;
    
    div.appendChild(transport_img);
    d.getElementById('world_cont2').appendChild(div); 
    
    div = d.createElement('DIV');
    div.id = 'timerfon';
    
    div.style.display = 'none';
    div.style.position = 'absolute';
    div.style.marginLeft = ((width)*100) + 'px';
    div.style.marginTop = ((height - 1)*100) + 'px';
    
    timer_img = d.createElement('IMG');
    timer_img.width = 100;
    timer_img.height = 100;
    
    div.appendChild(timer_img);
    d.getElementById('world_cont2').appendChild(div);
    
    div = d.createElement('DIV');
    div.id = 'timerdiv';

    div.style.display = 'none';
    div.style.position = 'absolute';
    div.style.marginLeft = ((width)*100) + 'px';
    div.style.marginTop = (42 + (height - 1)*100) + 'px';
    div.innerHTML = '<table cellpadding=0 cellspacing=0 border=0 width=100><tr><td align=center id="tdsec" class="timer_s"></td></tr></table>';
    
    d.getElementById('world_cont2').appendChild(div);
}

function showCursor()
{
    if(!transport_img)
    {
        createCursor();    
    }
    transport_img.src = 'img/image/map/nl_cursor.png'; 
}

function showTransport(name, from_x, from_y, to_x, to_y, p, type)
{
    if(!transport_img)
    {
        createCursor();    
    }
    
    rad = Math.atan2((to_y - from_y), (to_x - from_x));
    
    pi = 3.141592;
    grad = Math.round(rad/pi*180 / (360 / p));
    if (grad == p) grad = 0;
    if (grad < 0) grad = p + grad;
    
    
    if(pngAlpha) transport_img.src = 'img/image/map/'+name+'_'+grad+'.'+type;
    else
    {
        transport_img = ReInitCursor();
        transport_img.src = 'img/image/map/'+name+'_'+grad+'.'+type;
    }
   
    return true;
}

function ReInitCursor()
{
    var new_tr = d.createElement('IMG');
    new_tr.width = 100;
    new_tr.height = 100;
    transport_img.parentNode.appendChild(new_tr);
    transport_img.parentNode.removeChild(transport_img);
    return new_tr;    
}

ShowUser = function(user,type){
	if(type){
		return "<font class=nick>"+sh_align(user[3],0)+sh_sign(user[4],user[5],user[6])+"<B>"+user[1]+"</B>["+user[2]+"]</font>"; 
	}else{
		return "<a href=\"javascript:parent.say_private('"+user[1]+"')\"><img src=img/image/chat/private.gif width=11 height=12 border=0 align=absmiddle></a>&nbsp;<font class=nick>"+sh_align(user[3],0)+sh_sign(user[4],user[5],user[6])+"<B>"+user[1]+"</B>["+user[2]+"]&nbsp;</font><a href=\"/pinfo.cgi?"+user[1]+"\" target=_blank><img src=img/image/chat/info.gif width=11 height=12 border=0 align=absmiddle></a>"; 
	}
}