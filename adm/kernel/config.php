<?php
session_start();
/*if (!in_array($_SESSION['user']['id'], array(10001,10657,2030003))){
	header('Location: https://www.legendbattles.ru/index.php');
	die();
}
*/
if (!$db = mysqli_connect('localhost', '34', '34'))
    die('Cannot connect to MySQL server.');

mysqli_select_db($db, '34');
mysqli_set_charset($db, 'utf8');
