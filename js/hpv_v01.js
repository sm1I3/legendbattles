var Category = 0;
var TDataL = 0;

var PVU_Razdel = [["pv18.gif","��"],["pv19.gif","��"],["pv16.gif","��"],["pv12.gif","���"],["pv10.gif","���"],["pv08.gif","��"],["pv06.gif","��"],["pv04.gif","�������"],["pv02.gif","������ �������"],["pv01.gif","������"]];
var PVU_panels = [["��������",1],["������",2],["������������",4],["��������",16]];

$ = function(id){
	return document.getElementById(id);
}

StateReady = function(){
	switch(arr_res[0]){	
	case'ClanList':
		var all_i = arr_res.length - 1;
		var count = Math.floor(all_i / 1);
		
		if(count > 0){
			s = '<table cellpadding="3" cellspacing="1" border="0" align="center" width="90%">';
			s += '<tr><td colspan=4><font class=nickname><b><a href="javascript:clan_private()"><img src=http://img.legendbattles.ru/image/chat/private.gif width=11 height=12 border=0 align=absmiddle></a></font>&nbsp;<font color=#336699>����� �������</font></b><br></td></tr>';
				for(i=1; i<=count; i++){
					
					str_pr = arr_res[i].split(';');
					
					var priv = '<img src=http://img.legendbattles.ru/image/1x1.gif width=11 height=12 align=absmiddle>';
    				var all_si = '';
					var slink = '';
					
					if(hpv[1] & 2 && str_pr[0]==0) slink += '<a href=#>����� ����</a>&nbsp;&nbsp;';
					if(hpv[1] & 4) slink += '<a href="javascript: EditUser('+str_pr[7]+');">�������������</a>&nbsp;&nbsp;';
					if(hpv[1] & 8) slink += '<a href="javascript: if(confirm(\'������� ������������� ������?\')) { HPV_GoOut('+str_pr[7]+'); }">�������</a>';
					switch(str_pr[4]){
						case'9':
							slink = '';
							var ssta = '<font color=#CC0000>����� ��������� ������</font>';
						break;
						default:
							if(hpv[0] == str_pr[7]) slink = '';
							var ssta = str_pr[5];
					}
					
					if(str_pr[0] == 1){
						priv = '<a href="javascript:parent.say_private(\''+str_pr[1]+'\')"><img src=http://img.legendbattles.ru/image/chat/private.gif width=11 height=12 border=0 align=absmiddle></a>';
					}
					str_pr[1] = str_pr[1].replace("[a_GuildHonor_t]","@");
					
					all_si += '<img src=http://img.legendbattles.ru/image/signs/'+str_pr[3]+' width=15 height=12 border=0 align=absmiddle>';
    			   s += '<tr><td><font class=nickname>'+priv+'&nbsp;'+all_si+' <b>'+str_pr[1]+'</b>['+str_pr[2]+']<a href="ipers.php?'+str_pr[1]+'" target=_blank><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 align=absmiddle></a></td><td><font class=nickname>&nbsp;&nbsp;<b>'+ssta+'</b></td><td nowrap><font class=hpfont>&nbsp;&nbsp;'+str_pr[6]+'</font></td><td><font class=text>&nbsp;&nbsp;'+slink+'</td></tr>';
				}
				if(hpv[1] & 8) s += '<tr><td colspan=4><form onSubmit="SubmitForm(1);return false;"><font class="nickname"><hr size="1" color="#CCCCCC" /><b>�������<br /><font color="#aa0000">��� ���������:</font></b></font> <input type="text" name="fnick" id="fnick" class="gr_text" /><input type="submit" class="fr_but" value="�������" /></form></td></tr>';
				s += '</table>';
		}
		
		FormPopUp('darker');
		d.getElementById('DynTableData').innerHTML = s;	
	break;
	case'VerifUsers':
		var all_i = arr_res.length - 1;
		var count = Math.floor(all_i / 1);
		
		s = '<table cellpadding=0 cellspacing=1 border=0 align=center width=760><tr><td bgcolor="#cccccc"><table cellpadding="3" cellspacing="1" border="0" align="center" width="760">';
		s += '<tr><td width="50%" bgcolor="#f5f5f5" align="center"><a href="javascript://" onclick="VirifHPV(1)"><font class="zaya"><b>�������</b></font></a></td><td width="50%" bgcolor="#f5f5f5" align="center"><a href="javascript://" onclick="VirifHPV(2)"><font class="zaya"><b>�����������</b></font></a></td></tr></table></td></tr>';
		if(count > 0){
			s += '<tr><td bgcolor="#cccccc"><table cellpadding="3" cellspacing="1" border="0" align="center" width="760"><tr><td bgcolor="#f5f5f5" align="center" width="50">�������</td><td bgcolor="#f5f5f5" align="center">��������</td><td bgcolor="#f5f5f5" align="center">������</td></tr>';
			for(i=1; i<=count; i++){
				str_pr = arr_res[i].split(';');
					s += '<tr><td bgcolor="#f5f5f5" align="center"><b>'+i+'</b></td><td bgcolor="#f5f5f5"><b>'+str_pr[0]+'</b>['+str_pr[1]+']<a href="/ipers.php?'+str_pr[0]+'" target=_blank><img src=http://img.legendbattles.ru/image/chat/info.gif width=11 height=12 border=0 align=absmiddle></a></td><td bgcolor="#f5f5f5" align="center"><b>';
					if(str_pr[2] == 0){
						s += '� ��������';
					}else if(str_pr[2] == 2){
						s += '������� ��������';
					}
					s += '</b></td></tr>';
			}
			s += '</table></td></tr>';
		}
		s += '</table>';
		
		FormPopUp('darker');
		d.getElementById('DynTableData').innerHTML = s;	
	break;
	case'GoOut':
		
		//$('DarkSize').style.width = '500px';
		$('ContentPopUp').innerHTML = '<div align=center><font class=nickname><font color=#cc0000><b>��� ������ ������</b></font></font></div>';
		FormPopUp('darker');
		ActionHPV('Sign');
			
	break;
	case'EditUser':
		FormPopUp('darker');
		//$('DarkSize').style.width = '300px';
		str_pr = arr_res[1].split('|');
		var s = '<form onSubmit="SubmitForm(2);return false;"><table cellpadding="0" cellspacing="1" width="100%" border="0">';
		s += '<tr><td>������:</td><td><input type="text" name="clan_d" id="clan_d" class="LogintextBox" value="'+str_pr[1]+'" /></td></tr>';
		s += '<tr><td>�����:</td><td><select name="section" id="section" style="width:150px;">';
		for(var i = 0;i<PVU_Razdel.length;i++){
				s += '<option value="'+PVU_Razdel[i][0]+'"'+((str_pr[2] == PVU_Razdel[i][0])?' selected="selected"':'')+'>'+PVU_Razdel[i][1]+'</option>';
		}
		s += '</select></td></tr>';
		for(var i = 0;i<PVU_panels.length;i++){
			s += '<tr><td>'+PVU_panels[i][0]+':</td><td><select id="access_'+PVU_panels[i][1]+'" style="width:150px;">  <option value="1" '+((str_pr[(3+i)]=='1')?'selected="selected"':'')+'>��</option>  <option value="0" '+((str_pr[(3+i)]=='0')?'selected="selected"':'')+'>���</option></select></td></tr>';
		}
		s += '<td colspan="2" align="center"><input type="hidden" name="plid" id="plid" value="'+str_pr[0]+'" /><input type="submit" class="lbut" value="�������������" /></td>';
		s += '</table></form>';
		$('ContentPopUp').innerHTML = s;
		FormPopUp('darker');
	break;
	case'SubmitForm':
		switch(arr_res[1]){
			case'1':
				ActionHPV('Sign');
				//$('DarkSize').style.width = '500px';
				$('ContentPopUp').innerHTML = '<div align=center><font class=nickname><font color=#cc0000><b>��� ������ ������</b></font></font></div>';
				d.write('test1');
			break;
			case'2':
				ActionHPV('Sign');
				//$('DarkSize').style.width = '500px';
				$('ContentPopUp').innerHTML = '<div align=center><font class=nickname><font color=#cc0000><b>��� ������ ������</b></font></font></div>';
				d.write('�� ������ �������');
			break;	
		}
	
	break;
	}
}

