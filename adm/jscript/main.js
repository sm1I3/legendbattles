var lastMDivID = '';
var timerID = 0;
var aformSelEl = Array();

function rID(elmid) {
    if (document.getElementById) {
        return document.getElementById(elmid);
    }
    if (document.layers && document.layers[elmid]) {
        return document.layers[elmid];
    }
    if (document.all && document.all(elmid)) {
        return document.all(elmid);
    }
    return false;
}

function HideMDiv() {
    if (lastMDivID != '') {
        var mdiv = rID(lastMDivID);
        if (mdiv != false) {
            mdiv.style.display = "none";
            rSelect();
        }
        lastMDivID = '';
    }
}

function ShowBDiv(mi_id) {
    var menuitem_div = rID(mi_id);
    if (menuitem_div != false) {
        hSelect(mi_id);
        menuitem_div.style.display = "block";
    }
}

function ShowMDiv(mi_id, md_id) {
    var menuitem_div = rID(mi_id);
    var menu_div = rID(md_id);
    if (md_id != lastMDivID || lastMDivID == '') {
        HideMDiv();
        if (menuitem_div != false && menu_div != false) {
            var divX = 0;
            var divY = 0;
            var parentel = menuitem_div;
            while ((parentel != null && parentel.tagName != "BODY")) {
                if (parentel.tagName == "html:body") break;
                divX += parentel.offsetLeft;
                divY += parentel.offsetTop;
                parentel = parentel.offsetParent;
            }
            menu_div.style.left = divX + "px";
            menu_div.style.top = divY + menuitem_div.offsetHeight + "px";
            menu_div.style.display = "block";
            lastMDivID = md_id;
            hSelect('', md_id);
        }
    }
    clearTimeout(timerID);
    timerID = setTimeout('HideMDiv()', 3000);
}

function get_xywh(el) {
    var x = 0;
    var y = 0;
    var w = 0;
    var h = 0;
    var pel = el;
    while ((pel != null && pel.tagName != "BODY")) {
        if (pel.tagName == "html:body") break;
        x += pel.offsetLeft;
        y += pel.offsetTop;
        pel = pel.offsetParent;
    }
    x = x - el.scrollLeft;
    y = y - el.scrollTop;
    w = el.offsetWidth;
    h = el.offsetHeight;
//	alert(' x='+x+' y='+y+' w='+w+' h='+h);
    return xywh = [x, y, w, h];
}

function hSelect(formnm, divel) {
    if (aformSelEl && aformSelEl.length <= 0) {
        var ai = 0;
        aformSelEl = Array();
        for (var fi = 0; fi < document.forms.length; fi++) {
            formname = document.forms[fi];
            if (formname.name != formnm) {
                for (var ei = 0; ei < formname.elements.length; ei++) {
                    elname = formname.elements[ei];
                    if (elname &&
                        (elname.type == "select-one" || elname.type == "select-multiple")
                    ) {
                        if (divel != '' && divel != null) {
                            area = get_xywh(rID(divel));
                            var ax = area[0];
                            var ay = area[1];
                            var aw = area[2];
                            var ah = area[3];
                            elmnt = get_xywh(elname);
                            var ex = elmnt[0];
                            var ey = elmnt[1];
                            var ew = elmnt[2];
                            var eh = elmnt[3];
                            if (
                                (ex > ax && ex < ax + aw && ey > ay && ey < ay + ah) ||
                                (ex + ew > ax && ex + ew < ax + aw && ey > ay && ey < ay + ah) ||
                                (ex > ax && ex < ax + aw && ey + eh > ay && ey + eh < ay + ah) ||
                                (ex + ew > ax && ex + ew < ax + aw && ey + eh > ay && ey + eh < ay + ah)
                            ) {
                                aformSelEl[ai] = "document." + formname.name + "." + elname.name + ".style.visibility = 'visible'";
                                elname.style.visibility = "hidden";
                                ai = ai + 1;
                            }
//							alert('el= ex='+ex+' ey='+ey+' ew='+ew+' eh='+eh+' \n\nar= ax='+ax+' ay='+ay+' aw='+aw+' ah='+ah);
                        }
                    }
                }
            }
        }
    }
}

function rSelect() {
    for (ai = 0; ai < aformSelEl.length; ai++) {
        eval(aformSelEl[ai]);
    }
    aformSelEl = Array();
}


function addLoadEvent(func) {
    var oldonload = window.onload;
    if (typeof window.onload != 'function') {
        window.onload = func;
    } else {
        window.onload = function () {
            oldonload();
            func();
        }
    }
}
