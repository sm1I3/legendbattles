<?
$tg=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM user WHERE id='".intval($enemyid)."' LIMIT 1;"));
$pl_st=allparam($player);
$tg_st=allparam($tg);
if($player['fcolor_time']>time() or $player['fcolor_time']==0){
	$nickclr = $player['fcolor'];
}else{$nickclr='000000';}

if($player['invisible']<time()){
	$logpl="[1,$player[side],\"<font style=\'color: #".$nickclr.";\'>$player[login]</font>\",$player[level],$player[sklon],\"$player[clan_gif]\"]";
}else{
	$logpl='[4,'.$player['side'].']';
}
$oldlogin = $tg['login'];
$newlogin = str_replace(" [�����]","",$tg['login']);
if($oldlogin!=$newlogin){
	$champ=1;
}else{$champ=0;}
if($tg['invisible']<time()){
	$logtg="[1,$tg[side],\"".($champ?"<font style=\'color: #CC0000;\'>":"").$tg[login].($champ?"</font>":"")."\",$tg[level],$tg[sklon],\"$tg[clan_gif]\"]";
}else{
	$logtg='[4,'.$tg['side'].']';
}


function endb_t($bat){
	$hpt=mysqli_query($GLOBALS['db_link'],"SELECT user.battle, user.side, Sum( user.hp ) AS hpp, Sum( user.level ) AS level FROM user GROUP BY user.side, user.battle HAVING (((user.battle) = '".$bat."')) ORDER BY user.side LIMIT 2");
	while($hp = mysqli_fetch_assoc($hpt)){
		$sid[$hp['side']]=$hp['hpp'];
		$win[$hp['side']]=$hp['level'];
	}
	if($sid[1]==0 and $sid[2]!=0){
		$win[0]=2;
	}
	else if($sid[2]==0 and $sid[1]!=0){
		$win[0]=1;
	}
	else if($sid[1]==0 and $sid[2]==0){
		$win[0]=3;
	}
	else{
		$win[0]=0;
	}
	return $win;
}

function sqr($x){
	return $x*$x;
}

if($go_place!=''){
	mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `pos_fight`='".$go_place."' WHERE `id`='".$player['id']."';");
	$player['pos_fight'] = $go_place;
}

if($enemy=='3'){
	$bplace = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `battle_places` WHERE `id`='1'"));
	$sql=mysqli_query($GLOBALS['db_link'],"SELECT `pos_fight` FROM `user` WHERE `battle` = '".$player['battle']."'))");
	$go_no_p = '';
	if(mysqli_num_rows($sql)>0){
		while ($p = mysqli_fetch_assoc($sql)) {
			$go_no_p .= $p['pos_fight']."|";
		}
	}
	list($player['xf'], $player['yf']) = explode('_', $player['pos_fight']);
	list($tg['x'], $tg['y']) = explode('_', $tg['pos_fight']);
	$r = round(sqrt(sqr($tg["x"]-$player["xf"])+sqr($tg["y"]-$player["yf"])));
	if($r>1){
		$lg=90;
		for($i=$tg["x"]-3;$i<=$tg["x"]+3;$i++){
			for ($j=0;$j<=4;$j++){
				if (!substr_count("|".$bplace["xy"]."|".$go_no_p,"|".$i."_".$j."|")
				and round(sqrt(sqr($player["xf"]-$i)+sqr($player["yf"]-$j)))<=$lg 
				and round(sqrt(sqr($tg["x"]-$i)+sqr($tg["y"]-$j))) <= 1){
					$xtemp = $i;
					$ytemp = $j;
					$lg=round(sqrt(sqr($player["xf"]-$i)+sqr($player["yf"]-$j)));
				}
			}
		}
		if ($lg<90){	
			$go_no_p = str_replace("|".$tg["x"]."_".$tg["y"]."|","|".$xtemp."_".$ytemp."|",$go_no_p);
			$tg["x"]=$xtemp;
			$tg["y"]=$ytemp;
		}
		mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `pos_fight`='".$xtemp."_".$ytemp."' WHERE `id`='".$tg['id']."';");
	}else{ ## ������ �� ���� ��� ���� ������, � � ����� ������� �������� �� ����� ����� = ��� �� ����. ������� ����.
		$s=bot($tg_st[28],$tg['hp'],$tg['hp_all'],$tg['mp'],$tg['znan'],$tg['sila']);
		$ftr=60;
	}
	## bot fix by mozg 17-11-2013 (���� ���� � ����� ������, �������� �������������� �� ����, ���� ���������� ������� ��������� �� ���� ���)
		$s=bot($tg_st[28],$tg['hp'],$tg['hp_all'],$tg['mp'],$tg['znan'],$tg['sila']);
		$ftr=60;
	##	
}

