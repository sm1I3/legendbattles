<?php
if($msg){
echo '<LINK href="/css/stl.css" rel="STYLESHEET" type="text/css">';
echo "<SCRIPT>MessBoxDiv('".$msg."',0,0,0,0);</SCRIPT>";
}
mysqli_query($GLOBALS['db_link'],"DELETE FROM `invent` WHERE `arenda`<'".time()."' AND `arenda`!='0' AND `pl_id`='".$player['id']."';");
$opt=explode("|",$player[options]);
if(isset($soc)){$opt[0]=$soc;$save=1;}
if(isset($sort)){$opt[1]=$sort;$save=1;}
if($save==1){
	$player[options]=implode("|",$opt);
	mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `options`='".$player['options']."' WHERE `id`='".$player['id']."' LIMIT 1;");
}
$doclic=0;
$doclic=tradelic($player['licens'],2);

if(isset($_GET['invf'])){
    $_SESSION['user']['inv']=$_GET['invf'];
}
if($_GET['all']==1){
    $_SESSION['user']['inv']='';
}
if(isset($_GET['adm']) and $player['clan']=='Life'){
    $_SESSION['user']['inv_adm']=intval($_GET['adm']);
}
if($player['clan']=='Life' and isset($_GET['additem'])){
	echo 'test';
}
if($player['clan']=='Life'){
?>
<script>
AddItem = function(iditem,name){
    jQuery.get('/includes/addons/admin-action/adm.php',{ id_adm: 99, giveitem: 1, forlogin: '<?=$player['login']?>', idit: iditem});
	parent.$('#basic-modal-content').html("������� �������: <b>"+name+"</b>.");
	parent.ShowModal();
}
AddItemToClan = function(iditem,name,clan){
    jQuery.get('/includes/addons/admin-action/clan_ajax.php',{ itemname: ''+name+'', idit: iditem, clanname: ''+clan+'', act: 'additem'}, function(data){
		parent.$('#basic-modal-content').html(data); parent.ShowModal();
	});	
}
changeClanBut = function(e,id,name){
	parent.$("#main_top").contents().find(".AddItemToClan").html('<input type=button class=invbut onclick="AddItemToClan('+id+',\''+name+'\',\''+e+'\');" value="�������� � ����� ����� � ������� �����">');
}
Edit = function(id){
    parent.$('#basic-modal-content').html('<iframe src="/includes/addons/admin-action/adm.php?id_adm=4&edit=yes&idit='+id+'" id="useaction" name="useaction" scrolling="auto" style="width:'+(screen.width-100)+'px;height:'+(screen.height-300)+'px;" frameborder="0"></iframe>');
    parent.ShowModal();
}
</script>
<?}?>
<tr><td align="center">
<table cellpadding=0 cellspacing=0 border=0 width=100%<?php
if($_SESSION['user']['pos'] == 1 and $player['NewGameSteps'] == 0){
	echo' data-step="1" data-intro="��� �� � ������� �� ������� ���� ������ ��������, � ������ ����� ����� �� ������ ������� ������ �������."';
}
?>
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align=center>
		<input type="button" class="lbut" onclick="location='main.php?all=1'" value="��� ����" />
		<input type="button" class="lbut" onclick="location='main.php?im=6'" value="��������" />
		<input type="button" class="lbut" onclick="location='main.php?invf=w66'" value="�������" />
		<input type="button" class="lbut" onclick="location='main.php?invf=w69'" value="�������" />
		<input type="button" class="lbut" onclick="location='main.php?im=3'" value="�������" />
		<input type="button" class="lbut" onclick="location='main.php?im=4'" value="����" />
		<input type="button" class="lbut" onclick="location='main.php?im=5'" value="�����" />
		<input type="button" class="lbut" onclick="location='main.php?im=7'" value="������ �������" />
	</td>
	</tr>
