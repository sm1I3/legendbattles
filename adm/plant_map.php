<?php
require('kernel/before.php');

if (!userHasPermission(8192)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['action']) && $_GET['action']=='load') {
    ob_end_clean(); 
    
    $x1 = $_GET['x1'];
    $y1 = $_GET['y1'];
    $x2 = $_GET['x2'];
    $y2 = $_GET['y2'];
    
    $query = '
    select 
        * 
    from 
        zone_list zl 
        left join resource_group_zones rz on (zl.zone_id = rz.zone_id)
    where
        zl.x1 >= '.intval($x1).' and zl.y1 >= '.intval($y1).' and
        zl.x2 <= '.intval($x2).' and zl.y2 <= '.intval($y2).' and
        zl.zone_type = 0
    ';
    
    if (!$res = mysql_query($query))
        die(mysql_error());
    
    $arr = array();
    while($row = mysql_fetch_assoc($res)) {
        if (!isset($arr[$row['zone_id']]))
            $arr[$row['zone_id']] = $row['zone_id'].';'.$row['x1'].';'.$row['y1'].';'.$row['x2'].';'.$row['y2'];
            
        if (isset($row['resource_group_id']) && $row['resource_group_id'] != '')
            $arr[$row['zone_id']] .= ';'.$row['resource_group_id'];
    }
    
    echo implode('|', $arr);
    
    die();
}

if (isset($_POST['action']) && $_POST['action']=='save') {
    ob_end_clean();
    
    $arr = explode('|', urldecode($_POST['loaded_zones']));
    foreach($arr as $zone_id) {
        $query = 'delete from zone_list where zone_id = '.intval($zone_id);
        mysql_query($query);
        
        $query = 'delete from resource_group_zones where zone_id = '.intval($zone_id);
        mysql_query($query);
    }
    
    $arr = explode('|', urldecode($_POST['zones']));
    $plants = explode('|', urldecode($_POST['plants']));
    
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
            ('.intval($x1).', '.intval($y1).', '.intval($x2).', '.intval($y2).', 0)';
        mysql_query($query);
        $zone_id = mysql_insert_id();
        
        $plants_array = explode(';', $plants[$id]);
        if (is_array($plants_array) && sizeof($plants_array)>0) 
        foreach($plants_array as $plant) {
            $query = '
            insert into resource_group_zones 
                (zone_id, resource_group_id) 
            values
                ('.intval($zone_id).', '.intval($plant).')';
            mysql_query($query);
        }
        
    }
    echo 'success';
    
    die();
}

$resource_groups = array();
$res = mysql_query('select * from resource_group');
while($row = mysql_fetch_assoc($res))
    $resource_groups[$row['resource_group_id']] = $row['resource_group_name'];
mysql_free_result($res);


$zones = '';
?>
<script src="jscript/ajax.js" language="javascript"></script>
<script src="jscript/world_map.js" language="javascript"></script>
<script src="jscript/world_map_zones.js" language="javascript"></script>
<script src="jscript/plant_map.js" language="javascript"></script>
<script language="javascript">
var last_id = 0;
<?=createJsArray('res_array', $resource_groups)?>
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
        <input type="button" name="save" value="Редактировать" onclick="loadZones();" />
        <br /><br />
        Зоны:
        <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_zones" >
            <tr >
                <td class="cms_cap3 normal">Удалить</td>
                <td class="cms_cap3">Зона</td>
            </tr>
            <?=$zones?>
        </table>
        <br />
        <input type="button" name="create" value="Create" onclick="if (edit_mode == 0) { alert('Войдите в режим редактирования.'); } else { mode = 0; el('world_map').style.cursor = 'crosshair'; }" />
        <input type="button" name="save" value="Save" onclick="saveZones();" />
        <br /><br />
        <div id="plants_div" style="padding: 4px; border: 1px solid black; background: #EEEEEE; display: none; position: absolute; z-index: 1000;">
            Растения:
            <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="plants_table" >
                <tr>
                    <td class="cms_cap3 normal">Удалить</td>
                    <td class="cms_cap3">Растение</td>
                </tr>
                
            </table>
            <a href="#" onclick="paramAddPlant(''); return false">Add</a><br />
            <br />
            <input type="button" name="save" value="Apply" onclick="savePlantsParams();" />
            <input type="button" name="cancel" value="Cancel" onclick="cancelZoneParams();" />
        </div>
    </td>
</table>
<br />
<script language="javascript">
showMap(1000, 1000);
</script>
<? require('kernel/after.php'); ?>