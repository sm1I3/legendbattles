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
            if (addr[0] == 'click') {
                buts += '<td><div id="use_it"><a href="javascript:void(0);" id="use_it" onclick="' + addr[1] + '">Ок</a></div></td>'
            }
            else if (addr[0] == 'href') {
                buts += '<td><div id="use_it"><a href="javascript:void(0);" id="use_it" onclick="d.location=\'' + addr[1] + '\'">Ок</a></div></td>'
            }
        }
        else if (buttons[a] == 'cancel') {
            buts += '<td><div id="use_cancel"><a href="javascript:void(0);" id="use_cancel" onclick="close_window();">Нет</a></div></td>'
        }
        else if (buttons[a] == 'ereage') {
            buts += '<td><div id="ereage"><a href="?" id="ereage">Ок</a></div></td>'
        }
		else if (buttons[a]=='ok') {

			addr = address.split('|');
            if (addr.length > 1 && addr[0] == 'click') {
                buts += '<td><div id="use_ok"><a href="javascript:void(0);" id="use_ok" onclick="' + addr[0] + '">Ок</a></div></td>'
            }
			else {
                buts += '<td><div id="use_ok"><a href="javascript:void(0);" id="use_ok" onclick="close_window();">Ок</a></div></td>'
            }

	    }
	}
	buts += '</tr></table>';
	d.getElementById('popup').innerHTML = '<table width=100% height=100% border=0><tr><td align=center valign=middle style="padding-left:5px;"><table style="vertical-align:top;" bgcolor="#fdeaa8" cellspacing="0" cellpadding=0><tr height=5><td width=5 style="background-image:url(/interface/priroda1.gif); background-repeat:no-repeat;"></td><td style="background-image:url(/interface/priroda2.gif); background-repeat:repeat-x;"></td><td width=5 style="background-image:url(/interface/priroda3.gif); background-repeat:no-repeat;"></td></tr><tr><td width=5 style="background-image:url(/interface/priroda8.gif); background-repeat:repeat-y;"></td>'+
'<td valign="top" style="padding:5px;" id="popup_content"><center><font style="font-size:14px; font-weight:900; color:'+font+';">'+header+'</font></center><div style="font-size:12px; padding-top:5px; padding-bottom:5px;">'+message+'</div><center>'+buts+'</center></td><td width=5 style="background-image:url(/interface/priroda4.gif); background-repeat:repeat-y;"></td></tr><tr height=5><td width=5 style="background-image:url(/interface/priroda7.gif); background-repeat:no-repeat;"></td><td style="background-image:url(/interface/priroda6.gif); background-repeat:repeat-x;"></td><td width=5 style="background-image:url(/interface/priroda5.gif); background-repeat:no-repeat;"></td></tr></table></td></tr></table>';
}

function close_window () {
	d.getElementById('popup').style.display = 'none';
	d.getElementById('back').style.display = 'none';
}

