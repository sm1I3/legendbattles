if (frameResizer==undefined)
var frameResizer = '';

document.write('<script type="text/javascript" src="JavaScript/jquery.js?2"></script><center><table border="0" width="99%" cellspacing="0" cellpadding="0" class=but><tr> <td colspan="5" class="but2" align="center">'+frameResizer+'</td> </tr> <tr> <td class="but2" align="center" width="30%"><a href="watchers.php?id='+uid+'&do_w=mpb&'+rnd()+'" class=bg>���������� ��������, ������, ���� ,�������.</a></td> <td class="but2" align="center" width="30%"><a href="watchers.php?id='+uid+'&do_w=sells&'+rnd()+'"class=bg>�������/�������� ����� � �����</a></td> <td class="but2" align="center" width="30%"><a href="watchers.php?id='+uid+'&do_w=pass&'+rnd()+'"class=bg>����� ������</a></td> <td class="but2" align="center" width="30%"><a href="watchers.php?id='+uid+'&do_w=onecomp&'+rnd()+'"class=bg>������ � ������ ����.</a></td></tr> <tr> <td class="but2" align="center" width="30%"><a href="watchers.php?id='+uid+'&do_w=ip"class=bg>�������� IP �������</a></td> <td class="but2" align="center" width="30%"><a href="watchers.php?id='+uid+'&do_w=rmpb&'+rnd()+'"class=bg>���������� ����., ������, �����</a></td> <td class="but2" align="center" width="30%"><a href="watchers.php?id='+uid+'&do_w=w_z&'+rnd()+'"class=bg>������� �����������</a></td> <td class="but2" align="center" width="30%"><a href="watchers.php?id='+uid+'&do_w=battles&'+rnd()+'"class=bg>���</a></td></tr> <tr> <td class="inv" align="center" width="90%" colspan="9">');
var r=0;
function show_mpb(m,p,b,w,i,d,u,c){
document.write('<form action="watchers.php?id='+uid+'&do_w=mpb" method=post name=mpb onsubmit="subm();return false;"><b class=about>�����������:</b><table border="0" cellpadding="0" cellspacing="0" id=tbl_main><tr><td align="center" width="450" class=gray>��������</td><td>');
if (m>0) document.write('<select style="width:140px" size="1" name="molch" class=items><option selected value="">�����</option><option  value="-1">�����</option><option value="5">5 �����</option><option value="10">10 �����</option><option value="15">15 �����</option><option value="30">30 �����</option><option value="60">1 ���</option><option value="120">2 ���a</option><option value="180">3 ���a</option><option value="360">6 �����</option><option value="1440">24 ����</option></select>'); else document.write('<i>����������</i>');
document.write('<tr><td align="center" width="450" class=gray>������</td><td>');
if (p>0) document.write('<select style="width:140px" size="1" name="prisontime" class=items><option selected value="">�����</option><option value="vip">���������</option><option value="1">1 ����</option><option value="3">3 ���</option><option value="7">1 ������</option><option value="14">2 ������</option><option value="30">1 �����</option><option value="60">2 ������</option><option value="365">1 ���</option></select><input type=text class=but2 name=prison title="�������">');else document.write('<i>����������</i>');
document.write('</td></tr><tr><td align="center" width="450" class=gray>������������</td><td width="500" colspan="2">');
if (b>0) document.write('<select style="width:140px" size="1" name="blockt" class=items><option selected value="">�����</option><option value="1">�������������</option><option value="2">��������������</option></select><input type=text class=but2 name=block title="�������">'); else document.write('<i>����������</i>');
document.write('</td></tr><tr><td align="center" width="450" class=gray>������������ ����������</td><td width="500" colspan="2">');
if (i>0) document.write('<select style="width:140px" size="1" name="blockit" class=items><option selected value="">�����</option><option value="1">�������������</option><option value="2">��������������</option></select><input type=text class=but2 name=blocki title="�������">'); else document.write('<i>����������</i>');
document.write('</td></tr><tr><td align="center" width="450" class=gray>�������</td><td width="500" colspan="2">');
if (w>0) document.write('<input type=text class=but2 name=pometka>'); else document.write('<i>����������</i>');
if (d>0) document.write('<tr><td align="center" width="450" class=about>������� ������<br>[�������� ��� �������: <B>'+r+' DL.L.</B>]</td><td width="500" colspan="2"><input type=text class=but2 name=d_num title="����������"></td>');
if (m>0)
document.write('<tr><td align="center" width="914" colspan="3"><input type=submit class=login value="���������" style="width:100%;height:15px;cursor:pointer;"></td>');
document.write('</tr></table></form></td></tr></table>');
}
function subm()
{
	if (document.mpb.d_num)
	 if (document.mpb.d_num.value)
	  if (!confirm("�� ������������� ������ ������� ������???"))return;
	document.mpb.submit();
}
function show_message(message){
document.write(message);
document.write('</td></tr></table>');
}
function zametki(str)
{
document.write('<table border="0" cellpadding="0" cellspacing="3">');
	var lines = str.split('@');
	var s;
	for (var i=0;i<lines.length;i++) 
	{
		document.write('<tr>');
		if (lines[i]!=''){
		s=lines[i].split('|');
		document.write('<td><font class=time>'+s[0]+'</font></td><td> '+s[1]+' </td><td>(<b>'+s[2]+'</b>)</td>');
		}
		document.write('</tr>');
	}
document.write('</table></td></tr></table>');
}
function rmpb(molch,blocks)
{
document.write('��������:<br>');
document.write('<table border="0" cellpadding="0" cellspacing="3">');
	var lines = molch.split('@');
	var s;
	for (var i=0;i<lines.length;i++) 
	{
		document.write('<tr>');
		if (lines[i]!=''){
		s=lines[i].split('|');
		document.write('<td><font class=time>'+s[0]+'</font></td><td> '+s[1]+'</td><td> (<b>'+s[2]+'</b>)</td>');
		}
		document.write('</tr>');
	}
document.write('</table><hr>����� / ������:<br>');
document.write('<table border="0" cellpadding="0" cellspacing="3">');
	lines = blocks.split('@');
	for (var i=0;i<lines.length;i++) 
	{
		document.write('<tr>');
		if (lines[i]!=''){
		s=lines[i].split('|');
		if (s[1]>5)
		document.write('<td><font class=time>'+s[0]+'</font></td><td> ������, ������� '+s[2]+'</td><td> (<b>'+s[3]+'</b>)</td>');
		if (s[1]==0)
		document.write('<td><font class=time>'+s[0]+'</font></td><td> ������ �� ������ </td><td>(<b>'+s[3]+'</b>)</td>');
		if (s[1]==1)
		document.write('<td><font class=time>'+s[0]+'</font></td><td> ����, ������� '+s[2]+' </td><td>(<b>'+s[3]+'</b>)</td>');
		if (s[1]==2)
		document.write('<td><font class=time>'+s[0]+'</font></td><td> ������� </td><td>(<b>'+s[3]+'</b>)</td>');
		}
		document.write('</tr>');
	}
document.write('</table></td></tr></table>');
}
function ip(str)
{
document.write('<table border="0" cellpadding="0" cellspacing="3">');
	var lines = str.split('@');
	var s;
	for (var i=lines.length-1;i>=0;i--) 
	{
		document.write('<tr>');
		if (lines[i]!=''){
		s=lines[i].split('|');
		document.write('<td><font class=time>'+s[0]+'</font></td><td> '+s[1]+' </td>');
		}
		document.write('</tr>');
	}
document.write('</table></td></tr></table>');
}
function pass(str)
{
document.write('<table border="0" cellpadding="0" cellspacing="3">');
	var lines = str.split('@');
	var s;
	for (var i=0;i<lines.length;i++) 
	{
		document.write('<tr>');
		if (lines[i]!='')
		document.write('<td><font class=time>'+lines[i]+'</font></td><td> ����� </td>');
		document.write('</tr>');
	}
document.write('</table></td></tr></table>');
}
function sells(sales,tr)
{
document.write('�������:<br>');
document.write('<table border="0" cellpadding="0" cellspacing="3">');
	var lines = sales.split('@');
	var s;
	for (var i=0;i<lines.length;i++) 
	{
		document.write('<tr>');
		if (lines[i]!=''){
		s=lines[i].split('|');
		document.write('<td><font class=time>'+s[0]+'</font></td><td>'+s[1]+'</td>');
		}
		document.write('</tr>');
	}
document.write('</table><hr>��������:<br>');
document.write('<table border="0" cellpadding="0" cellspacing="3">');
	lines = tr.split('@');
	for (var i=0;i<lines.length;i++) 
	{
		document.write('<tr>');
		if (lines[i]!=''){
		s=lines[i].split('|');
		if (s[1]==0)
		document.write('<td><font class=time>'+s[0]+'</font></td><td><<< �������� ����� <b>'+s[2]+' LN</b> ��� '+s[3]+'<img style="CURSOR: hand" onclick="javascript:window.open(\'watchers.php?id='+s[3]+'\',\'_blank\')" src=images/info.gif></td>');
		if (s[1]==3)
		document.write('<td><font class=time>'+s[0]+'</font></td><td>>>> ������� ����� <b>'+s[2]+' LN</b> �� '+s[3]+'<img style="CURSOR: hand" onclick="javascript:window.open(\'watchers.php?id='+s[3]+'\',\'_blank\')" src=images/info.gif></td>');
		if (s[1]==1)
		document.write('<td><font class=time>'+s[0]+'</font></td><td><<< �������� <b>'+s[2]+'</b>(��� '+s[3]+') ��� '+s[4]+'<img style="CURSOR: hand" onclick="javascript:window.open(\'watchers.php?id='+s[4]+'\',\'_blank\')" src=images/info.gif></td>');
		if (s[1]==2)
		document.write('<td><font class=time>'+s[0]+'</font></td><td>>>> ������� <b>'+s[2]+'</b>(��� '+s[3]+') �� '+s[4]+'<img style="CURSOR: hand" onclick="javascript:window.open(\'watchers.php?id='+s[4]+'\',\'_blank\')" src=images/info.gif></td>');
		if (s[1]==4)
		{
		 if (s[2]==20) var travm='�����';
		 if (s[2]==50) var travm='�������';
		 if (s[2]==80) var travm='������';
			document.write('<td><font class=time>'+s[0]+'</font></td><td><<< ��������� '+travm+'   ������ ��� '+s[3]+'<img style="CURSOR: hand" onclick="javascript:window.open(\'watchers.php?id='+s[4]+'\',\'_blank\')" src=images/info.gif></td>');
		}
		if (s[1]==5)
		{
		 if (s[2]==20) var travm='�����';
		 if (s[2]==50) var travm='�������';
		 if (s[2]==80) var travm='������';
			document.write('<td><font class=time>'+s[0]+'</font></td><td>>>> ��������� '+travm+'   ������ �� '+s[3]+'<img style="CURSOR: hand" onclick="javascript:window.open(\'watchers.php?id='+s[4]+'\',\'_blank\')" src=images/info.gif></td>');
		}
				 
		}
		document.write('</tr>');
	}
document.write('</table></td></tr></table>');
}

