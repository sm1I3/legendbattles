<?php
require('kernel/before.php');

if (!userHasPermission(131072)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_quest_group_id']) && $_GET['delete_quest_group_id']!='' && is_numeric($_GET['delete_quest_group_id'])) 
{
    $quest_group_id = (int)$_GET['delete_quest_group_id'];
    mysql_query('delete from quest_groups where quest_group_id = '.intval($quest_group_id));
    header('Location: quest_groups.php');
}

$categories = '';
$res = mysql_query('select * from quest_groups'); 
while ($row = mysql_fetch_assoc($res))
{
    $categories .= '
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Вы уверены что хотите удалить эту категорию?\');" href="quest_group_list.php?delete_quest_group_id=' . $row['quest_group_id'] . '" title="Удалить категорию"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="quest_group_list.php?quest_group_id=' . $row['quest_group_id'] . '" title="Изменить категорию"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$row['quest_group_id'].'</td>
      <td class="cms_middle"><a href="quest_group_list.php?quest_group_id=' . $row['quest_group_id'] . '" title="Изменить категорию">' . _htext($row['quest_group_name']) . '</a></td>
    </tr>
    ';
}

?>
    <h3>Категории квестов</h3>
<div class="cms_ind">
<br />
    Категории квестов: <br/>
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
        <td class="cms_cap2 normal"> Удалить</td>
        <td class="cms_cap2 normal"> Изменить</td>

        <td class="cms_cap2">ID Категории</td>
        <td class="cms_cap2">Название категории</td>
    </tr>
    
    <?=$categories?>
    
    </table>
    <br />
 </div>
    <img src="images/cms_icons/cms_add.gif" alt="Добавить категорию"/><a href="quest_group_edit.php"
                                                                         title="Добавить категорию">Добавить
    категорию</a> &nbsp;<br/>
 <br />

<? require('kernel/after.php'); ?>