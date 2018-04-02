<?php
session_start();
//$_SESSION['chat']['mode']=0;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<META Content="text/html; Charset=utf-8" Http-Equiv=Content-type>
<META Http-Equiv=Cache-Control Content=No-Cache>
<META Http-Equiv=Pragma Content=No-Cache>
<META Http-Equiv=Expires Content=0>
<HEAD>
<LINK href="/ch/chat.css" rel=STYLESHEET type=text/css>
<SCRIPT>
    var user = '<?=$inf["sklon"]?> <?=$inf["clan_gif"]?> <?=$_SESSION['user']["login"]?>';
</SCRIPT>
<script type="text/javascript" src="/js/jquery.min.js?v7"></script>
<SCRIPT LANGUAGE="JavaScript" src="/ch/ch_msg.js?v9"></SCRIPT>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>
</HEAD>
<body style=" margin:2px; background-color:#FFFFFF; " OnLoad="parent.start()">
<div class="section" id="section">
  <ul class="tabs" style="position: relative;" >
      <li class="current" onclick="ch_mode(0);">Общий чат</li>
      <li onclick="ch_mode(1);">Торговый чат</li>
      <li onclick="ch_mode(3);">Системный</li>
      <!--li onclick="ch_mode(2);">Клановый чат&nbsp;&nbsp;</li-->
  </ul>
  <div class="box visible">
    <TEXTAREA id=cpnick style="display:none;"></TEXTAREA>
	<DIV id=user_menu class="usermenu"></DIV>
	<DIV id=msg></DIV>
  </div>
  <div class="box">
    <TEXTAREA id=cpnick2 style="display:none;"></TEXTAREA>
	<DIV id=user_menu2 class="usermenu"></DIV>
    <DIV id=msg_trade></DIV>
  </div>
  <div class="box">
    <TEXTAREA id=cpnick3 style="display:none;"></TEXTAREA>
	<DIV id=user_menu3 class="usermenu"></DIV>
    <DIV id=msg_system></DIV>
  </div>
   <!--div class="box">
    <DIV id=msg_clan></DIV>
  </div-->
</div><!-- .section -->

<SCRIPT>
var SaveScrollPos = [0,0];
function ch_mode(type){
	switch(type){
		case 0: parent.frames['ch_list'].location='../ch.php?lo=1&ch_mode=0'; break;
		case 1: parent.frames['ch_list'].location='../ch.php?lo=1&ch_mode=1'; break;
		case 2: parent.frames['ch_list'].location='../ch.php?lo=1&ch_mode=2'; break;
		case 3: parent.frames['ch_list'].location='../ch.php?lo=1&ch_mode=3'; break;
	}
	if(typeof pageYOffset == 'undefined'){$('ul.tabs').css('top', 0);}
}
$(window).scroll(function () {
	$('ul.tabs').css('top', getScrollTop());
});

(function($) {
$(function() {
  $('ul.tabs').delegate('li:not(.current)', 'click', function() {
    $(this).addClass('current').siblings().removeClass('current')
      .parents('div.section').find('div.box').eq($(this).index()).fadeIn(600).siblings('div.box').hide();
  })
})
})(jQuery);

var e_m;
e_m = get_by_id('user_menu');
e_m.onmouseout = function (evt) { return ch_close_menu(evt); };
e_m = get_by_id('msg');
e_m.onclick = function(evt) { return to_what_who(evt); };
e_m.oncontextmenu = function (evt) { return ch_open_menu(evt); };

var e_m2;
e_m2 = get_by_id('user_menu2');
e_m2.onmouseout = function (evt2) { return ch_close_menu2(evt2); };
e_m2 = get_by_id('msg_trade');
e_m2.onclick = function(evt2) { return to_what_who(evt2); };
e_m2.oncontextmenu = function (evt2) { return ch_open_menu2(evt2); };

var e_m3;
e_m3 = get_by_id('user_menu3');
e_m3.onmouseout = function (evt3) { return ch_close_menu3(evt3); };
e_m3 = get_by_id('msg_system');
e_m3.onclick = function(evt3) { return to_what_who(evt3); };
e_m3.oncontextmenu = function (evt3) { return ch_open_menu2(evt3); };
</SCRIPT>
</body>
</html>