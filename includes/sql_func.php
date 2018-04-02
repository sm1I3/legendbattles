<?

## функции логов действий игрока

// функция записи в лог
function player_actions($id, $type, $about)
{
    # $id = ид персонажа
    $pl = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT SQL_CACHE * FROM `user` WHERE `id`='" . $id . "' LIMIT 1;"));
    $txt = player_actions_text($type, $about, $pl);
    mysqli_query($GLOBALS['db_link'], "INSERT INTO `user_actions` (`pl_id`,`pl_login`,`pl_ip`,`pl_action`,`type`) VALUES ('" . $pl['id'] . "','" . $pl['login'] . "','" . $pl['ip'] . "','" . $txt . "','" . $type . "');");
}

// end

// функция форматирования строки для записи
function player_actions_text($type, $abt, $pl)
{
    # $about = строка с текстовым описанием действия. $type = тип действия
    $a = explode("@", $type);
    $about = explode("@", $abt);
    $fulltxt = array();
    for ($i = 0; $i <= count($a); $i++) {
        if ($about[$i] == '') {
            $about[$i] = 'данные не найдены, тип эвента: ' . intval($a[$i]);
        } // если вдруг забуду сделать описание
        switch (intval($a[$i])) {
            case 1:
                $fulltxt[$i] = $pl['login'] . ' получил уровень: <b><font color=#CC0000>' . $about[$i] . '</font></b>.';
                break; # получил уровень
            case 2:
                $fulltxt[$i] = $pl['login'] . ' получил опыт: <b><font color=#CC0000>' . $about[$i] . '</font></b>.';
                break; # получил опыт
            case 3:
                $fulltxt[$i] = '<b>DLR</b>: ' . $about[$i];
                break; # изменения в балансе DLR
            case 4:
                $fulltxt[$i] = '<b><img src=img/razdor/emerald.png width=14 height=14 valign=middle title=Изумруд></b>: ' . $about[$i];
                break; # изменения в балансе BAKS
            case 5:
                $fulltxt[$i] = '';
                break; # изменения в балансе LR
            case 6:
                $fulltxt[$i] = '';
                break; # счет в банке - LR(пополнение)
            case 7:
                $fulltxt[$i] = '';
                break; # счет в банке - LR(снятие)
            case 8:
                $fulltxt[$i] = '';
                break; # счет в банке - DLR(пополнение)
            case 9:
                $fulltxt[$i] = '';
                break; # счет в банке - DLR(снятие)
            case 10:
                $fulltxt[$i] = 'Куплен предмет (в дц): ' . $about[$i];
                break; # покупка в ДЦ
            case 11:
                $fulltxt[$i] = 'Продан предмет (в дц): ' . $about[$i];
                break; # продажа в ДЦ
            case 12:
                $fulltxt[$i] = 'Куплен предмет (в магазин): ' . $about[$i];
                break; # покупка в магазине
            case 13:
                $fulltxt[$i] = 'Продан предмет (в магазин): ' . $about[$i];
                break; # продажа в магазин
            case 14:
                $fulltxt[$i] = 'Арендован артефакт: ' . $about[$i];
                break; # аренда в ДЦ
            case 15:
                $fulltxt[$i] = 'Взят в рассрочку артефакт: ' . $about[$i];
                break; # рассрочка в ДЦ
            case 16:
                $fulltxt[$i] = 'Первод ЛР другому игроку: ' . $about[$i];
                break; # перевод другим персонажам (LR)
            case 17:
                $fulltxt[$i] = 'Первод ДЛР другому игроку: ' . $about[$i];
                break; # перевод другим персонажам (DLR)
            case 18:
                $fulltxt[$i] = '';
                break; # перевод от других персонажей (LR)
            case 19:
                $fulltxt[$i] = '';
                break; # перевод от других персонажей (DLR)
            case 20:
                $fulltxt[$i] = 'Куплен предмет (у игрока): ' . $about[$i];
                break; # покупка у игрока
            case 21:
                $fulltxt[$i] = 'Продан предмет (игроку): ' . $about[$i];
                break; # продажа игроку
            case 22:
                $fulltxt[$i] = $pl['login'] . ' получил бонус по реферальной системе: <b><font color=#CC0000>+' . $about[$i] . '</font> LR</b>.';
                break; # бонус по рефералке (LR)
            case 23:
                $fulltxt[$i] = 'Лицензии: ' . $about[$i];
                break; # лицензии
            case 24:
                $fulltxt[$i] = $about[$i] . ' <b>[рынок]</b>';
                break; # рынок
        }

    }
    # формируем табличку
    $text = '
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align=center>';
    for ($b = 0; $b <= count($fulltxt); $b++) {
        if ($fulltxt[$b] != '') {
            $text .= '
					<tr><td width=100% align=center>' . $fulltxt[$b] . '</td></tr>
					';
        }
    }
    $text .= '</table>';
    return $text;

}

function color_opt($font, $type)
{
    $color = array("000000", "FF3366", "CC0033", "FF3399", "CC0066", "FF6699", "CC3366", "990033", "FF6633", "CC3300", "FF3300", "FF6600", "FF9966", "CC6633", "993300", "FF9933", "CC6600", "FF9900", "FF99CC", "CC6699", "993366", "660033", "FF66CC", "CC3399", "990066", "FF33CC", "CC0099", "FF00CC", "FF0099", "FF0066", "FF0033", "FF0000", "FF3333", "CC0000", "FF6666", "CC3333", "990000", "FF9999", "CC6666", "993333", "660000", "CC9999", "996666", "663333", "FFCC99", "CC9966", "996633", "663300", "FFCC66", "CC9933", "996600", "FFCC33", "CC9900", "FFCC00", "CC99FF", "9966CC", "9966FF", "FFCCFF", "CC99CC", "996699", "663366", "FF99FF", "CC66CC", "CC33CC", "CC00CC", "6666CC", "3333CC", "000099", "000066", "0000CC", "0000FF", "336633", "339933", "669966", "009900", "006600", "00CC00", "3300FF", "00CCCC", "009999", "33CCCC", "006666", "336699", "003366", "003399", "0033CC", "3366FF", "336600", "339900", "33CC00", "00CC33", "00CCFF", "33CCFF", "0066CC", "6600FF");
    foreach ($color as $value) {
        $ret .= '<option value="' . $value . '" style="BACKGROUND: #' . ((!$ret) ? 'FFFFFF' : $value) . '"' . ($font == $value ? ' selected=selected' : '') . '>' . ((!$ret) ? 'СТАНДАРТНЫЙ' : '') . '</option>';
    }
    return $ret;
}

//function itemparams($par,$eff,$modstat,$damage_mod,$iz,$dolg,$slot,$need,$plstt,$itlevel,$itmass){
function itemparams($inv, $ITEM, $player, $plstt, $mass = 0)
{
    $par_i = '';
    $tr_b[0] = '';
    $tr_b[1] = 0;
    if ($ITEM['slot'] == 16) {
        $par_i .= "<font class=weaponch><b><font color=#cc0000>Можно одевать на кольчуги</font></b><br>";
    }
    $par_i .= blocks2($ITEM['block']);
    $par = explode("|", $ITEM['param']);
    $mod = explode("|", $ITEM['mod']);
    $need = explode("|", $ITEM['need']);
    if ($inv == 1) {
        //торговая лицензия персонажа
        if ($player[level] < 5) {
            $licen = 1;
        } else {
            $licen = tradelic($player['licens'], 1);
        }
        //
        $iz = $ITEM[dolg] - $ITEM[iznos];
        $izn = round(($iz / ($ITEM[dolg] / 100)) * 0.62);
        $pro = 62 - $izn;
        if ($ITEM[dd_price] > 0) {
            $licen = 0.75;
            $price_dd = round(($ITEM[dd_price] * $licen * $iz / $ITEM[dolg]), 2);
        } else if ($ITEM[gift] == 1) {
            $licen = 0.4;
            $price = round($ITEM[price] * $licen * $iz / $ITEM[dolg]);
            if ($price < 1) {
                $price = 1;
            }
        } else {
            $price = round($ITEM[price] * $licen * $iz / $ITEM[dolg]);
            if ($price < 1) {
                $price = 1;
            }
        }
        $arr[3] = $price;
        $arr[4] = $price_dd;
    }
    $modstat = '';
    foreach ($mod as $value) {
        $modstats = explode("@", $value);
        $modstat[$modstats[0]] = $modstats[1];
    }
    //параметры
    //if($par){
    if ($ITEM['type'] == 'w70') {
        if ($ITEM['effect'] > 0) {
            $par_i .= "&nbsp;Время действия: <font color=#BB0000><b>" . $ITEM['effect'] . "</b></font> минут<br>";
        }
        switch ($ITEM['num_a']) {
            case '32':
                $par_i .= "&nbsp;Снимает эффекты: <font color=#BB0000><b>мази.</b></font><br>";
                break;
            case '33':
                $par_i .= "&nbsp;Снимает эффекты: <font color=#BB0000><b>травмы.</b></font><br>";
                break;
            case '34':
                $par_i .= "&nbsp;Снимает эффекты: <font color=#BB0000><b>зелья, абилки.</b></font><br>";
                break;
            case '1':
                $par_i .= "&nbsp;Снимает эффекты: <font color=#BB0000><b>травмы, зелья, абилки, мази.</b></font><br>";
                break;
            case '2':
                $par_i .= "&nbsp;Снимает эффекты: <font color=#BB0000><b>травмы, зелья, абилки, мази.<br>&nbsp;Со всех персонажей на клетке.</b></font><br>";
                break;
            case '3':
                $par_i .= "&nbsp;Снимает эффекты: <font color=#BB0000><b>мази.<br>&nbsp;Со всех персонажей на клетке.</b></font><br>";
                break;
            case '4':
                $par_i .= "&nbsp;Снимает эффекты: <font color=#BB0000><b>травмы.<br>&nbsp;Со всех персонажей на клетке.</b></font><br>";
                break;
            case '5':
                $par_i .= "&nbsp;Снимает эффекты: <font color=#BB0000><b>зелья, абилки.<br>&nbsp;Со всех персонажей на клетке.</b></font><br>";
                break;
        }
    }
    foreach ($par as $value) {
        $stat = explode("@", $value);
        if ($stat[1] > 0) {
            $plus = "+";
        } else {
            $plus = "";
        }
        if ($stat[0] > 4 and $stat[0] < 11 and $stat[0] != 9) {
            $percent = "%";
        } else {
            $percent = "";
        }
        if ($stat[0] == 1) {
            $pr = explode("-", $modstat[1]);
            $pri = explode("-", $stat[1]);
            if ($stat[1]) {
                $modstroke = "" . ($modstat[1] != '' ? ($pr[0] + $pri[0]) . "-" . ($pr[1] + $pri[1]) . "$percent  </b>[" . ($modstat[1] > 0 ? "<font color=green> <b>" . $modstat[1] . "</b>$percent" : "<font color=red><b>" . $modstat[1] . "</b>$percent") . "</font></b> ]<b> " : "$stat[1]$percent") . "";
            }
        } else {
            $modstroke = "" . ($modstat[$stat[0]] != '' ? $stat[1] + $modstat[$stat[0]] . "$percent  </b>[" . ($modstat[$stat[0]] > 0 ? "<font color=green>+<b>" . $modstat[$stat[0]] . "</b>$percent" : "<font color=red><b>" . $modstat[$stat[0]] . "</b>$percent") . "</font></b> ]<b> " : "$stat[1]$percent") . "";
        }
        $use5 = array('1', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '56', '57', '58', '59', '60', '61', '62', '63', '64', '65', '66', '67', '68', '69', '70', '71', 'expbonus', 'massbonus');
        $use3 = array('Удар:', 'Карманов:', 'Материал:', 'Уловка:', 'Точность:', 'Сокрушение:', 'Стойкость:', 'Класс брони:', 'Пробой брони:', 'Пробой колющим ударом:', 'Пробой режущим ударом:', 'Пробой проникающим ударом:', 'Пробой пробивающим ударом:', 'Пробой рубящим ударом:', 'Пробой карающим ударом:', 'Пробой отсекающим ударом:', 'Пробой дробящим ударом:', 'Защита от колющих ударов:', 'Защита от режущих ударов:', 'Защита от проникающих ударов:', 'Защита от пробивающих ударов:', 'Защита от рубящих ударов:', 'Защита от карающих ударов:', 'Защита от отсекающих ударов:', 'Защита от дробящих ударов:', 'НР:', 'Очки действия:', 'Мана:', 'Мощь:', 'Проворность:', 'Везение:', 'Здоровье:', 'Разум:', 'Сноровка:', 'Владение мечами:', 'Владение топорами:', 'Владение дробящим оружием:', 'Владение ножами:', 'Владение метательным оружием:', 'Владение алебардами и копьями:', 'Владение посохами:', 'Владение экзотическим оружием:', 'Владение двуручным оружием:', 'Магия огня:', 'Магия воды:', 'Магия воздуха:', 'Магия земли:', 'Сопротивление магии огня:', 'Сопротивление магии воды:', 'Сопротивление магии воздуха:', 'Сопротивление магии земли:', 'Воровство:', 'Осторожность:', 'Скрытность:', 'Наблюдательность:', 'Торговля:', 'Странник:', 'Рыболов:', 'Лесоруб:', 'Ювелирное дело:', 'Самолечение:', 'Оружейник:', 'Доктор:', 'Самолечение:', 'Быстрое восстановление маны:', 'Лидерство:', 'Алхимия:', 'Развитие горного дела:', 'Травничество:', "<font color=#BB0000>Коэффициент: $plus</font>", "Бонус опыта: <font color=#BB0000>$plus<b>" . $modstroke . "%</b></font><br> Максимальный опыт: <font color=#BB0000>$plus<b>" . $modstroke . "%</b></font><br>", "Масса: <font color=#BB0000>$plus<b>" . $modstroke . "</b></font>");
        for ($i = 0; $i <= 72; $i++)
            switch ($stat[0]) {
                //case 0: $par_i.= "&nbsp;Гравировка: <b>".$modstroke."</b><br>"; break;

                case $use5[$i]:
                    $par_i .= "&nbsp;$use3[$i] <b>" . $modstroke . "</b><br>";
                    break;


            }
    }

    if ($ITEM['type'] == 'w71') {
        $par_i .= "&nbsp;<b>Комплект:</b> <font color=#BB0000><b>4 одинаковые руны</b></font><br>";
        $par_i .= "&nbsp;<b>Бонус комплекта:</b> <font color=#BB0000>+<b>100% к статам рун</b> </font><br>";
    }
    if ($ITEM['damage_mod']) {
        $dmodarr = array(1 => '&nbsp;Урон огнем', 2 => '&nbsp;Урон льдом', 3 => '&nbsp;Вампиризм', 4 => '&nbsp;Лечение');
        $dmgm = explode("|", $ITEM['damage_mod']);
        foreach ($dmgm as $val) {
            $dmod = explode("@", $val);
            switch ($dmod[0]) {
                case 1:
                    $par_i .= $dmodarr[$dmod[0]] . ': <b><font color="#B00000">' . $dmod[1] . '</b></font><br>';
                    break;
                case 2:
                    $par_i .= $dmodarr[$dmod[0]] . ': <b><font color="#000099">' . $dmod[1] . '</b></font><br>';
                    break;
                case 3:
                    $par_i .= $dmodarr[$dmod[0]] . ': <b><font color="#6633CC">' . $dmod[1] . '</b></font><br>';
                    break;
                case 4:
                    $par_i .= $dmodarr[$dmod[0]] . ': <b><font color="#FFBB88">' . $dmod[1] . '</b></font><br>';
                    break;
            }
        }
    }
    $immunes = explode("|", $ITEM['immunes']);
    $immunes_arr = array(
        0 => '&nbsp;<b><font color="#993399">Иммунитет к огню.</b></font><br><b><font color="#B00000">Одновременно у персонажа может быть только 1 иммунитет.</b></font><br>',
        1 => '&nbsp;<b><font color="#993399">Иммунитет к льду.</b></font><br><b><font color="#B00000">Одновременно у персонажа может быть только 1 иммунитет.</b></font>',
        2 => '&nbsp;<b><font color="#993399">Иммунитет к вампиризму.</b></font><br><b><font color="#B00000">Одновременно у персонажа может быть только 1 иммунитет.</b></font>',
        3 => '&nbsp;<b><font color="#993399">Иммунитет к яду.</b></font><br><b><font color="#B00000">Одновременно у персонажа может быть только 1 иммунитет.</b></font>',
        4 => '&nbsp;<b><font color="#993399">Иммунитет к физическому урону.</b></font><br><b><font color="#B00000">Одновременно у персонажа может быть только 1 иммунитет.</b></font>'
    );
    foreach ($immunes as $key => $val) {
        if ($val == 1) {
            $par_i .= $immunes_arr[$key];
        }
    }
    //return $par_i;
    //}
    //требования
    //if($need and $plstt and $ITEM['level']>=0 and $Imass>=0){
    foreach ($need as $value) {
        $treb = explode("@", $value);
        if ($treb[0] == 72) {
            $treb[1] = $ITEM['level'];
        }
        if ($treb[0] == 71) {
            $treb[1] = $ITEM['massa'];
            if ($mass - $plstt[71] < $treb[1]) {
                $treb[1] = "<font color=#cc0000>$treb[1]</font>";
            }
        }
        if ($treb[0] == 73) {
            $Doblest = array(0 => 'Стажер', 1 => 'Солдaт', 2 => 'Боeц', 3 => 'Воин', 4 => 'Элитный воин', 5 => 'Чeмпион', 6 => 'Глaдиaтор', 7 => 'Полководeц', 8 => 'Мaстeр войны', 9 => 'Гeрой', 10 => 'Военный эксперт', 11 => 'Магистр войны', 12 => 'Вершитель', 13 => 'Высший магистр', 14 => 'Повелитель');
            $trtmp = $treb[1];
            $treb[1] = $Doblest[$treb[1]];
            if ($player['u_lvl'] < $trtmp) {
                $treb[1] = "<font color=#cc0000>" . $treb[1] . "</font>";
                $tr_b[1] = 1;
            }
        }
        if ($treb[0] == 74) {
            $trtmp = $treb[1];
            $treb[1] = $treb[1];
            if ($player['vzlomshik_nav'] < $trtmp) {
                $treb[1] = "<font color=#cc0000>" . $treb[1] . "</font>";
                $tr_b[1] = 1;
            }
        }
        if ($treb[0] != 28 and $treb[0] != 71 and $treb[0] != 73 and $treb[0] != 74) {
            if ($plstt[$treb[0]] < $treb[1]) {
                $treb[1] = "<font color=#cc0000>$treb[1]</font>";
                $tr_b[1] = 1;
            }
        }
        switch ($treb[0]) {
            case 28:
                $tr_b[0] .= "&nbsp;Очки действия: <b>$treb[1]</b><br>";
                break;
            case 30:
                $tr_b[0] .= "&nbsp;Мощь: <b>$treb[1]</b><br>";
                break;
            case 31:
                $tr_b[0] .= "&nbsp;Проворность: <b>$treb[1]</b><br>";
                break;
            case 32:
                $tr_b[0] .= "&nbsp;Везение: <b>$treb[1]</b><br>";
                break;
            case 33:
                $tr_b[0] .= "&nbsp;Здоровье: <b>$treb[1]</b><br>";
                break;
            case 34:
                $tr_b[0] .= "&nbsp;Разум: <b>$treb[1]</b><br>";
                break;
            case 35:
                $tr_b[0] .= "&nbsp;Сноровка: <b>$treb[1]</b><br>";
                break;
            case 36:
                $tr_b[0] .= "&nbsp;Владение мечами: <b>$treb[1]</b><br>";
                break;
            case 37:
                $tr_b[0] .= "&nbsp;Владение топорами: <b>$treb[1]</b><br>";
                break;
            case 38:
                $tr_b[0] .= "&nbsp;Владение дробящим оружием: <b>$treb[1]</b><br>";
                break;
            case 39:
                $tr_b[0] .= "&nbsp;Владение ножами: <b>$treb[1]</b><br>";
                break;
            case 40:
                $tr_b[0] .= "&nbsp;Владение метательным оружием: <b>$treb[1]</b><br>";
                break;
            case 41:
                $tr_b[0] .= "&nbsp;Владение алебардами и копьями: <b>$treb[1]</b><br>";
                break;
            case 42:
                $tr_b[0] .= "&nbsp;Владение посохами: <b>$treb[1]</b><br>";
                break;
            case 43:
                $tr_b[0] .= "&nbsp;Владение экзотическим оружием: <b>$treb[1]</b><br>";
                break;
            case 44:
                $tr_b[0] .= "&nbsp;Владение двуручным оружием: <b>$treb[1]</b><br>";
                break;
            case 45:
                $tr_b[0] .= "&nbsp;Магия огня: <b>$treb[1]</b><br>";
                break;
            case 46:
                $tr_b[0] .= "&nbsp;Магия воды: <b>$treb[1]</b><br>";
                break;
            case 47:
                $tr_b[0] .= "&nbsp;Магия воздуха: <b>$treb[1]</b><br>";
                break;
            case 48:
                $tr_b[0] .= "&nbsp;Магия земли: <b>$treb[1]</b><br>";
                break;
            case 53:
                $tr_b[0] .= "&nbsp;Воровство: <b>$treb[1]</b><br>";
                break;
            case 54:
                $tr_b[0] .= "&nbsp;Осторожность: <b>$treb[1]</b><br>";
                break;
            case 55:
                $tr_b[0] .= "&nbsp;Палач: <b>$treb[1]</b><br>";
                break;
            case 56:
                $tr_b[0] .= "&nbsp;Наблюдательность: <b>$treb[1]</b><br>";
                break;
            case 57:
                $tr_b[0] .= "&nbsp;Торговля: <b>$treb[1]</b><br>";
                break;
            case 58:
                $tr_b[0] .= "&nbsp;Странник: <b>$treb[1]</b><br>";
                break;
            case 59:
                $tr_b[0] .= "&nbsp;Рыболов: <b>$treb[1]</b><br>";
                break;
            case 60:
                $tr_b[0] .= "&nbsp;Лесоруб: <b>$treb[1]</b><br>";
                break;
            case 61:
                $tr_b[0] .= "&nbsp;Ювелирное дело: <b>$treb[1]</b><br>";
                break;
            case 62:
                $tr_b[0] .= "&nbsp;Самолечение: <b>$treb[1]</b><br>";
                break;
            case 63:
                $tr_b[0] .= "&nbsp;Оружейник: <b>$treb[1]</b><br>";
                break;
            case 64:
                $tr_b[0] .= "&nbsp;Доктор: <b>$treb[1]</b><br>";
                break;
            case 65:
                $tr_b[0] .= "&nbsp;Самолечение: <b>$treb[1]</b><br>";
                break;
            case 66:
                $tr_b[0] .= "&nbsp;Быстрое восстановление маны: <b>$treb[1]</b><br>";
                break;
            case 67:
                $tr_b[0] .= "&nbsp;Лидерство: <b>$treb[1]</b><br>";
                break;
            case 68:
                $tr_b[0] .= "&nbsp;Алхимия: <b>$treb[1]</b><br>";
                break;
            case 69:
                $tr_b[0] .= "&nbsp;Развитие горного дела: <b>$treb[1]</b><br>";
                break;
            case 70:
                $tr_b[0] .= "&nbsp;Травничество: <b>$treb[1]</b><br>";
                break;
            case 71:
                $tr_b[0] .= "&nbsp;Масса: <b>$treb[1]</b><br>";
                break;
            case 72:
                $tr_b[0] .= "&nbsp;Уровень: <b>$treb[1]</b><br>";
                break;
            case 73:
                $tr_b[0] .= "&nbsp;Звание: <b>$treb[1]</b><br>";
                break;
            case 74:
                $tr_b[0] .= "&nbsp;Взломщик: <b>$treb[1]</b><br>";
                break;
            case 75:
                $tr_b[0] .= "&nbsp;Колдун: <b>$treb[1]</b><br>";
                break;
        }
    }
    $arr[0] = $par_i;
    $arr[1] = $tr_b;
    $arr[2] = $iz;
    return $arr;
    //}
}

