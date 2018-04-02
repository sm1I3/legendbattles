<?php
require('kernel/before.php');

if (!userHasPermission(2)) {
    header('Location: index.php');
    die();
}

//foreach($_POST as $key=>$value) print('$_POST["'.$key.'"] = '.$value.'<br>');

//die();

if (!isset($_GET['quest_id']) || !is_numeric($_GET['quest_id']))
    $quest_id = '';
else
    $quest_id = (int)$_GET['quest_id'];
    
$sexes = array(
    2 => 'Любой',
    0 => 'Мужской',
    1 => 'Женский',
);
    
$aligns = array(
    1 => 'Дети Тьмы',
    2 => 'Дети Света',
    3 => 'Дети Сумерек',
    4 => 'Дети Хаоса',
);

$item_actions = array(
    1 => 'Продать',
    2 => 'Передавать',
    4 => 'Дарить',
    8 => 'Сдать в гос',
    16 => 'Выставлять на аукцион',
    32 => 'Выкидывать',
);

$pl_types = array(
    0 => 'Любой',
    1 => 'Воин',
    2 => 'Маг',
);
    
$quest_groups = array();
$res = mysqli_query($GLOBALS['db_link'], 'select * from quest_groups');
while ($row = mysqli_fetch_assoc($res))
    $quest_groups[$row['quest_group_id']] = $row['quest_group_name'];
    
// list of all quests
$quest_array = array();
$res = mysqli_query($GLOBALS['db_link'], 'SELECT * FROM quest_list');
while ($row = mysqli_fetch_assoc($res)) {
    $tmp_arr = unserialize($row['quest_serilize']);
    $quest_array[$row['quest_id']] = $tmp_arr[0][0].(isset($tmp_arr[0][5]) && $tmp_arr[0][5] != '' ? ' ('.$tmp_arr[0][5].')' : '');
}
mysqli_free_result($res);

// list of all abilities
$image_array = array();
$res = mysqli_query($GLOBALS['db_link'], 'select * from quest_images');
while ($row = mysqli_fetch_assoc($res)) {
    $image_array[$row['image']] = $row['image_name'];
}
mysqli_free_result($res);

// list of all abilities
$ability_array = array();
$res = mysqli_query($GLOBALS['db_link'], 'select * from ability_list');
while ($row = mysqli_fetch_assoc($res)) {
    $ability_array[$row['ability_id']] = $row['ability_name'];
}
mysqli_free_result($res);

// list of sps abilities
$sps_abilities = array(
    'forcep' => 'Сила',
    'adroitness' => 'Ловкость',
    'goodluck' => 'Удача',
    'health' => 'Здоровье',
    'intellect' => 'Знания',
    'um_11' => 'Доп. ОД',
);

// list of all resources
$resource_array = array();
$res = mysqli_query($GLOBALS['db_link'], 'select * from restore_resources');
while ($row = mysqli_fetch_assoc($res))
    $resource_array[$row['resource_id']] = $row['resource_name'];
mysqli_free_result($res);

// list of all weapon categories
$weapon_categories_array = array();
$res = mysqli_query($GLOBALS['db_link'], 'select * from weapon_categories');
while ($row = mysqli_fetch_assoc($res))
    $weapon_categories_array[$row['category_code']] = $row['category_name'];
mysqli_free_result($res);

// list of all weapons
$weapon_array = array();
$res = mysqli_query($GLOBALS['db_link'], 'select * from items');
while ($row = mysqli_fetch_assoc($res)) {
    $weapon_array_id[$row['id']] = $row['name'];
}
mysqli_free_result($res);

