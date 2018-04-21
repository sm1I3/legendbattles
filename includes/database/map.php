<?php
if(accesses($pers['id'],'out')){
    list($pers['y'], $pers['x']) = explode('_', $pers['pos']);
if(!empty($_GET['x']) and !empty($_GET['y'])){
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `pos`='".$_GET['x']."_".$_GET['y']."' WHERE `id`='".$pers['id']."'");
$pers['x']=$_GET['x'];
$pers['y']=$_GET['y'];
}
if(!empty($_POST['ProffForm'])){
	mysqli_query($GLOBALS['db_link'],"UPDATE `nature` SET `quest`='".intval($_POST['que'])."',`build`='".intval($_POST['bld'])."',`drink`='".intval($_POST['dri'])."' WHERE `x`='".$pers['x']."' AND `y`='".$pers['y']."'");
}
if(!empty($_POST['BotsForm'])){
	mysqli_query($GLOBALS['db_link'],"UPDATE `nature` SET `BotTypes`='".intval($_POST['bots'])."' WHERE `x`='".$pers['x']."' AND `y`='".$pers['y']."'");
}

if(($_GET['locc']) or ($_POST["locc"])){
    mysqli_query($GLOBALS['db_link'], "INSERT INTO `nature` (`x`,`y`,`city`,`name`) VALUES ('" . $pers['x'] . "','" . $pers['y'] . "','Окрестности Фатерса','Природа');");
}

if($_POST['wood']){
    echo $_POST['wood'];
    if ($_POST['wood'] == 4) $_POST['wood'] = 0;
	mysqli_query($GLOBALS['db_link'],"UPDATE `nature` SET `wood`='".intval($_POST['wood'])."' WHERE `x`='".$pers['x']."' AND `y`='".$pers['y']."'");
}

$loc_editor=mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `nature` WHERE `x`='".$pers['x']."' and `y`='".$pers['y']."'"));
?>
<script src="/js/mapeditor.js"></script>
<script language="JavaScript">
var dataedit = [<?php echo $pers['x']; ?>,<?php echo $pers['y']; ?>,"<?php echo $loc_editor['name']; ?>",<?php echo $loc_editor['dep']?$loc_editor['dep']:'0'; ?>,<?php echo $loc_editor['x']?'1':'0'; ?>];
var goto = [<?php
$query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `loc` WHERE `id`!='28'");
while ($row = mysqli_fetch_array($query)) {
	$roll.='['.$row['id'].',"'.$row['city'].'['.$row['loc'].' '.$row['room'].']"],';
}
echo substr($roll,0,strlen($roll)-1);
?>];
var map = [<?php
$map = '';
for($y=($pers['y']-5);$y<=($pers['y']+5);$y++){
	for($x=($pers['x']-5);$x<=($pers['x']+5);$x++){
		$location = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `nature` WHERE `x`='".$x."' and `y`='".$y."'"));
		if(!empty($location['x']) and !empty($location['y'])){
			$map .= '['.$location['x'].','.$location['y'].'],';
		}
	}
}
echo substr($map,0,strlen($map)-1);
 ?>];
</script>
<table width="100%" cellpadding="0" cellspacing="0" border="1">

      <form method="post">
        <tr>
            <td width="100%">ЛОКАЦИЯ:</td>
            <td><select name="locc">
                    <option<?php echo((!$loc_editor['name']) ? ' selected="selected"' : ''); ?> value="0">Нет</option>
                    <option<?php echo(($loc_editor['name']) ? ' selected="selected"' : ''); ?> value="1">ДА</option>
            </select></td>
          </tr>
                  <tr>
            <td colspan="2" align="center"><input name="locc" type="submit" value="LOC SAVE" /></td>
          </tr>
          </form>

  <tr>
    <td width="200" valign="top"><script>MapSmall();</script>
      <hr />
      <form method="post">
        <table border="1" width="100%">
          <tr>
              <td width="100%">Тип ботов:</td>
            <td><select name="bots">
                    <option<?php echo(($loc_editor['BotTypes'] == 0) ? ' selected="selected"' : ''); ?> value="0">Нет
                        Ботов
                    </option>
                    <option<?php echo(($loc_editor['BotTypes'] == 1) ? ' selected="selected"' : ''); ?> value="1">
                        Слабые
                    </option>
                    <option<?php echo(($loc_editor['BotTypes'] == 2) ? ' selected="selected"' : ''); ?> value="2">
                        Средние
                    </option>
                    <option<?php echo(($loc_editor['BotTypes'] == 3) ? ' selected="selected"' : ''); ?> value="3">
                        Сильные
                    </option>
            </select></td>
          </tr>


        <tr>
            <td width="100%">ДЕРЕВЬЯ:</td>

            <td><select name="wood">
                    <option<?php echo(($loc_editor['wood'] == 0) ? ' selected="selected"' : ''); ?> value="4">Нет
                    </option>
                    <option<?php echo(($loc_editor['wood'] == 1) ? ' selected="selected"' : ''); ?> value="1">ТИП 1
                    </option>
                    <option<?php echo(($loc_editor['wood'] == 2) ? ' selected="selected"' : ''); ?> value="2">ТИП 2
                    </option>
                    <option<?php echo(($loc_editor['wood'] == 3) ? ' selected="selected"' : ''); ?> value="3">ТИП 3
                    </option>
            </select></td>
          </tr>

          <tr>
              <td colspan="2" align="center"><input name="BotsForm" type="submit" value="Сохранить"/></td>
          </tr>
        </table>
      </form>


    <hr />
      <form method="post">
        <table border="1" width="100%">
          <tr>
              <td width="100%">Квесты:</td>
            <td><select name="que">
                    <option<?php echo(($loc_editor['quest']) ? ' selected="selected"' : ''); ?> value="1"
                                                                                                style="background:#0F0">
                        да
                    </option>
                    <option<?php echo(($loc_editor['quest']) ? '' : ' selected="selected"'); ?> value="0"
                                                                                                style="background:#F00">
                        нет
                    </option>
            </select></td>
          </tr>
          <tr>
              <td>Строительство:</td>
            <td><select name="bld">
                    <option<?php echo(($loc_editor['build']) ? ' selected="selected"' : ''); ?> value="1"
                                                                                                style="background:#0F0">
                        да
                    </option>
                    <option<?php echo(($loc_editor['build']) ? '' : ' selected="selected"'); ?> value="0"
                                                                                                style="background:#F00">
                        нет
                    </option>
            </select></td>
          </tr>
          <tr>
              <td>Питье:</td>
            <td><select name="dri">
                    <option<?php echo(($loc_editor['drink']) ? ' selected="selected"' : ''); ?> value="1"
                                                                                                style="background:#0F0">
                        да
                    </option>
                    <option<?php echo(($loc_editor['drink']) ? '' : ' selected="selected"'); ?> value="0"
                                                                                                style="background:#F00">
                        нет
                    </option>
            </select></td>
          </tr>
          <tr>
              <td colspan="2" align="center"><input name="ProffForm" type="submit" value="Сохранить"/></td>
          </tr>
        </table>
      </form>
</td>
    <td align="center"><script>view_map();</script></td>
      <td width="200" valign="top" align="center"><a href="javascript:MoveTo();">Позиция<br/>
      X:<?php echo $pers['x']; ?> Y:<?php echo $pers['y']; ?></a>
      <hr />
          <a href="javascript:LocName();" id="LocName_text">Локция: <?php echo $loc_editor['name']; ?></a>
      <hr />
          <a href="javascript:GoTo();" id="GoTo_text">Вход:
        <?php
	  if($loc_editor['dep']){
		  $locname = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `loc` WHERE `id`='".$loc_editor['dep']."'"));
		  echo '<br>'.$locname['city'].'<br>['.$locname['loc']?$locname['loc']:$locname['loc'].'-'.$locname['room'].']';
	  }else{
          echo 'Никуда';
	  }?>
      </a></td>
  </tr>
</table>
<?php
}else{
    echo "<center><b>Нет Доступа</b></center>";
}
?>
