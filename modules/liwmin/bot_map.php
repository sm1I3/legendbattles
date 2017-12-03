<?php
require('kernel/before.php');

if (!userHasPermission(4096)) {
    header('Location: index.php');
    die();
}

if (isset($_GET['action']) && $_GET['action']=='load') 
{
    ob_end_clean(); 
    
    $x1 = $_GET['x1'];
    $y1 = $_GET['y1'];
    $x2 = $_GET['x2'];
    $y2 = $_GET['y2'];
    
    $query = '
    select 
        zl.*,
        bz.inf_bot
    from 
        zone_list zl 
        left join bots_zones bz on (zl.zone_id = bz.zone_id)
    where
        zl.x1 >= '.intval($x1).' and zl.y1 >= '.intval($y1).' and
        zl.x2 <= '.intval($x2).' and zl.y2 <= '.intval($y2).' and
        zl.zone_type = 1 
    ';
    
    if (!$res = mysql_query($query))
        die(mysql_error());
    
    $arr = array();
    while($row = mysql_fetch_assoc($res)) 
    {
        if (!isset($arr[$row['zone_id']]))
            $arr[$row['zone_id']] = $row['zone_id'].';'.$row['x1'].';'.$row['y1'].';'.$row['x2'].';'.$row['y2'].';'.$row['time_interval'].';'.
                                    $row['possibility1'].';'.$row['possibility2'].';'.$row['possibility3'].';'.$row['possibility4'].';'.$row['possibility5'].';'.
                                    $row['possibility6'].';'.$row['possibility7'].';'.$row['possibility8'].';'.$row['possibility9'].';'.$row['possibility10'];
            
        if (isset($row['inf_bot']) && $row['inf_bot'] != '')
            $arr[$row['zone_id']] .= ';'.$row['inf_bot'];
    }
    
    echo implode('|', $arr);
    
    die();
}

