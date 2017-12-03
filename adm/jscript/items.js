function addItem_item_mf(tableId, trPrefix, edName, arrMod)
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
    
    
    // field 1
    /*
    td2.className = 'cms_middle';
    ed = d.createElement('INPUT');
    ed.type = 'text';
    ed.name = edName+'[]';
    ed.value = edDefValue;
    td2.appendChild(ed);
    */
    td2.className = 'cms_middle'; 
    sel = createSelectFromArray(edName+'[]', arrMod, '');
    td2.appendChild(sel);
    
    // field 2
    td3.className = 'cms_middle';
    ed = d.createElement('INPUT');
    ed.type = 'text';
    ed.name = edName+'_value[]';
    ed.value = '';
    td3.appendChild(ed);
    
    // field 3
    td4.className = 'cms_middle';
    ed = d.createElement('INPUT');
    ed.type = 'text';
    ed.name = edName+'_time[]';
    ed.value = '';
    td4.appendChild(ed);
    
}

function addItem_item_rm(tableId, trPrefix, edName, arrMod, tdPrefix)
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
    tr.appendChild(td1);
    tr.appendChild(td2);
    tr.appendChild(td3);
    tr.appendChild(td4);
    tr.appendChild(td5);
    
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
    
    // add image
    var add_img = d.createElement('IMG');
    add_img.src = 'images/cms_icons/cms_add.gif';
    add_img.width = '16';
    add_img.height = '16';
    var add_a = d.createElement('A');
    add_a.href = '#';
    var td_id = tdPrefix+'_'+new_id;
    add_a.onclick = function() { addItemField_rm(td_id, edName+'['+new_id+'][]', arrMod); return false; };
    add_a.appendChild(add_img);
    
    td2.align = 'center';
    td2.className = 'cms_middle';
    td2.appendChild(add_a);
    
    // field 1
    /*
    td3.className = 'cms_middle';
    td3.id = 'td_rm_'+new_id;
    ed = d.createElement('INPUT');
    ed.type = 'text';
    ed.name = edName+'['+new_id+'][]';
    ed.value = edDefValue;
    td3.appendChild(ed);
    */
    td3.className = 'cms_middle';
    td3.id = td_id;  
    sel = createSelectFromArray(edName+'['+new_id+'][]', arrMod, '');
    td3.appendChild(sel);
    
    // field 2
    td4.className = 'cms_middle';
    ed = d.createElement('INPUT');
    ed.type = 'text';
    ed.name = edName+'_value['+new_id+']';
    ed.value = '';
    td4.appendChild(ed);
    
    // field 3
    td5.className = 'cms_middle';
    ed = d.createElement('INPUT');
    ed.type = 'text';
    ed.name = edName+'_time['+new_id+']';
    ed.value = '';
    td5.appendChild(ed);
    
}

