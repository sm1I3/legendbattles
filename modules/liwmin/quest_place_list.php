<?php
require('kernel/before.php');

if (!userHasPermission(2)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_place_code']) && $_GET['delete_place_code']!='') {
    $place_code = $_GET['delete_place_code'];
    mysql_query('delete from quest_places where place_code = \''.mysql_real_escape_string($place_code).'\'');
    header('Location: quest_place_list.php');
}

$places = '';
$res = mysql_query('select * from quest_places'); 
while ($row = mysql_fetch_assoc($res))
{
    $places .= '
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'�� ������� ��� ������ ������� ��� �����?\');" href="quest_place_list.php?delete_place_code='.$row['place_code'].'" title="������� �����"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="quest_place_edit.php?place_code='.$row['place_code'].'" title="�������� �����"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$row['place_code'].'</td>
      <td align="left" class="cms_middle"><a href="quest_place_edit.php?place_code='.$row['place_code'].'" title="�������� �����">'._htext($row['place_name']).'</a></td>
    </tr>
    ';
}

?>
<h3>������ ���� �������</h3>
<div class="cms_ind">
<br />
�����: <br />
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
      <td class="cms_cap2 normal"> ������� </td>
      <td class="cms_cap2 normal"> �������� </td>

      <td class="cms_cap2">��� �����</td>
      <td class="cms_cap2">�������� �����</td>
    </tr>
    
    <?=$places?>
    
    </table>
    <br />
 </div>
 <img src="images/cms_icons/cms_add.gif" alt="�������� �����" /><a href="quest_place_edit.php" title="�������� �����">�������� �����</a> &nbsp;<br />
 <br />

<? require('kernel/after.php'); ?>