<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (isset($_POST['delete'])) 
{
    if (isset($_POST['smile']) && is_array($_POST['smile']))
    foreach($_POST['smile'] as $smile_id => $val) {
        if ($val == 1) {
            mysql_query('DELETE FROM smile_list WHERE smile_id = '.intval($smile_id));
        }
    }
    header('Location: smile_list.php');
}

if (isset($_POST['add'])) {
    $from = (int)$_POST['from'];
    $to = (int)$_POST['to'];
    
    for ($i = $from; $i <= $to; $i++) {
        
        if ($i < 10)
            $smile = '00'.$i;
        elseif ($i < 100)
            $smile = '0'.$i;
        else
            $smile = $i;
            
        $info = getimagesize('http://image.neverlands.ru/forum/smiles/'.$smile.'.gif'); 
        $width = $info[0];
        $height = $info[1];
            
        if ($width > 0 && $height > 0)
        mysql_query('
            INSERT INTO smile_list (smile_id, smile_image, width, height)
            VALUES ('.$i.', \''.(string)$smile.'\', '.intval($width).', '.intval($height).')
        ');
        
        header('Location: smile_list.php');  

    }
}

?>
    <h3>Смайлы</h3>
<form name="smiles" method="post">
<div class="cms_ind">
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
<br />
    Список смайлов: <br/>
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
<tr >
<? 
$i = 0;
$res = mysql_query('select * from smile_list order by smile_id'); 
while ($row = mysql_fetch_assoc($res))
{
    $i++;
    echo '
        <td class="cms_middle" align="center" bgcolor="#'.(!isset($row['collection_id'])?'FFFFFF':'CCCCCC').'">
            <div id="smile_div_'.$row['smile_id'].'" style="cursor: pointer; border: 2px solid white;" onclick="selectSmile(\''.$row['smile_id'].'\'); return false;">
                <input type="hidden" name="smile['.$row['smile_id'].']" id="smile_'.$row['smile_id'].'" value="0" />
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
<br />
    <input type="submit" name="delete" value="Удалить выделенные"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="submit" name="add" value="Добавить новые"/>&nbsp;Диапазон от: <input type="text" name="from" value=""
                                                                                      size="10"/>
    До: <input type="text" name="to" value="" size="10"/>
</div>
<br />
    <a href="smile_collection_list.php">Назад</a><br/><br/>
</form>
<? require('kernel/after.php'); ?>