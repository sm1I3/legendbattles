<?php
if($pers['baks']>=intval($_POST['baks']) and intval($_POST['baks'])>=0){
if(!empty($_POST['tp'])){
	mysqli_query($GLOBALS['db_link'],"UPDATE clans SET baks=baks+'".$_POST['baks']."' WHERE clan_id='".$sign['clan_id']."'");
	mysqli_query($GLOBALS['db_link'],"UPDATE user SET baks=baks-'".$_POST['baks']."' WHERE id=".$pers['id'].";");
	echo"Вы положили на счёт клана ".$sign['clan_name']." ".$_POST['baks']." изумруд . ";
}
}
if($sign['baks'] >= intval($_POST['baks']) and intval($_POST['baks'])>0) {
if(!empty($_POST['tr'])){
	mysqli_query($GLOBALS['db_link'],"UPDATE clans SET baks=baks-'".$_POST['baks']."' WHERE clan_id='".$sign['clan_id']."'");
	mysqli_query($GLOBALS['db_link'],"UPDATE user SET baks=baks+'".$_POST['baks']."' WHERE id=".$pers['id'].";");
	echo"Вы сняли с счёт клана ".$sign['clan_name']." ".$_POST['baks']." изумруд . ";
}
}
?>
<table cellpadding=0 cellspacing=0 border=0 align=center width=760>
 <tr>
 <td>
  <table cellpadding=1 cellspacing=0 border=0 align=center width=100%>
   <tr>
    <td>
	 <table cellpadding="10" class=tbl1 border="0" width="100%">
	 <tr align="center"><td>
	<div align=center>
	<b>Вас приветствуют работники банка</b></font></font>
	<tr><td colspan=3 align=center><?=$msg?></td></tr>
	<tr align=center><td colspan=3><font class=travma>Денег с собой: <b><?=$pers[baks]?><img src="/img/razdor/emerald.png" width=14 height=14></b></font> </b></LEGEND><table cellpadding=3 cellspacing=1 border=0 width=100%></font></td></tr>
	<tr align=left><td colspan=3><div class="underline"></div></td></tr>
	<tr><td><div align=center>Денег в казне: <?=$sign[baks]?> <img src="/img/razdor/emerald.png" width=14 height=14></b></font> </b></LEGEND><table cellpadding=3 cellspacing=1 border=0 width=100%>
<div class="block info">
	<div class="header">
		<span>Возможности</span>
	</div>
 <div class="header">
<form method="post" action="">
<input type="text" name="baks" value="" />
<input type="submit" name="tp" value="Пополнить" />
</form>
<?if($pers['clan_status'] == 9){?>
<form method="post" action="">
<input type="text" name="baks" value="" />
<input type="submit" name="tr" value="Снять" />
</form> <?}?>
									</div>
									Правила :  Только Глава Клана имеет вожможнось забрать деньги с казны.
								</form>										
							</td></tr>
							</table>
							<div class="block info">
	                        <div class="header">
							<span>Отчеты</span>
							<table width="60%" border="1" cellspacing="1" cellpadding="0" align="center">
			  <tbody><tr>
				<td align="center"><b>дата</b></td>
				<td align="center"><b>логин игрока</b></td>
				<td align="center"><b>лог</b></td>
			   </tr>
			 <tr>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
			
					</tbody></table></td>
			   </tr></tbody></table>
			                <div class="header">
							
							