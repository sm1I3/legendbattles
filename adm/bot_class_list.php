<?php
require('kernel/before.php');

if (!userHasPermission(512)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_bot_class_id']) && $_GET['delete_bot_class_id']!='') {
    $bot_class_id = $_GET['delete_bot_template_id'];
    mysql_query('delete from bots_classes where bot_class_id = '.intval($bot_class_id).'');
    header('Location: bot_class_list.php');
}

$bot_classes = '';
$res = mysql_query('select * from bots_classes'); 
while ($row = mysql_fetch_assoc($res))
{
    $bot_classes .= '
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Вы уверены что хотите удалить этот класс?\');" href="bot_class_list.php?delete_bot_class_id='.$row['bot_class_id'].'" title="Удалить шаблон"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="bot_class_edit.php?bot_class_id='.$row['bot_class_id'].'" title="Изменить класс"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$row['bot_class_id'].'</td>
      <td align="left" class="cms_middle"><a href="bot_class_edit.php?bot_class_id='.$row['bot_class_id'].'" title="Изменить класс">'._htext($row['nickname']).'</a></td>
    </tr>
    ';
}

?>
<h3>Список классов ботов</h3>
<div class="cms_ind">
<br />
Классы ботов: <br />
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
      <td class="cms_cap2 normal"> Удалить </td>
      <td class="cms_cap2 normal"> Изменить </td>

      <td class="cms_cap2">ID Класса</td>
      <td class="cms_cap2">Название класса</td>
    </tr>
    
    <?=$bot_classes?>
    
    </table>
    <br />
 </div>
 <img src="images/cms_icons/cms_add.gif" alt="Добавить класс" /><a href="bot_class_edit.php" title="Добавить класс">Добавить класс</a> &nbsp;<br />
 <br />

<? require('kernel/after.php'); ?>