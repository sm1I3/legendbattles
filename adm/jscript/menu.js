function menuClick(sect) {
    var id = "div_" + sect;
    if (el(id).style.display == 'none') {
        el(id).style.display = 'block';
        delCookie('menu_' + sect);
    } else {
        el(id).style.display = 'none';
        setCookie('menu_' + sect, 'Y', 'Wed, 21 Dec 2012 00:00:00 UTC', '/');
    }
}