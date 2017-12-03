<? 

switch ($ud[1]) {
    case 0: $damage=rand($player['sila'],$player['sila']*1.6)*$s;break; //простой
	case 1: $damage=rand($player['sila'],$player['sila']*2)*$s;break; //усиленный
	case 2: $damage=1;//спирит
	case 3: $damage=1;//минд бласт
}


?>