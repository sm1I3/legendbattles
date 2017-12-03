var pg_id = 3;
var bavail = new Array();
var logged_in_account = new Object();
var logged_in_cell = new Object();

function ajaxParse(data)
{
    var arr = data.split('^');
    
    var butt = arr[0].split('@');
    bavail['inf'][0] = butt[0];
    bavail['inv'][0] = butt[1];
    bavail['up'][0] = butt[2];
    
    var bact = arr[1].split('@');
    for(var i=0; i<bact.length; i++)
    {
        basic_act[i] = bact[i];
    }
    
    var aact = arr[2].split('@')
    if (aact[0] == 'account')
    {
        for(i=1; i<aact.length; i++)
        {
            bank_account_act[i-1] = aact[i];
        }
    }
    if (aact[0] == 'cell')
    {
        for(i=1; i<aact.length; i++)
        {
            bank_cell_act[i-1] = aact[i];
        }
    }
    
    return arr[3];
}

function view_build_top()
{
    if(build[11])
    {
        parent.frames["ch_list"].location = "/ch.php?lo=1";
    }

    ins_HP();
    d.write('<table cellpadding=4 cellspacing=0 border=0 width=100%><tr><td bgcolor=#FCFAF3><table cellpadding=0 cellspacing=0 border=0>');
    d.write('<tr><td rowspan=3><font class=nick>'+sh_align(build[2],0)+sh_sign(build[3],build[4],build[5])+'<B>'+build[0]+'</B>['+build[1]+']&nbsp;</font></td><td><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=2><br><img src=http://img.legendbattles.ru/image/gameplay/hp.gif width=0 height=6 border=0 id=fHP vspace=0 align=absmiddle><img src=http://img.legendbattles.ru/image/gameplay/nohp.gif width=0 height=6 border=0 id=eHP vspace=0 align=absmiddle></td><td rowspan=3 class=hpbar><div id=hbar></div></td></tr>');
    d.write('<tr><td bgcolor=#ffffff><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1></td></tr>');
    d.write('<tr><td><img src=http://img.legendbattles.ru/image/gameplay/ma.gif width=0 height=6 border=0 id=fMP vspace=0 align=absmiddle><img src=http://img.legendbattles.ru/image/gameplay/noma.gif width=0 height=6 border=0 id=eMP vspace=0 align=absmiddle></td></tr>');
    d.write('</table></td><td bgcolor="#FCFAF3"><div align="center" id="ButtonPlace">'+ButtonGen()+'</div></td><td bgcolor=#FCFAF3><div align=right><a href="javascript: top.exit_redir()"><img src=http://img.legendbattles.ru/image/exit.gif align=absmiddle width=15 height=15 border=0></a></div></td></tr></table>');
    cha_HP();
        
    d.write('<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#FFFFFF><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1></td></tr><tr><td bgcolor=#B9A05C><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1></td></tr><tr><td bgcolor=#F3ECD7><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=2></td></tr><tr><td bgcolor=#FFFFFF><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=10></td></tr></table>');
}

function view_build_bottom()
{
    d.write('<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#FFFFFF><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=4></td></tr><tr><td align=center>'+view_t()+'</td></tr><tr><td bgcolor=#FFFFFF><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=10></td></tr></table>');
}

function ButtonGen()
{
    var str = '';
    bavail = new Array();
    for(var i=0; i<mapbt.length; i++)
    {
        bavail[mapbt[i][0]] = [mapbt[i][2],mapbt[i][3]];
        str += ' <input type=button class=fr_but id="'+mapbt[i][0]+'" value="'+mapbt[i][1]+'" onclick=\'ButClick("'+mapbt[i][0]+'")\'>';
    }
    return str;
}

function ButClick(id)
{
    var goloc = '';
    switch(id)
    {
        case 'inf': goloc = 'main.php?get_id=56&act=10&go=inf&vcode='+bavail[id][0]; break;
        case 'inv': goloc = 'main.php?get_id=56&act=10&go=inv&vcode='+bavail[id][0]; break;
        case 'up': goloc = 'main.php?get_id=56&act=10&go=up&vcode='+bavail[id][0]; break;
    }
    if(goloc)
    {
        for(var j=0; j<bavail[id][1].length; j++) goloc += '&'+bavail[id][1][j][0]+'='+bavail[id][1][j][1];
        location = goloc;
    }    
}

function view_bank()
{
    //div_tunnels = false;
    cdiv = document.getElementById('content');
    while(cdiv.children.length > 0)
    {
        cdiv.removeChild(cdiv.lastChild);
    }
    document.getElementById('content').innerHTML = '<table cellpadding="0" cellspacing="0" border="0" align="center" width="760"><tr><td><img src="http://img.legendbattles.ru/image/gameplay/bank/bank.jpg" width="760" height="255" border="0"></td></tr><tr><td><img src="http://img.legendbattles.ru/image/1x1.gif" width="1" height="2"></td></tr><tr><td></td></tr><tr><td><img src="http://img.legendbattles.ru/image/1x1.gif" width="1" height="2"></td></tr></table><table cellpadding="0" cellspacing="0" border="0" align="center" width="760"><tr><td id="Dynamic" width="100%"></td></tr></table><br />'; 
    
    show_main();
}

function show_main()
{
    document.getElementById('Dynamic').innerHTML = '';
    show_menu();
}

function show_menu()
{
    var elements = '';
    elements += '<table cellpadding="2" cellspacing="1" border="0" align="center" width="100%" bgcolor="#CCCCCC">';
    
    if (bank[0] == 2)
    {
        if (bank[3] == 1)
            elements += '<tr><td width="33%" bgcolor="#f5f5f5" align="center"><a onclick="show_accounts(); return false;" href="#"><font class="zaya"><b>Счета</b></font></a></td><td width="33%" bgcolor="#f5f5f5" align="center"><a href="#" onclick="show_cells(); return false;"><font class="zaya"><b>Ячейки</b></font></a></td><td width="33%" bgcolor="#f5f5f5" align="center"><a onclick="show_shares(); return false;" href="#"><font class="zaya"><b>Акции</b></font></a></td></tr>';
        else
            elements += '<tr><td width="50%" bgcolor="#f5f5f5" align="center"><a onclick="show_accounts(); return false;" href="#"><font class="zaya"><b>Счета</b></font></a></td><td width="50%" bgcolor="#f5f5f5" align="center"><a href="#" onclick="show_cells(); return false;"><font class="zaya"><b>Ячейки</b></font></a></td></tr>';
    }
        
    if (bank[1] == 1)
        elements += '<tr><td width="33%" bgcolor="#f5f5f5" align="center"><a href="main.php?bank_act=9" ><font class="zaya"><b>Настройки банка</b></font></a></td><td width="33%" bgcolor="#f5f5f5" align="center"><a href="main.php?bank_act=94"><font class="zaya"><b>Управлене кредитами</b></font></a></td><td width="33%" bgcolor="#f5f5f5" align="center"><a href="main.php?bank_act=96"><font class="zaya"><b>Конфискованные вещи</b></font></a></td></tr>';
    
    elements += '</table>';
    
    document.getElementById('Dynamic').innerHTML = elements;
}