if (isset($_POST['quest_name'])) 
{
    
    $temp_arr = array();
    
    $temp_arr[0][0] = $_POST['quest_name'];
    $temp_arr[0][1] = $_POST['quest_image'];
    $temp_arr[0][2] = $_POST['quest_time'];
    $temp_arr[0][3] = (isset($_POST['quest_uncompletable']) && $_POST['quest_uncompletable']=='Y'?1:0);
    $temp_arr[0][4] = $_POST['quest_repeat'];
    $temp_arr[0][5] = $_POST['quest_comment'];
    
    if ($_POST['req_level']!='' && is_numeric($_POST['req_level']))
        $temp_arr[1]['LV'] = $_POST['req_level'];
        
    if ($_POST['req_align']!='' && is_numeric($_POST['req_align']))
        $temp_arr[1]['ALIGN'] = $_POST['req_align'];
        
    if ($_POST['req_gender']!='' && is_numeric($_POST['req_gender']))
        $temp_arr[1]['GENDER'] = $_POST['req_gender'];
        
    if ($_POST['req_nv']!='' && is_numeric($_POST['req_nv']))
        $temp_arr[2]['NV'] = $_POST['req_nv'];
        
    if ($_POST['req_npc']!='' && is_numeric($_POST['req_npc']))
        $temp_arr[2]['NPC'] = $_POST['req_npc'];
        
    if ($_POST['req_pvp']!='' && is_numeric($_POST['req_pvp']))
        $temp_arr[2]['PVP'] = $_POST['req_pvp'];
        
    if (isset($_POST['qe']) && is_array($_POST['qe']))
    foreach($_POST['qe'] as $qe)
        if ($qe != '')
            $temp_arr[1]['QE'][] = $qe;
            
    if (isset($_POST['qa']) && is_array($_POST['qa']))
    foreach($_POST['qa'] as $qe)
        if ($qe != '')
            $temp_arr[1]['QA'][] = $qe;
            
    if (isset($_POST['qna']) && is_array($_POST['qna']))
    foreach($_POST['qna'] as $qe)
        if ($qe != '')
            $temp_arr[1]['QNA'][] = $qe;
            
    if (isset($_POST['qu']) && is_array($_POST['qu']))
    foreach($_POST['qu'] as $qe)
        if ($qe != '')
            $temp_arr[1]['QU'][] = $qe;
            
    if (isset($_POST['qd']) && is_array($_POST['qd']))
    foreach($_POST['qd'] as $qe)
        if ($qe != '')
            $temp_arr[2]['QD'][] = $qe;
            
    if (isset($_POST['quest_price']) && $_POST['quest_price']!='' && is_numeric($_POST['quest_price']))
        $temp_arr[2]['MON'] = $_POST['quest_price'];
		if (isset($_POST['quest_price1']) && $_POST['quest_price1']!='' && is_numeric($_POST['quest_price1']))
				$temp_arr[2]['BAKS'] = $_POST['quest_price1'];
        
    if (isset($_POST['req_um']) && is_numeric($_POST['req_um']))
        $temp_arr[1]['UM'] = Array($_POST['req_um'], (int)$_POST['req_um_count']);
        
    if(isset($_POST['req_wea']) && is_array($_POST['req_wea']))
    {
        /*
        print('<pre>');
        print_r($_POST['req_wea']);
        print('</pre>');
        */
        foreach($_POST['req_wea'] as $k=>$v) 
        {
            $temp_arr[2]['WEA'][$_POST['req_wea_group'][$k]][$v] = array(0 => $_POST['req_wea_count'][$k],1 => $_POST['req_wea_time'][$k],2 => (isset($_POST['req_wea_self'][$k]) && $_POST['req_wea_self'][$k] == 'Y' ? 0 : 1));
            
        }
    }
    
    if (isset($_POST['req_res']) && is_array($_POST['req_res']))
    {
        foreach($_POST['req_res'] as $k=>$v) 
        {
            $temp_arr[2]['RES'][ $_POST['req_res_group'][$k] ][$v] = $_POST['req_res_count'][$k];
        }
    }
    
    if (isset($_POST['req_sps']) && is_array($_POST['req_sps']))
    {
        foreach($_POST['req_sps'] as $k=>$v) 
        {
            $temp_arr[1]['SPS'][$v] = $_POST['req_sps_count'][$k];
        }
    }
    
    if (isset($_POST['req_spf']) && is_array($_POST['req_spf']))
    {
        foreach($_POST['req_spf'] as $k=>$v) 
        {
            $temp_arr[2]['SPF'][$v] = $_POST['req_spf_count'][$k];
        }
    }
    
    $temp_arr[3] = array();    
    if (isset($_POST['hello_text']) && is_array($_POST['hello_text']))
    foreach($_POST['hello_text'] as $txt)
        $temp_arr[3][] = $txt;
        
    $temp_arr[4] = array();    
    if (isset($_POST['success_text']) && is_array($_POST['success_text']))
    foreach($_POST['success_text'] as $txt)
        $temp_arr[4][] = $txt;
        
    $temp_arr[5] = array();    
    if (isset($_POST['confirm_text']) && is_array($_POST['confirm_text']))
    foreach($_POST['confirm_text'] as $txt)
        $temp_arr[5][] = $txt;
        
    $temp_arr[6] = array();    
    if (isset($_POST['time_limit_text']) && is_array($_POST['time_limit_text']))
    foreach($_POST['time_limit_text'] as $txt)
        $temp_arr[6][] = $txt;
    
    $temp_arr[7] = array();    
    if (isset($_POST['completed_text']) && is_array($_POST['completed_text']))
    foreach($_POST['completed_text'] as $txt)
        $temp_arr[7][] = $txt; 
        
    $temp_arr[8] = array();    
    if (isset($_POST['unable_to_confirm_text']) && is_array($_POST['unable_to_confirm_text']))
    foreach($_POST['unable_to_confirm_text'] as $txt)
        $temp_arr[8][] = $txt;
        
    $temp_arr[9] = array();    
    if (isset($_POST['unable_to_complete_text']) && is_array($_POST['unable_to_complete_text']))
    foreach($_POST['unable_to_complete_text'] as $txt)
        $temp_arr[9][] = $txt;
        
    $temp_arr[10] = array();    
    if (isset($_POST['time_text']) && is_array($_POST['time_text']))
    foreach($_POST['time_text'] as $txt)
        $temp_arr[10][] = $txt;
        
    $temp_arr[11] = array();
    
    $temp_arr[12]['M_EXP'] = (int)$_POST['rcv_exp'];
		$temp_arr[12]['M_EXP1'] = (int)$_POST['rcv_exp1'];
    $temp_arr[12]['EXP'] = (int)$_POST['rcv_bexp'];
    $temp_arr[12]['MONEY'] = (int)$_POST['rcv_money'];
    $temp_arr[12]['PRE'] = (int)$_POST['present'];
		$temp_arr[12]['PRE2'] = (int)$_POST['present2'];
		$temp_arr[12]['PRE3'] = (int)$_POST['present3'];
    
    if (isset($_POST['rcv_wea']) && is_array($_POST['rcv_wea']))
    foreach($_POST['rcv_wea'] as $wid)
        if ($wid != '')
            $temp_arr[12]['W_UID'][] = $wid;
            
    if (isset($_POST['qha']) && is_array($_POST['qha']))
    foreach($_POST['qha'] as $qe)
        if ($qe != '')
            $temp_arr[12]['QHA'][] = $qe;
            
    
    $temp_arr[12]['WUID'] = array();
    if (isset($_POST['quest_wuid']) && is_array($_POST['quest_wuid']))
    foreach($_POST['quest_wuid'] as $id => $wea)
    {
        $act = 0;
        
        if (isset($_POST['quest_wuid_act'][$id]) && is_array($_POST['quest_wuid_act'][$id]))
        foreach($_POST['quest_wuid_act'][$id] as $actid => $val)
            if ($val == 'Y')
                $act |= $actid;
                
        $tmp = array(
            'item' => $_POST['quest_wuid'][$id],
            'char_type' => $_POST['quest_wuid_pltype'][$id],
            'sex' => $_POST['quest_wuid_sex'][$id],
            //'long_q' => (isset($_POST['pr_item_dolg_1'][$id]) && $_POST['pr_item_dolg_1'][$id]=='Y' ? 1 : 0),
            'long' => (isset($_POST['quest_wuid_dolg'][$id]) ? $_POST['quest_wuid_dolg'][$id] : ''),
            //'price_q' => (isset($_POST['pr_item_price_1'][$id]) && $_POST['pr_item_price_1'][$id]=='Y' ? 1 : 0),
            'price' => (isset($_POST['quest_wuid_price'][$id]) ? $_POST['quest_wuid_price'][$id] : ''),
            'expire' => (isset($_POST['quest_wuid_expire'][$id]) ? $_POST['quest_wuid_expire'][$id] : ''),
            'actions' => $act
        );
        
        if ($_POST['quest_wuid_count'][$id] != '')
            $tmp['count'] = $_POST['quest_wuid_count'][$id];
        
        $temp_arr[12]['WUID'][] = $tmp;
    }
    
    $temp_arr[13] = $_POST['quest_journal_text'];
    
    $serialized = serialize($temp_arr);    
    
    if ($quest_id == '') {
        $query = '
            insert into quest_list 
                (quest_id, quest_group_id, quest_serilize) 
            values 
                (' . (int)$_POST['quest_id'] . ', ' . ($_POST['quest_group_id'] != '' ? intval($_POST['quest_group_id']) : 'NULL') . ', "' . mysqli_escape_string($GLOBALS['db_link'], $serialized) . '")';
    } else {
        $query = '
        update 
            quest_list 
        set 
            quest_id = '.(int)$_POST['quest_id'].',
            quest_group_id = '.($_POST['quest_group_id'] != '' ? intval($_POST['quest_group_id']) : 'NULL').',
            quest_serilize = "' . mysqli_escape_string($GLOBALS['db_link'], $serialized) . '" 
        where 
            quest_id = '.intval($quest_id).'
            '.(!userHasPermission(32)?' and is_confirmed = \'N\'':'').'
            ';
    }
    mysqli_query($GLOBALS['db_link'], $query);
    header('Location: '.$_SESSION['cp_pages']['quest_list']);
}

