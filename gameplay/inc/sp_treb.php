<?php
if ($treb[0] == 72) {
    $treb[1] = $ITEM[level];
}
if ($treb[0] == 71) {
    $treb[1] = $ITEM[massa];
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
        $bt += 1;
    }
}
if ($treb[0] == 74) {
    $trtmp = $treb[1];
    $treb[1] = $treb[1];
    if ($player['vzlomshik_nav'] < $trtmp) {
        $treb[1] = "<font color=#cc0000>" . $treb[1] . "</font>";
        $bt += 1;
    }
}
if ($treb[0] != 28 and $treb[0] != 71 and $treb[0] != 73 and $treb[0] != 74) {
    if ($plstt[$treb[0]] < $treb[1]) {
        $treb[1] = "<font color=#cc0000>$treb[1]</font>";
        $bt += 1;
    }
}
switch ($treb[0]) {
    case 28:
        $tr_b .= "&nbsp;Очки действия: <b>$treb[1]</b><br>";
        break;
    case 30:
        $tr_b .= "&nbsp;Cила: <b>$treb[1]</b><br>";
        break;
    case 31:
        $tr_b .= "&nbsp;Ловкость: <b>$treb[1]</b><br>";
        break;
    case 32:
        $tr_b .= "&nbsp;Удача: <b>$treb[1]</b><br>";
        break;
    case 33:
        $tr_b .= "&nbsp;Здоровье: <b>$treb[1]</b><br>";
        break;
    case 34:
        $tr_b .= "&nbsp;Знания: <b>$treb[1]</b><br>";
        break;
    case 35:
        $tr_b .= "&nbsp;Сноровка: <b>$treb[1]</b><br>";
        break;
    case 36:
        $tr_b .= "&nbsp;Владение мечами: <b>$treb[1]</b><br>";
        break;
    case 37:
        $tr_b .= "&nbsp;Владение топорами: <b>$treb[1]</b><br>";
        break;
    case 38:
        $tr_b .= "&nbsp;Владение дробящим оружием: <b>$treb[1]</b><br>";
        break;
    case 39:
        $tr_b .= "&nbsp;Владение ножами: <b>$treb[1]</b><br>";
        break;
    case 40:
        $tr_b .= "&nbsp;Владение метательным оружием: <b>$treb[1]</b><br>";
        break;
    case 41:
        $tr_b .= "&nbsp;Владение алебардами и копьями: <b>$treb[1]</b><br>";
        break;
    case 42:
        $tr_b .= "&nbsp;Владение посохами: <b>$treb[1]</b><br>";
        break;
    case 43:
        $tr_b .= "&nbsp;Владение экзотическим оружием: <b>$treb[1]</b><br>";
        break;
    case 44:
        $tr_b .= "&nbsp;Владение двуручным оружием: <b>$treb[1]</b><br>";
        break;
    case 45:
        $tr_b .= "&nbsp;Магия огня: <b>$treb[1]</b><br>";
        break;
    case 46:
        $tr_b .= "&nbsp;Магия воды: <b>$treb[1]</b><br>";
        break;
    case 47:
        $tr_b .= "&nbsp;Магия воздуха: <b>$treb[1]</b><br>";
        break;
    case 48:
        $tr_b .= "&nbsp;Магия земли: <b>$treb[1]</b><br>";
        break;
    case 53:
        $tr_b .= "&nbsp;Воровство: <b>$treb[1]</b><br>";
        break;
    case 54:
        $tr_b .= "&nbsp;Осторожность: <b>$treb[1]</b><br>";
        break;
    case 55:
        $tr_b .= "&nbsp;Скрытность: <b>$treb[1]</b><br>";
        break;
    case 56:
        $tr_b .= "&nbsp;Наблюдательность: <b>$treb[1]</b><br>";
        break;
    case 57:
        $tr_b .= "&nbsp;Торговля: <b>$treb[1]</b><br>";
        break;
    case 58:
        $tr_b .= "&nbsp;Странник: <b>$treb[1]</b><br>";
        break;
    case 59:
        $tr_b .= "&nbsp;Рыболов: <b>$treb[1]</b><br>";
        break;
    case 60:
        $tr_b .= "&nbsp;Лесоруб: <b>$treb[1]</b><br>";
        break;
    case 61:
        $tr_b .= "&nbsp;Ювелирное дело: <b>$treb[1]</b><br>";
        break;
    case 62:
        $tr_b .= "&nbsp;Самолечение: <b>$treb[1]</b><br>";
        break;
    case 63:
        $tr_b .= "&nbsp;Оружейник: <b>$treb[1]</b><br>";
        break;
    case 64:
        $tr_b .= "&nbsp;Доктор: <b>$treb[1]</b><br>";
        break;
    case 65:
        $tr_b .= "&nbsp;Самолечение: <b>$treb[1]</b><br>";
        break;
    case 66:
        $tr_b .= "&nbsp;Быстрое восстановление маны: <b>$treb[1]</b><br>";
        break;
    case 67:
        $tr_b .= "&nbsp;Лидерство: <b>$treb[1]</b><br>";
        break;
    case 68:
        $tr_b .= "&nbsp;Алхимия: <b>$treb[1]</b><br>";
        break;
    case 69:
        $tr_b .= "&nbsp;Развитие горного дела: <b>$treb[1]</b><br>";
        break;
    case 70:
        $tr_b .= "&nbsp;Травничество: <b>$treb[1]</b><br>";
        break;
    case 71:
        $tr_b .= "&nbsp;Масса: <b>$treb[1]</b><br>";
        break;
    case 72:
        $tr_b .= "&nbsp;Уровень: <b>$treb[1]</b><br>";
        break;
    case 73:
        $tr_b .= "&nbsp;Звание: <b>$treb[1]</b><br>";
        break;
    case 74:
        $tr_b .= "&nbsp;Взломщик: <b>$treb[1]</b><br>";
        break;

}
?>