function show_accounts()
{
    document.getElementById('Dynamic').innerHTML = '<center>Загрузка...</center>';
    AjaxGet('bank_ajax.php?action=accounts_get&pg_id='+pg_id+'&vcode='+basic_act[0]+'&r='+Math.random()+'', function(xdata) {
        var data = ajaxParse(xdata);
        var arr = data.split('@');
        document.getElementById('Dynamic').innerHTML = '';
        show_menu();
        
        if (arr[0] != '')
        {
            var table = '<blockquote>Ваши счета:<br /><img src="http://img.legendbattles.ru/image/1x1.gif" width="1" height="3"><br /><table width=90% border=0 align=center cellpadding=0 cellspacing=0><tr><td bgcolor=#C96C21><table width=100% border=0 cellspacing=1 cellpadding=3 class="freetxt"><tr><td bgcolor="#FFFFFF"><b>Номер счёта</b></td><td bgcolor="#FFFFFF"><b>Владелец</b></td><td bgcolor="#FFFFFF"><b>Тип счёта</b></td><td bgcolor="#FFFFFF"><b>Оплачен до</b></td><td bgcolor="#FFFFFF">&nbsp;</td></tr>';
            var accounts = arr[0].split('|');
            for(var k in accounts)
            {
                acc = accounts[k].split('%');
                table += '<tr><td bgcolor="#FFFFFF">'+acc[0]+'</td><td bgcolor="#FFFFFF">'+(acc[1]==1 ? 'Личный счёт' : 'Счёт клана')+'</td><td bgcolor="#FFFFFF">'+(acc[2]==0?'NV': (acc[2]==1?'$':'DNV'))+'</td><td bgcolor="#FFFFFF">'+(acc[3]!='0' ? acc[3] + (acc[4]==1?' (Просрочен)':'') : 'Не ограничен')+'</td><td bgcolor="#FFFFFF" align="center"><a onclick="show_account_login('+acc[0]+', \''+acc[5]+'\', \''+acc[6]+'\'); return false;" href="#">Войти</a></td></tr>';
            }
            table += '</table></td></tr></table></blockquote>';
            document.getElementById('Dynamic').innerHTML += table;
        } else
            document.getElementById('Dynamic').innerHTML += '<blockquote>У вас нет счетов в этом банке.</blockquote>';
        
        document.getElementById('Dynamic').innerHTML += '<blockquote>';
        if (arr[1] == 0 && arr[7] > -1) document.getElementById('Dynamic').innerHTML += '<a onclick="show_account_create(1, '+arr[7]+', '+arr[8]+'); return false;" href="#">Открыть NV счёт. (Стоимость открытия: '+arr[7]+' NV. Стоимость обслуживания в месяц: '+arr[8]+' NV)</a><br />';
        if (arr[2] == 0 && arr[9] > -1) document.getElementById('Dynamic').innerHTML += '<a onclick="show_account_create(2, '+arr[9]+', '+arr[10]+'); return false;" href="#">Открыть $ счёт. (Стоимость открытия: '+arr[9]+' NV. Стоимость обслуживания в месяц: '+arr[10]+' NV)</a><br />';
        if (arr[3] == 0 && arr[11] > -1) document.getElementById('Dynamic').innerHTML += '<a onclick="show_account_create(3, '+arr[11]+', '+arr[12]+'); return false;" href="#">Открыть DNV счёт. (Стоимость открытия: '+arr[11]+' NV. Стоимость обслуживания в месяц: '+arr[12]+' NV)</a><br />';
        if (bank[2] == 2 && arr[4] == 0 && arr[13] > -1) document.getElementById('Dynamic').innerHTML += '<a onclick="show_account_create(4, '+arr[13]+', '+arr[14]+'); return false;" href="#">Открыть клановый NV счёт. (Стоимость открытия: '+arr[13]+' NV. Стоимость обслуживания в месяц: '+arr[14]+' NV)</a><br />';
        if (bank[2] == 2 && arr[5] == 0 && arr[15] > -1) document.getElementById('Dynamic').innerHTML += '<a onclick="show_account_create(5, '+arr[15]+', '+arr[16]+'); return false;" href="#">Открыть клановый $ счёт. (Стоимость открытия: '+arr[15]+' NV. Стоимость обслуживания в месяц: '+arr[16]+' NV)</a><br />';
        if (bank[2] == 2 && arr[6] == 0 && arr[17] > -1) document.getElementById('Dynamic').innerHTML += '<a onclick="show_account_create(6, '+arr[17]+', '+arr[18]+'); return false;" href="#">Открыть клановый DNV счёт. (Стоимость открытия: '+arr[17]+' NV. Стоимость обслуживания в месяц: '+arr[18]+' NV)</a><br />';
        document.getElementById('Dynamic').innerHTML += '</blockquote>';
    });
}

function show_account_create(account_type, price1, price2)
{
    document.getElementById('Dynamic').innerHTML = '';
    show_menu();
    var type = '';
    switch(account_type)
    {
        case 1: type = 'Личный NV'; break;
        case 2: type = 'Личный $'; break;
        case 3: type = 'Личный DNV'; break;
        case 4: type = 'Клановый NV'; break;
        case 5: type = 'Клановый $'; break;
        case 6: type = 'Клановый DNV'; break;
    }
    var account = '<div id="create_account"><blockquote><font class=freetxt><b>Стоимость открытия игрового счета '+price1+' NV.</b></blockquote><br>' +
    '<blockquote><table width="50%" border="0" cellspacing="0" cellpadding="0"><tr><td>'+
    '<font class=freetxt><b>Пароль: </b></font></td><td><input name="bpsw" id="bpsw" type="password" class="LogintextBox4"></td></tr><tr><td>'+
    '<font class=freetxt><b>Подтвердите пароль: </b></font></td><td><input name="bpsw1" id="bpsw1" type="password" class="LogintextBox4"></td></tr><tr><td>'+
    '<font class=freetxt><b>E-mail: </b></font></td><td><input name="email" id="email" type="text" class="LogintextBox4" maxlength="30"></td></tr><tr><td>'+
    '<font class=freetxt><b>Тип счета: </b></font></td><td><font class="freetxt">'+type+'</td></tr><tr><td colspan="2"><br>' +
    '<div align=center><input type="submit" value="Открыть счет" onclick="create_account('+account_type+');" class=lbut>&nbsp;&nbsp;<input type=button value="Отмена" onclick="show_accounts();" class=lbut></div></td></tr></table></blockquote><br /></div>';
    document.getElementById('Dynamic').innerHTML += account;
}

function show_account_login(account_id, forgot_code, login_code)
{
    document.getElementById('Dynamic').innerHTML = '';
    show_menu();
    var account = '<blockquote>';
    if (forgot_code != '')
        account += '<a onclick="el = document.getElementById(\'forgot_div\'); if (el.style.display == \'block\') el.style.display = \'none\'; else el.style.display = \'block\'; return false;" href="#">Забыл пароль</a><br><br><div id="forgot_div" style="display: none;">'+
    '<table width="50%"  border="0" cellspacing="0" cellpadding="0"><tr><td>'+
    '<font class=freetxt><b>Номер счета: </b></font></td><td><input name="forgot_account" id="forgot_account" type="text" class="LogintextBox4" maxlength="11" value="'+account_id+'"></td></tr><tr><td colspan="2"><div align="center"><input type="button" value="Выслать" onclick="account_forgot_password('+account_id+', \''+forgot_code+'\'); return false;" class=lbut></div></td></tr></table><br />'+
    '</div>';
    
    account += '<table width="50%"  border="0" cellspacing="0" cellpadding="0"><tr><td>'+
    '<font class=freetxt><b>Номер счета: </b></font></td><td><input onkeypress="if (event.keyCode == 13) { account_login('+account_id+', \''+login_code+'\'); return false; }" name="account" id="login_account" type="text" class="LogintextBox4" maxlength="11" value="'+account_id+'"></td></tr><tr><td>'+
    '<font class=freetxt><b>Пароль: </b></font></td><td><input onkeypress="if (event.keyCode == 13) { account_login('+account_id+', \''+login_code+'\'); return false; }" name="password" id="login_password" type="password" class="LogintextBox4"></td></tr><tr><td colspan="2"><br />'+
    '<div align=center><input type="submit" onclick="account_login('+account_id+', \''+login_code+'\'); return false;" value="Работать со счетом" class=lbut></div></td></tr></table><br /></blockquote>';
    document.getElementById('Dynamic').innerHTML += account;
    document.getElementById('login_password').focus();
}

