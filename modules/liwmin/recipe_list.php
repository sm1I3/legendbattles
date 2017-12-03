<?php
require('kernel/before.php');

if (!userHasPermission(128)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_rec_id']) && $_GET['delete_rec_id']!='' && is_numeric($_GET['delete_rec_id'])) {
    $rec_id = (int)$_GET['delete_rec_id'];
    mysql_query('delete from recipe_initial_resources where rec_id = '.$rec_id);
    mysql_query('delete from recipe_receive_resources where rec_id = '.$rec_id);
    mysql_query('delete from recipe_toolkit where rec_id = '.$rec_id);
    mysql_query('delete from recipe_list where rec_id = '.$rec_id);
    header('Location: '.$_SESSION['pages']['recipe_list']);
}

// PAGE NAVIGATOR
$query = 'select count(*) from recipe_list';
$res = mysql_query($query);
$row = mysql_fetch_row($res);
$records_count = $row[0];

$pages_count = ceil($records_count / $recs_per_page);
if (!isset($_GET['page']) || $_GET['page'] == '')
    $cur_page = 1;
else
    $cur_page = (int)$_GET['page'];

if ($cur_page > $pages_count) $cur_page = $pages_count;
if ($cur_page <= 0) $cur_page = 1; 
// END PAGE NAVIGATOR

$recipes = '';
$query = 'select * from recipe_list'.
         generateMysqlOrder().
         generateMysqlLimit($cur_page, $recs_per_page);
         
$res = mysql_query($query); 
while ($row = mysql_fetch_assoc($res))
{
    $recipes .= '
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Are you sure you want to delete this recipe?\');" href="recipe_list.php?delete_rec_id='.$row['rec_id'].'" title="Delete Recipe"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="recipe_edit.php?rec_id='.$row['rec_id'].'" title="Edit Recipe"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="recipe_edit.php?clone_rec_id='.$row['rec_id'].'" title="Clone Recipe"><img src="images/cms_icons/cms_add.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$row['rec_id'].'</td>
      <td align="left" class="cms_middle"><a href="recipe_edit.php?rec_id='.$row['rec_id'].'" title="Edit Recipe">'._htext($row['rec_name']).'</a></td>
      <td align="left" class="cms_middle">'.$row['rec_size'].'</td>
    </tr>
    ';
}

$_SESSION['pages']['recipe_list'] = $_SERVER['REQUEST_URI']; 

?>
<h3>Список рецептов</h3>
  <div id="results">
    <div id="cms_navigator"><?=createPageNavigator($records_count, $cur_page, 'Рецепты')?></div>

    <div class="cms_ind">
        <br />
        Рецепты: <br />
         <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
            <tr >
              <td class="cms_cap2 normal"> Удалить </td>
              <td class="cms_cap2 normal"> Изменить </td>
              <td class="cms_cap2 normal"> Копировать </td>

              <td class="cms_cap2"><a href="<?=sortby('rec_id')?>">ID Рецепта</a></td>
              <td class="cms_cap2"><a href="<?=sortby('rec_name')?>">Название рецепта</a></td>
              <td class="cms_cap2"><a href="<?=sortby('rec_size')?>">Кол-во ингредиентов</a></td>
            </tr>
            <?=$recipes?>
         </table>
         <br />
    </div>
    <div id="cms_navigator"><?=createPageNavigator($records_count, $cur_page, 'Рецепты')?></div> 
</div>
<br />
<img src="images/cms_icons/cms_add.gif" alt="Добавить рецепт" /><a href="recipe_edit.php" title="Добавить рецепт">Добавить рецепт</a> &nbsp;<br />
<br />

<? require('kernel/after.php'); ?>