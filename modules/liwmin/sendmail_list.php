<?php
require('kernel/before.php');

if (!userHasPermission(1)){
	header('Location: index.php');
	die();
}

if (isset($_GET['delete_message_id']) && $_GET['delete_message_id']!='' && is_numeric($_GET['delete_message_id'])){
	$message_id = (int)$_GET['delete_message_id'];
	mysql_query('delete from module_subscribe where id = '.intval($message_id));
	header('Location: sendmail_list.php');
}

$abilities = '';
$res = mysql_query('select * from module_subscribe'); 
while ($row = mysql_fetch_assoc($res)){
	$abilities .= '
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'�� ������� ��� ������ ������� ��� ���������?\');" href="sendmail_list.php?delete_message_id='.$row['id'].'" title="������� ���������"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="sendmail_edit.php?message_id='.$row['id'].'" title="�������� ���������"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$row['id'].'</td>
      <td align="left" class="cms_middle"><a href="sendmail_edit.php?message_id='.$row['id'].'" title="�������� ���������">'.$row['theame'].'</a></td>
	  <td align="left" class="cms_middle"><a href="sendmail_edit.php?message_id='.$row['id'].'" title="�������� ���������">'.substr(BbToHtml(nl2br($row['message'])), 0, 100).'</a></td>
    </tr>
    ';
}

?>
<h3>������ ���������</h3>
<div class="cms_ind">
<br />
���������: <br />
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
      <td class="cms_cap2 normal"> ������� </td>
      <td class="cms_cap2 normal"> �������� </td>

      <td class="cms_cap2">ID ���������</td>
      <td class="cms_cap2">���� ���������</td>
	  <td class="cms_cap2">����� ���������</td>
    </tr>
    
    <?=$abilities?>
    
    </table>
    <br />
 </div>
 <img src="images/cms_icons/cms_add.gif" alt="�������� ���������" /><a href="sendmail_edit.php" title="�������� ���������">�������� ���������</a> &nbsp;<br />
 <br />

<? require('kernel/after.php'); ?>