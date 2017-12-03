<?php
require('kernel/before.php');

if (!userHasPermission(32768)) {
    header('Location: index.php');
    die();
}

$mine_code = $_GET['mine_code']; 

$query = 'SELECT * FROM mine_list WHERE mine_code = \''.mysql_real_escape_string($mine_code).'\'';
$res = mysql_query($query);
$mine = mysql_fetch_assoc($res);

$mine_array = unserialize($mine['mine_levels']);
$height = sizeof($mine_array['m'][1]);
$width = sizeof($mine_array['m'][1][0]);

if (isset($_POST['remove']))
{
    $level = (int)$_POST['level'];
    if ($level > 0)
    {
        $resource = (isset($_POST['resource']) ? $_POST['resource'] : '');
        $query = 'DELETE FROM mine_res WHERE mine_code = \''.mysql_real_escape_string($mine_code).'\' AND cell_pos LIKE \''.$level.'_%\''.($resource != '' ? ' AND resource_id = '.intval($resource) : '');
        if (!mysql_query($query))
            die(mysql_error());
    }
}

if (isset($_POST['restore']))
{
    $level = (int)$_POST['level'];
    if ($level > 0)
    {
        $resource = (isset($_POST['resource']) ? $_POST['resource'] : '');
        $query = 'UPDATE mine_res SET count_left = count_total WHERE mine_code = \''.mysql_escape_string($mine_code).'\' AND cell_pos LIKE \''.$level.'_%\''.($resource != '' ? ' AND resource_id = '.intval($resource) : '');
        if (!mysql_query($query))
            die(mysql_error());
    }
}

