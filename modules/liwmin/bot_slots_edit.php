<?php
require('kernel/before.php');

if (!userHasPermission(128)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['bot_template_id']) || !is_numeric($_GET['bot_template_id']) || !isset($_GET['level']) || !is_numeric($_GET['level'])) {
    $bot_template_id = '';
    $level = '';
} else {
    $bot_template_id = (int)$_GET['bot_template_id'];
    $level = (int)$_GET['level'];
}
    
$slot_fields = array(
    'Шлем', 'Амулет', 'Оружие', 'Пояс', 'Содержимое пояса', 'Содержимое пояса', 'Содержимое пояса', 
    'Ботинки', 'Слот для кармана', 'Слот для содержимого кармана', 'Наручи', 'Перчатки', 
    'Щит', 'Кольцо', 'Кольцо', 'Броня'
);

$bot_templates = array();
$res = mysql_query('select * from e_players_bots_templates'); 
while ($row = mysql_fetch_assoc($res))
    $bot_templates[$row['bot_template_id']] = $row['nickname'];
    
if (isset($_POST['level'])) {
    
    $slots = '';
    if (isset($_POST['slots_name']) && is_array($_POST['slots_name']))
    foreach($_POST['slots_name'] as $id=>$name) {
        $slots .= $_POST['slots_img'][$id].':'.$name.'@';
    }
    
    if ($bot_template_id == '') {
        $query = '
        insert into e_players_bots_slots
        (
            bot_template_id,
            level,
            slots
        ) values (
        '.(int)$_POST['bot_template_id'].',
        '.(int)$_POST['level'].',
        \''.mysql_real_escape_string($slots).'\'
        )'  ;
    } else {
        $query = '
        update e_players_bots_slots set
            bot_template_id = '.(int)$_POST['bot_template_id'].',
            level = '.(int)$_POST['level'].',
            slots = \''.mysql_real_escape_string($slots).'\'
        where
            bot_template_id = '.intval($bot_template_id).' and
            level = '.intval($level).' 
        '  ;
    }    
    if (!mysql_query($query))
        die(mysql_error());
    header('Location: bot_slots_list.php');
    
}

if (isset($_GET['copy_bot_template_id']))
{
    $bot_template_id = (int)$_GET['copy_bot_template_id'];
    $level = (int)$_GET['level'];
}

if ($bot_template_id == '') {
    $bot_slots = array(
        'bot_template_id' => '',
        'level' => '',
        'slots' => '',
    );
} else {
    $bot_slots = array();
    $res = mysql_query('select * from e_players_bots_slots where bot_template_id = '.intval($bot_template_id).' and level = '.intval($level));
    if($row = mysql_fetch_assoc($res))
        $bot_slots = $row;
    mysql_free_result($res);
}

if (isset($_GET['copy_bot_template_id']))
{
    $bot_template_id = '';
    $level = '';
}

$slots_arr = explode('@', $bot_slots['slots']);

?>
<h3><?=($bot_template_id == ''?'Добавить слоты бота':'Изменить слоты бота')?></h3>

<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
  <td>ID Шаблона: &nbsp;  </td>
  <td><?=createSelectFromArray('bot_template_id', $bot_templates, $bot_slots['bot_template_id'])?></td>
</tr>
<tr>
  <td>Уровень бота: &nbsp;  </td>
  <td><input name="level" type="text" class="cms_fieldstyle1" value="<?=$bot_slots['level']?>" size="30" maxlength="255" /></td>
</tr>
</table>

Слоты:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_quest_qe" >
    <tr >
        <td class="cms_cap3">Слот</td>
        <td class="cms_cap3">Название предмета</td>
        <td class="cms_cap3">Картинка</td>
    </tr>
<? foreach($slot_fields as $id=>$sname) {
 
    if (isset($slots_arr[$id]) && $slots_arr[$id]!='') {
        $tarr = explode(':', $slots_arr[$id]);
        $img = $tarr[0];
        $name = $tarr[1];
    } else {
        $img = '';
        $name = '';
    }
?>
<tr>
  <td class="cms_middle"><?=$sname?>: &nbsp;  </td>
  <td class="cms_middle"><input name="slots_name[<?=$id?>]" type="text" class="cms_fieldstyle1" value="<?=$name?>" size="40" maxlength="255" /></td>
  <td class="cms_middle"><input name="slots_img[<?=$id?>]" type="text" class="cms_fieldstyle1" value="<?=$img?>" size="20" maxlength="255" /></td>
</tr>
<? } ?>
</table>

<p></p>
  <input name="submit"  type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
  <input name="cancel" type="submit" onclick="document.location='bot_slots_list.php'; return false;" class="cms_button1" value="Отмена" />
<p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>