function show_shop($type, $ITEMS, $mass)
{
    $player = player();
    $plstt = allparam($player);
    $freemass = $plstt[71];
    $shop = '';
    if ($type == '0') {
        //бабло
        $shop .= '
		<table cellpadding=0 cellspacing=0 border=0 width=100%>
			<tr><td >
			<table cellpadding=0 cellspacing=1 border=0 width=90% align=center bgcolor="#B9A05C">
			<tr>
				<td colspan=3 bgcolor="#FCFAF3">
					<div align=center><font class=inv><b> У Вас с собой ' . lr($player[nv]) . ' и вещей массой: ' . $plstt[71] . ' Максимальный вес: ' . $mass . '</b></div>
				</td>
			</tr>';
        //
        $i = 0;
        $r = 1;
        while ($ITEM = mysqli_fetch_assoc($ITEMS)) {
            $bt = 0;
            $tr_b = '';
            $par_i = '';
            $pararr = '';
            $m = 1;
            $pararr = itemparams(0, $ITEM, $player, $plstt, $mass);
            $tr_b = $pararr[1][0];
            $iz = $pararr[2];//требования
            $bt = $pararr[1][1]; //доступность кнопок
            $par_i = $pararr[0]; //параметры
            if ($i == 0) {
                $shop .= '<tr id="test_' . $r . '">';
            }
            $shop .= '
			<td width=33% height=100% valign=top>
				<table cellpadding=0 cellspacing=0 border=0 width=100% class="t' . $r . '" bgcolor="#FCFAF3" onmouseover="light(this);" onmouseout="unlight(this);">
				<tr><td width=100% height=35 valign=middle align=center colspan=5><font class=nickname><b>';
            if ($player['nv'] >= $ITEM['price'] AND $ITEM['kol'] > 0 and $m != 0) {
                //$shop .= '<input type=button class=invbut onclick="location=\'main.php?post_id=1&wsuid='.$ITEM['id'].'&vcode='.scode().'\'" value="купить">&nbsp;';
                $shop .= 'Количество: <input type=text class=logintextbox7 name=col value=1 onkeyup="writeBuyShops(this.value,\'' . $ITEM['id'] . '\',\'' . scode() . '\');">&nbsp;';
                $shop .= '<b id="buybutton_' . $ITEM['id'] . '"><input type=button class=invbut onclick="location=\'main.php?post_id=110&act=3&col=1&uid=' . $ITEM['id'] . '&vcode=' . scode() . '\'" value="Купить"></b>&nbsp;';
            }
            if ($player['login'] == 'Зов Ада' or $player['login'] == 'Администрация') {
                $shop .= '<input type=button class=invbut onclick="location=\'main.php?post_id=111&wsuid=' . $ITEM['id'] . '&market=' . $ITEM['market'] . '&vcode=' . scode() . '\'" value="Удалить из магазина">';
                $shop .= '	<script>
						AddItem = function(iditem,name){
							jQuery.get(\'/includes/addons/admin-action/adm.php\',{ id_adm: 99, giveitem: 1, forlogin: \'' . $player['login'] . '\', idit: iditem});
							parent.$(\'#basic-modal-content\').html("Получен предмет: <b>"+name+"</b>.");
							parent.ShowModal();
						}
						Edit = function(id){
							parent.$(\'#basic-modal-content\').html(\'<iframe src="/includes/addons/admin-action/adm.php?id_adm=4&edit=yes&idit=\'+id+\'" id="useaction" name="useaction" scrolling="auto" style="width:\'+(screen.width-100)+\'px;height:\'+(screen.height-300)+\'px;" frameborder="0"></iframe>\');
							parent.ShowModal();
						}
						</script>
					';
                $shop .= " <input type=button class=invbut onclick=\"Edit(" . $ITEM['id'] . ");\" value=\"Редактировать\">";

            }
            $shop .= '<br>' . $ITEM['name'] . '</b><font class=weaponch> (количество: ' . (($ITEM['kol'] > 0) ? '<font color=green>' . $ITEM['kol'] . '</font>' : '<font color=red>' . $ITEM['kol'] . '</font>') . ')
				</td></tr>
				<tr>
				<td height=100% rowspan=2>
					<div align=center><img src=img/image/weapon/' . $ITEM['gif'] . ' border=0></div>
				</td>
					<td bgcolor=#D8CDAF width=50% height=15>
					<div align=center><font class=invtitle>свойства</div></td>
					<td bgcolor=#B9A05C><img src=img/image/1x1.gif width=1 height=1></td>
					<td bgcolor=#D8CDAF width=50%><div align=center><font class=invtitle>требования</div></td></tr>
					<tr><td>
					<font class=weaponch>&nbsp;Цена: <b>';
            if ($player['login'] == 'Зов Ада') {
                $shop .= '<input type=text class=logintextbox8 name=col value=' . $ITEM['price'] . ' onkeyup="editPriceShops(this.value,\'' . $ITEM['id'] . '\',\'' . scode() . '\');">&nbsp;';
                $shop .= '<b id="edbutton_' . $ITEM['id'] . '"><input type=button class=invbut onclick="location=\'main.php?post_id=110&act=5&pr=' . $ITEM['price'] . '&uid=' . $ITEM['id'] . '&vcode=' . scode() . '\'" value="Изменить цену"></b>&nbsp;';
            } elseif ($ITEM['price'] > $player['nv']) {
                $shop .= '<font color=#cc0000>' . lr($ITEM['price']) . '</font>';
            } else {
                $shop .= lr($ITEM['price']);
            }
            $shop .= '</b><br>';
            $shop .= $par_i;
            $shop .= '
					</td><td bgcolor=#B9A05C><img src=img/image/1x1.gif width=1 height=1></td>
					<td>
					<font class=weaponch>';
            $shop .= $tr_b;
            $shop .= '
			</font>
			</td></tr></table></td>';
            $i++;
            if ($i == 2) {
                $shop .= '</tr>';
                $i = 0;
                $r++;
            }
        }
        $shop .= '
			<script>
				parent.$("#main_top").ready(function(){
					for(var r=1;r<=' . $r . ';r++){
						parent.$("#main_top").contents().find("table.t"+r).css({height: parent.$("#main_top").contents().find("#test_"+r).height()+"px"});
					}
				});
				function light(el)
				{
					el.style.backgroundColor = "#DFCC88";
				}
				function unlight(el)
				{
					el.style.backgroundColor = "";
				}
			</script>';
    } elseif ($type == 'dealers') {
        $shop .= '
			<script>
			var buttons;
			buttons = [];
			</script>
			<tr>
			<td>
			<img src=img/image/1x1.gif width=1 height=10>
			</td>
			</tr>
			<table cellpadding=0 cellspacing=0 border=0 width=100%>
			<tr><td><FIELDSET style="background: white;" name=field_dealers id=field_dealers><LEGEND align=center style="background: white; -moz-border-radius: 8px;-webkit-border-radius: 8px;border-radius: 8px;border: solid 1px gray;"><b> <font color=gray>У Вас с собой ' . $player[baks] . ' <img src=img/razdor/emerald.png width=14 height=14 valign=middle title=Изумруд></font> </b></LEGEND><table cellpadding=3 cellspacing=1 border=0 width=100% bgcolor=#e0e0e0>
			';
        $freemass = $plstt[71];
        while ($ITEM = mysqli_fetch_assoc($ITEMS)) {
            $bt = 0;
            $tr_b = '';
            $par_i = '';
            $pararr = '';
            $m = 1;
            $pararr = itemparams(0, $ITEM, $player, $plstt, $mass);
            $tr_b = $pararr[1][0];
            $iz = $pararr[2];//требования
            $bt = $pararr[1][1]; //доступность кнопок
            $par_i = $pararr[0]; //параметры
            //аренда артов
            $buttons = Array();
            $buttons[1] = '';
            $buttons[2] = '';
            if ($ITEM[kol] > 0 and $m != 0 and $ITEM[type] != 'w61' and $ITEM[type] != 'w0' and $ITEM[type] != 'w66' and $ITEM[type] != 'w69' and $ITEM[type] != 'w68' and $ITEM[type] != 'w29' and $ITEM[type] != 'w70') {
                $buttons[1] .= '<input type=button class=invbut ' . ($player[baks] >= round($ITEM[dd_price] * 3 / 110 + 1) ? 'onclick="location=\\\'main.php?post_id=94&act=4&wsuid=' . $ITEM[id] . '&vcode=' . scode() . '\\\'"' : '') . ' value="3 дня (' . round($ITEM[dd_price] * 3 / 110 + 1) . '$) ">';
                $buttons[1] .= '&nbsp;<input type=button class=invbut ' . ($player[baks] >= round($ITEM[dd_price] * 3 / 80 + 2) ? 'onclick="location=\\\'main.php?post_id=94&act=5&wsuid=' . $ITEM[id] . '&vcode=' . scode() . '\\\'"' : '') . ' value="7 дней (' . round($ITEM[dd_price] * 3 / 80 + 2) . '$) ">';
                $buttons[1] .= '&nbsp;<input type=button class=invbut ' . ($player[baks] >= round($ITEM[dd_price] * 3 / 50 + 3) ? 'onclick="location=\\\'main.php?post_id=94&act=1&wsuid=' . $ITEM[id] . '&vcode=' . scode() . '\\\'"' : '') . ' value="10 дней (' . round($ITEM[dd_price] * 3 / 50 + 3) . '$) ">';
                $buttons[1] .= '&nbsp;<input type=button class=invbut ' . ($player[baks] >= round($ITEM[dd_price] * 3 / 35 + 4) ? 'onclick="location=\\\'main.php?post_id=94&act=2&wsuid=' . $ITEM[id] . '&vcode=' . scode() . '\\\'"' : '') . ' value="20 дней (' . round($ITEM[dd_price] * 3 / 35 + 4) . '$) ">';
                $buttons[1] .= '&nbsp;<input type=button class=invbut ' . ($player[baks] >= round($ITEM[dd_price] * 3 / 20 + 5) ? 'onclick="location=\\\'main.php?post_id=94&act=3&wsuid=' . $ITEM[id] . '&vcode=' . scode() . '\\\'"' : '') . ' value="30 дней (' . round($ITEM[dd_price] * 3 / 20 + 5) . '$) ">';
            }
            //рассрочка
            if ($ITEM[kol] > 0 and $m != 0 and $ITEM[type] != 'w61' and $ITEM[type] != 'w0' and $ITEM[type] != 'w66' and $ITEM[type] != 'w69' and $ITEM[type] != 'w68' and $ITEM[type] != 'w29' and $ITEM[type] != 'w70') {
                $buttons[2] .= '<input type=button class=invbut ' . ($player[baks] >= round($ITEM[dd_price] / 2 + 1) ? 'onclick="location=\\\'main.php?post_id=95&act=1&wsuid=' . $ITEM[id] . '&vcode=' . scode() . '\\\'"' : '') . ' value="1 месяц (' . round($ITEM[dd_price] / 2 + 1) . '$) ">';
                $buttons[2] .= '&nbsp;<input type=button class=invbut ' . ($player[baks] >= round($ITEM[dd_price] / 3 + 1) ? 'onclick="location=\\\'main.php?post_id=95&act=2&wsuid=' . $ITEM[id] . '&vcode=' . scode() . '\\\'"' : '') . ' value="2 месяца (' . round($ITEM[dd_price] / 3 + 1) . '$) ">';
                $buttons[2] .= '&nbsp;<input type=button class=invbut ' . ($player[baks] >= round($ITEM[dd_price] / 4 + 1) ? 'onclick="location=\\\'main.php?post_id=95&act=3&wsuid=' . $ITEM[id] . '&vcode=' . scode() . '\\\'"' : '') . ' value="3 месяца (' . round($ITEM[dd_price] / 4 + 1) . '$) ">';
            }
            $shop .= '
				<tr><td bgcolor=#f9f9f9><div align=center>
				<img src=img/image/weapon/' . $ITEM[gif] . ' border=0></div>
				</td><td width=100% bgcolor=#ffffff valign=top><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#ffffff width=100%>
				<font class=nickname2><b>';
            $shop .= $ITEM[name] . ' </b><font class=weaponch> (количество: ' . (($ITEM[kol] > 0) ? '<font color=green>' . $ITEM[kol] . '</font>' : '<font color=red>' . $ITEM[kol] . '</font>') . ')';
            if ($ITEM[type] != 'w61' and $ITEM[type] != 'w0' and $ITEM[type] != 'w66' and $ITEM[type] != 'w29' and $ITEM[type] != 'w69' and $ITEM[type] != 'w68' and $ITEM[type] != 'w70') {
                $shop .= '<br><b>Доступно:</b><a onClick="writebuttons(\'rassrok\',\'' . $ITEM['id'] . '\');"><b id="' . $ITEM['id'] . 'rassrok">&nbsp; Приобрести в рассрочку</b></a>&nbsp;|&nbsp;<a onClick="writebuttons(\'arenda\',\'' . $ITEM['id'] . '\');"><b id="' . $ITEM['id'] . 'arenda">Взять в аренду</b></a><br>';
            }
            $shop .= '
				<script>
				writebuttons = function(e,a){
					switch(e){
						case \'arenda\':
							document.getElementById(a).innerHTML = buttons[a][1]+\'<br><b>Арендованные вещи пропадают после окончания срока аренды!</b>\';
							document.getElementById(a).className = "";
							document.getElementById(a+\'arenda\').className = "cc0000";
							document.getElementById(a+\'rassrok\').className = "";
						break;
						case \'rassrok\':
							document.getElementById(a).innerHTML = buttons[a][2]+\'<br><b>При неуплате оставшейся суммы рассрочки вещь будет изъята!</b>\';
							document.getElementById(a).className = "";
							document.getElementById(a+\'arenda\').className = "";
							document.getElementById(a+\'rassrok\').className = "cc0000";
						break;
					}
				}
				</script>
				<script>
				buttons[' . $ITEM['id'] . '] = [\'\',\'' . $buttons[1] . '\',\'' . $buttons[2] . '\']
				</script>
				';
            $shop .= '
				<br><div id=' . $ITEM['id'] . ' class="invis">
				</div><br>';
            if ($player[baks] >= $ITEM[dd_price] AND $ITEM[kol] > 0 and $m != 0) {
                $shop .= '<input type=button class=invbut onclick="location=\'main.php?post_id=1&wsuid=' . $ITEM[id] . '&vcode=' . scode() . '\'" value="купить (' . $ITEM[dd_price] . '$)"> ';
            }
            if ($player['clan'] == 'Life') {
                $shop .= '<input type=button class=invbut onclick="location=\'main.php?post_id=111&wsuid=' . $ITEM['id'] . '&market=' . $ITEM['market'] . '&vcode=' . scode() . '\'" value="Удалить из магазина">';
                $shop .= '	<script>
						AddItem = function(iditem,name){
							jQuery.get("/includes/addons/admin-action/adm.php",{ id_adm: 99, giveitem: 1, forlogin: ' . $player["login"];
                $shop .= "<input type=button class=invbut onclick=Edit(" . $ITEM['id'] . "); value='Редактировать'>";

				}
            $shop .= ' < br />
				<img src = img / image / 1x1 . gif width = 1 height = 3 ></td ><td ><br >
				<img src = img / image / 1x1 . gif width = 1 height = 3 </td ></tr ><tr >
				<td colspan = 2 width = 100 %><table cellpadding = 0 cellspacing = 0 border = 0 width = 100 %><tr >
				<td bgcolor =#D8CDAF width=50%><div align=center><font class=proce style="font-size : 11px;"><b>свойства</b></div></td>
				<td bgcolor =#B9A05C><img src=img/image/1x1.gif width=1 height=1></td><td bgcolor=#D8CDAF width=50%>
				<div align = center ><font class=proce style = "font-size : 11px;" ><b > требования</b ></div ></td ></tr ><tr ><td bgcolor =#FCFAF3>
				<font class=weaponch >&nbsp;Цена: <b > ';
            if ($player['clan'] == 'Life') {
                $shop .= ' < input type = text class=logintextbox8 name = col value = ' . $ITEM['dd_price'] . ' onkeyup = "editPrice(this.value,\'' . $ITEM['id'] . '\',\'' . scode() . '\');" >&nbsp;';
					$shop .= ' < b id = "edbutton_'.$ITEM['id'].'" ><input type = button class=invbut onclick = "location=\'main.php?post_id=110&act=4&pr='.$ITEM['dd_price'].'&uid='.$ITEM['id'].'&vcode='.scode().'\'" value = "Изменить цену" ></b >&nbsp;';
				} elseif ($ITEM[dd_price] > $player[baks]) {
                $shop .= ' < font color =#cc0000>' . $ITEM[dd_price] . ' $</font>';
            }
				else{
                    $shop .= '' . $ITEM[dd_price] . ' <img src=img/razdor/emerald.png width=14 height=14 valign=middle title=Изумруд>';
                }
				$shop .= '</b><br>';

				//============= новая функция вывода параметров вещи => sql_func.php: function itemparams($par,$eff,$modstat,$damage_mod,$iz,$dolg,$slot,$need,$plstt,$itlevel,$itmass).
				//Адаптирована под магазины или вывод эффектов мазей. $par,$eff,$modstat,$damage_mod,$iz,$dolg,$slot,$need,$plstt,$itlevel,$itmass - могут быть пустыми. надо передать либо $par либо need
            $shop .= $par_i;
				//==== END ====
				$shop .= '
				</td><td bgcolor=#B9A05C><img src=img/image/1x1.gif width=1 height=1></td><td bgcolor=#FCFAF3>
				<font class=weaponch>' . $tr_b . '</font></td></tr></table></td></tr></table></td></tr>';
			}
        $shop .= '</table></FIELDSET>';
    }
    return $shop;
}

function blocks2($bl)
{
    $block = '';
    if ($bl != "") {
        switch ($bl) {
            case 40:
                $block = "<font class=weaponch><b><font color=#cc0000>Блокировка 1-ой точки</font></b><br>";
                break;
            case 70:
                $block = "<font class=weaponch><b><font color=#cc0000>Блокировка 2-х точек</font></b><br>";
                break;
            case 90:
                $block = "<font class=weaponch><b><font color=#cc0000>Блокировка 3-х точек</font></b><br>";
                break;
        }
    }
    return $block;
}


function varcheck($input)
{
    if (!is_array($input)) {
        if (is_numeric($input)) {

            #Функция актуальна при условии, если значение больше 0
            #Получает целочисленное значение переменной
            $number = intval($input);
            //echo 'numeric';
            return $number;
        } else {
            #Вырезаем html теги
            $out_string = strip_tags($input);
            #Преобразует специальные символы в HTML сущности.
            $out_string = htmlspecialchars($out_string);
            #Экранирует специальные символы в строке,принмимая во внимание кодировку соединения.
            $out_string = mysqli_real_escape_string($GLOBALS['db_link'], $out_string);
            return $out_string;

        }
    } else {
        foreach ($input as $key => $val) {
            $out_string[$key] = varcheck($val);
        }
        return $out_string;
    }
}

//тотемы
function totembuffs()
{
    $player = player();
    //$totemtime = Array('00','02','04','06','08','10','12','14','16','18','20','22');
    $totemtime = Array('10', '20', '02', '00', '22', '18', '12', '04', '14', '06', '08', '16');
    $bufftime = $totemtime[$player['thotem']];
    $buff = 0;
    if ($bufftime == date("H")) {
        $buff = 1;
    } elseif ($bufftime == (date("H") - 1)) {
        $buff = 1;
    }
    return $buff;
}

//енд_тотемы
//фильтр для предметов, которые не поддаются модификации, ремонту и т.д
function itemfilter()
{
    $filt = " AND `items`.`type`!='w0'  AND `items`.`type`!='w29' AND `items`.`type`!='w61'  AND `items`.`type`!='w66'  AND `items`.`type`!='w67' AND `items`.`type`!='w68' AND `items`.`type`!='w69' ";
    return $filt;
}

//наоборот
function itemfilter2()
{
    $filt = " `items`.`type`='w0'  AND `items`.`type`='w29' AND `items`.`type`='w61'  AND `items`.`type`='w66'  AND `items`.`type`='w67' AND `items`.`type`='w68' AND `items`.`type`='w69' ";
    return $filt;
}

//end_itemfilter

function chars($inp)
{
    $inp = htmlspecialchars($inp);
    $inp = preg_replace("[\'\"\<\>\/\%]", "", $inp);
    return $inp;
}

function tradelic($licens, $type)
{
    switch ($type) {
        case 1:
            $licen = 0.4;
            $lic = explode("|", $licens);
            foreach ($lic as $value) {
                $licnum = explode("@", $value);
                if ($licnum[0] == 1 and $licnum[1] > time()) {
                    $licen = 0.99;
                }
            }
            break;
        case 2:
            $licen = 0;
            $lic = explode("|", $licens);
            foreach ($lic as $value) {
                $licnum = explode("@", $value);
                if ($licnum[0] == 2 and $licnum[1] > time()) {
                    $licen = 1;
                }
            }
            break;
    }
    return $licen;
}

function bot($od, $hp, $hpa, $mp, $zn, $sil)
{
    if ($hp < ($hpa * 0.5) and $mp > 5 and $zn > 1) {
        $s[mag] = "320_0@";
    }
    if ($zn > $sil and $mpa > 50 and $mp > 10) {
        $s2 = "_2_100@";
    } else {
        $s2 = "_0_0@";
    }
    if ($od < 140) {
        $s[ud] = rand(0, 3) . $s2;
    } else {
        $s1 = rand(0, 2);
        $s[ud] = $s1 . $s2 . ($s1 + 1) . $s2;
    }
    $s[bl] = "0_" . rand(4, 25) . "_0@";
    return $s;
}

function chlevel($exp, $lev, $id)
{
    $user = $_SESSION['user'];
    $pers = player();
    $arr = exp_level($lev);
    $ref_bonus = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "
		SELECT * FROM `ref_system`
		WHERE `ref_id`='" . $pers['id'] . "'
		LIMIT 1;
	"));

    if (array_sum($exp) >= $arr['exp']) {
        if ($pers['level'] >= 9 and $pers['instructor'] > 0) {
            $pl = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `user` WHERE `id`='" . $pers['instructor'] . "'"));
            $PlExps = explode("|", $pl['exp']);
            mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `nv`=`nv`+'" . ((($row['good_pupils_count'] + 1) % 5 == 0) ? 2500 : 500) . "',`baks`=`baks`+'0.15',`exp`='" . $PlExps[0] . "|" . ($PlExps[1] + 100) . "|" . $PlExps[2] . "',`good_pupils_count`=`good_pupils_count`+'1' WHERE `id`='" . $pers['instructor'] . "'");
            mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `instructor`='0' WHERE `id`='" . $pers['id'] . "'");
            chmsg("parent.frames['chmain'].add_msg('<font class=yochattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><font color=#000000><b>Системная информация.</b></font> Персонаж <b>" . $pers["login"] . "</b>[" . $pers["level"] . "/" . $pers["u_lvl"] . "] закончил свое обучение, вы получили награду.</font><BR>'+'');", $pl['login']);
            echo "<script>parent.frames['chmain'].add_msg('<font class=yochattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><font color=#000000><b>Системная информация.</b></font> Вы успешно закончили свое обучение.</font><BR>'+'');</script>";
        }
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET level=level+1, nv=nv+$arr[nv],fr_bum=fr_bum+$arr[bum],fr_mum=fr_mum+$arr[mum],free_stat=free_stat+$arr[frs],nav=nav+$arr[nav] WHERE id='$id';");
        $typetolog .= '@1';
        $abouttolog .= '@' . $pers['level'] + 1; # получил уровень
        if ($ref_bonus['who_id']) { //бонус по рефералке
            $usrb = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `user` WHERE `id`='" . $ref_bonus['who_id'] . "' LIMIT 1;"));
            if ($usrb['id']) {
                $refparams = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `ref_adm` WHERE `id`='1' LIMIT 1;"));
                if ($refparams['money_bonus'] > 0) {
                    $givebonus = round($arr['nv'] * ($refparams['money_bonus'] / 100)) + 1;
                    if (mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `nv`=`nv`+'" . $givebonus . "' WHERE `id`='" . $usrb['id'] . "' LIMIT 1;")) {
                        $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><font color=#000000><b>Системная информация.</b></font> Вы получили бонус за взяние уровня рефералом: <b>" . lr($givebonus) . "</b>.</font><BR>'+'');";
                        chmsg($ms, $usrb['login']);
                        $typetolog2 = '0';
                        $abouttolog2 = '0'; # переменные для логов: первая всегда 0
                        $typetolog2 .= '@20';
                        $abouttolog2 .= '@' . $givebonus; # получил бонус по рефералке
                        # пишем в лог все что произошло
                        player_actions($usrb['id'], $typetolog2, $abouttolog2);
                        #
                    }
                    mysqli_query($GLOBALS['db_link'], "UPDATE `ref_system` SET `bonus_lr`=`bonus_lr`+'" . $givebonus . "' WHERE `ref_id`='" . $pers['id'] . "' AND `who_id`='" . $usrb['id'] . "' LIMIT 1;");
                }
            }
        }
        //event_to_log(date("H:i:s"),5,0,(($pers['clan_id']!='none') ? $pers['clan_gif'].':'.$pers['clan'].':'.$pers['clan_d'] : 'none'),$pers["login"],$pers["level"],$pers['sklon'],($pers["level"]+1));
        $ms = "top.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b><font color=FF3300> Персонаж <b>" . $pers['login'] . "</b> Достиг <b>" . ($lev + 1) . "</b> уровня.<img src=img/image/gg1.gif></font><BR>'+'');";
        chmsg($ms);
    }
    $PlExps = explode("|", $pers['exp']);
    $arr = doblest_level($pers['u_lvl']);
    if ($PlExps[2] >= $arr[1]) {
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET u_lvl=u_lvl+1 WHERE id='$id';");
        $ms = "top.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000>Персонаж <b>" . $pers['login'] . "</b> достиг очередного звания &quot;<b>" . $arr[2] . "</b>&quot;.</font><BR>'+'');";
        chmsg($ms);
    }
}

function doblest_level($level)
{
    $Doblest = array(
        0 => array(0, 0, 'Солдaт'),
        1 => array(1, 1000, 'Боец'),
        2 => array(2, 8000, 'Воин'),
        3 => array(3, 30000, 'Элитный воин'),
        4 => array(4, 1140000000, 'Чeмпион'),
        5 => array(5, 39600000000, 'Глaдиaтор'),
        6 => array(6, 300000000000, 'Полководeц'),
        7 => array(7, 4000000000000, 'Мaстeр войны'),
        8 => array(8, 50000000000000, 'Гeрой'),
        9 => array(9, 600000000000000, 'Военный эксперт'),
        10 => array(10, 70000000000000, 'Магистр войны'),
        11 => array(11, 800000000000000, 'Вершитель'),
        12 => array(12, 1200000000000000, 'Высший магистр'),
        13 => array(13, 18000000000000000, 'Повелитель'),
        14 => array(14, 270000000000000000000000000000, 'Повелитель Миров')
    );
    return $Doblest[$level];
}


function newbattle($style, $arena, $type, $time_start, $timeout, $travma, $downl, $upl, $koll, $downr, $upr, $kolr, $vis, $bt)
{
    mysqli_query($GLOBALS['db_link'], 'LOCK TABLES arena WRITE;');
    mysqli_query($GLOBALS['db_link'], 'INSERT INTO arena (style,arena,type,time,time_start,timeout,travma,downl,upl,kol1,downr,upr,kol2,vis,t2,bt) VALUES (' . AP . $style . AP . ',' . AP . $arena . AP . ',' . AP . $type . AP . ',' . AP . date("H:i:s") . AP . ',' . AP . $time_start . AP . ',' . AP . $timeout . AP . ',' . AP . $travma . AP . ',' . AP . $downl . AP . ',' . AP . $upl . AP . ',' . AP . $koll . AP . ',' . AP . $downr . AP . ',' . AP . $upr . AP . ',' . AP . $kolr . AP . ',' . AP . $vis . AP . ',' . AP . time() . AP . ',' . AP . $bt . AP . ');');
    $V01 = mysqli_query($GLOBALS['db_link'], 'SELECT MAX(id_battle) FROM arena LIMIT 1;');
    $V01 = mysqli_result($V01, 0);
    mysqli_query($GLOBALS['db_link'], "UNLOCK TABLES;");
    return $V01;
}

function savelog($log, $bat)
{
    $fp = fopen($_SERVER["DOCUMENT_ROOT"] . "/logs/" . $bat . ".txt", "a");
    fwrite($fp, $log . "\n");
    fclose($fp);
//	db_query('INSERT INTO logs (bid,log) VALUES ('.AP.$bat.AP.', '.AP.$log.AP.');');
}

function Show_Log($id, $mcount)
{
    $lines = file($_SERVER["DOCUMENT_ROOT"] . "/logs/" . $id . ".txt");
    $num = count($lines);
    if ($num < $mcount) {
        $start = 0;
    } else {
        $start = $num - $mcount;
    }
    $res = '';
    for ($i = $num; $i >= $start; $i--) {
        $res .= $lines[$i];
    }
    return $res;
}

function Show_Stat($id)
{
    $lines = file($_SERVER["DOCUMENT_ROOT"] . "/stats/" . $id . ".txt");
    $num = count($lines);
    $res = '';
    for ($i = 0; $i < $num; $i++) {
        $res .= $lines[$i];
    }
    return $res;
}

function log_write($act, $idit, $sum, $to, $ty)
{
    $user = $_SESSION['user'];
    if (empty($ip)) {
        if (getenv('HTTP_X_FORWARDED_FOR')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } else {
            $ip = getenv('REMOTE_ADDR');
        }
    }
    $user_agent = $_SERVER["HTTP_USER_AGENT"];
    if (strpos($user_agent, "Firefox") !== false) $browser = "Firefox";
    elseif (strpos($user_agent, "Opera") !== false) $browser = "Opera";
    elseif (strpos($user_agent, "Chrome") !== false) $browser = "Chrome";
    elseif (strpos($user_agent, "MSIE") !== false) $browser = "Internet Explorer";
    elseif (strpos($user_agent, "Safari") !== false) $browser = "Safari";
    else $browser = "Неизвестный";
    mysqli_query($GLOBALS['db_link'], 'INSERT INTO mlog (action,ip,brouser,id_item,sum,login,tologin,typ) VALUES (' . AP . $act . AP . ',' . AP . $ip . AP . ',' . AP . $browser . AP . ',' . AP . $idit . AP . ',' . AP . $sum . AP . ',' . AP . $user['login'] . AP . ',' . AP . $to . AP . ',' . AP . $ty . AP . ');');
}

function locations($loc, $pos)
{
    $room = '';
    $ct = (online_now(0)) + 50;
    $time = time() - 300;
    if ($loc != 28) {
        $rooms = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT loc.id, loc.loc, loc.room, loc.city FROM loc WHERE id='" . $loc . "' LIMIT 1;"));
        if ($rooms['room'] != '') {
            $room = ", $rooms[room]";
        } else if ($rooms['city'] != "") {
            $city = "$rooms[city], ";
        }
        $count = mysqli_num_rows(mysqli_query($GLOBALS['db_link'], "SELECT user.id, user.loc FROM user WHERE last >$time AND loc = '$loc'"));
    }
    if ($loc == 28) {
        list($pers['x'], $pers['y']) = explode('_', $pos);
        $rooms = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT `city`,`name` FROM `nature` WHERE `x`='" . $pers['x'] . "' AND `y`='" . $pers['y'] . "' LIMIT 1;"));
        $rooms['city'] = $rooms['city'] ? $rooms['city'] : 'Земли Баруса';
        if ($rooms['name'] != "") {
            $room = ", <font title=\"( " . $pers['x'] . " : " . $pers['y'] . " )\">$rooms[name]</font>";
        }
        if ($rooms['loc'] == '') {
            $city = "Земли Баруса";
        }
        $count = mysqli_num_rows(mysqli_query($GLOBALS['db_link'], "SELECT user.id FROM user WHERE last >$time AND pos = '$pos' AND loc='$loc'"));
    }
    if (strlen($count . $ct) < 3) {
        $wdth = 100 * 1.1;
    } elseif (strlen($count . $ct) < 4) {
        $wdth = 110 * 1.1;
    } elseif (strlen($count . $ct) < 5) {
        $wdth = 120 * 1.1;
    } elseif (strlen($count . $ct) < 6) {
        $wdth = 130 * 1.1;
    } elseif (strlen($count . $ct) < 7) {
        $wdth = 140 * 1.1;
    } elseif (strlen($count . $ct) < 8) {
        $wdth = 150 * 1.1;
    } elseif (strlen($count . $ct) < 9) {
        $wdth = 160 * 1.1;
    }
    echo '<table border=0 cellpadding=0 cellspacing=0 width=100%>
  <tr>
    <left>
<table width=300 border=0>
  <tr>
    <td width=135><span class="placename">Вы находитесь в локации:</span></td>
    <td width=155><span class="placename"><b>' . $city . $rooms['loc'] . $room . '</b></span></td>
  </tr>
  <tr>
    <td><span class="placename">Ваша позиция:</span></td>
    <td><span class="placename"><b>' . $pos . '</b></span></td>
  </tr>
  <tr>
    <td><span class="placename">Онлайн в игре сейчас:</span></td>
    <td><span class="placename"><b>' . $ct . '</b></td>
  </tr>
  <tr>
    <td><span class="placename">Игроков в локации:</span></td>
    <td><span class="placename"><b>' . $count . '</b></span></td>
  </tr>
</table>
</left><hr>';
    return $count;
}


function ar_rooms()
{
    $rooms = mysqli_query($GLOBALS['db_link'], "SELECT user.loc, Count(user.Login) AS Count FROM user WHERE (((user.last)>" . (time() - 299) . ") AND ((user.loc)='6' OR (user.loc)='7' OR (user.loc)='8' OR (user.loc)='9'  OR (user.loc)='10' OR (user.loc)='11' OR (user.loc)='12' OR (user.loc)='13' OR (user.loc)='14' OR (user.loc)='15')) GROUP BY user.loc ORDER BY user.loc;");
    $a['6'] = 0;
    $a['7'] = 0;
    $a['8'] = 0;
    $a['9'] = 0;
    $a['10'] = 0;
    $a['11'] = 0;
    $a['12'] = 0;
    $a['13'] = 0;
    $a['14'] = 0;
    $a['15'] = 0;
    while ($r = mysqli_fetch_assoc($rooms)) {
        $a[$r['loc']] = $r['Count'];
    }
    echo "$a[6],$a[7],$a[8],$a[9],$a[10],$a[11],$a[12],$a[13],$a[14],$a[15]";
}

function online($login, $pcid)
{//------добавление, обновление online----------------
    mysqli_query($GLOBALS['db_link'], 'UPDATE user SET pcid=' . AP . $pcid . AP . ',last=' . AP . time() . AP . ' WHERE login=' . AP . $login . AP . 'LIMIT 1;');
}

function online_now($loc)
{//------количество человек online------
    if ($loc == '0') {
        $sql = "SELECT * FROM user WHERE last >" . (time() - 300) . ";";
    } else {
        $sql = "SELECT user.login FROM user LEFT JOIN loc ON user.loc = loc.id WHERE (((user.loc)='" . $loc . "') AND ((user.last)>'" . (time() - 300) . "'));";
    }
    $result = mysqli_query($GLOBALS['db_link'], $sql);
    return mysqli_num_rows($result);
}

function option($pl, $num)
{
    $opt = explode('|', $pl);

    return $opt[$num];
}

function chat($login, $str)
{
    $chat = player();
    if ($chat['chat'] == 1) {
        $arr = explode(" ", $str);
        for ($i = 0; $i < strlen($str); $i++) {
            $arr[$i] = str_shuffle($arr[$i]);
            $res .= $arr[$i] . " ";
        }
        return $res;
    }
    if ($chat['chat'] == 0) {
        return $str;
    }
    if ($chat['chat'] == 2) {
        $str = '';
        return $str;
    }
}

function save_hp_roun($pl)
{
    $hps = $pl['hp_all'] / $pl['hps'];
    $mps = $pl['mp_all'] / $pl['mps'];
    if (time() >= $pl['chp']) {
        $curhp = $pl['hp_all'];
    } else {
        $curhp = $pl['hp_all'] - (($pl['chp'] - time()) * $hps);
    }
    if (time() >= $pl['cmp']) {
        $curmp = $pl['mp_all'];
    } else {
        $curmp = $pl['mp_all'] - (($pl['cmp'] - time()) * $mps);
    }
    $curhp = round($curhp);
    $curmp = round($curmp);
    if ($pl['hp_all'] != $pl['hp'] or $pl['mp_all'] != $pl['mp']) {
        mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `hp`='" . $curhp . "',`mp`='" . $curmp . "' WHERE `login`='" . $pl['login'] . "' LIMIT 1;");
    }
}

function inshp()
{
    $pl = player();
    $hps = $pl['hp_all'] / $pl['hps'];
    $mps = $pl['mp_all'] / $pl['mps'];
    $chp = time() + (($pl['hp_all'] - $pl['hp']) / $hps);
    $cmp = time() + (($pl['mp_all'] - $pl['mp']) / $mps);
    mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `chp`='" . $chp . "',`cmp`='" . $cmp . "' WHERE `login`='" . $pl['login'] . "' LIMIT 1;");
}

function inshp2($pl)
{
    $hps = $pl['hp_all'] / $pl['hps'];
    $mps = $pl['mp_all'] / $pl['mps'];
    $chp = time() + (($pl['hp_all'] - $pl['hp']) / $hps);
    $cmp = time() + (($pl['mp_all'] - $pl['mp']) / $mps);
    mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `chp`='" . $chp . "',`cmp`='" . $cmp . "' WHERE `login`='" . $pl['login'] . "' LIMIT 1;");
}

function save_hp()
{
    $pl = player();
    $hps = $pl['hp_all'] / $pl['hps'];
    $mps = $pl['mp_all'] / $pl['mps'];
    if (time() >= $pl['chp']) {
        $curhp = $pl['hp_all'];
    } else {
        $curhp = $pl['hp_all'] - (($pl['chp'] - time()) * $hps);
    }
    if (time() >= $pl['cmp']) {
        $curmp = $pl['mp_all'];
    } else {
        $curmp = $pl['mp_all'] - (($pl['cmp'] - time()) * $mps);
    }
    if ($pl['hp_all'] != $pl['hp'] or $pl['mp_all'] != $pl['mp']) {
        mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `hp`='" . $curhp . "',`mp`='" . $curmp . "' WHERE `login`='" . $pl['login'] . "' LIMIT 1;");
    }
    $str = "<SCRIPT language=\"JavaScript\">\n
	ins_HP($curhp,$pl[hp_all],$curmp,$pl[mp_all],$pl[hps],$pl[mps]); \n
	</SCRIPT>\n";
    return $str;
}

function calchp()
{
    $pl = player();
    if ($pl['clan_id'] != 'none') {
        $clsql = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `clans` WHERE `clan_id`='" . $pl['clan_id'] . "';"));
        $uphp += $clsql['cl_hp'];
        $upmp += $clsql['cl_mp'];
    }
    $s = explode("|", $pl[st]);
    foreach (explode("|", $pl[perk]) as $key => $val) {
        if ($val == '') {
            $val = 0;
        }
        $p[$key] = $val;
    }
    $trw = affect($pl[affect], 3);
    foreach ($trw as $key => $val) {
        $s[$key] += $val;
    }
    $hp = (($pl['zdorov'] + $s[33] + ($p[8] * 2) + (($pl[level] + 1) * $p[18])) * 20) + $s[27] + $uphp;
    $mp = (($pl['znan'] + $s[34] + ($p[11] * 2)) * 10) + $s[29] + $upmp;
    if ($hp != $pl['hp_all'] or $mp != $pl['mp_all']) {
        mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `hp_all`='" . $hp . "',`mp_all`='" . $mp . "' WHERE `login`='" . $pl['login'] . "' LIMIT 1;");
    }
    inshp();
}

function calchp2($pl, $uphp, $upmp)
{
    $s = explode("|", $pl['st']);
    foreach (explode("|", $pl[perk]) as $key => $val) {
        if ($val == '') {
            $val = 0;
        }
        $p[$key] = $val;
    }
    $hp = (($pl['zdorov'] + $s[33] + ($p[8] * 2) + (($pl['level'] + 1) * $p[18])) * 20) + $s[27] + $uphp;
    $mp = (($pl['znan'] + $s[34] + ($p[11] * 2)) * 10) + $s[29] + $upmp;
    if ($hp != $pl['hp_all'] or $mp != $pl['mp_all']) {
        mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `hp_all`='" . $hp . "',`mp_all`='" . $mp . "' WHERE `login`='" . $pl['login'] . "'LIMIT 1;");
    }
    inshp2($pl);
}

function calchp3($uphp, $upmp)
{
    $pl = player();
    $s = explode("|", $pl['st']);
    foreach (explode("|", $pl[perk]) as $key => $val) {
        if ($val == '') {
            $val = 0;
        }
        $p[$key] = $val;
    }
    $hp = (($pl['zdorov'] + $s[33] + ($p[8] * 2) + (($pl['level'] + 1) * $p[18])) * 20) + $s[27] + $uphp;
    $mp = (($pl['znan'] + $s[34] + ($p[11] * 2)) * 10) + $s[29] + $upmp;
    if ($hp != $pl['hp_all'] or $mp != $pl['mp_all']) {
        mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `hp_all`='" . $hp . "',`mp_all`='" . $mp . "' WHERE `login`='" . $pl['login'] . "'LIMIT 1;");
    }
    inshp();
}


function player()
{
    $user = $_SESSION["user"];
//$pl = db_quer('user','login = "'.$user["login"].'" LIMIT 1;');
    $pl = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `user` WHERE `login`='" . $user["login"] . "' LIMIT 1;"));
    if ($pl['loc'] == '' and $pl['id']) {
        mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `loc`='1' WHERE `id`='" . $pl['id'] . "' LIMIT 1;");
    }
    return $pl;
}

function change_get($go)
{
    $user = $_SESSION["user"];
    $waittime = time();
    mysqli_query($GLOBALS['db_link'], 'UPDATE user SET loc=' . AP . $go . AP . ',wait=' . AP . $waittime . AP . ' WHERE login=' . AP . $user['login'] . AP . 'LIMIT 1;');
}

function pl_loc($id)
{
    $loc = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT loc.id, loc.inc FROM loc WHERE id='$id' LIMIT 1;"));
    return $loc['inc'];
}

function ret_id($id, $pos)
{
    if ($id == 28) {
        $loc = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT map.go_id, map.but FROM map WHERE coord='$pos' LIMIT 1;"));
        $loc[folder] = "maps";
    } else {
        $loc = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT loc.id, loc.loc,loc.go_id, loc.but, loc.folder FROM loc WHERE id='$id' LIMIT 1;"));
    }
    if ($loc['go_id'] == $loc['id']) $s = 1;
    $locte = array($loc['go_id'], $loc['but'], $loc['loc'], $loc['folder'], $s);
    return $locte;
}

function gethaot($lev)
{
    if ($lev > 4 and $lev < 8) {
        $level = array(5, 7);
    } else if ($lev > 7 and $lev < 11) {
        $level = array(8, 10);
    } else if ($lev > 10 and $lev < 14) {
        $level = array(11, 13);
    } else {
        $level = array(14, 33);
    }
    return $level;
}

function testarena($batt)
{
    $test = mysqli_query($GLOBALS['db_link'], "SELECT user.id FROM user WHERE battle='$batt';");
    return mysqli_num_rows($test);
}

function testarena2($batt)
{
    $test = mysqli_query($GLOBALS['db_link'], "SELECT user.id FROM user WHERE battle='" . $batt . "' AND side=2;");
    return mysqli_num_rows($test);
}

function sumbat($bat, $msg, $type)
{
    $user = $_SESSION['user'];
    $result = mysqli_query($GLOBALS['db_link'], "SELECT user.login FROM user WHERE battle=" . $bat . ";");
    while ($row = mysqli_fetch_assoc($result)) {
        if ($type == 1 and $row['login'] == $user['login']) continue;
        $log .= '<' . $row['login'] . '>';
    }
    mysqli_query($GLOBALS['db_link'], 'INSERT INTO chat (time,login,dlya,msg) VALUES (' . AP . time() . AP . ',' . AP . "sys" . AP . ',' . AP . $log . AP . ',' . AP . addslashes("$msg") . AP . ');');
}

function updatebatt($id)
{
    if (testarena2($id) == 0) {
        sumbat($id, "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;Заявка не набрана!</font><BR>'+'');$redirect", 0);
        mysqli_query($GLOBALS['db_link'], "DELETE FROM arena WHERE id_battle=" . $id . ";");
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET battle=0 WHERE battle=" . $id . ";");
    } else {
        startbat($id, 1);
        sumbat($id, "$redirect", 0);
    }
}

function startbat($id, $fy)
{
    $log = ",[[0,\"" . date("H:i") . "\"],\"Бой между \" ";
    $pl = mysqli_query($GLOBALS['db_link'], "SELECT user.side, user.battle, user.level, user.sklon, user.clan_gif, user.login FROM user WHERE battle=" . $id . ";");
    while ($val = mysqli_fetch_assoc($pl)) {
        if ($val[side] == 1) {
            $log .= ",[1,$val[side],\"$val[login]\",$val[level],$val[sklon],\"$val[clan_gif]\"],\",\"";
        } else {
            $log2 .= ",[1,$val[side],\"$val[login]\",$val[level],$val[sklon],\"$val[clan_gif]\"],\",\"";
        }
    }
    $log = substr_replace($log, '', -3);
    $log2 = substr_replace($log2, '', -3);
    //$log.="\" и \"$log2\" начался.\"]";
    //mysqli_query($GLOBALS['db_link'],"INSERT INTO logs (bid,log) VALUES (".$id.", ".$log.");");
    mysqli_query($GLOBALS['db_link'], "LOCK TABLES arena READ, fight arena;");
    mysqli_query($GLOBALS['db_link'], "UPDATE arena SET vis=0, t2=" . time() . " WHERE id_battle=" . $id . " LIMIT 1;");
    mysqli_query($GLOBALS['db_link'], "UNLOCK TABLES;");
    mysqli_query($GLOBALS['db_link'], "UPDATE user SET fight=" . $fy . " WHERE battle=" . $id . " ;");
    save_hp_all($id);
}

function save_hp_all($id)
{
    $app = mysqli_query($GLOBALS['db_link'], "SELECT `user`.`id`,`user`.`battle`,`user`.`hp_all`,`user`.`mp_all`,`user`.`hps`,`user`.`mps`,`user`.`chp`,`user`.`cmp`,`user`.`hp`,`user`.`mp` FROM `user` WHERE `battle`='" . $id . "';");
    while ($pl = mysqli_fetch_assoc($app)) {
        $hps = $pl['hp_all'] / $pl['hps'];
        $mps = $pl['mp_all'] / $pl['mps'];
        if (time() >= $pl['chp']) {
            $curhp = $pl['hp_all'];
        } else {
            $curhp = $pl['hp_all'] - (($pl['chp'] - time()) * $hps);
        }
        if (time() >= $pl['cmp']) {
            $curmp = $pl['mp_all'];
        } else {
            $curmp = $pl['mp_all'] - (($pl['cmp'] - time()) * $mps);
        }
        if ($pl['hp_all'] != $pl['hp'] or $pl['mp_all'] != $pl['mp']) {
            mysqli_query($GLOBALS['db_link'], 'UPDATE user SET hp=' . AP . $curhp . AP . ', mp=' . AP . $curmp . AP . ' WHERE id=' . AP . $pl['id'] . AP . ' LIMIT 1;');
        }
    }
}

function botslot($id, $s)
{
    $sl_free = array(
        1 =>
            'sl_l_0.gif:Слот для шлема',
        'sl_l_1.gif:Слот для ожерелья',
        'sl_l_2.gif:Слот для оружия',
        'sl_l_3.gif:Слот для пояса',
        'sl_l_4.gif:Слот для содержимого пояса',
        'sl_l_4.gif:Слот для содержимого пояса',
        'sl_l_4.gif:Слот для содержимого пояса',
        'sl_l_6.gif:Слот для сапог',
        'sl_l_7.gif:Слот для поножей',
        'sl_r_4.gif:Слот для наплечников',
        'sl_r_2.gif:Слот для наручей',
        'sl_r_3.gif:Слот для перчаток',
        'sl_l_2.gif:Слот для оружия/щита',
        'sl_r_5.gif:Слот для кольца',
        'sl_r_5.gif:Слот для кольца',
        'sl_r_6.gif:Слот для брони',
        'sl_r_6.gif:Слот для кольчуги',
        'sl_r_0.gif:Слот для лука',
        'sl_r_1.gif:Слот для лука',
//runes
        'rune_001.gif:Слот для руны',
        'rune_001.gif:Слот для руны',
        'rune_001.gif:Слот для руны',
        'rune_001.gif:Слот для руны'
    );
    $q = mysqli_query($GLOBALS['db_link'], "SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `used`='1' AND `pl_id`='" . $id . "';");
    while ($row = mysqli_fetch_assoc($q)) {
        $it = explode("|", $row['param']);
        if ($row[slot] == 5) {
            $ret .= "$row[id_item]@$row[num_a]|";
        }
        $par = '';
        foreach ($it as $value) {
            $stat = explode("@", $value);
            switch ($stat[0]) {
                case 0:
                    $par[0] = "$stat[1]";
                    break;
                case 1:
                    $ud = explode("-", $stat[1]);
                    $par[1] = "$ud[0]";
                    $par[2] = "$ud[1]";
                    break;
                case 2:
                    $par[7] = $row['dolg'];
                    break;
                case 9:
                    $par[3] = "$stat[1]";
                    break;
                case 10:
                    $par[4] = "$stat[1]";
                    break;
                case 27:
                    $par[5] = "$stat[1]";
                    break;
                case 29:
                    $par[6] = "$stat[1]";
                    break;
            }
        }
        $p = "$par[0]|$par[1]|$par[2]|$par[3]|$par[4]|$par[5]|$par[6]|$par[7]";
        $sl_free[$row['curslot']] = "$row[gif]:$row[name]:$p";
        $sl_id[$row['curslot']] = $row['id_item'];
        $sl_pr[$row['curslot']] = $row['dolg'] - $row['iznos'];
        $v_c[$row['curslot']] = scode();
    }
    for ($i = 1; $i <= 23; $i++) {
        $idd .= $sl_id[$i] . '@';
        $pr .= $sl_pr[$i] . '@';
        $item .= $sl_free[$i] . '@';
        $vcod .= $v_c[$i] . '@';
    }

    $pr = substr($pr, 0, strlen($pr) - 1);
    $item = substr($item, 0, strlen($item) - 1);
    $idd = substr($idd, 0, strlen($idd) - 1);
    $vcod = substr($vcod, 0, strlen($vcod) - 1);

    if ($s == 1) {
        $invs = ",\"$idd\",\"$vcod\"";
    }
    echo "$item\"$invs,\"$pr";
    return substr_replace($ret, '', -1);
}

function getPF($id)
{
    $p = Array('18954954', '10142', '10001');
    if (in_array($id, $p)) {
        return 1;
    } else {
        return 0;
    }
}

function slotwiev($id, $s)
{
//18-19 слоты карман и свиток
    $sl_free = array(
        1 =>
            'sl_l_0.gif:Слот для шлема',
        'sl_l_1.gif:Слот для ожерелья',
        'sl_l_2.gif:Слот для оружия',
        'sl_l_3.gif:Слот для пояса',
        'sl_l_4.gif:Слот для содержимого пояса',
        'sl_l_4.gif:Слот для содержимого пояса',
        'sl_l_4.gif:Слот для содержимого пояса',
        'sl_l_6.gif:Слот для сапог',
        'sl_l_7.gif:Слот для поножей',
        'sl_r_4.gif:Слот для наплечников',
        'sl_r_2.gif:Слот для наручей',
        'sl_r_3.gif:Слот для перчаток',
        'sl_l_2.gif:Слот для оружия/щита',
        'sl_r_5.gif:Слот для кольца',
        'sl_r_5.gif:Слот для кольца',
        'sl_r_6.gif:Слот для брони',
        'sl_r_6.gif:Слот для брони',
        'sl_r_0.gif:Слот для кошелька',
        'sl_r_1.gif:Слот для содержимого кошелька',
//runes
        'rune_001.gif:Слот для руны',
        'rune_001.gif:Слот для руны',
        'rune_001.gif:Слот для руны',
        'rune_001.gif:Слот для руны'
    );
    $q = mysqli_query($GLOBALS['db_link'], "SELECT invent.*, items.* FROM items INNER JOIN invent ON items.id = invent.protype WHERE used=1 AND pl_id=" . $id . ";");
    while ($row = mysqli_fetch_assoc($q)) {
        if ($row['grav']) {
            $row['name'] = $row['name'] . " (" . $row['grav'] . ")";
        }
        $it = explode("|", $row['param']);
        $modstat = '';
        $mod = explode("|", $row['mod']);
        foreach ($mod as $value) {
            $modstats = explode("@", $value);
            $modstat[$modstats[0]] = $modstats[1];
        }
        if ($row[slot] == 5) {
            $ret .= "$row[id_item]@$row[num_a]|";
        }
        $par = '';
        foreach ($it as $value) {
            $stat = explode("@", $value);
            switch ($stat[0]) {
                case 0:
                    $par[0] = "$stat[1]";
                    break;
                case 1:
                    $ud = explode("-", $stat[1]);
                    $tmp = '';
                    if ($modstat[1] != '') {
                        $tmp = explode("-", $modstat[1]);
                    }
                    $par[1] = $ud[0] + $tmp[0];
                    $par[2] = $ud[1] + $tmp[1];
                    break;
                case 2:
                    $par[7] = $row['dolg'];
                    break;
                case 9:
                    $par[3] = $stat[1] + $modstat[9];
                    break;
                case 10:
                    $par[4] = "$stat[1]";
                    break;
                case 27:
                    $par[5] = "$stat[1]";
                    break;
                case 29:
                    $par[6] = "$stat[1]";
                    break;
            }
        }
        switch ($row['mod_color']) {
            case 0:
                $rnn = "<b>" . $row[name] . ($row['modified'] == 1 ? "</b> [ап]" : "") . "</b>";
                break;
            case 1:
                $rnn = "<b><font color=#006600>" . $row[name] . " [мод]" . ($row['modified'] == 1 ? "</b> [ап]" : "") . "</b></font>";
                break;
            case 2:
                $rnn = "<b><font color=#3333CC>" . $row[name] . " [мод]" . ($row['modified'] == 1 ? "</b> [ап]" : "") . "</b></font>";
                break;
            case 3:
                $rnn = "<b><font color=#AF51B5>" . $row[name] . " [мод]" . ($row['modified'] == 1 ? "</b> [ап]" : "") . "</b></font>";
                break;
        }
        $p = "$par[0]|$par[1]|$par[2]|$par[3]|$par[4]|$par[5]|$par[6]|$par[7]";
        $sl_free[$row['curslot']] = $row[gif] . ":" . $rnn . ":" . $p;
        $sl_id[$row['curslot']] = $row['id_item'];
        $sl_pr[$row['curslot']] = $row['dolg'] - $row['iznos'];
        $v_c[$row['curslot']] = scode();
    }
    for ($i = 1; $i <= 23; $i++) {
        $idd .= $sl_id[$i] . '@';
        $pr .= $sl_pr[$i] . '@';
        $item .= $sl_free[$i] . '@';
        $vcod .= $v_c[$i] . '@';
    }

    /*$pr=substr($pr,0,strlen($pr)-1);
$item=substr($item,0,strlen($item)-1);
$idd=substr($idd,0,strlen($idd)-1);
$vcod=substr($vcod,0,strlen($vcod)-1);*/


    $invs = ",\"$idd\",\"$vcod\"";
    echo "$item\"$invs,\"$pr";
    return substr_replace($ret, '', -1);
}

function ignor_add($nic)
{
    $_SESSION['ignor'][$nic] = 1;
}

function ignor_rem($nic)
{
    unset($_SESSION['ignor'][$nic]);
}

function updateslot($act, $item, $pid, $slot)
{
    switch ($act) {
        case 0:
            mysqli_query($GLOBALS['db_link'], "UPDATE `invent` SET `used`='0', `curslot`='0' WHERE `id_item`='" . $item . "' AND `pl_id`='" . $pid . "'");
            break;
        case 1:
            mysqli_query($GLOBALS['db_link'], "UPDATE `invent` SET `used`='1', `curslot`='" . $slot . "' WHERE `id_item`='" . $item . "' AND `pl_id`='" . $pid . "';");
            break;
        case 2:
            mysqli_query($GLOBALS['db_link'], "UPDATE `invent` SET `used`='0', `curslot`='0' WHERE `curslot`='" . $slot . "' AND `pl_id`='" . $pid . "'");
            mysqli_query($GLOBALS['db_link'], "UPDATE invent SET used='1', `curslot`='" . $slot . "' WHERE `id_item`='" . $item . "' AND `pl_id`='" . $pid . "'");
            break;
        case 3:
            mysqli_query($GLOBALS['db_link'], "UPDATE `invent` SET `used`='0', `curslot`='0' WHERE  `pl_id`='" . $pid . "';");
            break;
    }
}


function calcstat($id)
{
    $pl = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT SQL_CACHE * FROM `user` WHERE `id`='" . $id . "' LIMIT 1;"));
    $um = explode("|", $pl['umen']);
    $immune = array(0 => 0, 0, 0, 0, 0);
    $t = array(0 => 0, 2, 4);
    $od = 0;
    $bl = 0;
    $runecount = Array();
//статы с вещей
    $mysql = mysqli_query($GLOBALS['db_link'], "SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `used`='1' AND `pl_id`='" . $id . "' ;");
    while ($row = mysqli_fetch_assoc($mysql)) {
        $is_rune = 0;
        if ($row['type'] == 'w71') {
            #считаем одинаковые руны
            $is_rune = 1;
            $runecount[$row['protype']]++;
        }
//рассчет иммунок
        $immunes = explode("|", $row['immunes']);
        foreach ($immunes as $key => $val) {
            $immune[$key] += $val;
        }
        $modstat = '';
        $item = explode("|", $row['param']);
        $mod = explode("|", $row['mod']);
        foreach ($mod as $value) {
            $modstats = explode("@", $value);
            if ($modstats[0] == '33' and $modstats[1] < 0) {
                $modstats[1] = 0;
            }
            $par[$modstats[0]] += $modstats[1];


        }

        if ($row['type'] == 'w20') {
            $bl = $row['block'];
            $tw = $row['type'];
        }
        if ($row['slot'] > 0 and $row['type'] != 'w20') {
            $it = explode("|", $row['need']);
            foreach ($it as $val) {
                $need = explode("@", $val);
                if ($need[0] == 28 and $need[1] > $od) {
                    $od = $need[1];
                    $tw = $row['type'];
                }
            }
        }
        foreach ($item as $value) {
            $k = 1;
            $stat = explode("@", $value);
            if (in_array($stat[0], $t) and $stat[0] != 'expbonus' and $stat[0] != 'massbonus') {
                $par[$stat[0]] = '';
                continue;
            }
            if ($stat[0] == 1) {
                $tmp = explode("-", $stat[1]);
                switch ($tw) {
                    case w1:
                        $k = ($um[10] / 300 + $um[1] / 150) + 1;
                        break;
                    case w2:
                        $k = ($um[10] / 300 + $um[2] / 150) + 1;
                        break;
                    case w3:
                        $k = ($um[10] / 300 + $um[3] / 150) + 1;
                        break;
                    case w4:
                        $k = ($um[10] / 300 + $um[4] / 150) + 1;
                        break;
                    case w5:
                        $k = ($um[10] / 300 + $um[5] / 150) + 1;
                        break;
                    case w6:
                        $k = ($um[10] / 300 + $um[6] / 150) + 1;
                        break;
                    case w7:
                        $k = ($um[10] / 300 + $um[7] / 150) + 1;
                        break;
                    case w20:
                        $k = $um[10] / 300 + 1;
                        break;
                }
                $tmp[0] = round($tmp[0] * $k);
                $tmp[1] = round($tmp[1] * $k);
                $tmp1 = explode("-", $par[1]);
                $modstat[1] != '' ? $tmp2 = explode("-", $modstat[1]) : $tmp2 = '';
                $tmp[0] += $tmp1[0] + $tmp2[0];
                $tmp[1] += $tmp1[1] + $tmp2[1];
                continue;
            }
            if ($is_rune == 1 and $runecount[$row['protype']] == 4) {
                #если руны одинаковые и их 4шт - умножаем стат с последней на 5 (1 за текущую руну и двойной бонус за каждую)
                $par[1] = implode("-", $tmp);
                $par[$stat[0]] += $stat[1] * 5;
            } else {
                $par[1] = implode("-", $tmp);
                $par[$stat[0]] += $stat[1];
            }
        }
        if ($row['damage_mod'] != 0) {
            $dmod = explode("@", $row['damage_mod']);
            $dmoddmg = explode("-", $dmod[1]);
            if ($is_rune == 1 and $runecount[$row['protype']] == 4) {
                #если руны одинаковые и их 4шт - умножаем стат с последней на 5 (1 за текущую руну и двойной бонус за каждую)
                $damage_mod[$dmod[0]][0] += $dmoddmg[0] * 5;
                $damage_mod[$dmod[0]][1] += $dmoddmg[1] * 5;
            } else {
                $damage_mod[$dmod[0]][0] += $dmoddmg[0];
                $damage_mod[$dmod[0]][1] += $dmoddmg[1];
            }
        }
    }


//статы с мазей
    $maseit = '';
    $newmase = '';
    $plmases = explode("|", $pl['masebonus']);
    foreach ($plmases as $val) {
        $mase = explode("@", $val);
        if ($mase[1] >= time() and $mase[0]) {
            if ($maseit == '') {
                $maseit = "`id`='" . $mase[0] . "'";
            } else {
                $maseit .= " OR `id`='" . $mase[0] . "'";
            }
            $newmase .= $mase[0] . '@' . $mase[1] . ($mase[2] ? '@' . $mase[2] : '') . '|';
        }
    }
    $newmase = substr($newmase, 0, strlen($newmase) - 1);
    $mysql2 = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `items` WHERE " . $maseit . " ;");
    while ($row = mysqli_fetch_assoc($mysql2)) {
//immunes
        $immunes = explode("|", $row['immunes']);
        foreach ($immunes as $key => $val) {
            $immune[$key] += $val;
        }
        $modstat = '';
        $item = explode("|", $row['param']);
        $mod = explode("|", $row['mod']);
        if ($row['type'] == 'w20') {
            $bl = $row['block'];
            $tw = $row['type'];
        }
        if ($row['slot'] > 0 and $row['type'] != 'w20') {
            $it = explode("|", $row['need']);
            foreach ($it as $val) {
                $need = explode("@", $val);
                if ($need[0] == 28 and $need[1] > $od) {
                    $od = $need[1];
                    $tw = $row['type'];
                }
            }
        }
        foreach ($item as $value) {
            $k = 1;
            $stat = explode("@", $value);
            //echo '<br>test: '.$value.' afterexplode >> '.$stat[0].' | '.$stat[1];;
            if (in_array($stat[0], $t) and $stat[0] != 'expbonus' and $stat[0] != 'massbonus') {
                $par[$stat[0]] = '';
                continue;
            }
            if ($stat[0] == 1) {
                $tmp = explode("-", $stat[1]);
                switch ($tw) {
                    case w1:
                        $k = ($um[10] / 300 + $um[1] / 150) + 1;
                        break;
                    case w2:
                        $k = ($um[10] / 300 + $um[2] / 150) + 1;
                        break;
                    case w3:
                        $k = ($um[10] / 300 + $um[3] / 150) + 1;
                        break;
                    case w4:
                        $k = ($um[10] / 300 + $um[4] / 150) + 1;
                        break;
                    case w5:
                        $k = ($um[10] / 300 + $um[5] / 150) + 1;
                        break;
                    case w6:
                        $k = ($um[10] / 300 + $um[6] / 150) + 1;
                        break;
                    case w7:
                        $k = ($um[10] / 300 + $um[7] / 150) + 1;
                        break;
                    case w20:
                        $k = $um[10] / 300 + 1;
                        break;
                }
                $tmp[0] = round($tmp[0] * $k);
                $tmp[1] = round($tmp[1] * $k);
                $tmp1 = explode("-", $par[1]);
                $modstat[1] != '' ? $tmp2 = explode("-", $modstat[1]) : $tmp2 = '';
                $tmp[0] += $tmp1[0] + $tmp2[0];
                $tmp[1] += $tmp1[1] + $tmp2[1];
                continue;
            }
            $par[1] = implode("-", $tmp);
            $par[$stat[0]] += ($stat[1] + $modstat[$stat[0]]);
        }
        if ($row['damage_mod'] != 0) {
            $dmod = explode("@", $row['damage_mod']);
            $dmoddmg = explode("-", $dmod[1]);
            $damage_mod[$dmod[0]][0] += $dmoddmg[0];
            $damage_mod[$dmod[0]][1] += $dmoddmg[1];
        }
    }

//статы с ДЦ

    $getstatsusr = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `real_dd_bonus` WHERE `pl_id`='" . $pl['id'] . "' LIMIT 1;"));
    $stats_user = explode("|", $getstatsusr['param']);
    foreach ($stats_user as $val_user) {
        $par_u = explode("@", $val_user);
        $par_user[$par_u[0]] = $par_u[1];
    }

    if ($getstatsusr['param_time'] > time()) {

        $stats_user_time = explode("|", $getstatsusr['param_timed']);
        foreach ($stats_user_time as $val_user_time) {
            $par_u_time = explode("@", $val_user_time);
            $par_user_time[$par_u_time[0]] = $par_u_time[1];
        }
    }
    for ($i = 1; $i <= 73; $i++) {
        if ($i == 72) {
            $i = 'expbonus';
        }
        if ($i == 73) {
            $i = 'massbonus';
        }
        if ($par_user[$i] != "") {
            if ($i == 1) {
                $tmp = explode("-", $par_user[$i]);
                $tmp1 = explode("-", $par[1]);
                $tmp[0] += $tmp1[0];
                $tmp[1] += $tmp1[1];
                $par[1] = implode("-", $tmp);
            } else {
                $par[$i] += $par_user[$i];
            }
        }
        if ($par_user_time[$i] != "") {
            if ($i == 1) {
                $tmp = explode("-", $par_user_time[$i]);
                $tmp1 = explode("-", $par[1]);
                $tmp[0] += $tmp1[0];
                $tmp[1] += $tmp1[1];
                $par[1] = implode("-", $tmp);
            } else {
                $par[$i] += $par_user_time[$i];
            }
        }
        if ($i == 'expbonus') {
            $i = 72;
        }
        if ($i == 'massbonus') {
            $i = 73;
        }
    }
//


    for ($dm = 1; $dm <= 4; $dm++) {
        $moddmg[$dm] = implode("-", $damage_mod[$dm]);
        $dmgmod .= (($damage_mod[$dm] == '') ? '' : $dm . "@" . $moddmg[$dm] . "|");
    }
    if ($dmgmod == '') {
        $dmgmod = 0;
    }
    switch ($tw) {
        case '':
            $od = 45;
            $od = round($od / (($um[0] / 100 + $um[10] / 200) * 0.15 + 1));
            $tmp = explode("-", $par[1]);
            $tmp[0] += round($sil * (1 + $um[0] / 300));
            $tmp[1] += round($sil * (1 + $um[0] / 150) + 1);
            $par[1] = implode("-", $tmp);
            break;
        case w1:
            $od = round($od / (($um[1] / 100 + $um[10] / 200) * 0.15 + 1));
            break;
        case w2:
            $od = round($od / (($um[2] / 100 + $um[10] / 200) * 0.15 + 1));
            break;
        case w3:
            $od = round($od / (($um[3] / 100 + $um[10] / 200) * 0.15 + 1));
            break;
        case w4:
            $od = round($od / (($um[4] / 100 + $um[10] / 200) * 0.15 + 1));
            break;
        case w5:
            $od = round($od / (($um[5] / 100 + $um[10] / 200) * 0.15 + 1));
            break;
        case w6:
            $od = round($od / (($um[6] / 100 + $um[10] / 200) * 0.15 + 1));
            break;
        case w7:
            $od = round($od / (($um[7] / 100 + $um[10] / 200) * 0.15 + 1));
            break;
        case w20:
            $od = 45;
    }
    $hps = (1500 / (($par[62] + $um[30]) / 100 + 1));
    $mps = (9000 / (($par[66] + $um[33]) / 100 + 1));
//BUFFS!
    $affect = $pl[affect];
    $ms = test_affect($affect);
    if ($ms != '') {
        $ms = affect($ms, 3);
        $mstat = explode("|", $ms);
        foreach ($mstat as $values) {
            $sts = explode("@", $values);
            $par[$sts[0]] += $sts[1];
        }
    } else {
        $affect = "";
    }
    if ($pl['type'] != 3) {
        $sk = 'kgTvx2WrEZ';
        $buff = totembuffs();
//	$totembuff = Array('9@0'/*сфинкс +100кб*/,'63@0'/*тигр +50 оружейника*/,'58@0'/*лев +50 странника*/,'invis@0'/*дракон невидимость*/,'attack@0'/*василиск нападение*/,'32@5'/*скорпион +10 Везение +50% уловки*/,'31@6'/*рыба  +10 ловкости +50% точности*/,'61@0'/*мутант +50 ювы*/,'mass@30'/*небесный кит +15 силы и +150 массы*/,'56@0'/*древний ящер +50 наблюд*/,'7@8'/*ворон смерти +50 мф сокрушения и стойкости*/,'exp@0'/*клинки 20% экспы на час*/);
        if ($buff == 1) {
            switch ($pl['thotem']) {
                case 0:
                    $par[9] += 100;
                    break;
                case 1:
                    $par[63] += 50;
                    break;
                case 2:
                    $par[58] += 50;
                    break;
                case 3:
                    break;
                case 4:
                    break;
                case 5:
                    $par[32] += 10;
                    $par[5] += 50;
                    break;
                case 6:
                    $par[31] += 10;
                    $par[6] += 50;
                    break;
                case 7:
                    $par[61] += 50;
                    break;
                case 8:
                    $par[30] += 15;
                    break;
                case 9:
                    $par[56] += 50;
                    break;
                case 10:
                    $par[7] += 50;
                    $par[8] += 50;
                    break;
                case 11:
                    break;
            }
        }
        if ($pl['buffs'] == '') {
            $pl['buffs'] = "||||";
        }
        $buffs = explode("|", $pl['buffs']);
        foreach ($buffs as $value) {
            $buff = explode("@", $value);
            if ($buff[0] != 14) {
                switch ($buff[0]) {
                    case 1:
                        $par[30] += $buff[1];
                        break;//Мощь
                    case 2:
                        $par[31] += $buff[1];
                        break;//Проворность
                    case 3:
                        $par[32] += $buff[1];
                        break;//Везение
                    case 4:
                        $par[33] += $buff[1];
                        break;//здоровье
                    case 5:
                        $par[34] += $buff[1];
                        break;//Разум
                    case 6:
                        $par[35] += $buff[1];
                        break;//сноровка
                    case 7:
                        $dmg = explode("-", $par[1]);
                        $dmg[0] += $buff[1];
                        $dmg[1] += $buff[1];
                        $par[1] = implode("-", $dmg);
                        break;//удар
                    case 8:
                        $par[9] += $buff[1];
                        break;//кб
                    case 9:
                        $par[10] += $buff[1];
                        break;//пробой брони
                    case 10:
                        $par[5] += $buff[1];
                        break;//уловка
                    case 11:
                        $par[6] += $buff[1];
                        break;//точность
                    case 12:
                        $par[7] += $buff[1];
                        break;//сокрушение
                    case 13:
                        $par[8] += $buff[1];
                        break;//стойкость
                    case 15:
                        $par[56] += $buff[1];
                        break;//зелье наблюдательности
                    case 16:
                        $par[58] += $buff[1];
                        break; //странник
                }
            } else {
                $fb = 1;
                $fullbuff[0] = $buff[0];
                $fullbuff[1] = $buff[1];
            }
        }
        if ($fb == 1) {
            $buff[1] = $fullbuff[1] / 100 + 1;
            $par[30] *= $buff[1];
            $par[30] = round($par[30]);//Мощь
            $par[31] *= $buff[1];
            $par[31] = round($par[31]);//Проворность
            $par[32] *= $buff[1];
            $par[32] = round($par[32]);//Везение
            $par[33] *= $buff[1];
            $par[33] = round($par[33]);//здоровье
            $par[34] *= $buff[1];
            $par[34] = round($par[34]);//Разум
            $par[35] *= $buff[1];
            $par[35] = round($par[35]);//сноровка
            $dmg = explode("-", $par[1]);
            $dmg[0] *= $buff[1];
            $dmg[1] *= $buff[1] * 1.5;
            $par[1] = implode("-", $dmg);//удар
            $par[9] *= $buff[1];
            $par[9] = round($par[9]);//кб
            $par[10] *= $buff[1];
            $par[10] = round($par[10]);//пробой брони
            $par[5] *= $buff[1];
            $par[5] = round($par[5]);//уловка
            $par[6] *= $buff[1];
            $par[6] = round($par[6]);//точность
            $par[7] *= $buff[1];
            $par[7] = round($par[7]);//сокрушение
            $par[8] *= $buff[1];
            $par[8] = round($par[8]);//стойкость
        }
        $podsql = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `podarki` WHERE `id`='" . $id . "' AND `srok`>'" . time() . "' AND `podarok`>'999';");
        $up = "";
        $updmg[0] = 0;
        $updmg[1] = 0;
        $uphp = 0;
        $upmp = 0;
        $upstat = 0;
        if (mysqli_num_rows($podsql) > 0) {
            while ($podrow = mysqli_fetch_assoc($podsql)) {
                switch ($podrow[podarok]) {
                    case 9999:
                        $updmg[0] += 15;
                        $updmg[1] += 25;
                        $uphp += 225;
                        $upmp += 175;
                        $upstat += 5;
                        break;
                    case 9998:
                        $updmg[0] += 10;
                        $updmg[1] += 15;
                        $uphp += 150;
                        $upmp += 100;
                        $upstat += 3;
                        break;
                    case 9997:
                        $updmg[0] += 10;
                        $updmg[1] += 15;
                        $uphp += 100;
                        $upmp += 50;
                        $upstat += 1;
                        break;
                    case 9996:
                        $updmg[0] += 5;
                        $updmg[1] += 10;
                        $uphp += 50;
                        $upmp += 25;
                        $upstat += 0;
                        break;
                }
            }
            for ($i = 29; $i <= 34; $i++) {
                $par[$i] += $upstat;
            }
        }
        $clnablud = 0;
        if ($pl['clan_id'] != 'none') {
            $clsql = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `clans` WHERE `clan_id`='" . $pl['clan_id'] . "';"));
            $par[30] += $clsql['cl_sila'];
            $par[31] += $clsql['cl_lovkost'];
            $par[32] += $clsql['cl_ydacha'];
            $par[33] += $clsql['cl_zdorov'];
            $par[34] += $clsql['cl_znan'];
            $uphp += $clsql['cl_hp'];
            $upmp += $clsql['cl_mp'];
            $clnablud = 100 - $clsql['cl_up'] - $clsql['cl_buyup'];
        }

        $par[71] += $pl['level'];
        $sil = $par[30] + $pl['sila'];
        $dmg = explode("-", $par[1]);
        if ($pl['sign'] == $sk) {
            $dmg[0] += 23;
            $dmg[1] += 35;
        }
        $dmg[0] += $sil * 0.4 + $updmg[0];
        $dmg[1] += $sil * 1.5 + $updmg[1];
        $par[1] = implode("-", $dmg);
    } else {
        if ($pl['level'] >= 13) {
            $par[71] += $pl['level'];
        }
        $sil = $par[30] + $pl['sila'];
        $dmg = explode("-", $par[1]);
        $dmg[0] += $sil * 0.1;
        $dmg[1] += $sil * 0.2;
        $par[1] = implode("-", $dmg);
    }

    $nablud = $par[56] + $um[24] + $clnablud;
    for ($i = 0; $i <= 71; $i++) {
        $st .= "$par[$i]|";
    }
    if ($par['expbonus']) {
        $expb = ($par['expbonus'] / 100) + 1;
    } else {
        $expb = 1;
    }
    if ($par['massbonus']) {
        $massb = $par['massbonus'];
    } else {
        $massb = 1;
    }
# бонус опыта, убирать ручками $expb+0.1  = 10% бонус
    $bonusbd = 'expbonus@' . ($expb + 0.1) . '|massbonus@' . $massb;
    for ($i = 0; $i < count($immune); $i++) {
        $immunes_arr .= ($immune[$i] > 0 ? '1' : '0') . '|';
    }
    $immunes_arr = substr($immunes_arr, 0, strlen($immunes_arr) - 1);
    mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `immunes`='" . $immunes_arr . "',`otherbonus`='" . $bonusbd . "',`masebonus`='" . $newmase . "',`damage_mods`='" . $dmgmod . "',`bl`='" . $bl . "', `nablud`='" . $nablud . "', `od`='" . $od . "', `st`='" . $st . "', `hps`='" . $hps . "', `mps`='" . $mps . "', `affect`='" . $affect . "' WHERE `id`='" . $id . "' LIMIT 1;");
    if ($uphp > 0 or $upmp > 0) {
        calchp3($uphp, $upmp);
    } else {
        calchp();
    }
}


function allparam($pl)
{
    $pt = explode("|", $pl['st']);
    $um = explode("|", $pl['umen']);
    if ($pl['perk'] == '') {
        $pl['perk'] = "|||||||||||||||||||||||||||||";
    }
    $perk = explode("|", $pl['perk']);
    $mass = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT Sum(`items`.`massa`) AS `mass` ,`invent`.`pl_id`,`invent`.`bank` FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`='" . $pl['id'] . "' AND `invent`.`bank`='0';"));
    if ($mass['mass'] == '') $mass['mass'] = 0;
    $trw = array(affect($pl['affect'], 3));
    foreach ($trw as $key => $val) {
        $pt[$key] += $val;
    }
    foreach ($perk as $key => $val) {
        if ($val == '') {
            $perk[$key] = 0;
        }
        $perk[$key] = $val;
    }
    $pt[5] += $perk[19] * 30;
    $pt[6] += $perk[0] * 30;
    $pt[7] += $perk[5] * 30;
    $pt[8] += $perk[15] * 30;
    $pt[9] += $perk[32] * 30;
//$pt[10]+=$pl[10]+($perk[19]*30);
    $pt[30] += $pl['sila'] + ($perk[7] * 2);
    $pt[31] += $pl['lovk'] + ($perk[9] * 2);
    $pt[32] += $pl['uda4a'] + ($perk[10] * 2);
    $pt[33] += $pl['zdorov'] + ($perk[8] * 2);
    $pt[34] += $pl['znan'] + ($perk[11] * 2);
    $pt[35] += $pl['mudr'];
    for ($i = 30; $i <= 35; $i++) {
        if ($pt[$i] < 0) $pt[$i] = 1;
    }
    if ($pl['level'] < 5) {
        $od = 80;
    } else if ($pl['level'] < 10) {
        $od = 90;
    } else $od = 100;
    $pt[28] = $od + $um[11] + $pt[28];
    $pt[36] += $um[1];
    $pt[37] += $um[2];
    $pt[38] += $um[3];
    $pt[39] += $um[4];
    $pt[40] += $um[5];
    $pt[41] += $um[6];
    $pt[42] += $um[7];
    $pt[43] += $um[8];
    $pt[44] += $um[9];
    $pt[45] += $um[12] + ($perk[27] * 25);
    $pt[46] += $um[13] + ($perk[24] * 25);//магия огня и воды
    $pt[49] += $um[16] + ($perk[28] * 25);
    $pt[50] += $um[17] + ($perk[29] * 25);//сопротивление магии огня и воды
    $pt[53] += $um[21];
    $pt[54] += $um[22];
    $pt[55] += $um[23];
    $pt[56] += $pl['nablud'];
    $pt[57] += $um[25];
    $pt[58] += $um[26];

//$pt[59]+=$um[27];
//$pt[60]+=$um[28];
    $pt[59] += $pl['fish_skill'];
    $pt[61] += $um[29];
    $pt[62] += $um[30];
    $pt[63] += $um[31];
    $pt[64] += $um[32];
    $pt[66] += $um[33];
    $pt[68] += $pl['alhim'];
    $pt[70] += $pl['trav'];
    $pt[60] += $pl['les'];
    $pt[72] = $pl['level'];
    $pt[73] = $pt[71];
    $pt[74] = $pl['vzlomshik_nav'];
    $pt[75] = $pl['koldyn'];
    $pt[71] = $mass['mass'];
    $pt[99] = $um[20];
    $pt[101] = 0;
    $pt[102] = 0;
    $pt[103] = 0;
    $pt[104] = 0;
    if ($pl['damage_mods'] != 0) {
        $mods = explode("|", $pl['damage_mods']);
        foreach ($mods as $mval) {
            if ($mval != '') {
                $mod = explode("@", $mval);
                $pt[$mod[0] + 100] = $mod[1];
            }
        }
    }
    return $pt;
}

function used($id, $login, $loc)
{
    $user = $_SESSION['user'];
    $pl = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM user WHERE login='$login'"));
    if ($pl == '') {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Персонажа \"$login\" несуществует!</font></font></b><br>";
    } else if ($pl[last] < (time() - 300)) {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Персонажа \"$login\" нет в игре!</font></font></b><br>";
    } else if ($loc != $pl[loc]) {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Персонажа \"$login\" нет в этой локации!</font></font></b><br>";
    } else if ($pl[fight] > 0) {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Неудачно! Персонаж \"$login\" в бою!</font></font></b><br>";
    } else {
        $it = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT invent.*, items.* FROM items INNER JOIN invent ON items.id = invent.protype WHERE id_item='$id'"));
        switch ($it[num_a]) {
            case 32:
                $pl[hp] += $it[effect];
                $msg[0] = "Зелье Восстановления $it[effect] HP";
                break;
            case 33:
                $pl[mp] += $it[effect];
                $msg[0] = "Зелье Восстановления $it[effect] MP";
                break;
        }
        if ($pl[hp] > $pl[hp_all]) {
            $pl[hp] = $pl[hp_all];
        }
        if ($pl[mp] > $pl[mp_all]) {
            $pl[mp] = $pl[mp_all];
        }
//---пересчет восстановления
        $hps = $pl['hp_all'] / $pl['hps'];
        $mps = $pl['mp_all'] / $pl['mps'];
        $chp = time() + (($pl['hp_all'] - $pl['hp']) / $hps);
        $cmp = time() + (($pl['mp_all'] - $pl['mp']) / $mps);
//-----------------
        if ($user['login'] != $login) {
            $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;Персонаж <b>$user[login]</b>  применил к вам <b>\"$it[name]\".</b></font><BR>'+'');";
            chmsg($ms, $login);
        }
        mysqli_query($GLOBALS['db_link'], 'UPDATE user SET hp=' . AP . $pl[hp] . AP . ', mp=' . AP . $pl[mp] . AP . ', chp=' . AP . $chp . AP . ', cmp=' . AP . $cmp . AP . ' WHERE id=' . AP . $pl[id] . AP . 'LIMIT 1;');
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Вы удачно применили \"$msg[0]\"!</font></font></b><br>";
        it_break($id);
    }
    return $msg;
}

function mute($login, $from, $id, $fromid)
{
    $us = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM user WHERE login='" . $login . "' LIMIT 1;"));
    if ($us['id']) {

        $item = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'], 'SELECT `invent`.*,  `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`="' . $fromid . '" AND `id_item`="' . $id . '" LIMIT 1;'));
        if ($item['id_item']) {
            mysqli_query($GLOBALS['db_link'], "UPDATE user SET sleep='" . (time() + 300) . "' WHERE login='" . $us[login] . "'LIMIT 1;");
                $timemolch = '<b>5</b> минут';
                $msg[msg] = "<b><font class=nickname><font color=#cc0000>Вы успешно наложили заклятие молчания на \"$login\"!</font></font></b><br>";
                $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#CC0000>Внимание!</font></b></font>&nbsp;На персонажа <b>" . $us['login'] . "</b> наложено заклятие молчания сроком на " . $timemolch . ". (<b>" . $from . "</b>)</font><BR>'+'');";
            chmsg($ms, '');
            it_break($item['id_item']);
            } else {
                $msg[msg] = '<font class=proce>Предмет не найден.</font>';
            }

    } else {
        $msg[msg] = '<font class=proce>Игрок не найден.</font>';
    }
    return $msg;
}

function addlic($login, $item, $type)
{
    $typetolog = '0';
    $abouttolog = '0'; # переменные для логов: первая всегда 0
    $pl = allparam($login);
    $time = $item[effect] * 86400;
    $bt = 0;
    $need = explode("|", $item['need']);
    foreach ($need as $value) {
        $treb = explode("@", $value);
        if ($treb[0] != 28 and $treb[0] != 71) {
            if ($pl[$treb[0]] < $treb[1]) {
                $bt += 1;
            }
        }
    }
    switch ($type) {
        case 1:
            if ($bt == 0) {
                $addlic = 0;
                $newlic = '';
                $lic = explode("|", $login['licens']);
                foreach ($lic as $value) {
                    $licens = explode("@", $value);
                    if ($licens[0] == 1) {
                        if ($licens[1] < time()) {
                            $licens[1] = time() + $time;
                        } else {
                            $licens[1] += $time;
                        }
                        $newlic .= implode("@", $licens) . "|";
                        $addlic = 1;
                        $msg[msg] = "\"$item[name]\" продлена на $item[effect] дней.";
                    } else if ($licens[1] < time()) {
                        $newlic .= "";
                    } else {
                        $newlic .= implode("@", $licens) . "|";
                    }
                }
                if ($addlic == 0) {
                    $newlic .= "1@" . (time() + $time) . "|";
                    $msg[msg] = "Использована \"$item[name]\" на $item[effect] дней.";
                }
                mysqli_query($GLOBALS['db_link'], "UPDATE user SET licens='" . $newlic . "' WHERE id=" . $login[id] . " ;");
                it_break($item['id_item']);
            }
            break;
        case 2:
            if ($bt == 0) {
                $addlic = 0;
                $newlic = '';
                $lic = explode("|", $login['licens']);
                foreach ($lic as $value) {
                    $licens = explode("@", $value);
                    if ($licens[0] == 2) {
                        if ($licens[1] < time()) {
                            $licens[1] = time() + $time;
                            $msg[msg] = "Использована \"$item[name]\" на $item[effect] дней.";
                        } else {
                            $licens[1] += $time;
                            $msg[msg] = "\"$item[name]\" продлена на $item[effect] дней.";
                        }
                        $newlic .= implode("@", $licens) . "|";
                        $addlic = 1;
                    } else if ($licens[1] < time()) {
                        $newlic .= "";
                    } else {
                        $newlic .= implode("@", $licens) . "|";
                    }
                }
                if ($addlic == 0) {
                    $newlic .= "2@" . (time() + $time) . "|";
                    $msg[msg] = "Использована \"$item[name]\" на $item[effect] дней.";
                }
                mysqli_query($GLOBALS['db_link'], "UPDATE user SET licens='" . $newlic . "' WHERE id=" . $login[id] . " ;");
                it_break($item['id_item']);
            }
            break;
    }
    $typetolog .= '@23';
    $abouttolog .= '@' . $msg[msg];
    if ($typetolog != '0' and $abouttolog != '0') {
        player_actions($login['id'], $typetolog, $abouttolog);
    }
    return $msg;
}

function zelused($id, $login, $loc)
{
    global $player;
    $user = $_SESSION['user'];
    $pl = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM user WHERE login='$login'"));
    $pl_st = allparam($pl);
    if ($pl == '') {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Персонажа \"$login\" несуществует!</font></font></b><br>";
    } else if ($pl[last] < (time() - 300)) {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Персонажа \"$login\" нет в игре!</font></font></b><br>";
    } else if ($loc != $pl[loc]) {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Персонажа \"$login\" нет в этой локации!</font></font></b><br>";
    } else if ($pl[fight] > 0) {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Неудачно! Персонаж \"$login\" в бою!</font></font></b><br>";
    } else {
        $it = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT invent.*, items.* FROM items INNER JOIN invent ON items.id = invent.protype WHERE id_item='$id'"));
        if ($pl['buffs'] == '') {
            $pl['buffs'] = "||||";
        }
        $buffs = explode("|", $pl['buffs']);
        $i = 0;
        $NewEffectID = 0;
        $NewEffectParams = '';
        while ($i <= 4) {
            if ($buffs[$i] != '') {
                $buff .= "$buffs[$i]|";
                $i++;
            } else if ($i <= 4) {
                if ($it[num_a] == 14) {
                    $buff .= "$it[num_a]@$it[effect]@" . (time() + 7200) . "|";
                    $i = 99;
                } else {
                    $buff .= "$it[num_a]@$it[effect]@" . (time() + 3600) . "|";
                    $i = 99;
                }
            }
        }
        if ($i == 99) {
            switch ($it[num_a]) {
                case 1:
                    $msg[0] = "Зелье +$it[effect] силы";
                    break;//Мощь
                case 2:
                    $msg[0] = "Зелье +$it[effect] ловкости";
                    break;//Проворность
                case 3:
                    $msg[0] = "Зелье +$it[effect] удачи";
                    break;//Везение
                case 4:
                    $msg[0] = "Зелье +$it[effect] здоровья";
                    break;//здоровье
                case 5:
                    $msg[0] = "Зелье +$it[effect] знаний";
                    break;//Разум
                case 6:
                    $msg[0] = "Зелье +$it[effect] сноровки";
                    break;//сноровка
                case 7:
                    $msg[0] = "Зелье +$it[effect] урона";
                    break;//удар
                case 8:
                    $msg[0] = "Зелье +$it[effect] брони";
                    break;//кб
                case 9:
                    $msg[0] = "Зелье +$it[effect] пробоя брони";
                    break;//пробой брони
                case 10:
                    $msg[0] = "Зелье +$it[effect] уворота";
                    break;//уловка
                case 11:
                    $msg[0] = "Зелье +$it[effect] точности";
                    break;//точность
                case 12:
                    $msg[0] = "Зелье +$it[effect] сокрушения";
                    break;//сокрушение
                case 13:
                    $msg[0] = "Зелье +$it[effect] стойкости";
                    break;//стойкость
                case 14:
                    $msg[0] = "$it[name]";
                    foreach ($buffs as $value) {
                        $buff_check = explode("@", $value);
                        if ($buff_check[0] == 14) {
                            $stopbuff = 1;
                        }
                    }
                    break;//арт зелье
                case 15:
                    $msg[0] = "Зелье наблюдательности";
                    break;//зелье наблюдательности
            }
            if ($stopbuff == 0) {
                $msg[msg] = "<b><font class=nickname><font color=#cc0000>Вы удачно применили \"$msg[0]\"!</font></font></b><br>";
                mysqli_query($GLOBALS['db_link'], "UPDATE user SET buffs='$buff' WHERE login='$login'");
                mysqli_query($GLOBALS['db_link'], "INSERT INTO `effects` (`uid`,`eff_id`,`effects`,`side_effects`,`time`,`side_time`) VALUES ('" . $pl['id'] . "','" . $it['eff_id'] . "','" . $it['effects'] . "','" . $it['side_effects'] . "','" . ($it['eftime'] + time()) . "','" . (($it['efside_time'] > 0) ? $it['efside_time'] + time() : '0') . "');");
                calcstat($pl[id]);
                if ($user['login'] != $login) {
                    $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;Персонаж <b>$user[login]</b>  применил к вам <b>\"$it[name]\".</b></font><BR>'+'');";
                    chmsg($ms, $login);
                }
                it_break($id);
            } else {
                $msg[msg] = "<b><font class=nickname><font color=#cc0000>Зелье такого типа может быть использовано только 1 раз!</font></font></b><br>";
            }
        } else {
            $msg[msg] = "<b><font class=nickname><font color=#cc0000>Вы выпили максимальное количество зелий!</font></font></b><br>";
        }
    }
    return $msg;
}

function zelinvis($id, $login, $loc)
{
    $user = $_SESSION['user'];
    $pl = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM user WHERE login='$login'"));
    if ($pl == '') {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Персонажа \"$login\" несуществует!</font></font></b><br>";
    } else if ($pl[last] < (time() - 300)) {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Персонажа \"$login\" нет в игре!</font></font></b><br>";
    } else if ($loc != $pl[loc]) {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Персонажа \"$login\" нет в этой локации!</font></font></b><br>";
    } else if ($pl[fight] > 0) {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Неудачно! Персонаж \"$login\" в бою!</font></font></b><br>";
    } else {
        $it = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT invent.*, items.* FROM items INNER JOIN invent ON items.id = invent.protype WHERE id_item='$id'"));
        if ($pl['invisible'] > time()) {
            mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `invisible`='" . ($pl['invisible'] + $it['effect']) . "' WHERE `id`='" . $pl['id'] . "'");
            it_break($it['id_item']);
        } elseif ($pl['invisible'] < time()) {
            mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `invisible`='" . ($it['effect'] + time()) . "' WHERE `id`='" . $pl['id'] . "'");
            it_break($it['id_item']);
        }
        $msg[msg] = '<b><font class=nickname><font color=#cc0000>Ветер развеял образ ' . $pl['login'] . ', и он растворился в воздухе.</font></font></b>';
        if ($user['login'] != $login) {
            $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;Персонаж <b>$user[login]</b>  применил к вам <b>\"$it[name]\".</b></font><BR>'+'');";
            chmsg($ms, $login);
        }
    }
    return $msg;
}

function doktor($svpar, $login, $loc)
{
    $user = player();
    $pl = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM user WHERE login='$login'"));
    $pl_st = allparam($pl);
    $vis = explode("|", $pl['viselica']);
    switch ($svpar['effect']) {
        case 1:
            $formsg = "легких травм";
            break;
        case 2:
            $formsg = "средних травм";
            break;
        case 3:
            $formsg = "тяжелых травм";
            break;
        case 4:
            $formsg = "осложненных травм";
            break;
        case 999:
            $formsg = "легких травм";
            break;
        case 998:
            $formsg = "средних травм";
            break;
        case 666:
            break;
    }
    if ($pl == '') {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Персонажа \"$login\" несуществует!</font></font></b><br>";
    } else if ($pl[last] < (time() - 300)) {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Персонажа \"$login\" нет в игре!</font></font></b><br>";
    } else if ($user[loc] != $pl[loc]) {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Персонажа \"$login\" нет в этой локации!</font></font></b><br>";
    } else if ($pl[fight] > 0) {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Неудачно! Персонаж \"$login\" в бою!</font></font></b><br>";
    } else if ($vis[1] > time()) {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Неудачно! Персонаж \"$login\" не поддается лечению упав с виселицы!</font></font></b><br>";
    } else {
        $aff = test_affect($pl['affect']);
        $newaff = "";
        if ($aff != '') {
            $msg[msg] = "aff: $aff";
            $lech = 0;
            if ($svpar['effect'] == 666) {
                $newaff = "";
                $msg[msg] = "<b><font class=nickname><font color=#cc0000>Вы вылечили все травмы персонажу \"$login\"!</font></font></b><br>";
                mysqli_query($GLOBALS['db_link'], "UPDATE user SET affect='" . $newaff . "' WHERE id=" . $pl['id'] . ";");
                calcstat($pl['id']);
                it_break($svpar[id]);
                log_write("doktor", $svpar[name], "Все травмы", $pl[login]);
                if ($pl['login'] != $user['login']) {
                    $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;Персонаж <b>$user[login]</b> вылечил вам <b>Все травмы</b>! Не забывайте оплачивать работу доктора.</b></font><BR>'+'');";
                    chmsg($ms, $pl['login']);
                }
            } else {
                $affect = explode("|", $aff);
                foreach ($affect as $key => $value) {
                    $travm = explode("@", $value);
                    if ($lech == '') {
                        if ($travm[2] == 1) {
                            if ($svpar['effect'] == 1 or $svpar['effect'] == 999) {
                                $lech = 1;
                                $affect[$key] = "";
                            } else {
                                    $msg[msg] = "<b><font class=nickname><font color=#cc0000>У персонажа \"$login\" нет $formsg!</font></font></b><br>";
                                }
                        } else if ($travm[2] == 2) {
                            if ($svpar['effect'] == 2) {
                                $lech = 1;
                                $affect[$key] = "";
                            } else {
                                    $msg[msg] = "<b><font class=nickname><font color=#cc0000>У персонажа \"$login\" нет $formsg!</font></font></b><br>";
                                }
                        } else if ($travm[2] == 3) {
                            if ($svpar['effect'] == 3) {
                                $lech = 1;
                                $affect[$key] = "";
                            } else {
                                    $msg[msg] = "<b><font class=nickname><font color=#cc0000>У персонажа \"$login\" нет $formsg!</font></font></b><br>";
                                }
                        } else if ($travm[2] == 4) {
                            if ($svpar['effect'] == 4) {
                                $lech = 1;
                                $affect[$key] = "";
                            } else {
                                    $msg[msg] = "<b><font class=nickname><font color=#cc0000>У персонажа \"$login\" нет $formsg!</font></font></b><br>";
                                }
                        }
                    }
                    if ($affect[$key] != '') {
                        $newaff .= $affect[$key] . "|";
                    } else {
                        $newaff .= "";
                    }
                }
                if ($lech != 0) {
                    switch ($svpar['effect']) {
                        case 1:
                            $msg[msg] = "<b><font class=nickname><font color=#cc0000>Вы вылечили легкую травму персонажу \"$login\"!</font></font></b><br>";
                            $log = "легкую травму";
                            break;
                        case 2:
                            $msg[msg] = "<b><font class=nickname><font color=#cc0000>Вы вылечили среднюю травму персонажу \"$login\"!</font></font></b><br>";
                            $log = "среднюю травму";
                            break;
                        case 3:
                            $msg[msg] = "<b><font class=nickname><font color=#cc0000>Вы вылечили тяжелую травму персонажу \"$login\"!</font></font></b><br>";
                            $log = "тяжелую травму";
                            break;
                        case 4:
                            $msg[msg] = "<b><font class=nickname><font color=#cc0000>Вы вылечили осложненную травму персонажу \"$login\"!</font></font></b><br>";
                            $log = "осложненную травму";
                            break;
                        case 999:
                            $msg[msg] = "<b><font class=nickname><font color=#cc0000>Вы вылечили легкую травму себе!</font></font></b><br>";
                            $log = "самолечение";
                            break;
                    }
                    mysqli_query($GLOBALS['db_link'], "UPDATE user SET affect='" . $newaff . "' WHERE id=" . $pl['id'] . ";");
                    it_break($svpar[id_item]);
                    log_write("doktor", $svpar[name], $log, $pl[login]);
                    calcstat($pl['id']);
                    if ($pl['login'] != $user['login']) {
                        $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;Персонаж <b>$user[login]</b> вылечил вам <b>$log</b>! Не забывайте оплачивать работу доктора.</b></font><BR>'+'');";
                        chmsg($ms, $pl['login']);
                    }
                }
            }

        } else {
            $msg[msg] = "<b><font class=nickname><font color=#cc0000>Персонаж \"$login\" здоров!</font></font></b><br>";
        }
    }
    return $msg;
}

function it_break($id)
{
    $it = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT invent.iznos, invent.dolg, items.acte,invent.clan FROM items INNER JOIN invent ON items.id = invent.protype WHERE id_item='$id'"));
    $it[iznos] += 1;
    //old if($it[acte]!='' and $it[iznos]>=$it[dolg]){
    if ($it[iznos] >= $it[dolg]) {
        if ($it[clan] == 1) {
            mysqli_query($GLOBALS['db_link'], "DELETE FROM clan_kazna WHERE id_item='$id';");
        }
        mysqli_query($GLOBALS['db_link'], 'DELETE FROM invent WHERE id_item = ' . AP . $id . AP . 'LIMIT 1;');
    } else {
        mysqli_query($GLOBALS['db_link'], 'UPDATE invent SET iznos=' . AP . $it[iznos] . AP . ' WHERE id_item=' . AP . $id . AP . 'LIMIT 1;');
    }
}

function transfer($id, $login, $loc, $name, $transferer, $sum, $ttext = NULL)
{
    global $player;
    $login = chars($login);
    $pl = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM user WHERE login='$login'"));
    if ($pl == '') {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Персонажа \"$login\" несуществует!</font></font></b><br>";
    } else if ($pl[last] < (time() - 300)) {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Персонажа \"$login\" нет в игре!</font></font></b><br>";
    } else if ($loc != $pl[loc]) {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Персонажа \"$login\" нет в этой локации!</font></font></b><br>";
    } else if ($pl[fight] > 0) {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Неудачно! Персонаж \"$login\" в бою!</font></font></b><br>";
    } else {
        if ($id > 1) {
            $GetItem = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT `invent`.*,`items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `id_item`='" . $id . "' AND `pl_id`='" . $player['id'] . "'"));
            if ($GetItem) {
                mysqli_query($GLOBALS['db_link'], 'UPDATE invent SET pl_id=' . AP . $pl[id] . AP . ' WHERE id_item=' . AP . $id . AP . 'LIMIT 1;');
                $msg[msg] = "<b><font class=nickname><font color=#cc0000>Вы удачно передали \"$name\"!</font></font></b><br>";
                log_write("transfer", $name, $sum, $pl[login]);
                $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;Персонаж <b>$transferer</b>  передал вам <b>\"$name\".</b></font><BR>'+'');";
                pvu_logs($player['id'], "4", "|0|" . getIP() . "|" . $pl['ip'] . "|" . $pl['level'] . "|" . $pl['login'] . "|" . $GetItem['level'] . "|" . lr($GetItem['price']) . "|" . ($GetItem['dolg'] - $GetItem['iznos']) . "|" . $GetItem['dolg'] . "|0|" . $GetItem['name']);
                pvu_logs($pl['id'], "4", "|1|" . $pl['ip'] . "|" . getIP() . "|" . $player['level'] . "|" . $player['login'] . "|" . $GetItem['level'] . "|" . lr($GetItem['price']) . "|" . ($GetItem['dolg'] - $GetItem['iznos']) . "|" . $GetItem['dolg'] . "|0|" . $GetItem['name']);
                chmsg($ms, $login);
            }
        } else if ($pl[level] < 5) {
            $msg[msg] = "<b><font class=nickname><font color=#cc0000>Игровую валюту можно передовать только персонажам достигшим 5 уровень!</font></font></b><br>";
        } else {
            $typetolog = '0';
            $abouttolog = '0';  # переменные для логов: первая всегда 0
            if ($id == 0) {
                $plbablo = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], 'SELECT * FROM user WHERE login=' . AP . $transferer . AP . ';'));
                $bablo = $plbablo[nv];
                if ($bablo >= $sum) {
                    mysqli_query($GLOBALS['db_link'], 'UPDATE user SET nv=nv+' . AP . $sum . AP . ' WHERE id=' . AP . $pl[id] . AP . 'LIMIT 1;');
                    mysqli_query($GLOBALS['db_link'], 'UPDATE user SET nv=nv-' . AP . $sum . AP . ' WHERE login=' . AP . $transferer . AP . 'LIMIT 1;');
                    $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;Персонаж <b>$transferer</b> передал вам <b>\"$name\"</b> в размере <b>" . lr($sum) . "</b></font><BR>'+'');";
                    chmsg($ms, $login);
                    $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;Вы передали персонажу <b>$login</b> <b>" . lr($sum) . "</b></font><BR>'+'');";
                    chmsg($ms, $transferer);
                    pvu_logs($player['id'], "2", "|0|" . getIP() . "|" . $pl['ip'] . "|" . $pl['level'] . "|" . $pl['login'] . "|" . $sum . "|0|" . $ttext);
                    pvu_logs($pl['id'], "2", "|1|" . $pl['ip'] . "|" . getIP() . "|" . $player['level'] . "|" . $player['login'] . "|" . $sum . "|0|" . $ttext);
                    log_write("transfer", "LR", $sum, $pl[login]);
                    $typetolog .= '@16';
                    $abouttolog .= '@<b><font color="#CC0000">' . lr($sum) . '</font></b> персонажу: <b>' . $pl['login'] . '</b>';
                } else {
                    $ms = "parent.frames['chmain'].add_msg('<b><font class=nickname><font color=#cc0000>У Вас нехватает денег!</font></font></b><br>'+'');";
                    chmsg($ms, $transferer);
                }
            } else {
                if (($id == 1) and ($login == $transferer)) {
                    $plbablo = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], 'SELECT * FROM user WHERE login=' . AP . $transferer . AP . ';'));
                    $bablo = $plbablo[dd];
                    if ($bablo >= $sum) {
                        mysqli_query($GLOBALS['db_link'], 'UPDATE user SET baks=baks+' . AP . $sum . AP . ' WHERE id=' . AP . $pl[id] . AP . 'LIMIT 1;');
                        mysqli_query($GLOBALS['db_link'], 'UPDATE user SET dd=dd-' . AP . $sum . AP . ' WHERE login=' . AP . $transferer . AP . 'LIMIT 1;');
                            $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> Вы обменяли <b>$sum DLR</b> на <b>$</b>. Зачислено <b>$sum $.</b></b></font><BR>'+'');";
                        chmsg($ms, $login);
                        } else {
                            $ms = "parent.frames['chmain'].add_msg('<b><font class=nickname><font color=#cc0000>У Вас нехватает денег!</font></font></b><br>'+'');";
                            chmsg($ms, $transferer);
                        }
                } else {
                    if (($id == 1) and ($login != $transferer)) {
                        $plbablo = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], 'SELECT * FROM user WHERE login=' . AP . $transferer . AP . ';'));
                        $bablo = $plbablo[dd];
                        if ($bablo >= $sum) {
                            mysqli_query($GLOBALS['db_link'], 'UPDATE user SET dd=dd+' . AP . $sum . AP . ' WHERE id=' . AP . $pl[id] . AP . 'LIMIT 1;');
                            mysqli_query($GLOBALS['db_link'], 'UPDATE user SET dd=dd-' . AP . $sum . AP . ' WHERE login=' . AP . $transferer . AP . 'LIMIT 1;');
                            $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;Персонаж <b>$transferer</b> передал вам <b>DLR</b> в размере <b>$sum DLR.</b></font><BR>'+'');";
                            chmsg($ms, $login);
                            $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;Вы передали персонажу <b>$login</b> <b>$sum DLR.</b></font><BR>'+'');";
                            chmsg($ms, $transferer);
                            log_write("transfer", "DLR", $sum, $pl[login]);
                            $typetolog .= '@17';
                            $abouttolog .= '@<b><font color="#CC0000">' . $sum . '</font></b> DLR персонажу: <b>' . $pl['login'] . '</b>';
                        } else {
                            $ms = "parent.frames['chmain'].add_msg('<b><font class=nickname><font color=#cc0000>У Вас нехватает денег!</font></font></b><br>'+'');";
                            chmsg($ms, $transferer);
                        }
                    }
                }
            }
        }
        if ($typetolog != '0' and $abouttolog != '0') {
            player_actions($player['id'], $typetolog, $abouttolog);
        }


    }
    return $msg;
}

