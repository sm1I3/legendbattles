<?php
if($msg){
echo '<LINK href="/css/stl.css" rel="STYLESHEET" type="text/css">';
echo "<SCRIPT>MessBoxDiv('".$msg."',0,0,0,0);</SCRIPT>";
}
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
?>
<tr><td align="center">
<table cellpadding=0 cellspacing=0 border=0 width=100%>
<tr></tr><td align="center"><a href="/main.php?all=1"><img src="img/image/gameplay/invent/0.gif" width="44" height="53" title="��� ����"  class="cath" border="0" /></a><a href="/main.php?invf=w70"><img src="img/image/gameplay/invent/6.gif" width="41" height="53" title="�������� � ����" class="cath" border="0" /></a><a href="/main.php?invf=w66"><img src="img/image/gameplay/invent/1.gif" width="41" height="53" title="�������" class="cath" border="0" /></a><a href="/main.php?invf=w69"><img src="img/image/gameplay/invent/2.gif" width="41" height="53" title="�������" class="cath" border="0" /></a><a href="/main.php?invf=w71"><img src="img/image/gameplay/invent/3.gif" width="41" height="53" title="����" class="cath" border="0" /></a><a href="/main.php?invf=w68"><img src="img/image/gameplay/invent/4.gif" width="41" height="53" title="���" class="cath" border="0" /></a><a href="/main.php?invf=5"><img src="img/image/gameplay/invent/5.gif" width="41" height="53" title="�����" class="cath" border="0" /></a><a href="/main.php?invf=7"><img src="img/image/gameplay/invent/7.gif" width="41" height="53" title="������ �������" border="0" /></a><a href="main.php?invf=w60"><img src=img/image/gameplay/invent/23.gif width=41 height=53 title="��������� ��������" border="0"></a><a href="main.php?invf=w61"><img src=img/image/gameplay/invent/8.gif width=41 height=53 title="��������"  border="0"></a><a href="main.php?invf=w29"><img src=img/image/gameplay/shops/svit.gif width=41 height=53 title="������" border="0"></a><a href="main.php?invf=w30"><img src=img/image/gameplay/invent/10.gif width=41 height=53 title="��������" border="0"></a><a href="main.php?invf=w62"><img src=img/image/gameplay/invent/db.gif width=41 height=53 title="�������" border="0"></a></td></tr></td></tr><tr><td><img src=img/image/1x1.gif width=1 height=4></td></tr><tr><td align="center"><a href="main.php?invf=w4"><img src=img/image/gameplay/invent/cat/0.gif width=44 height=53 title="����" class=cath border=0></a><a href="main.php?invf=w1"><img src=img/image/gameplay/invent/cat/1.gif width=41 height=53 title="����" class=cath border=0></a><a href="main.php?invf=w2"><img src=img/image/gameplay/invent/cat/2.gif width=41 height=53 title="������" class=cath border=0></a><a href="main.php?invf=w3"><img src=img/image/gameplay/invent/cat/3.gif width=41 height=53 title="��������" class=cath border=0></a><a href="main.php?invf=w6"><img src=img/image/gameplay/invent/cat/4.gif width=41 height=53 title="�������� � ���������" class=cath border=0></a><a href="main.php?invf=w5"><img src=img/image/gameplay/shop/missle.gif width=41 height=53 title="�����" class=cath border=0></a><a href="main.php?invf=w7"><img src=img/image/gameplay/invent/cat/6.gif width=41 height=53 title="������" class=cath border=0></a><a href="main.php?invf=w20"><img src=img/image/gameplay/invent/cat/7.gif width=41 height=53 title="����" class=cath border=0></a><a href="main.php?invf=w18"><img src=img/image/gameplay/invent/cat/10.gif width=41 height=53 title="��������" class=cath border=0></a><a href="main.php?invf=w19"><img src=img/image/gameplay/invent/cat/11.gif width=41 height=53 title="�������" class=cath border=0></a><a href="main.php?invf=w23"><img src=img/image/gameplay/invent/cat/8.gif width=41 height=53 title="�����" class=cath border=0></a><a href="main.php?invf=w21"><img src=img/image/gameplay/invent/cat/14.gif width=41 height=53 title="������" class=cath border=0></a><a href="main.php?invf=w21"><img src=img/image/gameplay/invent/cat/mgb.gif width=41 height=53 title="���������� �����" class=cath border=0></a></td></tr><tr><td><img src=img/image/1x1.gif width=1 height=4></td></tr><tr><td align="center"><a href="main.php?invf=w26"><img src=img/image/gameplay/invent/cat/9.gif width=44 height=53 title="�����" class=cath border=0></a><a href="main.php?invf=w24"><img src=img/image/gameplay/invent/cat/12.gif width=41 height=53 title="��������" class=cath border=0></a><a href="main.php?invf=w80"><img src=img/image/gameplay/invent/cat/13.gif width=41 height=53 title="���� �����" class=cath border=0></a><a href="main.php?invf=w25"><img src=img/image/gameplay/invent/cat/15.gif width=41 height=53 title="������" class=cath border=0></a><a href="main.php?invf=w22"><img src=img/image/gameplay/invent/cat/16.gif width=41 height=53 title="������" class=cath border=0></a><a href="main.php?invf=w28"><img src=img/image/gameplay/invent/cat/17.gif width=41 height=53 title="����������" class=cath border=0></a><a href="main.php?invf=w90"><img src=img/image/gameplay/shop/knee_guard.gif width=41 height=53 title="������" class=cath border=0></a><a href="main.php?invf=w0"><img src=img/image/gameplay/invent/cat/21.gif width=41 height=53 title="�����" class=cath border=0></a><a href="main.php?invf=w0"><img src=img/image/gameplay/invent/cat/inv_set.gif width=41 height=53 title="����" class=cath border=0></a><a href="main.php?soc=<? if($opt[0]==0)echo 1;else echo 0;?>"><img src=img/image/gameplay/invent/cat/b1.gif width=41 height=53 title="������ / ����������� ����������" class=cath border=0></a><a href="main.php?sort=<? if($opt[1]==0)echo 1;else echo 0;?>"><img src=img/image/gameplay/invent/cat/b2.gif width=41 height=53 title="���������� �� ����������" class=cath border=0></a><a href="main.php?all=1"><img src=img/image/gameplay/invent/cat/b3.gif width=41 height=53 title="�������� ������" class=cath border=0></a><a href="main.php?post_id=57&act=3&vcode=<?=scode()?>"><img src=img/image/gameplay/invent/cat/b0.gif width=41 height=53 title="����� ��� ����" class=cath border=0 /></a></td>
</td>
<table width="100%">
</td></tr>
</tr><tr><td><img src=img/image/1x1.gif width=1 height=4></td></tr>