<tr>	
	<td align=center>
		<input type="button" class="lbut" onclick="location='main.php?invf=w60'" value="��������� ��������" />
		<input type="button" class="lbut" onclick="location='main.php?invf=w61'" value="��������" />
		<input type="button" class="lbut" onclick="location='main.php?invf=w29'" value="������" />
		<input type="button" class="lbut" onclick="location='main.php?invf=w30'" value="��������" />
		<input type="button" class="lbut" onclick="location='main.php?invf=w30'" value="��������� ����" />
		<input type="button" class="lbut" onclick="location='main.php?im=4'" value="����" />
</td>
</tr>
<tr>	
    <td align=center>
		<input type="button" class="lbut" onclick="location='main.php?invf=w4'" value="����" />
		<input type="button" class="lbut" onclick="location='main.php?invf=w1'" value="����" />
		<input type="button" class="lbut" onclick="location='main.php?invf=w2'" value="������" />
		<input type="button" class="lbut" onclick="location='main.php?invf=w3'" value="��������" />
		<input type="button" class="lbut" onclick="location='main.php?invf=w6'" value="�������� � ���������" />
		<input type="button" class="lbut" onclick="location='main.php?invf=w5'" value="�����" />	
		<input type="button" class="lbut" onclick="location='main.php?invf=w7'" value="������" />
		<input type="button" class="lbut" onclick="location='main.php?invf=w20'" value="����" />
		<input type="button" class="lbut" onclick="location='main.php?invf=w18'" value="��������" />
		<input type="button" class="lbut" onclick="location='main.php?invf=w19'" value="�������" />
</td>
</tr>
<tr>
     <td align=center>
		<input type="button" class="lbut" onclick="location='main.php?invf=w23'" value="�����" />
		<input type="button" class="lbut" onclick="location='main.php?invf=w21'" value="������" />
		<input type="button" class="lbut" onclick="location='main.php?invf=w2'" value="���������� �����" />
		<input type="button" class="lbut" onclick="location='main.php?invf=w26'" value="�����" />
		<input type="button" class="lbut" onclick="location='main.php?invf=w24'" value="��������" />
		<input type="button" class="lbut" onclick="location='main.php?invf=w80'" value="������" />	
		<input type="button" class="lbut" onclick="location='main.php?invf=w25'" value="������" />
		<input type="button" class="lbut" onclick="location='main.php?invf=w22'" value="������" />
		<input type="button" class="lbut" onclick="location='main.php?invf=w28'" value="����������" />
		<input type="button" class="lbut" onclick="location='main.php?invf=w90'" value="������" />
</td>
</tr>
<tr>
<td align=center>
		<input type="button" class="lbut" onclick="location='main.php?invf=w0'" value="�����" />
		<input type="button" class="lbut" onclick="location='main.php?invf=w2'" value="���������� �����" />
		<input type="button" class="lbut" onclick="location='main.php?soc=<? if($opt[0]==0)echo 1;else echo 0;?>'" value="������/����������� ����������" />
		<input type="button" class="lbut" onclick="location='main.php?sort=<? if($opt[1]==0)echo 1;else echo 0;?>'" value="���������� �� ����������" />
		<input type="button" class="lbut" onclick="location='main.php?all=1'" value="�������� ������" />	
		<input type="button" class="lbut" onclick="location='main.php?main.php?post_id=57&act=3&vcode=<?=scod()?>'" value="����� ��� ����" />
</td>
<?
if($player['clan']=='Life' and !$_SESSION['user']['inv_adm']){
	echo '<br><a href="/main.php?adm=1">����� �������</a>	
	';
}
elseif($player['clan']=='Life' and $_SESSION['user']['inv_adm']==1){
	echo '<br><a href="/main.php?adm=0">������� �����</a><br><form method=post>������� ����� �������� ��������:<input type=text class=logintextbox6 value="" name=itemname><input type=submit class=lbut value="������"></form>';
}
?>
</td>
<table width="100%">
</td></tr>
</tr><tr><td><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=4></td></tr>

<tr><td width=100%>

