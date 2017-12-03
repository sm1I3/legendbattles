<?
if ($player['clan_id'] != 'none') {
    $clan = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT * FROM clans WHERE clan_id='" . $player['clan_id'] . "' LIMIT 1;"));
    $clpod = explode("|", $clan['podzem']);
}
$cd[1] = 'none';
$cd[2] = 'none';
if ($player['loc'] == 80) {
    $podq = mysqli_query($GLOBALS['db_link'], "SELECT * FROM podzem WHERE pl_id=" . $player['id'] . " AND pod_id=1;");
    if (mysqli_num_rows($podq) == 0) {
        mysqli_query($GLOBALS['db_link'], "INSERT INTO podzem (pl_id,level,pod_id) VALUES (" . $player['id'] . ",1,1)");
        $podq = mysqli_query($GLOBALS['db_link'], "SELECT * FROM podzem WHERE pl_id=" . $player['id'] . " AND pod_id=1;");
    }
    while ($row = mysqli_fetch_assoc($podq)) {
        if ($row['end_time'] > time() and $row['level'] == 1) {
            $cd[1] = "Подземелье откроется: " . date("d.m.y (в Hч. iмин. sсек.)", $row[end_time]) . "";
        }
        if ($row['end_time'] > time() and $row['level'] == 2) {
            $cd[2] = "Подземелье откроется: " . date("d.m.y (в Hч. iмин. sсек.)", $row[end_time]) . "";
        }
    }
    $id = 1;
} else if ($player['loc'] == 81) {
    $podq = mysqli_query($GLOBALS['db_link'], "SELECT * FROM podzem WHERE pl_id=" . $player['id'] . " AND pod_id=2;");
    if (mysqli_num_rows($podq) == 0) {
        mysqli_query($GLOBALS['db_link'], "INSERT INTO podzem (pl_id,level,pod_id) VALUES (" . $player['id'] . ",1,2)");
        $podq = mysqli_query($GLOBALS['db_link'], "SELECT * FROM podzem WHERE pl_id=" . $player['id'] . " AND pod_id=2;");
    }
    while ($row = mysqli_fetch_assoc($podq)) {
        if ($row['end_time'] > time() and $row['level'] == 1) {
            $cd[1] = "Подземелье откроется: " . date("d.m.y (в Hч. iмин. sсек.)", $row[end_time]) . "";
        }
        if ($row['end_time'] > time() and $row['level'] == 2) {
            $cd[2] = "Подземелье откроется: " . date("d.m.y (в Hч. iмин. sсек.)", $row[end_time]) . "";
        }
    }
    $id = 2;
}
echo '
	<table border=1 width=760 height=100 align=center valign=top>';

if ($cd[1] == 'none') {
    echo '<tr><td align=center width=33% bgcolor=f5f5f5><b><a href="main.php?post_id=80&vcode=';
    echo scode();
    echo '"><font class=weaponchart>Войти в подземелье (1й уровень)</font></a></b></font></td></tr>';
} else {
    echo '<tr><td align=center width=33% bgcolor=f5f5f5><b><font class=freetxt><font color=gray>' . $cd[1] . '</font></b></font></td></tr>';
}

if ($cd[2] == 'none' and $clpod[$id - 1] == $id) {
    echo '<tr><td align=center width=33% bgcolor=f5f5f5><b><a href="main.php?post_id=80&vcode=';
    echo scode();
    echo '"><font class=weaponchart>Войти в подземелье (2й уровень)</font></a></b></font></td></tr>';
} else if ($player['clan_id'] == 'none' or $clpod[$id - 1] != $id) {
    echo '<td align=center width=33% bgcolor=f5f5f5><b><font class=freetxt><font color=#222222>Вход на 2й уровень недоступен</font></b></font></td></tr>';
} else {
    echo '<tr><td align=center width=33% bgcolor=f5f5f5><b><font class=freetxt><font color=#222222>' . $cd[1] . '</font></b></font></td></tr>';
}
?>