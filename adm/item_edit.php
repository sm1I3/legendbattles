<?php
require('kernel/before.php');

if (!userHasPermission(64)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['item_id']) || !is_numeric($_GET['item_id']))
    $item_id = '';
else
    $item_id = (int)$_GET['item_id'];
    
// list of all resources
$resource_array = array();
$res = mysql_query('select * from restore_resources');
while($row = mysql_fetch_assoc($res)) {
    $resource_array[$row['resource_id']] = $row['resource_name'];
    $resource_prices[$row['resource_id']] = $row['resource_cost'];
}
mysql_free_result($res);

// list of all weapon categories
$weapon_categories_array = array();
$res = mysql_query('select * from weapon_categories');
while($row = mysql_fetch_assoc($res))
    $weapon_categories_array[$row['category_code']] = $row['category_name'];
mysql_free_result($res);

// list of all weapons
$weapon_array = array();
$res = mysql_query('select * from weapons_template');
while($row = mysql_fetch_assoc($res)) {
    $weapon_array_uid[$row['w_uid']] = $row['w_name'];
}
mysql_free_result($res);

// list of all quests
$quest_array = array();
$res = mysql_query('SELECT * FROM quest_list');
while($row = mysql_fetch_assoc($res)) {
    $tmp_arr = unserialize($row['quest_serilize']);
    $quest_array[$row['quest_id']] = $tmp_arr[0][0].(isset($tmp_arr[0][5]) && $tmp_arr[0][5] != '' ? ' ('.$tmp_arr[0][5].')' : '');
}
mysql_free_result($res);

require('library/modificators.php');
    