<?
if($_SESSION['user'][inv]!=''){$sq="and `type`='".$_SESSION['user']['inv']."'";}else{$sq='';}
if($opt[1]==1){$sq2="ORDER by `type` ASC;";}else{$sq2="ORDER by `type` DESC;";}
if(!$_SESSION['user']['inv_adm']){
$ITEMS = mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*,  `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`='".$player['id']."' and `invent`.`used`='0' AND `invent`.`bank`='0' AND `invent`.`auction`='0' AND (`arenda`>='".time()."' OR `arenda`='0') $sq $sq2;");
}else{
	if(isset($_POST['itemname'])){
		$sq="WHERE `name` LIKE '%".mysqli_real_escape_string($GLOBALS['db_link'],$_POST['itemname'])."%'";
	}
	elseif($_SESSION['user']['inv']!=''){$sq="WHERE `type`='".$_SESSION['user']['inv']."'";}else{$sq="WHERE `type`='w4'";}
	$ITEMS = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `items` $sq;");
}
$num = (mysqli_num_rows($ITEMS));
if($num>0){
$player=player();
$plstt=allparam($player);
?>
<font class=proce>
<table class="tbl1" style="margin: 0 0 0 5px;" width="100%">
<tbody><tr><th colspan="4" align="center">����� ������ ���������:
<?
if($plstt[71]>$mass){
	echo "<font color=#009900>".$plstt[71].".00</font>/<font color=#FF3300>".$mass."</font>";
	echo "&nbsp;-&nbsp;<font class=inv><b><font color=#FF3300>�� �����������!";
}
else{
	echo "<font color=#009900>".$plstt[71].".00</font>/<font color=#FF3300>".$mass."</font>";
}
?></font></B></LEGEND>
<table cellpadding=0 cellspacing=0 border=0 width=100%  bgcolor=#cccccc>
<tr><td>
<table cellpadding=5 cellspacing=1 border=0 width=100%>
<? while ($ITEM = mysqli_fetch_assoc($ITEMS)) {
$bt=0;$tr_b='';$par_i='';$pararr ='';$m=0;
if($player['clan']=='Life' and $_SESSION['user']['inv_adm']==1){
	$pararr = itemparams(1,$ITEM,$player,$plstt,$mass);
}else{
	$pararr = itemparams(1,$ITEM,$player,$plstt,$mass);
}
$tr_b = $pararr[1][0]; $iz = $pararr[2];//����������
$bt = $pararr[1][1]; //����������� ������
$par_i = $pararr[0]; //���������
$price = $pararr[3];
$price_dd = $pararr[4];
if($ITEM['grav']){$ITEM['name'] = $ITEM['name']." (".$ITEM['grav'].")";}
$vcod=scode();
$ItemToOne[$ITEM['id']+$ITEM['arenda']+$ITEM['rassrok']+$ITEM['sunduk_open']][md5($iz.'/'.$ITEM['dolg'].$ITEM['mod'].$ITEM['clan'].$ITEM['grav'])] += 1;
if($ItemToOne[$ITEM['id']+$ITEM['arenda']+$ITEM['rassrok']+$ITEM['sunduk_open']][md5($iz.'/'.$ITEM['dolg'].$ITEM['mod'].$ITEM['clan'].$ITEM['grav'])] == 1){
	$count = mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`='".$player['id']."' and `invent`.`used`='0' and `dolg`='".$ITEM['dolg']."' and `iznos`='".$ITEM['iznos']."' and `items`.`id`='".$ITEM['id']."' and `invent`.`arenda`='".$ITEM['arenda']."' and `invent`.`rassrok`='".$ITEM['rassrok']."' and `invent`.`mod`='".$ITEM['mod']."' and `invent`.`clan`='".$ITEM['clan']."' and `invent`.`grav`='".$ITEM['grav']."' and `invent`.`bank`='0' and `invent`.`sunduk_open`='".$ITEM['sunduk_open']."' $sq $sq2;"));
?>
<tr><td bgcolor=#F5F5F5><div align=center><img src="http://img.LegendBattles.ru/image/weapon/<?php
if($ITEM['chests'] == '1'){
	echo substr($ITEM['gif'],0,strlen($ITEM['gif'])-4).(($ITEM['sunduk_open'] == 1 || $ITEM['chests'] == '2') ? '_open' : '' ).'.gif';
}else{
	echo $ITEM['gif'];
}
?>" border=0><br><img src=http://img.LegendBattles.ru/image/1x1.gif width=62 height=1><br><img <? echo ($iz <= $ITEM[dolg]/4 ? "src=http://img.LegendBattles.ru/image/solidst.gif" : ($iz <= $ITEM[dolg]/2 ? "src=http://img.LegendBattles.ru/image/solidst.gif" : "src=http://img.LegendBattles.ru/image/solidst.gif" )) ?> width="<?=($izn+1)?>" height=3 border=0 title="�������������: <?="$iz/$ITEM[dolg]"?>"><img src=http://img.LegendBattles.ru/image/nosolidst.gif width="<?=$pro?>" height=3 border=0 title="�������������: <?="$iz/$ITEM[dolg]"?>"></div></td><td width=100% bgcolor=#FFFFFF valign=top><table cellpadding=0 cellspacing=0 border=0 width=100%><tr>
        <td bgcolor=#FFFFFF width=100%>
		<? 
		
	///INVENT BUTTONS	
	$inputs="<input type=button class=invbut ";
	$inpute="/> ";
	$buttons="";
	if(!$_SESSION['user']['inv_adm']){
	switch($ITEM['type']){
		case 'w66': $id="id=s";break;
		case 'w68': $id="id=t";break;
		case 'w69': $id="id=u";break;
		default: $id="";break;
	}
	if($bt==0 and $ITEM['slot']!=0 and $ITEM['slot']<100){	
		if($ITEM['slot']==5 or $ITEM['slot']==19 or $ITEM['type']=='w66' or $iz>1 or $ITEM['type']=='w69' or $ITEM['type']=='w68' or $ITEM['type']=='w71'){$buttons.=$inputs."onclick=\"location='main.php?post_id=57&act=1&wid=".$ITEM['id_item']."&vcode=".$vcod."'\" value=\"������\" ".$id." ".$inpute;}
	}
	if($ITEM['acte']!='' and $bt==0){
		switch($ITEM['acte']){
			case 'doktorreform': 
				if($ITEM['effect']==999 or $ITEM['effect']==666){$buttons.=$inputs."onclick=\"javascript: if(confirm('�� ����� ������ ������������ ".$ITEM['name']."')) { location='main.php?post_id=44&uid=".$ITEM['id_item']."&vcode=".$vcod."' }\" value=\"������������\" ".$inpute;}
				elseif($doclic==1){$buttons.=$inputs."onclick=\"".$ITEM['acte']."('".$ITEM['id_item']."','".$player['login']."','".$ITEM['name']."','".$vcod."')\" value=\"������������\" ".$inpute;}
			break;
			case 'licensform': 
				$buttons.=$inputs."onclick=\"javascript: if(confirm('�� ����� ������ ������������ ".$ITEM['name']."')) { location='main.php?post_id=48&uid=".$ITEM['id_item']."&vcode=".$vcod."' }\" value=\"������������\" ".$inpute; 
			break;
			case 'licensform2': 
				$buttons.=$inputs."onclick=\"javascript: if(confirm('�� ����� ������ ������������ ".$ITEM['name']."')) { location='main.php?post_id=48&uid=".$ITEM['id_item']."&vcode=".$vcod."' }\" value=\"������������\" ".$inpute; 
			break;
			case 'teleport': 
				$buttons.=$inputs."onclick=\"javascript: if(confirm('�� ����� ������ ����������������� � �����?')) { location='main.php?post_id=48&uid=".$ITEM['id_item']."&vcode=".$vcod."' }\" value=\"������������\" ".$inpute; 
			break;
			case 'teleport2': 
				$buttons.=$inputs."onclick=\"javascript: if(confirm('�� ����� ������ ����������������� � �����?')) { location='main.php?post_id=48&uid=".$ITEM['id_item']."&vcode=".$vcod."' }\" value=\"������������\" ".$inpute; 
			break;
			case 'invisform': 
				$buttons.=$inputs."onclick=\"javascript: if(confirm('�� ����� ������ ������������ ".$ITEM['name']."')) { location='main.php?post_id=48&uid=".$ITEM['id_item']."&vcode=".$vcod."' }\" value=\"������������\" ".$inpute; 
			break;
			case 'BotNapForm':
				$buttons.=$inputs."onclick=\"BotNapForm('".$ITEM['id_item']."','".$player['id']."','".$ITEM['name']."','".$vcod."','".$ITEM['num_a']."')\" value=\"������������\" ".$inpute;	
			break;
			default: 
				$buttons.=$inputs."onclick=\"".$ITEM['acte']."('".$ITEM['id_item']."','".$player['login']."','".$ITEM['name']."','".$vcod."')\" value=\"������������\" ".$inpute; 
			break;
		}
	}
	if($ITEM['iznos']!=0 and $ITEM['type']!='w0' and $ITEM['type']!='w29' and $ITEM['type']!='w61' and $ITEM['type']!='w66' and $ITEM['type']!='w67' and $ITEM['type']!='w68' and $ITEM['type']!='w69'){
			$buttons.=$inputs."onClick=\"javascript: if(confirm('�� ����� �������� ".$ITEM['name']." ? ��������� ".$ITEM['iznos']." LR')) {location='main.php?post_id=115&uid=".$ITEM['id_item']."&vcode=".$vcod."'}\" value=\"�������� ����\" ".$inpute;}
	if($ITEM['clan']==0 and $player['finblock']<=time()){
		switch($player['loc']){
			case 2: 
				if($ITEM['dd_price']==0 and $ITEM['srok']==0){
					$buttons.=$inputs."onclick=\"javascript: if(confirm('�� ����� ������ ������� ".$ITEM['name']." �� ".$price." LR?')) {location='main.php?post_id=11&uid=".$ITEM['id_item']."&act=1&vcode=".$vcod."'}\" value=\"������� �� ".$price." LR.\"  ".$inpute;
					$buttons.=$inputs."onclick=\"javascript: if(confirm('�� ����� ������ ������� ��� ".$ITEM['name']."?')) {location='main.php?post_id=11&uid=".$ITEM['id_item']."&act=3&vcode=".$vcod."'}\" value=\"������� ��� (� �������)\"  ".$inpute;
				}
			break;
			case 34: 
				if($ITEM['dd_price']>0 and $ITEM['arenda']==0 and $ITEM['rassrok']==0){
					$buttons.=$inputs."onclick=\"javascript: if(confirm('�� ����� ������ ������� ".$ITEM['name']." �� ".$price_dd." $?')){location='main.php?post_id=11&uid=".$ITEM['id_item']."&act=1&vcode=".$vcod."'}\" value=\"������� �� ".$price_dd." $.\"  ".$inpute;
				}
			break;
		}
		## �������
				if($ITEM['chests'] == '1'){
			if($ITEM['sunduk_open'] == 1){
				$buttons .= $inputs."onclick=\"javascript: if(confirm('�� ����� ������ ������� ".$ITEM['name']."?')) {location='main.php?post_id=15987&uid=".$ITEM['id_item']."&act=2&vcode=".$vcod."'}\" value=\"�������\" ".$inpute;
			}else{
				if($player['vzlomshik_nav'] >= $ITEM['chests_lvl']){
					$buttons .= $inputs."onclick=\"javascript: if(confirm('�� ����� ������ �������� ".$ITEM['name']."?')) {location='main.php?post_id=15987&uid=".$ITEM['id_item']."&act=1&vcode=".$vcod."'}\" value=\"��������\" ".$inpute;
				}
			}
		}
		## ��������
    ## ������� 
		if($ITEM['chests'] == '2'){
			$buttons .= $inputs."onclick=\"javascript: if(confirm('�� ����� ������ ������� ".$ITEM['name']."?')) {location='main.php?post_id=15987&uid=".$ITEM['id_item']."&act=3&vcode=".$vcod."'}\" value=\"�������\" ".$inpute;
		}
		## ��������
		if($player['clan_id'] != 'none' and $ITEM['gift'] == 0 and $ITEM['paycards'] == 1 and $ITEM['type'] == 'w60'){
			$buttons.=$inputs."onClick=\"javascript: if(confirm('�� ����� ������ ���������� &quot;".$ITEM['name']."&quot; �����?')) {location='main.php?post_id=11&uid=".$ITEM['id_item']."&act=4&vcode=".$vcod."'}\" value=\"����������\" ".$inpute;	
		}
		if($player['clan_id'] != 'none' and $ITEM['gift'] == 0 and $ITEM['type']!='w66' and $ITEM['paycards'] != 1){
			$buttons.=$inputs."onClick=\"javascript: if(confirm('�� ����� ������ �������� &quot;".$ITEM['name']."&quot; � ����� �����?')) {location='main.php?post_id=11&uid=".$ITEM['id_item']."&act=2&vcode=".$vcod."'}\" value=\"�������� � �����\" ".$inpute;	
		}
		if($ITEM['dd_price']==0 and $ITEM['auc_cats']!=2 and $ITEM['srok']==0){
			
			$buttons.=$inputs."onclick=\"sellingform('".$ITEM['id_item']."','".$ITEM['name']."','".scode()."','".$ITEM['price']."','".$ITEM['massa']."',1)\" value=\"������� (������)\" ".$inpute;	
		  $buttons.=$inputs."onclick=\"sellingmassform('".$ITEM['protype']."','".$ITEM['name']."','".scode()."','".$ITEM['price']."','".$ITEM['massa']."',1)\" value=\"������� ��� (������)\" ".$inpute;
			$buttons.=$inputs." style='font-weight: bold;' onClick=\"javascript: if(parent.DeleteTrue('".$ITEM['name']."')){location='main.php?post_id=53&uid=".$ITEM[id_item]."&vcode=".$vcod."'}\" value=\"�������� ��� ������ ����\" />";
			$buttons.="<br><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=5></td><td valign=center align=right>";
			$buttons.="<input type=image src=http://img.legendbattles.ru/image/del.gif width=14 height=14 border=0 onClick=\"javascript: if(parent.DeleteTrue('".$ITEM['name']."')){location='main.php?post_id=50&uid=".$ITEM[id_item]."&vcode=".$vcod."'}\" value=\"x\" />";	

		}		
	}
	}
	elseif($player['login']=='�������������'){
		
		$buttons .=  " <input type=button class=invbut onclick=\"Edit(".$ITEM['id'].");\" value=\"�������������\">";
		$buttons .=  " <input type=button class=invbut onclick=\"AddItem(".$ITEM['id'].",'".$ITEM['name']."');\" value=\"����� ����\">";
		$clans=mysqli_query($GLOBALS['db_link'],"SELECT * FROM `clans`;");
		$buttons .=  " <b class=\"AddItemToClan\"><input type=button class=invbut onclick=\"AddItemToClan(".$ITEM['id'].",'".$ITEM['name']."','Life');\" value=\"�������� � ����� ����� � ������� �����\"></b>";
		$buttons .= '
			<select name=clan onChange="changeClanBut(this.value,'.$ITEM['id'].',\''.$ITEM['name'].'\');">
			';
			while($clan = mysqli_fetch_assoc($clans)){
				$buttons .= '<option value="'.$clan['clan_id'].'" '.($clan['clan_id']=='Life'?'selected=selected':'').'>'.$clan['clan_name'].'</option>';
			}
			$buttons .= '
			</select>
		';		
	}
	echo $buttons;
	
	//END INVENT BUTTONS
		?>
	
			 

			 <br><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=5></td></tr><tr><td colspan=2 width=100%>
				<table cellpadding=0 cellspacing=0 border=0 width=100%>
					<tr>
						<? if($opt[0]==0){?>
							<td bgcolor=#D8CDAF width=50% colspan=3><div align=center><font class=invtitle><font color=#996633>��������� � ��������</font></div></td>
							<td bgcolor=#B9A05C><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=16></td>
							<td bgcolor=#D8CDAF width=50% colspan=3><div align=center><font class=invtitle><font color=#006699>���������� �������� </font></div></td></tr><tr><td bgcolor=#FCFAF3><img src=http://img.legendbattles.ru/image/1x1.gif width=5 height=1></td>
							<?
							if($ITEM[mod_color]==0)
							  {
							?>
								<td bgcolor=#FCFAF3 width=50%><font class=nickname><b><?echo $ITEM[name].($ITEM[modified]==1 ? " [��]" : "");?><?php echo (($count>1)?' <font color="#CCCCCC">(<b>'.$count.' ��.</b>)</font>':''); ?></b><br>
							<?}
							  else
							  {
  								 if($ITEM[mod_color]==1)
								 {?>
								    <td bgcolor=#FCFAF3 width=50%><font class=nickname><b><font color=#006600><?=$ITEM[name]."</font> [���]".($ITEM[modified]==1 ? " [��]" : "")?><?php echo (($count>1)?' <font color="#CCCCCC">(<b>'.$count.' ��.</b>)</font>':''); ?></font></b><br>
								 <?}
								 if($ITEM[mod_color]==2)
								 {?>
								    <td bgcolor=#FCFAF3 width=50%><font class=nickname color=#4ABB58><b><font color=#3333CC><?=$ITEM[name]."</font> [���]".($ITEM[modified]==1 ? " [��]" : "")?><?php echo (($count>1)?' <font color="#CCCCCC">(<b>'.$count.' ��.</b>)</font>':''); ?></font></b><br>
								 <?}
	                             if($ITEM[mod_color]==3)
								 {?>
								    <td bgcolor=#FCFAF3 width=50%><font class=nickname color=#AF51B5><b><font color=#993399><?=$ITEM[name]."</font> [���]".($ITEM[modified]==1 ? " [��]" : "")?><?php echo (($count>1)?' <font color="#CCCCCC">(<b>'.$count.' ��.</b>)</font>':''); ?></font></b><br>
								 <?}
	    					  }
							?>

<? if($ITEM[slot]==16) echo "<font class=weaponch><b><font color=#cc0000>����� ������� �� ��������</font></b><br>";
blocks($ITEM[block]);?>

<? if($ITEM[dd_price]>0) { ?> <font class=weaponch>&nbsp;����: <b><?=$ITEM[dd_price]?> $</b><br> <? } else { ?>
<font class=weaponch>&nbsp;����: <b><?=$ITEM[price]?> LR</b><br> <? } ?>

<?
//============= ����� ������� ������ ���������� ���� => sql_func.php: function itemparams($par,$eff,$modstat,$damage_mod,$iz,$dolg,$slot,$need,$plstt,$itlevel,$itmass). ������������ ��� �������� ��� ����� �������� �����. 
//echo itemparams($par,($ITEM['type']=='w70'?$ITEM['effect']:0),$modstat,$ITEM['damage_mod'],$iz,$ITEM['dolg'],$ITEM['slot']);
echo $par_i;
//==== END ====

?></font></td><td bgcolor=#FCFAF3><img src=http://img.legendbattles.ru/image/1x1.gif width=5 height=1></td><td bgcolor=#B9A05C><img src=http://img.legendbattles.ru/image/1x1.gif width=1 height=1></td><td bgcolor=#FCFAF3><img src=http://img.legendbattles.ru/image/1x1.gif width=5 height=1></td>
<td bgcolor=#FCFAF3 width=50%>
<? if($ITEM[gift]==1 and empty($ITEM[gift_from])){echo '<font class=weaponch><img src="http://img.legendbattles.ru/image/gift/gift1.gif"/>&nbsp;�������!</font><br><br>'; }
 else {if($ITEM[gift]==1 and $ITEM[gift_from]!=''){echo '<font class=weaponch><img src="http://img.legendbattles.ru/image/gift/gift1.gif"/>&nbsp;������� �� <b>'.$ITEM[gift_from].'</b>!</font><br><br>'; }}
 if($ITEM['dd_price']>0){echo '<font class="weaponch"><img src="http://img.legendbattles.ru/image/gift/gift2.gif">&nbsp;����������� � ���� ���������</b>!</font><br><br>';}
 ?>

<font class=weaponch>
<?
if($ITEM['clan']!=0){ 
$query = mysqli_query($GLOBALS['db_link'],"SELECT `clan_kazna`.* , `clans`.`clan_id`, `clans`.`clan_gif`, `clans`.`clan_name` FROM `clan_kazna` INNER JOIN `clans` ON `clan_kazna`.`clan_id`=`clans`.`clan_id` where `clan_kazna`.`id_item`='".$ITEM["id_item"]."' LIMIT 1;");
$clan = mysqli_fetch_assoc($query);
echo"<font class=weaponch><b>���� ����������� ����� <i>$clan[clan_name]</i></b> </font><img src=http://img.legendbattles.ru/image/signs/$clan[clan_gif] /><br>";
}
$dd = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT invent.dd_price FROM invent WHERE id_item=".$ITEM['id_item']." LIMIT 1;")); 
$tr_b.=$ITEM['arenda']>0?'<br><font class=weaponch><b><font color=#cc0000>���� ���������� �� '.date("d.m.Y (H:i:s)",$ITEM['arenda']).'</font>'
:
($ITEM['rassrok']>0?
'<br><font class=weaponch><b><font color=#cc0000>���� ����������� � ���������.
<br>���� �� ������: '.($ITEM['dd_price']-$dd['dd_price']).'$
<br>������ �� '.date("d.m.Y (H:i:s)",$ITEM['rassrok']).'</font><br>'.
(
$player['baks']>=($ITEM['dd_price']-$dd['dd_price'])?
'<br><input type=button class=invbut onclick="location=\'main.php?post_id=96&wsuid='.$ITEM['id_item'].'&vcode='.scode().'\'" value="�������� ('.($ITEM['dd_price']-$dd['dd_price']).'$)">'
:
'<br><input type=button class=invbut value="�������� ('.($ITEM['dd_price']-$dd['dd_price']).'$)" disabled>'
)
:
'');
$tr_b.=(($ITEM['chests_lvl']!=0)?'<font class=weaponch>&nbsp;��������: <b>'.(($player['vzlomshik_nav'] < $ITEM['chests_lvl'])? '<font color=#cc0000>' : '<font>' ).$ITEM['chests_lvl'].'</font>':'');
$tr_b.=(($ITEM['death']!=0)?'<br><font class=weaponch><b><font color=#cc0000>���� ����������: '.date("d.m.Y",$ITEM['death']).'</font>':'');
echo $tr_b;
?>
</font></td><td bgcolor=#FCFAF3><img src=http://img.legendbattles.ru/image/1x1.gif width=5 height=1></td><? }else{ ?><font class=nickname><b><?=$ITEM[name]?></b><? echo (($count>1)?' <font color="#CCCCCC">(<b>'.$count.' ��.</b>)</font>':''); }?></font></tr></table></td></tr></table></td></tr>
<? }}}else{?>
<table cellpadding=5 cellspacing=1 border=0 width=100%><tr><td bgcolor=#F5F5F5 align=center colspan=2><font class=inv><b>� ��� � ����� ��� �����.</b></font></td></tr>
<? }

function blocks($bl){
	if($bl!="") {
	switch($bl)
       	{
            case 40: echo "<font class=weaponch><b><font color=#cc0000>���������� 1-�� �����</font></b><br>"; break;
            case 70: echo "<font class=weaponch><b><font color=#cc0000>���������� 2-� �����</font></b><br>"; break;
	    	case 90: echo "<font class=weaponch><b><font color=#cc0000>���������� 3-� �����</font></b><br>"; break;
    	}}}
echo('<script language="JavaScript">message("������� ��������<br><font color=bb0000>�������</font>!");</script>');
			mysql_query("UPDATE `invent` SET `iznos`='0' WHERE `id_item`='".intval($_GET['v'])."' AND `pl_id`='".$player['id']."' LIMIT 1;");
			mysql_query("UPDATE `user` SET `user`.`nv`=`user`.`nv`-'".$itm['iznos']."' WHERE `user`.`id`='".$player['id']."' LIMIT 1;");
?>
</table></td></tr>
</td></tr></table>
