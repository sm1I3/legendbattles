var t;
document.onmousedown = function(event) { t_nick(event); };

function getScrollTop(){
    if(typeof pageYOffset!= 'undefined'){
        //most browsers
        return $(document).scrollTop();
    }
    else{
		var top = document.body.scrollTop
			? document.body.scrollTop
			: (window.pageYOffset
				? window.pageYOffset
				: (document.body.parentElement
					? document.body.parentElement.scrollTop
					: 0
				)
			);
			return top;
    }
}

function t_nick (e)
{
    e = e||window.event;
    parent.is_ctrl = e.ctrlKey;
    parent.is_alt = e.altKey;
}

var sm = new Array('001','002','003','004','005','007','008','009','006','010','011','012','013','014','015','016','000','018','021','022','019','023','024','025','026','027','028','031','032','034','033','037','038','036','040','039','043','049','052','056','059','057','062','066','068','073','082','080','079','083','086','085','114','118','119','123','161','158','164','167','166','170','174','177','175','179','178','186','189','188','190','202','205','203','206','221','237','239','238','243','246','254','253','255','277','276','275','278','284','289','288','294','293','295','310','313','324','336','347','346','345','348','349','351','352','361','362','366','367','382','393','411','415','413','419','422','434','442','447','453','467','471','472','475','551','554','559','564','568','573','029','030','077','126','127','131','155','156','267','297','319','350','353','354','357','358','368','376','385','386','414','417','457','459','469','473','474','477','552','558','560','570','574','575','576','579','600','601','602','603','604','605','606','607','608','609','610','611','612','613','614','615','616','617','618','619','620','621','622','623','624','625','626','627','628','629','630','631','632','633','634','635','636','637','638','639','640','641','642','643','644','645','646','647','648','650','651','652','653','654','655','656','657','950','951','952','953','954','955','956','957','958','959','960');


var maxsmiles = 3;
var smilesimgpath='<IMG border=0 src=/img/image/chat/smiles/';
var smilesimgstyle = ' style="cursor:pointer" onclick="ins_smile(\'';


function naemnik(login){
	parent.frames['main_top'].location = '/main.php?post_id=98&forlogin='+login;
}
function ticher(uid){
	parent.frames['main_top'].location = '/main.php?post_id=112&uid='+uid;
}

function ch_set_ignor (nick)
{
    while (nick.indexOf ('=') >= 0) nick = nick.replace ('=', '%3D');
    while (nick.indexOf ('+') >= 0) nick = nick.replace ('+', '%2B');
    while (nick.indexOf ('#') >= 0) nick = nick.replace ('#', '%23');
    while (nick.indexOf (' ') >= 0) nick = nick.replace (' ', '%20');
    parent.frames['ch_refr'].location = '../ch.php?a=ign&s=1&u='+nick;
}

function ch_remove_ignor (nick)
{
    while (nick.indexOf ('=') >= 0) nick = nick.replace ('=', '%3D');
    while (nick.indexOf ('+') >= 0) nick = nick.replace ('+', '%2B');
    while (nick.indexOf ('#') >= 0) nick = nick.replace ('#', '%23');
    while (nick.indexOf (' ') >= 0) nick = nick.replace (' ', '%20');
    parent.frames['ch_refr'].location = '../ch.php?a=ign&s=0&u='+nick;
}

function ch_copy_nick (nick)
{
    var cpn = get_by_id ('cpnick');
    cpn.innerHTML = nick;
    if (window.clipboardData) {
      var cp = cpn.createTextRange();
      cp.execCommand ("RemoveFormat");
      cp.execCommand ("Copy");
    }
}

