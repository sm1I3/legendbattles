<?php
include($_SERVER["DOCUMENT_ROOT"] . "/app/system/config.php");
include(DROOT . "/includes/functions.php");

echo "var ServerStatus = [", $GLOBALS['DBLink']->query("SELECT count(*) FROM `user` WHERE `id`>?", array(10000))->fetchColumn(0) . "," .
    (148 + $GLOBALS['DBLink']->query("SELECT count(*) FROM `user` WHERE `id`>? AND `last`>?", array(10000, (time() - 108000)))->fetchColumn(0)) . "," .
    (60 + $GLOBALS['DBLink']->query("SELECT count(*) FROM `user` WHERE `id`>? AND `last`>?", array(10000, (time() - 300)))->fetchColumn(0)) . "," . rand(9, 16) . "];";
