var cur_instr = -1;
var cur_instr_p1 = '';
var cur_instr_p2 = '';
var cur_instr_p3 = '';
var cur_mode = 0; //edit mode
var cur_highlited_x = -1;
var cur_highlited_y = -1;

var cur_object = -1;

var undo_x = -1;
var undo_y = -1;
var undo_val = 0;
var undo_param1 = '';
var undo_param2 = '';
var undo_param3 = '';
var undo_param4 = '';
var undo_param5 = '';

var prop_x = -1;
var prop_y = -1;

var mem_x = -1;
var mem_y = -1;

function drawLabyrinth(redraw_x, redraw_y)
{
    img_folder = 'images/labyrinth/';
    var val = -1;
    var j = 0;
    
    if (redraw_x==-1) {
        f_h = 0;
        t_h = lab_height-1;
    } else {
        f_h = (redraw_x>0?redraw_x-1:redraw_x);
        t_h = (redraw_x<(lab_height-1)?redraw_x+1:redraw_x);
    }
    
    if (redraw_y==-1) {
        f_w = 0;
        t_w = lab_width-1;
    } else {
        f_w = (redraw_y>0?redraw_y-1:redraw_y);
        t_w = (redraw_y<(lab_width-1)?redraw_y+1:redraw_y);
    }
    
    for (var i=f_h; i<=t_h; i++) {
        for (j=f_w; j<=t_w; j++) {
            
            val = el('val_'+i+'_'+j).value;
            if (val == '0')
                el('div_'+i+'_'+j).style.backgroundImage = 'url('+img_folder+'wall.jpg)';
            else 
            {
                
                var can_left = false;
                var can_right = false;
                var can_bottom = false;
                var can_top = false;
                
                if ( ((i-1) >= 0) && ( el('val_'+(i-1)+'_'+j).value > 0) )
                    can_top = true;
                if ( ((i+1) < lab_height) && ( el('val_'+(i+1)+'_'+j).value > 0) )
                    can_bottom = true;
                if ( ((j+1) < lab_width) && ( el('val_'+i+'_'+(j+1)).value > 0) )
                    can_right = true;
                if ( ((j-1) >= 0) && ( el('val_'+i+'_'+(j-1)).value > 0) )
                    can_left = true;
                //alert( (can_top?'t':'')+'_'+(can_right?'r':'')+'_'+(can_bottom?'b':'')+'_'+(can_left?'l':''));
                
                //draw object
                obj = el('object_'+i+'_'+j).value;
                if (obj != '') {
                    if (obj == '0' || obj == '1' || obj == '2' || obj == '3') {
                        el('img_'+i+'_'+j).src = img_folder+'map_'+(parseInt(obj)+1)+'.gif';
                    } 
                    
                } else {
                    el('img_'+i+'_'+j).src = img_folder+'spacer.gif';
                }
                
                // draw elements
                if (val == '1') {
                    fname = 'way_';
                    if (can_top) fname += 't';
                    if (can_right) fname += 'r';
                    if (can_bottom) fname += 'b';
                    if (can_left) fname += 'l';
                    if (fname == 'way_') fname += 'rl';
                    fname += '.jpg';
                    
                    el('div_'+i+'_'+j).style.backgroundImage = 'url('+img_folder+fname+')';
                } else if (val == '2') {
                    fname = 'grill_';
                    
                    if (can_top) fname += 't';
                    else if (can_left) fname += 'l';
                    
                    if (fname == 'grill_') fname += 'l';
                    fname += '.jpg';
                    
                    el('div_'+i+'_'+j).style.backgroundImage = 'url('+img_folder+fname+')';
                } else if (val == '3') {
                    fname = 'lever_';
                    
                    if (can_top) fname += 't';
                    else if (can_bottom) fname += 'b';
                    else if (can_left) fname += 'l';
                    else if (can_right) fname += 'r';
                    if (fname == 'lever_') fname += 't';
                    fname += '.jpg';
                    
                    el('div_'+i+'_'+j).style.backgroundImage = 'url('+img_folder+fname+')';
                } else if (val == '4') {
                    fname = 'door_';
                    
                    var ktype = el('param1_'+i+'_'+j).value;
                    if (ktype == 0)
                        fname += 'gold_';
                    else if (ktype == 2)
                        fname += 'silver_';
                    else if (ktype == 1)
                        fname += 'bronze_';
                    else if (ktype == 3)
                        fname += 'blue_';
                    
                    if (can_top) fname += 't';
                    else if (can_left) fname += 'l';
                    
                    if (fname == 'door_') fname += 'l';
                    fname += '.jpg';
                    
                    el('div_'+i+'_'+j).style.backgroundImage = 'url('+img_folder+fname+')';
                } else if (val == '5') {
                    fname = 'key_';
                    
                    var ktype = el('param1_'+i+'_'+j).value;
                    if (ktype == 0)
                        fname += 'gold_';
                    else if (ktype == 2)
                        fname += 'silver_';
                    else if (ktype == 1)
                        fname += 'bronze_';
                    else if (ktype == 3)
                        fname += 'blue_';
                    
                    if (can_top) fname += 't';
                    else if (can_bottom) fname += 'b';
                    else if (can_left) fname += 'l';
                    else if (can_right) fname += 'r';
                    if (fname == 'key_') fname += 't';
                    fname += '.jpg';
                    
                    el('div_'+i+'_'+j).style.backgroundImage = 'url('+img_folder+fname+')';
                } else if (val == '6') {
                    fname = 'guard_';
                    
                    if (can_top) fname += 't';
                    else if (can_bottom) fname += 'b';
                    else if (can_left) fname += 'l';
                    else if (can_right) fname += 'r';
                    if (fname == 'guard_') fname += 't';
                    fname += '.jpg';
                    
                    el('div_'+i+'_'+j).style.backgroundImage = 'url('+img_folder+fname+')';
                } else if (val == '7') {
                    fname = 'chest_';
                    
                    if (can_top) fname += 't';
                    else if (can_bottom) fname += 'b';
                    else if (can_left) fname += 'l';
                    else if (can_right) fname += 'r';
                    if (fname == 'chest_') fname += 't';
                    fname += '.jpg';
                    
                    el('div_'+i+'_'+j).style.backgroundImage = 'url('+img_folder+fname+')';
                } else if (val == '8') {
                    fname = 'portal_';
                    
                    if (can_top) fname += 't';
                    else if (can_bottom) fname += 'b';
                    else if (can_left) fname += 'l';
                    else if (can_right) fname += 'r';
                    if (fname == 'portal_') fname += 't';
                    fname += '.jpg';
                    
                    el('div_'+i+'_'+j).style.backgroundImage = 'url('+img_folder+fname+')';
                } else if (val == '9') {
                    fname = 'laz_';
                    
                    if (can_top) fname += 't';
                    else if (can_bottom) fname += 'b';
                    else if (can_left) fname += 'l';
                    else if (can_right) fname += 'r';
                    if (fname == 'laz_') fname += 't';
                    fname += '.jpg';
                    
                    el('div_'+i+'_'+j).style.backgroundImage = 'url('+img_folder+fname+')';
                } else if (val == '10') {
                    fname = 'water_';
                    
                    if (can_top) fname += 't';
                    else if (can_bottom) fname += 'b';
                    else if (can_left) fname += 'l';
                    else if (can_right) fname += 'r';
                    if (fname == 'water_') fname += 't';
                    fname += '.jpg';
                    
                    el('div_'+i+'_'+j).style.backgroundImage = 'url('+img_folder+fname+')';
                } else if (val == '11') {
                    fname = 'exit_';
                    
                    if (can_top) fname += 't';
                    else if (can_bottom) fname += 'b';
                    else if (can_left) fname += 'l';
                    else if (can_right) fname += 'r';
                    if (fname == 'exit_') fname += 't';
                    fname += '.jpg';
                    
                    el('div_'+i+'_'+j).style.backgroundImage = 'url('+img_folder+fname+')';
                }
            }
        }
    }
    setStartPoint(start_x, start_y, start_dir);
    
    return true;
}

