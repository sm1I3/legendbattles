<?

function checkAchievements($um, $wins, $checkAchieve, $days, $travnik, $fisher, $lesnik, $alchemist, $student, $vzlom)
{
    //Гладиатор
    if ($checkAchieve[0] == 0 && $wins[0] >= 1000) {
        $checkAchieve[0] = 1;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+3000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[0] == 1 && $wins[0] >= 3000) {
        $checkAchieve[0] = 2;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+7000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[0] == 2 && $wins[0] >= 7000) {
        $checkAchieve[0] = 3;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+15000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[0] == 3 && $wins[0] >= 10000) {
        $checkAchieve[0] = 4;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+25000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[0] == 4 && $wins[0] >= 15000) {
        $checkAchieve[0] = 5;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+50000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[0] == 5 && $wins[0] >= 22000) {
        $checkAchieve[0] = 6;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+100000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[0] == 6 && $wins[0] >= 30000) {
        $checkAchieve[0] = 7;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+200000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[0] == 7 && $wins[0] >= 40000) {
        $checkAchieve[0] = 8;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+400000, baks = baks+20 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[0] == 8 && $wins[0] >= 65000) {
        $checkAchieve[0] = 9;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+800000, baks = baks+35 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[0] == 9 && $wins[0] >= 80000) {
        $checkAchieve[0] = 10;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+1600000, baks = baks+40 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }

    //Охотник за головами
    if ($checkAchieve[1] == 0 && $wins[2] >= 1000) {
        $checkAchieve[1] = 1;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+5000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[1] == 1 && $wins[2] >= 3000) {
        $checkAchieve[1] = 2;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+10000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[1] == 2 && $wins[2] >= 7000) {
        $checkAchieve[1] = 3;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+20000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[1] == 3 && $wins[2] >= 10000) {
        $checkAchieve[1] = 4;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+40000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[1] == 4 && $wins[2] >= 15000) {
        $checkAchieve[1] = 5;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+80000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[1] == 5 && $wins[2] >= 22000) {
        $checkAchieve[1] = 6;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+160000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[1] == 6 && $wins[2] >= 30000) {
        $checkAchieve[1] = 7;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+320000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[1] == 7 && $wins[2] >= 40000) {
        $checkAchieve[1] = 8;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+640000, baks = baks+20 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[1] == 8 && $wins[2] >= 65000) {
        $checkAchieve[1] = 9;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+1280000, baks = baks+35 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[1] == 9 && $wins[2] >= 80000) {
        $checkAchieve[1] = 10;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+2560000, baks = baks+50 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }

    //Наставник
    if ($checkAchieve[8] == 0 && $student >= 1) {
        $checkAchieve[8] = 1;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+4000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[8] == 1 && $student >= 3) {
        $checkAchieve[8] = 2;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+7000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[8] == 2 && $student >= 5) {
        $checkAchieve[8] = 3;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+10000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[8] == 3 && $student >= 7) {
        $checkAchieve[8] = 4;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+13000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[8] == 4 && $student >= 9) {
        $checkAchieve[8] = 5;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+16000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[8] == 5 && $student >= 11) {
        $checkAchieve[8] = 6;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+19000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[8] == 6 && $student >= 13) {
        $checkAchieve[8] = 7;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+22000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[8] == 7 && $student >= 15) {
        $checkAchieve[8] = 8;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+25000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[8] == 8 && $student >= 17) {
        $checkAchieve[8] = 9;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+28000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[8] == 9 && $student >= 19) {
        $checkAchieve[8] = 10;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+31000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }

    //Ветеран
    if ($checkAchieve[9] == 0 && $days >= 365) {
        $checkAchieve[9] = 1;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+3000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[9] == 1 && $days >= 730) {
        $checkAchieve[9] = 2;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+7000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[9] == 2 && $days >= 1095) {
        $checkAchieve[9] = 3;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+15000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[9] == 3 && $days >= 1460) {
        $checkAchieve[9] = 4;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+25000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[9] == 4 && $days >= 1825) {
        $checkAchieve[9] = 5;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+50000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[9] == 5 && $days >= 2190) {
        $checkAchieve[9] = 6;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+100000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[9] == 6 && $days >= 2555) {
        $checkAchieve[9] = 7;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+200000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[9] == 7 && $days >= 2920) {
        $checkAchieve[9] = 8;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+400000, baks = baks+20 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[9] == 8 && $days >= 3285) {
        $checkAchieve[9] = 9;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+800000, baks = baks+35 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[9] == 9 && $days >= 3650) {
        $checkAchieve[9] = 10;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+1600000, baks = baks+40 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }

    //Взломщик
    if ($checkAchieve[12] == 0 && $vzlom >= 100) {
        $checkAchieve[12] = 1;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+400 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[12] == 1 && $vzlom >= 250) {
        $checkAchieve[12] = 2;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+700 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[12] == 2 && $vzlom >= 500) {
        $checkAchieve[12] = 3;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+1000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[12] == 3 && $vzlom >= 780) {
        $checkAchieve[12] = 4;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+3000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[12] == 4 && $vzlom >= 900) {
        $checkAchieve[12] = 5;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+6000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[12] == 5 && $vzlom >= 1080) {
        $checkAchieve[12] = 6;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+9000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[12] == 6 && $vzlom >= 2080) {
        $checkAchieve[12] = 7;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+12000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[12] == 7 && $vzlom >= 3780) {
        $checkAchieve[12] = 8;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+15000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[12] == 8 && $vzlom >= 4780) {
        $checkAchieve[12] = 9;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+18000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[12] == 9 && $vzlom >= 5780) {
        $checkAchieve[12] = 10;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+21000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }


    //Травник
    if ($checkAchieve[13] == 0 && $travnik >= 100) {
        $checkAchieve[13] = 1;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+2000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[13] == 1 && $travnik >= 200) {
        $checkAchieve[13] = 2;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+4000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[13] == 2 && $travnik >= 300) {
        $checkAchieve[13] = 3;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+6000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[13] == 3 && $travnik >= 400) {
        $checkAchieve[13] = 4;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+8000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[13] == 4 && $travnik >= 500) {
        $checkAchieve[13] = 5;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+10000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[13] == 5 && $travnik >= 600) {
        $checkAchieve[13] = 6;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+12000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[13] == 6 && $travnik >= 750) {
        $checkAchieve[13] = 7;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+14000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[13] == 7 && $travnik >= 900) {
        $checkAchieve[13] = 8;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+16000, baks = baks+20 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[13] == 8 && $travnik >= 1050) {
        $checkAchieve[13] = 9;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+18000, baks = baks+35 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[13] == 9 && $travnik >= 1250) {
        $checkAchieve[13] = 10;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+20000, baks = baks+50 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }

    //Лесоруб
    if ($checkAchieve[14] == 0 && $lesnik >= 100) {
        $checkAchieve[14] = 1;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+2000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[14] == 1 && $lesnik >= 200) {
        $checkAchieve[14] = 2;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+4000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[14] == 2 && $lesnik >= 300) {
        $checkAchieve[14] = 3;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+6000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[14] == 3 && $lesnik >= 400) {
        $checkAchieve[14] = 4;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+8000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[14] == 4 && $lesnik >= 500) {
        $checkAchieve[14] = 5;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+10000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[14] == 5 && $lesnik >= 600) {
        $checkAchieve[14] = 6;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+12000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[14] == 6 && $lesnik >= 750) {
        $checkAchieve[14] = 7;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+14000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[14] == 7 && $lesnik >= 900) {
        $checkAchieve[14] = 8;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+16000, baks = baks+20 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[14] == 8 && $lesnik >= 1050) {
        $checkAchieve[14] = 9;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+18000, baks = baks+35 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[14] == 9 && $lesnik >= 1250) {
        $checkAchieve[14] = 10;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+20000, baks = baks+50 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }

    //Рыболов
    if ($checkAchieve[15] == 0 && $fisher >= 100) {
        $checkAchieve[15] = 1;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+2000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[15] == 1 && $fisher >= 200) {
        $checkAchieve[15] = 2;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+4000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[15] == 2 && $fisher >= 300) {
        $checkAchieve[15] = 3;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+6000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[15] == 3 && $fisher >= 400) {
        $checkAchieve[15] = 4;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+8000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[15] == 4 && $fisher >= 500) {
        $checkAchieve[15] = 5;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+10000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[15] == 5 && $fisher >= 600) {
        $checkAchieve[15] = 6;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+12000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[15] == 6 && $fisher >= 750) {
        $checkAchieve[15] = 7;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+14000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[15] == 7 && $fisher >= 900) {
        $checkAchieve[15] = 8;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+16000, baks = baks+20 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[15] == 8 && $fisher >= 1050) {
        $checkAchieve[15] = 9;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+18000, baks = baks+35 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[15] == 9 && $fisher >= 1250) {
        $checkAchieve[15] = 10;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+20000, baks = baks+50 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }

    //Алхимик
    if ($checkAchieve[19] == 0 && $alchemist >= 100) {
        $checkAchieve[19] = 1;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+2000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[19] == 1 && $alchemist >= 200) {
        $checkAchieve[19] = 2;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+4000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[19] == 2 && $alchemist >= 300) {
        $checkAchieve[19] = 3;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+6000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[19] == 3 && $alchemist >= 400) {
        $checkAchieve[19] = 4;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+8000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[19] == 4 && $alchemist >= 500) {
        $checkAchieve[19] = 5;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+10000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[19] == 5 && $alchemist >= 600) {
        $checkAchieve[19] = 6;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+12000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[19] == 6 && $alchemist >= 750) {
        $checkAchieve[19] = 7;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+14000 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[19] == 7 && $alchemist >= 900) {
        $checkAchieve[19] = 8;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+16000, baks = baks+20 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[19] == 8 && $alchemist >= 1050) {
        $checkAchieve[19] = 9;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+18000, baks = baks+35 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
    if ($checkAchieve[19] == 9 && $alchemist >= 1250) {
        $checkAchieve[19] = 10;
        $setAchieve = implode("|", $checkAchieve);
        mysqli_query($GLOBALS['db_link'], "UPDATE user SET achievements = " . AP . $setAchieve . AP . ", nv = nv+20000, baks = baks+50 WHERE login=" . AP . $_SESSION[user]['login'] . AP . " LIMIT 1;");
        echo "<script>parent.jAlert('Получили достижение.');</script>";
    }
}


