var Category = 0;
var TDataL = 0;

$ = function(id){
	return document.getElementById(id);
}

StateReady = function(){
	
	switch(arr_res[0]){
	case'Get':
		
		var all_i = arr_res.length - 1;
		var count = Math.floor(all_i / 1);
		
		
		if(count > 0){
			s = '<table cellpadding=3 cellspacing=1 border=0 align=center width=100% bgcolor=#e0e0e0>';
			for(i=1; i<=count; i++){
				str_pr = arr_res[i].split(';');
				var buy = '<input type=button class=fr_but_dis value="������ �� '+str_pr[10]+' HR">';
				var buy_c = '<input type=button class=fr_but_dis value="������ �� '+str_pr[10]+' &cent;HR">';
					
					
				if(shop[2]<shop[1]-str_pr[7]){
					buy = '<input type=button class=fr_but onclick="BuyItems('+str_pr[0]+');scroll(0,0)" value="������ �� '+str_pr[10]+' HR"> ';
				}
				if(shop[2]<shop[1]-str_pr[7]){
					buy_c = '<input type=button class=fr_but onclick="BuyItems('+str_pr[0]+');scroll(0,0)" value="������ �� '+str_pr[10]+' &cent;HR"> ';
				}
				s += '<tr id="itemid_'+str_pr[0]+'"><td bgcolor=#f9f9f9><div align=center><img src=http://image.guild-honor.ru/weapon/'+str_pr[2]+' border=0></div></td><td width=100% bgcolor=#ffffff valign=top><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#ffffff width=100%><font class=nickname><b>'+buy+buy_c+(shop[3]?ShopEditor(str_pr[0],1):'')+str_pr[1]+'</b><font class=weaponch> </font></font><br><img src=http://image.guild-honor.ru/1x1.gif width=1 height=3></td><td><br><img src=http://image.guild-honor.ru/1x1.gif width=1 height=3></td></tr><tr><td colspan=2 width=100%><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#D8CDAF width=50%><div align=center><font class=invtitle>��������</font></div></td><td bgcolor=#B9A05C><img src=http://image.guild-honor.ru/1x1.gif width=1 height=1></td><td bgcolor=#D8CDAF width=50%><div align=center><font class=invtitle>����������</font></div></td></tr><tr><td bgcolor=#FCFAF3><font class=weaponch>'+((str_pr[5]==16)?'<b><font color=#cc0000>&nbsp;����� ������� �� ��������</font></b><br>':'')+blocks(str_pr[8])+((str_pr[9]==1)?'<b><font color=#cc0000>&nbsp;��������� ������</font></b><br>':'')+'&nbsp;����: <b>'+((shop[0]>str_pr[4])?str_pr[4]+' RB':'<font color=#cc0000>'+str_pr[4]+' RB</font>')+'</b><br>'+ViewItem_sv(str_pr[11])+'</font></td><td bgcolor=#B9A05C><img src=http://image.guild-honor.ru/1x1.gif width=1 height=1></td><td bgcolor=#FCFAF3><font class=weaponch>'+ViewItem_tr(str_pr[12],str_pr[7],str_pr[6],shop[2])+'</font></td></tr></table></td></tr></table></td></tr>';
			}
			s += '</table>';
		}else{
			d.getElementById('DynTableData').bgColor = '#FFFFFF';
			s = '<font class=freemain><font color=#3564A5><b>����� ���� ��������� ��� � �������</b></font></font>';
		}
		
		d.getElementById('DynTableData').innerHTML = s;	
			
	break;
	case'Buy':
		FormPopUp('darker');
		$('DarkSize').style.width = '500px';
		$('ContentPopUp').innerHTML = '<div align=center><font class=nickname><font color=#cc0000><b>'+arr_res[1]+'</b></font></font></div>';
	break;
	}
}