function rnd()
{
	return 'rand='+Math.random();
}

function rmpb_filter(uid,c1,c2,c3,c4,c5,from,to)
{
c1 = (c1) ? 'CHECKED' : '';
c2 = (c2) ? 'CHECKED' : '';
c3 = (c3) ? 'CHECKED' : '';
c4 = (c4) ? 'CHECKED' : '';
c5 = (c5) ? 'CHECKED' : '';
document.write('<center class=but2><form method=post action="watchers.php?id='+uid+'&do_w=rmpb" name=rmpb><i>������</i> <table border="1" width="100%" cellspacing="0" cellpadding="0"> <tr> <td align="center" width="20%">��������<input type="checkbox" name="C1" value="1"'+c1+'></td> <td align="center" width="20%">�����<input type="checkbox" name="C2" value="1"'+c2+'></td> <td align="center" width="20%">������<input type="checkbox" name="C3" value="1"'+c3+'></td> <td align="center" width="20%">����<input type="checkbox" name="C4" value="1"'+c4+'></td> <td align="center" width="20%">����� ����<input type="checkbox" name="C5" value="1"'+c5+'></td> </tr> <tr> <td align="center" width="20%"></td> <td align="center" width="20%"></td> <td align="center" width="20%"><input type="text" name="from" size="8" value="'+from+'" class=but>-<input type="text" name="to" size="8" value="'+to+'" class=but></td> <td align="center" width="20%"></td> <td align="center" width="20%"> </td> </tr> <tr> <td align="center" width="100%" colspan="5"> <input type="button" value="���������" class=login onclick="rmpb_submit();" style="width:90%"></td> </tr></table></form></center>');
}
function rmpb_submit()
{
	document.rmpb.submit();
}
function transfer(uid,c1,c2,c3,from,to)
{
c1 = (c1) ? 'CHECKED' : '';
c2 = (c2) ? 'CHECKED' : '';
c3 = (c3) ? 'CHECKED' : '';
document.write('<form method=post action="watchers.php?id='+uid+'&do_w=sells" name=rmpb> <table border="1" width="100%" cellspacing="0" cellpadding="0" bordercolordark="#FFFFFF" bordercolorlight="#DDDDDD" bgcolor="#F0EFEF"> <tr> <td colspan="5" align="center">:������:</td> </tr> <tr> <td align="center" width="33%">�������<input type="checkbox" name="C1" value="1"'+c1+'></td> <td align="center" width="33%">��������<input type="checkbox" name="C2" value="1"'+c2+'></td> <td align="center" width="33%">�������� �����<input type="checkbox" name="C3" value="1"'+c3+'></td></tr> <tr> <td align="center" width="33%">����:</td> <td align="center" width="33%">�� <input type="text" name="from" size="20" value="'+from+'"> </td>  <td align="center" width="33%"> �� <input type="text" name="to" size="20" value="'+to+'"></td> </tr> <tr> <td align="center" width="100%" colspan="5"> <input type="button" value="���������" class=login onclick="rmpb_submit();"></td> </tr></table></form>');
}

function show_wtch()
{
	top.document.getElementById('frmset').rows = "*,500";
	document.getElementById('wtch').innerHTML = '[������]�������������� ���������� ��� ������ � ���������';
	document.getElementById('wtch').href = 'javascript:hide_wtch()';
}
function hide_wtch()
{
	top.document.getElementById('frmset').rows = "*,35";
	document.getElementById('wtch').innerHTML = '[��������]�������������� ���������� ��� ������ � ���������';
	document.getElementById('wtch').href = 'javascript:show_wtch()';
}

function select_all_checks()
{
	$(":checkbox").each(function(){this.checked=true;});
}