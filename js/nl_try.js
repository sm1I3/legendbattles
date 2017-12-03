resizer = function () {
    var auth = d.getElementById('auth');
    auth.style.marginTop = (get_doc_height() / 2) - (auth.clientHeight / 2) + 'px';
}

try_submit = function () {
    d.getElementById('ftry').submit();
}
