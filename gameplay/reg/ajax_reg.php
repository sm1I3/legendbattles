<?php
session_start();
include($_SERVER["DOCUMENT_ROOT"] . "/includes/config.php");
include($_SERVER["DOCUMENT_ROOT"] . "/includes/functions.php");
header('Content-type: text/html; charset=utf-8');

if (!empty($_POST)) {
    // Фильтруем логин
    $_POST["reg-user"] = addslashes(trim((iconv("UTF-8", "utf-8", urldecode($_POST["reg-user"])) ? iconv("UTF-8", "utf-8", urldecode($_POST["reg-user"])) : urldecode($_POST["reg-user"]))));
    // Делаем проверки
    if (empty($_POST["reg-user"]) or strlen($_POST["reg-user"]) < 4 or strlen($_POST["reg-user"]) > 21) {
        exit('ERR@1');// Неверная длина логина
    }
    if (testchr($_POST["reg-user"])) {
        exit('ERR@2'); // Существует неверные символы
    }
    if (GetUser($_POST["reg-user"])) {
        exit('ERR@3'); // Пользователь уже зарегистрирован
    }
    preg_match("~^([a-z0-9_\-\.])+@([a-z0-9_\-\.])+\.([a-z0-9])+$~i", $_POST['reg-email']) or die('ERR@4'); // Неверный E-Mail
    preg_match("/^([0-2][0-9]|[3][0-1]).([0][0-9]|[1][0-2]).[0-9]{4}$/", $_POST['reg-bday']) or die('ERR@5'); // НДР
    if ($_POST['reg-sexuser'] != 'male' and $_POST['reg-sexuser'] != 'female') { // Иди в лес бесполое существо ;)
        exit('ERR@6');
    }
    // Если все нормально то уже регистрируем персонажа
    $UserPassword = generate_password(rand(6, 8));
    $val_bdate = varcheck($_POST['reg-bday']);
    // Шлем мыло
    send_mail($_POST['reg-email'], 'Регистрация нового пользователя', 'Здравствуйте, ' . $_POST['reg-user'] . '!<br><br>Вы успешно зарегистрировались в проекте Legend Battles.<br />Вот ваши игровые данные:<br />Логин: <b>' . $_POST['reg-user'] . '</b><br />Пароль: <b>' . $UserPassword . '</b><br /><br /><br />С наилучшими пожеланиями,<br />Администрация игры Legend Battles.<br />www.LegendBattles.ru<br /><br />');
    // Выполняем запросы в базу
    mysqli_query($GLOBALS['db_link'], "INSERT INTO `user` (`login`,`pass`,`email`,`bday`,`sex`,`thotem`,`bdaypers`,`obraz`,`ip`) VALUES ('" . $_POST['reg-user'] . "','" . md5($UserPassword) . "','" . $_POST['reg-email'] . "','" . $val_bdate . "','" . $_POST['reg-sexuser'] . "','" . rand(0, 11) . "','" . time() . "','" . $_POST['reg-sexuser'] . ".gif" . "','" . getIP() . "')");
    // Если есть рефералы работаем дальше ->>>>
    if ($_SESSION['referal_id'] and $_SESSION['referal']) {
        $ReferalID = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT `id`,`login` FROM `user` WHERE `id`='" . mysqli_insert_id($GLOBALS['db_link']) . "' LIMIT 1;"));
        mysqli_query($GLOBALS['db_link'], "INSERT INTO `ref_system` (`who_id`,`who_login`,`ref_id`,`ref_login`,`time`) VALUES ('" . $_SESSION['referal_id'] . "','" . $_SESSION['referal'] . "','" . $ReferalID['id'] . "','" . $ReferalID['login'] . "','" . time() . "');");
    }
    // Говорим что все ок, и завершаем регу
    exit('OK@' . $UserPassword);
}