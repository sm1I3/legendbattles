<?php
require('kernel/before.php');

if (!userHasPermission(128)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['rec_id']) || !is_numeric($_GET['rec_id']))
    $rec_id = '';
else
    $rec_id = (int)$_GET['rec_id'];

$row_id = 0;

// list of all resources
$resource_array = array();
$res = mysql_query('select * from restore_resources');
while($row = mysql_fetch_assoc($res))
    $resource_array[$row['resource_id']] = $row['resource_name'];
mysql_free_result($res);

// list of all abilities
$ability_array = array();
$res = mysql_query('select * from ability_list');
while($row = mysql_fetch_assoc($res)) {
    $ability_array[$row['ability_id']] = $row['ability_name'];
}
mysql_free_result($res);

// list of all items
$item_array = array();
$res = mysql_query('select * from restore_items');
while($row = mysql_fetch_assoc($res))
    $item_array[$row['item_id']] = $row['item_name'].' ('.$row['item_cost'].')';
mysql_free_result($res);

// list of all quests
$quest_array = array();
$res = mysql_query('select * from quest_list');
while($row = mysql_fetch_assoc($res)) {
    $tmp_arr = unserialize($row['quest_serilize']);
    $quest_array[$row['quest_id']] = $tmp_arr[0][0];
}
mysql_free_result($res);

if (isset($_POST['rec_name'])) {
    
    // updating serialized data
    $tmp_arr = array();
    if (isset($_POST['add']['UU']) && $_POST['add']['UU']!='' && is_numeric($_POST['add']['UU']))
        $tmp_arr['UU'] = $_POST['add']['UU'];
    if (isset($_POST['add']['WE']) && $_POST['add']['WE']!='' && is_numeric($_POST['add']['WE']))
        $tmp_arr['WE'] = $_POST['add']['WE'];
    if (isset($_POST['add']['ID']) && $_POST['add']['ID']!='' && is_numeric($_POST['add']['ID']))
        $tmp_arr['ID'] = $_POST['add']['ID'];
    if (isset($_POST['add']['CL']) && $_POST['add']['CL']!='' && is_numeric($_POST['add']['CL']))
        $tmp_arr['CL'] = $_POST['add']['CL'];
    if (isset($_POST['add']['TM']) && $_POST['add']['TM']!='' && is_numeric($_POST['add']['TM']))
        $tmp_arr['TM'] = $_POST['add']['TM'];
    
    if (isset($_POST['add']['UM']) && $_POST['add']['UM']!='' && is_numeric($_POST['add']['UM']))
        $tmp_arr['UM'] = array($_POST['add']['UM'], $_POST['add']['UM_count']);
        
    /*    
    if (isset($_POST['um']) && is_array($_POST['um']))
        foreach($_POST['um'] as $k=>$v)
            $tmp_arr['UM'][$v] = (int)$_POST['um_amount'][$k];
    */        
    if (isset($_POST['qe']) && is_array($_POST['qe']))
        foreach($_POST['qe'] as $k)
            $tmp_arr['QE'][] = (int)$k;
            
    $serialize = serialize($tmp_arr);
    
    
    // updating recipe values
    if ($rec_id == '') {
        $query = '
        insert into recipe_list
        (
            rec_name,
            rec_size,
            rec_serialize,
            rec_final
        ) values (
        \''.mysql_escape_string($_POST['rec_name']).'\',
        '.(isset($_POST['initial_resources'])?(int)sizeof($_POST['initial_resources']):0).',
        \''.mysql_escape_string($serialize).'\',
        '.(int)$_POST['rec_final'].'
        )'  ;
        
        mysql_query($query);
        $rec_id = mysql_insert_id($db);
    } else {
        $query = '
        update recipe_list set
            rec_name = \''.mysql_escape_string($_POST['rec_name']).'\',
            rec_size = '.(isset($_POST['initial_resources'])?(int)sizeof($_POST['initial_resources']):0).',
            rec_serialize = \''.mysql_escape_string($serialize).'\',
            rec_final = '.(int)$_POST['rec_final'].'
        where
            rec_id = '.intval($rec_id).'
        '  ;
        mysql_query($query); 
    }
    
    //updating initial resources
    mysql_query('delete from recipe_initial_resources where rec_id = '.intval($rec_id));
    if (isset($_POST['initial_resources']) && is_array($_POST['initial_resources']))
    foreach($_POST['initial_resources'] as $k=>$resource_id)
        if ($resource_id != '')
            mysql_query('insert into recipe_initial_resources (rec_id, resource_id, resource_share) values ('.intval($rec_id).', '.intval($resource_id).', '.(float)$_POST['initial_resources_share'][$k].')');
            
    //updating initial resources
    mysql_query('delete from recipe_receive_resources where rec_id = '.intval($rec_id));
    if (isset($_POST['receive_resources']) && is_array($_POST['receive_resources']))
    foreach($_POST['receive_resources'] as $k=>$resource_id)
        if ($resource_id != '')
            mysql_query('insert into recipe_receive_resources (rec_id, resource_id, resource_share) values ('.intval($rec_id).', '.intval($resource_id).', '.(float)$_POST['receive_resources_share'][$k].')');
   
    //updating recipe toolkit 
    mysql_query('delete from recipe_toolkit where rec_id = '.intval($rec_id));
    if (isset($_POST['recipe_toolkit']) && is_array($_POST['recipe_toolkit']))
    foreach($_POST['recipe_toolkit'] as $k=>$item_id)
        if ($resource_id != '')
            mysql_query('insert into recipe_toolkit (rec_id, item_id) values ('.intval($rec_id).', '.intval($item_id).')');
            
    header('Location: '.$_SESSION['pages']['recipe_list']);
}

