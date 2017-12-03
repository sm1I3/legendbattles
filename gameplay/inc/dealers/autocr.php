<?
$_POST['artname']=varcheck($_POST['artname']);
$row=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM art_zayav WHERE id=".intval($_POST['id']).";"));
$wtor = 0;
$block = 0;
$par="2@1000|";
$treb = "71|72|31@5|32@5|33@5";
	switch($row['type']){
		case 'w1':
            $type = "Меч";
            $slot = 3;
			$treb.="|28@50";
		break;
		case 'w2':
            $type = "Топор";
            $slot = 3;
            $treb .= "|28@55";
		break;
		case 'w3':
            $type = "Дробящее";
            $slot = 3;
            $treb .= "|28@60";
		break;
		case 'w4':
            $type = "Нож";
            $slot = 3;
            $treb .= "|28@40";
			$wtor = 1;
		break;
		case 'w5':
            $type = "Метательное";
            $slot = 3;
            $treb .= "|28@50";
		break;
		case 'w6':
            $type = "Алебарда";
            $slot = 3;
            $treb .= "|28@60";
		break;
		case 'w7':
            $type = "Посох";
            $slot = 3;
            $treb .= "|28@50";
		break;
		case 'w18':
            $type = "Кольчуга";
            $slot = 17;
		break;
		case 'w19':
            $type = "Доспех";
            $slot = 16;
		break;
		case 'w20':
            $type = "Щит";
            $slot = 13;
            $treb .= "|28@70";
			 $block=90;	
		break;
		case 'w21':
            $type = "Сапоги";
            $slot = 8;
		break;
		case 'w22':
            $type = "Кольцо";
            $slot = 14;
		break;
		case 'w23':
            $type = "Шлем";
            $slot = 1;
		break;
		case 'w24':
            $type = "Перчатки";
            $slot = 12;
		break;
		case 'w25':
            $type = "Кулон";
            $slot = 2;
		break;
		case 'w26':
            $type = "Пояс";
            $slot = 4;
		break;
		case 'w28':
            $type = "Наплечники";
            $slot = 10;
		break;
		case 'w80':
            $type = "Наручи";
            $slot = 11;
		break;	
		case 'w90':
            $type = "Наколенники";
            $slot = 9;
		break;	
		}
//статы
		if ($row['damage']!=0){
			$par.="1@".$row['damage']."|";
		}
		if($row['sila']!=0){
			$par.="30@".$row['sila']."|";
		}
		if($row['lovkost']!=0){
			$par.="31@".$row['lovkost']."|";
		}	
		if($row['udacha']!=0){
			$par.="32@".$row['udacha']."|";
		}	
		if($row['znan']!=0){
			$par.="34@".$row['znan']."|";
		}
//мф
		if($row['ylov']!=0){
			$par.="5@".$row['ylov']."|";
		}	
		if($row['toch']!=0){
			$par.="6@".$row['toch']."|";
		}	
		if($row['sokr']!=0){
			$par.="7@".$row['sokr']."|";
		}	
		if($row['stoi']!=0){
			$par.="8@".$row['stoi']."|";
		}
//пробой и броня
		if($row['armor']!=0){
			$par.="9@".$row['armor']."|";
		}
		if($row['proboi']!=0){
			$par.="10@".$row['proboi']."|";
		}
		if($row['koeff']!=0){
			$par.="71@".$row['koeff']."|";
		}
		if($row['hp']!=0){
			$par.="27@".$row['hp']."|";
		}
if($row['nav']!=''){
	$nav=explode("|",$row['nav']);
	$i=1;
	while($i <= 9){
		if($nav[$i]!=''){
			$par.=($i+35)."@".$nav[$i]."|";
		}
		$i++;
	}
	$i=21;
	while($i <= 33){
		if($nav[$i]!='' and $i!=33){
			$par.=($i+32)."@".$nav[$i]."|";
		}
		if($nav[$i]!='' and $i == 33){
			$par.=($i+33)."@".$nav[$i]."|";
		}
		$i++;
	}
}
$par=substr_replace($par, '', -1);
mysqli_query($GLOBALS['db_link'],"INSERT INTO items (gif,name,block,2w,type,param,need,acte,num_a,level,price,dd_price,massa,slot,effect) VALUES ('i_".$row['type']."_101.gif' , '".$_POST['artname']."' , '".$block."' , ".$wtor." , '".$row['type']."' , '".$par."' , '".$treb."' , '' , '' , 3 , 0 , ".$row['price']." , 7 , ".$slot." ,'');");
mysqli_query($GLOBALS['db_link'],"UPDATE art_zayav SET compl='1',name='".$_POST['artname']."' WHERE id=".intval($_POST['id'])." ;");

?>