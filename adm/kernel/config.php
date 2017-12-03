<?php
session_start();
/*if (!in_array($_SESSION['user']['id'], array(10001,10657,2030003))){
	header('Location: https://www.legendbattles.ru/index.php');
	die();
}
*/
if (!$db = mysql_connect('localhost', '34', '34'))
    die('Cannot connect to MySQL server.');

mysql_select_db('34', $db);
mysql_set_charset('utf8');