function addItem_item_rmb(tableId, trPrefix, edName, arrMod, tdPrefix)
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
    var td7 = d.createElement('TD');
    tr.appendChild(td1);
    tr.appendChild(td2);
    tr.appendChild(td3);
    tr.appendChild(td4);
    tr.appendChild(td5);
    tr.appendChild(td6);
    tr.appendChild(td7);
    
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
    
    // add image
    var add_img = d.createElement('IMG');
    add_img.src = 'images/cms_icons/cms_add.gif';
    add_img.width = '16';
    add_img.height = '16';
    var add_a = d.createElement('A');
    add_a.href = '#';
    var td_id = tdPrefix+'_'+new_id;
    add_a.onclick = function() { addItemField_rm(td_id, edName+'['+new_id+'][]', arrMod); return false; };
    add_a.appendChild(add_img);
    
    td2.align = 'center';
    td2.className = 'cms_middle';
    td2.appendChild(add_a);
    
    // field 1
    /*
    td3.className = 'cms_middle';
    td3.id = td_id;
    ed = d.createElement('INPUT');
    ed.type = 'text';
    ed.name = edName+'['+new_id+'][]';
    ed.value = edDefValue;
    td3.appendChild(ed);
    */
    td3.className = 'cms_middle'; 
    td3.id = td_id; 
    var sel = createSelectFromArray(edName+'['+new_id+'][]', arrMod, '');
    td3.appendChild(sel);
    
    // field 2
    td4.className = 'cms_middle';
    ed = d.createElement('INPUT');
    ed.type = 'text';
    ed.name = edName+'_minvalue['+new_id+']';
    ed.value = '';
    td4.appendChild(ed);
    
    // field 3
    td5.className = 'cms_middle';
    ed = d.createElement('INPUT');
    ed.type = 'text';
    ed.name = edName+'_time['+new_id+']';
    ed.value = '';
    td5.appendChild(ed);
    
    // field 4
    td6.className = 'cms_middle';
    ed = d.createElement('INPUT');
    ed.type = 'text';
    ed.name = edName+'_maxvalue['+new_id+']';
    ed.value = '';
    td6.appendChild(ed);
    
    // checkbox
    td7.className = 'cms_middle';
    ck = d.createElement('INPUT');
    ck.type = 'checkbox';
    ck.checked = true;
    ck.name = edName+'_ispositive['+new_id+']';
    ck.value = 'Y';
    td7.appendChild(ck);
    
}

function addItemField_rm(td_id, field_name, arrMod)
{
    var sel = createSelectFromArray(field_name, arrMod, ''); 
    //var ed = d.createElement('INPUT');
    var br = d.createElement('BR');
    el(td_id).appendChild(br);
    el(td_id).appendChild(sel);
}


function addItem_item_initres(tableId, trPrefix, slName, slValues, addField, addDefValue)
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
    del_a.onclick = function() { removeItem(new_id); recalcResourceCount(); recalcResourcePrice(); return false; };
    del_a.appendChild(del_img);
    
    td1.align = 'center';
    td1.className = 'cms_middle';
    td1.appendChild(del_a);
    
    td2.className = 'cms_middle';
    var sel = createSelectFromArray(slName, slValues);
    sel.onchange = function() { recalcResourceCount(); recalcResourcePrice(); return false; }
    sel.id = 'init_res_'+last_id;
    td2.appendChild(sel);
    
    if (addField != '') {
        var td3 = d.createElement('TD');
        td3.className = 'cms_middle';
        tr.appendChild(td3);
        var add_field = d.createElement('INPUT');
        add_field.type = 'text';
        add_field.name = addField;
        add_field.value = addDefValue;
        add_field.onchange = function() { recalcResourcePrice(); return false; }
        add_field.id = 'init_res_'+last_id+'_count';
        td3.appendChild(add_field);
    }
}



function recalcResourceCount()
{
    //res_prices should be global
    
    var count = 0;
    var table = el('table_resources');
    
    var pElements = table.getElementsByTagName("select");
    for (i=0; i<pElements.length; i++) {
        if (pElements[i].selectedIndex > 0) 
            count++;
    }
    
    var total_price = el('item_cost_total').value;
    
    for (i=0; i<pElements.length; i++) {
        if (pElements[i].selectedIndex > 0) { 
            el(pElements[i].id+'_count').value = floorTo(((total_price / count) / res_prices[pElements[i].options[pElements[i].selectedIndex].value]), 5);
        }
    }
    
    return true;
    
}



function recalcResourcePrice()
{
    //res_prices should be global
    var total = 0;
    var table = el('table_resources');
    
    var pElements = table.getElementsByTagName("select");
    for (i=0; i<pElements.length; i++) {
        if (pElements[i].selectedIndex > 0) { 
            total += el(pElements[i].id+'_count').value * res_prices[pElements[i].options[pElements[i].selectedIndex].value];
        }
    }
    
    el('init_res_total_info').innerHTML = floorTo(total, 5);
    
    return true;
}