<?php
session_start();
include($_SERVER["DOCUMENT_ROOT"] . "/includes/config.inc.php");
include(DROOT . "/includes/functions.php");

echo "var ServerStatus = [", mysqli_result(mysqli_query($GLOBALS['db_link'], "SELECT count(*) FROM `user` WHERE `id`>'10000'"), 0) . "," .
    (148 + mysqli_result(mysqli_query($GLOBALS['db_link'], "SELECT count(*) FROM `user` WHERE `id`>'10000' AND `last`>'" . (time() - 108000) . "'"), 0)) . "," .
    (60 + mysqli_result(mysqli_query($GLOBALS['db_link'], "SELECT count(*) FROM `user` WHERE `id`>'10000' AND `last`>'" . (time() - 300) . "'"), 0)) . "," . rand(9, 16) . "];";
?>