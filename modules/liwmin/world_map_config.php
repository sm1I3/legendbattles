<? 
require('kernel/before.php'); 

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}
?>
<h3>Config generator</h3>
<br />
<form name="generate" action="" method="post">
<input type="submit" name="generate" value="generate" />
</form>
<? 
if (isset($_POST['generate'])) {
    
    
    $zones = array();
    $res = mysql_query('select * from world_zones');
    while($row = mysql_fetch_assoc($res))
        $zones[$row['zone_code']] = $row;
    mysql_free_result($res);
    
    $cells = array();
    $res = mysql_query('select * from world_cells');
    while($row = mysql_fetch_assoc($res))
        $cells[$row['zone_code']][$row['cell_code']] = $row;
    mysql_free_result($res);
    
    $objects = array();
    $res = mysql_query('select * from world_objects');
    while($row = mysql_fetch_assoc($res)) {
        
        $objects[$row['zone_code']][$row['object_code']] = $row;
        $object_array[$row['object_code']] = $row;
        
        if (isset($row['parent_code']))
            $object_parent[$row['parent_code']] = $row['object_code'];
    }
    mysql_free_result($res);
    
    
    $config = '# Локации игры
# -----------------------------
# Формат: m/l (основная/дополнительная):краткое имя:описание

';
    
    foreach($zones as $zone_code => $zone) 
    {
        $config .= "\n".'m:'.$zone_code.':'.$zone['zone_name']."\n";
        
        if (isset($objects[$zone_code]) && is_array($objects[$zone_code]))
        foreach($objects[$zone_code] as $object_code => $object) 
        {
            
            if (isset($object_parent[$object_code])) 
            {
                if (isset($object_array[$object_parent[$object_code]]))
                    $p = $object_array[$object_parent[$object_code]];
                else
                    $p = array(
                        'object_code' => $object_parent[$object_code],
                        'object_module' => 'map',
                        'object_type' => 0
                    );
            } else
                $p = false;
                
            if (isset($object['parent_code'])) 
            {
                if (isset($object_array[$object['parent_code']]))
                    $t = $object_array[$object['parent_code']];
                else
                    $t = array(
                        'object_code' => $object['parent_code'],
                        'object_module' => 'map',
                        'object_type' => 0
                    );
            } else
                $t = false;
                
            $config .= 'l:'.$object_code.':'.$object['object_name'].':%'.($p? $p['object_code'].'@'.$p['object_module'].'@'.$p['object_type'] :'').'%'.($t? $t['object_code'].'@'.$t['object_module'].'@'.$t['object_type'] :'').'%'.($object['object_module']!=''?$object['object_module'].'@'.$object['object_type']:'')."\n";
        }
        
        if (isset($cells[$zone_code]) && is_array($cells[$zone_code]))
        foreach($cells[$zone_code] as $cell_code => $cell)
        {
            if (isset($object_parent[$cell_code]))
                $p = $object_array[$object_parent[$cell_code]];
            else
                $p = false;
            /*
            if (isset($cell['parent_code']))
                $t = $object_array[$cell['parent_code']];
            else
                $t = false;
            */    
            $config .= 'l:'.$cell_code.':'.$cell['cell_name'].':'.$cell['cell_details'].($cell['cell_add']!=''?'|'.$cell['cell_add']:'').'%'.($p? $p['object_code'].'@'.$p['object_module'].'@'.$p['object_type'] :'').'%'.''."\n";
        }
        
    }
    
    echo '<textarea cols="100" rows="35">'.htmlspecialchars($config).'</textarea>';
    
}
?>
<? require('kernel/after.php'); ?>