<?

$player = player();
$pt = allparam($player);
$chrecipe = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `alhim` WHERE `id`='" . intval($_POST['rid']) . "' LIMIT 1;");
if (mysqli_num_rows($chrecipe) > 0) {
    $chrecipe = mysqli_fetch_assoc($chrecipe);
    if ($player['alhim_rec'] == "0") {
        $alhim_rec = "0";
    } else {
        $alhim_rec = explode("|", $player['alhim_rec']);
    }
    if ($pt[68] >= $chrecipe['nav'] and $player['nv'] >= $chrecipe['price'] and in_array($chrecipe['id'], $alhim_rec) == false) {
        $message = 1;
        include($_SERVER["DOCUMENT_ROOT"] . "/gameplay/inc/alhim/alhim_messages" . ".php");
        mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `alhim_rec`='" . (($player['alhim_rec'] == "0") ? "|" . $chrecipe['id'] : $player['alhim_rec'] . "|" . $chrecipe['id']) . "',`nv`=`nv`-'" . $chrecipe['price'] . "' WHERE `id`='" . $player['id'] . "' LIMIT 1;");
    } else {
        (($pt[68] < $chrecipe['nav']) ? ($message = 2) : (($player['nv'] < $chrecipe['price']) ? ($message = 3) : ($message = 4)));
        include($_SERVER["DOCUMENT_ROOT"] . "/gameplay/inc/alhim/alhim_messages" . ".php");
    }
}
