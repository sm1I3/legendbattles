var d = document;

function view_build_top()
{
	if(build[11])
	{
		parent.frames["ch_list"].location = "/ch.php?lo=1";
	}
	d.write('<div class="TopBar">\
		<div class="TopBar_left">\
			<div class="LEM fontSize_11px bold color_111">\
				<span class="MyName">\
				<center>\
					' + sh_align(build[2],0)+sh_sign(build[3],build[4],build[5]) + ' ' + build[0] + ' <span style="color:#'+fcolor[0]+' font-weight: normal;">[' + build[1] + ']</span>\
				</center>\
				</span>\
				<div class="LEM_bg fontSize_10px color_fff">\
					<div class="Health mainTooltip" id="Health" style="background-position:-0px 0px;">???</div>\
					<div class="Mana mainTooltip" id="Mana" style="background-position:-0px -13px;">???</div>\
				</div>\
			</div>\
		</div>\
		<div class="TopBar_right">\
			<a '+(vcode[2][0] ? ' <input id="MovementMenu" class="MovementMenu mainTooltip" onmouseover="tooltip(this,\'<b>Войти</b>\');" onmouseout="hide_info(this);" style="display:none;" value=" " '+(vcode[2][1]!='' ? 'onclick="location=\'?get_id=56&act=10&go=up&vcode='+vcode[2][1]+'\'"' : 'DISABLED')+'> ' : '')+'</a>\
		</div>\
		<div class="TopBar_center">\
			<ul class="MainMenu">\
				<li class="CharacterMenu">\
					<a '+(vcode[0][0] ? ' <input id="CharacterMenu" class="mainTooltip" onmouseover="tooltip(this,\'<b>Персонаж</b>\');" onmouseout="hide_info(this);" value=" " '+(vcode[0][1]!='' ? 'onclick="location=\'?get_id=56&act=10&go=inf&vcode='+vcode[0][1]+'\'"' : 'DISABLED')+'> ' : '')+'</a>\
				</li>\
				<li class="InventoryMenu">\
					<a '+(vcode[1][0] ? ' <input id="InventoryMenu" class="mainTooltip" onmouseover="tooltip(this,\'<b>Инвентарь</b>\');" onmouseout="hide_info(this);" value=" " '+(vcode[1][1]!='' ? 'onclick="location=\'?get_id=56&act=10&go=inv&vcode='+vcode[1][1]+'\'"' : 'DISABLED')+'> ' : '')+'</a>\
				</li>\
				<li class="FightingMenu">\
					<a '+(vcode[2][0] ? ' <input id="FightingMenu" class="mainTooltip" onmouseover="tooltip(this,\'<b>Поединки</b>\');" onmouseout="hide_info(this);" value=" " '+(vcode[2][1]!='' ? 'onclick="location=\'?get_id=56&act=10&go=up&vcode='+vcode[2][1]+'\'"' : 'DISABLED')+'> ' : '')+'</a>\
				</li>\
				<li class="ClanMenu">\
					<a href="#" id="ClanMenu" class="mainTooltip" onmouseover="tooltip(this,\'<b>Клан</b>\');" onmouseout="hide_info(this);"></a>\
				</li>\
				<li class="InfoMenu">\
					<a '+(!build[12] ? '' : '<input id="InfoMenu" class="mainTooltip" onmouseover="tooltip(this,\'<b>Квесты</b>\');" onmouseout="hide_info(this);" value=" " onclick=\'QActive("'+build[12]+'");\'>')+ '</a>\
				</li>\
			</ul>\
		</div>\
	</div>');
}