var typesArray = [["1","Выпивка"],["2","Еда/Закуска"]];
var statsArray = [["0","Нельзя одеть"],["1","Шлем","62","65"],["2","Ожерелье","62","35"],["3","Оружие","62","91"],["4","Пояс","62","30"],["5","Содержимое пояса","20","20"],[],[],["8","Сапоги","62","63"],["9","Поножи","62","40"],["10","Наплечники","62","40"],["11","Наручи","62","40"],["12","Перчатки","62","40"],["13","Щит","62","91"],["14","Кольцо","31","31"],[],["16","Доспех","62","83"],["17","Кольчуга","62","83"]];
var d = document;
var xmlhttp;

var $ = function(id){
	if (document.getElementById(id)){
		return document.getElementById(id);
	}else{
		var a=document.getElementsByName(id);
		return a[0];
	}
};
if(!xmlhttp && typeof XMLHttpRequest != 'undefined'){
	try{
		xmlhttp = new XMLHttpRequest();
	}
	catch (e){
		xmlhttp = false;
	}
}

ShowForm = function(msg){
	if(document.getElementById('darker').style.display == 'none'){
		document.getElementById('darker').style.display = 'block';
		document.getElementById('ContentError').innerHTML = msg;
	}else if(document.getElementById('darker').style.display == 'block'){
		document.getElementById('darker').style.display = 'none';
		document.getElementById('ContentError').innerHTML = msg;
	}	
}
// Показываем редактор
ShowEditor = function(){
	var html = '<form method="post" action="">';
	html += '<div id="main"></div>';
	html += '<table border="1" cellpadding="0" cellspacing="0" align="center" width="100%">';
	html += '<tr>';
	html += '<td align="center" width="50%">СВОЙСТВА</td>';
	html += '<td align="center" width="50%">ТРЕБОВАНИЯ</td>';
	html += '</tr>';
	html += '<tr>';
	html += '<td align="center" width="50%" valign="top"><div id="params_1"></div></td>';
	html += '<td align="center" width="50%" valign="top"><div id="params_2"></div></td>';
	html += '</tr>';
	html += '<tr><td colspan="2" width="100%" id="prices"></td></tr>';
	html += '</table>';
	html += '<center><input type="submit" value="Сохранить" /></center></form><iframe src="" id="imageUpdate" name="imageUpdate" style="width:100%;height:0px;display:none;"></iframe>';
	d.write(html);
	main_inf();
	ShowPar();
}
main_inf = function(){
	var html = '<table border="1" cellpadding="0" cellspacing="0" align="center" width="100%">';
	html += '<tr>';
	html += '<td colspan="3" align="center"><input type="hidden" name="name" value="'+params[0]+'" /><div onclick="changeParams(0);">'+params[0]+'</div></td>';
	html += '</tr>';
	html += '<tr>';
	html += '<td align="center" width="50%"><hr><input type="hidden" name="LI" value="'+params[6]+'" /><font onclick="changeParams(6);" style="cursor:pointer">Лимит: <b>'+params[6]+'</b> шт.</font><hr></td>';
	html += '<td align="center" style="cursor:pointer" onclick="changeImage();"><input type="hidden" name="img" value="'+params[1]+'" /><img src="//img.legendbattles.ru/image/tools/'+params[1]+'.gif" /></td>';
	html += '<td align="center" width="50%"><hr><input type="hidden" name="time" value="'+params[7]+'" /><font onclick="changeParams(7);" style="cursor:pointer">Время: <b>'+params[7]+'</b> м.</font><hr></td>';
	html += '</tr>';
	html += '<tr>';
	html += '<td colspan="3" align="center"><hr>' + SelectTypes() + '<hr></td>';
	html += '</tr>';
	html += '</table>';
	$('main').innerHTML = html;
	html = '<table border="1" cellpadding="0" cellspacing="0" align="center" width="100%">';
	html += '<tr>';
	html += '<td align="center" width="50%"><hr><input type="hidden" name="price" value="'+params[2]+'" /><font onclick="changeParams(2);" style="cursor:pointer">Стоимость: <b>'+params[2]+'</b> </font><hr></td>';
	html += '<td align="center" width="50%"><hr><input type="hidden" name="count" value="'+params[3]+'" /><font onclick="changeParams(3);" style="cursor:pointer">Количество: <b>'+params[3]+'</b> шт.</font><hr></td>';
	html += '</tr>';
	html += '</table>';
	$('prices').innerHTML = html;
}
ShowPar = function(){
	var str_par = '';
	var showPars = '';
	var i1=0,i2=0;
	var showPars = '';
	var str_pr = params[8].split('|');
	qsort_int(str_pr, 0, str_pr.length-1);
	for (var str_val in str_pr){
		i1++;
		str_par = str_pr[str_val].split('@');
		if(str_par[0] != ''){
			if(str_par[1] != ''){
				showPars += '<tr style="background:#'+((i1%2)?"EEEEEE":"DDDDDD")+'"><td width=10><img src=images/drop.gif onclick="par_set(0,\''+str_par[0]+'\',\'\');" style="cursor:pointer"></td>';
				showPars += '<td width=50%><i>'+all_params[0][str_par[0]][1]+'</i>:</td><td onclick="changeStats(0,\'' + str_par[0] + '\',\'' + str_par[1] + '\');" style="cursor:pointer">&nbsp;<b>'+str_par[1]+'</b>'+all_params[0][str_par[0]][2]+'</td><td width="60" align="center">'+((str_par[0] != '0' && str_par[0] != '1' && str_par[0] != '4' && str_par[0] != '78' && str_par[0] != '79')?fast_up(0,str_par[0],str_par[1]):'---')+'</td></tr>';
			}
		}
	}
	$('params_1').innerHTML = '<table border="1" cellpadding="0" cellspacing="0" align="center" width="100%"><input type="hidden" name="param" value="' + params[8] + '" />'+showPars+'<tr><td align="center" colspan="4" onclick="AddParams(0);" style="cursor:pointer">ДОБАВИТЬ</td></tr></table>';
	var showPars = '';
	var str_pr = params[9].split('|');
	qsort_int(str_pr, 0, str_pr.length-1);
	for (var str_val in str_pr){
		i2++;
		str_par = str_pr[str_val].split('@');
		if(str_par[0] != ''){
			if(str_par[1] != ''){
				showPars += '<tr style="background:#'+((i2%2)?"EEEEEE":"DDDDDD")+'"><td width=10><img src=images/drop.gif onclick="par_set(1,\''+str_par[0]+'\',\'\');" style="cursor:pointer"></td>';
				showPars += '<td width=50%><i>'+all_params[1][str_par[0]][1]+'</i>:</td><td onclick="changeStats(1,\'' + str_par[0] + '\',\'' + str_par[1] + '\');" style="cursor:pointer">&nbsp;<b>'+str_par[1]+'</b>'+all_params[1][str_par[0]][2]+'</td><td width="60" align="center">'+((str_par[0] != '0' && str_par[0] != '1' && str_par[0] != '4' && str_par[0] != '78' && str_par[0] != '79')?fast_up(1,str_par[0],str_par[1]):'---')+'</td></tr>';
			}
		}
	}
	$('params_2').innerHTML = '<table border="1" cellpadding="0" cellspacing="0" align="center" width="100%"><input type="hidden" name="need" value="' + params[9] + '" />'+showPars+'<tr><td align="center" colspan="4" onclick="AddParams(1);" style="cursor:pointer">ДОБАВИТЬ</td></tr></table>';
	
	
	return true;
}
// Типы и категории вещей
SelectTypes = function(){
	var html = '<select name="type" onchange="ChSelect(4,this.options[this.selectedIndex].value);">';
	for(var i = 0; i < typesArray.length; i++){
		html += '<option value="'+typesArray[i][0]+'"'+((typesArray[i][0] == params[4])?' selected="selected"':'')+'>'+typesArray[i][1]+'</option>';
	}
	html += '</select>';
	return html;
}
SelectSlots = function(){
	var html = '<select name="slot" onchange="ChSelect(5,this.options[this.selectedIndex].value);">';
	for(var i = 0; i < statsArray.length; i++){
		if(statsArray[i][0]){
			html += '<option value="'+statsArray[i][0]+'"'+((statsArray[i][0] == params[5])?' selected="selected"':'')+'>'+statsArray[i][1]+'</option>';
		}
	}
	html += '</select>';
	return html;
}
SelectBlocks = function(){
	var html = '<select name="block" onchange="ChSelect(10,this.options[this.selectedIndex].value);">';
	html += '<option value="0"'+((params[10] == 0)?' selected="selected"':'')+'>-------</option>';
	html += '<option value="40"'+((params[10] == 40)?' selected="selected"':'')+'>1 точка</option>';
	html += '<option value="70"'+((params[10] == 70)?' selected="selected"':'')+'>2 точки</option>';
	html += '<option value="90"'+((params[10] == 90)?' selected="selected"':'')+'>3 точки</option>';
	html += '</select>';
	return html;
}
ChSelect = function(type, value){
	params[type] = value;
	main_inf();
}
// Всплывающие формы
changeParams = function(paramID){
	var html = '<form onsubmit="changeParamsM(' + paramID + ');return false;"><center><input class="login" type="text" value="'+params[paramID]+'" id="param" size=30><hr><input type="submit" value="[OK]"></center></form>';
	ShowForm(html);
}
changeParamsM = function(paramID){
	params[paramID] = $('param').value;
	ShowForm();
	main_inf();
}
// Меняем статы
changeStats = function(type,par,val){
	var html = '<form onsubmit="changeStatsM(' + type + ',' + par + ');return false;"><center><input class="login" type="text" value="' + val + '" id="param" size=30><hr><input type="submit" value="[OK]"></center></form>';
	ShowForm(html);
}
changeStatsM = function(type,par){
	par_set(type,par,$('param').value);
	ShowForm();
	ShowPar();
}
// Меняем Картинку
changeImage = function(){
	return alert('В разработке');
	var loadLink = '';
	if($('slot').value > 0){
		loadLink = 'javascript:changeImageAjax('+statsArray[$('slot').value][2]+', '+statsArray[$('slot').value][3]+');';
	}
	if(loadLink){
		ShowForm('<table width="100%"><tr><td align="center"><a href="'+loadLink+'">Загрузить</a></td><td align="center"><a href="#" onclick="window.frames[\'imageUpdate\'].location=\'/gameplay/ajax/imageUpdate.php?action=update\';">Обновить</a></td></tr><tr><td colspan="2" align="center"><div style="height: '+(window.innerHeight/2)+'px;overflow: auto;" id="gamImages">Loading...</div></td></tr></table>');
	}else{
		alert('Слот вещи не выбран');
	}
}
changeImageM = function(image){
	params[1] = image;
	ShowForm();
	main_inf();
}
changeImageAjax = function(x, y){
	xmlhttp.open('get', '/gameplay/ajax/imageUpdate.php?action=get&width=' + x +'&height=' + y + '&rand=' + Math.random());
	xmlhttp.onreadystatechange = ajax_response;
	xmlhttp.send(null);
}
// Добавляем новые статы
AddParams = function(type){
	var DataID = [8,9];
	var unselect = [];
	var i=0;
	// Делаем выборку уже добавленных статов
	var str_pr = params[DataID[type]].split('|');
	for (var str_val in str_pr){
		var str_par = str_pr[str_val].split('@');
		unselect[i++] = str_par[0];
	}
	// Строим Select
	var select = '';
	for(var i = 0; i < all_params[type].length; i++){
		if(all_params[type][i][0]){
			if(in_array(all_params[type][i][0], unselect) == false)
			select += '<option value="' + all_params[type][i][0] + '">' + all_params[type][i][1] + '</option>';
		}
	}
	// Строим шаблон
	ShowForm('<form onsubmit="AddParamsM(' + type + ');return false;"><center><select class="login" id="addParamsId">' + select + '</select><br /><input class="login" type="text" value="0" id="addParamsName" size=30><hr><input type="submit" value="[OK]"></center></form>');
}
AddParamsM = function(type){
	var DataID = [8,9];
	params[DataID[type]] += ((params[DataID[type]] != '')? '|' : '') + $('addParamsId').value + '@' + $('addParamsName').value;
	ShowForm();
	ShowPar();
}
// Редактируем переменные в режиме онлайн
fast_up = function(type,par,val){
	val = parseInt(val);
	return '<img style="cursor:pointer" src=http"//img.legendbattles.ru/images/fixed_on.gif onclick="par_set('+type+','+par+','+(val*2)+')"> <img style="cursor:pointer" src=http"//img.legendbattles.ru/images/battle/down.gif onclick="par_set('+type+','+par+','+(val-1)+')"> <img style="cursor:pointer" src=http"//img.legendbattles.ru/images/battle/up.gif onclick="par_set('+type+','+par+','+(val+1)+')"> <img style="cursor:pointer" src=http"//img.legendbattles.ru/images/fixed_off.gif onclick="par_set('+type+','+par+','+(val/2)+')">';
}
par_set = function(type,par,val){
	var NewParams = '';
	switch(type){
		case 0:
			var str_pr = params[8].split('|');
			qsort_int(str_pr, 0, str_pr.length-1);
			for (var str_val in str_pr){
				str_par = str_pr[str_val].split('@');
				str_par[0] = eval(str_par[0]);
				NewParams += (str_par[0] == par && val == '' && val != '0') ? '' : str_par[0] + '@' + ((str_par[0] != par)?str_par[1]:val) + '|';
			}
			params[8] = ((NewParams !='') ? NewParams.substring(0, NewParams.length - 1) : '');
		break;
		case 1:
			var str_pr = params[9].split('|');
			qsort_int(str_pr, 0, str_pr.length-1);
			for (var str_val in str_pr){
				str_par = str_pr[str_val].split('@');
				str_par[0] = eval(str_par[0]);
				NewParams += (str_par[0] == par && val == '' && val != '0') ? '' : str_par[0] + '@' + ((str_par[0] != par)?str_par[1]:val) + '|';
			}
			params[9] = ((NewParams !='') ? NewParams.substring(0, NewParams.length - 1) : '');
		break;
	}
	ShowPar();
}