function setInstrument(instr)
{
    unhighliteElm();
    
    
    if (cur_mode == -1) {
        el('img_obj_'+cur_object).style.border = '0px'; 
    } else {
        
        if (cur_instr != -1)
            el('img_instr_'+cur_instr).style.border = '0px';
        else
            el('img_instr_none').style.border = '0px';
    
    }
    
    cur_mode = 0; 
        
    cur_instr = instr;
    
    if (cur_instr != -1)
        el('img_instr_'+instr).style.border = '2px solid orange';
    else
        el('img_instr_none').style.border = '2px solid orange';
        
    if (instr == -1)
        el('labyrinth_table').style.cursor = 'pointer';
    else
        el('labyrinth_table').style.cursor = 'crosshair';
        
    cur_instr_p1 = '';
    cur_instr_p2 = '';
    cur_instr_p3 = '';
        
    return true;
}

function setInstrumentParams(p1, p2, p3)
{
    if (p1 == 'undefined')
        p1 = '';
    if (p2 == 'undefined')
        p2 = '';
    if (p3 == 'undefined')
        p3 = '';
        
    cur_instr_p1 = p1;
    cur_instr_p2 = p2;
    cur_instr_p3 = p3;
    
    return true;
}

function isRoad(x, y)
{
    var can_left = false;
    var can_right = false;
    var can_bottom = false;
    var can_top = false;
    
    if ( ((x-1) >= 0) && ( el('val_'+(x-1)+'_'+y).value > 0) )
        can_top = true;
    if ( ((x+1) < lab_height) && ( el('val_'+(x+1)+'_'+y).value > 0) )
        can_bottom = true;
    if ( ((y+1) < lab_width) && ( el('val_'+x+'_'+(y+1)).value > 0) )
        can_right = true;
    if ( ((y-1) >= 0) && ( el('val_'+x+'_'+(y-1)).value > 0) )
        can_left = true;
        
    if (can_top && can_bottom && !can_right && !can_left)
        return true;
        
    if (!can_top && !can_bottom && can_right && can_left)
        return true;
        
    return false;
    
}