if (isset($_POST['item_name'])) {
    
    $tmp_arr = array();
    if ($_POST['add_nl']!='' && is_numeric($_POST['add_nl']))
        $tmp_arr['NL'] = (int)$_POST['add_nl'];
        
    if ($_POST['add_hp']!='' && is_numeric($_POST['add_hp']))
        $tmp_arr['HP'] = (int)$_POST['add_hp'];
        
    if ($_POST['add_mp']!='' && is_numeric($_POST['add_mp']))
        $tmp_arr['MP'] = (int)$_POST['add_mp'];
        
    if ($_POST['add_us']!='' && is_numeric($_POST['add_us']))
        $tmp_arr['US'] = (int)$_POST['add_us'];
        
    if ($_POST['add_lv']!='' && is_numeric($_POST['add_lv']))
        $tmp_arr['LV'] = (int)$_POST['add_lv'];
        
    if ($_POST['add_qu']!='' && is_numeric($_POST['add_qu']))
        $tmp_arr['QU'] = (int)$_POST['add_qu'];
        
    if (isset($_POST['add_mf']) && is_array($_POST['add_mf']) && sizeof($_POST['add_mf'])>0)
    foreach($_POST['add_mf'] as $k=>$v)
        $tmp_arr['MF'][$v] = Array(
            0 => $_POST['add_mf_value'][$k],
            1 => $_POST['add_mf_time'][$k],
        );
        
    if (isset($_POST['add_rm']) && is_array($_POST['add_rm']) && sizeof($_POST['add_rm'])>0)
    foreach($_POST['add_rm'] as $k=>$v) {
        $t_arr = array();
        
        if (is_array($v) && sizeof($v)>0)
            foreach($v as $mf)
                if (trim($mf)!='' && is_numeric($mf))
                    $t_arr[] = $mf;
        
        $tmp_arr['RM'][] = Array(
            0 => $t_arr,
            1 => $_POST['add_rm_value'][$k],
            2 => $_POST['add_rm_time'][$k],
        );
        
        
    }
    
    
    if (isset($_POST['add_rmb']) && is_array($_POST['add_rmb']) && sizeof($_POST['add_rmb'])>0)
    foreach($_POST['add_rmb'] as $k=>$v) {
        $t_arr = array();
        
        if (is_array($v) && sizeof($v)>0)
            foreach($v as $mf)
                if (trim($mf)!='' && is_numeric($mf))
                    $t_arr[] = $mf;
        
        $tmp_arr['RMB'][] = Array(
            0 => $t_arr,
            1 => $_POST['add_rmb_minvalue'][$k],
            2 => $_POST['add_rmb_time'][$k],
            3 => $_POST['add_rmb_maxvalue'][$k],
            4 => (isset($_POST['add_rmb_ispositive'][$k]) && $_POST['add_rmb_ispositive'][$k]=='Y'?1:-1),
        );
    }
    
    if ($_POST['add_aeff_after']!='' && is_numeric($_POST['add_aeff_after']))
        $tmp_arr['AEFF']['EFF'][0] = (int)$_POST['add_aeff_after'];
        
    if ($_POST['add_aeff_duration']!='' && is_numeric($_POST['add_aeff_duration']))
        $tmp_arr['AEFF']['EFF'][1] = (int)$_POST['add_aeff_duration'];
    
    if (isset($_POST['add_aeff_mf']) && is_array($_POST['add_aeff_mf']) && sizeof($_POST['add_aeff_mf'])>0)
    foreach($_POST['add_aeff_mf'] as $k=>$v)
        $tmp_arr['AEFF']['MF'][$v] = Array(
            0 => $_POST['add_aeff_mf_value'][$k],
            1 => $_POST['add_aeff_mf_time'][$k],
        );
        
    if (isset($_POST['add_aeff_rm']) && is_array($_POST['add_aeff_rm']) && sizeof($_POST['add_aeff_rm'])>0)
    foreach($_POST['add_aeff_rm'] as $k=>$v) {
        $t_arr = array();
        
        if (is_array($v) && sizeof($v)>0)
            foreach($v as $mf)
                if (trim($mf)!='' && is_numeric($mf))
                    $t_arr[] = $mf;
        
        $tmp_arr['AEFF']['RM'][] = Array(
            0 => $t_arr,
            1 => $_POST['add_aeff_rm_value'][$k],
            2 => $_POST['add_aeff_rm_time'][$k],
        );
    }
    
    if (isset($_POST['add_aeff_rmb']) && is_array($_POST['add_aeff_rmb']) && sizeof($_POST['add_aeff_rmb'])>0)
    foreach($_POST['add_aeff_rmb'] as $k=>$v) {
        $t_arr = array();
        
        if (is_array($v) && sizeof($v)>0)
            foreach($v as $mf)
                if (trim($mf)!='' && is_numeric($mf))
                    $t_arr[] = $mf;
        
        $tmp_arr['AEFF']['RMB'][] = Array(
            0 => $t_arr,
            1 => $_POST['add_aeff_rmb_minvalue'][$k],
            2 => $_POST['add_aeff_rmb_time'][$k],
            3 => $_POST['add_aeff_rmb_maxvalue'][$k],
            4 => (isset($_POST['add_aeff_rmb_ispositive'][$k]) && $_POST['add_aeff_rmb_ispositive'][$k]=='Y'?1:-1),
        );
    }
    
    if ($_POST['add_aeff_hp']!='' && is_numeric($_POST['add_aeff_hp']))
        $tmp_arr['AEFF']['HP'] = (int)$_POST['add_aeff_hp'];
        
    if ($_POST['add_aeff_mp']!='' && is_numeric($_POST['add_aeff_mp']))
        $tmp_arr['AEFF']['MP'] = (int)$_POST['add_aeff_mp'];
        
    if ($_POST['add_aeff_us']!='' && is_numeric($_POST['add_aeff_us']))
        $tmp_arr['AEFF']['US'] = (int)$_POST['add_aeff_us'];
        
    if (isset($_POST['add_wea']) && $_POST['add_wea'] != '')
        $tmp_arr['WEA'] = $_POST['add_wea'];
        
    $serialized = serialize($tmp_arr);
        
    
    if ($item_id == '') {
        $query = '
        insert into restore_items
        (
            item_name,
            description,
            item_cost,
            item_captcha,
            item_spoiling,
            item_term,
            item_width,
            item_height,
            item_type,
            item_wid,
            item_weight,
            item_durability,
            item_level,
            item_direct,
            item_gos,
            item_params
        ) values (
            \''.mysql_escape_string($_POST['item_name']).'\',
            \''.mysql_escape_string($_POST['description']).'\',
            '.(int)$_POST['item_cost'].',
            '.(isset($_POST['item_captcha']) && $_POST['item_captcha']==1?'1':'0').',
            '.(int)$_POST['item_spoiling'].',
            '.(int)$_POST['item_term'].',
            '.(int)$_POST['item_width'].',
            '.(int)$_POST['item_height'].',
            '.(int)$_POST['item_type'].',
            '.(int)$_POST['item_wid'].',
            '.(float)$_POST['item_weight'].',
            '.(int)$_POST['item_durability'].',
            '.(int)$_POST['item_level'].',
            '.(int)$_POST['item_direct'].',
            '.(int)$_POST['item_gos'].',
            "'.mysql_escape_string($serialized).'"
        )'  ;
        mysql_query($query); 
        $item_id = mysql_insert_id($db);
    } else {
        $query = '
        update restore_items set
            item_name = \''.mysql_escape_string($_POST['item_name']).'\',
            description = \''.mysql_escape_string($_POST['description']).'\',
            item_cost = '.(int)$_POST['item_cost'].',
            item_captcha = '.(isset($_POST['item_captcha']) && $_POST['item_captcha'] == 1?'1':'0').',
            item_spoiling = '.(int)$_POST['item_spoiling'].',
            item_term = '.(int)$_POST['item_term'].',
            item_width = '.(int)$_POST['item_width'].',
            item_height = '.(int)$_POST['item_height'].',
            item_type = '.(int)$_POST['item_type'].',
            item_wid = '.(int)$_POST['item_wid'].',
            item_weight = '.(float)$_POST['item_weight'].',
            item_durability = '.(int)$_POST['item_durability'].',
            item_level = '.(int)$_POST['item_level'].',
            item_direct = '.(int)$_POST['item_direct'].',
            item_gos = '.(int)$_POST['item_gos'].',
            item_params = "'.mysql_escape_string($serialized).'"
        where
            item_id = '.intval($item_id).'
        '  ;
        mysql_query($query); 
    }    
    
    mysql_query('delete from restore_consists where item_id = '.intval($item_id));
    if (isset($_POST['resources']) && is_array($_POST['resources']))
    foreach($_POST['resources'] as $k=>$resource_id)
        if ($resource_id != '')
            mysql_query('insert into restore_consists (item_id, resource_id, resource_amount) values ('.intval($item_id).', '.intval($resource_id).', '.(float)$_POST['resources_amount'][$k].')');
    header('Location: '.$_SESSION['pages']['item_list']);
    
}