$recipe_um = '';
$recipe_qe = '';
$resouce_initial = '';
$resouce_receive = '';
$recipe_toolkit = ''; 

if ($rec_id == '' && !isset($_GET['clone_rec_id'])) {
    $recipe = array(
        'rec_name' => '',
        'rec_final' => '0',
    );
} else {    
    // loading recipe
    if (isset($_GET['clone_rec_id']))
        $rec_id = $_GET['clone_rec_id'];
    
    $recipe = array();
    $res = mysql_query('select * from recipe_list where rec_id = '.intval($rec_id));
    if($row = mysql_fetch_assoc($res))
        $recipe = $row;
    mysql_free_result($res);

    
    // list of initial resources
    $res = mysql_query('select * from recipe_initial_resources where rec_id = '.intval($rec_id));
    while($row = mysql_fetch_assoc($res))
        $resouce_initial .= '
        <tr id="tr_initialres_'.(++$row_id).'">
          <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_initialres_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>  
          <td align="left" class="cms_middle">'.createSelectFromArray('initial_resources[]', $resource_array, $row['resource_id']).'</td>
          <td align="left" class="cms_middle"><input type="text" name="initial_resources_share[]" value="'.$row['resource_share'].'" /></td>
        </tr>
        ';
    mysql_free_result($res);

    // list of recieve resources    
    $res = mysql_query('select * from recipe_receive_resources where rec_id = '.intval($rec_id));
    while($row = mysql_fetch_assoc($res))
        $resouce_receive .= '
        <tr id="tr_receiveres_'.(++$row_id).'">
          <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_receiveres_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
          <td align="left" class="cms_middle">'.createSelectFromArray('receive_resources[]', $resource_array, $row['resource_id']).'</td>
          <td align="left" class="cms_middle"><input type="text" name="receive_resources_share[]" value="'.$row['resource_share'].'" /></td>
        </tr>
        ';
    mysql_free_result($res);

    // list of recipe toolkit
    $res = mysql_query('select * from recipe_toolkit where rec_id = '.intval($rec_id));
    while($row = mysql_fetch_assoc($res))
        $recipe_toolkit .= '
        <tr id="tr_toolkitres_'.(++$row_id).'">
          <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_toolkitres_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
          <td align="left" class="cms_middle">'.createSelectFromArray('recipe_toolkit[]', $item_array, $row['item_id']).'</td>
        </tr>
        ';
    mysql_free_result($res);

    $rcp_add = unserialize($recipe['rec_serialize']);
    /*
    if (isset($rcp_add['UM']) && is_array($rcp_add['UM']))
    foreach($rcp_add['UM'] as $k=>$v) {
        $recipe_um .= '
        <tr id="tr_um_'.(++$row_id).'">
          <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_um_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
          <td align="left" class="cms_middle"><input type="text" name="um[]" value="'.$k.'" /></td>
          <td align="left" class="cms_middle"><input type="text" name="um_amount[]" value="'.$v.'" /></td>
        </tr>';
    }
    */
    if (isset($rcp_add['QE']) && is_array($rcp_add['QE']))
    foreach($rcp_add['QE'] as $k=>$v) {
        $recipe_qe .= '
        <tr id="tr_qe_'.(++$row_id).'">
          <td class="cms_middle" align="center"><a href="#" onclick="removeItem(\'tr_qe_'.$row_id.'\'); return false;" title="Remove"><img src="images/cms_icons/cms_delete.gif" width="16" height="16" /></a></td>
          <td align="left" class="cms_middle">'.createSelectFromArray('qe[]', $quest_array, $v).'</td>
        </tr>';
    }
}

?>
<h3><?=($rec_id==''?'Добавить рецепт':'Изменить рецепт')?></h3>
<script language="javascript">
var last_id = <?=(int)$row_id?>;
<?=createJsArray('res_array', $resource_array)?>
<?=createJsArray('item_array', $item_array)?>
<?=createJsArray('quest_array', $quest_array)?>
</script>
<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
    <tr>
        <td><span class="cms_star">*</span>Название рецепта: &nbsp;  </td>
        <td><input name="rec_name" type="text" class="cms_fieldstyle1" value="<?=$recipe['rec_name']?>" size="30" maxlength="255" /></td>
    </tr>
    <? //TODO: Translate rec_final ?>
    <tr>
        <td><span class="cms_star">*</span>Recipe Final: &nbsp;  </td>
        <td><input name="rec_final" type="text" class="cms_fieldstyle1" value="<?=$recipe['rec_final']?>" size="10" maxlength="255" /></td>
    </tr>
