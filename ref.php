<?
session_start();
error_reporting("E_ALL");
include($_SERVER["DOCUMENT_ROOT"] . "/includes/config.php");
include($_SERVER["DOCUMENT_ROOT"] . "/includes/functions.php");
foreach ($_POST as $keypost => $valp) {
    $valp = varcheck($valp);
    $_POST[$keypost] = $valp;
    $$keypost = $valp;
}
foreach ($_GET as $keyget => $valg) {
    $valg = varcheck($valg);
    $_GET[$keyget] = $valg;
    $$keyget = $valg;

}
foreach ($_SESSION as $keyses => $vals) {
    $$keyses = $vals;
}

if (empty($_GET["p"])) {
    $_GET["p"] = $_SERVER['QUERY_STRING'];
}
$pers = GetUser(str_replace("%20", " ", iconv("UTF-8", "Windows-1251", urldecode($_GET["p"]))));
if (!empty($pers['id']) and !empty($pers['login'])) {
    $_SESSION['referal'] = $pers['login'];
    $_SESSION['referal_id'] = $pers['id'];
}
exit(header("Location: /index.php"));
?>