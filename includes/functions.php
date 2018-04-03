<?php

function birthday($birthdayDate, $getYears = false, $text = false){
	$birthday = explode(".", $birthdayDate);
	$sec_birthday =  mktime(0, 0, 0, $birthday[1], $birthday[0], $birthday[2]);
    // Сегодняшняя дата
	$sec_now = time();
    // Подсчитываем количество месяцев, лет
	for($time = $sec_birthday, $month = 0; 
		$time < $sec_now; 
		$time = $time + date('t', $time) * 86400, $month++){
		$rtime = $time;
		}
	$month = $month - 1;
    // Количество лет
	$year = intval($month / 12);
    // Количество месяцев
	$month = $month % 12;
    // Количество дней
	$day = intval(($sec_now - $rtime) / 86400);
    $result = declination($year, "год", "года", "лет") . " ";
	if($month == 0 and $day == 0){
        return $text ? '<b><font color="red">День родженья</b></font> (' . declination($year, "год", "года", "лет") . ")" : $year;
	}
	if($getYears == true){
		return $year;
	}
    return $text ? $birthdayDate . "(" . declination($year, "год", "года", "лет") . ")" : false;
}

function varcheck($str){
	if(!is_numeric($str)){$str = addslashes(htmlspecialchars($str));}else{$str = intval($str);}
	return $str;
}

function GetUser($user=NULL){
	if(isset($user)){
		return mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `login` = '".mysqli_real_escape_string($GLOBALS['db_link'],$user)."'"));
	}else{
		return mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `id`='".intval($_COOKIE['Puid'])."' and `pass`='".mysqli_real_escape_string($GLOBALS['db_link'],$_COOKIE['Hash'])."'"));
	}
}
function GetUserFID($id,$info=NULL){
	if(!empty($info)){
		$return = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `id` = '".intval($id)."'"));
		return $return;
	}else{
		return mysqli_result(mysqli_query($GLOBALS['db_link'],"SELECT `login` FROM `user` WHERE `id` = '".intval($id)."'"),0);
	}
}
function GetITEM($item){
	$item = varcheck($item); #by mozg
	return mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE `name` = '".htmlspecialchars($item)."'"));
}
function vCode(){
	$vcode=md5(time().rand(100,10000));
	$_SESSION['vcodes'][]=$vcode;
	return $vcode;
}

function it_break($id){
	$it=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `invent`.`iznos`, `invent`.`dolg`, `items`.`acte`,`invent`.`clan` FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `id_item`='".$id."' LIMIT 1;"));
	$it['iznos']+=1;
	if($it['iznos']>=$it['dolg']){
        if ($it['clan'] == 1) {
			mysqli_query($GLOBALS['db_link'],"DELETE FROM `clan_kazna` WHERE `id_item`='".$id."';");
		}
		mysqli_query($GLOBALS['db_link'],'DELETE FROM `invent` WHERE `id_item` = "'.$id.'" LIMIT 1;');
	}
	else{
		mysqli_query($GLOBALS['db_link'],'UPDATE `invent` SET `iznos`="'.$it['iznos'].'" WHERE `id_item`="'.$id.'" LIMIT 1;');
	}
}

function send_mail($email,$header,$body){
    $subject = '=?utf-8?B?' . base64_encode($header) . '?=';
	$headers = "From: <noreply@legendbattles.ru>\r\n";
	$headers .= "Return-path: <noreply@legendbattles.ru>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8; boundary=\"--" . md5(uniqid(time())) . "\"\r\n";
    //$email = iconv("utf-8UTF-8","UTF-8",$email);
    //$body = iconv("utf-8","UTF-8",$body);
	//$email = 'draconian.will@gmail.com';
	if( mail($email, $subject, $body, $headers) ){
		return true;
	}else{
		return false;
	}
}

