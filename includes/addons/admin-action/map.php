<?php
if(accesses($pers['id'],'out')){
    list($pers['y'], $pers['x']) = explode('_', $pers['pos']);
if($_GET['x']!='' and $_GET['y']!=''){
	mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `pos`='".$_GET['x']."_".$_GET['y']."' WHERE `id`='".$pers['id']."'");
	$pers['x']=$_GET['x'];
	$pers['y']=$_GET['y'];
}
if(!empty($_POST['ProffForm'])){
	mysqli_query($GLOBALS['db_link'],"UPDATE `nature` SET `que`='".intval($_POST['que'])."',`ogl`='".intval($_POST['ogl'])."',`fis`='".intval($_POST['fis'])."',`dri`='".intval($_POST['dri'])."',`les`='".intval($_POST['les'])."' WHERE `x`='".$pers['x']."' AND `y`='".$pers['y']."'");
}
$loc_editor=mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `nature` WHERE `x`='".$pers['x']."' and `y`='".$pers['y']."'"));
?>
<script src="/js/mapeditor.js"></script>
<SCRIPT src="/js/v1_tooltip.js"></SCRIPT>
<script language="JavaScript">
var dataedit = [<?php echo $pers['x']; ?>,<?php echo $pers['y']; ?>,"<?php echo $loc_editor['name']; ?>",<?php echo $loc_editor['dep']?$loc_editor['dep']:'0'; ?>,<?php echo $loc_editor['x']?'1':'0'; ?>];
var goto = [<?php
$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `loc` WHERE `id`!='28'");
while ($row = mysqli_fetch_array($query)) {
	$roll.='['.$row['id'].',"'.$row['city'].'['.$row['loc'].' '.$row['room'].']"],';
}
echo substr($roll,0,strlen($roll)-1);
?>];
var teleto = [<?php
$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `nature` ORDER BY `x`,`y`");
while ($row = mysqli_fetch_array($query)) {
	$teleroll.='["'.$row['x'].'_'.$row['y'].'","'.$row['city'].'-'.$row['name'].'['.$row['x'].'_'.$row['y'].']"],';
}
echo substr($teleroll,0,strlen($teleroll)-1);
?>];
var map = [<?php 
$map = '';
for($y=($pers['y']-5);$y<=($pers['y']+5);$y++){
	for($x=($pers['x']-5);$x<=($pers['x']+5);$x++){
		$location = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `nature` WHERE `x`='".$x."' and `y`='".$y."'"));
		if($location['x']!='' and $location['y']!=''){
			$map .= '['.$location['x'].','.$location['y'].'],';
		}
	}
}
if(!empty($_POST['BotsForm'])){
	mysqli_query($GLOBALS['db_link'],"UPDATE `nature` SET `BotTypes`='".intval($_POST['bots'])."' WHERE `x`='".$pers['x']."' AND `y`='".$pers['y']."'");
}
echo substr($map,0,strlen($map)-1);
 ?>];
</script>
<table width="100%" cellpadding="0" cellspacing="0" border="1">
  <tr>
    <td width="200" valign="top"><script>MapSmall();</script>
      <hr />
      <table border="1" width="100%">
        <?php
	$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `nature_bots` WHERE `x`='".$pers['x']."' AND `y`='".$pers['y']."'");
	while ($row = mysqli_fetch_assoc($query)) {
        echo '<tr><td align="center" title="Редактировать"><a href="javascript:EditBots(\'Edit\',\'' . $row['lvlmin'] . '|' . $row['lvlmax'] . '\');">E</a></td><td align=center>Боты<br>[<b>' . $row['lvlmin'] . '-' . $row['lvlmax'] . '</b>]</td><td align="center" title="Удалить"><a href="javascript: if(confirm(\'Вы действительно хотите удалить бота?\')) { AjaxGet(\'mapeditor_ajax.php?act=BotDelete&x=' . $pers['x'] . '&y=' . $pers['y'] . '\'); }">X</a></td>';
	}
	if(mysqli_num_rows($query)<1){
        echo '<tr><td align="center" colspan="3"><a href="javascript:EditBots(\'Add\');">Добавить ботов</a></td></tr>';
	}
	if(!empty($_POST['BotsGroup'])){
	mysqli_query($GLOBALS['db_link'],"UPDATE `nature_bots` SET `group`='".intval($_POST['group'])."' WHERE `x`='".$pers['x']."' AND `y`='".$pers['y']."'");
}
        //трава
	$gquery = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `nature_grass` WHERE `x`='".$pers['x']."' AND `y`='".$pers['y']."'");
	$basegrass = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE `type`='w66' AND `slot`='0';");
	$gparam="";
	$gcol=0;
	while($row = mysqli_fetch_assoc($basegrass)){
		$gid.=$row['id']."|";
		$gname.=$row['name']."|";
		$gcol++;		
	}
	$gid=substr($gid,0,strlen($gid)-1);
	$gname=substr($gname,0,strlen($gname)-1);
	while ($row = mysqli_fetch_assoc($gquery)) {
		$grass=explode("|",$row['grass']);
		$list="";
		$listnames="";
		foreach($grass as $val){
			$gr=explode("@",$val);
			$list=mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT `items`.`name` FROM `items` WHERE `id`='".$gr[0]."' LIMIT 1"));
            $listnames .= $list['name'] . " (" . $gr[1] . " мин)<br>";
        }
        echo '<tr><td align="center" title="Редактировать"><a href="javascript:EditGrass(\'Add\',\'' . $gid . '\',\'' . $gname . '\',\'' . $gcol . '\');">E</a></td><td align=center><b>Трава</b><br>' . $listnames . '</td><td align="center" title="Удалить"><a href="javascript: if(confirm(\'Вы действительно хотите удалить траву?\')) { AjaxGet(\'mapeditor_ajax.php?act=GrassDelete&x=' . $pers['x'] . '&y=' . $pers['y'] . '\'); }">X</a></td>';
	}
	if(mysqli_num_rows($gquery)<1){
        echo '<tr><td align="center" colspan="3"><a href="javascript:EditGrass(\'Add\',\'' . $gid . '\',\'' . $gname . '\',\'' . $gcol . '\');">Добавить траву</a></td></tr>';
    }
        //лес
	$lquery = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `nature_les` WHERE `x`='".$pers['x']."' AND `y`='".$pers['y']."'");
	$baseles = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE `type`='w68'  AND `slot`='0' AND `num_a`='';");
	$lparam="";
	$lcol=0;
	$lid="";
	$lname="";
	while($row = mysqli_fetch_assoc($baseles)){
		$lid.=$row['id']."|";
		$lname.=$row['name']."|";
		$lcol++;		
	}
	$lid=substr($lid,0,strlen($lid)-1);
	$lname=substr($lname,0,strlen($lname)-1);
	while ($row = mysqli_fetch_assoc($lquery)) {
		$grass=explode("|",$row['grass']);
		$list="";
		$listnames="";
		foreach($grass as $val){
			$gr=explode("@",$val);
			$list=mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT `items`.`name` FROM `items` WHERE `id`='".$gr[0]."' LIMIT 1"));
            $listnames .= $list['name'] . " (" . $gr[1] . " мин)<br>";
        }
        echo '<tr><td align="center" title="Редактировать"><a href="javascript:EditLes(\'Add\',\'' . $lid . '\',\'' . $lname . '\',\'' . $lcol . '\');">E</a></td><td align=center><b>Лес</b><br>' . $listnames . '</td><td align="center" title="Удалить"><a href="javascript: if(confirm(\'Вы действительно хотите удалить лес?\')) { AjaxGet(\'mapeditor_ajax.php?act=LesDelete&x=' . $pers['x'] . '&y=' . $pers['y'] . '\'); }">X</a></td>';
	}
	if(mysqli_num_rows($lquery)<1){
        echo '<tr><td align="center" colspan="3"><a href="javascript:EditLes(\'Add\',\'' . $lid . '\',\'' . $lname . '\',\'' . $lcol . '\');">Добавить лес</a></td></tr>';
    }
        //рыбалка
	$lquery = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `nature_fish` WHERE `x`='".$pers['x']."' AND `y`='".$pers['y']."'");
	$baseles = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE `type`='w69'  AND `slot`='0' AND `num_a`='';");
	$lparam="";
	$lcol=0;
	$lid="";
	$lname="";
	while($row = mysqli_fetch_assoc($baseles)){
		$lid.=$row['id']."|";
		$lname.=$row['name']."|";
		$lcol++;		
	}
	$lid=substr($lid,0,strlen($lid)-1);
	$lname=substr($lname,0,strlen($lname)-1);
	while ($row = mysqli_fetch_assoc($lquery)) {
		$grass=explode("|",$row['grass']);
		$list="";
		$listnames="";
		foreach($grass as $val){
			$gr=explode("@",$val);
			$list=mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT `items`.`name` FROM `items` WHERE `id`='".$gr[0]."' LIMIT 1;"));
            $listnames .= $list['name'] . " (" . $gr[1] . " умения)<br>";
        }
        echo '<tr><td align="center" title="Редактировать"><a href="javascript:EditFish(\'Add\',\'' . $lid . '\',\'' . $lname . '\',\'' . $lcol . '\');">E</a></td><td align=center><b>Рыбалка</b><br>' . $listnames . '</td><td align="center" title="Удалить"><a href="javascript: if(confirm(\'Вы действительно хотите удалить рыбу?\')) { AjaxGet(\'mapeditor_ajax.php?act=FishDelete&x=' . $pers['x'] . '&y=' . $pers['y'] . '\'); }">X</a></td>';
	}
	if(mysqli_num_rows($lquery)<1){
        echo '<tr><td align="center" colspan="3"><a href="javascript:EditFish(\'Add\',\'' . $lid . '\',\'' . $lname . '\',\'' . $lcol . '\');">Добавить рыбу</a></td></tr>';
	}
	?>
      </table>
      <hr />
      <form method="post">
        <table border="1" width="100%">
          <tr>
              <td width="100%">Квесты:</td>
            <td><select name="que">
                    <option<?php echo(($loc_editor['que']) ? ' selected="selected"' : ''); ?> value="1"
                                                                                              style="background:#0F0">да
                    </option>
                    <option<?php echo(($loc_editor['que']) ? '' : ' selected="selected"'); ?> value="0"
                                                                                              style="background:#F00">
                        нет
                    </option>
            </select></td>
          </tr>
          <tr>
              <td>Алхимия:</td>
            <td><select name="ogl">
                    <option<?php echo(($loc_editor['ogl']) ? ' selected="selected"' : ''); ?> value="1"
                                                                                              style="background:#0F0">да
                    </option>
                    <option<?php echo(($loc_editor['ogl']) ? '' : ' selected="selected"'); ?> value="0"
                                                                                              style="background:#F00">
                        нет
                    </option>
            </select></td>
          </tr>
          <tr>
              <td>Рыбалка:</td>
            <td><select name="fis">
                    <option<?php echo(($loc_editor['fis']) ? ' selected="selected"' : ''); ?> value="1"
                                                                                              style="background:#0F0">да
                    </option>
                    <option<?php echo(($loc_editor['fis']) ? '' : ' selected="selected"'); ?> value="0"
                                                                                              style="background:#F00">
                        нет
                    </option>
            </select></td>
          </tr>
          <tr>
              <td>Питье:</td>
            <td><select name="dri">
                    <option<?php echo(($loc_editor['dri']) ? ' selected="selected"' : ''); ?> value="1"
                                                                                              style="background:#0F0">да
                    </option>
                    <option<?php echo(($loc_editor['dri']) ? '' : ' selected="selected"'); ?> value="0"
                                                                                              style="background:#F00">
                        нет
                    </option>
            </select></td>
          </tr>
		  <tr>
              <td>Лесоруб:</td>
            <td><select name="les">
                    <option<?php echo(($loc_editor['les']) ? ' selected="selected"' : ''); ?> value="1"
                                                                                              style="background:#0F0">да
                    </option>
                    <option<?php echo(($loc_editor['les']) ? '' : ' selected="selected"'); ?> value="0"
                                                                                              style="background:#F00">
                        нет
                    </option>
            </select></td>
          </tr>
		  <tr>
              <td>Строения:</td>
            <td><select name="bld">
                    <option<?php echo(($loc_editor['bld']) ? ' selected="selected"' : ''); ?> value="1"
                                                                                              style="background:#0F0">да
                    </option>
                    <option<?php echo(($loc_editor['bld']) ? '' : ' selected="selected"'); ?> value="0"
                                                                                              style="background:#F00">
                        нет
                    </option>
            </select></td>
          </tr>
          <tr>
              <td colspan="2" align="center"><input name="ProffForm" type="submit" value="Сохранить"/></td>
          </tr>
        </table>
      </form></td>
    <td align="center"><script>view_map();</script></td>
      <td width="200" valign="top" align="center"><a href="javascript:MoveTo();">Позиция<br/>
      X:<?php echo $pers['x']; ?> Y:<?php echo $pers['y']; ?></a>
      <hr />
          <a href="javascript:LocName();" id="LocName_text">Локация: <?php echo $loc_editor['name']; ?></a>
      <hr />
          <a href="javascript:LocConfig();"
             id="LocName_text">Клетка: <?php echo($loc_editor['name'] ? 'Доступная для перехода' : 'Недоступная для перехода'); ?></a>
      <hr />
          <a href="javascript:GoTo();" id="GoTo_text">Вход:
        <?php 
	  if($loc_editor['dep']){
		  $locname = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `loc` WHERE `id`='".$loc_editor['dep']."'"));
		  echo '<br>'.$locname['city'].'<br>['.$locname['loc']?$locname['loc']:$locname['loc'].'-'.$locname['room'].']';
	  }else{
          echo 'Никуда';
	  }?>
	  <hr />
              <a href="javascript:TeleTo();" id="TeleTo_text">Телепорт:
	  <?php 
	  if($loc_editor['tele_coord']){
          list($tele['y'], $tele['x']) = explode('_', $loc_editor['tele_coord']);
		  $locname = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `nature` WHERE `x`='".$tele['x']."' AND `y`='".$tele['y']."' LIMIT 1;"));
		  echo '<br>'.$locname['city'].'<br>['.($locname['name']?$locname['name']:'').']';
	  }else{
          echo 'Никуда';
	  }?>
      </a></td>
  </tr>
</table>
	  <form method="post">
        <table border="1" width="100%">
          <tr>
              <td width="100%">Создать бота на клетке(не использовать если на клетке уже есть боты):</td>
            <td><select name="new_bot">
                    <option<?php echo(($bot_editor['group'] == 0) ? ' selected="selected"' : ''); ?> value="0">Нет
                        ботов(не выбирать)
                    </option>
                    <option<?php echo(($bot_editor['group'] == 1) ? ' selected="selected"' : ''); ?> value="1">Зомби
                        8-12
                    </option>
            </select></td>
          </tr>
          <tr>
              <td colspan="2" align="center"><input name="MakeBot" type="submit" value="Сохранить"/></td>
          </tr>
        </table>
      </form>
	  
	       <form method="post">
        <table border="1" width="100%">
          <tr>
              <td width="100%">Группа ботов(только для смены группы а не установки новой):</td>
            <td><select name="group">
                    <option<?php echo(($bot_editor['group'] == 0) ? ' selected="selected"' : ''); ?> value="0">Нет
                        ботов(не выбирать)
                    </option>
                    <option<?php echo(($bot_editor['group'] == 1) ? ' selected="selected"' : ''); ?> value="1">Зомби
                        8-12
                    </option>
            </select></td>
          </tr>
          <tr>
              <td colspan="2" align="center"><input name="BotsGroup" type="submit" value="Сохранить"/></td>
          </tr>
		  <tr>
          </tr>
        </table>
      </form>

<form method="post">
        <table border="1" width="100%">
		  <tr>
              <td colspan="2" align="center"><input name="BotDelete" type="submit" value="Удалить ботов с клетки"/></td>
          </tr>
        </table>
      </form>
<?php
}
?>
