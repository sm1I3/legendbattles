function addItem_quest_weapon(tableId, trPrefix, elmPrefix)
{
    var table = el(tableId);
    var tr = d.createElement('TR');
    last_id++;
    var new_id = trPrefix+last_id;
    tr.id = new_id;
    table.lastChild.appendChild(tr);
    var td1 = d.createElement('TD');
    var td2 = d.createElement('TD');
    var td3 = d.createElement('TD');
    var td4 = d.createElement('TD');
    var td5 = d.createElement('TD');
    var td6 = d.createElement('TD');
    tr.appendChild(td1);
    tr.appendChild(td2);
    tr.appendChild(td3);
    tr.appendChild(td4);
    tr.appendChild(td5);
    tr.appendChild(td6);
    
    // delete image
    var del_img = d.createElement('IMG');
    del_img.src = 'images/cms_icons/cms_delete.gif';
    del_img.width = '16';
    del_img.height = '16';
    var del_a = d.createElement('A');
    del_a.href = '#';
    del_a.onclick = function() { removeItem(new_id); return false; };
    del_a.appendChild(del_img);
    
    td1.align = 'center';
    td1.className = 'cms_middle';
    td1.appendChild(del_a);
    
    td2.className = 'cms_middle';
    ed1 = d.createElement('INPUT');
    ed1.type = 'text';
    ed1.name = elmPrefix+'_group['+new_id+']';
    ed1.value = '0';
    td2.appendChild(ed1);
    
    td3.className = 'cms_middle';
    wc = createWeaponControl(elmPrefix+'['+new_id+']', 'id');
    td3.appendChild(wc);
    
    td4.className = 'cms_middle';
    ed2 = d.createElement('INPUT');
    ed2.type = 'text';
    ed2.name = elmPrefix+'_count['+new_id+']';
    ed2.value = '';
    td4.appendChild(ed2);
    
    td5.className = 'cms_middle';
    ed3 = d.createElement('INPUT');
    ed3.type = 'text';
    ed3.name = elmPrefix+'_time['+new_id+']';
    ed3.value = '';
    td5.appendChild(ed3);
    
    td6.className = 'cms_middle';
    ck1 = d.createElement('INPUT');
    ck1.type = 'checkbox';
    ck1.value = 'Y';
    ck1.name = elmPrefix+'_self['+new_id+']';
    td6.appendChild(ck1);
    
}

function addItem_receive_weapons(tableId, trPrefix, edName, edDefValue, addField, addDefValue)
{
    var table = el(tableId);
    var tr = d.createElement('TR');
    last_id++;
    var new_id = trPrefix+last_id;
    tr.id = new_id;
    table.lastChild.appendChild(tr);
    var td1 = d.createElement('TD');
    var td2 = d.createElement('TD');
    tr.appendChild(td1);
    tr.appendChild(td2);
    
    // delete image
    var del_img = d.createElement('IMG');
    del_img.src = 'images/cms_icons/cms_delete.gif';
    del_img.width = '16';
    del_img.height = '16';
    var del_a = d.createElement('A');
    del_a.href = '#';
    del_a.onclick = function() { removeItem(new_id); return false; };
    del_a.appendChild(del_img);
    
    td1.align = 'center';
    td1.className = 'cms_middle';
    td1.appendChild(del_a);
    
    td2.className = 'cms_middle';
    ed = createWeaponControl(edName, 'uid');
    td2.appendChild(ed);
    
    if (addField != '') {
        var td3 = d.createElement('TD');
        td3.className = 'cms_middle';
        tr.appendChild(td3);
        var add_field = d.createElement('INPUT');
        add_field.type = 'text';
        add_field.name = addField;
        add_field.value = addDefValue;
        td3.appendChild(add_field);
    }
}