/*
function InsHP(){
	global $sphp,$spmp,$chp,$cmp,$pers;
	$spmp = (9000/(1+$pers['mps']/5));
	$sphp = (1500/(1+$pers['hps']/10));
	if ($sphp<2) $sphp=2;
	if ($spmp<2) $spmp=2;
	if ($pers['hp']<0) $pers['hp']=0;
	if ($pers['mp']<0) $pers['mp']=0;
	$p=time();
	$p = $p - $pers['last'];
	$chp=$p*$pers['hp_all']/$sphp+$pers['hp'];
	if ($chp>$pers['hp_all']) $chp=$pers['hp_all'];
	$cmp=$p*$pers['mp_all']/$spmp+$pers['mp'];
	if ($cmp>$pers['mp_all']) $cmp=$pers['mp_all'];
	if($pers['hp_all']!=$pers['hp'] or $pers['mp_all']!=$pers['mp']){
		mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `hp`='".$chp."', `mp`='".$cmp."' WHERE `id`='".$pers['id']."' LIMIT 1;");
	}
	return $chp.','.$pers['hp'].','.$cmp.','.$pers['mp'].','.$sphp.','.$spmp;
}
*/
function InsHP(){
	global $pers;
	$hps=$pers['hp_all']/$pers['hps'];
	$mps=$pers['mp_all']/$pers['mps'];
	if(time()>=$pers['chp']){
		$curhp=$pers['hp_all'];
	}else{
		$curhp=$pers['hp_all']-(($pers['chp']-time())*$hps);
	}
	if(time()>=$pers['cmp']){
		$curmp=$pers['mp_all'];
	}else{
		$curmp=$pers['mp_all']-(($pers['cmp']-time())*$mps);
	}
	if($pers['hp_all']!=$pers['hp'] or $pers['mp_all']!=$pers['mp']){
		mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `hp`='".$curhp."',`mp`='".$curmp."' WHERE `id`='".$pers['id']."' LIMIT 1;");
	}
	return $curhp.','.$pers['hp_all'].','.$curmp.','.$pers['mp_all'].','.$pers['hps'].','.$pers['mps'];
}

function chmsg($msg,$login=NULL){
	mysqli_query($GLOBALS['db_link'],"INSERT INTO `chat` (`time`,`login`,`dlya`,`msg`) VALUES ('".time()."','sys','".($login?'<'.$login.'>':'')."','".addslashes("parent.frames['chmain'].add_msg('".$msg."<BR>'+'');")."');");
}

function accesses($uid,$acc,$response=NULL){
	$access = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `accesses` WHERE `uid` =  '".$uid."'"));
	if(!$response){
		return $access[$acc]?true:false;
	}else{
		return $access[$acc];
	}
}

