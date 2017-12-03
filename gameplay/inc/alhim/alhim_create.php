<?
$player = player();
$pt = allparam($player);
$err = "0";
$chrecipe = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `alhim` WHERE `id`='" . intval($_POST['rid']) . "' LIMIT 1;");
if (mysqli_num_rows($chrecipe) > 0) {
    $chrecipe = mysqli_fetch_assoc($chrecipe);
    if ($player['alhim_rec'] == "0") {
        $alhim_rec = "0";
    } else {
        $alhim_rec = explode("|", $player['alhim_rec']);
    }
    if ($pt[68] >= $chrecipe['nav'] and in_array($chrecipe['id'], $alhim_rec)) {
        $reg = explode("|", $chrecipe['reagents']);
        $regmiss = "";
        $grassit = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `items` WHERE (`type`='w66' OR `type`='w69') AND `slot`='0';");
        while ($grow = mysqli_fetch_assoc($grassit)) {
            $plcol[$grow['id']] = mysqli_num_rows(mysqli_query($GLOBALS['db_link'], "SELECT `invent`.`id_item`,`invent`.`bank` FROM `invent` WHERE `protype`='" . $grow['id'] . "' AND `pl_id`='" . $player['id'] . "' AND `bank`='0';"));
        }
        foreach ($reg as $val) {
            $reagent = explode("@", $val);
            $regit = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT `items`.`name` FROM `items` WHERE `items`.`id`='" . $reagent[0] . "' LIMIT 1;"));
            if ($plcol[$reagent[0]] < $reagent[1]) {
                $regmiss .= '<b>' . $regit['name'] . '</b> в количестве ' . ($reagent[1] - $plcol[$reagent[0]]) . ' шт.<br>';
                $err = "1";
            }
        }
        $IT = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `items` WHERE `id`='" . $chrecipe['protype'] . "' LIMIT 1;"));
        if ($IT != '' and $err == "0") {
            $pr = explode("|", $IT['param']);
            foreach ($pr as $value) {
                $stat = explode("@", $value);
                switch ($stat[0]) {
                    case 2:
                        $dolg = $stat[1];
                        break;
                }
            }
            $insert = "";
            for ($i = 0; $i < $chrecipe['col']; $i++) {
                $insert .= "('" . $IT['id'] . "','" . $player['id'] . "','" . $dolg . "','" . $IT['price'] . "'),";
            }
            $insert = substr($insert, 0, strlen($insert) - 1);
            foreach ($reg as $val) {
                $reagent = explode("@", $val);
                mysqli_query($GLOBALS['db_link'], "DELETE FROM `invent` WHERE `pl_id`='" . $player['id'] . "' AND `protype`='" . $reagent[0] . "' AND `bank`='0' ORDER by `death` LIMIT " . $reagent[1] . ";");
            }
            mysqli_query($GLOBALS['db_link'], "INSERT INTO `invent` (`protype`,`pl_id`,`dolg`,`price`) VALUES " . $insert . ";");
            $message = 5;
            include($_SERVER["DOCUMENT_ROOT"] . "/gameplay/inc/alhim/alhim_messages" . ".php");
        } else if ($err == "1") {
            $message = 6;
            include($_SERVER["DOCUMENT_ROOT"] . "/gameplay/inc/alhim/alhim_messages" . ".php");
        } else if ($IT == '') {
            $message = 7;
            include($_SERVER["DOCUMENT_ROOT"] . "/gameplay/inc/alhim/alhim_messages" . ".php");
        }
    } else {
        (($pt[68] < $chrecipe['nav']) ? ($message = 2) : ($message = 8));
        include($_SERVER["DOCUMENT_ROOT"] . "/gameplay/inc/alhim/alhim_messages" . ".php");
    }
}
?>