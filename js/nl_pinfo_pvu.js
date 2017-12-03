var DTAB = false;
var seen = 0;

PInfoPVU = function(see){
	var date_f = d.getElementById('date_from').value;
	var date_t = d.getElementById('date_to').value;
	if(date_f && date_t){
		seen = see;
		PInfoGet('/gameplay/ajax/pinfo_pvu.php?puid='+info[11][0]+'&etime='+info[11][1]+'&hash='+info[11][2]+'&see='+see+'&date_f='+date_f+'&date_t='+date_t);
	}
}

PInfoGet = function(script){
	if(!xmlhttp){
		xmlhttp = GetHttpRequest();
		if(!xmlhttp) return;
	}
	xmlhttp.open('GET','./'+script,true);
	xmlhttp.onreadystatechange = PInfoProcessChange;
	xmlhttp.send(null);
}

PInfoProcessChange = function(){
	if(xmlhttp.readyState == 4){
		if(xmlhttp.status == 200){
			var ret = xmlhttp.responseText;
			if(ret != 'ERR'){
				arr_res = ret.split('::');
				if(arr_res[1] != '0'){
					info[11][1] = parseInt(arr_res[1]);
					info[11][2] = arr_res[2];
				}
				var i,tr = 0,table_obj,all = arr_res.length - 1;
				if(DTAB) d.getElementById('Dynamic').removeChild(DTAB);
				
				DTAB = d.createElement('table');
				DTAB.id = 'TDyn';
				DTAB.cellPadding = '4';
				DTAB.cellSpacing = '1';
				DTAB.border = '0';
				DTAB.width = '100%';
				d.getElementById('Dynamic').appendChild(DTAB);
				
				table_obj = d.getElementById('TDyn');
				var get = '';
				if(all > 3){
					for(i=3; i<all; i++){
						get = PVUFormat(arr_res[i]);
						if(get){
							BasicAddTD(table_obj.insertRow(tr),'[[[0,"'+get+'"]]]');
							tr++;
						}
					}
				}
				else BasicAddTD(table_obj.insertRow(0),'[[[0,"<B>������� �� �������.</B>"]]]');
			}
		}
	}
}

PInfoPVUMenu = function(){
	return '<table class="infoblock2" cellspacing="0" cellpadding="0" border="0"><tr><td class="left_top"></div></td><td class="center_top"><div class="top_name_right">������ ����</div></td><td class="right_top"></td></tr><tr><td class="left_middle"></td><td class="center_middle" style="width: 660px;"><div class="text"><table cellspacing=1 cellpadding=4 border=0><tr><td colspan=4><input type=text id="date_from" name="date_from" class="calendat_input"> <img src="http://img.legendbattles.ru/image/pinfo/cms_calendar.gif" align="absmiddle" id="from_d" title="" alt="" style="cursor: pointer;" border="0" width="18" height="18"> <input type=text id="date_to" name="date_to" class="calendat_input"> <img src="http://img.legendbattles.ru/image/pinfo/cms_calendar.gif" align="absmiddle" id="from_t" title="" alt="" style="cursor: pointer;" border="0" width="18" height="18"></td></tr><tr><td><a href="#">�������</a></td><td><a href="javascript: PInfoPVU(8388608);">LR/���� (����)</a></td><td><a href="javascript: PInfoPVU(128);">�������� LR (�����)</a></td><td><a href="javascript: PInfoPVU(512);">��������/�����/�������</a></td></tr><tr><td><a href="javascript: PInfoPVU(1024);">�������</a></td><td><a href="javascript: PInfoPVU(4194304);">��������� �������</a></td><td><a href="javascript: PInfoPVU(8192);">��������/������/����</a></td><td><a href="javascript: PInfoPVU(32);">�������/������� �����</a></td></tr><tr><td><a href="javascript: PInfoPVU(2048);">��������</a></td><td><a href="javascript: PInfoPVU(2097152);">����������� �����</a></td><td><a href="javascript: PInfoPVU(256);">�����/���� (��������)</a></td><td><a href="javascript: PInfoPVU(1048576);">�������/���������/�������</a></td></tr><tr><td><a href="javascript: PInfoPVU(2);">�������� LR</a></td><td><a href="javascript: PInfoPVU(16);">����������� �����</a></td><td><a href="javascript: PInfoPVU(32768);">�����/����� (��������)</a></td><td><a href="javascript: PInfoPVU(4096);">����� � ������ ����������</a></td></tr><tr><td><a href="javascript: PInfoPVU(8);">����� � ���</a></td><td><a href="javascript: PInfoPVU(1);">����� ������������</a></td><td><a href="javascript: PInfoPVU(65536);">�����/����� (��������)</a></td><td><a href="javascript: PInfoPVU(131072);">������/Flash/E-mail (�����)</a></td></tr><tr><td><a href="javascript: PInfoPVU(64);">����� � �����</a></td><td><a href="javascript: PInfoPVU(262144);">�������������� ���</a></td><td><a href="javascript: PInfoPVU(4);">��������/������� �����</a></td><td><a href="javascript: PInfoPVU(16384);">�������� �� �������</a></td></tr></table><table cellspacing=0 cellpadding=0 border=0><tr><td id="Dynamic"></td></tr></table></div></td><td class="right_middle"></td></tr><tr><td class="left_bot"></td><td class="center_bot"></td><td class="right_bot"></td></tr></table>';
}