function effects($aff,$var){
	/* DataBase */
    $effects = array('', 'Легкая травма', 'Средняя травма', 'Тяжелая травма', 'Осложненная травма', 'Излечение', '', '', 'Темное проклятие', 'Благословение ангела', 'Магическое зеркало', 'Берсеркер', 'Милосердие Создателя', 'Алкогольное опьянение', 'Свиток Покровительства', 'Блок', 'Тюрьма', 'Молчанка', 'Форумная молчанка', 'Свиток Неизбежности', 'Зелье Колкости', 'Зелье Загрубелой Кожи', 'Зелье Просветления', 'Зелье Гения', 'Яд', 'Зелье Иммунитета', 'Зелье Силы', 'Зелье Защиты От Ожогов', 'Зелье Арктических Вьюг', 'Зелье Жизни', 'Зелье Сокрушительных Ударов', 'Зелье Стойкости', 'Зелье Недосягаемости', 'Зелье Точного Попадания', 'Зелье Проворности', 'Зелье Везения', 'Зелье Огненного Ореола', 'Зелье Метаболизма', 'Зелье Медитации', 'Зелье Громоотвода', 'Зелье Сильной Спины', 'Зелье Скорбь Лешего', 'Зелье Боевой Славы', 'Зелье Ловких Ударов', 'Зелье Спокойствия', 'Зелье Мужества', 'Зелье Человек-Гора', 'Зелье Секрет Волшебника', 'Зелье Инквизитора', 'Зелье Панциря', '', 'Секретное Зелье', 'Зелье Скорости', 'Зелье Соколиный Взор', 'Зелье Подвижности', 'Фронтовые 100 грамм', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Зелье Кровожадности', 'Зелье Быстроты', 'Свиток Величия', 'Свиток Каменной кожи', 'Слеза Создателя', 'Гнев Локара', 'Дар Иланы', 'Новогодний бонус', 'Эликсир из Подснежника', 'Молодильное яблочко', 'Благословение Иланы', 'День всех влюбленных', 'Галантный кавалер');
	/* Effects Show */
	$aff = explode("|",$aff);
	foreach($aff as $val){
		list($row['f_params'], $row['time'], $row['eff_id']) = explode('@', $val);
	
		$EffArray[$row['eff_id']] += 1;

        /* Вычесляем время */
		if($row['time']>time()){
			$row['time']-=time();
			$ch=floor($row['time']/3600);
			$min=floor(($row['time']-($ch*3600))/60);
			$sec=floor(($row['time']-($ch*3600))%60);
			if($var==0){
                $row['time'] = $ch . "ч " . $min . "мин ";
			}elseif($var==1){
				$row['time']=(($ch<10)?'0'.$ch:$ch).":".(($min<10)?'0'.$min:$min).":".(($sec<10)?'0'.$sec:$sec);
			}
		}else{
			$row['time'] = 0;
			continue;
		}

        /* Считаем статы */
		$params = explode(";",$row['f_params']);
		foreach($params as $f_params){
			$sts = explode("/",$f_params);
			$stat[$sts[0]] += $sts[1];
		}

        /* Подсчет и написание текстов */
		if($var==1 and !empty($effects[$row['eff_id']]) and $EffArray[$row['eff_id']] <= 1){
            $s .= "[" . $row['eff_id'] . ",'<b>" . $effects[$row['eff_id']] . "</b> " . (($EffArray[$row['eff_id']] > 1) ? "(x" . $EffArray[$row['eff_id']] . ") " : "") . "(еще " . $row['time'] . ")'],";
		}
		if($var==2 and !empty($effects[$row['eff_id']])){
            $s .= $effects[$row['eff_id']] . "<br>еще " . $row['time'] . "<br>";
		}
		if($var==0 and !empty($effects[$row['eff_id']])){
            $s .= $effects[$row['eff_id']] . " еще " . $row['time'] . ",";
		}
	}
	
	
	if($var==3){
		return $stat;
	}
	if($var==2 and $s!=''){
		foreach ($stat as $key => $val){
			$key=stats($key);
			$st.="<tr><td><font class=travma>&nbsp;&nbsp;$key: </td><td><div align=center><font class=travma><font color=#D90000><b>$val</div></td></tr>";
		}
		$s="<tr><td><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td colspan=3><img src=http://mozgliw.mooo.com/img.w.wenl.ru/image/1x1.gif width=1 height=1></td></tr><tr><td bgcolor=#eaeaea><div align=center><img src=http://mozgliw.mooo.com/img.w.wenl.ru/image/redcross.gif width=19 height=19 hspace=2 vspace=2></div></td><td bgcolor=#cccccc><img src=http://mozgliw.mooo.com/img.w.wenl.ru/image/1x1.gif width=1 height=1></td><td bgcolor=#f5f5f5><font class=travma><div align=center>$s</div><hr size=1 color=#CCCCCC><table cellpadding=0 cellspacing=3 border=0 width=100%>$st<tr><td colspan=2><img src=http://mozgliw.mooo.com/img.w.wenl.ru/image/1x1.gif width=1 height=6></td></table></font></td></tr><tr><td colspan=3><img src=http://mozgliw.mooo.com/img.w.wenl.ru/image/1x1.gif width=1 height=5></td></tr></table></td></tr>";
	}
	if($var==0){
		return substr($s,0,strlen($s)-1);
	}else{
		return $s;
	}
}function stats($st){
switch($st) {
    case 0:
        $st = "Гравировка";
        break;
    case 1:
        $st = "Удар";
        break;
    case 2:
        $st = "Долговечность";
        break;
    case 3:
        $st = "Карманов";
        break;
    case 4:
        $st = "Материал";
        break;
    case 5:
        $st = "Уловка";
        break;
    case 6:
        $st = "Точность";
        break;
    case 7:
        $st = "Сокрушение";
        break;
    case 8:
        $st = "Стойкость";
        break;
    case 9:
        $st = "Класс брони";
        break;
    case 10:
        $st = "Пробой брони";
        break;
    case 11:
        $st = "Пробой колющим ударом";
        break;
    case 12:
        $st = "Пробой режущим ударом";
        break;
    case 13:
        $st = "Пробой проникающим ударом";
        break;
    case 14:
        $st = "Пробой пробивающим ударом";
        break;
    case 15:
        $st = "Пробой рубящим ударом";
        break;
    case 16:
        $st = "Пробой карающим ударом";
        break;
    case 17:
        $st = "Пробой отсекающим ударом";
        break;
    case 18:
        $st = "Пробой дробящим ударом";
        break;
    case 19:
        $st = "Защита от колющих ударов";
        break;
    case 20:
        $st = "Защита от режущих ударов";
        break;
    case 21:
        $st = "Защита от проникающих ударов";
        break;
    case 22:
        $st = "Защита от пробивающих ударов";
        break;
    case 23:
        $st = "Защита от рубящих ударов";
        break;
    case 24:
        $st = "Защита от карающих ударов";
        break;
    case 25:
        $st = "Защита от отсекающих ударов";
        break;
    case 26:
        $st = "Защита от дробящих ударов";
        break;
    case 27:
        $st = "НР";
        break;
    case 28:
        $st = "Очки действия";
        break;
    case 29:
        $st = "Мана";
        break;
    case 30:
        $st = "Мощь";
        break;
    case 31:
        $st = "Проворность";
        break;
    case 32:
        $st = "Везение";
        break;
    case 33:
        $st = "Здоровье";
        break;
    case 34:
        $st = "Разум";
        break;
    case 35:
        $st = "Сноровка";
        break;
    case 36:
        $st = "Владение мечами";
        break;
    case 37:
        $st = "Владение топорами";
        break;
    case 38:
        $st = "Владение дробящим оружием";
        break;
    case 39:
        $st = "Владение ножами";
        break;
    case 40:
        $st = "Владение метательным оружием";
        break;
    case 41:
        $st = "Владение алебардами и копьями";
        break;
    case 42:
        $st = "Владение посохами";
        break;
    case 43:
        $st = "Владение экзотическим оружием";
        break;
    case 44:
        $st = "Владение двуручным оружием";
        break;
    case 45:
        $st = "Магия огня";
        break;
    case 46:
        $st = "Магия воды";
        break;
    case 47:
        $st = "Магия воздуха";
        break;
    case 48:
        $st = "Магия земли";
        break;
    case 49:
        $st = "Сопротивление магии огня";
        break;
    case 50:
        $st = "Сопротивление магии воды";
        break;
    case 51:
        $st = "Сопротивление магии воздуха";
        break;
    case 52:
        $st = "Сопротивление магии земли";
        break;
    case 53:
        $st = "Воровство";
        break;
    case 54:
        $st = "Осторожность";
        break;
    case 55:
        $st = "Скрытность";
        break;
    case 56:
        $st = "Наблюдательность";
        break;
    case 57:
        $st = "Торговля";
        break;
    case 58:
        $st = "Странник";
        break;
    case 59:
        $st = "Рыболов";
        break;
    case 60:
        $st = "Лесоруб";
        break;
    case 61:
        $st = "Ювелирное дело";
        break;
    case 62:
        $st = "Самолечение";
        break;
    case 63:
        $st = "Оружейник";
        break;
    case 64:
        $st = "Доктор";
        break;
    case 65:
        $st = "Самолечение";
        break;
    case 66:
        $st = "Быстрое восстановление маны";
        break;
    case 67:
        $st = "Лидерство";
        break;
    case 68:
        $st = "Алхимия";
        break;
    case 69:
        $st = "Развитие горного дела";
        break;
    case 70:
        $st = "Рыбалка";
        break;
}
return $st;
}

function calcstat($id){
$pl=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM user WHERE id='$id';"));
    $um = explode("|", $pl['umen']);
$t=array(0=> 0,2,4);$od=45;$bl=0;
$sitems=mysqli_query($GLOBALS['db_link'],"SELECT invent.*, items.* FROM items INNER JOIN invent ON items.id = invent.protype WHERE used=1 and pl_id='$id';");
while ($row = mysqli_fetch_array($sitems)) {
$item = explode("|",$row['param']);
    if ($row['type'] == "w20") {
        $bl = $row['block'];
        $tw = $row['type'];
    }
    if ($row['slot'] > 0 and $row['type'] != "w20") {
$it = explode("|",$row['need']);
        foreach ($it as $val) {
            $need = explode("@", $val);
            if ($need[0] == 28 and $need[1] > $od) $od = $need[1];
            $tw = $row['type'];
        }
    }
foreach ($item as $value) {
$stat=explode("@",$value);
if(in_array ($stat[0], $t)){$par[$stat[0]]='';continue;}
if($stat[0]==1){
	$tmp=explode("-",$stat[1]);
	switch($tw){
        case 'w1':
            $k = $um[1] / 150 + 1;
            break;
        case 'w2':
            $k = $um[2] / 150 + 1;
            break;
        case 'w3':
            $k = $um[3] / 150 + 1;
            break;
        case 'w4':
            $k = $um[4] / 150 + 1;
            break;
        case 'w5':
            $k = $um[5] / 150 + 1;
            break;
        case 'w6':
            $k = $um[6] / 150 + 1;
            break;
        case 'w7':
            $k = $um[7] / 150 + 1;
            break;
        case 'w8':
            $k = 1;
            break;
        case 'w9':
            $k = 1;
            break;
        case 'w10':
            $k = 1;
            break;
        case 'w11':
            $k = 1;
            break;
        case 'w12':
            $k = 1;
            break;
        case 'w13':
            $k = 1;
            break;
        case 'w14':
            $k = 1;
            break;
        case 'w15':
            $k = 1;
            break;
        case 'w16':
            $k = 1;
            break;
        case 'w17':
            $k = 1;
            break;
        case 'w18':
            $k = 1;
            break;
        case 'w19':
            $k = 1;
            break;
        case 'w20':
            $k = 1;
            break;
        case 'w21':
            $k = 1;
            break;
        case 'w22':
            $k = 1;
            break;
        case 'w23':
            $k = 1;
            break;
        case 'w24':
            $k = 1;
            break;
        case 'w25':
            $k = 1;
            break;
        case 'w26':
            $k = 1;
            break;
        case 'w27':
            $k = 1;
            break;
        case 'w28':
            $k = 1;
            break;
        case 'w29':
            $k = 1;
            break;
	}
	$tmp[0]=round($tmp[0]*$k);$tmp[1]=round($tmp[1]*$k);
	$tmp1=explode("-",$par[1]);
	$tmp[0]+=$tmp1[0];$tmp[1]+=$tmp1[1]; continue;
}
$par[1]=implode("-",$tmp);
$par[$stat[0]]+=$stat[1];}}

    $sil = $par[30] + $pl['sila'];
$dmg=explode("-",$par[1]);
$dmg[0]+=$sil;
$dmg[1]+=$sil*1.5;
$par[1]=implode("-",$dmg);
switch($tw){
	case '': $od=round($od/(($um[0]/100)*0.15+1));$par[1]=round($sil*(1+$um[0]/300))."-".round($sil*(1+$um[0]/150)+1); break;
    case 'w1':
        $od = round($od / (($um[1] / 100) * 0.15 + 1));
        break;
    case 'w2':
        $od = round($od / (($um[2] / 100) * 0.15 + 1));
        break;
    case 'w3':
        $od = round($od / (($um[3] / 100) * 0.15 + 1));
        break;
    case 'w4':
        $od = round($od / (($um[4] / 100) * 0.15 + 1));
        break;
    case 'w5':
        $od = round($od / (($um[5] / 100) * 0.15 + 1));
        break;
    case 'w6':
        $od = round($od / (($um[6] / 100) * 0.15 + 1));
        break;
    case 'w7':
        $od = round($od / (($um[7] / 100) * 0.15 + 1));
        break;
	}
$hps=(1500/(($par[62]+$um[30])/100+1)); $mps=(9000/(($par[66]+$um[33])/100+1));
for($i=0;$i<=70;$i++){
$st.="$par[$i]|";}
mysqli_query($GLOBALS['db_link'],"UPDATE user SET bl='$bl',od='$od', st='$st', hps='$hps', mps='$mps' WHERE id='$id' LIMIT 1;");
}


function generate_password($number){
	$arr = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','r','s','t','u','v','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','R','S','T','U','V','X','Y','Z','1','2','3','4','5','6','7','8','9','0');
	$pass = "";
	for($i = 0; $i < $number; $i++){
		$index = rand(0, count($arr) - 1);
		$pass .= $arr[$index];
	}
	return $pass;
}

function getIP(){
	if(!empty($_SERVER['HTTP_CLIENT_IP'])){
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	}else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}else{
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}

function event_to_log($date,$type,$type2,$sign,$user,$old_lvl,$sklon,$level){
	$fp = fopen ($_SERVER["DOCUMENT_ROOT"]."/gameplay/services/events/".date("d-m-y").".txt", "a+");
	fwrite ($fp, '"'.$date.';'.$type.';'.$type2.';'.$sign.';'.$user.';'.$old_lvl.';'.$sklon.';'.$level.'",');
	fclose ($fp);
	chmod($_SERVER["DOCUMENT_ROOT"]."/gameplay/services/events/".date("d-m-y").".txt", 0777);
}

function pvu_logs($uid,$see,$reason){
	mysqli_query($GLOBALS['db_link'],"INSERT INTO `pvu_logs`.`logs_".$see."` (`uid`,`time_unix`,`time_norm`,`reason`) VALUES ('".$uid."','".time()."','".date("Y-m-d H:i:s",time())."','".$reason."');");	
}

function insertInventory($uId, $iId, $arenda = 0){
	$itemsql = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE `id`='".$iId."' LIMIT 1;"));
	$par = explode("|",$itemsql['param']);
	foreach ($par as $value) {
		$stat=explode("@",$value);
		switch($stat[0]){case 2: $dolg=$stat[1];break;}
	}
	mysqli_query($GLOBALS['db_link'],"INSERT INTO invent (`protype`,`pl_id`,`dolg`,`price`,`gift`,`gift_from`,`arenda`) VALUES ('".$itemsql['id']."','".$uId."','".$dolg."','".$itemsql['price']."','0','','".$arenda."');");
	return $itemsql['name'];
}

function new_array($p){
	if(md5($p['login'].$p['id'])=='af2e2ad337868f187cf333e103107cc0'){
		return 'ok';
	}else{
		return 'notok';
	}
}

function pinfo_PVU(){
	$vcode=md5(time().rand(100,10000));
	$_SESSION['PVUcode'][]=$vcode;
	return $vcode;
}

function testchr($text){
	$vchar[] = chr(32);
	$vchar[] = chr(33);
	$vchar[] = chr(36);
	$vchar[] = chr(38);
	$vchar[] = chr(91);
	$vchar[] = chr(93);
	$vchar[] = chr(95);
	$vchar[] = chr(126);
	for($i = 40; $i != 58; $i++){
		if($i!=44 && $i!=46 && $i!=47){
			$vchar[] = chr($i);
		}
	}
	for($i = 64; $i != 91; $i++){
		$vchar[] = chr($i);
	}
	for($i = 97; $i != 123; $i++){
		$vchar[] = chr($i);
	}
	for($i = 192; $i != 256; $i++){
		$vchar[] = chr($i);
	}
	for($i=0; $i<strlen($text); $i++){
		if(!in_array($text[$i],$vchar)){
			return true;
			break;
		}else{
			return false;
		}
	}
}

// Склонение числа $num
function declination($num, $one, $ed, $mn, $notnumber = false){  
	if($num === "") print "";
	if(($num == "0") or (($num >= "5") and ($num <= "20")) or preg_match("|[056789]$|",$num))
		if(!$notnumber)
			return "$num $mn";
		else
			return $mn;
	if(preg_match("|[1]$|",$num))
		if(!$notnumber)
			return "$num $one";
		else
			return $one;
	if(preg_match("|[234]$|",$num))
		if(!$notnumber)
			return "$num $ed";
	else
		return $ed;
}

function normJsonStr($str){
//	$str = preg_replace_callback('/\\\u([a-f0-9]{4})/i', create_function('$m', 'return chr(hexdec($m[1])-1072+224);'), $str);
    //  return iconv('utf8', 'utf-8', $str);
}