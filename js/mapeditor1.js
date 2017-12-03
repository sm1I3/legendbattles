var d = document;
var bots = {0:["Крыса","bot_3.jpg"],100:["Кабан","bot_4.jpg"],200:["Паук","bot_5.jpg"],300:["Ядовитый Паук","bot_6.jpg"],400:["Гоблин","bot_2.jpg"],500:["Орк","bot_1.jpg"],600:["Скелет","bot_7.jpg"],700:["Скелет Воин","bot_9.jpg"],800:["Зомби","bot_8.jpg"],900:["Дух","bot_10.jpg"],1000:["Болотный Тролль","bot_11.jpg"],1100:["Минотавр","bot_12.jpg"]};
var avail = new Array();

EditBots = function(mod,values){
	FormPopUp('darker');
	if(mod == 'Add'){
		var options = '';
		var id = ids.splist("|");
		var name = name.split("|");
		for(var i=0;i<ebots.length;i++){
			EditBot += '<option value="'+ebots[i][0]+'" '+(i==0?'selected=selected':'')+'>'+ebots[i][1]+'</option>';
		}
		var EditBot = '<form onSubmit="FormSubmit(\'11\');return false;"><table width="100%" align="center"><tr><td align=center><select id="group">'+options+'</select></td></tr><tr><td align="center"><input type="submit" value="Сохранить" class="lbut" /></td></tr></table></form>';		
	}
	$('ContentPopUp').innerHTML = EditBot;
}

EditLes = function(mod,ids,names,col){
	FormPopUp('darker');
	if(mod == 'Add'){
		var options = '';
		var id = ids.split("|");		
		var name = names.split("|");
		for(var i = 0; i<col;i++){
			options  += '<option value="'+id[i]+'" '+(i==0?'selected=selected':'')+'>'+name[i]+'</option>';
		}
		var EditLes = '<form onSubmit="FormSubmit(\'7\');return false;"><table width="100%" align="center"><tr><td align=center><select id="grass">'+options+'</select></td></tr><tr><td align="center" colspan="2">Время роста (минуты): <input type="text" id="rost" value="60"><br><input type="submit" value="Сохранить" class="lbut" /></td></tr></table></form>';		
	}
	$('ContentPopUp').innerHTML = EditLes;
}

EditFish = function(mod,ids,names,col){
	FormPopUp('darker');
	if(mod == 'Add'){
		var options = '';
		var id = ids.split("|");		
		var name = names.split("|");
		for(var i = 0; i<col;i++){
			options  += '<option value="'+id[i]+'" '+(i==0?'selected=selected':'')+'>'+name[i]+'</option>';
		}
		var EditFish = '<form onSubmit="FormSubmit(\'12\');return false;"><table width="100%" align="center"><tr><td align=center><select id="grass">'+options+'</select></td></tr><tr><td align="center" colspan="2">Уровень "Рыбалки" для ловли: <input type="text" id="rost" value="1"><br><input type="submit" value="Сохранить" class="lbut" /></td></tr></table></form>';		
	}
	$('ContentPopUp').innerHTML = EditFish;
}

LocConfig = function(){
	FormPopUp('darker');
	if(dataedit[4] == '0'){
		$('ContentPopUp').innerHTML = '<form onSubmit="FormSubmit(\'4\');return false;">  <table width="100%" align="center"><tr>      <td align="center"><input type="submit" value="Создать" class="lbut" /></td>    </tr>  </table></form>';
	}else if(dataedit[4] == '1'){
		$('ContentPopUp').innerHTML = '<form onSubmit="FormSubmit(\'5\');return false;">  <table width="100%" align="center"><tr>      <td align="center"><input type="submit" value="Удалить" class="lbut" /></td>    </tr>  </table></form>';
	}
}

MoveTo = function(){
	FormPopUp('darker');
	$('ContentPopUp').innerHTML = '<form onSubmit="FormSubmit(\'1\');return false;">  <table width="100%" align="center">    <tr>      <td align="center"><input name="pos_x" id="pos_x" value="'+dataedit[0]+'" class="lbut" />        <input name="pos_y" id="pos_y" value="'+dataedit[1]+'" class="lbut" /></td>    </tr>    <tr>      <td align="center"><input type="submit" value="Перейти" class="lbut" /></td>    </tr>  </table></form>';
}

