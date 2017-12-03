var zones_plants = Array();
var current_zone = -1;

function loadZones()
{
    x1 = current_x-width;
    y1 = current_y-height;
    x2 = current_x+width;
    y2 = current_y+height;
    ajaxGet('tree_map.php?action=load&x1='+x1+'&y1='+y1+'&x2='+x2+'&y2='+y2, function(data) { 
        removeAllZones();
        tarr = data.split('|');
        
        loaded_zones = Array();
        for(var i in tarr) {
            if (tarr[i] != '') {
                t = tarr[i].split(';');
                zone_id = addZone(parseInt(t[1]), parseInt(t[2]), parseInt(t[3]), parseInt(t[4]));
                loaded_zones[ loaded_zones.length ] = parseInt(t[0]);
                
                plants = Array();
                if (t.length > 5) {
                    for (i=5; i<t.length; i++)
                        plants[ plants.length ] = t[i];
                }
                zones_plants[zone_id] = plants.join(';');
            }
        }
        edit_mode = 1;
    }); 
}

function saveZones()
{
    params = Array();
    zones_str = plants_str = '';
    loaded_zones_str = '';
    for (var c in zones) {
        zones_str += ''+zones[c]+'|';
        if (zones_plants[c])
            plants_str += ''+zones_plants[c]+'|';
        else
            plants_str += '|';
    }
    
    loaded_zones_str = loaded_zones.join('|');
        
    params['action'] = 'save';
    params['zones'] = zones_str;
    params['plants'] = plants_str;
    params['loaded_zones'] = loaded_zones_str;
    //params['params'] = 
    
    ajaxPost('tree_map.php', params, function(data) { alert(data); } );
}

function showZoneParams(zone_id)
{
    // Show table
    el('plants_div').style.display = 'block';
    
    // POSITION
    pos = absPosition(el('world_map'));
    zone = zones[zone_id];
        
    tar = zone.split(';');
    tar1 = tar[0].split(',');
    tar2 = tar[1].split(',');
    
    x1 = parseInt(tar1[0]);
    y1 = parseInt(tar1[1]);
    x2 = parseInt(tar2[0]);
    y2 = parseInt(tar2[1]);
    el('plants_div').style.left = (pos.x + (x1 - current_x + width)*51 + Math.floor(((x2-x1+1)*51 )/2)) + 'px';
    el('plants_div').style.top = (pos.y + (y1 - current_y + height)*51 + Math.floor(((y2-y1+1)*51 )/2)) + 'px';
    
    // Clear table
    tbody = el('plants_table').lastChild;
    while (tbody.childNodes.length > 1) 
        tbody.removeChild(tbody.lastChild)
        
    if (zones_plants[zone_id] && zones_plants[zone_id] != '')
        plants = zones_plants[zone_id].split(';');
    else
        plants = Array();
        
    for (var i in plants) {
        paramAddPlant(plants[i]);
    }
    
    current_zone = zone_id;
    
    return true;
}

function paramAddPlant(plant_id)
{
    last_id++;
    
    var table = el('plants_table');
    
    var tr = d.createElement('TR');
    
    var new_id = 'tr_plant_'+last_id;
    var lid = last_id;
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
    del_a.onclick = function() { removeItem(new_id); removeZone(lid); return false; };
    del_a.appendChild(del_img);
    
    td1.align = 'center';
    td1.className = 'cms_middle';
    td1.appendChild(del_a);
    
    // plants_array  should be defined
    
    td2.className = 'cms_middle';
    sl1 = createSelectFromArray('plant_id', res_array, plant_id);
    sl1.id = 'plant_'+new_id;
    td2.appendChild(sl1);
    
    return true;
}

function savePlantsParams()
{
    var elmts = el('plants_table').getElementsByTagName('select');
    plants = Array();
    for (i=0; i<elmts.length; i++) {
        elm = elmts[i];
        if (elm.name == 'plant_id') {
            plant = elm.options[elm.selectedIndex].value;
            if (plant != '')
                plants[ plants.length ] = plant;
        }
    }
    zones_plants[ current_zone ] = plants.join(';');
    
    el('plants_div').style.display = 'none'; 
    return true;
    
}

function cancelZoneParams()
{
    el('plants_div').style.display = 'none';
    return true;
}