$req_quests = '';
$req_weapon = '';
$req_res = '';
$req_sps = '';
$req_spf = '';
$rcv_weapon = '';
$req_um = '';
$req_qha_quests = '';

$hello_text = '';
$success_text = '';
$confirm_text = '';
$completed_text = '';
$unable_to_confirm_text = '';
$unable_to_complete_text = '';
$time_text = '';

$row_id = 0; 
if ($quest_id == '' && !isset($_GET['clone_quest_id'])) {
    $quest = array(
        0 => array(
            0 => '',
            1 => '0000',
            2 => '72',
            3 => 0,
            4 => '0',
        )
    );
    $quest_row = array(
        'quest_id' => ''
    );
    $is_confirmed = 'N';
} else {
    if (isset($_GET['clone_quest_id']) && $_GET['clone_quest_id'] != '')
        $quest_id = $_GET['clone_quest_id'];
    
    $item = array();
    $res = mysqli_query($GLOBALS['db_link'], 'select * from quest_list where quest_id = ' . intval($quest_id));
    if ($row = mysqli_fetch_assoc($res)) {
        $quest_row = $row;
        $is_confirmed = $row['is_confirmed'];
        $quest = unserialize($row['quest_serilize']);
    }
    mysqli_free_result($res);
    
    if (isset($_GET['clone_quest_id']) && $_GET['clone_quest_id'] != '')
    {
        $quest_row['quest_id'] = '';
    }
    
    $req_quests = '';
    if (isset($quest[1]['QE']) && is_array($quest[1]['QE']))
    foreach($quest[1]['QE'] as $v)
        $req_quests .= '
        <tr id="tr_qe_'.(++$row_id).'">
          <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_qe_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
          <td align="left" class="cms_middle">'.createSelectFromArray('qe[]', $quest_array, $v).'</td>
        </tr>';
    
    $req_a_quests = '';
    if (isset($quest[1]['QA']) && is_array($quest[1]['QA']))
    foreach($quest[1]['QA'] as $v)
        $req_a_quests .= '
        <tr id="tr_qa_'.(++$row_id).'">
          <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_qa_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
          <td align="left" class="cms_middle">'.createSelectFromArray('qa[]', $quest_array, $v).'</td>
        </tr>';
        
    $req_na_quests = '';
    if (isset($quest[1]['QNA']) && is_array($quest[1]['QNA']))
    foreach($quest[1]['QNA'] as $v)
        $req_na_quests .= '
        <tr id="tr_qna_'.(++$row_id).'">
          <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_qna_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
          <td align="left" class="cms_middle">'.createSelectFromArray('qna[]', $quest_array, $v).'</td>
        </tr>';
        
    $req_u_quests = '';
    if (isset($quest[1]['QU']) && is_array($quest[1]['QU']))
    foreach($quest[1]['QU'] as $v)
        $req_u_quests .= '
        <tr id="tr_qu_'.(++$row_id).'">
          <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_qu_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
          <td align="left" class="cms_middle">'.createSelectFromArray('qu[]', $quest_array, $v).'</td>
        </tr>';
    
    $req_d_quests = '';
    if (isset($quest[2]['QD']) && is_array($quest[2]['QD']))
    foreach($quest[2]['QD'] as $v)
        $req_d_quests .= '
        <tr id="tr_qd_'.(++$row_id).'">
          <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_qd_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
          <td align="left" class="cms_middle">'.createSelectFromArray('qd[]', $quest_array, $v).'</td>
        </tr>';
        
    if (isset($quest[12]['QHA']) && is_array($quest[12]['QHA']))
    foreach($quest[12]['QHA'] as $v)
        $req_qha_quests .= '
        <tr id="tr_qha_'.(++$row_id).'">
          <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_qha_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
          <td align="left" class="cms_middle">'.createSelectFromArray('qha[]', $quest_array, $v).'</td>
        </tr>';
        
    
    
    if (isset($quest[2]['WEA']) && is_array($quest[2]['WEA'])) {
        
        foreach($quest[2]['WEA'] as $group_id => $wea)
            if (is_array($wea))
                foreach($wea as $weapon_id=>$arr) {
                    $req_weapon .= '<tr id="tr_req_wea_'.(++$row_id).'">
                      <td class="cms_middle" align="center">'.$weapon_id.'<a href="#" onclick="removeItem(\'tr_req_wea_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
                      <td align="left" class="cms_middle"><input type="text" name="req_wea_group['.$row_id.']" value="'.$group_id.'" /></td>
                      <td align="left" class="cms_middle">'.createWeaponControl('req_wea['.$row_id.']', 'id', $weapon_id, $weapon_array_id[$weapon_id]).'</td>
                      <td align="left" class="cms_middle"><input type="text" name="req_wea_count['.$row_id.']" value="'.$arr[0].'" /></td>
                      <td align="left" class="cms_middle"><input type="text" name="req_wea_time['.$row_id.']" value="'.$arr[1].'" /></td>
                      <td align="left" class="cms_middle"><input type="checkbox" name="req_wea_self['.$row_id.']" value="Y" '.($arr[2]==0?'checked="checked"':'').' /></td>
                    </tr>';
        }
    }
    
    if (isset($quest[2]['RES']) && is_array($quest[2]['RES'])) {
        
        foreach($quest[2]['RES'] as $group_id => $res)
            if (is_array($res))
                foreach($res as $res_id=>$count) {
                    $req_res .= '<tr id="tr_req_res_'.(++$row_id).'">
                      <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_req_res_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
                      <td align="left" class="cms_middle"><input type="text" name="req_res_group['.$row_id.']" value="'.$group_id.'" /></td>
                      <td align="left" class="cms_middle">'.createSelectFromArray('req_res['.$row_id.']', $resource_array, $res_id).'</td>
                      <td align="left" class="cms_middle"><input type="text" name="req_res_count['.$row_id.']" value="'.$count.'" /></td>
                    </tr>';
        }
    }
    
    if (isset($quest[1]['SPS']) && is_array($quest[1]['SPS'])) 
    {
        foreach($quest[1]['SPS'] as $res_id=>$count) 
        {
            $req_sps .= '<tr id="tr_sps_'.(++$row_id).'">
              <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_sps_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
              <td align="left" class="cms_middle">'.createSelectFromArray('req_sps['.$row_id.']', $sps_abilities, $res_id).'</td>
              <td align="left" class="cms_middle"><input type="text" name="req_sps_count['.$row_id.']" value="'.$count.'" /></td>
            </tr>';
        }
    }
    
    if (isset($quest[2]['SPF']) && is_array($quest[2]['SPF'])) 
    {
        foreach($quest[2]['SPF'] as $res_id=>$count) 
        {
            $req_spf .= '<tr id="tr_spf_'.(++$row_id).'">
              <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_spf_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
              <td align="left" class="cms_middle">'.createSelectFromArray('req_spf['.$row_id.']', $sps_abilities, $res_id).'</td>
              <td align="left" class="cms_middle"><input type="text" name="req_spf_count['.$row_id.']" value="'.$count.'" /></td>
            </tr>';
        }
    }
    
    
    if (isset($quest[12]['W_UID']) && is_array($quest[12]['W_UID'])) {
        foreach($quest[12]['W_UID'] as $weapon_id) {
            $rcv_weapon .= '<tr id="tr_rcv_wea_'.(++$row_id).'">
              <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_rcv_wea_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
              <td align="left" class="cms_middle">'.createWeaponControl('rcv_wea[]', 'id', $weapon_id, $weapon_array_id[$weapon_id]).'</td>
            </tr>';
        }
    }
    
    if (isset($quest[3]) && is_array($quest[3]))
    foreach($quest[3] as $text)
        $hello_text .= '
        <tr id="tr_hello_text_'.(++$row_id).'">
          <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_hello_text_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
          <td align="left" class="cms_middle"><input type="text" name="hello_text[]" value="'._htext($text).'" size="100" /></td>
        </tr>';
        
    if (isset($quest[4]) && is_array($quest[4]))
    foreach($quest[4] as $text)
        $success_text .= '
        <tr id="tr_success_text_'.(++$row_id).'">
          <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_success_text_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
          <td align="left" class="cms_middle"><input type="text" name="success_text[]" value="'._htext($text).'" size="100" /></td>
        </tr>';
        
    if (isset($quest[5]) && is_array($quest[5]))
    foreach($quest[5] as $text)
        $confirm_text .= '
        <tr id="tr_confirm_text_'.(++$row_id).'">
          <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_confirm_text_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
          <td align="left" class="cms_middle"><input type="text" name="confirm_text[]" value="'._htext($text).'" size="100" /></td>
        </tr>';
        
    $time_limit_text = '';
    if (isset($quest[6]) && is_array($quest[6]))
    foreach($quest[6] as $text)
        $time_limit_text .= '
        <tr id="tr_time_limit_text_'.(++$row_id).'">
          <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_time_limit_text_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
          <td align="left" class="cms_middle"><input type="text" name="time_limit_text[]" value="'._htext($text).'" size="100" /></td>
        </tr>';
        
    if (isset($quest[7]) && is_array($quest[7]))
    foreach($quest[7] as $text)
        $completed_text .= '
        <tr id="tr_completed_text_'.(++$row_id).'">
          <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_completed_text_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
          <td align="left" class="cms_middle"><input type="text" name="completed_text[]" value="'._htext($text).'" size="100" /></td>
        </tr>';
        
    if (isset($quest[8]) && is_array($quest[8]))
    foreach($quest[8] as $text)
        $unable_to_confirm_text .= '
        <tr id="tr_unable_to_confirm_text_'.(++$row_id).'">
          <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_unable_to_confirm_text_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
          <td align="left" class="cms_middle"><input type="text" name="unable_to_confirm_text[]" value="'._htext($text).'" size="100" /></td>
        </tr>';
        
    if (isset($quest[9]) && is_array($quest[9]))
    foreach($quest[9] as $text)
        $unable_to_complete_text .= '
        <tr id="tr_unable_to_complete_text_'.(++$row_id).'">
          <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_unable_to_complete_text_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
          <td align="left" class="cms_middle"><input type="text" name="unable_to_complete_text[]" value="'._htext($text).'" size="100" /></td>
        </tr>';
        
    if (isset($quest[10]) && is_array($quest[10]))
    foreach($quest[10] as $text)
        $time_text .= '
        <tr id="tr_time_text_'.(++$row_id).'">
          <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_time_text_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
          <td align="left" class="cms_middle"><input type="text" name="time_text[]" value="'._htext($text).'" size="100" /></td>
        </tr>';
    
    if (isset($_GET['clone_quest_id']) && $_GET['clone_quest_id'] != '')
        $quest_id = '';
}

