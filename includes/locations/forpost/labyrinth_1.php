<?php
$build = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `locations` WHERE `id` = '".$pers['loc']."'"));
list($pers['x'], $pers['y']) = explode('_', $pers['pos']);
$labyrinth = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `labyrinth` WHERE `x`='".$pers['x']."' and `y`='".$pers['y']."'"));

function GoBut($ViewTo){
    global $pers;
    $rotation = array(
        '0'=>array(
            '0'=>array('x'=>0,'y'=>-1),
            '1'=>array('x'=>0,'y'=>1),
            '2'=>array('x'=>-1,'y'=>0),
            '3'=>array('x'=>1,'y'=>0)
        ),
        '90'=>array(
            '0'=>array('x'=>1,'y'=>0),
            '1'=>array('x'=>-1,'y'=>0),
            '2'=>array('x'=>0,'y'=>-1),
            '3'=>array('x'=>0,'y'=>1)
        ),
        '180'=>array(
            '0'=>array('x'=>0,'y'=>1),
            '1'=>array('x'=>0,'y'=>-1),
            '2'=>array('x'=>1,'y'=>0),
            '3'=>array('x'=>-1,'y'=>0)
        ),
        '270'=>array(
            '0'=>array('x'=>-1,'y'=>0),
            '1'=>array('x'=>1,'y'=>0),
            '2'=>array('x'=>0,'y'=>1),
            '3'=>array('x'=>0,'y'=>-1)
        ),
    );
    $lab = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `labyrinth` WHERE `x`='".($pers['x']+$rotation[$pers['rotation']][$ViewTo]['x'])."' and `y`='".($pers['y']+$rotation[$pers['rotation']][$ViewTo]['y'])."'"));
	if($lab['L_img'] == 2 or $lab['L_img'] == 4){
//        if($pers['rotation'] == 180 or $pers['rotation'] == 90){
            if($lab['doors'] == 0){
                unset($lab);
            }
//        }
    }
    return (($lab)?vCode():'');
}

