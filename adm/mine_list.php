<?php
require('kernel/before.php');

$types = array(
    1 => '����� ������� ��������',
    2 => '����� ����������� ��������',
);

if (!userHasPermission(32768)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_mine_code']) && $_GET['delete_mine_code']!='') {
    $mine_code = $_GET['delete_mine_code'];
    mysql_query('delete from mine_res where mine_code = \''.mysql_real_escape_string($mine_code).'\'');
    mysql_query('delete from mine_list where mine_code = \''.mysql_real_escape_string($mine_code).'\'');
    header('Location: mine_list.php');
}


$mines = '';
$res = mysql_query('select * from mine_list', $db); 
while ($row = mysql_fetch_assoc($res))
{
    $mines.='
    <tr>
        <td class="cms_middle" align="center"><a onclick="return confirm(\'�� ������������� ������ ������� ���� ��������?\');" href="mine_list.php?delete_mine_code='.$row['mine_code'].'" title="�������"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
        <td class="cms_middle" align="center"><a href="mine_edit.php?mine_code='.$row['mine_code'].'" title="�������� ���������"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
        <td class="cms_middle" align="center"><a href="mine_view.php?mine_code='.$row['mine_code'].'" title="�������� ���������"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
        <td align="left" class="cms_middle">'.$row['mine_code'].'</td>
        <td align="left" class="cms_middle"><a href="mine_view.php?mine_code='.$row['mine_code'].'" title="�������� ���������">'._htext($row['mine_name']).'</a></td>
        <td align="left" class="cms_middle">'.$types[$row['mine_type']].'</td>
        <td align="left" class="cms_middle">'._htext($row['levels_count']).'</td>
    </tr>
    ';
}

?>
<h3>������ ����</h3> 
<div class="cms_ind">
<br />
�����: <br />
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
      <td class="cms_cap2 normal"> ������� </td>
      <td class="cms_cap2 normal"> ��������� </td>
      <td class="cms_cap2 normal"> �������� </td>

      <td class="cms_cap2">��� �����</td>
      <td class="cms_cap2">�������� �����</td>
      <td class="cms_cap2">��� �����</td>
      <td class="cms_cap2">�������</td>
    </tr>
    
    <?=$mines?>
    
    </table>
    <br />
 </div>
 <img src="images/cms_icons/cms_add.gif" alt="�������� �����" /><a href="mine_edit.php" title="�������� �����">�������� �����</a> &nbsp;<br />
<? require('kernel/after.php'); ?>