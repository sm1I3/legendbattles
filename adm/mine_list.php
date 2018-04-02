<?php
require('kernel/before.php');

$types = array(
    1 => 'Шахта простых металлов',
    2 => 'Шахта драгоценных металлов',
);

if (!userHasPermission(32768)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_mine_code']) && $_GET['delete_mine_code']!='') {
    $mine_code = $_GET['delete_mine_code'];
    mysqli_query($GLOBALS['db_link'], 'delete from mine_res where mine_code = \'' . mysqli_real_escape_string($GLOBALS['db_link'], $mine_code) . '\'');
    mysqli_query($GLOBALS['db_link'], 'delete from mine_list where mine_code = \'' . mysqli_real_escape_string($GLOBALS['db_link'], $mine_code) . '\'');
    header('Location: mine_list.php');
}


$mines = '';
$res = mysqli_query($GLOBALS['db_link'], 'select * from mine_list');
while ($row = mysqli_fetch_assoc($res))
{
    $mines.='
    <tr>
        <td class="cms_middle" align="center"><a onclick="return confirm(\'Вы действительно хотите удалить этот лабиринт?\');" href="mine_list.php?delete_mine_code=' . $row['mine_code'] . '" title="Удалить"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
        <td class="cms_middle" align="center"><a href="mine_edit.php?mine_code=' . $row['mine_code'] . '" title="Изменить параметры"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
        <td class="cms_middle" align="center"><a href="mine_view.php?mine_code=' . $row['mine_code'] . '" title="Редактор лабиринта"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
        <td align="left" class="cms_middle">'.$row['mine_code'].'</td>
        <td align="left" class="cms_middle"><a href="mine_view.php?mine_code=' . $row['mine_code'] . '" title="Редактор лабиринта">' . _htext($row['mine_name']) . '</a></td>
        <td align="left" class="cms_middle">'.$types[$row['mine_type']].'</td>
        <td align="left" class="cms_middle">'._htext($row['levels_count']).'</td>
    </tr>
    ';
}

?>
    <h3>Список шахт</h3>
<div class="cms_ind">
<br />
    Шахты: <br/>
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
        <td class="cms_cap2 normal"> Удалить</td>
        <td class="cms_cap2 normal"> Параметры</td>
        <td class="cms_cap2 normal"> Редактор</td>

        <td class="cms_cap2">Код Шахты</td>
        <td class="cms_cap2">Название Шахты</td>
        <td class="cms_cap2">Тип Шахты</td>
        <td class="cms_cap2">Глубина</td>
    </tr>
    
    <?=$mines?>
    
    </table>
    <br />
 </div>
    <img src="images/cms_icons/cms_add.gif" alt="Добавить шахту"/><a href="mine_edit.php" title="Добавить шахту">Добавить
    шахту</a> &nbsp;<br/>
<? require('kernel/after.php'); ?>