$item_consists = '';
$add_mf = '';
$add_rm = '';
$add_rmb = '';
$add_aeff_mf = '';
$add_aeff_rm = '';
$add_aeff_rmb = '';
$row_id = 0; 
if ($item_id == '' && !isset($_GET['clone_id'])) 
{
        
    $item = array(
        'item_name' => '',
        'item_cost' => '',
        'item_captcha' => '',
        'item_spoiling' => '0.00',
        'item_term' => '0.00',
        'item_width' => '',
        'item_height' => '',
        'item_type' => '',
        'item_wid' => '',
        'item_weight' => '0',
        'item_durability' => '0',
        'item_level' => '0',
        'item_direct' => '',
        'item_gos' => '',
        'description' => ''
    );
} 
else 
{
    if (isset($_GET['clone_id']))
        $item_id = $_GET['clone_id'];
        
    $item = array();
    $res = mysql_query('select * from restore_items where item_id = '.intval($item_id));
    if($row = mysql_fetch_assoc($res))
        $item = $row;
    mysql_free_result($res);
    
    $res = mysql_query('select * from restore_consists where item_id = '.intval($item_id));
    while($row = mysql_fetch_assoc($res))
        $item_consists .= '
        <tr id="tr_resource_'.(++$row_id).'">
          <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_resource_'.$row_id.'\'); recalcResourceCount(); recalcResourcePrice(); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
          <td align="left" class="cms_middle">'.createSelectFromArray('resources[]',$resource_array,$row['resource_id'],'id="init_res_'.$row_id.'" onchange="recalcResourceCount(); recalcResourcePrice();"').'</td>
          <td align="left" class="cms_middle"><input type="text" name="resources_amount[]" value="'.$row['resource_amount'].'" id="init_res_'.$row_id.'_count" onchange="recalcResourcePrice();" /></td>
        </tr>';
    mysql_free_result($res);
    
    $add = unserialize($item['item_params']);
    
    if (isset($add['MF']) && is_array($add['MF'])) {
        foreach($add['MF'] as $k=>$row)
        $add_mf .= '
        <tr id="tr_mf_'.(++$row_id).'">
          <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_mf_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
          <td align="left" class="cms_middle">'.createSelectFromArray('add_mf[]', $modificators, $k).'</td>
          <td align="left" class="cms_middle"><input type="text" name="add_mf_value[]" value="'.$row[0].'" /></td>
          <td align="left" class="cms_middle"><input type="text" name="add_mf_time[]" value="'.$row[1].'" /></td>
        </tr>
        ';
    }
    
    if (isset($add['RM']) && is_array($add['RM'])) {
        foreach($add['RM'] as $row) {
            $tmp_fields = '';
            $row_id++;
            
            if (isset($row[0]) && is_array($row[0]))
            foreach($row[0] as $m) {
                $tmp_fields .= ($tmp_fields!=''?'<br />':'').createSelectFromArray('add_rm['.$row_id.'][]', $modificators, $m);
                
            }
            
            $add_rm .= '
            <tr id="tr_rm_'.$row_id.'">
              <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_rm_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
              <td class="cms_middle" align="center"><a href="#" onclick="addItemField_rm(\'td_rm_'.$row_id.'\', \'add_rm['.$row_id.'][]\', mod_array); return false;" title="Remove"><img src="images/cms_icons/cms_add.gif" width="16" height="16" /></a></td>
              <td align="left" class="cms_middle" id="td_rm_'.$row_id.'">'.$tmp_fields.'</td>
              <td align="left" class="cms_middle"><input type="text" name="add_rm_value['.$row_id.']" value="'.$row[1].'" /></td>
              <td align="left" class="cms_middle"><input type="text" name="add_rm_time['.$row_id.']" value="'.$row[2].'" /></td>
            </tr>
            ';
        }
    }
    
    if (isset($add['RMB']) && is_array($add['RMB'])) {
        foreach($add['RMB'] as $row) {
            $tmp_fields = '';
            $row_id++;
            
            if (isset($row[0]) && is_array($row[0]))
            foreach($row[0] as $m)
                $tmp_fields .= ($tmp_fields!=''?'<br />':'').createSelectFromArray('add_rmb['.$row_id.'][]', $modificators, $m);
                
            $add_rmb .= '
            <tr id="tr_rmb_'.$row_id.'">
              <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_rmb_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
              <td class="cms_middle" align="center"><a href="#" onclick="addItemField_rm(\'td_rmb_'.$row_id.'\', \'add_rmb['.$row_id.'][]\', mod_array); return false;" title="Remove"><img src="images/cms_icons/cms_add.gif" width="16" height="16" /></a></td>
              <td align="left" class="cms_middle" id="td_rmb_'.$row_id.'">'.$tmp_fields.'</td>
              <td align="left" class="cms_middle"><input type="text" name="add_rmb_minvalue['.$row_id.']" value="'.$row[1].'" /></td>
              <td align="left" class="cms_middle"><input type="text" name="add_rmb_time['.$row_id.']" value="'.$row[2].'" /></td>
              <td align="left" class="cms_middle"><input type="text" name="add_rmb_maxvalue['.$row_id.']" value="'.$row[3].'" /></td>
              <td align="left" class="cms_middle"><input type="checkbox" name="add_rmb_ispositive['.$row_id.']" value="Y" '.($row[4]==1?'checked="checked"':'').' /></td>
            </tr>
            ';
        }
    }
    
    if (isset($add['AEFF']['MF']) && is_array($add['AEFF']['MF'])) {
        foreach($add['AEFF']['MF'] as $k=>$row)
        $add_aeff_mf .= '
        <tr id="tr_aeff_mf_'.(++$row_id).'">
          <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_aeff_mf_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
          <td align="left" class="cms_middle">'.createSelectFromArray('add_aeff_mf[]', $modificators, $k).'</td>
          <td align="left" class="cms_middle"><input type="text" name="add_aeff_mf_value[]" value="'.$row[0].'" /></td>
          <td align="left" class="cms_middle"><input type="text" name="add_aeff_mf_time[]" value="'.$row[1].'" /></td>
        </tr>
        ';
    }
    
    if (isset($add['AEFF']['RM']) && is_array($add['AEFF']['RM'])) {
        foreach($add['AEFF']['RM'] as $row) {
            $tmp_fields = '';
            $row_id++;
            
            if (isset($row[0]) && is_array($row[0]))
            foreach($row[0] as $m)
                $tmp_fields .= ($tmp_fields!=''?'<br />':'').''.createSelectFromArray('add_aeff_rm['.$row_id.'][]', $modificators, $m);
            
            $add_aeff_rm .= '
            <tr id="tr_aeff_rm_'.$row_id.'">
              <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_aeff_rm_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
              <td class="cms_middle" align="center"><a href="#" onclick="addItemField_rm(\'td_aeff_rm_'.$row_id.'\', \'add_aeff_rm['.$row_id.'][]\', mod_array); return false;" title="Remove"><img src="images/cms_icons/cms_add.gif" width="16" height="16" /></a></td>
              <td align="left" class="cms_middle" id="td_aeff_rm_'.$row_id.'">'.$tmp_fields.'</td>
              <td align="left" class="cms_middle"><input type="text" name="add_aeff_rm_value['.$row_id.']" value="'.$row[1].'" /></td>
              <td align="left" class="cms_middle"><input type="text" name="add_aeff_rm_time['.$row_id.']" value="'.$row[2].'" /></td>
            </tr>
            ';
        }
    }
    
    if (isset($add['AEFF']['RMB']) && is_array($add['AEFF']['RMB'])) {
        foreach($add['AEFF']['RMB'] as $row) {
            $tmp_fields = '';
            $row_id++;
            
            if (isset($row[0]) && is_array($row[0]))
            foreach($row[0] as $m)
                $tmp_fields .= ($tmp_fields!=''?'<br />':'').createSelectFromArray('add_aeff_rmb['.$row_id.'][]', $modificators, $m);
                
            $add_aeff_rmb .= '
            <tr id="tr_aeff_rmb_'.$row_id.'">
              <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_aeff_rmb_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
              <td class="cms_middle" align="center"><a href="#" onclick="addItemField_rm(\'td_aeff_rmb_'.$row_id.'\', \'add_aeff_rmb['.$row_id.'][]\', mod_array); return false;" title="Remove"><img src="images/cms_icons/cms_add.gif" width="16" height="16" /></a></td>
              <td align="left" class="cms_middle" id="td_aeff_rmb_'.$row_id.'">'.$tmp_fields.'</td>
              <td align="left" class="cms_middle"><input type="text" name="add_aeff_rmb_minvalue['.$row_id.']" value="'.$row[1].'" /></td>
              <td align="left" class="cms_middle"><input type="text" name="add_aeff_rmb_time['.$row_id.']" value="'.$row[2].'" /></td>
              <td align="left" class="cms_middle"><input type="text" name="add_aeff_rmb_maxvalue['.$row_id.']" value="'.$row[3].'" /></td>
              <td align="left" class="cms_middle"><input type="checkbox" name="add_aeff_rmb_ispositive['.$row_id.']" value="Y" '.($row[4]==1?'checked="checked"':'').' /></td>
            </tr>
            ';
        }
    }
    //dump($add);
    if (isset($_GET['clone_id']))
        $item_id = '';
}

