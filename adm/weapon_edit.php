<?php
require('kernel/before.php');

if (!userHasPermission(256)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['w_uid']) || !is_numeric($_GET['w_uid']))
    $w_uid = '';
else
    $w_uid = (int)$_GET['w_uid'];
/*    
$fields = array(
    'w_subid' => 'w_subid',
    'w_fortime' => 'w_fortime',
    'w_base' => 'w_base',
    'w_sort' => 'w_sort',
    'w_type' => 'w_type',
    'w_security' => 'w_security',
    'w_hands' => 'w_hands',
    'w_price' => 'w_price',
    'w_n_level' => 'w_n_level',
    'w_n_sex' => 'w_n_sex',
    'w_n_power' => 'w_n_power',
    'w_n_goodlu' => 'w_n_goodlu',
    'w_n_adroit' => 'w_n_adroit',
    'w_n_intell' => 'w_n_intell',
    'w_n_wisdom' => 'w_n_wisdom',
    'w_n_health' => 'w_n_health',
    'w_n_massa' => 'w_n_massa',
    'w_n_um_1' => 'w_n_um_1',
    'w_n_um_2' => 'w_n_um_2',
    'w_n_um_3' => 'w_n_um_3',
    'w_n_um_4' => 'w_n_um_4',
    'w_n_um_5' => 'w_n_um_5',
    'w_n_um_6' => 'w_n_um_6',
    'w_n_um_7' => 'w_n_um_7',
    'w_n_um_8' => 'w_n_um_8',
    'w_n_um_9' => 'w_n_um_9',
    'w_n_um_10' => 'w_n_um_10',
    'w_n_um_12' => 'w_n_um_12',
    'w_n_um_13' => 'w_n_um_13',
    'w_n_um_14' => 'w_n_um_14',
    'w_n_um_15' => 'w_n_um_15',
    'w_n_um_23' => 'w_n_um_23',
    'w_n_um_25' => 'w_n_um_25',
    'w_n_um_27' => 'w_n_um_27',
    'w_n_um_29' => 'w_n_um_29',
    'w_n_um_31' => 'w_n_um_31',
    'w_n_um_32' => 'w_n_um_32',
    'w_n_um_35' => 'w_n_um_35',
    'w_n_um_36' => 'w_n_um_36',
    'w_n_um_37' => 'w_n_um_37',
    'w_n_um_38' => 'w_n_um_38',
    'w_n_od' => 'w_n_od',
    'w_cursolid' => 'w_cursolid',
    'w_maxsolid' => 'w_maxsolid',
    'w_min_dam' => 'w_min_dam',
    'w_max_dam' => 'w_max_dam',
    'w_karmanov' => 'w_karmanov ',
    'w_kr' => 'w_kr',
    'w_ankr' => 'w_ankr',
    'w_uv' => 'w_uv',
    'w_anuv' => 'w_anuv',
    'w_bro' => 'w_bro',
    'w_pro' => 'w_pro',
    'w_add_massa' => 'w_add_massa',
    'w_add_hp' => 'w_add_hp',
    'w_add_ma' => 'w_add_ma',
    'w_add_force' => 'w_add_force',
    'w_add_goodlu' => 'w_add_goodlu',
    'w_add_adroit' => 'w_add_adroit',
    'w_add_intell' => 'w_add_intell',
    'w_add_wisdom' => 'w_add_wisdom',
    'w_restore_hp' => 'w_restore_hp',
    'w_restore_ma' => 'w_restore_ma',
    'w_add_um_1' => 'w_add_um_1',
    'w_add_um_2' => 'w_add_um_2',
    'w_add_um_3' => 'w_add_um_3',
    'w_add_um_4' => 'w_add_um_4',
    'w_add_um_5' => 'w_add_um_5',
    'w_add_um_6' => 'w_add_um_6',
    'w_add_um_7' => 'w_add_um_7',
    'w_add_um_8' => 'w_add_um_8',
    'w_add_um_9' => 'w_add_um_9',
    'w_add_um_10' => 'w_add_um_10',
    'w_add_um_11' => 'w_add_um_11',
    'w_add_um_12' => 'w_add_um_12',
    'w_add_um_13' => 'w_add_um_13',
    'w_add_um_14' => 'w_add_um_14',
    'w_add_um_15' => 'w_add_um_15',
    'w_add_um_16' => 'w_add_um_16',
    'w_add_um_17' => 'w_add_um_17',
    'w_add_um_18' => 'w_add_um_18',
    'w_add_um_19' => 'w_add_um_19',
    'w_add_um_20' => 'w_add_um_20',
    'w_add_um_21' => 'w_add_um_21',
    'w_add_um_22' => 'w_add_um_22',
    'w_add_um_23' => 'w_add_um_23',
    'w_add_um_24' => 'w_add_um_24',
    'w_add_um_25' => 'w_add_um_25',
    'w_add_um_26' => 'w_add_um_26',
    'w_add_um_27' => 'w_add_um_27',
    'w_add_um_28' => 'w_add_um_28',
    'w_add_um_29' => 'w_add_um_29',
    'w_add_um_30' => 'w_add_um_30',
    'w_add_um_31' => 'w_add_um_31',
    'w_add_um_32' => 'w_add_um_32',
    'w_add_um_33' => 'w_add_um_33',
    'w_add_um_34' => 'w_add_um_34',
    'w_add_um_35' => 'w_add_um_35',
    'w_add_um_36' => 'w_add_um_36',
    'w_add_um_37' => 'w_add_um_37',
    'w_add_um_38' => 'w_add_um_38',
);
*/
/*
$res = mysqli_query($GLOBALS['db_link'],'select * from weapon_properties');
while($row = mysqli_fetch_assoc($res)) {
    $fields[$row['property_code']] = $row['property_name'];
}
*/

