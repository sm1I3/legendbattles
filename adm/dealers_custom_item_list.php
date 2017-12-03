<?php
//error_reporting(E_ALL);
require('kernel/before.php');

if (!userHasPermission(262144)) {
    header('Location: index.php');
    die();
}

$id = 1; 

$res = mysql_query('SELECT * FROM d_custom_item WHERE id = '.intval($id));
if ($row = mysql_fetch_assoc($res))
    $array = unserialize($row['description']);
    
$trf = $array['trf'];
$color = $array['color'];
$color_a = $array['color_a'];
$ins = $array['ins'];
$grpn = $array['grpn'];
$modn = $array['modn'];
$itmp = $array['itmp'];

$akeys = $array['akeys'];

?>
<h3>Список типов и классов</h3>
<?


echo '<table border="1" cellpadding="0" cellspacing="0" bordercolor="#C1E1EE" class="cms_table1" >';
echo '<tr><td class="cms_cap2">&nbsp;</td>';
foreach($color_a as $trfcode => $trfcolor)
    echo '<td class="cms_cap2"><span style="color: #'.$trfcolor.'">'.$trfcode.'</span></td>';
echo '</tr>';

foreach($ins as $inscode => $insname)
{
    echo '<tr>';
    echo '<td class="cms_cap2">'.$insname.'</td>';
    foreach($color_a as $trfcode => $trfcolor)
    {
        
        if (in_array($inscode, $akeys[$trfcode]))
            echo '<td>&nbsp;<a href="dealers_custom_item_edit.php?id='.$id.'&inscode='.$inscode.'&trfcode='.$trfcode.'">Редактировать</a>&nbsp;</td>';
        else
            echo '<td>&nbsp;<a style="color: red;" href="dealers_custom_item_edit.php?id='.$id.'&inscode='.$inscode.'&trfcode='.$trfcode.'">Добавить</a>&nbsp;</td>';
    }
    
    echo '</tr>';
}
echo '</table>';
?>
<form name="generate"><input type="submit" name="generate" value="Generate array" /></form>
<?
//echo 1;
if (isset($_GET['generate']))
{
    //echo 2;
    $itemtype_array = array();
    //echo 3;               
    echo '$itmp = array(';
    foreach($itmp as $itemname => $itemtype)
    {
        //echo 4;
        $class_array = array();
        foreach($itemtype as $classname => $class)
        {
            //echo 5;
            $paramtype_array = array();
            foreach($class as $paramtypename => $paramtypes)
            {
                //echo 6;
                $paramname_array = array();
                foreach($paramtypes as $paramname => $param)
                {
                    //echo 7;
                    $param_array = array();
                    foreach($param as $mod => $value)
                    {
                        //echo 8;
                        $param_array[] = (preg_match('/^[0-9]+$/is', $mod) ? $mod : "'".$mod."'").' => '.$value;
                    }
                    
                    //echo 9;
                    $paramname_array[] = "'".$paramname."'".' => array('.implode(', ', $param_array).')';
                }
                
                //echo 'A<br>';
                $paramtype_array[] = "'".$paramtypename."'".' => array('.implode(', ', $paramname_array).')';
            }
            //echo 'B<br><br>';
            $class_array[] = "'".$classname."'".' => array('.implode(', ', $paramtype_array).')';
            //echo 'B1<br><br>';
        }
        //echo 'C<br><br><br>';
        $itemtype_array[] = "'".$itemname."'".' => array('.implode(', ', $class_array).')';
        //echo 'C1<br><br><br>';
    }
    //echo 'D';
    echo implode(', ', $itemtype_array).');';
}

?>