?>
<link rel="stylesheet" href="files/modalwindow.css" type="text/css" />
<script src="jscript/ajax.js" language="javascript" charset="windows-1251"></script>
<script src="jscript/modal_window.js" language="javascript" charset="windows-1251"></script>
<script src="jscript/controls/weapon_control.js" language="javascript" charset="windows-1251"></script>
<script src="jscript/items.js" language="javascript" charset="windows-1251"></script> 
<script language="javascript">
var last_id = <?=(int)$row_id?>;
<?=createJsArray('res_array', $resource_array);?>
<?=createJsArray('res_prices', $resource_prices);?>
<?=createJsArray('mod_array', $modificators);?>
<?=createJsArray('weapon_categories', $weapon_categories_array)?> 
</script>
<h3><?=($item_id == ''?'Добавить предмет':'Изменить предмет')?></h3>
<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
  <td><span class="cms_star">*</span>Название предмета: &nbsp;  </td>
  <td><input name="item_name" type="text" class="cms_fieldstyle1" value="<?=$item['item_name']?>" size="30" maxlength="255" /></td>
</tr>
<? if ($item_id != '') { ?>
<tr>
  <td>Картинка: &nbsp;  </td>
  <td><img src="http://image.neverlands.ru/tools/<?=$item_id?>.gif" /></td>
</tr>
<? } ?>
<tr>
  <td>Стоимость: &nbsp;  </td>
  <td><input name="item_cost" type="text" class="cms_fieldstyle1" value="<?=$item['item_cost']?>" size="10" maxlength="255" id="item_cost_total" onchange="recalcResourceCount(); recalcResourcePrice();" /></td>
