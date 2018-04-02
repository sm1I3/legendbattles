<?php
$dmodarr = array(1 => 'Урон огнем', 2 => 'Урон льдом', 3 => 'Вампиризм', 4 => 'Лечение');
switch ($dmod[0]) {
    case 1:
        echo $dmodarr[$dmod[0]] . ': <b><font color="#B00000">' . $dmod[1] . '</b></font><br>';
        break;
    case 2:
        echo $dmodarr[$dmod[0]] . ': <b><font color="#000099">' . $dmod[1] . '</b></font><br>';
        break;
    case 3:
        echo $dmodarr[$dmod[0]] . ': <b><font color="#6633CC">' . $dmod[1] . '</b></font><br>';
        break;
    case 4:
        echo $dmodarr[$dmod[0]] . ': <b><font color="#FFBB88">' . $dmod[1] . '</b></font><br>';
        break;
}
