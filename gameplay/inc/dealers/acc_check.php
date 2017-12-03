<?
$prbd=$player['premium'];
$time=0;
$minus=0;
$userprem=explode("|",$player['premium']);
switch(intval($_POST['premium'])){
	case 0: $filt="id=1";	break;
	case 1: $filt="id=2";	break;
	case 2: $filt="id=3";	break;
	case 3: $filt="id=4";	break;
	case 4: $filt="id=5";	break;
	default: $filt="id=2";	break;
}
$premsql=mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM premium_info WHERE $filt;"));
if($filt=="id=2"){
//echo 'TEST';
switch(intval($_POST['prem'])){
		case 1:	
			if($premsql['id']!=1){
				if($player['nv'] >= $premsql['price_10'] and $premsql['price_10']>0){
					$time=time()+864000;
					$userprem[0] == $premsql['id'] ? $prbd=$premsql['id']."|".($time+$userprem[1]-time()) : $prbd=$premsql['id']."|".$time;
					$minus=$premsql['price_10'];
				}
				else if($player['nv'] >= $premsql['price_30']){
					$time=time()+2592000;
					$userprem[0] == $premsql['id'] ? $prbd=$premsql['id']."|".($time+$userprem[1]-time()) : $prbd=$premsql['id']."|".$time;
					$minus=$premsql['price_30'];
				}
			}
			
		break; //10 days
		case 2:	
			if($premsql['id']!=1){
				if($player['nv'] >= $premsql['price_30']){
					$time=time()+2592000;
					$userprem[0] == $premsql['id'] ? $prbd=$premsql['id']."|".($time+$userprem[1]-time()) : $prbd=$premsql['id']."|".$time;
					$minus=$premsql['price_30'];
				}
			}
						
		break; //30 days
		case 3:
			if($premsql['id']!=1){
				if($player['nv'] >= $premsql['price_60']){
					$time=time()+5184000;
					$userprem[0] == $premsql['id'] ? $prbd=$premsql['id']."|".($time+$userprem[1]-time()) : $prbd=$premsql['id']."|".$time;
					$minus=$premsql['price_60'];
				}	
			}
							
		break; //60 days
		case 4:
			if($premsql['id']!=1){	
				if($player['nv'] >= $premsql['price_90']){
					$time=time()+7776000;
					$userprem[0] == $premsql['id'] ? $prbd=$premsql['id']."|".($time+$userprem[1]-time()) : $prbd=$premsql['id']."|".$time;
					$minus=$premsql['price_90'];
				}
			}
								
		break; // 90 days
		default:
			$prbd=$player['premium'];		
		break;
	}
	if($premsql['id']==4 or $premsql['id']==5){$smiles="1|2|4|8|16|32|64";}else{$smiles="1";}
	$test=explode("|",$prbd);
	//echo "premium: ".date("d.m.y - H:i:s",$test[1]);
	mysqli_query($GLOBALS['db_link'],"UPDATE user SET premium='".$prbd."',nv=nv-".$minus." ".(intval($_POST['premium'])==3?($player['seif']==0?',seif=seif+'.(time()+2592000).' ':',seif=seif+2592000'):'').",forum_smiles='".$smiles."' WHERE id='".$player['id']."';");
	
}
else{
	
	switch(intval($_POST['prem'])){
		case 1:	
			if($premsql['id']!=1){
				if($player['baks'] >= $premsql['price_10'] and $premsql['price_10']>0){
					$time=time()+864000;
					$userprem[0] == $premsql['id'] ? $prbd=$premsql['id']."|".($time+$userprem[1]-time()) : $prbd=$premsql['id']."|".$time;
					$minus=$premsql['price_10'];
				}
				else if($player['baks'] >= $premsql['price_30']){
					$time=time()+2592000;
					$userprem[0] == $premsql['id'] ? $prbd=$premsql['id']."|".($time+$userprem[1]-time()) : $prbd=$premsql['id']."|".$time;
					$minus=$premsql['price_30'];
				}
			}
			
		break; //10 days
		case 2:	
			if($premsql['id']!=1){
				if($player['baks'] >= $premsql['price_30']){
					$time=time()+2592000;
					$userprem[0] == $premsql['id'] ? $prbd=$premsql['id']."|".($time+$userprem[1]-time()) : $prbd=$premsql['id']."|".$time;
					$minus=$premsql['price_30'];
				}
			}
						
		break; //30 days
		case 3:
			if($premsql['id']!=1){
				if($player['baks'] >= $premsql['price_60']){
					$time=time()+5184000;
					$userprem[0] == $premsql['id'] ? $prbd=$premsql['id']."|".($time+$userprem[1]-time()) : $prbd=$premsql['id']."|".$time;
					$minus=$premsql['price_60'];
				}	
			}
							
		break; //60 days
		case 4:
			if($premsql['id']!=1){	
				if($player['baks'] >= $premsql['price_90']){
					$time=time()+7776000;
					$userprem[0] == $premsql['id'] ? $prbd=$premsql['id']."|".($time+$userprem[1]-time()) : $prbd=$premsql['id']."|".$time;
					$minus=$premsql['price_90'];
				}
			}
								
		break; // 90 days
		default:
			$prbd=$player['premium'];		
		break;
	}
	if($premsql['id']==4 or $premsql['id']==5){$smiles="1|2|4|8|16|32|64";}else{$smiles="1";}
	$test=explode("|",$prbd);
	//echo "premium: ".date("d.m.y - H:i:s",$test[1]);
	mysqli_query($GLOBALS['db_link'],"UPDATE user SET premium='".$prbd."',baks=baks-".$minus." ".(intval($_POST['premium'])==3?($player['seif']==0?',seif=seif+'.(time()+2592000).' ':',seif=seif+2592000'):'').",forum_smiles='".$smiles."' WHERE id='".$player['id']."';");

}


?>