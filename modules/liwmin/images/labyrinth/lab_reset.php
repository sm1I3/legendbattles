<?
if($_GET['reset'])
{
	$timenow = time();
	       
	$timegostart = strtotime('4 September 2009 6:45:00');
	$timegoend = strtotime('4 September 2009 7:00:00');
	       
	$timestart = strtotime('10 September 2009 6:45:00');
	$timeend = strtotime('16 September 2009 19:30:00');
	       
	$dxy = array(15,2,3);
	$tim = array($timegostart,$timegoend);
       
	$lab = array
	(
		 0 => array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
		 1 => array(0,1,1,1,1,1,0,0,0,6,0,8,0,11,0,1,0,5,0,0),
		 2 => array(0,4,0,5,0,1,1,1,1,1,0,1,0,1,0,1,0,1,8,0),
		 3 => array(0,1,0,0,0,0,0,0,0,8,0,4,0,1,0,1,0,2,0,0),
		 4 => array(0,1,1,1,1,1,1,1,0,0,0,7,0,1,0,1,0,1,3,0),
		 5 => array(0,1,0,0,0,0,0,0,0,8,0,0,0,1,0,1,0,2,0,0),
		 6 => array(0,1,0,5,0,1,1,0,8,1,8,0,0,1,0,1,0,1,3,0),
		 7 => array(0,1,1,1,4,1,0,0,0,8,0,0,0,1,0,1,0,2,0,0),
		 8 => array(0,1,0,0,0,0,0,1,0,0,0,8,0,1,0,1,0,1,3,0),
		 9 => array(0,1,0,1,4,1,0,1,1,0,1,1,0,1,0,1,0,2,0,0),
		10 => array(0,1,0,1,0,1,1,1,0,0,1,0,0,1,0,1,0,1,3,0),
		11 => array(0,1,1,1,0,8,0,0,0,1,1,0,3,1,1,1,2,1,0,0),
		12 => array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0)
	);
	
	// $kparams[y][x] = array(0,0);
	$kparams[2][3] = array(0);
	$kparams[7][4] = array(0,0);
	$kparams[6][3] = array(1);
	$kparams[2][1] = array(1,0);
	$kparams[1][17] = array(2);
	$kparams[9][4] = array(2,0);
	$kparams[3][11] = array(3,0);
	$kparams[5][9] = array(13,3,3);
	$kparams[3][9] = array(13,3,3);
	$kparams[6][10] = array(11,2,3);
	$kparams[1][11] = array(9,6,3);
	$kparams[7][9] = array(10,10,0);
	$kparams[8][11] = array(9,6,0);
	$kparams[11][5] = array(9,6,1);
	$kparams[2][18] = array(9,6,2);
	$kparams[11][16] = array(0);
	$kparams[9][17] = array(0);
	$kparams[7][17] = array(0);
	$kparams[5][17] = array(0);
	$kparams[3][17] = array(0);
	$kparams[11][12] = array(16,11);
    $kparams[10][18] = array(17,9);
    $kparams[8][18] = array(17,7);
    $kparams[6][18] = array(17,5);
    $kparams[4][18] = array(17,3);
    
    // weapons
    $kwea[1][15] = array(0,0);
    $kwea[4][7] = array(1,0);
    $kwea[6][6] = array(2,0);
    $kwea[11][9] = array(3,0);
       
	$Xmax = sizeof($lab[0]) - 1;
	$Ymax = sizeof($lab) - 1;
       
	$direct = array
	(
		1 => array('25','38','53','61'),
		2 => array(0 => array('03','04','18','22','27','29','36','39','56','62','63','66','70','74','76'), 1 => array('02','20','21','23','26','28','46','49','51','55','58','68','69','72','75','78')),
		3 => array('05','07','08','11','13','16','19','24','30','33','41','52','54','60','64','71','77'),
		4 => array('37','47')
	);
       
	$other = array
	(
		2 => array('r01','r02','r03'),
		3 => array('o01','o02','o03'),
		4 => array('g01','g02','g03','g04'),
		5 => array('k01','k02','k03'),
		6 => array('straj'),
		7 => array('sunduk'),
		8 => array('portal1','portal2'),
		9 => array('laz'),
		10 => array('rodnik1','rodnik2'),
		11 => array('exit')
	);
	
	ipair_put(1,'LABYRINTH',serialize($lab));
	ipair_put(1,'ETIME',$timeend);
	ipair_put(1,'DIRECTION',serialize($dxy));
	ipair_put(1,'LABYRTIME',serialize($tim));
	         
	for($y=1; $y<$Ymax; $y++)
	{
		for($x=1; $x<$Xmax; $x++)
		{
			if($lab[$y][$x])
			{
				if($lab[$y][$x] == 1)
				{
					$forward = $lab[$y - 1][$x] ? 1 : 0;
					$back = $lab[$y + 1][$x] ? 1 : 0;
					$left = $lab[$y][$x - 1] ? 1 : 0;
					$right = $lab[$y][$x + 1] ? 1 : 0;
					$sum = $forward + $back + $left + $right;
                            	   
					if($sum == 2)
					{
						if(($forward && $back) || ($left && $right)) $log = 0;
						else $log = 1;
						
						$size = sizeof($direct[$sum][$log]) - 1;
						ipair_put(1,'p'.$y.'_'.$x,serialize(array($direct[$sum][$log][mt_rand(0,$size)])));
					}
					else
					{
						$size = sizeof($direct[$sum]) - 1;
						ipair_put(1,'p'.$y.'_'.$x,serialize(array($direct[$sum][mt_rand(0,$size)])));
					}	   
				}
				else if($lab[$y][$x] == 4 || $lab[$y][$x] == 5) 
				{
					$tarr = array();
					$tarr[] = $other[$lab[$y][$x]][$kparams[$y][$x][0]];
					foreach($kparams[$y][$x] as $key=>$value) $tarr[] = $value;
					ipair_put(1,'p'.$y.'_'.$x,serialize($tarr));
				}
				else
				{
					$size = sizeof($other[$lab[$y][$x]]) - 1;
					$tarr = array();
					$tarr[] = $other[$lab[$y][$x]][mt_rand(0,$size)];
					foreach($kparams[$y][$x] as $key=>$value) $tarr[] = $value;
					ipair_put(1,'p'.$y.'_'.$x,serialize($tarr));
				}
				
				if(is_array($kwea[$y][$x]))
				{
					$wlab = array(1 => $kwea[$y][$x]);
					ipair_put(1,'AR_'.$y.'x'.$x,serialize($wlab));	
				}
			}
		}
	}
	       
	if($labid = dba_open('/home/sites/game/add_data/labyrinth.cron.db4','n','db4'))
	{
		dba_replace('ROUNDCURR',0,$labid);
		dba_replace('ROUNDSTEP',0.2,$labid);
		dba_replace('ROUNDMAX',12,$labid);
		dba_replace('STIME',$timestart,$labid);
		dba_replace('ETIME',$timeend,$labid);
		dba_sync($labid);
		dba_close($labid);
	}
}
?>