ShowHide_wtch = function(){
	if(parent.document.getElementById('frmset').rows == '*,25'){
		parent.document.getElementById('frmset').rows = "*,500";
		document.getElementById('wtch').innerHTML = '[������]';
	}else if(parent.document.getElementById('frmset').rows == '*,500'){
		parent.document.getElementById('frmset').rows = "*,25";
		document.getElementById('wtch').innerHTML = '[��������]';
	}
}
ViewPage = function(){
	var r = '';
	if(fdata[0] & 1) r += '<tr><td align="center" width="450" class=nickname>�������� ��������</td><td><select style="width:140px" size="1" name="pactions" class=LogintextBox6><option selected value="">�� ��������</option><option value="1">����������</option></select></td></tr>';
	
	if(fdata[0] & 1) r += '<tr><td align="center" width="450" class=nickname>������ � 1 ��</td><td><select style="width:140px" size="1" name="pip" class=LogintextBox6><option selected value="">�� ��������</option><option value="1">����������</option></select></td></tr>';
	
	if(fdata[0] & 1) r += '<td align="center" width="450" class=nickname>��������� �����</td><td><select style="width:140px" size="1" name="autobot" class=LogintextBox6><option selected value="">�����</option><option  value="-1">�����</option><option value="5">5 �����</option><option value="10">10 �����</option><option value="15">15 �����</option><option value="30">30 �����</option><option value="60">1 ���</option><option value="120">2 ���a</option><option value="180">3 ���a</option><option value="360">6 �����</option><option value="1440">24 ����</option></select></td>';
	
	if(fdata[0] & 1) r += '<tr><td align="center" width="450" class=nickname>��������</td><td><select style="width:140px" size="1" name="molch" class=LogintextBox6><option selected value="">�����</option><option  value="-1">�����</option><option value="5">5 �����</option><option value="10">10 �����</option><option value="15">15 �����</option><option value="30">30 �����</option><option value="60">1 ���</option><option value="120">2 ���a</option><option value="180">3 ���a</option><option value="360">6 �����</option><option value="1440">24 ����</option></select><input type=text class=LogintextBox4 name=reason1 title="�������"></td></tr>';
	
	if(fdata[0] & 1) r += '<tr><td align="center" width="450" class=nickname>�������� ��������</td><td><select style="width:140px" size="1" name="fmolch" class=LogintextBox6><option selected value="">�����</option><option  value="-1">�����</option><option value="60">1 ���</option><option value="360">6 �����</option><option value="1440">24 ����</option><option value="10080">1 ������</option><option value="259200">6 �������</option><option value="525600">1 ���</option></select><input type=text class=LogintextBox4 name=freason1 title="�������"></td></tr>';
	
	if(fdata[0] & 2) r += '<tr><td align="center" width="450" class=nickname>������</td><td><select style="width:140px" size="1" name="prisontime" class=LogintextBox6><option selected value="">�����</option><option value="-1">���������</option><option value="1">1 ����</option><option value="3">3 ���</option><option value="7">1 ������</option><option value="14">2 ������</option><option value="30">1 �����</option><option value="60">2 ������</option><option value="365">1 ���</option></select><input type=text class=LogintextBox4 name=prison title="�������"></td></tr>';
	
	if(fdata[0] & 4) r += '<tr><td align="center" width="450" class=nickname>������������</td><td width="500" colspan="2"><select style="width:140px" size="1" name="blockt" class=LogintextBox6><option selected value="">�����</option><option value="1">�������������</option><option value="2">��������������</option></select><input type=text class=LogintextBox4 name=block title="�������"></td></tr>';	
	
	if(fdata[0] & 8) r += '<tr><td align="center" width="450" class=nickname>�������</td><td><input type=button class=lbut value="������� �� �����" onclick="if (confirm(\'�������?\'))location = \'/ipers.php?p='+fdata[1]+'&no_watch=yes&watch_menu=yes&clan_go_out=1\'"></td></tr>';
	
	if(fdata[0] & 16) r += '<tr><td align="center" width="450" class=nickname>��������</td><td width="500" colspan="2"><select style="width:140px" size="1" name="verif" class=LogintextBox6><option selected value="">�����</option><option value="1">�������� ��������</option><option value="2">�������� �������� (�������)</option><option value="3">�������� �� ��������</option></select><input type=text class=LogintextBox4 name=verifr title="�������"></td></tr>';
	
	if(fdata[0] & 32) r += '<tr><td align="center" width="450" class=nickname>������� ���������</td><td><input type=button class=lbut value="�������" onclick="if(confirm(\'�������?\'))location = \'/ipers.php?p='+fdata[1]+'&no_watch=yes&watch_menu=yes&wear_out=1\'"></td></tr>';
	
	if(fdata[0] & 64) r += '<tr><td align="center" width="450" class=nickname>�������� � ������</td><td><input type=button class=lbut  value="���������������" onclick="location = \'/ipers.php?p='+fdata[1]+'&no_watch=yes&watch_menu=yes&mprision=1\'" style="width:90%"></td></tr>';
	
	if(fdata[0] & 128) r += '<tr><td align="center" width="450" class=nickname>�������</td><td><input type=text class=LogintextBox4 name=pometka></td></tr>';
	
	if(fbut == '���������' || fbut == '�������������') r += '<tr><td align="center" width="450" class=nickname>������ ��</td><td><input type=button class=lbut value="���� ������" onclick="location = \'/ipers.php?p='+fdata[1]+'&no_watch=yes&watch_menu=yes&give_buttons=1\'"><input type=button class=lbut value="������� ������" onclick="location = \'/ipers.php?p='+fdata[1]+'&no_watch=yes&watch_menu=yes&give_buttons=2\'"><input type=button class=lbut value="���� ������ � ������" onclick="location = \'/ipers.php?p='+fdata[1]+'&no_watch=yes&watch_menu=yes&give_buttons=3\'"><input type=button class=lbut value="������� ������ � ������" onclick="location = \'/ipers.php?p='+fdata[1]+'&no_watch=yes&watch_menu=yes&give_buttons=4\'"><input type=button class=lbut value="���� ����� �������" onclick="location = \'/ipers.php?p='+fdata[1]+'&no_watch=yes&watch_menu=yes&give_buttons=5\'"></td></tr>';
																													
		
	if(fdata[0] & 256) r += '<tr><td align="center" width="450" class=nickname>�������� �� ����</td><td><input type=button class=lbut  value="��������" onclick="location = \'/ipers.php?p='+fdata[1]+'&no_watch=yes&watch_menu=yes&bugoff=1\'" style="width:15%"></td></td></tr>';
	
	if(fdata[0] & 1) r += '<tr><td align="center" width="450" class=nickname>�������� �� ���</td><td><input type=button class=lbut  value="��������" onclick="location = \'/ipers.php?p='+fdata[1]+'&no_watch=yes&watch_menu=yes&fightoff=1\'" style="width:15%"></td></td></tr>';
	
	document.write('<table cellpadding="0" cellspacing="3" border="0"><form method="post" action="?p='+fdata[1]+'&no_watch=yes&watch_menu=yes">'+r+'<tr><td colspan="2" align="center"><input type="submit" class="lbut" value="���������"></td></tr></form></table>');
}