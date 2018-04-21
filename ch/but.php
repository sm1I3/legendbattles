<?php
include($_SERVER["DOCUMENT_ROOT"] . "/system/config.php");
include($_SERVER["DOCUMENT_ROOT"]."/includes/functions.php");

$pers = GetUser($_SESSION['user']['login']);
$dat_arr = getdate( time() );
$Premium = explode("|",$pers['premium']);
$check = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `premium_info` WHERE `id`='".$Premium[0]."' LIMIT 1;"));
if($check['auto']==1){$Premium['ABC']='yes';}else{$Premium['ABC']='no';}
//end_check
echo '<HTML>
<META Content="text/html; Charset=utf-8" Http-Equiv=Content-type>
<META Http-Equiv=Cache-Control Content=No-Cache>
<META Http-Equiv=Pragma Content=No-Cache>
<META Http-Equiv=Expires Content=0>
<HEAD>
<LINK href="/ch/button.css" rel=STYLESHEET type=text/css>
<LINK href="/css/NewDesign.css" rel=STYLESHEET type=text/css>
<SCRIPT LANGUAGE="JavaScript" src="/ch/ch_but.js?v3"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" src="/js/swfobject.js"></SCRIPT>
<SCRIPT>
function reset_length(){
       var size = window.document.body.clientWidth -';
$size = '671';
if ($pers['clan_id'] != 'none') {
    $size = $size + 56;
}
if ($pers['pair_id'] != 'none') {
    $size = $size + 26;
}
if ($pers['login'] != '') {
    $size = $size + 26;
}
echo $size;
echo ';
       if(size < 100) size = 100;
       window.document.FBT.text.size = 2*size/13;
       window.document.all(\'INPT\').width = size;
}
window.onresize = reset_length;
</SCRIPT>
</HEAD>
<BODY LeftMargin=0 TopMargin=0 MarginHeight=0 MarginWidth=0 background=/imgs/pinfo_bg.jpg OnLoad="reset_length();status=\'legendbat - Жизнь в Мире Cильнейших..\'">
<FORM action="/ch.php" target="ch_refr" method=POST name="FBT" onsubmit="submit_msg();parent.ch_refresh_n();">
<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td height=11 class=hedderup></td></tr></table>
<TABLE cellSpacing="0" cellPadding="0" width="100%" border="0" height="27" background="/img/chat/main_bg.gif">
       <TR>
       <TD background=/img/chat/1bg.gif><input type=submit name=sbmsg style="display:none"><INPUT TYPE="hidden" name="fyo" value=""><INPUT TYPE="hidden" name="lmid" value=""><img src=/img/chat/spacer.gif width=5 height=27 border=0 align=absmiddle></TD>
       <TD background=/img/chat/1bg.gif class=action_text align=absmiddle><input type=checkbox name=pactiondo value="1"></td><td background=/img/chat/1bg.gif class=action_text>Выде' . ((new_array($pers) == 'ok') ? '<font onclick="useactions(\'addons-action\');">л</font>' : 'л') . 'ить</TD>
       <TD width=75 height=27><img src=/img/chat/1_1.gif width=75 height=27 border=0 title="Сказать:" align=absmiddle></TD>
       <TD id=INPT background=/img/chat/fbg.gif align=absmiddle><input name=text type=text class=chat_forma size=80 maxlength=270 onkeyup="if ((event.ctrlKey) && ((event.keyCode==10) || (event.keyCode==13))) { document.FBT.sbmsg.click() }" x-webkit-speech></TD>
       <TD width=6 height=27><img src=/img/chat/1_2.gif width=6 height=27 border=0 align=absmiddle></TD>
       <TD width=19 height=27><img src=/img/chat/b1.gif name=butinp width=19 height=27 border=0 class=chatpostbut align=absmiddle title="Отправить сообщение" onclick="document.FBT.sbmsg.click()"></TD>
       <TD width=19 height=27><img src=/img/chat/b2.gif width=19 height=27 border=0 align=absmiddle class=chatpostbut onclick="parent.clr_input();" title="Очистить поле ввода"></TD>
       <TD width=12 height=27><img src=/img/chat/b3.gif width=12 height=27 border=0 align=absmiddle class=chatpostbut onclick="smile_open(\'\');" title="Смайлы №1"></td><td width=12 height=27><img src=/img/chat/b4.gif width=12 height=27 border=0 align=absmiddle class=chatpostbut onclick="smile_open(2);" title="Смайлы №2"></TD>';
if($pers['clan_id']!='none'){
    $clanid = $pers['clan_id'];
    echo '<TD width=28><img src=/img/chat/bb0.gif width=28 height=27 border=0 align=absmiddle class=chatpostbut onclick="parent.clan_private(\'' . $clanid . '\');" title="' . $pers['clan_id'] . '"></TD>';
}
echo '<TD width="30"><img src=/img/chat/bb2.gif width=27 height=27 border=0 align=absmiddle class=chatpostbut onclick="parent.clr_chat();" title="Очистить окно чата"></TD>';
if ($pers['level'] >= 5) {
    echo '<TD width="32%""><img src="/img/chat/ab7.gif" width="26" height="27" border="0" align="absmiddle" class="chatpostbut" onclick="useaction(\'auction-action\');" title="Аукцион"></TD>';
}
if($Premium[0] > 1 and $Premium[1] > time() and $Premium['ABC'] == 'yes'){
    echo '<TD width=26 height=27><img src=/img/chat/ab5.gif width=26 height=27 border=0 align=absmiddle class=chatpostbut onclick="useaction(\'client-action\');" title="Авто-Бот"></TD>';
}
echo '<TD width=26 height=27><img src=/img/chat/ab3.gif width=26 height=27 border=0 align=absmiddle class=chatpostbut onclick="use_action(\'addon-action\');" title="Возможности игрока"></TD>';
echo '<TD width="100%"><img src=/img/chat/dreg.gif width=26 height=27 border=0 align=absmiddle class=chatpostbut onclick="use_action(\'menu-action\');" title="Коллекции"></TD>';
echo '
       </TR>
</TABLE>
<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td height=11 class=hedderbottom></td></tr></table>
</FORM>
<SCRIPT LANGUAGE="JavaScript">
document.FBT.text.focus();
</SCRIPT>
</BODY>
</HTML>';