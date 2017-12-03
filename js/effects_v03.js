var d = document;
var effects = [ '','������ ������','������� ������','������� ������','����������� ������','���������','','','������ ���������','������������� ������','���������� �������','���������','���������� ���������','����������� ���������','������ ���������������','����','������','��������','�������� ��������','������ ������������','����� ��������','����� ���������� ����','����� ������������','����� �����','��','����� ����������','����� ����','����� ������ �� ������','����� ����������� ����','����� �����','����� �������������� ������','����� ���������','����� ��������������','����� ������� ���������','����� ��������','����� �����','����� ��������� ������','����� �����������','����� ���������','����� �����������','����� ������� �����','����� ������ ������','����� ������ �����','����� ������ ������','����� �����������','����� ��������','����� �������-����','����� ������ ����������','����� �����������','����� �������','','��������� �����','����� ��������','����� ��������� ����','����� �����������','��������� 100 �����','','','','','','','','','','','','','','','����� �������������','����� ��������','������ �������','������ �������� ����','����� ���������','���� ������','��� �����','���������� �����','������� �� �����������','����������� �������','������������� �����','���� ���� ����������','��������� �������','������ �������','������ �����','������������ �������� ������','������ �����','������� ����','��������� ����','������ ��������','����� ����������','','','','','',''];

function effects_view(elementid)
{
    var i;
    var a = cureff.length;
    
    if(a)
    {
        tid = d.getElementById(elementid);
        for(i=0; i<a; i++)
        {
            if(effects[cureff[i][0]]) tid.innerHTML += '<img src="/img/image/pinfo/eff_'+cureff[i][0]+'.gif" width="29" height="29" onmouseover="tooltip(this,\'<b>'+effects[cureff[i][0]]+'</b> '+effects_time(cureff[i][1])+((cureff[i][2])?'<br />'+effect_params(cureff[i][2]):'')+'\')" onmouseout="hide_info(this)"> ';
        }
    }
}

function effects_time(time)
{
    var h,m,s;
    h = m = 0;
    if(time > 0) h = parseInt(time / 3600);
    time -= 3600 * h;
    if(time > 0) m = parseInt(time / 60);
    time -= 60 * m;
    s = time;
    return '(��� '+(h < 10 ? '0'+h : h)+':'+(m < 10 ? '0'+m : m)+':'+(s < 10 ? '0'+s : s)+')';
}

function effect_params(params){
	var str_params = '';
	var str_pr = params.split(';');
	for (var str_val in str_pr){
		str_par = str_pr[str_val].split('/');	
		switch(str_par[0]){
			case'1': str_params += "&nbsp;����: <b>"+str_par[1]+"</b><br>";break;
			case'5': str_params += "&nbsp;������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br>";break;
			case'6': str_params += "&nbsp;��������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br>";break;
			case'7': str_params += "&nbsp;����������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br>";break;
			case'8': str_params += "&nbsp;���������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br>";break;
			case'9': str_params += "&nbsp;����� �����: <b>"+str_par[1]+"</b><br>";break;
			case'10': str_params += "&nbsp;������ �����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br>";break;
			case'11': str_params += "&nbsp;������ ������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'12': str_params += "&nbsp;������ ������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'13': str_params += "&nbsp;������ ����������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'14': str_params += "&nbsp;������ ����������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'15': str_params += "&nbsp;������ ������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'16': str_params += "&nbsp;������ �������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'17': str_params += "&nbsp;������ ���������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'18': str_params += "&nbsp;������ �������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'19': str_params += "&nbsp;������ �� ������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br>";break;
			case'20': str_params += "&nbsp;������ �� ������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br>";break;
			case'21': str_params += "&nbsp;������ �� ����������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br>";break;
			case'22': str_params += "&nbsp;������ �� ����������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br>";break;
			case'23': str_params += "&nbsp;������ �� ������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br>";break;
			case'24': str_params += "&nbsp;������ �� �������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br>";break;
			case'25': str_params += "&nbsp;������ �� ���������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br>";break;
			case'26': str_params += "&nbsp;������ �� �������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br>";break;
			case'27': str_params += "&nbsp;��: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br>";break;
			case'28': str_params += "&nbsp;���� ��������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br>";break;
			case'29': str_params += "&nbsp;����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br>";break;
			case'30': str_params += "&nbsp;����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br>";break;
			case'31': str_params += "&nbsp;�����������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br>";break;
			case'32': str_params += "&nbsp;�������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br>";break;
			case'33': str_params += "&nbsp;��������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br>";break;
			case'34': str_params += "&nbsp;�����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br>";break;
			case'35': str_params += "&nbsp;��������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</b><br>";break;
			case'36': str_params += "&nbsp;�������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'37': str_params += "&nbsp;�������� ��������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'38': str_params += "&nbsp;�������� �������� �������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'39': str_params += "&nbsp;�������� ������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'40': str_params += "&nbsp;�������� ����������� �������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'41': str_params += "&nbsp;�������� ���������� � �������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'42': str_params += "&nbsp;�������� ��������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'43': str_params += "&nbsp;�������� ������������ �������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'44': str_params += "&nbsp;�������� ��������� �������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'45': str_params += "&nbsp;����� ����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'46': str_params += "&nbsp;����� ����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'47': str_params += "&nbsp;����� �������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'48': str_params += "&nbsp;����� �����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'49': str_params += "&nbsp;������������� ����� ����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'50': str_params += "&nbsp;������������� ����� ����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'51': str_params += "&nbsp;������������� ����� �������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'52': str_params += "&nbsp;������������� ����� �����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'53': str_params += "&nbsp;���������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'54': str_params += "&nbsp;������������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'55': str_params += "&nbsp;����������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'56': str_params += "&nbsp;����������������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'57': str_params += "&nbsp;��������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'58': str_params += "&nbsp;��������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'59': str_params += "&nbsp;�������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'60': str_params += "&nbsp;�������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'61': str_params += "&nbsp;��������� ����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'62': str_params += "&nbsp;�����������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'63': str_params += "&nbsp;���������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'64': str_params += "&nbsp;������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'65': str_params += "&nbsp;�����������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'66': str_params += "&nbsp;������� �������������� ����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'67': str_params += "&nbsp;���������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'68': str_params += "&nbsp;�������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'69': str_params += "&nbsp;�������� ������� ����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'70': str_params += "&nbsp;������������: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'99': str_params += "&nbsp;��������� �����: "+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</b><br>";break;
			case'expbonus': str_params += "&nbsp;����� �����: <font color=#BB0000>"+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"%</font></b><br>";break;
			case'massbonus': str_params += "&nbsp;�����: <font color=#BB0000>"+((str_par[1])>0?'+':'')+"<b>"+str_par[1]+"</font></b><br>";break;
		}
	}
	return str_params;
}