view_shop = function(){
	view_build_top();
	var cats_art = [["helm","w23","�����"],["armor_hard","w19","�������"],["3","333333","�������� �������"],["gloves","w24","��������"],["boots","w21","������"],["amulet","w25","������"],["ring","w22","������"]];
	d.write('<div id="tooltip"></div><table cellpadding=0 cellspacing=1 border=0 align=center width=760><tr><td bgcolor=#ffffff width=100%><a name="top"></a><img src=http://image.guild-honor.ru/1x1.gif width=1 height=3></td></tr><tr><td bgcolor=#3564A5 width=100%><img src=http://image.guild-honor.ru/1x1.gif width=1 height=3></td></tr><tr><td><img src=http://image.guild-honor.ru/locations/hdi/hdi_city1.jpg width=760 height=255 border=0></td></tr><tr><td><img src=http://image.guild-honor.ru/1x1.gif width=1 height=2></td></tr></table></td></tr><tr><td><img src=http://image.guild-honor.ru/1x1.gif width=1 height=2></td></tr></table><table cellpadding=0 cellspacing=0 border=0 align=center width=760><tr><td><table cellpadding=0 cellspacing=0 border=0 align=center width=760><tr><td><img src=http://image.guild-honor.ru/gameplay/hdi/corner0.gif width=69 height=66></td><td background=http://image.guild-honor.ru/gameplay/hdi/fill0.gif><img src=http://image.guild-honor.ru/1x1.gif width=622 height=1></td><td><img src=http://image.guild-honor.ru/gameplay/hdi/corner1.gif width=69 height=66></td></tr><tr>        <td background=http://image.guild-honor.ru/gameplay/hdi/fill1.gif></td><td><table cellpadding=1 cellspacing=0 border=0 align=center width=100%><tr><td><FIELDSET><LEGEND align=center><B>&nbsp;�������������� ���������� �������&nbsp;</B></LEGEND><table cellpadding="10" cellspacing="0" border="0" width="100%"><tr><td align="center"><a href="http://2pay.ru/oplata/wm/?id=4458&v1='+build[0]+'" target="_blank"><img src="http://image.guild-honor.ru/gameplay/hdi/webmoney.gif" onmouseover="this.src=\'http://image.guild-honor.ru/gameplay/hdi/webmoney_over.gif\'" onmouseout="this.src=\'http://image.guild-honor.ru/gameplay/hdi/webmoney.gif\'" width="126" height="72" border="0" /></a></td><td align="center"><a href="http://2pay.ru/oplata/qiwi/?id=4458&v1='+build[0]+'" target="_blank"><img src="http://image.guild-honor.ru/gameplay/hdi/qiwi.gif" onmouseover="this.src=\'http://image.guild-honor.ru/gameplay/hdi/qiwi_over.gif\'" onmouseout="this.src=\'http://image.guild-honor.ru/gameplay/hdi/qiwi.gif\'" width="126" height="72" border="0" /></a></td><td align="center"><a href="https://2pay.ru/oplata/payonlinesystem/?id=4458&v1='+build[0]+'" target="_blank"><img src="http://image.guild-honor.ru/gameplay/hdi/visa.gif" onmouseover="this.src=\'http://image.guild-honor.ru/gameplay/hdi/visa_over.gif\'" onmouseout="this.src=\'http://image.guild-honor.ru/gameplay/hdi/visa.gif\'" width="126" height="72" border="0" /></td><td align="center"><a href="http://2pay.ru/oplata/yandex/?id=4458&v1='+build[0]+'" target="_blank"><img src="http://image.guild-honor.ru/gameplay/hdi/yandex.gif" onmouseover="this.src=\'http://image.guild-honor.ru/gameplay/hdi/yandex_over.gif\'" onmouseout="this.src=\'http://image.guild-honor.ru/gameplay/hdi/yandex.gif\'" width="126" height="72" border="0" /></a></td></tr></table></FIELDSET><br /><FIELDSET><LEGEND align=center><B>&nbsp;������� ���������� � ������ �����&nbsp;</B></LEGEND><table cellpadding=10 cellspacing=0 border=0 width=100%><tr><td><font class=nickname>');
	for(var i=0; i<cats_art.length;i++){
		d.write('<a href="javascript:ShowItems('+cats_art[i][0]+')"><b><font color=#'+cats_art[i][1]+'>'+cats_art[i][2]+'</font></b></a><br />');	
	}
	d.write('</font></td></tr></table></FIELDSET><br /><FIELDSET><div align=center id="DynTableData"><font class=nickname><font color=#3564A5><b>�������� ������</b></font></font></div></FIELDSET></td></tr></table></td><td background="http://image.guild-honor.ru/gameplay/hdi/fill2.gif"></td></tr><tr><td><img src="http://image.guild-honor.ru/gameplay/hdi/corner2.gif" width="69" height="66"></td><td background="http://image.guild-honor.ru/gameplay/hdi/fill3.gif"></td><td><img src="http://image.guild-honor.ru/gameplay/hdi/corner3.gif" width="69" height="66"></td></tr></table></td></tr></table>');
	view_build_bottom();
}

ShowItems = function(act){
	$('DynTableData').innerHTML = '<img src="http://image.guild-honor.ru/loader.gif">';
	AjaxGet('dhouse_ajax.php?act=Get&cat='+act+'&vcode='+ajaxp[0]+'&r='+Math.random());
}

BuyItems = function(id){
	AjaxGet('dhouse_ajax.php?act=Buy&id='+id+'&vcode='+ajaxp[0]+'&r='+Math.random());
}		

