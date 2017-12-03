function addItem_place_item(tableId, trPrefix, slName, slValues, addField, addDefValue) {
    var table = el(tableId);
    var tr = d.createElement('TR');
    last_id++;
    var new_id = trPrefix + last_id;
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
    del_a.onclick = function () {
        removeItem(new_id);
        return false;
    };
    del_a.appendChild(del_img);

    td1.align = 'center';
    td1.className = 'cms_middle';
    td1.appendChild(del_a);

    td2.className = 'cms_middle';
    td2.appendChild(createSelectFromArray('item[' + last_id + ']', slValues));

    var td3 = d.createElement('TD');
    td3.className = 'cms_middle';
    tr.appendChild(td3);
    var add_field = d.createElement('INPUT');
    add_field.type = 'text';
    add_field.name = 'item_amount[' + last_id + ']';
    add_field.value = '0';
    td3.appendChild(add_field);

    var td4 = d.createElement('TD');
    td4.className = 'cms_middle';
    tr.appendChild(td4);
    var add_field = d.createElement('INPUT');
    add_field.type = 'text';
    add_field.name = 'item_average[' + last_id + ']';
    add_field.value = '0';
    td4.appendChild(add_field);

    var td5 = d.createElement('TD');
    td5.className = 'cms_middle';
    tr.appendChild(td5);
    var add_field = d.createElement('INPUT');
    add_field.type = 'text';
    add_field.name = 'item_requirement[' + last_id + ']';
    add_field.value = '0';
    td5.appendChild(add_field);
}

function moveItemUp(table_name, tr_prefix, id) {
    var cur_id = 0;
    var table = el(table_name);
    var pElements = table.getElementsByTagName("tr");
    for (i = 0; i < pElements.length; i++) {
        if (pElements[i].id == tr_prefix + id)
            cur_id = i;
    }

    var tmps = '';
    var tmpi = 0;

    if (cur_id > 1) {
        var pFromElm = pElements[cur_id].getElementsByTagName("input");
        var pToElm = pElements[cur_id - 1].getElementsByTagName("input");
        for (i = 0; i < pFromElm.length; i++) {
            if (pFromElm[i].type == 'text') {
                tmps = pFromElm[i].value;
                pFromElm[i].value = pToElm[i].value;
                pToElm[i].value = tmps;
            }
        }
        var pFromElm = pElements[cur_id].getElementsByTagName("select");
        var pToElm = pElements[cur_id - 1].getElementsByTagName("select");
        for (i = 0; i < pFromElm.length; i++) {
            tmpi = pFromElm[i].selectedIndex;
            pFromElm[i].selectedIndex = pToElm[i].selectedIndex;
            pToElm[i].selectedIndex = tmpi;
        }
    }
}

function moveItemDown(table_name, tr_prefix, id) {
    var cur_id = 0;
    var table = el(table_name);
    var pElements = table.getElementsByTagName("tr");
    for (i = 0; i < pElements.length; i++) {
        if (pElements[i].id == tr_prefix + id)
            cur_id = i;
    }

    var tmps = '';
    var tmpi = 0;


    if (cur_id < pElements.length - 1) {
        var pFromElm = pElements[cur_id].getElementsByTagName("input");
        var pToElm = pElements[cur_id + 1].getElementsByTagName("input");
        for (i = 0; i < pFromElm.length; i++) {
            if (pFromElm[i].type == 'text') {
                tmps = pFromElm[i].value;
                pFromElm[i].value = pToElm[i].value;
                pToElm[i].value = tmps;
            }
        }
        var pFromElm = pElements[cur_id].getElementsByTagName("select");
        var pToElm = pElements[cur_id + 1].getElementsByTagName("select");
        for (i = 0; i < pFromElm.length; i++) {
            tmpi = pFromElm[i].selectedIndex;
            pFromElm[i].selectedIndex = pToElm[i].selectedIndex;
            pToElm[i].selectedIndex = tmpi;
        }
    }
}