function ch_open_menu(e)
{
    var e = e || window.event;
    var el, x, y, login, login2;
    el = document.getElementById('user_menu');
    var o = e.target || e.srcElement;
    if (o.tagName !== "SPAN") 
        return true;
    x = e.clientX + document.documentElement.scrollLeft + document.body.scrollLeft - 4;
    y = e.clientY + getScrollTop();

	BodyHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;	
    y -= (e.clientY + 72 > BodyHeight) ? 70 : 2;
    login = o.innerHTML;
    e.returnValue=false;
    login2 = login;
    while (login2.indexOf(' ') >=0) login2 = login2.replace (' ', '%20');
    while (login2.indexOf('+') >=0) login2 = login2.replace ('+', '%2B');
    while (login2.indexOf('#') >=0) login2 = login2.replace ('#', '%23');
    while (login2.indexOf('?') >=0) login2 = login2.replace ('?', '%3F');

    el.innerHTML = '<a class="usermenulink" href="javascript:parent.say_private(\''+login+'\');ch_hmenu()">Приват</a>'+
    '<a class="usermenulink" href="/ipers/'+login2+'" target="_blank" onclick="ch_hmenu();return true;">Информация</a>'+
    '<a class="usermenulink" href="javascript:ch_copy_nick(\''+login+'\');ch_hmenu()">Копировать ник</a>'+
    '<a class="usermenulink" href="javascript:ch_set_ignor(\''+login+'\');ch_hmenu()">Игнорировать</a>';

    el.style.left = x + "px";
    el.style.top  = y + "px";
    el.style.visibility = "visible";
    
    return false;
}

function ch_hmenu()
{
    document.getElementById("user_menu").style.visibility = "hidden";
    document.getElementById("user_menu").style.top="0px";
    parent.frames['ch_buttons'].document.FBT.text.focus();
}

function ch_close_menu(e)
{
    var e = e || window.event;
    var te = e.relatedTarget || e.toElement;
    if (e && te)
    {
        var cls = te.className;
        if (cls === 'usermenulink' || cls === 'usermenu') return;
    }
    document.getElementById("user_menu").style.visibility = "hidden";
    document.getElementById("user_menu").style.top="0px";
    return false;
}


function ch_copy_nick2 (nick)
{
    var cpn = get_by_id ('cpnick2');
    cpn.innerHTML = nick;
    if (window.clipboardData) {
      var cp = cpn.createTextRange();
      cp.execCommand ("RemoveFormat");
      cp.execCommand ("Copy");
    }
}

function ch_open_menu2(e)
{
    var e = e || window.event;
    var el, x, y, login, login2;
    el = document.getElementById('user_menu2');
    var o = e.target || e.srcElement;
    if (o.tagName !== "SPAN") 
        return true;
    x = e.clientX + document.documentElement.scrollLeft + document.body.scrollLeft - 4;
    y = e.clientY + getScrollTop();

	BodyHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;	
    y -= (e.clientY + 72 > BodyHeight) ? 70 : 2;
    login = o.innerHTML;
    e.returnValue=false;
    login2 = login;
    while (login2.indexOf(' ') >=0) login2 = login2.replace (' ', '%20');
    while (login2.indexOf('+') >=0) login2 = login2.replace ('+', '%2B');
    while (login2.indexOf('#') >=0) login2 = login2.replace ('#', '%23');
    while (login2.indexOf('?') >=0) login2 = login2.replace ('?', '%3F');

    el.innerHTML = '<a class="usermenulink" href="javascript:parent.lvl_array(\''+login+'\');ch_hmenu2()">[]</a>'+
	'<a class="usermenulink" href="javascript:parent.say_private(\''+login+'\');ch_hmenu2()">Приват</a>'+
    '<a class="usermenulink" href="/ipers/'+login2+'" target="_blank" onclick="ch_hmenu2();return true;">Информация</a>'+
    '<a class="usermenulink" href="javascript:ch_copy_nick(\''+login+'\');ch_hmenu2()">Копировать ник</a>'+
    '<a class="usermenulink" href="javascript:ch_set_ignor(\''+login+'\');ch_hmenu2()">Игнорировать</a>';

    el.style.left = x + "px";
    el.style.top  = y + "px";
    el.style.visibility = "visible";
    
    return false;
}

function ch_hmenu2()
{
    document.getElementById("user_menu2").style.visibility = "hidden";
    document.getElementById("user_menu2").style.top="0px";
    parent.frames['ch_buttons'].document.FBT.text.focus();
}

function ch_close_menu2(e)
{
    var e = e || window.event;
    var te = e.relatedTarget || e.toElement;
    if (e && te)
    {
        var cls = te.className;
        if (cls === 'usermenulink' || cls === 'usermenu') return;
    }
    document.getElementById("user_menu2").style.visibility = "hidden";
    document.getElementById("user_menu2").style.top="0px";
    return false;
}

