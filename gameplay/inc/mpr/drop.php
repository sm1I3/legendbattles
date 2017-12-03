<div class="block skill">
	<div class="header">
		<span>
				Информация о монстров
	</span>
	</div>
<?php
$bots=mysqli_query($GLOBALS['db_link'],"SELECT `chests`.`id`,`chests`.`name` FROM `chests`;");
while($bot = mysqli_fetch_assoc($bots)){
		$chbot=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `chests`  WHERE `id`='".$bot['id']."' LIMIT 1;"));	
			echo'
				<table cellpadding=0 cellspacing=0 border=0 width=65%  align=center>
				<tr><td>
				<table border=0 cellpadding=4 cellspacing=1  align=center class="smallhead" width=100%>
				<tr align=center class=nickname><td><b>Сундук:  '.$bot['name'].' </b></td></tr><hr>';
				$itemsin=explode("|",$chbot['items']);				
				foreach($itemsin as $val){
					if($val!=''){
						$name=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `items`.`gif`,`items`.`name`,`items`.`id` FROM `items` WHERE `id`='".$val."' LIMIT 1;"));
						echo '
						<tr>							
							<td>
							<form>
							
							<img src="img/image/weapon/'.$name['gif'].'" width="20" height="20" border="0" align="absmiddle" onmouseover="tooltip(this,\'<b>'.$name['name'].'</b>\')" onmouseout="hide_info(this)">  '.$name['name'].' <a href="/iteminfo.php?'.$name['name'].'" target="_blank"><img src="http://efilands.ru/image/chat/info1.gif" width="11" height="12" border="0" align="absmiddle"></a>							
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
?>