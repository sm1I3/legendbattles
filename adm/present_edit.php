<?php
require('kernel/before.php');

if (!userHasPermission(131072)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['present_id']) || !is_numeric($_GET['present_id']))
    $present_id = '';
else
    $present_id = (int)$_GET['present_id'];
    
$modificators = array(
    4 => 'сила',
    5 => 'ловкость',
    6 => 'удача',
    7 => 'знания',
    8 => 'мудрость',
    9 => '% к силе',
    10 => '% к ловкости',
    11 => '% к удаче',
    12 => '% к знаниям',
    13 => '% к мудрости',
    14 => 'сокрушение',
    15 => 'стойкость',
    16 => 'уловка',
    17 => 'точность',
    18 => '% к сокрушению',
    19 => '% к стойкости',
    20 => '% к уловке',
    21 => '% к точности',
    22 => 'КБ',
    23 => '% к КБ',
    24 => 'ОД',
    25 => '% к опыту в боях против людей',
    26 => '% к урону',
    27 => 'сопротивление к магии огня',
    28 => 'сопротивление к магии воздуха',
    29 => 'сопротивление к магии земли',
    30 => 'сопротивление к магии воды',
    31 => 'сопротивление к ядам',
    32 => 'сопротивление к физическому урону',
    33 => 'вес',
    34 => '% к весу',
    35 => 'увеличение максимального HP',
    36 => 'увеличение максимального MP',
    37 => 'скорость восстановления HP',
    38 => 'скорость восстановления MP',
    39 => 'урон атаки min',
    40 => 'урон атаки max',
    41 => 'наблюдательность',
    42 => '% к опыту в боях против ботов',
    43 => 'Странник +к умению',
    44 => ' сек к +/-перемещению',
);
    
