<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['delete_collection_id']) && $_GET['delete_collection_id']!='' && is_numeric($_GET['delete_collection_id'])) {
    $collection_id = (int)$_GET['delete_collection_id'];
    mysql_query('UPDATE smile_list SET collection_id = NULL WHERE collection_id = '.$collection_id);
    mysql_query('DELETE FROM smile_collections WHERE collection_id = '.$collection_id);
    header('Location: smile_collection_list.php');
}

$collections = '';
$res = mysql_query('select * from smile_collections'); 
while ($row = mysql_fetch_assoc($res))
{
    $collections .= '
    <tr>
      <td class="cms_middle" align="center"><a onclick="return confirm(\'Are you sure you want to delete this collection?\');" href="smile_collection_list.php?delete_collection_id='.$row['collection_id'].'" title="Delete Collection"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="smile_collection_edit.php?collection_id='.$row['collection_id'].'" title="Edit Collection"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td class="cms_middle" align="center"><a href="smile_collection_list.php?generate_config='.$row['collection_id'].'" title="Generate Config"><img src="images/cms_icons/cms_edit.gif" width="16" height="16" border="0" /></a></td>
      <td align="left" class="cms_middle">'.$row['collection_id'].'</td>
      <td align="left" class="cms_middle"><a href="smile_collection_edit.php?collection_id='.$row['collection_id'].'" title="Edit Collection">'._htext($row['collection_name']).'</a></td>
    </tr>
    ';
}
mysql_free_result($res);

if (isset($_GET['generate_config']))
{
    $res = mysql_query('select * from smile_list where collection_id = '.intval($_GET['generate_config'])); 
    while ($row = mysql_fetch_assoc($res))
        $smiles[$row['smile_id']] = $row;
    mysql_free_result($res);
    
    $arr1 = array();
    $arr2 = array();
    foreach($smiles as $smile_id => $smile) {
        $arr1[] = '\'/:'.$smile['smile_image'].':/\'';
        $arr2[] = '\''.$smile['smile_image'].'-'.$smile['width'].'x'.$smile['height'].'\'';
    }
    
    $str = implode(',', $arr1)."\n\n".implode(',', $arr2);
}


if (isset($_GET['generate_total']))
{
    $res = mysql_query('select * from smile_list where collection_id IS NOT NULL order by collection_id, smile_id '); 
    while ($row = mysql_fetch_assoc($res))
        $smiles[$row['collection_id']][$row['smile_id']] = $row;
    mysql_free_result($res);
    
    $arr1 = array();
    $arr2 = array();
    foreach($smiles as $collection_id => $row) {
        
        $arr1 = array();
        
        foreach($row as $smile_id => $smile) {
            $arr1[] = '["'.$smile['smile_image'].'","'.$smile['width'].'","'.$smile['height'].'"]';
        }
        $arr2[] = '['.implode(',', $arr1).']';
        
    }
    
    $str = '['.implode(',', $arr2).']';
}
/*
for ($i = 1; $i <= 112; $i++) {
    
    if ($i < 10)
        $smile = '00'.$i;
    elseif ($i < 100)
        $smile = '0'.$i;
    else
        $smile = $i;
        
    $info = getimagesize('http://image.neverlands.ru/forum/smiles/'.$smile.'.gif'); 
    $width = $info[0];
    $height = $info[1];
        
    mysql_query('
        INSERT INTO smile_list (smile_id, smile_image, width, height)
        VALUES ('.$i.', \''.(string)$smile.'\', '.$width.', '.$height.')
    ');
    
    //die(mysql_error());
}
*/
?>
<h3>Список смайлов</h3>
<div class="cms_ind">
<br />
Коллекции смайлов: <br />
 <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
      <td class="cms_cap2 normal"> Удалить </td>
      <td class="cms_cap2 normal"> Изменить </td>
      <td class="cms_cap2 normal"> Конфиг </td>

      <td class="cms_cap2">ID Коллекции</td>
      <td class="cms_cap2">Название Коллекции</td>
    </tr>
    
    <?=$collections?>
    
    </table>
    <br />
 </div>
 <img src="images/cms_icons/cms_add.gif" alt="Добавить коллекцию" /><a href="smile_collection_edit.php" title="Добавить коллекцию">Добавить коллекцию</a> &nbsp;<br />
 <br />
 <a href="?generate_total=Y">Общий конфиг</a><br /><br />
 <a href="smile_list.php">Список смайлов</a><br /><br />
<? if (isset($str)) { ?>
<textarea cols="80" rows="6"><?=$str?></textarea>
<? } ?>
<? require('kernel/after.php'); ?>