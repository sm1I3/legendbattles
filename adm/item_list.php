<?php
require('kernel/before.php');

if (!userHasPermission(64)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_item_id']) && $_GET['delete_item_id']!='' && is_numeric($_GET['delete_item_id'])) {
    $item_id = (int)$_GET['delete_item_id'];
    mysqli_query($GLOBALS['db_link'], 'delete from items where item_id = ' . intval($item_id));
    header('Location: '.$_SESSION['pages']['item_list']);
}

// PAGE NAVIGATOR
$query = 'select count(*) from items';
$res = mysqli_query($GLOBALS['db_link'], $query);
$row = mysqli_fetch_row($res);
$records_count = $row[0];

$pages_count = ceil($records_count / $recs_per_page);
if (!isset($_GET['page']) || $_GET['page'] == '')
    $cur_page = 1;
else
    $cur_page = (int)$_GET['page'];
if ($cur_page < 0) $cur_page = 1;
elseif ($cur_page > $pages_count) $cur_page = $pages_count;
// END PAGE NAVIGATOR

$items = '';
$query = 'select * from items'.
        generateMysqlOrder().
        generateMysqlLimit($cur_page, $recs_per_page);

$res = mysqli_query($GLOBALS['db_link'], $query, $db);
while ($row = mysqli_fetch_assoc($res))
{
    $items.='
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Are you sure you want to delete this item?\');" href="item_list.php?delete_item_id='.$row['id'].'" title="Delete Item"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="item_edit.php?item_id='.$row['id'].'" title="Edit Item"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="item_edit.php?clone_id='.$row['id'].'" title="Copy Item"><img src="images/cms_icons/cms_add.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$row['id'].'</td>
      <td align="left" class="cms_middle"><a href="item_edit.php?item_id='.$row['id'].'" title="Edit Item">'._htext($row['name']).'</a></td>
      <td align="left" class="cms_middle">'.$row['price'].'</td>
    </tr>
    ';
}

$_SESSION['pages']['item_list'] = $_SERVER['REQUEST_URI'];

?>
    <h3>Список предметов</h3>
<div id="results">
    <div id="cms_navigator"><?= createPageNavigator($records_count, $cur_page, 'Предметы') ?></div>

    <div class="cms_ind">
        <br />
        Предметы: <br/>
         <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
            <tr >
                <td class="cms_cap2 normal"> Удалить</td>
                <td class="cms_cap2 normal"> Изменить</td>
                <td class="cms_cap2 normal"> Клонировать</td>

                <td class="cms_cap2"><a href="<?= sortby('id') ?>">ID Предмета</a></td>
                <td class="cms_cap2"><a href="<?= sortby('name') ?>">Название предмета</a></td>
                <td class="cms_cap2"><a href="<?= sortby('price') ?>">Стоимость</a></td>
            </tr>
            
            <?=$items?>
            
            </table>
            <br />
    </div>
    <div id="cms_navigator"><?= createPageNavigator($records_count, $cur_page, 'Предметы') ?></div>
</div>
<br />
    <img src="images/cms_icons/cms_add.gif" alt="Добавить предмет"/><a href="item_edit.php" title="Добавить предмет">Добавить
    предмет</a><br/>
<br />
<? require('kernel/after.php'); ?>