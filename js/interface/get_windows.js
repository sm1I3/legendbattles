d = document;
window.timer;

function message_window (type,header,message,buttons,address) {
	d.getElementById('popup').style.display = '';
	d.getElementById('back').style.width = '100%';
	d.getElementById('back').style.height = d.body.scrollHeight+'px';
	d.getElementById('popup').style.width = '100%';
	d.getElementById('popup').style.height = '100%';
	d.getElementById('back').style.display = '';
	d.getElementById('popup').style.top = d.body.scrollTop;

	if (type=='alert') { font = '#AA0000' }
	else if (type=='success') { font = '#009900' }
	else if (type=='confirm') { font = '#333333' }
	else if (type=='ereage') { font = '#009900' }

	buttons = buttons.split('|');
	buts = '<table border=0><tr>';
	for (a=0,b=buttons.length;a<b;a++){

		if (buttons[a]=='accept') {
			addr = address.split('|');
			if (addr[0]=='click') {buts += '<td><div id="use_it"><a href="javascript:void(0);" id="use_it" onclick="'+addr[1]+'"><img src=interface/prim.gif border=0></a></div></td>'}
			else if (addr[0]=='href') {	buts += '<td><div id="use_it"><a href="javascript:void(0);" id="use_it" onclick="d.location=\''+addr[1]+'\'"><img src=interface/prim.gif border=0></a></div></td>' }
		}
		else if (buttons[a]=='cancel') { buts += '<td><div id="use_cancel"><a href="javascript:void(0);" id="use_cancel" onclick="close_window();"><img src=interface/cancel.gif border=0></a></div></td>' }
		else if (buttons[a]=='ereage') {buts += '<td><div id="ereage"><a href="?" id="ereage"><img src=interface/ok.gif></a></div></td>'}
		else if (buttons[a]=='ok') { //buts += '<td><div id="use_ok"><a href="javascript:void(0);" id="use_ok" onclick="close_window();"></a></div></td>' }

			addr = address.split('|');
			if (addr.length>1 && addr[0]=='click') { buts += '<td><div id="use_ok"><a href="javascript:void(0);" id="use_ok" onclick="'+addr[0]+'"><img src=interface/ok.gif border=0></a></div></td>' }
			else {
			//buts += '<td><div id="use_ok"><a href="?" id="use_ok"><img src=interface/ok.gif></a></div></td>' }
			  buts += '<td><div id="use_ok"><a href="javascript:void(0);" id="use_ok" onclick="close_window();"><img src=interface/ok.gif></a></div></td>' }

	    }
	}
	buts += '</tr></table>';
	d.getElementById('popup').innerHTML = '<table width=100% height=100% border=0><tr><td align=center valign=middle style="padding-left:5px;"><table style="vertical-align:top;" background="http://img.legendbattles.ru/images/bg2.gif" cellspacing="0" cellpadding=0><tr height=5><td width=5 style="background-image:url(/interface/priroda1.gif); background-repeat:no-repeat;"></td><td style="background-image:url(/interface/priroda2.gif); background-repeat:repeat-x;"></td><td width=5 style="background-image:url(/interface/priroda3.gif); background-repeat:no-repeat;"></td></tr><tr><td width=5 style="background-image:url(/interface/priroda8.gif); background-repeat:repeat-y;"></td>'+
'<td valign="top" style="padding:5px;" id="popup_content"><center><font style="font-size:14px; font-weight:900; color:'+font+';">'+header+'</font></center><div style="font-size:12px; padding-top:5px; padding-bottom:5px;">'+message+'</div><center>'+buts+'</center></td><td width=5 style="background-image:url(/interface/priroda4.gif); background-repeat:repeat-y;"></td></tr><tr height=5><td width=5 style="background-image:url(/interface/priroda7.gif); background-repeat:no-repeat;"></td><td style="background-image:url(/interface/priroda6.gif); background-repeat:repeat-x;"></td><td width=5 style="background-image:url(/interface/priroda5.gif); background-repeat:no-repeat;"></td></tr></table></td></tr></table>';
}