//dump($quest);

?>
    <h3><?= ($quest_id == '' ? 'Добавить квест' : 'Редактировать квест') ?></h3>
<link rel="stylesheet" href="files/modalwindow.css" type="text/css" />
    <script src="jscript/ajax.js" language="javascript" charset="utf-8"></script>
    <script src="jscript/modal_window.js" language="javascript" charset="utf-8"></script>
    <script src="jscript/controls/weapon_control.js" language="javascript" charset="utf-8"></script>
    <script src="jscript/quest.js" language="javascript" charset="utf-8"></script>
<script language="javascript">
var last_id = <?=(int)$row_id?>;
<?=createJsArray('res_array', $resource_array)?>
<?=createJsArray('sps_abilities_array', $sps_abilities)?>
<?=createJsArray('quest_array', $quest_array)?>
<?=createJsArray('weapon_categories', $weapon_categories_array)?>
<?=createJsArray('pl_types', $pl_types)?>
<?=createJsArray('sexes', $sexes)?>
<?=createJsArray('item_actions', $item_actions)?>
</script>
<form name="edit_resource" action="" method="POST">

    <hr/>
    <b>Основные параметры</b>
    <hr/>

<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td>ID квеста: &nbsp;</td>
  <td><input name="quest_id" type="text" class="cms_fieldstyle1" value="<?=$quest_row['quest_id']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td>Группа: &nbsp;</td>
    <td><?= createSelectFromArray('quest_group_id', $quest_groups, $quest_row['quest_group_id'], '', '(Нет группы)') ?></td>
