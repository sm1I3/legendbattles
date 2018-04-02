<?php
require('kernel/before.php');

if (!userHasPermission(2)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['place_code']))
    $place_code = '';
else
    $place_code = $_GET['place_code'];
    
if (isset($_POST['place_name'])) {
    
    if ($place_code == '') {
        $query = '
        insert into quest_places
        (
            place_code,
            place_name
        ) values (
            \'' . mysqli_real_escape_string($GLOBALS['db_link'], $_POST['place_code']) . '\',
            \'' . mysqli_real_escape_string($GLOBALS['db_link'], $_POST['place_name']) . '\'
        )'  ;
        mysqli_query($GLOBALS['db_link'], $query);
        $place_code = mysqli_insert_id($GLOBALS['db_link']);
    } else {
        $query = '
        update quest_places set
            place_code = \'' . mysqli_real_escape_string($GLOBALS['db_link'], $_POST['place_code']) . '\',
            place_name = \'' . mysqli_real_escape_string($GLOBALS['db_link'], $_POST['place_name']) . '\'
        where
            place_code = \'' . mysqli_real_escape_string($GLOBALS['db_link'], $place_code) . '\'
        '  ;
        mysqli_query($GLOBALS['db_link'], $query);
    }

    mysqli_query($GLOBALS['db_link'], 'delete from quest_to_place where place_code = \'' . mysqli_real_escape_string($GLOBALS['db_link'], $place_code) . '\'');
    
    if (isset($_POST['quest']) && is_array($_POST['quest']))
    foreach($_POST['quest'] as $k => $quest_id) {
        mysqli_query($GLOBALS['db_link'], 'insert into quest_to_place (place_code, quest_id) values (\'' . mysqli_real_escape_string($GLOBALS['db_link'], $place_code) . '\', ' . (int)$quest_id . ')');
    }
    
    header('Location: quest_place_list.php');
    
}

$quests = '';
$row_id = 0;

// list of all quests
$quest_array = array();
$res = mysqli_query($GLOBALS['db_link'], 'select * from quest_list');
while ($row = mysqli_fetch_assoc($res)) {
    $tmp_arr = unserialize($row['quest_serilize']);
    $quest_array[$row['quest_id']] = $tmp_arr[0][0];
}
mysqli_free_result($res);

if ($place_code == '') {
    $place = array(
        'place_code' => '',
        'place_name' => ''
    );
} else {
    $place = array();
    $res = mysqli_query($GLOBALS['db_link'], 'select * from quest_places where place_code = \'' . mysqli_real_escape_string($GLOBALS['db_link'], $place_code) . '\'');
    echo mysqli_error($GLOBALS['db_link']);
    if ($row = mysqli_fetch_assoc($res))
        $place = $row;
    mysqli_free_result($res);

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
<script language="javascript">
var last_id = <?=(int)$row_id?>;
<?=createJsArray('quest_array', $quest_array)?>

</script>
<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
    <td><span class="cms_star">*</span>Код места: &nbsp;</td>
  <td><input name="place_code" type="text" class="cms_fieldstyle1" value="<?=$place['place_code']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
    <td><span class="cms_star">*</span>Название места: &nbsp;</td>
  <td><input name="place_name" type="text" class="cms_fieldstyle1" value="<?=$place['place_name']?>" size="30" maxlength="255" /></td>
</tr>
</table>
    Товары:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_quests" >
    <tr >
        <td class="cms_cap3 normal">Удалить</td>
        <td class="cms_cap3">Квест</td>
    </tr>
    <?=$quests?>
</table>
    <a onclick="addItem_select('table_quests', 'tr_quests_', 'quest[]', quest_array, '', ''); return false;" href="#">Добавить
        квест</a><br/>
<p></p>
    <input name="submit" type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
    <input name="cancel" type="submit" onclick="document.location='quest_place_list.php'; return false;"
           class="cms_button1" value="Отмена"/>
    <p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>