if (isset($_POST['add']))
{
    $level = (int)$_POST['level'];
    if ($level > 0)
    {
        $res_id = (isset($_POST['resource']) ? $_POST['resource'] : '');
        
        $mine_resources = array();
        $tmp_res = array();
        
        $res_count = intval(isset($_POST['count']) ? $_POST['count'] : 0);
        $rand = intval(isset($_POST['rand']) ? $_POST['rand'] : 0);
        $chance = intval(isset($_POST['chance']) ? $_POST['chance'] : 100);
        $res_lvl_count = $res_count;
        $lvl = $level;
        $depth = 1;
        
        
        $realheight = $height;//($height-1)/2;
        $realwidth = $width;//($width-1)/2;
        
        switch($rand)
        {
            case 1: $vein_count = ($realheight*$realwidth) - 2; break;
            case 2: $vein_count = rand( ceil($realheight*$realwidth/2) , $realheight*$realwidth*1.5); break;
            case 3: $vein_count = rand( ceil($realheight*$realwidth/3) , $realheight*$realwidth); break;
            case 4: $vein_count = rand( ((min($realheight, $realwidth)-2)>0?(min($realheight, $realwidth)-2):2) , $realheight*$realwidth); break;
            case 5: $vein_count = rand( ((min($realheight, $realwidth)-2)>0?(min($realheight, $realwidth)-2):2) , floor($realheight*$realwidth/2)); break;
            default: $vein_count = rand( ceil($realheight*$realwidth/2) , $realheight*$realwidth*1.5); break;
        }
        
        
        $res_lvl_left = $res_lvl_count;
        for($v=1; $v<=$vein_count; $v++)
        {
            if ($v != $vein_count)
            {
                $res_vein_count = round($res_lvl_left / ($vein_count - $v + 1)) + rand( 0-(($res_lvl_count/$vein_count)/5), (($res_lvl_count/$vein_count)/5));
                if ($res_vein_count > $res_lvl_left)
                    $res_vein_count = $res_lvl_left;
                $res_lvl_left -= $res_vein_count;
            }
            else
                $res_vein_count = $res_lvl_left;
            
            if ($res_vein_count > 0)
            {
                $b = false;
                while(!$b)
                {
                    
                    $h = rand(0, $height-1);
                    $w = rand(0, $width-1);
                    
                    if ($mine_array['m'][$lvl][$h][$w]['v'] > 0 && $mine_array['m'][$lvl][$h][$w]['v'] < 10)
                        $b = true;
                }
                if (!isset($mine_resources[$lvl.'_'.$h.'_'.$w][$res_id]))
                    $mine_resources[$lvl.'_'.$h.'_'.$w][$res_id] = $res_vein_count;
                else
                    $mine_resources[$lvl.'_'.$h.'_'.$w][$res_id] += $res_vein_count;
            }
        }
        
        foreach($mine_resources as $cell_pos => $arr)
        foreach($arr as $res_id => $res_count)
        {
            $ar =explode('_', $cell_pos);
            $query = '
                INSERT INTO mine_res (mine_code, cell_pos, resource_id, level, count_total, count_left, min_ability, chance) 
                VALUES (\''.mysql_escape_string($mine_code).'\', \''.$cell_pos.'\', '.(int)$res_id.', '.(int)$ar[0].', '.(int)$res_count.', '.(int)$res_count.', '.(int)$_POST['ability'].', '.(int)$chance.')
                ON DUPLICATE KEY UPDATE
                    count_total = count_total + '.(int)$res_count.',
                    count_left = count_left + '.(int)$res_count.'';
            if (!mysql_query($query))
                die(mysql_error());
        }
    }
}

?>
<a href="mine_list.php">Назад к списку шахт</a>
<script language="javascript">
    var selected_row = '';
    var selected_cell = '';
    function selectCell(lvl, h, w)
    {
        if (selected_row != '')
            el(selected_row).style.background = '#FFFFFF';
        if (selected_cell != '')
            el(selected_cell).style.border = '1px solid black';
            
        if (el('tr_'+lvl+'_'+h+'_'+w))
        {
            el('tr_'+lvl+'_'+h+'_'+w).style.background = '#FFFF11';
            selected_row = 'tr_'+lvl+'_'+h+'_'+w;
        }
        if (el('cell_'+lvl+'_'+h+'_'+w))
        {
            el('cell_'+lvl+'_'+h+'_'+w).style.border = '1px solid yellow';
            selected_cell = 'cell_'+lvl+'_'+h+'_'+w;
        }
        return true;
    }
</script>
<?php

// list of mineral resources
$resource_array = array();
$res = mysql_query('select * from restore_resources where resource_type = 8');
while($row = mysql_fetch_assoc($res))
    $resource_array[$row['resource_id']] = $row['resource_name'];
mysql_free_result($res);

$query = 'SELECT * FROM mine_res WHERE mine_code = \''.mysql_escape_string($mine_code).'\' order by cell_pos';
$res = mysql_query($query);
while($row = mysql_fetch_assoc($res))
{
    $ar = explode('_', $row['cell_pos']);
    $resources[$ar[0]][$ar[1].'_'.$ar[2]][] = $row;
}

//dump($row);
if ($mine)
{
    $mine_array = unserialize($mine['mine_levels']);
    
    foreach($mine_array['m'] as $lvl => $arr)
    {
        echo '<br />Уровень '.$lvl.':<br /><br />
        <table><tr><td valign="top">
        <table border="0" cellpadding="0" cellspacing="0">';
        foreach($arr as $i => $arr2)
        {
            echo '<tr>';
            foreach($arr2 as $j => $t)
            {
                echo '<td>
                <div id="cell_'.$lvl.'_'.$i.'_'.$j.'" onclick="selectCell('.$lvl.','.$i.','.$j.');" style="border: 1px solid black;">';
                if ($t['v'] == 0) echo '<img src="http://image.neverlands.ru/1x1.gif" width="130" height="130" />';
                elseif ($t['v'] > 0 && $t['v'] < 10)
                    echo '<img src="http://image.neverlands.ru/gameplay/mine_new/'.$t['p'].'_'.$t['v'].'.jpg" width="130" height="130" />';
                elseif ($t['v'] == 10 || $t['v'] == 11)
                    echo '<img src="http://image.neverlands.ru/gameplay/mine_new/'.$t['p'].'_el.jpg" width="130" height="130" />';
                echo '</div></td>';
            }
            echo '</tr>';
        }
        echo '</table></td><td valign="top">
        Добываемые ресурсы:
        <table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_res" >
            <tr >
                <td class="cms_cap3">Клетка</td>
                <td class="cms_cap3">Ресурс</td>
                <td class="cms_cap3">Умение</td>
                <td class="cms_cap3">Всего</td>
                <td class="cms_cap3">Осталось</td>
                <td class="cms_cap3">Шанс</td>
            </tr>';
        if (isset($resources[$lvl]) && is_array($resources[$lvl]))
        foreach($resources[$lvl] as $cell => $arr)
        foreach($arr as $rowr) 
        {
            $ar = explode('_', $cell);
            echo '
            <tr id="tr_'.$lvl.'_'.$cell.'" onclick="selectCell('.$lvl.', '.$ar[0].', '.$ar[1].');">
              <td class="cms_middle" align="center">'.$cell.'</td>
              <td class="cms_middle" align="center">'.$resource_array[$rowr['resource_id']].'</td>
              <td align="left" class="cms_middle">'.$rowr['min_ability'].'</td>
              <td align="left" class="cms_middle">'.$rowr['count_total'].'</td>
              <td align="left" class="cms_middle">'.$rowr['count_left'].'</td>
              <td align="left" class="cms_middle">'.$rowr['chance'].'</td>
            </tr>
            ';
        }
            
        echo '</table>
        </td></tr></table>
        ';
        
    }
} else echo '<br /><br />Шахта не найдена';

$levels = array();
for($i=1; $i<=$mine['levels_count']; $i++)
    $levels[$i] = $i;
    
$rand_array = array(
    1 => '1 - Большое кол-во маленьких жил',
    2 => '2',
    3 => '3',
    4 => '4',
    5 => '5 - Малое кол-во больших жил',
);

?>
Добавить ресурсы:
<form name="add_remove_resources" method="post" action="">
Уровень: <?=createSelectFromArray('level', $levels)?><br />
Добавить ресурс: <?=createSelectFromArray('resource', $resource_array)?><br />
Количество на уровень: <input type="text" name="count" /><br />
Требуемое умение: <input type="text" name="ability" value="0" /><br />
Шанс: <input type="text" name="chance" value="100" />%<br />
Разброс: <?=createSelectFromArray('rand', $rand_array, '')?><br />
<input type="submit" name="add" value="Добавить" />
</form>
<br />
Очистить уровень:
<form name="add_remove_resources" method="post" action="">
Уровень: <?=createSelectFromArray('level', $levels)?><br />
Ресурс: <?=createSelectFromArray('resource', $resource_array)?><br />
<input type="submit" name="remove" value="Очистить" />
</form>
<br />
Восстановить уровень:
<form name="add_remove_resources" method="post" action="">
Уровень: <?=createSelectFromArray('level', $levels)?><br />
Ресурс: <?=createSelectFromArray('resource', $resource_array)?><br />
<input type="submit" name="restore" value="Восстановить" />
</form>
<? require('kernel/after.php'); ?>