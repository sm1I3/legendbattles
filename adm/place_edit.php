<?php
require('kernel/before.php');

if (!userHasPermission(16384)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['place_code']) || $_GET['place_code'] == '')
    $place_code = '';
else
    $place_code = $_GET['place_code'];
    
if (isset($_POST['city'])) {
    
    if ($place_code == '') {
        $query = '
        insert into loc
        (
            id,
            loc,
			city,
			but
        ) values (
            \'' . mysqli_real_escape_string($GLOBALS['db_link'], $_POST['id']) . '\',
            \'' . mysqli_real_escape_string($GLOBALS['db_link'], $_POST['loc']) . '\'
			\'' . mysqli_real_escape_string($GLOBALS['db_link'], $_POST['city']) . '\'
			\'' . mysqli_real_escape_string($GLOBALS['db_link'], $_POST['but']) . '\'
        )'  ;
        if (!mysqli_query($GLOBALS['db_link'], $query))
            die(mysqli_error($GLOBALS['db_link']));
    } else {
        $query = '
        update loc set
            id = \'' . mysqli_real_escape_string($GLOBALS['db_link'], $_POST['id']) . '\',
            loc = \'' . mysqli_real_escape_string($GLOBALS['db_link'], $_POST['loc']) . '\',
			city = \'' . mysqli_real_escape_string($GLOBALS['db_link'], $_POST['city']) . '\',
			room = \'' . mysqli_real_escape_string($GLOBALS['db_link'], $_POST['but']) . '\'
        where
            id = \'' . mysqli_real_escape_string($GLOBALS['db_link'], $place_code) . '\'
        '  ;
        if (!mysqli_query($GLOBALS['db_link'], $query))
            die(mysqli_error($GLOBALS['db_link']));
    }
/*    
    if (!mysqli_query($GLOBALS['db_link'],'delete from restore_located where place_code = \''.mysqli_real_escape_string($GLOBALS['db_link'],$place_code).'\''))
        die(mysqli_error($GLOBALS['db_link'])); 
    
    if (isset($_POST['item']) && is_array($_POST['item']))
    foreach($_POST['item'] as $k => $item_id) {
        if (!mysqli_query($GLOBALS['db_link'],'insert into restore_located (place_code, item_id, item_amount, item_average, item_requirement) values (\''.mysqli_escape_string($GLOBALS['db_link'],$place_code).'\', '.(int)$item_id.', '.(int)$_POST['item_amount'][$k].', '.(int)$_POST['item_average'][$k].', '.(int)$_POST['item_requirement'][$k].')'))
            die(mysqli_error($GLOBALS['db_link'])); 
    }
*/
    mysqli_query($GLOBALS['db_link'], 'delete from quest_to_place where place_code = \'' . mysqli_real_escape_string($GLOBALS['db_link'], $place_code) . '\'');
    
    if (isset($_POST['quest']) && is_array($_POST['quest']))
    foreach($_POST['quest'] as $k => $quest_id) {
        if (!mysqli_query($GLOBALS['db_link'], 'insert into quest_to_place (place_code, quest_id) values (\'' . mysqli_escape_string($GLOBALS['db_link'], $place_code) . '\', ' . (int)$quest_id . ')'))
            die(mysqli_error($GLOBALS['db_link'])); 
    }
    
    header('Location: place_list.php');
    
}

$goods = '';
$quests = '';
$row_id = 0;
/*
// list of items
$item_array = array();
$res = mysqli_query($GLOBALS['db_link'],'select * from restore_items');
while($row = mysqli_fetch_assoc($res))
    $item_array[$row['item_id']] = $row['item_name'].' ('.$row['item_cost'].')';
mysqli_free_result($res);
*/

// list of all quests
$quest_array = array();
$res = mysqli_query($GLOBALS['db_link'], 'select * from quest_list WHERE is_confirmed = \'Y\'');
while ($row = mysqli_fetch_assoc($res)) {
    $tmp_arr = unserialize($row['quest_serilize']);
    $quest_array[$row['quest_id']] = $tmp_arr[0][0].(isset($tmp_arr[0][5]) && $tmp_arr[0][5] != '' ? ' ('.$tmp_arr[0][5].')' : '');
}
mysqli_free_result($res);

