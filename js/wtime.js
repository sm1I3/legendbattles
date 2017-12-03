var curTimeFor;
var curTimeInt;
var ActionFormUse;

function wtime(tfor)
{
       curTimeFor = tfor+1;
       curTimeInt = setInterval("wchan()",1000);
}

function wchan()
{
       if(curTimeFor>0)
       {
              document.all("wtime").innerHTML = '<i>Выполняется действие... Еще '+curTimeFor+' сек...</i>';
	      curTimeFor = curTimeFor - 1;
       }
       else
       {
              clearInterval(curTimeInt);
	      document.all("wtime").innerHTML = '<i>Подождите... Идет <a href=main.php>обновление</a> экрана...</i>';
	      window.location = "main.php";
       }
}

function close_fight_map()
{
       document.all("mapf").style.visibility="hidden";
       document.all("mapf").innerHTML = '<img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1>';
       parent.frames['ch_buttons'].document.FBT.text.focus();
       ActionFormUse='';
}

function fight_map(vcode)
{
       parent.frames['ch_buttons'].document.FBT.text.focus();
       document.all("mapf").innerHTML = '<form action=main.php method=POST><input type=hidden name=post_id value="8"><input type=hidden name=vcode value='+vcode+'><table cellpadding=0 cellspacing=0 border=0 width=400><tr><td bgcolor=#B9A05C><table cellpadding=3 cellspacing=1 border=0 width=100%><tr><td width=100% bgcolor=#FCFAF3><font class=nickname><b>Нападение на природе</b></div></td></tr><tr><td bgcolor=#FCFAF3><font class=nickname><b>На кого:</b> <INPUT TYPE="text" name=pnick class=LogintextBox maxlength=20> <input type=submit value="Выполнить" class=lbut> <input type=button class=lbut onclick="close_fight_map()" value="Отмена"></td></tr></table></td></tr></table></FORM>';
       document.all("mapf").style.visibility = "visible";
       document.all("pnick").focus();
       ActionFormUse = 'pnick';
}