<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_category_code']) && $_GET['delete_category_code']!='') 
{
    $weapon_category_code = $_GET['delete_category_code'];
    mysql_query('delete from weapon_categories where category_code = \''.mysql_real_escape_string($weapon_category_code).'\'');
    header('Location: weapon_category_list.php');
}

$weapon_categories = '';
$res = mysql_query('select * from weapon_categories'); 
while ($row = mysql_fetch_assoc($res))
{
    $weapon_categories .= '
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Are you sure you want to delete this weapon category?\');" href="weapon_category_list.php?delete_category_code='.$row['category_code'].'" title="Delete Weapon Category"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="weapon_category_edit.php?category_code='.$row['category_code'].'" title="Edit Weapon Category"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$row['category_code'].'</td>
      <td align="left" class="cms_middle"><a href="weapon_category_edit.php?category_code='.$row['category_code'].'" title="Edit Weapon Category">'._htext($row['category_name']).'</a></td>
    </tr>
    ';
}

?>
<h3>Список категорий оружия</h3>
<div class="cms_ind">
<br />
Категории оружия: <br />
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
      <td class="cms_cap2 normal"> Удалить </td>
      <td class="cms_cap2 normal"> Изменить </td>

      <td class="cms_cap2">ID Категории</td>
      <td class="cms_cap2">Название категории</td>
    </tr>
    
    <?=$weapon_categories?>
    
    </table>
    <br />
 </div>
 <img src="images/cms_icons/cms_add.gif" alt="Добавить категорию" /><a href="weapon_category_edit.php" title="Добавить категорию">Добавить категорию</a> &nbsp;<br />
 <br />

<? require('kernel/after.php'); ?>