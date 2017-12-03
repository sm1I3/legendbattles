<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_branch_code']) && $_GET['delete_branch_code']!='') 
{
    $branch_code = $_GET['delete_branch_code'];
    mysql_query('delete from bank_branch where branch_code = \''.mysql_real_escape_string($branch_code).'\'');
    header('Location: bank_branch_list.php');
}

$banks = array();
$res = mysql_query('select * from bank');
while($row = mysql_fetch_assoc($res))
    $banks[$row['bank_id']] = $row['bank_name'];
mysql_free_result($res);

$branches = '';
$res = mysql_query('select * from bank_branch'); 
while ($row = mysql_fetch_assoc($res))
{
    $branches .= '
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Вы уверены что хотите удалить это отделение?\');" href="bank_branch_list.php?delete_branch_code='.$row['branch_code'].'" title="Удалить отделение"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="bank_branch_edit.php?branch_code='.$row['branch_code'].'" title="Изменить отделение"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$banks[$row['bank_id']].'</td>
      <td align="left" class="cms_middle">'.$row['branch_code'].'</td>
      <td align="left" class="cms_middle"><a href="bank_branch_edit.php?branch_code='.$row['branch_code'].'" title="Изменить отделение">'._htext($row['branch_name']).'</a></td>
    </tr>
    ';
}

?>
<h3>Список отделений банков</h3>
<div class="cms_ind">
    <br />
    Отделения банков: <br />
    <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
        <tr >
        <td class="cms_cap2 normal"> Удалить </td>
        <td class="cms_cap2 normal"> Изменить </td>

        <td class="cms_cap2">Банк</td>
        <td class="cms_cap2">Код отделения банка</td>
        <td class="cms_cap2">Название отделения банка</td>
        </tr>

        <?=$branches?>

    </table>
    <br />
</div>
<img src="images/cms_icons/cms_add.gif" alt="Добавить отделение банка" /><a href="bank_branch_edit.php" title="Добавить отделение банка">Добавить отделение банка</a> &nbsp;<br />
<br />

<? require('kernel/after.php'); ?>