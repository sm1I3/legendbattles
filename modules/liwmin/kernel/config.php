<?php
session_start();
/*if (!in_array($_SESSION['user']['id'], array(10001,10657,2030003))){
	header('Location: https://www.legendbattles.ru/index.php');
	die();
}
*/
if (!$db = mysql_connect('localhost', 'root', 'j4T450V2'))
    die('Cannot connect to MySQL server.');

mysql_select_db('legend', $db);
mysql_set_charset('cp1251');
