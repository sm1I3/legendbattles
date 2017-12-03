var ActionFormUse;
function closesellingform()
{
	document.all('transfer').style.visibility = 'hidden';
	document.all('transfer').innerHTML = '<img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1>';
	parent.frames['ch_buttons'].document.FBT.text.focus();
	ActionFormUse = '';
}

function sellingform(wuid,wnametxt,wtcode,wwprice,wmas,wsellst) 
{
       parent.frames['ch_buttons'].document.FBT.text.focus();
       var add_info;
    if (wsellst == 1) add_info = 'Вы можете вести торговые операции.';
    else add_info = 'Вы не можете проводить торговые операции, кроме продажи вещей торговцам.';
    add_ext = '<br><img src="http://img.legendbattles.ru/image/gold.png" width="14" height="14" valign="middle" title="Золото"><input type=text name=gold style="width: 60;"><img src="http://img.legendbattles.ru/image/silver.png" width="14" height="14" valign="middle" title="Золото"><input type=text name=silver style="width: 60;"><img src="http://img.legendbattles.ru/image/bronze.png" width="14" height="14" valign="middle" title="Золото"><input type=text name=bronze style="width: 60;">';
    document.all('transfer').innerHTML = '<form action=main.php method=POST><input type=hidden name=post_id value="0"><input type=hidden name=sellingnametxt value="' + wnametxt + '"><input type=hidden name=sellprice value="' + wwprice + '"><input type=hidden name=wsellst value="' + wsellst + '"><input type=hidden name=wmas value="' + wmas + '"><input type=hidden name=selluid value=' + wuid + '><input type=hidden name=vcode value=' + wtcode + '><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#B9A05C><table cellpadding=3 cellspacing=1 border=0 width=100%><tr><td width=100% bgcolor=#FCFAF3><font class=nickname><b>Продать "' + wnametxt + '"?</b><br><font class=freetxt>' + add_info + '</font></div></td></tr><tr><td bgcolor=#FCFAF3><font class=nickname><b>Кому:</b> <INPUT TYPE="text" name=fornickname class=LogintextBox  maxlength=25> <b>Цена:</b>' + add_ext + ' <input type=submit value="продать" class=lbut> <input type=button class=lbut onclick=\"closesellingform()\" value=\" x \"></td></tr></table></td></tr></table></FORM>';
       document.all('transfer').style.visibility = 'visible';
       document.all('fornickname').focus();
       ActionFormUse = 'fornickname';
}

function sellingmassform(wuid,wnametxt,wtcode,wwprice,wmas,wsellst) 
{
       parent.frames['ch_buttons'].document.FBT.text.focus();
       var add_info;
    if (wsellst == 1) add_info = 'Вы можете вести торговые операции.';
    else add_info = 'Вы не можете проводить торговые операции, кроме продажи вещей торговцам.';
    add_ext = '<br><img src="http://img.legendbattles.ru/image/gold.png" width="14" height="14" valign="middle" title="Золото"><input type=text name=gold style="width: 60;"><img src="http://img.legendbattles.ru/image/silver.png" width="14" height="14" valign="middle" title="Золото"><input type=text name=silver style="width: 60;"><img src="http://img.legendbattles.ru/image/bronze.png" width="14" height="14" valign="middle" title="Золото"><input type=text name=bronze style="width: 60;">';
    document.all('transfer').innerHTML = '<form action=main.php method=POST><input type=hidden name=post_id value="101"><input type=hidden name=sellingnametxt value="' + wnametxt + '"><input type=hidden name=sellprice value="' + wwprice + '"><input type=hidden name=wsellst value="' + wsellst + '"><input type=hidden name=wmas value="' + wmas + '"><input type=hidden name=selluid value=' + wuid + '><input type=hidden name=vcode value=' + wtcode + '><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#B9A05C><table cellpadding=3 cellspacing=1 border=0 width=100%><tr><td width=100% bgcolor=#FCFAF3><font class=nickname><b>Продать "' + wnametxt + '"?</b><br><font class=freetxt>' + add_info + '</font></div></td></tr><tr><td bgcolor=#FCFAF3><font class=nickname><b>Кому:</b> <INPUT TYPE="text" name=fornickname class=LogintextBox  maxlength=25> <b>Цена (за 1 шт):</b> ' + add_ext + ' <input type=submit value="продать" class=lbut> <input type=button class=lbut onclick=\"closesellingform()\" value=\" x \"></td></tr></table></td></tr></table></FORM>';
       document.all('transfer').style.visibility = 'visible';
       document.all('fornickname').focus();
       ActionFormUse = 'fornickname';
}