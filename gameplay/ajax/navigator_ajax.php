<?php
#GLOBALS OFF
session_start();
include($_SERVER["DOCUMENT_ROOT"]."/includes/config.inc.php");
include($_SERVER["DOCUMENT_ROOT"]."/includes/functions.php");
foreach($_POST as $keypost=>$valp){
	$valp = varcheck($valp);
	$_POST[$keypost] = $valp;
}
foreach($_GET as $keyget=>$valg){
	$valg = varcheck($valg);
	$_GET[$keyget] = $valg;

}

header('Content-type: text/html; charset=UTF-8');
$error='';
$pers = GetUser($_SESSION['user']['login']);
$prem=explode("|",$pers['premium']);
switch(intval($_GET['act'])){
	case 1:
		if($pers['id']){
			list($pers['x'], $pers['y']) = explode('_', $pers['pos']);
			if($pers['x']<=14 and $pers['y']<=9){
				$query_nature = mysqli_query($GLOBALS['db_link'],"SELECT `x`,`y` FROM `nature` WHERE `x`<='".(14)."' and `y`<='".(9)."' ORDER BY `y`,`x`");
			}
			elseif($pers['x']>=100 and $pers['y']<=18){
				$query_nature = mysqli_query($GLOBALS['db_link'],"SELECT `x`,`y` FROM `nature` WHERE `x`>='".(100)."' and `y`<='".(18)."' ORDER BY `y`,`x`");
			}
			$pnature = '';
			if(mysqli_num_rows($query_nature)>0){	
				while($nature = mysqli_fetch_assoc($query_nature)){		
					//if($pers['x']!=$nature['x'] or $pers['y']!=$nature['y']){
						$pnature .= '['.$nature['x'].','.$nature['y'].',"'.vCode().'"],';
					//}
				}
			} else {
                $error = 'Навигатор недоступен в этой локации!';
            }
			$captcha="00000";
            header("Content-type: text/html; charset=UTF-8");
			echo 'NAVI@["'.($error?$error:'').'",""]@[0,"'.$captcha.'","'.(($serp)?$serp['id_item']:'').'",1,1000,'.substr($pnature,0,strlen($pnature)-1).']';
		}
	break;
	case 2:
		 //$way['start'] = $pers['x']."_".$pers['y'];
		// $way['end'] = $GoPos['x']."_".$GoPos['y'];
		if($pers['id']){
			$count=0;
			list($pers['x'], $pers['y']) = explode('_', $pers['pos']);
			$GoPos = array('x'=>intval($_GET['x']),'y'=>intval($_GET['y']));
			//if($GoPos['x']<=14 and $GoPos['y']<=9){
				$path = findpath($pers['x'],$pers['y'],$GoPos['x'],$GoPos['y']);
				if($path){
						$patharr=$path;
						$path = explode("|",$path);
						$path = array_reverse($path);
						if($path[2]){
							$dest = array_reverse($path);
							mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `navidest`='".$dest[0]."',`navipath`='".$patharr."' WHERE `id`='".$pers['id']."' LIMIT 1;");
						}
						foreach($path as $key=>$val){
							list($x, $y) = explode('_', $val);		
							if($key==1){$pnature .= '['.$x.','.$y.',"'.vCode().'","'.$key.'|'.$val.'"],';}			
						}	
					
				} else {
                    $error = 'Путь не найден!';
                }
			//}
            //else{$error='Навигатор недоступен в этой локации!';}
			echo 'NAVIGO@["'.($error?$error:'').'",""]@[0,"'.$captcha.'","'.(($serp)?$serp['id_item']:'').'",1,1000,'.substr($pnature,0,strlen($pnature)-1).']';
		}
	break;
}

function check_way($way){
	list($x, $y) = explode("_",$way);
	$query_nature = mysqli_query($GLOBALS['db_link'],"SELECT `x`,`y` FROM `nature` WHERE `x`>='".($x-1)."' and `x`<='".($x+1)."' and `y`>='".($y-1)."' and `y`<='".($y+1)."'");
	while($nature = mysqli_fetch_assoc($query_nature)){
		$xy .= $nature['x'].'_'.$nature['y']."@";
	}
	$xy = substr($xy,0,strlen($xy)-1);
	return $xy;
}
	 
	 function way($xy,$xyn){
		$xy = explode("_",$xy);
		$xyn = explode("_",$xyn);
		$cost = (($xy[0] - $xyn[0])*($xy[0] - $xyn[0])) + (($xy[1] - $xyn[1])*($xy[1] - $xyn[1]));
		return round($cost);
	 }
	 
function findpath($x,$y,$xn,$yn){
		$start['c'] = $x."_".$y;
		$end['c'] = $xn."_".$yn;
		$closedset = "";
    $start['f'] = way($start['c'], $end['c']); // Эвристическая оценка расстояние до цели. h(x)
		$openset [] = $start['c'];
		$fset[]=$start['f'];
		$err='';
		$b=0;
	    while($openset){
			$oldf='';
			$low='';
			$lowi='';
			for($i=0;$i < count($openset);$i++){
				if(empty($oldf)){
					$oldf = $fset[$i];
					$low = $openset[$i];
					$lowi = $i;
				}
				elseif($oldf>$fset[$i]){
					$oldf = $fset[$i];
					$low = $openset[$i];
					$lowi = $i;
				}
			}
			if($low == $end['c']){
                $err = recpath($start, $kletka[$openset[$lowi]], $kletka); //заполняем карту path_map
				break;
			}
			unset($openset[$lowi]);
			unset($fset[$lowi]);
			sort($openset);
			sort($fset);
			$closedset[] = $low; $b++;
			$nearlow = explode("@",check_way($low));
			foreach($nearlow as $val){				
				if(in_array($val,$closedset)){continue;}
				else{
					$kletka[$val]['f'] = way($val,$end['c']);
					$kletka[$val]['c'] = $val;
					if(!in_array($val,$openset)){$openset[] = $val;$fset[] = $kletka[$val]['f'];$score = 1;}
					else{
						$key = array_search($val,$openset);
						if($fset[$key]<$kletka[$val]['f']){$score = 1;}
						else{$score = 0;}
					}
					if($score == 1){
						$key = array_search($val,$openset);
						$kletka[$val]['came_from'] = $low;
						$kletka[$val]['f'] = way($val,$end['c']);
						$openset[$key] = $kletka[$val]['c'];
						$fset[$key] = $kletka[$val]['f'];																			
					}
				}		
			}
		}		
	return $err;	
}

function recpath($start, $goal, $kletka){
// Добавляем в карту все вершины от finish_node до start_node.
	$path_map = '';
    $current['c'] = $goal['c']; // поиск начинается от финиша
	while ($current['c']!=''){
        $path_map .= $current['c'] . "|"; // Добавить вершину в карту
		$current['c'] = $goal['came_from'];		
		$goal = $kletka[$goal['came_from']];		
	}
	$path_map = substr($path_map,0,strlen($path_map)-1);
	//return 'test:'.$kletka[$goal['came_from']]['came_from']." test2:".$kletka[$goal['came_from']];
	return $path_map;
}














?>