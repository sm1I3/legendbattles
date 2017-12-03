<?php
require('kernel/before.php');

$types = array(
    1 => 'Шахта простых металлов',
    2 => 'Шахта драгоценных металлов',
);

if (!userHasPermission(32768)) {
    header('Location: index.php');
    die();
}

if (!isset($_GET['mine_code']))
    $mine_code = '';
else
    $mine_code = $_GET['mine_code'];
    
date_default_timezone_set('Europe/Moscow');

$row_id = 0;

// list of mineral resources
$resource_array = array();
$res = mysql_query('select * from restore_resources where resource_type = 8');
while($row = mysql_fetch_assoc($res))
    $resource_array[$row['resource_id']] = $row['resource_name'];
mysql_free_result($res);

$mine_resources = '';
// resources

    
if (isset($_POST['mine_name'])) 
{
    $mine_array = array();
    
    $fullfill = 100; // %
    $wallshort = 100; // %
    
    $depth = $_POST['mine_depth'];
    $width = $_POST['mine_width']*2 + 1;
    $height = $_POST['mine_height']*2 + 1;
    
    function initrandom ()
    {
        global $h, $r, $width, $height;
        $j = 0;

        for ($y = 2; $y < $width; $y += 2)
        for ($x = 2; $x < $height; $x += 2)
        {
            $r[0][$j] = $x; 
            $r[1][$j] = $y; 
            $j++;
        }

        $h = $j - 1;
        
        return true;
    }
    
    function getrandom($x, $y)
    {
        global $h, $r;
        $i = rand(1, $h);
        $x = $r[0][$i]; 
        $y = $r[1][$i];
        
        $r[0][$i] = $r[0][$h]; 
        $r[1][$i] = $r[1][$h];
        
        $h--;
        
        if ($h > 0)
            return array(
                'startx' => $x,
                'starty' => $y
            );
        else
            return false;
    }
    
    function clear()
    {
        global $m, $height, $width;
        
        for($i=0; $i<$height; $i++)
        for($j=0; $j<$width; $j++)
            $m[$i][$j] = 1;
    }
    
    function view()
    {
        global $width, $height, $m;
        
        echo '<br /><br />';
        for($i=0; $i<$height; $i++)
        {
            for($j=0; $j<$width; $j++)
                echo ($m[$i][$j]);
            echo '<br />';
        }
        echo '<br /><br />';
    }
    
    for($lvl=1; $lvl<=$depth; $lvl++)
    {
    
        $m = $r = array();
        $startx = $starty = 0;
        clear();
        
        for($i=0; $i<$height; $i++)
        {
            $m[$i][0] = 0;
            $m[$i][$width-1] = 0;
        }
        
        for($j=0; $j<$width; $j++)
        {
            $m[0][$j] = 0;
            $m[$height-1][$j] = 0;
        }
        
        initrandom();
        while ($x = getrandom($startx, $starty))
        {
            $startx = $x['startx'];
            $starty = $x['starty'];
            if ($m[$starty][$startx] == 0) continue;
            if (rand(1, 100) > $fullfill) continue;

            $sx = $sy = 0;
            
            do
            {
                $sx = rand(0,2) - 1;
                $sy = rand(0,2) - 1;
            } while (($sx==0 && $sy==0) || ($sx!=0 && $sy!=0)); //sx==0 and sy==0
            
            while ($m[$starty][$startx]==1)
            {
                if (rand(1, 100) > $wallshort)
                {
                    $m[$starty][$startx] = 0; 
                    break;
                }

                $m[$starty][$startx] = 0;
                $startx += $sx; 
                $starty += $sy;
                $m[$starty][$startx] = 0;
                $startx += $sx; 
                $starty += $sy;
            }
        }
        
        $tmp = array();
        
        for ($i=1; $i<$height; $i+=2)
            for ($j=1; $j<$width; $j+=2)
            {
                $ni = ($i-1)/2;
                $nj = ($j-1)/2;
                $tmp[$ni][$nj]['v'] = ($m[$i][$j]==0?0:rand(1,4));
                $tmp[$ni][$nj]['p'] = '';
                if ($m[$i-1][$j] > 0) $tmp[$ni][$nj]['p'] .= 't';
                if ($m[$i][$j+1] > 0) $tmp[$ni][$nj]['p'] .= 'r';
                if ($m[$i+1][$j] > 0) $tmp[$ni][$nj]['p'] .= 'b';
                if ($m[$i][$j-1] > 0) $tmp[$ni][$nj]['p'] .= 'l';
            }
        
        // First elevator (up)    
        $b = false;
        while(!$b)
        {
            $i = rand(0, ($height-1)/2);
            $j = rand(0, ($width-1)/2);
            if ($tmp[$i][$j]['v'] > 0) {
                $tmp[$i][$j]['v'] = 10;
                $b = true;
            }
        }
        
        // Second elevator (down)
        $b = false;
        while(!$b)
        {
            $i = rand(0, ($height-1)/2);
            $j = rand(0, ($width-1)/2);
            if ($tmp[$i][$j]['v'] > 0 && $tmp[$i][$j]['v'] < 10) {
                $tmp[$i][$j]['v'] = 11;
                $b = true;
            }
        }
        
        $mine_array['m'][$lvl] = $tmp;
        
    }
    
    
    $mine_resources = array();
    $tmp_res = array();
    if (isset($_POST['res']) && is_array($_POST['res']))
    foreach($_POST['res'] as $id=>$res_id)
    {
        $res_count = (int)$_POST['res_count'][$id];
        $rand = (int)$_POST['res_rand'][$id];
        $ability = (int)$_POST['res_ability'][$id];
        $res_left = $res_count;
        for($lvl=1; $lvl<=$depth; $lvl++)
        {
            $res_lvl_count = round($res_left / ($depth - $lvl + 1));
            $res_left -= $res_lvl_count;
            
            $realheight = ($height-1)/2;
            $realwidth = ($width-1)/2;
            
            switch($rand)
            {
                case 1: $vein_count = rand( ceil($realheight*$realwidth/1.5) , $realheight*$realwidth*2); break;
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
                    {
                        $mine_resources[$lvl.'_'.$h.'_'.$w][$res_id]['count'] = $res_vein_count;
                        $mine_resources[$lvl.'_'.$h.'_'.$w][$res_id]['ability'] = $ability;
                    } else
                        $mine_resources[$lvl.'_'.$h.'_'.$w][$res_id]['count'] += $res_vein_count;
                }
            }
        }
    }
    
    if ($mine_code == '') 
    {
        
        if ((int)$_POST['width'] < 5) $_POST['width'] = 5;
        if ((int)$_POST['height'] < 5) $_POST['height'] = 5;
        if ((int)$_POST['mine_type'] < 1) $_POST['mine_type'] = 1;
        
        $lab_array = array();
        $lab_params = array();
        $lab_objects = array();
        
        for ($i=0; $i<(int)$_POST['height']; $i++)
            for ($j=0; $j<(int)$_POST['width']; $j++)
                $lab_array[$i][$j] = 0;
                    
        $start_array = array(0, 0, 3);
        
        $tmp_arr = array(
            0 => $lab_array,
            1 => $start_array,
            2 => $lab_params,
            3 => $lab_objects,
        );
        
        $serialized = serialize($tmp_arr);
        
        $query = '
        insert into mine_list 
        (
            mine_code,
            mine_name,
            mine_type,
            levels_count,
            levels_opened,
            move_time,
            move_ust,
            elev_time,
            elev_ust,
            digg_time,
            digg_ust,
            wait_time,
            wait_ust,
            mine_levels
        ) values (
            \''.mysql_escape_string($_POST['mine_code']).'\',
            \''.mysql_escape_string($_POST['mine_name']).'\',
            '.(int)$_POST['mine_type'].',
            '.(int)$depth.',
            '.(int)$_POST['levels_opened'].',
            '.(int)$_POST['move_time'].',
            '.(float)$_POST['move_ust'].',
            '.(int)$_POST['elev_time'].',
            '.(float)$_POST['elev_ust'].',
            '.(int)$_POST['digg_time'].',
            '.(float)$_POST['digg_ust'].',
            '.(int)$_POST['wait_time'].',
            '.(float)$_POST['wait_ust'].',
            \''.mysql_escape_string(serialize($mine_array)).'\'
        )';
        
        if (!mysql_query($query)) {
            echo mysql_error();
            die();
        }
        
        $mine_code = $_POST['mine_code'];
        
        foreach($mine_resources as $cell_pos => $arr)
        foreach($arr as $res_id => $count_ability)
        {
            $ar =explode('_', $cell_pos);
            $query = '
                INSERT INTO mine_res (mine_code, cell_pos, resource_id, level, count_total, count_left, min_ability) 
                VALUES (\''.mysql_escape_string($mine_code).'\', \''.$cell_pos.'\', '.(int)$res_id.', '.(int)$ar[0].', '.(int)$count_ability['count'].', '.(int)$count_ability['count'].', '.(int)$count_ability['ability'].')';
            if (!mysql_query($query))
                die(mysql_error());
        }
        
        header('Location: mine_view.php?mine_code='.$mine_code);
    } else {
        $query = '
        update mine_list set
            mine_code = \''.mysql_escape_string($_POST['mine_code']).'\',
            mine_name = \''.mysql_escape_string($_POST['mine_name']).'\',
            mine_type = '.intval($_POST['mine_type']).',
            levels_opened = '.intval($_POST['levels_opened']).',
            move_time = '.intval($_POST['move_time']).',
            move_ust = '.floatval($_POST['move_ust']).',
            elev_time = '.intval($_POST['elev_time']).',
            elev_ust = '.floatval($_POST['elev_ust']).',
            digg_time = '.intval($_POST['digg_time']).',
            digg_ust = '.floatval($_POST['digg_ust']).',
            wait_time = '.intval($_POST['wait_time']).',
            wait_ust = '.floatval($_POST['wait_ust']).'
        where
            mine_code = \''.mysql_escape_string($_POST['mine_code']).'\'
        '  ;
        mysql_query($query);
        header('Location: mine_list.php');
    }    
    
    
}


