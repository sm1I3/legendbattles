var Category = 0;
var TDataL = 0;

function StateReady(res)
{
	var arr_res = res.split('@');
	switch(arr_res[0])
	{
		case '1':
		
		var i,j,tr_obj,td_obj,str_pr;
		var all_i = arr_res.length - 1;
		var s = Math.floor(all_i / 4);
		
		var table_obj = d.getElementById('DynTableData');
		
		if(TDataL)
		{
			table_obj.deleteRow(1);
			table_obj.deleteRow(0);
		}
		
		tr_obj = table_obj.insertRow(0);
		td_obj = tr_obj.insertCell(0);
		td_obj.innerHTML = '<img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=2>';
		tr_obj = table_obj.insertRow(1);
		td_obj = tr_obj.insertCell(0);
		td_obj.innerHTML = '<table cellpadding=7 cellspacing=1 border=0 width=100% id="DTD"></table>';
		td_obj.bgColor = '#CCCCCC';
		
		TDataL = 1;
		
		var table_obj = d.getElementById('DTD');
		var k = 0;
		
		for(i=0; i<=s; i++)
		{
			tr_obj = table_obj.insertRow(i);
			for(j=0; j<4; j++)
			{
				k += 1;
				td_obj = tr_obj.insertCell(j);
				
				if(all_i >= k)
				{
					str_pr = arr_res[k].split('|');
					td_obj.innerHTML = '<img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=5><br><img src=http://img.legendbattles.ru/image/tools/'+str_pr[2]+'.gif width=60 height=60 onMouseover="ToolTip(eval('+str_pr[8]+'));" onMouseout="HideToolTip();" onMousemove="ChangePos(event);"><br><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=5><br><b>Стоимость: '+str_pr[4]+' LR</b><br>Остаток: '+str_pr[1]+'<br><br>'+AddButton(eval(str_pr[9]));
				}
				
				td_obj.bgColor = '#FFFFFF';
				td_obj.align = 'center';
				td_obj.width = '25%';
				td_obj.className = 'filt';	
			}
		}
		
		break;
	}
}

function view_taverna()
{
	view_build_top();
	var Title = ['','Выпивка','Еда/Закуска'];
	d.write('<div id="tooltip"></div><table cellpadding=0 cellspacing=0 border=0 align=center width=760><tr><td><img src=http://img.legendbattles.ru/image/gameplay/taverna/taverna.jpg width=760 height=255 border=0></td></tr><tr><td><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=2></td></tr><tr><td bgcolor=#CCCCCC><table cellpadding=4 cellspacing=1 border=0 width=100%><tr>');
	for(var i=1; i<3; i++) d.write('<td bgcolor=#FFFFFF align=center width=50% id="Cat'+i+'"><b><a href="javascript: TavernaShow('+i+');"><font class=category>'+Title[i]+'</font></a></b></td>');
	d.write('</tr></table></td></tr><tr><td><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=2></td></tr><tr><td bgcolor=#CCCCCC><table cellpadding=4 cellspacing=1 border=0 width=100%><tr><td align=center class=inv bgcolor=#FFFFFF><B>У Вас с собой '+taverna[0]+' LR</B></td></tr></table></td></tr></table><table cellpadding=0 cellspacing=0 border=0 align=center width=760 id="DynTableData"></table>');
	view_build_bottom();
}

function TavernaShow(t)
{
	if(Category != t)
	{
		if(Category) d.getElementById('Cat'+Category).bgColor = '#FFFFFF';
		d.getElementById('Cat'+t).bgColor = '#E0E0E0';
		Category = t;
		
		switch(t)
		{
			case 1:
		
			
		
			break;
			case 2:
			
			AjaxGet('taverna_ajax.php?act=1&p='+ajaxp[1]+'&m='+Math.ceil(taverna[0])+'&type=9&vcode='+ajaxp[0]+'&r='+Math.random());
		
			break;
		}
	}
}