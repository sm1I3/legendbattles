var d = document;
var type,second,el;

function clearparams(v){
	switch(v){
		case '1': d.getElementById('params1').innerHTML = ''; d.getElementById('params2').innerHTML = ''; d.getElementById('params3').innerHTML = ''; break;
		case '2': d.getElementById('params2').innerHTML = ''; d.getElementById('params3').innerHTML = ''; break;
		case '3': d.getElementById('params3').innerHTML = ''; break;
	}
}

function writeparams(e){
el = d.getElementById('params1');
type='';
second='';
switch (e){
		case 'w1': 	type = "weapon";	break;
		case 'w2': 	type = "weapon";	break;
		case 'w3': 	type = "weapon";	break;
		case 'w4': 	type = "weapon";	break;
		case 'w5': 	type = "weapon";	break;
		case 'w6': 	type = "weapon";	break;
		case 'w7': 	type = "weapon";	break;
		case 'w18': break;
		case 'w19': break;
		case 'w20': type = "shield";	break;
		case 'w21': break;
		case 'w22': break;
		case 'w23': break;
		case 'w24': break;
		case 'w25': break;
		case 'w26': break;
		case 'w28': break;
		case 'w80': break;	
		case 'w90': break;		
}
switch(type){
	case '': second='';break;
	case 'weapon': second='<font class weaponchdis>&nbsp;Второе оружие ( да <input name="wtor" type="radio" value="1" onClick="writeparams2();" /> ) ( нет <input name="wtor" type="radio" value="0" onClick="writeparams2();" /> )<input type=hidden name="block" value="0" /></font>';	break;
	case 'shield': second= '<select name="block" width=50><option value="0" selected="selected">Блок точек</option><option value="40">1 точка</option><option value="70">2 точки</option><option value="90">3 точки</option></select>';	break;
}
el.innerHTML = second;
}

function writeparams2(){
	el = d.getElementById('params2');
	el.innerHTML = '<input name="name" type="text" value="Название" /><input type="checkbox" onClick="writeparams3();" />';
}

function writeparams3(){
	el = d.getElementById('params3');
	el.innerHTML = '<input name="name" type="text" value="Название" /><input type="checkbox" onClick="writeparams3();" />';
}
 
 
 