if (isset($_POST['present_id'])) 
{
    $params = array();
    if (trim($_POST['PLID']) != '')
        $params['PLID'] = (int)$_POST['PLID'];
    if (trim($_POST['OPEN']) != '')
        $params['OPEN'] = (int)$_POST['OPEN'];
    if (trim($_POST['TIME']) != '')
        $params['TIME'] = strtotime($_POST['TIME']);
    if (trim($_POST['PARENT']) != '')
        $params['PARENT'] = (int)$_POST['PARENT'];
        
    $params['XX'] = array();
        
    // Present includes money
    if (isset($_POST['ins_money']) && $_POST['ins_money'] == 'Y')
    {
        $params['XX']['MONEY'] = array(
            'money_d' => $_POST['money_d'],
            'money_dnv' => $_POST['money_dnv'],
        );
    }
    
    // Present includes items
    if (isset($_POST['ins_item']) && $_POST['ins_item'] == 'Y')
    {
        $params['XX']['ITEM'] = array();
        if (isset($_POST['pr_item_type']) && is_array($_POST['pr_item_type']))
        foreach($_POST['pr_item_type'] as $id => $type)
        {
            $act = 0;
            
            if (isset($_POST['pr_item_act'][$id]) && is_array($_POST['pr_item_act'][$id]))
            foreach($_POST['pr_item_act'][$id] as $actid => $val)
                if ($val == 'Y')
                    $act |= $actid;
                    
            $tmp = array(
                'type' => $type,
                'item' => $_POST['pr_item'][$id],
                'char_type' => $_POST['pr_item_pltype'][$id],
                'sex' => $_POST['pr_item_sex'][$id],
                //'long_q' => (isset($_POST['pr_item_dolg_1'][$id]) && $_POST['pr_item_dolg_1'][$id]=='Y' ? 1 : 0),
                'long' => (isset($_POST['pr_item_dolg'][$id]) ? $_POST['pr_item_dolg'][$id] : ''),
                //'price_q' => (isset($_POST['pr_item_price_1'][$id]) && $_POST['pr_item_price_1'][$id]=='Y' ? 1 : 0),
                'price' => (isset($_POST['pr_item_price'][$id]) ? $_POST['pr_item_price'][$id] : ''),
                'expire' => (isset($_POST['pr_item_expire'][$id]) ? $_POST['pr_item_expire'][$id] : ''),
                'actions' => $act
            );
            
            if ($_POST['pr_item_count'][$id] != '')
                $tmp['count'] = $_POST['pr_item_count'][$id];
            
            $params['XX']['ITEM'][] = $tmp;
        }
    }
    
    // Present includes effects
    if (isset($_POST['ins_effect']) && $_POST['ins_effect'] == 'Y')
    {
        $params['XX']['EFFECT'] = array(
            'effect_id' => $_POST['effect_id'],
            'effect_time' => $_POST['effect_time'],
            'effect_to' => $_POST['effect_to'],
            'modificators' => array(),
        );
        
        foreach($modificators as $id=>$name)
        {
            if (isset($_POST['modificator'][$id]) && $_POST['modificator'][$id]=='Y')
                $params['XX']['EFFECT']['modificators'][$id] = $_POST['modificator_value'][$id];
        }
    }
    
    // Present includes totem
    if (isset($_POST['ins_totem']) && $_POST['ins_totem'] == 'Y')
    {
        $params['XX']['TOTEM'] = array(
            'totem_id' => $_POST['totem_id'],
        );
    }
    
    if (sizeof($params['XX']) == 0)
        unset($params['XX']);
    
    $str_params = serialize($params);
    
    if ($present_id == '') 
    {
        $query = '
        insert into present_list
        (
            pr_code,
            pr_cat_id,
            pr_life,
            pr_nv,
            pr_dnv,
            pr_sex,
            pr_limit,
            pr_params
        ) values (
            '.(int)$_POST['present_id'].',
            '.(int)$_POST['category_id'].',
            '.(int)$_POST['pr_life'].',
            '.(int)$_POST['pr_nv'].',
            '.(float)$_POST['pr_dnv'].',
            '.(int)$_POST['pr_sex'].',
            '.(int)$_POST['pr_limit'].',
            \''.mysql_escape_string($str_params).'\'
        )'  ;
    } else {
        $query = '
        update present_list set
            pr_code = '.(int)$_POST['present_id'].',
            pr_cat_id = '.(int)$_POST['category_id'].',
            pr_life = '.(int)$_POST['pr_life'].',
            pr_nv = '.(int)$_POST['pr_nv'].',
            pr_dnv = '.(float)$_POST['pr_dnv'].',
            pr_sex = '.(int)($_POST['pr_sex']==''?2:$_POST['pr_sex']).',
            pr_limit = '.(int)$_POST['pr_limit'].',
            pr_params = \''.mysql_escape_string($str_params).'\'
        where
            pr_code = '.intval($present_id).'
        '  ;
    }    
    if (!mysql_query($query))
        die(mysql_error());
    header('Location: '.$_SESSION['pages']['present_list']);
    
}

if ((string)$present_id == '') 
{
    
    if (isset($_GET['copy_present_id']) && filter_var($_GET['copy_present_id'], FILTER_VALIDATE_INT))
    {
        $copy_present_id = (int)$_GET['copy_present_id'];
        $present = array();
        $res = mysql_query('select * from present_list where pr_code = '.intval($copy_present_id));
        if($row = mysql_fetch_assoc($res))
        {
            $present = $row;
            $present['present_id'] = $row['pr_code'];
            $present['category_id'] = $row['pr_cat_id'];
            
            $present_add = unserialize($present['pr_params']);
        }
        
        mysql_free_result($res);
    }
    else
    {
    
        $present = array(
            'present_id' => '',
            'category_id' => '',
            'category_name' => '',
            'pr_life' => 255,
            'pr_nv' => 100,
            'pr_dnv' => 0,
            'pr_sex' => 2,
            'pr_limit' => 50000,
        );
        $present_add = array(
            'PLID' => '',
            'OPEN' => '',
            'TIME' => '',
            'PARENT' => '0',
        );
    }
} 
else 
{
    $present = array();
    $res = mysql_query('select * from present_list where pr_code = '.intval($present_id));
    if($row = mysql_fetch_assoc($res))
    {
        $present = $row;
        $present['present_id'] = $row['pr_code'];
        $present['category_id'] = $row['pr_cat_id'];
        
        $present_add = unserialize($present['pr_params']);
        
        //var_dump($present_add);
    }
    
    mysql_free_result($res);
}

