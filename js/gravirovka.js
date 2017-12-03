function closeopengrav(idfor)
{
    document.all(idfor).style.visibility="hidden";
    document.all(idfor).innerHTML = '<img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1>';
    top.frames['ch_buttons'].document.FBT.text.focus();
}

function opengrav(idfor,gruid,grmaxlen,grmoney,vcode) 
{
    top.frames['ch_buttons'].document.FBT.text.focus();
    document.all(idfor).innerHTML = '<form action=main.php method=POST><input type=hidden name=post_id value="14"><input type=hidden name=gruid value="'+gruid+'"><input type=hidden name=grmaxlen value="'+grmaxlen+'"><input type=hidden name=grmoney value="'+grmoney+'"><input type=hidden name=vcode value="'+vcode+'"><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#B9A05C><table cellpadding=3 cellspacing=1 border=0 width=100%><tr><td width=100% bgcolor=#FCFAF3><font class=nickname><b>Гравировка ('+grmoney+' LR)</b></font></div></td></tr><tr><td bgcolor=#FCFAF3><font class=nickname><b>Текст:</b> <INPUT TYPE="text" name=gravtxt class=LogintextBox maxlength='+grmaxlen+'> <input type=submit value="ок" class=lbut> <input type=button class=lbut onclick="closeopengrav(\''+idfor+'\')" value="x"></td></tr></table></td></tr></table></FORM>';
    document.all(idfor).style.visibility = "visible";
    document.all("gravtxt").focus();
}