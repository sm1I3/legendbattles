<?
require_once"/var/www/legendbattles.ru/includes/sql.php";
$stop_injection = new InitVars();
$stop_injection->checkVars();
?>
<? session_start();
$tsql=array('dlr' => 0, 'lr'=>0);
if(!empty($_POST['pass']) and !empty($_POST['schet'])){
	$tsql=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM bank WHERE pass='".md5($_POST['pass'])."' AND num='".intval($_POST['schet'])."' LIMIT 1;"));
}
$locname = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `loc` WHERE `id`='".$player['loc']."' LIMIT 1;"));
echo'
<center>

<table class=tbl1 border=0 align=center width=760>
<tr><th colspan=4 align=center>'.$locname['loc'].'<tr><td><img src=/img/image/gameplay/bank/bank.jpg width=760 height=255 border=0></td></tr></th></tr>
<tr><td><img src=/img/image/1x1.gif width=1 height=10></td></tr>

</td></tr>
<tr><td>

<table cellpadding=0 cellspacing=0 border=0 align=center width=760>
 <tr>
 <td>
  <table cellpadding=1 cellspacing=0 border=0 align=center width=100%>
   <tr>
    <td>
	 <table cellpadding="10" class=tbl1 border="0" width="100%">
	 <tr align="center"><td>
	<div align=center>
	<b>��� ������������ ��������� ����� ������ �����</b></font></font>
	<br>� ��� � �����: <b>'.lr($player[nv]).'
	<b>'.(!empty($_POST['dlr'])?($_POST['tp']==0?($tsql['dlr']-intval($_POST['dlr'])>0?$player['dd']+intval($_POST['dlr']):$player['dd']):($player['dd']-intval($_POST['dlr'])>0?$player['dd']-intval($_POST['dlr']):$player['dd'])):$player['dd']).'
	</b> DLR � ����� �� ����� '.$plstt[71].'.<br><br>
	'.($message!='' ? "<font class=nickname style=\"color:red\"><b>".$message."</b></font>" : "").'	
	</div></font>
	</td>
	</tr>
	</table>';
if(empty($bank_c)){$bank_c=0;}

