<?
header('Content-type: text/html; charset=UTF-8');
/*			switch($tp){
				case 1: $str = "`param`='".$par_new."'"; break;
				case 2: $str = "`param_timed`='".$par_new."',`param_time`='".(time()+2592000)."'"; break;
			}
			mysqli_query($GLOBALS['db_link'],"UPDATE `real_dd_bonus` SET ".$str." WHERE `pl_id`='".$player['id']."' LIMIT 1;");
			switch($tp){
				case 1: $str = "(`pl_id`,`param`) VALUES ('".$player['id']."','".$par."')"; break;
				case 2: $str = "(`pl_id`,`param_timed`,`param_time`) VALUES ('".$player['id']."','".$par_new."','".(time()+2592000)."')"; break;
			}
			mysqli_query($GLOBALS['db_link'],"INSERT INTO `real_dd_bonus` ".$str.";");	
			
			
*/
require($_SERVER["DOCUMENT_ROOT"] . "/system/config.php");
require($_SERVER["DOCUMENT_ROOT"] . "/includes/sql_func.php");
$pers = player();
$_GET['string'] = iconv("UTF-8", "UTF-8", urldecode($_GET['string']));
$getstatsusr = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `real_dd_bonus` WHERE `pl_id`='" . $pers['id'] . "' LIMIT 1;"));
$_GET['type'] = intval($_GET['type']);
$hash = md5($_GET['type'] . $_SESSION['user']['login'] . $_GET['params'] . $_GET['sum'] . $pers['dd']);
if ($_GET['type'] == 1) {
    $hashBD = $getstatsusr['tmp_hash'];
} else {
    $hashBD = $getstatsusr['tmp_time_hash'];
}
if ($hash == $hashBD) {
    $str = "";
    switch ($_GET['type']) {
        case 1:
            $str = "`param`='" . mysqli_real_escape_string($GLOBALS['db_link'], $_GET['params']) . "'";
            break;
        case 2:
            if ($getstatsusr['param_time'] > time()) {
                $str = "`param_timed`='" . mysqli_real_escape_string($GLOBALS['db_link'], $_GET['params']) . "'";
            } else {
                $str = "`param_timed`='" . mysqli_real_escape_string($GLOBALS['db_link'], $_GET['params']) . "',`param_time`='" . (time() + 2592000) . "'";
            }
            break;
    }
    if ($str) {
        if ($pers['baks'] >= $_GET['sum'] and $_GET['sum'] > 0 and is_numeric($_GET['sum'])) {
            if (mysqli_query($GLOBALS['db_link'], "UPDATE `real_dd_bonus` SET " . $str . " WHERE `pl_id`='" . $pers['id'] . "' LIMIT 1;") and mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `baks`=`baks`-'" . $_GET['sum'] . "' WHERE `id`='" . $pers['id'] . "' LIMIT 1;")) {
                echo 'Вы успешно получили:<br>' . $_GET['string'] . '<br>Заплачено:&nbsp;' . $_GET['sum'] . '$';
            } else {
                echo 'Ошибка (id: ddparams-3).&nbsp;Попробуйте еще раз.&nbsp;Если повторится:&nbsp; напишите персонажу Администрация.';
            }
        } else {
            echo 'Недостаточно денег.<br>(Оплата производится в $).<br>Обменяйте имеющиеся DLR на $.&nbsp;Попробуйте еще раз';
        }
    } else {
        echo 'Ошибка!<br>Попробуйте еще раз.';
    }
} else {
    echo 'Ошибка!<br>Попробуйте еще раз.';
}































