<div class="block skill">
	<div class="header">
		<span>
				Информация о монстров
	</span>
	</div>
<?php
$bots=mysqli_query($GLOBALS['db_link'],"SELECT `user`.`id`,`user`.`login`,`user`.`level`,`user`.`obraz` FROM `user` WHERE `user`.`type`='3' AND `user`.`id`<'9999';");
while($bot = mysqli_fetch_assoc($bots)){
		$chbot=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `bot_drop`  WHERE `bot_id`='".$bot['id']."' LIMIT 1;"));	
			echo'
				<table cellpadding=0 cellspacing=0 border=0 width=65%  align=center>
				<tr><td>
				<table border=0 cellpadding=4 cellspacing=1  align=center class="smallhead" width=100%>
				<tr align=center class=nickname><td><img src="/img/image/obrazy/' . $bot['obraz'] . '" width="100" height="100" border="0" align="absmiddle" onmouseover="tooltip(this,\'<b>' . $bot['login'] . ' [ Уровень ' . $bot['level'] . ' ]</b>\')" onmouseout="hide_info(this)"></td></tr><hr>
				';
				$itemsin=explode("|",$chbot['items_id']);				
				foreach($itemsin as $val){
					if($val!=''){
						$name=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `items`.`gif`,`items`.`name`,`items`.`id` FROM `items` WHERE `id`='".$val."' LIMIT 1;"));
						echo '
						<tr>							
							<td>
							<form>
							<img src="/img/image/weapon/'.$name['gif'].'" width="20" height="20" border="0" align="absmiddle" onmouseover="tooltip(this,\'<b>'.$name['name'].'</b>\')" onmouseout="hide_info(this)">  '.$name['name'].' <a href="/iteminfo.php?'.$name['name'].'" target="_blank"><img src="/img/image/chat/info1.gif" width="11" height="12" border="0" align="absmiddle"></a>							
							</form>
							</td>
						</tr>';
					}
				}
				echo'
				</table>
				</td></tr>
				</table>';
			
}