function close_window () {
	d.getElementById('popup').style.display = 'none';
	d.getElementById('back').style.display = 'none';
}

function send_out (user) { message_window ('confirm','���������� ���������','�� ������������� ������ ������� ��������� <b>'+user+'</b> �� ������?','accept|cancel','href|main.php?go_out='+user+'&gopers=clan&action=addon') }
function sended_out (user) { message_window ('success','�������� ��������','�������� <b>'+user+'</b> �������� �� ������� ������.<br>� ������ ����� ������� <b>200 <img src=images/money.gif></b>.','ok','') }
function got_in (user) { message_window ('success','�������� ������','�������� <b>'+user+'</b> ������ � ������ ������.<br>� ������ ����� ������� <b>200 <img src=images/money.gif></b>.','ok','') }
function new_head (user) { message_window ('success','����� �����','�������� <b>'+user+'</b> ������� �������� �� ��������� ����� ������.','ok','') }
function sell_give (user) { message_window ('success','�������','�� ������ ������ <b>'+info[0]+'</b>.','ok','') }
function proc_error (number) {
	switch (number) {
		case 1: text = '������ ��������� �� ����������.'; break;
		case 2: text = '������ ��������� �� ���������� ��� <br>�������� ��������� � ������ ������.'; break;
		case 3: text = '�������� �� ��������� � ������.'; break;
		default: text = '����������� ������. �������� ������� �����.'; break;
	}
	message_window ('alert','������!',text,'ok','');
}

function init_timer (time) {
	//info = time.split('|');
	var info = time;
	//window.timer = parseInt(info[0]);
	message_window ('success','������������',info[1]+'','ok','');//click|javascript:void()
	//work_timer ();
}

function work_timer () {
	if (window.timer>0) {
		document.getElementById("internal_timer").innerHTML = '<center> ��� '+window.timer+' ���.</center>';
		window.timer = window.timer - 1;
		setTimeout("work_timer ("+window.timer+");",1000);
	}
	else {
		close_window();
	}
}

// ������
//�����, ������
function b0_help() {
		text = '<div style="width:450px;"><p align=justify>� ����� �������� ����� ������ ��� �����������, ������� ���������� ��� ����� �����.<br>&bull; <b>�����������</b> ��������� ��� ����� ����� � ��������� ������������ �������<br>&bull; <b>������</b> ���������� ��� ������������ �������� ����������� ��� �����<br>&bull; <b>������� ��� �����</b> ���������� ����� ������� ������� ������������ �����<br>&bull; <b>������� ��� �������</b> ���������� ��������� - ��� �������� ������� � ������� �������� �����.</div>';
		message_window ('success','����� ��������',text,'ok','');
}
//�����, 1-� ����
function b1_help() {
		text = '<div style="width:450px;"><p align=justify>&bull; <b>������ ��������:</b> ����� �� ������ ��������� ������������ ������/������� ��������, ���� ��� ����/����� ������ �����.<br>&bull; <b>����� ��������:</b> ����� �� ������ ��������� ���� ������� �� �������, �� ������ ��� ����, ��������� ��� ������ �������.</div>';
		message_window ('success','�����, 1-� ����',text,'ok','');
}
//�����, 2-� ����
function b3_help() {
		text = '<div style="width:450px;"><p align=justify>� ����� �������� ����� ������ ��� �����������, ������� ���������� ��� ����� �����.<br>&bull; <b>�����������</b> ��������� ��� ����� ����� � ��������� ������������ �������<br>&bull; <b>������</b> ���������� ��� ������������ �������� ����������� ��� �����<br>&bull; <b>������� ��� �����</b> ���������� ����� ������� ������� ������������ �����<br>&bull; <b>������� ��� �������</b> ���������� ��������� - ��� �������� ������� � ������� �������� �����.</div>';
		message_window ('success','����� ��������',text,'ok','');
}