</tr>
<tr>
  <td>Captcha: &nbsp;  </td>
  <td><input name="item_captcha" type="checkbox" value="1" <?=($item['item_captcha']==1?'checked="checked"':'')?> /></td>
</tr>
<tr>
  <td>Item Spoiling: &nbsp;  </td>
  <td><input name="item_spoiling" type="text" class="cms_fieldstyle1" value="<?=$item['item_spoiling']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
  <td>Item Term: &nbsp;  </td>
  <td><input name="item_term" type="text" class="cms_fieldstyle1" value="<?=$item['item_term']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
  <td>Item Width: &nbsp;  </td>
  <td><input name="item_width" type="text" class="cms_fieldstyle1" value="<?=$item['item_width']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
  <td>Item Height: &nbsp;  </td>
  <td><input name="item_height" type="text" class="cms_fieldstyle1" value="<?=$item['item_height']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
  <td>Item Type: &nbsp;  </td>
  <td><input name="item_type" type="text" class="cms_fieldstyle1" value="<?=$item['item_type']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
  <td>Item Wid: &nbsp;  </td>
  <td><input name="item_wid" type="text" class="cms_fieldstyle1" value="<?=$item['item_wid']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
  <td>Item Weight: &nbsp;  </td>
  <td><input name="item_weight" type="text" class="cms_fieldstyle1" value="<?=$item['item_weight']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
  <td>Item Durability: &nbsp;  </td>
  <td><input name="item_durability" type="text" class="cms_fieldstyle1" value="<?=$item['item_durability']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
  <td>Item Level: &nbsp;  </td>
  <td><input name="item_level" type="text" class="cms_fieldstyle1" value="<?=$item['item_level']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
  <td>Item Direct: &nbsp;  </td>
  <td><input name="item_direct" type="text" class="cms_fieldstyle1" value="<?=$item['item_direct']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
  <td>Item Gos: &nbsp;  </td>
  <td><input name="item_gos" type="text" class="cms_fieldstyle1" value="<?=$item['item_gos']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
  <td valign="top">Description: &nbsp;  </td>
  <td><textarea name="description" cols="40" rows="4"><?=_htext($item['description'])?></textarea></td>