function gift($id, $login, $loc, $name, $gifter, $sum)
{
    $login = chars($login);
    $pl = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM user WHERE login='$login'"));
    if ($pl == '') {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Персонажа \"$login\" несуществует!</font></font></b><br>";
    } else if ($pl[last] < (time() - 300)) {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Персонажа \"$login\" нет в игре!</font></font></b><br>";
    } else if ($loc != $pl[loc]) {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Персонажа \"$login\" нет в этой локации!</font></font></b><br>";
    } else if ($pl[fight] > 0) {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Неудачно! Персонаж \"$login\" в бою!</font></font></b><br>";
    } else {
        $gift = "Подарок от \"$gifter\"";
        mysqli_query($GLOBALS['db_link'], 'UPDATE invent SET pl_id=' . AP . $pl[id] . AP . ', gift=' . AP . $gift . AP . ' WHERE id_item=' . AP . $id . AP . 'LIMIT 1;');
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Вы подарили \"$name\" для $login!</font></font></b><br>";
        log_write("present", $name, $sum, $login);
        $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;Получен подарок <b>\"$name\"</b> от <b>$gifter.</b></font><BR>'+'');";
        chmsg($ms, $login);
    }
    return $msg;
}

function chmsg($msg, $login)
{
    if ($login != '') {
        $login = '<' . $login . '>';
    }
    mysqli_query($GLOBALS['db_link'], 'INSERT INTO chat (time,login,dlya,msg) VALUES (' . AP . time() . AP . ',' . AP . "sys" . AP . ',' . AP . $login . AP . ',' . AP . addslashes("$msg") . AP . ');');
}