VirifHPV = function(type){
	//$('DarkSize').style.width = '300px';
	$('ContentPopUp').innerHTML = '<img src="http://img.legendbattles.ru/image/loader.gif">';
	FormPopUp('darker');
	AjaxGet('hpv_ajax.php?act=Verif&type=' + type + '&vcode='+ajaxp[0]+'&r='+Math.random());
}

view_hpv = function(){
	view_build_top();
	d.write('<div id="tooltip"></div><table cellpadding=0 cellspacing=1 border=0 align=center width=760><tr><td><fieldset><legend align="center"><b><font color="gray">������� �������</font></b></legend><img src=http://img.legendbattles.ru/image/gameplay/hpv/hpv_city1.jpg width=760 height=255 border=0></fieldset></td></tr><tr><td><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=2></td></tr><tr><td bgcolor="#cccccc"><table cellpadding="2" cellspacing="1" border="0" align="center" width="100%"><tr><td width="33%" bgcolor="#f5f5f5" align="center"><a href="javascript://" onclick="ActionHPV(\'Sign\')"><font class="zaya"><b>��������� �������</b></font></a></td><td width="34%" bgcolor="#f5f5f5" align="center"><a href="#" onClick="location=\'?get_id=56&act=11&go=49&vcode='+ajaxp[0]+'\'"><font class="zaya"><b>�������</b></font></a></td><td width="33%" bgcolor="#f5f5f5" align="center"><a href="javascript://" onclick="ActionHPV(\'Verif\')"><font class="zaya"><b>��������</b></font></a></td></tr></table></td></tr><tr><td><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=2></td></tr><tr><td bgcolor=#CCCCCC><table cellpadding=0 cellspacing=0 border=0 width=100%></table></td></tr></table><div id="DynTableData"></div>');
	view_build_bottom();
}

