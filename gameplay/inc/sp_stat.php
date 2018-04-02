<?php
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
    $modstroke = "" . ($modstat[1] != '' ? ($pr[0] + $pri[0]) . "-" . ($pr[1] + $pri[1]) . "$percent  </b>[" . ($modstat[1] > 0 ? "<font color=green> <b>" . $modstat[1] . "</b>$percent" : "<font color=red><b>" . $modstat[1] . "</b>$percent") . "</font></b> ]<b> " : "$stat[1]$percent") . "";
} else {
    $modstroke = "" . ($modstat[$stat[0]] != '' ? $stat[1] + $modstat[$stat[0]] . "$percent  </b>[" . ($modstat[$stat[0]] > 0 ? "<font color=green>+<b>" . $modstat[$stat[0]] . "</b>$percent" : "<font color=red><b>" . $modstat[$stat[0]] . "</b>$percent") . "</font></b> ]<b> " : "$stat[1]$percent") . "";
}
switch ($stat[0]) {
    //case 0: echo "&nbsp;Гравировка: <b>".$modstroke."</b><br>"; break;
    case 1:
        echo "&nbsp;Удар: <b>" . $modstroke . "</b><br>";
        break;
    case 2:
        echo "&nbsp;Долговечность: <b>" . (($iz == 1 and $ITEM['slot'] != 5) ? "<font color=red>" . $iz . "</font>" : $iz) . "/$ITEM[dolg]</b><br>";
        break;
    case 3:
        echo "&nbsp;Карманов: <b>" . $modstroke . "</b><br>";
        break;
    case 4:
        echo "&nbsp;Описания: <b>" . $modstroke . "</b><br>";
        break;
    case 5:
        echo "&nbsp;Уловка: $plus<b>" . $modstroke . "</b><br>";
        break;
    case 6:
        echo "&nbsp;Точность: $plus<b>" . $modstroke . "</b><br>";
        break;
    case 7:
        echo "&nbsp;Сокрушение: $plus<b>" . $modstroke . "</b><br>";
        break;
    case 8:
        echo "&nbsp;Стойкость: $plus<b>" . $modstroke . "</b><br>";
        break;
    case 9:
        echo "&nbsp;Класс брони: <b>" . $modstroke . "</b><br>";
        break;
    case 10:
        echo "&nbsp;Пробой брони: $plus<b>" . $modstroke . "</b><br>";
        break;
    case 11:
        echo "&nbsp;Пробой колющим ударом: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 12:
        echo "&nbsp;Пробой режущим ударом: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 13:
        echo "&nbsp;Пробой проникающим ударом: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 14:
        echo "&nbsp;Пробой пробивающим ударом: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 15:
        echo "&nbsp;Пробой рубящим ударом: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 16:
        echo "&nbsp;Пробой карающим ударом: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 17:
        echo "&nbsp;Пробой отсекающим ударом: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 18:
        echo "&nbsp;Пробой дробящим ударом: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 19:
        echo "&nbsp;Защита от колющих ударов: $plus<b>" . $modstroke . "</b><br>";
        break;
    case 20:
        echo "&nbsp;Защита от режущих ударов: $plus<b>" . $modstroke . "</b><br>";
        break;
    case 21:
        echo "&nbsp;Защита от проникающих ударов: $plus<b>" . $modstroke . "</b><br>";
        break;
    case 22:
        echo "&nbsp;Защита от пробивающих ударов: $plus<b>" . $modstroke . "</b><br>";
        break;
    case 23:
        echo "&nbsp;Защита от рубящих ударов: $plus<b>" . $modstroke . "</b><br>";
        break;
    case 24:
        echo "&nbsp;Защита от карающих ударов: $plus<b>" . $modstroke . "</b><br>";
        break;
    case 25:
        echo "&nbsp;Защита от отсекающих ударов: $plus<b>" . $modstroke . "</b><br>";
        break;
    case 26:
        echo "&nbsp;Защита от дробящих ударов: $plus<b>" . $modstroke . "</b><br>";
        break;
    case 27:
        echo "&nbsp;НР: $plus<b>" . $modstroke . "</b><br>";
        break;
    case 28:
        echo "&nbsp;Очки действия: $plus<b>" . $modstroke . "</b><br>";
        break;
    case 29:
        echo "&nbsp;Мана: $plus<b>" . $modstroke . "</b><br>";
        break;
    case 30:
        echo "&nbsp;Мощь: $plus<b>" . $modstroke . "</b><br>";
        break;
    case 31:
        echo "&nbsp;Проворность: $plus<b>" . $modstroke . "</b><br>";
        break;
    case 32:
        echo "&nbsp;Везение: $plus<b>" . $modstroke . "</b><br>";
        break;
    case 33:
        echo "&nbsp;Здоровье: $plus<b>" . $modstroke . "</b><br>";
        break;
    case 34:
        echo "&nbsp;Разум: $plus<b>" . $modstroke . "</b><br>";
        break;
    case 35:
        echo "&nbsp;Сноровка: $plus<b>" . $modstroke . "</b><br>";
        break;
    case 36:
        echo "&nbsp;Владение мечами: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 37:
        echo "&nbsp;Владение топорами: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 38:
        echo "&nbsp;Владение дробящим оружием: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 39:
        echo "&nbsp;Владение ножами: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 40:
        echo "&nbsp;Владение метательным оружием: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 41:
        echo "&nbsp;Владение алебардами и копьями: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 42:
        echo "&nbsp;Владение посохами: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 43:
        echo "&nbsp;Владение экзотическим оружием: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 44:
        echo "&nbsp;Владение двуручным оружием: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 45:
        echo "&nbsp;Магия огня: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 46:
        echo "&nbsp;Магия воды: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 47:
        echo "&nbsp;Магия воздуха: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 48:
        echo "&nbsp;Магия земли: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 49:
        echo "&nbsp;Сопротивление магии огня: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 50:
        echo "&nbsp;Сопротивление магии воды: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 51:
        echo "&nbsp;Сопротивление магии воздуха: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 52:
        echo "&nbsp;Сопротивление магии земли: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 53:
        echo "&nbsp;Воровство: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 54:
        echo "&nbsp;Осторожность: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 55:
        echo "&nbsp;Скрытность: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 56:
        echo "&nbsp;Наблюдательность: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 57:
        echo "&nbsp;Торговля: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 58:
        echo "&nbsp;Странник: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 59:
        echo "&nbsp;Рыболов: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 60:
        echo "&nbsp;Лесоруб: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 61:
        echo "&nbsp;Ювелирное дело: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 62:
        echo "&nbsp;Самолечение: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 63:
        echo "&nbsp;Оружейник: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 64:
        echo "&nbsp;Доктор: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 65:
        echo "&nbsp;Самолечение: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 66:
        echo "&nbsp;Быстрое восстановление маны: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 67:
        echo "&nbsp;Лидерство: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 68:
        echo "&nbsp;Алхимия: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 69:
        echo "&nbsp;Развитие горного дела: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 70:
        echo "&nbsp;Травничество: $plus<b>" . $modstroke . "%</b><br>";
        break;
    case 71:
        echo "&nbsp;<font color=#BB0000>Коэффициент: $plus<b>" . $modstroke . "%</b></font><br>";
        break;
    case 'expbonus':
        echo "&nbsp;Бонус опыта: <font color=#BB0000>$plus<b>" . $modstroke . "%</b></font><br>";
        break;
    case 'massbonus':
        echo "&nbsp;Масса: <font color=#BB0000>$plus<b>" . $modstroke . "</b></font><br>";
        break;
}
