<?php
require('kernel/before.php');

if (!userHasPermission(128)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_bot_template_id']) && $_GET['delete_bot_template_id']!='') 
{
    $bot_template_id = $_GET['delete_bot_template_id'];
    $level = $_GET['level'];
    mysql_query('delete from e_players_bots_slots where bot_template_id = '.intval($bot_template_id).' and level = '.intval($level));
    header('Location: bot_slots_list.php');
}

$bot_templates = array();
$res = mysql_query('select * from e_players_bots_templates'); 
while ($row = mysql_fetch_assoc($res))
    $bot_templates[$row['bot_template_id']] = $row['nickname'];

$bot_slots = '';
$res = mysql_query('select * from e_players_bots_slots'); 
while ($row = mysql_fetch_assoc($res))
{
    $bot_slots .= '
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Вы уверены что хотите удалить эти слоты?\');" href="bot_slots_list.php?delete_bot_template_id=' . $row['bot_template_id'] . '&level=' . $row['level'] . '" title="Удалить шаблон"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="bot_slots_edit.php?bot_template_id=' . $row['bot_template_id'] . '&level=' . $row['level'] . '" title="Изменить шаблон"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="bot_slots_edit.php?copy_bot_template_id=' . $row['bot_template_id'] . '&level=' . $row['level'] . '" title="Клонировать шаблон"><img src="images/cms_icons/cms_add.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$bot_templates[$row['bot_template_id']].'</td>
      <td align="left" class="cms_middle">'.$row['level'].'</td>
    </tr>
    ';
}

?>
    <h3>Список слотов ботов</h3>
<div class="cms_ind">
<br />
    Слоты ботов: <br/>
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
        <td class="cms_cap2 normal"> Удалить</td>
        <td class="cms_cap2 normal"> Изменить</td>
        <td class="cms_cap2 normal"> Клонировать</td>

        <td class="cms_cap2">ID Шаблона</td>
        <td class="cms_cap2">Уровень бота</td>
    </tr>
    
    <?=$bot_slots?>
    
    </table>
    <br />
 </div>
    <img src="images/cms_icons/cms_add.gif" alt="Добавить столы"/><a href="bot_slots_edit.php" title="Добавить столы">Добавить
    столы</a> &nbsp;<br/>
 <br />

<? require('kernel/after.php'); ?>