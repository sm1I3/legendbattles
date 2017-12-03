<?php
require('kernel/before.php');

if (!userHasPermission(512)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['bot_class_id']) || !is_numeric($_GET['bot_class_id']))
    $bot_class_id = '';
else
    $bot_class_id = (int)$_GET['bot_class_id'];
    
if (isset($_POST['nickname'])) 
{
    
    if ($bot_class_id == '') 
    {
        $query = '
        insert into bots_classes
        (
            bot_class_id,
            nickname,
            shortnn,
            image,
            intsex,
            inf_name,
            inf_country,
            inf_city,
            inf_url,
            inf_infoabout,
            check_attack_conditions,
            min_attack_level,
            max_attack_level,
            quest_attack_start,
            quest_attack_finish,
            attack_disable_effect
        ) values (
        '.(int)$_POST['bot_class_id'].',
        \''.mysql_real_escape_string($_POST['nickname']).'\',
        \''.mysql_real_escape_string($_POST['shortnn']).'\',
        \''.mysql_real_escape_string($_POST['image']).'\',
        '.(int)$_POST['intsex'].',
        \''.mysql_real_escape_string($_POST['inf_name']).'\',
        \''.mysql_real_escape_string($_POST['inf_country']).'\',
        \''.mysql_real_escape_string($_POST['inf_city']).'\',
        \''.mysql_real_escape_string($_POST['inf_url']).'\',
        \''.mysql_real_escape_string($_POST['inf_infoabout']).'\',
        '.(int)(isset($_POST['check_attack_conditions']) ? 1 : 0).',
        '.(int)$_POST['min_attack_level'].',
        '.(int)$_POST['max_attack_level'].',
        '.(int)$_POST['quest_attack_start'].',
        '.(int)$_POST['quest_attack_finish'].',
        '.(int)$_POST['attack_disable_effect'].'
        )';
        
        if (!mysql_query($query))
            die(mysql_error());
    } 
    else 
    {
        $query = '
        update bots_classes set
            bot_class_id = '.(int)$_POST['bot_class_id'].',
            nickname = \''.mysql_real_escape_string($_POST['nickname']).'\',
            shortnn = \''.mysql_real_escape_string($_POST['shortnn']).'\',
            image = \''.mysql_real_escape_string($_POST['image']).'\',
            intsex = '.(int)($_POST['intsex']).',
            inf_name = \''.mysql_real_escape_string($_POST['inf_name']).'\',
            inf_country = \''.mysql_real_escape_string($_POST['inf_country']).'\',
            inf_city = \''.mysql_real_escape_string($_POST['inf_city']).'\',
            inf_url = \''.mysql_real_escape_string($_POST['inf_url']).'\',
            inf_infoabout = \''.mysql_real_escape_string($_POST['inf_infoabout']).'\',
            check_attack_conditions = '.(int)(isset($_POST['check_attack_conditions']) ? 1 : 0).',
            min_attack_level = '.(int)$_POST['min_attack_level'].',
            max_attack_level = '.(int)$_POST['max_attack_level'].',
            quest_attack_start = '.(int)$_POST['quest_attack_start'].',
            quest_attack_finish = '.(int)$_POST['quest_attack_finish'].',
            attack_disable_effect = '.(int)$_POST['attack_disable_effect'].'
        where
            bot_class_id = '.$bot_class_id.'
        '  ;
        
        if (!mysql_query($query))
            die(mysql_error());
    }    
    
    // Saving times
    
    if ($bot_class_id != '')
        mysql_query('DELETE FROM bots_times WHERE bot_class_id = '.intval($bot_class_id));
    
    $query = 'INSERT INTO bots_times (bot_class_id,';
    for ($i=0; $i<24; $i++) 
    { 
        if ($i<10) $h = '0'.$i; else $h = $i;
        $query .= '`'.$h.'`,';
    }
    $query .= 'bot_koef, change_exp) VALUES ('.(int)$_POST['bot_class_id'].',';
    for ($i=0; $i<24; $i++) 
    { 
        if ($i<10) $h = '0'.$i; else $h = $i;
        $query .= (float)$_POST['hours'][$h].',';
    }
    $query .= $_POST['bot_koef'].', '.(isset($_POST['change_exp']) ? 1 : 0).') ON DUPLICATE KEY UPDATE ';
    for ($i=0; $i<24; $i++) 
    { 
        if ($i<10) $h = '0'.$i; else $h = $i;
        $query .= '`'.$h.'` = '.(float)$_POST['hours'][$h].',';
    }
    $query .= 'bot_koef = '.$_POST['bot_koef'];
    
    if (!mysql_query($query))
        die(mysql_error());
        
    header('Location: bot_class_list.php');
    
}

