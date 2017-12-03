d=document;
// Верхнее меню (лево)
var tbl_main_top_left = '<TABLE cellpadding=0 cellspacing=0 height=100% width=100%><TR><TD><IMG SRC="/images/1x1.gif" WIDTH="10" HEIGHT="34" BORDER="0"></TD><TD width=100%><TABLE cellpadding=0 cellspacing=0 width=100% background="/images/1x1.gif" height="34"><TR><TD id=button class="tbl_top_left">';
// Верхнее меню (Центр)
var tbl_main_center = '</td><td class="tbl_top_right">';
// Верхнее меню (Право)
var tbl_main_top_right = '</TD></TR></TABLE></TD><TD><IMG SRC="/images/1x1.gif" WIDTH="10" HEIGHT="34" BORDER="0"></TD></TR><TR height=100%><TD><TABLE cellpadding=0 cellspacing=0 height=100%><TR><TD><IMG SRC="/images/1x1.gif" WIDTH="10" HEIGHT="16" BORDER="0"></TD></TR><TR height=100%><TD></TD></TR><TR><TD><IMG SRC="/images/1x1.gif" WIDTH="10" HEIGHT="16" BORDER="0"></TD></TR></TABLE></TD><TD valign=top id=resend>';
// Нижнее меню (лево)
var tbl_main_bot_left = '<TD><TABLE cellpadding=0 cellspacing=0 height=100%><TR><TD><IMG SRC="/images/1x1.gif" WIDTH="10" HEIGHT="16" BORDER="0"></TD></TR><TR height=100%><TD></TD></TR><TR><TD><IMG SRC="/images/1x1.gif" WIDTH="10" HEIGHT="16" BORDER="0"></TD></TR></TABLE></TD></TR><TR><TD><IMG SRC="/images/1x1.gif" WIDTH="10" HEIGHT="53" BORDER="0"></TD><TD width=100%><TABLE cellpadding=0 cellspacing=0 width=100%><TR><TD><IMG SRC="/images/1x1.gif" WIDTH="44" HEIGHT="53" BORDER="0"></TD><TD width=100% valign=top align=center>';
// Нижнее меню (право)
var tbl_main_bot_right = '</TD><TD><IMG SRC="/images/1x1.gif" WIDTH="45" HEIGHT="53" BORDER="0"></TD></TR></TABLE></TD><TD><IMG SRC="/images/1x1.gif" WIDTH="10" HEIGHT="53" BORDER="0"></TD></TR></TABLE>';



var form_main_left = '<TABLE cellpadding=0 cellspacing=0 height=100% width=100%><TR><TD><IMG SRC="/images/1x1.gif" WIDTH="21" HEIGHT="28" BORDER="0"></TD><TD width=100% align=center>';
var form_main_right = '</TD><TD><IMG SRC="/images/1x1.gif" WIDTH="20" HEIGHT="28" BORDER="0"></TD></TR><TR><TD height=100%></TD><TD background="images/fon2.jpg" valign=top>';
var form_main_bottom = '</TD><TD></TD></TR><TR><TD><IMG SRC="/images/1x1.gif" WIDTH="21" HEIGHT="22" BORDER="0"></TD><TD></TD><TD><IMG SRC="/images/1x1.gif" WIDTH="20" HEIGHT="22" BORDER="0"></TD></TR></TABLE>';
var menu_top = '<TABLE cellpadding=0 cellspacing=0 width=100% style="width: 100%;"><TR><TD><IMG SRC="/images/1x1.gif" WIDTH="10" HEIGHT="33" BORDER="0"></TD><TD width=100%><TABLE cellpadding=0 cellspacing=0 width=100%><TR><TD><IMG SRC="/images/1x1.gif" WIDTH="51" HEIGHT="33" BORDER="0"></TD><TD width=100%></TD><TD><IMG SRC="/images/1x1.gif" WIDTH="47" HEIGHT="33" BORDER="0"></TD></TR></TABLE></TD><TD><IMG SRC="/images/1x1.gif" WIDTH="10" HEIGHT="33" BORDER="0"></TD></TR><TR height=100%><TD><TABLE cellpadding=0 cellspacing=0 height=100%><TR><TD><IMG SRC="/images/1x1.gif" WIDTH="10" HEIGHT="17" BORDER="0"></TD></TR><TR height=100%><TD></TD></TR><TR><TD><IMG SRC="/images/1x1.gif" WIDTH="10" HEIGHT="16" BORDER="0"></TD></TR></TABLE></TD><TD background="images/fon2.jpg" valign=top>';
var menu_bottom = '</TD><TD><TABLE cellpadding=0 cellspacing=0 height=100%><TR><TD><IMG SRC="/images/1x1.gif" WIDTH="10" HEIGHT="17" BORDER="0"></TD></TR><TR height=100%><TD></TD></TR><TR><TD><IMG SRC="/images/1x1.gif" WIDTH="10" HEIGHT="16" BORDER="0"></TD></TR></TABLE></TD></TR><TR><TD><IMG SRC="/images/1x1.gif" WIDTH="10" HEIGHT="22" BORDER="0"></TD><TD width=100%><TABLE cellpadding=0 cellspacing=0 width=100%><TR><TD><IMG SRC="/images/1x1.gif" WIDTH="51" HEIGHT="22" BORDER="0"></TD><TD width=100%></TD><TD><IMG SRC="/images/1x1.gif" WIDTH="47" HEIGHT="22" BORDER="0"></TD></TR></TABLE></TD><TD><IMG SRC="/images/1x1.gif" WIDTH="10" HEIGHT="22" BORDER="0"></TD></TR></TABLE>';


