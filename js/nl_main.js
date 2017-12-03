var d = document;
var detect = false;
var dclose = false;

get_doc_height = function () {
    return Math.max(
        Math.max(d.body.scrollHeight, d.documentElement.scrollHeight),
        Math.max(d.body.offsetHeight, d.documentElement.offsetHeight),
        Math.max(d.body.clientHeight, d.documentElement.clientHeight)
    );
}

get_doc_width = function () {
    return Math.max(
        Math.max(d.body.scrollWidth, d.documentElement.scrollWidth),
        Math.max(d.body.offsetWidth, d.documentElement.offsetWidth),
        Math.max(d.body.clientWidth, d.documentElement.clientWidth)
    );
}

show_obj = function (obj_id, show_darker) {
    if (!detect) tb_detectMacXFF();

    if (show_darker) {
        var darker = d.getElementById('darker');
        darker.style.display = 'block';
    }

    dclose = false;

    var obj = d.getElementById(obj_id);

    obj.style.display = 'block';
    obj.style.top = (get_doc_height() / 2) - (obj.clientHeight / 2) + 'px';
    obj.style.left = (get_doc_width() / 2) - (obj.clientWidth / 2) + 'px';
}

close_obj = function (obj_id, close_darker) {
    if (close_darker || dclose) {
        var darker = d.getElementById('darker');
        darker.style.display = 'none';
    }

    dclose = false;

    var obj = d.getElementById(obj_id);
    obj.style.display = 'none';
}

tb_detectMacXFF = function () {
    detect = true;
    var userAgent = navigator.userAgent.toLowerCase();
    if (userAgent.indexOf('mac') != -1 && userAgent.indexOf('firefox') != -1) {
        d.getElementById('darker').className = 'TB_overlayMacFFBGHack';
    }
    else d.getElementById('darker').className = 'TB_overlayBG';
}