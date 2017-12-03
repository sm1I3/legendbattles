var d = document;
var offsetfromcursorY = 15;
var ie = d.all && !window.opera;
var ns6 = d.getElementById && !d.all;
var tipobj, op, v = 0;

function tooltip(el, txt) {
    tipobj = d.getElementById('tooltip');
    tipobj.innerHTML = txt;
    op = 1;
    tipobj.style.opacity = op;
    el.onmousemove = positiontip;
    appear();
}

function hide_info(el) {
    tipobj.style.visibility = 'hidden';
    el.onmousemove = '';
    v = 0;
}

function ietruebody() {
    return (d.compatMode && d.compatMode != 'BackCompat') ? d.documentElement : d.body;
}

function positiontip(e) {
    if (!v) {
        v = 1;
        tipobj.style.visibility = 'visible';
    }
    var curX = (ns6) ? e.pageX : event.clientX + ietruebody().scrollLeft;
    var curY = (ns6) ? e.pageY : event.clientY + ietruebody().scrollTop;
    var winwidth = ie ? ietruebody().clientWidth : window.innerWidth - 20;
    var winheight = ie ? ietruebody().clientHeight : window.innerHeight - 20;

    var rightedge = ie ? winwidth - event.clientX : winwidth - e.clientX;
    var bottomedge = ie ? winheight - event.clientY - offsetfromcursorY : winheight - e.clientY - offsetfromcursorY;

    if (rightedge < tipobj.offsetWidth) tipobj.style.left = curX - tipobj.offsetWidth + 'px';
    else tipobj.style.left = curX + 'px';

    if (bottomedge < tipobj.offsetHeight) tipobj.style.top = curY - tipobj.offsetHeight - offsetfromcursorY + 'px';
    else tipobj.style.top = curY + offsetfromcursorY + 'px';
}

function appear() {
    if (op < 1) {
        op += 0.1;
        tipobj.style.opacity = op;
        tipobj.style.filter = 'alpha(opacity=' + op * 100 + ')';
        t = setTimeout('appear()', 30);
    }
}

document.write('<div id="tooltip"></div>');