ActionHPV = function(act){
	//$('DarkSize').style.width = '300px';
	$('ContentPopUp').innerHTML = '<img src="http://img.legendbattles.ru/image/loader.gif">';
	FormPopUp('darker');
	AjaxGet('hpv_ajax.php?act='+act+'&vcode='+ajaxp[0]+'&r='+Math.random());
}

HPV_GoOut = function(uid){
	//$('DarkSize').style.width = '300px';
	$('ContentPopUp').innerHTML = '<img src="http://img.legendbattles.ru/image/loader.gif">';
	FormPopUp('darker');
	AjaxGet('hpv_ajax.php?act=GoOut&uid='+uid+'&vcode='+ajaxp[0]+'&r='+Math.random());
}

EditUser = function(uid){
	//$('DarkSize').style.width = '300px';
	$('ContentPopUp').innerHTML = '<img src="http://img.legendbattles.ru/image/loader.gif">';
	FormPopUp('darker');
	AjaxGet('hpv_ajax.php?act=EditUser&uid='+uid+'&vcode='+ajaxp[0]+'&r='+Math.random());
}

SubmitForm = function(id){
	switch(id){
		case 1:
			AjaxGet('hpv_ajax.php?act=SubmitForm&sub=1&fnick='+$('fnick').value+'&vcode='+ajaxp[0]+'&r='+Math.random());
			//$('DarkSize').style.width = '300px';
			$('ContentPopUp').innerHTML = '<img src="http://img.legendbattles.ru/image/loader.gif">';
			FormPopUp('darker');
		break;
		case 2:
			var ajaxbuild = '';
			for(var i = 0;i<PVU_panels.length;i++){
				ajaxbuild += '&access_'+PVU_panels[i][1]+'='+$('access_'+PVU_panels[i][1]).value;
			}
			AjaxGet('hpv_ajax.php?act=SubmitForm&sub=2&plid='+$('plid').value+'&clan_d='+$('clan_d').value+'&section='+$('section').value+ajaxbuild+'&vcode='+ajaxp[0]+'&r='+Math.random());
			//$('DarkSize').style.width = '300px';
			$('ContentPopUp').innerHTML = '<img src="http://img.legendbattles.ru/image/loader.gif">';
			FormPopUp('darker');
		break;	
	}
}		

ViewItem_sv = function(params){
	var str_params = '';
	var str_pr = params.split('|');
	for (var str_val in str_pr){
		str_par = str_pr[str_val].split(':');	
		switch(str_par[0]){
			//case '0': str_params += "&nbsp;����������: <b>"+str_par[1]+"</b><br />"; break;
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
			case'30': str_params += "&nbsp;����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case'31': str_params += "&nbsp;�����������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case'32': str_params += "&nbsp;�������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case'33': str_params += "&nbsp;��������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
			case'34': str_params += "&nbsp;�����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br />"; break;
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
			case'59': str_params += "&nbsp;�������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'60': str_params += "&nbsp;�������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'61': str_params += "&nbsp;��������� ����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'62': str_params += "&nbsp;�����������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'63': str_params += "&nbsp;���������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'64': str_params += "&nbsp;������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'65': str_params += "&nbsp;�����������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'66': str_params += "&nbsp;������� �������������� ����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'67': str_params += "&nbsp;���������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'68': str_params += "&nbsp;�������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'69': str_params += "&nbsp;�������� ������� ����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'70': str_params += "&nbsp;������������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br />"; break;
			case'expbonus': str_params += "&nbsp;<font color=#BB0000>����� �����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</font></b><br>";break;
			case'massbonus': str_params += "&nbsp;<font color=#BB0000>�����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</font></b><br>";break;
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
			case'30': str_params += "&nbsp;����: <b>"+str_par[1]+"</b><br />"; break;
			case'31': str_params += "&nbsp;�����������: <b>"+str_par[1]+"</b><br />"; break;
			case'32': str_params += "&nbsp;�������: <b>"+str_par[1]+"</b><br />"; break;
			case'33': str_params += "&nbsp;��������: <b>"+str_par[1]+"</b><br />"; break;
			case'34': str_params += "&nbsp;�����: <b>"+str_par[1]+"</b><br />"; break;
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
			case'expbonus': str_params += "&nbsp;����� �����:<font color=#BB0000> "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</font></b><br>";break;
			case'massbonus': str_params += "&nbsp;�����:<font color=#BB0000> "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</font></b><br>";break;
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