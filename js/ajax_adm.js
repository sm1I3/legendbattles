var xmlhttp = false;
var arr_res;

function GetHttpRequest() {
    var xmlHttpObj = false;
    if (window.XMLHttpRequest) {
        // IE7+, Firefox, Chrome, Opera, Safari
        xmlHttpObj = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) {
        // IE6, IE5
        try {
            xmlHttpObj = new ActiveXObject('Microsoft.XMLHTTP');
        }
        catch (e) {
            try {
                xmlHttpObj = new ActiveXObject('Msxml2.XMLHTTP');
            }
            catch (e) {
            }
        }
    }
    return xmlHttpObj;
}

function AjaxGet(script) {
    if (!xmlhttp) {
        xmlhttp = GetHttpRequest();
        if (!xmlhttp) return;
    }
    xmlhttp.open('GET', '../../../includes/addons/admin-action/' + script, true);
    xmlhttp.onreadystatechange = AjaxProcessChange;
    xmlhttp.send(null);
}

function AjaxProcessChange() {
    if (xmlhttp.readyState == 4) {
        if (xmlhttp.status == 200) {
            var ret = xmlhttp.responseText;
            if (ret != 'ERR') {
                arr_res = ret.split('@');
                if (arr_res[0] != 'QUEST') StateReady();
                else QuestReady();
            }
        }
    }
}