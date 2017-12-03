var re_e = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
var re = /^[\d]{5,5}$/;

switch_agree = function()
{
    var bg_div = d.getElementById('reg_input_check');
    var need_check_box = d.getElementById('condition');

    if(!need_check_box.checked)
    {
        bg_div.style.backgroundPosition='0 0';
        need_check_box.checked = true;
    }
    else
    {
        bg_div.style.backgroundPosition='0 100%';
        need_check_box.checked = false;
    }
}

StateReady = function()
{
    if(arr_res[0] == 'OK')
    {
        close_obj('reg_form', false);
        show_warn('�����������! ����������� ������ �������!','ok',true,false);
    }
    else if(arr_res[0] == 'RECOVERY')
    {
        d.getElementById('recovery_info').className = 'ok';
        d.getElementById('recovery_msg').innerHTML = '<br>�� ��������� E-mail ������� ���������� ��� ������ ������.';
        d.getElementById('recovery_next').href = 'javascript:close_obj("pass_recovery", true);';        
    }
    else
    {
        var msg = '';
        var err;
        for(var i=1; i<arr_res.length; i++)
        {
            err = -1;
            
            switch(arr_res[i])
            {
                case '1':
                
                if(!msg) msg = '������ �� ���������!';
                err = 3; 
                
                break;
                case '2':
                
                if(!msg) msg = '������ ������ ��������� �� ����� 8 ��������!';
                err = 2; 
                
                break;
                case '3':
                
                if(!msg) msg = '������������ ������ E-mail!';
                err = 1; 
                
                break;
                case '4':
                
                if(!msg) msg = '������������ ������ ��������!';
                err = 0; 
                
                break;
                case '6':
                
                if(!msg) msg = '��������� ������� ��� �����!';
                err = 0; 
                
                break;
                case '5':
                
                if(!msg) msg = '������� ������� ����������������� ����������!'; 
                
                break;
                case '7':
                
                if(!msg) msg = '��������� E-mail ��� �����!'; 
                
                break;
                case '8':
				
                check_refrech_auto.location='check.php';
                if(!msg) msg = '������� ������ ��� � ��������.';
                err = 4;  
                
                break;
                case '9':
                
                if(!msg) msg = '������ IP ��� ������� ����������� ��� �����������.';
                
                break;
            }
            if(err != -1) d.getElementById('Ch'+err).className = 'reg_field_right invalid';
        }
        show_warn(msg,'err',false,false);
    }
}

function InCh(inid)
{
    var log;
    
    switch(inid)
    {
        case 0:
        
        var login = d.getElementById('login').value;
        log = login ? (login.length > 2 ? (login.length < 21 ? 1 : 0) : 0) : 0;
        
        break;
        case 1:
        
        log = d.getElementById('email').value.match(re_e) ? 1 : 0;
        
        break;
        case 2:
        
        log = d.getElementById('pass').value.length > 7 ? 1 : 0;
        
        break;
        case 3:
        
        log = d.getElementById('verify').value == d.getElementById('pass').value ? 1 : 0;
        
        break;
        case 4:
        
        log = d.getElementById('code').value.match(re) ? 1 : 0;
        
        break;
        case 5:
        
        var login = d.getElementById('f_login').value;
        log = login ? (login.length > 2 ? (login.length < 21 ? 1 : 0) : 0) : 0;
        
        break;
        case 6:
        
        log = d.getElementById('f_email').value.match(re_e) ? 1 : 0;
        
        break;
    }
    d.getElementById('Ch'+inid).className = 'reg_field_right '+(log ? '' : 'in')+'valid';
}

RegSubmit = function(vcode)
{ 
     var err_mess = '';
     var login = d.getElementById("login").value;
     var email = d.getElementById("email").value;
     var pass = d.getElementById("pass").value;
     var verify = d.getElementById("verify").value;
     var code = d.getElementById("code").value;
     var condition = d.getElementById("condition");
     
     if(!login) err_mess = '������� ��� �������!';
     else if(login.length < 3 || login.length > 20) err_mess = '������� ������ ��������� �� 3 �� 20 ��������!';
     else if(!email.match(re_e)) err_mess = '������� ��� E-mail!';
     else if(pass.length < 8) err_mess = '������ ������ ��������� �� ����� 8 ��������!';
     else if(pass != verify) err_mess = '������ �� ���������!';
     else if(!code.match(re)) err_mess = '������� ��� � ��������!';
     else if(!condition.checked) err_mess = '������� ������� ����������������� ����������!';
     
     if(err_mess == '') 
     {
         AjaxGetScript('./modules/reg/ajax_reg_nl.php?login='+encodeURIComponent(login)+'&email='+encodeURIComponent(email)+'&pass='+encodeURIComponent(pass)+'&verify='+encodeURIComponent(verify)+'&sex='+d.getElementById("sex").value+'&code='+code+'&condition='+(condition.checked ? 1 : 0)+'&vcode='+vcode+'&r='+Math.random());
     }
     else 
     {
         show_warn(err_mess,'err',false,false);
     }
}

AjaxGetScript = function(script)
{
    if(!xmlhttp) 
    {
        xmlhttp = GetHttpRequest();
        if(!xmlhttp) return;
    }
    xmlhttp.open('GET',script,true);
    xmlhttp.onreadystatechange = AjaxProcessChange;
    xmlhttp.send(null);
}

show_warn = function(warnm,warnt,warndcl,warndark)
{
    d.getElementById('reg_warn_mid_id').className = warnt;
    d.getElementById('reg_warn_left_id').className = warnt;
    d.getElementById('reg_warn_mess').innerHTML = warnm;
    show_obj('reg_warn', warndark);
    dclose = warndcl;
}

pass_recovery = function(vcode)
{
    var err_mess = '';
    var login = d.getElementById('f_login').value;
    var email = d.getElementById('f_email').value;
    if(!login) err_mess = '������� ��� �������!';
    else if(login.length < 3 || login.length > 20) err_mess = '������� ������ ��������� �� 3 �� 20 ��������!';
    else if(!email.match(re_e)) err_mess = '������� ��� E-mail!';
    if(!err_mess) AjaxGetScript('./modules/reg/ajax_recovery_nl.php?login='+encodeURIComponent(login)+'&email='+encodeURIComponent(email)+'&vcode='+vcode+'&r='+Math.random());
    else 
    {
        d.getElementById('recovery_info').className = 'err';
        d.getElementById('recovery_msg').innerHTML = '<br>'+err_mess;        
    }
}

top_small = function(t)
{
    switch(t)
    {
        case 1: return '';
        case 2: return '';
    }
}

resizer = function()
{
    var html = d.getElementById('html');
    var main = d.getElementById('main');
    var body = d.getElementById('body');
    var wbg = d.getElementById('wbg');
    var flag = d.getElementById('flags');
    var copyright = d.getElementById('copyright');

    var h = Math.ceil(d.body.offsetHeight / 2) - 410;
    var h2 = get_doc_height();
    //flag.style.top =  (h2 - 42) + 'px';
    //copyright.style.top = (h2 - 20) + 'px';
    if(h > 0)
    {
        main.style.top = h + 'px';
        html.style.backgroundPosition =  '0px ' + h + 'px';
        wbg.style.height =  h + 'px';
        body.style.backgroundPosition =  '50% ' + (h + 431) + 'px';
    }
    else
    {
        main.style.top = '0px';
        html.style.backgroundPosition =  '0px 0px';
        wbg.style.height =  '0px';
        body.style.backgroundPosition =  '50% 431px';
    }
}