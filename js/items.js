var DTAB = false;

function ItemsView()
{ 
    var i,j,table_obj,tr_obj,td_obj,str_pr;
    var all_i = arr_res.length - 1;
    var s = Math.ceil(all_i / 3);
    var k = 0;
    
    if(DTAB) d.getElementById('Dynamic').removeChild(DTAB);
    
    DTAB = d.createElement('table');
    DTAB.id = 'TDyn';
    DTAB.cellPadding = '5';
    DTAB.cellSpacing = '1';
    DTAB.border = '0';
    DTAB.width = '100%';
    d.getElementById('Dynamic').appendChild(DTAB);
    
    table_obj = d.getElementById('TDyn');
    
    for(i=0; i<s; i++)
    {
        tr_obj = table_obj.insertRow(i);
        for(j=0; j<3; j++)
        {
            k++;
            td_obj = tr_obj.insertCell(j);
            td_obj.bgColor = '#FFFFFF';
            td_obj.align = 'center';
            td_obj.width = '33%';
            td_obj.className = 'filt';
            
            if(all_i >= k)
            {
                str_pr = arr_res[k].split('|');
                td_obj.innerHTML = '<b>'+str_pr[5]+'</b>'+(str_pr[6] ? '<br><font color=#00A11E><b>'+str_pr[6]+'</b></font>' : '')+'<br>Долговечность: '+str_pr[7]+'/'+str_pr[7]+'<br>Масса: '+str_pr[8]+'<br><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=5><br><img src=http://img.legendbattles.ru/image/tools/'+str_pr[3]+'.gif width=60 height=60><br><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=5><br><b>Стоимость: '+str_pr[4]+' LR</b><br>Остаток: '+str_pr[9]+'<br>'+(str_pr[0] ? (!str_pr[1] ? '' : '<img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=10><br><img src="http://www.lifeiswar.ru/modules/code/code.php?'+str_pr[1]+'" width=134 height=60><br><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=10><br>Код: <input type=text id="ICODE_'+str_pr[3]+'" name=code size=4 class=gr_text><br><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=10>')+'<br>Кол-во: <input type=text id="INGRC_'+str_pr[3]+'" name=ingrc value=1 class=gr_text size=2 maxlength=2> <input type=button value="Купить" class=gr_but onClick=\'ItemsBuy('+k+');\'>' : '<br>Кол-во: <input type=text name=ingrc value=1 class=gr_text size=2 maxlength=2 DISABLED> <input type=button class=gr_but value="Купить" DISABLED>');   
            }         
        }
    }
}    


function ItemsBuy(index)
{
    var str_pr = arr_res[index].split('|');
    var ingrc = d.getElementById('INGRC_'+str_pr[3]).value;
    if(parseInt(ingrc) > 0)
    {
        AjaxGet('items_ajax.php?vcode='+str_pr[0]+'&act=1&cost='+str_pr[4]+'&id='+str_pr[3]+'&place='+str_pr[2]+'&ingrc='+ingrc+(!str_pr[1] ? '' : '&code='+d.getElementById('ICODE_'+str_pr[3]).value)+'&r='+Math.random());   
    }        
}