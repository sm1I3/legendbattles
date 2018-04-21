<?php
$_POST['fileid'] = varcheck($_POST['fileid']);
function NickName_by_ID($id)
{
    return $GLOBALS['DBlink']->query("SELECT `login`,`dd`,`baks` FROM `user` WHERE `id`= ?", array($id))->fetchColumn(0);
}

if ($_GET['reject']) {
    $check = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT `user`.`login`,`user`.`id`,`user`.`baks` FROM `user` WHERE `id`='" . chars($_POST['userid']) . "' LIMIT 1;"));
    if ($check['id']) {
        mysqli_query($GLOBALS['db_link'], "UPDATE `FilesUpload` SET `Status`='Invalid' WHERE `Status`='Wite' AND `user`='" . $check['id'] . "' AND `FileName`='" . $_POST['fileid'] . "' LIMIT 1;");
    }
}
if ($_GET['accept'] and $_POST['userid'] and $_POST['fileid']) {
    $check = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT `user`.`login`,`user`.`id`,`user`.`baks` FROM `user` WHERE `id`='" . chars($_POST['userid']) . "' LIMIT 1;"));
    if ($check['id']) {
        mysqli_query($GLOBALS['db_link'], "UPDATE `FilesUpload` SET `Status`='Valid' WHERE `Status`='Wite' AND `user`='" . $check['id'] . "' AND `FileName`='" . $_POST['fileid'] . "' LIMIT 1;");
    }
}
if ($_GET['delete'] and $_POST['userid'] and $_POST['fileid']) {
    $check = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'], "SELECT `user`.`login`,`user`.`id`,`user`.`baks` FROM `user` WHERE `id`='" . chars($_POST['userid']) . "' LIMIT 1;"));
    if ($check['id']) {
        mysqli_query($GLOBALS['db_link'], "DELETE FROM `FilesUpload` WHERE `Status`='Invalid' AND `user`='" . $check['id'] . "' AND `FileName`='" . $_POST['fileid'] . "' LIMIT 1;");
    }
}
echo '
<br>
<font class=proce><font color=#222222>
<FIELDSET>
  <table cellpadding=0 cellspacing=0 border=0 width=100%>
    <tr>
      <td align=center><font class=nickname2 style="color:#336699">
        <table cellpadding=0 cellspacing=0 border=0 width=100% bgcolor=#e0e0e0>
          <tr>
            <td>
              <table cellpadding=1 cellspacing=1 border=0 width=100%>
                <tr>
                  <td bgcolor=#' . (($_GET['cat'] == '1') ? 'FFFFFF' : 'F0F0F0') . ' width=33%>
                    <div align="center">
                      <a href="?d_swi=1000&cat=1" class="nickname"><font class="nickname"><b>Новые Образы</b></font></a>
                    </div>
                  </td>
                  <td bgcolor=#' . (($_GET['cat'] == '2') ? 'FFFFFF' : 'F0F0F0') . ' width=33%>
                    <div align="center">
                      <a href="?d_swi=1000&cat=2" class="nickname"><font class="nickname"><b>Одобренные</b></font></a>
                    </div>
                  </td>
                  <td bgcolor=#' . (($_GET['cat'] == '3') ? 'FFFFFF' : 'F0F0F0') . ' width=33%>
                    <div align="center">
                      <a href="?d_swi=1000&cat=3" class="nickname"><font class="nickname"><b>Отказаные</b></font></a>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td bgcolor=#ffffff width=100% colspan=3><font class=nickname2 style="color:#336699">';
