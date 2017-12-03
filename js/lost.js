function closef()
{
       document.all("lp").style.visibility = "hidden";
       document.all("lp").innerHTML = '<img src=image/1x1.gif width=1 height=1>';
}

function lostf()
{
    document.all("lp").innerHTML = '<table cellpadding=1 cellspacing=0 border=0 width=500><tr><td bgcolor=#cccccc><table cellpadding=3 cellspacing=0 border=0 width=100%><tr><td bgcolor=#ececec><font class=copir>[<b> <a href="javascript: closef()" class=menu>x</a> </b>] </font><b>Восстановление пароля:</b></td></tr><tr><td bgcolor=#ececec><font class=copir><font color=#555555>Для восстановления пароля необходимо ввести Ваш логин и Ваш E-mail, который был указан при регистрации. Система сформирует письмо на указанный E-mail, которое будет содержать ссылку для сброса пароля.</font></td></tr><tr><td bgcolor=#ececec><form method=POST action=restore.php><div align=center><b>Логин</b> <input type=text name=login_lost class=inp_form> <b>E-mail</b> <input type=text name=email_lost class=inp_form> <input type=submit value=далее align=absmiddle class=f_text></div></font></form></td></tr></table></td></tr></table>';
       document.all("lp").style.visibility = "visible";
       document.all("login_lost").focus();
}