function complectform(ccode) 
{
    document.all('complect').innerHTML = '<form action=main.php method=POST name=CMPL><input type=hidden name=complectstart value="1"><input type=hidden name=post_a value=3><input type=hidden name=ccode value="' + ccode + '"><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#B9A05C><table cellpadding=3 cellspacing=1 border=0 width=100%><tr><td width=100% bgcolor=#FCFAF3><font class=nickname>Введите название комплекта</font></div></td></tr><tr><td bgcolor=#FCFAF3><font class=nickname><b>Название:</b> <INPUT TYPE="text" name=cname class=LogintextBox4 style="WIDTH:190px" maxlength=50> <input type=submit value="Запомнить" class=lbut> <input type=button class=lbut onclick=\"closecomplectform()\" value=\" x \"></td></tr></table></td></tr></table></FORM>';
       document.all('complect').style.visibility = 'visible';
       document.CMPL.cname.focus();
}

function closecomplectform()
{
       document.all('complect').style.visibility = 'hidden';
       document.all('complect').innerHTML = '<img src=image/1x1.gif width=1 height=1>';
       parent.frames['ch_buttons'].document.FBT.text.focus();
}

function check_delete_compl(cname)
{
    formCheck = confirm("Вы действительно хотите удалить комплект '" + cname + "'?");
       if(formCheck) return true;
       return false;
}

function compl_f(vcode)
{
    document.all('complect').innerHTML = '<FORM action=main.php method=POST name=CMPL><input type=hidden name=post_id value=2><input type=hidden name=act value=3><input type=hidden name=vcode value="' + vcode + '"><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#B9A05C><table cellpadding=3 cellspacing=1 border=0 width=100%><tr><td width=100% bgcolor=#FCFAF3><font class=nickname>Введите название комплекта</font></div></td></tr><tr><td bgcolor=#FCFAF3><font class=nickname><b>Название:</b> <input type=text name=cname class=LogintextBox4 maxlength=30> <input type=submit value="Запомнить" class=lbut> <input type=button class=lbut onclick="compl_close()" value=" x "></td></tr></table></td></tr></table></FORM>';
       document.all('complect').style.visibility = 'visible';
       document.CMPL.cname.focus();
}

function compl_close()
{
       document.all('complect').style.visibility = 'hidden';
       document.all('complect').innerHTML = '<img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1>';
       parent.frames['ch_buttons'].document.FBT.text.focus();
}

function compl_del(cname)
{
    if (confirm('Вы действительно хотите удалить комплект «' + cname + '»?')) return true;
       return false;
}

function compl_view(cname,key,vcode)
{
    document.write('<tr><td width=100% bgcolor=#FFFFFF><font class=nickname>' + cname + '</td><td bgcolor=#FFFFFF><input type=button class=invbut onclick="location=\'main.php?post_id=4&key=' + key + '&vcode=' + vcode + '\'" value="Надеть"></td><td bgcolor=#FFFFFF><input type=button class=invbut onclick="if(compl_del(\'' + cname + '\')) { location=\'main.php?post_id=3&key=' + key + '&vcode=' + vcode + '\' }" value="Удалить"></td></tr>');
}