switch ($_GET['cat']) {
    case'1':
        $Query = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `FilesUpload` WHERE `Status`='Wite'");
        echo '<table cellpadding=1 cellspacing=1 border=0 width=100% bgcolor=#e0e0e0>';
        $count = mysqli_num_rows($Query);
        for ($i = 0; $i < ($count / 4); $i++) {
            echo '<tr>';
            for ($j = 0; $j < 4; $j++) {
                $row = mysqli_fetch_assoc($Query);
                echo '<td width=25% align=center class=nickname2 bgcolor=#FFFFFF>' . (($row['FileName']) ? '<img src="http://img.legendbattles.ru/image/obrazy/' . $row['FileName'] . '" title="Size:' . $row['FileX'] . 'x' . $row['FileY'] . '">
									<br />Загрузил: <b>' . NickName_by_ID($row['user']) . '</b><br />Размер: <b>' . round($row['FileSize'] / 1024, 2) . '</b> кб.<br />
									Дата: <b title="' . date("H:i:s", $row['date']) . '">' . date("d:m:Y", $row['date']) . '</b>
									<br><font class=weaponchart><form method=post action="main.php?d_swi=1000&accept=1&cat=1">
										<input type=submit class=weaponchart value="Одобрить">
										<input type=hidden name="userid" value="' . $row['user'] . '">
										<input type=hidden name="fileid" value="' . $row['FileName'] . '">
									</form></font>
									<br><font class=proce><form method=post action="main.php?d_swi=1000&reject=1&cat=1">
										<input type=submit class=proce value="Отклонить">
										<input type=hidden name="userid" value="' . $row['user'] . '">
										<input type=hidden name="fileid" value="' . $row['FileName'] . '">
									</form></font>' : '&nbsp;') . '
									</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
        break;
    case'2':
        $Query = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `FilesUpload` WHERE `Status`='Valid'");
        echo '<table cellpadding=1 cellspacing=1 border=0 width=100% bgcolor=#e0e0e0>';
        $count = mysqli_num_rows($Query);
        for ($i = 0; $i < ($count / 4); $i++) {
            echo '<tr>';
            for ($j = 0; $j < 4; $j++) {
                $row = mysqli_fetch_assoc($Query);
                echo '<td width=25% align=center class=nickname2 bgcolor=#FFFFFF>' . (($row['FileName']) ? '<img src="http://img.legendbattles.ru/image/obrazy/' . $row['FileName'] . '" title="Size:' . $row['FileX'] . 'x' . $row['FileY'] . '">
									<br />Загрузил: <b>' . NickName_by_ID($row['user']) . '</b><br />Размер: <b>' . round($row['FileSize'] / 1024, 2) . '</b> кб.<br />
									Дата: <b title="' . date("H:i:s", $row['date']) . '">' . date("d:m:Y", $row['date']) . '</b>' : '&nbsp;') . '
									</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
        break;
    case'3':
        $Query = mysqli_query($GLOBALS['db_link'], "SELECT * FROM `FilesUpload` WHERE `Status`='Invalid'");
        echo '<table cellpadding=1 cellspacing=1 border=0 width=100% bgcolor=#e0e0e0>';
        $count = mysqli_num_rows($Query);
        for ($i = 0; $i < ($count / 4); $i++) {
            echo '<tr>';
            for ($j = 0; $j < 4; $j++) {
                $row = mysqli_fetch_assoc($Query);
                echo '<td width=25% align=center class=nickname2 bgcolor=#FFFFFF>' . (($row['FileName']) ? '<img src="http://img.legendbattles.ru/image/obrazy/' . $row['FileName'] . '" title="Size:' . $row['FileX'] . 'x' . $row['FileY'] . '">
									<br />Загрузил: <b>' . NickName_by_ID($row['user']) . '</b><br />Размер: <b>' . round($row['FileSize'] / 1024, 2) . '</b> кб.<br />
									Дата: <b title="' . date("H:i:s", $row['date']) . '">' . date("d:m:Y", $row['date']) . '</b>
									<br><font class=weaponchart><form method=post action="main.php?d_swi=1000&delete=1&cat=3">
										<input type=submit class=proce value="УДАЛИТЬ">
										<input type=hidden name="userid" value="' . $row['user'] . '">
										<input type=hidden name="fileid" value="' . $row['FileName'] . '">
									</form></font>									
									' : '&nbsp;') . '
									</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
        break;
    default:
        echo '<center><br />Выберите раздел<br /><br /></center>';
        break;
}
echo '</font></td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </font></td>
    </tr>
  </table>
</FIELDSET>
<br>';

