var d = document;
var price = new Array('35:75:125:170:255','5:10:15:20:25:30:35:40:45:50:55:60:65:70:75:80:85:90:95:100','15:30:45:60:75:90:105:120:135:150:165:180:195:210:225:240:255:270:285:300','10:20:30:40:50:60:70:80:90:100','15:25:35:45:55:65:75:85:95:100:110','30:45:60:75:90:105:120:135:150:165:180:195:200','50:100:150:200:250:300:350:400');
var navarr = new Array('Рукопашный бой', 'Владение мечами', 'Владение топорами', 'Владение дробящим оружием', 'Владение ножами', 'Владение копьями и метательным оружием', 'Владение тяжёлыми алебардами', 'Владение магическими посохами', 'Владение экзотическим оружием', 'Владение двуручным оружием', 'Владение двумя руками', 'Дополнительные очки действия в бою', 'Магия огня', 'Магия воды', 'Магия воздуха', 'Магия земли', 'Сопротивление магии огня', 'Сопротивление магии воды', 'Сопротивление магии воздуха', 'Сопротивление магии земли', 'Сопротивление повреждениям', 'Воровство', 'Осторожность', 'Скрытность', 'Наблюдательность', 'Торговля', 'Странник', 'Рыболов', 'Лесоруб', 'Ювелирное дело', 'Самолечение', 'Оружейник', 'Доктор', 'Быстрое восстановление маны', 'Лидерство', 'Развитие науки алхимика', 'Развитие горного дела');

