<?php
require('kernel/before.php');
require('library/forum.php');

if (!userHasPermission(2)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_cat_id']) && $_GET['delete_cat_id']!='') 
{
    $delete_cat_id = intval($_GET['delete_cat_id']);
    frm_del_categ($delete_cat_id);
    header('Location: forum_list.php');
}

if (isset($_GET['delete_forum_id']) && $_GET['delete_forum_id']!='') 
{
    $delete_forum_id = intval($_GET['delete_forum_id']);
    frm_del_forum($delete_forum_id);
    header('Location: forum_list.php');
}


$categories = array();
$forum = '';
frm_get_categ_list($categories);

foreach($categories as $cat)
{
    $forums = array();
        $forum .= '
        <tr>
          <td class="cms_middle" align="center"><a onclick="return confirm(\'�� ������� ��� ������ ������� ��� ���������?\');" href="forum_list.php?delete_cat_id='.$cat[0].'" title="������� �����"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
          <td class="cms_middle" align="center"><a href="forum_cat_edit.php?cat_id='.$cat[0].'" title="�������� ���������"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
          <td class="cms_middle" style="background: #EEE;"><b>'.$cat[0].'</b></td>
          <td class="cms_middle" colspan="5" style="background: #EEE;"><b>'.$cat[1].'</b>&nbsp;&nbsp;<img src="images/cms_icons/cms_add.gif" alt="�������� �����" /><a href="forum_edit.php?cat_id='.$cat[0].'" title="�������� �����">�������� �����</a></td>
        </tr>';
    
    frm_get_forum_list($cat[0], $forums);
    foreach($forums as $f)
    {
        $forum .= '
        <tr>
          <td class="cms_middle" align="center"><a onclick="return confirm(\'�� ������� ��� ������ ������� ���� �����?\');" href="forum_list.php?delete_forum_id='.$f[0].'" title="������� �����"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
          <td class="cms_middle" align="center"><a href="forum_edit.php?cat_id='.$cat[0].'&forum_id='.$f[0].'" title="�������� �����"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
          <td align="left" class="cms_middle">'.$f[0].'</td>
          <td align="left" class="cms_middle">'.$f[1].'</td>
          <td align="left" class="cms_middle">'.$f[2].'</td>
          <td align="left" class="cms_middle">'.$f[3].'</td>
          <td align="left" class="cms_middle">'.$f[4].'</td>
          <td align="left" class="cms_middle">'.$f[5].'</td>
        </tr>
        ';
    }
}

?>
<h3>������</h3>
<div class="cms_ind">
<br />
������: <br />
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
      <td class="cms_cap2 normal"> ������� </td>
      <td class="cms_cap2 normal"> �������� </td>

      <td class="cms_cap2">ID ������</td>
      <td class="cms_cap2">�������� ������</td>
      <td class="cms_cap2">��������</td>
      <td class="cms_cap2">��������</td>
      <td class="cms_cap2">���</td>
      <td class="cms_cap2">�������</td>
    </tr>
    
    <?=$forum?>
    
    </table>
    <br />
 </div>
<img src="images/cms_icons/cms_add.gif" alt="�������� ���������" /><a href="forum_cat_edit.php" title="�������� ���������">�������� ���������</a> &nbsp;<br />
<br />

<? require('kernel/after.php'); ?>