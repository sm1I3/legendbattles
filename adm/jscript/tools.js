var d = document;
var el = function(elm) { return document.getElementById(elm) };

function removeItem(item)
{
    var elm = el(item);
    elm.parentNode.removeChild(elm);
    return false;
}

function addItem_select(tableId, trPrefix, slName, slValues, addField, addDefValue)
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
    del_a.onclick = function() { removeItem(new_id); };
    del_a.appendChild(del_img);
    
    td1.align = 'center';
    td1.className = 'cms_middle';
    td1.appendChild(del_a);
    
    td2.className = 'cms_middle';
    td2.appendChild(createSelectFromArray(slName, slValues));
    
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

function addItem_edit(tableId, trPrefix, edName, edDefValue, addField, addDefValue)
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
    del_a.onclick = function() { removeItem(new_id); };
    del_a.appendChild(del_img);
    
    td1.align = 'center';
    td1.className = 'cms_middle';
    td1.appendChild(del_a);
    
    td2.className = 'cms_middle';
    ed = d.createElement('INPUT');
    ed.type = 'text';
    ed.name = edName;
    ed.value = edDefValue;
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

function createSelectFromArray(select_name, array, selected_id)
{
    var select = d.createElement('SELECT');
    select.name = select_name;
    i = 0;
    select.options[0] = new Option('(Please select)', '');
    for (k in array) {
        select.options[++i] = new Option(array[k], k);
    }
    return select;
}