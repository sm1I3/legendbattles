<?

		function ShowParDD($i,$par,$type){
			$fr="";	
			$str="";			
			switch($i){
				case 1: $fr="����:";break;
				case 5: $fr="������:";break;
				case 6: $fr="��������:";break;
				case 7: $fr="����������:";break;
				case 8: $fr="���������:";break;
				case 9: $fr="����� �����:";break;
				case 10: $fr="������ �����:";break;
					/*case 11: $fr="������ ������� ������:";break;
					case 12: $fr="������ ������� ������:";break;
					case 13: $fr="������ ����������� ������:";break;
					case 14: $fr="������ ����������� ������:";break;
					case 15: $fr="������ ������� ������:";break;
					case 16: $fr="������ �������� ������:";break;
					case 17: $fr="������ ���������� ������:";break;
					case 18: $fr="������ �������� ������:";break;
					case 19: $fr="������ �� ������� ������:";break;
					case 20: $fr="������ �� ������� ������:";break;
					case 21: $fr="������ �� ����������� ������:";break;
					case 22: $fr="������ �� ����������� ������:";break;
					case 23: $fr="������ �� ������� ������:";break;
					case 24: $fr="������ �� �������� ������:";break;
					case 25: $fr="������ �� ���������� ������:";break;
					case 26: $fr="������ �� �������� ������:";break;*/
				case 27: $fr="��:";break;
				case 28: $fr="���� ��������:";break;
				case 29: $fr="����:";break;
				case 30: $fr="����:";break;
				case 31: $fr="�����������:";break;
				case 32: $fr="�������:";break;
				case 33: $fr="��������:";break;
				case 34: $fr="�����:";break;
					//case 35: $fr="��������:";break;
				case 36: $fr="����. ������:";break;
				case 37: $fr="����. ��������:";break;
				case 38: $fr="����. �������� �������:";break;
				case 39: $fr="����. ������:";break;
				case 40: $fr="����. ����������� �������:";break;
				case 41: $fr="����. ���������� � �������:";break;
				case 42: $fr="����. ��������:";break;
				case 43: $fr="����. ������������ �������:";break;
				case 44: $fr="����. ��������� �������:";break;
				case 45: $fr="����� ����:";break;
				case 46: $fr="����� ����:";break;
				case 47: $fr="����� �������:";break;
				case 48: $fr="����� �����:";break;
				case 49: $fr="������������� ����� ����:";break;
				case 50: $fr="������������� ����� ����:";break;
				case 51: $fr="������������� ����� �������:";break;
				case 52: $fr="������������� ����� �����:";break;
				case 53: $fr="���������:";break;
				case 54: $fr="������������";break;
				case 55: $fr="����������:";break;
				case 56: $fr="����������������:";break;
				case 57: $fr="��������:";break;
				case 58: $fr="��������:";break;
				case 59: $fr="�������:";break;
				case 60: $fr="�������:";break;
				case 61: $fr="��������� ����:";break;
				case 62: $fr="�����������:";break;
				case 63: $fr="���������:";break;
				case 64: $fr="������:";break;
				case 65: $fr="�����������:";break;
				case 66: $fr="������� �������������� ����:";break;
				case 67: $fr="���������:";break;
				case 68: $fr="�������:";break;
				case 69: $fr="�������� ������� ����:";break;
				case 70: $fr="������������:";break;
				case 71: $fr="�����������(new):";break;
				case 'expbonus': $fr="����� ����� (� %):";break;
				case 'massbonus': $fr="����� �����:";break;
			}
			if($type==1 and $par and $i){
				$str = '<font class=weaponch><b>'.$fr.'</b></font>&nbsp;<select  name=pr['.$i.']>'.getOptionsSt($i).'</select><br>';
			}elseif($par and $i){
				$str = '<font class=weaponch><b>'.$fr.'</b></font>&nbsp;'.$par.'<br>';
			}			
			return $str;
		}
		function getArraySt($type){			
			$dmg = Array('0','1-1','5-5','10-10','15-15','20-20','30-30','50-50','100-100');
			$other = Array('0','1','2','3','4','5','10','25','50','75','100','150');
			if($type==1){return $dmg;}
			if($type==2){return $other;}
		}
		
		function getOptionsSt($i){
			$dmg = getArraySt(1);
			$other = getArraySt(2);
			$options = "";
			if($i==1){	
				for($b=0;$b<count($dmg);$b++){
					$options.='<option value="'.$b.'">'.$dmg[$b].'</option>';
				}
			}else{
				for($b=0;$b<count($other);$b++){
					$options.='<option value="'.$b.'">'.$other[$b].'</option>';
				}		
			}
			return $options;
		}
		
		function checkOptionsSt($i){
			$dmg = getArraySt(1);
			$other = getArraySt(2);
		}
		
		function calcParamPrice($par_arr,$type){
			$getstats = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `real_dd_adm` WHERE `id`='1' LIMIT 1;"));
			$stats = explode("|",$getstats['param_price']);
			$stats_arr = explode("|",$par_arr);			
			foreach($stats as $val){
				$param = explode("@",$val);
				$par[$param[0]] = $param[1];
			}
			foreach($stats_arr as $val_arr){
				$param_arr = explode("@",$val_arr);
				$npar[$param_arr[0]] = $param_arr[1];
			}
			$price = 0;
			for($i=1;$i<=73;$i++){
				if($i==72){$i='expbonus';}
				if($i==73){$i='massbonus';}
				if($i==1){
					//echo '<br>test-i:'.$i.'|test-par:'.$par[$i].'|test-npar:'.$npar[$i];
					$dmg = explode("-",$npar[$i]);
					if($par[$i]>0 and $dmg[0]>0){						
						$npr=$par[$i];$k=($getstats['kf']/100);
						for($b=1;$b<=$dmg[0];$b++){
							if($type!=1){$k=0.01;}
							$koeff = ($k * $b)+1;
							$nprice = round(($npr * $koeff),2);
							$price += $nprice;
						}	
					}
				}
				else{
					if($par[$i]>0 and $npar[$i]>0){
						//echo '<br>test-i:'.$i.'|test-par:'.$par[$i].'|test-npar:'.$npar[$i];
						$npr=$par[$i];$k=($getstats['kf']/100);
						for($b=1;$b<=$npar[$i];$b++){
							if($type!=1){$k=0.01;}
							$koeff = ($k * $b)+1;
							$nprice = round(($npr * $koeff),2);
							$price += $nprice;
						}						
					}
				}
				if($i=='expbonus'){$i=72;}
				if($i=='massbonus'){$i=73;}	
			}			
			return $price;
		}
		function calcNewParams($p_post,$p_user){
			$stats_post = explode("|",$p_post);
			$stats_user = explode("|",$p_user);
			
			foreach($stats_post as $val_post){
				$par_p = explode("@",$val_post);
				$par_post[$par_p[0]] = $par_p[1];
			}
			
			foreach($stats_user as $val_user){
				$par_u = explode("@",$val_user);
				$par_user[$par_u[0]] = $par_u[1];
			}
			
			$par = "";
			$par_str = "";
			for($i=1;$i<=73;$i++){				
				if($i==72){$i='expbonus';}
				if($i==73){$i='massbonus';}
				$par_str .= ShowParDD($i,$par_post[$i],0);
				if($par_post[$i] and $par_user[$i]){
					if($i==1){
						$dmg_post = explode("-",$par_post[$i]);
						$dmg_user = explode("-",$par_user[$i]);
						$par_post[$i] = $dmg_post[0];
						$par_user[$i] = $dmg_user[0];
						$par.=$i."@".($par_post[$i]+$par_user[$i])."-".($par_post[$i]+$par_user[$i])."|";
					}
					else{
						$par.=$i."@".($par_post[$i]+$par_user[$i])."|";
					}
				}else{
					if($i==1){
						$dmg_post = explode("-",$par_post[$i]);
						$dmg_user = explode("-",$par_user[$i]);
						$par_post[$i] = $dmg_post[0];
						$par_user[$i] = $dmg_user[0];
						if($par_post[$i]){
							$par.=$i."@".$par_post[$i]."-".$par_post[$i]."|";
						}elseif($par_user[$i]){
							$par.=$i."@".$par_user[$i]."-".$par_user[$i]."|";
						}
					}else{
						if($par_post[$i]){
							$par.=$i."@".$par_post[$i]."|";
						}elseif($par_user[$i]){
							$par.=$i."@".$par_user[$i]."|";
						}
					}
				}	
				if($i=='expbonus'){$i=72;}
				if($i=='massbonus'){$i=73;}
			}
			//echo '<br>TEST-post-par'.$p_post;
			//echo '<br>TEST-user-par'.$p_user;
			//echo '<br>TEST-new-par'.$par;
			$arr[0]=$par;
			$arr[1]=$par_str;			
			return $arr;
		}