$property_types = array(
    1 => 'Основные требования',
    2 => 'Требования умений',
    3 => 'Основные хар-ки',
    4 => 'Дополнительные умения'
);

$weapon_properties = array();
$res = mysqli_query($GLOBALS['db_link'], 'select * from weapon_properties');
while ($row = mysqli_fetch_assoc($res))
    $weapon_properties[$row['property_code']] = $row;
mysqli_free_result($res);

if ($w_uid == '' && !isset($_GET['clone_w_uid'])) 
{
    foreach($weapon_properties as $f=>$name)
        $weapon[$f] = 0;
    $weapon['w_name'] = '';
    $weapon['w_image'] = '';
    $weapon['w_category'] = '';
    $weapon['w_id'] = '';
} 
else 
{
    if (isset($_GET['clone_w_uid']))
        $w_uid = $_GET['clone_w_uid'];
    $weapon = array();
    $res = mysqli_query($GLOBALS['db_link'], 'select * from weapons_template where w_uid = ' . intval($w_uid));
    if ($row = mysqli_fetch_assoc($res))
    {
        foreach($weapon_properties as $f=>$name)
            $weapon[$f] = $row[$f];
        $weapon['w_name'] = $row['w_name'];
        $weapon['w_image'] = $row['w_image'];
        $weapon['w_category'] = $row['w_category'];
        $weapon['w_id'] = $row['w_id'];
    }
    mysqli_free_result($res);
    
    if (isset($_GET['clone_w_uid']))
        $w_uid = '';
}

if (isset($_POST['w_name'])) 
{
    
    if ($w_uid == '') 
    {
        
        $fnames = $fvalues = '';
        foreach($weapon_properties as $code=>$name) 
        {
            $fnames .= $code.',';
            if (isset($_POST['property'])) {
                $i = array_search($code, $_POST['property']);
                if ($code == 'w_koef')
                    $fvalues .= ($i?(float)$_POST['property_value'][$i]:'0').',';
                else
                    $fvalues .= ($i?(int)$_POST['property_value'][$i]:'0').',';
            } else
                $fvalues .= '0,';
        }
            
        $query = '
        insert into weapons_template
        (
            w_name,
            w_category,
            w_image,
            '.$fnames.'
            w_id
        ) values (
            \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['w_name']) . '\',
            \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['w_category']) . '\',
            \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['w_image']) . '\',
            '.$fvalues.'
            \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['w_id']) . '\'
        )'  ;
    } 
    else 
    {
        
        $fnames = '';
        foreach($weapon_properties as $f=>$name)
            $fnames .= $f.' = '.(isset($_POST[$f])?(int)$_POST[$f]:0).',';
            
        $fnames = '';
        foreach($weapon_properties as $code=>$name) 
        {
            if (isset($_POST['property'])) {
                $i = array_search($code, $_POST['property']);
                if ($code == 'w_koef')
                    $fnames .= $code.' = '.($i?(float)$_POST['property_value'][$i]:'0').',';
                else
                    $fnames .= $code.' = '.($i?(int)$_POST['property_value'][$i]:'0').',';
            } else
                $fnames .= $code.' = 0,';
        }
        
        $query = '
        update weapons_template set
            w_name = \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['w_name']) . '\',
            w_image = \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['w_image']) . '\',
            w_category = \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['w_category']) . '\',
            '.$fnames.'
            w_id = \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['w_id']) . '\'
        where
            w_uid = '.intval($w_uid).'
        '  ;
    }
    /*
    echo $query;
    die();
    */
    if (!mysqli_query($GLOBALS['db_link'], $query))
        die(mysqli_error($GLOBALS['db_link']));
    
    header('Location: '.$_SESSION['pages']['weapon_list']);
    
} 
else 
{
    foreach($weapon_properties as $code=>$name)
        $wprop[$code] = $weapon[$code];
    $_POST = $weapon;
    
}