function isCorner(x, y)
{
    var can_left = false;
    var can_right = false;
    var can_bottom = false;
    var can_top = false;
    
    if ( ((x-1) >= 0) && ( el('val_'+(x-1)+'_'+y).value > 0) )
        can_top = true;
    if ( ((x+1) < lab_height) && ( el('val_'+(x+1)+'_'+y).value > 0) )
        can_bottom = true;
    if ( ((y+1) < lab_width) && ( el('val_'+x+'_'+(y+1)).value > 0) )
        can_right = true;
    if ( ((y-1) >= 0) && ( el('val_'+x+'_'+(y-1)).value > 0) )
        can_left = true;
        
    if (can_top && !can_bottom && !can_right && !can_left)
        return true;
        
    if (!can_top && can_bottom && !can_right && !can_left)
        return true;
        
    if (!can_top && !can_bottom && can_right && !can_left)
        return true;
        
    if (!can_top && !can_bottom && !can_right && can_left)
        return true;
        
    return false;
}

function clearParams(x, y)
{
    el('param1_'+x+'_'+y).value = '';
    el('param2_'+x+'_'+y).value = '';
    el('param3_'+x+'_'+y).value = '';
    el('param4_'+x+'_'+y).value = '';
    el('param5_'+x+'_'+y).value = '';
    return true;
}

function getElm(x, y) { return el('val_'+x+'_'+y) }
function getElmType(x, y) { return el('val_'+x+'_'+y).value }
function getElmParam(x, y, n) { return el('param'+n+'_'+x+'_'+y).value }

