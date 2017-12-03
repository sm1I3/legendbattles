<?php
session_start();
include($_SERVER["DOCUMENT_ROOT"] . "/includes/config.inc.php");
include(DROOT . "/includes/functions.php");
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
function locations($loc, $pos)
{
    if ($pers['loc'] != '28') {
        $location = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT `id`, `loc`, `room`, `city` FROM `loc` WHERE `id`='" . $loc . "' LIMIT 1;"));
    }
    return $location['city'] . ";" . (($location['room']) ? $location['room'] : $location['loc']);
}


if (!empty($_GET['sign'])) {
    if ($_GET['sign'] == 'watchers') {
        $ClanQuery = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `user` WHERE `clan_gif` = 'pv27.gif' or `clan_gif` = 'pv18.gif' ORDER BY `level` DESC");
    } else {
        $ClanQuery = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `user` WHERE `clan_id` = '" . preg_replace('/[^a-zA-Zа-яА-Я0-9]/', '', $_GET['sign']) . "' ORDER BY `level` DESC");
    }
}
if (!empty($_GET['gif'])) {
    $ClanQuery = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `user` WHERE `clan_gif` = '" . preg_replace('/[^a-zA-Zа-яА-Я0-9.]/', '', $_GET['gif']) . "' ORDER BY `level` DESC");
}

$s = 'var ClanList = new Array(';
while ($ClanRow = mysqli_fetch_assoc($ClanQuery)) {
    $nst = explode("|", $ClanRow['st']);
    for ($i = 5; $i <= 40; $i++) {
        $nst[$i] = $nst[$i] ? $nst[$i] : 0;
    }
    $ust = 100 - round(($ClanRow['ustal'] - time()) / (150 / ($nst[58] / 200 + 1)));
    $s .= '"' . $ClanRow['login'] . ':';
    $s .= $ClanRow['level'] . ':';
    $s .= (($ClanRow['clan_id'] != 'none') ? $ClanRow['clan_gif'] . ';' . $ClanRow['clan'] . ';' . $ClanRow['clan_d'] . ':' : '0:');
    $s .= ((accesses($ClanRow['id'], 'dealer')) ? ((accesses($ClanRow['id'], 'dealer', 1) < 3) ? accesses($ClanRow['id'], 'dealer', 1) : '0') . ':' : '0:');
    $s .= $ClanRow['sklon'] ? $ClanRow['sklon'] . ':' : '0:';
    if ($ClanRow['last'] > (time() - 300)) {
        $s .= locations($ClanRow['loc'], $ClanRow['pos']) . ':';
    } else {
        $s .= '0:';
    }
    $s .= (($ust > 100) ? '100:' : $ust . ':');
    $s .= $ClanRow['clan_status'] . '"';
    $s .= ",";
}
echo substr($s, 0, strlen($s) - 1) . ');';
mysqli_free_result($ClanQuery);
?>