switch(intval($bank_c)){
	case 0: 
		echo'
		<table class=tbl1 width=100% border=0>
    <tr><th colspan=4 align=center>�������� ���������</th></tr>
    </table>
		';
	break;
	case 1: 
		$vklad = $player['vklad']!=0 ? explode("|",$player['vklad']) : $vklad[1]="";
		if($vklad[0]!=""){
			echo '			
			<table class=tbl1 width=100% border=0>
    <tr><th colspan=4 align=center>&nbsp;������ ���������&nbsp;</th></tr>
			<table cellpadding=0 cellspacing=0 border=0 width=100%>
				<tr><td align=center class=nickname>
				��������� �����: '.lr($vklad[1]).' ������<br>
				���� ���������� ���������: '.date("d.m.y�.",$vklad[0]).'<br>
				����� ��������� � ������ ���������: '.$vklad[2].'<br>
				</td></tr>
				<tr><td align=center class=nickname>
				<br><b>��������� ��������:</b><br>
				<form method=POST>
					<input type=hidden name=post_id value=92>
					<input type="hidden" name="vcode" value="'.scode().'" />
				'.(
				$vklad[0]>time() ? 
				'<button type=submit>������� �������� '.lr($vklad[1]).'</button></form>
				<br><font style="color:red" class=freetxt>��� ������ ������ �������� ����� ����� ���������� ��� ���������� ���������!</font>'
				:
				'<button type=submit>������� ����� '.lr($vklad[2]).'</button></form>	'				
				).
				'
				</td></tr>
			</table>';
		}
		else{
			echo '
			<script language=Javascript src="../../../js/vklad.js"> </script>
					<script>
					var pl_lvl,scode;
					mon= '.$player['nv'].';
					</script>
			<font class=proce><font color=#222222>
			<table class=tbl1 width=100% border=0>
				<tr><td align=center>
						<select onChange="writevklad(this.value);chvk();" >
							<option value=0 selected>�������� ��� ������</option>
							<option value=1 >�������</option>
							<option value=2 >�������������</option>
							<option value=3 >������������</option>
						</select>
						<input id="vk_sum" type="hidden" onblur="if (value == \'\') {value=\' ������� ����� ������ \' }" onfocus="if (value == \' ������� ����� ������ \') {value = \'\'}" value=" ������� ����� ������ " onkeyup="chvk();" />
				</td></tr>
				<tr><td align=center>
					<form method=POST>
						<input type=hidden name="sum" id="vk_sum_hid" value="0">
						<input type=hidden name="type" id="vk_type_hid" value="0">
						<input type="hidden" name="vcode" value="'.scode().'" />
						<font class=freetxt>
							<div id="vk_uslov">
								�������� ��� ������.
							</div>
						</font>
					</form>	
				</td></tr>
			</table>';
		}
	break;
	case 2: 
		$sql=mysqli_query($GLOBALS['db_link'],"SELECT * FROM credit WHERE uid='".$player['id']."';");
		if(mysqli_num_rows($sql)>0){
		echo '
				<table class=tbl1 width=100% border=0>
        <tr><th colspan=4 align=center>&nbsp;���� �������&nbsp;</th></tr>
		    <table cellpadding=0 cellspacing=0 border=0 width=100%>
			  <tr><td align=center class=nickname>
				';
				$csql=mysqli_fetch_assoc($sql);
				echo'
				�����: '.lr($csql['proc_sum']).'<br>
				������������ ������: '.$csql['plat'].'<br>
				���� ���������� �������: '.(date("d.m.y�.",$csql['next'])).'<br>
				������� �� �������: '.lr($csql['proc_sum']-$csql['sum_payed']).'
				<form method=POST>
					<input type=hidden name=post_id value=88>
					<input type=hidden name=act value=2>
					<input type="hidden" name="vcode" value="'.scode().'" />
					<button type=submit>�������� '.lr($csql['plat']).'</button>
				</form>	
				<form method=POST>
					<input type=hidden name=post_id value=88>
					<input type=hidden name=act value=3>
					<input type="hidden" name="vcode" value="'.scode().'" />
					<button type=submit>�������� ������ '.lr($csql['proc_sum']-$csql['sum_payed']).'</button>
				</form>	
			</td></tr>
			';
		}
		else{
			echo'
			<table class=tbl1 width=100% border=0>
        <tr><th colspan=4 align=center>��������� ��������&nbsp;</th></tr>
			<table cellpadding=0 cellspacing=0 border=0 width=100%>
			';
			if($player['finblock']<time() and $player['level']>4){
				echo'
				<script language=Javascript src="../../../js/credit.js"> </script>
				<script>
				var pl_lvl,scode;
				pl_lvl= '.$player['level'].';
				</script>
				<tr><td align=center>
					<font  class=nickname style="color:#336699"><b>����� ������:</b></font><br>
					�����: 
					<select onChange="writesum(this.value)">
						<option value=0 selected>�������� �����</option>
						<option value=1 >'.($player['level']*100).' ������</option>
						<option value=2 >'.($player['level']*200).' ������</option>
						<option value=3 >'.($player['level']*300).' ������</option>
						<option value=4 >'.($player['level']*400).' ������</option>
					</select>
					����: 
					<select onChange="writeuslov(this.value)">
						<option value=0 selected>�������� ����</option>
						<option value=1 >1 ������</option>
						<option value=2 >2 ������</option>
						<option value=3 >4 ������</option>
						<option value=4 >8 ������</option>
					</select>
					<br>
					<form method=POST>
					<input type=hidden name="sum" id="cr_sum_hid" value="0">
					<input type=hidden name="srok" id="cr_srok_hid" value="0">
					<input type="hidden" name="vcode" value="'.scode().'" />
					<font class=freetxt>
						<div id="cr_uslov">
							�������� ����� � ���� �������.
						</div>
						</font>
					</form>					
				</td></tr>
				';
			}
			else{
				echo'
				<tr><td align=center>
					<font  class=nickname style="color:#336699"><b>��������� �������� ���������� ��� ����� ���������.</b></font>
				</td></tr>
				';			
			}
		}
		echo '
		</table>';
	break;
	case 3:
		if(empty($_GET['act'])){$_GET['act']=0;	}
		switch(intval($_GET['act'])){
			case 0:
				echo ($player['seif']<time() ? 
				'<table class=tbl1 width=100% border=0>
        <tr><th colspan=4 align=center>&nbsp;���������� ����&nbsp;</th></tr>
				<table cellpadding=0 cellspacing=0 border=0 width=100%>				
					<tr><td align=center>
						<form method=POST>
							<input type=hidden name=post_id value=88>
							<input type=hidden name=act value=4>
							<input type=hidden name=time value=1>
							<input type="hidden" name="vcode" value="'.scode().'" />
							<input type=submit class=lbut value="  1 ������ (250 ������)  " >
						</form>	
						</td><td align=center>
						<form method=POST>
							<input type=hidden name=post_id value=88>
							<input type=hidden name=act value=4>
							<input type=hidden name=time value=2>
							<input type="hidden" name="vcode" value="'.scode().'" />
							<input type=submit class=lbut value="  4 ������ (900 ������)  " >
						</form>	
						</td><td align=center>
						<form method=POST>
							<input type=hidden name=post_id value=88>
							<input type=hidden name=act value=4>
							<input type=hidden name=time value=3>
							<input type="hidden" name="vcode" value="'.scode().'" />
							<input type=submit class=lbut value=" 8 ������ (1600 ������) " >
						</form>	
						</td><td align=center>
						<form method=POST>
							<input type=hidden name=post_id value=88>
							<input type=hidden name=act value=4>
							<input type=hidden name=time value=4>
							<input type="hidden" name="vcode" value="'.scode().'" />
							<input type=submit class=lbut value="  36 ������ (2 DLR)  " >
						</form>	
						</td></tr>
				</table>
				</FIELDSET>' 
				: 				
				'<font class=proce><font color=#222222>
				<FIELDSET><LEGEND align=center><font color=gray><B>&nbsp;<a href="?bank_c=3&act=1">������� ����</a>&nbsp;|&nbsp;<a href="?bank_c=3&act=2">�������� ����</a>&nbsp;</B></font></LEGEND>
				<table cellpadding=0 cellspacing=0 border=0 width=100%>	
					'.($player['seif']>time() ? "<tr><td colspan=2 align=center><font class=freetxt>���� ��������� ��: ".date("d.m.y�.",$player['seif'])."<br></font></td></tr>" : "").'
				</table>'					
				);
				$player['seif']<time() ? mysqli_query($GLOBALS['db_link'],"UPDATE invent SET bank='0' WHERE pl_id='".$player['id']."';") : "";
			break;	
			case 1:
				$ITEMS = mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*,`items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `invent`.`pl_id`='".$player['id']."' AND `invent`.`used`='0' AND `invent`.`clan`='0' AND `invent`.`bank`='1';");
				echo'
				<table class=tbl1 width=100% border=0>
        <tr><th colspan=4 align=center>&nbsp;������� ����&nbsp;|&nbsp;<a href="?bank_c=3&act=2">�������� ����</a></th></tr>
				<table cellpadding=0 cellspacing=0 border=0 width=100% bgcolor=#e0e0e0 align=center>
				<tr><td>
				<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
				';
				if(mysqli_num_rows($ITEMS)>0){
					echo '
					<tr align=center><td bgcolor=#f9f9f9 align=center colspan=3>
					<form method=POST>
						<input type=hidden name=post_id value=89>
						<input type="hidden" name="vcode" value="'.scode().'" />
						<input type=submit class=lbut value=" ������� ��� ���� �� ����� " >
					</form>		
					</td></tr>
					';
					while ($ITEM = mysqli_fetch_assoc($ITEMS)) {						
						if($ITEM['dd_price']>0){$art="weaponchart";}else{$art="weaponch";}
						$iz=$ITEM['dolg']-$ITEM['iznos'];
						$ItemToOne[$ITEM['id']+$ITEM['arenda']+$ITEM['rassrok']][md5($iz.'/'.$ITEM['dolg'])] += 1;
						if($ItemToOne[$ITEM['id']+$ITEM['arenda']+$ITEM['rassrok']][md5($iz.'/'.$ITEM['dolg'])] == 1){
							$count = mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `invent`.`pl_id`='".$player['id']."' and `invent`.`used`='0' and `invent`.`dolg`='".$ITEM['dolg']."' and `invent`.`iznos`='".$ITEM['iznos']."' and `items`.`id`='".$ITEM['id']."' and `invent`.`arenda`='".$ITEM['arenda']."' and `invent`.`rassrok`='".$ITEM['rassrok']."' and `invent`.`bank`='1' ORDER BY `items`.`dd_price`,`items`.`name`;"));
							echo'
							<tr align=center>
							<td bgcolor=#f9f9f9 align=left width=50%>
							<font class='.$art.'  style="margin: 0px 0px 0px 20px;"><b>'.$ITEM['name'].'</b>&nbsp;[&nbsp;'.$ITEM['level'].'&nbsp;]<a href="iteminfo.php?'.$ITEM['name'].'" target=_blank><img src=/img/image/chat/info.gif width=11 height=12 border=0></a></font><font class=weaponch>'.(($count>1)?' <font color="gray">(<b>'.$count.' ��.</b>)</font>':'').'
							</td>
							<td align=center width=50% bgcolor=#f9f9f9>
							<form method=POST>
								<input type=hidden name=post_id value=88>
								<input type=hidden name=act value=6>
								<input type=hidden name=item value="'.$ITEM['id_item'].'" >
								<input type="hidden" name="vcode" value="'.scode().'" />
								<input type=submit class=lbut value=" ������� �� ����� " >
							</form>	
							<form method=POST>
								<input type=hidden name=post_id value=88>
								<input type=hidden name=act value=8>
								<input type=hidden name=item value="'.$ITEM['protype'].'" >
								<input type="hidden" name="vcode" value="'.scode().'" />
								<input type=submit class=lbut value=" ������� �� ����� ( ��� ������ ����) " >
							</form>	
							</td>
							</tr>
							';
						}
					}
				}
				else{
					echo '<tr align=center><td class=nickname align=center><b>�� �� �������� �� ����� ���� � ����</b></td></tr>';
				}
				echo'
				</table>
				</td></tr></table>';
			break;
			break;
			case 2:
				$ITEMS = mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*,`items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `invent`.`pl_id`='".$player['id']."' AND `invent`.`used`='0' AND `invent`.`clan`='0' AND `invent`.`bank`='0' ORDER BY `items`.`dd_price`,`items`.`name`;");
				echo'
				<table class=tbl1 width=100% border=0>
        <tr><th colspan=4 align=center><a href="?bank_c=3&act=1">������� ����</a>&nbsp;|&nbsp;�������� ����&nbsp;</th></tr>
				<table cellpadding=0 cellspacing=0 border=0 width=100% bgcolor=#e0e0e0 align=center>
				<tr><td>
				<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
				';
				if(mysqli_num_rows($ITEMS)>0){
					echo'
					<tr align=center><td bgcolor=#f9f9f9 align=center colspan=3>
					<form method=POST>
						<input type=hidden name=post_id value=90>
						<input type="hidden" name="vcode" value="'.scode().'" />
						<input type=submit class=lbut value=" �������� ��� ���� � ���� " >
					</form>		
					</td></tr>';
					while ($ITEM = mysqli_fetch_assoc($ITEMS)) {
						if($ITEM['dd_price']>0){$art="weaponchart";}else{$art="weaponch";}
						$iz=$ITEM['dolg']-$ITEM['iznos'];
						$ItemToOne[$ITEM['id']+$ITEM['arenda']+$ITEM['rassrok']][md5($iz.'/'.$ITEM['dolg'])] += 1;
						if($ItemToOne[$ITEM['id']+$ITEM['arenda']+$ITEM['rassrok']][md5($iz.'/'.$ITEM['dolg'])] == 1){
							$count = mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `invent`.`pl_id`='".$player['id']."' and `invent`.`used`='0' and `invent`.`dolg`='".$ITEM['dolg']."' and `invent`.`iznos`='".$ITEM['iznos']."' and `items`.`id`='".$ITEM['id']."' and `invent`.`arenda`='".$ITEM['arenda']."' and `invent`.`rassrok`='".$ITEM['rassrok']."' and `invent`.`bank`='0';"));
							echo'
						<tr align=center>
						<td bgcolor=#f9f9f9 align=left width=50%>
						<font class='.$art.'  style="margin: 0px 0px 0px 20px;"><b>'.$ITEM['name'].'</b>&nbsp;[&nbsp;'.$ITEM['level'].'&nbsp;]<a href="iteminfo.php?'.$ITEM['name'].'" target=_blank><img src=/img/image/chat/info.gif width=11 height=12 border=0></a></font><font class=weaponch>'.(($count>1)?' <font color="gray">(<b>'.$count.' ��.</b>)</font>':'').'
						</td>
						<td align=center width=50% bgcolor=#f9f9f9>
						<form method=POST>
							<input type=hidden name=post_id value=88>
							<input type=hidden name=act value=5>
							<input type=hidden name=item value="'.$ITEM['id_item'].'" >
							<input type="hidden" name="vcode" value="'.scode().'" />
							<input type=submit class=lbut value=" �������� � ���� " >
						</form>	
						<form method=POST>
							<input type=hidden name=post_id value=88>
							<input type=hidden name=act value=7>
							<input type=hidden name=item value="'.$ITEM['protype'].'" >
							<input type="hidden" name="vcode" value="'.scode().'" />
							<input type=submit class=lbut value=" �������� � ���� ( ��� ������ ����) " >
						</form>	
						</td>
						</tr>
						';
						}
					}
				}
				else{
					echo '<tr align=center><td class=nickname align=center><b>� ��� ��� �� ����� ����.</b></td></tr>';
				}
				echo'
				</table>
				</td></tr></table>';
			break;
		}
	break;
	case 4:
		if(empty($_GET['act'])){$_GET['act']=0;	}
		switch(intval($_GET['act'])){
			case 0:
				echo '
				<table class=tbl1 width=100% border=0>
        <tr><th colspan=4 align=center>�������� ���������</th></tr>
					<tr>
						<td class=nickname align=center><b><a href="?bank_c=4&act=1">������������ �����</a></b></td>
						<td class=nickname align=center><b><a href="?bank_c=4&act=2">�������� �����</a></b></td>
						<td class=nickname align=center><b><a href="?bank_c=4&act=3">�������� ��������</a></b></td>
					</tr>
				</table>';
			break;
			case 1:
				$sql=mysqli_query($GLOBALS['db_link'],"SELECT * FROM bank WHERE pl_id=".$player['id'].";");
				if(mysqli_num_rows($sql)>0){
					if(!empty($_POST['pass']) and !empty($_POST['schet'])){
						//���������� �����						
						if( !empty($_POST['lr']) ) {	
							if (intval($_POST['tp'])==0){
								if($tsql['lr']>=intval($_POST['lr']) and intval($_POST['lr'])>=0){
									mysqli_query($GLOBALS['db_link'],"UPDATE bank SET lr=lr-".intval($_POST['lr'])." WHERE pl_id=".$player['id']." AND pass='".md5($_POST['pass'])."' AND num='".intval($_POST['schet'])."' LIMIT 1;");
									mysqli_query($GLOBALS['db_link'],"UPDATE user SET nv=nv+".intval($_POST['lr'])." WHERE id=".$player['id']." LIMIT 1;");
								}
							}
							else if( $player['nv'] >= intval($_POST['lr']) and intval($_POST['tp'])==1 and intval($_POST['lr'])>=0) {
								mysqli_query($GLOBALS['db_link'],"UPDATE bank SET lr=lr+".intval($_POST['lr'])." WHERE pl_id=".$player['id']." AND pass='".md5($_POST['pass'])."' AND num='".intval($_POST['schet'])."' LIMIT 1;");
								mysqli_query($GLOBALS['db_link'],"UPDATE user SET nv=nv-".intval($_POST['lr'])." WHERE id=".$player['id']." LIMIT 1;");
							}							
						}
						if( !empty($_POST['dlr']) ) {
							if (intval($_POST['tp'])==0){
								if($tsql['dlr']>=intval($_POST['dlr']) and intval($_POST['dlr'])>=0){
									mysqli_query($GLOBALS['db_link'],"UPDATE bank SET dlr=dlr-".intval($_POST['dlr'])." WHERE pl_id=".$player['id']." AND pass='".md5($_POST['pass'])."' AND num='".intval($_POST['schet'])."';");
									mysqli_query($GLOBALS['db_link'],"UPDATE user SET dd=dd+".intval($_POST['dlr'])." WHERE id=".$player['id']." LIMIT 1;");
								}
							}
							else if( $player['dd'] >= intval($_POST['dlr']) and intval($_POST['tp'])==1 and intval($_POST['dlr'])>=0){
								mysqli_query($GLOBALS['db_link'],"UPDATE bank SET dlr=dlr+".intval($_POST['dlr'])." WHERE pl_id=".$player['id']." AND pass='".md5($_POST['pass'])."' AND num='".intval($_POST['schet'])."';");
								mysqli_query($GLOBALS['db_link'],"UPDATE user SET dd=dd-".intval($_POST['dlr'])." WHERE id=".$player['id']." LIMIT 1;");

							}
						}
						//����� ���������� �����
						$postsql=mysqli_query($GLOBALS['db_link'],"SELECT * FROM bank WHERE pl_id=".$player['id']." AND pass='".md5($_POST['pass'])."' AND num='".intval($_POST['schet'])."' LIMIT 1;");
						if(mysqli_num_rows($postsql)>0){
							$postsql=mysqli_fetch_assoc($postsql);
							echo'						
							<table class=tbl1 width=100% border=0>
              <tr><th colspan=4 align=center>��� ����</th></tr>
							<table cellpadding=0 cellspacing=0 border=0 width=100%>
								<tr><td align=center class=nickname>
									������: <b>'.lr($postsql['lr']).'</b><br>������ DLR: <b>'.$postsql['dlr'].'</b>
								</td></tr>
							<tr><td align=left class=nickname>			
								<form method=post action="?bank_c=4&act=1">	
									������: <input type=text name=lr value="0" onblur="if (value == \'\') {value=\'0\' }" onfocus="if (value == \'0\') {value = \'\'}">
									DLR: <input type=text name=dlr value="0" onblur="if (value == \'\') {value=\'0\' }" onfocus="if (value == \'0\') {value = \'\'}">								
									<input name=schet type=hidden value="'.$_POST['schet'].'">
									<input id=pass type=hidden name=pass value="'.$_POST['pass'].'">
									<input type=hidden name=tp value="1">									
									<input type="hidden" name="vcode" value="'.scode().'" />
									<input type=submit class=lbut value=" ��������� " >
								</form>	
							</td></tr>	
							<tr><td align=left class=nickname>
								<form method=post action="?bank_c=4&act=1">	
									������: <input type=text name=lr value="0" onblur="if (value == \'\') {value=\'0\' }" onfocus="if (value == \'0\') {value = \'\'}">
									DLR: <input type=text name=dlr value="0" onblur="if (value == \'\') {value=\'0\' }" onfocus="if (value == \'0\') {value = \'\'}">								
									<input name=schet type=hidden value="'.$_POST['schet'].'">
									<input id=pass type=hidden name=pass value="'.$_POST['pass'].'">	
									<input type=hidden name=tp value="0">									
									<input type="hidden" name="vcode" value="'.scode().'" />
									<input type=submit class=lbut value=" ������� " >
								</form>										
							</td></tr>
							</table>';					
						}
						else{
							echo'						
							<table class=tbl1 width=100% border=0>
              <tr><th colspan=4 align=center>��� ����</th></tr>
							<table cellpadding=0 cellspacing=0 border=0 width=100%>
								<tr><td align=center class=nickname>
									����� ����� ��� ������ �������!
								</td></tr>
							</table>';	
						}
					}else{
						echo'
						<script>
						$ = function(id){
							return document.getElementById(id);
						}
						function chpass(){
							if($(\'pass\').type == \'password\'){
								$(\'pass\').type = \'text\';
							}else if($(\'pass\').type == \'text\'){
								$(\'pass\').type = \'password\';
							}	
						}
						</script>					
						<table class=tbl1 width=100% border=0>
            <tr><th colspan=4 align=center>����</th></tr>
							<tr><td align=center>
								<form method=post action="?bank_c=4&act=1">	
									<input name=schet type=text value="������� ����� �����" onblur="if (value == \'\') {value=\'������� ����� �����\' }" onfocus="if (value == \'������� ����� �����\') {value = \'\'}">
									<input id=pass type=text name=pass value="������� ������" onblur="if (value == \'\') {value=\'������� ������\' }" onfocus="if (value == \'������� ������\') {value = \'\'}">								
									<input type="hidden" name="vcode" value="'.scode().'" />
									<input type=submit class=lbut value=" ����� " >
								</form>
								<input type=checkbox onclick="chpass();" checked><font class=freetxt> ���������� ������ </font>
							</td></tr>
						</table>';
					}
				}
				else{
					echo '
					<script>
					$ = function(id){
						return document.getElementById(id);
					}
					function chpass(){
						if($(\'pass\').type == \'password\'){
							$(\'pass\').type = \'text\';
						}else if($(\'pass\').type == \'text\'){
							$(\'pass\').type = \'password\';
						}	
					}
					</script>
					<table class=tbl1 width=100% border=0>
          <tr><th colspan=4 align=center>������� ����</th></tr>
					<table cellpadding=0 cellspacing=0 border=0 width=100%>
						<tr><td align=center>
							<form method=post>								
								<input id=pass type=text name=pass value="������� ������" onblur="if (value == \'\') {value=\'������� ������\' }" onfocus="if (value == \'������� ������\') {value = \'\'}">
								<input type=hidden name=post_id value=93>
								<input type=hidden name=act value=1>
								<input type="hidden" name="vcode" value="'.scode().'" />
								<input type=submit class=lbut value=" ������� ���� " >
							</form>
							<input type=checkbox onclick="chpass();" checked><font class=freetxt> ���������� ������ </font>
						</td></tr>
					</table>';
				}
			break;
			case 2:
			$sql=mysqli_query($GLOBALS['db_link'],"SELECT * FROM bank WHERE clan_id='".$player['clan_id']."';");
			if(mysqli_num_rows($sql)>0){
					if(!empty($_POST['pass']) and !empty($_POST['schet'])){
						//���������� �����						
						if( !empty($_POST['lr']) ) {	
							if (intval($_POST['tp'])==0){
								if($tsql['lr']>=intval($_POST['lr']) and intval($_POST['lr'])>0){
									mysqli_query($GLOBALS['db_link'],"UPDATE bank SET lr=lr-".intval($_POST['lr'])." WHERE clan_id='".$player['clan_id']."' AND pass='".md5($_POST['pass'])."' AND num='".intval($_POST['schet'])."' LIMIT 1;");
									mysqli_query($GLOBALS['db_link'],"UPDATE user SET nv=nv+".intval($_POST['lr'])." WHERE id=".$player['id']." LIMIT 1;");
								}
							}
							else if( $player['nv'] >= intval($_POST['lr']) and intval($_POST['tp'])==1 and intval($_POST['lr'])>0) {
								mysqli_query($GLOBALS['db_link'],"UPDATE bank SET lr=lr+".intval($_POST['lr'])." WHERE clan_id='".$player['clan_id']."' AND pass='".md5($_POST['pass'])."' AND num='".intval($_POST['schet'])."' LIMIT 1;");
								mysqli_query($GLOBALS['db_link'],"UPDATE user SET nv=nv-".intval($_POST['lr'])." WHERE id=".$player['id']." LIMIT 1;");
							}							
						}
						if( !empty($_POST['dlr']) ) {
							if (intval($_POST['tp'])==0){
								if($tsql['dlr']>=intval($_POST['dlr']) and intval($_POST['dlr'])>0){
									mysqli_query($GLOBALS['db_link'],"UPDATE bank SET dlr=dlr-".intval($_POST['dlr'])." WHERE clan_id='".$player['clan_id']."' AND pass='".md5($_POST['pass'])."' AND num='".intval($_POST['schet'])."';");
									mysqli_query($GLOBALS['db_link'],"UPDATE user SET dd=dd+".intval($_POST['dlr'])." WHERE id=".$player['id']." LIMIT 1;");
								}
							}
							else if( $player['dd'] >= intval($_POST['dlr']) and intval($_POST['tp'])==1  and intval($_POST['dlr'])>0){
								mysqli_query($GLOBALS['db_link'],"UPDATE bank SET dlr=dlr+".intval($_POST['dlr'])." WHERE clan_id='".$player['clan_id']."' AND pass='".md5($_POST['pass'])."' AND num='".intval($_POST['schet'])."';");
								mysqli_query($GLOBALS['db_link'],"UPDATE user SET dd=dd-".intval($_POST['dlr'])." WHERE id=".$player['id']." LIMIT 1;");
							}
						}
						//����� ���������� �����
						$postsql=mysqli_query($GLOBALS['db_link'],"SELECT * FROM bank WHERE clan_id='".$player['clan_id']."' AND pass='".md5($_POST['pass'])."' AND num='".intval($_POST['schet'])."' LIMIT 1;");
						if(mysqli_num_rows($postsql)>0){
							$postsql=mysqli_fetch_assoc($postsql);
							echo'						
							<table class=tbl1 width=100% border=0>
              <tr><th colspan=4 align=center>��� ����</th></tr>
							<table cellpadding=0 cellspacing=0 border=0 width=100%>
								<tr><td align=center class=nickname>
									������: <b>'.lr($postsql['lr']).'</b><br>������ DLR: <b>'.$postsql['dlr'].'</b>
								</td></tr>
							<tr><td align=left class=nickname>			
								<form method=post action="?bank_c=4&act=2">	
									������: <input type=text name=lr value="0" onblur="if (value == \'\') {value=\'0\' }" onfocus="if (value == \'0\') {value = \'\'}">
									DLR: <input type=text name=dlr value="0" onblur="if (value == \'\') {value=\'0\' }" onfocus="if (value == \'0\') {value = \'\'}">								
									<input name=schet type=hidden value="'.$_POST['schet'].'">
									<input id=pass type=hidden name=pass value="'.$_POST['pass'].'">
									<input type=hidden name=tp value="1">									
									<input type="hidden" name="vcode" value="'.scode().'" />
									<input type=submit class=lbut value=" ��������� " >
								</form>	
							</td></tr>	
							<tr><td align=left class=nickname>
								<form method=post action="?bank_c=4&act=2">	
									������: <input type=text name=lr value="0" onblur="if (value == \'\') {value=\'0\' }" onfocus="if (value == \'0\') {value = \'\'}">
									DLR: <input type=text name=dlr value="0" onblur="if (value == \'\') {value=\'0\' }" onfocus="if (value == \'0\') {value = \'\'}">								
									<input name=schet type=hidden value="'.$_POST['schet'].'">
									<input id=pass type=hidden name=pass value="'.$_POST['pass'].'">	
									<input type=hidden name=tp value="0">									
									<input type="hidden" name="vcode" value="'.scode().'" />
									<input type=submit class=lbut value=" ������� " >
								</form>										
							</td></tr>
							</table>';					
						}
						else{
							echo'						
							<table class=tbl1 width=100% border=0>
              <tr><th colspan=4 align=center>��� ����</th></tr>
							<table cellpadding=0 cellspacing=0 border=0 width=100%>
								<tr><td align=center class=nickname>
									����� ����� ��� ������ �������!
								</td></tr>
							</table>';	
						}
					}else{
						echo'
						<script>
						$ = function(id){
							return document.getElementById(id);
						}
						function chpass(){
							if($(\'pass\').type == \'password\'){
								$(\'pass\').type = \'text\';
							}else if($(\'pass\').type == \'text\'){
								$(\'pass\').type = \'password\';
							}	
						}
						</script>					
						<table class=tbl1 width=100% border=0>
          <tr><th colspan=4 align=center>����</th></tr>
						<table cellpadding=0 cellspacing=0 border=0 width=100%>
							<tr><td align=center>
								<form method=post action="?bank_c=4&act=2">	
									<input name=schet type=text value="������� ����� �����" onblur="if (value == \'\') {value=\'������� ����� �����\' }" onfocus="if (value == \'������� ����� �����\') {value = \'\'}">
									<input id=pass type=text name=pass value="������� ������" onblur="if (value == \'\') {value=\'������� ������\' }" onfocus="if (value == \'������� ������\') {value = \'\'}">								
									<input type="hidden" name="vcode" value="'.scode().'" />
									<input type=submit class=lbut value=" ����� " >
								</form>
								<input type=checkbox onclick="chpass();" checked><font class=freetxt> ���������� ������ </font>
							</td></tr>
						</table>
						</FIELDSET>
						';
					}
				}
				else if($player['clan_status']>=8){
					echo '
					<script>
					$ = function(id){
						return document.getElementById(id);
					}
					function chpass(){
						if($(\'pass\').type == \'password\'){
							$(\'pass\').type = \'text\';
						}else if($(\'pass\').type == \'text\'){
							$(\'pass\').type = \'password\';
						}	
					}
					</script>
					<table class=tbl1 width=100% border=0>
          <tr><th colspan=4 align=center>������� ����</th></tr>
					<table cellpadding=0 cellspacing=0 border=0 width=100%>
						<tr><td align=center>
							<form method=post>								
								<input id=pass type=text name=pass value="������� ������" onblur="if (value == \'\') {value=\'������� ������\' }" onfocus="if (value == \'������� ������\') {value = \'\'}">
								<input type=hidden name=post_id value=93>
								<input type=hidden name=act value=2>
								<input type="hidden" name="vcode" value="'.scode().'" />
								<input type=submit class=lbut value=" ������� ���� " >
							</form>
							<input type=checkbox onclick="chpass();" checked><font class=freetxt> ���������� ������ </font>
						</td></tr>
					</table>
					</FIELDSET>
					';
				}
				else{
					echo'
					<font class=proce><font color=#222222>
					<FIELDSET><LEGEND align=center><font color=gray><B>&nbsp;������� ����&nbsp;</B></font></LEGEND>
					<table cellpadding=0 cellspacing=0 border=0 width=100%>
						<tr><td class=nickname align=center>
							� ��� ��� ���� �� �������� �����	
						</td></tr>
					</table>
					</FIELDSET>
					';
				}
			break;
			case 3:
			break;
			case 4:
			break;
		}
	break;
}

	echo'	
	  <table class=tbl1 width=100% border=0>
    <tr><th colspan=4 align=center>���������� ��������</th></tr>
		<tr align="center">
		<td class=nickname align=center><b><a href="?bank_c=1">������</a></b></td>
		<td class=nickname align=center><b><a href="?bank_c=2">�������</a></b></td>	
		<td class=nickname align=center><b><a href="?bank_c=3">�����</a></b></td>
		<td class=nickname align=center><b><a href="?bank_c=4">�����</a></b></td>		
		</tr>
	</table>';	  

echo'
  </td>
   </tr>
  </table>
</table>
';
?>
<SCRIPT language='JavaScript'>
NewLinksView();
</SCRIPT>