<?php
$BotGroup = array(
    "1" => array(" (`id`>='1597' AND `id`<='1597')", " Тест"),
    "2" => array("(`id`>='410' AND `id`<='414') ", " Зомби 10-14"),
    "3" => array("(`id`>='412' AND `id`<='414')", " Зомби 12-14"),
    "4" => array("(`id`>='511' AND `id`<='513') OR (`id`>='411' AND `id`<='413')", "Рогач 11-13, Зомби 11-13"),
    "5" => array("(`id`>='512' AND `id`<='514') OR (`id`>='412' AND `id`<='414')", "Рогач 12-14, Зомби 12-14"),
    "6" => array("(`id`>='509' AND `id`<='512') OR (`id`>='409' AND `id`<='412')", "Рогач 9-12, Зомби 9-12"),
    "7" => array("(`id`>='510' AND `id`<='513') OR (`id`>='409' AND `id`<='412')", "Рогач 10-13, Зомби 9-12"),
    "8" => array("(`id`>='1' AND `id`<='11')", "Крысы 0-10"),
    "9" => array("(`id`>='514' AND `id`<='515') OR `id`='414'", "Рогач 14-15, Зомби 14"),
    "10" => array("(`id`>='511' AND `id`<='514') OR (`id`>='410' AND `id`<='413') OR (`id`>='109' AND `id`<='112')", "Рогач 11-14, Зомби 10-13, Кабаны 9-12"),
## 11 (delete)
    "11" => array("(`id`>='510' AND `id`<='513') OR (`id`>='409' AND `id`<='412')", "Рогач 10-13, Зомби 9-12"),
    "12" => array("(`id`>='507' AND `id`<='509') OR (`id`>='407' AND `id`<='409') OR (`id`>='109' AND `id`<='110')", "Рогач 7-9, Зомби 7-9, Кабаны 9-10"),
## 13,14,15 delete
    "13" => array("(`id`>='510' AND `id`<='513') OR (`id`>='409' AND `id`<='412')", "Рогач 10-13, Зомби 9-12"),
    "14" => array("(`id`>='510' AND `id`<='513') OR (`id`>='409' AND `id`<='412')", "Рогач 10-13, Зомби 9-12"),
    "15" => array("(`id`>='510' AND `id`<='513') OR (`id`>='409' AND `id`<='412')", "Рогач 10-13, Зомби 9-12"),
    "16" => array("(`id`>='512' AND `id`<='515') OR (`id`>='411' AND `id`<='414') OR (`id`>='110' AND `id`<='112')", "Рогач 12-15, Зомби 11-14, Кабаны 10-12"),
    "17" => array("(`id`>='508' AND `id`<='512') OR (`id`>='407' AND `id`<='411')", "Рогач 8-12, Зомби 7-11"),
    "18" => array("(`id`>='505' AND `id`<='509') OR (`id`>='404' AND `id`<='408') OR (`id`>='106' AND `id`<='111')", "Рогач 5-9, Зомби 4-8, Кабаны 6-11"),
    "19" => array("(`id`>='507' AND `id`<='511') OR (`id`>='406' AND `id`<='410')", "Рогач 7-11, Зомби 6-10"),
    "20" => array("(`id`>='504' AND `id`<='508') OR (`id`>='403' AND `id`<='407')", "Рогач 4-8, Зомби 3-7"),
    "21" => array("(`id`>='500' AND `id`<='503') OR (`id`>='400' AND `id`<='403') OR (`id`>='1' AND `id`<='8')", "Рогач 0-3, Зомби 0-3, Крысы 0-7"),
    "22" => array("(`id`>='503' AND `id`<='506') OR (`id`>='403' AND `id`<='406') ", "Рогач 3-6, Зомби 3-6"),
    "23" => array("(`id`>='504' AND `id`<='507') OR (`id`>='404' AND `id`<='407') OR (`id`>='4' AND `id`<='11')", "Рогач 4-7, Зомби 4-7, Крысы 3-10"),
    "24" => array("(`id`>='505' AND `id`<='508') OR (`id`>='405' AND `id`<='408') OR (`id`>='4' AND `id`<='11')", "Рогач 5-8, Зомби 5-8, Крысы 3-10"),
    "25" => array("(`id`>='506' AND `id`<='510') OR (`id`>='406' AND `id`<='410')", "Рогач 6-10, Зомби 6-10"),
    "26" => array("(`id`>='509' AND `id`<='513') OR (`id`>='409' AND `id`<='413') OR (`id`>='10' AND `id`<='11')", "Рогач 9-13, Зомби 9-13, Крысы 9-10"),
//  крит             уворот
// Рогач 10-13 = 5; Зомби 9 - 12 =6
    "27" => array("(`id`>='510' AND `id`<='513') OR (`id`>='409' AND `id`<='412')", "Рогач 10-13, Зомби 9-12"),
    "28" => array("(`id`>='510' AND `id`<='513') OR (`id`>='409' AND `id`<='412')", "Рогач 10-13, Зомби 9-12"),
    "29" => array("(`id`>='510' AND `id`<='513') OR (`id`>='409' AND `id`<='412')", "Рогач 10-13, Зомби 9-12"),
    "30" => array("(`id`>='510' AND `id`<='513') OR (`id`>='409' AND `id`<='412')", "Рогач 10-13, Зомби 9-12"),
    "31" => array("(`id`>='510' AND `id`<='513') OR (`id`>='409' AND `id`<='412')", "Рогач 10-13, Зомби 9-12"),
    "32" => array("(`id`>='510' AND `id`<='513') OR (`id`>='409' AND `id`<='412')", "Рогач 10-13, Зомби 9-12"),
    "33" => array("(`id`>='403' AND `id`<='407') OR (`id`>='108' AND `id`<='109')", "Кабаны 8-9, Зомби 3-7"),
    "34" => array("(`id`>='403' AND `id`<='407') OR (`id`>='9' AND `id`<='10')", "Крысы 8-9, Зомби 3-7"),
    "35" => array("(`id`>='403' AND `id`<='407') OR (`id`>='105' AND `id`<='107')", "Кабаны 5-7, Зомби 3-7"),
    "36" => array("(`id`>='403' AND `id`<='407') OR (`id`>='6' AND `id`<='8')", "Крысы 5-7, Зомби 3-7"),

// пауки 1-3 = 1; 4-5 = 2;
// яд пауки = 6-8 = 3; 9-10 = 4;
    "37" => array("(`id`>='201' AND `id`<='205') OR (`id`>='306' AND `id`<='307')", "Пауки 1-5, Ядовитые пауки 5-7"),
    /*"36"=>array("(`id`>='201' AND `id`<='205') OR (`id`>='306' AND `id`<='310') OR (`id`>='607' AND `id`<='610') OR (`id`>='711' AND `id`<='715') ","Пауки 1-5, Яд. пауки 6-10, Скелеты 7-10, Скелет-в. 11-15"),*/

    /*
    "номер группы желательно меньше 100"=>array(" sql запрос ","название для отображения на карте","група используеться только для боссов"),

    */
    "38" => array("`id`='8000'", "Гоблин 16"),

//новогодний бот
    "39" => array("`id`='8001'", "Снеговик 15"),
    "40" => array("`id`='8002'", "Снеговик-Вася 20"),
    "41" => array("`id`='8003'", "Белый медведь 22"),
    "42" => array("`id`='8010'", "Гоблин Мститель 20"),
    "43" => array("`id`='8025'", "Бальтазар 20"),
    "44" => array("`id`='8060'", "Купидон 10"),
    "45" => array("`id`='8061'", "Купидон 13"),
    "46" => array("`id`='8062'", "Купидон 16"),
    "47" => array("`id`='8063'", "Купидон 20"),
//
    "100" => array("`id`='9000' OR `id`='9900'", "Золотой Дракон", "GOLDEN"));

$BotsTypes = array(
    1 => array(8, 18, 20, 21, 22, 35),// легкие
    2 => array(1, 4, 5, 6, 7, 10, 12, 17, 19, 23, 24, 25, 26, 27, 30, 31, 32),// средние
    3 => array(2, 3, 9, 11, 13, 14, 15, 16, 28, 29, 33, 34, 36, 38),//тяжолые
    4 => array(39),//праздничные
    5 => array(100)// босы
);
