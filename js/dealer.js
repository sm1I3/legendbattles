var ActionFormUse;
function c_form()
{
	document.all("transfer").style.visibility="hidden";
	document.all("transfer").innerHTML = '<img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1>';
	top.frames['ch_buttons'].document.FBT.text.focus();
	ActionFormUse='';
}

function m_form(vcode)
{
	top.frames['ch_buttons'].document.FBT.text.focus();
	var waddbl='';
	waddbl=' <b>�����:</b> <font class=freetxt>(�����)</font> <input type=text name=sum class=LogintextBox2>';
	document.all("transfer").innerHTML = '<FORM action=main.php method=POST><input type=hidden name=post_id value=42><input type=hidden name=vcode value='+vcode+'><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#B9A05C><table cellpadding=3 cellspacing=1 border=0 width=100%><tr><td width=100% bgcolor=#FCFAF3><font class=nickname><b>�������� �������� ������� (DNV)</b></div></td></tr><tr><td bgcolor=#FCFAF3><font class=nickname><b>����:</b> <INPUT TYPE="text" name=fnick class=LogintextBox maxlength=25> <b>�����:</b> <font class=freetxt>(�����)</font> <input type=text name=sum class=LogintextBox2> <input type=submit value="��������" class=lbut> <input type=button class=lbut onclick=\"c_form()\" value=\" x \"></td></tr></table></td></tr></table></FORM>';
	document.all("transfer").style.visibility = "visible";
	document.all("fnick").focus();
	ActionFormUse='fnick';
}