function create_account(account_type)
{
    var pwd = document.getElementById('bpsw').value;
    var pwd2 = document.getElementById('bpsw1').value;
    var email = document.getElementById('email').value;
    if (pwd=='') { alert('Поле "Пароль" обязательно для заполнения.'); return false; }
    else if (pwd2=='') { alert('Поле "Подтвердите пароль" обязательно для заполнения.'); return false; }
    else if (pwd!=pwd2) { alert('Поля "Пароль" и "Подтвердите пароль" не совпадают.'); return false; }
    else if (email=='') { alert('Поле "E-mail" обязательно для заполнения.'); return false; }
    
    data = new Array();
    data['action'] = 'account_create';
    data['pwd'] = pwd;
    data['pwd2'] = pwd2;
    data['email'] = email;
    data['type'] = account_type;
    data['vcode'] = bank_account_act[0];
    data['pg_id'] = pg_id;
    AjaxPost('bank_ajax.php', data, function(data) {
        data = ajaxParse(data);
        var arr = data.split('@');
        if (arr[0] != 'ERROR')
            show_accounts();
        else
            MessBoxDiv(arr[1]);
    });
    
}

function account_forgot_password(account_id, vcode)
{
    var account = document.getElementById('forgot_account').value;
    if (account=='') { alert('Поле "Номер счета" обязательно для заполнения.'); return false; }
    
    data = new Array();
    data['action'] = 'account_forgot_password';
    data['account'] = account;
    data['vcode'] = vcode;
    data['pg_id'] = pg_id;
    AjaxPost('bank_ajax.php', data, function(data) {
        data = ajaxParse(data);
        var arr = data.split('@');
        if (arr[0] != 'ERROR')
        {
            show_accounts();
        }
        else
        {
            show_account_login(arr[2], arr[3], arr[4]);
        }
        MessBoxDiv(arr[1]);
    });
}

function account_login(account_id, vcode)
{
    var account = document.getElementById('login_account').value;
    var pwd = document.getElementById('login_password').value;
    if (account=='') { alert('Поле "Номер счета" обязательно для заполнения.'); return false; }
    else if (pwd=='') { alert('Поле "Пароль" обязательно для заполнения.'); return false; }
    
    data = new Array();
    data['action'] = 'account_login';
    data['account'] = account;
    data['password'] = pwd;
    data['vcode'] = vcode;
    data['pg_id'] = pg_id;
    AjaxPost('bank_ajax.php', data, function(data) {
        data = ajaxParse(data);
        var arr = data.split('@');
        if (arr[0] == 'SUCCESS')
            show_account(arr[2]);
        else
        {
            show_account_login(arr[2], arr[3], arr[4]);
            MessBoxDiv(arr[1]);
        }
    });
}

function show_account(account_id)
{
    document.getElementById('Dynamic').innerHTML = '';
    show_menu();
    AjaxGet('bank_ajax.php?action=account_get_info&account='+account_id+'&pg_id='+pg_id+'&vcode='+bank_account_act[10], function(xdata) {
        data = ajaxParse(xdata);
        if (data.substr(0, 5) == 'ERROR')
        {
            MessBoxDiv(data.substring(6));
        } 
        else 
        {
            var arr = data.split('|');
            var account = '';
            var mtype = (arr[1]==0?'NV': (arr[1]==1?'$':'DNV'));
            logged_in_account.account_id = arr[0];
            logged_in_account.account_type = arr[1];
                
            account += '<blockquote><table border="0" width="90%"><tr><td><font class=freetxt><b>Номер счета:</b> '+arr[0]+'<br><b>Денег на счете: </b>'+arr[2]+' '+mtype+'<br><b>Владелец счета: </b>'+arr[3]+'<br><b>E-Mail: </b>'+arr[4].split('+').join('@')+'</font></td><td>&nbsp;&nbsp;&nbsp;</td><td>';
            if (arr[11] == 2)
                account += '<a href="#" onclick="document.getElementById(\'tr_hist\').style.display = (document.getElementById(\'tr_hist\').style.display == \'block\' ? \'none\' : \'block\'); return false;">История платежей</a>';
            else
                account += '&nbsp;';
            account += '</td></tr>';
            
            if (arr[11] == 2)
            {
                account += '<tr id="tr_hist" style="display: none;"><td colspan="3"><font class="freetxt"><b>История платежей</b></font><br><br>' +
                           '<input type=text id="date_from" name="date_from" class="calendat_input"> <img src="http://img.legendbattles.ru/image/pinfo/cms_calendar.gif" align="absmiddle" id="from_d" title="" title="" style="cursor: pointer;" border="0" width="18" height="18"> <input type=text id="date_to" name="date_to" class="calendat_input"> <img src="http://img.legendbattles.ru/image/pinfo/cms_calendar.gif" align="absmiddle" id="from_t" title="" title="" style="cursor: pointer;" border="0" width="18" height="18">' +
                           '<input type=button name="show" value="Показать" onclick="show_account_history('+account_id+');" /><br><div id="account_history"></div>' +
                           '</td></tr>';
            }
            
            account += '</table></blockquote><blockquote><font class=freetxt><b>Операции со счетом</b><br><br></font><table width="100%" border="0" cellspacing="0" cellpadding="0" class="freetxt">';
            
            if(arr[5] == 1)
            {
                account += '<tr><td><font class="freetxt"><b>Положить <input type="text" onkeypress="if (event.keyCode == 13) { return false; }" name="acc_money_put" id="acc_money_put" class=logintextbox5> '+mtype+' на счет</b></font>&nbsp;&nbsp;<input type="button" onclick="account_money_put('+arr[0]+');" value="Ок" class=lbut></td>';
                if(arr[6] == 1)
                {
                    account += '<td><b><font class="freetxt">Снять <input type="text" onkeypress="if (event.keyCode == 13) { return false; }" name="acc_money_get" id="acc_money_get" class=logintextbox5> '+mtype+' со счета</b></font>&nbsp;&nbsp;<input type="button" onclick="account_money_get('+arr[0]+');" value="Ок" class="lbut"></td></tr><tr><td colspan="2">&nbsp;</td></tr>';
                    account += (arr[1] == 0 ? '<tr><td colspan="2"><font class=freetxt><b>Перевести <input type="text" onkeypress="if (event.keyCode == 13) { return false; }" name="acc_money_transfer" id="acc_money_transfer" class="logintextbox5"> '+mtype+' на счет № <input type="text" onkeypress="if (event.keyCode == 13) { return false; }" name="acc_account_transfer" id="acc_account_transfer" class="logintextbox4"><br />Цель перевода: <input type="text" onkeypress="if (event.keyCode == 13) { return false; }" name="acc_transfer_comment" id="acc_transfer_comment" class=logintextbox4></b>&nbsp;&nbsp;<input type="button" onclick="account_money_transfer('+arr[0]+');" value="Перевести" class=lbut></font></td></tr>' : '');
                }
                else
                {
                    account += '<td>&nbsp;</td></tr>'
                }
                account += '</table>';
            }
            
            if(arr[6] == 1)
            {
                account += '<br /><br /><font class=freetxt><b>Другие операции</b></font>';
                account += '<table width="100%" border="0" cellspacing="5" cellpadding="0" class="freetxt"><tr><td colspan="5"><font class="freetxt"><b>Новый пароль <input type="password" onkeypress="if (event.keyCode == 13) { return false; }" name="new_pwd" id="new_pwd" class="logintextbox2"> Повторить пароль <input type="password" onkeypress="if (event.keyCode == 13) { return false; }" name="new_pwd2" id="new_pwd2" class="logintextbox2"></b>&nbsp;&nbsp;<input type="button"  value="Поменять пароль" onclick="account_change_password('+arr[0]+');" class="lbut" /></td></tr><tr><td colspan="5"><font class="freetxt"><b>Новый E-mail <input type="text" onkeypress="if (event.keyCode == 13) { return false; }" name="new_email" id="new_email" class="logintextbox2" maxlength="30"></b>&nbsp;&nbsp;<input type="button" value="Поменять E-mail" onclick="account_change_email('+arr[0]+');" class="lbut"></td></tr></table>';
            }
                    
            if(arr[6] == 1 && arr[7] != '0')
            {
                if (arr[1] == 0)
                    account += '<table width="100%" border="0" cellspacing="5" cellpadding="0" class="freetxt"><tr><td colspan="5"><font class="freetxt"><b>Счёт оплачен до: '+arr[7]+'</b>&nbsp;&nbsp;(Стоимость пользования 30 дней: '+arr[8]+' NV)<br><input type="radio" name="pay" value="player" id="pay_player"><label for="pay_player">Продлить используя средства персонажа</label><br><input type="radio" name="pay" value="account" id="pay_account"><label for="pay_account">Продлить используя средства со счёта</label><br><br><input type="button" name="submit" onclick="account_pay('+arr[0]+');" value="Продлить" class="lbut"></td></tr></table>';
                else
                    account += '<table width="100%" border="0" cellspacing="5" cellpadding="0" class="freetxt"><tr><td colspan="5"><font class="freetxt"><b>Счёт оплачен до: '+arr[7]+'</b>&nbsp;&nbsp;(Стоимость пользования 30 дней: '+arr[8]+' NV)<br><input type="radio" name="pay" value="player" id="pay_player"><label for="pay_player">Продлить используя средства персонажа</label><br><br><input type="button" name="submit" onclick="account_pay('+arr[0]+');" value="Продлить" class="lbut"></td></tr></table>';
            }
                    
            if(arr[6] == 1)
            {
                account += '<table width="100%" border="0" cellspacing="5" cellpadding="0" class="freetxt"><tr><td colspan="2"><font class="freetxt"><b>Закрыть счет <input type="checkbox" name="close" value="1" id="close_account" class="lbut"></b>&nbsp;&nbsp;<input type="button" onclick="if (document.getElementById(\'close_account\').checked && confirm(\'Вы действительно хотите закрыть этот счёт?\')) account_close('+arr[0]+');" value="Ок" class="lbut" />'+(arr[10] > 0 ? '&nbsp;Стоимость закрытия: '+arr[10]+' NV' : '')+'</td></tr></table>';
            }
            
            account += '<table width="100%" border="0" cellspacing="5" cellpadding="0" class="freetxt"><tr><td colspan="5"><input type="submit" onclick="account_logout();" value="Закончить работу со счетом" class=lbut></td></tr></table></blockquote>';
            
            document.getElementById('Dynamic').innerHTML += account;
            
            if (arr[11] == 2)
            {
                Calendar.setup({
                    inputField : "date_from",
                    ifFormat   : "%Y-%m-%d",
                    button     : "from_d",
                    align      : "Br",
                    weekNumbers: false,
                    showsTime   : false,
                    timeFormat  : 24 
                });
                Calendar.setup({
                    inputField : "date_to",
                    ifFormat   : "%Y-%m-%d",
                    button     : "from_t",
                    align      : "Br",
                    weekNumbers: false,
                    showsTime   : false,
                    timeFormat  : 24 
                });
            }
        }
    });
}

