<?php
$it = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE " . ((intval($_POST['uid'])) ? "`id_item`='" . intval($_POST['uid']) . "'" : "`invent`.`pl_id`='" . $player['id'] . "' AND `items`.`acte`='BotNapForm' ORDER BY `invent`.`iznos` DESC LIMIT 1") . ";"));
switch ($it['num_a']) {
    case'32':
        if ($player['fight'] == '0' and $player['loc'] == '28' and $player['hp'] >= '1' and ($player['battle'] == '0' or $player['battle'] == '')) {
            BotNapAttack($player, $it['id_item']);
        }
        break;
}