$bot_koef = '1.00';
$change_exp = 1;
if ($bot_class_id == '') 
{
    $bot_class = array(
        'bot_class_id' => '',
        'nickname' => '',
        'shortnn' => '',
        'image' => '',
        'intsex' => '0',
        'inf_name' => '',
        'inf_country' => '',
        'inf_city' => '',
        'inf_url' => '',
        'inf_infoabout' => '',
        'drop_enabled' => 1,
        'hunt_enabled' => 1,
        'check_attack_conditions' => '1',
        'min_attack_level' => '',
        'max_attack_level' => '',
        'quest_attack_start' => '',
        'quest_attack_finish' => '',
        'attack_disable_effect' => '0',
    );
    
    for ($i=0; $i<24; $i++) 
    { 
        if ($i<10) $h = '0'.$i; else $h = $i;
        $hvalues[$h] = '1.00';
    }
    
    $bot_kicks['kicks'] = '';
    $bot_kicks['blocks'] = '';
    $bot_kicks['adds'] = '';
} 
else 
{
    $bot_class = array();
    $res = mysql_query('select * from bots_classes where bot_class_id = '.intval($bot_class_id));
    if($row = mysql_fetch_assoc($res))
        $bot_class = $row;
    mysql_free_result($res);
    
    if ($bot_class['min_attack_level'] == '0')
        $bot_class['min_attack_level'] = '';
    if ($bot_class['max_attack_level'] == '0')
        $bot_class['max_attack_level'] = '';
    if ($bot_class['quest_attack_start'] == '0')
        $bot_class['quest_attack_start'] = '';
    if ($bot_class['quest_attack_finish'] == '0')
        $bot_class['quest_attack_finish'] = '';
    
    $res = mysql_query('select * from bots_times where bot_class_id = '.intval($bot_class_id));
    if($row = mysql_fetch_assoc($res))
    {
        for ($i=0; $i<24; $i++) 
        { 
            if ($i<10) $h = '0'.$i; else $h = $i;
            $hvalues[$h] = $row[$h];
        }
        $bot_koef = $row['bot_koef'];
        $change_exp = $row['change_exp'];
    } else {
        for ($i=0; $i<24; $i++) 
        { 
            if ($i<10) $h = '0'.$i; else $h = $i;
            $hvalues[$h] = '1.00';
        }
    }
    mysql_free_result($res);
}

?>
<h3><?=($bot_class_id == ''?'Добавить класс бота':'Изменить класс бота')?></h3>

<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
  <td>ID Шаблона: &nbsp;  </td>
  <td><input name="bot_class_id" type="text" class="cms_fieldstyle1" value="<?=$bot_class['bot_class_id']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
  <td>Имя бота: &nbsp;  </td>
  <td><input name="nickname" type="text" class="cms_fieldstyle1" value="<?=$bot_class['nickname']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Короткое имя: &nbsp;  </td>
  <td><input name="shortnn" type="text" class="cms_fieldstyle1" value="<?=$bot_class['shortnn']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Картинка: &nbsp;  </td>
  <td><input name="image" type="text" class="cms_fieldstyle1" value="<?=$bot_class['image']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Пол: &nbsp;  </td>
  <td><?=createSelectFromArray('intsex', array(0 => 'Мужской', 1 => 'Женский'), $bot_class['intsex'], '', false)?></td>
