<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_user_id']) && $_GET['delete_user_id']!='') 
{
    $user_id = (int)$_GET['delete_user_id'];
    mysql_query('UPDATE user SET permissions = \'0\' WHERE user_id = '.intval($user_id));
    header('Location: user_list.php');
}

$users = '';
$res = mysql_query('select * from user WHERE permissions > 0'); 
while ($row = mysql_fetch_assoc($res))
{
    $users .= '
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Вы действительно хотите удалить этого пользователя?\');" href="user_list.php?delete_user_id='.$row['id'].'" title="Удалить пользователя"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="user_edit.php?user_id='.$row['id'].'" title="Редактировать пользователя"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$row['id'].'</td>
      <td align="left" class="cms_middle"><a href="user_edit.php?user_id='.$row['id'].'" title="Редактировать пользователя">'._htext($row['login']).'</a></td>
    </tr>
    ';
}

?>
<h3>Список пользователей</h3>
<div class="cms_ind">
<br />
Пользователи: <br />
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
      <td class="cms_cap2 normal"> Удалить </td>
      <td class="cms_cap2 normal"> Изменить </td>

      <td class="cms_cap2">ID Пользователя</td>
      <td class="cms_cap2">Логин</td>
    </tr>
    
    <?=$users?>
    
    </table>
    <br />
 </div>
 <img src="images/cms_icons/cms_add.gif" alt="Добавить пользователя" /><a href="user_edit.php" title="Добавить пользователя">Добавить пользователя</a> &nbsp;<br />
 <br />

<? require('kernel/after.php'); ?>