<?php
require('kernel/before.php');

if (!userHasPermission(1024)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['bot_id']) || !is_numeric($_GET['bot_id']))
    $bot_id = '';
else
    $bot_id = (int)$_GET['bot_id'];
    
$row_id = 0;
    
// list of all weapon categories
$weapon_categories_array = array();
$res = mysqli_query($GLOBALS['db_link'], 'select * from weapon_categories');
while ($row = mysqli_fetch_assoc($res))
    $weapon_categories_array[$row['category_code']] = $row['category_name'];
mysqli_free_result($res);

// list of all weapons
$weapon_array = array();
$res = mysqli_query($GLOBALS['db_link'], 'select * from weapons_template');
while ($row = mysqli_fetch_assoc($res)) {
    $weapon_array_id[$row['w_id']] = $row['w_name'];
    $weapon_array_uid[$row['w_uid']] = $row['w_name'];
}
mysqli_free_result($res);
    
$bot_classes = array();
$res = mysqli_query($GLOBALS['db_link'], 'select * from bots_classes');
while ($row = mysqli_fetch_assoc($res)) {
    $bot_classes[$row['bot_class_id']] = $row['nickname'];
    $bot_classes_inf[$row['bot_class_id']] = $row;
}
mysqli_free_result($res);

$resource_array = array();
$res = mysqli_query($GLOBALS['db_link'], 'select * from restore_resources');
while ($row = mysqli_fetch_assoc($res)) {
    $resource_array[$row['resource_id']] = $row['resource_name'];
}
mysqli_free_result($res);

$tools_array = array();
$res = mysqli_query($GLOBALS['db_link'], 'select * from restore_items');
while ($row = mysqli_fetch_assoc($res)) {
    $tools_array[$row['item_id']] = $row['item_name'];
}
mysqli_free_result($res);
    
$fields = array(
    'level' => 'уровень',
    'curhp' => 'текущие ХП',
    'maxhp' => 'максимальные ХП',
    'addhp' => 'ХП от экипировки',
    'curma' => 'текущие МП',
    'addma' => 'МП от экипировки',
    'steps' => 'очки действия',
    'forcep' => 'сила персонажа',
    'addforce' => 'сила от экипировки',
    'adroitness' => 'ловкость персонажа',
    'addadroitness' => 'ловкость от экипировки',
    'goodluck' => 'удача персонажа',
    'addgoodluck' => 'удача от экипировки',
    'health' => 'здоровье персонажа',
    'wisdom' => 'мудрость персонажа',
    'addwisdom' => 'мудрость от экипировки',
    'uvorot' => 'модификатор уловки',
    'antiuvorot' => 'модификатор точности',
    'krit' => 'модификатор сокрушения',
    'antikrit' => 'модификатор стойкости',
    'intellect' => 'знания персонажа',
    'addintellect' => 'знания от экипировки',
    'broclass' => 'класс брони',
    'proclass' => 'пробой брони',
    'mindamage' => 'мин. урон',
    'maxdamage' => 'макс. урон',
    'weaponbase' => 'weaponbase',
    'um_0' => 'Рукопашный бой',
    'um_1' => 'Владение мечами',
    'um_2' => 'Владение топорами',
    'um_3' => 'Владение дробящим оружием',
    'um_4' => 'Владение ножами',
    'um_5' => 'Владение метательным оружием',
    'um_6' => 'Владение алебардами и копьями',
    'um_7' => 'Владение посохами',
    'um_8' => 'Владение экзотическим оружием',
    'um_9' => 'Владение двуручным оружием',
    'um_10' => 'Владение двумя руками',
    'um_11' => 'Доп. очки действия',
    'um_12' => 'Магия огня',
    'um_13' => 'Магия воды',
    'um_14' => 'Магия воздуха',
    'um_15' => 'Магия земли',
    'um_16' => 'Сопротивление магии огня',
    'um_17' => 'Сопротивление магии воды',
    'um_18' => 'Сопротивление магии воздуха',
    'um_19' => 'Сопротивление магии земли',
    'um_20' => 'Сопротивление физ. поврежд.',
    'um_21' => 'Воровство',
    'um_22' => 'Осторожность',
    'um_23' => 'Скрытность',
    'um_24' => 'Наблюдательность',
    'um_25' => 'Торговля',
    'um_26' => 'Странник',
    'um_27' => 'Языковедение',
    'um_28' => 'Каллиграфия',
    'um_29' => 'Ювелирное дело',
    'um_30' => 'Самолечение',
    'um_31' => 'Оружейник',
    'um_32' => 'Доктор',
    'um_33' => 'Быстрое восстановление маны',
    'um_34' => 'Лидерство',
    'um_35' => 'Алхимия',
    'um_36' => 'Развитие горного дела',
    'um_37' => 'Рыбалка',
    'nav' => 'nav',
    'wea_f' => 'wea_f',
    'wea_s' => 'wea_s',
    'wea_od' => 'Требование ОД на удар',
    'block_od' => 'Требование ОД на блок',
    'w_koef' => 'Коэффициент оружия',
    //'inf_totem' => 'inf_totem',
);