$categories = array();
$res = mysql_query('select * from present_category order by pr_cat_title asc');
while($row = mysql_fetch_assoc($res))
    $categories[$row['pr_cat_id']] = $row['pr_cat_title'];
mysql_free_result($res);

$sexes = array(
    2 => 'Любой',
    0 => 'Мужской',
    1 => 'Женский',
);

$pl_types = array(
    0 => 'Любой',
    1 => 'Воин',
    2 => 'Маг',
);

$open_types = array(
    1 => 'Индивидуальное',
    2 => 'Массовое',
    3 => 'Подаренная вещь',
);

$item_actions = array(
    1 => 'Продать',
    2 => 'Передавать',
    4 => 'Дарить',
    8 => 'Сдать в гос',
    16 => 'Выставлять на аукцион',
    32 => 'Выкидывать',
);

// list of all weapon categories
$weapon_categories_array = array();
$res = mysql_query('select * from weapon_categories');
while($row = mysql_fetch_assoc($res))
    $weapon_categories_array[$row['category_code']] = $row['category_name'];
mysql_free_result($res);

$row_id = 1;

?>
    <h3><?= ($present_id == '' ? 'Добавить подарок' : 'Изменить подарок') ?></h3>

    <script type="text/javascript" src="jscript/calendar/calendar_stripped.js" charset="utf-8"></script>
    <script type="text/javascript" src="jscript/calendar/lang/calendar-ru_win_.js" charset="utf-8"></script>
    <script type="text/javascript" src="jscript/calendar/calendar-setup_stripped.js" charset="utf-8"></script>
    <script src="jscript/ajax.js" language="javascript" charset="utf-8"></script>
    <script src="jscript/modal_window.js" language="javascript" charset="utf-8"></script>
    <script src="jscript/controls/weapon_control.js" language="javascript" charset="utf-8"></script>
    <script src="jscript/present.js" language="javascript" charset="utf-8"></script>
<script language="javascript">
    var last_id = <?=(int)$row_id?>; 
    <?=createJsArray('weapon_categories', $weapon_categories_array)?>
    <?=createJsArray('sexes', $sexes)?>
    <?=createJsArray('pl_types', $pl_types)?>
    <?=createJsArray('item_actions', $item_actions)?>
</script>
<link rel="stylesheet" type="text/css" media="all" href="jscript/calendar/calendar-system.css" title="system" />
<link rel="stylesheet" href="files/modalwindow.css" type="text/css" />

<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td><span class="cms_star">*</span>ID Подарка: &nbsp;</td>
  <td><input name="present_id" type="text" class="cms_fieldstyle1" value="<?=$present['present_id']?>" size="10" maxlength="255" /></td>
</tr>
<tr>
    <td><span class="cms_star">*</span>Категория Подарка: &nbsp;</td>
  <td><?=createSelectFromArray('category_id', $categories, $present['category_id'])?></td>
</tr>
<tr>
    <td><span class="cms_star">*</span>Время жизни: &nbsp;</td>
  <td><input name="pr_life" type="text" class="cms_fieldstyle1" value="<?=$present['pr_life']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td><span class="cms_star">*</span>Стоимость NV: &nbsp;</td>
  <td><input name="pr_nv" type="text" class="cms_fieldstyle1" value="<?=$present['pr_nv']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td><span class="cms_star">*</span>Стоимость DNV: &nbsp;</td>
  <td><input name="pr_dnv" type="text" class="cms_fieldstyle1" value="<?=$present['pr_dnv']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td><span class="cms_star">*</span>Пол: &nbsp;</td>
  <td><?=createSelectFromArray('pr_sex', $sexes, $present['pr_sex'])?></td>
