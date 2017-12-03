var ActionFormUse;

function c_form()
{
       document.all("transfer").style.visibility = 'hidden';
       document.all("transfer").innerHTML = '<img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1>';
       top.frames['ch_buttons'].document.FBT.text.focus();
       ActionFormUse = '';
}

function w28_form(vcode,wuid,wsubid,wsolid)
{
       var wadd = 0;
       var vtitle,vcont;
       top.frames['ch_buttons'].document.FBT.text.focus();
       switch(wsubid)
       {
	      case 1:
	      case 2:
	      case 3:
           case 4:
               wadd = 2;
               vtitle = 'Обычное нападение';
               vcont = '<INPUT type=hidden name=post_id value=8><INPUT type=hidden name=vcode value=' + vcode + '><INPUT type=hidden name=wuid value=' + wuid + '><INPUT type=hidden name=wsubid value=' + wsubid + '><INPUT type=hidden name=wsolid value=' + wsolid + '><DIV align=center><FONT class=nickname><B>На кого: </B><INPUT TYPE="text" name=pnick class=LogintextBox maxlength=20> <INPUT type=submit value="Выполнить" class=lbut name=agree> <INPUT type=button class=lbut onclick="c_form()" value="Отмена"></DIV>';
               break;
	      case 5:
	      case 6:
	      case 7:
           case 8:
               wadd = 2;
               vtitle = 'Кровавое нападение';
               vcont = '<INPUT type=hidden name=post_id value=8><INPUT type=hidden name=vcode value=' + vcode + '><INPUT type=hidden name=wuid value=' + wuid + '><INPUT type=hidden name=wsubid value=' + wsubid + '><INPUT type=hidden name=wsolid value=' + wsolid + '><DIV align=center><FONT class=nickname><B>На кого: </B><INPUT TYPE="text" name=pnick class=LogintextBox maxlength=20> <INPUT type=submit value="Выполнить" class=lbut name=agree> <INPUT type=button class=lbut onclick="c_form()" value="Отмена"></DIV>';
               break;
           case 14:
               wadd = 2;
               vtitle = 'Закрытое нападение';
               vcont = '<INPUT type=hidden name=post_id value=8><INPUT type=hidden name=vcode value=' + vcode + '><INPUT type=hidden name=wuid value=' + wuid + '><INPUT type=hidden name=wsubid value=' + wsubid + '><INPUT type=hidden name=wsolid value=' + wsolid + '><DIV align=center><FONT class=nickname><B>На кого: </B><INPUT TYPE="text" name=pnick class=LogintextBox maxlength=20> <INPUT type=submit value="Выполнить" class=lbut name=agree> <INPUT type=button class=lbut onclick="c_form()" value="Отмена"></DIV>';
               break;
           case 9:
               wadd = 1;
               vtitle = 'Применить невидимость на 4 часа?';
               vcont = '<INPUT type=hidden name=post_id value=25><INPUT type=hidden name=vcode value=' + vcode + '><INPUT type=hidden name=wuid value=' + wuid + '><INPUT type=hidden name=wsubid value=' + wsubid + '><INPUT type=hidden name=wsolid value=' + wsolid + '><DIV align=center><INPUT type=submit value="Применить" class=lbut name=agree> <INPUT type=button class=lbut onclick="c_form()" value="Отмена"></DIV>';
               break;
           case 22:
               wadd = 1;
               vtitle = 'Применить телепорт?';
               vcont = '<INPUT type=hidden name=post_id value=25><INPUT type=hidden name=vcode value=' + vcode + '><INPUT type=hidden name=wuid value=' + wuid + '><INPUT type=hidden name=wsubid value=' + wsubid + '><INPUT type=hidden name=wsolid value=' + wsolid + '><DIV align=center><FONT class=nickname><B>Пункт назначения: </B><SELECT name=wtelid class=LogintextBox6><OPTION VALUE=1>Город Барус</OPTION><OPTION VALUE=2>Город Октал</OPTION><OPTION VALUE=3>Деревня Подгорная</OPTION><OPTION VALUE=4>Окрестность Баруса, Телепорт</OPTION><OPTION VALUE=5>Окрестность Октала, Телепорт</OPTION><OPTION VALUE=6>Кровавый Берег, Телепорт</OPTION><OPTION VALUE=7>Окрестность Баалгора, Телепорт</OPTION><OPTION VALUE=8>Пустыня Самум-Бейт, Телепорт</OPTION></SELECT> <INPUT type=submit value="Применить" class=lbut name=agree> <INPUT type=button class=lbut onclick="c_form()" value="Отмена"></FONT></DIV>';
               break;
           case 23:
               wadd = 1;
               vtitle = 'Рассеять невидимость?';
               vcont = '<INPUT type=hidden name=post_id value=25><INPUT type=hidden name=vcode value=' + vcode + '><INPUT type=hidden name=wuid value=' + wuid + '><INPUT type=hidden name=wsubid value=' + wsubid + '><INPUT type=hidden name=wsolid value=' + wsolid + '><DIV align=center><INPUT type=submit value="Рассеять" class=lbut name=agree> <INPUT type=button class=lbut onclick="c_form()" value="Отмена"></DIV>';
               break;
           case 24:
               wadd = 2;
               vtitle = 'Кулачное нападение';
               vcont = '<INPUT type=hidden name=post_id value=8><INPUT type=hidden name=vcode value=' + vcode + '><INPUT type=hidden name=wuid value=' + wuid + '><INPUT type=hidden name=wsubid value=' + wsubid + '><INPUT type=hidden name=wsolid value=' + wsolid + '><DIV align=center><FONT class=nickname><B>На кого: </B><INPUT TYPE="text" name=pnick class=LogintextBox maxlength=20> <INPUT type=submit value="Выполнить" class=lbut name=agree> <INPUT type=button class=lbut onclick="c_form()" value="Отмена"></DIV>';
               break;
           case 25:
               wadd = 2;
               vtitle = 'Закрытое кулачное нападение';
               vcont = '<INPUT type=hidden name=post_id value=8><INPUT type=hidden name=vcode value=' + vcode + '><INPUT type=hidden name=wuid value=' + wuid + '><INPUT type=hidden name=wsubid value=' + wsubid + '><INPUT type=hidden name=wsolid value=' + wsolid + '><DIV align=center><FONT class=nickname><B>На кого: </B><INPUT TYPE="text" name=pnick class=LogintextBox maxlength=20> <INPUT type=submit value="Выполнить" class=lbut name=agree> <INPUT type=button class=lbut onclick="c_form()" value="Отмена"></DIV>';
               break;
           case 26:
               wadd = 2;
               vtitle = 'Боевое нападение';
               vcont = '<INPUT type=hidden name=post_id value=8><INPUT type=hidden name=vcode value=' + vcode + '><INPUT type=hidden name=wuid value=' + wuid + '><INPUT type=hidden name=wsubid value=' + wsubid + '><INPUT type=hidden name=wsolid value=' + wsolid + '><DIV align=center><FONT class=nickname><B>На кого: </B><INPUT TYPE="text" name=pnick class=LogintextBox maxlength=20> <INPUT type=submit value="Выполнить" class=lbut name=agree> <INPUT type=button class=lbut onclick="c_form()" value="Отмена"></DIV>';
               break;
           case 27:
               wadd = 2;
               vtitle = 'Свиток Защиты';
               vcont = '<INPUT type=hidden name=post_id value=25><INPUT type=hidden name=vcode value=' + vcode + '><INPUT type=hidden name=wuid value=' + wuid + '><INPUT type=hidden name=wsubid value=' + wsubid + '><INPUT type=hidden name=wsolid value=' + wsolid + '><DIV align=center><FONT class=nickname><B>Союзник: </B><INPUT TYPE="text" name=pnick class=LogintextBox maxlength=20> <INPUT type=submit value="Помочь" class=lbut name=agree> <INPUT type=button class=lbut onclick="c_form()" value="Отмена"></DIV>';
               break;
           case 28:
               wadd = 1;
               vtitle = 'Применить Свиток Обнаружения?';
               vcont = '<INPUT type=hidden name=post_id value=25><INPUT type=hidden name=vcode value=' + vcode + '><INPUT type=hidden name=wuid value=' + wuid + '><INPUT type=hidden name=wsubid value=' + wsubid + '><INPUT type=hidden name=wsolid value=' + wsolid + '><DIV align=center><INPUT type=submit value="Применить" class=lbut name=agree> <INPUT type=button class=lbut onclick="c_form()" value="Отмена"></DIV>';
               break;
       }
       document.all("transfer").innerHTML = '<FORM ACTION=main.php METHOD=POST><TABLE cellpadding=0 cellspacing=0 border=0 width=100%><TR><TD bgcolor=#B9A05C><TABLE cellpadding=3 cellspacing=1 border=0 width=100%><TR><TD width=100% bgcolor=#FCFAF3><FONT class=nickname><B>'+vtitle+'</B></TD></TR><TR><TD bgcolor=#FCFAF3>'+vcont+'</TD></TR></TABLE></TD></TR></TABLE></FORM>';
       document.all("transfer").style.visibility = 'visible';
       switch(wadd)
       {
              case 1: document.all("agree").focus(); break;
              case 2: 
	      document.all("pnick").focus(); 
	      ActionFormUse = 'pnick';
	      break;
       }
}