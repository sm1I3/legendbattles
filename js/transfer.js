var ActionFormUse;
function close_f()
{
       document.all("transfer").style.visibility="hidden";
       document.all("transfer").innerHTML = '<img src=image/1x1.gif width=1 height=1>';
       parent.frames['ch_buttons'].document.FBT.text.focus();
       ActionFormUse = '';
}

function transferform(wuid,wtrprice,wnametxt,wtcode,wwprice,wmas,wcs,wms)
{
       parent.frames['ch_buttons'].document.FBT.text.focus();
       var waddbl = '';
       var waddpr = '';
       if(wuid == '0')
       {
           waddbl = ' <br><b>Сумма:</b> <font class=freetxt></font> <br><img src="http://img.legendbattles.ru/image/gold.png" width="14" height="14" valign="middle" title="Золото"><input type=text name=gold style="width: 60;"><img src="http://img.legendbattles.ru/image/silver.png" width="14" height="14" valign="middle" title="Золото"><input type=text name=silver style="width: 60;"><img src="http://img.legendbattles.ru/image/bronze.png" width="14" height="14" valign="middle" title="Золото"><input type=text name=bronze style="width: 60;">';
           waddpr = '<br><b>Причина перевода: </b><input type=text name=ttext class=LogintextBox6 maxlength=150 size=30>';
           document.all("transfer").innerHTML = '<form action=main.php method=POST><input type=hidden name=post_id value=22><input type=hidden name=transfernametxt value="' + wnametxt + '"><input type=hidden name=transferprice value="' + wtrprice + '"><input type=hidden name=wmas value="' + wmas + '"><input type=hidden name=wcs value="' + wcs + '"><input type=hidden name=wms value="' + wms + '"><input type=hidden name=transferuid value=' + wuid + '><input type=hidden name=vcode value=' + wtcode + '><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#B9A05C><table cellpadding=3 cellspacing=1 border=0 width=100%><tr><td width=100% bgcolor=#FCFAF3><font class=nickname><b>Передать "' + wnametxt + '"?</b> <font class=freetxt>(Одна Золотая = <b> 10000 Бронзы</b>)</font></div></td></tr><tr><td bgcolor=#FCFAF3><font class=nickname><b>Кому:</b> <INPUT TYPE="text" name=fornickname class=LogintextBox  maxlength=25>' + waddbl + ' <input type=submit value="передать" class=lbut> <input type=button class=lbut onclick=\"close_f()\" value=\" x \">' + waddpr + '</td></tr></table></td></tr></table></FORM>';
			document.all("transfer").style.visibility = "visible";
			document.all("fornickname").focus();
			ActionFormUse = 'fornickname';
		} 
		else if(wuid == '1')
		{
            waddbl = ' <b>Сумма:</b> <font class=freetxt></font> <input type=text name=sum class=LogintextBox2>';
            waddpr = '<br><b>Причина перевода: </b><input type=text name=ttext class=LogintextBox6 maxlength=150 size=40>';
            document.all("transfer").innerHTML = '<form action=main.php method=POST><input type=hidden name=post_id value=24><input type=hidden name=transfernametxt value="' + wnametxt + '"><input type=hidden name=transferprice value="' + wtrprice + '"><input type=hidden name=wmas value="' + wmas + '"><input type=hidden name=wcs value="' + wcs + '"><input type=hidden name=wms value="' + wms + '"><input type=hidden name=transferuid value=' + wuid + '><input type=hidden name=vcode value=' + wtcode + '><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#B9A05C><table cellpadding=3 cellspacing=1 border=0 width=100%><tr><td width=100% bgcolor=#FCFAF3><font class=nickname><b>Передать "' + wnametxt + '"?</b> <font class=freetxt>(коммисия: <b>' + wtrprice + ' Бронзы</b>)</font></div></td></tr><tr><td bgcolor=#FCFAF3><font class=nickname><b>Кому:</b> <INPUT TYPE="text" name=fornickname class=LogintextBox  maxlength=25>' + waddbl + ' <input type=submit value="передать" class=lbut> <input type=button class=lbut onclick=\"close_f()\" value=\" x \">' + waddpr + '</td></tr></table></td></tr></table></FORM>';
			   document.all("transfer").style.visibility = "visible";
			   document.all("fornickname").focus();
			   ActionFormUse = 'fornickname';		
		}
		else if(wuid == '2')
		{
            waddbl = '<b>Сумма:</b><font class=freetxt></font> <input type=text name=sum class=LogintextBox2>';
       	      waddpr = '';
            document.all("transfer").innerHTML = '<form action=main.php method=POST><input type=hidden name=post_id value=25><input type=hidden name=vcode value=' + wtcode + '><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#B9A05C><table cellpadding=3 cellspacing=1 border=0 width=100%><tr><td width=100% bgcolor=#FCFAF3><font class=nickname><b>Обменять "' + wnametxt + '" на Золото?</b> Золота. | курс: <b>1 <img src=http://img.legendbattles.ru/razdor/emerald.png width=14 height=14 valign=middle title=Золото> </b> = <b>25 <img src=http://img.legendbattles.ru/image/gold.png width=14 height=14 valign=middle title=Золото></b></font></div></td></tr><tr><td bgcolor=#FCFAF3><font class=nickname>' + waddbl + ' <input type=submit value="обменять" class=lbut> <input type=button class=lbut onclick=\"close_f()\" value=\" x \">' + waddpr + '</td></tr></table></td></tr></table></FORM>';
			document.all("transfer").style.visibility = "visible";
			document.all("fornickname").focus();
			ActionFormUse = 'fornickname';		
		}
       else{
	   waddbl = '<input type=hidden name=sum value="'+wwprice+'">';
           document.all("transfer").innerHTML = '<form action=main.php method=POST><input type=hidden name=post_id value=22><input type=hidden name=transfernametxt value="' + wnametxt + '"><input type=hidden name=transferprice value="' + wtrprice + '"><input type=hidden name=wmas value="' + wmas + '"><input type=hidden name=wcs value="' + wcs + '"><input type=hidden name=wms value="' + wms + '"><input type=hidden name=transferuid value=' + wuid + '><input type=hidden name=vcode value=' + wtcode + '><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#B9A05C><table cellpadding=3 cellspacing=1 border=0 width=100%><tr><td width=100% bgcolor=#FCFAF3><font class=nickname><b>Передать "' + wnametxt + '"?</b> <font class=freetxt>(коммисия: <b>' + wtrprice + ' Бронзы</b>)</font></div></td></tr><tr><td bgcolor=#FCFAF3><font class=nickname><b>Кому:</b> <INPUT TYPE="text" name=fornickname class=LogintextBox  maxlength=25>' + waddbl + ' <input type=submit value="передать" class=lbut> <input type=button class=lbut onclick=\"close_f()\" value=\" x \">' + waddpr + '</td></tr></table></td></tr></table></FORM>';
	   document.all("transfer").style.visibility = "visible";
       document.all("fornickname").focus();
       ActionFormUse = 'fornickname';
	   }
}