function highliteElm(x, y, dir) {
    cur_highlited_x = x;
    cur_highlited_y = y;
    el('div_'+x+'_'+y).style.border = '2px solid yellow';
    el('div_'+x+'_'+y).style.width = '34px';
    el('div_'+x+'_'+y).style.height = '34px';
    
    if (dir != 'undefined' && dir != '') {
        if (dir == 0)
            el('div_'+x+'_'+y).style.borderTop = '2px solid orange';
        else if (dir == 3)
            el('div_'+x+'_'+y).style.borderBottom = '2px solid orange';
        else if (dir == 2)
            el('div_'+x+'_'+y).style.borderRight = '2px solid orange';
        else if (dir == 1)
            el('div_'+x+'_'+y).style.borderLeft = '2px solid orange';
        
    }
}

function unhighliteElm() {
    if (cur_highlited_x > -1 && cur_highlited_y > -1) {
        el('div_'+cur_highlited_x+'_'+cur_highlited_y).style.border = '0px';
        el('div_'+cur_highlited_x+'_'+cur_highlited_y).style.width = '38px';
        el('div_'+cur_highlited_x+'_'+cur_highlited_y).style.height = '38px'; 
        cur_highlited_x = -1;
        cur_highlited_y = -1;
    }
}

function selectElm(x, y) {
    
    unhighliteElm();
    propCancel();
    var etype = getElmType(x, y);
    if (etype == 3) {
        var ty = getElmParam(x, y, 1);
        var tx = getElmParam(x, y, 2);
        if (tx=='' || ty == '')
            return false;
        highliteElm(tx, ty, '');
    }
    else if (etype == 7) {
        propEdit(x, y, 'Type', 'Value', '', '', '');
    }
    else if (etype == 8) {
        var ty = getElmParam(x, y, 1);
        var tx = getElmParam(x, y, 2);
        var dir = getElmParam(x, y, 3);
        if (tx=='' || ty == '')
            return false;
        highliteElm(tx, ty, dir);
    }
    return true;
}

function labRightClick(x, y, evt) {
    
    evt = evt || window.event;
    evt.cancelBubble = true; 
    
    if (cur_mode != -1) {
        
        var t_instr = cur_instr;
        setInstrument(0);
        labClick(x, y);
        setInstrument(t_instr);
        
    } else {
        
        removeObject(x, y);
        
    }
    
    return true;
}

function insertObject(x, y)
{
    if (cur_object == -1)
        return removeObject(x, y);
    el('object_'+x+'_'+y).value = cur_object;
    drawLabyrinth(x, y);
    return true;
}

function removeObject(x, y)
{
    el('object_'+x+'_'+y).value = '';
    drawLabyrinth(x, y);
    return true;
}

