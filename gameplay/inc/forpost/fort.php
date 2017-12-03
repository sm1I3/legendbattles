<?php
list($player['x'], $player['y']) = explode('_', $player['pos']);
$Fort = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `forts` WHERE `x`='".$player['x']."' and `y`='".$player['y']."'"));
if(!isset($_GET['addid'])){
	$_GET['addid'] = 1;
}
if(!empty($_POST)){
	switch($_POST['cat']){
		case'1':
			$PortalsArray = array(
				1=>array("8","4","10"),
				2=>array("111","12","10"),
				3=>array("121","16","100"),
				4=>array("102","12","100")
			);
			if($Fort['clan'] == $player['clan_id']){
				$teleport_capacity = explode('/',$Fort['teleport']);
				if(isset($PortalsArray[$_POST['target']][0])){
					if($player['nv'] >= $PortalsArray[$_POST['target']][2]){
						if($teleport_capacity[0] > 0){
							mysqli_query($GLOBALS['db_link'],"UPDATE `forts` SET `teleport`='".($teleport_capacity[0]-1)."/".($teleport_capacity[1])."' WHERE `id`='".$Fort['id']."'");
							mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `pos`='".$PortalsArray[$_POST['target']][0]."_".$PortalsArray[$_POST['target']][1]."',`loc`='28',`nv`=`nv`-'".$PortalsArray[$_POST['target']][2]."' WHERE `id`='".$player['id']."'");
							echo"<script>window.location='/core2.php';</script>";
						}
					}
				}
			}
		break;
		case'2':

		break;
		case'3':
			$BlessArray = array(
				1=>array("0.85","0.7",""),
				2=>array("0.85","0.7",""),
				3=>array("0.95","0.9",""),
				4=>array("0.9","0.8","")
			);
			if($Fort['clan'] == $player['clan_id']){
				$bless_capacity = explode('/',$Fort['bless']);
				$level = (($bless_capacity['1']>7) ? '1' : '0' );
				if(isset($BlessArray[$_POST['bless']][$level])){
					if($bless_capacity[0] > 0){
						if($player['bless'] == ''){
							$Fort['bless'] = ($bless_capacity[0]-1)."/".($bless_capacity[1]);
							mysqli_query($GLOBALS['db_link'],"UPDATE `forts` SET `bless`='".$Fort['bless']."' WHERE `id`='".$Fort['id']."'");
							mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `bless`='".$_POST['bless']."/".$BlessArray[$_POST['bless']][$level]."/".(time()+18000)."' WHERE `id`='".$player['id']."'");
						}
					}
				}
			}
		break;
		case'4':
			
		break;
		case'5':
			if($_POST['storm_process'] && time() < $Fort['storm_stamp']+3600 && time() < $Fort['storm_stamp']){
				if($player['fort_storm'] == '0'){
					if($Fort['clan'] == $player['clan_id']){
						mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `fort_storm`='2' WHERE `id`='".$player['id']."'");
					}else{
						if($player['nv'] >= 100){
							mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `fort_storm`='1',`nv`=`nv`-'100' WHERE `id`='".$player['id']."'");
						}
					}
				}
			}
		break;
	}
}
?>
<table width="90%" cellpadding="10" cellspacing="0" align="center">
  <tr>
    <td><table width="100%" cellpadding="0" cellspacing="2">
      <tr>
        <td bgcolor="#cccccc"><table cellpadding="1" cellspacing="1" width="100%" border="0">
          <tr>
            <td bgcolor="#<?php echo (($_GET['addid']==1)?'FFFFFF':'F0F0F0'); ?>" width="20%"><div align="center"><a href="?addid=1" class="nickname"><font class=nickname><b>Порталы</b></font></a></div></td>
            <td bgcolor="#<?php echo (($_GET['addid']==2)?'FFFFFF':'F0F0F0'); ?>" width="20%"><div align="center"><a href="#?addid=2" class="nickname"><font class=nickname><b>Обмен ресурсов</b></font></a></div></td>
            <td bgcolor="#<?php echo (($_GET['addid']==3)?'FFFFFF':'F0F0F0'); ?>" width="20%"><div align="center"><a href="?addid=3" class="nickname"><font class=nickname><b>Благословения</b></font></a></div></td>
            <td bgcolor="#<?php echo (($_GET['addid']==4)?'FFFFFF':'F0F0F0'); ?>" width="20%"><div align="center"><a href="#?addid=4" class="nickname"><font class=nickname><b>Лавка</b></font></a></div></td>
            <td bgcolor="#<?php echo (($_GET['addid']==5)?'FFFFFF':'F0F0F0'); ?>" width="20%"><div align="center"><a href="?addid=5" class="nickname"><font class=nickname><b>Штурм</b></font></a></div></td>
          </tr>
        </table>
<?php
if($player['clan_id'] == $Fort['clan']){
?>
        <table cellpadding="1" cellspacing="1" width="100%" border="0">
          <tr>
            <td bgcolor="#<?php echo (($_GET['addid']==6)?'FFFFFF':'F0F0F0'); ?>" width="50%"><div align="center"><a href="?addid=6" class="nickname"><font class=nickname><b>Настройки штурма</b></font></a></div></td>
            <td bgcolor="#<?php echo (($_GET['addid']==7)?'FFFFFF':'F0F0F0'); ?>" width="50%"><div align="center"><a href="?addid=7" class="nickname"><font class=nickname><b>Настройки услуг</b></font></a></div></td>
          </tr>
        </table>
<?php
}
?></td>
      </tr>
      <tr>
        <td bgcolor="#cccccc"><table cellpadding="1" cellspacing="1" width="100%" border="0">
          <tr>
            <td bgcolor="#FFFFFF" width="100%">
              <center><font class=nickname>Островной Форт под контролем клана <b><?php echo $Fort['clan']; ?></b></font></center>
            </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" cellpadding="1" cellspacing="0">
          <tr>
            <td bgcolor="#CCCCCC"><table width="100%" cellpadding="5" cellspacing="0">
              <tr>
                <td bgcolor="#FFFFFF"><font class=nickname><?php 
				if(is_file($_SERVER["DOCUMENT_ROOT"]."/inc/forpost/fort/".preg_replace('/[^a-zA-Z0-9]/','',$_GET['addid']).".php")){
					include($_SERVER["DOCUMENT_ROOT"]."/inc/forpost/fort/".preg_replace('/[^a-zA-Z0-9]/','',$_GET['addid']).".php");
				}
				?></font></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
