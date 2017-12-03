<?

$um=explode("|",$player['umen']);
$b_skills=0;
$m_skills=0;
$b_new_skills=0;
$m_new_skills=0;
$fail=0;
foreach($um as $key=>$val){
	if($val>0){
		if($key<21){$b_skills+=calc_um($key,$val);}
		else {$m_skills+=calc_um($key,$val);}
	}
}
ksort ($f); 
$i=0;
foreach($f as $key=>$val){
	if($val>100){
		$val=100;
	}
	if($val<0){
		$val=0;
	}
	if($val<$um[$key]){$fail=1;}
	if($val==0){$f[$key]='';}	
	else {
		$f[$key]=intval($val);
		if($key<21){$b_new_skills+=calc_um($key,$val);}
		else {$m_new_skills+=calc_um($key,$val);}
	}
}
$freeskills=$player[fr_bum]-($b_new_skills-$b_skills);
$freeskillsmir=$player[fr_mum]-($m_new_skills-$m_skills);
//echo "$player[fr_bum] | $b_new_skills | $b_skills";
if($freeskills>=0 and $freeskillsmir>=0 and $fail==0){
	if($f[30]>0 or $f[33]>0){
		$hps=(10000/($f[30]/100+1)); $mps=(10000/($f[33]/100+1));
		mysqli_query($GLOBALS['db_link'],'UPDATE user SET hps='.AP.$hps.AP.', mps='.AP.$mps.AP.' WHERE id='.AP.$player['id'].AP.'LIMIT 1;');
	}
	$um=implode("|",$f);
	mysqli_query($GLOBALS['db_link'],'UPDATE user SET umen='.AP.$um.AP.', fr_bum='.AP.$freeskills.AP.', fr_mum='.AP.$freeskillsmir.AP.' WHERE login='.AP.$_SESSION['user']['login'].AP.'LIMIT 1;');calchp();calcstat($player['id']);
}

		
		
function calc_um($id,$value){
	$sk_arr=array("10:8:6:4","8:6:4:2","8:6:4:2","8:6:4:2","8:6:4:2","8:6:4:2","8:6:4:2","8:6:4:2","6:4:4:2","10:8:6:4","4:4:2:2","2:2:2:2","8:6:4:2","8:6:4:2","8:6:4:2","8:6:4:2","6:4:2:2","6:4:2:2","6:4:2:2","6:4:2:2","6:4:2:2","2:2:2:2","6:4:3:2","6:4:3:2","6:4:3:2","10:8:6:4","8:6:4:2","8:6:4:2","2:2:2:2","2:2:2:2","6:4:3:2","2:2:2:2","6:4:2:2","6:4:3:2","6:4:3:2","6:4:3:2","6:4:3:2");
	$val=explode(":",$sk_arr[$id]);
	$skill=0;
	$a=0;$b=0;$c=0;$d=0;
	if($skill==0){
		while(($val[0]*$a)<25){
			$a++;
			if($value==$val[0]*$a){$skill=$a;}
		}
		$val[0]*=$a;
	}
	if($skill==0){
		while(($val[0]+$val[1]*$b)<50){
			$b++;
			if($value==($val[0]+$val[1]*$b)){$skill=$a+$b;}
		}
		$val[1]*=$b;
	}
	if($skill==0){
		while(($val[0]+$val[1]+$val[2]*$c)<=75){
			$c++;
			if($value==($val[0]+$val[1]+$val[2]*$c)){$skill=$a+$b+$c;}
		}
		$val[2]*=$c;
	}
	if($skill==0){
		while(($val[0]+$val[1]+$val[2]+$val[3]*$d)<100){
			$d++;
			$x=$val[0]+$val[1]+$val[2]+$val[3]*$d;
			if($x>100){$x=100;}
			if($value==$x){$skill=$a+$b+$c+$d;}
		}
		$val[3]*=$d;
	}
	return $skill;
}
?>