function labClick(x, y) {
    /*
    if (evt.ctrlKey)
        return labRightClick(x, y, evt);
    */
    if (cur_mode == -1)
        return insertObject(x, y);
    
    if (cur_instr == -1)
        return selectElm(x, y);
        
    // for start point
    if (cur_instr == 100 && cur_mode == 100) {
        if (el('val_'+x+'_'+y).value == '1') {
            
            var dir = -1;
            if (x < mem_x && y == mem_y)
                dir = 0;
            else if (x > mem_x && y == mem_y)
                dir = 3;
            else if (x == mem_x && y > mem_y)
                dir = 2;
            else if (x == mem_x && y < mem_y)
                dir = 1;
                
            if (dir == -1)
                alert('Пожалуйста выберете правильное место для точки старта.');
            else {
                cur_mode = 0;
                setStartPoint(mem_x, mem_y, dir);
                setInstrument(-1);
                setMessage('');
                return true;
            }
        } else
            alert('');
            
        return false;
    }
    
    
    if (cur_instr == 100) {
        if (el('val_'+x+'_'+y).value == '1') {
            mem_x = x;
            mem_y = y;
            cur_mode = 100;
            setMessage('Пожалуйста установите направление старта. <a onclick="cancelClick(); return false;" href="#">Отмена</a>');
        } else
            alert('Пожалуйста выберете правильное место для точки старта.');
            
        return false;
    }
    
    
    // for lever
    if (cur_mode == 3) {
        if (el('val_'+x+'_'+y).value == '2') {
            // param 1 - y, param 2 - x 
            el('param1_'+mem_x+'_'+mem_y).value = y;
            el('param2_'+mem_x+'_'+mem_y).value = x;
            cur_mode = 0;
            setMessage('');
        } else
            alert('Выбранный объект не является решеткой.');
            
        return true;    
    }
    
    // for portal
    if (cur_mode == 8) {
        if (el('val_'+x+'_'+y).value > 0) {
            // param 1 - y, param 2 - x
            el('param1_'+mem_x+'_'+mem_y).value = y;
            el('param2_'+mem_x+'_'+mem_y).value = x;
            cur_mode = 81;
            setMessage('Пожалуйста установите направление телепортации. <a onclick="cancelClick(); return false;" href="#">Отмена</a>');
        } else
            alert('Выберете место для телепортации.');
            
        return true;    
    }
    
    // for portal direction
    if (cur_mode == 81) {
        if (el('val_'+x+'_'+y).value > 0) {
            var y1 = el('param1_'+mem_x+'_'+mem_y).value;
            var x1 = el('param2_'+mem_x+'_'+mem_y).value;
            
            var dir = -1;
            if (x < x1 && y == y1)
                dir = 0;
            else if (x > x1 && y == y1)
                dir = 3;
            else if (x == x1 && y > y1)
                dir = 2;
            else if (x == x1 && y < y1)
                dir = 1;
                
            if (dir == -1)
                alert('Пожалуйста выберете правильное место для телепортации.');
            else {
                el('param3_'+mem_x+'_'+mem_y).value = dir;
                setMessage('');
                cur_mode = 0;
            }
        } else
            alert('Пожалуйста выберете правильное направление для телепортации.');
            
        return true;    
    }
    
    undo_x = x; undo_y = y;
    undo_val = el('val_'+x+'_'+y).value;
    undo_param1 = el('param1_'+x+'_'+y).value;
    undo_param2 = el('param2_'+x+'_'+y).value;
    undo_param3 = el('param3_'+x+'_'+y).value;
    undo_param4 = el('param4_'+x+'_'+y).value;
    undo_param5 = el('param5_'+x+'_'+y).value;
        
    if (cur_instr == 0) {
        el('val_'+x+'_'+y).value = '0';
        clearParams(x, y);
    } else if (cur_instr == 1) {
        el('val_'+x+'_'+y).value = '1';
    } else if (cur_instr == 2) {
        if (isRoad(x, y))
            el('val_'+x+'_'+y).value = '2';
        else
            alert('Невозможно установить решетку в выбранном месте.');
    } else if (cur_instr == 3) {
        if (isCorner(x, y)) {
            el('val_'+x+'_'+y).value = '3';
            mem_x = x; mem_y = y;
            setMessage('Выберете решетку, которую открывает этот рычаг. <a onclick="cancelClick(); return false;" href="#">Отмена</a>');
            cur_mode = 3;
        } else
            alert('Unable to set the lever here.');
    } else if (cur_instr == 41) {
        if (isRoad(x, y)) {
            el('val_'+x+'_'+y).value = '4';
            el('param1_'+x+'_'+y).value = '0';
        } else
            alert('Невозможно установить дверь в выбранном месте.');
    } else if (cur_instr == 42) {
        if (isRoad(x, y)) {
            el('val_'+x+'_'+y).value = '4';
            el('param1_'+x+'_'+y).value = '2';
        } else
            alert('Невозможно установить дверь в выбранном месте.');
    } else if (cur_instr == 43) {
        if (isRoad(x, y)) {
            el('val_'+x+'_'+y).value = '4';
            el('param1_'+x+'_'+y).value = '1';
        } else
            alert('Невозможно установить дверь в выбранном месте.');
    } else if (cur_instr == 44) {
        if (isRoad(x, y)) {
            el('val_'+x+'_'+y).value = '4';
            el('param1_'+x+'_'+y).value = '3';
        } else
            alert('Невозможно установить дверь в выбранном месте.');
    } else if (cur_instr == 51) {
        if (isCorner(x, y)) {
            el('val_'+x+'_'+y).value = '5';
            el('param1_'+x+'_'+y).value = '0';
        } else
            alert('Невозможно установить золотой ключ в выбранном месте.');
    } else if (cur_instr == 52) {
        if (isCorner(x, y)) {
            el('val_'+x+'_'+y).value = '5';
            el('param1_'+x+'_'+y).value = '2';
        } else
            alert('Невозможно установить серебряный ключ в выбранном месте.');
    } else if (cur_instr == 53) {
        if (isCorner(x, y)) {
            el('val_'+x+'_'+y).value = '5';
            el('param1_'+x+'_'+y).value = '1';
        } else
            alert('Невозможно установить бронзовый ключ в выбранном месте.');
    } else if (cur_instr == 54) {
        if (isCorner(x, y)) {
            el('val_'+x+'_'+y).value = '5';
            el('param1_'+x+'_'+y).value = '3';
        } else
            alert('Невозможно установить ключ стража в выбранном месте.');
            
    } else if (cur_instr == 6) {
        if (isCorner(x, y))
            el('val_'+x+'_'+y).value = '6';
        else
            alert('Невозможно установить стража в выбранном месте.');
    } else if (cur_instr == 7) {
        if (isCorner(x, y)) {
            el('val_'+x+'_'+y).value = '7';
            propEdit(x, y, 'Type', 'Value', '', '', '');
        } else
            alert('Невозможно установить сундук в выбранном месте.');
    } else if (cur_instr == 8) {
        if (isCorner(x, y)) {
            el('val_'+x+'_'+y).value = '8';
            mem_x = x; mem_y = y;
            setMessage('Пожалуйста выберете точку телепортации. <a onclick="cancelClick(); return false;" href="#">Отмена</a>');
            cur_mode = 8;
        } else
            alert('Невозможно установить портал в выбранном месте.');
    } else if (cur_instr == 9) {
        if (isCorner(x, y))
            el('val_'+x+'_'+y).value = '9';
        else
            alert('Невозможно установить лаз в выбранном месте.');
    } else if (cur_instr == 10) {
        if (isCorner(x, y))
            el('val_'+x+'_'+y).value = '10';
        else
            alert('Невозможно установить источник в выбранном месте.');
    } else if (cur_instr == 11) {
        if (isCorner(x, y))
            el('val_'+x+'_'+y).value = '11';
        else
            alert('Невозможно установить выход в выбранном месте.');
    }
    
    drawLabyrinth(x, y);
    
}