if ($place_code == '') {
    $place = array(
        'id' => '',
        'city' => '',
		'loc' => '',
		'room' => ''
    );
} else {
    $place = array();
    $res = mysqli_query($GLOBALS['db_link'], 'select * from loc where id = \'' . mysqli_real_escape_string($GLOBALS['db_link'], $place_code) . '\'');
    if ($row = mysqli_fetch_assoc($res))
        $place = $row;
    mysqli_free_result($res);
/*    
    $res = mysqli_query($GLOBALS['db_link'],'select * from restore_located where place_code = \''.mysqli_real_escape_string($GLOBALS['db_link'],$place_code).'\' order by locate_id asc');
    while($row = mysqli_fetch_assoc($res)) {
        $goods .= '
        <tr id="tr_items_'.(++$row_id).'">
          <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_items_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
          <td align="left" class="cms_middle">'.createSelectFromArray('item['.$row_id.']', $item_array, $row['item_id']).'</td>
          <td align="left" class="cms_middle"><input type="text" name="item_amount['.$row_id.']" value="'.$row['item_amount'].'" /></td>
          <td align="left" class="cms_middle"><input type="text" name="item_average['.$row_id.']" value="'.$row['item_average'].'" /></td>
          <td align="left" class="cms_middle"><input type="text" name="item_requirement['.$row_id.']" value="'.$row['item_requirement'].'" /></td>
          <td align="left" class="cms_middle"><a onclick="moveItemUp(\'table_items\', \'tr_items_\', '.$row_id.'); return false;" href="#">up</a>&nbsp;<a onclick="moveItemDown(\'table_items\', \'tr_items_\', '.$row_id.'); return false;" href="#">down</a></td>
        </tr>
        ';
    }
*/
    $res = mysqli_query($GLOBALS['db_link'], 'select * from quest_to_place where place_code = \'' . mysqli_real_escape_string($GLOBALS['db_link'], $place_code) . '\'');
    while ($row = mysqli_fetch_assoc($res)) {
        $quests .= '
        <tr id="tr_quests_'.(++$row_id).'">
          <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_quests_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
          <td align="left" class="cms_middle">'.createSelectFromArray('quest['.$row_id.']', $quest_array, $row['quest_id']).'</td>
        </tr>
        ';
    }
}

?>
    <h3><?= ($place_code == '' ? 'Добавить место' : 'Изменить место') ?></h3>
<script src="jscript/place.js" language="javascript"></script>
<script language="javascript">
var last_id = <?=(int)$row_id?>;
<?=createJsArray('item_array', $item_array)?>
<?=createJsArray('quest_array', $quest_array)?>
</script>
<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td><span class="cms_star">*</span>Код места: &nbsp;</td>
  <td><input name="id" type="text" class="cms_fieldstyle1" value="<?=$place['id']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td><span class="cms_star">*</span>Название города: &nbsp;</td>
  <td><input name="city" type="text" class="cms_fieldstyle1" value="<?=$place['city']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td><span class="cms_star">*</span>Название локации: &nbsp;</td>
  <td><input name="loc" type="text" class="cms_fieldstyle1" value="<?=$place['loc']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td><span class="cms_star">*</span>Название комнаты: &nbsp;</td>
  <td><input name="room" type="text" class="cms_fieldstyle1" value="<?=$place['but']?>" size="30" maxlength="255" /></td>
</tr>
</table>
<br />
    Квесты:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_quests" >
    <tr >
        <td class="cms_cap3 normal">Удалить</td>
        <td class="cms_cap3">Квест</td>
    </tr>
    <?=$quests?>
</table>
    <a onclick="addItem_select('table_quests', 'tr_quests_', 'quest[]', quest_array, '', ''); return false;" href="#">Добавить
        квест</a><br/>
<!--<br />

Товары:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_items" >
    <tr >
        <td class="cms_cap3 normal">Удалить</td>
        <td class="cms_cap3">Товар</td>
        <td class="cms_cap3">Количество</td>
        <td class="cms_cap3">average</td>
        <td class="cms_cap3">requirement</td>
        <td class="cms_cap3">&nbsp;</td>
    </tr>
    <?=$goods?>
</table>
<a onclick="addItem_place_item('table_items', 'tr_items_', 'item[]', item_array, '', ''); return false;" href="#">Добавить товар</a><br />
-->
<p></p>
    <input name="submit" type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
    <input name="cancel" type="submit" onclick="document.location='place_list.php'; return false;" class="cms_button1"
           value="Отмена"/>
    <p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>