function fImg($L_img,$L_view,$TunelIMG = NULL){
    global $pers;
    $ObjectsImages = array("","","grill","lever","cw_laz","","","su","tp","cw_laz","wt","");
    $ViewImg = '';
    switch($pers['rotation']){
        case'0':
            for($i = 3;$i > 0;$i--){
                $rotation['0']['lw'.$i] = array('y'=>-$i,'x'=>-1);
                $rotation['0']['rw'.$i] = array('y'=>-$i,'x'=>1);
                $rotation['0']['cw'.$i] = array('y'=>-$i,'x'=>0);
                $rotation['0']['lsw'.$i] = array('y'=>-$i,'x'=>-1);
                $rotation['0']['rsw'.$i] = array('y'=>-$i,'x'=>1);             
            }
            $rotation['0']['lsw0'] = array('y'=>0,'x'=>-1);
            $rotation['0']['rsw0'] = array('y'=>0,'x'=>1);
        break;
        case'90':
            for($i = 3;$i > 0;$i--){
                $rotation['90']['lw'.$i] = array('y'=>-1,'x'=>$i);
                $rotation['90']['rw'.$i] = array('y'=>1,'x'=>$i);
                $rotation['90']['cw'.$i] = array('y'=>0,'x'=>$i);
                $rotation['90']['lsw'.$i] = array('y'=>-1,'x'=>$i);
                $rotation['90']['rsw'.$i] = array('y'=>1,'x'=>$i);
            }
            $rotation['90']['lsw0'] = array('y'=>-1,'x'=>0);
            $rotation['90']['rsw0'] = array('y'=>1,'x'=>0);
        break;
        case'180':
            for($i = 3;$i > 0;$i--){
                $rotation['180']['lw'.$i] = array('y'=>$i,'x'=>1);
                $rotation['180']['rw'.$i] = array('y'=>$i,'x'=>-1);
                $rotation['180']['cw'.$i] = array('y'=>$i,'x'=>0);
                $rotation['180']['lsw'.$i] = array('y'=>$i,'x'=>1);
                $rotation['180']['rsw'.$i] = array('y'=>$i,'x'=>-1);
            }
            $rotation['180']['lsw0'] = array('y'=>0,'x'=>1);
            $rotation['180']['rsw0'] = array('y'=>0,'x'=>-1);
        break;
        case'270':
            for($i = 3;$i > 0;$i--){
                $rotation['270']['lw'.$i] = array('y'=>1,'x'=>-$i);
                $rotation['270']['rw'.$i] = array('y'=>-1,'x'=>-$i);
                $rotation['270']['cw'.$i] = array('y'=>0,'x'=>-$i);
                $rotation['270']['lsw'.$i] = array('y'=>1,'x'=>-$i);
                $rotation['270']['rsw'.$i] = array('y'=>-1,'x'=>-$i);
            }
            $rotation['270']['lsw0'] = array('y'=>1,'x'=>0);
            $rotation['270']['rsw0'] = array('y'=>-1,'x'=>0);
        break;
    }
    // Масив 3 клеток перед собой
    for($i = 3;$i > 0;$i--){
        if($TunelIMG[($pers['y']+$rotation[$pers['rotation']]['lw'.$i]['y'])][($pers['x']+$rotation[$pers['rotation']]['lw'.$i]['x'])][0] == false){
            $ViewImg .= '<div class="lw'.$i.'"></div>';
        }
        if($TunelIMG[($pers['y']+$rotation[$pers['rotation']]['rw'.$i]['y'])][($pers['x']+$rotation[$pers['rotation']]['rw'.$i]['x'])][0] == false){
            $ViewImg .= '<div class="rw'.$i.'"></div>';
        }
        if($TunelIMG[($pers['y']+$rotation[$pers['rotation']]['cw'.$i]['y'])][($pers['x']+$rotation[$pers['rotation']]['cw'.$i]['x'])][0] == false){
            $ViewImg .= '<div class="cw'.$i.'"></div>';
        }else{
            if($TunelIMG[($pers['y']+$rotation[$pers['rotation']]['lsw'.$i]['y'])][($pers['x']+$rotation[$pers['rotation']]['lsw'.$i]['x'])][0] == false){
                $ViewImg .= '<div class="lsw'.$i.'"></div>';
            }
            if($TunelIMG[($pers['y']+$rotation[$pers['rotation']]['rsw'.$i]['y'])][($pers['x']+$rotation[$pers['rotation']]['rsw'.$i]['x'])][0] == false){
                $ViewImg .= '<div class="rsw'.$i.'"></div>';
            }
        }
        // Двери и калитки
        if($TunelIMG[($pers['y']+$rotation[$pers['rotation']]['cw'.$i]['y'])][($pers['x']+$rotation[$pers['rotation']]['cw'.$i]['x'])][0] == 2 or $TunelIMG[($pers['y']+$rotation[$pers['rotation']]['cw'.$i]['y'])][($pers['x']+$rotation[$pers['rotation']]['cw'.$i]['x'])][0] == 4 ){
            if($pers['rotation'] == 180 or $pers['rotation'] == 90){
                if($i < 3){
                    $ViewImg .= '<div class="'.$ObjectsImages[$TunelIMG[($pers['y']+$rotation[$pers['rotation']]['cw'.$i]['y'])][($pers['x']+$rotation[$pers['rotation']]['cw'.$i]['x'])][0]].'_'.$TunelIMG[($pers['y']+$rotation[$pers['rotation']]['cw'.$i]['y'])][($pers['x']+$rotation[$pers['rotation']]['cw'.$i]['x'])][2].'_'.$i.'"></div>';
                }
            }elseif($pers['rotation'] == 0 or $pers['rotation'] == 270){
                $ViewImg .= '<div class="'.$ObjectsImages[$TunelIMG[($pers['y']+$rotation[$pers['rotation']]['cw'.$i]['y'])][($pers['x']+$rotation[$pers['rotation']]['cw'.$i]['x'])][0]].'_'.$TunelIMG[($pers['y']+$rotation[$pers['rotation']]['cw'.$i]['y'])][($pers['x']+$rotation[$pers['rotation']]['cw'.$i]['x'])][2].'_'.($i-1).'"></div>';
            }
        }
        // Обьекты
        if($i < 3){
            if($TunelIMG[($pers['y']+$rotation[$pers['rotation']]['cw'.$i]['y'])][($pers['x']+$rotation[$pers['rotation']]['cw'.$i]['x'])][0] >= 3 and $TunelIMG[($pers['y']+$rotation[$pers['rotation']]['cw'.$i]['y'])][($pers['x']+$rotation[$pers['rotation']]['cw'.$i]['x'])][0] != 4 ){
                $ViewImg .= '<div class="'.$ObjectsImages[$TunelIMG[($pers['y']+$rotation[$pers['rotation']]['cw'.$i]['y'])][($pers['x']+$rotation[$pers['rotation']]['cw'.$i]['x'])][0]].$i.'"></div>';
            }
        }
    }
    // Смотрим перед носом
    if($TunelIMG[($pers['y']+$rotation[$pers['rotation']]['lsw0']['y'])][($pers['x']+$rotation[$pers['rotation']]['lsw0']['x'])][0] == false){
        $ViewImg .= '<div class="lsw0"></div>';
    }
    if($TunelIMG[($pers['y']+$rotation[$pers['rotation']]['rsw0']['y'])][($pers['x']+$rotation[$pers['rotation']]['rsw0']['x'])][0] == false){
        $ViewImg .= '<div class="rsw0"></div>';
    }
    // Двери и калитки
    if($TunelIMG[($pers['y']+$rotation[$pers['rotation']]['lsw0']['y'])][($pers['x']+$rotation[$pers['rotation']]['lsw0']['x'])][0] == false and ($TunelIMG[($pers['y'])][($pers['x'])][0] == 2 or $TunelIMG[($pers['y'])][($pers['x'])][0] == 4)){
        if($pers['rotation'] == 180 or $pers['rotation'] == 90){
            $ViewImg .= '<div class="'.$ObjectsImages[$TunelIMG[($pers['y'])][($pers['x'])][0]].'_'.$TunelIMG[($pers['y'])][($pers['x'])][2].'_0"></div>';
        }
    }
    // Обьекты
    if($TunelIMG[($pers['y']+$rotation[$pers['rotation']]['lsw0']['y'])][($pers['x']+$rotation[$pers['rotation']]['lsw0']['x'])][0] == false and $TunelIMG[($pers['y']+$rotation[$pers['rotation']]['cw1']['y'])][($pers['x']+$rotation[$pers['rotation']]['cw1']['x'])][0] == false and $TunelIMG[($pers['y']+$rotation[$pers['rotation']]['rsw0']['y'])][($pers['x']+$rotation[$pers['rotation']]['rsw0']['x'])][0] == false and $TunelIMG[($pers['y'])][($pers['x'])][0] >= 3 and $TunelIMG[($pers['y'])][($pers['x'])][0] != 4){
        $ViewImg .= '<div class="'.$ObjectsImages[$TunelIMG[($pers['y'])][($pers['x'])][0]].'0"></div>';
    }
    return $ViewImg;
}
$VersJS = 'v12345678';
$LabCat = '1';

