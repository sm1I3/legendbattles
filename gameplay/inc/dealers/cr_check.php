<?
$name=trim($_POST['artname']);
$name=addslashes($name);
$name=cutStr($name,40,"");	
$name=trim($name);
$err=0;
if (testchr($name) == 1) {
    $message = "<font color=red>имя артефакта содержит недопустимые символы</font>";
    $err = 1;
} else if ($name == '') {
    $message = "<font color=red>имя артефакта не может состоять только из пробелов</font>";
    $err = 1;
}
else{
	switch ($_POST['selecttype']){
        case '':
            $message = "<font color=red>не выбран тип</font>";
            $err = 1;
            break;
		case 'w1': $err=0;break;
		case 'w2': $err=0;break;
		case 'w3': $err=0;break;
		case 'w4': $err=0;break;
		case 'w5': $err=0;break;
		case 'w6': $err=0;break;
		case 'w7': $err=0;break;
		case 'w18': $err=0;break;
		case 'w19': $err=0;break;
		case 'w20': $err=0;break;
		case 'w21': $err=0;break;
		case 'w22': $err=0;break;
		case 'w23': $err=0;break;
		case 'w24': $err=0;break;
		case 'w25': $err=0;break;
		case 'w26': $err=0;break;
		case 'w28': $err=0;break;
		case 'w80': $err=0;break;
		case 'w90': $err=0;break;
		default: $err=1;break;
	}
}
if ($err==0){
$pr=0;
    $nar = Array('Рукопашный бой', 'Владение мечами', 'Владение топорами', 'Владение дробящим оружием', 'Владение ножами', 'Владение копьями и метательным оружием', 'Владение тяжёлыми алебардами', 'Владение магическими посохами', 'Владение экзотическим оружием', 'Владение двуручным оружием', 'Владение двумя руками', 'Дополнительные очки действия в бою', 'Магия огня', 'Магия воды', 'Магия воздуха', 'Магия земли', 'Сопротивление магии огня', 'Сопротивление магии воды', 'Сопротивление магии воздуха', 'Сопротивление магии земли', 'Сопротивление повреждениям', 'Воровство', 'Осторожность', 'Скрытность', 'Наблюдательность', 'Торговля', 'Странник', 'Рыболов', 'Лесоруб', 'Ювелирное дело', 'Самолечение', 'Оружейник', 'Доктор', 'Быстрое восстановление маны', 'Лидерство', 'Развитие науки алхимика', 'Развитие горного дела');
$koeff = Array('100:1','250:2','400:3','550:4','650:5','750:6','900:7','1200:8','1450:9','1700:10','2000:11','2300:12','2600:13','3000:14','3400:15','3900:16','4500:17','5000:18','5000:19','6000:20','6600:21','7200:22','7900:23','8500:24','9100:25','9800:26','10500:27','11200:28','11900:29','12600:30','13300:31');
$price = Array('35:75:125:170:255','5:10:15:20:25:30:35:40:45:50:55:60:65:70:75:80:85:90:95:100','15:30:45:60:75:90:105:120:135:150:165:180:195:210:225:240:255:270:285:300','10:20:30:40:50:60:70:80:90:100','15:25:35:45:55:65:75:85:95:100:110','10:20:35:50:65:85:115:155','50:100:150:200:250:300:350:400');
$tp='';

switch ($_POST['selecttype']){
		case 'w1': 
			 $param = Array('40-50:50-60:60-70:70-80:85-100','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','15:25:35:45:55:65:75:85:95:100:110','30:45:60:75:90:105:120:135:150:165:180:195:200','25:50:75:100:125:150:175:200');
            $dmgkb = "урон";
            $tp = $_POST['selecttype'];
            $type = "Меч";
		break;
		case 'w2': 
			$param = Array('35-60:45-70:55-80:65-90:84-111','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','15:25:35:45:55:65:75:85:95:100:110','30:45:60:75:90:105:120:135:150:165:180:195:200','25:50:75:100:125:150:175:200');
            $dmgkb = "урон";
            $tp = $_POST['selecttype'];
            $type = "Топор";
		break;
		case 'w3': 
			 $param = Array('40-60:50-70:60-80:70-90:92-113','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','15:25:35:45:55:65:75:85:95:100:110','30:45:60:75:90:105:120:135:150:165:180:195:200','25:50:75:100:125:150:175:200');
            $dmgkb = "урон";
            $tp = $_POST['selecttype'];
            $type = "Дробящее";
		break;
		case 'w4': 
			 $param = Array('15-25:25-40:40-55:55-70:75-94','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','15:25:35:45:55:65:75:85:95:100:110','30:45:60:75:90:105:120:135:150:165:180:195:200','25:50:75:100:125:150:175:200');
            $dmgkb = "урон";
            $tp = $_POST['selecttype'];
            $type = "Нож";
		break;
		case 'w5': 
			 $param = Array('35-60:45-70:55-80:65-95:95-105','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','15:25:35:45:55:65:75:85:95:100:110','30:45:60:75:90:105:120:135:150:165:180:195:200','25:50:75:100:125:150:175:200');
            $dmgkb = "урон";
            $tp = $_POST['selecttype'];
            $type = "Метательное";
		break;
		case 'w6': 
			 $param = Array('35-65:45-75:55-85:65-100:107-135','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','15:25:35:45:55:65:75:85:95:100:110','30:45:60:75:90:105:120:135:150:165:180:195:200','25:50:75:100:125:150:175:200');
            $dmgkb = "урон";
            $tp = $_POST['selecttype'];
            $type = "Алебарда";
		break;
		case 'w7': 
			 $param = Array('35-65:45-75:55-85:65-85:85-107','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','15:25:35:45:55:65:75:85:95:100:110','30:45:60:75:90:105:120:135:150:165:180:195:200','25:50:75:100:125:150:175:200');
            $dmgkb = "урон";
            $tp = $_POST['selecttype'];
            $type = "Посох";
		break;
		case 'w18': 
			 $param = Array('5-9:10-13:14-17:18-22:23-27','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','1:3:5:10:15:25:30:35:40:45:50','30:45:60:75:90:105:120:135:150:165:180:195:200','40:80:120:160:200:240:270:300');
            $dmgkb = "урон";
            $price[4] = "75:90:105:120:135:150:165:180:195:210:225";
            $tp = $_POST['selecttype'];
            $type = "Кольчуга";
            $price[6] = "80:160:240:320:400:480:540:600";
		break;
		case 'w19': 
			 $param = Array('5-9:10-13:14-17:18-22:23-27','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','1:3:5:10:15:25:30:35:40:45:50','50:70:100:130:150:170:200:250:300:350:400:450:500','60:120:180:240:300:360:420:500');
            $dmgkb = "урон";
            $price[4] = "75:90:105:120:135:150:165:180:195:210:225";
            $price[5] = "50:70:100:130:150:170:200:250:300:350:400:450:1000";
            $tp = $_POST['selecttype'];
            $type = "Доспех";
			 $price[6] = "120:240:360:480:600:720:840:1000";
			
		break;
		case 'w20': 
			 $param = Array('5-9:10-13:14-17:18-22:23-27','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','1:3:5:10:15:25:30:35:40:45:50','50:70:100:130:150:170:200:250:300:350:400:450:500','60:120:180:240:300:360:420:500');
            $dmgkb = "урон";
            $price[4] = "75:90:105:120:135:150:165:180:195:210:225";
            $price[5] = "50:70:100:130:150:170:200:250:300:350:400:450:1000";
            $tp = $_POST['selecttype'];
            $type = "Щит";
			 $price[6] = "120:240:360:480:600:720:840:1000";
		break;
		case 'w21': 
			 $param = Array('5-9:10-13:14-17:18-22:23-27','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','1:3:5:10:15:25:30:35:40:45:50','30:45:60:75:90:105:120:135:150:165:180:195:200','40:80:120:160:200:240:270:300');
            $dmgkb = "урон";
            $price[4] = "75:90:105:120:135:150:165:180:195:210:225";
            $tp = $_POST['selecttype'];
            $type = "Сапоги";
            $price[6] = "80:160:240:320:400:480:540:600";
			 
		break;
		case 'w22': 
			 $param = Array('5-9:10-13:14-17:18-22:23-27','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','25:30:35:40:45:50:55:60:65:70:75','10:20:30:40:50:60:70:80:90:100:110:120:130','40:80:120:160:200:240:270:300');
            $dmgkb = "урон";
            $price[4] = "75:90:105:120:135:150:165:180:195:210:225";
            $price[5] = "50:70:100:130:150:170:200:250:300:350:400:450:650";
            $tp = $_POST['selecttype'];
            $type = "Кольцо";
            $price[6] = "80:160:240:320:400:480:540:600";
		break;
		case 'w23': 
			 $param = Array('5-9:10-13:14-17:18-22:23-27','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','1:3:5:10:15:25:30:35:40:45:50','30:45:60:75:90:105:120:135:150:165:180:195:200','40:80:120:160:200:240:270:300');
            $dmgkb = "урон";
            $price[4] = "75:90:105:120:135:150:165:180:195:210:225";
            $tp = $_POST['selecttype'];
            $type = "Шлем";
            $price[6] = "80:160:240:320:400:480:540:600";
		break;
		case 'w24': 
			 $param = Array('5-9:10-13:14-17:18-22:23-27','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','1:3:5:10:15:25:30:35:40:45:50','30:45:60:75:90:105:120:135:150:165:180:195:200','40:80:120:160:200:240:270:300');
            $dmgkb = "урон";
            $price[4] = "75:90:105:120:135:150:165:180:195:210:225";
            $tp = $_POST['selecttype'];
            $type = "Перчатки";
            $price[6] = "80:160:240:320:400:480:540:600";
			 		
		break;
		case 'w25': 
			 $param = Array('5-9:10-13:14-17:18-22:23-27','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','1:3:5:10:15:25:30:35:40:45:50','30:45:60:75:90:105:120:135:150:165:180:195:200','40:80:120:160:200:240:270:300');
            $dmgkb = "урон";
            $price[4] = "75:90:105:120:135:150:165:180:195:210:225";
            $tp = $_POST['selecttype'];
            $type = "Кулон";
            $price[6] = "80:160:240:320:400:480:540:600";
			 
		break;
		case 'w26': 
			 $param = Array('5-9:10-13:14-17:18-22:23-27','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','1:3:5:10:15:25:30:35:40:45:50','30:45:60:75:90:105:120:135:150:165:180:195:200','40:80:120:160:200:240:270:300');
            $dmgkb = "урон";
            $price[4] = "75:90:105:120:135:150:165:180:195:210:225";
            $tp = $_POST['selecttype'];
            $type = "Пояс";
            $price[6] = "80:160:240:320:400:480:540:600";
			 
		break;
		case 'w28': 
			 $param = Array('5-9:10-13:14-17:18-22:23-27','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','1:3:5:10:15:25:30:35:40:45:50','30:45:60:75:90:105:120:135:150:165:180:195:200','40:80:120:160:200:240:270:300');
            $dmgkb = "урон";
            $price[4] = "75:90:105:120:135:150:165:180:195:210:225";
            $tp = $_POST['selecttype'];
            $type = "Наплечники";
            $price[6] = "80:160:240:320:400:480:540:600";
			 
		break;
		case 'w80': 
			 $param = Array('5-9:10-13:14-17:18-22:23-27','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','1:3:5:10:15:25:30:35:40:45:50','30:45:60:75:90:105:120:135:150:165:180:195:200','40:80:120:160:200:240:270:300');
            $dmgkb = "урон";
            $price[4] = "75:90:105:120:135:150:165:180:195:210:225";
            $tp = $_POST['selecttype'];
            $type = "Наручи";
            $price[6] = "80:160:240:320:400:480:540:600";
			
		break;	
		case 'w90': 
			 $param = Array('5-9:10-13:14-17:18-22:23-27','1:2:3:4:5:6:7:8:9:10:11:12:13:14:15:16:17:18:19:20','10:20:30:40:50:60:70:80:90:100:110:120:130:140:150:160:170:180:190:200','5:10:15:20:25:30:35:40:45:50','1:3:5:10:15:25:30:35:40:45:50','30:45:60:75:90:105:120:135:150:165:180:195:200','40:80:120:160:200:240:270:300');
            $dmgkb = "урон";
            $price[4] = "75:90:105:120:135:150:165:180:195:210:225";
            $tp = $_POST['selecttype'];
            $type = "Наколенники";
            $price[6] = "80:160:240:320:400:480:540:600";
		break;	
}
//просчет статов
	$damage = explode(":",$param[0]);
	$stats = explode(":",$param[1]);
	$modif = explode(":",$param[2]);
	$nav = explode(":",$param[3]);
	$proboi = explode(":",$param[4]);
	$armor = explode(":",$param[5]);
	$hp = explode(":",$param[6]);
	$val = "";
	//echo  $type."<br>";
    //урон
	if($_POST['damage']!='' and $_POST['damage']!='none'){
	//	echo $dmgkb.": ".$damage[intval($_POST['damage'])]."<br>";
		$val .= "'".$damage[intval($_POST['damage'])]."',";
		$temppr=explode(":",$price[0]);
		$pr+=$temppr[intval($_POST['damage'])];
	}
	else {$val .= "0,";}
    //броня
	if($_POST['armor']!='' and $_POST['armor']!='none'){
        //	echo "броня: ".$armor[intval($_POST['armor'])]."<br>";
		$val .= $armor[intval($_POST['armor'])].",";
		$temppr=explode(":",$price[5]);
		$pr+=$temppr[intval($_POST['armor'])];
	}
	else {$val .= "0,";}
//	пробой
	if($_POST['proboi']!='' and $_POST['proboi']!='none'){
        //	echo "пробой брони: ".$proboi[intval($_POST['proboi'])]."<br>";
		$val .= $proboi[intval($_POST['proboi'])].",";
		$temppr=explode(":",$price[4]);
		$pr+=$temppr[intval($_POST['proboi'])];
	}
	else {$val .= "0,";}
	if($_POST['hp']!='' and $_POST['hp']!='none'){
	//	echo "HP: ".$hp[intval($_POST['hp'])]."<br>";
		$val .= $hp[intval($_POST['hp'])].",";
		$temppr=explode(":",$price[6]);
		echo $temppr[intval($_POST['hp'])];
		$pr+=$temppr[intval($_POST['hp'])];
	}
	else {$val .= "0,";}
    //статы
	if($_POST['sila']!='' and $_POST['sila']!='none'){
        //	echo "Мощь: ".$stats[intval($_POST['sila'])]."<br>";
		$val .= $stats[intval($_POST['sila'])].",";
		$temppr=explode(":",$price[1]);
		$pr+=$temppr[intval($_POST['sila'])];
	}
	else {$val .= "0,";}
	if($_POST['lovkost']!='' and $_POST['lovkost']!='none'){
        //	echo "Проворность: ".$stats[intval($_POST['lovkost'])]."<br>";
		$val .= $stats[intval($_POST['lovkost'])].",";
		$temppr=explode(":",$price[1]);
		$pr+=$temppr[intval($_POST['lovkost'])];
	}
	else {$val .= "0,";}
	if($_POST['udacha']!='' and $_POST['udacha']!='none'){
        //	echo "Везение: ".$stats[intval($_POST['udacha'])]."<br>";
		$val .= $stats[intval($_POST['udacha'])].",";
		$temppr=explode(":",$price[1]);
		$pr+=$temppr[intval($_POST['udacha'])];
	}
	else {$val .= "0,";}
	if($_POST['znan']!='' and $_POST['znan']!='none'){
        //	echo "Разум: ".$stats[intval($_POST['znan'])]."<br>";
		$val .= $stats[intval($_POST['znan'])].",";
		$temppr=explode(":",$price[1]);
		$pr+=$temppr[intval($_POST['znan'])];
	}
	else {$val .= "0,";}
    //модификаторы
	if($_POST['ylov']!='' and $_POST['ylov']!='none'){
        //	echo "уловка: ".$modif[intval($_POST['ylov'])]."<br>";
		$val .= $modif[intval($_POST['ylov'])].",";
		$temppr=explode(":",$price[2]);
		$pr+=$temppr[intval($_POST['ylov'])];
	}
	else {$val .= "0,";}
	if($_POST['toch']!='' and $_POST['toch']!='none'){
        //	echo "точность: ".$modif[intval($_POST['toch'])]."<br>";
		$val .= $modif[intval($_POST['toch'])].",";
		$temppr=explode(":",$price[2]);
		$pr+=$temppr[intval($_POST['toch'])];
	}
	else {$val .= "0,";}
	if($_POST['sokr']!='' and $_POST['sokr']!='none'){
        //	echo "сокрушение: ".$modif[intval($_POST['sokr'])]."<br>";
		$val .= $modif[intval($_POST['sokr'])].",";
		$temppr=explode(":",$price[2]);
		$pr+=$temppr[intval($_POST['sokr'])];
	}
	else {$val .= "0,";}
	if($_POST['stoi']!='' and $_POST['stoi']!='none'){
        //	echo "стойкость: ".$modif[intval($_POST['stoi'])]."<br>";
		$val .= $modif[intval($_POST['stoi'])].",";
		$temppr=explode(":",$price[2]);
		$pr+=$temppr[intval($_POST['stoi'])];
	}
	else {$val .= "0,";}
    //умения
	$i = 0;
	$temppr=explode(":",$price[3]);
	while ($i <= 33){
		if($nav[$_POST['nav'.$i.'']]!='' and $nav[$_POST['nav'.$i.'']]!='none'){
		//	echo "".$nar[$i].": ".$nav[intval($_POST['nav'.$i.''])]."<br>";
			$navval .= $nav[intval($_POST['nav'.$i.''])]."|";
			$pr+=$temppr[intval($_POST['nav'.$i.''])];
		}
		else {$navval .= "|";}
		$i++;
	}
//echo $val."<br>";
//echo $navval."<br>";
//echo $pr."<br>";
//echo chars($_POST['artname'])."<br>";
$z=0;
foreach($koeff as $key=>$value){
	$k=explode(":",$koeff[$key]);
	if($k[0] < $pr){$z++;}
}
if($pr>0){
//echo "koeff: ".$z;
    mysqli_query($GLOBALS['db_link'], "INSERT INTO art_zayav (type,damage,armor,proboi,hp,sila,lovkost,udacha,znan,ylov,toch,sokr,stoi,nav,pl_id,name,price,koeff,cr_time) VALUES ('" . $tp . "'," . $val . "'" . $navval . "'," . $player['id'] . ",'" . $name . "'," . $pr . "," . $z . "," . time() . ");");
	}
}