if (isset($_POST['action']) && $_POST['action']=='save') 
{
    ob_end_clean();
    
    $loaded_zones = array();
    $arr = explode('|', urldecode($_POST['loaded_zones']));
    
    foreach($arr as $zone_id) 
    {
        $loaded_zones[$zone_id] = true;
        /*
        $query = '
        delete from 
            zone_list 
        where 
            zone_id = '.$zone_id;
        mysql_query($query);
        */
        $query = '
        delete from 
            bots_zones
        where 
            zone_id = '.intval($zone_id);
        mysql_query($query);
    }
    
    $arr = explode('|', urldecode($_POST['zones']));
    $bots = explode('|', urldecode($_POST['bots']));
    $posibilieies = explode('|', urldecode($_POST['zones_pos']));
    $time_intervals = explode('|', urldecode($_POST['zones_intervals']));
    
    $is_broken = false;
    
    foreach($arr as $id => $zone) 
    if ($zone != '' && strpos($zone, '@') !== false) 
    {
        list($zone_id, $zone) = explode('@', $zone);
        unset($loaded_zones[$zone_id]);
        $t = explode(';', $zone);
        $t1 = explode(',', $t[0]);
        $t2 = explode(',', $t[1]);
        
        $x1 = $t1[0];
        $y1 = $t1[1];
        $x2 = $t2[0];
        $y2 = $t2[1];
        
        $posarr = explode(';', $posibilieies[$id]);
        
        if ($zone_id < 0)
        {
            $query = '
                insert into zone_list 
                    (x1, y1, x2, y2, zone_type, time_interval';
                    
            for($j=1; $j<=10; $j++)
                $query .= ',possibility'.$j.' ';
            $query .= ') 
                values
                    ('.intval($x1).', '.intval($y1).', '.intval($x2).', '.intval($y2).', 1, '.intval($time_intervals[$id]);
            for($j=1; $j<=10; $j++)
                $query .= ','.floatval($posarr[$j]).' ';
            $query .= ')';
            
            mysql_query($query);
            $zone_id = mysql_insert_id();
        }
        else
        {
            $query = '
                UPDATE zone_list
                SET
                    x1 = '.intval($x1).', 
                    y1 = '.intval($y1).', 
                    x2 = '.intval($x2).', 
                    y2 = '.intval($y2).',
                    time_interval = '.intval($time_intervals[$id]);
            
            for($j=1; $j<=10; $j++)
                $query .= ',possibility'.$j.' = '.floatval($posarr[$j]);
            $query .= '
            WHERE zone_id = '.intval($zone_id).'';
            mysql_query($query);
        }
        
        $bots_array = explode(';', $bots[$id]);
        
        
        if (is_array($bots_array) && sizeof($bots_array)>0) 
        foreach($bots_array as $bot) 
        {
            $ar = explode(':', $bot);
            $query = '
            insert into bots_zones 
                (zone_id, inf_bot) 
            values
                ('.intval($zone_id).', '.intval($ar[0]).')';
            
            mysql_query($query);
        }
        
    }
    else
    {
        if ($zone != '' && strpos($zone, '@') === false)
            $is_broken = true;
    }
    
    if (sizeof($loaded_zones) > 0 && !$is_broken)
    {
        $query = '
        delete from 
            zone_list 
        where 
            zone_id IN ('.implode(',', array_keys($loaded_zones)).')';
        mysql_query($query);
        
        $query = '
        delete from 
            bots_zones
        where 
            zone_id IN ('.implode(',', array_keys($loaded_zones)).')';
        mysql_query($query);
    }
    
    echo 'success';
    
    die();
}

$bot_templates = array();
$res = mysql_query('select * from bots_classes ');
while($row = mysql_fetch_assoc($res))
    $bot_templates[$row['bot_class_id']] = $row['nickname'];
mysql_free_result($res);

$bots = array();
$res = mysql_query('select * from bots_templates ');
while($row = mysql_fetch_assoc($res))
    $bots[$row['bot_class_id']][$row['inf_bot']] = $bot_templates[$row['bot_class_id']].' ['.$row['level'].']'.(isset($row['comment']) && $row['comment']!=''?' ('.$row['comment'].')':'');
mysql_free_result($res);

$zones = '';
?>
<script src="jscript/ajax.js" language="javascript"></script>
<script src="jscript/world_map.js" language="javascript"></script>
<script src="jscript/world_map_zones.js" language="javascript"></script>
<script src="jscript/bot_map.js" language="javascript"></script>
<script language="javascript">
<?=createJsArray('bots_templates_array', $bot_templates)?>
<?=createJsHArray('bots_array', $bots)?>
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
        <div id="bots_div" style="padding: 4px; border: 1px solid black; background: #EEEEEE; display: none; position: absolute; z-index: 1000;">
            <table border="0">
                <tr>
                    <? for($i=1; $i<=10; $i++) { echo '<td>'.$i.'</td>'; } ?>
                </tr>
                <tr>
                    <? for($i=1; $i<=10; $i++) { echo '<td><input size="2" type="text" name="poss'.$i.'" id="poss'.$i.'" value="" /></td>'; } ?>
                </tr>
            </table>
            Интервал: <input type="text" name="time_interval" id="time_interval" value="" size="6">
            <br />
            Боты:
            <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="bots_table" >
                <tr>
                    <td class="cms_cap3 normal">Удалить</td>
                    <td class="cms_cap3">Бот</td>
                </tr>
                
            </table>
            <a href="#" onclick="paramAddBot('', 1, 10); return false">Add</a><br />
            <br />
            <input type="button" name="save" value="Apply" onclick="saveBotsParams();" />
            <input type="button" name="cancel" value="Cancel" onclick="cancelZoneParams();" />
        </div>
    </td>
</table>
<br />
<script language="javascript">
showMap(1000, 1000);
</script>
<? require('kernel/after.php'); ?>