<? 
$dat_arr = getdate( time() );
$time = "hour=".$dat_arr['hours']."&min=".$dat_arr['minutes']."&sec=".$dat_arr['seconds'];
?>
<HTML>
<META Content="text/html; Charset=windows-1251" Http-Equiv=Content-type>
<META Http-Equiv=Cache-Control Content=No-Cache>
<META Http-Equiv=Pragma Content=No-Cache>
<META Http-Equiv=Expires Content=0>
<HEAD>
<LINK href="../ch/button.css" rel=STYLESHEET type=text/css>
<SCRIPT LANGUAGE="JavaScript" src="../ch/ch_but.js"></SCRIPT>
<SCRIPT>
function reset_length()
{
       var size = window.document.body.clientWidth - 531
       if(size < 100) size = 100;
       window.document.FBT.text.size = 2*size/13;
       window.document.all('INPT').width = size;
}
window.onresize = reset_length;
</SCRIPT>
</HEAD>
<BODY LeftMargin=0 TopMargin=0 MarginHeight=0 MarginWidth=0 BgColor=#FFFFFF OnLoad="reset_length();status='NeverLands - Come as you are.'">
<FORM action="../ch.php" target="ch_refr" method=POST name="FBT" onSubmit="submit_msg();top.ch_refresh_n();">
<TABLE cellSpacing="0" cellPadding="0" width="100%" border="0" height="30" background="http://img.LegendBattles.ru/image/chat/main_bg.gif">
       <TR>
       <TD background=http://img.LegendBattles.ru/image/chat/1bg.gif><input type=submit name=sbmsg style="display:none"><INPUT TYPE="hidden" name="fyo" value=""><INPUT TYPE="hidden" name="lmid" value=""><img src=http://img.LegendBattles.ru/image/chat/spacer.gif width=5 height=30 border=0 align=absmiddle></TD>
       <TD background=http://img.LegendBattles.ru/image/chat/1bg.gif class=action_text align=absmiddle><input type=checkbox name=pactiondo value="1"></td><td background=http://img.LegendBattles.ru/image/chat/1bg.gif class=action_text>Действие</TD>
       <TD width=75 height=30><img src=http://img.LegendBattles.ru/image/chat/1_1.gif width=75 height=30 border=0 title="Сказать:" align=absmiddle></TD>
       <TD id=INPT background=http://img.LegendBattles.ru/image/chat/fbg.gif align=absmiddle><input name=text type=text class=chat_forma size=80 maxlength=250 onKeyUp="if ((event.ctrlKey) && ((event.keyCode==10) || (event.keyCode==13))) { document.FBT.sbmsg.click() }"></TD>
       <TD width=6 height=30><img src=http://img.LegendBattles.ru/image/chat/1_2.gif width=6 height=30 border=0 align=absmiddle></TD>
       <TD width=23 height=30><img src=http://img.LegendBattles.ru/image/chat/b1.gif width=23 height=30 border=0 class=chatpostbut align=absmiddle title="Отправить сообщение" onClick="document.FBT.sbmsg.click()"></TD>
       <TD width=19 height=30><img src=http://img.LegendBattles.ru/image/chat/b2.gif width=19 height=30 border=0 align=absmiddle class=chatpostbut onClick="top.clr_input();" title="Очистить поле ввода"></TD>
       <TD width=11 height=30><img src=http://img.LegendBattles.ru/image/chat/b3.gif width=11 height=30 border=0 align=absmiddle class=chatpostbut onClick="smile_open('');" title="Смайлы №1"></td><td width=10 height=30><img src=http://img.LegendBattles.ru/image/chat/b4.gif width=10 height=30 border=0 align=absmiddle class=chatpostbut onClick="smile_open('2');" title="Смайлы №2"></TD>
       <TD width=15 height=30><img src=http://img.LegendBattles.ru/image/chat/1_3.gif width=15 height=30 border=0 align=absmiddle></TD>
              <TD width=30 height=30><img src=http://img.LegendBattles.ru/image/chat/bb1.gif width=30 height=30 border=0 align=absmiddle class=chatpostbut onClick="top.ch_refresh();" title="Обновить окно чата"></TD>
       <TD width=30 height=30><img src=http://img.LegendBattles.ru/image/chat/bb2.gif width=30 height=30 border=0 align=absmiddle class=chatpostbut onClick="top.clr_chat();" title="Очистить окно чата"></TD>
       <TD width=30 height=30><img src=http://img.LegendBattles.ru/image/chat/bb3_all.gif width=30 height=30 border=0 align=absmiddle class=chatpostbut onClick="top.change_chatsetup();" name=schat title="Режим чата (Показывать все сообщения)"></TD>
       <TD width=30 height=30><img src=http://img.LegendBattles.ru/image/chat/bb_10.gif width=30 height=30 border=0 align=absmiddle class=chatpostbut onClick="top.change_chatspeed();" name=spchat title="Скорость обновления (раз в 10 секунд)"></TD>
       <TD width=30 height=30><img src=http://img.LegendBattles.ru/image/chat/bb4_nc.gif width=30 height=30 border=0 align=absmiddle class=chatpostbut name=lrchat onClick="top.change_latrus();" title="LAT <-> RUS (Транслит выключен)"></TD>
       <TD height=30 width=145>
       <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="145" height="30" id="fma" align="middle">
<param name="allowScriptAccess" value="sameDomain" />
<param name="movie" value="http://img.LegendBattles.ru/image/flash/clock.swf?<?=$time?>"/>
<param name="quality" value="high" />
<param name="bgcolor" value="#ffffff" />
<embed src="http://img.LegendBattles.ru/image/flash/clock.swf?<?=$time?>" quality="high" bgcolor="#ffffff" width="145" height="30" name="clock" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>
	   </TD>
       <TD width=26 height=30><img src=http://img.LegendBattles.ru/image/chat/ab3.gif width=26 height=30 border=0 align=absmiddle class=chatpostbut onClick="use_action('addon-action');" title="Возможности игрока"></TD>
       <TD width=26 height=30><img src=http://img.LegendBattles.ru/image/chat/spacer.gif width=126 height=30 border=0></TD>
	   <TD width=26 height=30><img src=http://img.LegendBattles.ru/image/chat/ab3.gif width=26 height=30 border=0 align=absmiddle class=chatpostbut onClick="use_action('addon-action');" title="Возможности игрока"></TD>
	   <TD width=26 height=30><img src=http://img.LegendBattles.ru/image/chat/spacer.gif width=126 height=30 border=0></TD>
       </TR>
</TABLE>
</FORM>
<SCRIPT LANGUAGE="JavaScript">
document.FBT.text.focus();
</SCRIPT>
</BODY>
</HTML>