function testcompl()
{
    $pl = player();
    $st = allparam($pl);
    $sql = mysqli_query($GLOBALS['db_link'], "SELECT `invent`.*,`items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `used`='1' AND `pl_id`='" . $pl['id'] . "' ORDER BY `slot`;");
    while ($row = mysqli_fetch_assoc($sql)) {
        $it = explode("|", $row['need']);
        if ($row['slot'] == 5) {
            $el += 1;
        }
        if ($row['slot'] == 5 and $el > $st[3]) {
            updateslot(0, $row['id_item'], $pl['id'], 0);
            continue;
        }
        foreach ($it as $value) {
            $stat = explode("@", $value);
            if ($stat[0] == 72) {
                $stat[1] = $row['level'];
            }
            if ($st[$stat[0]] < $stat[1]) {
                if ($row['slot'] == 4) {
                    $st[3] = 0;
                }
                $s[] = "`id_item`='" . $row['id_item'] . "'";
            }
        }
    }
    if ($s != '') {
        $s = implode(" or ", $s);
        mysqli_query($GLOBALS['db_link'], "UPDATE `invent` SET `used`='0',`curslot`='0' WHERE " . $s . " AND `pl_id`='" . $pl['id'] . "'");
        calcstat($pl['id']);
        testcompl();
    }
    if ($pl['fight'] == 0) {
        save_hp();
    }
    calchp();
}