if($_POST['dswi_id']){
	switch(intval($_POST['dswi_id'])){
	 case 1:
		//������� ��������� ���������� ������
		$pr = $_POST['pr'];
		$dmg = getArraySt(1);
		$other = getArraySt(2);
		for($i=1;$i<=73;$i++){
			if($i==72){$i='expbonus';}
			if($i==73){$i='massbonus';}
			if($pr[$i]!=""){
				if($i==1 and $dmg[$pr[$i]]){$par.=$i."@".$dmg[$pr[$i]]."|";}
				elseif($other[$pr[$i]]){$par.=$i."@".$other[$pr[$i]]."|";}
			}
			if($i=='expbonus'){$i=72;}
			if($i=='massbonus'){$i=73;}	
		}
		if($par){
		switch(intval($_POST['partype'])){
			case 1: $tp=1; break;
			case 2: $tp=2; break;
			default: $tp=2; break;
		}
		//��������� ��������� ������������
		/*$getstatsusr = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `real_dd_bonus` WHERE `pl_id`='".$player['id']."' LIMIT 1;"));
		if($getstatsusr['id']){
			if($tp==1){
				calcNewParams($par,$getstatsusr['param']);
			}
		}*/
		//������� ���� ������
		//	
		//$fullprice = calcParamPrice($par,$tp);
		//� ������ ���� ��������� �� ���� �� � ����� ��� ���-�� �������
		$usrprice = 0; $fullprice = 0;
		$getstatsusr = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `real_dd_bonus` WHERE `pl_id`='".$player['id']."' LIMIT 1;"));
		if($getstatsusr['id']){
			if($tp==1){
				$newparams = calcNewParams($par,$getstatsusr['param']);
				$par_str = $newparams[1];
				$par_new = $newparams[0];
				$fullprice = calcParamPrice($newparams[0],$tp);
				$usrprice = calcParamPrice($getstatsusr['param'],$tp);
			}elseif($getstatsusr['param_time']>time()){
				$newparams = calcNewParams($par,$getstatsusr['param_timed']);
				$par_str = $newparams[1];
				$par_new = $newparams[0];
				$fullprice = calcParamPrice($newparams[0],$tp);
				$usrprice = calcParamPrice($getstatsusr['param_timed'],$tp);
			}else{
				$newparams = calcNewParams($par,0);
				$par_str = $newparams[1];
				$par_new = $newparams[0];
				$fullprice = calcParamPrice($newparams[0],$tp);
				$usrprice = 0;
			}
			$price = round(($fullprice - $usrprice),2);
			$str = "";
			$hash = md5($tp.$_SESSION['user']['login'].$par_new.$price.$player['dd']);
			switch($tp){
				case 1: $str = "`tmp_hash`='".$hash."'"; break;
				case 2: $str = "`tmp_time_hash`='".$hash."'"; break;
			}
			mysqli_query($GLOBALS['db_link'],"UPDATE `real_dd_bonus` SET ".$str." WHERE `pl_id`='".$player['id']."' LIMIT 1;");
			echo'
				<script>
				parent.$(\'#basic-modal-content\').html(\'<div><input type=hidden name=type id=type value="'.$tp.'"><input type=hidden name=params id=params value="'.$par_new.'"><input type=hidden name=sum id=sum value="'.$price.'"><input type=hidden name=parstr id=parstr value="'.$par_str.'">�� �������� ��������� ���������:<br>'.$par_str.'<br>����: '.$price.' $<br><input type=button class=lbut value="��������" onClick="DDAdd();"></div>\');
				parent.ShowModal();
				</script>
			';
		}else{
			$newparams = calcNewParams($par,0);
			$par_str = $newparams[1];
			$par_new = $newparams[0];
			$fullprice = calcParamPrice($newparams[0],$tp);
			$usrprice = 0;
			$price = round(($fullprice - $usrprice),2);
			$str = "";
			$hash = md5($tp.$_SESSION['user']['login'].$par_new.$price.$player['dd']);
			switch($tp){
				case 1: $str = "(`pl_id`,`param`,`tmp_hash`) VALUES ('".$player['id']."','','".$hash."')"; break;
				case 2: $str = "(`pl_id`,`param_timed`,`param_time`,`tmp_time_hash`) VALUES ('".$player['id']."','','','".$hash."')"; break;
			}
			mysqli_query($GLOBALS['db_link'],"INSERT INTO `real_dd_bonus` ".$str.";");	
			echo'
				<script>
				parent.$(\'#basic-modal-content\').html(\'<div><input type=hidden name=type id=type value="'.$tp.'"><input type=hidden name=params id=params value="'.$par_new.'"><input type=hidden name=sum id=sum value="'.$price.'"><input type=hidden name=parstr id=parstr value="'.$par_str.'">�� �������� ��������� ���������:<br>'.$par_str.'<br>����: '.$price.' $<br><input type=button class=lbut value="��������" onClick="DDAdd();"></div>\');
				parent.ShowModal();
				</script>
			';
		}	
		}	
	 break;
	}
}

$getstatsusr = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `real_dd_bonus` WHERE `pl_id`='".$player['id']."' LIMIT 1;"));
$stats_user = explode("|",$getstatsusr['param']);
foreach($stats_user as $val_user){
	$par_u = explode("@",$val_user);
	$par_user[$par_u[0]] = $par_u[1];
}
if($getstatsusr['param_time']>time()){
	$stats_user_time = explode("|",$getstatsusr['param_timed']);
	foreach($stats_user_time as $val_user_time){
		$par_u_time = explode("@",$val_user_time);
		$par_user_time[$par_u_time[0]] = $par_u_time[1];
	}
}
$getstats = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `real_dd_adm` WHERE `id`='1' LIMIT 1;"));
$stats = explode("|",$getstats['param_price']);
foreach($stats as $val){
	$param = explode("@",$val);
	$par[$param[0]] = $param[1];
}
		echo '
		<font class=proce><font color=#222222>
		<FIELDSET style="background: white;" name="field_dealers" id="field_dealers">
		<LEGEND align=center style="background: white; -moz-border-radius: 8px;-webkit-border-radius: 8px;border-radius: 8px;border: solid 1px gray;"><b> <font color=gray>� ��� � ����� '.$player['baks'].' $</font> </b></LEGEND>
		<table cellpadding=0 cellspacing=0 border=0 width=100% bgcolor=#e0e0e0 align=center>
			<tr><td align=center>
				<form method=post action="?d_swi=11">
				<table border=0 cellpadding=4 cellspacing=1 bordercolor=#e0e0e0 align=center class="smallhead" width=100%>
					<tr class=nickname bgcolor=#EAEAEA>
						<td align=center width=100%><b>��� �� ������ ���������� �������������� ��������� ������ ���������</b></td>
					</tr>
					<tr class=nickname bgcolor=#EAEAEA><td>������������� ���������:';
					$str = "";
					for($i=1;$i<=73;$i++){
						//echo '<br>test-i:'.$i.'<br>';
						if($i==72){$i='expbonus';}
						if($i==73){$i='massbonus';}
						if(!$par_user[$i]){$par_user[$i]=0;}
						$str .= ShowParDD($i,$par_user[$i],0);
						if($i=='expbonus'){$i=72;}
						if($i=='massbonus'){$i=73;}
					}
					if($str){echo '<br>'.$str;}else{echo ' <b>���</b>';}
					echo'
					</td>
					</tr>
					<tr class=nickname bgcolor=#EAEAEA><td>����������� ���������'.($str?' (��������� ������: <b>'.date("d.m.y",$getstatsusr['param_time']).'</b>)':'').':';
					$str = "";
					for($i=1;$i<=73;$i++){
						//echo '<br>test-i:'.$i.'<br>';
						if($i==72){$i='expbonus';}
						if($i==73){$i='massbonus';}
						if(!$par_user_time[$i]){$par_user_time[$i]=0;}
						$str .= ShowParDD($i,$par_user_time[$i],0);
						if($i=='expbonus'){$i=72;}
						if($i=='massbonus'){$i=73;}
					}
					if($str){echo '<br>'.$str;}else{echo ' <b>���</b>';}
					echo'
					</td>
					</tr>
					<tr class=nickname bgcolor=#EAEAEA><td align=left width=100% bgcolor=white colspan=3>
					';
				for($i=1;$i<=73;$i++){
					//echo '<br>test-i:'.$i.'<br>';
					if($i==72){$i='expbonus';}
					if($i==73){$i='massbonus';}
					if(!$par[$i]){$par[$i]=0;}
					echo ShowParDD($i,$par[$i],1);
					if($i=='expbonus'){$i=72;}
					if($i=='massbonus'){$i=73;}
				}
		echo '</td></tr>
			<tr class=nickname bgcolor=#EAEAEA>
				<td align=center width=100%>
					<input type=hidden name=dswi_id value=1>
					��� �������: <select name=partype>
						<option value=1>��������</option>
						<option value=2>������ �� 30 ����</option>	
					</select>
					<input class=lbut name=koeffpercent type=submit value="���������">
				</td>
			</tr>
			<tr class=nickname bgcolor=#EAEAEA>
				<td align=center width=100%>
					<b>���� �������</b><br>
					��������: <font class=proce>���������� ��������� ����� ��������� � ��� ���������.</font><br>
					������ 30 ����: <font class=proce>���������� ��������� ����� ��������� � ��� �����������.<br>���� � ��� ��� ���� ������������ ��������� - ����� �������� �� �����!</font><br>
				</td>
			</tr>
		</table></form>	

			</td></tr>
		</table>
		</FIELDSET>
		';
		
		
		
		
		
		
		
		
		
		
?>