PInfoCalendar = function(){
	Calendar.setup({
		inputField : "date_from",
		ifFormat   : "%Y-%m-%d",
		button     : "from_d",
		align      : "Br",
		weekNumbers: false,
		showsTime   : true,
		timeFormat  : 24
	});
	Calendar.setup({
		inputField : "date_to",
		ifFormat   : "%Y-%m-%d",
		button     : "from_t",
		align      : "Br",
		weekNumbers: false,
		showsTime   : true,
		timeFormat  : 24
	});      
}

BasicAddTD = function(oTR,Os){
	var Obj = eval(Os);
	var i,j,oTD;
	for(i=0; i<Obj.length; i++){
		oTD = oTR.insertCell(i);
		for(j=0; j<Obj[i].length; j++){
			switch(Obj[i][j][0]){
				case 0: oTD.innerHTML = Obj[i][j][1]; break;
				case 1: oTD.bgColor = Obj[i][j][1]; break;
				case 2: oTD.align = Obj[i][j][1]; break;
				case 3: oTD.width = Obj[i][j][1]; break;
				case 4: oTD.height = Obj[i][j][1]; break;
				case 5: oTD.className = Obj[i][j][1]; break;
				case 6: oTD.colSpan = Obj[i][j][1]; break;
			}
		}
	}
}