if($player['sex']=='female'){
	$psex=array(0=> 1,"a","���");
}else{
	$psex=array(0=> 0,"","��");
}
if($tg['sex']=='female'){
	$tsex=array(0=> 1,"a","���");
}else{
	$tsex=array(0=> 0,"","��");
}
if($ina!='' or $s['mag']!=''){
	include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/magic.php");
}
if($inu!=''){
	$log.=udar($inu,$s['bl'],$player,$tg,$pl_st,$tg_st);
}else{
	$tg_hp=$tg['hp'];
}
$pl_hp=$tg_hp;
if($s['ud']!=''){
	$log.=udar($s['ud'],$inb,$tg,$player,$tg_st,$pl_st);
}else{
	$tg_hp=$player['hp'];
}
savelog($log,$player['battle']);
// ��� ����� �������� ����!
if($pl_hp <= 0){
	$death=",[[0,\"".date("H:i")."\"],$logtg,\" <b> ��������$tsex[1] ���.</b>\"]";
	if($tg['level']>0 and $tg['type']==3){
		include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/calc_drop.php");
	}
	savelog($death,$player['battle']);
	if(rand(0,100)<=$ftr and $tg[level]>5 and $tg[type]==1){
		$death=",[[0,\"".date("H:i")."\"],$logtg";
		$death="".$death."".add_trw($tg,$ftr)."";
		savelog($death,$player['battle']);
	}
}
if($tg_hp==0){
	$death=",[[0,\"".date("H:i")."\"],$logpl,\" <b>��������$psex[1] ���.</b>\"]";
	savelog($death,$player['battle']);
	if(rand(0,100)<=$ftr and $player[level]>5 and $player[type]==1){
		$death=",[[0,\"".date("H:i")."\"],$logpl";
		$death="".$death."".add_trw($player,$ftr)."";
		savelog($death,$player['battle']);
	}
}
//------------
$win=endb_t($player['battle']);
if ($win[0]!=0){
	$win[999]=0;endbat($player['battle'],$win,$pl_st[73]);
}
//-----------

