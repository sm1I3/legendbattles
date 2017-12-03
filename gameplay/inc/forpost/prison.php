<?
$pris = explode("|",$player['prison']);
$register_time    =  $pris[0];
$timestamp        = time()-$register_time;
$times = date( 'H Час: i мин: s сек ', $timestamp );
$days  = floor($timestamp / 86400);
$con_time = $days." Дн. ".$times; 
?><table cellpadding=0 cellspacing=0 border=0 align=center width=760>
<tr><td><img src=/img/image/1x1.gif width=1 height=10></td></tr>
<tr><td><div class="block info">
	<div class="header">
		<span>Тюрьма</span>
	</div><img src="/img/image/gameplay/prison1.jpg" width="760" height="255" border="0" /></td></tr>
<tr><td><img src=/img/image/1x1.gif width=1 height=10><br><div align=center><b>Причина: <font class=nickname><font color=#dd0000><i><?=$pris[1]?></div></td></tr>
<tr><td><img src=/img/image/1x1.gif width=1 height=3><br><div align=center><b>Дней: <font class=nickname><font color=#dd0000><i><?=$days?></div></td></tr>
</table>