ViewItem_sv = function(params){
	var str_params = '';
	var str_pr = params.split('|');
	for (var str_val in str_pr){
		str_par = str_pr[str_val].split(':');	
		switch(str_par[0]){
			case '0': str_params += "&nbsp;����������: <b>"+str_par[1]+"</b><br />"; break;
			case '1': str_params += "&nbsp;����: <b>"+str_par[1]+"</b><br />"; break;
			case '2': str_params += "&nbsp;�������������: <b>"+str_par[1]+"/"+str_par[1]+"</b><br />"; break;
			case '3': str_params += "&nbsp;��������: <b>"+str_par[1]+"</b><br />"; break;
			case '4': str_params += "&nbsp;��������: <b>"+str_par[1]+"</b><br />"; break;
			case '5': str_params += "&nbsp;������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '6': str_params += "&nbsp;��������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '7': str_params += "&nbsp;����������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '8': str_params += "&nbsp;���������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '9': str_params += "&nbsp;����� �����: <b>"+str_par[1]+"</b><br />"; break;
			case'10': str_params += "&nbsp;������ �����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'11': str_params += "&nbsp;������ ������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'12': str_params += "&nbsp;������ ������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'13': str_params += "&nbsp;������ ����������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'14': str_params += "&nbsp;������ ����������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'15': str_params += "&nbsp;������ ������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'16': str_params += "&nbsp;������ �������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'17': str_params += "&nbsp;������ ���������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'18': str_params += "&nbsp;������ �������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'19': str_params += "&nbsp;������ �� ������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case'20': str_params += "&nbsp;������ �� ������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case'21': str_params += "&nbsp;������ �� ����������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case'22': str_params += "&nbsp;������ �� ����������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case'23': str_params += "&nbsp;������ �� ������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case'24': str_params += "&nbsp;������ �� �������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case'25': str_params += "&nbsp;������ �� ���������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case'26': str_params += "&nbsp;������ �� �������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case'27': str_params += "&nbsp;��: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case'28': str_params += "&nbsp;���� ��������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case'29': str_params += "&nbsp;����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case'30': str_params += "&nbsp;C���: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case'31': str_params += "&nbsp;��������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case'32': str_params += "&nbsp;�����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case'33': str_params += "&nbsp;��������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case'34': str_params += "&nbsp;������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case'35': str_params += "&nbsp;��������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case'36': str_params += "&nbsp;�������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'37': str_params += "&nbsp;�������� ��������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'38': str_params += "&nbsp;�������� �������� �������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'39': str_params += "&nbsp;�������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'40': str_params += "&nbsp;�������� ����������� �������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'41': str_params += "&nbsp;�������� ���������� � �������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'42': str_params += "&nbsp;�������� ��������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'43': str_params += "&nbsp;�������� ������������ �������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'44': str_params += "&nbsp;�������� ��������� �������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'45': str_params += "&nbsp;����� ����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'46': str_params += "&nbsp;����� ����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'47': str_params += "&nbsp;����� �������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'48': str_params += "&nbsp;����� �����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'49': str_params += "&nbsp;������������� ����� ����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'50': str_params += "&nbsp;������������� ����� ����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'51': str_params += "&nbsp;������������� ����� �������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'52': str_params += "&nbsp;������������� ����� �����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'53': str_params += "&nbsp;���������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'54': str_params += "&nbsp;������������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'55': str_params += "&nbsp;����������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'56': str_params += "&nbsp;����������������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'57': str_params += "&nbsp;��������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'58': str_params += "&nbsp;��������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'59': str_params += "&nbsp;������������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'60': str_params += "&nbsp;�����������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'61': str_params += "&nbsp;��������� ����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'62': str_params += "&nbsp;�����������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'63': str_params += "&nbsp;���������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'64': str_params += "&nbsp;������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'65': str_params += "&nbsp;�����������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'66': str_params += "&nbsp;������� �������������� ����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'67': str_params += "&nbsp;���������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'68': str_params += "&nbsp;�������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'69': str_params += "&nbsp;�������� ������� ����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'70': str_params += "&nbsp;�������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
		}
	}
	return str_params;
}