function addItem_quest_res(tableId, trPrefix, elmPrefix, res_array)
{
    var table = el(tableId);
    var tr = d.createElement('TR');
    last_id++;
    var new_id = trPrefix+last_id;
    tr.id = new_id;
    table.lastChild.appendChild(tr);
    var td1 = d.createElement('TD');
    var td2 = d.createElement('TD');
    var td3 = d.createElement('TD');
    var td4 = d.createElement('TD');
    tr.appendChild(td1);
    tr.appendChild(td2);
    tr.appendChild(td3);
    tr.appendChild(td4);
    
    // delete image
    var del_img = d.createElement('IMG');
    del_img.src = 'images/cms_icons/cms_delete.gif';
    del_img.width = '16';
    del_img.height = '16';
    var del_a = d.createElement('A');
    del_a.href = '#';
    del_a.onclick = function() { removeItem(new_id); return false; };
    del_a.appendChild(del_img);
    
    td1.align = 'center';
    td1.className = 'cms_middle';
    td1.appendChild(del_a);
    
    td2.className = 'cms_middle';
    ed1 = d.createElement('INPUT');
    ed1.type = 'text';
    ed1.name = elmPrefix+'_group['+new_id+']';
    ed1.value = '0';
    td2.appendChild(ed1);
    
    td3.className = 'cms_middle';
    sl1 = createSelectFromArray(elmPrefix+'['+new_id+']', res_array, '');
    td3.appendChild(sl1);
    
    td4.className = 'cms_middle';
    ed2 = d.createElement('INPUT');
    ed2.type = 'text';
    ed2.name = elmPrefix+'_count['+new_id+']';
    ed2.value = '';
    td4.appendChild(ed2);
    
}

function add_quest_sps(tableId, trPrefix, elmPrefix, res_array)
{
    var table = el(tableId);
    var tr = d.createElement('TR');
    last_id++;
    var new_id = trPrefix+last_id;
    tr.id = new_id;
    table.lastChild.appendChild(tr);
    var td1 = d.createElement('TD');
    var td3 = d.createElement('TD');
    var td4 = d.createElement('TD');
    tr.appendChild(td1);
    tr.appendChild(td3);
    tr.appendChild(td4);
    
    // delete image
    var del_img = d.createElement('IMG');
    del_img.src = 'images/cms_icons/cms_delete.gif';
    del_img.width = '16';
    del_img.height = '16';
    var del_a = d.createElement('A');
    del_a.href = '#';
    del_a.onclick = function() { removeItem(new_id); return false; };
    del_a.appendChild(del_img);
    
    td1.align = 'center';
    td1.className = 'cms_middle';
    td1.appendChild(del_a);
    
    td3.className = 'cms_middle';
    sl1 = createSelectFromArray(elmPrefix+'['+new_id+']', res_array, '');
    td3.appendChild(sl1);
    
    td4.className = 'cms_middle';
    ed2 = d.createElement('INPUT');
    ed2.type = 'text';
    ed2.name = elmPrefix+'_count['+new_id+']';
    ed2.value = '';
    td4.appendChild(ed2);
    
}

function addItem_text(tableId, trPrefix, edName, edDefValue, addField, addDefValue)
{
    var table = el(tableId);
    var tr = d.createElement('TR');
    last_id++;
    var new_id = trPrefix+last_id;
    tr.id = new_id;
    table.lastChild.appendChild(tr);
    var td1 = d.createElement('TD');
    var td2 = d.createElement('TD');
    tr.appendChild(td1);
    tr.appendChild(td2);
    
    // delete image
    var del_img = d.createElement('IMG');
    del_img.src = 'images/cms_icons/cms_delete.gif';
    del_img.width = '16';
    del_img.height = '16';
    var del_a = d.createElement('A');
    del_a.href = '#';
    del_a.onclick = function() { removeItem(new_id); return false; };
    del_a.appendChild(del_img);
    
    td1.align = 'center';
    td1.className = 'cms_middle';
    td1.appendChild(del_a);
    
    td2.className = 'cms_middle';
    ed = d.createElement('INPUT');
    ed.type = 'text';
    ed.name = edName;
    ed.value = edDefValue;
    ed.size = '100';
    td2.appendChild(ed);
    
    if (addField != '') {
        var td3 = d.createElement('TD');
        td3.className = 'cms_middle';
        tr.appendChild(td3);
        var add_field = d.createElement('INPUT');
        add_field.type = 'text';
        add_field.name = addField;
        add_field.value = addDefValue;
        td3.appendChild(add_field);
    }
}