function ObnulForm(wuid,wnametxt,wtname,wtcode)
{
       parent.frames['ch_buttons'].document.FBT.text.focus();
       var waddbl = '';
       var waddpr = '';
            waddbl = '';
       	    waddpr = '';
    document.all("transfer").innerHTML = '<form action=main.php method=POST><input type=hidden name=post_id value=107><input type=hidden name=uid value=' + wuid + '><input type=hidden name=vcode value=' + wtcode + '><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#B9A05C><table cellpadding=3 cellspacing=1 border=0 width=100%><tr><td width=100% bgcolor=#FCFAF3><font class=nickname><b>Использовать "' + wtname + '"?</b></div></td></tr><tr><td bgcolor=#FCFAF3><input type=submit value="использовать" class=lbut> <input type=button class=lbut onclick=\"close_f()\" value=\" x \"></td></tr></table></td></tr></table></FORM>';
			document.all("transfer").style.visibility = "visible";
			document.all("fornickname").focus();
			ActionFormUse = 'fornickname';
}


function presentform(wuid,wnametxt,wtcode,wmas,wnv,wcs,wms)
{
       parent.frames['ch_buttons'].document.FBT.text.focus();
    document.all("transfer").innerHTML = '<form action=main.php method=POST><input type=hidden name=presentstart value="1"><input type=hidden name=post_id value=23><input type=hidden name=presentnametxt value="' + wnametxt + '"><input type=hidden name=wmas value="' + wmas + '"><input type=hidden name=presentnv value="' + wnv + '"><input type=hidden name=presentuid value=' + wuid + '><input type=hidden name=wcs value="' + wcs + '"><input type=hidden name=wms value="' + wms + '"><input type=hidden name=vcode value=' + wtcode + '><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#B9A05C><table cellpadding=3 cellspacing=1 border=0 width=100%><tr><td width=100% bgcolor=#FCFAF3><font class=nickname><b>Подарить "' + wnametxt + '"?</b></font></div></td></tr><tr><td bgcolor=#FCFAF3><font class=nickname><b>Кому:</b> <INPUT TYPE="text" name=fornickname class=LogintextBox  maxlength=25> <input type=submit value="подарить" class=lbut> <input type=button class=lbut onclick=\"close_f()\" value=\" x \"></td></tr></table></td></tr></table></FORM>';
       document.all("transfer").style.visibility = "visible";
       document.all("fornickname").focus();
       ActionFormUse = 'fornickname';
}

useactions = function(usetype){
    parent.$('#basic-modal-content').html('<iframe src="http://legendbattles.ru/gameplay/ajax/addons-action.php" id="useaction" name="useaction" scrolling="auto" style="width:800px;height:600px;" frameborder="0"></iframe>');
    parent.ShowModal();
}