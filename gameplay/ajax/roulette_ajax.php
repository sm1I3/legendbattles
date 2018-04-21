<?php
#GLOBALS OFF
header('Content-type: text/html; charset=UTF-8');
include($_SERVER["DOCUMENT_ROOT"] . "/app/system/config.php");
include($_SERVER["DOCUMENT_ROOT"]."/includes/functions.php");

$pers = GetUser($_SESSION['user']['login']);

$roulette = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `module_slot_status` WHERE `roulette_id` = '1'"));

if(isset($_GET['vcode'])){
	$comb = array(
		0 => array(array(3, 4, 5), array(3, 5, 4), array(3, 5, 5), array(4, 3, 5), array(4, 5, 3), array(4, 5, 5), array(5, 3, 4), array(5, 4, 3), array(5, 5, 3), array(5, 5, 4)),
		1 => array(array(1, 3, 4), array(1, 3, 5), array(1, 4, 3), array(1, 4, 5), array(1, 5, 5), array(3, 1, 4), array(3, 1, 5), array(3, 4, 1), array(3, 5, 1), array(4, 1, 3), array(4, 1, 5), array(4, 3, 1), array(4, 5, 1), array(5, 1, 3), array(5, 1, 4), array(5, 1, 5), array(5, 3, 1), array(5, 4, 1), array(5, 5, 1)),
		2 => array(array(1, 1, 3), array(1, 1, 4), array(1, 1, 5), array(1, 3, 1), array(1, 4, 1), array(1, 5, 1), array(3, 1, 1), array(4, 1, 1), array(5, 1, 1)),
		3 => array(array(1, 1, 1)),
		4 => array(array(2, 3, 4), array(2, 3, 5), array(2, 4, 3), array(2, 4, 5), array(2, 5, 5), array(3, 2, 4), array(3, 2, 5), array(3, 4, 2), array(3, 5, 2), array(4, 2, 3), array(4, 2, 5), array(4, 3, 2), array(4, 5, 2), array(5, 2, 3), array(5, 2, 4), array(5, 2, 5), array(5, 3, 2), array(5, 4, 2), array(5, 5, 2)),
		5 => array(array(2, 2, 3), array(2, 2, 4), array(2, 2, 5), array(2, 3, 2), array(2, 4, 2), array(2, 5, 2), array(3, 2, 2), array(4, 2, 2), array(5, 2, 2)), 
		6 => array(array(2, 2, 2)), 
		7 => array(array(3, 3, 4), array(3, 3, 5), array(3, 4, 3), array(3, 5, 3), array(4, 3, 3), array(5, 3, 3)),
		8 => array(array(3, 3, 3)),
		9 => array(array(4, 4, 3), array(4, 4, 5), array(3, 4, 4), array(5, 4, 4), array(4, 3, 4), array(4, 5, 4)),
		10 => array(array(4, 4, 4)),
		11 => array(array(5, 5, 5)) 
	);
	$comb_chance = array(1 => 16, 2 => 8, 3 => 0.3, 4 => 2, 5 => 0.3, 6 => 0.018, 7 => 0.1, 8 => 0.01, 9 => 0.4, 10 => 0.02, 11 => 0.001 );
	$won_prize = 0;
	for ($pr = 1; $pr <= 11; $pr++ ){
		$v = mt_rand( 1, 1000000 ) / 10000;
		if ( $v < $comb_chance[$pr] && $won_prize == 0 ){
			$won_prize = $pr;
		}
	}
	$prize_count = $count_won = 0;
	$x = mt_rand( 0, sizeof( $comb[$won_prize] ) - 1 );
	$roulette_comb = $comb[$won_prize][$x][0]."@".$comb[$won_prize][$x][1]."@".$comb[$won_prize][$x][2];
	if(in_array($_GET['vcode'],$_SESSION['secur'])){
		$pass_to_roulette = false;
		if( $_GET['action'] == 'free' ){
			$res = mysqli_query($GLOBALS['db_link'], "SELECT * FROM module_slot_free WHERE user_id = ".$pers['id']." AND day = '".date( "Y-m-d" )."'");
			if ( mysqli_num_rows($res) > 0 ){
                exit("ERROR@Вы не можете сыграть бесплатно больше одного раза в день.");
			}
			mysqli_query($GLOBALS['db_link'], "INSERT INTO module_slot_free (user_id, day, prize) VALUES (".$pers['id'].", '".date( "Y-m-d" )."', ".$won_prize.")" );
		}else{
			if ( $pers['baks'] >= 0.2 ){
				mysqli_query($GLOBALS['db_link'], "UPDATE user SET baks = baks - 0.2 WHERE id = ".$pers['id']);
				$pass_to_roulette = true;
				$pers['baks'] -= 0.2;
			}else
                exit("ERROR@У вас нет средств для игры.");
		}
		
		switch ( $won_prize ){
			case 0 :
                $Text = 'OK@К сожалению, Вы ничего не выиграли. Возможно, Вам повезет в следующий раз.';
			break;
			case 1 :
                //mysqli_query($GLOBALS['db_link'],"INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('".time()."','sys','".addslashes("parent.frames['chmain'].add_msg('<font class=massm>&nbsp;Слот-машина&nbsp;</font> <font color=000000>С радостью сообщаем Всем о Удаче &quot;<b>".$pers['login']."</b>&quot; в игре Слоты. Его выигрыш - <b>1000</b> LR!</font></i><BR>'+'');")."');");
				mysqli_query($GLOBALS['db_link'], "UPDATE user SET nv = nv + 50 WHERE id = ".$pers['id']);
                $Text = "OK@Поздравляем, Вы выиграли 50 LR.";
				$count_won = $pers['nv'] + 50;
				$prize_count = 50;
			break;
			case 2 :
                //mysqli_query($GLOBALS['db_link'],"INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('".time()."','sys','".addslashes("parent.frames['chmain'].add_msg('<font class=massm>&nbsp;Слот-машина&nbsp;</font> <font color=000000>С радостью сообщаем Всем о Удаче &quot;<b>".$pers['login']."</b>&quot; в игре Слоты. Его выигрыш - <b>5000</b> LR!</font></i><BR>'+'');")."');");
				mysqli_query($GLOBALS['db_link'], "UPDATE user SET nv = nv + 500 WHERE id = ".$pers['id']);
                $Text = "OK@Поздравляем, Вы выиграли 500 LR.";
				$count_won = $pers['nv'] + 500;
				$prize_count = 500;
			break;
			case 3 :
                //mysqli_query($GLOBALS['db_link'],"INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('".time()."','sys','".addslashes("parent.frames['chmain'].add_msg('<font class=massm>&nbsp;Слот-машина&nbsp;</font> <font color=000000>С радостью сообщаем Всем о Удаче &quot;<b>".$pers['login']."</b>&quot; в игре Слоты. Его выигрыш - <b>10000</b> LR!</font></i><BR>'+'');")."');");
				mysqli_query($GLOBALS['db_link'], "UPDATE user SET nv = nv + 10000 WHERE id = ".$pers['id']);
                $Text = "OK@Поздравляем, Вы выиграли 10000 LR.";
				$count_won = $pers['nv'] + 10000;
				$prize_count = 10000;
			break;
			case 4 :
				$ItemsArray = array(2196,2362,2200,3487,2509);
				$PrizeID = rand(0,(count($ItemsArray)-1));
                $Text = 'OK@Поздравляем, Вы выиграли Обычный расходник.';
				insertInventory($pers['id'], $ItemsArray[$PrizeID]);
				$prize_count = $ItemsArray[$PrizeID];
			break;
			case 5 :
				$ItemsArray = array(2324,2322,2201,1984,2069,2716,1930);
				$PrizeID = rand(0,(count($ItemsArray)-1));
                $Text = 'OK@Поздравляем, Вы выиграли Хороший расходник.';
				insertInventory($pers['id'], $ItemsArray[$PrizeID]);
				$prize_count = $ItemsArray[$PrizeID];
			break;
			case 6 :
				$ItemsArray = array(2257,2321,2323,2511,2250,2526,2328);
				$PrizeID = rand(0,(count($ItemsArray)-1));
                $Text = 'OK@Поздравляем, Вы выиграли Дорогой расходник.';
				insertInventory($pers['id'], $ItemsArray[$PrizeID]);
				$prize_count = $ItemsArray[$PrizeID];
			break;
			case 7 :
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('" . time() . "','sys','" . addslashes("parent.frames['chmain'].add_msg('<font class=massm>&nbsp;Слот-машина&nbsp;</font> <font color=000000>С радостью сообщаем Всем о Удаче &quot;<b>" . $pers['login'] . "</b>&quot; в игре Слоты. Его выигрыш - <b>25</b> $!</font></i><BR>'+'');") . "');");
				mysqli_query($GLOBALS['db_link'], "UPDATE user SET baks = baks + 25 WHERE id = ".$pers['id']);
                $Text = 'OK@Поздравляем, Вы выиграли 25 Изумруд.';
				$count_won = $pers['baks'] + 25;
				$prize_count = 25;
			break;
			case 8 :
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('" . time() . "','sys','" . addslashes("parent.frames['chmain'].add_msg('<font class=massm>&nbsp;Слот-машина&nbsp;</font> <font color=000000>С радостью сообщаем Всем о Удаче &quot;<b>" . $pers['login'] . "</b>&quot; в игре Слоты. Его выигрыш - <b>75</b> $!</font></i><BR>'+'');") . "');");
				mysqli_query($GLOBALS['db_link'], "UPDATE user SET baks = baks + 75 WHERE id = ".$pers['id']);
                $Text = 'OK@Поздравляем, Вы выиграли 75 Изумруд.';
				$count_won = $pers['baks'] + 75;
				$prize_count = 75;
			break;
			case 9 :
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('" . time() . "','sys','" . addslashes("parent.frames['chmain'].add_msg('<font class=massm>&nbsp;Слот-машина&nbsp;</font> <font color=000000>С радостью сообщаем Всем о Удаче &quot;<b>" . $pers['login'] . "</b>&quot; в игре Слоты. Его выигрыш - <b>Уникальный раритет</b>!</font></i><BR>'+'');") . "');");
				$ItemsArray = array(2304, 2273, 2278, 2271, 2272, 288, 295, 292);
				$PrizeID = rand(0,(count($ItemsArray)-1));
                $Text = 'OK@Поздравляем, Вы выиграли Уникальный раритет.';
				insertInventory($pers['id'], $ItemsArray[$PrizeID], (time()+864000));
				$prize_count = $ItemsArray[$PrizeID];
			break;
			case 10 :
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('" . time() . "','sys','" . addslashes("parent.frames['chmain'].add_msg('<font class=massm>&nbsp;Слот-машина&nbsp;</font> <font color=000000>С радостью сообщаем Всем о Удаче &quot;<b>" . $pers['login'] . "</b>&quot; в игре Слоты. Его выигрыш - <b>Уникальный артефакт</b>!</font></i><BR>'+'');") . "');");
				$ItemsArray = array(2346, 2337, 2339, 2341, 2345, 2687, 2692, 2695);
				$PrizeID = rand(0,(count($ItemsArray)-1));
                $Text = 'OK@Поздравляем, Вы выиграли Уникальный артефакт.';
				insertInventory($pers['id'], $ItemsArray[$PrizeID], (time()+432000));
				$prize_count = $ItemsArray[$PrizeID];
			break;
			case 11 :
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('" . time() . "','sys','" . addslashes("parent.frames['chmain'].add_msg('<font class=massm>&nbsp;Слот-машина&nbsp;</font> <font color=000000>С радостью сообщаем Всем о Удаче &quot;<b>" . $pers['login'] . "</b>&quot; в игре Слоты. Он сорвал <b><font color=red>JACK POT</font></b> в размере <b><font color=red>" . $roulette['jackpot_amount'] . "</font></b> $!</font><BR>'+'');") . "');");
				mysqli_query($GLOBALS['db_link'], "UPDATE module_slot_status SET jackpot_amount = 0, attempts_count = 0, last_winner_id = " . $pers['id'] . ", last_winner_name = '" . $pers['login'] . "', last_winner_datetime = ".time().", last_winner_amount = '".$roulette['jackpot_amount']."' WHERE roulette_id = 1");
				mysqli_query($GLOBALS['db_link'], "UPDATE user SET baks = baks + ".$roulette['jackpot_amount']." WHERE id = ".$pers['id']);
                $Text = 'OK@Поздравляем, Вы выиграли JACK POT ' . $roulette['jackpot_amount'] . ' Изумруд !!!.';
				$count_won = $pers['baks'] + $roulette['jackpot_amount'];
				$prize_count = $roulette['jackpot_amount'];
			break;
		}
		mysqli_query($GLOBALS['db_link'], "INSERT INTO module_slot_stat (user_id, datetime, money, prize, prize_amount) VALUES (".$pers['id'].", '".date( "Y-m-d H:i:s" )."', ".( $pass_to_roulette ? 1 : 0 ).", ".$won_prize.", ".$prize_count.")" );
		mysqli_query($GLOBALS['db_link'], "UPDATE module_slot_status SET jackpot_amount = jackpot_amount + 0.1, attempts_count = attempts_count + 1 WHERE roulette_id = 1");
		exit( $Text . "@" . $roulette_comb . "@" . round($pers['dd'], 2) . "@" . $won_prize . "@" . $count_won . "@" . ($roulette['jackpot_amount'] + 0.1) . " $@" . (($pers['dd'] < 0.2) ? 0 : 1));
	}
    exit("ERROR@Неизвестная ошибка.");
}