TeleTo = function(){
	var TeleToS = '<form onSubmit="FormSubmit(\'10\');return false;"><select name="tele_id" id="tele_id">';
	TeleToS += '<option value="0" ';
	if(dataedit[3]=='0'){
		TeleToS += 'selected="selected"';
	}
	TeleToS += '>Никуда</option>';
	for(var i=0; i<teleto.length; i++){
		if(teleto[i][0] == dataedit[3]){
			TeleToS += '<option value="'+teleto[i][0]+'" selected="selected">'+teleto[i][1]+'</option>';
		}else{
			TeleToS += '<option value="'+teleto[i][0]+'">'+teleto[i][1]+'</option>';
		}
	}
	TeleToS += '</select><input type="submit" value="Изменить" class="lbut" /></form>';
	FormPopUp('darker');
	$('ContentPopUp').innerHTML = TeleToS;
}

GoTo = function(){
	var GoToS = '<form onSubmit="FormSubmit(\'3\');return false;"><select name="go_id" id="go_id">';
	GoToS += '<option value="0" ';
	if(dataedit[3]=='0'){
		GoToS += 'selected="selected"';
	}
	GoToS += '>Никуда</option>';
	for(var i=0; i<goto.length; i++){
		if(goto[i][0] == dataedit[3]){
			GoToS += '<option value="'+goto[i][0]+'" selected="selected">'+goto[i][1]+'</option>';
		}else{
			GoToS += '<option value="'+goto[i][0]+'">'+goto[i][1]+'</option>';
		}
	}
	GoToS += '</select><input type="submit" value="Изменить" class="lbut" /></form>';
	FormPopUp('darker');
	$('ContentPopUp').innerHTML = GoToS;
}

LocName = function(){
	FormPopUp('darker');
	$('ContentPopUp').innerHTML = '<form onSubmit="FormSubmit(\'2\');return false;">  <table width="100%" align="center">    <tr>      <td align="center"><input name="LocName" id="LocName" value="'+dataedit[2]+'" class="lbut" /></td>    </tr>    <tr>      <td align="center"><input type="submit" value="Изменить" class="lbut" /></td>    </tr>  </table></form>';
}

FormSubmit = function(id){
	if(id == 1){
		window.location = '?useaction=admin-action&addid=map&x='+$('pos_x').value+'&y='+$('pos_y').value;
	}else if(id == 2){
		AjaxGet('mapeditor_ajax.php?act=EditName&locname='+$('LocName').value+'&x='+dataedit[0]+'&y='+dataedit[1]);
	}else if(id == 3){
		AjaxGet('mapeditor_ajax.php?act=GoTo&locid='+$('go_id').value+'&x='+dataedit[0]+'&y='+dataedit[1]);
	}else if(id == 4){
		AjaxGet('mapeditor_ajax.php?act=Create&x='+dataedit[0]+'&y='+dataedit[1]);
	}else if(id == 5){
		AjaxGet('mapeditor_ajax.php?act=Delete&x='+dataedit[0]+'&y='+dataedit[1]);
	}else if(id == 6){
		AjaxGet('mapeditor_ajax.php?act=BotAdd&x='+dataedit[0]+'&y='+dataedit[1]+'&id='+$('bot_id').value);
	}else if(id == 7){
		AjaxGet('mapeditor_ajax.php?act=BotEdit&x='+dataedit[0]+'&y='+dataedit[1]+'&lvlmin='+$('bot_min').value+'&lvlmax='+$('bot_max').value);
	}else if(id == 8){
		AjaxGet('mapeditor_ajax.php?act=GrassDelete&x='+dataedit[0]+'&y='+dataedit[1]);
	}else if(id == 9){
		AjaxGet('mapeditor_ajax.php?act=GrassAdd&x='+dataedit[0]+'&y='+dataedit[1]+'&rost='+$('rost').value+'&grass='+$('grass').value);
	}else if(id == 10){
		AjaxGet('mapeditor_ajax.php?act=TeleAdd&x='+dataedit[0]+'&y='+dataedit[1]+'&telex='+$('tele_id').value);
	}else if(id == 11){
		AjaxGet('mapeditor_ajax.php?act=LesAdd&x='+dataedit[0]+'&y='+dataedit[1]+'&rost='+$('rost').value+'&grass='+$('grass').value);
	}else if(id == 12){
		AjaxGet('mapeditor_ajax.php?act=FishAdd&x='+dataedit[0]+'&y='+dataedit[1]+'&rost='+$('rost').value+'&grass='+$('grass').value);
	}
}

