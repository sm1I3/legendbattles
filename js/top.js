var r;
var s = screen;
var sfo = s.width + '*' + s.height;
var dep = s.colorDepth ? s.colorDepth : s.pixelDepth;

function top(referr) {
    /*  if(referr == 'null') r = escape(d.referrer);
      else r = escape("http://antinl.maynstrim.ru/")+referr+'.html';
      return '<a href="http://top.mail.ru/jump?from=2330323" target="_blank"><img src="http://top.list.ru/counter?id=2330323;t=59;js=11;r='+r+';j='+navigator.javaEnabled()+';s='+sfo+';d='+dep+';rand='+Math.random()+'" border="0" height="31" width="88"></a> <a href="http://www.liveinternet.ru/click" target="_blank"><img src="http://counter.yadro.ru/hit?t44.2;r'+r+((typeof(s) == 'undefined') ? '' : ';s'+sfo+'*'+dep)+';u'+escape(d.URL)+';'+Math.random()+'" border="0" width="31" height="31"></a>';*/
}

function top_small(t) {
    r = escape(d.referrer);
    switch (t) {
        case 1:
            return ' ';
        case 2:
            return ' ';
    }
}