function show_account_history(account_id)
{
    var date_from = document.getElementById('date_from').value;
    var date_to = document.getElementById('date_to').value;
    if (date_from == '') { alert('Введите начальную дату.'); return false; }
    if (date_to == '') { alert('Введите конечную дату.'); return false; }
    data = new Array();
    data['action'] = 'account_history_show';
    data['account'] = account_id;
    data['date_from'] = date_from;
    data['date_to'] = date_to;
    data['type'] = logged_in_account.account_type;
    data['vcode'] = bank_account_act[11];
    data['pg_id'] = pg_id;
    AjaxPost('bank_ajax.php', data, function(data) {
        data = ajaxParse(data);
        var str = '';
        if (data.length > 0)
        {
            str = '<table width=100% border=0 align=center cellpadding=0 cellspacing=0><tr><td bgcolor=#C96C21><table width=100% border=0 cellspacing=1 cellpadding=3 class="freetxt"><tr><td bgcolor="#FFFFFF"><b>Время</b></td><td bgcolor="#FFFFFF"><b>Действие</b></td><td bgcolor="#FFFFFF"><b>Пользователь</b></td><td bgcolor="#FFFFFF"><b>Сумма</b></td><td bgcolor="#FFFFFF"><b>Комментарии</b></td></tr>';
            var arr = data.split('%');
            for (var i in arr)
            {
                var row = arr[i].split('@');
                var act = row[0];
                var actions = ["", "Положил деньги", "Снял деньги", "Переведены на счёт ", "Получены со счёта ", "Открыл счёт", "Закрыл счёт", "Комиссия банка"];
                var action = actions[act];
                var comment = row[6];
                if (act == 4 || act == 5)
                    action += row[2];
                comment = comment.split('__PCNT__').join('%');
                comment = comment.split('__DOG__').join('@');
                comment = comment.split('__BIRD__').join('^');
                str += '<tr><td bgcolor="#FFFFFF">'+row[1]+'</td><td bgcolor="#FFFFFF">'+actions[act]+'</td><td bgcolor="#FFFFFF">'+row[4]+'</td><td bgcolor="#FFFFFF">'+row[5]+'</td><td bgcolor="#FFFFFF" align="center">'+row[6]+'</td></tr>';
            }
            str += '</table>';
        }
        document.getElementById('account_history').innerHTML = str;
    });
}

function account_logout()
{
    show_accounts();
}

function account_money_put(account_id)
{
    var money = parseFloat(document.getElementById('acc_money_put').value);
    if (isNaN(money)) { alert("Введите правильное количество денег."); return false; }
    
    data = new Array();
    data['action'] = 'account_money_put';
    data['account'] = account_id;
    data['money'] = money;
    data['type'] = logged_in_account.account_type;
    data['vcode'] = bank_account_act[3];
    data['pg_id'] = pg_id;
    AjaxPost('bank_ajax.php', data, function(data) {
        data = ajaxParse(data);
        var arr = data.split('@');
        if (arr[0] == 'SUCCESS')
        {
            MessBoxDiv("Операция совершена успешно.");
            show_account(arr[1]);
        }
        else
            MessBoxDiv(arr[1]);
    });
}

function account_money_get(account_id)
{
    var money = parseFloat(document.getElementById('acc_money_get').value);
    if (isNaN(money)) { alert("Введите правильное количество денег."); return false; }
    
    data = new Array();
    data['action'] = 'account_money_get';
    data['account'] = account_id;
    data['money'] = money;
    data['type'] = logged_in_account.account_type;
    data['vcode'] = bank_account_act[4];
    data['pg_id'] = pg_id;
    AjaxPost('bank_ajax.php', data, function(data) {
        data = ajaxParse(data);
        var arr = data.split('@');
        if (arr[0] == 'SUCCESS')
        {
            if (arr[2] > 0)
                MessBoxDiv("Операция совершена успешно. Комиссия банка: "+arr[2]+" NV");
            else
                MessBoxDiv("Операция совершена успешно.");
            show_account(arr[1]);
        }
        else
            MessBoxDiv(arr[1]);
    });
}

function account_money_transfer(account_id)
{
    var money = parseFloat(document.getElementById('acc_money_transfer').value);
    var account = parseInt(document.getElementById('acc_account_transfer').value);
    var comment = document.getElementById('acc_transfer_comment').value;
    if (isNaN(money)) { alert("Введите правильное количество денег."); return false; }
    if (isNaN(account)) { alert("Введите правильный номер счёта."); return false; }
    
    data = new Array();
    data['action'] = 'account_money_transfer';
    data['account'] = account_id;
    data['money'] = money;
    data['to_account'] = account;
    data['comment'] = comment;
    data['type'] = logged_in_account.account_type;
    data['vcode'] = bank_account_act[5];
    data['pg_id'] = pg_id;
    AjaxPost('bank_ajax.php', data, function(data) {
        data = ajaxParse(data);
        var arr = data.split('@');
        if (arr[0] == 'SUCCESS')
        {
            if (arr[2] > 0)
                MessBoxDiv("Операция совершена успешно. Комиссия банка: "+arr[2]+" NV");
            else
                MessBoxDiv("Операция совершена успешно.");
            show_account(arr[1]);
        }
        else
            MessBoxDiv(arr[1]);
    });
}

