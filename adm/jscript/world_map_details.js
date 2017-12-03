var cells = Array();

var current_cell = -1;
var changed_cells = Array();

var buffer_cell = Array();

function loadCells()
{
    x1 = current_x-width;
    y1 = current_y-height;
    x2 = current_x+width;
    y2 = current_y+height;
    ajaxGet('world_map.php?action=load&x1='+x1+'&y1='+y1+'&x2='+x2+'&y2='+y2, function(data) { 
        //removeAllZones();
        
        tarr = data.split('#');
        cells = Array();
        
        for(var i in tarr) {
            if (tarr[i] != '') {
                t = tarr[i].split(';');
                
                cells['m_'+t[0]+'_'+t[1]] = Array();
                cells['m_'+t[0]+'_'+t[1]]['zone'] = t[2];
                cells['m_'+t[0]+'_'+t[1]]['name'] = urldecode(t[3]);
                cells['m_'+t[0]+'_'+t[1]]['details'] = t[4];
                cells['m_'+t[0]+'_'+t[1]]['enter'] = urldecode(t[5]);
                cells['m_'+t[0]+'_'+t[1]]['add'] = urldecode(t[6]);
                
                edit_mode = 1;
            }
            
        }
        
        for (i=y1; i<=y2; i++) {
            for (j=x1; j<=x2; j++) {
                if (cells['m_'+j+'_'+i])
                    el('img_'+j+'_'+i).src = 'images/spacer.gif';
                else
                    el('img_'+j+'_'+i).src = 'images/bg.png';
            }
        }
    });
    changed_cells = Array(); 
    buffer_cell = Array();
    
    setClibboardStatus('empty');
    setSavedStatus('saved');
    
    cancelDetails();
}

function unselectZones() { }
function removeAllZones() { }

var fctime = 0;
var sctime = 0;
function mapClick(x, y)
{
    var time = new Date().getTime();
    
    if (time - fctime <= 250 && fctime - sctime <= 250)
        mapTrippleClick(x, y);
    if (time - fctime <= 250)
        mapDoubleClick(x, y);
    else
        showDetails(x, y);
    
    sctime = fctime;    
    fctime = time;
}

function mapDoubleClick(x, y)
{
    var id = 'm_'+x+'_'+y; 
    el('details_div').style.display = 'block';
    ccnt = Array();
    if (!cells[id]) 
    {
        for (xi=x-1; xi<=x+1; xi++)
        for (yi=y-1; yi<=y+1; yi++)
        if (xi != x || yi != y)
        {
            id = 'm_'+xi+'_'+yi;
            if (cells[id])
            {
                if (ccnt[cells[id]['name']])
                    ccnt[cells[id]['name']]['cnt']++;
                else
                {
                    ccnt[cells[id]['name']] = Array();
                    ccnt[cells[id]['name']]['cnt'] = 1;
                    ccnt[cells[id]['name']]['code'] = id;
                }
            }
        }
        
        
        var code = '';
        
        var max = 0;
        for(var name in ccnt) 
        {
            if (ccnt[name]['cnt'] > max)
            {
                max = ccnt[name]['cnt'];
                code = ccnt[name]['code'];
            }
        }
        
        if (code != '')
        {
            id = 'm_'+x+'_'+y; 
            cells[id] = cells[code];
            el('img_'+x+'_'+y).src = 'images/spacer.gif';
            changed_cells[id] = 'Y'; 
            setSavedStatus('unsaved');
            showDetails(x, y);
        }
    }
    
}

function mapTrippleClick(x, y)
{
    var id = 'm_'+x+'_'+y;
    if (buffer_cell)
    {
        cells[id] = buffer_cell;
        changed_cells[id] = 'Y';
        setSavedStatus('unsaved');
    }
    showDetails(x, y);
}

function showDetails(x, y)
{
    var id = 'm_'+x+'_'+y;
    
    el('current_coord').innerHTML = id;
    el('details_div').style.display = 'block';
    el('map_links').innerHTML = '';
    
    if (cells[id]) {
        var arr = cells[id]['details'].split('|');
        
        setSelectValue('zone_code', cells[id]['zone']);
        //el('zone_code').value = cells[id]['zone'];
        el('cell_name').value = cells[id]['name'];
        el('cell_time').value = arr[0];
        
        el('cell_det_0').checked = arr[1] & 1;
        el('cell_det_1').checked = arr[1] & 2;
        el('cell_det_2').checked = arr[1] & 4;
        el('cell_det_3').checked = arr[1] & 8;
        el('cell_det_4').checked = arr[1] & 16;
        el('cell_det_5').checked = arr[1] & 32;
        el('cell_add').value = cells[id]['add'];
        el('cell_enter').innerHTML = cells[id]['enter'];
    } else {
        setSelectValue('zone_code', '');
        //el('zone_code').value = '';
        el('cell_name').value = '';
        el('cell_time').value = '';
        el('cell_det_0').checked = false;
        el('cell_det_1').checked = false;
        el('cell_det_2').checked = false;
        el('cell_det_3').checked = false;
        el('cell_det_4').checked = false;
        el('cell_det_5').checked = false;
        el('cell_enter').innerHTML = 'Пусто';
    }
    
    if (changed_cells[id])
        el('save_button').disabled = false;
    else
        el('save_button').disabled = true;
    
    current_cell = id;
    return true;
}

