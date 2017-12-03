function counterview(referr)
{
    js=11;
     d=document;var a='';
     if(referr=='null') a+=';r='+escape(d.referrer); else a+=';r='+escape("http://legendbattles.ru/uTerms.php")+referr+'.html';
     a+=';j='+navigator.javaEnabled();
     s=screen;a+=';s='+s.width+'*'+s.height;
     a+=';d='+(s.colorDepth?s.colorDepth:s.pixelDepth);
     d.write('<a href="http://top.mail.ru/jump?from=2330323"'+' target=_blank><img src="http://top.list.ru/counter'+'?id=2330323;t=59;js='+js+a+';rand='+Math.random()+'" title="Рейтинг@Mail.ru"'+' border=0 height=31 width=88><\/a> ');
     d.write(' <a href="http://www.liveinternet.ru/click" '+
     'target=_blank><img src="http://counter.yadro.ru/hit?t44.2;r'+
     escape(d.referrer)+((typeof(screen)=='undefined')?'':
     ';s'+screen.width+'*'+screen.height+'*'+(screen.colorDepth?
     screen.colorDepth:screen.pixelDepth))+';u'+escape(d.URL)+
     ';'+Math.random()+
     '" border=0 width=31 height=31 title="liveinternet.ru"></a>');
}

function helpwin(open_page)
{
     url_open = 'http://legendbattles.ru/uTerms.php';
     viewwin = open(url_open, "helpWindow", "width=455, height=400, status=no, toolbar=no, menubar=no, resizable=no, scrollbars=yes");
}