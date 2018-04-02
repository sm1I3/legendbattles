<? //--------одевалка 
save_hp();
$wid = varcheck($_POST['wid']) ?? varcheck($_GET['wid']) ?? '';
$items = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype`  WHERE id_item='" . $wid . "' and `pl_id`='" . $player['id'] . "' LIMIT 1;"));
if ($act == 1) {
    if ($items['slot'] == 3 and $items['2w'] == 1 and mysqli_num_rows(mysqli_query($GLOBALS['db_link'], "SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `curslot`='3' and `used`='1' and `pl_id`='" . $player['id'] . "'")) > 0) {
        $items['slot'] = 13;
    }
    if ($items['slot'] == 14 and mysqli_num_rows(mysqli_query($GLOBALS['db_link'], "SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `curslot`='14' and `used`='1' and `pl_id`='" . $player['id'] . "'")) > 0) {
        $items['slot'] = 15;
    }
    if ($plstt[3] == 0 and $items['slot'] == 5) {
        $act = -1;
        $items['slot'] = 5;
    }
    if ($plstt[3] > 1 and $items['slot'] == 5 and mysqli_num_rows(mysqli_query($GLOBALS['db_link'], "SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `curslot`='5' and `used`='1' and `pl_id`='" . $player['id'] . "'")) > 0) {
        $items['slot'] = 6;
    }
    if ($plstt[3] > 2 and $items['slot'] == 6 and mysqli_num_rows(mysqli_query($GLOBALS['db_link'], "SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `curslot`='6' and `used`='1' and `pl_id`='" . $player['id'] . "'")) > 0) {
        $items['slot'] = 7;
    }
    if ($items['slot'] == 20) {
        for ($i = 20; $i <= 23; $i++) {
            if (mysqli_num_rows(mysqli_query($GLOBALS['db_link'], "SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `curslot`='" . $i . "' and `used`='1' and `pl_id`='" . $player['id'] . "'")) == 0) {
                $items['slot'] = $i;
                $i = 24;
            } elseif ($i == 23) {
                $items['slot'] = $i;
            }
        }
    }
    if (mysqli_num_rows(mysqli_query($GLOBALS['db_link'], "SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `curslot`='" . $items['slot'] . "' and `pl_id`='" . $player['id'] . "'")) > 0) {
        $act = 2;
    }
}
updateslot($act, $wid, $player['id'], $items['slot']);
calcstat($player['id']);
testcompl();