function cancelDetails()
{
    current_cell = '';
    el('details_div').style.display = 'none';
}

function applyDetails()
{
    if (current_cell == '')
        return false;
        
    var bin = 0;
    if (el('cell_det_0').checked) bin = bin + 1;
    if (el('cell_det_1').checked) bin = bin + 2;
    if (el('cell_det_2').checked) bin = bin + 4;
    if (el('cell_det_3').checked) bin = bin + 8;
    if (el('cell_det_4').checked) bin = bin + 16;
    if (el('cell_det_5').checked) bin = bin + 32;
    
    if (cells[current_cell]['enter'])
        enter = cells[current_cell]['enter'];
    else
        enter = '';
    
    cells[current_cell] = Array();
    cells[current_cell]['zone'] = getSelectValue(el('zone_code'));
    cells[current_cell]['name'] = el('cell_name').value;
    cells[current_cell]['details'] = el('cell_time').value + '|' + bin;
    cells[current_cell]['enter'] = enter;
    cells[current_cell]['add'] = el('cell_add').value;
    
    changed_cells[current_cell] = 'Y';
    setSavedStatus('unsaved');
    el('save_button').disabled = false;
    
}

function saveDetails()
{
    if (current_cell == '')
        return false;
        
    params = Array();
    params['action'] = 'save';
    params['zone_code'] = getSelectValue(el('zone_code'));
    params['cell_code'] = current_cell;
    params['cell_name'] = encodeURIComponent(el('cell_name').value);
    params['cell_add'] = el('cell_add').value;
    
    
    var bin = 0;
    if (el('cell_det_0').checked) bin = bin + 1;
    if (el('cell_det_1').checked) bin = bin + 2;
    if (el('cell_det_2').checked) bin = bin + 4;
    if (el('cell_det_3').checked) bin = bin + 8;
    if (el('cell_det_4').checked) bin = bin + 16;
    if (el('cell_det_5').checked) bin = bin + 32;
    
    params['cell_details'] = el('cell_time').value + '|' + bin;
    //alert(params['cell_details']);
    ajaxPost('world_map.php', params, function(data) {
        ar = data.split('@');
        changed_cells['m_'+ar[1]] = false;
        checkChangedCells();
        el('save_button').disabled = true;  
        if (ar[0] == 'deleted') {
            el('img_'+ar[1]).src = 'images/bg.png';
            cells['m_'+ar[1]] = null;
        } else if (ar[0] == 'updated') {
            //alert(ar[4]);
            el('img_'+ar[1]).src = 'images/spacer.gif';
            cells['m_'+ar[1]] = Array();
            cells['m_'+ar[1]]['zone'] = ar[2];
            cells['m_'+ar[1]]['name'] = urldecode(ar[3]);
            cells['m_'+ar[1]]['details'] = ar[4];
            cells['m_'+ar[1]]['add'] = ar[5];
            cells['m_'+ar[1]]['enter'] = '';
        } else
            alert(data);
    });
    
    return true;
}

function copyDetails()
{
    if (current_cell == '' || !cells[current_cell])
        return false;
        
    buffer_cell = cells[current_cell];
    setClibboardStatus(cells[current_cell]['name']);
    
    return true;
}

function saveChanged()
{
    params = Array();
    params['action'] = 'saveall';
    for (var cell in changed_cells)
    if (changed_cells[cell])
    {
        params[cell] = Array();
        params[cell]['zone_code'] = cells[cell]['zone'];
        params[cell]['cell_code'] = cell;
        params[cell]['cell_name'] = cells[cell]['name'];
        
        params[cell]['cell_details'] = cells[cell]['details'];
        params[cell]['cell_add'] = cells[cell]['add'];
        //alert(params['cell_details']);
    }
    ajaxPost('world_map.php', params, function(data) {
        if (data != 'success')
            alert(data);
        else
        {
            changed_cells = Array();
            setSavedStatus('saved');
        }
    });
    
    return true;
}

function checkChangedCells()
{
    var changed = false;
    for (var i in changed_cells)
    if (changed_cells[i]) changed = true;
    
    if (changed)
        setSavedStatus('unsaved');
    else
        setSavedStatus('saved');
    
}

function setClibboardStatus(status)
{
    if (status == 'empty')
    {
        el('clipboard_status').innerHTML = 'Буфер обмена пуст.';
        el('clipboard_status').className = 'status_none';
    }
    else
    {
        el('clipboard_status').innerHTML = 'Буфер обмена: '+cells[current_cell]['name'];
        el('clipboard_status').className = 'status_good';
    }
}

function setSavedStatus(status)
{
    if (status == 'saved')
    {
        el('save_all_status').className = 'status_ok';
        el('save_all_status').innerHTML = 'Все изменения сохранены.';
        el('save_all_button').disabled = true;
    }
    else
    {
        el('save_all_status').className = 'status_notice';
        el('save_all_status').innerHTML = 'Есть несохранённые данные.';
        el('save_all_button').disabled = false;
    }
}