function to_what_who(e)
{
    var e = e || window.event;
    var o = e.target || e.srcElement;
    if (o.tagName === "SPAN")
    {
        var login=o.innerHTML;
        if (o.title !== null && o.title.length>0) login=o.title;
        if (login.charAt(0) === '%')
        {
            login = login.replace ('%', '');
            parent.say_private (login);
        }
        else
            parent.say_to(login);
    }
    
    return false;
}

function ins_smile(smile)
{
    parent.frames['ch_buttons'].document.FBT.text.focus();
    parent.frames['ch_buttons'].document.FBT.text.value += ' :'+smile+': ';
}

function add_msg_system(text)
{
    var myRe = /script/ig;       
    var pr = /^\s(\%\<[^\>]{2,20}\>\s?)+$/;
    var s = "";
    text = text.replace(myRe,'скрипт');

    var spl = text.split("<BR>");
    for(var k=0; k<spl.length; k++)
    {
        var txt = spl[k];
        if(txt.length > 8)
        {
            var re = /\<font\s$/;
            if(re.test(txt)) continue;

            var i,j=0;
            for(i=0; i < sm.length; i++)
            {
                while(txt.indexOf(':'+sm[i]+':') >= 0)
                {
                    txt = txt.replace(':'+sm[i]+':', smilesimgpath + 'smiles_' + sm[i] + '.gif ' + smilesimgstyle+sm[i]+'\')">');
                    if (++j >= maxsmiles) break;
                }
                if(j >= maxsmiles) break;
            }
            if(txt.indexOf('<SPL>') > 0)
            {
                var msgp = txt.split('<SPL>');

                var j = msgp[1].indexOf('<SPAN>');
                var i = msgp[1].indexOf('</SPAN>');
                var user2;
                user2 = msgp[1].substring(j+6,i);

                if(msgp[2] !== '')
                {
                    msgp[2] = ' '+msgp[2];
                    if(pr.test (msgp[2]))
                    {
                        msgp[1] = '>>> '+msgp[1];
                        while(msgp[2].indexOf('>') >= 0) msgp[2] = msgp[2].replace('>', ':');
                        while(msgp[2].indexOf('%<') >= 0) msgp[2] = msgp[2].replace('%<', '> ');

                        if(user2 !== '') msgp[1] = msgp[1].replace('<SPAN>','<SPAN title="%'+user2+'">');
                        if(msgp[2].indexOf ('> '+user+':') >= 0)
                        {
                            if(user2 !== '') msgp[2] = msgp[2].replace(user,'<SPAN title="%'+user2+'">'+user+'</SPAN>');
                            msgp[0] = msgp[0].replace('<font class=chattime>','<font class=prchattime>');
                        }
                    }
                    else
                    {
                        while(msgp[2].indexOf('<') >= 0) msgp[2] = msgp[2].replace('<', '');
                        while(msgp[2].indexOf('>') >= 0) msgp[2] = msgp[2].replace('>', ':');

                        if(msgp[2].indexOf (' '+user+':') >= 0)
                        {
                            if(user2 !== '') msgp[2] = msgp[2].replace(' '+user,' <SPAN title="'+user2+'">'+user+'</SPAN>');
                            msgp[0] = msgp[0].replace('<font class=chattime>','<font class=yochattime>');
                        }

                        msgp[2] = '&nbsp;для'+msgp[2];
                    }
                }
                txt = msgp.join('');
            }
            s += txt + "<BR>";
        }
    }
    e_m = get_by_id ('msg_system');
    e_m.innerHTML += s;
	window.scrollBy(0,65000);//SmartScroll;//SmartScroll
}

