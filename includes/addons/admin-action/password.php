<?php
include_once('includes/config.inc.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
 <head>
 <link rel="stylesheet" href="./css/css.php?f=game|stl|core|introjs.min">
  <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
  <title>Восстановление пароля</title>

</head>
<body>

<?php
if (isset($_POST['submit'])){     
	$login = $_POST['login'];
	$email = $_POST['email'];
	
	if (empty($login)){
		echo "Введите логин!";
	}
	elseif (empty($email)){
		echo "Введите e-mail!";
	}
   else{
		$resultat = mysqli_query($GLOBALS['db_link'],"SELECT * FROM user WHERE login = '$login' AND email = '$email'");
		$array = mysqli_fetch_array($resultat);
		if (empty($array)){
			echo 'Ошибка! Такого пользователя не существует';
		}
		elseif (mysqli_num_rows($resultat) > 0){
			$chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP"; 
			$max=10; 
			$size=StrLen($chars)-1; 
			$password=null; 
			
			while($max--){
			$password.=$chars[rand(0,$size)]; 
			}
			$newmdPassword = md5($password); 
			$title = 'Востановления пароля пользователю '.$login.' для сайта legendbattles.ru!';
			$headers  = "Content-type: text/plain; charset=windows-1251\r\n";
			$headers .= "Администрация сайта legendbattles.ru";
			$letter = 	'Вы запросили восстановление пароля для аккаунта '.$login.' на сайте legendbattles.ru  Ваш новый пароль: '.$password;

// Отправляем письмо
			if (mail($email, $title, $letter, $headers)) {
			   mysqli_query($GLOBALS['db_link'],"UPDATE user SET pass = '$newmdPassword' WHERE login = '$login'  AND user.email = '$email'");
			   echo 'Новый пароль отправлен на ваш e-mail!<br><a href="index.php">Главная страница</a>';
			}
		}		
	}
}
mysql_close();
?>

<table>
 
      <form method="POST">
      <tr>
      <td>Логин:</td>
      <td><input type="text" size="20" name="login" ></td>
      </tr>
      <tr>
      <td>E-mail:</td>
      <td><input type="text" size="20" name="email"></td>
      </tr>
      <tr>
       <td></td>
      <td colspan="2"><input type="submit" value="Восстановить пароль" name="submit" ></td>
      </tr>
     <br>
      </form>
</table>
</body>
</html>
 