function udar($inu,$block,$player,$tg,$pl_st,$tg_st){
if($player['invisible']<time()){
	$logpl="[1,$player[side],\"$player[login]\",$player[level],$player[sklon],\"$player[clan_gif]\"]";
}else{
	$logpl='[4,'.$player['side'].']';
}
if($tg['invisible']<time()){
	$logtg="[1,$tg[side],\"$tg[login]\",$tg[level],$tg[sklon],\"$tg[clan_gif]\"]";
}else{
	$logtg='[4,'.$tg['side'].']';
}

$log.=",[[0,\"".date("H:i")."\"]";
$exp=explode(",",$player[dmg]);
$exx=exp_level($player[level]);
if($tg[bl]>0){$ms[2]=" �����";$ms[3]=" ���";}else{$ms[3]=" ����";}
$cblock=($pl_st[30]-$tg_st[30])/2+(($player[level]-$tg[level])*5)+rand(0,50)+($player[bl]/2); 
if($cblock<5){$cblock=5;}else if($cblock>95){$cblock=95;} 
if($player['sex']=='female'){$psex=array(0=> 1,"a","���");}else{$psex=array(0=> 0,"","��");}
if($tg['sex']=='female'){$tsex=array(0=> 1,"a","���");}else{$tsex=array(0=> 0,"","��");}
$bl=block($block);
$arr=explode("@",$inu);
for($i=0; $i<=count($arr)-2; $i++){
$ud=explode("_",$arr[$i]);
//------
if($ud[2]<0){$ud[2]=0;}
if($ud[2]>0){
	if($exx['ma']<$ud[2]){$ud[2]=$exx['ma'];}	
	if($player['mp']<$ud[2]){$ud[2]=$player['mp'];}	
	if($ud[2]<5){$ud[2]=5;}
}
//$player['mp']-=$ud[2];
//------
$ylov =3+($tg_st[31]*3+$tg_st[5])*(($tg_st[73]/100)+1)-($pl_st[31]*4+$pl_st[6]+$pl_st[32]*2+$pl_st[34]*3)*(($pl_st[73]/100)+1);
if ($ylov>80){$ylov=80;}else if($ylov<6){$ylov=6;}
if(random($ylov)==1){
	
	$log.=",$logpl,\" �������$psex[2] �������� ���������, ��\",$logtg,\" �������$tsex[2] �� �����\", [6,$ud[0]], \".\"";
}else{
	if($ud[2]>=5 and ($player['mp']-$ud[2])<0){		
		$log.=",$logpl,\" �������� �����������$psex[1] ����� <B><font color=#CC0000> ��������� ����</font></B>.\"";
		continue;
	}
	$player['mp']-=$ud[2];
if(!in_array ($ud[0],$bl)){$s=1;include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/udar_succ.php");}else{
if(random($cblock)==1 or $tg[hp]==0){
	$s=(rand(3,6))/10;
	if($tg[hp]<=0){$s=1;}
	include($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/udar_succ.php");
}
else $log.=",$logtg,\" ������������$tsex[1]$ms[2] ����\",[6,$ud[0]],\" ��\",$logpl,\".\"";
}}}
global $tg_hp;
$tg_hp=$tg['hp'];
$i=0;
while($i<=10){
	if($exp[$i]==''){$exp[$i]=0;}
	$i++;
}
$expa="$exp[0],$exp[1],$exp[2],$exp[3],$exp[4],$exp[5],$exp[6],$exp[7],$exp[8],$exp[9],$exp[10]";
$query='';
$tgn=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM user WHERE id='".$tg['id']."' LIMIT 1;"));
if($tgn['heal']!='0' and $tg['hp']>0){
	$clr="6633CC";
	$tg['hp'] += $tgn['heal'];
	if($tg['hp']>$tg['hp_all']){$tg['hp']=$tg['hp_all'];}
	if($tg['invisible']<time()){
		$log.=",$logtg,\" �������$tsex[1] ������� �� <B><font color=#FFBB88>+$tgn[heal]</font></B> [$tg[hp]/$tg[hp_all]].\"";
	}else{
		$log.=",$logtg,\" �������$tsex[1] ������� �� <B><font color=#FFBB88>+$tgn[heal]</font></B> [???/???].\"";
	}
	$query = ",heal='0' ";
}
mysqli_query($GLOBALS['db_link'],'UPDATE user SET hp='.AP.$tg['hp'].AP.''.$query.' WHERE id ='.AP.$tg['id'].AP.' LIMIT 1;');
mysqli_query($GLOBALS['db_link'],'UPDATE user SET mp='.AP.$player['mp'].AP.',dmg='.AP.$expa.AP.' WHERE id ='.AP.$player['id'].AP.' LIMIT 1;');
return $log."]";
}

function block($p)
{if(isset($p)){$bl=explode("_",$p);
switch ($bl[1]) {
    case 4: return array(0);break; //������
	case 5: return array(0,1);break; //"������ + ����"
	case 6: return array(0,2);break; //,"������ + �����"
	case 7: return array(1);break; //,"����"
	case 8: return array(1,2);break; //,"���� + �����",
	case 9: return array(1,3);break; //"���� + ����"
	case 10: return array(2);break; //,"�����"
	case 11: return array(2,3);break; //,"����� + ����"
	case 12: return array(3);break; //,"����"
	case 13: return array(0,3);break; //"���� + ������"
	case 14: return array(0);break; //,,"������"
	case 15: return array(0,1);break; //,"������ + ����"
	case 16: return array(1);break; //,"����"
	case 17: return array(1,2);break; //,"���� + �����"
	case 18: return array(2);break; //,"�����"
	case 19: return array(2,3);break; //,"����� + ����
	case 20: return array(3);break; //","����"
	case 21: return array(0,3);break; //,"���� + ������"
	case 22: return array(0);break; //,"������"
	case 23: return array(0,1);break; //,"������ + ����"
	case 24: return array(1,2);break; //,"���� + �����"
	case 25: return array(2,3);break; //,"����� + ����"
	case 26: return array(0,2,3);break; //,"���� + ������ + �����"
	case 27: return array(0,1,2);break; //"������ + ���� + �����"
	case 28: return array(1,2,3);break; //,"���� + ����� + ����"
}}}

function random($i){if(rand(0,100)<$i){return 1;}else return 0;}

unset($tg_hp);
?>
