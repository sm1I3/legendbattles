<?php
require('./../kernel/before.php'); 
ob_end_clean();

    $query = 'select * from items where 1=1 ';
    if (isset($_GET['wtype']) && $_GET['wtype']!='')
        $query .= ' and type = \''.mysql_escape_string($_GET['wtype']).'\' ';
        
    if (isset($_GET['wname']) && $_GET['wname']!='')
        $wname = iconv('UTF-8', 'windows-1251', $_GET['wname']);
    else
        $wname = '';
        
    if (isset($_GET['wsecurity']) && $_GET['wsecurity']!='')
        $wsecurity = intval($_GET['wsecurity']);
    else
        $wsecurity = '';


    if ($wname != '')
        $query .= ' and name like \'%'.mysql_escape_string($wname).'%\' ';
        

    if (isset($_GET['id']) && $_GET['id'] != '')
        $id = $_GET['id'];
    else
        $id = '';
        
    $use_uid = (isset($_GET['idtype']) && $_GET['idtype'] == 'uid');

    $table = '<table border="0" cellpadding="0" cellspacing="0">';

    $res = mysql_query($query);
    $i = 0;
    $count = mysql_num_rows($res);
    while($i < 100 && $row = mysql_fetch_assoc($res)) {
        $i++;
        $rid = ($use_uid?$row['id']:$row['id']);
        $table .= '<tr>
        <td style="border-top: 1px solid grey;"><input type="radio" name="id" value="'.$rid.'" '.($rid==$id?'checked':'').' id="'.$row['id'].'" /><input type="hidden" name="name" id="'.$row['id'].'_name" value="'._htext($row['name']).'"></td>
        <td style="border-top: 1px solid grey;" width="99%"><label for="'.$row['id'].'">'._htext($row['name']).'</label></td>
        <td style="border-top: 1px solid grey;"><label for="'.$row['id'].'"><img src="//img.lifeiswar.ru/image/weapon/'.$row['gif'].'" /></label></td>
        </tr>';
    }

    $table .= '</table>';

    $status = ($count>100 ? 'x' : ($count==0 ? 'n' : 'k') );

    header('Content-type: text/html; charset=windows-1251');
    header("Cache-Control: no-cache"); 
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    echo $status.'|'.$table;
    die();