<?

	$player = player();	
	$pt=allparam($player);
	$chrecipe = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `koldyn` WHERE `id`='".intval($_POST['rid'])."' LIMIT 1;");
	if(mysqli_num_rows($chrecipe)>0){
		$chrecipe=mysqli_fetch_assoc($chrecipe);
		if($player['koldyn_rec']=="0"){$koldyn_rec = "0";}
		else{$koldyn_rec = explode("|",$player['koldyn_rec']);}	
		if($pt[75]>=$chrecipe['nav'] and $player['nv']>=$chrecipe['price'] and in_array($chrecipe['id'],$koldyn_rec)==false){
			$message=1;include ($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/koldyn/koldyn_messages".".php");
			mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `koldyn_rec`='".(($player['koldyn_rec']=="0")?"|".$chrecipe['id']:$player['koldyn_rec']."|".$chrecipe['id'])."',`nv`=`nv`-'".$chrecipe['price']."' WHERE `id`='".$player['id']."' LIMIT 1;");
		}
		else{
			(($pt[75]<$chrecipe['nav'])?($message=2):(($player['nv']<$chrecipe['price'])?($message=3):($message=4)));
			include ($_SERVER["DOCUMENT_ROOT"]."/gameplay/inc/koldyn/koldyn_messages".".php");
		}
	}
