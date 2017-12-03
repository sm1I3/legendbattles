function createWorldMapControl(control_name, control_type)
{
    var cdiv = d.createElement('DIV');
    
    var uid = uniqId();
    
    var hf = d.createElement('INPUT');
    hf.name = control_name;
    hf.type = 'hidden';
    hf.id = uid+'_hf';
    cdiv.appendChild(hf);
    
    var nf = d.createElement('INPUT');
    nf.type = 'text';
    nf.readOnly = true;
    nf.id = uid+'_nf';
    nf.name = '___name'+control_name;
    cdiv.appendChild(nf);
    
    var bt = d.createElement('INPUT');
    bt.type = 'button';
    bt.name = '___button'+control_name;
    bt.value = '...';
    bt.onclick = function() { showWorldMapDiallog(uid, control_type); };
    cdiv.appendChild(bt);
    
    var clr = d.createElement('IMG');
    clr.src = 'images/cms_icons/cms_calendar_clear.gif';
    clr.align = 'absmiddle';
    clr.title = 'Clear';
    clr.style.cursor = 'pointer';
    clr.onclick = function() { clearWorldMapDiallog(uid); };
    cdiv.appendChild(clr);
    
    return cdiv;
}

function getWorldMap(x, y, selected)
{
    div = d.createElement('DIV');
    table = d.createElement('TABLE');
    div.appendChild(table);
    tbody = d.createElement('TBODY');
    table.appendChild(tbody);
    table.border = 0;
    table.cellPadding = 0;
    table.cellSpacing = 0;
    table.style.borderLeft = '1px solid black';
    table.style.borderTop = '1px solid black';
    
    for (i=-5; i<=5; i++) {
        
        tr = d.createElement('TR');
        for (j=-8; j<=8; j++) {
            td = d.createElement('TD');
            td.background = 'http://image.neverlands.ru/map/world/small/'+(y+i)+'/'+(x+j)+'_'+(y+i)+'.jpg';
            td.style.borderRight = '1px solid black';
            td.style.borderBottom = '1px solid black';
            img = d.createElement('IMG');
            img.src = 'http://image.neverlands.ru/map/world/small/'+(y+i)+'/'+(x+j)+'_'+(y+i)+'.jpg';
            img.width = 50;
            img.height = 50;
            
            td.appendChild(img);
            tr.appendChild(td);
        }
        tbody.appendChild(tr);
    
    }
    return div;
}

function showWorldMapDiallog(uid, id_type)
{
    // Open modal window
    window_id = 'window_'+uid+'_'+uniqId();
    
    var mWindow = new ModalWindow(window_id);
    
    mWindow.title = 'Выбор зоны';
    mWindow.content = '';
    mWindow.width = 900;
    mWindow.height = 500;
    mWindow.open();
    
    // Create Table for Weapons
    var table = d.createElement('TABLE');
    var tbody = d.createElement('TBODY');
    table.appendChild(tbody);
    var tr1 = d.createElement('TR');
    //var tr2 = d.createElement('TR');
    tbody.appendChild(tr1);
    //tbody.appendChild(tr2);
    var td1_1 = d.createElement('TD');
    var td1_2 = d.createElement('TD');
    //var td2_1 = d.createElement('TD');
    //td2_1.colSpan = '2';
    tr1.appendChild(td1_1);
    tr1.appendChild(td1_2);
    //tr2.appendChild(td2_1);
    
    //World map
    div = getWorldMap(1000, 1000);
    td1_1.appendChild(div);
    
    
    // Button OK
    var bok = d.createElement('INPUT');
    bok.type = 'button';
    bok.value = 'OK';
    bok.onclick = function() { 
        var pElements = div.getElementsByTagName("input");
        for (i=0; i<pElements.length; i++) {
            var pElement = pElements.item(i);
            if (pElement.checked) {

                el(uid+'_hf').value = pElement.value;
                el(uid+'_nf').value = el(pElement.id+'_name').value;
                mWindow.close(mWindow.windowId);
            }
        }
    }
    
    // If some value has beed selected already
    /*
    ed.value = el(uid+'_nf').value;
    
    if (ed.value != '') {
        ajaxGet('ajax_control/select_weapon.php?wtype='+encodeURIComponent(sl.options[sl.selectedIndex].value)+'&wname='+encodeURIComponent(ed.value)+'&idtype='+encodeURIComponent(id_type)+'&id='+encodeURIComponent(el(uid+'_hf').value), function(data) {
            var ar = data.split('|');
            var div_container = div;
            div_container.innerHTML = ar[1];
        });
    }
    */
    
    
    // Cancel button
    var bcl = d.createElement('INPUT');
    bcl.type = 'button';
    bcl.value = 'Отмена';
    bcl.onclick = function() { 
       mWindow.close(mWindow.windowId);
    }
    
    td1_1.appendChild(d.createElement('BR'));
    td1_1.appendChild(bok);
    td1_1.appendChild(bcl);
    
    // Applying table to modal window
    mWindow.getContentElement().appendChild(table);
    
    return true;
}

function clearWorldMapDiallog(uid)
{
    el(uid+'_nf').value = '';
    el(uid+'_hf').value = '';
    return true;
}