function add_msg(text)
{
    var myRe = /script/ig;       
    var pr = /^\s(\%\<[^\>]{2,20}\>\s?)+$/;
    var s = "";
    text = text.replace(myRe,'скрипт');

    var spl = text.split("<BR>");
    for(var k=0; k<spl.length; k++)
    {
        var txt = spl[k];
        if(txt.length > 8)
        {
            var re = /\<font\s$/;
            if(re.test(txt)) continue;

            var i,j=0;
            for(i=0; i < sm.length; i++)
            {
                while(txt.indexOf(':'+sm[i]+':') >= 0)
                {
                    txt = txt.replace(':'+sm[i]+':', smilesimgpath + 'smiles_' + sm[i] + '.gif ' + smilesimgstyle+sm[i]+'\')">');
                    if (++j >= maxsmiles) break;
                }
                if(j >= maxsmiles) break;
            }
            if(txt.indexOf('<SPL>') > 0)
            {
                var msgp = txt.split('<SPL>');

                var j = msgp[1].indexOf('<SPAN>');
                var i = msgp[1].indexOf('</SPAN>');
                var user2;
                user2 = msgp[1].substring(j+6,i);

                if(msgp[2] !== '')
                {
                    msgp[2] = ' '+msgp[2];
                    if(pr.test (msgp[2]))
                    {
                        msgp[1] = '>>> '+msgp[1];
                        while(msgp[2].indexOf('>') >= 0) msgp[2] = msgp[2].replace('>', ':');
                        while(msgp[2].indexOf('%<') >= 0) msgp[2] = msgp[2].replace('%<', '> ');

                        if(user2 !== '') msgp[1] = msgp[1].replace('<SPAN>','<SPAN title="%'+user2+'">');
                        if(msgp[2].indexOf ('> '+user+':') >= 0)
                        {
                            if(user2 !== '') msgp[2] = msgp[2].replace(user,'<SPAN title="%'+user2+'">'+user+'</SPAN>');
                            msgp[0] = msgp[0].replace('<font class=chattime>','<font class=prchattime>');
                        }
                    }
                    else
                    {
                        while(msgp[2].indexOf('<') >= 0) msgp[2] = msgp[2].replace('<', '');
                        while(msgp[2].indexOf('>') >= 0) msgp[2] = msgp[2].replace('>', ':');

                        if(msgp[2].indexOf (' '+user+':') >= 0)
                        {
                            if(user2 !== '') msgp[2] = msgp[2].replace(' '+user,' <SPAN title="'+user2+'">'+user+'</SPAN>');
                            msgp[0] = msgp[0].replace('<font class=chattime>','<font class=yochattime>');
                        }

                        msgp[2] = '&nbsp;для'+msgp[2];
                    }
                }
                txt = msgp.join('');
            }
            s += txt + "<BR>";
        }
    }
    e_m = get_by_id ('msg');
    e_m.innerHTML += s;
	window.scrollBy(0,65000);//SmartScroll;//SmartScroll
}

function add_msg_trade(text)
{
    var myRe = /script/ig;       
    var pr = /^\s(\%\<[^\>]{2,20}\>\s?)+$/;
    var s = "";
    text = text.replace(myRe,'скрипт');

    var spl = text.split("<BR>");
    for(var k=0; k<spl.length; k++)
    {
        var txt = spl[k];
        if(txt.length > 8)
        {
            var re = /\<font\s$/;
            if(re.test(txt)) continue;

            var i,j=0;
            for(i=0; i < sm.length; i++)
            {
                while(txt.indexOf(':'+sm[i]+':') >= 0)
                {
                    txt = txt.replace(':'+sm[i]+':', smilesimgpath + 'smiles_' + sm[i] + '.gif ' + smilesimgstyle+sm[i]+'\')">');
                    if (++j >= maxsmiles) break;
                }
                if(j >= maxsmiles) break;
            }
            if(txt.indexOf('<SPL>') > 0)
            {
                var msgp = txt.split('<SPL>');

                var j = msgp[1].indexOf('<SPAN>');
                var i = msgp[1].indexOf('</SPAN>');
                var user2;
                user2 = msgp[1].substring(j+6,i);

                if(msgp[2] !== '')
                {
                    msgp[2] = ' '+msgp[2];
                    if(pr.test (msgp[2]))
                    {
                        msgp[1] = '>>> '+msgp[1];
                        while(msgp[2].indexOf('>') >= 0) msgp[2] = msgp[2].replace('>', ':');
                        while(msgp[2].indexOf('%<') >= 0) msgp[2] = msgp[2].replace('%<', '> ');

                        if(user2 !== '') msgp[1] = msgp[1].replace('<SPAN>','<SPAN title="%'+user2+'">');
                        if(msgp[2].indexOf ('> '+user+':') >= 0)
                        {
                            if(user2 !== '') msgp[2] = msgp[2].replace(user,'<SPAN title="%'+user2+'">'+user+'</SPAN>');
                            msgp[0] = msgp[0].replace('<font class=chattime>','<font class=prchattime>');
                        }
                    }
                    else
                    {
                        while(msgp[2].indexOf('<') >= 0) msgp[2] = msgp[2].replace('<', '');
                        while(msgp[2].indexOf('>') >= 0) msgp[2] = msgp[2].replace('>', ':');

                        if(msgp[2].indexOf (' '+user+':') >= 0)
                        {
                            if(user2 !== '') msgp[2] = msgp[2].replace(' '+user,' <SPAN title="'+user2+'">'+user+'</SPAN>');
                            msgp[0] = msgp[0].replace('<font class=chattime>','<font class=yochattime>');
                        }

                        msgp[2] = '&nbsp;для'+msgp[2];
                    }
                }
                txt = msgp.join('');
            }
            s += txt + "<BR>";
        }
    }
    e_m = get_by_id ('msg_trade');
    e_m.innerHTML += s;
	window.scrollBy(0,65000);//SmartScroll;//SmartScroll
}

