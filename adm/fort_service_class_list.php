<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_fort_service_class_id']) && $_GET['delete_fort_service_class_id']!='') 
{
    $fort_service_class_id = $_GET['delete_fort_service_class_id'];
    mysql_query('delete from forts_serv_classes where service_id  = '.intval($fort_service_class_id).'');
    header('Location: fort_service_class_list.php');
}

$fort_classes = '';
$res = mysql_query('select * from forts_serv_classes'); 
while ($row = mysql_fetch_assoc($res))
{
    $fort_classes .= '
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Вы уверены что хотите удалить этот класс?\');" href="fort_service_class_list.php?delete_fort_service_class_id=' . $row['service_id'] . '" title="Удалить класс"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="fort_service_class_edit.php?fort_service_class_id=' . $row['service_id'] . '" title="Изменить класс"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$row['service_id'].'</td>
      <td align="left" class="cms_middle"><a href="fort_service_class_edit.php?fort_service_class_id=' . $row['service_id'] . '" title="Изменить класс">' . _htext($row['service_name']) . '</a></td>
    </tr>
    ';
}

?>
    <h3>Список классов сервисов</h3>
<div class="cms_ind">
<br />
    Классы сервисов: <br/>
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
        <td class="cms_cap2 normal"> Удалить</td>
        <td class="cms_cap2 normal"> Изменить</td>

        <td class="cms_cap2">ID Класса</td>
        <td class="cms_cap2">Название класса</td>
    </tr>
    
    <?=$fort_classes?>
    
    </table>
    <br />
 </div>
    <img src="images/cms_icons/cms_add.gif" alt="Добавить класс"/><a href="fort_service_class_edit.php"
                                                                     title="Добавить класс">Добавить класс</a> &nbsp;
    <br/>
 <br />

<? require('kernel/after.php'); ?>