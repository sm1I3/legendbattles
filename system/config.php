<?php
session_start();
error_reporting(0);
define('DROOT', $_SERVER["DOCUMENT_ROOT"]);
$db_link = 0;
$db_link = mysqli_connect('localhost', 'root', '', 'legends');
if (mysqli_connect_errno()) {
    printf("Подключение к серверу MySQL невозможно. Код ошибки: %s\n", mysqli_connect_error());
    exit;
}
$GLOBALS['db_link'] = $db_link;
mysqli_query($GLOBALS['db_link'], "SET NAMES utf8");

$GLOBALS['redirect'] = "parent.frames['main_top'].location='main.php';";
$quit = "parent.location='index.php';";

define('AP', '\'');

function mysqli_result($res, $row = 0, $col = 0)
{
    $numrows = mysqli_num_rows($res);
    if ($numrows && $row <= ($numrows - 1) && $row >= 0) {
        mysqli_data_seek($res, $row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])) {
            return $resrow[$col];
        }
    }
    return false;
}

function goto_error($err_text)
{
    echo '<br><b>����� �������: </b><br>' . $err_text . '<br><INPUT TYPE="button" VALUE="�����" onClick="history.back()">';
    die;
}

function db_query($str)
{
    global $db_result;
    $db_result = mysqli_query($GLOBALS['db_link'], $str) or goto_error(mysqli_error($GLOBALS['db_link']));

}

function db_quer($table, $filter)
{
    $str = 'SELECT * FROM ' . $table . ' WHERE ' . $filter;
    //echo $str;
    $db_result = mysqli_query($GLOBALS['db_link'], $str) or goto_error(mysqli_error($GLOBALS['db_link']));
    $str2 = mysqli_fetch_assoc($db_result);
    return $str2;

}


function scode()
{
    $cod = md5(rand(100, 10000));
    $_SESSION['secur'][] = $cod;
    return $cod;
}

