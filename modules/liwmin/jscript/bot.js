function addItem_weapon_drop(tableId, trPrefix, edName, edDefValue, addField, addDefValue)
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
    var td8 = d.createElement('TD');
    var td9 = d.createElement('TD');
    var td10 = d.createElement('TD');
    tr.appendChild(td1);
    tr.appendChild(td2);
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
    
    // Group
    var ed = d.createElement('INPUT');
    ed.type = 'text';
    ed.name = 'drop_group['+last_id+']';
    ed.size = 5;
    ed.value = '0';
    td2.className = 'cms_middle';
    td2.appendChild(ed);
    
    // Drop type
    var sel = createSelectFromArray('drop_type['+last_id+']', drop_types);
    sel.id = last_id+'_drop_type_sel';
    sel.onclick = function(i){
        return function() {
            ind = el(last_id+'_drop_type_sel').selectedIndex;
            switchControl(last_id, ind)
        }
    }(sel.selectedIndex);
    td3.className = 'cms_middle';
    td3.appendChild(sel);
    
    // Item
    td4.className = 'cms_middle';
    td4.className = 'cms_middle';
    
    div1 = d.createElement('DIV');
    div1.id = last_id+'_drop_type_1';
    sel = createSelectFromArray('drop_money['+last_id+']', money_types);
    div1.style.display = 'none';
    div1.appendChild(sel);
    
    div2 = d.createElement('DIV');
    div2.id = last_id+'_drop_type_2';
    sel = createSelectFromArray('drop_resource['+last_id+']', resources);
    div2.style.display = 'none';
    div2.appendChild(sel);
    
    div3 = d.createElement('DIV');
    div3.id = last_id+'_drop_type_3';
    wc = createWeaponControl('drop_weapon['+last_id+']', 'uid');
    div3.style.display = 'none';
    div3.appendChild(wc);
    
    div4 = d.createElement('DIV');
    div4.id = last_id+'_drop_type_4';
    sel = createSelectFromArray('drop_tools['+last_id+']', tools);
    div4.style.display = 'none';
    div4.appendChild(sel);
    
    td4.appendChild(div1);
    td4.appendChild(div2);
    td4.appendChild(div3);
    td4.appendChild(div4);
    
    // Chance
    var ed = d.createElement('INPUT');
    ed.type = 'text';
    ed.name = 'drop_chance['+last_id+']';
    //ed.size = 5;
    td5.className = 'cms_middle';
    td5.appendChild(ed);
    
    // Count min
    var ed = d.createElement('INPUT');
    ed.type = 'text';
    ed.name = 'count_min['+last_id+']';
    ed.size = 8;
    ed.value = '0';
    td6.className = 'cms_middle';
    td6.appendChild(ed);
    
    // Count max
    var ed = d.createElement('INPUT');
    ed.type = 'text';
    ed.name = 'count_max['+last_id+']';
    ed.size = 8;
    ed.value = '0';
    td7.className = 'cms_middle';
    td7.appendChild(ed);
    
    // quest
    var ed = d.createElement('INPUT');
    ed.type = 'text';
    ed.name = 'completed_quest['+last_id+']';
    ed.size = 8;
    ed.value = '0';
    td8.className = 'cms_middle';
    td8.appendChild(ed);
    
    // deactivate_by_quest
    var ed = d.createElement('INPUT');
    ed.type = 'text';
    ed.name = 'deactivate_by_quest['+last_id+']';
    ed.size = 8;
    ed.value = '0';
    td9.className = 'cms_middle';
    td9.appendChild(ed);
    
    // align
    var ed = d.createElement('INPUT');
    ed.type = 'text';
    ed.name = 'align['+last_id+']';
    ed.size = 8;
    ed.value = '0';
    td10.className = 'cms_middle';
    td10.appendChild(ed);
    
}