</tr>
<tr>
    <td>Название квеста: &nbsp;</td>
  <td><input name="quest_name" type="text" class="cms_fieldstyle1" value="<?=$quest[0][0]?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td>Картинка квеста: &nbsp;</td>
  <td valign="top">
    <?=createSelectFromArray('quest_image', $image_array, $quest[0][1], 'onchange="el(\'quest_image\').src = \'http://image.neverlands.ru/gameplay/faces/\'+this.options[this.selectedIndex].value;"')?><br />
    <? if (isset($quest[0][1])) { ?>
        <img id="quest_image" src="http://image.neverlands.ru/gameplay/faces/<?=$quest[0][1]?>">
    <? } else { ?>
        <img id="quest_image" src="images/spacer.gif">
    <? } ?>
  </td>
</tr>
<tr>
    <td>Время на выполнение: &nbsp;</td>
  <td><input name="quest_time" type="text" class="cms_fieldstyle1" value="<?=$quest[0][2]?>" size="10" maxlength="255" /></td>
</tr>
<tr>
    <td>Невозможно завершить: &nbsp;</td>
  <td><input name="quest_uncompletable" type="checkbox" <?=(isset($quest[0][3]) && $quest[0][3]==1?'checked="checked"':'')?> value="Y" /></td>
</tr>
<tr>
    <td>Повторное прохождение через &nbsp;</td>
    <td><input name="quest_repeat" type="text" class="cms_fieldstyle1"
               value="<?= (isset($quest[0][4]) ? $quest[0][4] : '0') ?>" size="10" maxlength="255"/> часов
    </td>
</tr>
<tr>
    <td>Комментарий: &nbsp;</td>
  <td><input name="quest_comment" type="text" class="cms_fieldstyle1" value="<?=(isset($quest[0][5])?$quest[0][5]:'')?>" size="25" maxlength="255" /></td>
</tr>
</table>

    <hr/>
    <b>Отображение квеста</b>
    <hr/>

<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td>Требуемый уровень: &nbsp;</td>
  <td><input name="req_level" type="text" class="cms_fieldstyle1" value="<?=(isset($quest[1]['LV'])?$quest[1]['LV']:'')?>" size="10" maxlength="255" /></td>
</tr>
<tr>
    <td>Склонность: &nbsp;</td>
    <td><?= createSelectFromArray('req_align', $aligns, (isset($quest[1]['ALIGN']) ? $quest[1]['ALIGN'] : ''), '', 'Всё равно') ?></td>
