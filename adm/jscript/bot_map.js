var zones_bots = Array();
var zones_posibilieis = Array();
var zones_intervals = Array();
var current_zone = -1;
var last_bot_id = 0;

function loadZones()
{
    x1 = current_x-width;
    y1 = current_y-height;
    x2 = current_x+width;
    y2 = current_y+height;
    ajaxGet('bot_map.php?action=load&x1='+x1+'&y1='+y1+'&x2='+x2+'&y2='+y2, function(data) { 
        removeAllZones();
        tarr = data.split('|');
        
        loaded_zones = Array();
        for(var i in tarr) 
        {
            if (tarr[i] != '') 
            {
                t = tarr[i].split(';');
                zone_id = addZone(parseInt(t[1]), parseInt(t[2]), parseInt(t[3]), parseInt(t[4]), parseInt(t[0]));
                loaded_zones[ loaded_zones.length ] = parseInt(t[0]);
                
                zones_intervals[zone_id] = t[5];
                
                zones_posibilieis[zone_id] = new Array();
                for(var j=1; j<=10; j++)
                    zones_posibilieis[zone_id][j] = t[5+j];
                
                bots = Array();
                if (t.length > 5) 
                {
                    for (i=16; i<t.length; i++)
                        bots[ bots.length ] = t[i];
                }
                zones_bots[zone_id] = bots.join(';');
            }
        }
        edit_mode = 1;
    }); 
}

function saveZones()
{
    params = Array();
    zones_str = bots_str = '';
    loaded_zones_str = '';
    zone_pos_str = '';
    zone_interval_str = '';
    
    for (var c in zones) 
    if (zones[c])
    {
        zones_str += c+'@'+zones[c]+'|';
        if (zones_bots[c])
            bots_str += ''+zones_bots[c]+'|';
        else
            bots_str += '|';
        zone_pos_str += zones_posibilieis[c].join(';') + '|';
        zone_interval_str += zones_intervals[c] + '|';
    }
    
    loaded_zones_str = loaded_zones.join('|');
        
    params['action'] = 'save';
    params['zones'] = zones_str;
    params['zones_pos'] = zone_pos_str;
    params['zones_intervals'] = zone_interval_str;
    params['bots'] = bots_str;
    params['loaded_zones'] = loaded_zones_str;
    //params['params'] = 
    
    ajaxPost('bot_map.php', params, function(data) { alert(data); loadZones(); } );
}

function showZoneParams(zone_id)
{
    // Show table
    el('bots_div').style.display = 'block';
    
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
    el('bots_div').style.left = (pos.x + (x1 - current_x + width)*51 + Math.floor(((x2-x1+1)*51 )/2)) + 'px';
    el('bots_div').style.top = (pos.y + (y1 - current_y + height)*51 + Math.floor(((y2-y1+1)*51 )/2)) + 'px';
    
    if (!zones_posibilieis[zone_id])
    {
        zones_posibilieis[zone_id] = new Array();
        for(var j=1; j<=10; j++)
            zones_posibilieis[zone_id][j] = '0';
        zones_intervals[zone_id] = '0';
    }
    
    for(var j=1; j<=10; j++)
        el('poss' + j).value = zones_posibilieis[zone_id][j];
        
    el('time_interval').value = zones_intervals[zone_id];
    
    // Clear table
    tbody = el('bots_table').lastChild;
    while (tbody.childNodes.length > 1) 
        tbody.removeChild(tbody.lastChild)
        
    if (zones_bots[zone_id] && zones_bots[zone_id] != '')
        bots = zones_bots[zone_id].split(';');
    else
        bots = Array();
        
    for (var i=0; i<bots.length; i++) 
    {
        b = bots[i];
        paramAddBot(b);
    }
    
    current_zone = zone_id;
    
    return true;
}

function paramAddBot(bot_id)
{
    last_bot_id++;
    
    var table = el('bots_table');
    
    var tr = d.createElement('TR');
    
    var new_id = 'tr_bot_'+last_id;
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
    del_a.onclick = function() { removeItem(new_id); /*removeZone(lid); */return false; };
    del_a.appendChild(del_img);
    
    td1.align = 'center';
    td1.className = 'cms_middle';
    td1.appendChild(del_a);
    
    // bots_array  should be defined
    
    td2.className = 'cms_middle';
    sl1 = createHSelectFromArray('bot_id', bots_templates_array, bots_array, bot_id);
    sl1.id = 'bot_'+new_id;
    td2.appendChild(sl1);
    
    return true;
}

function saveBotsParams()
{
    var elmts = el('bots_table').getElementsByTagName('select');
    bots = Array();
    for (i=0; i<elmts.length; i++) 
    {
        elm = elmts[i];
        if (elm.name == 'bot_id') 
        {
            bot = elm.options[elm.selectedIndex].value;
            if (bot != '')
                bots[ bots.length ] = bot;
        }
    }
    var elmts = el('bots_table').getElementsByTagName('input');
    for (i=0; i<elmts.length; i+=2) 
    {
        var bot_id = Math.floor(i / 2);
        bots[ bot_id ] += ':'+elmts[i].value+':'+elmts[i+1].value;
    }
    
    zones_bots[ current_zone ] = bots.join(';');
    
    for(var j=1; j<=10; j++)
        zones_posibilieis[current_zone][j] = el('poss' + j).value;
        
    zones_intervals[current_zone] = el('time_interval').value;
    
    el('bots_div').style.display = 'none'; 
    return true;
    
}

function cancelZoneParams()
{
    el('bots_div').style.display = 'none';
    return true;
}