</tr>
</table>
<br />
Состав предмета: (<span id="init_res_total_info">0</span>)
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_resources" >
<tr >
    <td class="cms_cap3">Удалить</td>
    <td class="cms_cap3">Название ресурса</td>
    <td class="cms_cap3">Количество</td>
</tr>
<?=$item_consists?>
</table>
<script language="javascript">recalcResourcePrice();</script>
<a onclick="addItem_item_initres('table_resources', 'tr_resource', 'resources[]', res_array, 'resources_amount[]', '1'); return false;" href="#">Add resource</a><br />
<br />
Дополнительные пораметры:
<table border="0" cellpadding="0" cellspacing="1">
<tr>
  <td>Ограничение по количеству (0 - нет ограничения): &nbsp;  </td>
  <td><input name="add_nl" type="text" class="cms_fieldstyle1" value="<?=(isset($add['NL'])?$add['NL']:'')?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Здоровье: &nbsp;  </td>
  <td><input name="add_hp" type="text" class="cms_fieldstyle1" value="<?=(isset($add['HP'])?$add['HP']:'')?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Мана: &nbsp;  </td>
  <td><input name="add_mp" type="text" class="cms_fieldstyle1" value="<?=(isset($add['MP'])?$add['MP']:'')?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Усталость: &nbsp;  </td>
  <td><input name="add_us" type="text" class="cms_fieldstyle1" value="<?=(isset($add['US'])?$add['US']:'')?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Требуемый уровень: &nbsp;  </td>
  <td><input name="add_lv" type="text" class="cms_fieldstyle1" value="<?=(isset($add['LV'])?$add['LV']:'')?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Требуемый квест: &nbsp;  </td>
  <td><?=createSelectFromArray('add_qu', $quest_array, (isset($add['QU'])?$add['QU']:''))?></td>
