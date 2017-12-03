<?php

//1 - покупка рецептов
//2 - находим рецепты которые соответствуют навыку игрока
//3 - запрос на получение имени, картинки и параметров предмета который будет изготовлен
//4 - вывод параметров создаваемого предмета
//5 - функция для получения параметров реагентов
//5.1 - запрос параметров реагента из БД (имя, картинка)
//5.2 - запрос в БД на количество данных предметов у игрока
//5.3 - вывод данных в виде таблицы для пользователя
//6 - проверяем есть ли у игрока кикае-то рецепты вообще, назначем переменную для более легкого поиска
//6.1 - ищем по рецептам игрока есть ли у него такой рецепт, если нет - кнопка "купить", если да - кнопка "создать"
//7 - создание зелий

if ($_GET['buy'] == 1 and intval($_POST['rid']) != "") {
    include($_SERVER["DOCUMENT_ROOT"] . "/gameplay/inc/craft_sys/custom_buy" . ".php");
}
if ($_GET['create'] == 1 and intval($_POST['rid']) != "") {
    include($_SERVER["DOCUMENT_ROOT"] . "/gameplay/inc/craft_sys/custom_create" . ".php");
}
$player = player();
$pt = allparam($player);
if (intval($_GET['rec'])) {
    switch (intval($_GET['rec'])) {
        case 1:
            $_SESSION['user']['hospi_rec'] = 1;
            break;
        case 2:
            $_SESSION['user']['hospi_rec'] = 2;
            break;
    }
}
if ($_SESSION['user']['hospi_rec'] == '') {
    $_SESSION['user']['hospi_rec'] = 1;
}
echo '
<font class=proce><font color=#222222>
<FIELDSET><LEGEND align=center><B><font color=gray>&nbsp;Доступные рецепты&nbsp;<br><a href=main.php?hospi_sel=4&rec=1><font class=zaya ' . ($_SESSION['user']['hospi_rec'] == 1 ? 'style="color: red;"' : '') . '><b>Мази</b></font></a> | <a href=main.php?hospi_sel=4&rec=2><font class=zaya ' . ($_SESSION['user']['hospi_rec'] == 2 ? 'style="color: red;"' : '') . '><b>Руны</b></font></a></font></B></LEGEND>
<table cellpadding=0 cellspacing=0 border=0 width=100% bgcolor=#e0e0e0 align=center>
<tr><td>
<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
		<tr class=nickname bgcolor=#EAEAEA>
			<td align=center width=50% colspan=2><b>Рецепт</b></td>
			<td align=center width=50%><b>Реагенты</b></td>	
		</tr>';
