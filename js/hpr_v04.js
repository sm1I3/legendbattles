var d = document;
var prsel = false;
var DTAB = false;
var prcan = 0;

function view_hpr()
{
    view_build_top();
    d.write('<div id="tooltip"></div><table cellpadding=0 cellspacing=0 border=0 align=center width=760><tr><td bgcolor=#CCCCCC id="Dynamic" width="100%"></td></tr></table>');
	view_build_bottom();
    PRList(hpr);
}

function PRList(value)
{
    var cat = value[0].length;
    var i,j,p,s,k,all_i,table_obj,tr_obj,td_obj,str_pr;
    var tr = -1;
    
    if(DTAB) d.getElementById('Dynamic').removeChild(DTAB);
    
    DTAB = d.createElement('table');
    DTAB.id = 'TDyn';
    DTAB.cellPadding = '5';
    DTAB.cellSpacing = '1';
    DTAB.border = '0';
    DTAB.width = '100%';
    d.getElementById('Dynamic').appendChild(DTAB);
    
    table_obj = d.getElementById('TDyn');
    
    for(p=0; p<cat; p++)
    {
        tr++;
        tr_obj = table_obj.insertRow(tr);
        td_obj = tr_obj.insertCell(0);
        td_obj.bgColor = '#FFFFFF';
        td_obj.align = 'center';
        td_obj.colSpan = '6';
        td_obj.className = 'freetxt';
        td_obj.innerHTML = '<b>'+value[0][p][0][0]+'</b>';
        
        all_i = value[0][p].length;
        s = Math.ceil((all_i - 1) / 6);
        k = 1;
        
        for(i=0; i<s; i++)
        {
            tr++;
            tr_obj = table_obj.insertRow(tr);
            for(j=0; j<6; j++)
            {
                td_obj = tr_obj.insertCell(j);
                td_obj.bgColor = '#FFFFFF';
                td_obj.width = '16%';
                
                if(all_i > k)
                {
                    td_obj.align = 'center';
                    td_obj.innerHTML = '<table cellpadding=0 cellspacing=0 border=0><tr><td bgcolor=#FFFFFF id="td'+value[0][p][k][0]+'"><table cellpadding=5 cellspacing=1 border=0><tr><td bgcolor=#FFFFFF><img src=http://img.legendbattles.ru/image/presents/'+value[0][p][k][0]+'.gif width=100 height=100 style="cursor: hand;" onclick="PRSelect('+value[0][p][k][0]+','+value[0][p][k][6]+')" onmouseover="tooltip(this,\''+PRTitle(value[0][p][k])+'\')" onmouseout="hide_info(this)"></td></tr></table></td></tr></table>'; 
                }
                else td_obj.innerHTML = '&nbsp;';
                k++;
            }
        }       
    }
    
    tr++;
    tr_obj = table_obj.insertRow(tr);
    td_obj = tr_obj.insertCell(0);
    td_obj.bgColor = '#FFFFFF';
    td_obj.align = 'center';
    td_obj.colSpan = '6';
    td_obj.className = 'freetxt';
    td_obj.innerHTML = 'Подарок для: <input type=text id=prnick class=gr_text size=20 maxlength=20 DISABLED> Подпись: <input type=text id=prtext class=gr_text size=40 maxlength=40 DISABLED> <input type=checkbox id=pranon value=1 class=gr_text DISABLED> анонимно <input type=submit value="Отправить" id=pridsub class=gr_but onclick="check_pres()" DISABLED>';
}

function PRSelect(prid,canb)
{
    if(prsel) d.getElementById('td'+prsel).bgColor = '#ffffff';
    else 
    {
        d.getElementById('prnick').disabled = false;
        d.getElementById('prtext').disabled = false; 
        d.getElementById('pranon').disabled = false; 
        d.getElementById('pridsub').disabled = false;     
    }
    d.getElementById('td'+prid).bgColor = '#dd0000';
    prsel = prid;
    prcan = canb;  
}

function PRTitle(value)
{
    var str = '';
    if(value[1] > 0) str += '<b>Стомость:</b> '+value[1]+' NV';
    if(value[2] > 0) str += '<b>Стомость:</b> '+value[2]+' Изумруда';
    str += '<br><b>Время жизни:</b> '+value[3]+' дн';
    str += '<br><b>Лимит:</b> '+(value[4] == 50000 ? 'неограничено' : value[4]+' шт');
    str += '<br><b>Пол:</b> '+(value[5] == 2 ? 'любой' : (!value[5] ? 'мужской' : 'женский'));
    return str;
}

function check_pres() 
{
    if(prcan)
    {
        var er = 0;
        var prnick = d.getElementById('prnick').value;
        var prtext = d.getElementById('prtext').value;
        
        if(!prnick) er = 1;
        else if(!prtext) er = 1;
        
        if(er) MessBoxDiv('Заполните все поля!');
        else AjaxGet('present_ajax.php?act=1&pr_code='+prsel+'&prnick='+encodeURIComponent(prnick)+'&prtext='+encodeURIComponent(prtext)+'&pranon='+(d.getElementById('pranon').checked ? 1 : 0)+'&vcode='+hpr[1][0]+'&r='+Math.random());
    }
    else MessBoxDiv('Недостаточно средств для покупки выбранного подарка!');
}

function StateReady()
{
    switch(arr_res[0])
    {
        case 'PRESENTS':
        
        prsel = false;
        prcan = 0;
        var strt = arr_res[1].split('|');
        hpr[1][0] = strt[0];
        PRList(eval(arr_res[2]));
        if(strt[1]) MessBoxDiv(strt[1]);
        
        break;
    }    
}