</tr>
<tr>
    <td><span class="cms_star">*</span>Лимит: &nbsp;</td>
  <td><input name="pr_limit" type="text" class="cms_fieldstyle1" value="<?=$present['pr_limit']?>" size="30" maxlength="255" /></td>
</tr>
</table><br />
    Дополнительные параметры:<br/>
<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td>Индивидуальный подарок: &nbsp;</td>
  <td><input name="PLID" type="text" class="cms_fieldstyle1" value="<?=(isset($present_add['PLID'])?$present_add['PLID']:'')?>" size="10" maxlength="255" /></td>
</tr>
<tr>
    <td>Тип открытия: &nbsp;</td>
  <td><?=createSelectFromArray('OPEN', $open_types, (isset($present_add['OPEN'])?$present_add['OPEN']:''))?></td>
</tr>
<tr>
    <td>Родитель: &nbsp;</td>
  <td><input name="PARENT" type="text" class="cms_fieldstyle1" value="<?=(isset($present_add['PARENT'])?$present_add['PARENT']:'')?>" size="10" maxlength="255" /></td>
</tr>
<tr>
    <td>Время открытия: &nbsp;</td>
  <td>
    <input name="TIME" id="TIME" type="text" class="cms_fieldstyle1" value="<?=(isset($present_add['TIME']) && $present_add['TIME']!=''?date('Y-m-d H:i:s', $present_add['TIME']):'')?>" size="22" maxlength="255" />
    <img src="images/cms_icons/cms_calendar.gif" align="absmiddle" id="kl1jhjhdj12d1jk2" title="Set Date" alt="Set Date" style="cursor: pointer;" border="0">
    <script type="text/javascript">
    
    Calendar.setup({
        inputField : "TIME",     // id of the input field
        ifFormat   : "%Y-%m-%d %H:%M:00",      // format of the input field
        button     : "kl1jhjhdj12d1jk2",  // trigger for the calendar (button ID)
        align      : "Br",        // alignment (defaults to "Bl")
        //showOthers : true,          // if "true" (but default: "false") it will show days from other months too
        weekNumbers: false,          // (true/false) if it's true (default) the calendar will display week numbers
        showsTime   : true,               // show time
        timeFormat  : 24 
        
    });
    Calendar.setup({
        inputField : "TIME",     
        ifFormat   : "%Y-%m-%d %H:%M:00",
        align      : "Br",
        //showOthers : true,
        weekNumbers: false,
        showsTime   : true,               // show time
        timeFormat  : 24
        
    });
    </script>
    <img src="images/cms_icons/cms_calendar_clear.gif" align="absmiddle" onclick='document.getElementById("TIME").value=""; ' title="Clear Date" style="cursor: pointer;" >
  </td>
</tr>
</table>
<br />

    <!-- ДЕНЬГИ -->
    <input type="checkbox" <?= (isset($present_add['XX']['MONEY']) ? 'checked="checked"' : '') ?> name="ins_money"
           id="ins_money" value="Y" onclick="el('div_money').style.display = (this.checked ? 'block' : 'none');"/><label
            for="ins_money"><b>Деньги</b></label><br/>
<div id="div_money" style="display: <?=(isset($present_add['XX']['MONEY'])?'block':'none')?>;">
$: <input type="text" name="money_d" value="<?=(isset($present_add['XX']['MONEY']['money_d'])?$present_add['XX']['MONEY']['money_d']:'')?>" />&nbsp;&nbsp;DNV: <input type="text" name="money_dnv" value="<?=(isset($present_add['XX']['MONEY']['money_dnv'])?$present_add['XX']['MONEY']['money_dnv']:'')?>" />
</div>
<br />

    <!-- ВЕЩЬ -->
    <input type="checkbox" <?= (isset($present_add['XX']['ITEM']) ? 'checked="checked"' : '') ?> name="ins_item"
           id="ins_item" value="Y" onclick="el('div_item').style.display = (this.checked ? 'block' : 'none');"/><label
            for="ins_item"><b>Вещь</b></label><br/>