</tr>
</table>


Влияние на модификаторы:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_mf" >
<tr >
    <td class="cms_cap3">Удалить</td>
    <td class="cms_cap3">Модификатор</td>
    <td class="cms_cap3">Значение</td>
    <td class="cms_cap3">Время в минутах</td>
</tr>
<?=$add_mf?>
</table>
<a onclick="addItem_item_mf('table_mf', 'tr_mf', 'add_mf', mod_array); return false;" href="#">Добавить модификатор</a><br />
<br />


Влияние на случайные модификаторы:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_rm" >
<tr >
    <td class="cms_cap3">Удалить</td>
    <td class="cms_cap3">Добавить</td>
    <td class="cms_cap3">Модификаторы</td>
    <td class="cms_cap3">Значение</td>
    <td class="cms_cap3">Время в минутах</td>
</tr>
<?=$add_rm?>
</table>
<a onclick="addItem_item_rm('table_rm', 'tr_rm', 'add_rm', mod_array, 'td_rm'); return false;" href="#">Добавить группу модификаторов</a><br />
<br />


Случайное влияние на случайные модификаторы:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_rmb" >
<tr >
    <td class="cms_cap3">Удалить</td>
    <td class="cms_cap3">Добавить</td>
    <td class="cms_cap3">Модификаторы</td>
    <td class="cms_cap3">Минимальное значение</td>
    <td class="cms_cap3">Время в минутах</td>
    <td class="cms_cap3">Максимальное значение</td>
    <td class="cms_cap3">Положительный эффект</td>
</tr>
<?=$add_rmb?>
</table>
<a onclick="addItem_item_rmb('table_rmb', 'tr_rmb', 'add_rmb', mod_array, 'td_rmb'); return false;" href="#">Добавить группу модификаторов</a><br />
<br />
<br />