function account_change_password(account_id)
{
    var pwd = document.getElementById('new_pwd').value;
    var pwd2 = document.getElementById('new_pwd2').value;
    if (pwd == '') { alert('Поле "Новый пароль" обязательно для заполнения.'); return false; }
    if (pwd2 == '') { alert('Поле "Повторить пароль" обязательно для заполнения.'); return false; }
    if (pwd != pwd2) { alert('Поля "Новый пароль" и "Повторить пароль" должны совпадать.'); return false; }
    
    data = new Array();
    data['action'] = 'account_change_password';
    data['account'] = account_id;
    data['pwd'] = pwd;
    data['type'] = logged_in_account.account_type;
    data['vcode'] = bank_account_act[6];
    data['pg_id'] = pg_id;
    AjaxPost('bank_ajax.php', data, function(data) {
        data = ajaxParse(data);
        var arr = data.split('@');
        if (arr[0] == 'SUCCESS')
            MessBoxDiv("Пароль успешно изменён.");
        else
            MessBoxDiv(arr[1]);
    });
}

function account_change_email(account_id)
{
    var email = document.getElementById('new_email').value;
    if (email == '') { alert('Поле "Новый E-mail" обязательно для заполнения.'); return false; }
    
    data = new Array();
    data['action'] = 'account_change_email';
    data['account'] = account_id;
    data['email'] = email;
    data['type'] = logged_in_account.account_type;
    data['vcode'] = bank_account_act[7];
    data['pg_id'] = pg_id;
    AjaxPost('bank_ajax.php', data, function(data) {
        data = ajaxParse(data);
        var arr = data.split('@');
        if (arr[0] == 'SUCCESS')
        {
            show_account(arr[1]);
            MessBoxDiv("E-mail успешно изменён.");
        }
        else
            MessBoxDiv(arr[1]);
    });
}

function account_pay(account_id)
{
    if (!document.getElementById('pay_player').checked && !document.getElementById('pay_account').checked) { alert('Выберите способ оплаты.'); return false; }
    
    data = new Array();
    data['action'] = 'account_pay';
    data['account'] = account_id;
    data['pay'] = (document.getElementById('pay_player').checked ? 'player' : 'account');
    data['type'] = logged_in_account.account_type;
    data['vcode'] = bank_account_act[9];
    data['pg_id'] = pg_id;
    AjaxPost('bank_ajax.php', data, function(data) {
        data = ajaxParse(data);
        var arr = data.split('@');
        if (arr[0] == 'SUCCESS')
        {
            show_account(arr[1]);
            MessBoxDiv("Счёт успешно оплачен.");
        }
        else
            MessBoxDiv(arr[1]);
    });
}

function account_close(account_id)
{
    data = new Array();
    data['action'] = 'account_close';
    data['account'] = account_id;
    data['type'] = logged_in_account.account_type;
    data['vcode'] = bank_account_act[8];
    data['pg_id'] = pg_id;
    AjaxPost('bank_ajax.php', data, function(xdata) {
        var data = ajaxParse(xdata);
        var arr = data.split('@');
        if (arr[0] == 'SUCCESS')
        {
            show_accounts();
            MessBoxDiv("Счёт успешно закрыт, все средства возвращены владельцу."+(arr[2] > 0 ? " Комиссия за возврат средств: "+arr[2]+" NV" : ""));
        }
        else
            MessBoxDiv(arr[1]);
    });
}

function show_cells()
{
    document.getElementById('Dynamic').innerHTML = '<center>Загрузка...</center>';
    AjaxGet('bank_ajax.php?action=cells_get_status&pg_id='+pg_id+'&vcode='+basic_act[1]+'&r='+Math.random()+'', function(xdata){
        var data = ajaxParse(xdata);
        var arr = data.split('|');
        document.getElementById('Dynamic').innerHTML = '';
        show_menu();
        
        if (arr[0] != '')
        {
            var table = '<blockquote>Ваши ячейки:<br><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=3><br><table width=90% border=0 align=center cellpadding=0 cellspacing=0><tr><td bgcolor=#C96C21><table width=100% border=0 cellspacing=1 cellpadding=3 class="freetxt"><tr><td bgcolor="#FFFFFF"><b>Номер ячейки</b></td><td bgcolor="#FFFFFF"><b>Владелец</b></td><td bgcolor="#FFFFFF"><b>Тип ячейки</b></td><td bgcolor="#FFFFFF"><b>Оплачена до</b></td><td bgcolor="#FFFFFF">&nbsp;</td></tr>';
            var accounts = arr[0].split('@');
            for(var k in accounts)
            {
                acc = accounts[k].split('%');
                table += '<tr><td bgcolor="#FFFFFF">'+acc[0]+'</td><td bgcolor="#FFFFFF">'+(acc[1]==1 ? 'Личная ячейка' : 'Ячейка клана')+'</td><td bgcolor="#FFFFFF">'+(acc[2]==0?'NV':(acc[2]==1?'$':'DNV'))+'</td><td bgcolor="#FFFFFF">'+(acc[3]!='0' ? acc[3] + (acc[4]==1?' (Просрочен)':'') : 'Не ограничен')+'</td><td bgcolor="#FFFFFF" align="center"><a onclick="show_cell_login('+acc[0]+', \''+acc[5]+'\', \''+acc[6]+'\'); return false;" href="#">Войти</a></td></tr>';
            }
            table += '</table></td></tr></table></blockquote>';
            document.getElementById('Dynamic').innerHTML += table;
        } else
            document.getElementById('Dynamic').innerHTML += '<blockquote>У вас нет ячеек в этом отделении банка.</blockquote>';
        
        document.getElementById('Dynamic').innerHTML += '<blockquote>';
        if (arr[1] == 1) document.getElementById('Dynamic').innerHTML += '<a onclick="show_cell_create(1, 0, '+arr[2]+', '+arr[3]+'); return false;" href="#">Открыть NV ячейку. (Стоимость открытия: '+arr[2]+' NV. Стоимость обслуживания в месяц: '+arr[3]+' NV)</a><br />';
        if (arr[4] == 1) document.getElementById('Dynamic').innerHTML += '<a onclick="show_cell_create(1, 1, '+arr[5]+', '+arr[6]+'); return false;" href="#">Открыть $ ячейку. (Стоимость открытия: '+arr[5]+' $. Стоимость обслуживания в месяц: '+arr[6]+' $)</a><br />';
        if (arr[13] == 1) document.getElementById('Dynamic').innerHTML += '<a onclick="show_cell_create(1, 2, '+arr[14]+', '+arr[15]+'); return false;" href="#">Открыть DNV ячейку. (Стоимость открытия: '+arr[14]+' DNV. Стоимость обслуживания в месяц: '+arr[15]+' DNV)</a><br />';
        if (arr[7] == 1) document.getElementById('Dynamic').innerHTML += '<a onclick="show_cell_create(2, 0, '+arr[8]+', '+arr[9]+'); return false;" href="#">Открыть клановую NV ячейку. (Стоимость открытия: '+arr[8]+' NV. Стоимость обслуживания в месяц: '+arr[9]+' NV)</a><br />';
        if (arr[10] == 1) document.getElementById('Dynamic').innerHTML += '<a onclick="show_cell_create(2, 1, '+arr[11]+', '+arr[12]+'); return false;" href="#">Открыть клановую $ ячейку. (Стоимость открытия: '+arr[11]+' $. Стоимость обслуживания в месяц: '+arr[12]+' $)</a><br />';
        if (arr[16] == 1) document.getElementById('Dynamic').innerHTML += '<a onclick="show_cell_create(2, 2, '+arr[17]+', '+arr[18]+'); return false;" href="#">Открыть клановую DNV ячейку. (Стоимость открытия: '+arr[17]+' DNV. Стоимость обслуживания в месяц: '+arr[18]+' DNV)</a><br />';
        document.getElementById('Dynamic').innerHTML += '</blockquote>';
    });
}

