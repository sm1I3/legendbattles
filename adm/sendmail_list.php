<?php
require('kernel/before.php');
require_once($_SERVER["DOCUMENT_ROOT"]."/includes/sql_func.php");
if (!userHasPermission(1)){
	header('Location: index.php');
	die();
}

// если была нажата кнопка "Отправить" 
if ($_POST['submit']) {
    $SQL = mysqli_query($GLOBALS['db_link'], "SELECT `email` FROM `user` WHERE `id`>'9999'");
    while ($row = mysqli_fetch_assoc($SQL)) {
    // $_POST['title'] содержит данные из поля "Тема", trim() - убираем все лишние пробелы и переносы строк, htmlspecialchars() - преобразует специальные символы в HTML сущности, будем считать для того, чтобы простейшие попытки взломать наш сайт обломались, ну и  substr($_POST['title'], 0, 1000) - урезаем текст до 1000 символов. Для переменной $_POST['mess'] все аналогично
	$title = substr(htmlspecialchars(trim($_POST['title'])), 0, 1000); 
	$mess =  substr(htmlspecialchars(trim($_POST['mess'])), 0, 1000000);
    // функция, которая отправляет наше письмо.
	send_mail($row['email'], $title, $mess, 'From:noreply@legendbattles.ru');
    echo 'Спасибо! Ваше письмо отправлено.';
}
} 
?> 
<form action="" method=post> 
 
              <div align="center">
                  Teма<br/>
                  <input type="text" name="title" size="40"><br />
                  Сообщение<br/>
                  <textarea name="mess" rows="10" cols="40"></textarea>
              <br />
                  <input type="submit" value="Отправить" name="submit"></div>
</form>


<? require('kernel/after.php'); ?>