</tr>
<tr>
  <td>Имя: &nbsp;  </td>
  <td><input name="inf_name" type="text" class="cms_fieldstyle1" value="<?=$bot_class['inf_name']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Страна: &nbsp;  </td>
  <td><input name="inf_country" type="text" class="cms_fieldstyle1" value="<?=$bot_class['inf_country']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Город: &nbsp;  </td>
  <td><input name="inf_city" type="text" class="cms_fieldstyle1" value="<?=$bot_class['inf_city']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Домашняя страница: &nbsp;  </td>
  <td><input name="inf_url" type="text" class="cms_fieldstyle1" value="<?=$bot_class['inf_url']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>О себе: &nbsp;  </td>
  <td><input name="inf_infoabout" type="text" class="cms_fieldstyle1" value="<?=$bot_class['inf_infoabout']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td colspan="2">&nbsp;</td>
</tr>
<tr>
  <td>Коэфф. бота: &nbsp;  </td>
  <td><input name="bot_koef" type="text" class="cms_fieldstyle1" value="<?=$bot_koef?>" size="30" maxlength="255" /></td>
</tr>
</table>
<br />
Время нападения:<br />
<table>
<tr>
    <? for ($i=0; $i<24; $i++) { if ($i<10) $h = '0'.$i; else $h = $i; ?>
    <td align="center"><?=$h?></td>
    <? } ?>
</tr>
<tr>
    <? for ($i=0; $i<24; $i++) { if ($i<10) $h = '0'.$i; else $h = $i; ?>
    <td><input type="text" name="hours[<?=$h?>]" value="<?=$hvalues[$h]?>" size="3" /></td>
    <? } ?>
</tr>
</table>
<input type="checkbox" name="change_exp" id="change_exp" value="Y" <?=($change_exp == 1 ? 'checked="checked"' : '')?> /><label for="change_exp">Применять коэффициенты к опыту</label><br>
<br />
Условия нападения: <input type="checkbox" name="check_attack_conditions" value="Y" <?=($bot_class['check_attack_conditions']!='1'?'':'checked="checked"')?> /><br />
<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td>Минимальный уровень нападения: &nbsp;  </td>
    <td><input name="min_attack_level" type="text" class="cms_fieldstyle1" value="<?=$bot_class['min_attack_level']?>" size="5" maxlength="5" /></td>
</tr>
<tr>
    <td>Максимальный уровень нападения: &nbsp;  </td>
    <td><input name="max_attack_level" type="text" class="cms_fieldstyle1" value="<?=$bot_class['max_attack_level']?>" size="5" maxlength="5" /></td>
</tr>
<tr>
    <td>Пройденный квест, при котором стартуются нападения: &nbsp;  </td>
    <td><input name="quest_attack_start" type="text" class="cms_fieldstyle1" value="<?=$bot_class['quest_attack_start']?>" size="10" maxlength="10" /></td>
</tr>
<tr>
    <td>Пройденный квест, при котором завершаются нападения: &nbsp;  </td>
    <td><input name="quest_attack_finish" type="text" class="cms_fieldstyle1" value="<?=$bot_class['quest_attack_finish']?>" size="10" maxlength="10" /></td>
</tr>
<tr>
    <td>ID эффекта, для защиты от нападений: &nbsp;  </td>
    <td><input name="attack_disable_effect" type="text" class="cms_fieldstyle1" value="<?=$bot_class['attack_disable_effect']?>" size="10" maxlength="10" /></td>
</tr>
</table>
<p></p>
  <input name="submit"  type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
  <input name="cancel" type="submit" onclick="document.location='bot_class_list.php'; return false;" class="cms_button1" value="Отмена" />
<p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>