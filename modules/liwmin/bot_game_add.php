<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}
/*
if (isset($_GET['bot_id']) && is_numeric($_GET['bot_id']))
    $bot_id = (int)$_GET['bot_id'];
elseif (isset($_POST['bot_id']) && is_numeric($_POST['bot_id']))
    $bot_id = (int)$_POST['bot_id'];
else
    $bot_id = '';
*/    
if (isset($_GET['bot_class_id']))
    $bot_class_id = $_GET['bot_class_id'];
else
    $bot_class_id = '';
    //header('Location: bot_list.php');

$bot_classes = array();
$res = mysql_query('select * from bots_classes', $db); 
while ($row = mysql_fetch_assoc($res))
{
    $bot_classes[$row['bot_class_id']] = $row['nickname'];
    $bot_classes_inf[$row['bot_class_id']] = $row;
}
mysql_free_result($res);    

if ($bot_class_id != '') 
{
    
    $bots = array();
    $res = mysql_query('select * from bots_templates where bot_class_id = '.intval($bot_class_id).' ORDER BY level', $db); 
    while ($row = mysql_fetch_assoc($res)) 
    {
        $bots_array[$row['inf_bot']] = $row;
        $bots_array[$row['inf_bot']]['nickname'] = $bot_classes_inf[$row['bot_class_id']]['nickname'];
        $bots_array[$row['inf_bot']]['shortnn'] = $bot_classes_inf[$row['bot_class_id']]['shortnn'];
        $bots_array[$row['inf_bot']]['image'] = $bot_classes_inf[$row['bot_class_id']]['image'];
        $bots[$row['inf_bot']] = '['.$row['level'].']'.(isset($row['comment']) && $row['comment']!=''?' ('.$row['comment'].')':'');
    }
    mysql_free_result($res);
    
    if (isset($_POST['generate']) && isset($_POST['fill_type']) && $_POST['fill_type']!='') 
    {
        $copy_fields = array(
            'level', 'intsex',
            'curhp', 'maxhp', 'addhp', 'curma', 'addma', 'steps', 'forcep', 'addforce', 'adroitness', 'addadroitness', 'goodluck', 'addgoodluck', 
            'health', 'wisdom', 'addwisdom', 'uvorot', 'antiuvorot', 'krit', 'antikrit', 'intellect', 'addintellect', 'broclass', 
            'proclass', 'mindamage', 'maxdamage', 'weaponbase', 
            'um_0', 'um_1', 'um_2', 'um_3', 'um_4', 'um_5', 'um_6', 'um_7', 'um_8', 'um_9', 'um_10', 'um_11', 'um_12',
            'um_13', 'um_14', 'um_15', 'um_16', 'um_17', 'um_18', 'um_19', 'um_20', 'um_21', 'um_22', 'um_23', 'um_24',
            'um_25', 'um_26', 'um_27', 'um_28', 'um_29', 'um_30', 'um_31', 'um_32', 'um_33', 'um_34', 'um_35', 'um_36', 'um_37', 'um_38',
            'wea_f', 'wea_s', 'wea_od', 'block_od', 'w_koef', 'inf_bot', 'nav'
        );
            
        if (isset($_POST['bot_uid'])) 
        foreach($_POST['bot_uid'] as $bot_uid => $count) 
        {
            
            $bot = $bots_array[$bot_uid];
            
            $bot_slots = '';
            $res = mysql_query('SELECT * FROM bots_slots WHERE inf_bot = '.intval($bot_uid), $db); 
            if ($row = mysql_fetch_assoc($res))
                $bot_slots = $row['sl_main'];
            mysql_free_result($res);
            
            $bot_class = $bot_classes_inf[$bot['bot_class_id']];
            
            $ins_f = $ins_v = '';
            foreach($copy_fields as $field) 
            {
                $ins_f .= $field.',';
                if ($field == 'w_koef')
                    $ins_v .= (isset($bot[$field])?(float)$bot[$field]:'0').',';
                else
                    $ins_v .= (isset($bot[$field])?(int)$bot[$field]:'0').',';
            }
            
            for ($i=0; $i<(int)$count; $i++) 
            {
                $totem = mt_rand(1,11);
                $query = '
                INSERT INTO e_players_table (
                    nickname, shortnn, password, image, 
                    nowcity, nowplace, nowstatus, llocateid, lhouseid, lhousein, lmacroid,
                    sign, signname, signstatus, signid, signst, session_id,  
                    '.$ins_f.'
                    add_um_0,add_um_1,add_um_2,add_um_3,add_um_4,add_um_5,add_um_6,add_um_7,add_um_8,add_um_9,add_um_10,add_um_11,add_um_12,add_um_13,add_um_14,add_um_15,add_um_16,add_um_17,add_um_18,add_um_19,add_um_20,add_um_21,add_um_22,add_um_23,add_um_24,add_um_25,add_um_26,add_um_27,add_um_28,add_um_29,add_um_30,add_um_31,add_um_32,add_um_33,add_um_34,add_um_35,add_um_36,add_um_37,add_um_38,
                    inf_totem, inf_totem_2, fplace, tplace, magic, pr_cam
                ) VALUES (
                    \''.mysql_real_escape_string($bot['nickname']).'\', \''.mysql_real_escape_string($bot['shortnn']).'\', \''.str_repeat('0',32).'\', \''.mysql_real_escape_string($bot['image']).'\',
                    \'map\', \'m_0_0\', \'free\', 0, 0, 0, 0, 
                    \'none\', \'\', \'\', \'n\', 0, \'\', 
                    '.$ins_v.'
                    0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                    '.intval($totem).', '.intval($totem).', \'\', \'\', \'\', 0
                )';
                
                
                if (!mysql_query($query))
                    die(mysql_error());
                
                $plid = mysql_insert_id();
                if($plid > 0)
                {
                    $res = mysql_query('SELECT nickname,level,curhp,weaponbase,inf_bot FROM e_players_table WHERE playerid = '.intval($plid));
                    if (!$res)
                        die(mysql_error());
                    
                    $row = mysql_fetch_row($res);
                    
                    $query = '
                        INSERT INTO bots_fights (
                            playerid, inf_bot, bot_type, fightid
                        ) VALUES (
                            '.$plid.', '.$bot_uid.', '.(int)$_POST['fill_type'].',0
                        )';
                   
                    if (!mysql_query($query))
                        die(mysql_error()); 
                    
                    $query = '
                        INSERT INTO e_players_modify (
                            playerid, modify
                        ) VALUES (
                            '.intval($plid).', ""
                        )';
                    if (!mysql_query($query))
                        die(mysql_error());
                        
                    $query = '
                        INSERT INTO e_players_slots (
                            playerid, sl_main, sl_uids, sl_wids, sl_csol, sl_wmas, sl_magic
                        ) VALUES (
                            '.intval($plid).',"'.mysql_real_escape_string($bot_slots).'","@@@@@@@@@@@@@@@@","@@@@@@@@@@@@@@@@","@@@@@@@@@@@@@@@@","@@@@@@@@@@@@@@@@", "@@@@@@@@@@@@@@@@"
                        )';
                    if (!mysql_query($query))
                        die(mysql_error());
                        
                    $query = '
                        INSERT INTO e_players_info (
                            playerid, inf_icq, inf_d, inf_m, inf_y, inf_borntime, bl_info, pr_info, inf_email, inf_name, inf_country, inf_city, inf_borncity, inf_bornip, inf_url, inf_infoadd, inf_infoabout
                        ) VALUES (
                            '.intval($plid).',0,6,6,1906,1122638011,"","","info@neverlands.ru","'.mysql_real_escape_string($bot_class['inf_name']).'","'.mysql_real_escape_string($bot_class['inf_country']).'","'.mysql_real_escape_string($bot_class['inf_city']).'","city1","127.0.0.1","'.mysql_real_escape_string($bot_class['inf_url']).'","","'.mysql_real_escape_string($bot_class['inf_infoabout']).'"
                        )';
                    if (!mysql_query($query))
                        die(mysql_error()); 
                }
            }
            
            header('Location: bot_game_add.php'); 
            
        }
    }
}