function setStartPoint(x, y, dir)
{
    
    if (x != start_x || y != start_y || dir != start_dir) {
        
        if (start_x != -1 && start_y != -1)
        el('img_'+start_x+'_'+start_y).src =  img_folder+'spacer.gif';
        
        start_x = x;
        start_y = y;
        start_dir = dir;
        
        // start x = y, start y = x
        // for saving purposes
        el('start_x').value = start_y;
        el('start_y').value = start_x;
        el('start_dir').value = start_dir;
        el('start_point_coords').innerHTML = start_y+';'+start_x+';'+start_dir;
    }
    
    
    
    if (dir == 0)
        el('img_'+x+'_'+y).src =  img_folder+'arrow_t.gif';
    else if (dir == 2)
        el('img_'+x+'_'+y).src =  img_folder+'arrow_r.gif';
    else if (dir == 3)
        el('img_'+x+'_'+y).src =  img_folder+'arrow_b.gif';
    else if (dir == 1)
        el('img_'+x+'_'+y).src =  img_folder+'arrow_l.gif';
        
    return false;
}


function setMessage(msg)
{
    el('labyrinth_message').innerHTML = msg;
    return true;
}

function cancelClick()
{
    
    if (undo_x == -1 || undo_y == -1)
        return false;
        
    el('val_'+undo_x+'_'+undo_y).value = undo_val;
    el('param1_'+undo_x+'_'+undo_y).value = undo_param1;
    el('param2_'+undo_x+'_'+undo_y).value = undo_param2;
    el('param3_'+undo_x+'_'+undo_y).value = undo_param3;
    el('param4_'+undo_x+'_'+undo_y).value = undo_param4;
    el('param5_'+undo_x+'_'+undo_y).value = undo_param5;
    
    cur_mode = 0;
    setMessage('');
    drawLabyrinth(undo_x, undo_y);
    
    return true;
}

