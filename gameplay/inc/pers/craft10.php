<?php
echo '<style>
.collection-ico{
	display: inline-block;
	height: 75px;
	vertical-align: middle;
	font-weight: bold;
	font-size: 40px;
}
.category{
	float:left;
	padding: 0 5px 0 0;
	text-align:center;
}
</style><script type="text/javascript" language="javascript" src="/js/itemsInfo.js"></script><table cellpadding="5" cellspacing="1" border="0" width="100%"><tr><td>';
$ArrayCombins = array(
    array(// Вещь 6
        'items' => array(
            array('2734', '50'),
            array('', ''),
            array('', ''),
            array('', ''),
            array('', ''),
            array('', ''),
            array('', '')
        ),
        'result' => '3552' // ИД вещи
    ),
    array(// Вещь 5
        'items' => array(
            array('2809', '50'),
            array('', ''),
            array('', ''),
            array('', ''),
            array('', ''),
            array('', ''),
            array('', '')
        ),
        'result' => '3552' // ИД вещи
    ),
);
if (isset($_POST['craftID'])) {
    $ParamsNeeds = true;
    if (isset($ArrayCombins[intval($_POST['craftID'])])) {
        $ResultItem = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `items` WHERE `id`='" . $ArrayCombins[intval($_POST['craftID'])]['result'] . "'"));
        foreach ($ArrayCombins[intval($_POST['craftID'])]['items'] as $items) {
            $ResultNeed = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `items` WHERE `id`='{$items[0]}'"));
            if ($items[0]) {
                $countInInv = mysqli_num_rows(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `invent` WHERE `protype` = '{$items[0]}' and `pl_id`='{$player['id']}'"));
                if ($countInInv < $items[1] and $ParamsNeeds == true) {
                    $ParamsNeeds = false;
                }
            }
        }
        foreach ($ArrayCombins[intval($_POST['craftID'])]['items'] as $items) {
            if ($ParamsNeeds == true and $items[0]) {
                mysqli_query($GLOBALS['db_link'], "DELETE FROM `invent` WHERE `protype`='{$items[0]}' and `pl_id`='{$player['id']}' LIMIT " . $items[1] . ";");
            }
        }
        if ($ParamsNeeds == true) {
            $itemsql = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `items` WHERE `id`='" . $ArrayCombins[intval($_POST['craftID'])]['result'] . "' LIMIT 1;"));
            $par = explode("|", $itemsql['param']);
            foreach ($par as $value) {
                $stat = explode("@", $value);
                switch ($stat[0]) {
                    case 2:
                        $dolg = $stat[1];
                        break;
                }
            }
            if (mysqli_query($GLOBALS['db_link'], "INSERT INTO invent (`protype` ,`pl_id` ,`dolg` ,`price` ,`gift`,`gift_from`) VALUES ('" . $itemsql['id'] . "','" . $player['id'] . "','" . $dolg . "','" . $itemsql['price'] . "','0','');")) {
                echo "<script>
							top.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "</font>&nbsp;<b><font color=#CC0000>Внимание!</font></b> Вы получили &quot;<b>" . $itemsql['name'] . "</b>&quot;. </font><BR>'+'');
							top.set_lmid(8);
							</script>";
            }
        }
    }
}
$i = 0;
foreach ($ArrayCombins as $row) {
    $ResultItem = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `items` WHERE `id`='{$row['result']}'"));
    echo '<form method="POST" action=""><table cellpadding="5" cellspacing="1" border="0" width="100%">
				 <input type="hidden" name="craftID" value="' . $i++ . '" />
				 <tr>
					<td bgcolor="#FFFFFF" class="nickname" align="center">';
    $ParamsNeeds = true;
    foreach ($row['items'] as $items) {
        $ResultNeed = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `items` WHERE `id`='{$items[0]}'"));
        echo '<div class="category">';
        if ($items[0]) {
            $countInInv = mysqli_num_rows(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `invent` WHERE `protype` = '{$items[0]}' and `pl_id`='{$player['id']}'"));
            if ($countInInv < $items[1] and $ParamsNeeds == true) {
                $ParamsNeeds = false;
            }
            echo '<img src="/img/image/weapon/' . $ResultNeed['gif'] . '" onmouseover="tooltip(this,ShowInfo(\'' . $ResultNeed['name'] . '\',\'' . $ResultNeed['gif'] . '\',\'' . lr($ResultNeed['price']) . '\',\'' . $ResultNeed['slot'] . '\',\'' . $ResultNeed['block'] . '\',\'' . $ResultNeed['hand'] . '\',\'' . preg_replace('/@/', ':', $ResultNeed['param']) . '\',\'' . preg_replace('/@/', ':', $ResultNeed['need']) . '\',\'' . $ResultNeed['massa'] . '\',\'' . $ResultNeed['level'] . '\'));" onmouseout="hide_info(this);" /><br />' . $countInInv . '/' . $items[1];
        } else {
            echo '<img src="http://w1.dwar.ru/images/slot-empty.png" /><br />&nbsp;';
        }
        echo '</div>';
    }
    echo '</td><td class="collection-ico" bgcolor="#FFFFFF" align="center"><b>=</b></td><td bgcolor="#FFFFFF" align="center"><img src="/img/image/weapon/' . $ResultItem['gif'] . '" onmouseover="tooltip(this,ShowInfo(\'' . $ResultItem['name'] . '\',\'' . $ResultItem['gif'] . '\',\'' . lr($ResultItem['price']) . '\',\'' . $ResultItem['slot'] . '\',\'' . $ResultItem['block'] . '\',\'' . $ResultItem['hand'] . '\',\'' . preg_replace('/@/', ':', $ResultItem['param']) . '\',\'' . preg_replace('/@/', ':', $ResultItem['need']) . '\',\'' . $ResultItem['massa'] . '\',\'' . $ResultItem['level'] . '\'));" onmouseout="hide_info(this);" /></td><td bgcolor="#FFFFFF" align="center"><input type=submit' . ($ParamsNeeds == true ? ' class=lbut' : ' class=lbutdis disabled') . ' value="Обменять" /></td></tr></table></form>';
}
echo '</td></tr></table>';
?>