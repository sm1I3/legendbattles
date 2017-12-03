<?php
session_start ();
include($_SERVER["DOCUMENT_ROOT"]."/includes/config.php");
include( DROOT . "/includes/functions.php");

	function lr($lr) {
		$b = $lr % 100;
		$s = intval(($lr % 10000) / 100);
		$g = intval($lr / 10000);
		return (($g)?$g.' <img src=/img/image/gold.png width=14 height=14 valign=middle title=������>  ':'').(($s)?$s.' <img src=/img/image/silver.png width=14 height=14 valign=middle title=�������> ':'').(($b)?$b.' <img src=/img/image/bronze.png width=14 height=14 valign=middle title=������> ':'');
	}

function itemparams($inv,$ITEM,$player,$plstt,$mass){	
	$par_i='';$tr_b[0]='';$tr_b[1]=0;	
	$par=explode("|",$ITEM['param']);
	$mod=explode("|",$ITEM['mod']);
	$need=explode("|",$ITEM['need']);
	if($inv==1){
		//�������� �������� ���������
			if($player[level]<5){$licen=1;}
			else{$licen=tradelic($player['licens'],1);}
		//
		$iz=$ITEM[dolg]-$ITEM[iznos];
		$izn = round(($iz/($ITEM[dolg]/100))*0.62);
		$pro = 62-$izn;
		if($ITEM[dd_price]>0){
			$licen=0.9;
			$price_dd=round(($ITEM[dd_price]*$licen*$iz/$ITEM[dolg]),2);
		}
		else if($ITEM[gift]==1){
			$licen=0.4;
			$price=round($ITEM[price]*$licen*$iz/$ITEM[dolg]);
			if($price<1){$price=1;}
		}
		else{
			$price=round($ITEM[price]*$licen*$iz/$ITEM[dolg]);
			if($price<1){$price=1;}
		}	
	}
	$modstat='';
	foreach ($mod as $value){
		$modstats=explode("@",$value);
		$modstat[$modstats[0]]=$modstats[1];
	}	
	//���������
	//if($par){	
	  if($ITEM['srok']>0){$par_i.="&nbsp;����� �����: <font color=#BB0000><b>".$ITEM['srok']."</b></font> ����<br>";}
		if($ITEM['type']=='w70'){ 
			if($ITEM['effect']>0){$par_i.="&nbsp;����� ��������: <font color=#BB0000><b>".$ITEM['effect']."</b></font> �����<br>";}
			switch($ITEM['num_a']){
				case '32': $par_i.="&nbsp;������� �������: <font color=#BB0000><b>����.</b></font><br>";break;
				case '33': $par_i.="&nbsp;������� �������: <font color=#BB0000><b>������.</b></font><br>";break;
				case '34': $par_i.="&nbsp;������� �������: <font color=#BB0000><b>�����, ������.</b></font><br>";break;
				case '1': $par_i.="&nbsp;������� �������: <font color=#BB0000><b>������, �����, ������, ����.</b></font><br>";break;
				case '2': $par_i.="&nbsp;������� �������: <font color=#BB0000><b>������, �����, ������, ����.<br>&nbsp;�� ���� ���������� �� ������.</b></font><br>"; break;
				case '3': $par_i.="&nbsp;������� �������: <font color=#BB0000><b>����.<br>&nbsp;�� ���� ���������� �� ������.</b></font><br>"; break;
				case '4': $par_i.="&nbsp;������� �������: <font color=#BB0000><b>������.<br>&nbsp;�� ���� ���������� �� ������.</b></font><br>"; break;
				case '5': $par_i.="&nbsp;������� �������: <font color=#BB0000><b>�����, ������.<br>&nbsp;�� ���� ���������� �� ������.</b></font><br>"; break;
			}
		}		
		foreach ($par as $value){
			$stat=explode("@",$value);
			if($stat[1]>0){
				$plus = "+";		
			}else{
				$plus ="";
			}
			if ($stat[0]>4 and $stat[0]<11 and $stat[0]!=9){
				$percent="%";
			}else{
				$percent="";
			}
			if($stat[0]==1){
				$pr=explode("-",$modstat[1]);		
				$pri=explode("-",$stat[1]);
				$modstroke="".($modstat[1]!='' ?  ($pr[0]+$pri[0])."-".($pr[1]+$pri[1])."$percent  </b>[".($modstat[1]>0 ? "<font color=green> <b>".$modstat[1]."</b>$percent" : "<font color=red><b>".$modstat[1]."</b>$percent")."</font></b> ]<b> " : "$stat[1]$percent")."";
			}else{
				$modstroke="".($modstat[$stat[0]]!='' ?  $stat[1]+$modstat[$stat[0]]."$percent  </b>[".($modstat[$stat[0]]>0 ? "<font color=green>+<b>".$modstat[$stat[0]]."</b>$percent" : "<font color=red><b>".$modstat[$stat[0]]."</b>$percent")."</font></b> ]<b> " : "$stat[1]$percent")."";
			}
			switch($stat[0]){
				//case 0: $par_i.= "&nbsp;����������: <b>".$modstroke."</b><br>"; break;
				case 1: $par_i.= "&nbsp;����: <b>".$modstroke."</b><br>";break;
				case 2: 
					($iz)? $par_i.= "&nbsp;�������������: <b>".(($iz==1 and $ITEM['slot']!=5) ? "<font color=red>".$iz."</font>" : $iz)."/$ITEM[dolg]</b><br>" 
					: 
					$par_i.= "&nbsp;�������������: <b>".$ITEM['dolg']."/$stat[1]</b><br>"
					; 
					break;
				case 3: $par_i.= "&nbsp;��������: <b>".$modstroke."</b><br>";break;
				case 4: $par_i.= "&nbsp;��������: <b>".$modstroke."</b><br>";break;	
				case 5: $par_i.= "&nbsp;������: $plus<b>".$modstroke."</b><br>";break;
				case 6: $par_i.= "&nbsp;��������: $plus<b>".$modstroke."</b><br>";break;
				case 7: $par_i.= "&nbsp;����������: $plus<b>".$modstroke."</b><br>";break;
				case 8: $par_i.= "&nbsp;���������: $plus<b>".$modstroke."</b><br>";break;
				case 9: $par_i.= "&nbsp;����� �����: <b>".$modstroke."</b><br>";break;
				case 10: $par_i.= "&nbsp;������ �����: $plus<b>".$modstroke."</b><br>";break;
				case 11: $par_i.= "&nbsp;������ ������� ������: $plus<b>".$modstroke."%</b><br>";break;
				case 12: $par_i.= "&nbsp;������ ������� ������: $plus<b>".$modstroke."%</b><br>";break;
				case 13: $par_i.= "&nbsp;������ ����������� ������: $plus<b>".$modstroke."%</b><br>";break;
				case 14: $par_i.= "&nbsp;������ ����������� ������: $plus<b>".$modstroke."%</b><br>";break;
				case 15: $par_i.= "&nbsp;������ ������� ������: $plus<b>".$modstroke."%</b><br>";break;
				case 16: $par_i.= "&nbsp;������ �������� ������: $plus<b>".$modstroke."%</b><br>";break;
				case 17: $par_i.= "&nbsp;������ ���������� ������: $plus<b>".$modstroke."%</b><br>";break;
				case 18: $par_i.= "&nbsp;������ �������� ������: $plus<b>".$modstroke."%</b><br>";break;
				case 19: $par_i.= "&nbsp;������ �� ������� ������: $plus<b>".$modstroke."</b><br>";break;
				case 20: $par_i.= "&nbsp;������ �� ������� ������: $plus<b>".$modstroke."</b><br>";break;
				case 21: $par_i.= "&nbsp;������ �� ����������� ������: $plus<b>".$modstroke."</b><br>";break;
				case 22: $par_i.= "&nbsp;������ �� ����������� ������: $plus<b>".$modstroke."</b><br>";break;
				case 23: $par_i.= "&nbsp;������ �� ������� ������: $plus<b>".$modstroke."</b><br>";break;
				case 24: $par_i.= "&nbsp;������ �� �������� ������: $plus<b>".$modstroke."</b><br>";break;
				case 25: $par_i.= "&nbsp;������ �� ���������� ������: $plus<b>".$modstroke."</b><br>";break;
				case 26: $par_i.= "&nbsp;������ �� �������� ������: $plus<b>".$modstroke."</b><br>";break;
				case 27: $par_i.= "&nbsp;��: $plus<b>".$modstroke."</b><br>";break;
				case 28: $par_i.= "&nbsp;���� ��������: $plus<b>".$modstroke."</b><br>";break;
				case 29: $par_i.= "&nbsp;����: $plus<b>".$modstroke."</b><br>";break;
				case 30: $par_i.= "&nbsp;����: $plus<b>".$modstroke."</b><br>";break;
				case 31: $par_i.= "&nbsp;�����������: $plus<b>".$modstroke."</b><br>";break;
				case 32: $par_i.= "&nbsp;�������: $plus<b>".$modstroke."</b><br>";break;
				case 33: $par_i.= "&nbsp;��������: $plus<b>".$modstroke."</b><br>";break;
				case 34: $par_i.= "&nbsp;�����: $plus<b>".$modstroke."</b><br>";break;
				case 35: $par_i.= "&nbsp;��������: $plus<b>".$modstroke."</b><br>";break;
				case 36: $par_i.= "&nbsp;�������� ������: $plus<b>".$modstroke."%</b><br>";break;
				case 37: $par_i.= "&nbsp;�������� ��������: $plus<b>".$modstroke."%</b><br>";break;
				case 38: $par_i.= "&nbsp;�������� �������� �������: $plus<b>".$modstroke."%</b><br>";break;
				case 39: $par_i.= "&nbsp;�������� ������: $plus<b>".$modstroke."%</b><br>";break;
				case 40: $par_i.= "&nbsp;�������� ����������� �������: $plus<b>".$modstroke."%</b><br>";break;
				case 41: $par_i.= "&nbsp;�������� ���������� � �������: $plus<b>".$modstroke."%</b><br>";break;
				case 42: $par_i.= "&nbsp;�������� ��������: $plus<b>".$modstroke."%</b><br>";break;
				case 43: $par_i.= "&nbsp;�������� ������������ �������: $plus<b>".$modstroke."%</b><br>";break;
				case 44: $par_i.= "&nbsp;�������� ��������� �������: $plus<b>".$modstroke."%</b><br>";break;
				case 53: $par_i.= "&nbsp;���������: $plus<b>".$modstroke."%</b><br>";break;
				case 54: $par_i.= "&nbsp;������������: $plus<b>".$modstroke."%</b><br>";break;
				case 55: $par_i.= "&nbsp;�����: $plus<b>".$modstroke."%</b><br>";break;
				case 56: $par_i.= "&nbsp;����������������: $plus<b>".$modstroke."%</b><br>";break;
				case 57: $par_i.= "&nbsp;��������: $plus<b>".$modstroke."%</b><br>";break;
				case 58: $par_i.= "&nbsp;��������: $plus<b>".$modstroke."%</b><br>";break;
				case 59: $par_i.= "&nbsp;�������: $plus<b>".$modstroke."%</b><br>";break;
				case 60: $par_i.= "&nbsp;�������: $plus<b>".$modstroke."%</b><br>";break;
				case 61: $par_i.= "&nbsp;��������� ����: $plus<b>".$modstroke."%</b><br>";break;
				case 62: $par_i.= "&nbsp;�����������: $plus<b>".$modstroke."%</b><br>";break;
				case 63: $par_i.= "&nbsp;���������: $plus<b>".$modstroke."%</b><br>";break;
				case 64: $par_i.= "&nbsp;������: $plus<b>".$modstroke."%</b><br>";break;
				case 65: $par_i.= "&nbsp;�����������: $plus<b>".$modstroke."%</b><br>";break;
				case 66: $par_i.= "&nbsp;������� �������������� ����: $plus<b>".$modstroke."%</b><br>";break;
				case 67: $par_i.= "&nbsp;���������: $plus<b>".$modstroke."%</b><br>";break;
				case 68: $par_i.= "&nbsp;�������: $plus<b>".$modstroke."%</b><br>";break;
				case 69: $par_i.= "&nbsp;�������� ������� ����: $plus<b>".$modstroke."%</b><br>";break;
				case 70: $par_i.= "&nbsp;������������: $plus<b>".$modstroke."%</b><br>";break;
				case 71: $par_i.= "&nbsp;<font color=#BB0000>�����������: $plus<b>".$modstroke."%</b></font><br>";break;
				case 'expbonus': 
					$par_i.= "&nbsp;����� �����: <font color=#BB0000>$plus<b>".$modstroke."%</b></font><br>";
					$par_i.= "&nbsp;������������ ����: <font color=#BB0000>$plus<b>".$modstroke."%</b></font><br>";
				break;
				case 'massbonus': $par_i.= "&nbsp;�����: <font color=#BB0000>$plus<b>".$modstroke."</b></font><br>";break;
			}			
		}
		if($ITEM['damage_mod']){
			$dmodarr = array(1=>'&nbsp;���� �����',2=>'&nbsp;���� �����',3=>'&nbsp;���������',4=>'&nbsp;�������');
			$dmgm=explode("|",$ITEM['damage_mod']);
			foreach($dmgm as $val){
				$dmod=explode("@",$val);
				switch($dmod[0]){
					case 1: $par_i .= $dmodarr[$dmod[0]].': <b><font color="#B00000">'.$dmod[1].'</b></font><br>'; break;
					case 2: $par_i .= $dmodarr[$dmod[0]].': <b><font color="#000099">'.$dmod[1].'</b></font><br>'; break;
					case 3: $par_i .= $dmodarr[$dmod[0]].': <b><font color="#6633CC">'.$dmod[1].'</b></font><br>'; break;
					case 4: $par_i .= $dmodarr[$dmod[0]].': <b><font color="#FFBB88">'.$dmod[1].'</b></font><br>'; break;
				}
			}				
		}
		$immunes = explode("|",$ITEM['immunes']);
		$immunes_arr = array(
			0=>'&nbsp;<b><font color="#993399">��������� � ����.</b></font><br>',
			1=>'&nbsp;<b><font color="#993399">��������� � ����.</b></font><br>',
			2=>'&nbsp;<b><font color="#993399">��������� � ����������.</b></font><br>',
			3=>'&nbsp;<b><font color="#993399">��������� � ���.</b></font><br>',
			4=>'&nbsp;<b><font color="#993399">��������� � ����������� �����.</b></font><br>'
		);
		foreach($immunes as $key=>$val){
			if($val==1){
				$par_i .= $immunes_arr[$key];		
			}
		}
		
		//return $par_i;
	//}
	//����������
	//if($need and $plstt and $ITEM['level']>=0 and $Imass>=0){
		foreach ($need as $value) {
			$treb=explode("@",$value);
			if($treb[0]==72){
				$treb[1]=$ITEM['level'];
			}
			if($treb[0]==71){
				$treb[1]=$ITEM['massa'];
				if($mass-$plstt[71]<$treb[1]){
					$treb[1]="<font color=#cc0000>$treb[1]</font>";
				}
			}
			if($treb[0]==73){
	   $Doblest = array(0=>'������',1=>'����a�',2=>'��e�',3=>'����',4=>'������� ����',5=>'�e�����',6=>'��a��a���',7=>'��������e�',8=>'�a��e� �����',9=>'�e���',10=>'������� �������',11=>'������� �����',12=>'���������',13=>'������ �������',14=>'����������');
	    $trtmp = $treb[1];
	    $treb[1] = $Doblest[$treb[1]];
	    if($player['u_lvl']<$trtmp){
		  $treb[1]="<font color=#cc0000>".$treb[1]."</font>";
		  $tr_b[1]=1;
	      }
      }
			if($treb[0]!=28 and $treb[0]!=71 and $treb[0]!=73){
				if($plstt[$treb[0]]<$treb[1]){
					$treb[1]="<font color=#cc0000>$treb[1]</font>";
					$tr_b[1]=1;
				}
			}
			switch($treb[0]){
				case 28: $tr_b[0].="&nbsp;���� ��������: <b>$treb[1]</b><br>";break;
				case 30: $tr_b[0].="&nbsp;����: <b>$treb[1]</b><br>";break;
				case 31: $tr_b[0].="&nbsp;�����������: <b>$treb[1]</b><br>";break;
				case 32: $tr_b[0].="&nbsp;�������: <b>$treb[1]</b><br>";break;
				case 33: $tr_b[0].="&nbsp;��������: <b>$treb[1]</b><br>";break;
				case 34: $tr_b[0].="&nbsp;�����: <b>$treb[1]</b><br>";break;
				case 35: $tr_b[0].="&nbsp;��������: <b>$treb[1]</b><br>";break;
				case 36: $tr_b[0].="&nbsp;�������� ������: <b>$treb[1]</b><br>";break;
				case 37: $tr_b[0].="&nbsp;�������� ��������: <b>$treb[1]</b><br>";break;
				case 38: $tr_b[0].="&nbsp;�������� �������� �������: <b>$treb[1]</b><br>";break;
				case 39: $tr_b[0].="&nbsp;�������� ������: <b>$treb[1]</b><br>";break;
				case 40: $tr_b[0].="&nbsp;�������� ����������� �������: <b>$treb[1]</b><br>";break;
				case 41: $tr_b[0].="&nbsp;�������� ���������� � �������: <b>$treb[1]</b><br>";break;
				case 42: $tr_b[0].="&nbsp;�������� ��������: <b>$treb[1]</b><br>";break;
				case 43: $tr_b[0].="&nbsp;�������� ������������ �������: <b>$treb[1]</b><br>";break;
				case 44: $tr_b[0].="&nbsp;�������� ��������� �������: <b>$treb[1]</b><br>";break;
				case 45: $tr_b[0].="&nbsp;����� ����: <b>$treb[1]</b><br>";break;
				case 46: $tr_b[0].="&nbsp;����� ����: <b>$treb[1]</b><br>";break;
				case 47: $tr_b[0].="&nbsp;����� �������: <b>$treb[1]</b><br>";break;
				case 48: $tr_b[0].="&nbsp;����� �����: <b>$treb[1]</b><br>";break;
				case 53: $tr_b[0].="&nbsp;���������: <b>$treb[1]</b><br>";break;
				case 54: $tr_b[0].="&nbsp;������������: <b>$treb[1]</b><br>";break;
				case 55: $tr_b[0].="&nbsp;�����: <b>$treb[1]</b><br>";break;
				case 56: $tr_b[0].="&nbsp;����������������: <b>$treb[1]</b><br>";break;
				case 57: $tr_b[0].="&nbsp;��������: <b>$treb[1]</b><br>";break;
				case 58: $tr_b[0].="&nbsp;��������: <b>$treb[1]</b><br>";break;
				case 59: $tr_b[0].="&nbsp;�������: <b>$treb[1]</b><br>";break;
				case 60: $tr_b[0].="&nbsp;�������: <b>$treb[1]</b><br>";break;
				case 61: $tr_b[0].="&nbsp;��������� ����: <b>$treb[1]</b><br>";break;
				case 62: $tr_b[0].="&nbsp;�����������: <b>$treb[1]</b><br>";break;
				case 63: $tr_b[0].="&nbsp;���������: <b>$treb[1]</b><br>";break;
				case 64: $tr_b[0].="&nbsp;������: <b>$treb[1]</b><br>";break;
				case 65: $tr_b[0].="&nbsp;�����������: <b>$treb[1]</b><br>";break;
				case 66: $tr_b[0].="&nbsp;������� �������������� ����: <b>$treb[1]</b><br>";break;
				case 67: $tr_b[0].="&nbsp;���������: <b>$treb[1]</b><br>";break;
				case 68: $tr_b[0].="&nbsp;�������: <b>$treb[1]</b><br>";break;
				case 69: $tr_b[0].="&nbsp;�������� ������� ����: <b>$treb[1]</b><br>";break;
				case 70: $tr_b[0].="&nbsp;������������: <b>$treb[1]</b><br>";break;
				case 71: $tr_b[0].="&nbsp;�����: <b>$treb[1]</b><br>";break;
				case 72: $tr_b[0].="&nbsp;�������: <b>$treb[1]</b><br>";break;
				case 73: $tr_b[0].="&nbsp;������: <b>$treb[1]</b><br>";break;
				case 74: $tr_b[0].="&nbsp;��������: <b>$treb[1]</b><br>";break;
			}
		}
		$arr[0] = $par_i;
		$arr[1] = $tr_b;
		$arr[2] = $iz;
		return $arr;
	//}	
}
foreach($_POST as $keypost=>$valp){
     $valp = varcheck($valp);
     $_POST[$keypost] = $valp;
     $$keypost = $valp;
}
foreach($_GET as $keyget=>$valg){
     $valg = varcheck($valg);
     $_GET[$keyget] = $valg;
     $$keyget = $valg;

}
foreach($_SESSION as $keyses=>$vals){
     $$keyses = $vals;
}

