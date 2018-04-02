<?php
require('kernel/before.php');

if (!userHasPermission(2)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_bot_template_id']) && $_GET['delete_bot_template_id']!='') 
{
    $bot_template_id = $_GET['delete_bot_template_id'];
    mysqli_query($GLOBALS['db_link'], 'delete from e_players_bots_templates where bot_template_id = ' . intval($bot_template_id) . '');
    header('Location: bot_template_list.php');
}

$bot_templates = '';
$res = mysqli_query($GLOBALS['db_link'], 'select * from e_players_bots_templates');
while ($row = mysqli_fetch_assoc($res))
{
    $bot_templates .= '
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Вы уверены что хотите удалить этот шаблон?\');" href="bot_template_list.php?delete_bot_template_id=' . $row['bot_template_id'] . '" title="Удалить шаблон"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="bot_template_edit.php?bot_template_id=' . $row['bot_template_id'] . '" title="Изменить шаблон"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$row['bot_template_id'].'</td>
      <td align="left" class="cms_middle"><a href="bot_template_edit.php?bot_template_id=' . $row['bot_template_id'] . '" title="Изменить шаблон">' . _htext($row['nickname']) . '</a></td>
    </tr>
    ';
}

?>
    <h3>Список шаблонов ботов</h3>
<div class="cms_ind">
<br />
    Шаблоны ботов: <br/>
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
        <td class="cms_cap2 normal"> Удалить</td>
        <td class="cms_cap2 normal"> Изменить</td>

        <td class="cms_cap2">ID Шаблона</td>
        <td class="cms_cap2">Название шаблона</td>
    </tr>
    
    <?=$bot_templates?>
    
    </table>
    <br />
 </div>
    <img src="images/cms_icons/cms_add.gif" alt="Добавить шаблон"/><a href="bot_template_edit.php"
                                                                      title="Добавить шаблон">Добавить шаблон</a> &nbsp;
    <br/>
 <br />

<? require('kernel/after.php'); ?>