$weapon_categories = array();
$res = mysqli_query($GLOBALS['db_link'], 'select * from weapon_categories');
while ($row = mysqli_fetch_assoc($res))
    $weapon_categories[$row['category_code']] = $row['category_name'];
mysqli_free_result($res);


$row_id = 0;
$prop_html = array();
$html = '';

foreach($weapon_properties as $code=>$row) {
    $properties[$row['property_type']][$row['property_code']] = $row['property_name'];
    $prop_html[$row['property_type']] = '';
}

foreach($weapon_properties as $code=>$row) {
    if (isset($wprop[$code]) && ($wprop[$code] != 0))
    $prop_html[$row['property_type']] .= '
        <tr id="tr_prop'.$row['property_type'].'_'.(++$row_id).'">
          <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_prop'.$row['property_type'].'_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td> 
          <td align="left" class="cms_middle">'.createSelectFromArray('property['.$row_id.']', $properties[$row['property_type']], $code).'</td>
          <td align="left" class="cms_middle"><input type="text" name="property_value['.$row_id.']" value="'.$wprop[$code].'" /></td>
        </tr>
    ';
}

foreach($property_types as $type=>$name) {
    
    $html .= '
    '.$name.':
    <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_prop'.$type.'" >
        <tr >
            <td class="cms_cap3 normal">Удалить</td>
            <td class="cms_cap3">Название Характеристики</td>
            <td class="cms_cap3">Значение</td>
        </tr>
        '.(isset($prop_html[$type])?$prop_html[$type]:'').'
    </table>
    <a onclick="addItem_select(\'table_prop' . $type . '\', \'tr_prop' . $type . '\', \'property[\'+(++last_id)+\']\', prop' . $type . '_array, \'property_value[\'+last_id+\']\', \'0\'); return false;" href="#">Добавить</a><br />
    <br />
    ';
    
}

?>
    <h3><?= ($w_uid == '' ? 'Добавить оружие' : 'Изменить оружие') ?></h3>
<script language="javascript">
var last_id = <?=(int)$row_id?>;
<? foreach($property_types as $type=>$name) { ?>
<?=createJsArray('prop'.$type.'_array', $properties[$type])?>
<? } ?>
</script>
<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td><span class="cms_star">*</span>Название оружия: &nbsp;</td>
  <td><input name="w_name" type="text" class="cms_fieldstyle1" value="<?=_htext($_POST['w_name'])?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td>Изображение: &nbsp;</td>
  <td><input name="w_image" type="text" class="cms_fieldstyle1" value="<?=_htext($_POST['w_image'])?>" size="30" maxlength="255" /></td>
</tr>
<? if ($_POST['w_image'] != '') { ?>
<tr>
    <td>Картинка: &nbsp;</td>
  <td><img src="http://image.neverlands.ru/weapon/<?=$_POST['w_image']?>" /></td>
</tr>
<? } ?>
<tr>
    <td>Категория оружия: &nbsp;</td>
  <td><?=createSelectFromArray('w_category', $weapon_categories, $_POST['w_category'])?></td>
</tr>
<tr>
  <td>ID: &nbsp;  </td>
  <td><input name="w_id" type="text" class="cms_fieldstyle1" value="<?=_htext($_POST['w_id'])?>" size="30" maxlength="255" /></td>
</tr>
<!--
<? foreach ($fields as $f=>$name) { ?>
<tr>
  <td valign="top"><?=$name?>: &nbsp;  </td>
  <td><input name="<?=$f?>" type="text" class="cms_fieldstyle1" value="<?=_htext($_POST[$f])?>" size="10" maxlength="10" /></td>
</tr>
<? } ?>
-->
</table>

<?=$html?>

    
    
<p></p>
    <input name="submit" type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
    <input name="cancel" type="submit"
           onclick="document.location='<?= $_SESSION['pages']['weapon_list'] ?>'; return false;" class="cms_button1"
           value="Отмена"/>
    <p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>