var case1 = ['���� � ����','�������� ������','�������� Flash-������'];
var case2 = [['�������','���'],['�������','��'],['������� �� �����','���'],['������� �� �����','��']];
var case4 = [['�������','���'],['�������','��'],['������� �� �����','���'],['������� �� �����','��'],['������� ������ �����','���'],['������� ������ �����','��'],['������� ��� �������','���'],['������� ��� �������','��']];
var case1024 = [['������ �������','���'],['������� �������','��']];
var case2048 = ['','����������� ��������','����������� �������� ','����������� ��������','�������� ��������','���������� �������� III','���������� �������� II','���������� �������� I'];
var case32768 = ['�������� �� �����','�������� �� �����','�������� �� ��','�������� � �����','�������� � ����','�������� � ��'];
var case65536 = ['�������� �� �����','�������� �� �����','�������� � �����','�������� � ����'];
var case131072 = [['����� e-mail','����������'],['����� ������','��'],['��������� Flash-������','�����'],['������ Flash-������'],['����� ���� ��������']];
var case8192 = [['��������','���'],['������ ��������','���'],['�������� ��������','��'],['������ �������� ��������','��'],['������� � ������','���'],['������ �� ������'],['�������� � ������'],['����������'],['������ ����������'],['��������� ��������']];
var case32 = [['������','���'],['�����','�'],['������ �� �����','���'],['����� �� �����','�'],['������ �� ��������','���'],['����� �� ��������','�']];
var case1048576 = [['������������� �����','������� ���','������ ������'],['������ �� �����','�������� ���','������� ������'],['������������� �������','�������� ���','������� ������'],['������ �� �������','������ ���������',''],['������������� ������� (������)','','������ ������'],['������ �� ������� (������)',''],['������������� ������',''],['������ �� ������',''],['������� ���������',''],['������ �� �������',''],['���������/������������� (������)',''],['���������/������������ (�������)','']];
var case2097152 = [['��������� ����������� ������','���������'],['��������� ����������� ��','�������'],['��������� ����������� HP'],['��������� ����������� �����'],['��������� ����������� ��'],['��������� ����������� MP'],['����������� �����'],['����������� HP'],['����������� ��'],['����������� ������']];
var case16384 = ['�������� ��������','�������� �������� (�������)','�������� �� ��������'];
var case128 = [['������� �� ���� (����)','���'],['������� �� ���� (����)','��']];

