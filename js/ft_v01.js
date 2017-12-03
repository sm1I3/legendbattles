var r;
var s = screen;
var sfo = s.width + '*' + s.height;
var dep = s.colorDepth ? s.colorDepth : s.pixelDepth;
var d = document;

function ft_s(t) {
    switch (t) {
        case 2:
            return '<a href="http://top.mail.ru/jump?from=2330323" target="_blank"><img src="http://top.list.ru/counter?id=2330323;t=69;js=11;r=' + r + ';j=' + navigator.javaEnabled() + ';s=' + sfo + ';d=' + dep + ';rand=' + Math.random() + '" border="0" height="31" width="38" style="filter:alpha(opacity=50);"></a>';
        case 1:
            return '<a href="http://www.liveinternet.ru/click" target="_blank"><img src="http://counter.yadro.ru/hit?t44.2;r' + r + ((typeof(s) == 'undefined') ? '' : ';s' + sfo + '*' + dep) + ';u' + escape(d.URL) + ';' + Math.random() + '" border="0" width="31" height="31" style="filter:alpha(opacity=50);"></a>';
    }
}

function BottomLinks() {
    d.write('<div id="footer"><span class="left_counter">' + ft_s(2) + '</span><span class="right_counter">' + ft_s(1) + '</span><div>');
}

NewLinksView = function () {
    d.write('<table cellpadding="0" cellspacing="0" align="center" width="100%" border="0"><tr><td width="50%" align="left" style="position:relative;">' + PNGImage('forum/design/b1.gif', 'forum/design/b1.png', 158, 42) + '<div id="leftCounter">' + ft_s(1) + '</div></td><td width="50%" align="right" style="position:relative;">' + PNGImage('forum/design/b2.gif', 'forum/design/b2.png', 158, 42) + '<div id="rightCounter">' + ft_s(2) + '</div></td></tr></table>');
}