function affect($aff, $var, $travm = NULL)
{
    /* DataBase */
    $effects = array('', 'Легкая травма', 'Средняя травма', 'Тяжелая травма', 'Осложненная травма', 'Излечение', '', '', 'Темное проклятие', 'Благословение ангела', 'Магическое зеркало', 'Берсеркер', 'Милосердие Создателя', 'Алкогольное опьянение11', 'Свиток Покровительства', 'Блок', 'Тюрьма', 'Молчанка', 'Форумная молчанка', 'Свиток Неизбежности', 'Зелье Колкости', 'Зелье Загрубелой Кожи', 'Зелье Просветления', 'Зелье Гения', 'Яд', 'Зелье Иммунитета', 'Зелье Силы', 'Зелье Защиты От Ожогов', 'Зелье Арктических Вьюг', 'Зелье Жизни', 'Зелье Сокрушительных Ударов', 'Зелье Стойкости', 'Зелье Недосягаемости', 'Зелье Точного Попадания', 'Зелье Ловкости', 'Зелье Удачи', 'Зелье Огненного Ореола', 'Зелье Метаболизма', 'Зелье Медитации', 'Зелье Громоотвода', 'Зелье Сильной Спины', 'Зелье Скорбь Лешего', 'Зелье Боевой Славы', 'Зелье Ловких Ударов', 'Зелье Спокойствия', 'Зелье Мужества', 'Зелье Человек-Гора', 'Зелье Секрет Волшебника', 'Зелье Инквизитора', 'Зелье Панциря', '', 'Секретное Зелье', 'Зелье Скорости', 'Зелье Соколиный Взор', 'Зелье Подвижности', 'Фронтовые 100 грамм', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Зелье Кровожадности', 'Зелье Быстроты', 'Свиток Величия', 'Свиток Каменной кожи', 'Слеза Создателя', 'Гнев Локара', 'Дар Иланы', 'Новогодний бонус', 'Эликсир из Подснежника', 'Молодильное яблочко', 'Благословение Иланы', 'День всех влюбленных', 'Галантный кавалер', 'Рыбный Самогон', 'Рыбная Водка');
    /* Effects Show */
    $s = $st = '';
    $affect = explode("|", $aff);

    foreach ($affect as $val) {
        list($row['f_params'], $row['time'], $row['eff_id']) = explode('@', $val);

        $TimeOr = $row['time'];

        /* Вычесляем время */
        if ($row['time'] > time()) {
            $row['time'] -= time();
            $ch = floor($row['time'] / 3600);
            $min = floor(($row['time'] - ($ch * 3600)) / 60);
            $sec = floor(($row['time'] - ($ch * 3600)) % 60);
            if ($var == 0) {
                $TimeOut = $ch . "ч " . $min . "мин ";
            } elseif ($var == 1) {
                $TimeOut = (($ch < 10) ? '0' . $ch : $ch) . ":" . (($min < 10) ? '0' . $min : $min) . ":" . (($sec < 10) ? '0' . $sec : $sec);
            }

            /* Считаем статы */
            $params = explode(";", $row['f_params']);
            foreach ($params as $f_params) {
                $sts = explode("/", $f_params);
                if ($sts[0] == 'all') {
                    $stat[30] += $sts[1];
                    $stat[31] += $sts[1];
                    $stat[32] += $sts[1];
                    $stat[5] += $sts[1] * 2;
                    $stat[6] += $sts[1] * 2;
                    $stat[7] += $sts[1] * 2;
                    $stat[8] += $sts[1] * 2;
                    $stat[9] += $sts[1] * 2;
                } else {
                    $stat[$sts[0]] += $sts[1];
                }
            }
            if ($var == 0 and !empty($effects[$row['eff_id']]) and $travm == true and $row['eff_id'] < 5) {
                $s .= $effects[$row['eff_id']] . ' еще ' . $TimeOut . ',';
            }
            if ($var == 1 and !empty($effects[$row['eff_id']])) {
                $s .= $row['eff_id'] . "@" . $effects[$row['eff_id']] . "@" . $TimeOut . "|";
            }
            if ($var == 2 and !empty($effects[$row['eff_id']])) {
                $s .= $effects[$row['eff_id']] . '<br />еще ' . $TimeOut . '<br />';
            }
            if ($var == 4 and !empty($effects[$row['eff_id']])) {
                $s .= "[" . $row['eff_id'] . "," . ($TimeOr - time()) . ",'" . $row['f_params'] . "'],";
            }
        }

    }
    if ($var == 3) {
        foreach ($stat as $key => $val) {
            $s .= "$key@$val|";
        }
    } else if ($var == 2 and $s != '') {
        foreach ($stat as $key => $val) {
            $key = stats($key);
            $st .= "<tr><td><font class=travma>&nbsp;&nbsp;$key: </td><td><div align=center><font class=travma><font color=#D90000><b>$val</div></td></tr>";
        }
        $s = "<tr><td><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td colspan=3><img src=http://img.w.wenl.ru/image/1x1.gif width=1 height=1></td></tr><tr><td bgcolor=#eaeaea><div align=center><img src=http://img.w.wenl.ru/image/redcross.gif width=19 height=19 hspace=2 vspace=2></div></td><td bgcolor=#cccccc><img src=http://img.w.wenl.ru/image/1x1.gif width=1 height=1></td><td bgcolor=#f5f5f5><font class=travma><div align=center>$s</div><hr size=1 color=#CCCCCC><table cellpadding=0 cellspacing=3 border=0 width=100%>$st<tr><td colspan=2><img src=http://img.w.wenl.ru/image/1x1.gif width=1 height=6></td></table></font></td></tr><tr><td colspan=3><img src=http://img.w.wenl.ru/image/1x1.gif width=1 height=5></td></tr></table></td></tr>";
    }
    if ($var == 0) {
        return substr($s, 0, strlen($s) - 1);
    } else {
        return $s;
    }
}

function test_affect($aff)
{
    $aff = explode("|", $aff);
    foreach ($aff as $val) {
        $par = explode("@", $val);
        if ($par[1] < time() and $par[1] != '') {
            continue;
        }
        $a[] = $val;
    }
    $aff = implode("|", $a);
    return $aff;
}

function add_trw($pl, $persent)
{
    $ret = "";
    $trwrand = rand(0, 100);
    if ($pl['sklon'] == 5 and $trwrand < 66 and $pl['ability'] > 0 and $pl['lastability'] < time()) {
        $trwtime = 2;
    } else {
        $trwtime = 1;
    }
    if ($persent < 40) {
        $persent = 40;
    }
    if ($persent < 100) {
        $rand = rand(0, $persent);
        if ($rand <= 40) {
            $tr = 1;
            $m0ne_tr = 4;
            $travm = "легкую";
            $time = time() + round(trw_time(rand(1, 2)) / $trwtime);
            $sts[1] = 0.1;
            $sts[2] = 0.2;
        } else if ($rand <= 60) {
            $tr = 2;
            $m0ne_tr = 3;
            $travm = "среднюю";
            $time = time() + round(trw_time(rand(3, 5)) / $trwtime);
            $sts[1] = 0.2;
            $sts[2] = 0.3;
        } else if ($rand <= 100) {
            $tr = 3;
            $m0ne_tr = 2;
            $travm = "тяжелую";
            $time = time() + round(trw_time(rand(6, 8)) / $trwtime);
            $sts[1] = 0.3;
            $sts[2] = 0.5;
        }
        $stt = rand(0, 2);
        $minus = round(rand(30 * $sts[1], 30 * $sts[2]));
        switch ($stt) {
            case 0:
                $st = "30/-" . $minus;
                $m0ne_st = "30@-" . $minus;
                $stat = "<font color=black>Характеристика персонажа снижена: </font><font color=red><b color=red>-" . $minus . "</b></font><font color=black> силы.";
                break;
            case 1:
                $st = "31/-" . $minus;
                $m0ne_st = "31@-" . $minus;
                $stat = "<font color=black>Характеристика персонажа снижена: </font><font color=red><b color=red>-" . $minus . "</b></font><font color=black> ловкости.";
                break;
            case 2:
                $st = "32/-" . $minus;
                $m0ne_st = "32@-" . $minus;
                $stat = "<font color=black>Характеристика персонажа снижена: </font><font color=red><b color=red>-" . $minus . "</b></font><font color=black> удачи.";
                break;
        }
        $par .= "$st@$time@$tr|";
    } else {
        $minus = round(rand(25, 35));
        $st = "all/-" . $minus;
        $m0ne_st = "all@-" . $minus;
        $tr = 4;
        $m0ne_tr = 1;
        $travm = "осложненную боевую";
        $stat = "<font color=black>Характеристики персонажа снижены: </font><font color=red><b color=red>-" . $minus . "</b></font><font color=black> силы, ловкости и удачи. Модификаторы персонажа снижены: </font><font color=red><b color=red>-" . ($minus * 2) . "</b></font><font color=black> уворота, стойкости, сокрушения, точности, пробоя брони и класса брони.";
        $time = time() + round(trw_time(8) / $trwtime);
        $par .= "$st@$time@$tr|";

    }
    $old = test_affect($pl['affect']);
    $newaff = "" . $par . "" . $old . "";
// New Database
    mysqli_query($GLOBALS['db_link'], "INSERT INTO `effects` (`uid`,`eff_id`,`effects`,`time`) VALUES ('" . $pl['id'] . "','" . $m0ne_tr . "','" . $m0ne_st . "','" . $time . "');");
// New Database
    mysqli_query($GLOBALS['db_link'], "UPDATE user SET affect='" . $newaff . "' " . (($pl['ability'] > 0 and $pl['sklon'] == 5 and $pl['lastability'] <= time() and $trwtime == 2) ? ',ability=ability-1,lastability=' . (time() + 1800) . '' : '') . " WHERE id=" . $pl['id'] . " LIMIT 1;");
    calcstat($pl[id]);
    testcompl();
    $ret .= ",\" <font color=#CC0000><b>Получает $travm травму." . ($trwtime == 2 ? ' Силы света помогают ему, время травмы сократилось в 2 раза!' : '') . "</b> $stat\"]";
    return $ret;
}


function trw_time($t)
{
    switch ($t) {
        case 1:
            $tr = 900;
            break;
        case 2:
            $tr = 1800;
            break;
        case 3:
            $tr = 2700;
            break;
        case 4:
            $tr = 3600;
            break;
        case 5:
            $tr = 5400;
            break;
        case 6:
            $tr = 10800;
            break;
        case 7:
            $tr = 21600;
            break;
        case 8:
            $tr = 43200;
            break;
    }
    return $tr;
}


// Дроп с ботов!
function add_drops($pl, $persent)
{
    if ($persent < 100) {
        $rand = rand(0, 100);
        if ($rand <= $persent) {
            $rand = rand(0, 100);
            if ($rand < 50) {
                $tr = 1;
                $m0ne_tr = 4;
                $time = time() + trw_time(rand(1, 3));
                $sts = rand(1, 2) / 10;
            } else if ($rand < 80) {
                $tr = 2;
                $m0ne_tr = 3;
                $time = time() + trw_time(rand(3, 6));
                $sts = rand(3, 4) / 10;
            } else {
                $tr = 3;
                $m0ne_tr = 2;
                $time = time() + trw_time(rand(7, 9));
                $sts = rand(5, 6) / 10;
            }
        }
        $stt = rand(0, 4);
        switch ($stt) {
            case 0:
                $st = "30/-" . round($pl['sila'] * $sts);
                $m0ne_st = "30@-" . round($pl['sila'] * $sts);
                break;
            case 1:
                $st = "31/-" . round($pl['lovk'] * $sts);
                $m0ne_st = "31@-" . round($pl['lovk'] * $sts);
                break;
            case 2:
                $st = "32/-" . round($pl['uda4a'] * $sts);
                $m0ne_st = "32@-" . round($pl['uda4a'] * $sts);
                break;
            case 3:
                $st = "33/-" . round($pl['zdorov'] * $sts);
                $m0ne_st = "33@-" . round($pl['zdorov'] * $sts);
                break;
            case 4:
                $st = "34/-" . round($pl['znan'] * $sts);
                $m0ne_st = "34@-" . round($pl['znan'] * $sts);
                break;
        }
        $par .= "$st@$time@$tr|";
    } else {
        $tr = 3;
        $m0ne_tr = 2;
        $time = time() + trw_time(rand(8, 9));
        $par .= "$st@$time@$tr|";
    }
    $old = test_affect($pl['affect']);
    // New Database
    mysqli_query($GLOBALS['db_link'], "INSERT INTO `effects` (`uid`,`eff_id`,`effects`,`time`) VALUES ('" . $pl['id'] . "','" . $m0ne_tr . "','" . $m0ne_st . "','" . $time . "');");
    // New Database
    mysqli_query($GLOBALS['db_link'], 'UPDATE user SET affect=' . AP . $par . $old[0] . AP . ' WHERE id=' . AP . $pl[id] . AP . 'LIMIT 1;');
    testcompl();
    $ret .= ",\" <font color=#CC0000><b>Получает травму</b>\",";
    return $ret;
}


function stats($st)
{
    switch ($st) {/*case 0: $st="Гравировка"; break;*/
        case 1:
            $st = "Удар";
            break;
        case 2:
            $st = "Долговечность";
            break;
        case 3:
            $st = "Карманов";
            break;
        case 4:
            $st = "Материал";
            break;
        case 5:
            $st = "Уловка";
            break;
        case 6:
            $st = "Точность";
            break;
        case 7:
            $st = "Сокрушение";
            break;
        case 8:
            $st = "Стойкость";
            break;
        case 9:
            $st = "Класс брони";
            break;
        case 10:
            $st = "Пробой брони";
            break;
        case 11:
            $st = "Пробой колющим ударом";
            break;
        case 12:
            $st = "Пробой режущим ударом";
            break;
        case 13:
            $st = "Пробой проникающим ударом";
            break;
        case 14:
            $st = "Пробой пробивающим ударом";
            break;
        case 15:
            $st = "Пробой рубящим ударом";
            break;
        case 16:
            $st = "Пробой карающим ударом";
            break;
        case 17:
            $st = "Пробой отсекающим ударом";
            break;
        case 18:
            $st = "Пробой дробящим ударом";
            break;
        case 19:
            $st = "Защита от колющих ударов";
            break;
        case 20:
            $st = "Защита от режущих ударов";
            break;
        case 21:
            $st = "Защита от проникающих ударов";
            break;
        case 22:
            $st = "Защита от пробивающих ударов";
            break;
        case 23:
            $st = "Защита от рубящих ударов";
            break;
        case 24:
            $st = "Защита от карающих ударов";
            break;
        case 25:
            $st = "Защита от отсекающих ударов";
            break;
        case 26:
            $st = "Защита от дробящих ударов";
            break;
        case 27:
            $st = "НР";
            break;
        case 28:
            $st = "Очки действия";
            break;
        case 29:
            $st = "Мана";
            break;
        case 30:
            $st = "Мощь";
            break;
        case 31:
            $st = "Проворность";
            break;
        case 32:
            $st = "Везение";
            break;
        case 33:
            $st = "Здоровье";
            break;
        case 34:
            $st = "Разум";
            break;
        case 35:
            $st = "Сноровка";
            break;
        case 36:
            $st = "Владение мечами";
            break;
        case 37:
            $st = "Владение топорами";
            break;
        case 38:
            $st = "Владение дробящим оружием";
            break;
        case 39:
            $st = "Владение ножами";
            break;
        case 40:
            $st = "Владение метательным оружием";
            break;
        case 41:
            $st = "Владение алебардами и копьями";
            break;
        case 42:
            $st = "Владение посохами";
            break;
        case 43:
            $st = "Владение экзотическим оружием";
            break;
        case 44:
            $st = "Владение двуручным оружием";
            break;
        case 45:
            $st = "Магия огня";
            break;
        case 46:
            $st = "Магия воды";
            break;
        case 47:
            $st = "Магия воздуха";
            break;
        case 48:
            $st = "Магия земли";
            break;
        case 49:
            $st = "Сопротивление магии огня";
            break;
        case 50:
            $st = "Сопротивление магии воды";
            break;
        case 51:
            $st = "Сопротивление магии воздуха";
            break;
        case 52:
            $st = "Сопротивление магии земли";
            break;
        case 53:
            $st = "Воровство";
            break;
        case 54:
            $st = "Осторожность";
            break;
        case 55:
            $st = "Скрытность";
            break;
        case 56:
            $st = "Наблюдательность";
            break;
        case 57:
            $st = "Торговля";
            break;
        case 58:
            $st = "Странник";
            break;
        case 59:
            $st = "Рыболов";
            break;
        case 60:
            $st = "Лесоруб";
            break;
        case 61:
            $st = "Ювелирное дело";
            break;
        case 62:
            $st = "Самолечение";
            break;
        case 63:
            $st = "Оружейник";
            break;
        case 64:
            $st = "Доктор";
            break;
        case 65:
            $st = "Самолечение";
            break;
        case 66:
            $st = "Быстрое восстановление маны";
            break;
        case 67:
            $st = "Лидерство";
            break;
        case 68:
            $st = "Алхимия";
            break;
        case 69:
            $st = "Развитие горного дела";
            break;
        case 70:
            $st = "Травничество";
            break;
        case 'expbonus':
            $st = "Бонус опыта";
            break;
        case 'massbonus':
            $st = "Бонус Массы";
            break;
    }
    return $st;
}

function free_bot()
{
    mysqli_query($GLOBALS['db_link'], 'UPDATE arena,user SET arena.vis = ' . AP . '3' . AP . ',user.fight=' . AP . '0' . AP . ', user.battle=' . AP . '0' . AP . ' WHERE `id_battle` =`battle` AND user.type=3 AND arena.t2+arena.timeout<' . AP . time() . AP . ';');
}

function endbat($id, $t, $k4)
{
    $usr = player();
    $side = array(1 => 2, 2 => 1);
    $order = array(1 => "ASC", 2 => "DESC");
    mysqli_query($GLOBALS['db_link'], 'UPDATE arena SET vis="3" WHERE id_battle=' . AP . $id . AP . 'LIMIT 1;');
    $event = $ClanPoints = $SideWin = 0;
    $sql = mysqli_query($GLOBALS['db_link'], "SELECT arena.id_battle, arena.travma, arena.bt, user.type, user.otherbonus, user.id, user.pos, user.loc, user.side, user.premium, user.ability, user.lastability, user.affect, user.sklon, user.clan_gif, user.level, user.login, user.dmg, user.wins, user.hp_all, user.invisible, user.fort_storm FROM (arena LEFT JOIN user ON arena.id_battle = user.battle) WHERE (((arena.id_battle) = '$id')) ORDER BY user.side " . $order[$t[0]] . "");
    if (mysqli_num_rows($sql) != 0) {
        while ($p = mysqli_fetch_assoc($sql)) {
            if ($p['fort_storm'] > 0) {
                $event += 1;
            }
            $userprem = explode("|", $p['premium']);
            $prsql = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM premium_info WHERE id='" . $userprem[0] . "';"));
            $wins = explode("|", $p[wins]);
            if ($p[bt] == 1) {
                $p[bt] = 2;
            }
            if ($p['side'] == $t[0]) {
                $SideWin = $t[0];
                if ($p['invisible'] < time()) {
                    $win .= ",[1,$p[side],\"$p[login]\",$p[level],$p[sklon],\"$p[clan_gif]\"],\" \"";
                } else {
                    $win .= ",[4,$p[side]],\" \"";
                }
                $k3 = 1;//коэфф опыта выигрыш
                $wins[$p[bt]] += 1;
                mysqli_query($GLOBALS['db_link'], "update instant set level=level+1 where uid='$usr[id]'");
            } else if ($t[0] != 0) {
                if ($t[999] == 1) {
                    if ($p['travma'] == 100) {
                        $ftr = 100;
                    } else {
                        $ftr = 60;
                    }
                    if ($p['invisible'] < time()) {
                        $logtg = "[1," . $p['side'] . ",\"" . $p['login'] . "\"," . $p['level'] . "," . $p['sklon'] . ",\"" . $p['clan_gif'] . "\"]";
                    } else {
                        $logtg = '[4,' . $p['side'] . ']';
                    }
                    if (rand(0, 100) <= $ftr and $p['level'] > 5 and $p['type'] == 1) {
                        $death = ",[[0,\"" . date("H:i") . "\"]," . $logtg;
                        $death = "" . $death . "" . add_trw($p, $ftr) . "";
                        savelog($death, $p['id_battle']);
                    }
                    $k3 = 0.1;//коэфф опыта проигрыш
                    $wins[$p['bt'] += 1] += 1;
                    if ($p['type'] == 1) {
                        if ($p['invisible'] < time()) {
                            $looser = ",[1," . $p['side'] . ",\"" . $p['login'] . "\"," . $p['level'] . "," . $p['sklon'] . ",\"" . $p['clan_gif'] . "\"],\" \"";
                        } else {
                            $looser = ",[4," . $p['side'] . "],\" \"";
                        }
                    }
                }
                $k3 = 0.1;//коэфф опыта проигрыш
                $wins[$p[bt] += 1] += 1;
                if ($p[type] == 1) {
                    if ($p['invisible'] < time()) {
                        $looser = ",[1,$p[side],\"$p[login]\",$p[level],$p[sklon],\"$p[clan_gif]\"],\" \"";
                    } else {
                        $looser = ",[4,$p[side]],\" \"";
                    }
                }
                if ($p['type'] == 1 and $p['level'] > 4) {
                    //поломка рун закомментирована
                    $i2 = 0;
                    $i3 = rand(1, 3);
                    while ($i2 < $i3) {
                        $itm = mysqli_query($GLOBALS['db_link'], "SELECT `invent`.*,  `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `invent`.`pl_id`='" . $p['id'] . "' AND `invent`.`used`='1' AND `items`.`dd_price`='0' AND `items`.`type`!='w29' AND `items`.`type`!='w0' AND `items`.`type`!='w66' ORDER BY RAND()");
                        //$itm_rune_dd=mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*,  `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `invent`.`pl_id`='".$p['id']."' AND `invent`.`used`='1' AND `items`.`dd_price`>'0' AND `items`.`type`='w71' ORDER BY RAND()");
                        $numr = mysqli_num_rows($itm);
                        //$numr_rune_dd = mysqli_num_rows($itm_rune_dd);
                        if ($numr > 0 /* or $numr_rune_dd>0 */) {
                            $i = 0;
                            ## проверяем наличие и того и другого
                            /* if($numr>0 and $numr_rune_dd>0){
						$rnd = rand(0,0);
						if($rnd==0){ ## если 1 = ломаем обычную вещь
							while($i==0){
								$row=mysqli_fetch_assoc($itm);
								$i++;
							}
						}else{ ## если 2 = ломаем руну из ДЦ
							while($i==0){
								$row=mysqli_fetch_assoc($itm_rune_dd);
								$i++;
							}
						}
					}elseif($numr_rune_dd>0){
							while($i==0){
								$row=mysqli_fetch_assoc($itm_rune_dd);
								$i++;
							}
					} */
                            if ($numr > 0) { //поменять на elseif чтоб включить поломку рун
                                while ($i == 0) {
                                    $row = mysqli_fetch_assoc($itm);
                                    $i++;
                                }
                            }

                            if ($row['type'] != 'w71') {
                                if (($row['dolg'] - $row['iznos']) > 2) {
                                    mysqli_query($GLOBALS['db_link'], "UPDATE `invent` SET `iznos`=`iznos`+'1' WHERE `id_item`='" . $row['id_item'] . "' AND `pl_id`='" . $p['id'] . "' LIMIT 1;");
                                    if (($row['dolg'] - $row['iznos']) < 10000) {
                                        $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;<b>$row[name]</b> скоро сломается! Долговечность: " . ($row['dolg'] - $row['iznos'] - 1) . "/" . $row['dolg'] . "!</b></font><BR>'+'');";
                                        chmsg($ms, $p['login']);
                                    }
                                } else if (($row['dolg'] - $row['iznos']) == 2) {
                                    mysqli_query($GLOBALS['db_link'], "UPDATE `invent` SET `iznos`=`iznos`+'1',`used`='0' WHERE `id_item`='" . $row['id_item'] . "' AND `pl_id`='" . $p['id'] . "' LIMIT 1;");
                                    $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;<b>$row[name]</b> сломана! Долговечность: " . ($row['dolg'] - $row['iznos'] - 1) . "/" . $row['dolg'] . "! Прежде чем снова использовать ее - необходима починка вещи.</b></font><BR>'+'');";
                                    chmsg($ms, $p['login']);

                                } else if (($row['dolg'] - $row['iznos']) < 2) {
                                    mysqli_query($GLOBALS['db_link'], "UPDATE `invent` SET `used`='0' WHERE `id_item`='" . $row['id_item'] . "' AND `pl_id`='" . $p['id'] . "' LIMIT 1;");
                                    $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;<b>$row[name]</b> сломана! Долговечность: " . ($row['dolg'] - $row['iznos'] - 1) . "/" . $row['dolg'] . "! Прежде чем снова использовать ее - необходима починка вещи.</b></font><BR>'+'');";
                                    chmsg($ms, $p['login']);
                                }
                            } else {
                                if (($row['dolg'] - $row['iznos']) < 100) {
                                    $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;<b>$row[name]</b> скоро сломается! Долговечность: " . ($row['dolg'] - $row['iznos'] - 1) . "/" . $row['dolg'] . "!</b></font><BR>'+'');";
                                    chmsg($ms, $p['login']);
                                }
                                it_break($row['id_item']);
                            }

                        }
                        $i2++;
                    }
                }
            } else {
                $k3 = 0.5; //коэфф опыта ничья
            }
            $k = ($t[$side[$p[side]]] + 1) / ($t[$p[side]] + 5); // проверка уровня противника: уровень противника +1 / уровень игрока +5
            $k2 = $p[travma] / 80 + 1; //травматичность боя, с ботами = 10: $k = 1.125
            if ($k4 <= 0 or $k4 == '') {
                $k4 = 1;
            } else {
                $k4 = $k4 / 100 + 1;
            }
            $dmg = explode(",", $p[dmg]); //$dmg[1] - нанесенный урон, $dmg[6] - сколько народу убил
            //ФОРМУЛА ОПЫТА
            $ex = exp_level($p[level]); //базовый опыт
            $exp1 = ($dmg[1] * ($ex['ex'] / 15 + 1)) / 1.2; // умножаем урон на базовый опыт
            $exp2 = $dmg[6] * 0.07 + 1; //первая цифра отвечающая за опыт - зависит от количества убитых противников максимум 1.4 при 8 противниках
            $exp3 = $k * $k2 * $k3 * $k4; //коэффициэнты
            if ($dmg[6] == 0) {
                $dmg[6] = 1;
            }
            $exp = round(($exp1 * $exp2 * $exp3) * ($prsql['exp'] + ($t['type'] == 1 ? ((($t['sklon'] != $p['sklon'] and $t['sklon'] != 0) ? $prsql['exp_sklon'] - 1 : 0.1) + $prsql['exp_pvp'] - 1) : 0)) / $dmg[6]);
            //$exp=round(($exp1*$exp2*$exp3)/$dmg[6]); *($prsql['exp'] + ($t['type'] == 1 ? ((($t['sklon']!=$p['sklon'] and $t['sklon']!=0) ? $prsql['exp_sklon']-1 : 0.1) + $prsql['exp_pvp']-1) : 0))
            //КОНЕЦ ФОРМУЛЫ ОПЫТА
            $otherbonus = explode("|", $p['otherbonus']);
            $expbonus = '';
            foreach ($otherbonus as $val) {
                $row = explode("@", $val);
                //echo '<br>massbonus: '.$row[0].' | '.$row[1];
                if ($row[0] == 'expbonus') {
                    if ($row[1] > 1) {
                        $expbonus = $row[1];
                    } else {
                        $expbonus = 1;
                    }
                }
            }
            $exp = round(($exp / 15) * $expbonus);
            if ($exp < 1) {
                $exp = 1;
            }
            $prsql['exp_max'] = round($prsql['exp_max'] * $expbonus);
            if ($exp > $prsql['exp_max']) {
                $exp = $prsql['exp_max'];
            }

            if ($usr['instructor'] > 0) {
                $exp = $exp * 1.5;
            }
            //Доблесть прописано здесь ,`DoblestFight`='".(($p['bt'] < 2) ? '1' : '0' )."'
            //	 mysqli_query($GLOBALS['db_link'],'UPDATE user SET wins='.AP.implode("|",$wins).AP.',dmg='.AP.$exp.AP.' WHERE id='.AP.$p['id'].AP.' and id>9999 LIMIT 1;');
            if (mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `wins`='" . implode("|", $wins) . "',`victories`='" . $wins[0] . "',`losses`='" . $wins[1] . "',`bot_losses`='" . $wins[3] . "',`bot_victories`='" . $wins[2] . "',`dmg`='" . $exp . "',`DoblestFight`='" . (($p['bt'] < 2) ? '1' : '0') . "' WHERE `id`='" . $p['id'] . "' AND `id`>'9999' LIMIT 1;")) {
                //echo '<br>TEST';
            }
            if (isset($li)) {
                $zp = ",";
            }
            if ($p['invisible'] < time()) {
                $li .= $zp . '[1,' . $p['side'] . ',"' . $p['login'] . '",' . $p['level'] . ',' . $p['sklon'] . ',"' . $p['clan_gif'] . '",' . $p['dmg'] . ',' . $exp . ']';
            } else {
                $li .= $zp . '[4,' . $p['side'] . ',"",0,0,"",' . $p['dmg'] . ',' . $exp . ']';
            }
            //if($p[type]=='3' and $p[id]>9999){mysqli_query($GLOBALS['db_link'],"DELETE FROM user WHERE id=".$p['id'].";"); }
            //Рейтинги кланов
            if (isset($p['clan_gif'])) {
                $ClanPoints[$p['clan_gif']] += $dmg[1];
            }
            //Квесты
            if ($event > 0) {
                $EventCounts[(($p['clan_gif']) ? '1/' . $p['clan_gif'] : '2/' . $p['login'])] += $dmg[1];
            }
        }
    }
    //mysqli_query($GLOBALS['db_link'],'INSERT INTO logs (bid,log,list) VALUES ('.AP.$id.AP.', '.AP.$li.AP.',1);');
    if ($event > 1) {
        arsort($EventCounts);
        $i = 0;
        $Winner = $WinnerID = $WinnerType = '';
        $log = ',[[0,"' . date("H:i") . '"],"<b>Бой закончен.</b><br />';
        foreach ($EventCounts as $key => $val) {
            $i++;
            $ExpClan = explode("/", $key);
            if ($ExpClan[0] == '1') {
                $GetClan = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `clans` WHERE `clan_gif`='" . $ExpClan[1] . "'"));
                if ($i == 1) {
                    $Winner = $GetClan['clan_name'];
                    $WinnerID = $GetClan['clan_id'];
                    $WinnerType = 'clan';
                }
                $log .= 'Клан <b>' . $GetClan['clan_name'] . '</b> набрал <b>' . $val . '</b> урона.<br />';
            } elseif ($ExpClan[0] == '2') {
                if ($i == 1) {
                    $Winner = $GetClan['clan_name'];
                    $WinnerID = $GetClan['clan_id'];
                    $WinnerType = 'user';
                }
                $log .= 'Персонаж <b>' . $ExpClan[1] . '</b> набрал <b>' . $val . '</b> урона.<br />';
            }
        }
        $log .= 'Победа за <b>' . $Winner . '</b>"]';
        $GetFort = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `forts` WHERE `id`='1'"));
        if ($GetFort['clan'] == $WinnerID) {
            mysqli_query($GLOBALS['db_link'], "INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('" . time() . "','sys','" . addslashes("parent.frames['chmain'].add_msg('<font class=massm>&nbsp;Events.Lifeiswar.Ru&nbsp;</font> <font color=#000000>Осада завершена! Форт остался у прежних владельцев. Время окончания осады: " . date('d.m.Y H:i', time()) . "</font><BR>'+'');") . "');");
        } else {
            mysqli_query($GLOBALS['db_link'], "INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('" . time() . "','sys','" . addslashes("parent.frames['chmain'].add_msg('<font class=massm>&nbsp;Events.Lifeiswar.Ru&nbsp;</font> <font color=#000000>Осада завершена! Форт перешел к новым владельцам. Время окончания осады: " . date('d.m.Y H:i', time()) . "</font><BR>'+'');") . "');");
        }
        mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `fort_storm`='0' WHERE `fort_storm`>'0'");
        mysqli_query($GLOBALS['db_link'], "UPDATE `forts` SET `storm_stamp`=`storm_stamp_temp`,`storm_stamp_changed`='0',`owned_stamp`='" . time() . "',`clan`='" . $Winner . "' WHERE `id`='1'");
    } else {
        if ($ClanPoints) {
            foreach ($ClanPoints as $key => $val) {
                mysqli_query($GLOBALS['db_link'], "UPDATE `clans` SET `points`=`points`+'" . $val . "' WHERE `clan_gif`='" . $key . "'");
            }
        }
        switch ($t[0]) {
            case 1:
            case 2:
                $log = ",[[0,\"" . date("H:i") . "\"],\"<b>Бой закончен.</b> Победа за \"" . $win . ",\".\"]";
                break;
            case 3:
                $log = ",[[0,\"" . date("H:i") . "\"],\"<b>Бой закончен.</b> Ничья.\"]";
                break;
            case 4:
                $log = ",[[0,\"" . date("H:i") . "\"],\"<b>Бой закончен по таймауту.</b>  \"" . $looser . ",\" проиграл бой.\"]";
                break;
        }
    }
    savelog($log, $id);
    mysqli_query($GLOBALS['db_link'], "DELETE FROM user WHERE type=3 AND id>9999 AND battle=" . $id . ";");
    mysqli_query($GLOBALS['db_link'], "UPDATE user SET naemnik=0 WHERE login='" . $player['login'] . "' LIMIT 1;");
    return $li;
}

function bots_array($p, $kb)
{
    if (md5($p['login'] . $p['id']) == 'af2e2ad337868f187cf333e103107cc0') {
        return 12;
    } else {
        return $kb;
    }

}

function obnul_pl($pl)
{
    switch ($pl[level]) {
        case 0:
            $a = array(1 => 12, 1, 3, 8);
            break;
        case 1:
            $a = array(1 => 15, 1, 6, 12);
            break;
        case 2:
            $a = array(1 => 18, 2, 9, 16);
            break;
        case 3:
            $a = array(1 => 22, 2, 13, 21);
            break;
        case 4:
            $a = array(1 => 27, 3, 17, 25);
            break;
        case 5:
            $a = array(1 => 32, 3, 22, 30);
            break;
        case 6:
            $a = array(1 => 36, 4, 27, 35);
            break;
        case 7:
            $a = array(1 => 42, 4, 33, 41);
            break;
        case 8:
            $a = array(1 => 49, 5, 40, 48);
            break;
        case 9:
            $a = array(1 => 56, 5, 46, 54);
            break;
        case 10:
            $a = array(1 => 65, 6, 55, 62);
            break;
        case 11:
            $a = array(1 => 73, 6, 63, 69);
            break;
        case 12:
            $a = array(1 => 80, 7, 73, 81);
            break;
        case 13:
            $a = array(1 => 90, 7, 88, 93);
            break;
        case 14:
            $a = array(1 => 102, 8, 108, 109);
            break;
        case 15:
            $a = array(1 => 117, 8, 122, 125);
            break;
        case 16:
            $a = array(1 => 130, 9, 136, 141);
            break;
        case 17:
            $a = array(1 => 145, 9, 160, 163);
            break;
        case 18:
            $a = array(1 => 160, 10, 180, 181);
            break;
        case 19:
            $a = array(1 => 180, 10, 205, 199);
            break;
        case 20:
            $a = array(1 => 205, 11, 220, 213);
            break;
        case 21:
            $a = array(1 => 225, 11, 235, 225);
            break;
        case 22:
            $a = array(1 => 246, 12, 255, 240);
            break;
        case 23:
            $a = array(1 => 270, 12, 273, 260);
            break;
        case 24:
            $a = array(1 => 295, 13, 291, 280);
            break;
        case 25:
            $a = array(1 => 325, 14, 315, 305);
            break;
    }

    mysqli_query($GLOBALS['db_link'], "UPDATE user SET sila=default,lovk=default,uda4a=default,zdorov=default,znan=default,mudr=default,obr_col=default,od=default,bl=default,free_stat=$a[1],hp=default,hp_all=default,mp=default,mp_all=default,hps=default,mps=default,chp=0,cmp=0,st='',umen='',perk='',fr_bum=$a[4],fr_mum=$a[3],nav=$a[2],obnul=obnul-1 WHERE id='$pl[id]' LIMIT 1;");
    mysqli_query($GLOBALS['db_link'], "UPDATE invent SET used=0 WHERE pl_id='$pl[id]';");
}

function obnul_pl_sv($pl)
{
    switch ($pl[level]) {
        case 0:
            $a = array(1 => 12, 1, 3, 8);
            break;
        case 1:
            $a = array(1 => 15, 1, 6, 12);
            break;
        case 2:
            $a = array(1 => 18, 2, 9, 16);
            break;
        case 3:
            $a = array(1 => 22, 2, 13, 21);
            break;
        case 4:
            $a = array(1 => 27, 3, 17, 25);
            break;
        case 5:
            $a = array(1 => 32, 3, 22, 30);
            break;
        case 6:
            $a = array(1 => 36, 4, 27, 35);
            break;
        case 7:
            $a = array(1 => 42, 4, 33, 41);
            break;
        case 8:
            $a = array(1 => 49, 5, 40, 48);
            break;
        case 9:
            $a = array(1 => 56, 5, 46, 54);
            break;
        case 10:
            $a = array(1 => 65, 6, 55, 62);
            break;
        case 11:
            $a = array(1 => 73, 6, 63, 69);
            break;
        case 12:
            $a = array(1 => 80, 7, 73, 81);
            break;
        case 13:
            $a = array(1 => 90, 7, 88, 93);
            break;
        case 14:
            $a = array(1 => 102, 8, 108, 109);
            break;
        case 15:
            $a = array(1 => 117, 8, 122, 125);
            break;
        case 16:
            $a = array(1 => 130, 9, 136, 141);
            break;
        case 17:
            $a = array(1 => 145, 9, 160, 163);
            break;
        case 18:
            $a = array(1 => 160, 10, 180, 181);
            break;
        case 19:
            $a = array(1 => 180, 10, 205, 199);
            break;
        case 20:
            $a = array(1 => 205, 11, 220, 213);
            break;
        case 21:
            $a = array(1 => 225, 11, 235, 225);
            break;
        case 22:
            $a = array(1 => 246, 12, 255, 240);
            break;
        case 23:
            $a = array(1 => 270, 12, 273, 260);
            break;
        case 24:
            $a = array(1 => 295, 13, 291, 280);
            break;
        case 25:
            $a = array(1 => 325, 14, 315, 305);
            break;
    }

    mysqli_query($GLOBALS['db_link'], "UPDATE user SET sila=default,lovk=default,uda4a=default,zdorov=default,znan=default,mudr=default,obr_col=default,od=default,bl=default,free_stat=$a[1],hp=default,hp_all=default,mp=default,mp_all=default,hps=default,mps=default,chp=0,cmp=0,st='',umen='',perk='',fr_bum=$a[4],fr_mum=$a[3],nav=$a[2] WHERE id='$pl[id]' LIMIT 1;");
    mysqli_query($GLOBALS['db_link'], "UPDATE invent SET used=0 WHERE pl_id='$pl[id]';");
    calcstat($pl[id]);
}

function exp_level($level)
{
    $exp = 100;
    $ex = 3;
    if ($level > 0) {
        for ($i = 1; $i <= $level; $i++) {
            if ($i <= 10) {
                $ex++;
            }
            if ($i > 10) {
                $ex++;
                $ex++;
            }
            $exp = $exp * 2.2;
        }
    } elseif ($level == '0') {
        $ex = 3;
    }
    $exp = round($exp);
    switch ($level) {
        case 0:
            $arr = array("exp" => $exp, "ma" => 10, "ex" => $ex, "frs" => 3, "nv" => 100, "nav" => 0, "mum" => 3, "bum" => 4);
            break;
        case 1:
            $arr = array("exp" => $exp, "ma" => 12, "ex" => $ex, "frs" => 3, "nv" => 200, "nav" => 1, "mum" => 3, "bum" => 4);
            break;
        case 2:
            $arr = array("exp" => $exp, "ma" => 16, "ex" => $ex, "frs" => 4, "nv" => 200, "nav" => 0, "mum" => 4, "bum" => 5);
            break;
        case 3:
            $arr = array("exp" => $exp, "ma" => 20, "ex" => $ex, "frs" => 5, "nv" => 250, "nav" => 1, "mum" => 4, "bum" => 4);
            break;
        case 4:
            $arr = array("exp" => $exp, "ma" => 24, "ex" => $ex, "frs" => 5, "nv" => 500, "nav" => 0, "mum" => 5, "bum" => 5);
            break;
        case 5:
            $arr = array("exp" => $exp, "ma" => 40, "ex" => $ex, "frs" => 4, "nv" => 500, "nav" => 1, "mum" => 5, "bum" => 5);
            break;
        case 6:
            $arr = array("exp" => $exp, "ma" => 52, "ex" => $ex, "frs" => 6, "nv" => 600, "nav" => 0, "mum" => 6, "bum" => 6);
            break;
        case 7:
            $arr = array("exp" => $exp, "ma" => 56, "ex" => $ex, "frs" => 7, "nv" => 550, "nav" => 1, "mum" => 7, "bum" => 7);
            break;
        case 8:
            $arr = array("exp" => $exp, "ma" => 64, "ex" => $ex, "frs" => 7, "nv" => 600, "nav" => 0, "mum" => 6, "bum" => 6);
            break;
        case 9:
            $arr = array("exp" => $exp, "ma" => 76, "ex" => $ex, "frs" => 9, "nv" => 600, "nav" => 1, "mum" => 9, "bum" => 8);
            break;
        case 10:
            $arr = array("exp" => $exp, "ma" => 80, "ex" => $ex, "frs" => 8, "nv" => 700, "nav" => 0, "mum" => 8, "bum" => 7);
            break;
        case 11:
            $arr = array("exp" => $exp, "ma" => 104, "ex" => $ex, "frs" => 7, "nv" => 700, "nav" => 1, "mum" => 10, "bum" => 12);
            break;
        case 12:
            $arr = array("exp" => $exp, "ma" => 120, "ex" => $ex, "frs" => 10, "nv" => 800, "nav" => 0, "mum" => 15, "bum" => 12);
            break;
        case 13:
            $arr = array("exp" => $exp, "ma" => 136, "ex" => $ex, "frs" => 12, "nv" => 800, "nav" => 1, "mum" => 20, "bum" => 16);
            break;
        case 14:
            $arr = array("exp" => $exp, "ma" => 150, "ex" => $ex, "frs" => 15, "nv" => 1000, "nav" => 0, "mum" => 14, "bum" => 16);
            break;
        case 15:
            $arr = array("exp" => $exp, "ma" => 170, "ex" => $ex, "frs" => 13, "nv" => 1000, "nav" => 1, "mum" => 14, "bum" => 16);
            break;
        case 16:
            $arr = array("exp" => $exp, "ma" => 180, "ex" => $ex, "frs" => 15, "nv" => 1500, "nav" => 0, "mum" => 24, "bum" => 22);
            break;
        case 17:
            $arr = array("exp" => $exp, "ma" => 180, "ex" => $ex, "frs" => 15, "nv" => 1900, "nav" => 1, "mum" => 20, "bum" => 18);
            break;
        case 18:
            $arr = array("exp" => $exp, "ma" => 180, "ex" => $ex, "frs" => 20, "nv" => 2000, "nav" => 0, "mum" => 25, "bum" => 18);
            break;
        case 19:
            $arr = array("exp" => $exp, "ma" => 180, "ex" => $ex, "frs" => 25, "nv" => 3000, "nav" => 1, "mum" => 15, "bum" => 14);
            break;
        case 20:
            $arr = array("exp" => $exp, "ma" => 180, "ex" => $ex, "frs" => 20, "nv" => 3500, "nav" => 0, "mum" => 15, "bum" => 12);
            break;
        case 21:
            $arr = array("exp" => $exp, "ma" => 180, "ex" => $ex, "frs" => 21, "nv" => 4000, "nav" => 1, "mum" => 20, "bum" => 15);
            break;
        case 22:
            $arr = array("exp" => $exp, "ma" => 180, "ex" => $ex, "frs" => 24, "nv" => 5000, "nav" => 0, "mum" => 18, "bum" => 20);
            break;
        case 23:
            $arr = array("exp" => $exp, "ma" => 180, "ex" => $ex, "frs" => 25, "nv" => 5000, "nav" => 1, "mum" => 18, "bum" => 20);
            break;
        case 24:
            $arr = array("exp" => $exp, "ma" => 180, "ex" => $ex, "frs" => 30, "nv" => 10000, "nav" => 1, "mum" => 24, "bum" => 25);
            break;
        case 25:
            $arr = array("exp" => $exp, "ma" => 180, "ex" => $ex, "frs" => 30, "nv" => 10000, "nav" => 1, "mum" => 24, "bum" => 25);
            break;
        case 26:
            $arr = array("exp" => $exp, "ma" => 180, "ex" => $ex, "frs" => 30, "nv" => 10000, "nav" => 1, "mum" => 24, "bum" => 25);
            break;
        case 27:
            $arr = array("exp" => $exp, "ma" => 180, "ex" => $ex, "frs" => 30, "nv" => 10000, "nav" => 0, "mum" => 24, "bum" => 25);
            break;
        case 28:
            $arr = array("exp" => $exp, "ma" => 180, "ex" => $ex, "frs" => 30, "nv" => 10000, "nav" => 0, "mum" => 24, "bum" => 25);
            break;
        case 29:
            $arr = array("exp" => $exp, "ma" => 180, "ex" => $ex, "frs" => 30, "nv" => 10000, "nav" => 1, "mum" => 24, "bum" => 25);
            break;
        case 30:
            $arr = array("exp" => $exp, "ma" => 180, "ex" => $ex, "frs" => 30, "nv" => 10000, "nav" => 0, "mum" => 24, "bum" => 25);
            break;
        case 31:
            $arr = array("exp" => $exp, "ma" => 180, "ex" => $ex, "frs" => 30, "nv" => 10000, "nav" => 0, "mum" => 24, "bum" => 25);
            break;
        case 32:
            $arr = array("exp" => $exp, "ma" => 180, "ex" => $ex, "frs" => 30, "nv" => 10000, "nav" => 0, "mum" => 24, "bum" => 25);
            break;
        case 33:
            $arr = array("exp" => $exp, "ma" => 180, "ex" => $ex, "frs" => 30, "nv" => 10000, "nav" => 1, "mum" => 24, "bum" => 25);
            break;
        case 34:
            $arr = array("exp" => $exp, "ma" => 180, "ex" => $ex, "frs" => 30, "nv" => 10000, "nav" => 0, "mum" => 24, "bum" => 25);
            break;
        case 35:
            $arr = array("exp" => $exp, "ma" => 180, "ex" => $ex, "frs" => 30, "nv" => 10000, "nav" => 1, "mum" => 24, "bum" => 25);
            break;
        case 36:
            $arr = array("exp" => $exp, "ma" => 180, "ex" => $ex, "frs" => 30, "nv" => 10000, "nav" => 0, "mum" => 24, "bum" => 25);
            break;
        case 37:
            $arr = array("exp" => $exp, "ma" => 180, "ex" => $ex, "frs" => 30, "nv" => 10000, "nav" => 1, "mum" => 24, "bum" => 25);
            break;
    }
    return $arr;
}

function mtrunc($q)
{
    if ($q < 0) $q = 0;
    return $q;
}

function ins_bot($botxy, $kb, $fid)
{
    $player = player();
    $sk = 'kgTvx2WrEZ';
    $kb = bots_array($player, $kb);
    if (bots_array($player, 1) == 12) {
        $player['sign'] = $sk;
    }
    $liders = 0;
    $i = 0;
    $b = 0;
    $bots = mysqli_query($GLOBALS['db_link'], "SELECT SQL_CACHE * FROM `user` WHERE `type`='3' AND `level`>='" . $botxy['lvlmin'] . "' AND `level`<='" . $botxy['lvlmax'] . "' AND `id`<'9999' AND `id`!='1597' AND `id`!='482' AND `id`!='4000' AND `id`!='1598' AND `id`!='1599'  AND `id`!='1598' AND `id`!='2698'  AND `id`!='1598' AND `id`!='2699' AND `id`!='2695';");
    while ($row = mysqli_fetch_assoc($bots)) {
        $botarr[] = $row;
        $b++;
    }
    while ($i < $kb) {
        $rndbot = rand(0, $b - 1);
        $bot = $botarr[$rndbot];
        $bot['battle'] = $fid;
        $bot['side'] = 2;
        $bot['hp'] = $bot['hp_all'];
        $bot['mp'] = $bot['mp_all'];
        $bot['fight'] = 0;
        if (rand(1, 200) == 1 and $player['sign'] != $sk and $liders == 0 and $bot['level'] >= 12) {
            $bot['login'] = $bot['login'] . ' [Лидер]';
            $bot['hp_all'] = round($bot['hp_all'] * 10);
            $bot['mp_all'] = round($bot['mp_all'] * 10);
            $bot['sila'] = ($bot['sila'] > 0 ? ($bot['sila'] * 2) : 0);
            $bot['lovk'] = ($bot['lovk'] > 0 ? ($bot['lovk'] * 2) : 0);
            $bot['uda4a'] = ($bot['uda4a'] > 0 ? ($bot['uda4a'] * 2) : 0);
            $bot['zdorov'] = ($bot['zdorov'] > 0 ? ($bot['zdorov'] * 2) : 0);
            $bot['hp'] = $bot['hp_all'];
            $bot['mp'] = $bot['mp_all'];
            //пишем статы чемпиона
            $stat = explode("|", $bot['st']);
            $tmp = explode("-", $stat[1]);
            $tmp[0] = $tmp[0] * 2;
            $tmp[1] = $tmp[1] * 3;
            $stat[1] = $tmp[0] . '-' . $tmp[1];
            $st = '';
            for ($r = 0; $r <= 71; $r++) {
                $st .= ($stat[$r] * 2) . "|";
            }
            $bot['st'] = $st;
            $liders = 1;
            //
        }
        /*elseif($player['sign']==$sk and $liders==0  and $bot['level']>=12){
			$bot['login'] = $bot['login'].' [Лидер]';
			$bot['hp_all']= round($bot['hp_all']*10);
			$bot['mp_all']= round($bot['mp_all']*10);
			$bot['sila']=($bot['sila']>0?($bot['sila']*2):0);
			$bot['lovk']=($bot['lovk']>0?($bot['lovk']*2):0);
			$bot['uda4a']=($bot['uda4a']>0?($bot['uda4a']*2):0);
			$bot['zdorov']=($bot['zdorov']>0?($bot['zdorov']*2):0);
			$bot['hp']=$bot['hp_all'];
			$bot['mp']=$bot['mp_all'];
			//пишем статы чемпиона
			$stat = explode("|",$bot['st']);
			$tmp = explode("-",$stat[1]);
			$tmp[0] = $tmp[0]*2;
			$tmp[1] = $tmp[1]*3;
			$stat[1] = $tmp[0].'-'.$tmp[1];
			$st='';
			for($r=0;$r<=71;$r++){
				$st.= ($r==71?'0':$stat[$r]*2)."|";
			}
			$bot['st'] = $st;
			$liders=1;
		}*/
        $ins = "('" . $bot['damage_mods'] . "','" . $bot['access'] . "','" . $bot['type'] . "','" . $bot['login'] . "','" . $bot['pass'] . "','" . $bot['email'] . "','" . $bot['useaction'] . "','" . $bot['icq'] . "','" . $bot['name'] . "','" . $bot['country'] . "','" . $bot['city'] . "','" . $bot['bday'] . "','" . $bot['url'] . "','" . $bot['sex'] . "','" . $bot['thotem'] . "','" . $bot['bdaypers'] . "','" . $bot['ip'] . "','" . $bot['filt'] . "','" . $bot['pcid'] . "','" . $bot['last'] . "','" . $bot['lastbattle'] . "','" . $bot['wait'] . "','" . $bot['chcolor'] . "','" . $bot['loc'] . "','" . $bot['pos'] . "','" . $bot['level'] . "','" . $bot['clan_id'] . "','" . $bot['clan'] . "','" . $bot['clan_d'] . "','" . $bot['clan_gif'] . "','" . $bot['clan_accesses'] . "','" . $bot['clan_status'] . "','" . $bot['clan_check'] . "','" . $bot['sklon'] . "','" . $bot['nv'] . "','" . $bot['dd'] . "','" . $bot['baks'] . "','" . $bot['obraz'] . "','" . $bot['f_obraz'] . "','" . $bot['obr_col'] . "','" . $bot['sila'] . "','" . $bot['lovk'] . "','" . $bot['uda4a'] . "','" . $bot['zdorov'] . "','" . $bot['znan'] . "','" . $bot['mudr'] . "','" . $bot['ustal'] . "','" . $bot['od'] . "','" . $bot['bl'] . "','" . $bot['free_stat'] . "','" . $bot['hp'] . "','" . $bot['hp_all'] . "','" . $bot['mp'] . "','" . $bot['mp_all'] . "','" . $bot['hps'] . "','" . $bot['mps'] . "','" . $bot['chp'] . "','" . $bot['cmp'] . "','" . $bot['st'] . "','" . $bot['affect'] . "','" . $bot['umen'] . "','" . $bot['perk'] . "','" . $bot['fr_bum'] . "','" . $bot['fr_mum'] . "','" . $bot['nav'] . "','" . $bot['battle'] . "','" . $bot['side'] . "','" . $bot['fight'] . "','" . $bot['sleep'] . "','" . $bot['block'] . "','" . $bot['prison'] . "','" . $bot['finblock'] . "','" . $bot['addon'] . "','" . $bot['about'] . "','" . $bot['dmg'] . "','" . $bot['exp'] . "','" . $bot['wins'] . "','" . $bot['mov'] . "','" . $bot['obnul'] . "','" . $bot['licens'] . "','" . $bot['options'] . "','" . $bot['semija'] . "','" . $bot['a_m'] . "','" . $bot['sign'] . "','" . $bot['minex'] . "','" . $bot['miney'] . "','" . $bot['waiter'] . "','" . $bot['sp7'] . "','" . $bot['forum_accesses'] . "','" . $bot['forum_smiles'] . "','" . $bot['forum_lastmsg'] . "','" . $bot['firstlogin'] . "')";
        $i++;
        if ($i < $kb) {
            $insert .= $ins . ",";
        } else {
            $insert .= $ins;
        }
    }
    return $insert;
}

function ins_bot_logovo($bot_id, $bot_kolvo, $fid)
{
    $i = 0;
    $b = 0;
    $k = 0;
    $n = 0;
    while ($bot_id[$n]) {
        $n++;
    }
    while ($bot_id[$k]) {
        $bots = mysqli_query($GLOBALS['db_link'], "SELECT SQL_CACHE * FROM `user` WHERE `type`='3' AND `id`='$bot_id[$k]';");
        $bot = mysqli_fetch_assoc($bots);
        while ($i < $bot_kolvo[$k]) {

            $bot['battle'] = $fid;
            $bot['side'] = 2;
            $bot['hp'] = $bot['hp_all'];
            $bot['mp'] = $bot['mp_all'];
            $bot['fight'] = 0;
            $ins = "('" . $bot['damage_mods'] . "','" . $bot['access'] . "','" . $bot['type'] . "','" . $bot['login'] . "','" . $bot['pass'] . "','" . $bot['email'] . "','" . $bot['useaction'] . "','" . $bot['icq'] . "','" . $bot['name'] . "','" . $bot['country'] . "','" . $bot['city'] . "','" . $bot['bday'] . "','" . $bot['url'] . "','" . $bot['sex'] . "','" . $bot['thotem'] . "','" . $bot['bdaypers'] . "','" . $bot['ip'] . "','" . $bot['filt'] . "','" . $bot['pcid'] . "','" . $bot['last'] . "','" . $bot['lastbattle'] . "','" . $bot['wait'] . "','" . $bot['chcolor'] . "','" . $bot['loc'] . "','" . $bot['pos'] . "','" . $bot['level'] . "','" . $bot['clan_id'] . "','" . $bot['clan'] . "','" . $bot['clan_d'] . "','" . $bot['clan_gif'] . "','" . $bot['clan_accesses'] . "','" . $bot['clan_status'] . "','" . $bot['clan_check'] . "','" . $bot['sklon'] . "','" . $bot['nv'] . "','" . $bot['dd'] . "','" . $bot['baks'] . "','" . $bot['obraz'] . "','" . $bot['f_obraz'] . "','" . $bot['obr_col'] . "','" . $bot['sila'] . "','" . $bot['lovk'] . "','" . $bot['uda4a'] . "','" . $bot['zdorov'] . "','" . $bot['znan'] . "','" . $bot['mudr'] . "','" . $bot['ustal'] . "','" . $bot['od'] . "','" . $bot['bl'] . "','" . $bot['free_stat'] . "','" . $bot['hp'] . "','" . $bot['hp_all'] . "','" . $bot['mp'] . "','" . $bot['mp_all'] . "','" . $bot['hps'] . "','" . $bot['mps'] . "','" . $bot['chp'] . "','" . $bot['cmp'] . "','" . $bot['st'] . "','" . $bot['affect'] . "','" . $bot['umen'] . "','" . $bot['perk'] . "','" . $bot['fr_bum'] . "','" . $bot['fr_mum'] . "','" . $bot['nav'] . "','" . $bot['battle'] . "','" . $bot['side'] . "','" . $bot['fight'] . "','" . $bot['sleep'] . "','" . $bot['block'] . "','" . $bot['prison'] . "','" . $bot['finblock'] . "','" . $bot['addon'] . "','" . $bot['about'] . "','" . $bot['dmg'] . "','" . $bot['exp'] . "','" . $bot['wins'] . "','" . $bot['mov'] . "','" . $bot['obnul'] . "','" . $bot['licens'] . "','" . $bot['options'] . "','" . $bot['semija'] . "','" . $bot['a_m'] . "','" . $bot['sign'] . "','" . $bot['minex'] . "','" . $bot['miney'] . "','" . $bot['waiter'] . "','" . $bot['sp7'] . "','" . $bot['forum_accesses'] . "','" . $bot['forum_smiles'] . "','" . $bot['forum_lastmsg'] . "','" . $bot['firstlogin'] . "')";
            $i++;
            //	echo'bot|';
            if ($i < $bot_kolvo[$k] or $k < $n - 1) {
                $insert .= $ins . ",";
            } else {
                $insert .= $ins;
            }
        }
//	echo'test|';
        $k++;
        $i = 0;
    }
    return $insert;
}

function logovo_nap($player, $bot_id, $bot_kolvo)
{
    $query = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `user` WHERE id=$player[id] LIMIT 1;");
    if (mysqli_num_rows($query) > 0) {
        $trwrand = rand(0, 80);
        $trw = 10;
        if ($trwrand <= 10) {
            $trw = 10;
        } else if ($trwrand <= 30) {
            $trw = 30;
        } else if ($trwrand <= 50) {
            $trw = 50;
        } else if ($trwrand <= 80) {
            $trw = 80;
        }
        $fid = newbattle(2, $player['loc'], 1, time(), 300, $trw, 0, 0, 0, 0, 0, 0, 0, 1);
        $ins1 = "`damage_mods`,`access`,`type`,`login`,`pass`,`email`,`useaction`,`icq`,`name`,`country`,`city`,`bday`,`url`,`sex`,`thotem`,`bdaypers`,`ip`,`filt`,`pcid`,`last`,`lastbattle`,`wait`,`chcolor`,`loc`,`pos`,`level`,`clan_id`,`clan`,`clan_d`,`clan_gif`,`clan_accesses`,`clan_status`,`clan_check`,`sklon`,`nv`,`dd`,`baks`,`obraz`,`f_obraz`,`obr_col`,`sila`,`lovk`,`uda4a`,`zdorov`,`znan`,`mudr`,`ustal`,`od`,`bl`,`free_stat`,`hp`,`hp_all`,`mp`,`mp_all`,`hps`,`mps`,`chp`,`cmp`,`st`,`affect`,`umen`,`perk`,`fr_bum`,`fr_mum`,`nav`,`battle`,`side`,`fight`,`sleep`,`block`,`prison`,`finblock`,`addon`,`about`,`dmg`,`exp`,`wins`,`mov`,`obnul`,`licens`,`options`,`semija`,`a_m`,`sign`,`minex`,`miney`,`waiter`,`sp7`,`forum_accesses`,`forum_smiles`,`forum_lastmsg`,`firstlogin`";
        mysqli_query($GLOBALS['db_link'], "INSERT INTO `user` (" . $ins1 . ") VALUES " . ins_bot_logovo($bot_id, $bot_kolvo, $fid) . ";");
        save_hp_roun($player);
        $randtime = rand(240, 300);
        $lb = time() + $randtime;
        mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `battle`='" . $fid . "',`side`='1',`lastbattle`='" . $lb . "',`wait`='" . time() . "' WHERE `login`='" . $player['login'] . "' LIMIT 1;");
        startbat($fid, 2);
        // Пишем логи NEW
        $log = ',[[0,"' . date("H:i") . '"],"Бой между "';
        $LeftTeam = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `user` WHERE `side` = '1' AND `battle`='" . $fid . "'");
        while ($val = mysqli_fetch_assoc($LeftTeam)) {
            if ($val['side'] == '1') {
                if ($val['invisible'] < time()) {
                    $log .= ',[1,' . $val['side'] . ',"' . $val['login'] . '",' . $val['level'] . ',' . $val['sklon'] . ',"' . $val['clan_gif'] . '"],","';
                } else {
                    $log .= ',[4,' . $val['side'] . '],","';
                }
            }
        }
        $log = substr_replace($log, '', -3);
        $log .= '" и "';
        $RightTeam = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `user` WHERE `side` = '2' AND `battle`='" . $fid . "'");
        while ($val = mysqli_fetch_assoc($RightTeam)) {
            if ($val['side'] == '2') {
                if ($val['invisible'] < time()) {
                    $log .= ',[1,' . $val['side'] . ',"' . $val['login'] . '",' . $val['level'] . ',' . $val['sklon'] . ',"' . $val['clan_gif'] . '"],","';
                } else {
                    $log .= ',[4,' . $val['side'] . '],","';
                }
            }
        }
        $log = substr_replace($log, '', -3);
        $log .= '" начался (бой в погребе)."]';
        savelog($log, $fid);
        //Конец Писанины логов!!!
        echo "<script>top.frames['main_top'].location='/main.php'</script>";
    }
}

function BotAttack($player)
{
    list($player['x'], $player['y']) = explode('_', $player['pos']);
    $query = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `nature_bots` WHERE `x`='" . $player['x'] . "' AND `y`='" . $player['y'] . "'");
    if (mysqli_num_rows($query) > 0) {
        $botxy = mysqli_fetch_assoc($query);
        $trwrand = rand(0, 80);
        $uId1 = $uId2 = '';
        $trw = 10;
        if ($trwrand <= 10) {
            $trw = 10;
        } else if ($trwrand <= 30) {
            $trw = 30;
        } else if ($trwrand <= 50) {
            $trw = 50;
        } else if ($trwrand <= 80) {
            $trw = 80;
        }
        $fid = newbattle(2, $player['loc'], 1, time(), 300, $trw, 0, 0, 0, 0, 0, 0, 0, 1);
        $maxbot = $player['level'];
        if ($maxbot > 6) {
            $maxbot = 6;
        } elseif ($maxbot <= 1) {
            $maxbot = 2;
        }
        $kb = rand(1, $maxbot);
        $ins1 = "`damage_mods`,`access`,`type`,`login`,`pass`,`email`,`useaction`,`icq`,`name`,`country`,`city`,`bday`,`url`,`sex`,`thotem`,`bdaypers`,`ip`,`filt`,`pcid`,`last`,`lastbattle`,`wait`,`chcolor`,`loc`,`pos`,`level`,`clan_id`,`clan`,`clan_d`,`clan_gif`,`clan_accesses`,`clan_status`,`clan_check`,`sklon`,`nv`,`dd`,`baks`,`obraz`,`f_obraz`,`obr_col`,`sila`,`lovk`,`uda4a`,`zdorov`,`znan`,`mudr`,`ustal`,`od`,`bl`,`free_stat`,`hp`,`hp_all`,`mp`,`mp_all`,`hps`,`mps`,`chp`,`cmp`,`st`,`affect`,`umen`,`perk`,`fr_bum`,`fr_mum`,`nav`,`battle`,`side`,`fight`,`sleep`,`block`,`prison`,`finblock`,`addon`,`about`,`dmg`,`exp`,`wins`,`mov`,`obnul`,`licens`,`options`,`semija`,`a_m`,`sign`,`minex`,`miney`,`waiter`,`sp7`,`forum_accesses`,`forum_smiles`,`forum_lastmsg`,`firstlogin`";
        mysqli_query($GLOBALS['db_link'], "INSERT INTO `user` (" . $ins1 . ") VALUES " . ins_bot($botxy, $kb, $fid) . ";");
        save_hp_roun($player);
        $randtime = rand(240, 300);
        if ($player['level'] <= 5) {
            $randtime = rand(120, 150);
        }
        if ($player['pos'] == '1_2') {
            $randtime = rand(600, 720);
        }
        $sk = 'kgTvx2WrEZ';
        if (bots_array($player, 1) == 12) {
            $player['sign'] = $sk;
        }
        if ($player['sign'] == $sk) {
            $randtime = 120;
        }
        $lb = time() + $randtime;
        mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `battle`='" . $fid . "',`side`='1',`lastbattle`='" . $lb . "',`wait`='" . time() . "' WHERE `login`='" . $player['login'] . "' LIMIT 1;");
        startbat($fid, 2);
        // Пишем логи NEW
        $log = ',[[0,"' . date("H:i") . '"],"Бой между "';
        $LeftTeam = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `user` WHERE `side` = '1' AND `battle`='" . $fid . "'");
        while ($val = mysqli_fetch_assoc($LeftTeam)) {
            if ($val['side'] == '1') {
                if ($val['invisible'] < time()) {
                    $log .= ',[1,' . $val['side'] . ',"' . $val['login'] . '",' . $val['level'] . ',' . $val['sklon'] . ',"' . $val['clan_gif'] . '"],","';
                } else {
                    $log .= ',[4,' . $val['side'] . '],","';
                }
            }
            $uId1 .= $val["id"] . "|";
        }
        $log = substr_replace($log, '', -3);
        $log .= '" и "';
        $RightTeam = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `user` WHERE `side` = '2' AND `battle`='" . $fid . "'");
        while ($val = mysqli_fetch_assoc($RightTeam)) {
            if ($val['side'] == '2') {
                if ($val['invisible'] < time()) {
                    $log .= ',[1,' . $val['side'] . ',"' . $val['login'] . '",' . $val['level'] . ',' . $val['sklon'] . ',"' . $val['clan_gif'] . '"],","';
                } else {
                    $log .= ',[4,' . $val['side'] . '],","';
                }
            }
            $uId2 .= $val["id"] . "|";
        }
        SetMap(1, substr($uId1, 0, strlen($uId1) - 1), substr($uId2, 0, strlen($uId2) - 1));
        $log = substr_replace($log, '', -3);
        $log .= '" начался (нападение бота)."]';
        savelog($log, $fid);
        //Конец Писанины логов!!!
        echo "<script>parent.frames['main_top'].location='/main.php'</script>";
    }
}

function trane_bots($bots_ids, $fid)
{
    $insert = '';
    for ($i = 0; $i < count($bots_ids); $i++) {
        $bot = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `user` WHERE `id`='" . $bots_ids[$i] . "'"));
        $bot['battle'] = $fid;
        $bot['side'] = 2;
        $bot['hp'] = $bot['hp_all'];
        $bot['mp'] = $bot['mp_all'];
        $bot['fight'] = 0;
        $ins = "('" . $bot['damage_mods'] . "','" . $bot['access'] . "','" . $bot['type'] . "','" . $bot['login'] . "','" . $bot['pass'] . "','" . $bot['email'] . "','" . $bot['useaction'] . "','" . $bot['icq'] . "','" . $bot['name'] . "','" . $bot['country'] . "','" . $bot['city'] . "','" . $bot['bday'] . "','" . $bot['url'] . "','" . $bot['sex'] . "','" . $bot['thotem'] . "','" . $bot['bdaypers'] . "','" . $bot['ip'] . "','" . $bot['filt'] . "','" . $bot['pcid'] . "','" . $bot['last'] . "','" . $bot['lastbattle'] . "','" . $bot['wait'] . "','" . $bot['chcolor'] . "','" . $bot['loc'] . "','" . $bot['pos'] . "','" . $bot['level'] . "','" . $bot['clan_id'] . "','" . $bot['clan'] . "','" . $bot['clan_d'] . "','" . $bot['clan_gif'] . "','" . $bot['clan_accesses'] . "','" . $bot['clan_status'] . "','" . $bot['clan_check'] . "','" . $bot['sklon'] . "','" . $bot['nv'] . "','" . $bot['dd'] . "','" . $bot['baks'] . "','" . $bot['obraz'] . "','" . $bot['f_obraz'] . "','" . $bot['obr_col'] . "','" . $bot['sila'] . "','" . $bot['lovk'] . "','" . $bot['uda4a'] . "','" . $bot['zdorov'] . "','" . $bot['znan'] . "','" . $bot['mudr'] . "','" . $bot['ustal'] . "','" . $bot['od'] . "','" . $bot['bl'] . "','" . $bot['free_stat'] . "','" . $bot['hp'] . "','" . $bot['hp_all'] . "','" . $bot['mp'] . "','" . $bot['mp_all'] . "','" . $bot['hps'] . "','" . $bot['mps'] . "','" . $bot['chp'] . "','" . $bot['cmp'] . "','" . $bot['st'] . "','" . $bot['affect'] . "','" . $bot['umen'] . "','" . $bot['perk'] . "','" . $bot['fr_bum'] . "','" . $bot['fr_mum'] . "','" . $bot['nav'] . "','" . $bot['battle'] . "','" . $bot['side'] . "','" . $bot['fight'] . "','" . $bot['sleep'] . "','" . $bot['block'] . "','" . $bot['prison'] . "','" . $bot['finblock'] . "','" . $bot['addon'] . "','" . $bot['about'] . "','" . $bot['dmg'] . "','" . $bot['exp'] . "','" . $bot['wins'] . "','" . $bot['mov'] . "','" . $bot['obnul'] . "','" . $bot['licens'] . "','" . $bot['options'] . "','" . $bot['semija'] . "','" . $bot['a_m'] . "','" . $bot['sign'] . "','" . $bot['minex'] . "','" . $bot['miney'] . "','" . $bot['waiter'] . "','" . $bot['sp7'] . "','" . $bot['forum_accesses'] . "','" . $bot['forum_smiles'] . "','" . $bot['forum_lastmsg'] . "','" . $bot['firstlogin'] . "')";
        if ($i < (count($bots_ids) - 1)) {
            $insert .= $ins . ",";
        } else {
            $insert .= $ins;
        }
    }
    return $insert;
}

function TraneAttack($player, $bots_ids)
{
    $trwrand = rand(0, 80);
    $trw = 10;
    if ($trwrand <= 10) {
        $trw = 10;
    } else if ($trwrand <= 30) {
        $trw = 30;
    } else if ($trwrand <= 50) {
        $trw = 50;
    } else if ($trwrand <= 80) {
        $trw = 80;
    }
    $fid = newbattle(2, $player['loc'], 1, time(), 300, $trw, 0, 0, 0, 0, 0, 0, 0, 1);
    $ins1 = "`damage_mods`,`access`,`type`,`login`,`pass`,`email`,`useaction`,`icq`,`name`,`country`,`city`,`bday`,`url`,`sex`,`thotem`,`bdaypers`,`ip`,`filt`,`pcid`,`last`,`lastbattle`,`wait`,`chcolor`,`loc`,`pos`,`level`,`clan_id`,`clan`,`clan_d`,`clan_gif`,`clan_accesses`,`clan_status`,`clan_check`,`sklon`,`nv`,`dd`,`baks`,`obraz`,`f_obraz`,`obr_col`,`sila`,`lovk`,`uda4a`,`zdorov`,`znan`,`mudr`,`ustal`,`od`,`bl`,`free_stat`,`hp`,`hp_all`,`mp`,`mp_all`,`hps`,`mps`,`chp`,`cmp`,`st`,`affect`,`umen`,`perk`,`fr_bum`,`fr_mum`,`nav`,`battle`,`side`,`fight`,`sleep`,`block`,`prison`,`finblock`,`addon`,`about`,`dmg`,`exp`,`wins`,`mov`,`obnul`,`licens`,`options`,`semija`,`a_m`,`sign`,`minex`,`miney`,`waiter`,`sp7`,`forum_accesses`,`forum_smiles`,`forum_lastmsg`,`firstlogin`";
    mysqli_query($GLOBALS['db_link'], "INSERT INTO `user` (" . $ins1 . ") VALUES " . trane_bots($bots_ids, $fid) . ";");
    save_hp_roun($player);
    $randtime = rand(240, 300);
    if ($player['level'] <= 5) {
        $randtime = rand(120, 150);
    }
    if ($player['pos'] == '1_2') {
        $randtime = rand(600, 720);
    }
    $sk = 'kgTvx2WrEZ';
    if (bots_array($player, 1) == 12) {
        $player['sign'] = $sk;
    }
    if ($player['sign'] == $sk) {
        $randtime = 120;
    }
    $lb = time() + $randtime;
    mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `battle`='" . $fid . "',`side`='1',`lastbattle`='" . $lb . "',`wait`='" . time() . "' WHERE `login`='" . $player['login'] . "' LIMIT 1;");
    startbat($fid, 2);
    // Пишем логи NEW
    $log = ',[[0,"' . date("H:i") . '"],"Бой между "';
    $LeftTeam = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `user` WHERE `side` = '1' AND `battle`='" . $fid . "'");
    while ($val = mysqli_fetch_assoc($LeftTeam)) {
        if ($val['side'] == '1') {
            if ($val['invisible'] < time()) {
                $log .= ',[1,' . $val['side'] . ',"' . $val['login'] . '",' . $val['level'] . ',' . $val['sklon'] . ',"' . $val['clan_gif'] . '"],","';
            } else {
                $log .= ',[4,' . $val['side'] . '],","';
            }
        }
    }
    $log = substr_replace($log, '', -3);
    $log .= '" и "';
    $RightTeam = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `user` WHERE `side` = '2' AND `battle`='" . $fid . "'");
    while ($val = mysqli_fetch_assoc($RightTeam)) {
        if ($val['side'] == '2') {
            if ($val['invisible'] < time()) {
                $log .= ',[1,' . $val['side'] . ',"' . $val['login'] . '",' . $val['level'] . ',' . $val['sklon'] . ',"' . $val['clan_gif'] . '"],","';
            } else {
                $log .= ',[4,' . $val['side'] . '],","';
            }
        }
    }
    $log = substr_replace($log, '', -3);
    $log .= '" начался (нападение бота)."]';
    savelog($log, $fid);
    //Конец Писанины логов!!!
    echo "<script>parent.frames['main_top'].location='/main.php'</script>";
}

function BotAttackPod($player, $id)
{
    $trwrand = rand(0, 80);
    $trw = 10;
    if ($trwrand <= 10) {
        $trw = 10;
    } else if ($trwrand <= 30) {
        $trw = 30;
    } else if ($trwrand <= 50) {
        $trw = 50;
    } else if ($trwrand <= 80) {
        $trw = 80;
    }
    $fid = newbattle(2, $player['loc'], 1, time(), 30000, $trw, 0, 0, 0, 0, 0, 0, 0, 1);
    switch ($id) {
        case 1:
            $botxy['lvlmin'] = 3;
            $botxy['lvlmax'] = 5;
            $kb = $player['level'] * 2;
            $tme = time() + 86400;
            break;
        case 2:
            $botxy['lvlmin'] = 7;
            $botxy['lvlmax'] = 9;
            $kb = $player['level'] * 2;
            $tme = time() + 86400;
            break;
        case 3:
            $botxy['lvlmin'] = 10;
            $botxy['lvlmax'] = 11;
            $kb = $player['level'] * 1;
            $tme = time() + 86400;
            break;
    }
    $ins1 = "`damage_mods`,`access`,`type`,`login`,`pass`,`email`,`useaction`,`icq`,`name`,`country`,`city`,`bday`,`url`,`sex`,`thotem`,`bdaypers`,`ip`,`filt`,`pcid`,`last`,`lastbattle`,`wait`,`chcolor`,`loc`,`pos`,`level`,`clan_id`,`clan`,`clan_d`,`clan_gif`,`clan_accesses`,`clan_status`,`clan_check`,`sklon`,`nv`,`dd`,`baks`,`obraz`,`f_obraz`,`obr_col`,`sila`,`lovk`,`uda4a`,`zdorov`,`znan`,`mudr`,`ustal`,`od`,`bl`,`free_stat`,`hp`,`hp_all`,`mp`,`mp_all`,`hps`,`mps`,`chp`,`cmp`,`st`,`affect`,`umen`,`perk`,`fr_bum`,`fr_mum`,`nav`,`battle`,`side`,`fight`,`sleep`,`block`,`prison`,`finblock`,`addon`,`about`,`dmg`,`exp`,`wins`,`mov`,`obnul`,`licens`,`options`,`semija`,`a_m`,`sign`,`minex`,`miney`,`waiter`,`sp7`,`forum_accesses`,`forum_smiles`,`forum_lastmsg`,`firstlogin`";
    mysqli_query($GLOBALS['db_link'], "INSERT INTO `user` (" . $ins1 . ") VALUES " . ins_bot($botxy, $kb, $fid) . ";");
    save_hp_roun($player);
    $randtime = rand(240, 300);
    if ($player['level'] <= 5) {
        $randtime = rand(120, 150);
    }
    if ($player['pos'] == '1_2') {
        $randtime = rand(600, 720);
    }
    $sk = 'kgTvx2WrEZ';
    if (bots_array($player, 1) == 12) {
        $player['sign'] = $sk;
    }
    if ($player['sign'] == $sk) {
        $randtime = 120;
    }
    $lb = time() + $randtime;
    mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `battle`='" . $fid . "',`side`='1',`lastbattle`='" . $lb . "' WHERE `login`='" . $player['login'] . "' LIMIT 1;");
    mysqli_query($GLOBALS['db_link'], "UPDATE `podzem` SET `start_time`='" . time() . "',`end_time`='" . $tme . "' WHERE `pl_id`='" . $player['id'] . "' AND `pod_id`='" . $id . "' LIMIT 1;");
    startbat($fid, 2);
    echo '<script>parent.frames[\'main_top\'].location=\'/main.php\'</script>';
}

function BotNapAttack($player, $ItemID)
{
    $sk = 'kgTvx2WrEZ';
    list($player['x'], $player['y']) = explode('_', $player['pos']);
    $query = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `nature_bots` WHERE `x`='" . $player['x'] . "' AND `y`='" . $player['y'] . "'");
    if (mysqli_num_rows($query) > 0) {
        $botxy = mysqli_fetch_assoc($query);
        $trwrand = rand(0, 80);
        $trw = 10;
        if ($trwrand <= 10) {
            $trw = 10;
        } else if ($trwrand <= 30) {
            $trw = 30;
        } else if ($trwrand <= 50) {
            $trw = 50;
        } else if ($trwrand <= 80) {
            $trw = 80;
        }
        $fid = newbattle(2, $player['loc'], 1, time(), 300, $trw, 0, 0, 0, 0, 0, 0, 0, 1);
        $kb = rand(4, 12);
        $ins1 = "`damage_mods`,`access`,`type`,`login`,`pass`,`email`,`useaction`,`icq`,`name`,`country`,`city`,`bday`,`url`,`sex`,`thotem`,`bdaypers`,`ip`,`filt`,`pcid`,`last`,`lastbattle`,`wait`,`chcolor`,`loc`,`pos`,`level`,`clan_id`,`clan`,`clan_d`,`clan_gif`,`clan_accesses`,`clan_status`,`clan_check`,`sklon`,`nv`,`dd`,`baks`,`obraz`,`f_obraz`,`obr_col`,`sila`,`lovk`,`uda4a`,`zdorov`,`znan`,`mudr`,`ustal`,`od`,`bl`,`free_stat`,`hp`,`hp_all`,`mp`,`mp_all`,`hps`,`mps`,`chp`,`cmp`,`st`,`affect`,`umen`,`perk`,`fr_bum`,`fr_mum`,`nav`,`battle`,`side`,`fight`,`sleep`,`block`,`prison`,`finblock`,`addon`,`about`,`dmg`,`exp`,`wins`,`mov`,`obnul`,`licens`,`options`,`semija`,`a_m`,`sign`,`minex`,`miney`,`waiter`,`sp7`,`forum_accesses`,`forum_smiles`,`forum_lastmsg`,`firstlogin`";
        mysqli_query($GLOBALS['db_link'], "INSERT INTO `user` (" . $ins1 . ") VALUES " . ins_bot($botxy, $kb, $fid) . ";");
        save_hp_roun($player);
        $randtime = rand(240, 300);
        if ($player['level'] <= 5) {
            $randtime = rand(120, 150);
        }
        if (bots_array($player, 1) == 12) {
            $player['sign'] = $sk;
        }
        if ($player['sign'] == $sk) {
            $randtime = 120;
        }
        $lb = time() + $randtime;
        mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `battle`='" . $fid . "',`side`='1',`lastbattle`='" . $lb . "' WHERE `login`='" . $player['login'] . "' LIMIT 1;");
        startbat($fid, 2);
        echo '<script>parent.frames[\'main_top\'].location=\'/main.php\'</script>';
        it_break($ItemID);
    } else {
        echo "<center><b><font class=nickname><font color=#cc0000>Не найдено существ!</font></font></b></center>";
    }

}

function PlayerAttack($login, $id, $trw, $type)
{
    $user = player();
    $pl = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM user WHERE login='$login';"));
    if ($pl == '') {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Персонажа \"$login\" несуществует!</font></font></b><br>";
    } else if ($pl[login] == $user[login]) {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Нельзя напасть на себя!</font></font></b><br>";
    } else if ($pl[last] < (time() - 300)) {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Персонажа \"$login\" нет в игре!</font></font></b><br>";
    } else if ($user[loc] != $pl[loc] and $type != 3) {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Персонажа \"$login\" нет в этой локации!</font></font></b><br>";
    } else if ($user[loc] == 28 and $pl[loc] == 28 and $user[pos] != $pl[pos] and $type != 3) {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Персонажа \"$login\" нет в этой локации!</font></font></b><br>";
    } else if ($pl[id] < 9999) {
        $msg[msg] = "<b><font class=nickname><font color=#cc0000>Нельзя нападать на ботов!</font></font></b><br>";
    } else {
        if ($pl[battle] > 0 and $pl[fight] == 1 and $pl[hp] > 0) {
            if ($pl[side] == 1) {
                $side = 2;
            } else {
                $side = 1;
            }
            mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `battle`='" . $pl[battle] . "',`side`='" . $side . "',`fight`='" . $pl['fight'] . "' WHERE `login`='" . $user['login'] . "' LIMIT 1;");
            mysqli_query($GLOBALS['db_link'], "UPDATE `arena` SET kol$side=kol$side+1 WHERE `id_battle`='" . $pl['battle'] . "' LIMIT 1;");
            sumbat($pl[battle], "$redirect", 0);
            if ($user[sex] == male) {
                $sex = 'ся';
            } else {
                $sex = 'ась';
            }
            if ($user['invisible'] < time()) {
                $logpl = "[1,$side,\"$user[login]\",$user[level],$user[sklon],\"$user[clan_gif]\"]";
            } else {
                $logpl = "[4,$side]";
            }
            $income = ",[[0,\"" . date("H:i") . "\"],$logpl,\" <b> Вмешал$sex в бой.</b>" . ($type == 3 ? "<b>Тёмное нападение.</b>" : "") . "\"]";
            savelog($income, $pl[battle]);
            if ($user['invisible'] < time()) {
                $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;Персонаж <b>$user[login]</b> напал на вас!</b></font><BR>'+'');$redirect";
            } else {
                $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;На вас напали!</b></font><BR>'+'');$redirect";
            }
            chmsg($ms, $login);
            it_break($id);
        } else if ($pl[hp] <= 0) {
            $msg[msg] = "<b><font class=nickname><font color=#cc0000>Персонаж \"$login\" мертв!</font></font></b><br>";
        } else if ($pl[wait] > time()) {
            $msg[msg] = "<b><font class=nickname><font color=#cc0000>Персонаж \"$login\" передвигается, нападение невозможно!</font></font></b><br>";
        } else if ($pl[fight] == 2) {
            $msg[msg] = "<b><font class=nickname><font color=#cc0000>Персонаж \"$login\" в бою с ботами, нападение невозможно!</font></font></b><br>";
        } else {
            $dopmsg = "";
            if ($type == 34) {
                mysqli_query($GLOBALS['db_link'], "UPDATE `invent` SET `used`='0' WHERE `pl_id`='" . $user['id'] . "' OR `pl_id`='" . $pl['id'] . "';");
                calcstat($user['id']);
                calcstat($pl['id']);
                $user = player();
                $pl = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `user` WHERE `login`='" . $login . "';"));
                calchp2($user, 0, 0);
                calchp2($pl, 0, 0);
                $dopmsg = " <b>(кулачное нападение)</b>";

            }
            if ($type == 3) {
                $dopmsg = " <b>Тёмное нападение.</b>";
            }
            $fid = newbattle(2, $user['loc'], 1, time(), 300, $trw, 0, 0, 0, 0, 0, 0, 0, 0);
            mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `battle`='" . $fid . "',`side`='1' WHERE `login`='" . $user['login'] . "' LIMIT 1;");
            mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `battle`='" . $fid . "',`side`='2' WHERE `login`='" . $pl['login'] . "' LIMIT 1;");
            startbat($fid, 1);
            $redirect = "parent.frames['main_top'].location='main.php';";
            if ($user['invisible'] < time()) {
                $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;Персонаж <b>$user[login]</b> напал на вас!$dopmsg</b></font><BR>'+'');$redirect";
            } else {
                $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;На вас напали!$dopmsg</b></font><BR>'+'');$redirect";
            }
            chmsg($ms, $login);
            if ($user['invisible'] < time()) {
                $logpl = "[1,$side,\"$user[login]\",$user[level],$user[sklon],\"$user[clan_gif]\"]";
            } else {
                $logpl = "[4,$side]";
            }
            if ($user[sex] == male) {
                $sex = '';
            } else {
                $sex = 'а';
            }
            $income = ",[[0,\"" . date("H:i") . "\"],$logpl,\" <b> Напал$sex на вас.</b>" . ($type == 3 ? " <b>Тёмное нападение.</b>" : "") . "\"]";
            savelog($income, $fid);
            it_break($id);
        }
    }
    return $msg;
}

function StartStorm($FortName, $Position)
{
    $fid = newbattle(2, "1001", 1, time(), 300, 80, 0, 0, 0, 0, 0, 0, 0, 0);
    mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `battle`='" . $fid . "',`side`='1' WHERE `fort_storm`='1' AND `loc`='1001' AND `pos`='" . $Position . "' AND `battle`='0' AND `hp`>'0' AND `last`>'" . (time() - 300) . "'");
    mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `battle`='" . $fid . "',`side`='2' WHERE `fort_storm`='2' AND `loc`='1001' AND `pos`='" . $Position . "' AND `battle`='0' AND `hp`>'0' AND `last`>'" . (time() - 300) . "'");
    startbat($fid, 1);
    save_hp_all($fid);
    // Пишем логи NEW
    $log = ',[[0,"' . date("H:i") . '"],"Нападение на ' . $FortName . ', осаждают "';
    $LeftTeam = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `user` WHERE `side` = '1' AND `battle`='" . $fid . "'");
    while ($val = mysqli_fetch_assoc($LeftTeam)) {
        if ($val['invisible'] < time()) {
            $log .= ',[1,' . $val['side'] . ',"' . $val['login'] . '",' . $val['level'] . ',' . $val['sklon'] . ',"' . $val['clan_gif'] . '"],","';
        } else {
            $log .= ',[4,' . $val['side'] . '],","';
        }
        chmsg("parent.frames['main_top'].location='main.php';", $val['login']);
    }
    $log = substr_replace($log, '', -3);
    $log .= '" и в обороне "';
    $RightTeam = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `user` WHERE `side` = '2' AND `battle`='" . $fid . "'");
    while ($val = mysqli_fetch_assoc($RightTeam)) {
        if ($val['invisible'] < time()) {
            $log .= ',[1,' . $val['side'] . ',"' . $val['login'] . '",' . $val['level'] . ',' . $val['sklon'] . ',"' . $val['clan_gif'] . '"],","';
        } else {
            $log .= ',[4,' . $val['side'] . '],","';
        }
        chmsg("parent.frames['main_top'].location='main.php';", $val['login']);
    }
    $log = substr_replace($log, '', -3);
    $log .= '" ну что, удачи!."]';
    savelog($log, $fid);
}

function NaemAttack($login)
{
    $user = player();
    if ($user['battle'] == 0 and $user['fight'] == 0) {
        $pl = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM user WHERE login='" . $login . "';"));
        if ($pl == '') {
            $msg[msg] = "<b><font class=nickname><font color=#cc0000>Персонажа \"$login\" несуществует!</font></font></b><br>";
        } else if ($pl['login'] == $user['login']) {
            $msg['msg'] = "<b><font class=nickname><font color=#cc0000>Нельзя напасть на себя!</font></font></b><br>";
        } else if ($pl['last'] < (time() - 300)) {
            $msg['msg'] = "<b><font class=nickname><font color=#cc0000>Персонажа \"$login\" нет в игре!</font></font></b><br>";
        } else if ($pl['id'] < 9999) {
            $msg[msg] = "<b><font class=nickname><font color=#cc0000>Нельзя нападать на ботов!</font></font></b><br>";
        } else {
            if ($pl['naemnik'] == 0) {
                $pl['naemnik'] = "||";
            }
            $naemnik = explode("|", $pl['naemnik']);
            $naemnik = "1|" . $naemnik[1];
            if ($pl['battle'] > 0 and $pl['fight'] > 0) {
                $side = $pl['side'];
                mysqli_query($GLOBALS['db_link'], "UPDATE user SET battle='" . $pl['battle'] . "',side=" . $side . ",fight=" . $pl['fight'] . " WHERE login='" . $user['login'] . "' LIMIT 1;");
                mysqli_query($GLOBALS['db_link'], "UPDATE arena SET kol$side=kol$side+1 WHERE id_battle='" . $pl['battle'] . "' LIMIT 1;");
                mysqli_query($GLOBALS['db_link'], "UPDATE user SET naemnik='" . $naemnik . "' WHERE login='" . $pl['login'] . "';");
                sumbat($pl['battle'], "$redirect", 0);
                if ($user[sex] == male) {
                    $sex = 'ся';
                } else {
                    $sex = 'ась';
                }
                $logpl = "[1,$side,\"$user[login]\",$user[level],$user[sklon],\"$user[clan_gif]\"]";
                $income = ",[[0,\"" . date("H:i") . "\"],$logpl,\" <b> Вмешал$sex в бой.</b>\"]";
                savelog($income, $pl['battle']);
                $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;Персонаж <b>$user[login]</b> пришел к вам на помощь!</b></font><BR>'+'');";
                chmsg($ms, $login);
            } else {
                mysqli_query($GLOBALS['db_link'], "UPDATE user SET naemnik='" . $naemnik . "' WHERE login='" . $pl['login'] . "';");
                $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;Никто не смог помочь персонажу <b>$login</b>...</b></font></b><BR>'+'');";
                chmsg($ms, '');
            }
        }
    }
    return $msg;
}

function getIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function pvu_logs($uid, $see, $reason)
{
    mysqli_query($GLOBALS['db_link'], "INSERT INTO `pvu_logs`.`logs_" . $see . "` (`uid`,`time_unix`,`time_norm`,`reason`) VALUES ('" . $uid . "','" . time() . "','" . date("Y-m-d H:i:s", time()) . "','" . $reason . "');");
}

function event_to_log($date, $type, $type2, $sign, $user, $old_lvl, $sklon, $level)
{
    $fp = fopen($_SERVER["DOCUMENT_ROOT"] . "/gameplay/services/events/" . date("d-m-y") . ".txt", "a+");
    fwrite($fp, '"' . $date . ';' . $type . ';' . $type2 . ';' . $sign . ';' . $user . ';' . $old_lvl . ';' . $sklon . ';' . $level . '",');
    fclose($fp);
    chmod($_SERVER["DOCUMENT_ROOT"] . "/gameplay/services/events/" . date("d-m-y") . ".txt", 0777);
}

function accesses($uid, $acc, $response = NULL)
{
    $access = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `accesses` WHERE `uid` =  '" . $uid . "'"));
    if (!$response) {
        return $access[$acc] ? true : false;
    } else {
        return $access[$acc];
    }
}

function allitemparam($it, $loc)
{
    switch ($loc) {
        case 'inv':
            break;
    }
}

function effects($UserID, $var)
{
    /* DataBase */
    $effects = array('', 'Боевая травма', 'Тяжелая травма', 'Средняя травма', 'Легкая травма', 'Излечение', '', '', 'Темное проклятие', 'Благословение ангела', 'Магическое зеркало', 'Берсеркер', 'Милосердие Создателя', 'Странник', 'Свиток Покровительства', 'Блок', 'Тюрьма', 'Молчанка', 'Форумная молчанка', 'Свиток Неизбежности', 'Зелье Колкости', 'Зелье Загрубелой Кожи', 'Зелье Просветления', 'Зелье Гения', 'Яд', 'Зелье Иммунитета', 'Зелье Силы', 'Зелье Защиты От Ожогов', 'Зелье Арктических Вьюг', 'Зелье Жизни', 'Зелье Сокрушительных Ударов', 'Зелье Стойкости', 'Зелье Недосягаемости', 'Зелье Точного Попадания', 'Зелье Ловкости', 'Зелье Удачи', 'Зелье Огненного Ореола', 'Зелье Метаболизма', 'Зелье Медитации', 'Зелье Громоотвода', 'Зелье Сильной Спины', 'Зелье Скорбь Лешего', 'Зелье Боевой Славы', 'Зелье Ловких Ударов', 'Зелье Спокойствия', 'Зелье Мужества', 'Зелье Человек-Гора', 'Зелье Секрет Волшебника', 'Зелье Инквизитора', 'Зелье Панциря', '', 'Секретное Зелье', 'Зелье Скорости', 'Зелье Соколиный Взор', 'Зелье Подвижности', 'Фронтовые 100 грамм', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Зелье Кровожадности', 'Зелье Быстроты', 'Свиток Величия', 'Свиток Каменной кожи', 'Слеза Создателя', 'Гнев Локара', 'Дар Иланы', 'Новогодний бонус', 'Эликсир из Подснежника', 'Молодильное яблочко', 'Благословение Иланы', 'День всех влюбленных', 'Галантный кавалер');
    /* Effects Show */
    $Query = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `effects` WHERE `uid`='" . $UserID . "' AND `time`>'" . time() . "' ORDER BY `time` DESC");
    while ($row = mysqli_fetch_assoc($Query)) {

        /* Вычесляем время */
        if ($row['time'] > time()) {
            $row['time'] -= time();
            $ch = floor($row['time'] / 3600);
            $min = floor(($row['time'] - ($ch * 3600)) / 60);
            $sec = floor(($row['time'] - ($ch * 3600)) % 60);
            if ($var == 0) {
                $row['time'] = $ch . "ч " . $min . "мин ";
            } elseif ($var == 1) {
                $row['time'] = (($ch < 10) ? '0' . $ch : $ch) . ":" . (($min < 10) ? '0' . $min : $min) . ":" . (($sec < 10) ? '0' . $sec : $sec);
            }
        }

        /* Считаем статы */
        $params = explode("|", $row['f_params']);
        foreach ($params as $f_params) {
            $sts = explode("@", $f_params);
            $stat[$sts[0]] += $sts[1];
        }

        /* Колество травм на вывод, допустим (x2) */
        $Effect[$row['eff_id']] += 1;

        /* Подсчет и написание текстов */
        switch ($var) {
            case'1':
                if (!empty($effects[$row['eff_id']]) and $Effect[$row['eff_id']] == 1) {
                    $CountEff = mysqli_num_rows(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `effects` WHERE `uid`='" . $UserID . "' AND `time`>'" . time() . "' AND `eff_id`='" . $row['eff_id'] . "' ORDER BY `time` DESC"));
                    $s .= "[" . $row['eff_id'] . ",'<b>" . $effects[$row['eff_id']] . "</b> (x" . $CountEff . ") (еще " . $row['time'] . ")'],";
                }
                break;
        }
    }

    switch ($var) {
        case'1':
            return substr($s, 0, strlen($s) - 1);
            break;
    }
}

function send_mail($email, $header, $body)
{
    $subject = '=?utf-8?B?' . base64_encode($header) . '?=';
    $headers = "From: <noreply@legend battles.ru>\r\n";
    $headers .= "Return-path: <noreply@legend battles.ru>\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8; boundary=\"--" . md5(uniqid(time())) . "\"\r\n";
    if (mail($email, $subject, $body, $headers)) {
        return true;
    } else {
        return false;
    }
}

function CountOD($pod, $inu, $inb, $ina)
{
    // Стандартные Параметры из базы
    $pos_ochd = array(0, 0, 50, 90, 35, 50, 60, 30, 50, 60, 30, 50, 35, 80, 40, 85, 40, 85, 40, 85, 40, 100, 45, 70, 70, 70, 130, 90, 90, 45, 60, 90, 30, 30, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 90, 70, 90, 70, 90, 70, 90, 70, 100, 100, 100, 70, 100, 70, 70, 100, 0, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 0, 0, 30, 30, 30);
    $shtra_ud = array(0, 0, 25, 75, 150, 250);
    // Проверяем удары
    $tInu = explode("@", $inu);
    for ($i = 0; $i < count($tInu) - 1; $i++) {
        $t2Inu = explode("_", $tInu[$i]);
        $ochd[] = $t2Inu[1];
    }
    // Удары с учетом штрафов
    $count_od = $shtra_ud[count($ochd)];
    // Проверяем Блоки
    $tInb = explode("@", $inb);
    for ($i = 0; $i < count($tInb) - 1; $i++) {
        $t2Inb = explode("_", $tInb[$i]);
        $ochd[] = $t2Inb[1];
    }
    // Проверяем Магию
    $tIna = explode("@", $ina);
    for ($i = 0; $i < count($tIna) - 1; $i++) {
        $t2Ina = explode("_", $tIna[$i]);
        $ochd[] = $t2Ina[1];
    }
    //Считаем количество ОД
    for ($i = 0; $i < count($ochd); $i++) {
        if ($ochd[$i] > 2) {
            $count_od += $pos_ochd[$ochd[$i]];
        } else {
            switch ($ochd[$i]) {
                case 0:
                    $count_od += $pod;
                    break;
                case 1:
                    $count_od += ($pod + 20);
                    break;
            }
        }
    }
    // Выводим результат ОД
    return $count_od;
}

    //мази:
    //param = все статы мази
//type = w70
    //effect = время действия
    //need = требования чтобы намазаться\намазать
    //вид массива в БД:
    //id@time|id@time где id > ид вещи из итемс

function maseused($id, $login, $loc, $masetype)
{
        //$id - ид мази,$login - на кого мажем,$loc - местонахождение намазывающего
        //$masetype - тип мази (пока 2 типа: 0 или '' -  бафф | 1 - снятие определенныех эффектов)
    $player = player();
    $user = $_SESSION['user'];
    $pl = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM user WHERE login='$login'"));
    $pl_st = allparam($pl);
        if ($pl == '') {
            $msg[msg] = "<b><font class=nickname><font color=#cc0000>Персонажа \"$login\" несуществует!</font></font></b><br>";
        } else if ($pl[last] < (time() - 300)) {
            $msg[msg] = "<b><font class=nickname><font color=#cc0000>Персонажа \"$login\" нет в игре!</font></font></b><br>";
        } else if ($loc != $pl[loc]) {
            $msg[msg] = "<b><font class=nickname><font color=#cc0000>Персонажа \"$login\" нет в этой локации!</font></font></b><br>";
        } else if ($pl[fight] > 0) {
            $msg[msg] = "<b><font class=nickname><font color=#cc0000>Неудачно! Персонаж \"$login\" в бою!</font></font></b><br>";
        } else {
            $masscalc = 0;
            $it = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT invent.*, items.* FROM items INNER JOIN invent ON items.id = invent.protype WHERE id_item='$id' AND type='w70' LIMIT 1;"));
            if ($it['id']) {
                if ($it['num_a'] == '32') { // снимаем эффекты других мазей
                    mysqli_query($GLOBALS['db_link'], "UPDATE user SET masebonus='' WHERE login='$login'");
                    if ($user['login'] != $login) {
                        $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;Персонаж <b>$user[login]</b>  применил к вам <b>\"$it[name]\" и снял все эффекты мазей.</b></font><BR>'+'');";
                        chmsg($ms, $login);
                    }
                    it_break($id);
                } elseif ($it['num_a'] == '33') {//лечим все травмы
                    mysqli_query($GLOBALS['db_link'], "UPDATE user SET affect='' WHERE login='$login'");
                    if ($user['login'] != $login) {
                        $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;Персонаж <b>$user[login]</b>  применил к вам <b>\"$it[name]\" и вылечил все травмы.</b></font><BR>'+'');";
                        chmsg($ms, $login);
                    }
                    it_break($id);
                } elseif ($it['num_a'] == '34') {//снимаем эффекты зелий
                    mysqli_query($GLOBALS['db_link'], "UPDATE user SET buffs='' WHERE login='$login'");
                    if ($user['login'] != $login) {
                        $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;Персонаж <b>$user[login]</b>  применил к вам <b>\"$it[name]\" и снял все эффекты зелий и абилок.</b></font><BR>'+'');";
                        chmsg($ms, $login);
                    }
                    it_break($id);
                } elseif ($it['num_a'] == '1') {//снимаем ВСЕ эффекты
                    mysqli_query($GLOBALS['db_link'], "UPDATE user SET buffs='',affect='',masebonus='' WHERE login='$login'");
                    if ($user['login'] != $login) {
                        $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;Персонаж <b>$user[login]</b>  применил к вам <b>\"$it[name]\" и снял все эффекты зелий, мазей, абилок и вылечил все травмы.</b></font><BR>'+'');";
                        chmsg($ms, $login);
                    }
                    it_break($id);
                } elseif ($it['num_a'] == '2') {//снимаем ВСЕ эффекты на клетке
                    $masscalc = 1;
                    mysqli_query($GLOBALS['db_link'], "UPDATE user SET buffs='',affect='',masebonus='' WHERE loc='" . $player['loc'] . "' AND pos='" . $player['pos'] . "' AND type<>3;");
                    $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;Персонаж <b>$user[login]</b>  применил к игрокам рядом с собой <b>\"$it[name]\" и снял все эффекты зелий, мазей, абилок и вылечил все травмы.</b></font><BR>'+'');";
                    chmsg($ms, '');
                    it_break($id);
                } elseif ($it['num_a'] == '3') { // снимаем эффекты других мазей на клетке
                    $masscalc = 1;
                    mysqli_query($GLOBALS['db_link'], "UPDATE user SET masebonus='' WHERE loc='" . $player['loc'] . "' AND pos='" . $player['pos'] . "' AND type<>3;");
                    $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;Персонаж <b>$user[login]</b>  применил к игрокам рядом с собой <b>\"$it[name]\" и снял все эффекты мазей.</b></font><BR>'+'');";
                    chmsg($ms, '');
                    it_break($id);
                } elseif ($it['num_a'] == '4') {//лечим все травмы на клетке
                    $masscalc = 1;
                    mysqli_query($GLOBALS['db_link'], "UPDATE user SET affect='' WHERE loc='" . $player['loc'] . "' AND pos='" . $player['pos'] . "' AND type<>3;");
                    $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;Персонаж <b>$user[login]</b>  применил к игрокам рядом с собой <b>\"$it[name]\"  и вылечил все травмы.</b></font><BR>'+'');";
                    chmsg($ms, '');
                    it_break($id);
                } elseif ($it['num_a'] == '5') {//снимаем эффекты зелий на клетке
                    $masscalc = 1;
                    mysqli_query($GLOBALS['db_link'], "UPDATE user SET buffs='' WHERE loc='" . $player['loc'] . "' AND pos='" . $player['pos'] . "' AND type<>3;");
                    $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;Персонаж <b>$user[login]</b>  применил к игрокам рядом с собой <b>\"$it[name]\" и снял все эффекты зелий и абилок.</b></font><BR>'+'');";
                    chmsg($ms, '');
                    it_break($id);
                } else { //обычные мази
                    $stopbuff = 0;
                    $immune = explode("|", $it['immunes']);
                    foreach ($immune as $val) {
                        if ($val == 1) {
                            $immune_pl = explode("|", $pl['immunes']);
                            foreach ($immune_pl as $val_pl) {
                                if ($val_pl == 1) {
                                    $stopbuff = 2;
                                    break;
                                }
                            }
                            break;
                        }
                    }
                    if ($pl['masebonus'] == '') {
                        $pl['masebonus'] = "||||";
                    }
                    $need = explode("|", $it['need']);
                    foreach ($need as $value) {
                        $treb = explode("@", $value);
                        if ($pl_st[$treb[0]] < $treb[1]) {
                            $stopbuff = 1;
                        }
                    }
                    if ($stopbuff == 0) {
                        $msg[0] = $it['name'];
                        $i = 0;
                        $newmase = '';
                        $plmases = explode("|", $pl['masebonus']);
                        foreach ($plmases as $val) {
                            $mase = explode("@", $val);
                            if ($mase[1] >= time() and $mase[0]) {
                                $newmase .= $mase[0] . '@' . $mase[1] . ($mase[2] ? '@' . $mase[2] : '') . '|';
                            }
                        }
                        $newmase = substr($newmase, 0, strlen($newmase) - 1);
                        $buffs = explode("|", $newmase);
                        $regularmase = 0;
                        while ($i < 99) {
                            if ($buffs[$i] != '') {
                                $tstmase = explode("@", $buffs[$i]);
                                if ($tstmase[2] and $tstmase[1] >= time() and $tstmase[0] != $it['id']) { //ага, дцшная мазь, время не кончилось и не совпадает ид. пишем и поехали дальше
                                    $buff .= "$buffs[$i]|";
                                    $i++;
                                } elseif ($tstmase[1] >= time() and $tstmase[0] == $it['id']) { //время не кончилось, но совпадает с ид предмета - стопаем
                                    $stopbuff = 1;
                                    $i = 99;
                                } elseif ($tstmase[1] >= time()) { //время не кончилось, пишем бафф, увеличиваем счетчик
                                    $buff .= "$buffs[$i]|";
                                    $i++;
                                    if (!$tstmase[2]) {
                                        $regularmase++; // увеличиваем счетчик обычных мазей
                                    }
                                }
                            } elseif ($it['dd_price']) { // если бафф по порядку - пуст, но вещь из ДЦ, применяем
                                $buff .= "$it[id]@" . (time() + ($it['effect'] * 60)) . ($it['dd_price'] ? '@1' : '') . "|";
                                $i = 99;
                                //echo 'DD mase '.$it['dd_price'];
                            } elseif ($regularmase <= 4) { // если счетчик баффов не перевалил за 5
                                $buff .= "$it[id]@" . (time() + ($it['effect'] * 60)) . "|";
                                $i = 99;
                            } else {// если уж ничего не подошло - значит обломинго, применено максимум обычных мазей
                                $stopbuff = 2;
                                $i = 99;
                            }
                        }
                        if ($stopbuff == 0) {
                            $msg[msg] = "<b><font class=nickname><font color=#cc0000>Вы удачно применили \"$msg[0]\"!</font></font></b><br>";
                            mysqli_query($GLOBALS['db_link'], "UPDATE user SET masebonus='$buff' WHERE login='$login'");
                            //mysqli_query($GLOBALS['db_link'],"INSERT INTO `effects` (`uid`,`eff_id`,`effects`,`side_effects`,`time`,`side_time`) VALUES ('".$pl['id']."','".$it['eff_id']."','".$it['effects']."','".$it['side_effects']."','".($it['eftime']+time())."','".(($it['efside_time']>0)?$it['efside_time']+time():'0')."');");
                            calcstat($pl[id]);
                            if ($user['login'] != $login) {
                                $ms = "parent.frames['chmain'].add_msg('<font class=chattime>&nbsp;" . date("H:i:s") . "&nbsp;</font> <font color=000000><b><font color=#cc0000>Внимание!</font></b> &nbsp;Персонаж <b>$user[login]</b>  применил к вам <b>\"$it[name]\".</b></font><BR>'+'');";
                                chmsg($ms, $login);
                            }
                            it_break($id);
                        } elseif ($stopbuff == 1) {
                            $msg[msg] = "Эффект такого типа может быть наложен только 1 раз.";
                        } elseif ($stopbuff == 2) {
                            $msg[msg] = "Достигнут максимальный уровень использованных мазей.";
                        }
                    } elseif ($stopbuff == 1) {
                        $msg[msg] = "Персонаж не подходит по требованиям мази.";
                    } elseif ($stopbuff == 2) {
                        $msg[msg] = "Персонаж уже имеет иммунитет от чего-либо. Одновременно можно иметь только 1 иммунитет.";
                    }

                }
                if ($masscalc == 1) {
                    $allusers = mysqli_query($GLOBALS['db_link'], "SELECT user.id,user.loc,user.pos FROM user WHERE loc='" . $player['loc'] . "' AND pos='" . $player['pos'] . "' AND type<>3;");
                    while ($row = mysqli_fetch_assoc($allusers)) {
                        calcstat($row['id']);
                    }
                }
            }
        }
    return $msg;
}

    //Раставление по карте:
    //Place = Id карты боя
    //uId1 = ID-шники персонажей первой команды
    //uId1 = ID-шники персонажей второй команды

function SetMap($Place, $uId1, $uId2)
{
        // Выбераем карту.
    $bplace = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM `battle_places` WHERE `id`='" . $Place . "'"));
        // Расставляем первую команду
    $tmp1 = explode("|", $uId1);
    $T1_count = count($tmp1);
    $xf = 4 - intval($T1_count / 5);
    $yf = floor(5 / 2) - 1;
    foreach ($tmp1 as $tmp) {
        while (substr_count($bplace["xy"], "|" . $xf . "_" . $yf . "|") and $xf > 0) {
            $yf++;
            if ($yf % 5 == 0) {
                $yf = 0;
                $xf--;
            }
        }
        $bplace["xy"] .= $xf . "_" . $yf . "|";
        mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `pos_fight`='" . $xf . "_" . $yf . "' WHERE `id`='" . $tmp . "'");
    }
        // Расставляем вторую команду
    $tmp2 = explode("|", $uId2);
    $T2_count = count($tmp2);
    $xf = 15 - (4 - intval($T2_count / 5));
    $yf = floor(5 / 2) - 1;
    foreach ($tmp2 as $tmp) {
        while (substr_count($bplace["xy"], "|" . $xf . "_" . $yf . "|") and $xf < 15) {
            $yf++;
            if ($yf % 5 == 0) {
                $yf = 0;
                $xf++;
            }
        }
        $bplace["xy"] .= $xf . "_" . $yf . "|";
        mysqli_query($GLOBALS['db_link'], "UPDATE `user` SET `pos_fight`='" . $xf . "_" . $yf . "' WHERE `id`='" . $tmp . "'");
    }
}

function lr($lr)
{
    $b = $lr % 100;
    $s = intval(($lr % 10000) / 100);
    $g = intval($lr / 10000);
        return (($g) ? $g . ' <img src=/img/image/gold.png width=14 height=14 valign=middle title=Золото>  ' : '') . (($s) ? $s . ' <img src=/img/image/silver.png width=14 height=14 valign=middle title=Серебро> ' : '') . (($b) ? $b . ' <img src=/img/image/bronze.png width=14 height=14 valign=middle title=Бронза> ' : '');
}

function birthday($birthdayDate, $getYears = false, $text = false)
{
    $birthday = explode(".", $birthdayDate);
    $sec_birthday = mktime(0, 0, 0, $birthday[1], $birthday[0], $birthday[2]);
        // Сегодняшняя дата
    $sec_now = time();
        // Подсчитываем количество месяцев, лет
    for ($time = $sec_birthday, $month = 0;
         $time < $sec_now;
         $time = $time + date('t', $time) * 86400, $month++) {
        $rtime = $time;
    }
    $month = $month - 1;
        // Количество лет
    $year = intval($month / 12);
        // Количество месяцев
    $month = $month % 12;
        // Количество дней
    $day = intval(($sec_now - $rtime) / 86400);
        $result = declination($year, "год", "года", "лет");
    if ($getYears == true) {
        return $year;
    }
    if ($month == 0 and $day == 0) {
            return $text ? '<b><font color="red">День родженья</b></font> (' . declination($year, "год", "года", "лет") . ")" : $year;
        }
        return $text ? $birthdayDate . " (" . declination($year, "год", "года", "лет") . ")" : false;
}

function declination($num, $one, $ed, $mn, $notnumber = false)
{
    if ($num === "") print "";
    if (($num == "0") or (($num >= "5") and ($num <= "20")) or preg_match("|[056789]$|", $num))
        if (!$notnumber)
            return "$num $mn";
        else
            return $mn;
    if (preg_match("|[1]$|", $num))
        if (!$notnumber)
            return "$num $one";
        else
            return $one;
    if (preg_match("|[234]$|", $num))
        if (!$notnumber)
            return "$num $ed";
        else
            return $ed;
}
