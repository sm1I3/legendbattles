<?
$player = player();
$pt = allparam($player);
$chrecipe = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `custom_rec` WHERE `id`='" . intval($_POST['rid']) . "' LIMIT 1;");
if (mysqli_num_rows($chrecipe) > 0) {
    $chrecipe = mysqli_fetch_assoc($chrecipe);
    if ($player['custom_rec'] == "0") {
        $alhim_rec = "0";
    } else {
        $alhim_rec = explode("|", $player['custom_rec']);
    }
    if ($player['nv'] >= $chrecipe['price'] and in_array($chrecipe['id'], $alhim_rec) == false) {
        $message = 1;
        include($_SERVER["DOCUMENT_ROOT"] . "/gameplay/inc/craft_sys/custom_messages" . ".php");
        mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `custom_rec`='" . (($player['custom_rec'] == "0") ? "|" . $chrecipe['id'] : $player['custom_rec'] . "|" . $chrecipe['id']) . "',`nv`=`nv`-'" . $chrecipe['price'] . "' WHERE `id`='" . $player['id'] . "' LIMIT 1;");
    } else {
        (($player['nv'] < $chrecipe['price']) ? ($message = 3) : ($message = 4));
        include($_SERVER["DOCUMENT_ROOT"] . "/gameplay/inc/craft_sys/custom_messages" . ".php");
    }
}