</tr>
<tr>
    <td>Требуемый пол: &nbsp;</td>
    <td><?= createSelectFromArray('req_gender', array(0 => 'Мужской', 1 => 'Женский'), (isset($quest[1]['GENDER']) ? $quest[1]['GENDER'] : ''), '', 'Всё равно') ?></td>
</tr>
<tr>
    <td>Требуемое умение: &nbsp;</td>
  <td><?=createSelectFromArray('req_um', $ability_array, (isset($quest[1]['UM'][0])?$quest[1]['UM'][0]:''))?></td>
</tr>
<tr>
    <td>Требуемый уровень умения: &nbsp;</td>
  <td><input name="req_um_count" type="text" class="cms_fieldstyle1" value="<?=(isset($quest[1]['UM'][1])?$quest[1]['UM'][1]:'')?>" size="10" maxlength="255" /></td>
</tr>
</table>
<br />

    Требуемые квесты:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_quest_qe" >
    <tr >
        <td class="cms_cap3 normal">Удалить</td>
        <td class="cms_cap3">Название квеста</td>
    </tr>
    <?=$req_quests?>
</table>
    <a onclick="addItem_select('table_quest_qe', 'tr_qe', 'qe[]', quest_array, '', ''); return false;" href="#">Добавить
        квест</a><br/>
<br />

    Требуемые взятые квесты:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_quest_qa" >
    <tr >
        <td class="cms_cap3 normal">Удалить</td>
        <td class="cms_cap3">Название квеста</td>
    </tr>
    <?=$req_a_quests?>
</table>
    <a onclick="addItem_select('table_quest_qa', 'tr_qa', 'qa[]', quest_array, '', ''); return false;" href="#">Добавить
        квест</a><br/>
<br />

    Квесты, которые не должны быть взяты:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_quest_qna" >
    <tr >
        <td class="cms_cap3 normal">Удалить</td>
        <td class="cms_cap3">Название квеста</td>
    </tr>
    <?=$req_na_quests?>
</table>
    <a onclick="addItem_select('table_quest_qna', 'tr_qna', 'qna[]', quest_array, '', ''); return false;" href="#">Добавить
        квест</a><br/>
<br />

    Квесты, которые не должны быть пройдены:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_quest_qu" >
    <tr >
        <td class="cms_cap3 normal">Удалить</td>
        <td class="cms_cap3">Название квеста</td>
    </tr>
    <?=$req_u_quests?>
</table>
    <a onclick="addItem_select('table_quest_qu', 'tr_qu', 'qu[]', quest_array, '', ''); return false;" href="#">Добавить
        квест</a><br/>
<br />

    Раскачка:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_quest_sps" >
    <tr >
        <td class="cms_cap3 normal">Удалить</td>
        <td class="cms_cap3">Умение</td>
        <td class="cms_cap3">Количество</td>
    </tr>
    <?=$req_sps?>
</table>
    <a onclick="add_quest_sps('table_quest_sps', 'tr_sps', 'req_sps', sps_abilities_array); return false;" href="#">Добавить
        умение</a><br/>
<br />

    <hr/>
    <b>Требования квеста</b>
    <hr/>

<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td>Требуемые средства (NV): &nbsp;</td>
  <td><input name="quest_price" type="text" class="cms_fieldstyle1" value="<?=(isset($quest[2]['MON'])?$quest[2]['MON']:'')?>" size="10" maxlength="255" /></td>
</tr>
<tr>
    <td>Требуемые средства (Изумруд): &nbsp;</td>
  <td><input name="quest_price1" type="text" class="cms_fieldstyle1" value="<?=(isset($quest[2]['BAKS'])?$quest[2]['BAKS']:'')?>" size="10" maxlength="255" /></td>
</tr>
<tr>
    <td>Требуемые средства при завершении (NV): &nbsp;</td>
  <td><input name="req_nv" type="text" class="cms_fieldstyle1" value="<?=(isset($quest[2]['NV'])?$quest[2]['NV']:'')?>" size="10" maxlength="20" /></td>
</tr>
<tr>
    <td>Кол-во побед в PvE с момента взятия квеста: &nbsp;</td>
  <td><input name="req_npc" type="text" class="cms_fieldstyle1" value="<?=(isset($quest[2]['NPC'])?$quest[2]['NPC']:'')?>" size="10" maxlength="20" /></td>
</tr>
<tr>
    <td>Кол-во побед в PvP с момента взятия квеста: &nbsp;</td>
  <td><input name="req_pvp" type="text" class="cms_fieldstyle1" value="<?=(isset($quest[2]['PVP'])?$quest[2]['PVP']:'')?>" size="10" maxlength="20" /></td>
</tr>
</table>
<br />

    Требование скрытие квестов из журнала заданий:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_quest_qd" >
    <tr >
        <td class="cms_cap3 normal">Удалить</td>
        <td class="cms_cap3">Название квеста</td>
    </tr>
    <?=$req_d_quests?>
</table>
    <a onclick="addItem_select('table_quest_qd', 'tr_qd', 'qd[]', quest_array, '', ''); return false;" href="#">Добавить
        квест</a><br/>
<br />

    Требуемые предметы:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_quest_req_wea" >
    <tr >
        <td class="cms_cap3 normal">Удалить</td>
        <td class="cms_cap3">Группа</td>
        <td class="cms_cap3">Предмет</td>
        <td class="cms_cap3">Количество</td>
        <td class="cms_cap3">Время</td>
        <td class="cms_cap3">Не был передан</td>
    </tr>
    <?=$req_weapon?>
</table>
    <a onclick="addItem_quest_weapon('table_quest_req_wea', 'tr_req_wea', 'req_wea'); return false;" href="#">Добавить
        предмет</a><br/>