if (empty($_GET["i"])) {
$_GET["i"]=(iconv("UTF-8","Windows-1251",urldecode($_SERVER['QUERY_STRING']))?iconv("UTF-8","Windows-1251",urldecode($_SERVER['QUERY_STRING'])):urldecode($_SERVER['QUERY_STRING']));
}
$error = 0;
if(isset($_GET['auc'])){
	$_GET["i"] = str_replace("'","",$_GET["i"]);
	$_GET['auc'] = intval($_GET['auc']);
	$ITEM = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT `invent`.* , `items`.* FROM `invent` INNER JOIN `items` ON `invent`.`protype`=`items`.`id`  WHERE `id_item`=".$_GET['i']));
	$error .= 1;
}else{
$_GET["i"] = str_replace("'","",$_GET["i"]);
$ITEM = GetItem(urldecode($_GET['i']));
$error .= 2;
}
if($ITEM['mod_color']!='0' or $ITEM['modified'] == '1') $ITEM['name'] .= '[��]';
function blocks($bl){
	if($bl!="") {
	switch($bl)
       	{
            case 40: echo "<font class=weaponch><b><font color=#cc0000>���������� 1-�� �����</font></b><br>"; break;
            case 70: echo "<font class=weaponch><b><font color=#cc0000>���������� 2-� �����</font></b><br>"; break;
	    	case 90: echo "<font class=weaponch><b><font color=#cc0000>���������� 3-� �����</font></b><br>"; break;
    	}
		}
}
if(empty($ITEM)){
echo'<HTML><HEAD>
<TITLE>Legend battles - ����� c���������.</TITLE>
<SCRIPT  LANGUAGE="JavaScript" src="./js/ft_v01.js"></SCRIPT>
<SCRIPT  LANGUAGE="JavaScript" src="./js/png.js"></SCRIPT>
<LINK href="/css/game.css" rel="STYLESHEET" type="text/css">
<META Http-Equiv=CONTENT-TYPE Content="text/html; charset=windows-1251">
<META Http-Equiv=PRAGMA Content="NO-CACHE">
<META Http-Equiv=CACHE-CONTROL Content="NO-CACHE, NO-STORE">
<META Http-Equiv=EXPIRES Content="0">
</HEAD>������, ������ �������� ��� � ����.'.$error.'<br>'.$ITEM['id_item'].'<br>.'.$_GET['i'];
}
else{
echo'<HTML><HEAD>
<TITLE>['.$ITEM['name'].'] </TITLE>
<LINK href="/css/game.css" rel="STYLESHEET" type="text/css">
<META Http-Equiv=CONTENT-TYPE Content="text/html; charset=windows-1251">
<META Http-Equiv=PRAGMA Content="NO-CACHE">
<META Http-Equiv=CACHE-CONTROL Content="NO-CACHE, NO-STORE">
<META Http-Equiv=EXPIRES Content="0">
</HEAD>
<body>
<table align=center cellpadding=100 cellspacing=100 border=0 width=1000>
<tr><td bgcolor=#e0e0e0>
<table cellpadding=20 cellspacing=1 border=0 width=100%>';
$bt=0;$tr_b='';$par_i='';$pararr ='';$m=0;
$pararr = itemparams(0,$ITEM,$player,$plstt,$mass);
$tr_b = $pararr[1][0]; $iz = $pararr[2];//����������
$bt = $pararr[1][1]; //����������� ������
$par_i = $pararr[0]; //���������
echo'
<tr>
<td bgcolor=#f9f9f9>
	<div align=center>
		<img src=/img/image/weapon/'.$ITEM['gif'].' border=0>
	</div>
</td>
<td width=100% bgcolor=#ffffff valign=top>
	<table cellpadding=0 cellspacing=0 border=0 width=100%>
		<tr>
			<td bgcolor=#ffffff width=100%>
				<font class=weaponch><b>'.$ITEM['name'].'</b><font class=weaponch><br>
				<img src=/img/image/1x1.gif width=1 height=3></td><td><br><img src=/img/image/1x1.gif width=1 height=3
			</td>
		</tr>
		<tr>
			<td colspan=2 width=100%>
				<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td bgcolor=#D8CDAF width=50%>
					<div align=center><font class=invtitle>��������</div></td><td bgcolor=#B9A05C>
					<img src=/img/image/1x1.gif width=1 height=1></td><td bgcolor=#D8CDAF width=50%>
					<div align=center><font class=invtitle>����������</div>
				</td></tr>
				<td bgcolor=#FCFAF3><font class=weaponch>&nbsp;</b><br>';
if($ITEM['slot']==16) {echo "<font class=weaponch><b><font color=#cc0000>����� ������� �� ��������</font></b><br>";}
blocks($ITEM['block']);


if($ITEM[dd_price]>0) { ?> <font class=weaponch>&nbsp;����: <b><?=$ITEM[dd_price]?> <img src="/img/razdor/emerald.png" width=14 height=14></b><br> <? } else { ?>
<font class=weaponch>����: <b><?=lr($ITEM['price'])?></b><br> <? } ?>


<?

//============= ����� ������� ������ ���������� ���� => sql_func.php: function itemparams($par,$eff,$modstat,$damage_mod,$iz,$dolg,$slot,$need,$plstt,$itlevel,$itmass).
//������������ ��� �������� ��� ����� �������� �����. $par,$eff,$modstat,$damage_mod,$iz,$dolg,$slot,$need,$plstt,$itlevel,$itmass - ����� ���� �������. ���� �������� ���� $par ���� need
echo $par_i;
//==== END ====
if($ITEM['clan']!=0){ 
$query = mysqli_query($GLOBALS['db_link'],"SELECT `clan_kazna`.* , `clans`.`clan_id`, `clans`.`clan_gif`, `clans`.`clan_name` FROM `clan_kazna` INNER JOIN `clans` ON `clan_kazna`.`clan_id`=`clans`.`clan_id` where `clan_kazna`.`id_item`='".$ITEM["id_item"]."' LIMIT 1;");
$clan = mysqli_fetch_assoc($query);
echo"<font class=weaponch><b>���� ����������� ����� <i>$clan[clan_name]</i></b> </font><img src=/img/image/signs/$clan[clan_gif] /><br>";
}
$dd = mysqli_query($GLOBALS['db_link'],"SELECT invent.dd_price FROM invent WHERE id_item=".$ITEM['id_item']." LIMIT 1;"); 
$tr_b.=$ITEM['arenda']>0?'<br><font class=weaponch><b><font color=#cc0000>���� ���������� �� '.date("d.m.Y (H:i:s)",$ITEM['arenda']).'</font>'
:
($ITEM['rassrok']>0?
'<br><font class=weaponch><b><font color=#cc0000>���� ����������� � ���������.
<br>���� �� ������: '.($ITEM['dd_price']-$dd['dd_price']).'�������
<br>������ �� '.date("d.m.Y (H:i:s)",$ITEM['rassrok']).'</font><br>'.
(
$player['baks']>=($ITEM['dd_price']-$dd['dd_price'])?
'<br><input type=button class=invbut onclick="location=\'main.php?post_id=96&wsuid='.$ITEM['id_item'].'&vcode='.scode().'\'" value="�������� ('.($ITEM['dd_price']-$dd['dd_price']).'�������)">'
:
'<br><input type=button class=invbut value="�������� ('.($ITEM['dd_price']-$dd['dd_price']).'�������)" disabled>'
)
:
'');
$tr_b.=(($ITEM['death']!=0)?'<br><font class=weaponch><b><font color=#cc0000>���� ����������: '.date("d.m.Y",$ITEM['death']).'</font>':'');
echo'</td><td bgcolor=#B9A05C><img src=/img/image/1x1.gif width=1 height=1></td><td bgcolor=#FCFAF3><font class=weaponch>'.$tr_b.'</font></td></tr></table></td></tr></table></td></tr></table>';
echo'
</body></html>';
}
?>