function propEdit(x, y, name1, name2, name3, name4, name5)
{
    prop_x = x;
    prop_y = y;
    el('lab_properties').style.display = 'block';
    
    var elmParmas = el('param5_'+x+'_'+y).value;
    
    
    el('lab_properties_content').innerHTML = el('chest_properties').innerHTML;
    
    //alert(elmParmas);
    if (elmParmas != '') {
    
        /*
        var obj = !(/[^,:{}\[\]0-9.\-+Eaeflnr-u \n\r\t]/.test(
            elmParmas.replace(/"(\\.|[^"\\])*"/g, ''))) &&
            eval('(' + elmParmas + ')');
        */
        obj = new Object();
        tarr = elmParmas.split('|');
        for(i=0; i<tarr.length; i++) {
            
            if (tarr[i].length > 0) {
                //alert(tarr[i]);
                x = tarr[i];
                t = x.split(':');
                
                obj[t[0]] = t[1];
            
            }
        }
            
        var div = el('lab_properties_content');
        var pElements = div.getElementsByTagName("input");
        for (i=0; i<pElements.length; i++) {
            //alert(obj[name]);
            elm = pElements[i];
            name = elm.name;
            if (elm.type == 'checkbox')
                elm.checked = (obj[name] == "1");
            else if (obj[name])
                elm.value = decodeURIComponent(obj[name]);
            
        }
        
        var pElements = div.getElementsByTagName("select");
        for (i=0; i<pElements.length; i++) {
        
            elm = pElements[i];
            name = elm.name;
            
            for(j=0; j<elm.options.length; j++)
                if (obj[name] && elm.options[j].value == obj[name])
                    elm.selectedIndex = j;
            
        }
        
        
    }
    
    return true;
}

function propSave()
{
    //el('param5_'+prop_x+'_'+prop_y).value = el('prop5_value').value;
    
    var div = el('lab_properties_content');
    
    var obj = new Object();
    var pElements = div.getElementsByTagName("input");
    for (i=0; i<pElements.length; i++) {
        elm = pElements[i];
        name = elm.name;
        if (elm.type == 'checkbox')
            obj[name] = (elm.checked?"1":"0");
        else
            obj[name] = encodeURIComponent(elm.value);
    }
    
    var pElements = div.getElementsByTagName("select");
    for (i=0; i<pElements.length; i++) {
        elm = pElements[i];
        name = elm.name;
        
        obj[name] = encodeURIComponent(elm.options[elm.selectedIndex].value);
    }
    /*
    var text = JSON.stringify(obj, function(key, value) {
        if (typeof value === 'number' && !isFinite(value)) {
            return String(value);
        }
        return value;
    });
    */
    var text = '';
    for(var key in obj) {
        text += key + ':' + obj[key] + '|';
        // key - название свойства
        // object[key] - значение свойства
    }
    //alert(text);
    el('param5_'+prop_x+'_'+prop_y).value = text;
    
    
    /*
    for(var key in object) {
        // key - название свойства
        // object[key] - значение свойства
        ...
    }
    */
    
    el('lab_properties').style.display = 'none';
    
    return true;
}

function propCancel()
{
    el('lab_properties').style.display = 'none';
    return true;
}

function setObjectInsert(obj) {
    
    if (cur_mode == -1) {
        el('img_obj_'+cur_object).style.border = '0px'; 
    } else {
        
        if (cur_instr != -1)
            el('img_instr_'+cur_instr).style.border = '0px';
        else
            el('img_instr_none').style.border = '0px';
    
    }
    
    cur_object = obj;
    
    el('img_obj_'+cur_object).style.border = '2px solid orange';
    el('labyrinth_table').style.cursor = 'crosshair';
    
    cur_mode = -1; //object mode
    
    return true;
}