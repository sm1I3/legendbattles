<?php
function dump($var) { echo '<pre>'; print_r($var); echo '</pre>'; }

function _htext($text) { return htmlspecialchars($text, ENT_COMPAT, 'WINDOWS-1251'); }

function BbToHtml($str) {
	$str = preg_replace("/\[center\](.+)\[\/center\]/Usi","<center>\\1</center>",$str);
	$str = preg_replace("/\[img\](.*)\[\/img\]/Usi","<img src=\"\\1\" />",$str);
	$str = preg_replace("/\[b\](.+)\[\/b\]/Usi","<b>\\1</b>",$str);
	$str = preg_replace("/\[i\](.+)\[\/i\]/Usi","<i>\\1</i>",$str);
	$str = preg_replace("/\[u\](.+)\[\/u\]/Usi","<u>\\1</u>",$str);
	$str = preg_replace("/\[s\](.+)\[\/s\]/Usi","<s>\\1</s>",$str);
    return $str;
}
function HtmlToBb($str) {
	$str = preg_replace("/<center>(.+)<\/center>/Usi","[center]\\1[/center]",$str);
	$str = preg_replace("/<img src=\\\"(.+)\\\" \/>/Usi","[img]\\1[/img]",$str);
	$str = preg_replace("/<b>(.+)<\/b>/Usi","[b]\\1[/b]",$str);
	$str = preg_replace("/<i>(.+)<\/i>/Usi","[i]\\1[/i]",$str);
	$str = preg_replace("/<u>(.+)<\/u>/Usi","[u]\\1[/u]",$str);
	$str = preg_replace("/<s>(.+)<\/s>/Usi","[s]\\1[/s]",$str);
	return $str;
}

function createJsArray($array_name, $array) {  
    $js = 'var '.$array_name.' = new Array();'."\n";
    if (is_array($array))
    foreach($array as $k=>$v)
        $js .= $array_name.'[\''.$k.'\'] = \''.stripslashes( $v ).'\';'."\n";
    return $js;
}

function createJsHArray($array_name, $array) {  
    $js = 'var '.$array_name.' = new Array();'."\n";
    if (is_array($array))
    foreach($array as $gid=>$arr) {
        $js .= $array_name.'[\''.$gid.'\'] = new Array();'."\n";
        if (is_array($arr))
        foreach($arr as $eid => $v) {
            $js .= $array_name.'[\''.$gid.'\'][\''.$eid.'\'] = \''.stripslashes( $v ).'\';'."\n";
        }
        
    }
    return $js;
}

function createSelectFromArray($select_name, $array, $selected_default = '', $other = '', $default = '(Выберите вариант)') {
    $s = '<select name="'.$select_name.'" '.$other.' >';
    if ($default)
        $s .= '<option value="">'.$default.'</option>';
    if (is_array($array))
    foreach($array as $k=>$v) {
        $s .= '<option value="'.$k.'" '.((string)$k==(string)$selected_default?'selected="selected"':'').' >'._htext($v).'</option>';
    }
    $s .= '</select>';
    return $s;
}

function createPageNavigator($records_count, $cur_page = 1, $nav_name = 'Записи', $link = '', $recs_per_page = 50)
{
    if ($link == '') $link = $_SERVER['REQUEST_URI'];
    
    $pages_count = ceil($records_count / $recs_per_page);
    $first = (($cur_page-1)*$recs_per_page + 1);
    if ($records_count == 0) $first = 0;
    $last = ($cur_page*$recs_per_page);
    if ($last > $records_count) $last = $records_count;
    
    $nav = $nav_name.' '.$first.'-'.$last.' из '.$records_count.'<br />';
    
    $link = preg_replace('/\&?page=\d{1,5}/i', '', $link);
    if (strpos($link, '?')===false) 
        $link .= '?';
    
    if ($cur_page > 1)
        $nav .= '<a href="'.$link.'&page=1">Первая</a> | <a href="'.$link.'&page='.($cur_page-1).'">Пред.</a> | ';
    else
        $nav .= '<span class="red">Первая</span> | <span class="red">Пред.</span> | ';
    
    for($i=1; $i<=$pages_count; $i++) {
        if ($cur_page == $i)
            $nav .= '<span class="red">'.$i.'</span> | ';
        else
            $nav .= '<a href="'.$link.'&page='.$i.'">'.$i.'</a> | ';
    }
    
    if ($cur_page < $pages_count)
        $nav .= '<a href="'.$link.'&page='.($cur_page+1).'">След.</a> | <a href="'.$link.'&page='.$pages_count.'">Последняя</a>';
    else
        $nav .= '<span class="red">След.</span> | <span class="red">Последняя</span>';
    
    return $nav;
}

function generateMysqlLimit($page, $recs_per_page)
{
    return ' LIMIT '.intval(($page-1)*$recs_per_page).', '.intval($recs_per_page).' ';
}

function generateMysqlOrder($sort_by = '', $sort_order = 'asc')
{
    if ($sort_by == '') {
        if (isset($_GET['sort_by']) && $_GET['sort_by'] != '') 
            $sort_by = $_GET['sort_by'];
        else 
            $sort_by = '';
        if (isset($_GET['sort_order']) && $_GET['sort_order'] != '') 
            $sort_order = $_GET['sort_order'];
        else 
            $sort_order = '';
    }
    
    if ($sort_by == '')
        return '';
    else
        return ' ORDER BY '.$sort_by.' '.$sort_order.' ';    
}

function sortby($field) 
{
    $link = $_SERVER['REQUEST_URI'];
    $link = preg_replace('/\&?sort_by=[a-zA-Z_\-]{1,20}/i', '', $link);
    $link = preg_replace('/\&?sort_order=[a-zA-Z_\-]{3,4}/i', '', $link);
    if (strpos($link, '?')===false) 
        $link .= '?';
    
    $sort_order = 'asc';
    if (isset($_GET['sort_by']) && $_GET['sort_by'] == $field) {
        if (isset($_GET['sort_order']) && strtolower($_GET['sort_order'])=='asc')
            $sort_order = 'desc';
    }
    
    return $link.'&sort_by='.$field.'&sort_order='.$sort_order;
}

function createWeaponControl($name, $type, $value_id, $value_name)
{
    $uid = rand(1,15).rand(20,215).rand(1,115);
    return '
    <div>
        <input type="hidden" name="'.$name.'" id="'.$uid.'_hf" value="'.$value_id.'" />
        <input type="text" name="_____name'.$name.'" id="'.$uid.'_nf" value="'.$value_name.'" readonly /><input type="button" name="_____button'.$name.'" value="..." onclick="showWeaponDiallog(\''.$uid.'\', \''.$type.'\');" /><img src="images/cms_icons/cms_calendar_clear.gif" align="absmiddle" onclick="clearWeaponDiallog(\''.$uid.'\');" title="Clear Date" style="cursor: pointer;" >
    </div>
    ';
}

function userHasPermission($code) {
    if (!isset($_SESSION['USER']['user_permissions']))
        return false;
        
    return $_SESSION['USER']['user_permissions'] & $code;
}

function errorToHtml($err) {
    if (is_array($err))
        return '<div class="error">'.implode('<br />', $err).'</div>';
    else
        return '<div class="error">'._htext($err).'</div>';
}

function messageToHtml($err) {
    if (is_array($err))
        return '<div class="winmodify">'.implode('<br />', $err).'</div>';
    else
        return '<div class="winmodify">'._htext($err).'</div>';
}
?>