$slot_fields = array(
    'Шлем', 'Амулет', 'Оружие', 'Пояс', 'Содержимое пояса', 'Содержимое пояса', 'Содержимое пояса',
    'Ботинки', 'Слот для кармана', 'Слот для содержимого кармана', 'Наручи', 'Перчатки',
    'Щит', 'Кольцо', 'Кольцо', 'Броня'
);

if (isset($_POST['update_tables']) && $bot_id != '')
{
    echo '<h5>';
    $bot = array();
    $res = mysqli_query($GLOBALS['db_link'], 'select * from bots_templates where inf_bot = ' . intval($bot_id));
    if ($row = mysqli_fetch_assoc($res))
        $bot = $row;
    mysqli_free_result($res);
    
    $bot_slots = array();
    $res = mysqli_query($GLOBALS['db_link'], 'select * from bots_slots where inf_bot = ' . intval($bot_id));
    if ($row = mysqli_fetch_assoc($res))
        $bot_slots = $row;
    mysqli_free_result($res);
    
    $player_ids = array();
    $ignore_fields = array('inf_bot', 'is_active', 'bot_class_id', 'search_possibility', 'drop_level_dec', 'drop_level_inc', 'comment');
    $res = mysqli_query($GLOBALS['db_link'], 'SELECT * FROM bots_fights WHERE inf_bot = ' . intval($bot_id));
    while ($row = mysqli_fetch_assoc($res))
        $player_ids[] = $row['playerid'];
    $player_arr = array_chunk($player_ids, 100);
    foreach($player_arr as $players)
    {
        $query = 'UPDATE e_players_table SET '."\n";
        foreach($bot as $key => $val)
        if (!in_array($key, $ignore_fields))
        {
            $query .= $key.' = '.$val.', '."\n";
        }
        $query = substr($query, 0, -3)."\n".' WHERE playerid IN ('.implode(',', $players).') AND inf_bot > 0';
        //echo nl2br($query);
        if (!mysqli_query($GLOBALS['db_link'], $query))
            echo mysqli_error($GLOBALS['db_link']);
        echo 'Ботов обновлено: ' . mysqli_affected_rows($GLOBALS['db_link']) . ', ';

        if (!mysqli_query($GLOBALS['db_link'], 'UPDATE e_players_slots SET sl_main = \'' . mysqli_real_escape_string($GLOBALS['db_link'], $bot_slots['sl_main']) . '\' WHERE playerid IN (' . implode(',', $players) . ')'))
            echo mysqli_error($GLOBALS['db_link']);
        echo 'Слотов обновлено: ' . mysqli_affected_rows($GLOBALS['db_link']);
    }
    echo '</h5>';
}
    