<div id="div_item" style="display: <?=(isset($present_add['XX']['ITEM'])?'block':'none')?>;">
    Набор вещей:
    <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_present_wea" >
        <tr >
            <td class="cms_cap3 normal">Удалить</td>
            <td class="cms_cap3">Тип</td>
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
        if (isset($present_add['XX']['ITEM']) && is_array($present_add['XX']['ITEM']))
        foreach($present_add['XX']['ITEM'] as $id => $item) 
        { 
            $item_name = '';
            if ($item['type']=='D')
            {
                $res = mysql_query('SELECT * FROM d_dilers WHERE wuid = \''.mysql_escape_string($item['item']).'\'');
                if ($row = mysql_fetch_assoc($res))
                    $item_name = $row['w_name'];
            } else
            {
                $res = mysql_query('SELECT * FROM weapons_template WHERE w_uid = \''.mysql_escape_string($item['item']).'\'');
                if ($row = mysql_fetch_assoc($res))
                    $item_name = $row['w_name'];
            } 
        ?>
        <tr id="tr_wea<?=$id?>">
            <td class="cms_middle" align="center"><a href="#" onclick="removeItem('tr_wea<?=$id?>');"><img src="images/cms_icons/cms_delete.gif" /></a></td>
            <td class="cms_middle"><?= ($item['type'] == 'N' ? 'Обычный <input type="hidden" name="pr_item_type[' . $id . ']" value="N" />' : 'Дилерский <input type="hidden" name="pr_item_type[' . $id . ']" value="D" />') ?></td>
            <td class="cms_middle"><?=createWeaponControl('pr_item['.$id.']', 'uid', $item['item'], $item_name, ($item['type']=='P'?'normal':'dealers'))?></td>
            <td class="cms_middle"><?=createSelectFromArray('pr_item_pltype['.$id.']', $pl_types, $item['char_type'])?></td>
            <td class="cms_middle"><?=createSelectFromArray('pr_item_sex['.$id.']', $sexes, $item['sex'])?></td>
            <td class="cms_middle">
                <input type="text" name="pr_item_dolg[<?=$id?>]" id="pr_item_dolg_<?=$id?>" value="<?=$item['long']?>" size="3" />
                <!--<input type="checkbox" name="pr_item_dolg_1[<?= $id ?>]" id="pr_item_dolg_1_<?= $id ?>_" value="Y" <?= ($item['long_q'] == 1 ? 'checked="checked"' : '') ?> /><label for="pr_item_dolg_1_<?= $id ?>_">Зависит от кол-ва</label>-->
            </td>
            <td class="cms_middle">
                <input type="text" name="pr_item_count[<?=$id?>]" id="pr_item_count_<?=$id?>" value="<?=(isset($item['count'])?$item['count']:'')?>" size="3" />
            </td>
            <td class="cms_middle">
                <input type="text" name="pr_item_price[<?=$id?>]" id="pr_item_price_<?=$id?>" value="<?=$item['price']?>" size="3" />
                <!--<input type="checkbox" name="pr_item_price_1[<?= $id ?>]" id="pr_item_price_1_<?= $id ?>_" value="Y" <?= ($item['price_q'] == 1 ? 'checked="checked"' : '') ?> /><label for="pr_item_price_1_<?= $id ?>_">Зависит от кол-ва</label>-->
            </td>
            <td class="cms_middle">
                <input type="text" name="pr_item_expire[<?=$id?>]" id="pr_item_expire_<?=$id?>" value="<?=$item['expire']?>" size="3" />
            </td>
            <td>
            <? foreach($item_actions as $aid => $actname) { ?>
                <input type="checkbox" <?=($item['actions'] & $aid?'checked="checked"':'')?> name="pr_item_act[<?=$id?>][<?=$aid?>]" id="pr_item_act_<?=$id?>_<?=$aid?>" value="Y" /><label for="pr_item_act_<?=$id?>_<?=$aid?>"><?=$actname?></label><br />
            <? } ?>
            </td>
        
        <? } ?>
        
    </table>
    <a onclick="addItem_present_weapon('table_present_wea', 'tr_wea', 'pr_item', 'normal'); return false;" href="#">Добавить
        предмет</a>&nbsp;&nbsp;<a
            onclick="addItem_present_weapon('table_present_wea', 'tr_wea', 'pr_item', 'dealers'); return false;"
            href="#">Добавить дилерский предмет</a><br/>