if ($mine_code == '') {
    $mine = array(
        'mine_code' => '',
        'mine_type' => 1,
        'mine_name' => '',
        'levels_opened' => '0',
    );
    $params = array(
        'round_max_level' => 99,
        'round_step' => 1,
    );
    $is_confirmed = 'N';
} 
else 
{
    $mine = array();
    $res = mysql_query('select * from mine_list where mine_code = \''.$mine_code.'\'');
    if($row = mysql_fetch_assoc($res))
        $mine = $row;
    mysql_free_result($res);
}

?>
<h3><?=($mine_code == ''?'Добавить шахту':'Параметры шахты')?></h3>
<script type="text/javascript" src="jscript/mine.js"></script>
<script language="javascript">
var last_id = <?=(int)$row_id?>;
<?=createJsArray('res_array', $resource_array)?>
</script>
<form name="edit_resource" action="" method="POST">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
  <td><span class="cms_star">*</span>Код шахты: &nbsp;  </td>
  <td><input name="mine_code" type="text" class="cms_fieldstyle1" value="<?=$mine['mine_code']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td><span class="cms_star">*</span>Название шахты: &nbsp;  </td>
  <td><input name="mine_name" type="text" class="cms_fieldstyle1" value="<?=$mine['mine_name']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td><span class="cms_star">*</span>Тип шахты: &nbsp;  </td>
  <td><?= createSelectFromArray('mine_type', $types, $mine['mine_type']) ?></td>
