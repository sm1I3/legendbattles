<?php
require('kernel/before.php');

if (!userHasPermission(262144)) {
    header('Location: index.php');
    die();
}

$global_id = 1; 

$inscode = $_GET['inscode'];
$trfcode = $_GET['trfcode'];

$res = mysql_query('SELECT * FROM d_custom_item WHERE id = '.intval($global_id));
if ($row = mysql_fetch_assoc($res))
    $array = unserialize($row['description']);
    
    
$trf = $array['trf'];
$color = $array['color'];
$color_a = $array['color_a'];
$ins = $array['ins'];
$grpn = $array['grpn'];
$modn = $array['modn'];

$akeys = $array['akeys'];

$grchk = $array['grchk'];

//dump($akeys);

foreach($grchk as $um => $grp)
{
    $group[$grp][] = $um;
}

if (isset($_POST['delete']))
{
    unset($array['itmp'][$inscode][$trfcode]);
    $key = array_search($inscode, $array['akeys'][$trfcode]);
    /*
    dump($array['akeys']);
    dump($key);
    */
    if ($key)
        unset($array['akeys'][$trfcode][$key]);
    /*
    dump($array['akeys']);
    die();
    */    
    mysql_query('UPDATE d_custom_item SET description = \''.mysql_escape_string(serialize($array)).'\' WHERE id = '.intval($global_id));
    
    header('Location: dealers_custom_item_list.php');
    die();
}


if (isset($_POST['action']) && $_POST['action'] == 'save')
{
    
    $item = array();
    foreach($group as $gcode => $params)
    {
        foreach($params as $param)
        {
            if (isset($_POST['value_'.$param]) && is_array($_POST['value_'.$param]))
                foreach($_POST['value_'.$param] as $id => $val)
                    if ($val != '')
                        $item[$gcode][$param][$val] = $_POST['price_'.$param][$id];
        }
    }
    
    $array['itmp'][$inscode][$trfcode] = $item;
    
    if (!in_array($inscode, $array['akeys'][$trfcode]))
        $array['akeys'][$trfcode][] = $inscode;
    
    if (!mysql_query('UPDATE d_custom_item SET description = \''.mysql_escape_string(serialize($array)).'\' WHERE id = '.intval($global_id)))
    {
        die(mysql_error());
    }
    
    header('Location: dealers_custom_item_list.php');
    die(); 
}

if (isset($array['itmp'][$inscode][$trfcode]))
    $item = $array['itmp'][$inscode][$trfcode];
else
    $item = array();

?>
<h3>Редактирование - <span style="color: #<?=$color_a[$trfcode]?>"><?=$trfcode?> <?=$ins[$inscode]?></span></h3> 

<script language="javascript">
function add_fields(param)
{
    td1 = document.createElement('TD');
    textbox = document.createElement('INPUT');
    textbox.type = 'text';
    textbox.name = 'value_'+param+'[]';
    textbox.value = '';
    textbox.size = '3';
    td1.appendChild(textbox);
    
    td2 = document.createElement('TD');
    textbox = document.createElement('INPUT');
    textbox.type = 'text';
    textbox.name = 'price_'+param+'[]';
    textbox.value = '';
    textbox.size = '3';
    td2.appendChild(textbox);
    
    document.getElementById('tr_val_'+param).appendChild(td1);
    document.getElementById('tr_price_'+param).appendChild(td2);
    
    return false;
}
</script>
<form name="change_parmas" action="" method="post">
<?

echo '<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >';
foreach($group as $gcode => $params)
{
    echo '<tr><td class="cms_cap2"><b>'.$grpn[$gcode].'</b></span></td><td class="cms_cap2">&nbsp;</td><td class="cms_cap2">&nbsp;</td></tr>';
    foreach($params as $param)
    {
        $vals = '<table><tr id="tr_val_'.$param.'"><td>Значение</td>';
        $prices = '</tr><tr id="tr_price_'.$param.'"><td>Цена</td>';
        if (isset($item[$gcode][$param]) && is_array($item[$gcode][$param]))
        foreach($item[$gcode][$param] as $val => $price)
        {
            $vals .= '<td><input type="text" name="value_'.$param.'[]" value="'.$val.'" size="3" /></td>';
            $prices .= '<td><input type="text" name="price_'.$param.'[]" value="'.$price.'" size="3" /></td>';
        }
        
        $prices .= '</tr></table>';
        
        echo '
            <tr><td class="cms_middle">'.(isset($modn[$param])?$modn[$param]:'').'</span></td>
            <td class="cms_middle">
                '.$vals.$prices.'
            </td>
            <td class="cms_middle"><a onclick="add_fields(\''.$param.'\'); return false;" href="#">Добавить</a></td></tr>';
    }
}

echo '</table>';

?>
<br />
<input type="hidden" name="action" value="save" />
<input type="submit" name="save" value="Сохранить" />&nbsp;<input type="button" name="save" value="Отмена" onclick="document.location = 'dealers_custom_item_list.php'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input onclick="return confirm('Вы уверены что хотите удалть этот предмет?');" type="submit" name="delete" value="Удалить" />
</form>