// default mode
var mem_x = -1;
var mem_y = -1;
var last_id = 0;

var zones = Array();
var loaded_zones = Array();
var colors = Array();

function mapClick(x, y) {
    if (mode == 0) {
        mem_x = x;
        mem_y = y;
        mode = 1;
    } else if (mode == 1) {
        zone_id = addZone(mem_x, mem_y, x, y);
        el('world_map').style.cursor = 'default';
        mode = -1;
        mem_x = -1;
        mem_y = -1;
        selectZone(zone_id);
    }
    return true;
}

function addZone(x1, y1, x2, y2, zone_id) {

    var zone = x1 + ',' + y1 + ';' + x2 + ',' + y2;

    if (x1 > x2) {
        t = x1;
        x1 = x2;
        x2 = t;
    }

    if (y1 > y2) {
        t = y1;
        y1 = y2;
        y2 = t;
    }

    if (typeof zone_id == 'undefined')
        zone_id = --last_id;

    var zone = x1 + ',' + y1 + ';' + x2 + ',' + y2;

    zones[zone_id] = zone;
    colors[zone_id] = (Math.round(0xFFFFFF * Math.random()).toString(16) + "000000").replace(/([a-f0-9]{6}).+/, "#$1").toUpperCase();

    var table = el('table_zones');
    var tr = d.createElement('TR');

    var new_id = 'tr_zone_' + zone_id;
    var lid = zone_id;
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
        removeZone(lid);
        return false;
    };
    del_a.appendChild(del_img);

    td1.align = 'center';
    td1.className = 'cms_middle';
    td1.appendChild(del_a);

    td2.className = 'cms_middle';
    ed1 = d.createElement('INPUT');
    ed1.type = 'text';
    ed1.readOnly = true;
    ed1.size = 18;
    ed1.name = 'zone[' + new_id + ']';
    ed1.value = zone;
    ed1.id = 'zone_' + new_id;
    ed1.onclick = function () {
        selectZone(lid);
        return false;
    }
    td2.appendChild(ed1);

    drawZones();

    return zone_id
}

function drawZones() {

    for (var c in zones)
        if (el('zone_' + c))
            document.body.removeChild(el('zone_' + c));

    for (var c in zones)
        if (zones[c] != '') {
            zone = zones[c];

            tar = zone.split(';');
            tar1 = tar[0].split(',');
            tar2 = tar[1].split(',');

            x1 = parseInt(tar1[0]);
            y1 = parseInt(tar1[1]);
            x2 = parseInt(tar2[0]);
            y2 = parseInt(tar2[1]);

            pos = absPosition(el('world_map'));

            div = d.createElement('DIV');
            div.id = 'zone_' + c;

            div.style.border = '2px solid ' + colors[c];

            div.style.display = 'block';
            div.style.position = 'absolute';
            div.style.left = (pos.x + (x1 - current_x + width) * 51 - 2) + 'px';
            div.style.top = (pos.y + (y1 - current_y + height) * 51 - 2) + 'px';

            div.style.width = ((x2 - x1 + 1) * 51) + 'px';
            div.style.height = ((y2 - y1 + 1) * 51) + 'px';

            div.appendChild(createClickZone(x1, y1, x2, y2));
            div.onclick = function (zone_id) {
                return function () {
                    if (mode == -1) selectZone(zone_id);
                }
            }(c);
            document.body.appendChild(div);

        }
}

function selectZone(i) {
    drawZones();

    zone = el('zone_' + i);
    if (zone) {
        zone.style.border = '2px dashed ' + colors[i];
    }

    showZoneParams(i);
}

function unselectZones() {
    drawZones();
    cancelZoneParams();

    return true;
}

function removeZone(i) {
    zones[i] = '';

    zone = el('zone_' + i);
    document.body.removeChild(zone);
    drawZones();

    return true;
}

function removeAllZones() {
    for (var c in zones)
        if (zones[c] != '') {
            document.body.removeChild(el('zone_' + c));
            removeItem('tr_zone_' + c);
            zones[c] = '';
        }
    loaded_zones = Array();
    cancelZoneParams();
    drawZones();
}

function createClickZone(x1, y1, x2, y2) {
    table = d.createElement('TABLE');
    tbody = d.createElement('TBODY');
    table.appendChild(tbody);
    table.border = 0;
    table.cellPadding = 0;
    table.cellSpacing = 0;

    for (i = y1; i <= y2; i++) {

        tr = d.createElement('TR');
        for (j = x1; j <= x2; j++) {
            td = d.createElement('TD');
            td.background = 'images/spacer.gif';
            //td.style.borderRight = '1px solid black';
            //td.style.borderBottom = '1px solid black';
            img = d.createElement('IMG');
            img.src = 'images/spacer.gif';
            img.width = 50;
            img.height = 50;

            dx = j;
            dy = i;
            img.onclick = function (dx, dy) {
                return function () {
                    mapClick(dx, dy);
                }
            }(dx, dy);

            td.appendChild(img);
            tr.appendChild(td);
        }
        tbody.appendChild(tr);

    }

    return table;
}