</tr>
<tr>
  <td><span class="cms_star">*</span>Открыто уровней: &nbsp;  </td>
  <td><input name="levels_opened" type="text" class="cms_fieldstyle1" value="<?=$mine['levels_opened']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Время на перемещение: &nbsp;  </td>
  <td><input name="move_time" type="text" class="cms_fieldstyle1" value="<?=$mine['move_time']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Усталость при перемещении: &nbsp;  </td>
  <td><input name="move_ust" type="text" class="cms_fieldstyle1" value="<?=$mine['move_ust']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Время на спуск/подъём: &nbsp;  </td>
  <td><input name="elev_time" type="text" class="cms_fieldstyle1" value="<?=$mine['elev_time']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Усталость при спуске/подъёме: &nbsp;  </td>
  <td><input name="elev_ust" type="text" class="cms_fieldstyle1" value="<?=$mine['elev_ust']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Время на добычу: &nbsp;  </td>
  <td><input name="digg_time" type="text" class="cms_fieldstyle1" value="<?=$mine['digg_time']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Усталость при добыче: &nbsp;  </td>
  <td><input name="digg_ust" type="text" class="cms_fieldstyle1" value="<?=$mine['digg_ust']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Время на ожидание (при неудачной добыче): &nbsp;  </td>
  <td><input name="wait_time" type="text" class="cms_fieldstyle1" value="<?=$mine['wait_time']?>" size="30" maxlength="255" /></td>
</tr>
<tr>
  <td>Усталость при ожидании: &nbsp;  </td>
  <td><input name="wait_ust" type="text" class="cms_fieldstyle1" value="<?=$mine['wait_ust']?>" size="30" maxlength="255" /></td>
</tr>
</table>
<? if ($mine_code == '') { ?>
<br />
<table border="0" cellpadding="0" cellspacing="1">
<tr>
  <td><span class="cms_star">*</span> Глубина шахты: &nbsp;  </td>
  <td><input name="mine_depth" type="text" class="cms_fieldstyle1" value="10" size="10" maxlength="5" /></td>
</tr>
<tr>
  <td><span class="cms_star">*</span> Длина этажа: &nbsp;  </td>
  <td><input name="mine_width" type="text" class="cms_fieldstyle1" value="5" size="10" maxlength="5" /></td>
</tr>
<tr>
  <td><span class="cms_star">*</span> Ширина этажа: &nbsp;  </td>
  <td><input name="mine_height" type="text" class="cms_fieldstyle1" value="5" size="10" maxlength="5" /></td>
</tr>
</table>
<br />
Добываемые ресурсы:
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" id="table_res" >
    <tr >
        <td class="cms_cap3">Удалить</td>
        <td class="cms_cap3">Ресурс</td>
        <td class="cms_cap3">Количество</td>
        <td class="cms_cap3">Умение</td>
        <td class="cms_cap3">Разброс</td>
    </tr>
</table>
<a onclick="addItem_mine_res('table_res', 'tr_res_', 'res', res_array); return false;" href="#">Добавить</a><br />
<br />
<? } ?>
    
    
<p></p>
<input name="submit" onclick="return validate(this.form);" type="submit" class="cms_button1" value="Сохранить" style="width: 150px"  <?=(!userHasPermission(8) && $is_confirmed=='Y'?'disabled="disabled"':'')?> />
<input name="cancel" type="submit" onclick="document.location='mine_list.php'; return false;" class="cms_button1" value="Отмена" />
<p><span class="cms_star">*</span> - Обязательные поля </p>
</form>
<? require('kernel/after.php'); ?>