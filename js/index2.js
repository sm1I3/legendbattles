var d=document;
view_index = function(page){
	
BoxLoad();	
var links='<table border="0" cellpadding="0" cellspacing="0" align="center">  <tr>    <td width="150" align="center"><a class="boxed" href="reg.php" rel="{handler:\'iframe\',size:{x:500,y:450}}">Регистрация</a></td>	<td>&nbsp;</td> <td width="150" align="center"><a target="_blank" href="http://money.legendbattles.ru/">Банк</a></td> <td>&nbsp;</td> <td width="150" align="center"><a target="_blank" href="http://wiki.legendbattles.ru/">Библиотека</a></td> <td>&nbsp;</td>	<td width="150" align="center"><a target="_blank" href="http://legendbattles.ru/forum/">Форум</a></td>	<td>&nbsp;</td>	<td width="150" align="center"><a class="boxed" href="#lostpwd.php" rel="{handler:\'iframe\',size:{x:700,y:250}}">Забыли пароль?</a></td>  </tr></table>';

if(page != 'mobile'){
	
}
d.write('<div id="header"><div style="position: absolute;margin: 1% 0 0 10px;z-index: 100;"><img src="http://img.legendbattles.ru/img/year.gif" width="201"  height="170"></div></div><div id="tooltip"></div><table border="0" style="height:100%;width:100%;">  <tr>    <td align="center"><div id="content"><form action="world.php'+((page)?'?view='+page:'')+'" method="post"><table width="800" height="520" border="0" cellpadding="0" cellspacing="0" align="center" style="background-image:url(/images/index/index.jpg);">  <tr> <td width="200" height="110"></td> <td colspan="2" width="200" height="110"></td> <td colspan="2" width="200" height="110"></td> <td width="200" height="110"></td> </tr> <tr><td width="200" height="151" ></td> <td width="110" height="151"></td><td colspan="2" width="173" height="151" align="center"><input name="player_nick"  class="button" type="text"  onBlur="if (value == \'\') {value=\'Логин\'}" onFocus="if (value == \'Логин\') {value = \'\'}" value="Логин"><input name="player_client"  class="button" type="hidden"  value="0"><br><input name="player_password" class="button" type="password" onBlur="if (value == \'\') {value=\'Пароль\'}" onFocus="if (value == \'Пароль\') {value =\'\'}" value="Пароль"><br> <input type="submit" class="enter" value="Войти"></td><td width="117" height="151"></td><td width="117" height="151"></td></tr><tr><td width="200" height="177"></td><td colspan="2" width="200" height="177"></td><td colspan="2" width="200" height="177"></td><td width="200" height="177"></td>  </tr></table></form>'+links+'</div></td>  </tr></table>');
	if(page != 'mobile'){
		d.write('<td><center><font color="#CFB08D">&copy; Copyright 2012-2013, Legend Battles Ltd. Все права защищены.</font></center></td>');
	}
}

fixpng = function(img) {
	var arVersion = navigator.appVersion.split("MSIE")
	var version = parseFloat(arVersion[1])
	
	if ((version >= 5.5) && (document.body.filters)) 
	{
		var imgName = img.src.toUpperCase()
		if (imgName.substring(imgName.length-3, imgName.length) == "PNG")
		{
			var imgID = (img.id) ? "id='" + img.id + "' " : ""
			var imgClass = (img.className) ? "class='" + img.className + "' " : ""
			var imgTitle = (img.title) ? "title='" + img.title + "' " : "title='" + img.alt + "' "
			var imgStyle = "display:inline-block;" + img.style.cssText 
			if (img.align == "left") imgStyle = "float:left;" + imgStyle
				if (img.align == "right") imgStyle = "float:right;" + imgStyle
					if (img.parentElement.href) imgStyle = "cursor:pointer;" + imgStyle
						var strNewHTML = "<span " + imgID + imgClass + imgTitle
						+ " style=\"" + "width:" + img.width + "px; height:" + img.height + "px;" + imgStyle + ";"
						+ "filter:progid:DXImageTransform.Microsoft.AlphaImageLoader"
						+ "(src=\'" + img.src + "\', sizingMethod='scale');\"></span>" 
						img.outerHTML = strNewHTML
						i = i-1
		}
	}
}

BoxLoad = function(){
	window.addEvent('domready', function() {
		SqueezeBox.initialize({
			size: {x: 350, y: 400},
			ajaxOptions: {
				method: 'get'
			}
		});
		$$('a.boxed').each(function(el) {
			el.addEvent('click', function(e) {
				new Event(e).stop();
				SqueezeBox.fromElement(el);
			});
		});
		$$('.panel-toggler').each(function(el) {
			var target = el.getLast().setStyle('display', 'none');
			el.getFirst().addEvent('click', function() {
				target.style.display = (target.style.display == 'none') ? '' : 'none';
			});
		});
	});
}
ShowError = function(msg){
	if(document.getElementById('darker').style.display == 'none'){
		document.getElementById('darker').style.display = 'block';
		document.getElementById('ContentError').innerHTML = msg;
	}else if(document.getElementById('darker').style.display == 'block'){
		document.getElementById('darker').style.display = 'none';
		document.getElementById('ContentError').innerHTML = msg;
	}	
}

document.write('<div id="darker" style="display:none;"><table cellspacing="0" cellpadding="0" width="300" style="position:relative;width:300px;left:50%;top:50%;margin-left:-150px;margin-top:-105px;">  <tr>    <td style="width:18px;height:18px;"><div style="position:absolute; width:30px; height:30px; background:url(imagesclosebox.png) no-repeat;right:0px;top:0px;cursor:pointer;" onclick="ShowError();">&nbsp;</div><img src="images/Formup/left_top.png" width="18" height="18"></td>    <td style="height:18px;background-image:url(\'images/Formup/top.png\');"></td>    <td style="width:18px;height:18px;"><img src="images/Formup/right_top.png" width="18" height="18"></td>  </tr>  <tr>    <td style="width:18px;background-image:url(\'images/Formup/left.png\');"></td>    <td style="background-image:url(\'images/Formup/bg.png\');" align="center"><div id="ContentError"></div></td>    <td style="width:18px;background-image:url(\'images/Formup/right.png\');"></td>  </tr>  <tr>    <td style="width:18px;height:18px;"><img src="images/Formup/left_bottom.png" width="18" height="18"></td>    <td style="height:18px;background-image:url(\'images/Formup/bottom.png\');"></td>    <td style="width:18px;height:18px;"><img src="images/Formup/right_bottom.png" width="18" height="18"></td>  </tr></table></div>');