switch ($_SESSION['user']['hospi_rec']) {
    case 1:
        $str = "WHERE `items`.`type`='w70'";
        break;
    case 2:
        $str = "WHERE `items`.`type`='w71' OR `items`.`type`='w100'";
        break;
}
$_GET['rec'] = $_SESSION['user']['hospi_rec'];
$recipes = mysqli_query($GLOBALS['db_link'], "SELECT `custom_rec`.* FROM `custom_rec` INNER JOIN `items` ON `custom_rec`.`protype` = `items`.`id` " . $str . " ORDER BY `custom_rec`.`id`;"); //2 - находим рецепты которые соответствуют навыку игрока
//$recipes = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `custom_rec` ORDER BY `id`;"); //2 - находим рецепты которые соответствуют навыку игрока
$grassit = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `items` WHERE `type`='w66' OR `type`='w67' OR `type`='w68' OR `type`='w69' OR `type`='w70'  OR `type`='w71' OR `type`='w100';");
while ($grow = mysqli_fetch_assoc($grassit)) {
    $plcol[$grow['id']] = mysqli_num_rows(mysqli_query($GLOBALS['db_link'], "SELECT `invent`.`id_item`,`invent`.`bank` FROM `invent` WHERE `protype`='" . $grow['id'] . "' AND `pl_id`='" . $player['id'] . "' AND `bank`='0';"));
}
while ($row = mysqli_fetch_assoc($recipes)) {
    $rec_inf = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT `items`.`name`,`items`.`gif`,`items`.`param` FROM `items` WHERE `items`.`id`='" . $row['protype'] . "' LIMIT 1;"));  //3 - запрос на получение имени, картинки и параметров предмета который будет изготовлен
    $rec_inf['dolg'] = "";
    $par = explode("|", $rec_inf['param']);
    foreach ($par as $value) {
        $param = explode("@", $value);
        switch ($param[0]) {
            case 2:
                $rec_inf['dolg'] = $param[1];
                break;
        }
    }
    $reg = explode("|", $row['reagents']);
    //4 - вывод параметров создаваемого предмета
    echo '
			<tr class=nickname bgcolor=white>
			<td align=center rowspan=2>
				<img src="http://img.legendbattles.ru/image/weapon/' . $rec_inf['gif'] . '" onmouseover="tooltip(this,\'<b>' . $rec_inf['name'] . '</b><br><b><font color=#336699>Щелкните по изображению для просмотра подробной информации о предмете.</font></b>\')" onmouseout="hide_info(this)" onclick="window.open(\'http://www.legendbattles.ru/iteminfo.php?' . $rec_inf['name'] . '\');" style="cursor:pointer;" align=absmiddle>
			</td>
			<td align=center rowspan=2>
				<b>' . $rec_inf['name'] . '</b><br>Долговечность: ' . $rec_inf['dolg'] . '/' . $rec_inf['dolg'] . '<br>Количество создаваемых предметов: <b>' . $row['col'] . '</b> шт.
			</td>
			<td align=center>';
    $i = 0;
    foreach ($reg as $val) {
        //5
        $i++;
        $reagent = explode("@", $val);
        $regit = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT `items`.`name`,`items`.`gif` FROM `items` WHERE `items`.`id`='" . $reagent[0] . "' LIMIT 1;")); //5.1
        echo '<img src="http://img.legendbattles.ru/image/weapon/' . $regit['gif'] . '" ' . ($_GET['rec'] == 2 ? '' : 'width="35" height="35"') . '  onmouseover="tooltip(this,\'<b>' . $regit['name'] . '</b><br>Необходимо для создания: <b>' . $reagent[1] . '</b><br>В наличии: <b>' . (($plcol[$reagent[0]] < $reagent[1]) ? '<font color=red>' . $plcol[$reagent[0]] . '</font>' : '<font color=green>' . $plcol[$reagent[0]] . '</font>') . '</b><br><b><font color=#336699>Щелкните по изображению для просмотра подробной информации о предмете.</font></b>\')" onmouseout="hide_info(this)" onclick="window.open(\'http://legendbattles.ru/iteminfo.php?' . $regit['name'] . '\');" style="cursor:pointer;">&nbsp;&nbsp;';//5.3
        if ($i == 7) {
            echo "<br>";
            $i = 0;
        }
    }
    if ($player['custom_rec'] == "0") {
        $alhim_rec = "||||";
    } else {
        $alhim_rec = explode("|", $player['custom_rec']);
    }
    echo '</td></tr>
			<tr class=nickname bgcolor=white><td align=center>
			' . ((in_array($row['id'], $alhim_rec))
            ?
            '<form method=post action="main.php?hospi_sel=4&create=1"><input type="submit" class="lbut" value="Создать" /><input type=hidden name=rid value="' . $row['id'] . '"/></form>'
            :
            '<form method=post action="main.php?hospi_sel=4&buy=1"><button type="submit">Купить рецепт [ ' . lr($row['price']) . ' ]</button><input type=hidden name=rid value="' . $row['id'] . '"/></form>') . '
			</td>
			</tr>
			';//6.1
}
echo '</table></td></tr></table></FIELDSET>';
//===================================================
?>