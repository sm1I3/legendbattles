ShowInfo = function(name,img,price,kolch,block,hands,sv,tr,tr_level,tr_mass){
	return '<table cellpadding=3 cellspacing=1 border=0 align=center width=300 bgcolor=#e0e0e0><tr><td bgcolor=#f9f9f9><div align=center><img src=/img/image/weapon/'+img+' border=0></div></td><td width=100% bgcolor=#ffffff valign=top><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#ffffff width=100%><font class=nickname><b>'+name+'</b></font><br><img src=http://image.guild-honor.ru/1x1.gif width=1 height=3></td></tr><tr><td colspan=2 width=100%><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#D8CDAF width=50%><div align=center><font class=invtitle>��������</font></div></td><td bgcolor=#B9A05C><img src=http://image.guild-honor.ru/1x1.gif width=1 height=1></td><td bgcolor=#D8CDAF width=50%><div align=center><font class=invtitle>����������</font></div></td></tr><tr><td bgcolor=#FCFAF3><font class=weaponch>'+((kolch==16)?'<b><font color=#cc0000>&nbsp;����� ������� �� ��������</font></b><br>':'')+blocks(block)+((hands==1)?'<b><font color=#cc0000>&nbsp;��������� ������</font></b><br>':'')+'&nbsp;����: <b>'+price+'</b><br>'+ViewItem_sv(sv)+'</font></td><td bgcolor=#B9A05C><img src=http://image.guild-honor.ru/1x1.gif width=1 height=1></td><td bgcolor=#FCFAF3><font class=weaponch>'+ViewItem_tr(tr,tr_level,tr_mass)+'</font></td></tr></table></td></tr></table></td></tr></table>';
}
ViewItem_sv = function(params){
	var str_params = '';
	var str_pr = params.split('|');
	for (var str_val in str_pr){
		str_par = str_pr[str_val].split(':');	
		switch(str_par[0]){
			case '0': str_params += "&nbsp;����������: <b>"+str_par[1]+"</b><br>"; break;
			case '1': str_params += "&nbsp;����: <b>"+str_par[1]+"</b><br />"; break;
			case '2': str_params += "&nbsp;�������������: <b>"+str_par[1]+"</b><br />"; break;
			case '3': str_params += "&nbsp;��������: <b>"+str_par[1]+"</b><br />"; break;
			case '4': str_params += "&nbsp;��������: <b>"+str_par[1]+"</b><br />"; break;
			case '5': str_params += "&nbsp;������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case '6': str_params += "&nbsp;��������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case '7': str_params += "&nbsp;����������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case '8': str_params += "&nbsp;���������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case '9': str_params += "&nbsp;����� �����: <b>"+str_par[1]+"</b><br />"; break;
			case '10': str_params += "&nbsp;������ �����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case '11': str_params += "&nbsp;������ ������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '12': str_params += "&nbsp;������ ������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '13': str_params += "&nbsp;������ ����������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '14': str_params += "&nbsp;������ ����������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '15': str_params += "&nbsp;������ ������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '16': str_params += "&nbsp;������ �������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '17': str_params += "&nbsp;������ ���������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '18': str_params += "&nbsp;������ �������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '19': str_params += "&nbsp;������ �� ������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case '20': str_params += "&nbsp;������ �� ������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case '21': str_params += "&nbsp;������ �� ����������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case '22': str_params += "&nbsp;������ �� ����������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case '23': str_params += "&nbsp;������ �� ������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case '24': str_params += "&nbsp;������ �� �������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case '25': str_params += "&nbsp;������ �� ���������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case '26': str_params += "&nbsp;������ �� �������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case '27': str_params += "&nbsp;��: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case '28': str_params += "&nbsp;���� ��������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case '29': str_params += "&nbsp;����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case '30': str_params += "&nbsp;C���: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case '31': str_params += "&nbsp;��������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case '32': str_params += "&nbsp;�����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case '33': str_params += "&nbsp;��������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case '34': str_params += "&nbsp;������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case '35': str_params += "&nbsp;��������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case '36': str_params += "&nbsp;�������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '37': str_params += "&nbsp;�������� ��������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '38': str_params += "&nbsp;�������� �������� �������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '39': str_params += "&nbsp;�������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '40': str_params += "&nbsp;�������� ����������� �������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '41': str_params += "&nbsp;�������� ���������� � �������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '42': str_params += "&nbsp;�������� ��������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '43': str_params += "&nbsp;�������� ������������ �������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '44': str_params += "&nbsp;�������� ��������� �������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '45': str_params += "&nbsp;����� ����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '46': str_params += "&nbsp;����� ����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '47': str_params += "&nbsp;����� �������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '48': str_params += "&nbsp;����� �����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '49': str_params += "&nbsp;������������� ����� ����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '50': str_params += "&nbsp;������������� ����� ����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '51': str_params += "&nbsp;������������� ����� �������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '52': str_params += "&nbsp;������������� ����� �����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '53': str_params += "&nbsp;���������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '54': str_params += "&nbsp;������������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '55': str_params += "&nbsp;����������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '56': str_params += "&nbsp;����������������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '57': str_params += "&nbsp;��������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '58': str_params += "&nbsp;��������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '59': str_params += "&nbsp;�������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '60': str_params += "&nbsp;�������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '61': str_params += "&nbsp;��������� ����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '62': str_params += "&nbsp;�����������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '63': str_params += "&nbsp;���������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '64': str_params += "&nbsp;������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '65': str_params += "&nbsp;�����������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '66': str_params += "&nbsp;������� �������������� ����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '67': str_params += "&nbsp;���������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '68': str_params += "&nbsp;�������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '69': str_params += "&nbsp;�������� ������� ����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '70': str_params += "&nbsp;������������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case '71': str_params += "&nbsp;<font color=#BB0000>�����������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b></font><br />"; break;
		}
	}
	return str_params;
}

