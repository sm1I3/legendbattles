<?php
session_start();
include_once('includes/config.inc.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
 <head>
 <link rel="stylesheet" href="./css/css.php?f=game|stl|core|introjs.min">
  <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
  <title>�������������� ������</title>

</head>
<body>

<?php

/*new web login*/

$vowels_lok = array("*", "/", ",", "<", "'", "\"", "-");

if (isset($_POST['submit'])){     
	$login = str_replace($vowels_lok, "",strip_tags($_POST['login']));
	$email = str_replace($vowels_lok, "",strip_tags($_POST['email']));
	$login=mysql_real_escape_string($login);
	$email=mysql_real_escape_string($email);
	
	if (empty($login)){
		echo "������� �����!";
	}
	elseif (empty($email)){
		echo "������� e-mail!";
	}
   else{
		$resultat = mysqli_query($GLOBALS['db_link'],"SELECT * FROM user WHERE login = '$login' AND email = '$email'");
		$array = mysqli_fetch_array($resultat);
		if (empty($array)){
			echo '������! ������ ������������ �� ����������';
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
			$title = '������������� ������ ������������ '.mysql_real_escape_string($login).' ��� ����� legendbattles.ru!';
			$headers  = "Content-type: text/plain; charset=windows-1251\r\n";
			$headers .= "������������� ����� legendbattles.ru";
			$letter = 	'�� ��������� �������������� ������ ��� �������� '.mysql_real_escape_string($login).' �� ����� legendbattles.ru  ��� ����� ������: '.mysql_real_escape_string($password);

// ���������� ������
			if (mail($email, $title, $letter, $headers)) {
			   mysqli_query($GLOBALS['db_link'],"UPDATE user SET pass = '$newmdPassword' WHERE login = '$login'  AND user.email = '$email'");
			   echo '����� ������ ��������� �� ��� e-mail!<br><a href="index.php">������� ��������</a>';
			}
		}		
	}
}
mysql_close();
?>

<table>
 
      <form method="POST">
      <tr>
      <td>�����:</td>
      <td><input type="text" size="20" name="login" ></td>
      </tr>
      <tr>
      <td>E-mail:</td>
      <td><input type="text" size="20" name="email"></td>
      </tr>
      <tr>
       <td></td>
      <td colspan="2"><input type="submit" value="������������ ������" name="submit" ></td>
      </tr>
     <br>
      </form>
</table>
</body>
</html>
 