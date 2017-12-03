var d = document;
var el = function(elm) { return document.getElementById(elm) };

var uniqId = (function() {
   var numberOfCalls = 0;
   return function() {
      return ++ numberOfCalls;
   }
})();

function removeItem(item)
{
    var elm = el(item);
    elm.parentNode.removeChild(elm);
    return false;
}

function roundTo(number, signs)
{
    if (signs > 0) {
        var x = Math.pow(10, signs);
        return (Math.round(number*x)) / x;
    } else
        return Math.round(number);
}

function floorTo(number, signs)
{
    if (signs > 0) {
        var x = Math.pow(10, signs);
        return (Math.floor(number*x)) / x;
    } else
        return Math.floor(number);
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
    del_a.onclick = function() { removeItem(new_id); return false; };
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
        if (selected_id == k)
            select.options[i].selected = true;
    }
    return select;
}

function createHSelectFromArray(select_name, group_array, element_array, selected_id)
{
    
    selected_group = '';
    for (var g in element_array) {
        for (var e in element_array[g]) {
            if (selected_id == e)
                selected_group = g;
        }
    }

    var gselect = d.createElement('SELECT');
    
    gselect.name = select_name+'_group';
    i = 0;
    gselect.options[0] = new Option('(Please select)', '');
    for (k in group_array) {
        gselect.options[++i] = new Option(group_array[k], k);
        if (selected_group == k)
            gselect.options[i].selected = true;
    }
    
    var eselect = d.createElement('SELECT');
    eselect.name = select_name;
    i = 0;
    eselect.options.length = 0;
    eselect.options[0] = new Option('(Please select)', '');
    
    if (selected_group != '')
    for (k in element_array[selected_group]) {
        eselect.options[++i] = new Option(element_array[selected_group][k], k);
        if (selected_id == k)
            eselect.options[i].selected = true;
    }
    
    gselect.onchange = function() {
        eselect.options.length = 0;
        i = 0;
        eselect.options[0] = new Option('(Please select)', '');
        
        selected_group = gselect.options[gselect.selectedIndex].value;
        if (selected_group != '')
        for (k in element_array[selected_group]) {
            eselect.options[++i] = new Option(element_array[selected_group][k], k);
            if (selected_id == k)
                eselect.options[i].selected = true;
        }
    }
    
    var div = d.createElement('DIV');
    div.appendChild(gselect);
    div.appendChild( d.createElement('BR') );
    div.appendChild(eselect);
    
    
    return div;
}

function absPosition(obj) {
      var x = y = 0;
      while(obj) {
            x += obj.offsetLeft;
            y += obj.offsetTop;
            obj = obj.offsetParent;
      }
      return {x:x, y:y};
} 



// Javascript url encode/decode
var trans=[];
var snart=[];
for(var i=0x410;i<=0x44F;i++)
{
    trans[i]=i-0x350;
    snart[i-0x350] = i;
}
trans[0x401]= 0xA8;
trans[0x451]= 0xB8;
snart[0xA8] = 0x401;
snart[0xB8] = 0x451;

window.urlencode = function(str)
{
    var ret=[];
    for(var i=0;i<str.length;i++)
    {
        var n=str.charCodeAt(i);
        if(typeof trans[n]!='undefined')
        n = trans[n];
        if (n <= 0xFF)
        ret.push(n);
    }

    return window.escape(String.fromCharCode.apply(null,ret));
}

window.urldecode = function(str)
{
    var ret=[];
    str = unescape(str);
    for(var i=0;i<str.length;i++)
    {
        var n=str.charCodeAt(i);
        if(typeof snart[n]!='undefined')
        n = snart[n];
        ret.push(n);
    }

    return String.fromCharCode.apply(null,ret);
}

function getSelectValue(select)
{
    return select.options[select.selectedIndex].value;
}

function setSelectValue(sel_code, val)
{
    sel = el(sel_code);
    
    for(i=0; i<sel.options.length; i++)
        if (sel.options[i].value == val)
            sel.selectedIndex = i;
    
    return true;
}

function setCookie (name, value, expires, path, domain, secure) {
      document.cookie = name + "=" + escape(value) +
        ((expires) ? "; expires=" + expires : "") +
        ((path) ? "; path=" + path : "") +
        ((domain) ? "; domain=" + domain : "") +
        ((secure) ? "; secure" : "");
}

function getCookie(name) {
    var cookie = " " + document.cookie;
    var search = " " + name + "=";
    var setStr = null;
    var offset = 0;
    var end = 0;
    if (cookie.length > 0) {
        offset = cookie.indexOf(search);
        if (offset != -1) {
            offset += search.length;
            end = cookie.indexOf(";", offset)
            if (end == -1) {
                end = cookie.length;
            }
            setStr = unescape(cookie.substring(offset, end));
        }
    }
    return(setStr);
}

function delCookie(name) {
    document.cookie = name+'= ; expires=Fri, 3 Aug 2001 20:47:11 UTC; path=/';
}