//frame okno
var form_main_left_okno = '<TABLE cellpadding=0 cellspacing=0 height=150 width=150><TR><TD><IMG SRC="/images/1x1.gif" WIDTH="21" HEIGHT="28" BORDER="0"></TD><TD width=100% align=center>';

function form_title_okno(txt)
{
	return '<TABLE cellpadding=0 cellspacing=0><TR><TD><IMG SRC="/images/1x1.gif" WIDTH="28" HEIGHT="28" BORDER="0"></TD><TD class=title><nobr id=titl>'+txt+'</nobr></TD><TD><IMG SRC="/images/1x1.gif" WIDTH="28" HEIGHT="28" BORDER="0"></TD></TR></TABLE>';
}
var form_main_right_okno = '</TD><TD><IMG SRC="/images/1x1.gif" WIDTH="20" HEIGHT="28" BORDER="0"></TD></TR><TR><TD height=100%></TD><TD valign=top>';
var form_main_bottom_okno = '</TD><TD></TD></TR><TR><TD><IMG SRC="/images/1x1.gif" WIDTH="21" HEIGHT="22" BORDER="0"></TD><TD></TD><TD><IMG SRC="/images/1x1.gif" WIDTH="20" HEIGHT="22" BORDER="0"></TD></TR></TABLE>';



function form_title(txt)
{

	return '<TABLE cellpadding=0 cellspacing=0><TR><TD><IMG SRC="/images/1x1.gif" WIDTH="28" HEIGHT="28" BORDER="0"></TD><TD class=title><nobr id=titl>'+txt+'</nobr></TD><TD><IMG SRC="/images/1x1.gif" WIDTH="28" HEIGHT="28" BORDER="0"></TD></TR></TABLE>';
}

function title(txt)
{
	return '<center><TABLE cellpadding=0 cellspacing=0 class=mar5><TR><TD><IMG SRC="/images/1x1.gif" WIDTH="25" HEIGHT="26" BORDER="0"></TD><TD class=tit><nobr>'+txt+'</nobr></TD><TD><IMG SRC="/images/1x1.gif" WIDTH="25" HEIGHT="26" BORDER="0"></TD></TR></TABLE></center>';
}

// Вывод стандартного меню
function main_menu(act, txt, click)
{
	add = act == 1 ? '_act' : '';
	al = act == 2 ? 'right' : 'left';
	return '<table cellpadding=0 cellspacing=1 align='+al+'><tr><td><IMG SRC="/images/1x1.gif" WIDTH="23" HEIGHT="34" BORDER="0"></TD><TD class="but_menu curh" onClick="'+click+'" title="'+txt+'" nowrap>'+txt+'</TD><TD><IMG SRC="/images/1x1.gif" WIDTH="22" HEIGHT="34" BORDER="0"></TD></tr></table>';
}

// Вывод меню с открытием второго окна
function main_menu_target(act, txt, click)
{
	add = act == 1 ? '_act' : '';
	al = act == 2 ? 'right' : 'left';
	return '<table cellpadding=0 cellspacing=1 align='+al+'><tr><td><IMG SRC="/images/1x1.gif" WIDTH="23" HEIGHT="34" BORDER="0"></TD><TD class="but_menu curh" onClick="'+click+'" title="'+txt+'" nowrap><a href="'+click+'" target=_blank><font color=#FFE4AA>'+txt+'</font></a></TD><TD><IMG SRC="/images/1x1.gif" WIDTH="22" HEIGHT="34" BORDER="0"></TD></tr></table>';
}

// Вывод меню без клика
function main_menu_title(act, txt)
{
	add = act == 1 ? '_act' : '';
	al = act == 2 ? 'right' : 'left';
	return '<table cellpadding=0 cellspacing=1 align='+al+'><tr><td><IMG SRC="/images/1x1.gif" WIDTH="23" HEIGHT="34" BORDER="0"></TD><TD class="title2"><nobr id=titl>'+txt+'</nobr></TD><TD><IMG SRC="/images/1x1.gif" WIDTH="22" HEIGHT="34" BORDER="0"></TD></tr></table>';
}

// Вывод меню без клика
function main_menu_zamok(act, txt)
{
	add = act == 1 ? '_act' : '';
	al = act == 2 ? 'center' : 'center';
	return '<table cellpadding=0 cellspacing=1 align='+al+'><tr><td><IMG SRC="/images/1x1.gif" WIDTH="23" HEIGHT="34" BORDER="0"></TD><TD class="zamok"><nobr id=titl>'+txt+'</nobr></TD><TD><IMG SRC="/images/1x1.gif" WIDTH="22" HEIGHT="34" BORDER="0"></TD></tr></table>';
}

// Вывод помощи без клика
function main_menu_help(act, txt)
{
	add = act == 1 ? '_act' : '';
	al = act == 2 ? 'center' : 'right';
	return '<table cellpadding=0 cellspacing=1 align='+al+'><tr><td><IMG SRC="/images/1x1.gif" WIDTH="23" HEIGHT="34" BORDER="0"></TD><TD class="zamok"><nobr id=titl>'+txt+'</nobr></TD><TD><IMG SRC="/images/1x1.gif" WIDTH="22" HEIGHT="34" BORDER="0"></TD></tr></table>';
}

function form_menu(act, txt, click)
{
	add = act == 1 ? '_act' : '';

	return '<table cellpadding=0 cellspacing=1><tr><td><IMG SRC="/images/1x1.gif" WIDTH="14" HEIGHT="28" BORDER="0"></TD><TD class="but_menu curh" onClick="'+click+'" title="'+txt+'" nowrap>'+txt+'</TD><TD><IMG SRC="/images/1x1.gif" WIDTH="14" HEIGHT="28" BORDER="0"></TD></tr></table>';
}