function show_cell_create(type1, type2, price1, price2)
{
    document.getElementById('Dynamic').innerHTML = '';
    show_menu();
    var account = '<div id="create_account"><blockquote><font class=freetxt><b>Стоимость открытия ячейки '+price1+' '+(type2==0?'NV':(type2==1?'$':'DNV'))+'.</b></blockquote><br>' +
    '<blockquote><table width="50%" border="0" cellspacing="0" cellpadding="0"><tr><td>'+
    '<font class=freetxt><b>Пароль: </b></font></td><td><input name="bpsw" id="cell_bpsw" type="password" class="LogintextBox4"></td></tr><tr><td>'+
    '<font class=freetxt><b>Подтвердите пароль: </b></font></td><td><input name="bpsw1" id="cell_bpsw1" type="password" class="LogintextBox4"></td></tr><tr><td>'+
    '<font class=freetxt><b>E-mail: </b></font></td><td><input name="email" id="cell_email" type="text" class="LogintextBox4" maxlength="30"></td></tr><tr><td>'+
    '<font class=freetxt><b>Тип ячейки: </b></font></td><td><font class="freetxt">'+(type1==1 ? 'Личный' : 'Клановый')+' '+(type2==0?'NV':(type2==1?'$':'DNV'))+'</td></tr><tr><td colspan="2"><br>' +
    '<div align=center><input type="submit" value="Открыть ячейку" onclick="create_cell('+type1+', '+type2+');" class=lbut>&nbsp;&nbsp;<input type=button value="Отмена" onclick="show_cells();" class=lbut></div></td></tr></table></blockquote><br /></div>';
    document.getElementById('Dynamic').innerHTML += account;
}

function show_cell_login(cell_id, forgot_code, login_code)
{
    document.getElementById('Dynamic').innerHTML = '';
    show_menu();
    var account = '<blockquote>';
    
    if (forgot_code != '')
        account += '<a onclick="el = document.getElementById(\'forgot_div\'); if (el.style.display == \'block\') el.style.display = \'none\'; else el.style.display = \'block\'; return false;" href="#">Забыл пароль</a><br><br><div id="forgot_div" style="display: none;">'+
    '<table width="50%"  border="0" cellspacing="0" cellpadding="0"><tr><td>'+
    '<font class=freetxt><b>Номер ячейки: </b></font></td><td><input name="forgot_cell" id="forgot_cell" type="text" class="LogintextBox4" maxlength="11" value="'+cell_id+'"></td></tr><tr><td colspan="2"><div align="center"><input type="button" value="Выслать" onclick="cell_forgot_password('+cell_id+', \''+forgot_code+'\'); return false;" class=lbut></div></td></tr></table><br />'+
    '</div>';
    
    account += '<table width="50%"  border="0" cellspacing="0" cellpadding="0"><tr><td>'+
    '<font class=freetxt><b>Номер ячейки: </b></font></td><td><input onkeypress="if (event.keyCode == 13) { cell_login('+cell_id+', \''+login_code+'\'); return false; } " name="cell" id="login_cell" type="text" class="LogintextBox4" maxlength="11" value="'+cell_id+'"></td></tr><tr><td>'+
    '<font class=freetxt><b>Пароль: </b></font></td><td><input onkeypress="if (event.keyCode == 13) { cell_login('+cell_id+', \''+login_code+'\'); return false; }" name="cell_password" id="login_cell_password" type="password" class="LogintextBox4"></td></tr><tr><td colspan="2"><br />'+
    '<div align=center><input type="submit" name="cell_login" onclick="cell_login('+cell_id+', \''+login_code+'\'); return false;" value="Работать с ячейкой" class="lbut"></div></td></tr></table><br /></form></blockquote>';
    document.getElementById('Dynamic').innerHTML += account;
    document.getElementById('login_cell_password').focus();
}

function create_cell(type1, type2)
{
    var pwd = document.getElementById('cell_bpsw').value;
    var pwd2 = document.getElementById('cell_bpsw1').value;
    var email = document.getElementById('cell_email').value;
    if (pwd=='') { alert('Поле "Пароль" обязательно для заполнения.'); return false; }
    else if (pwd2=='') { alert('Поле "Подтвердите пароль" обязательно для заполнения.'); return false; }
    else if (pwd!=pwd2) { alert('Поля "Пароль" и "Подтвердите пароль" не совпадают.'); return false; }
    else if (email=='') { alert('Поле "E-mail" обязательно для заполнения.'); return false; }
    
    data = new Array();
    data['action'] = 'cell_create';
    data['pwd'] = pwd;
    data['pwd2'] = pwd2;
    data['email'] = email;
    data['type1'] = type1;
    data['type2'] = type2;
    data['vcode'] = bank_cell_act[0];
    data['pg_id'] = pg_id;
    AjaxPost('bank_ajax.php', data, function(xdata) {
        var data = ajaxParse(xdata);
        var arr = data.split('@');
        if (arr[0] != 'ERROR')
            show_cells();
        else
            MessBoxDiv(arr[1]);
    });
}

function cell_forgot_password(cell_id, vcode)
{
    var cell = document.getElementById('forgot_cell').value;
    if (cell=='') { alert('Поле "Номер ячейки" обязательно для заполнения.'); return false; }
    
    data = new Array();
    data['action'] = 'cell_forgot_password';
    data['cell'] = cell;
    data['vcode'] = vcode;
    data['pg_id'] = pg_id;
    AjaxPost('bank_ajax.php', data, function(xdata) {
        var data = ajaxParse(xdata);
        var arr = data.split('@');
        if (arr[0] != 'ERROR')
        {   
            show_cells();
        }
        else
        {
            show_cell_login(arr[2], arr[3], arr[4])
        }
        MessBoxDiv(arr[1]);
    });
}

function cell_login(cell_id, vcode)
{
    var cell = document.getElementById('login_cell').value;
    var pwd = document.getElementById('login_cell_password').value;
    if (cell=='') { alert('Поле "Номер ячейки" обязательно для заполнения.'); return false; }
    else if (pwd=='') { alert('Поле "Пароль" обязательно для заполнения.'); return false; }
    
    data = new Array();
    data['action'] = 'cell_login';
    data['cell'] = cell;
    data['password'] = pwd;
    data['vcode'] = vcode;
    data['pg_id'] = pg_id;
    AjaxPost('bank_ajax.php', data, function(xdata) {
        var data = ajaxParse(xdata);
        var arr = data.split('@');
        if (arr[0] == 'SUCCESS')
            show_cell(arr[1], 0);
        else
        {
            MessBoxDiv(arr[1]);
            show_cell_login(arr[2], arr[3], arr[4]);
        }
    });
}

