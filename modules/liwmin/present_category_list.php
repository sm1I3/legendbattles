<?php
require('kernel/before.php');

if (!userHasPermission(131072)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_pr_cat_id']) && $_GET['delete_pr_cat_id']!='' && is_numeric($_GET['delete_pr_cat_id'])) 
{
    $category_id = (int)$_GET['delete_pr_cat_id'];
    mysql_query('delete from present_category where pr_cat_id = '.intval($category_id));
    header('Location: present_category_list.php');
}

$categories = '';
$res = mysql_query('select * from present_category'); 
while ($row = mysql_fetch_assoc($res))
{
    $categories .= '
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'�� ������� ��� ������ ������� ��� ���������?\');" href="present_category_list.php?delete_pr_cat_id='.$row['pr_cat_id'].'" title="������� ���������"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="present_category_edit.php?category_id='.$row['pr_cat_id'].'" title="�������� ���������"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$row['pr_cat_id'].'</td>
      <td class="cms_middle"><a href="present_category_edit.php?category_id='.$row['pr_cat_id'].'" title="�������� ���������">'._htext($row['pr_cat_title']).'</a></td>
      <td class="cms_middle">'.date('Y-m-d H:i:s', $row['pr_cat_start']).'</td>
      <td class="cms_middle">'.date('Y-m-d H:i:s', $row['pr_cat_end']).'</td>
    </tr>
    ';
}

?>
<h3>��������� ��������</h3>
<div class="cms_ind">
<br />
��������� ��������: <br />
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
      <td class="cms_cap2 normal"> ������� </td>
      <td class="cms_cap2 normal"> �������� </td>

      <td class="cms_cap2">ID ���������</td>
      <td class="cms_cap2">�������� ���������</td>
      <td class="cms_cap2">������ ��������</td>
      <td class="cms_cap2">����� ��������</td>
    </tr>
    
    <?=$categories?>
    
    </table>
    <br />
 </div>
 <img src="images/cms_icons/cms_add.gif" alt="�������� ���������" /><a href="present_category_edit.php" title="�������� ���������">�������� ���������</a> &nbsp;<br />
 <br />

<? require('kernel/after.php'); ?>