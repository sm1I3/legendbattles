function addItem_mine_res(tableId, trPrefix, elmPrefix, res_array)
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
    
    td2.className = 'cms_middle';
    sl1 = createSelectFromArray(elmPrefix+'['+new_id+']', res_array, '');
    td2.appendChild(sl1);
    
    td3.className = 'cms_middle';
    ed2 = d.createElement('INPUT');
    ed2.type = 'text';
    ed2.name = elmPrefix+'_count['+new_id+']';
    ed2.value = '';
    td3.appendChild(ed2);
    
    td4.className = 'cms_middle';
    ed1 = d.createElement('INPUT');
    ed1.type = 'text';
    ed1.name = elmPrefix+'_ability['+new_id+']';
    ed1.value = '0';
    td4.appendChild(ed1);
    
    td5.className = 'cms_middle';
    rand_array = new Array();
    rand_array[1] = '1 - Большое кол-во маленьких жил';
    rand_array[2] = '2';
    rand_array[3] = '3';
    rand_array[4] = '4';
    rand_array[5] = '5 - Малое кол-во больших жил';
    sl2 = createSelectFromArray(elmPrefix+'_rand['+new_id+']', rand_array, '');
    td5.appendChild(sl2);
    
}