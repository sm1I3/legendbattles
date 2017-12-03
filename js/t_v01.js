var d = document;
var s = screen;
var sfo = s.width+'*'+s.height;
var dep = s.colorDepth ? s.colorDepth : s.pixelDepth;
var r = escape(d.referrer);

function view_t()
{
	return '<a href="http://top.mail.ru/jump?from=2330323" target="_blank"><img src="http://d6.c2.ba.a0.top.mail.ru/counter?id=2330323;t=79;js=13;r='+r+';j='+navigator.javaEnabled()+';s='+sfo+';d='+dep+';rand='+Math.random()+'" border="0" height="31" width="38" style="filter:alpha(opacity=50);"></a> <a href="http://www.liveinternet.ru/click" target="_blank"><img src="http://counter.yadro.ru/hit?t44.2;r'+r+((typeof(s) == 'undefined') ? '' : ';s'+sfo+'*'+dep)+';u'+escape(d.URL)+';'+Math.random()+'" border="0" width="31" height="31" style="filter:alpha(opacity=50);"></a>';
}