echo'<HTML>
<HEAD>
<LINK href="/css/frame.css?'.$VersJS.'" rel="STYLESHEET" type="text/css">
<LINK href="/css/labyrinth.css?'.$VersJS.'" rel="STYLESHEET" type="text/css">
<LINK href="/css/NewDesign.css?'.$VersJS.'" rel="STYLESHEET" type="text/css">
<META Http-Equiv="Content-Type" Content="text/html; charset=utf-8">
<META Http-Equiv="Cache-Control" Content="No-Cache">
<META Http-Equiv="Pragma" Content="No-Cache">
<META Http-Equiv="Expires" Content="0">
<SCRIPT src="/js/building_v03.js?'.$VersJS.'"></SCRIPT>
<SCRIPT src="/js/signs.js?'.$VersJS.'"></SCRIPT>
<SCRIPT src="/js/hpmp.js?'.$VersJS.'"></SCRIPT>
<SCRIPT src="/js/t_v01.js?'.$VersJS.'"></SCRIPT>
<SCRIPT src="/js/png.js?'.$VersJS.'"></SCRIPT>
<SCRIPT src="/js/labyrinth_v03.js?'.$VersJS.'"></SCRIPT>
<script type="text/javascript" src="./js/jquery.min.js"></script>
<script type="text/javascript" src="./js/scroll.js"></script>
  <style type="text/css">
	/* Зданий фон */
	.rbg {position:relative;left:0px;top:0px;width:297px;height:204px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/images/'.$LabCat.'/background.jpg);}
	/* Стенка перед лицом */
	.cw1 {position:absolute;left:0px;top:0px;width:297px;height:204px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/images/'.$LabCat.'/cw1.gif);}
	.cw2 {position:absolute;left:0px;top:0px;width:297px;height:204px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/images/'.$LabCat.'/cw2.gif);}
	.cw3 {position:absolute;left:0px;top:0px;width:297px;height:204px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/images/'.$LabCat.'/cw3.gif);}
	/* Проход с лева */
	.lw1 {position:absolute;left:0px;top:0px;width:297px;height:204px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/images/'.$LabCat.'/lw1.gif);}
	.lw2 {position:absolute;left:0px;top:0px;width:297px;height:204px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/images/'.$LabCat.'/lw2.gif);}
	.lw3 {position:absolute;left:0px;top:0px;width:297px;height:204px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/images/'.$LabCat.'/lw3.gif);}
	/* Проход с права */
	.rw1 {position:absolute;left:0px;top:0px;width:297px;height:204px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/images/'.$LabCat.'/rw1.gif);}
	.rw2 {position:absolute;left:0px;top:0px;width:297px;height:204px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/images/'.$LabCat.'/rw2.gif);}
	.rw3 {position:absolute;left:0px;top:0px;width:297px;height:204px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/images/'.$LabCat.'/rw3.gif);}
	/* Левая стена */
	.lsw0 {position:absolute;left:0px;top:0px;width:297px;height:204px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/images/'.$LabCat.'/lsw0.gif);}
	.lsw1 {position:absolute;left:0px;top:0px;width:297px;height:204px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/images/'.$LabCat.'/lsw1.gif);}
	.lsw2 {position:absolute;left:0px;top:0px;width:297px;height:204px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/images/'.$LabCat.'/lsw2.gif);}
	.lsw3 {position:absolute;left:0px;top:0px;width:297px;height:204px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/images/'.$LabCat.'/lsw3.gif);}
	/* Правая стена */
	.rsw0 {position:absolute;left:0px;top:0px;width:297px;height:204px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/images/'.$LabCat.'/rsw0.gif);}
	.rsw1 {position:absolute;left:0px;top:0px;width:297px;height:204px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/images/'.$LabCat.'/rsw1.gif);}
	.rsw2 {position:absolute;left:0px;top:0px;width:297px;height:204px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/images/'.$LabCat.'/rsw2.gif);}
	.rsw3 {position:absolute;left:0px;top:0px;width:297px;height:204px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/images/'.$LabCat.'/rsw3.gif);}
    /* Разные обьекты */
    .grill_0_0 {position:absolute;left:0px;top:0px;width:297px;height:204px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/objects/grill1.png);}
	.grill_0_1 {position:absolute;left:0px;top:0px;width:297px;height:204px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/objects/grill2.png);}
	.grill_0_2 {position:absolute;left:0px;top:0px;width:297px;height:204px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/objects/grill3.png);}
    .grill_1_0 {position:absolute;left:0px;top:0px;width:297px;height:204px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/objects/grill11.png);}
	.grill_1_1 {position:absolute;left:0px;top:0px;width:297px;height:204px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/objects/grill22.png);}
	.grill_1_2 {position:absolute;left:0px;top:0px;width:297px;height:204px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/objects/grill33.png);}
    
    .lever0 {position:absolute;left:91px;top:100px;width:84px;height:91px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/objects/lever1.png);}
    .lever1 {position:absolute;left:91px;top:60px;width:84px;height:91px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/objects/lever2.png);}
    .lever2 {position:absolute;left:101px;top:35px;width:84px;height:91px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/objects/lever3.png);}

    .su0 {position:absolute;left:91px;top:135px;width:115px;height:67px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/objects/su0.png);}
    .su1 {position:absolute;left:91px;top:105px;width:115px;height:67px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/objects/su1.png);}
    .su2 {position:absolute;left:91px;top:85px;width:115px;height:67px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/objects/su2.png);}

    .tp0 {position:absolute;left:95px;top:145px;width:108px;height:55px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/objects/tp0.png);}
    .tp1 {position:absolute;left:95px;top:115px;width:108px;height:55px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/objects/tp1.png);}
    .tp2 {position:absolute;left:95px;top:85px;width:108px;height:55px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/objects/tp2.png);}
        
    .cw_laz0 {position:absolute;left:0px;top:0px;width:297px;height:204px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/images/'.$LabCat.'/cw_laz1.gif);}
	.cw_laz1 {position:absolute;left:0px;top:0px;width:297px;height:204px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/images/'.$LabCat.'/cw_laz2.gif);}
	.cw_laz2 {position:absolute;left:0px;top:0px;width:297px;height:204px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/images/'.$LabCat.'/cw_laz3.gif);}

    .wt0 {position:absolute;left:95px;top:95px;width:108px;height:107px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/objects/wt0.png);}
    .wt1 {position:absolute;left:95px;top:75px;width:108px;height:107px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/objects/wt1.png);}
    .wt2 {position:absolute;left:95px;top:60px;width:108px;height:107px;background-image:url(http://img.legendbattles.ru/image/gameplay/labyrinth/objects/wt2.png);}

  </style>
</HEAD>
<BODY>

<SCRIPT language="JavaScript">';
if($pers['fcolor_time']>time() or $pers['fcolor_time']==0){
	$nickclr = $pers['fcolor'];
}else{$nickclr='000000';}
echo "var fcolor = ['".$nickclr."',''];";
echo'
var inshp = ['.InsHP().'];
var vcode = [[1,"'.vCode().'"],[1,"'.vCode().'"],[1,"'.(($labyrinth['L_img'] == 11)? vCode() : '' ).'"]];
var build = ["'.$pers['login'].'","'.$pers['level'].'/'.$pers['u_lvl'].'",'.$pers['sklon'].',"'.$pers['clan_gif'].'","'.$pers['clan'].'","'.$pers['clan_d'].'",'.$build['but'].',"main","'.$build['disbut'].'","'.$build['textid'].'",0,0,""];
';
// тут мы строим сетку кординат
$Cord = '';
for($y=($pers['y']-3); $y<=($pers['y']+3); $y++){
	$Cordx = '';
	for($x=($pers['x']-3); $x<=($pers['x']+3); $x++){
        $MiniMap = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `labyrinth` WHERE `x`='".($x)."' and `y`='".($y)."'"));
		$Cordx .= '['.(($MiniMap['L_img'])?($MiniMap['L_img']?$MiniMap['L_img']:'12'):0).','.(($MiniMap['L_img'] == 4 || $MiniMap['L_img'] == 5)?$MiniMap['L_view']:0).'],';
		$ArrayMiniMap[$y][$x] = array((($MiniMap['L_img'])?$MiniMap['L_img']:0),(($MiniMap['L_img'] == 4 || $MiniMap['L_img'] == 5)?$MiniMap['L_view']:0),$MiniMap['doors']);
	}
	$Cord .= '['.substr($Cordx,0,strlen($Cordx)-1).'],';
}
if($labyrinth['L_img'] == 11){
    mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `rotation` = '0' WHERE `id` = '".$pers['id']."'");
    $pers['rotation'] = 0;
	echo'var param = [[0,\''.fImg($labyrinth['L_img'],$labyrinth['L_view'],$ArrayMiniMap).'\',["'.GoBut(0).'"],[],"",[0,"",""]]];';
}else{
    // построили
	echo'var param = [[1,\''.fImg($labyrinth['L_img'],$labyrinth['L_view'],$ArrayMiniMap).'\',["'.GoBut(0).'","'.GoBut(1).'","'.GoBut(2).'","'.GoBut(3).'"],[],"",['.$pers['rotation'].',"'.vCode().'","'.vCode().'"]],';
	if($labyrinth['L_img'] == '3'){
        echo '["Дернуть Рычаг","10","' . vCode() . '"]';
	}elseif($labyrinth['L_img'] == '7'){
        echo '["Открыть Сундук","test","' . vCode() . '"]';
	}elseif($labyrinth['L_img'] == '8'){
        echo '["Телепортироваться","10","' . vCode() . '"]';
	}elseif($labyrinth['L_img'] == '9'){
        echo '["Разведать Лаз","10","' . vCode() . '"]';
	}elseif($labyrinth['L_img'] == '10'){
        echo '["Сделать Глоток","tset","test"]';
	}elseif($labyrinth['L_img'] == '11'){
        echo '["Открыть Сундук","tset","test"]';
	}else{
		echo'[]';
	}
    echo ',[[/* Ключи */],[/* Карты */],[/*[10,1,1,"' . vCode() . '"]*/],[/* Вещи */]],[[],[],[],[]],[';
	$Query = mysqli_query($GLOBALS['db_link'],"SELECT * FROM `user` WHERE `loc`='501' and `pos`='".$pers['pos']."' and `last`>'".(time()-300)."'");
	$view_lab_nicks = '';
	while($row = mysqli_fetch_assoc($Query)){
		$view_lab_nicks .= '["'.$row['login'].'","'.$row['level'].'/'.$row['u_lvl'].'","'.$row['clan_gif'].'",'.$row['sklon'].'],';
	}
	echo substr($view_lab_nicks,0,strlen($view_lab_nicks)-1).'],['.substr($Cord,0,strlen($Cord)-1).'],"'.$DialogMSG.'","'.(($pers['wait']-time() > 0) ? $pers['wait']-time() : 0 ).'"];';
}
echo'
view_labyrinth();
</SCRIPT>

</BODY>
</HTML>';