//�����, 3-� ����
function b3_help() {
		text = '<div style="width:450px;"><p align=justify>� ����� �������� ����� ������ ��� �����������, ������� ���������� ��� ����� �����.<br>&bull; <b>�����������</b> ��������� ��� ����� ����� � ��������� ������������ �������<br>&bull; <b>������</b> ���������� ��� ������������ �������� ����������� ��� �����<br>&bull; <b>������� ��� �����</b> ���������� ����� ������� ������� ������������ �����<br>&bull; <b>������� ��� �������</b> ���������� ��������� - ��� �������� ������� � ������� �������� �����.</div>';
		message_window ('success','�����',text,'ok','');
}
//����� ��������
function celitel_1() {
		text = '<div style="width:450px;"><p align=justify>� ������ �������� ����� ������ ��� �����������, ������� ���������� ��� ����� �����.<br>&bull; <b>�����������</b> ��������� ��� ����� ����� � ��������� ������������ �������<br>&bull; <b>������</b> ���������� ��� ������������ �������� ����������� ��� �����<br>&bull; <b>������� ��� �����</b> ���������� ����� ������� ������� ������������ �����<br>&bull; <b>������� ��� �������</b> ���������� ��������� - ��� �������� ������� � ������� �������� �����.</div>';
		message_window ('success','������ ��������',text,'ok','');
}
//�������, �������� ����������
function taverna_2() {
		text = '<div style="width:450px;"><p align=justify>� ���� ������� �� ������� ��������� ���� ��������� � ������ � ������� ����������. <br>&bull; ��������: ���� � ��������.<br> ��������� ��������� ������ ���������: 50 <img src=images/money.gif>.</div>';
		message_window ('success','���������� �������',text,'ok','');
}
//�������, �������� ������
function taverna_3() {
		text = '<div style="width:450px;"><p align=justify>� ���� ������� �� ������� ��������� ���� ������ ������ � ������ � ������� ����������. <br>&bull; ��������: �������� ������ �� �������� ������.<br> ��������� ��������� ������ ������: 50 <img src=images/money.gif>.</div>';
		message_window ('success','������� �����',text,'ok','');
}
// �����
function city() {
		text = '<div style="width:450px;"><p align=justify><b> ������ ������� :</b> ���������� ����� � ������ ����� ������������ ������, � ������� ����� �����.<br><b> ������ ����������� : </b>���������� ��������� ��� ��������� �����<br>&bull; <b><i> ��� ����������� �� ������ � ���� � ������, �������� �� ������ ��� ������, ��� �������� ������ �� ��������. </b></i></div>';
		message_window ('success','�����(�����)',text,'ok','');
}
// ����� ��������
function pr_shop() {
		text = '<div style="width:450px;"><p align=justify> ���������� ����� ��� ����, ��������� ������� � ������� ����� � �������.</div>';
		message_window ('success','���������� �����',text,'ok','');
}
// ������ ��� �������� �����
function help_map() {
		text = '<div style="width:450px;"><p align=justify> <b>���������: ���������� ������ �� ��� ���� ������ ��������:</b><br /><font color="#d60000"><b>������� - ������� ��������������.</b></font><br /><font color="#600000"><b>Ҹ���-������� - ����� ����������.</b></font><br /><font><b>���������� - �������� ������������. </b></font> <br /> ��� ����� ��������, ���� �� �� ���������� � ����� ������ ��, ��� ��� �����. ��� �������� ��������������� ���������, ������ ����� �����.</div>';
		message_window ('success','��������� ���������',text,'ok','');
}

// ����� 1
function mine1() {
		text = '<div style="width:450px;"><p align=justify> <b>���������: ���������� ������ �� ��� ���� ������ ��������:</b><br /><font color="#d60000"><b>������� - ������� ��������������.</b></font><br /><font color="#600000"><b>Ҹ���-������� - ����� ����������.</b></font><br /><font><b>���������� - �������� ������������. </b></font> <br /> ��� ����� ��������, ���� �� �� ���������� � ����� ������ ��, ��� ��� �����. ��� �������� ��������������� ���������, ������ ����� �����.</div>';
		message_window ('success','��������� ���������',text,'ok','');
}