$fill_types = Array(
    0 => 'Природа',
    1 => 'Лабиринт',
    4 => 'Нападение на город',
    5 => 'Нападение по свитку',
);

?>
<h3>Добавление ботов в игру</h3>

<form name="add_bot_step_1" action="" method="GET">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
  <td>Бот: &nbsp;  </td>
  <td><?=createSelectFromArray('bot_class_id', $bot_classes, $bot_class_id)?></td>
</tr>
</table>
<p></p>
<input name="show"  type="submit" class="cms_button1" value="Показать" style="width: 150px"/>
<input name="cancel" type="submit" onclick="document.location='bot_list.php'; return false;" class="cms_button1" value="Отмена" />
</form>
<? if ($bot_class_id != '') { ?> 
<br />
<form name="add_bot_step_2" action="" method="post">
<input type="hidden" name="bot_class_id" value="<?=$bot_class_id?>" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >
    <tr >
        <td class="cms_cap2">ID Бота</td>
        <td class="cms_cap2">Название бота</td>
        <td class="cms_cap2">Количество</td>
    </tr>
    <? foreach($bots_array as $bot_uid => $row) { ?>
    <tr>
        <td align="left" class="cms_middle"><?=$bot_uid?></td>
        <td align="left" class="cms_middle"><?=$bots[$bot_uid]?></td>
        <td align="left" class="cms_middle"><input type="text" name="bot_uid[<?=$bot_uid?>]" value="0" /></td>
    </tr>
    <? } ?>
</table>
<br />
Тип наполнения: <?=createSelectFromArray('fill_type', $fill_types, '')?>
<p></p>
<input type="hidden" name="generate" value="generate" />
<input name="generate" type="submit" class="cms_button1" value="Сгенерировать" style="width: 150px"/>
<input name="cancel" type="submit" onclick="document.location='bot_game_add.php'; return false;" class="cms_button1" value="Отмена" />
</form>
<? } ?>

<p><span class="cms_star">*</span> - Обязательные поля </p>

<? require('kernel/after.php'); ?>