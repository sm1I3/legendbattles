<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_ability_id']) && $_GET['delete_ability_id']!='' && is_numeric($_GET['delete_ability_id'])) {
    $ability_id = (int)$_GET['delete_ability_id'];
    mysql_query('delete from ability_list where ability_id = '.intval($ability_id));
    header('Location: ability_list.php');
}

$abilities = '';
$res = mysql_query('select * from ability_list', $db); 
while ($row = mysql_fetch_assoc($res))
{
    $abilities .= '
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Вы уверены что хотите удалить это умение?\');" href="ability_list.php?delete_ability_id='.$row['ability_id'].'" title="Удалить умение"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="ability_edit.php?ability_id='.$row['ability_id'].'" title="Изменить умение"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$row['ability_id'].'</td>
      <td align="left" class="cms_middle"><a href="ability_edit.php?ability_id='.$row['ability_id'].'" title="Изменить умение">'._htext($row['ability_name']).'</a></td>
    </tr>
    ';
}

?>
<h3>Список умений</h3>
<div class="cms_ind">
<br />
Умения: <br />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
<tr >
  <td class="cms_cap2 normal"> Удалить </td>
  <td class="cms_cap2 normal"> Изменить </td>

  <td class="cms_cap2">ID Умения</td>
  <td class="cms_cap2">Название умения</td>
</tr>

<?=$abilities?>

</table>
<br />
</div>
<img src="images/cms_icons/cms_add.gif" alt="Добавить умение" /><a href="ability_edit.php" title="Добавить умение">Добавить умение</a> &nbsp;<br />
<br />
<? require('kernel/after.php'); ?>