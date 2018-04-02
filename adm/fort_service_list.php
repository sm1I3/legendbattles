<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_fort_service_id']) && $_GET['delete_fort_service_id']!='') {
    $fort_service_id = (int)$_GET['delete_fort_service_id'];
    mysqli_query($GLOBALS['db_link'], 'delete from forts_serv_lists where list_id = ' . intval($fort_service_id));
    header('Location: fort_service_list.php');
}

$classes = array();
$res = mysqli_query($GLOBALS['db_link'], 'SELECT * FROM forts_serv_classes ORDER BY service_name ASC');
while ($row = mysqli_fetch_assoc($res))
    $classes[$row['service_id']] = $row['service_name'];
mysqli_free_result($res);

$services = '';
$now_class = '';
$res = mysqli_query($GLOBALS['db_link'], 'select * from forts_serv_lists ORDER BY service_id ASC, service_nv ASC');
while ($row = mysqli_fetch_assoc($res))
{
    if ($now_class != $row['service_id'])
        $services .= '
        <tr><td class="cms_middle" colspan="7">&nbsp;&nbsp;&nbsp;<b>'.$classes[$row['service_id']].'</b></td></tr>
        ';
        
    $now_class = $row['service_id'];
    
    $services .= '
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Вы действительно хотите удалить этот сервис?\');" href="fort_service_list.php?delete_fort_service_id=' . $row['list_id'] . '" title="Удалить сервис"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="fort_service_edit.php?fort_service_id=' . $row['list_id'] . '" title="Редактировать сервис"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td align="center" class="cms_middle">'.$row['list_id'].'</td>
      <td align="left" class="cms_middle">'.$row['service_size'].'</td>
      <td align="left" class="cms_middle">'.$row['service_time'].'</td>
      <td align="left" class="cms_middle">'.$row['service_nv'].'</td>
      <td align="left" class="cms_middle">'.$row['service_dnv'].'</td>
    </tr>
    ';
}



?>
    <h3>Список сервисов</h3>
<div class="cms_ind">
<br />
    Сервисы: <br/>


 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
        <td class="cms_cap2 normal"> Удалить</td>
        <td class="cms_cap2 normal"> Изменить</td>

      <td class="cms_cap2">ID</td>
        <td class="cms_cap2">Размер</td>
        <td class="cms_cap2">Время</td>
      <td class="cms_cap2">NV</td>
      <td class="cms_cap2">DNV</td>
    </tr>
    
    <?=$services?>
    
    </table>
    <br />
 </div>
    <img src="images/cms_icons/cms_add.gif" alt="Добавить сервис"/><a href="fort_service_edit.php"
                                                                      title="Добавить сервис">Добавить сервис</a> &nbsp;
    <br/>
 <br />

<? require('kernel/after.php'); ?>