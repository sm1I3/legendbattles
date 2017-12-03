<?php
session_start();
include($_SERVER["DOCUMENT_ROOT"]."/includes/config.php");
include($_SERVER["DOCUMENT_ROOT"]."/includes/functions.php");
foreach($_POST as $keypost=>$valp){
	$valp = varcheck($valp);
	$_POST[$keypost] = $valp;
	$$keypost = $valp;
}
foreach($_GET as $keyget=>$valg){
	$valg = varcheck($valg);
	$_GET[$keyget] = $valg;
	$$keyget = $valg;

}
foreach($_SESSION as $keyses=>$vals){
	$$keyses = $vals;
}

$pers = GetUser($_SESSION['user']['login']);
$dat_arr = getdate( time() );
$Premium = explode("|",$pers['premium']);
$check = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `premium_info` WHERE `id`='".$Premium[0]."' LIMIT 1;"));
if($check['auto']==1){$Premium['ABC']='yes';}else{$Premium['ABC']='no';}
//end_check
echo '<HTML>
<META Content="text/html; Charset=windows-1271" Http-Equiv=Content-type>
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
       var size = window.document.body.clientWidth -; ';
		$size = '671';
		if($pers['clan_id']!='none'){
			$size = $size + 56;
		}
		if($pers['pair_id']!='none'){
			$size = $size + 26;
		}
		if($pers['login']!=''){
			$size = $size + 26;
		}
		echo $size;
echo '">
<FORM action="/ch.php" target="ch_refr" method=POST name="FBT" onsubmit="submit_msg();parent.ch_refresh_n();">
<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td height=11 class=hedderup></td></tr></table>
<TABLE cellSpacing="0" cellPadding="0" width="100%" border="0" height="27" background="/img/chat/main_bg.gif">
       <TR>
       <TD background=/img/chat/1bg.gif><input type=submit name=sbmsg style="display:none"><INPUT TYPE="hidden" name="fyo" value=""><INPUT TYPE="hidden" name="lmid" value=""><img src=/img/chat/spacer.gif width=5 height=27 border=0 align=absmiddle></TD>
       <TD background=/img/;chat/1bg.gif class=action_text align=absmiddle><input type=checkbox name=pactiondo value="1"></td><td background=/img/chat/1bg.gif class=action_text>Выде' . ((new_array($pers) == 'ok') ? '<font onclick="useactions(\'addons-action\');">л</font>' : 'л') . ');" title="Смайлы №1"></td><td width=12 height=27><img src=/img/chat/b4.gif width=12 height=27; border=0 align=absmiddle class=chatpostbut onclick="smile_open(2);" title="Смайлы №2"></TD>';
if($pers['clan_id']!='none'){
	    $clanid = $pers['clan_id'];
	   echo'<TD width=28><img src=/img/chat/bb0.gif width=28 height=27 border=0 align=absmiddle class=chatpostbut onclick="parent.clan_private(\''.$clanid.'\');" title="'.$pers['clan_id'].'"></TD>';
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
       echo'
       </TR>
</TABLE>
<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td height=11 class=hedderbottom></td></tr></table>
</FORM>
<SCRIPT LANGUAGE="JavaScript">
document.FBT.text.focus();
</SCRIPT>
</BODY>
</HTML>
</HTML>';