if (isset($_POST['save']) || isset($_POST['apply'])) 
{
    
    if ($bot_id == '') 
    {
        
        $qfield = '';
        $qvalues = '';
        
        foreach($fields as $code => $name) {
            $qfield .= $code.',';
            if ($code == 'w_koef')
                $qvalues .= (float)$_POST[$code].',';
            else
                $qvalues .= (int)$_POST[$code].',';
        };
        
        $query = '
        insert into bots_templates
        (
            comment,
            '.$qfield.'
            bot_class_id,
            is_active,
            search_possibility,
            drop_level_dec,
            drop_level_inc
        ) values (
            \'' . mysqli_real_escape_string($GLOBALS['db_link'], $_POST['comment']) . '\',
            '.$qvalues.'
            '.(int)$_POST['bot_class_id'].',
            '.(isset($_POST['is_active']) && $_POST['is_active']==1?1:0).',
            '.(int)$_POST['search_possibility'].',
            '.(int)$_POST['drop_level_dec'].',
            '.(int)$_POST['drop_level_inc'].'
        )';
        if (!mysqli_query($GLOBALS['db_link'], $query))
            die(mysqli_error($GLOBALS['db_link']));

        $bot_id = mysqli_insert_id($GLOBALS['db_link']);
        
    } else {
        
        $qfield = '';
        
        foreach($fields as $code => $name) {
            if ($code == 'w_koef') 
                $qfield .= $code.' = '.(float)$_POST[$code].',';
            else
                $qfield .= $code.' = '.(int)$_POST[$code].',';
        };
        
        $query = '
        update bots_templates set
            comment = \'' . mysqli_real_escape_string($GLOBALS['db_link'], $_POST['comment']) . '\',
            '.$qfield.'
            bot_class_id = '.(int)$_POST['bot_class_id'].',
            is_active = '.(isset($_POST['is_active']) && $_POST['is_active']==1?1:0).',
            search_possibility = '.(int)$_POST['search_possibility'].',
            drop_level_dec = '.(int)$_POST['drop_level_dec'].',
            drop_level_inc = '.(int)$_POST['drop_level_inc'].'
        where
            inf_bot = '.$bot_id.'
        '  ;
        if (!mysqli_query($GLOBALS['db_link'], $query))
            die(mysqli_error($GLOBALS['db_link']));
    }
    
    
    $slots = '';
    $weapon_steps = '';
    if (isset($_POST['slots_name']) && is_array($_POST['slots_name']))
    foreach($_POST['slots_name'] as $id=>$name) {
        $slots .= $_POST['slots_img'][$id].':'.$name.'@';
        $weapon_steps .= $_POST['slots_weapon'][$id].':'.$_POST['slots_steps'][$id].'@';
    }
    
    $query = '
    INSERT INTO bots_slots (inf_bot, sl_main, weapon_steps) VALUES (' . $bot_id . ', \'' . mysqli_escape_string($GLOBALS['db_link'], $slots) . '\', \'' . mysqli_escape_string($GLOBALS['db_link'], $weapon_steps) . '\')
    ON DUPLICATE KEY UPDATE
        sl_main = \'' . mysqli_real_escape_string($GLOBALS['db_link'], $slots) . '\',
        weapon_steps = \'' . mysqli_real_escape_string($GLOBALS['db_link'], $weapon_steps) . '\'
    ';

    if (!mysqli_query($GLOBALS['db_link'], $query))
        die(mysqli_error($GLOBALS['db_link']));
        
    
            
    
    // Drop
    mysqli_query($GLOBALS['db_link'], 'DELETE FROM bots_drops WHERE inf_bot = ' . intval($bot_id));
    if (isset($_POST['drop_group']) && is_array($_POST['drop_group']))
    foreach($_POST['drop_group'] as $k=>$group)
    {
        
        if ($_POST['drop_type'][$k] == 1)
            $item_id = (int)$_POST['drop_money'][$k];
        elseif ($_POST['drop_type'][$k] == 2)
            $item_id = (int)$_POST['drop_resource'][$k];
        elseif ($_POST['drop_type'][$k] == 3)
            $item_id = (int)$_POST['drop_weapon'][$k];
        elseif ($_POST['drop_type'][$k] == 4)
            $item_id = (int)$_POST['drop_tools'][$k];
        else
            $item_id = -1;
            
        $drop = serialize(array(
            $_POST['drop_type'][$k], $item_id, (int)$_POST['count_min'][$k], (int)$_POST['count_max'][$k] 
        ));
            
        
        if ($item_id != -1) 
        {
            if (!mysqli_query($GLOBALS['db_link'], '
                INSERT INTO bots_drops 
                (
                    inf_bot, 
                    group_id,
                    chance,
                    drop_item,
                    completed_quest,
                    deactivate_by_quest,
                    align
                ) 
                VALUES 
                (
                    '.intval($bot_id).', 
                    '.(int)$_POST['drop_group'][$k].',
                    '.floatval($_POST['drop_chance'][$k]).',
                    \'' . mysqli_real_escape_string($GLOBALS['db_link'], $drop) . '\',
                    '.(int)$_POST['completed_quest'][$k].',
                    '.(int)$_POST['deactivate_by_quest'][$k].',
                    '.(int)$_POST['align'][$k].'
                )
            '))
                die(mysqli_error($GLOBALS['db_link']));
        }
            
    }
    
    /// Saving kicks
        
    if ($bot_id != '')
        mysqli_query($GLOBALS['db_link'], 'DELETE FROM bots_kicks WHERE inf_bot = ' . intval($bot_id));
        
    $query = '
        INSERT INTO bots_kicks (inf_bot, kicks, blocks, adds)
        VALUES (' . $bot_id . ', \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['bot_kicks']['kicks']) . '\', \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['bot_kicks']['blocks']) . '\', \'' . mysqli_escape_string($GLOBALS['db_link'], $_POST['bot_kicks']['adds']) . '\')
    ';

    if (!mysqli_query($GLOBALS['db_link'], $query))
        die(mysqli_error($GLOBALS['db_link']));
    
    if (isset($_POST['save']))
        header('Location: '.$_SESSION['pages']['bot_list']);
    
}

$drop_type_array = array(
    1 => 'Деньги',
    2 => 'Ресурсы',
    3 => 'Оружие',
    4 => 'Инструменты',
);

$money_type_array = array(
    0 => 'NV',
    1 => 'Gold',
    2 => 'DNV'
);

$bot_drop = '';
$bot_time = '';

if (isset($_GET['copy_bot_id']))
    $bot_id = (int)$_GET['copy_bot_id'];
    
if ($bot_id == '') 
{
    $bot = array();
    foreach ($fields as $code => $name)
        $bot[$code] = 0;
    $bot['bot_class_id'] = '';
    $bot_slots = '';
} 
else 
{
    $bot = array();
    $res = mysqli_query($GLOBALS['db_link'], 'select * from bots_templates where inf_bot = ' . intval($bot_id));
    if ($row = mysqli_fetch_assoc($res))
        $bot = $row;
    mysqli_free_result($res);

    $res = mysqli_query($GLOBALS['db_link'], 'select * from bots_slots where inf_bot = ' . intval($bot_id));
    if ($row = mysqli_fetch_assoc($res))
        $bot_slots = $row;
    else
        $bot_slots = '';
    mysqli_free_result($res);
    
    
    // Drop and time
    $res = mysqli_query($GLOBALS['db_link'], 'select * from bots_drops where inf_bot = ' . intval($bot_id));
    while ($row = mysqli_fetch_assoc($res)) 
    {
        $arr = unserialize($row['drop_item']);
        $row['drop_type'] = $arr[0];
        $row['item_id'] = $arr[1];
        
        $bot_drop .= '<tr id="tr_drop_'.(++$row_id).'">
          <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_drop_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
          <td align="left" class="cms_middle"><input type="text" name="drop_group['.$row_id.']" value="'.$row['group_id'].'" size="5" /></td>
          <td align="left" class="cms_middle">'.createSelectFromArray('drop_type['.$row_id.']', $drop_type_array, $row['drop_type'], 'onchange="switchControl('.$row_id.', this.selectedIndex)"').'</td>
          <td align="left" class="cms_middle">
            <div id="'.$row_id.'_drop_type_1" style="display: '.($row['drop_type']==1?'block':'none').';">
                '.createSelectFromArray('drop_money['.$row_id.']', $money_type_array, ($row['drop_type']==1?$row['item_id']:'') ).'
            </div>
            <div id="'.$row_id.'_drop_type_2" style="display: '.($row['drop_type']==2?'block':'none').';">
                '.createSelectFromArray('drop_resource['.$row_id.']', $resource_array, ($row['drop_type']==2?$row['item_id']:'') ).'
            </div>
            <div id="'.$row_id.'_drop_type_3" style="display: '.($row['drop_type']==3?'block':'none').';">
                '.createWeaponControl('drop_weapon['.$row_id.']', 'uid', ($row['drop_type']==3?$row['item_id']:''), ($row['drop_type']==3?$weapon_array_uid[$row['item_id']]:'') ).'
            </div>
            <div id="'.$row_id.'_drop_type_4" style="display: '.($row['drop_type']==4?'block':'none').';">
                '.createSelectFromArray('drop_tools['.$row_id.']', $tools_array, ($row['drop_type']==4?$row['item_id']:'') ).'
            </div>
          </td>
          <td align="left" class="cms_middle"><input type="text" name="drop_chance['.$row_id.']" value="'.$row['chance'].'" /></td>
          <td align="left" class="cms_middle"><input type="text" name="count_min['.$row_id.']" value="'.$arr[2].'" size="8" /></td>
          <td align="left" class="cms_middle"><input type="text" name="count_max['.$row_id.']" value="'.$arr[3].'" size="8" /></td>
          <td align="left" class="cms_middle"><input type="text" name="completed_quest['.$row_id.']" value="'.$row['completed_quest'].'" size="8" /></td>
          <td align="left" class="cms_middle"><input type="text" name="deactivate_by_quest['.$row_id.']" value="'.$row['deactivate_by_quest'].'" size="8" /></td>
          <td align="left" class="cms_middle"><input type="text" name="align['.$row_id.']" value="'.$row['align'].'" size="8" /></td>
        </tr>';
    }
    mysqli_free_result($res);
}

$res = mysqli_query($GLOBALS['db_link'], 'select * from bots_kicks where inf_bot = ' . intval($bot_id));
if ($row = mysqli_fetch_assoc($res))
{
    $bot_kicks['kicks'] = $row['kicks'];
    $bot_kicks['blocks'] = $row['blocks'];
    $bot_kicks['adds'] = $row['adds'];
} else {
    $bot_kicks['kicks'] = '';
    $bot_kicks['blocks'] = '';
    $bot_kicks['adds'] = '';
}
mysqli_free_result($res);

if (isset($_GET['copy_bot_id']))
    $bot_id = '';

if ($bot_slots != '')
{
    $slots_arr = explode('@', $bot_slots['sl_main']);
    $slots_weapon_steps = explode('@', $bot_slots['weapon_steps']);
}
    
    
$weapons = array(
    1 => 'меч',
    2 => 'топор',
    3 => 'дробящее',
    4 => 'нож',
    5 => 'метательное',
    6 => 'алебарда',
    7 => 'посох',
);

?>
    <h3><?= ($bot_id == '' ? 'Добавить бота' : 'Изменить бота') ?></h3>
<link rel="stylesheet" href="files/modalwindow.css" type="text/css" />
    <script src="jscript/ajax.js" language="javascript" charset="utf-8"></script>
    <script src="jscript/modal_window.js" language="javascript" charset="utf-8"></script>
    <script src="jscript/controls/weapon_control.js" language="javascript" charset="utf-8"></script>
<script src="jscript/bot.js" language="javascript"></script>
<script language="javascript">
var last_id = <?=(int)$row_id?>;
<?=createJsArray('weapon_categories', $weapon_categories_array)?>
<?=createJsArray('drop_types', $drop_type_array)?>
<?=createJsArray('money_types', $money_type_array)?>
<?=createJsArray('resources', $resource_array)?>
<?=createJsArray('tools', $tools_array)?>
function switchControl(row_id, index)
{
    el(row_id+'_drop_type_1').style.display = 'none';
    el(row_id+'_drop_type_2').style.display = 'none';
    el(row_id+'_drop_type_3').style.display = 'none';
    el(row_id+'_drop_type_4').style.display = 'none';
    if (index > 0)
        el(row_id+'_drop_type_'+index).style.display = 'block';
}
</script>
<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td>Шаблон бота: &nbsp;</td>
  <td><?=createSelectFromArray('bot_class_id', $bot_classes, $bot['bot_class_id'])?></td>
</tr>
<tr>
    <td>Активный: &nbsp;</td>
  <td><input type="checkbox" name="is_active" value="1" <?=($bot['is_active']==1 ? 'checked="checked"' : '')?> ></td>
</tr>
<tr>
    <td>Комментарий: &nbsp;</td>
  <td><input type="text" name="comment" value="<?=(isset($bot['comment'])?_htext($bot['comment']):'')?>" /></td>
</tr>
<tr>
    <td>Вероятность обыска: &nbsp;</td>
  <td><input type="text" name="search_possibility" value="<?=(isset($bot['search_possibility'])?_htext($bot['search_possibility']):'100')?>" /></td>
</tr>
<tr>
    <td>Минус сколько уровней от бота дроп: &nbsp;</td>
  <td><input type="text" name="drop_level_dec" value="<?=(isset($bot['drop_level_dec'])?_htext($bot['drop_level_dec']):'0')?>" /></td>
</tr>
<tr>
    <td>Плюс сколько уровней от бота дроп: &nbsp;</td>
  <td><input type="text" name="drop_level_inc" value="<?=(isset($bot['drop_level_inc'])?_htext($bot['drop_level_inc']):'0')?>" /></td>
</tr>
<!--<tr>
  <td>Пройденный квест: &nbsp;  </td>
  <td><input type="text" name="completed_quest" value="<?=(isset($bot['completed_quest'])?_htext($bot['completed_quest']):'')?>" /></td>
</tr>
<tr>
  <td>Склонность: &nbsp;  </td>
  <td><input type="text" name="align" value="<?=(isset($bot['align'])?_htext($bot['align']):'')?>" /></td>
</tr>-->
<? foreach ($fields as $code => $name) { ?>
<tr>
  <td><?=$name?>: &nbsp;  </td>
  <td><input name="<?=$code?>" type="text" class="cms_fieldstyle1" id="<?=$code?>" value="<?=$bot[$code]?>" size="10" maxlength="255" onchange="recalc_total_steps();" /></td>
</tr>
<? } ?>
</table>
<br />
    Дроп:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_drop" >
    <tr >
        <td class="cms_cap3">Удалить</td>
        <td class="cms_cap3">Группа</td>
        <td class="cms_cap3">Тип дропа</td>
        <td class="cms_cap3">Предмет</td>
        <td class="cms_cap3">Шанс выпадения</td>
        <td class="cms_cap3">Мин.кол-во</td>
        <td class="cms_cap3">Макс.кол-во</td>
        <td class="cms_cap3">Пр.квест</td>
        <td class="cms_cap3">Деактивация по квесту</td>
        <td class="cms_cap3">Склонность</td>
    </tr>
    <?=$bot_drop?>
</table>
    <a onclick="addItem_weapon_drop('table_drop', 'tr_drop_', 'drop[]', '', 'drop_chance[]', ''); return false;"
       href="#">Добавить</a><br/>
<br />
<!--
Часы нападение (если пусто - нападает всегда):
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_time" >
    <tr >
        <td class="cms_cap3">Удалить</td>
        <td class="cms_cap3">Час</td>
        <td class="cms_cap3">Коэффициент</td>
    </tr>
    <?=$bot_time?>
</table>
<a onclick="addItem_edit('table_time', 'tr_time_', 'time[]', '', 'time_coef[]', ''); return false;" href="#">Добавить</a><br />
<br />
-->
    Слоты:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_quest_qe" >
    <tr >
        <td class="cms_cap3">Слот</td>
        <td class="cms_cap3">Название предмета</td>
        <td class="cms_cap3">Картинка</td>
        <td class="cms_cap3">Оружие</td>
        <td class="cms_cap3">ОД</td>
    </tr>
<? foreach($slot_fields as $id=>$sname) 
   {
 
    if (isset($slots_arr[$id]) && $slots_arr[$id]!='') 
    {
        $tarr = explode(':', $slots_arr[$id]);
        $img = $tarr[0];
        $name = $tarr[1];
    } 
    else 
    {
        $img = '';
        $name = '';
    }
    
    if (isset($slots_weapon_steps[$id]) && $slots_weapon_steps[$id] != '')
    {
        list($wea, $steps) = explode(':', $slots_weapon_steps[$id]);
    }
    else
    {
        $wea = '';
        $steps = '';
    }
?>
<tr>
  <td class="cms_middle"><?=$sname?>: &nbsp;  </td>
  <td class="cms_middle"><input name="slots_name[<?=$id?>]" type="text" class="cms_fieldstyle1" value="<?=$name?>" size="40" maxlength="255" /></td>
  <td class="cms_middle"><input name="slots_img[<?=$id?>]" type="text" class="cms_fieldstyle1" value="<?=$img?>" size="20" maxlength="255" /></td>
  <td class="cms_middle"><?=createSelectFromArray('slots_weapon['.$id.']', $weapons, $wea, 'id="wea_'.$id.'" onchange="recalc_total_steps();"')?></td>
  <td class="cms_middle"><input name="slots_steps[<?=$id?>]" type="text" class="cms_fieldstyle1" value="<?=$steps?>" id="steps_<?=$id?>" size="5" maxlength="5" onchange="recalc_total_steps();" /></td>
</tr>
<? } ?>
</table>
<br>
    <b>Очки действия на удар:</b>&nbsp;<span id="kick_steps"></span><br>
    <b>Всего очков действий:</b>&nbsp;<span id="total_steps"></span>
<script type="text/javascript">
function recalc_total_steps()
{
    var el = function(id) { return document.getElementById(id); }
    var elint = function(id) { return parseInt(document.getElementById(id).value); }
    var od_f = elint('steps_2');
    var od_s = elint('steps_12');
    var wea_f = elint('wea_2');
    var wea_s = elint('wea_12');
    var wea_od = 0;
    
    if(od_f)
    {
        var min_od = new Array(
            new Array(),
            new Array(0,2,4,6,8),
            new Array(0,2,5,7,10),
            new Array(0,2,5,7,10),
            new Array(0,2,4,6,8),
            new Array(),
            new Array(0,2,5,8,11),
            new Array(0,2,5,7,10)
        );
        var min = Math.floor( elint('um_'+wea_f) / 25 );
        if (min > 4)
            min = 4;
        if (min_od[wea_f][min])
            od_f -= min_od[wea_f][min];
        
        if(od_s)
        {
            min = Math.floor( elint('um_'+wea_s) / 25 );
            if (od_s -= min_od[wea_s][min])
                od_s -= min_od[wea_s][min];
            wea_od = Math.round((od_f + od_s)/2) + 5;
        }
        else 
            wea_od = od_f;
    }
    else 
        wea_od = 45 - Math.floor( elint('um_0') /12.5);

    el('kick_steps').innerHTML = wea_od;
    
    
    var total = 0;
    var level = elint('level');
    total += elint('steps') + elint('um_11') + ( level >= 5 && level <= 9 ? 10 : ( level > 9 ? 20 : 0 ) );
    
    el('total_steps').innerHTML = total;
}
recalc_total_steps();
</script>
<br>
<br />
<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td>Удары:</td>
    <td><input type="text" name="bot_kicks[kicks]" value="<?=htmlspecialchars($bot_kicks['kicks'])?>" size="100" /></td>
</tr>
<tr>
    <td>Блоки:</td>
    <td><input type="text" name="bot_kicks[blocks]" value="<?=htmlspecialchars($bot_kicks['blocks'])?>" size="100" /></td>
</tr>
<tr>
    <td>Дополнительно:</td>
    <td><input type="text" name="bot_kicks[adds]" value="<?=htmlspecialchars($bot_kicks['adds'])?>" size="100" /></td>
</tr>
</table>
<br />
<p></p>
    <input type="submit" name="save" class="cms_button1" value="Сохранить и выйти" style="width: 150px"/>
    <input type="submit" name="apply" class="cms_button1" value="Применить" style="width: 150px"/>
    <input name="cancel" type="submit"
           onclick="document.location='<?= $_SESSION['pages']['bot_list'] ?>'; return false;" class="cms_button1"
           value="Отмена"/>
<br><br>
    <input type="submit" name="update_tables" class="cms_button1" value="Обновить созданных ботов" style="width: 200px"
           onclick="return confirm('Вы уверены?');"/>&nbsp;(все изменения должны быть сохранены)
</form>
<? require('kernel/after.php'); ?>