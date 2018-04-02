<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_fort_id']) && $_GET['delete_fort_id']!='') {
    $fort_id = $_GET['delete_fort_id'];
    mysqli_query($GLOBALS['db_link'], 'delete from forts where fort_id  = \'' . mysqli_real_escape_string($GLOBALS['db_link'], $fort_id) . '\'');
    header('Location: fort_list.php');
}

$fort_classes = array();
$res = mysqli_query($GLOBALS['db_link'], 'select * from forts_classes');
while ($row = mysqli_fetch_assoc($res))
    $fort_classes[$row['fort_class']] = $row['class_name'];
mysqli_free_result($res);

$forts = '';
$res = mysqli_query($GLOBALS['db_link'], 'select * from forts');
while ($row = mysqli_fetch_assoc($res))
{
    $forts .= '
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Вы уверены что хотите удалить этот замок?\');" href="fort_list.php?delete_fort_id=' . $row['fort_id'] . '" title="Удалить класс"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="fort_edit.php?fort_id=' . $row['fort_id'] . '" title="Изменить замок"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      
      <td align="left" class="cms_middle"><a href="fort_edit.php?fort_id=' . $row['fort_id'] . '" title="Изменить замок">' . $row['fort_id'] . '</a></td>
      <td align="left" class="cms_middle">'.$fort_classes[$row['fort_class']].'</td>
      <td align="left" class="cms_middle">'.$row['teleport'].'</td>
      <td align="left" class="cms_middle">'.$row['hp'].'</td>
      <td align="left" class="cms_middle">'.$row['mp'].'</td>
      <td align="left" class="cms_middle">'.$row['massa'].'</td>
      <td align="left" class="cms_middle">'.$row['cmassa'].'</td>
    </tr>
    ';
}

?>
    <h3>Список замков</h3>
<div class="cms_ind">
<br />
    Классы замков: <br/>
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
        <td class="cms_cap2 normal"> Удалить</td>
        <td class="cms_cap2 normal"> Изменить</td>

        <td class="cms_cap2">ID Замка</td>
        <td class="cms_cap2">Класс</td>
        <td class="cms_cap2">Телепорт</td>
      <td class="cms_cap2">HP</td>
      <td class="cms_cap2">MP</td>
        <td class="cms_cap2">Масса</td>
        <td class="cms_cap2">Масса</td>
    </tr>
    
    <?=$forts?>
    
    </table>
    <br />
 </div>
    <img src="images/cms_icons/cms_add.gif" alt="Добавить замок"/><a href="fort_edit.php" title="Добавить замок">Добавить
    замок</a> &nbsp;<br/>
 <br />

<? require('kernel/after.php'); ?>