<br />

    Требуемые ресурсы:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_quest_req_res" >
    <tr >
        <td class="cms_cap3 normal">Удалить</td>
        <td class="cms_cap3">Группа</td>
        <td class="cms_cap3">Ресурс</td>
        <td class="cms_cap3">Количество</td>
    </tr>
    <?=$req_res?>
</table>
    <a onclick="addItem_quest_res('table_quest_req_res', 'tr_req_res', 'req_res', res_array); return false;" href="#">Добавить
        ресурс</a><br/>
<br />

    Раскачка:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_quest_spf" >
    <tr >
        <td class="cms_cap3 normal">Удалить</td>
        <td class="cms_cap3">Умение</td>
        <td class="cms_cap3">Количество</td>
    </tr>
    <?=$req_spf?>
</table>
    <a onclick="add_quest_sps('table_quest_spf', 'tr_spf', 'req_spf', sps_abilities_array); return false;" href="#">Добавить
        умение</a><br/>
<br />

    <hr/>
    <b>Награда за квест</b>
    <hr/>

<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td>Мирный опыт: &nbsp;</td>
  <td><input name="rcv_exp" type="text" class="cms_fieldstyle1" value="<?=(isset($quest[12]['M_EXP'])?$quest[12]['M_EXP']:'')?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td>Доблесть опыт: &nbsp;</td>
  <td><input name="rcv_exp1" type="text" class="cms_fieldstyle1" value="<?=(isset($quest[12]['M_EXP1'])?$quest[12]['M_EXP1']:'')?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td>Боевой опыт: &nbsp;</td>
  <td><input name="rcv_bexp" type="text" class="cms_fieldstyle1" value="<?=(isset($quest[12]['EXP'])?$quest[12]['EXP']:'')?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td>Получаемые деньги золото: &nbsp;</td>
  <td><input name="rcv_money" type="text" class="cms_fieldstyle1" value="<?=(isset($quest[12]['MONEY'])?$quest[12]['MONEY']:'')?>" size="10" maxlength="255" /></td>
</tr>
<tr>
    <td>Взломщик: &nbsp;</td>
  <td><input name="present" type="text" class="cms_fieldstyle1" value="<?=(isset($quest[12]['PRE'])?$quest[12]['PRE']:'')?>" size="25" maxlength="255" /></td>
</tr>
<tr>
    <td>Получаемые деньги Изумруд: &nbsp;</td>
  <td><input name="present2" type="text" class="cms_fieldstyle1" value="<?=(isset($quest[12]['PRE2'])?$quest[12]['PRE2']:'')?>" size="25" maxlength="255" /></td>
</tr>
<tr>
    <td>Репутация Города: &nbsp;</td>
  <td><input name="present3" type="text" class="cms_fieldstyle1" value="<?=(isset($quest[12]['PRE3'])?$quest[12]['PRE3']:'')?>" size="25" maxlength="255" /></td>
</tr>
</table>
<br />
    Получаемые предметы:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_rcv_weapons" >
    <tr >
        <td class="cms_cap3 normal">Удалить</td>
        <td class="cms_cap3">Предмет</td>
    </tr>
    <?=$rcv_weapon?>
</table>
    <a onclick="addItem_receive_weapons('table_rcv_weapons', 'tr_rcv_wea', 'rcv_wea[]', '', '', ''); return false;"
       href="#">Добавить предмет</a><br/>
<br />
    Требование скрытие квестов из журнала заданий при завершении:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_quest_qha" >
    <tr >
        <td class="cms_cap3 normal">Удалить</td>
        <td class="cms_cap3">Название квеста</td>
    </tr>
    <?=$req_qha_quests?>
</table>
    <a onclick="addItem_select('table_quest_qha', 'tr_qha', 'qha[]', quest_array, '', ''); return false;" href="#">Добавить
        квест</a><br/>
<br />

    Вещи:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_quest_wuid" >
    <tr >
        <td class="cms_cap3 normal">Удалить</td>
        <td class="cms_cap3">Предмет</td>
        <td class="cms_cap3">Для кого</td>
        <td class="cms_cap3">Пол</td>
        <td class="cms_cap3">Долговечность</td>
        <td class="cms_cap3">Кол-во</td>
        <td class="cms_cap3">Цена</td>
        <td class="cms_cap3">Срок годности</td>
        <td class="cms_cap3">Разрешенные действия</td>
    </tr>
    <? 
    if (isset($quest[12]['WUID']) && is_array($quest[12]['WUID']))
    foreach($quest[12]['WUID'] as $id => $item)
    {
    $res = mysqli_query($GLOBALS['db_link'], 'SELECT * FROM items WHERE id = \'' . mysqli_real_escape_string($GLOBALS['db_link'], $item['item']) . '\'');
    if ($row = mysqli_fetch_assoc($res))
            $item_name = $row['name'];
    ?>
    <tr id="tr_wuid<?=$id?>">
        <td class="cms_middle" align="center"><a href="#" onclick="removeItem('tr_wuid<?=$id?>'); return false;"><img src="images/cms_icons/cms_delete.gif" /></a></td>
        <td class="cms_middle"><?=createWeaponControl('quest_wuid['.$id.']', 'uid', $item['item'], $item_name, 'normal')?></td>
        <td class="cms_middle"><?=createSelectFromArray('quest_wuid_pltype['.$id.']', $pl_types, $item['char_type'])?></td>
        <td class="cms_middle"><?=createSelectFromArray('quest_wuid_sex['.$id.']', $sexes, $item['sex'])?></td>
        <td class="cms_middle">
            <input type="text" name="quest_wuid_dolg[<?=$id?>]" id="quest_wuid_dolg_<?=$id?>" value="<?=$item['long']?>" size="3" />
        </td>
        <td class="cms_middle">
            <input type="text" name="quest_wuid_count[<?=$id?>]" id="quest_wuid_count_<?=$id?>" value="<?=(isset($item['count'])?$item['count']:'')?>" size="3" />
        </td>
        <td class="cms_middle">
            <input type="text" name="quest_wuid_price[<?=$id?>]" id="quest_wuid_price_<?=$id?>" value="<?=$item['price']?>" size="3" />
        </td>
        <td class="cms_middle">
            <input type="text" name="quest_wuid_expire[<?=$id?>]" id="quest_wuid_expire_<?=$id?>" value="<?=$item['expire']?>" size="3" />
        </td>
        <td>
        <? foreach($item_actions as $aid => $actname) { ?>
            <input type="checkbox" <?=($item['actions'] & $aid?'checked="checked"':'')?> name="quest_wuid_act[<?=$id?>][<?=$aid?>]" id="quest_wuid_act_<?=$id?>_<?=$aid?>" value="Y" /><label for="quest_wuid_act_<?=$id?>_<?=$aid?>"><?=$actname?></label><br />
        <? } ?>
        </td>
    
    <? } ?>
    
