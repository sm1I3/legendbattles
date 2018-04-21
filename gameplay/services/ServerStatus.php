<?php
include($_SERVER["DOCUMENT_ROOT"] . "/app/system/config.php");
include(DROOT . "/includes/functions.php");

echo "var ServerStatus = [", $GLOBALS['DBLink']->query("SELECT count(*) FROM `user` WHERE `id`>'10000'")->fetchColumn(0) . "," .
    (148 + $GLOBALS['DBLink']->query("SELECT count(*) FROM `user` WHERE `id`>'10000' AND `last`>'" . (time() - 108000) . "'")->fetchColumn(0)) . "," .
    (60 + $GLOBALS['DBLink']->query("SELECT count(*) FROM `user` WHERE `id`>'10000' AND `last`>'" . (time() - 300) . "'")->fetchColumn(0)) . "," . rand(9, 16) . "];";
