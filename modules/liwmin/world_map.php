<?php
require('kernel/before.php');

if (!userHasPermission(2048)) {
    header('Location: index.php');
    die();
}
/*
if (isset($_GET['action']) && $_GET['action'] == 'update_old_params')
{
    $res = mysql_query('SELECT * FROM world_cells');
    while($row = mysql_fetch_assoc($res))
    {
        $ar = explode('|', $row['cell_params']);
        $bin = 0;
        if (isset($ar[1]) && $ar[1] > 0) $bin += 1;
        if (isset($ar[2]) && $ar[2] > 0) $bin += 2;
        if (isset($ar[3]) && $ar[3] > 0) $bin += 4;
        if (isset($ar[4]) && $ar[4] > 0) $bin += 8;
        
        $details = $ar[0].'|'.$bin;
        mysql_query('UPDATE world_cells SET cell_details = \''.$details.'\' WHERE cell_code = \''.$row['cell_code'].'\'');
    }
}
*/
$zones = array();
$res = mysql_query('select * from world_zones');
while($row = mysql_fetch_assoc($res))
    $zones[$row['zone_code']] = $row['zone_name'];
mysql_free_result($res);

if (isset($_POST['action']) && $_POST['action']=='save') 
{
    ob_end_clean(); 
    header('Content-type: text/html; charset=windows-1251');
    
    $cell_code = $_POST['cell_code'];
    
    if (isset($_POST['cell_name']) && $_POST['cell_name']!='')
        $cell_name = iconv('UTF-8', 'windows-1251', rawurldecode($_POST['cell_name']));
    else
        $cell_name = '';
    
    //$cell_name = urldecode($_POST['cell_name']);
    
    $t = explode('_', $cell_code);
    $x = (int)$t[1];
    $y = (int)$t[2];
    
    if (trim($_POST['cell_name'] == '') && trim($_POST['cell_details'] == '|0')) {
        $query = '
        delete from 
            world_cells
        where
            cell_code = \''.mysql_escape_string($cell_code).'\'
        ';
    } else {
        $query = '
        insert into world_cells (cell_code, zone_code, x, y, cell_name, cell_params, cell_details, cell_add) 
        values (\''.mysql_escape_string($cell_code).'\', \''.mysql_escape_string($_POST['zone_code']).'\', '.intval($x).', '.intval($y).', \''.mysql_escape_string($cell_name).'\', \'\', \''.mysql_escape_string($_POST['cell_details']).'\', \''.mysql_escape_string($_POST['cell_add']).'\') 
        on duplicate key update 
            zone_code = \''.mysql_escape_string($_POST['zone_code']).'\',
            cell_name = \''.mysql_escape_string($cell_name).'\',
            cell_add = \''.mysql_escape_string($_POST['cell_add']).'\',
            cell_details = \''.mysql_escape_string($_POST['cell_details']).'\';
        ';
    }
    
    if (!$res = mysql_query($query))
        die(mysql_error());
    elseif (trim($_POST['cell_name'] == '') && trim($_POST['cell_details'] == '|0'))
        echo 'deleted@'.$x.'_'.$y;
    else
        echo 'updated@'.$x.'_'.$y.'@'.$_POST['zone_code'].'@'.rawurlencode($cell_name).'@'.$_POST['cell_details'].'@'.$_POST['cell_add'];
    
    
    die();
}

if (isset($_POST['action']) && $_POST['action']=='saveall') 
{
    ob_end_clean(); 
    header('Content-type: text/html; charset=windows-1251');
    
    
    foreach($_POST as $code => $row)
    if (substr($code, 0, 2) == 'm_')
    {
        $cell_code = $code;
        
        if (isset($row['cell_name']) && $row['cell_name']!='')
            $cell_name = iconv('UTF-8', 'windows-1251', rawurldecode($row['cell_name']));
        else
            $cell_name = '';
        
        //$cell_name = urldecode($_POST['cell_name']);
        
        $t = explode('_', $cell_code);
        $x = (int)$t[1];
        $y = (int)$t[2];
        
        if (trim($row['cell_name'] == '') && trim($row['cell_details'] == '')) {
            $query = '
            delete from 
                world_cells
            where
                cell_code = \''.mysql_escape_string($cell_code).'\'
            ';
        } else {
            $query = '
            insert into world_cells (cell_code, zone_code, x, y, cell_name, cell_params, cell_details, cell_add) 
            values (\''.mysql_escape_string($cell_code).'\', \''.mysql_escape_string($row['zone_code']).'\', '.$x.', '.$y.', \''.mysql_escape_string($cell_name).'\', \'\', \''.mysql_escape_string($row['cell_details']).'\', \''.mysql_escape_string($row['cell_add']).'\') 
            on duplicate key update 
                zone_code = \''.mysql_escape_string($row['zone_code']).'\',
                cell_name = \''.mysql_escape_string($cell_name).'\',
                cell_add = \''.mysql_escape_string($row['cell_add']).'\',
                cell_details = \''.mysql_escape_string($row['cell_details']).'\';
            ';
        }
        
        if (!$res = mysql_query($query))
            die(mysql_error());
    }
    
    die('success');
}

if (isset($_GET['action']) && $_GET['action']=='load') 
{
    ob_end_clean(); 
    header('Content-type: text/html; charset=windows-1251');
    
    $x1 = $_GET['x1'];
    $y1 = $_GET['y1'];
    $x2 = $_GET['x2'];
    $y2 = $_GET['y2'];
    
    $object_array = array();
    $res = mysql_query('SELECT * FROM world_objects WHERE parent_code IS NOT NULL');
    while($row = mysql_fetch_assoc($res))
        if (substr($row['parent_code'], 0, 2) == 'm_')
            $object_array[$row['parent_code']] = $row['object_name'].' ('.$row['object_code'].')';
    mysql_free_result($res);
    
    $query = '
    select 
        * 
    from 
        world_cells
    where
        x >= '.$x1.' and y >= '.$y1.' and
        x <= '.$x2.' and y <= '.$y2.'
    ';
    
    
    if (!$res = mysql_query($query))
        die(mysql_error());
    
    $arr = array();
    while($row = mysql_fetch_assoc($res)) {
        $arr[] = $row['x'].';'.$row['y'].';'.$row['zone_code'].';'.rawurlencode($row['cell_name']).';'.$row['cell_details'].';'.rawurlencode((isset($object_array[$row['cell_code']])?$object_array[$row['cell_code']]:'')).';'.$row['cell_add'];
    }
    
    echo implode('#', $arr);
    
    die();
}
/*
if (isset($_POST['action']) && $_POST['action']=='save') { 
    ob_end_clean();
    
    $arr = explode('|', urldecode($_POST['loaded_zones']));
    foreach($arr as $zone_id) {
        $query = '
        delete from 
            zone_list 
        where 
            zone_id = '.$zone_id;
        mysql_query($query);
        
        $query = '
        delete from 
            e_players_bots_zones 
        where 
            zone_id = '.$zone_id;
        mysql_query($query);
    }
    
    $arr = explode('|', urldecode($_POST['zones']));
    $bots = explode('|', urldecode($_POST['bots']));
    
    foreach($arr as $id => $zone) 
    if ($zone != '') {
        $t = explode(';', $zone);
        $t1 = explode(',', $t[0]);
        $t2 = explode(',', $t[1]);
        
        $x1 = $t1[0];
        $y1 = $t1[1];
        $x2 = $t2[0];
        $y2 = $t2[1];
        
        $query = '
            insert into zone_list 
                (x1, y1, x2, y2, zone_type) 
            values
            ('.$x1.', '.$y1.', '.$x2.', '.$y2.', 1)';
        mysql_query($query);
        $zone_id = mysql_insert_id();
        
        $bots_array = explode(';', $bots[$id]);
        if (is_array($bots_array) && sizeof($bots_array)>0) 
        foreach($bots_array as $bot) {
            $query = '
            insert into e_players_bots_zones 
                (zone_id, bot_uid) 
            values
            ('.$zone_id.', '.$bot.')';
            mysql_query($query);
        }
        
    }
    echo 'success';
    
    die(); }
*/

?>
<script src="jscript/ajax.js" language="javascript"></script>
<script src="jscript/world_map.js" language="javascript"></script>
<script src="jscript/world_map_details.js" language="javascript"></script>
<script language="javascript">
var last_id = 0;
</script>
<table>
<tr>
    <td  valign="top">
        <div id="world_map"></div>
    </td>
    <td valign="top">
        <div align="center">
            <input type="button" onclick="moveMap('up');" name="move_up" value="^" /><br />
            <input type="button" onclick="moveMap('left');" name="move_left" value="&lt;" />
            <input type="button" onclick="moveMap('down');" name="move_down" value="v" />
            <input type="button" onclick="moveMap('right');" name="move_right" value="&gt;" />
        </div>
        <br /><br />
        <input type="button" name="save" value="Загрузить" onclick="loadCells();" />
        <br /><br />
        
        <div id="save_all_status" class="status_ok">Все изменения сохранены.</div>
        <input id="save_all_button" type="button" name="save" value="Сохранить изменения" onclick="saveChanged();"  disabled="disabled" />
        <br />
        <br />
        <div id="clipboard_status" class="status_none">Буфер обмена пуст.</div>
        <br />
        <br />
        
        <div id="details_div" style="display: none;">
            Детали (<b><span id="current_coord"></span></b>):
            
            <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="bots_table" >
                <tr>
                    <td>Зона</td>
                    <td><?=createSelectFromArray('zone', $zones, '', 'id="zone_code" onchange="applyDetails();"')?></td>
                </tr>
                <tr>
                    <td>Название</td>
                    <td><input type="text" name="name" id="cell_name" onkeypress="applyDetails();" /></td>
                </tr>
                <!--<tr>
                    <td>Параметры (старые)</td>
                    <td><input type="text" name="params" id="cell_params" /></td>
                </tr>-->
                <tr>
                    <td>Переход</td>
                    <td><input type="text" name="time" id="cell_time" onkeypress="applyDetails();" /></td>
                </tr>
                <tr>
                    <td>Оглядется</td>
                    <td><input type="checkbox" name="det0" id="cell_det_0" value="Y" onclick="applyDetails();" /></td>
                </tr>
                <tr>
                    <td>Нападать</td>
                    <td><input type="checkbox" name="det1" id="cell_det_1" value="Y" onclick="applyDetails();" /></td>
                </tr>
                <tr>
                    <td>Пить</td>
                    <td><input type="checkbox" name="det2" id="cell_det_2" value="Y" onclick="applyDetails();" /></td>
                </tr>
                <tr>
                    <td>Рыбалка</td>
                    <td><input type="checkbox" name="det3" id="cell_det_3" value="Y" onclick="applyDetails();" /></td>
                </tr>
                <tr>
                    <td>Квесты</td>
                    <td><input type="checkbox" name="det4" id="cell_det_4" value="Y" onclick="applyDetails();" /></td>
                </tr>
                <tr>
                    <td>Замок</td>
                    <td><input type="checkbox" name="det5" id="cell_det_5" value="Y" onclick="applyDetails();" /></td>
                </tr>
                <tr>
                    <td>Доп.</td>
                    <td><input type="text" name="cell_add" id="cell_add" value="" onkeyup="applyDetails();" /></td>
                </tr>
            </table>
            <div id="map_links"></div>
            <b>Здесь находится:</b><br />
            <span id="cell_enter">Пусто</span>
            <br />
            <br />
            <input id="save_button" type="button" name="save" value="Сохранить" onclick="saveDetails();" />
            <input id="copy_button" type="button" name="save" value="Запомнить" onclick="copyDetails();" />
            <input id="cancel_button" type="button" name="cancel" value="Закрыть" onclick="cancelDetails();" /><br />
        </div>
    </td>
</table>
<br />
<script language="javascript">
showMap(1000, 1000);
</script>
<? require('kernel/after.php'); ?>