qsort_int = function(arr,first,last){
	if (first<last){
		point=parseInt(arr[first].split("@")[0]);
		i=first;
		j=last;
		while (i<j){
			while ((1*parseInt(arr[i].split("@")[0])<=1*point) && (i<last)) i++;
			while ((1*parseInt(arr[j].split("@")[0])>=1*point) && (j>first)) j--;
			if (i<j){
				temp=arr[i];
				arr[i]=arr[j];
				arr[j]=temp;
			}
		}
		temp=arr[first];
		arr[first]=arr[j];
		arr[j]=temp;
		qsort_int(arr,first,j-1);
		qsort_int(arr,j+1,last);
	}
}

ajax_response = function(){
	if(xmlhttp.readyState == 4){
		if(xmlhttp.status == 200){
			var response = xmlhttp.responseText;
			var z = '';
			if (response == 'none'){
				$('gamImages').innerHTML += 'Рисунков не найдено.';
			}else if (response != 'none'){
				response = response.split('|');
				for (var i=0;i<response.length;i++){
					if (response[i]){
						z+= '<img src="//img.legendbattles.ru/image/weapon'+response[i]+'" style="cursor:pointer;" onclick="changeImageM(\''+response[i]+'\')" width=30> ';
					}
				}
				$('gamImages').innerHTML = z;
			}
		}
	}
}

in_array = function(needle, haystack, strict) {
	var found = false, key, strict = !!strict;
	for (key in haystack) {
		if ((strict && haystack[key] === needle) || (!strict && haystack[key] == needle)) {
			found = true;
			break;
		}
	}
	return found;
}