</div>
<br />

    <!-- ЭФФЕКТ -->
    <input type="checkbox" <?= (isset($present_add['XX']['EFFECT']) ? 'checked="checked"' : '') ?> name="ins_effect"
           id="ins_effect" value="Y"
           onclick="el('div_effect').style.display = (this.checked ? 'block' : 'none');"/><label for="ins_effect"><b>Эффект</b></label><br/>
<div id="div_effect" style="display: <?=(isset($present_add['XX']['EFFECT'])?'block':'none')?>;">
    ID эффекта: <input type="text" name="effect_id"
                       value="<?= (isset($present_add['XX']['EFFECT']['effect_id']) ? $present_add['XX']['EFFECT']['effect_id'] : '') ?>"/><br/>
    Время эффекта: <input type="text" name="effect_time"
                          value="<?= (isset($present_add['XX']['EFFECT']['effect_time']) ? $present_add['XX']['EFFECT']['effect_time'] : '') ?>"/><br/>
    Лимит до: <input type="text" name="effect_to"
                     value="<?= (isset($present_add['XX']['EFFECT']['effect_to']) ? $present_add['XX']['EFFECT']['effect_to'] : '') ?>"/><br/>
<? foreach($modificators as $id=>$name) { 
    $mdf = array();
    if (isset($present_add['XX']['EFFECT']['modificators']))
        $mdf = $present_add['XX']['EFFECT']['modificators'];
?>
<input type="checkbox" <?=(isset($mdf[$id])?'checked="checked"':'')?> name="modificator[<?=$id?>]" id="modificator_<?=$id?>" value="Y" onclick="el('modificator_value_<?=$id?>').style.visibility = (this.checked ? 'visible':'hidden')" /><label for="modificator_<?=$id?>"><?=$name?></label>&nbsp;
<input type="text" name="modificator_value[<?=$id?>]" id="modificator_value_<?=$id?>" value="<?=(isset($mdf[$id])?$mdf[$id]:'')?>" style="visibility: <?=(isset($mdf[$id])?'visible':'hidden')?>" /><br />
<? } ?>
</div>
<br />

    <!-- ТОТЕМ -->
    <input type="checkbox" <?= (isset($present_add['XX']['TOTEM']) ? 'checked="checked"' : '') ?> name="ins_totem"
           id="ins_totem" value="Y" onclick="el('div_totem').style.display = (this.checked ? 'block' : 'none');"/><label
            for="ins_totem"><b>Тотем</b></label><br/>
<div id="div_totem" style="display: <?=(isset($present_add['XX']['TOTEM'])?'block':'none')?>;">
    ID тотема: <input type="text" name="totem_id"
                      value="<?= (isset($present_add['XX']['TOTEM']['totem_id']) ? $present_add['XX']['TOTEM']['totem_id'] : '') ?>"/>
</div>
<br />

<p></p>
    <input name="submit" type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
    <input name="cancel" type="submit"
           onclick="document.location='<?= $_SESSION['pages']['present_list'] ?>'; return false;" class="cms_button1"
           value="Отмена"/>
    <p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>