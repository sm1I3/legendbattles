<?php

require('kernel/before.php');

if (!userHasPermission(1024)) {
    header('Location: index.php');
    die();
}

if (isset($_POST['update']))
{
    // Level koef
    mysql_query('DELETE FROM bots_level_koef');
    for($i = 0; $i <= 33; $i++)
    {
        $query = 'INSERT INTO bots_level_koef (level';
        $keys = '';
        $values = '';
        for ($j = 1; $j <=10; $j++)
        {
            $keys .= ', koef_'.$j;
            $values .= ', '.(isset($_POST['bot_koef'][$i][$j]) ? floatval($_POST['bot_koef'][$i][$j]) : 1);
        }
        $query .= $keys . ') VALUES ('.$i.' '.$values.')';
        mysql_query($query);
    }
}

// Level koef
$res = mysql_query('select * from bots_level_koef');
$bot_koef = array();
while ($row = mysql_fetch_assoc($res)) 
{
    for($i = 1; $i <= 10; $i++)
        $bot_koef[$row['level']][$i] = floatval($row['koef_'.$i]);
}


$_SESSION['pages']['bot_list'] = $_SERVER['REQUEST_URI'];

?>
<h3>Коэффициенты ботов</h3>
<link rel="stylesheet" href="files/modalwindow.css" type="text/css" />
<form action="" method="post">
Коэффициенты:
<table>
    <tr>
        <td>&nbsp;</td>
<? for ($i=1; $i<=10; $i++) { ?>
    <td align="center"><?=$i?></td>
<? } ?>
    </tr>
<? for ($i=0; $i<=33; $i++) { ?>
    <tr><td><?=$i?></td>
<? for ($j=1; $j<=10; $j++) { ?>
    <td><input type="text" size="3" name="bot_koef[<?=$i?>][<?=$j?>]" value="<?=(isset($bot_koef[$i][$j]) ? $bot_koef[$i][$j] : 1)?>" /></td>
<? } ?>
    </tr>
<? } ?>
</table>
<input type="submit" name="update" value="Сохранить">
 <br />
</form>
 <br />

<? require('kernel/after.php'); ?>