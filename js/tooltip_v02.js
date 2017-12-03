var ttip_obj = false;

function ToolTip(descr)
{
	if(!ttip_obj) ttip_obj = d.getElementById("tooltip");
	if(ttip_obj)
	{
		var str_params = '';
		var st = '';
		if(descr[0]) str_params += '<B>'+descr[0]+'</B>';
		for(var i=1; i<descr.length; i++)
		{
			st = descr[i][2] ? ' ('+(descr[i][2] / 60)+' �)' : '';
			
			switch(descr[i][0])
			{
				case 'LI': str_params += '<BR>�����: <B>'+(!descr[i][1] ? '��� �����������' : descr[i][1]+' ��')+'</B>'+st; break;
				case 'EFF': str_params += '<BR><font color="#CC0000"><B>�������� ������</B> (����� <B>'+(descr[i][1] / 60)+'</B> �):</font>'; break;
				case 'HP': str_params += '<BR>�������������� HP: +<B>'+descr[i][1]+'</B>'+st; break;
				case 'MP': str_params += '<BR>�������������� MP: +<B>'+descr[i][1]+'</B>'+st; break;
				case 'US': str_params += '<BR>���������: -<B>'+descr[i][1]+'</B>'+st; break;
				case 'R_ST': str_params += '<BR>��������� ����: +<B>'+descr[i][1]+'</B>'+st; break;
				case 'R_MF': str_params += '<BR>��������� ��: +<B>'+descr[i][1]+'</B>'+st; break;
				case 'RB_ST': str_params += '<BR>��������� ����: '+(descr[i][4] == '1' ? '+' : '-')+'<B>'+descr[i][1]+'-'+descr[i][3]+'</B>'+st; break;
				case 'RB_MF': str_params += '<BR>��������� ��: '+(descr[i][4] == '1' ? '+' : '-')+'<B>'+descr[i][1]+'-'+descr[i][3]+'</B>'+st; break;
				case '4': str_params += '<BR>����: +<B>'+descr[i][1]+'</B>'+st; break;
				case '5': str_params += '<BR>�����������: +<B>'+descr[i][1]+'</B>'+st; break;
				case '6': str_params += '<BR>�������: +<B>'+descr[i][1]+'</B>'+st; break;
				case '7': str_params += '<BR>�����: +<B>'+descr[i][1]+'</B>'+st; break;
				case '9': str_params += '<BR>����: +<B>'+descr[i][1]+'</B>'+st; break;
				case '10': str_params += '<BR>�����������: +<B>'+descr[i][1]+'%</B>'+st; break;
				case '11': str_params += '<BR>�������: +<B>'+descr[i][1]+'%</B>'+st; break;
				case '12': str_params += '<BR>�����: +<B>'+descr[i][1]+'%</B>'+st; break;
				case '14': str_params += '<BR>����������: +<B>'+descr[i][1]+'</B>'+st; break;
				case '15': str_params += '<BR>���������: +<B>'+descr[i][1]+'</B>'+st; break;
				case '16': str_params += '<BR>������: +<B>'+descr[i][1]+'</B>'+st; break;
				case '17': str_params += '<BR>��������: +<B>'+descr[i][1]+'</B>'+st; break;
				case '18': str_params += '<BR>����������: +<B>'+descr[i][1]+'%</B>'+st; break;
				case '19': str_params += '<BR>���������: +<B>'+descr[i][1]+'%</B>'+st; break;
				case '20': str_params += '<BR>������: +<B>'+descr[i][1]+'%</B>'+st; break;
				case '21': str_params += '<BR>��������: +<B>'+descr[i][1]+'%</B>'+st; break;
				case '22': str_params += '<BR>����� �����: +<B>'+descr[i][1]+'</B>'+st; break;
				case '23': str_params += '<BR>����� �����: +<B>'+descr[i][1]+'%</B>'+st; break;
				case '24': str_params += '<BR>���� ��������: +<B>'+descr[i][1]+'</B>'+st; break;
				case '25': str_params += '<BR>���� PvP: +<B>'+descr[i][1]+'%</B>'+st; break;
				case '26': str_params += '<BR>����: '+(parseInt(descr[i][1]) > 0 ? '+' : '')+'<B>'+descr[i][1]+'%</B>'+st; break;
				case '33': str_params += '<BR>���: +<B>'+descr[i][1]+'</B>'+st; break;
				case '34': str_params += '<BR>���: +<B>'+descr[i][1]+'%</B>'+st; break;
				case '35': str_params += '<BR>������������ HP: +<B>'+descr[i][1]+'</B>'+st; break;
				case '36': str_params += '<BR>������������ MP: +<B>'+descr[i][1]+'</B>'+st; break;
				case '37': str_params += '<BR>�������������� HP: +<B>'+descr[i][1]+'%</B>'+st; break;
				case '38': str_params += '<BR>�������������� MP: +<B>'+descr[i][1]+'%</B>'+st; break;
				case '39': str_params += '<BR>����������� ����: +<B>'+descr[i][1]+'</B>'+st; break;
				case '40': str_params += '<BR>������������ ����: +<B>'+descr[i][1]+'</B>'+st; break;
				case '41': str_params += '<BR>����������������: +<B>'+descr[i][1]+'%</B>'+st; break;
				case '42': str_params += '<BR>���� PvE: +<B>'+descr[i][1]+'%</B>'+st; break;
				case '43': str_params += '<BR>����� ��������: -<B>'+descr[i][1]+'%</B>'+st; break;
			}
		}
		ttip_obj.innerHTML = str_params;
	}
}

