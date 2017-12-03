<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 0);


require_once"./includes/config.php";		
//require_once"/var/www/legendbattles.ru/includes/config.php";
//include"/var/www/legen451/data/www/legendbattles.ru/includes/cron.php";
//require_once"/var/www/legendbattles.ru/includes/sql.php";
include"./includes/sql.php";
$stop_injection = new InitVars();
//$stop_injection->checkVars();
?>