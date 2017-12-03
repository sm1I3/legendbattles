<?php
require('kernel/before.php');
include($_SERVER["DOCUMENT_ROOT"] . "/includes/functions/TavernStats.php");
?><table width="100%" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td><table width="100%" cellpadding="0" cellspacing="2">
			<tr>
				<td bgcolor="#cccccc"><table cellpadding="0" cellspacing="1" width="100%" border="0">
					<tr>
                        <td bgcolor="#<?php echo(($_GET['type'] == '1') ? 'FFFFFF' : 'F0F0F0'); ?>" width="50%">
                            <div align="center"><a href="tavern.php?type=1"><font class=nickname><b>Алкоголь</a></div>
                        </td>
                        <td bgcolor="#<?php echo(($_GET['type'] == '2') ? 'FFFFFF' : 'F0F0F0'); ?>" width="50%">
                            <div align="center"><a href="tavern.php?type=2"><font class=nickname><b>Закуска</a></div>
                        </td>
					</tr>
					<tr>
						<td colspan="2"><table cellpadding="1" cellspacing="1" border="0" width="100%">
<?php
	function lr($lr) {
		$b = $lr % 100;
		$s = intval(($lr % 10000) / 100);
		$g = intval($lr / 10000);
        return (($g) ? $g . ' <img src=http://img.legendbattles.ru/image/gold.png width=14 height=14 valign=middle title=Золото>  ' : '') . (($s) ? $s . ' <img src=http://img.legendbattles.ru/image/silver.png width=14 height=14 valign=middle title=Серебро> ' : '') . (($b) ? $b . ' <img src=http://img.legendbattles.ru/image/bronze.png width=14 height=14 valign=middle title=Бронза> ' : '');
	}
$Query = mysql_query("SELECT * FROM `tavern` WHERE `type`='".intval($_GET['type'])."'");
while($row = mysql_fetch_assoc($Query)){
	$Effects = explode("@", $row['effects']);
	$ParamFirst = $ParamSecond = '';
	$EffectTime = 0;
	$Step = 0;
	foreach($Effects as $Effect){
		$Params = explode("|", $Effect);
		if($Step == 0 and $Params[0] != 'EFF'){
			$ParamFirst .= $Effect . '@';
		}else if($Step == 1){
			$ParamSecond .= $Effect . '@';
		}
		if($Params[0] == 'EFF'){
			$Step = 1;
		}
	}
echo'							<tr>
								<td bgcolor="#f9f9f9" width="150"><div align="center"><img src="//img.legendbattles.ru/image/tools/'.$row['img'].'.gif" border="0" />
									<img src="//img.legendbattles.ru/image/1x1.gif" width="150" height="1" /></td>
										<td width="100%" bgcolor="#ffffff" valign="top"><table cellpadding="0" cellspacing="0" border="0" width="100%">
											<tr>
												<td bgcolor="#ffffff" width="100%"><font class=nickname><input type="button" class="lbut" onclick="showEditor(' . $row['id'] . ');" value="редактор" /><b> ' . $row['name'] . ' </b></font><br />
												<img src="//img.legendbattles.ru/image/1x1.gif" width="1" height="3" /></td>
												<td><img src="//img.legendbattles.ru/image/1x1.gif" width="1" height="3&lt;/td" /></td>
											</tr>
											<tr>
												<td colspan="2" width="100%"><table cellpadding="0" cellspacing="0" border="0" width="100%">
											<tr>
												<td bgcolor="#D8CDAF" width="50%"><div align="center"><font class=invtitle>основные</font></div></td>
												<td bgcolor="#B9A05C"><img src="//img.legendbattles.ru/image/1x1.gif" width="1" height="1" /></td>
												<td bgcolor="#D8CDAF" width="50%"><div align="center"><font class=invtitle>побочные</font></div></td>
											</tr>
											<tr>
												<td bgcolor="#FCFAF3"><font class=weaponch>&nbsp;Цена: <b>' . lr($row['price']) . '</b><br />
												&nbsp;Остаток: <b>' . $row['count'] . ' шт.</b><br />';
												if($row['LI'] > 0){
                                                    echo '&nbsp;Лимит: <b>' . $row['LI'] . ' шт.</b><br />';
												}
												$Params = explode("@", substr($ParamFirst,0,strlen($ParamFirst)-1));
												foreach ($Params as $value) {
													TavernStats(explode("|",$value));
												}
												echo'</font></td>
												<td bgcolor="#B9A05C"><img src="//img.legendbattles.ru/image/1x1.gif" width="1" height="1" /></td>
												<td bgcolor="#FCFAF3"><font class=weaponch>';
												$Params = explode("@", substr($ParamSecond,0,strlen($ParamSecond)-1));
												foreach ($Params as $value) {
													TavernStats(explode("|",$value));
												}
												echo'</font></td>
											</tr>
										</table></td>
									</tr>
								</table></td>
							</tr>';
}
?>
						</table></td>
					</tr>
				</table></td>
			</tr>
		</table></td>
	</tr>
</table>
<script>
showEditor = function(id){
	top.$("#basic-modal-content").html('<iframe src="/tavern.php?useaction=admin-action&addid=m0neditor&type=tavern&id=' + id + '" id="useaction" name="useaction" scrolling="auto" style="width:' + (parent.$(window).width()-60) + 'px;height:' + (parent.$(window).height()-40) + 'px;" frameborder="0"></iframe>');
	top.ShowModal();
}
</script>
<? require('kernel/after.php'); ?>