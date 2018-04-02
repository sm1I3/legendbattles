<?php
require('kernel/before.php');

$smiles_from = 000;
$smiles_to   = 112;

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['collection_id']) || !is_numeric($_GET['collection_id']))
    $collection_id = '';
else
    $collection_id = (int)$_GET['collection_id'];
    
if (isset($_POST['collection_name'])) 
{
    $tarr = array();
    
    if (is_array($_POST['smile']) && sizeof($_POST['smile'])>0)
    foreach($_POST['smile'] as $smile => $val)
        if ($val == 1)
            $tarr[] = $smile;
            
    if ($collection_id == '') {
        $query = '
        insert into smile_collections
        (
            collection_id,
            collection_name
        ) values (
            '.(int)$_POST['collection_id'].',
            \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['collection_name']) . '\'
        )';
        mysqli_query($GLOBALS['db_link'], $query);
        $collection_id = mysqli_insert_id($GLOBALS['db_link']);
    } else {
        $query = '
        update smile_collections set
            collection_id = '.(int)$_POST['collection_id'].',
            collection_name = \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['collection_name']) . '\'
        where
            collection_id = '.intval($collection_id).'
        ';
        mysqli_query($GLOBALS['db_link'], $query);
    }

    mysqli_query($GLOBALS['db_link'], 'UPDATE smile_list SET collection_id = NULL WHERE collection_id = ' . intval($collection_id));
    if (sizeof($tarr) > 0) {
        mysqli_query($GLOBALS['db_link'], 'UPDATE smile_list SET collection_id = ' . (int)$_POST['collection_id'] . ' WHERE smile_id IN (' . implode(',', $tarr) . ')');
    }
        
    
    header('Location: smile_collection_list.php');
    
}

if ($collection_id == '') {
    $collection = array(
        'collection_id' => '',
        'collection_name' => '',
        'smiles' => ''
    );
} else {
    $collection = array();
    $res = mysqli_query($GLOBALS['db_link'], 'select * from smile_collections where collection_id = ' . intval($collection_id));
    if ($row = mysqli_fetch_assoc($res))
        $collection = $row;
    mysqli_free_result($res);
}

?>
    <h3><?= ($collection_id == '' ? 'Добавить коллекцию смайлов' : 'Изменить коллекцию смайлов') ?></h3>

<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td>ID Коллекции: &nbsp;</td>
  <td><input name="collection_id" type="text" class="cms_fieldstyle1" value="<?=$collection['collection_id']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td>Название коллекции: &nbsp;</td>
  <td><input name="collection_name" type="text" class="cms_fieldstyle1" value="<?=$collection['collection_name']?>" size="30" maxlength="255" /></td>
</tr>
</table>
<br />
    Смайлы:
<script language="javascript">
function selectSmile(smile)
{
    elm = el('smile_'+smile);
    if (elm.value == '1')
    {
        elm.value = '0';
        el('smile_div_'+smile).style.border = '2px solid white';
    } 
    else 
    {
        elm.value = '1';
        el('smile_div_'+smile).style.border = '2px solid green';
    }
    return true;
}
</script>
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
<tr>
<? 
$i = 0;
$res = mysqli_query($GLOBALS['db_link'], 'select * from smile_list order by smile_id');
while ($row = mysqli_fetch_assoc($res))
{
    $i++;
    echo '
        <td class="cms_middle" align="center" bgcolor="#'.(!isset($row['collection_id']) || $row['collection_id']==$collection_id?'FFFFFF':'CCCCCC').'">
            <div id="smile_div_'.$row['smile_id'].'" style="cursor: pointer; border: 2px solid '.($collection_id!='' && $row['collection_id']==$collection_id?'green':'white').';" onclick="selectSmile(\''.$row['smile_id'].'\'); return false;">
                <input type="hidden" name="smile['.$row['smile_id'].']" id="smile_'.$row['smile_id'].'" value="'.($collection_id!='' && $row['collection_id']==$collection_id?'1':'0').'" />
                '.$row['smile_image'].'<br />
                <img src="http://image.neverlands.ru/forum/smiles/'.$row['smile_image'].'.gif" border="0" width="'.$row['width'].'" height="'.$row['height'].'" />
            </div>
        </td>
    ';
    if ($i % 12 == 0)
        echo '</tr><tr>';
} ?>
</tr>
</table>
<p></p>
    <input name="submit" type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
    <input name="cancel" type="submit" onclick="document.location='smile_collection_list.php'; return false;"
           class="cms_button1" value="Отмена"/>
    <p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>