var mode = -1; 
var current_x = -1;
var current_y = -1;

var edit_mode = 0;

var height = 9;
var width = 13;

function moveMap(dir)
{
    div = el('world_map');
    tbody = div.lastChild.lastChild;
    switch (dir) 
    {
        case 'down':
            current_y++;
            
            tr = tbody.firstChild;
            tbody.removeChild(tr);
            tr = d.createElement('TR');
            for (i=-width; i<=width; i++) {
                td = d.createElement('TD');
                
                img_src = '/img/image/wmap/map/day/'+(current_y+height)+'/'+(current_x+i)+'_'+(current_y+height)+'.gif';
                td.style.backgroundImage = 'url('+img_src+')';
                td.style.borderRight = '1px solid black';
                td.style.borderBottom = '1px solid black';
                img = d.createElement('IMG');
                img.src = 'images/spacer.gif';
                img.width = 100;
                img.height = 100;
                img.id = 'img_'+(current_x+i)+'_'+(current_y+height);
                
                dx = current_x+i;
                dy = current_y+height;
                img.onclick = function(dx, dy) { return function() { if (mode == -1) unselectZones(); mapClick(dx, dy); } }(dx, dy);
            
                td.appendChild(img);
                tr.appendChild(td);
            }
            tbody.appendChild(tr);
        break
        case 'up':
            current_y--;
            
            tr = tbody.lastChild;
            tbody.removeChild(tr);
            tr = d.createElement('TR');
            for (i=-width; i<=width; i++) {
                td = d.createElement('TD');
                
                img_src = '/img/image/wmap/map/day/'+(current_y-height)+'/'+(current_x+i)+'_'+(current_y-height)+'.gif';
                td.style.backgroundImage = 'url('+img_src+')';
                td.style.borderRight = '1px solid black';
                td.style.borderBottom = '1px solid black';
                img = d.createElement('IMG');
                img.src = 'images/spacer.gif';
                img.width = 100;
                img.height = 100;
                img.id = 'img_'+(current_x+i)+'_'+(current_y-height);
                
                dx = current_x+i;
                dy = current_y-height;
                img.onclick = function(dx, dy) { return function() { if (mode == -1) unselectZones(); mapClick(dx, dy); } }(dx, dy);
                
                td.appendChild(img);
                tr.appendChild(td);
            }
            tbody.insertBefore(tr, tbody.firstChild);
        break
        case 'right':
            current_x++;
            
            for (i=0; i<=(height*2); i++) {
                tr = tbody.childNodes[i];
                
                tr.removeChild(tr.firstChild);
                
                img_src = '/img/image/wmap/map/day/'+(current_y-height+i)+'/'+(current_x+width)+'_'+(current_y-height+i)+'.gif';
                td = d.createElement('TD');
                td.style.backgroundImage = 'url('+img_src+')';
                td.style.borderRight = '1px solid black';
                td.style.borderBottom = '1px solid black';
                img = d.createElement('IMG');
                img.src = 'images/spacer.gif';
                img.width = 100;
                img.height = 100;
                img.id = 'img_'+(current_x+width)+'_'+(current_y-height+i);
                
                dx = current_x+width;
                dy = current_y-height+i;
                img.onclick = function(dx, dy) { return function() { if (mode == -1) unselectZones(); mapClick(dx, dy); } }(dx, dy);
                
                td.appendChild(img);
                tr.appendChild(td);
            }
            
        break
        case 'left':
            current_x--;
            
            for (i=0; i<=(height*2); i++) {
                tr = tbody.childNodes[i];
                
                tr.removeChild(tr.lastChild);
                
                img_src = '/img/image/wmap/map/day/'+(current_y-height+i)+'/'+(current_x-width)+'_'+(current_y-height+i)+'.gif';
                td = d.createElement('TD');
                td.style.backgroundImage = 'url('+img_src+')';
                td.style.borderRight = '1px solid black';
                td.style.borderBottom = '1px solid black';
                img = d.createElement('IMG');
                img.src = 'images/spacer.gif';
                img.width = 100;
                img.height = 100;
                img.id = 'img_'+(current_x-width)+'_'+(current_y-height+i);
                
                dx = current_x-width;
                dy = current_y-height+i;
                img.onclick = function(dx, dy) { return function() { if (mode == -1) unselectZones(); mapClick(dx, dy); } }(dx, dy);
                
                td.appendChild(img);
                tr.insertBefore(td, tr.firstChild);
            }
        break
    }
    removeAllZones();
    edit_mode = 0;
    return true;
}

function showMap(x, y)
{
    //div = d.createElement('DIV');
    div = el('world_map');
    table = d.createElement('TABLE');
    div.appendChild(table);
    tbody = d.createElement('TBODY');
    table.appendChild(tbody);
    table.border = 0;
    table.cellPadding = 0;
    table.cellSpacing = 0;
    table.style.borderLeft = '1px solid black';
    table.style.borderTop = '1px solid black';
    
    for (i=-height; i<=height; i++) {
        
        tr = d.createElement('TR');
        for (j=-width; j<=width; j++) {
            td = d.createElement('TD');
            td.style.backgroundImage = 'url(/img/image/wmap/map/day/'+(y+i)+'/'+(x+j)+'_'+(y+i)+'.gif)';
            td.style.borderRight = '1px solid black';
            td.style.borderBottom = '1px solid black';
            
            //div = d.createElement('DIV');
            //div.style.background
            
            img = d.createElement('IMG');
            img.src = '/img/image/wmap/map/day/'+(y+i)+'/'+(x+j)+'_'+(y+i)+'.gif';
            //img.src = 'images/spacer.gif';
            img.width = 100;
            img.height = 100;
            img.id = 'img_'+(x+j)+'_'+(y+i);
            
            dx = x+j;
            dy = y+i;
            img.onclick = function(dx, dy) { return function() { if (mode == -1) unselectZones(); mapClick(dx, dy); } }(dx, dy);
            
            td.appendChild(img);
            tr.appendChild(td);
        }
        tbody.appendChild(tr);
    
    }
    
    current_x = x;
    current_y = y;
    
    return true;
}