function show_cell(cell_id, menu)
{
    document.getElementById('Dynamic').innerHTML = '';
    show_menu();
    AjaxGet('bank_ajax.php?action=cell_get_info&cell='+cell_id+'&pg_id='+pg_id+'&vcode='+bank_cell_act[13], function(xdata) {
        var data = ajaxParse(xdata);
        var arr = data.split('@');
        if (arr[0] != 'ERROR')
        {
            var account = '';
            var res = arr[1];
            arr = res.split('|');
            var mtype = (arr[1]==0?'NV': (arr[1]==1?'$':'DNV'));
            logged_in_cell.cell_id = arr[0];
            logged_in_cell.cell_type = arr[1];
            
            account += '<br /><table><tr><td><b>'+(arr[2]==1?'Личная':'Клановая')+' '+(arr[1]==0?'NV':(arr[1]==1?'$':'DNV'))+' ячейка номер '+arr[0]+'</b><br />Email: '+arr[14].split('+').join('@')+'</td><td>&nbsp;&nbsp;&nbsp;</td><td><input type="button" onclick="cell_logout();" value="Закончить работу с ячейкой" class="lbut" /></td></tr></table><br />' +
                       '<table cellpadding=0 cellspacing=0 border=0 align=center width=100%><tr><td width=25% bgcolor=#f9f9f9><div align=center class = freemain>'+
                       '<a href="#" onclick="cell_show_cell_inv('+arr[0]+'); return false;"><font class=zaya><b>Вещи в ячейке</b></font></a>' +
                       '</div></td><td width=25% bgcolor=#f9f9f9><div align=center class = freemain>'+
                       '<a href="#" onclick="cell_show_player_inv('+arr[0]+'); return false;"><font class=zaya><b>Вещи у вас</b></font></a>' +
                       '</div></td><td width=25% bgcolor=#f9f9f9><div align=center class = freemain>'+
                       '<a href="#" onclick="document.getElementById(\'cell_additional\').style.display = (document.getElementById(\'cell_additional\').style.display == \'block\' ? \'none\' : \'block\'); return false;" ><font class=zaya><b>Управление ячейкой</b></font></a>' +
                       '</div></td></tr></table><br />';
                       
            account += '<div id="cell_additional" style="display: '+(menu == 3 ? 'block' : 'none')+';"><table width="100%" align = center border="0" cellspacing="0" cellpadding="0" class=freetxt>';
            if (arr[4] == 1)
                account += '<tr><td colspan="5"><br /><br /><font class=freetxt><b>Новый пароль <input type="password" onkeypress="if (event.keyCode == 13) { return false; }" name="cell_pwd1" id="cell_pwd1" class="logintextbox2" /> Повторить пароль <input type="password" onkeypress="if (event.keyCode == 13) { return false; }" name="cell_pwd2" id="cell_pwd2" class="logintextbox2" /></b>&nbsp;&nbsp;<input type="button" value="Поменять пароль" class="lbut" onclick="cell_change_password('+arr[0]+');" /></td></tr>'+
                           '<tr><td colspan="5"><font class=freetxt><b>Новый E-mail <input type="text" onkeypress="if (event.keyCode == 13) { return false; }" name="cell_email" id="cell_email" class="logintextbox4" maxlength="30" value=""></b>&nbsp;&nbsp;<input type="button" value="Поменять E-mail" class="lbut" onclick="cell_change_email('+arr[0]+');" /></td></tr><tr><td>&nbsp;</td></tr>';
                           
            if (arr[4] == 1 && arr[5] != 0)
                account += '<tr><td colspan="5"><font class=freetxt><b>Ячейка оплачена до: '+arr[5]+'</b>&nbsp;&nbsp;(Стоимость пользования 30 дней: '+arr[6]+' '+(arr[1]==0?'NV':(arr[1]==1?'$':'DNV'))+')<br /><input type="checkbox" name="pay" value="player" id="cell_pay_player"><label for="cell_pay_player">Продлить</label><br /><br /><input type="button" name="submit" value="Продлить" class="lbut" onclick="cell_pay('+arr[0]+');" /></td></tr><tr><td>&nbsp;</td></tr>';
            
            if (arr[7] != 0)
                account += '<tr><td><font class=freetxt><b>Увеличить размер ячейки на '+arr[8]+' <input type="checkbox" name="upgrade" id="cell_upgrade" value="1" class="lbut" /></b>&nbsp;&nbsp;<input type="button" value="Увеличить" class="lbut" onclick="cell_upgrade('+arr[0]+');" />&nbsp;&nbsp;Доплата за текущий период: '+arr[9]+' '+(arr[1]==0?'NV':(arr[1]==1?'$':'DNV'))+'</td></tr><tr><td>&nbsp;</td></tr>';
            
            if (arr[10] != 0)
                account += '<tr><td><font class=freetxt><b>Уменьшить размер ячейки на '+arr[8]+' <input type="checkbox" name="downgrade" id="cell_downgrade" value="1" class="lbut" /></b>&nbsp;&nbsp;<input type="button" value="Уменьшить" class="lbut" onclick="cell_downgrade('+arr[0]+');" />&nbsp;&nbsp;Оплата за текущий период не возвращается.</td></tr><tr><td>&nbsp;</td></tr>';
                   
            if (arr[11] != 0)
                account += '<tr><td><font class=freetxt><b>Отказаться от аренды ячейки <input type="checkbox" name="close" id="cell_close" value="1" class="lbut" /></b>&nbsp;&nbsp;<input type="button" value="Ок" class="lbut" onclick="cell_close('+arr[0]+');" />'+(arr[12] != 0?'&nbsp;Стоимость закрытия: '+arr[12]+' '+(arr[1]==0?'NV':(arr[1]==1?'$':'DNV')):'')+'</td></tr>';
                
            account += '</table></div><br /><div style="display: none;" id="cell_content"></div>';
            
            document.getElementById('Dynamic').innerHTML += account;
        } else
            MessBoxDiv(arr[1]);
    });
}

function cell_show_cell_inv(cell_id)
{
    data = new Array();
    data['action'] = 'cell_show_cell_inv';
    data['cell'] = cell_id;
    data['type'] = logged_in_cell.cell_type;
    data['vcode'] = bank_cell_act[11];
    data['pg_id'] = pg_id;
    AjaxPost('bank_ajax.php', data, function(xdata) {
        var data = ajaxParse(xdata);
        if (data.substring(0, 5) == 'ERROR')
        {
            arr = data.split('@');
            MessBoxDiv(arr[1]);
        }
        else
        {
            document.getElementById('cell_content').innerHTML = data;
            document.getElementById('cell_content').style.display = 'block';
            document.getElementById('cell_additional').style.display = 'none';
        }
            
    });
}

function cell_logout()
{
    show_cells();
}

function cell_show_player_inv(cell_id)
{
    data = new Array();
    data['action'] = 'cell_show_player_inv';
    data['cell'] = cell_id;
    data['type'] = logged_in_cell.cell_type;
    data['vcode'] = bank_cell_act[12];
    data['pg_id'] = pg_id;
    AjaxPost('bank_ajax.php', data, function(xdata) {
        var data = ajaxParse(xdata);
        if (data.substring(0, 5) == 'ERROR')
        {
            arr = data.split('@');
            MessBoxDiv(arr[1]);
        }
        else
        {
            document.getElementById('cell_content').innerHTML = data;
            document.getElementById('cell_content').style.display = 'block';
            document.getElementById('cell_additional').style.display = 'none';
        }
            
    });
}

function cell_put(cell_id, item_id, vcode)
{
    data = new Array();
    data['action'] = 'cell_put';
    data['cell'] = cell_id;
    data['item'] = item_id;
    data['type'] = logged_in_cell.cell_type;
    data['vcode'] = vcode;
    data['pg_id'] = pg_id;
    if (vcode == '')
        alert('Вы не можете пользоваться ячейкой, которая не оплачена.');
    else
    {
        AjaxPost('bank_ajax.php', data, function(xdata) {
            var data = ajaxParse(xdata);
            if (data.substring(0, 5) == 'ERROR')
            {
                arr = data.split('@');
                MessBoxDiv(arr[1]);
            }
            else
            {
                document.getElementById('cell_content').innerHTML = data;
                document.getElementById('cell_content').style.display = 'block';
                document.getElementById('cell_additional').style.display = 'none';
            }
        });
    }
}

function cell_get(cell_id, item_id, vcode)
{
    data = new Array();
    data['action'] = 'cell_get';
    data['cell'] = cell_id;
    data['item'] = item_id;
    data['type'] = logged_in_cell.cell_type;
    data['vcode'] = vcode;
    data['pg_id'] = pg_id;
    if (vcode == '')
        alert('Вы не можете пользоваться ячейкой, которая не оплачена.');
    else
    {
        AjaxPost('bank_ajax.php', data, function(xdata) {
            var data = ajaxParse(xdata);
            if (data.substring(0, 5) == 'ERROR')
            {
                arr = data.split('@');
                MessBoxDiv(arr[1]);
            }
            else
            {
                document.getElementById('cell_content').innerHTML = data;
                document.getElementById('cell_content').style.display = 'block';
                document.getElementById('cell_additional').style.display = 'none';
            }
        });
    }
}

