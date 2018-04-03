<?php
session_start();
include($_SERVER["DOCUMENT_ROOT"] . "/includes/config.php");
include($_SERVER["DOCUMENT_ROOT"] . "/includes/functions.php");

$pers = GetUser($_SESSION['user']['login']);
/* Go To Old Core */
if ($_GET['go'] == 'inf' and $pers['wait'] <= time()) {
    $_SESSION['secur'] = $_SESSION['vcodes'];
    header("Location: /main.php?get=0&vcode=" . $_GET['vcode']);
}
if ($_GET['go'] == 'inv' and $pers['wait'] <= time()) {
    $_SESSION['secur'] = $_SESSION['vcodes'];
    header("Location: /main.php?get=1&vcode=" . $_GET['vcode']);
}
if (isset($_POST['post_id']) and in_array($_POST['vcode'], $_SESSION['vcodes'])) {
    include($_SERVER["DOCUMENT_ROOT"] . "/includes/post_id.php");
}
if (isset($_GET['get_id']) and in_array($_GET['vcode'], $_SESSION['vcodes'])) {
    include($_SERVER["DOCUMENT_ROOT"] . "/includes/get_id.php");
}

unset($_SESSION['vcodes']);

if (isset($_GET['useaction'])) {
    $usea = array('addon-action', 'map-action', 'auction-action');
    for ($i = 0; $i <= 3; $i++)
        switch ($_GET['useaction']) {
            case $usea[$i]:
                exit(include "./includes/addons/" . $usea[$i] . ".php");
                break;
            case'clan-action':
                if ($_SESSION['user']['clan'] == '') {
                    exit(include "./includes/addons/clan-action.php");
                }
                break;
        }
}

switch ($pers['useaction']) {
    case'0':
        header("Location: /main.php");
        break;
    case'1':
        header("Location: /main.php");
        break;
    case'3':
        $location = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `loc` WHERE `id`='" . $pers['loc'] . "'"));
        include($_SERVER["DOCUMENT_ROOT"] . "/includes/locations/" . $location['folder'] . "/" . $location['inc']);
        break;
}
