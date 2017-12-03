

function createWeaponControl(control_name, control_type, table_type)
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
    bt.onclick = function() { showWeaponDiallog(uid, control_type, table_type); };
    cdiv.appendChild(bt);
    
    var clr = d.createElement('IMG');
    clr.src = 'images/cms_icons/cms_calendar_clear.gif';
    clr.align = 'absmiddle';
    clr.title = 'Clear';
    clr.style.cursor = 'pointer';
    clr.onclick = function() { clearWeaponDiallog(uid); };
    cdiv.appendChild(clr);
    
    return cdiv;
}

function showWeaponDiallog(uid, id_type, weapon_table)
{
    if (weapon_table == 'undefined')
        weapon_table = '';
    // Open modal window
    window_id = 'window_'+uid+'_'+uniqId();
    
    var mWindow = new ModalWindow(window_id);
    
    mWindow.title = 'Выбор оружия';
    mWindow.content = '';
    mWindow.width = 500;
    mWindow.height = 300;
    mWindow.open();
    
    // Create Table for Weapons
    var table = d.createElement('TABLE');
    var tbody = d.createElement('TBODY');
    table.appendChild(tbody);
    var tr1 = d.createElement('TR');
    var tr2 = d.createElement('TR');
    var tr3 = d.createElement('TR');
    tbody.appendChild(tr1);
    tbody.appendChild(tr2);
    tbody.appendChild(tr3);
    var td1_1 = d.createElement('TD');
    var td1_2 = d.createElement('TD');
    var td2_1 = d.createElement('TD');
    var td3_1 = d.createElement('TD');
    td2_1.colSpan = '2';
    td3_1.colSpan = '2';
    tr1.appendChild(td1_1);
    tr1.appendChild(td1_2);
    tr2.appendChild(td2_1);
    tr3.appendChild(td3_1);
    
    // Weapon types
    // weapon_categories should be defined in the code
    
    var sl = createSelectFromArray('select_weapon_type', weapon_categories, '');
    var ed = d.createElement('INPUT');
    ed.type = 'text';
    ed.name = 'select_weapon_name';
    ed.value = '';
    
    // Weapon name
    var text = document.createTextNode('Тип: ');
    td1_1.appendChild(text);
    td1_1.appendChild(sl);
    var text = document.createTextNode('Название: '); 
    td1_2.appendChild(text);
    td1_2.appendChild(ed);
    
    var div = d.createElement('DIV');
    div.id = window_id+'_weapon_content';
    div.style.overflow = 'auto';
    div.style.width = '400px';
    div.style.height = '300px';
    div.style.border = '1px solid blue';
    td3_1.appendChild(div);
    
    // Button GO
    var bt = d.createElement('INPUT');
    bt.type = 'button';
    bt.name = 'go';
    bt.value = '>';
    bt.onclick = function() {
        ajaxGet('ajax_control/select_weapon.php?wtype='+encodeURIComponent(sl.options[sl.selectedIndex].value)+'&wname='+encodeURIComponent(ed.value)+'&idtype='+encodeURIComponent(id_type)+'&wtable='+encodeURIComponent(weapon_table), function(data) {
            var ar = data.split('|');
            var div_container = div;
            div_container.innerHTML = ar[1];
        });
        
        return true;
    }
    
    td1_2.appendChild(bt);
    
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
    ed.value = el(uid+'_nf').value;
    
    if (ed.value != '') {
        ajaxGet('ajax_control/select_weapon.php?wtype='+encodeURIComponent(sl.options[sl.selectedIndex].value)+'&wname='+encodeURIComponent(ed.value)+'&idtype='+encodeURIComponent(id_type)+'&id='+encodeURIComponent(el(uid+'_hf').value), function(data) {
            var ar = data.split('|');
            var div_container = div;
            div_container.innerHTML = ar[1];
        });
    }
    
    // Cancel button
    var bcl = d.createElement('INPUT');
    bcl.type = 'button';
    bcl.value = 'Отмена';
    bcl.onclick = function() { 
       mWindow.close(mWindow.windowId);
    }
    
    td3_1.appendChild(d.createElement('BR'));
    td3_1.appendChild(bok);
    td3_1.appendChild(bcl);
    
    // Applying table to modal window
    mWindow.getContentElement().appendChild(table);
    
    return true;
}

function clearWeaponDiallog(uid)
{
    el(uid+'_nf').value = '';
    el(uid+'_hf').value = '';
    return true;
}