<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_fort_class_id']) && $_GET['delete_fort_class_id']!='') 
{
    $fort_class_id = $_GET['delete_fort_class_id'];
    mysql_query('delete from forts_classes where fort_class  = '.intval($fort_class_id).'');
    header('Location: fort_class_list.php');
}

$fort_classes = '';
$res = mysql_query('select * from forts_classes'); 
while ($row = mysql_fetch_assoc($res))
{
    $fort_classes .= '
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Вы уверены что хотите удалить этот класс?\');" href="fort_class_list.php?delete_fort_class_id='.$row['fort_class'].'" title="Удалить класс"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="fort_class_edit.php?fort_class_id='.$row['fort_class'].'" title="Изменить класс"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$row['fort_class'].'</td>
      <td align="left" class="cms_middle"><a href="fort_class_edit.php?fort_class_id='.$row['fort_class'].'" title="Изменить класс">'._htext($row['class_name']).'</a></td>
      <td align="left" class="cms_middle">'.$row['teleport'].'</td>
      <td align="left" class="cms_middle">'.$row['hp'].'</td>
      <td align="left" class="cms_middle">'.$row['mp'].'</td>
      <td align="left" class="cms_middle">'.$row['massa'].'</td>
    </tr>
    ';
}

?>
<h3>Список классов замков</h3>
<div class="cms_ind">
<br />
Классы замков: <br />
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
      <td class="cms_cap2 normal"> Удалить </td>
      <td class="cms_cap2 normal"> Изменить </td>

      <td class="cms_cap2">ID Класса</td>
      <td class="cms_cap2">Название класса</td>
      <td class="cms_cap2">Телепорт</td>
      <td class="cms_cap2">HP</td>
      <td class="cms_cap2">MP</td>
      <td class="cms_cap2">Масса</td>
    </tr>
    
    <?=$fort_classes?>
    
    </table>
    <br />
 </div>
 <img src="images/cms_icons/cms_add.gif" alt="Добавить класс" /><a href="fort_class_edit.php" title="Добавить класс">Добавить класс</a> &nbsp;<br />
 <br />

<? require('kernel/after.php'); ?>