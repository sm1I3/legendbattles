<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}
	function lr($lr) {
		$b = $lr % 100;
		$s = intval(($lr % 10000) / 100);
		$g = intval($lr / 10000);
		return (($g)?$g.' <img src=/img/image/gold.png width=14 height=14 valign=middle title=������>  ':'').(($s)?$s.' <img src=/img/image/silver.png width=14 height=14 valign=middle title=�������> ':'').(($b)?$b.' <img src=/img/image/bronze.png width=14 height=14 valign=middle title=������> ':'');
	}
if (isset($_GET['delete_bank_id']) && $_GET['delete_bank_id']!='') 
{
    $bank_id = (int)$_GET['delete_bank_id'];
    mysql_query('delete from bank where id = '.intval($id).'');
    header('Location: bank_list.php');
}

$banks = '';
$res = mysql_query('SELECT * FROM user, bank WHERE user.id = bank.pl_id '); 
while ($row = mysql_fetch_assoc($res))
{
    $banks .= '
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'�� ������� ��� ������ ������� ���� ����?\');" href="bank_list.php?delete_bank_id='.$row['id'].'" title="������� ����"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="bank_edit.php?id='.$row['id'].'" title="�������� ����"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$row['id'].'</td>
      <td align="left" class="cms_middle"><a href="bank_edit.php?id='.$row['id'].'" title="�������� ����">'._htext($row['num']).'</a></td>
			<td align="left" class="cms_middle">'.$row['login'].'</td>
			<td align="left" class="cms_middle">'.lr($row['lr']).'</td>
			<td align="left" class="cms_middle">'.$row['dlr'].'</td>
    </tr>
    ';
}

?>
<h3>������ ������</h3>
<div class="cms_ind">
<br />
�����: <br />
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
      <td class="cms_cap2 normal"> ������� </td>
      <td class="cms_cap2 normal"> �������� </td>

      <td class="cms_cap2">ID �����</td>
      <td class="cms_cap2">�������� �����</td>
			<td class="cms_cap2">�����</td>
			<td class="cms_cap2">LR</td>
			<td class="cms_cap2">�������</td>
    </tr>
    
    <?=$banks?>
    
    </table>
    <br />
 </div>
 <img src="images/cms_icons/cms_add.gif" alt="�������� ����" /><a href="bank_edit.php" title="�������� ����">�������� ����</a> &nbsp;<br />
 <br />

<? require('kernel/after.php'); ?>