<?php
require('kernel/before.php');
require_once($_SERVER["DOCUMENT_ROOT"]."/includes/sql_func.php");
if (!userHasPermission(1)){
	header('Location: index.php');
	die();
}

// ���� ���� ������ ������ "���������" 
if($_POST['submit']) { 
$SQL = mysql_query("SELECT `email` FROM `user` WHERE `id`>'9999'");
while($row = mysql_fetch_assoc($SQL)){
	// $_POST['title'] �������� ������ �� ���� "����", trim() - ������� ��� ������ ������� � �������� �����, htmlspecialchars() - ����������� ����������� ������� � HTML ��������, ����� ������� ��� ����, ����� ���������� ������� �������� ��� ���� ����������, �� �  substr($_POST['title'], 0, 1000) - ������� ����� �� 1000 ��������. ��� ���������� $_POST['mess'] ��� ���������� 
	$title = substr(htmlspecialchars(trim($_POST['title'])), 0, 1000); 
	$mess =  substr(htmlspecialchars(trim($_POST['mess'])), 0, 1000000); 
	// �������, ������� ���������� ���� ������. 
	send_mail($row['email'], $title, $mess, 'From:noreply@legendbattles.ru'); 
	echo '�������! ���� ������ ����������.'; 
}
} 
?> 
<form action="" method=post> 
 
              <div align="center"> 
              Te��<br /> 
              <input type="text" name="title" size="40"><br /> 
              ���������<br /> 
              <textarea name="mess" rows="10" cols="40"></textarea> 
              <br /> 
              <input type="submit" value="���������" name="submit"></div> 
</form>


<? require('kernel/after.php'); ?>