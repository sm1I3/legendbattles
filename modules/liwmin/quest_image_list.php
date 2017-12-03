<?php
require('kernel/before.php');

if (isset($_GET['mode']) && $_GET['mode'] == 'img')
    $mode = 'img';
else
    $mode = 'text';

if (!userHasPermission(2)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_image_id']) && $_GET['delete_image_id']!='' && is_numeric($_GET['delete_image_id'])) 
{
    $image_id = (int)$_GET['delete_image_id'];
    mysql_query('delete from quest_images where quest_id = '.intval($image_id));
    header('Location: quest_image_list.php');
}


$images = '';
$i = 0;
$res = mysql_query('select * from quest_images'); 
if ($mode == 'text')
    while ($row = mysql_fetch_assoc($res))
    {
        $images.='
        <tr>
          <td class="cms_middle" align="center"><a onclick="return confirm(\'�� ������� ��� ������ ������� ��� ��������?\');" href="quest_image_list.php?delete_image_id='.$row['image_id'].'" title="�������"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
          <td class="cms_middle" align="center"><a href="quest_image_edit.php?image_id='.$row['image_id'].'" title="��������"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
          <td align="left" class="cms_middle">'.$row['image_id'].'</td>
          <td align="left" class="cms_middle"><a href="quest_image_edit.php?image_id='.$row['image_id'].'" title="��������">'._htext($row['image_name']).'</a></td>
        </tr>
        ';
    }
else
    while ($row = mysql_fetch_assoc($res))
    {
        $i++;
        $images.='
        <td align="center" class="cms_middle" style="padding-top: 5px;">
            <a href="quest_image_edit.php?image_id='.$row['image_id'].'" title="��������">
                <img src="http://image.neverlands.ru/gameplay/faces/'.$row['image'].'" style="border: 0px;" /><br />
                '._htext($row['image_name']).'
            </a>
        </td>
        ';
        if ($i % 6 == 0)
            $images .= '</tr><tr>';
    }
    
$_SESSION['pages']['quest_image_list'] = $_SERVER['REQUEST_URI'];

?>
<h3>������ �������� �������</h3>
<br />
<? if ($mode == 'text') { ?>
<a href="?mode=img">������������� � ����� �����������</a>
<? } else { ?>
<a href="?mode=text">������������� � ��������� �����</a>
<? } ?>
<div class="cms_ind">
<br />
<? if ($mode == 'text') { ?> 
��������: <br />
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
      <td class="cms_cap2 normal"> ������� </td>
      <td class="cms_cap2 normal"> �������� </td>

      <td class="cms_cap2">ID ��������</td>
      <td class="cms_cap2">�������� ��������</td>
    </tr>
    
    <?=$images?>
    
    </table>
 <? } else { ?>
    <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
        <?=$images?>
    </table>
 <? } ?>
    <br />
 </div>
<img src="images/cms_icons/cms_add.gif" alt="�������� ��������" /><a href="quest_image_edit.php" title="�������� ��������">�������� ��������</a> &nbsp;<br />
<br />

<? require('kernel/after.php'); ?>