<?php
require('kernel/before.php');

if (!userHasPermission(16384)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_place_code']) && $_GET['delete_place_code']!='') 
{
    $place_code = $_GET['delete_place_code'];
    mysql_query('delete from loc where place_code = \''.mysql_real_escape_string($place_code).'\'');
    header('Location: place_list.php');
}

$places = '';
$res = mysql_query('select * from loc'); 
while ($row = mysql_fetch_assoc($res))
{
    $places .= '
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Вы уверены что хотите удалить этот магазин?\');" href="place_list.php?delete_place_code='.$row['id'].'" title="Удалить магазин"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="place_edit.php?place_code='.$row['ud'].'" title="Изменить магазин"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$row['id'].'</td>
      <td align="left" class="cms_middle"><a href="place_edit.php?place_code='.$row['id'].'" title="Изменить магазин">'._htext($row['room'] ? $row['city'] . ', ' . $row['loc'] . ', ' . $row['room'] : $row['city'] . ', ' . $row['loc']).'</a></td>
    </tr>
    ';
}

?>
<h3>Список мест</h3>
<div class="cms_ind">
<br />
Места: <br />
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
      <td class="cms_cap2 normal"> Удалить </td>
      <td class="cms_cap2 normal"> Изменить </td>

      <td class="cms_cap2">Код Места</td>
      <td class="cms_cap2">Название места</td>
    </tr>
    
    <?=$places?>
    
    </table>
    <br />
 </div>
 <img src="images/cms_icons/cms_add.gif" alt="Добавить место" /><a href="place_edit.php" title="Добавить место">Добавить место</a> &nbsp;<br />
 <br />

<? require('kernel/after.php'); ?>