</table><br />


Дополнительные параметры:
<table border="0" cellpadding="0" cellspacing="1">
    <tr>
        <td>Умение, которое прокачивается при использовании: &nbsp;</td>
        <td><?=createSelectFromArray('add[UU]', $ability_array, (isset($rcp_add['UU'])?$rcp_add['UU']:''))?></td>
    </tr>
    <tr>
        <td>Получаемая из рецепта вещь: &nbsp;</td>
        <td><input name="add[WE]" type="text" class="cms_fieldstyle1" value="<?=(isset($rcp_add['WE'])?$rcp_add['WE']:'')?>" size="8" maxlength="255" /></td>
    </tr>
    <tr>
        <td>ID Игрока (если персональный рецепт): &nbsp;</td>
        <td><input name="add[ID]" type="text" class="cms_fieldstyle1" value="<?=(isset($rcp_add['ID'])?$rcp_add['ID']:'')?>" size="8" maxlength="255" /></td>
    </tr>
    <tr>
        <td>ID Клана (если клановый рецепт): &nbsp;</td>
        <td><input name="add[CL]" type="text" class="cms_fieldstyle1" value="<?=(isset($rcp_add['CL'])?$rcp_add['CL']:'')?>" size="8" maxlength="255" /></td>
    </tr>
    <tr>
        <td>Время на 1 единицу (мин): &nbsp;</td>
        <td><input name="add[TM]" type="text" class="cms_fieldstyle1" value="<?=(isset($rcp_add['TM'])?$rcp_add['TM']:'')?>" size="8" maxlength="255" /></td>
    </tr>
    <tr>
        <td colspan="2">
            Необходимое умение: &nbsp;
            <?=createSelectFromArray('add[UM]', $ability_array, (isset($rcp_add['UM'][0])?$rcp_add['UM'][0]:''))?>
            Количество: &nbsp;
            <input name="add[UM_count]" type="text" class="cms_fieldstyle1" value="<?=(isset($rcp_add['UM'][1])?$rcp_add['UM'][1]:'')?>" size="8" maxlength="255" />
        </td>
    </tr>
</table>

<!--
UM:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_recipe_um" >
    <tr >
        <td class="cms_cap3 normal">del</td>
        <td class="cms_cap3">UM</td>
        <td class="cms_cap3">UM count</td>
    </tr>
    <? //$recipe_um ?>
</table>
<a onclick="addItem_edit('table_recipe_um', 'tr_um', 'um[]', '', 'um_amount[]', '1'); return false;" href="#">Add um</a><br />
<br />
 -->
Необходимые квесты:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_recipe_qe" >
    <tr >
        <td class="cms_cap3 normal">Удалить</td>
        <td class="cms_cap3">Название квеста</td>
    </tr>
    <?=$recipe_qe?>
</table>
<a onclick="addItem_select('table_recipe_qe', 'tr_qe', 'qe[]', quest_array, '', ''); return false;" href="#">Добавить квест</a><br />
<br />

Требуемые ингредиенты:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_initialres" >
    <tr >
        <td class="cms_cap3 normal">Удалить</td>
        <td class="cms_cap3">Название ресурса</td>
        <td class="cms_cap3">Доля ресурса</td>
    </tr>
    <?=$resouce_initial?>
</table>
<a onclick="addItem_select('table_initialres', 'tr_initialres', 'initial_resources[]', res_array, 'initial_resources_share[]', '1'); return false;" href="#">Добавить ресурс</a><br />
<br />

Получаемые ресурсы:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_receiveres" >
    <tr >
        <td class="cms_cap3 normal">Удалить</td>
        <td class="cms_cap3">Название ресурса</td>
        <td class="cms_cap3">Доля ресурса</td>
    </tr>
    <?=$resouce_receive?>
</table>
<a onclick="addItem_select('table_receiveres', 'tr_receiveres', 'receive_resources[]', res_array, 'receive_resources_share[]', '1'); return false;" href="#">Добавить ресурс</a><br />
<br />

Необходимые инструменты:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_toolkit" >
    <tr >
        <td class="cms_cap3 normal">Удалить</td>
        <td class="cms_cap3">Название инструмента</td>
    </tr>
    <?=$recipe_toolkit?>
</table>
<a onclick="addItem_select('table_toolkit', 'tr_toolkitres', 'recipe_toolkit[]', item_array, '', ''); return false;" href="#">Добавить инструмент</a><br />  

<p></p>
<input name="submit"  type="submit" class="cms_button1" value="Сохранить" style="width: 150px"/>
<input name="cancel" type="submit" onclick="document.location='<?=$_SESSION['pages']['recipe_list']?>'; return false;" class="cms_button1" value="Отмена" />
<p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>