//урон, статы, мф, умения, пробой брони

 function writeparams(e){
 var armor = "<input type=hidden id=armor value=none>";
 if (e != 'none'){
		price = new Array('35:75:125:170:255','5:10:15:20:25:30:35:40:45:50:55:60:65:70:75:80:85:90:95:100','15:30:45:60:75:90:105:120:135:150:165:180:195:210:225:240:255:270:285:300','10:20:30:40:50:60:70:80:90:100','15:25:35:45:55:65:75:85:95:100:110','30:45:60:75:90:105:120:135:150:165:180:195:200','50:100:150:200:250:300:350:400');
	    switch (e){
		case 'w1': 
			var param = new Array('40-50:50-60:60-70:70-80:85-100','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','15:25:35:45:55:65:75:85:95:100:110','30:45:60:75:90:105:120:135:150:165:180:195:200','25:50:75:100:125:150:175:200');
            var dmgkb = "урон:";
			armor = "<input type=hidden id=armor value=none>";
		break;
		case 'w2': 
			var param = new Array('35-60:45-70:55-80:65-90:84-111','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','15:25:35:45:55:65:75:85:95:100:110','30:45:60:75:90:105:120:135:150:165:180:195:200','25:50:75:100:125:150:175:200');
            var dmgkb = "урон:";
			armor = "<input type=hidden id=armor value=none>";
		break;
		case 'w3': 
			var param = new Array('40-60:50-70:60-80:70-90:92-113','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','15:25:35:45:55:65:75:85:95:100:110','30:45:60:75:90:105:120:135:150:165:180:195:200','25:50:75:100:125:150:175:200');
            var dmgkb = "урон:";
			armor = "<input type=hidden id=armor value=none>";
		break;
		case 'w4': 
			var param = new Array('15-25:25-40:40-55:55-70:75-94','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','15:25:35:45:55:65:75:85:95:100:110','30:45:60:75:90:105:120:135:150:165:180:195:200','25:50:75:100:125:150:175:200');
            var dmgkb = "урон:";
			armor = "<input type=hidden id=armor value=none>";
		break;
		case 'w5': 
			var param = new Array('35-60:45-70:55-80:65-95:95-105','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','15:25:35:45:55:65:75:85:95:100:110','30:45:60:75:90:105:120:135:150:165:180:195:200','25:50:75:100:125:150:175:200');
            var dmgkb = "урон:";
			armor = "<input type=hidden id=armor value=none>";
		break;
		case 'w6': 
			var param = new Array('35-65:45-75:55-85:65-100:107-135','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','15:25:35:45:55:65:75:85:95:100:110','30:45:60:75:90:105:120:135:150:165:180:195:200','25:50:75:100:125:150:175:200');
            var dmgkb = "урон:";
			armor = "<input type=hidden id=armor value=none>";
		break;
		case 'w7': 
			var param = new Array('35-65:45-75:55-85:65-85:85-107','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','15:25:35:45:55:65:75:85:95:100:110','30:45:60:75:90:105:120:135:150:165:180:195:200','25:50:75:100:125:150:175:200');
            var dmgkb = "урон:";
			armor = "<input type=hidden id=armor value=none>";
		break;
		case 'w18': 
			var param = new Array('5-9:10-13:14-17:18-22:23-27','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','1:3:5:10:15:25:30:35:40:45:50','30:45:60:75:90:105:120:135:150:165:180:195:200','40:80:120:160:200:240:270:300');
            var dmgkb = "урон:";
            price[4] = "75:90:105:120:135:150:165:180:195:210:225";
            armor = "броня: <select id=armor name=armor onChange=\"getPrice();\"><option value=none selected=selected>0</option>";
			price[6] = "80:160:240:320:400:480:540:600";
		break;
		case 'w19': 
			var param = new Array('5-9:10-13:14-17:18-22:23-27','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','1:3:5:10:15:25:30:35:40:45:50','50:70:100:130:150:170:200:250:300:350:400:450:500','60:120:180:240:300:360:420:500');
            var dmgkb = "урон:";
            price[4] = "75:90:105:120:135:150:165:180:195:210:225";
            price[5] = "50:70:100:130:150:170:200:250:300:350:400:450:1000";
            armor = "броня: <select id=armor name=armor onChange=\"getPrice();\"><option value=none selected=selected>0</option>";
			price[6] = "120:240:360:480:600:720:840:1000";
		break;
		case 'w20': 
			var param = new Array('5-9:10-13:14-17:18-22:23-27','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','1:3:5:10:15:25:30:35:40:45:50','50:70:100:130:150:170:200:250:300:350:400:450:500','60:120:180:240:300:360:420:500');
            var dmgkb = "урон:";
            price[4] = "75:90:105:120:135:150:165:180:195:210:225";
            price[5] = "50:70:100:130:150:170:200:250:300:350:400:450:1000";
            armor = "броня: <select id=armor name=armor onChange=\"getPrice();\"><option value=none selected=selected>0</option>";
			price[6] = "120:240:360:480:600:720:840:1000";
		break;
		case 'w21': 
			var param = new Array('5-9:10-13:14-17:18-22:23-27','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','1:3:5:10:15:25:30:35:40:45:50','30:45:60:75:90:105:120:135:150:165:180:195:200','40:80:120:160:200:240:270:300');
            var dmgkb = "урон:";
            price[4] = "75:90:105:120:135:150:165:180:195:210:225";
            armor = "броня: <select id=armor name=armor onChange=\"getPrice();\"><option value=none selected=selected>0</option>";
			price[6] = "80:160:240:320:400:480:540:600";
		break;
		case 'w22': 
			var param = new Array('5-9:10-13:14-17:18-22:23-27','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','25:30:35:40:45:50:55:60:65:70:75','10:20:30:40:50:60:70:80:90:100:110:120:130','40:80:120:160:200:240:270:300');
            var dmgkb = "урон:";
            price[4] = "75:90:105:120:135:150:165:180:195:210:225";
            price[5] = "50:70:100:130:150:170:200:250:300:350:400:450:650";
            armor = "броня: <select id=armor name=armor onChange=\"getPrice();\"><option value=none selected=selected>0</option>";
			price[6] = "80:160:240:320:400:480:540:600";
		break;
		case 'w23': 
			var param = new Array('5-9:10-13:14-17:18-22:23-27','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','1:3:5:10:15:25:30:35:40:45:50','30:45:60:75:90:105:120:135:150:165:180:195:200','40:80:120:160:200:240:270:300');
            var dmgkb = "урон:";
            price[4] = "75:90:105:120:135:150:165:180:195:210:225";
            armor = "броня: <select id=armor name=armor onChange=\"getPrice();\"><option value=none selected=selected>0</option>";
			price[6] = "80:160:240:320:400:480:540:600";
		break;
		case 'w24': 
			var param = new Array('5-9:10-13:14-17:18-22:23-27','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','1:3:5:10:15:25:30:35:40:45:50','30:45:60:75:90:105:120:135:150:165:180:195:200','40:80:120:160:200:240:270:300');
            var dmgkb = "урон:";
            price[4] = "75:90:105:120:135:150:165:180:195:210:225";
            armor = "броня: <select id=armor name=armor onChange=\"getPrice();\"><option value=none selected=selected>0</option>";
			price[6] = "80:160:240:320:400:480:540:600";
		break;
		case 'w25': 
			var param = new Array('5-9:10-13:14-17:18-22:23-27','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','1:3:5:10:15:25:30:35:40:45:50','30:45:60:75:90:105:120:135:150:165:180:195:200','40:80:120:160:200:240:270:300');
            var dmgkb = "урон:";
            price[4] = "75:90:105:120:135:150:165:180:195:210:225";
            armor = "броня: <select id=armor name=armor onChange=\"getPrice();\"><option value=none selected=selected>0</option>";
			price[6] = "80:160:240:320:400:480:540:600";
		break;
		case 'w26': 
			var param = new Array('5-9:10-13:14-17:18-22:23-27','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','1:3:5:10:15:25:30:35:40:45:50','30:45:60:75:90:105:120:135:150:165:180:195:200','40:80:120:160:200:240:270:300');
            var dmgkb = "урон:";
            price[4] = "75:90:105:120:135:150:165:180:195:210:225";
            armor = "броня: <select id=armor name=armor onChange=\"getPrice();\"><option value=none selected=selected>0</option>";
			price[6] = "80:160:240:320:400:480:540:600";
		break;
		case 'w28': 
			var param = new Array('5-9:10-13:14-17:18-22:23-27','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','1:3:5:10:15:25:30:35:40:45:50','30:45:60:75:90:105:120:135:150:165:180:195:200','40:80:120:160:200:240:270:300');
            var dmgkb = "урон:";
            price[4] = "75:90:105:120:135:150:165:180:195:210:225";
            armor = "броня: <select id=armor name=armor onChange=\"getPrice();\"><option value=none selected=selected>0</option>";
			price[6] = "80:160:240:320:400:480:540:600";
		break;
		case 'w80': 
			var param = new Array('5-9:10-13:14-17:18-22:23-27','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','1:3:5:10:15:25:30:35:40:45:50','30:45:60:75:90:105:120:135:150:165:180:195:200','40:80:120:160:200:240:270:300');
            var dmgkb = "урон:";
            price[4] = "75:90:105:120:135:150:165:180:195:210:225";
            armor = "броня: <select id=armor name=armor onChange=\"getPrice();\"><option value=none selected=selected>0</option>";
			price[6] = "80:160:240:320:400:480:540:600";
		break;	
		case 'w90': 
			var param = new Array('5-9:10-13:14-17:18-22:23-27','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','1:3:5:10:15:25:30:35:40:45:50','30:45:60:75:90:105:120:135:150:165:180:195:200','40:80:120:160:200:240:270:300');
            var dmgkb = "урон:";
            price[4] = "75:90:105:120:135:150:165:180:195:210:225";
            armor = "броня: <select id=armor name=armor onChange=\"getPrice();\"><option value=none selected=selected>0</option>";
			price[6] = "80:160:240:320:400:480:540:600";
		break;		
	  }
		var sts = 0;
		if(armor != "<input type=hidden id=armor value=none>"){
			while(sts <= 12){
				armor += "<option value="+sts+">"+param[5].split(':')[sts]+"</option>";
				if(sts == 12){
					armor += "</select> <br>";
				}
				sts++;
			}
		}
     //урон
		var damage = ""+dmgkb+" <select id=damage name=damage onChange=\"getPrice();\"><option value=none selected=selected>0</option><option value=0>"+param[0].split(':')[0]+"</option><option value=1>"+param[0].split(':')[1]+"</option><option value=2>"+param[0].split(':')[2]+"</option><option value=3>"+param[0].split(':')[3]+"</option><option value=4>"+param[0].split(':')[4]+"</option></select> <br>";
     //статы
     var stats1 = "Мощь: <select id=sila name=sila onChange=\"getPrice();\"><option value=none selected=selected>0</option>";
     var stats2 = "Проворность: <select id=lovkost name=lovkost onChange=\"getPrice();\"><option value=none selected=selected>0</option>";
     var stats3 = "Везение: <select id=udacha name=udacha onChange=\"getPrice();\"><option value=none selected=selected>0</option>";
     var stats4 = "Разум: <select id=znan name=znan onChange=\"getPrice();\"><option value=none selected=selected>0</option>";
		sts = 0;
		while (sts <= 19){
				stats1 += "<option value="+sts+">"+param[1].split(':')[sts]+"</option>";
				stats2 += "<option value="+sts+">"+param[1].split(':')[sts]+"</option>";
				stats3 += "<option value="+sts+">"+param[1].split(':')[sts]+"</option>";
				stats4 += "<option value="+sts+">"+param[1].split(':')[sts]+"</option>";
				if(sts == 19){
				stats1 += "</select> <br>";
				stats2 += "</select> <br>";
				stats3 += "</select> <br>";
				stats4 += "</select> <br>";
				}
			sts++;
		}
		sts = 0;
     //модификаторы
     var modif1 = "уловка: <select id=ylov name=ylov onChange=\"getPrice();\"><option value=none selected=selected>0</option>";
     var modif2 = "точность: <select id=toch name=toch onChange=\"getPrice();\"><option value=none selected=selected>0</option>";
     var modif3 = "сокрушение: <select id=sokr name=sokr onChange=\"getPrice();\"><option value=none selected=selected>0</option>";
     var modif4 = "стойкость: <select id=stoi name=stoi onChange=\"getPrice();\"><option value=none selected=selected>0</option>";
		while (sts <= 19){
				modif1 += "<option value="+sts+">"+param[2].split(':')[sts]+"</option>";
				modif2 += "<option value="+sts+">"+param[2].split(':')[sts]+"</option>";
				modif3 += "<option value="+sts+">"+param[2].split(':')[sts]+"</option>";
				modif4 += "<option value="+sts+">"+param[2].split(':')[sts]+"</option>";
				if(sts == 19){
				modif1 += "</select> <br>";
				modif2 += "</select> <br>";
				modif3 += "</select> <br>";
				modif4 += "</select> <br>";
				}
			sts++;
		}
     //пробой брони
		sts = 0;
     var proboi = "пробой брони: <select id=proboi name=proboi onChange=\"getPrice();\"><option value=none selected=selected>0</option>";
		while (sts <= 10){
			proboi += "<option value="+sts+">"+param[4].split(':')[sts]+"</option>";
			if(sts == 10){
			proboi += "</select> <br>";
			}
			sts++;
		}
		sts = 0;
     var hp = "жизнь: <select id=hp name=hp onChange=\"getPrice();\"><option value=none selected=selected>0</option>";
		while (sts <= 7){
			hp += "<option value="+sts+">"+param[6].split(':')[sts]+"</option>";
			if(sts == 7){
			hp += "</select> <br>";
			}
			sts++;
		}
     //умения
		var navstr = "onChange=\"getPrice();\"><option value='none' selected=selected>0</option><option value=0>"+param[3].split(':')[0]+"</option><option value=1>"+param[3].split(':')[1]+"</option><option value=2>"+param[3].split(':')[2]+"</option><option value=3>"+param[3].split(':')[3]+"</option><option value=4>"+param[3].split(':')[4]+"</option><option value=5>"+param[3].split(':')[5]+"</option><option value=6>"+param[3].split(':')[6]+"</option><option value=7>"+param[3].split(':')[7]+"</option><option value=8>"+param[3].split(':')[8]+"</option><option value=9>"+param[3].split(':')[9]+"</option></select> <br>";
		var b = 1;
		var navor = '';
		var navmir = '';
		var nav = new Array;
		while (b <= 9){
				nav[b] = navarr[b]+":<select id="+b+" name=nav"+b+" "+navstr;
				navor += ""+nav[b]+"";
			b++;
		}
		b = 21;
		while (b <=33){
			nav[b] = navarr[b]+":<select id="+b+" name=nav"+b+" "+navstr;
			navmir += ""+nav[b]+"";
			b++;
		}
     d.getElementById('params').innerHTML = '<FIELDSET><LEGEND align=center><B><font color=gray>&nbsp;Основные характеристики&nbsp;</font></B></LEGEND>' + damage + '' + armor + '' + hp + '' + stats1 + '' + stats2 + '' + stats3 + '' + stats4 + '' + modif1 + '' + modif2 + '' + modif3 + '' + modif4 + '' + proboi + '</FIELDSET><FIELDSET><LEGEND align=center><B><font color=gray>&nbsp;Умения владения оружием&nbsp;</font></B></LEGEND>' + navor + '</FIELDSET><FIELDSET><LEGEND align=center><B><font color=gray>&nbsp;Мирные умения&nbsp;</font></B></LEGEND>' + navmir + '</FIELDSET>';
	}
	else {
		d.getElementById('params').innerHTML = '';
		d.getElementById('dealprice').innerHTML = '';
	}
}
 
 function getPrice(){
	var koeff = new Array('100:1','250:2','400:3','550:4','650:5','750:6','900:7','1200:8','1450:9','1700:10','2000:11','2300:12','2600:13','3000:14','3400:15','3900:16','4500:17','5000:18','5000:19','6000:20','6600:21','7200:22','7900:23','8500:24','9100:25','9800:26','10500:27','11200:28','11900:29','12600:30','13300:31');
	var el = d.getElementById('dealprice');	
	el.innerHTML = '';
	var c = 1;	var prval = 0;	var i = 0; var complete = '';
     //проверяем все навыки
	while (c <= 9){
		if (d.getElementById(c).value != 'none'){
			prval += parseInt(price[3].split(':')[d.getElementById(c).value]);
		}
		c++;
	}
	c = 21;	
	while (c <= 33){
		if (d.getElementById(c).value != 'none'){
			prval += parseInt(price[3].split(':')[d.getElementById(c).value]);
		}
		c++;
	}
     //считаем коэфф
     //проверяем все параметры для подсчета
	if (d.getElementById('sila').value != 'none'){
		prval += parseInt(price[1].split(':')[d.getElementById('sila').value]);
	}
	if (d.getElementById('lovkost').value != 'none'){
		prval += parseInt(price[1].split(':')[d.getElementById('lovkost').value]);
	}
	if (d.getElementById('udacha').value != 'none'){
		prval += parseInt(price[1].split(':')[d.getElementById('udacha').value]);
	}
	if (d.getElementById('znan').value != 'none'){
		prval += parseInt(price[1].split(':')[d.getElementById('znan').value]);
	}	
	if (d.getElementById('ylov').value != 'none'){
		prval += parseInt(price[2].split(':')[d.getElementById('ylov').value]);
	}
	if (d.getElementById('toch').value != 'none'){
		prval += parseInt(price[2].split(':')[d.getElementById('toch').value]);
	}
	if (d.getElementById('sokr').value != 'none'){
		prval += parseInt(price[2].split(':')[d.getElementById('sokr').value]);
	}
	if (d.getElementById('stoi').value != 'none'){
		prval += parseInt(price[2].split(':')[d.getElementById('stoi').value]);
	}
	if (d.getElementById('proboi').value != 'none'){
		prval += parseInt(price[4].split(':')[d.getElementById('proboi').value]);
	}
	if (d.getElementById('damage').value != 'none'){
		prval += parseInt(price[0].split(':')[d.getElementById('damage').value]);
	}
	if (d.getElementById('armor').value != 'none'){
		prval += parseInt(price[5].split(':')[d.getElementById('armor').value]);
	}
	if (d.getElementById('hp').value != 'none'){
		prval += parseInt(price[6].split(':')[d.getElementById('hp').value]);
	}
     //проверка параметров артефакта
	if(prval>0 && d.getElementById('artname').value!='' && d.getElementById('artname').value.length >= 5){
        complete = "<input type=submit class=klbut title=\"Подать заявку\" value=\"ПОДАТЬ ЗАЯВКУ\" />"
	}
	else if (prval>0 && d.getElementById('artname').value==''){
        complete = "<font class=weaponchdis>укажите название артефакта</font></form>";
	}
	else if (prval>0 && d.getElementById('artname').value!='' && d.getElementById('artname').value.length < 5){
        complete = "<font class=weaponchdis>название должно быть не короче 5 символов</font>";
	}
	else if(prval <= 0){
        complete = "<font class=weaponchdis>выберите хотя бы 1 параметр для артефакта</font>";
	}
	while(parseInt(koeff[i].split(':')[0]) < prval){
			i++;
	}
     //вывод цены, коэффа
     el.innerHTML = "<font color=black>цена: " + prval + "<br>коэффициэнт: " + i + "<br><br>" + complete + "";
 }

 
 