ViewItem_tr = function(params,massa,level){
	var str_params = '';
	var str_pr = params.split('|');
	for (var str_val in str_pr){
		str_par = str_pr[str_val].split(':');	
		if(str_par[0]==72){
			str_par[1]=level;
		}
		if(str_par[0]==71){
			str_par[1]=massa;
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
			case'59': str_params += "&nbsp;�������: <b>"+str_par[1]+"</b><br />"; break;
			case'60': str_params += "&nbsp;�������: <b>"+str_par[1]+"</b><br />"; break;
			case'61': str_params += "&nbsp;��������� ����: <b>"+str_par[1]+"</b><br />"; break;
			case'62': str_params += "&nbsp;�����������: <b>"+str_par[1]+"</b><br />"; break;
			case'63': str_params += "&nbsp;���������: <b>"+str_par[1]+"</b><br />"; break;
			case'64': str_params += "&nbsp;������: <b>"+str_par[1]+"</b><br />"; break;
			case'65': str_params += "&nbsp;�����������: <b>"+str_par[1]+"</b><br />"; break;
			case'66': str_params += "&nbsp;������� �������������� ����: <b>"+str_par[1]+"</b><br />"; break;
			case'67': str_params += "&nbsp;���������: <b>"+str_par[1]+"</b><br />"; break;
			case'68': str_params += "&nbsp;�������: <b>"+str_par[1]+"</b><br />"; break;
			case'69': str_params += "&nbsp;�������� ������� ����: <b>"+str_par[1]+"</b><br />"; break;
			case'70': str_params += "&nbsp;������������: <b>"+str_par[1]+"</b><br />"; break;
			case'71': str_params += "&nbsp;�����: <b>"+str_par[1]+"</b><br />"; break;
			case'72': str_params += "&nbsp;�������: <b>"+str_par[1]+"</b><br />"; break;
			case'73': str_params += "&nbsp;������: <b>"+str_par[1]+"</b><br />"; break;
			case'74': str_params += "&nbsp;��������: <b>"+str_par[1]+"</b><br />"; break;
		}
	}
	return str_params;
}

blocks = function(bl){
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