</table>
    <a onclick="addItem_present_weapon('table_quest_wuid', 'tr_wuid', 'quest_wuid'); return false;" href="#">Добавить
        предмет</a><br/>

    <hr/>
    <b>Диалоги</b>
    <hr/>

    Приветственный диалог:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_hello_text" >
    <tr >
        <td class="cms_cap3 normal">Удалить</td>
        <td class="cms_cap3">Текст</td>
    </tr>
    <?=$hello_text?>
</table>
    <a onclick="addItem_text('table_hello_text', 'tr_hello_text', 'hello_text[]', '', '', ''); return false;" href="#">Добавить
        диалог</a><br/>
<br />

    Диалог при успешном прохождении:<br/>
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_success_text" >
    <tr >
        <td class="cms_cap3 normal">Удалить</td>
        <td class="cms_cap3">Текст</td>
    </tr>
    <?=$success_text?>
</table>
    <a onclick="addItem_text('table_success_text', 'tr_success_text', 'success_text[]', '', '', ''); return false;"
       href="#">Добавить диалог</a><br/>
<br />

    Диалог при согласии взять квест:<br/>
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_confirm_text" >
    <tr >
        <td class="cms_cap3 normal">Удалить</td>
        <td class="cms_cap3">Текст</td>
    </tr>
    <?=$confirm_text?>
</table>
    <a onclick="addItem_text('table_confirm_text', 'tr_confirm_text', 'confirm_text[]', '', '', ''); return false;"
       href="#">Добавить диалог</a><br/>
<br />

    Диалог при временном ограничении:<br/>
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_time_limit_text" >
    <tr >
        <td class="cms_cap3 normal">Удалить</td>
        <td class="cms_cap3">Текст</td>
    </tr>
    <?=$time_limit_text?>
</table>
    <a onclick="addItem_text('table_time_limit_text', 'tr_time_limit_text', 'time_limit_text[]', '', '', ''); return false;"
       href="#">Добавить диалог</a><br/>
<br />

    Диалог при сдаче квеста:<br/>
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_completed_text" >
    <tr >
        <td class="cms_cap3 normal">Удалить</td>
        <td class="cms_cap3">Текст</td>
    </tr>
    <?=$completed_text?>
</table>
    <a onclick="addItem_text('table_completed_text', 'tr_completed_text', 'completed_text[]', '', '', ''); return false;"
       href="#">Добавить диалог</a><br/>
<br />

    Диалог, если невозможно взять квест:<br/>
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_unable_to_confirm_text" >
    <tr >
        <td class="cms_cap3 normal">Удалить</td>
        <td class="cms_cap3">Текст</td>
    </tr>
    <?=$unable_to_confirm_text?>
</table>
    <a onclick="addItem_text('table_unable_to_confirm_text', 'tr_unable_to_confirm_text', 'unable_to_confirm_text[]', '', '', ''); return false;"
       href="#">Добавить диалог</a><br/>
<br />

    Диалог, если невозможно завершить квест:<br/>
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_unable_to_complete_text" >
    <tr >
        <td class="cms_cap3 normal">Удалить</td>
        <td class="cms_cap3">Текст</td>
    </tr>
    <?=$unable_to_complete_text?>
</table>
    <a onclick="addItem_text('table_unable_to_complete_text', 'tr_unable_to_complete_text', 'unable_to_complete_text[]', '', '', ''); return false;"
       href="#">Добавить диалог</a><br/>
<br />

    Диалог, если истекло время квеста:<br/>
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_time_text" >
    <tr >
        <td class="cms_cap3 normal">Удалить</td>
        <td class="cms_cap3">Текст</td>
    </tr>
    <?=$time_text?>
</table>
    <a onclick="addItem_text('table_time_text', 'tr_time_text', 'time_text[]', '', '', ''); return false;" href="#">Добавить
        диалог</a><br/>
<br />

    Текст записи в журнал квестов:<br/>
<textarea cols="80" rows="4" name="quest_journal_text"><?=_htext(isset($quest[13])?_htext($quest[13]):'')?></textarea><br />
<br />
  
<p></p>
    <input name="submit" type="submit" class="cms_button1"
           value="Сохранить" <?= (!userHasPermission(32) && $is_confirmed == 'Y' ? 'disabled="disabled"' : '') ?>
           style="width: 150px"/>
    <input name="cancel" type="submit"
           onclick="document.location='<?= $_SESSION['cp_pages']['quest_list'] ?>'; return false;" class="cms_button1"
           value="Отмена"/>
    <p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>