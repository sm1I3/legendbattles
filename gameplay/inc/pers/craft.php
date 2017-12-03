<?php
			echo'<style>
.collection-ico{
	display: inline-block;
	height: 75px;
	vertical-align: middle;
	font-weight: bold;
	font-size: 40px;
}
.category{
	float:left;
	padding: 0 5px 0 0;
	text-align:center;
}
</style><script type="text/javascript" language="javascript" src="/js/itemsInfo.js"></script><table cellpadding="5" cellspacing="1" border="0" width="100%"><tr><td>';
			$ArrayCombins = array(
					array(// Вещь 22
					'items'=>array(
						array('3999','8'),
						array('4000','2'),
						array('4001','2'),
						array('4002','2'),
						array('4003','1'),
						array('4004','1'),
						array('4006','50'),
						array('3998','1'),
					),
					'result'=>'4005' // ИД вещи
				),
					array(// Вещь 21
					'items'=>array(
						array('3946','8'),
						array('3947','2'),
						array('3948','2'),
						array('3949','2'),
						array('3950','1'),
						array('3951','1'),
						array('3958','1')
					),
					'result'=>'3961' // ИД вещи
				),
					array(// Вещь 20
					'items'=>array(
						array('3946','8'),
						array('3947','2'),
						array('3948','2'),
						array('3949','2'),
						array('3950','1'),
						array('3951','1'),
						array('3945','1')
					),
					'result'=>'3952' // ИД вещи
				),
				array(// Вещь 1
					'items'=>array(
						array('3099','10'),
						array('3101','5'),
						array('3098','3'),
						array('3100','3'),
						array('3103','3'),
						array('3102','2'),
						array('','')
					),
					'result'=>'3104' // ИД вещи
				),
				array(// Вещь 2
					'items'=>array(
						array('3099','10'),
						array('3101','5'),
						array('3098','3'),
						array('3100','3'),
						array('3103','3'),
						array('3102','2'),
						array('','')
					),
					'result'=>'3123' // ИД вещи
				),
				array(// Вещь 3
					'items'=>array(
						array('2893','15'),
						array('2894','7'),
						array('2895','6'),
						array('2896','6'),
						array('2897','3'),
						array('2898','3'),
						array('','')
					),
					'result'=>'3046' // ИД вещи
				),
				array(// Вещь 4
					'items'=>array(
						array('2893','15'),
						array('2894','7'),
						array('2895','6'),
						array('2896','6'),
						array('2897','3'),
						array('2898','3'),
						array('','')
					),
					'result'=>'3047' // ИД вещи
				),
				array(// Вещь 5
					'items'=>array(
						array('2906','12'),
						array('2907','6'),
						array('2908','5'),
						array('2909','6'),
						array('2910','3'),
						array('2911','3'),
						array('','')
					),
					'result'=>'2563' // ИД вещи
				),
				array(// Вещь 6
					'items'=>array(
						array('2906','12'),
						array('2907','6'),
						array('2908','5'),
						array('2909','6'),
						array('2910','3'),
						array('2911','3'),
						array('','')
					),
					'result'=>'3040' // ИД вещи
				),
				array(// Вещь 7
					'items'=>array(
						array('2906','12'),
						array('2907','5'),
						array('2908','4'),
						array('2909','6'),
						array('2910','3'),
						array('2911','3'),
						array('','')
					),
					'result'=>'2932' // ИД вещи
				),
				array(// Вещь 8
					'items'=>array(
						array('2906','12'),
						array('2907','5'),
						array('2908','4'),
						array('2909','6'),
						array('2910','3'),
						array('2911','3'),
						array('','')
					),
					'result'=>'2933' // ИД вещи
				),
				array(// Вещь 9
					'items'=>array(
						array('2893','12'),
						array('2894','5'),
						array('2895','4'),
						array('2896','6'),
						array('2897','3'),
						array('2898','3'),
						array('','')
					),
					'result'=>'2899' // ИД вещи
				),
				array(// Вещь 10
					'items'=>array(
						array('2893','12'),
						array('2894','5'),
						array('2895','4'),
						array('2896','6'),
						array('2897','3'),
						array('2898','3'),
						array('','')
					),
					'result'=>'2900' // ИД вещи
				),
			);
			if(isset($_POST['craftID'])){
				$ParamsNeeds = true;
				if(isset($ArrayCombins[intval($_POST['craftID'])])){
					$ResultItem = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE `id`='" . $ArrayCombins[intval($_POST['craftID'])]['result'] . "'"));
					foreach($ArrayCombins[intval($_POST['craftID'])]['items'] as $items){
						$ResultNeed = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE `id`='{$items[0]}'"));
						if($items[0]){
							$countInInv = mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `invent` WHERE `protype` = '{$items[0]}' and `pl_id`='{$player['id']}'"));
							if($countInInv < $items[1] and $ParamsNeeds == true){
								$ParamsNeeds = false;
							}
						}
					}
					foreach($ArrayCombins[intval($_POST['craftID'])]['items'] as $items){
						if($ParamsNeeds == true and $items[0]){
							mysqli_query($GLOBALS['db_link'],"DELETE FROM `invent` WHERE `protype`='{$items[0]}' and `pl_id`='{$player['id']}' LIMIT " . $items[1] . ";");
						}
					}
					if($ParamsNeeds == true){
						$itemsql = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE `id`='" . $ArrayCombins[intval($_POST['craftID'])]['result'] . "' LIMIT 1;"));
						$par = explode("|",$itemsql['param']);
						foreach ($par as $value) {
							$stat=explode("@",$value);
							switch($stat[0]){
								case 2:
									$dolg=$stat[1];
								break;
							}
						}
						if(mysqli_query($GLOBALS['db_link'],"INSERT INTO invent (`protype` ,`pl_id` ,`dolg` ,`price` ,`gift`,`gift_from`) VALUES ('".$itemsql['id']."','".$player['id']."','".$dolg."','".$itemsql['price']."','0','');")){
						echo"<script>
							top.frames['chmain'].add_msg('<font class=chattime>&nbsp;".date("H:i:s")."</font>&nbsp;<b><font color=#CC0000>Внимание!</font></b> Вы получили &quot;<b>" . $itemsql['name'] . "</b>&quot;. </font><BR>'+'');
							top.set_lmid(8);
							</script>";	
						}
					}
				}
			}
			$i = 0;
			foreach($ArrayCombins as $row){
				$ResultItem = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE `id`='{$row['result']}'"));
				 echo'<form method="POST" action=""><table cellpadding="5" cellspacing="1" border="0" width="100%">
				 <input type="hidden" name="craftID" value="' . $i++ . '" />
				 <tr>
					<td bgcolor="#FFFFFF" class="nickname" align="center">';
				$ParamsNeeds = true;
				foreach($row['items'] as $items){
					$ResultNeed = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` WHERE `id`='{$items[0]}'"));
					echo'<div class="category">';
					if($items[0]){
						$countInInv = mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `invent` WHERE `protype` = '{$items[0]}' and `pl_id`='{$player['id']}'"));
						if($countInInv < $items[1] and $ParamsNeeds == true){
							$ParamsNeeds = false;
						}
						echo'<img src="'.$IMG.'/image/weapon/' . $ResultNeed['gif'] . '" onmouseover="tooltip(this,ShowInfo(\''.$ResultNeed['name'].'\',\''.$ResultNeed['gif'].'\',\''.lr($ResultNeed['price']).'\',\''.$ResultNeed['slot'].'\',\''.$ResultNeed['block'].'\',\''.$ResultNeed['hand'].'\',\''.preg_replace('/@/',':',$ResultNeed['param']).'\',\''.preg_replace('/@/',':',$ResultNeed['need']).'\',\''.$ResultNeed['massa'].'\',\''.$ResultNeed['level'].'\'));" onmouseout="hide_info(this);" /><br />' . $countInInv . '/' . $items[1];
					}else{
						echo'<img src="http://w1.dwar.ru/images/slot-empty.png" /><br />&nbsp;';
					}
					echo'</div>';
				}
				echo'</td><td class="collection-ico" bgcolor="#FFFFFF" align="center"><b>=</b></td><td bgcolor="#FFFFFF" align="center"><img src="'.$IMG.'/image/weapon/' . $ResultItem['gif'] . '" onmouseover="tooltip(this,ShowInfo(\''.$ResultItem['name'].'\',\''.$ResultItem['gif'].'\',\''.lr($ResultItem['price']).'\',\''.$ResultItem['slot'].'\',\''.$ResultItem['block'].'\',\''.$ResultItem['hand'].'\',\''.preg_replace('/@/',':',$ResultItem['param']).'\',\''.preg_replace('/@/',':',$ResultItem['need']).'\',\''.$ResultItem['massa'].'\',\''.$ResultItem['level'].'\'));" onmouseout="hide_info(this);" /></td><td bgcolor="#FFFFFF" align="center"><input type=submit' . ($ParamsNeeds == true ? ' class=lbut' : ' class=lbutdis disabled') . ' value="скрафтить" /></td></tr></table></form>';
			}
			echo'</td></tr></table>';
		?>