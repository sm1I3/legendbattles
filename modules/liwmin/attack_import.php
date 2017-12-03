<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}

if (isset($_FILES['config_file']))
{
    $config = file_get_contents($_FILES['config_file']['tmp_name']);
    $arr = explode("\n", $config);
    
    mysql_query('DELETE FROM attack_list');
    
    foreach($arr as $id=>$row)
    if (trim($row) != '')
    {
        $arr2 = explode('|', $row);
        $arr3 = $arr2;
        unset($arr3[0]); unset($arr3[1]); unset($arr3[2]);
        
        $gv = 'NULL';
        
        if ($arr2[0] == 0 && $arr2[2] == 1) $gv = 1;
        if ($arr2[0] == 0 && $arr2[2] == 2) $gv = 2;
        if ($arr2[0] == 0 && $arr2[2] == 3) $gv = 4;
        if ($arr2[0] == 1 && $arr2[2] == 3) $gv = 4;
        if ($arr2[0] == 1 && $arr2[2] == 5) $gv = 3;
        if ($arr2[0] == 1 && $arr2[2] == 6) $gv = 4;
        if ($arr2[0] == 2 || $arr2[0] == 3 || $arr2[0] == 4 || $arr2[0] == 5) $gv = 3;
        
        mysql_query('
            INSERT INTO attack_list
                (attack_id, is_active, name, display_name, type, action_type, pos_type, params)
            VALUES
                ('.intval($id).', 1, \''.mysql_real_escape_string($arr2[1]).'\', 1, '.intval($arr2[0]).', '.intval($arr2[2]).', '.intval($gv).', \''.mysql_real_escape_string( implode('|', $arr3) ).'\')
        ');
    }
}

?>
<h3>Импорт конфига</h3>
<br />
<form name="config_import" action="" method="post" enctype="multipart/form-data">
<input type="file" name="config_file" /><br /><br />
<input type="submit" name="import" value="Импортировать" onclick="return confirm('Все текущие удары будут удалены. Вы уверены?');" />
</form>
<br />
<a href="attack_list.php">Назад</a>

<? require('kernel/after.php'); ?>