Эффекты, применяемые по истечению времени:<br />
<table border="0" cellpadding="0" cellspacing="1">
<tr>
  <td>Кол-во времени: &nbsp;  </td>
  <td><input name="add_aeff_after" type="text" class="cms_fieldstyle1" value="<?=(isset($add['AEFF']['EFF'][0])?$add['AEFF']['EFF'][0]:'')?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Длительность эффекта: &nbsp;  </td>
  <td><input name="add_aeff_duration" type="text" class="cms_fieldstyle1" value="<?=(isset($add['AEFF']['EFF'][1])?$add['AEFF']['EFF'][1]:'')?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Здоровье: &nbsp;  </td>
  <td><input name="add_aeff_hp" type="text" class="cms_fieldstyle1" value="<?=(isset($add['AEFF']['HP'])?$add['AEFF']['HP']:'')?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Мана: &nbsp;  </td>
  <td><input name="add_aeff_mp" type="text" class="cms_fieldstyle1" value="<?=(isset($add['AEFF']['MP'])?$add['AEFF']['MP']:'')?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Усталость: &nbsp;  </td>
  <td><input name="add_aeff_us" type="text" class="cms_fieldstyle1" value="<?=(isset($add['AEFF']['US'])?$add['AEFF']['US']:'')?>" size="30" maxlength="255" /></td>
</tr>
</table><br />

Влияние на модификаторы:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_aeff_mf" >
 <tr >
    <td class="cms_cap3">Удалить</td>
    <td class="cms_cap3">Модификатор</td>
    <td class="cms_cap3">Значение</td>
    <td class="cms_cap3">Время в минутах</td>
</tr>
<?=$add_aeff_mf?>
</table>
<a onclick="addItem_item_mf('table_aeff_mf', 'tr_aeff_mf', 'add_aeff_mf', mod_array); return false;" href="#">Добавить модификатор</a><br />
<br />


Влияние на случайные модификаторы:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_aeff_rm" >
 <tr >
    <td class="cms_cap3">Удалить</td>
    <td class="cms_cap3">Добавить</td>
    <td class="cms_cap3">Модификаторы</td>
    <td class="cms_cap3">Значение</td>
    <td class="cms_cap3">Время в минутах</td>
</tr>
<?=$add_aeff_rm?>
</table>
<a onclick="addItem_item_rm('table_aeff_rm', 'tr_aeff_rm', 'add_aeff_rm', mod_array, 'td_aeff_rm'); return false;" href="#">Добавить группу модификаторов</a><br />
<br />


Случайное влияние на случайные модификаторы:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_aeff_rmb" >
 <tr >
    <td class="cms_cap3">Удалить</td>
    <td class="cms_cap3">Добавить</td>
    <td class="cms_cap3">Модификаторы</td>
    <td class="cms_cap3">Минимальное значение</td>
    <td class="cms_cap3">Время в минутах</td>
    <td class="cms_cap3">Максимальное значение</td>
    <td class="cms_cap3">Положительный эффект</td>
</tr>
<?=$add_aeff_rmb?>
</table>
<a onclick="addItem_item_rmb('table_aeff_rmb', 'tr_aeff_rmb', 'add_aeff_rmb', mod_array, 'td_aeff_rmb'); return false;" href="#">Добавить группу модификаторов</a><br />
<br />

<table border="0" cellpadding="0" cellspacing="1">
<tr>
  <td><span class="cms_star">*</span>Вместо инструмента использовать оружие: &nbsp;  </td>
  <td><?=createWeaponControl('add_wea', 'uid', (isset($add['WEA'])?$add['WEA']:''), (isset($add['WEA'])?$weapon_array_uid[$add['WEA']]:''))?></td>
</tr>
</table>
    
<p></p>
  <input name="submit"  type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
  <input name="cancel" type="submit" onclick="document.location='<?=$_SESSION['pages']['item_list']?>'; return false;" class="cms_button1" value="Отмена" />
<p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>