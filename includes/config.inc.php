<?php
define('DROOT', $_SERVER["DOCUMENT_ROOT"]);
$db_link = 0;
$db_link = mysqli_connect(
    'localhost',
    '34',
    '34',
    '34');
if (mysqli_connect_errno()) {
    printf("Подключение к серверу MySQL невозможно. Код ошибки: %s\n", mysqli_connect_error());
    exit;
}
mysqli_query($GLOBALS['db_link'], "SET NAMES utf8");
function mysqli_result($res, $row, $field = 0)
{
    $res->data_seek($row);
    $datarow = $res->fetch_array();
    return $datarow[$field];
}

