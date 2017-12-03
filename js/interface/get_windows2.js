d = document;
window.timer;
window.onerror=null;
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
	buts = '<table class="coll w100 mar user_info"><tr>';
	for (a=0,b=buttons.length;a<b;a++){

		    if (buttons[a]=='accept') {
			addr = address.split('|');
			if (addr[0]=='click') {buts += '<td align=center><div id="use_it"><a href="javascript:void(0);" id="use_it" onclick="'+addr[1]+'"><input type=button class=butloc value="ÏÐÈÌÅÍÈÒÜ" style="width:120;" border=0></a></div></td>'}
			else if (addr[0]=='href') {	buts += '<td align=center><div id="use_it"><a href="javascript:void(0);" id="use_it" onclick="d.location=\''+addr[1]+'\'"><input type=button class=butloc value="ÏÐÈÌÅÍÈÒÜ" style="width:120;" border=0></a></div></td>' }
		    }
		    else if (buttons[a]=='cancel') { buts += '<td align=center><div id="use_cancel"><a href="javascript:void(0);" id="use_cancel" onclick="close_window();"><input type=button class=butloc value="ÎÒÌÅÍÀ" style="width:120;" border=0></a></div></td>' }
		    else if (buttons[a]=='ereage') {buts += '<td align=center><div id="ereage"><a href="?" id="ereage" onclick="close_window();"><input type=button class=butloc value="ÎÊ" style="width:120;" border=0></a></div></td>'}
		    else if (buttons[a]=='ok') { //buts += '<td><div id="use_ok"><a href="javascript:void(0);" id="use_ok" onclick="close_window();"></a></div></td>' }

			addr = address.split('|');
			if (addr.length>1 && addr[0]=='click') {
			buts += '<td align=center><div id="use_ok"><a href="javascript:void(0);" id="use_ok" onclick="'+addr[0]+'"><img src=interface/ok.gif border=0></a></div></td>' }
			else {			buts += '<td align=center><div id="use_ok"><a href="javascript:void(0);" id="use_ok" onclick="close_window();"><input type=button class=butloc value="ÎÊ" style="width:120;" border=0></a></div></td>'}
	    }
	}
	buts += '</tr></table>';
    if (header>''){head_tem = '<font style="font-size:14px; font-weight:900; color:FFFFFF;">'+header+'</font>';
   }else{ head_tem = '';}
   d.getElementById('popup').innerHTML ='<table width=100% height=100% border=0><tr><td align=center valign=middle style="padding-left:5px;">'+head_tem+'<table class="lbut" width=300 height=300><tr><td class="tbl l b" bgcolor="#F5F5F5">'+message+'<center style="width:600px;">'+buts+'</center></table></table></tr></td>';

}

function close_window () {
	d.getElementById('popup').style.display = 'none';
	d.getElementById('back').style.display = 'none';
}

