<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

$property_types = array(
    1 => '�������� ����������',
    2 => '���������� ������',
    3 => '�������� ���-��',
    4 => '�������������� ������'
);

if (isset($_GET['delete_property_code']) && $_GET['delete_property_code']!='') {
    $weapon_property_code = $_GET['delete_property_code'];
    mysql_query('delete from weapon_properties where property_code = \''.mysql_real_escape_string($weapon_property_code).'\'');
    header('Location: weapon_property_list.php');
}

$weapon_properties = '';
$res = mysql_query('select * from weapon_properties'); 
while ($row = mysql_fetch_assoc($res))
{
    $weapon_properties .= '
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'�� ������� ��� ������ ������� ���� �������� ������?\');" href="weapon_property_list.php?delete_property_code='.$row['property_code'].'" title="������� �������� ������"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="weapon_property_edit.php?property_code='.$row['property_code'].'" title="�������� �������� ������"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$property_types[$row['property_type']].'</td>
      <td align="left" class="cms_middle">'.$row['property_code'].'</td>
      <td align="left" class="cms_middle"><a href="weapon_property_edit.php?property_code='.$row['property_code'].'" title="�������� �������� ������">'._htext($row['property_name']).'</a></td>
    </tr>
    ';
}

?>
<h3>������ ���������� ������</h3>
<div class="cms_ind">
<br />
��������� ������: <br />
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
      <td class="cms_cap2 normal"> ������� </td>
      <td class="cms_cap2 normal"> �������� </td>

      <td class="cms_cap2">��� ���������</td>
      <td class="cms_cap2">��� ���������</td>
      <td class="cms_cap2">�������� ���������</td>
    </tr>
    
    <?=$weapon_properties?>
    
    </table>
    <br />
 </div>
 <img src="images/cms_icons/cms_add.gif" alt="�������� ��������" /><a href="weapon_property_edit.php" title="�������� ��������">�������� ��������</a> &nbsp;<br />
 <br />

<? require('kernel/after.php'); ?>