<tr><td width=100%>

<?
if($_SESSION['user']['inv']!=''){$sq="and `type`='".$_SESSION['user']['inv']."'";}else{$sq='';}
if($opt[1]==1){$sq2="ORDER by `type` ASC;";}else{$sq2="ORDER by `type` DESC;";}
$ITEMS = mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*,  `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`='".$player['id']."' and `invent`.`used`='0' AND `invent`.`bank`='0' AND `invent`.`auction`='0' AND (`arenda`>='".time()."' OR `arenda`='0') $sq $sq2;");
$num = (mysqli_num_rows($ITEMS));
if($num>0){
$player=player();
$plstt=allparam($player);
?>
<div class="block info">
	<div class="header">
		<span>����� ������ ���������:  <?
if($plstt[71]>$mass){
	echo "<font color=#009900>".$plstt[71]."</font>/<font color=#FF3300>".$mass."</font>";
	echo "&nbsp;-&nbsp;<font class=inv><b><font color=#FF3300>�� �����������!";
}
else{
	echo "<font color=#009900>".$plstt[71]."</font>/<font color=#FF3300>".$mass."</font>";
}
?></span>
	</div></B>
<table cellpadding=0 cellspacing=0 border=0 width=100%  bgcolor=#cccccc>
<tr><td>
<table cellpadding=5 cellspacing=1 border=0 width=100%>
<? while ($ITEM = mysqli_fetch_assoc($ITEMS)) {
$bt=0;$tr_b='';$par_i='';$pararr ='';$m=0;
$pararr = itemparams(1,$ITEM,$player,$plstt,$mass);
$tr_b = $pararr[1][0]; $iz = $pararr[2];//����������
$bt = $pararr[1][1]; //����������� ������
$par_i = $pararr[0]; //���������
$price = $pararr[3];
$price_dd = $pararr[4];
if($ITEM['grav']){$ITEM['name'] = $ITEM['name']." (".$ITEM['grav'].")";}
$vcod=scode();
$ItemToOne[$ITEM['id']+$ITEM['arenda']+$ITEM['rassrok']+$ITEM['sunduk_open']][md5($iz.'/'.$ITEM['dolg'].$ITEM['mod'].$ITEM['clan'].$ITEM['grav'].$ITEM['sunduk_open'])] += 1;
if($ItemToOne[$ITEM['id']+$ITEM['arenda']+$ITEM['rassrok']+$ITEM['sunduk_open']][md5($iz.'/'.$ITEM['dolg'].$ITEM['mod'].$ITEM['clan'].$ITEM['grav'].$ITEM['sunduk_open'])] == 1){
//$count = mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`='".$player['id']."' and `used`='0' and `dolg`='".$ITEM['dolg']."' and `iznos`='".$ITEM['iznos']."' and `items`.`id`='".$ITEM['id']."' $sq $sq2;"));
	$count = mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT `invent`.*, `items`.* FROM `items` INNER JOIN `invent` ON `items`.`id` = `invent`.`protype` WHERE `pl_id`='".$player['id']."' and `invent`.`used`='0' and `dolg`='".$ITEM['dolg']."' and `iznos`='".$ITEM['iznos']."' and `items`.`id`='".$ITEM['id']."' and `invent`.`arenda`='".$ITEM['arenda']."' and `invent`.`rassrok`='".$ITEM['rassrok']."' and `invent`.`mod`='".$ITEM['mod']."' and `invent`.`clan`='".$ITEM['clan']."' and `invent`.`grav`='".$ITEM['grav']."' and `invent`.`bank`='0' and `invent`.`sunduk_open`='".$ITEM['sunduk_open']."' $sq $sq2;"));
?>
<tr><td bgcolor=#F5F5F5><div align=center><font class=nickname><b><?=$ITEM['name']?></b></font><br><img src="img/image/weapon/<?php
if($ITEM['chests'] == '1'){
	echo substr($ITEM['gif'],0,strlen($ITEM['gif'])-4).(($ITEM['sunduk_open'] == 1 || $ITEM['chests'] == '2') ? '_open' : '' ).'.gif';
}else{
	echo $ITEM['gif'];
}
?>"  border=0><br><img src=img/image/1x1.gif width=62 height=1><br><img <?php
$DolgWidth = round(56*($iz/$ITEM['dolg']));
?><img <? echo ($iz <= $ITEM[dolg]/4 ? "src=/img/image/solidst.gif" : ($iz <= $ITEM[dolg]/2 ? "src=/img/image/solidst.gif" : "src=/img/image/solidst.gif" )) ?> width="<?php echo $DolgWidth; ?>" height=3 border=0 title="�������������: <?="$iz/$ITEM[dolg]"?>"><img src=/img/image/nosolidst.gif width="<?php echo (56-$DolgWidth); ?>" height=3 border=0 title="�������������: <?="$iz/$ITEM[dolg]"?>"><br><?php echo (($count>1)?' <font color="#CCCCCC">(<b>'.$count.' ��.</b>)</font>':'');  ?><? 
		
	///INVENT BUTTONS	
	$inputs="<input type=button class=invbut ";
	$inpute="/> ";
	$buttons="";
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
			///��������
			case 'sila': 
				$buttons.="<input type=image src=/img/image/signs/vzlom.jpg width=14 height=14 border=0 title='������������' onclick=\"javascript: if(confirm('�� ����� ������ ������������ ".$ITEM['name']."')) { location='main.php?post_id=119&act=1&uid=".$ITEM['id_item']."&vcode=".$vcod."' }\" />"; 
			break;
			case 'lovk': 
				$buttons.="<input type=image src=/img/image/signs/vzlom.jpg width=14 height=14 border=0 title='������������' onclick=\"javascript: if(confirm('�� ����� ������ ������������ ".$ITEM['name']."')) { location='main.php?post_id=119&act=2&uid=".$ITEM['id_item']."&vcode=".$vcod."' }\" />"; 
			break;
			case 'uda4a': 
				$buttons.="<input type=image src=/img/image/signs/vzlom.jpg width=14 height=14 border=0 title='������������' onclick=\"javascript: if(confirm('�� ����� ������ ������������ ".$ITEM['name']."')) { location='main.php?post_id=119&act=3&uid=".$ITEM['id_item']."&vcode=".$vcod."' }\" />"; 
			break;
			case 'zdorov': 
				$buttons.="<input type=image src=/img/image/signs/vzlom.jpg width=14 height=14 border=0 title='������������' onclick=\"javascript: if(confirm('�� ����� ������ ������������ ".$ITEM['name']."')) { location='main.php?post_id=119&act=4&uid=".$ITEM['id_item']."&vcode=".$vcod."' }\" />"; 
			break;
			case 'znan': 
				$buttons.="<input type=image src=/img/image/signs/vzlom.jpg width=14 height=14 border=0 title='������������' onclick=\"javascript: if(confirm('�� ����� ������ ������������ ".$ITEM['name']."')) { location='main.php?post_id=119&act=5&uid=".$ITEM['id_item']."&vcode=".$vcod."' }\" />";
			break;
			/////
			default: 
				$buttons.="<input type=image src=/img/image/signs/vzlom.jpg width=14 height=14 border=0 title='������������' onclick=\"".$ITEM['acte']."('".$ITEM['id_item']."','".$player['login']."','".$ITEM['name']."','".$vcod."')\" />"; 
			break;
		}
	}
	if($ITEM['iznos']!=0 and $ITEM['type']!='w0' and $ITEM['type']!='w29' and $ITEM['type']!='w61' and $ITEM['type']!='w66' and $ITEM['type']!='w67' and $ITEM['type']!='w68' and $ITEM['type']!='w69'){
			$buttons.=$inputs."onClick=\"javascript: if(confirm('�� ����� �������� ".$ITEM['name']." ? ��������� ".lr($ITEM['iznos'])."')) {location='main.php?post_id=115&uid=".$ITEM['id_item']."&vcode=".$vcod."'}\" value=\"�������� ����\" ".$inpute;}
	if($ITEM['clan']==0 and $player['finblock']<=time()){
		switch($player['loc']){
			case 2: 
				if($ITEM['dd_price']==0 and $ITEM['srok']==0){
					$buttons.="<button onclick=\"javascript: if(confirm('�� ����� ������ ������� ".$ITEM['name']." �� ".($price)."?')) {location='main.php?post_id=11&uid=".$ITEM['id_item']."&act=1&vcode=".$vcod."'}\">������� �� ".lr($price)."</button>";
					$buttons.="<button onclick=\"javascript: if(confirm('�� ����� ������ ������� ".$ITEM['name']." �� ".($price*$count)."?')) {location='main.php?post_id=11&uid=".$ITEM['id_item']."&act=3&vcode=".$vcod."'}\">������� ��� (� �������) �� ".lr($price*$count)."</button>";
				}
			break;
			case 34: 
				if($ITEM['dd_price']>0 and $ITEM['arenda']==0 and $ITEM['rassrok']==0){
					$buttons.=$inputs."onclick=\"javascript: if(confirm('�� ����� ������ ������� ".$ITEM['name']." �� ".$price_dd." ?')){location='main.php?post_id=11&uid=".$ITEM['id_item']."&act=1&vcode=".$vcod."'}\" value=\"������� �� ".$price_dd."\"  ".$inpute;
				}
			break;
		}
		## �������
				if($ITEM['chests'] == '1'){
			if($ITEM['sunduk_open'] == 1){
				$buttons .="<input type=image src=/img/image/signs/key_quest.png width=14 height=14 border=0 title='�������' onclick=\"javascript: if(confirm('�� ����� ������ ������� ".$ITEM['name']."?')) {location='main.php?post_id=15987&uid=".$ITEM['id_item']."&act=2&vcode=".$vcod."'}\" />";
			}else{
				if($bt==0 and $plstt[74]){
					$buttons .="<input type=image src=/img/image/signs/vzlom.jpg width=14 height=14 border=0 title='��������' onclick=\"javascript: if(confirm('�� ����� ������ �������� ".$ITEM['name']."?')) {location='main.php?post_id=15987&uid=".$ITEM['id_item']."&act=1&vcode=".$vcod."'}\" />";
				}
			}
		}
		## ��������
    ## ������� 
		if($ITEM['chests'] == '2'){
			$buttons .="<input type=image src=/img/image/del.gif width=14 height=14 border=0 onclick=\"javascript: if(confirm('�� ����� ������ ������� ".$ITEM['name']."?')) {location='main.php?post_id=15987&uid=".$ITEM['id_item']."&act=3&vcode=".$vcod."'}\" value=\"�������\" />";
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
			
			$buttons.="<input type=image src=/img/image/del.gif width=14 height=14 border=0 title='�������' onClick=\"javascript: if(parent.DeleteTrue('".$ITEM['name']."')){location='main.php?post_id=50&uid=".$ITEM[id_item]."&vcode=".$vcod."'}\" value=\"x\" />";	

		}		
	}
	echo $buttons;
	
	//END INVENT BUTTONS
		?></div></td><td width=100% bgcolor=#FFFFFF valign=top><table cellpadding=0 cellspacing=0 border=0 width=100%><tr>

        <td bgcolor=#FFFFFF width=100%>
		
		
	
	
			 

			 <br><img src=img/image/1x1.gif width=1 height=5></td></tr><tr><td colspan=2 width=100%>
				<table cellpadding=0 cellspacing=0 border=0 width=100%>
					<tr>
						<? if($opt[0]==0){?>
							<td bgcolor=#D8CDAF width=50% colspan=3><div align=center><font class=invtitle><font color=#996633>��������� � ��������</font></div></td>
							<td bgcolor=#B9A05C><img src=img/image/1x1.gif width=1 height=16></td>
							<td bgcolor=#D8CDAF width=50% colspan=3><div align=center><font class=invtitle><font color=#006699>���������� �������� </font></div></td></tr><tr><td bgcolor=#FCFAF3><img src=img/image/1x1.gif width=5 height=1></td>
							<?if($ITEM[mod_color]==0){?>
								<td bgcolor=#FCFAF3 width=50%><font class=nickname><b><?echo $ITEM[name].($ITEM[modified]==1 ? " [��]" : "");?><a href="/iteminfo.php?<?=$ITEM[name]?>" target="_blank">	<img src=img/image/info.gif width=6 height=12 border=0 valign=top>
		</a></b><br>
							<?}else{if($ITEM[mod_color]==1){?>
								    <td bgcolor=#FCFAF3 width=50%><font class=nickname><b><font color=#006600><?=$ITEM[name]."</font> [���]".($ITEM[modified]==1 ? " [��]" : "")?><a href="/iteminfo.php?<?=$ITEM[name]?>" target="_blank">	<img src=img/image/info.gif width=6 height=12 border=0 valign=top></font></b><br>
								 <?}if($ITEM[mod_color]==2){?>
								    <td bgcolor=#FCFAF3 width=50%><font class=nickname color=#4ABB58><b><font color=#3333CC><?=$ITEM[name]."</font> [���]".($ITEM[modified]==1 ? " [��]" : "")?><a href="/iteminfo.php?<?=$ITEM[name]?>" target="_blank">	<img src=img/image/info.gif width=6 height=12 border=0 valign=top></font></b><br>
								 <?}if($ITEM[mod_color]==3){?>
								    <td bgcolor=#FCFAF3 width=50%><font class=nickname color=#AF51B5><b><font color=#993399><?=$ITEM[name]."</font> [���]".($ITEM[modified]==1 ? " [��]" : "")?><a href="/iteminfo.php?<?=$ITEM[name]?>" target="_blank">	<img src=img/image/info.gif width=6 height=12 border=0 valign=top></font></b><br>
								 <?}}?>

<? if($ITEM[dd_price]>0) { ?> <font class=weaponch>&nbsp;����: <b><?=$ITEM[dd_price]?> <img src="img/razdor/emerald.png" width=14 height=14></b><br> <? } else { ?>
<font class=weaponch>����: <b><?=lr($ITEM['price'])?></b><br> <? } ?>

<?
//============= ����� ������� ������ ���������� ���� => sql_func.php: function itemparams($par,$eff,$modstat,$damage_mod,$iz,$dolg,$slot,$need,$plstt,$itlevel,$itmass). ������������ ��� �������� ��� ����� �������� �����. 
//echo itemparams($par,($ITEM['type']=='w70'?$ITEM['effect']:0),$modstat,$ITEM['damage_mod'],$iz,$ITEM['dolg'],$ITEM['slot']);
echo $par_i;
//==== END ====

?></font></td><td bgcolor=#FCFAF3><img src=img/image/1x1.gif width=5 height=1></td><td bgcolor=#B9A05C><img src=img/image/1x1.gif width=1 height=1></td><td bgcolor=#FCFAF3><img src=img/image/1x1.gif width=5 height=1></td>
<td bgcolor=#FCFAF3 width=50%>
<? if($ITEM[gift]==1 and empty($ITEM[gift_from])){echo '<font class=weaponch><img src="img/image/gift/gift1.gif"/>&nbsp;�������!</font><br><br>'; }
 else {if($ITEM[gift]==1 and $ITEM[gift_from]!=''){echo '<font class=weaponch><img src="img/image/gift/gift1.gif"/>&nbsp;������� �� <b>'.$ITEM[gift_from].'</b>!</font><br><br>'; }}
 if($ITEM['dd_price']>0){echo '<font class="weaponch"><img src="img/image/gift/gift2.gif">&nbsp;����������� � ���� ���������</b>!</font><br><br>';}
 ?>

<font class=weaponch>
<?
if($ITEM['clan']!=0){ 
$query = mysqli_query($GLOBALS['db_link'],"SELECT `clan_kazna`.* , `clans`.`clan_id`, `clans`.`clan_gif`, `clans`.`clan_name` FROM `clan_kazna` INNER JOIN `clans` ON `clan_kazna`.`clan_id`=`clans`.`clan_id` where `clan_kazna`.`id_item`='".$ITEM["id_item"]."' LIMIT 1;");
$clan = mysqli_fetch_assoc($query);
echo"<font class=weaponch><b>���� ����������� ����� <i>$clan[clan_name]</i></b> </font><img src=img/image/signs/$clan[clan_gif] /><br>";
}
$dd = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT invent.dd_price FROM invent WHERE id_item=".$ITEM['id_item']." LIMIT 1;")); 
$tr_b.=$ITEM['arenda']>0?'<br><font class=weaponch><b><font color=#cc0000>���� ����������: '.date("d.m.Y (H:i:s)",$ITEM['arenda']).'</font>'
:
($ITEM['rassrok']>0?
'<br><font class=weaponch><b><font color=#cc0000>���� ����������� � ���������.
<br>���� �� ������: '.($ITEM['dd_price']-$dd['dd_price']).' ������� (�)
<br>������ �� '.date("d.m.Y (H:i:s)",$ITEM['rassrok']).'</font><br>'.
(
$player['baks']>=($ITEM['dd_price']-$dd['dd_price'])?
'<br><input type=button class=invbut onclick="location=\'main.php?post_id=96&wsuid='.$ITEM['id_item'].'&vcode='.scode().'\'" value="�������� '.($ITEM['dd_price']-$dd['dd_price']).' ������� (�)">'
:
'<br><input type=button class=invbut value="�������� '.($ITEM['dd_price']-$dd['dd_price']).' ������� (�)" disabled>'
)
:
'');
$tr_b.=(($ITEM['srok']!=0)?'<br><font class=weaponch><b><font color=#00000>����� �����:<b><font color=green> '.date("d.m.Y (H:i:s)",$ITEM['srok']).'</font>':'');
$tr_b.=(($ITEM['death']!=0)?'<br><font class=weaponch><b><font color=#00000>����� �����:<b><font color=green> '.date("d.m.Y",$ITEM['death']).'</font>':'');
echo $tr_b;
?>
</font></td><td bgcolor=#FCFAF3><img src=img/image/1x1.gif width=5 height=1></td><? }else{ ?><?}?></tr></table></td></tr></table></td></tr>
<? }}}else{?>
<table cellpadding=5 cellspacing=1 border=0 width=100%><tr><td bgcolor=#F5F5F5 align=center colspan=2><font class=inv><b>� ��� � ����� ��� �����.</b></font></td></tr>
<? }
echo('<script language="JavaScript">message("������� ��������<br><font color=bb0000>�������</font>!");</script>');
			mysqli_query($GLOBALS['db_link'],"UPDATE `invent` SET `iznos`='0' WHERE `id_item`='".intval($_GET['v'])."' AND `pl_id`='".$player['id']."' LIMIT 1;");
			mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `user`.`nv`=`user`.`nv`-'".$itm['iznos']."' WHERE `user`.`id`='".$player['id']."' LIMIT 1;");
?>
</div>
