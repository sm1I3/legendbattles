var ModalWindow = function (windowId) {
    this.windowId = windowId;
    this.title = "";
    this.parent = "body";
    this.hide_fields = "";
    this.content = "";
    this.width = null;
    this.height = null;
}

ModalWindow.prototype.getIEVersion = function () {
    var rv = -1; // Return value assumes failure.
    if (navigator.appName == 'Microsoft Internet Explorer') {
        var ua = navigator.userAgent;
        var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
        if (re.exec(ua) != null)
            rv = parseFloat(RegExp.$1);
    }

    return rv;
}

ModalWindow.prototype.close = function (window_id) {
    mw = el('modal-window-' + window_id);
    mw.parentNode.removeChild(mw);
    mo = el('modal-window-' + window_id + '_overlay');
    mo.parentNode.removeChild(mo);
};

ModalWindow.prototype.open = function () {
    /*
    if (ModalWindow.prototype.getIEVersion()==6) {
        $('select').each(function() {if (this.style.display!='none' && this.style.visibility!='hidden') this.setAttribute('modal_hidden', 'true') });
        $('select').hide();
    }
    */
    var modal = "";
    modal += "<div id=\"modal-window-" + this.windowId + "_overlay\" class=\"modal-overlay\"></div>";
    modal += "<div id=\"modal-window-" + this.windowId + "\" class=\"modal-window\" style=\"width:" + this.width + "px; height:" + this.height + "px; margin-top:-" + (this.height / 2) + "px; margin-left:-" + (this.width / 2) + "px;\">";
    modal += "<table width=\"" + this.width + "\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border:1px solid #8ebcdb\"><tr><td>";
    //modal += "<div class=\"popup\" style=\"width: " + this.width + "px;\">";
    modal += "<div class=\"popup\" style=\"width: " + this.width + "px;\">";
    modal += "<table class=\"popup_header\" width=\"" + this.width + "\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr>";
    modal += "<td width=\"99%\"><strong class=\"title\">" + this.title + "</strong></td>";
    modal += "<td align=\"right\"><a href=\"#\" title=\"CLOSE\" class=\"close-window\" id=\"close-window-" + this.windowId + "\" ></a></td>";
    modal += "</tr></table>";
    //modal += "<a href=\"#\" class=\"close-window\" title=\"CLOSE\"><img src=\"/admin/images/survey/tabs/close.gif\" width=\"17\" height=\"20\" border=\"0\" align=\"right\" /></a><br /><br />";  
    modal += "<div id=\"modal-window-" + this.windowId + "_content\">";
    modal += this.content;
    modal += "</div></div></td></tr></table></div>";
    /*
    if (ModalWindow.prototype.getIEVersion()==6 && this.hide_fields != "")
    {
        $('#'+this.hide_fields+' select').hide();
    }
     */


    //$(this.parent).append(modal);
    var dc = document.createElement('DIV');
    dc.id = 'div-container-' + this.windowId;
    document.body.appendChild(dc)
    dc.innerHTML = modal;

    var scrollTop = self.pageYOffset || (document.documentElement && document.documentElement.scrollTop) || (document.body && document.body.scrollTop);
    var scrollLeft = self.pageXOffset || (document.documentElement && document.documentElement.scrollLeft) || (document.body && document.body.scrollLeft);

    var height = (document.body.scrollHeight > document.body.offsetHeight) ? document.body.scrollHeight : document.body.offsetHeight;
    var width = (document.body.scrollWidth > document.body.offsetWidth) ? document.body.scrollWidth : document.body.offsetWidth;

    var centerWidth = parseInt(width / 2) + scrollLeft;
    var centerHeight = parseInt(height / 2) + scrollTop;

    el('modal-window-' + this.windowId + '_overlay').style.height = height + 'px';
    el('modal-window-' + this.windowId).style.top = (scrollTop + 300) + 'px';
    var wid = this.windowId;
    el('close-window-' + this.windowId).onclick = function () {
        ModalWindow.prototype.close(wid);
        return false;
    };

}

ModalWindow.prototype.updateContent = function (content) {
    el("modal-window-" + this.windowId + "_content").innerHTML(content);
}

ModalWindow.prototype.getContentElement = function () {
    return document.getElementById("modal-window-" + this.windowId + "_content");
}