function add_msg_clan(text)
{
    var myRe = /script/ig;       
    var pr = /^\s(\%\<[^\>]{2,20}\>\s?)+$/;
    var s = "";
    text = text.replace(myRe,'скрипт');

    var spl = text.split("<BR>");
    for(var k=0; k<spl.length; k++)
    {
        var txt = spl[k];
        if(txt.length > 8)
        {
            var re = /\<font\s$/;
            if(re.test(txt)) continue;

            var i,j=0;
            for(i=0; i < sm.length; i++)
            {
                while(txt.indexOf(':'+sm[i]+':') >= 0)
                {
                    txt = txt.replace(':'+sm[i]+':', smilesimgpath + 'smiles_' + sm[i] + '.gif ' + smilesimgstyle+sm[i]+'\')">');
                    if (++j >= maxsmiles) break;
                }
                if(j >= maxsmiles) break;
            }
            if(txt.indexOf('<SPL>') > 0)
            {
                var msgp = txt.split('<SPL>');

                var j = msgp[1].indexOf('<SPAN>');
                var i = msgp[1].indexOf('</SPAN>');
                var user2;
                user2 = msgp[1].substring(j+6,i);

                if(msgp[2] !== '')
                {
                    msgp[2] = ' '+msgp[2];
                    if(pr.test (msgp[2]))
                    {
                        msgp[1] = '>>> '+msgp[1];
                        while(msgp[2].indexOf('>') >= 0) msgp[2] = msgp[2].replace('>', ':');
                        while(msgp[2].indexOf('%<') >= 0) msgp[2] = msgp[2].replace('%<', '> ');

                        if(user2 !== '') msgp[1] = msgp[1].replace('<SPAN>','<SPAN title="%'+user2+'">');
                        if(msgp[2].indexOf ('> '+user+':') >= 0)
                        {
                            if(user2 !== '') msgp[2] = msgp[2].replace(user,'<SPAN title="%'+user2+'">'+user+'</SPAN>');
                            msgp[0] = msgp[0].replace('<font class=chattime>','<font class=prchattime>');
                        }
                    }
                    else
                    {
                        while(msgp[2].indexOf('<') >= 0) msgp[2] = msgp[2].replace('<', '');
                        while(msgp[2].indexOf('>') >= 0) msgp[2] = msgp[2].replace('>', ':');

                        if(msgp[2].indexOf (' '+user+':') >= 0)
                        {
                            if(user2 !== '') msgp[2] = msgp[2].replace(' '+user,' <SPAN title="'+user2+'">'+user+'</SPAN>');
                            msgp[0] = msgp[0].replace('<font class=chattime>','<font class=yochattime>');
                        }

                        msgp[2] = '&nbsp;для'+msgp[2];
                    }
                }
                txt = msgp.join('');
            }
            s += txt + "<BR>";
        }
    }
    e_m = get_by_id ('msg_clan');
    e_m.innerHTML += s;
	window.scrollBy(0,65000);//SmartScroll;//SmartScroll
}

function KillSmart() {
t=clearTimeout(t);
}

function SmartScroll(cc) {
KillSmart();
    if (cc<200){
        window.scrollBy(0,1);
	cc=cc+1;
        t=setTimeout('//SmartScroll('+cc+')',30);
    }
    else {
    KillSmart();
    return false;
   }
}
function get_by_id(name)
{
    if (document.getElementById) return document.getElementById(name);
    else return false;
  //else if (document.all) return document.all[name];
}
