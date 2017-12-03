<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_bank_id']) && $_GET['delete_bank_id']!='') 
{
    $bank_id = (int)$_GET['delete_bank_id'];
    mysql_query('delete from bank where id = '.intval($id).'');
    header('Location: bank_list.php');
}

$banks = '';
$res = mysql_query('select * from bank'); 
while ($row = mysql_fetch_assoc($res))
{
    $banks .= '
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Вы уверены что хотите удалить этот банк?\');" href="bank_list.php?delete_bank_id='.$row['id'].'" title="Удалить банк"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="bank_edit.php?bank_id='.$row['id'].'" title="Изменить банк"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$row['id'].'</td>
      <td align="left" class="cms_middle"><a href="bank_edit.php?bank_id='.$row['id'].'" title="Изменить банк">'._htext($row['num']).'</a></td>
			<td align="left" class="cms_middle">'.$row['pl_id'].'</td>
    </tr>
    ';
}

?>
<h3>Список Банков</h3>
<div class="cms_ind">
<br />
Банки: <br />
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
      <td class="cms_cap2 normal"> Удалить </td>
      <td class="cms_cap2 normal"> Изменить </td>

      <td class="cms_cap2">ID Банка</td>
      <td class="cms_cap2">Название банка</td>
			<td class="cms_cap2">id игрока</td>
    </tr>
    
    <?=$banks?>
    
    </table>
    <br />
 </div>
 <img src="images/cms_icons/cms_add.gif" alt="Добавить банк" /><a href="bank_edit.php" title="Добавить банк">Добавить банк</a> &nbsp;<br />
 <br />

<? require('kernel/after.php'); ?>