function cell_change_password(cell_id)
{
    var pwd = document.getElementById('cell_pwd1').value;
    var pwd2 = document.getElementById('cell_pwd2').value;
    if (pwd == '') { alert('Поле "Новый пароль" обязательно для заполнения.'); return false; }
    if (pwd2 == '') { alert('Поле "Повторить пароль" обязательно для заполнения.'); return false; }
    if (pwd != pwd2) { alert('Поля "Новый пароль" и "Повторить пароль" должны совпадать.'); return false; }
    
    data = new Array();
    data['action'] = 'cell_change_password';
    data['cell'] = cell_id;
    data['pwd'] = pwd;
    data['type'] = logged_in_cell.cell_type;
    data['vcode'] = bank_cell_act[3];
    data['pg_id'] = pg_id;
    AjaxPost('bank_ajax.php', data, function(xdata) {
        var data = ajaxParse(xdata);
        var arr = data.split('@');
        if (arr[0] == 'SUCCESS')
            MessBoxDiv("Пароль успешно изменён.");
        else
            MessBoxDiv(arr[1]);
    });
}

function cell_change_email(cell_id)
{
    var email = document.getElementById('cell_email').value;
    if (email == '') { alert('Поле "Новый E-mail" обязательно для заполнения.'); return false; }
    
    data = new Array();
    data['action'] = 'cell_change_email';
    data['cell'] = cell_id;
    data['email'] = email;
    data['type'] = logged_in_cell.cell_type;
    data['vcode'] = bank_cell_act[4];
    data['pg_id'] = pg_id;
    AjaxPost('bank_ajax.php', data, function(xdata) {
        var data = ajaxParse(xdata);
        var arr = data.split('@');
        if (arr[0] == 'SUCCESS')
        {
            //show_cell(arr[1]);
            MessBoxDiv("E-mail успешно изменён.");
        }
        else
            MessBoxDiv(arr[1]);
    });
}

function cell_pay(cell_id)
{
    if (!document.getElementById('cell_pay_player').checked) 
        return false;
    
    data = new Array();
    data['action'] = 'cell_pay';
    data['cell'] = cell_id;
    data['pay'] = (document.getElementById('cell_pay_player').checked ? 'player' : 'account');
    data['type'] = logged_in_cell.cell_type;
    data['vcode'] = bank_cell_act[5];
    data['pg_id'] = pg_id;
    AjaxPost('bank_ajax.php', data, function(xdata) {
        var data = ajaxParse(xdata);
        var arr = data.split('@');
        if (arr[0] == 'SUCCESS')
        {
            show_cell(arr[1], 3);
            MessBoxDiv("Ячейка успешно оплачена.");
        }
        else
            MessBoxDiv(arr[1]);
    });
}

function cell_upgrade(cell_id)
{
    if (!document.getElementById('cell_upgrade').checked) 
        return false;
    
    data = new Array();
    data['action'] = 'cell_upgrade';
    data['cell'] = cell_id;
    data['type'] = logged_in_cell.cell_type;
    data['vcode'] = bank_cell_act[6];
    data['pg_id'] = pg_id;
    AjaxPost('bank_ajax.php', data, function(xdata) {
        var data = ajaxParse(xdata);
        var arr = data.split('@');
        if (arr[0] == 'SUCCESS')
        {
            show_cell(arr[1], 3);
            MessBoxDiv("Ячейка успешно увеличина.");
        }
        else
            MessBoxDiv(arr[1]);
    });
}

function cell_downgrade(cell_id)
{
    if (!document.getElementById('cell_downgrade').checked) 
        return false;
    
    data = new Array();
    data['action'] = 'cell_downgrade';
    data['cell'] = cell_id;
    data['type'] = logged_in_cell.cell_type;
    data['vcode'] = bank_cell_act[7];
    data['pg_id'] = pg_id;
    AjaxPost('bank_ajax.php', data, function(xdata) {
        var data = ajaxParse(xdata);
        var arr = data.split('@');
        if (arr[0] == 'SUCCESS')
        {
            show_cell(arr[1], 3);
            MessBoxDiv("Ячейка успешно уменьшена.");
        }
        else
            MessBoxDiv(arr[1]);
    });
}

function cell_close(cell_id)
{
    if (!document.getElementById('cell_close').checked) 
        return false;
    
    data = new Array();
    data['action'] = 'cell_close';
    data['cell'] = cell_id;
    data['type'] = logged_in_cell.cell_type;
    data['vcode'] = bank_cell_act[8];
    data['pg_id'] = pg_id;
    AjaxPost('bank_ajax.php', data, function(xdata) {
        var data = ajaxParse(xdata);
        var arr = data.split('@');
        if (arr[0] == 'SUCCESS')
        {
            show_cells();
            MessBoxDiv("Ячейка успешно закрыта.");
        }
        else
            MessBoxDiv(arr[1]);
    });
}

function show_shares()
{
    document.getElementById('Dynamic').innerHTML = '<center>Загрузка...</center>';
    AjaxGet('bank_ajax.php?action=shares_get_status&pg_id='+pg_id+'&vcode='+vcode+'&r='+Math.random()+'', function(data){
        var arr = data.split('|');
        document.getElementById('Dynamic').innerHTML = '';
        show_menu();
        
        if (arr[0] > 0)
        {
            document.getElementById('Dynamic').innerHTML += '<blockquote>Вы владеете <b>'+arr[0]+'</b> акциями этого банка (<b>'+arr[1]+' %</b> от общего количества).<br /><br /><a onclick="show_shares_actions();" href="#">Панель акционера</a><br /><br />Текущий капитал банка: <b>'+arr[2]+' NV.</b><br /><br /></blockquote>' +
            '<blockquote><font class=freetxt><b>Продать акции (у вас '+arr[0]+' акций)</b><br /><br /></font>' + 
            '<table width="80%" border="0" cellspacing="0" cellpadding="0" class="freetxt"><tr><td>' +
            'Продать <input type="text" name="sell_shares_count" id="sell_shares_count" class="logintextbox5"> акций по цене <b>'+arr[5]+' NV</b> за штуку.&nbsp;&nbsp;' +
            '<a href="#" onclick="if (confirm(\'Вы уверены что хотите продать акции?\')) sell_shares();">Продать</a>'
            '</td></tr></table></blockquote><br />';
        }
        if (arr[4] > 0)
        {
            document.getElementById('Dynamic').innerHTML += '<blockquote><font class=freetxt><b>Акций в свободной продаже: '+arr[4]+'</b><br /><br /></font>' +
            '<table width="80%" border="0" cellspacing="0" cellpadding="0" class="freetxt"><tr><td>' +
            'Купить <input type="text" name="buy_shares_count" id="buy_shares_count" class="logintextbox5"> акций по цене <b>'+arr[6]+' NV</b> за штуку.</b>&nbsp;&nbsp;' +
            '<a href="#" onclick="if (confirm(\'Вы уверены что хотите продать акции?\')) buy_shares();">Купить</a>' +
            '</td></tr></table></form></blockquote><br />';
        }
    });
}

function sell_shares()
{
    var shares_count = parseInt(document.getElementById('sell_shares_count').value);
    if (isNaN(shares_count)) 
        return false;
    data = new Array();
    data['action'] = 'shares_sell';
    data['count'] = shares_count;
    data['vcode'] = bank_shares_act[0];
    data['pg_id'] = pg_id;
    AjaxPost('bank_ajax.php', data, function(data) {
        var arr = data.split('@');
        show_shares();
        MessBoxDiv(arr[1]);
    });
}

function buy_shares()
{
    var shares_count = parseInt(document.getElementById('buy_shares_count').value);
    if (isNaN(shares_count)) 
        return false;
    data = new Array();
    data['action'] = 'shares_buy';
    data['count'] = shares_count;
    data['vcode'] = bank_shares_act[1];
    data['pg_id'] = pg_id;
    AjaxPost('bank_ajax.php', data, function(data) {
        var arr = data.split('@');
        show_shares();
        MessBoxDiv(arr[1]);
    });
}