<?php
require('kernel/before.php');

if (!userHasPermission(8)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['copy_lab_id']) && $_GET['copy_lab_id']!='' && filter_var($_GET['copy_lab_id'], FILTER_VALIDATE_INT)) 
{
    $lab_id = (int)$_GET['copy_lab_id'];
    if (!mysqli_query($GLOBALS['db_link'], '
        INSERT INTO labyrinth_list
            (labyrinth_name, date_from, date_to, opened_from, opened_to, labyrinth_params, labyrinth_serialized)
        SELECT 
            CONCAT(labyrinth_name, " (Copy)"), date_from, date_to, opened_from, opened_to, labyrinth_params, labyrinth_serialized
        FROM 
            labyrinth_list
        WHERE
            labyrinth_id = '.(int)$lab_id.'
    '))
        die(mysqli_error($GLOBALS['db_link']));
    $last_id = mysqli_insert_id($GLOBALS['db_link']);
    header('Location: labyrinth_design.php?lab_id='.$last_id); 
}

if (isset($_GET['delete_lab_id']) && $_GET['delete_lab_id']!='' && is_numeric($_GET['delete_lab_id'])) {
    $lab_id = (int)$_GET['delete_lab_id'];
    mysqli_query($GLOBALS['db_link'], 'delete from labyrinth_list where labyrinth_id = ' . (int)$lab_id . ' AND is_confirmed = \'N\'');
    header('Location: labyrinth_list.php');
}

if (isset($_GET['accept_confirm']) && $_GET['accept_confirm']!='' && is_numeric($_GET['accept_confirm']) && userHasPermission(16)) {
    $lab_id = (int)$_GET['accept_confirm'];
    mysqli_query($GLOBALS['db_link'], 'update labyrinth_list set is_confirmed = \'Y\' where labyrinth_id = ' . (int)$lab_id);
    header('Location: labyrinth_list.php');
}

if (isset($_GET['decline_confirm']) && $_GET['decline_confirm']!='' && is_numeric($_GET['decline_confirm']) && userHasPermission(16)) {
    $lab_id = (int)$_GET['decline_confirm'];
    mysqli_query($GLOBALS['db_link'], 'update labyrinth_list set is_confirmed = \'N\' where labyrinth_id = ' . (int)$lab_id);
    header('Location: labyrinth_list.php');
}

$labyrinths = '';
$res = mysqli_query($GLOBALS['db_link'], 'select * from labyrinth_list');
while ($row = mysqli_fetch_assoc($res))
{
    
    if (!userHasPermission(16))
        $confirm_str = '';
    else {
        if ($row['is_confirmed']!='Y')
            $confirm_str = ' (<a href="labyrinth_list.php?accept_confirm=' . $row['labyrinth_id'] . '">Подтвердить</a>)';
        else
            $confirm_str = ' (<a href="labyrinth_list.php?decline_confirm=' . $row['labyrinth_id'] . '">Отменить подтверждение</a>)';
    }
    
    $labyrinths.='
    <tr>
      <td class="cms_middle" align="center">' . ($row['is_confirmed'] != 'Y' ? '<a onclick="return confirm(\'Вы действительно хотите удалить этот лабиринт?\');" href="labyrinth_list.php?delete_lab_id=' . $row['labyrinth_id'] . '" title="Удалить"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a>' : '') . '</td>
      <td class="cms_middle" align="center"><a href="labyrinth_edit.php?lab_id=' . $row['labyrinth_id'] . '" title="Изменить параметры"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="labyrinth_design.php?lab_id=' . $row['labyrinth_id'] . '" title="Редактор лабиринта"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="labyrinth_list.php?copy_lab_id=' . $row['labyrinth_id'] . '" title="Копировать лабиринт"><img src="images/cms_icons/cms_add.gif" width="18" height="18" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$row['labyrinth_id'].'</td>
      <td align="center" class="cms_middle"><img src="images/cms_icons/'.($row['is_confirmed']=='Y'?'cms_checked.gif':'cms_checkbox.gif').'" />'.$confirm_str.'</td>
      <td align="left" class="cms_middle"><a href="labyrinth_design.php?lab_id=' . $row['labyrinth_id'] . '" title="Редактор лабиринта">' . _htext($row['labyrinth_name']) . '</a></td>
    </tr>
    ';
}

?>
    <h3>Список лабиринтов</h3>
<div class="cms_ind">
<br />
    Лабиринты: <br/>
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
        <td class="cms_cap2 normal"> Удалить</td>
        <td class="cms_cap2 normal"> Параметры</td>
        <td class="cms_cap2 normal"> Редактор</td>
        <td class="cms_cap2 normal"> Копировать</td>

        <td class="cms_cap2">ID Лабиринта</td>
        <td class="cms_cap2">Подтвержден</td>
        <td class="cms_cap2">Название лабиринта</td>
    </tr>
    
    <?=$labyrinths?>
    
    </table>
    <br />
 </div>
    <img src="images/cms_icons/cms_add.gif" alt="Добавить лабиринт"/><a href="labyrinth_edit.php"
                                                                        title="Добавить лабиринт">Добавить
    лабиринт</a> &nbsp;<br/>
<? require('kernel/after.php'); ?>