PVUFormat = function(str){
	var r = '',c,c1;
	var arr = str.split('|');
	switch(seen){
        case 1:
        
        c = parseInt(arr[1]);
        r = arr[0]+' <b>'+case1[c]+'</b> (IP: '+arr[2]+')';
        
        break;
        case 2:
        
        c = parseInt(arr[1]);
        r = (arr[2] != arr[3] ? '' : '<font color=#DD0000>')+arr[0]+' <b>'+case2[c][0]+'</b> ('+arr[2]+') '+case2[c][1]+' <b>'+arr[5]+'</b> ['+arr[4]+'] ('+arr[3]+') <b>'+arr[6]+' LR</b>'+(arr[8] ? ' (������� ��������: '+arr[8]+')' : '')+(arr[2] != arr[3] ? '' : '</font>');
        
        break;
        case 4:
        
        c = parseInt(arr[1]); 
        r = (arr[2] != arr[3] ? '' : '<font color=#DD0000>')+arr[0]+' <b>'+case4[c][0]+'</b> ('+arr[2]+') '+case4[c][1]+' <b>'+arr[5]+'</b> ['+arr[4]+'] ('+arr[3]+') <b>'+arr[11]+'</b> ('+arr[7]+' LR) ['+arr[6]+'] ['+arr[8]+'/'+arr[9]+']'+(arr[2] != arr[3] ? '' : '</font>');
        
        break;
        case 8:
        
        r = arr[0]+' <b>����� � ���</b> ('+arr[1]+') <b>'+arr[8]+'</b> ('+arr[3]+' LR) ['+arr[2]+'] ['+arr[5]+'/'+arr[6]+'] �� <b>'+arr[4]+' LR</b>';
        
        break;
        case 16:
        
        r = arr[0]+' <b>����������� ����</b> ('+arr[1]+') <b>'+arr[6]+'</b> ('+arr[3]+' LR) ['+arr[2]+'] ['+arr[4]+'/'+arr[5]+']';
        
        break;
        case 64:
        
        r = arr[0]+' <b>����� � �����</b> ����� <img src=http://img.legendbattles.ru/image/signs/'+align[parseInt(arr[6])][0]+' width=15 height=12 border=0 align=absmiddle> <img src=http://img.legendbattles.ru/image/signs/'+arr[7]+' width=15 height=12 border=0 align=absmiddle> '+arr[8]+' ('+arr[1]+') <b>'+arr[9]+'</b> ('+arr[3]+' LR) ['+arr[2]+'] ['+arr[4]+'/'+arr[5]+']';
        
        break;
        case 1024:
        
        c = parseInt(arr[1]); 
        r = arr[0]+' <b>'+case1024[c][0]+'</b> �� <b>'+arr[5]+' LR</b> ('+arr[2]+') '+case1024[c][1]+' <b>'+arr[4]+'</b> ['+arr[3]+']'+(arr[6].length>1 ? ' (�������: '+arr[6]+')' : '');
        
        break;
        case 2048:
        
        c = parseInt(arr[3]);
        r = arr[0]+' <b>'+case2048[c]+'</b> ['+arr[5]+'] ('+arr[1]+') ['+arr[2]+'] ('+arr[4]+' LR)'; 
        
        break;
        case 32768:
        
        c = parseInt(arr[1]);
        r = arr[0]+' <b>'+case32768[c]+'</b> �� '+arr[4]+' ['+arr[3]+'] ('+arr[2]+')';
        
        break; 
        case 65536:
        
        c = parseInt(arr[1]);
        r = arr[0]+' <b>'+case65536[c]+'</b> ('+arr[2]+') ��������� '+arr[4]+' ['+arr[3]+'] �� <b>'+arr[5]+' LR</b>';
        
        break;
        case 131072:
        
        c1 = -1;
        c = parseInt(arr[1]);
        if(arr[4]) c1 = parseInt(arr[4]);
        r = arr[0]+' <b>'+case131072[c][0]+'</b> ('+arr[2]+')'+(arr[3] ? ' ['+arr[3]+']' : '')+' '+(c1 > -1 ? case131072[c1][1] : '')+(arr[6] ? ' <b>'+arr[6]+'</b> ['+arr[5]+']' : '');
        
        break;
        case 262144:
        
        r = arr[0]+' ����� ��� <a href=\'./logs.fcg?fid='+arr[4]+'\' target=_blank><b>'+arr[4]+'</b></a> ('+arr[1]+') ������� ['+arr[2]+'] ���� ['+arr[3]+']';
        
        break;
        case 4194304:
        
        r = arr[0]+' ����� ��� <a href=\'./logs.fcg?fid='+arr[3]+'\' target=_blank><b>'+arr[3]+'</b></a> ('+arr[1]+') ��������� ������ ['+arr[2]+']';
        
        break;
        case 4096:
        
        var func = parseInt(arr[1]);
        r = arr[0]+' <a href=\'./ipers.php?'+arr[3]+'\' target=\'_blank\'><b>'+arr[3]+'</b></a> ['+arr[2]+'] ('+arr[4]+')'+(func & 1 ? ' (<b>� ������</b>)' : (func & 2 ? ' <b>� �����</b>' : ''));
        
        break;
        case 8388608:
        
        r = arr[0]+' <b>'+arr[1]+'</b>'+(parseInt(arr[3])>0 ? ' ['+arr[3]+'/'+arr[3]+']' : '')+' ('+arr[2]+' LR)';
        
        break;
        case 8192:
        
        c = parseInt(arr[1]);
        c1 = parseInt(arr[5]);
        
        r = arr[0]+' <b>'+case8192[c][0]+'</b> �� '+arr[4]+' ['+arr[3]+'] ('+arr[2]+')'+(parseInt(arr[6])>0 ? ' �� ['+arr[6]+' '+case8192[c1][1]+']' : '')+(arr[7] ? ' (�������: '+arr[7]+')' : '');
        
        break;
        case 32:
        
        c = parseInt(arr[1]); 
        r = (arr[2] != arr[3] ? '' : '<font color=#DD0000>')+arr[0]+' <b>'+case32[c][0]+'</b> ('+arr[2]+') �� <b>'+arr[8]+'</b> '+case32[c][1]+' <b>'+arr[5]+'</b> ['+arr[4]+'] ('+arr[3]+') <b>'+arr[12]+'</b> ['+arr[6]+'] ('+arr[7]+' LR) ['+arr[9]+'/'+arr[10]+']'+(arr[2] != arr[3] ? '' : '</font>');
        
        break;
        case 2097152:
        
        c = parseInt(arr[2]);
        c1 = parseInt(arr[3]);
        r = arr[0]+' ����������� <b>'+arr[10]+'</b> ['+case2097152[c][0]+' / '+case2097152[c1][1]+'] ['+arr[4]+'] ['+arr[8]+'/'+arr[9]+'] ('+arr[1]+') <b>'+arr[5]+' LR -> '+arr[6]+' LR</b> ('+arr[7]+' LR)';
        
        break;
        case 128:
        
        c = parseInt(arr[1]);
        switch(c)
        {
            case 0:
            case 1: r = (arr[2] != arr[3] ? '' : '<font color=#DD0000>')+arr[0]+' <b>'+case128[c][0]+'</b> ('+arr[2]+') '+case128[c][1]+' <b>'+arr[5]+'</b> ['+arr[4]+'] ('+arr[3]+') <b>'+arr[6]+' LR</b>'+(arr[8] ? ' (������� ��������: '+arr[8]+')' : '')+(arr[2] != arr[3] ? '' : '</font>'); break;
            case 2: r = arr[0]+' <b>������� �� ���� <img src=http://img.legendbattles.ru/image/signs/'+arr[7]+'.gif width=15 height=12 border=0 align=absmiddle>�����</b> ('+arr[2]+') <b>'+arr[6]+' LR</b>'+(arr[8] ? ' (������� ��������: '+arr[8]+')' : ''); break;
            case 3: r = arr[0]+' <b>������� �� ����� <img src=http://img.legendbattles.ru/image/signs/'+arr[7]+'.gif width=15 height=12 border=0 align=absmiddle>�����</b> ('+arr[2]+') <b>'+arr[6]+' LR</b>'+(arr[8] ? ' (������� ��������: '+arr[8]+')' : ''); break;
            case 4: r = arr[0]+' <b>������� �� ���� <img src=http://img.legendbattles.ru/image/signs/'+arr[7]+'.gif width=15 height=12 border=0 align=absmiddle>�����</b> ('+arr[2]+') <b>'+arr[6]+' LR</b> �� ����� <img src=http://img.legendbattles.ru/image/signs/'+arr[5]+'.gif width=15 height=12 border=0 align=absmiddle>�����'+(arr[8] ? ' (������� ��������: '+arr[8]+')' : ''); break;
        }
         
        break;
        case 256:
        
        r = str;
        
        break;
        case 512:
        
        r = str;
        
        break;
        case 1048576:
        
        c = parseInt(arr[1]);
        if(c < 8) r = arr[0]+' <b>'+case1048576[c][0]+'</b> '+arr[8]+' ('+arr[2]+') <b>'+arr[5]+'</b> ['+arr[4]+'] ('+arr[3]+') ['+arr[6]+' / '+arr[7]+']';
        else if(c < 10) 
        {
            c1 = parseInt(arr[6]);
            r = arr[0]+' <b>'+case1048576[c][0]+'</b> ['+case1048576[c1][2]+'] ('+arr[2]+') <b>'+arr[5]+'</b> ['+arr[4]+'] ('+arr[3]+')';    
        }
        else 
        {
            c1 = parseInt(arr[3]);
            r = arr[0]+' <b>'+case1048576[c][0]+'</b> ('+arr[2]+') ����� ��� <a href=\'./logs.fcg?fid='+arr[4]+'\' target=_blank><b>'+arr[4]+'</b></a>'+(case1048576[c1][1] ? ' ('+case1048576[c1][1]+')' : '');
        }
        
        break;
        case 16384:
        
        c = parseInt(arr[1]);
        r = arr[0]+' <b>'+case16384[c]+'</b> '+arr[4]+' ['+arr[3]+'] ('+arr[2]+')'+(arr[5] ? ' <b>�����������:</b> '+arr[5] : '');
        
        break;   
    }
    return r;
}