<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_fort_id']) && $_GET['delete_fort_id']!='') {
    $fort_id = $_GET['delete_fort_id'];
    mysql_query('delete from forts where fort_id  = \''.mysql_real_escape_string($fort_id).'\'');
    header('Location: fort_list.php');
}

$fort_classes = array();
$res = mysql_query('select * from forts_classes');
while($row = mysql_fetch_assoc($res))
    $fort_classes[$row['fort_class']] = $row['class_name'];
mysql_free_result($res);

$forts = '';
$res = mysql_query('select * from forts'); 
while ($row = mysql_fetch_assoc($res))
{
    $forts .= '
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'�� ������� ��� ������ ������� ���� �����?\');" href="fort_list.php?delete_fort_id='.$row['fort_id'].'" title="������� �����"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="fort_edit.php?fort_id='.$row['fort_id'].'" title="�������� �����"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      
      <td align="left" class="cms_middle"><a href="fort_edit.php?fort_id='.$row['fort_id'].'" title="�������� �����">'.$row['fort_id'].'</a></td>
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
<h3>������ ������</h3>
<div class="cms_ind">
<br />
������ ������: <br />
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
      <td class="cms_cap2 normal"> ������� </td>
      <td class="cms_cap2 normal"> �������� </td>

      <td class="cms_cap2">ID �����</td>
      <td class="cms_cap2">�����</td>
      <td class="cms_cap2">��������</td>
      <td class="cms_cap2">HP</td>
      <td class="cms_cap2">MP</td>
      <td class="cms_cap2">�����</td>
      <td class="cms_cap2">�����</td>
    </tr>
    
    <?=$forts?>
    
    </table>
    <br />
 </div>
 <img src="images/cms_icons/cms_add.gif" alt="�������� �����" /><a href="fort_edit.php" title="�������� �����">�������� �����</a> &nbsp;<br />
 <br />

<? require('kernel/after.php'); ?>