ViewItem_tr = function(params,massa,level,freemass){
	var str_params = '';
	var str_pr = params.split('|');
	for (var str_val in str_pr){
		str_par = str_pr[str_val].split(':');	
		if(str_par[0]==72){
			str_par[1]=level;
		}
		if(str_par[0]==71){
			str_par[1]=massa;
			shop[4][71]=shop[1]-freemass;
		}
		if(str_par[0]!=28){
			if(shop[4][str_par[0]]<str_par[1]){
				str_par[1] = '<font color=#cc0000>'+str_par[1]+'</font>';
			}
		}
		switch(str_par[0]){
			case'28': str_params += "&nbsp;���� ��������: <b>"+str_par[1]+"</b><br />"; break;
			case'30': str_params += "&nbsp;C���: <b>"+str_par[1]+"</b><br />"; break;
			case'31': str_params += "&nbsp;��������: <b>"+str_par[1]+"</b><br />"; break;
			case'32': str_params += "&nbsp;�����: <b>"+str_par[1]+"</b><br />"; break;
			case'33': str_params += "&nbsp;��������: <b>"+str_par[1]+"</b><br />"; break;
			case'34': str_params += "&nbsp;������: <b>"+str_par[1]+"</b><br />"; break;
			case'35': str_params += "&nbsp;��������: <b>"+str_par[1]+"</b><br />"; break;
			case'36': str_params += "&nbsp;�������� ������: <b>"+str_par[1]+"</b><br />"; break;
			case'37': str_params += "&nbsp;�������� ��������: <b>"+str_par[1]+"</b><br />"; break;
			case'38': str_params += "&nbsp;�������� �������� �������: <b>"+str_par[1]+"</b><br />"; break;
			case'39': str_params += "&nbsp;�������� ������: <b>"+str_par[1]+"</b><br />"; break;
			case'40': str_params += "&nbsp;�������� ����������� �������: <b>"+str_par[1]+"</b><br />"; break;
			case'41': str_params += "&nbsp;�������� ���������� � �������: <b>"+str_par[1]+"</b><br />"; break;
			case'42': str_params += "&nbsp;�������� ��������: <b>"+str_par[1]+"</b><br />"; break;
			case'43': str_params += "&nbsp;�������� ������������ �������: <b>"+str_par[1]+"</b><br />"; break;
			case'44': str_params += "&nbsp;�������� ��������� �������: <b>"+str_par[1]+"</b><br />"; break;
			case'45': str_params += "&nbsp;����� ����: <b>"+str_par[1]+"</b><br />"; break;
			case'46': str_params += "&nbsp;����� ����: <b>"+str_par[1]+"</b><br />"; break;
			case'47': str_params += "&nbsp;����� �������: <b>"+str_par[1]+"</b><br />"; break;
			case'48': str_params += "&nbsp;����� �����: <b>"+str_par[1]+"</b><br />"; break;
			case'53': str_params += "&nbsp;���������: <b>"+str_par[1]+"</b><br />"; break;
			case'54': str_params += "&nbsp;������������: <b>"+str_par[1]+"</b><br />"; break;
			case'55': str_params += "&nbsp;����������: <b>"+str_par[1]+"</b><br />"; break;
			case'56': str_params += "&nbsp;����������������: <b>"+str_par[1]+"</b><br />"; break;
			case'57': str_params += "&nbsp;��������: <b>"+str_par[1]+"</b><br />"; break;
			case'58': str_params += "&nbsp;��������: <b>"+str_par[1]+"</b><br />"; break;
			case'59': str_params += "&nbsp;������������: <b>"+str_par[1]+"</b><br />"; break;
			case'60': str_params += "&nbsp;�����������: <b>"+str_par[1]+"</b><br />"; break;
			case'61': str_params += "&nbsp;��������� ����: <b>"+str_par[1]+"</b><br />"; break;
			case'62': str_params += "&nbsp;�����������: <b>"+str_par[1]+"</b><br />"; break;
			case'63': str_params += "&nbsp;���������: <b>"+str_par[1]+"</b><br />"; break;
			case'64': str_params += "&nbsp;������: <b>"+str_par[1]+"</b><br />"; break;
			case'65': str_params += "&nbsp;�����������: <b>"+str_par[1]+"</b><br />"; break;
			case'66': str_params += "&nbsp;������� �������������� ����: <b>"+str_par[1]+"</b><br />"; break;
			case'67': str_params += "&nbsp;���������: <b>"+str_par[1]+"</b><br />"; break;
			case'68': str_params += "&nbsp;�������: <b>"+str_par[1]+"</b><br />"; break;
			case'69': str_params += "&nbsp;�������� ������� ����: <b>"+str_par[1]+"</b><br />"; break;
			case'70': str_params += "&nbsp;�������: <b>"+str_par[1]+"</b><br />"; break;
			case'71': str_params += "&nbsp;�����: <b>"+str_par[1]+"</b><br />"; break;
			case'72': str_params += "&nbsp;�������: <b>"+str_par[1]+"</b><br />"; break;
		}
	}
	return str_params;
}

function blocks(bl){
	var str_params = '';
	if(bl!="") {
		switch(bl){
			case'40': str_params += '<b><font color=#cc0000>&nbsp;���������� 1-�� �����</font></b><br />'; break;
			case'70': str_params += '<b><font color=#cc0000>&nbsp;���������� 2-� �����</font></b><br />'; break;
			case'90': str_params += '<b><font color=#cc0000>&nbsp;���������� 3-� �����</font></b><br />'; break;
		}
	}
	return str_params;
}