function ChangePos(e)
{
	if(ttip_obj)
	{
		var curX = (e.pageX ? e.pageX : e.clientX + GetScrollX()) + 15;
		var curY = (e.pageY ? e.pageY : e.clientY + GetScrollY()) - 15;
	    ttip_obj.style.top = curY+"px";
	    ttip_obj.style.left = curX+"px";
	    ttip_obj.style.visibility = "visible";
    }
}

function HideToolTip()
{
	if(ttip_obj) ttip_obj.style.visibility = "hidden";
}

function GetScrollX()
{
	var x = 0;
	if(typeof window.pageXOffset == "number") x = window.pageXOffset;
 	else if(d.documentElement && d.documentElement.scrollLeft) x = d.documentElement.scrollLeft;
  	else if(d.body && d.body.scrollLeft) x = d.body.scrollLeft; 
   	else if(window.scrollX) x = window.scrollX;
	return x;
}
    
function GetScrollY()
{
	var y = 0;  
	if(typeof window.pageYOffset == "number") y = window.pageYOffset;
	else if(d.documentElement && d.documentElement.scrollTop) y = d.documentElement.scrollTop;
    else if(d.body && d.body.scrollTop) y = d.body.scrollTop; 
    else if(window.scrollY) y = window.scrollY;
	return y;
}

document.onmousemove = moveTip;
function moveTip(e) {
  floatTipStyle = document.getElementById("floatTip").style;
  w = 180; // ������ ���������

  // ��� �������� IE6-8
  if (document.all)  { 
    x = event.clientX + document.body.scrollLeft; 
    y = event.clientY + document.body.scrollTop; 

  // ��� ��������� ���������
  } else   { 
    x = e.pageX; // ���������� X �������
    y = e.pageY; // ���������� Y �������
  }

  // ���������� ���� ������ �� ������� 
  if ((x + w + 10) < document.body.clientWidth) { 
    floatTipStyle.left = x + 'px';

  // ���������� ���� ����� �� �������
  } else { 
    floatTipStyle.left = x - w + 'px';
  }

  // ��������� ��  �������� ���� ���� ��������
  floatTipStyle.top = y + 20 + 'px';
}

function toolTip(msg) {
  floatTipStyle = document.getElementById("floatTip").style;
  if (msg) {
    // ������� ����� ���������
    document.getElementById("floatTip").innerHTML = msg;
    // ���������� ���������
    floatTipStyle.display = "block";
  } else { 
    // ������ ���������
    floatTipStyle.display = "none";
  } 
}