StateReady = function(){
	if(arr_res[0] == 'OK2'){
		FormPopUp('darker');
		dataedit[2] = $('LocName').value;
		$('LocName_text').innerHTML = 'Локация: '+$('LocName').value;
	}else if(arr_res[0] == 'OK3'){
		FormPopUp('darker');
		dataedit[3] = $('go_id').value;
		$('GoTo_text').innerHTML = 'Вход: '+arr_res[1];
	}else if(arr_res[0] == 'OK4'){
		window.location.reload();
	}else if(arr_res[0] == 'OK5'){
		FormPopUp('darker');
		dataedit[3] = $('tele_id').value;
		$('TeleTo_text').innerHTML = 'Телепорт: '+arr_res[1];
	}else if(arr_res[0] == 'NOTOK'){
		alert('test');
	}
	
}

view_map = function(){
	MapBig();
}



MapBig = function(){
	for(var i=0; i<map.length; i++){
		avail[map[i][0]+'_'+map[i][1]] = map[i][0]+'_'+map[i][1];
	}
	d.write('<table border="1" cellpadding="0" cellspacing="0" align="center" width="700">');
	for(var y=(dataedit[1]-2);y<=(dataedit[1]+2);y++){
		d.write('<tr>');
		for(var x=(dataedit[0]-3);x<=(dataedit[0]+3);x++){
			if(dataedit[1] == y && dataedit[0] == x){
				d.write('<td background="http://image.guild-honor.ru/map/world/day/'+y+'/'+x+'_'+y+'.jpg"><img ondblclick="LocConfig()" src="http://image.guild-honor.ru/map/here.png" width="100" height="100" /></td>');
			}else if(avail[x+'_'+y]){
				d.write('<td background="http://image.guild-honor.ru/map/world/day/'+y+'/'+x+'_'+y+'.jpg"><a href="?useaction=admin-action&addid=map&x='+x+'&y='+y+'"><img src="http://image.guild-honor.ru/map/world/go_yes.gif" width="100" height="100" border="0" /></a></td>');
			}else{
				d.write('<td background="http://image.guild-honor.ru/map/world/day/'+y+'/'+x+'_'+y+'.jpg"><a href="?useaction=admin-action&addid=map&x='+x+'&y='+y+'"><img src="http://image.guild-honor.ru/index/dark.png" width="100" height="100" border="0" /></a></td>');	
			}
		}
		d.write('</tr>');
	}
	d.write('</table>');
}

MapSmall = function(){
	for(var i=0; i<map.length; i++){
		avail[map[i][0]+'_'+map[i][1]] = map[i][0]+'_'+map[i][1];
	}
	d.write('<table border="1" cellpadding="0" cellspacing="0" align="center" bgcolor="#000000">');
	for(var y=(dataedit[1]-5);y<=(dataedit[1]+5);y++){
		d.write('<tr>');
		for(var x=(dataedit[0]-5);x<=(dataedit[0]+5);x++){
			if(dataedit[1] == y && dataedit[0] == x){
				d.write('<td><img src="http://image.guild-honor.ru/map/world/day/'+y+'/'+x+'_'+y+'.jpg" width="15" height="15"></td>');
			}else if(avail[x+'_'+y]){
				d.write('<td><a href="?useaction=admin-action&addid=map&x='+x+'&y='+y+'"><img src="http://image.guild-honor.ru/map/world/day/'+y+'/'+x+'_'+y+'.jpg" width="15" height="15"  border="0"></a></td>');
			}else{
				d.write('<td><a href="?useaction=admin-action&addid=map&x='+x+'&y='+y+'"><img src="http://image.guild-honor.ru/map/world/day/'+y+'/'+x+'_'+y+'.jpg" width="15" height="15" style="opacity:0.55;" border="0" /></a></td>');	
			}
		}
		d.write('</tr>');
	}
	d.write('</table>');
}