function addItem_res_item(tableId, trPrefix, slName, slValues, addField, addDefValue)
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
    var select = createSelectFromArray('resource_id['+last_id+']', slValues, '');
    select.id = 'resource_id_'+last_id;
    td2.appendChild(select);
    
    var td3 = d.createElement('TD');
    var select = createSelectFromArray('resource_type['+last_id+']', resource_types );
    td3.appendChild(select);
    select.onchange = function(last_id) { return function() { filter(last_id, this.options[this.selectedIndex].value); } }(last_id);
    tr.appendChild(td3);
        
    var td4 = d.createElement('TD');
    td4.className = 'cms_middle';
    tr.appendChild(td4);
    var add_field = d.createElement('INPUT');
    add_field.type = 'text';
    add_field.name = 'count['+last_id+']';
    add_field.value = '0';
    td4.appendChild(add_field);
    
    var td5 = d.createElement('TD');
    td5.className = 'cms_middle';
    tr.appendChild(td5);
    var add_field = d.createElement('INPUT');
    add_field.type = 'text';
    add_field.name = 'restore_time['+last_id+']';
    add_field.value = '0';
    td5.appendChild(add_field);
}