function addItem_present_weapon(tableId, trPrefix, elmPrefix)
{
    var table = el(tableId);
    var tr = d.createElement('TR');
    last_id++;
    var new_id = trPrefix+last_id;
    tr.id = new_id;
    table.lastChild.appendChild(tr);
    var td1 = d.createElement('TD');
    var td3 = d.createElement('TD');
    var td4 = d.createElement('TD');
    var td5 = d.createElement('TD');
    var td6 = d.createElement('TD');
    var td7 = d.createElement('TD');
    var td8 = d.createElement('TD');
    var td9 = d.createElement('TD');
    var td10 = d.createElement('TD');
    tr.appendChild(td1);
    tr.appendChild(td3);
    tr.appendChild(td4);
    tr.appendChild(td5);
    tr.appendChild(td6);
    tr.appendChild(td7);
    tr.appendChild(td8);
    tr.appendChild(td9);
    tr.appendChild(td10);
    
    // delete image
    var del_img = d.createElement('IMG');
    del_img.src = 'images/cms_icons/cms_delete.gif';
    del_img.width = '16';
    del_img.height = '16';
    var del_a = d.createElement('A');
    del_a.href = '#';
    del_a.onclick = function() { removeItem(new_id); return false; };
    del_a.appendChild(del_img);
    
    td1.align = 'center';
    td1.className = 'cms_middle';
    td1.appendChild(del_a);
        
    td3.className = 'cms_middle';
    wc = createWeaponControl(elmPrefix+'['+new_id+']', 'uid', 'normal');
    td3.appendChild(wc);
    
    
    
    td4.className = 'cms_middle';
    s2 = createSelectFromArray(elmPrefix+'_pltype['+new_id+']', pl_types, 0);
    td4.appendChild(s2);
    
    td5.className = 'cms_middle';
    sl = createSelectFromArray(elmPrefix+'_sex['+new_id+']', sexes, 2);
    td5.appendChild(sl);
    
    var txt = '';
    td6.className = 'cms_middle';
    txt =  '<input type="text" name="'+elmPrefix+'_dolg['+new_id+']'+'" id="'+elmPrefix+'_dolg_'+new_id+'" value="" size="3" />';
    //txt += '<input type="checkbox" name="'+elmPrefix+'_dolg_1['+new_id+']'+'" id="'+elmPrefix+'_dolg_1_'+new_id+'_'+'" value="Y" /><label for="'+elmPrefix+'_dolg_1_'+new_id+'_'+'">������� �� ���-��</label>' ;
    /*ed2 = d.createElement('INPUT');
    ed2.type = 'text';
    ed2.name = elmPrefix+'_dolg['+new_id+']';
    ed2.value = '';
    ed2.size = 3;*/
    //td6.appendChild(ed2);
    td6.innerHTML = txt;
    
    td7.className = 'cms_middle';
    /*
    ed3 = d.createElement('INPUT');
    ed3.type = 'text';
    ed3.name = elmPrefix+'_price['+new_id+']';
    ed3.value = '';
    ed3.size = 3;
    td7.appendChild(ed3);*/
    txt =  '<input type="text" name="'+elmPrefix+'_count['+new_id+']'+'" id="'+elmPrefix+'_count_'+new_id+'" value="" size="3" />';
    //txt += '<input type="checkbox" name="'+elmPrefix+'_price_1['+new_id+']'+'" id="'+elmPrefix+'_price_1_'+new_id+'_'+'" value="Y" /><label for="'+elmPrefix+'_price_1_'+new_id+'_'+'">������� �� ���-��</label>' ;
    td7.innerHTML = txt;
    
    td8.className = 'cms_middle';
    /*
    ed3 = d.createElement('INPUT');
    ed3.type = 'text';
    ed3.name = elmPrefix+'_price['+new_id+']';
    ed3.value = '';
    ed3.size = 3;
    td7.appendChild(ed3);*/
    txt =  '<input type="text" name="'+elmPrefix+'_price['+new_id+']'+'" id="'+elmPrefix+'_price_'+new_id+'" value="" size="3" />';
    //txt += '<input type="checkbox" name="'+elmPrefix+'_price_1['+new_id+']'+'" id="'+elmPrefix+'_price_1_'+new_id+'_'+'" value="Y" /><label for="'+elmPrefix+'_price_1_'+new_id+'_'+'">������� �� ���-��</label>' ;
    td8.innerHTML = txt; 
    
    td9.className = 'cms_middle';
    txt =  '<input type="text" name="'+elmPrefix+'_expire['+new_id+']'+'" id="'+elmPrefix+'_expire_'+new_id+'" value="" size="3" />';
    td9.innerHTML = txt;
    
    txt = '';
    td10.className = 'cms_middle';
    for(var i in item_actions)
    {
        txt += '<input type="checkbox" name="'+elmPrefix+'_act['+new_id+']['+i+']" id="'+elmPrefix+'_act_'+new_id+'_'+i+'" value="Y" /><label for="'+elmPrefix+'_act_'+new_id+'_'+i+'">' + item_actions[i] + '</label><br />';
    }
    td10.innerHTML = txt;
    /*
    td6.className = 'cms_middle';
    ck1 = d.createElement('INPUT');
    ck1.type = 'checkbox';
    ck1.value = 'Y';
    ck1.name = elmPrefix+'_self['+new_id+']';
    td6.appendChild(ck1);
    */
}