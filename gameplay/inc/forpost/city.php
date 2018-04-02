<div class="content">
<?php
echo'
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/jquery.MetaData.js"></script>
<script type="text/javascript" src="/js/snowfall.min.jquery.js"></script>
<script type="text/javascript" src="/js/jquery.maphilight.min.js"></script>
<script>
$(function() {
	$("img[usemap]").maphilight();
});
function hilightlinkover(id){
	$("#loc_"+id).mouseover();
}
function hilightlinkout(id){
	$("#loc_"+id).mouseout();
}
$(document).ready(function(){
	$("#SnowContent").snowfall({flakeCount : 150});
});
</script>';
if(isset($player['loc'])){
	switch($player['loc']){
	case'1':
	$prem=explode("|",$player['premium']);
        if ($player['login'] == '' or $player['login'] == 'alexs' or $player['login'] == 'Администрация') {
	$closed = 0;
}
else{
	$closed = 1;
}

        $coord[0] = "210,0,198,4,192,12,194,50,208,50,222,50,216,62,212,72,212,82,222,76,224,92,230,104,232,90,232,76,244,82,238,68,230,60,224,52,232,52,232,22,230,12,224,4"; //выход из города
        $coord[1] = "98,200,105,188,115,194,119,198,134,197,139,188,154,187,158,171,165,162,164,155,164,127,165,99,146,84,140,73,106,56,89,70,80,70,74,76,75,80,61,83,46,104,47,108,51,116,52,130,52,146,57,188,73,189,74,198"; //Оружейная Лавка
        $coord[2] = "476,134,461,148,434,161,417,163,283,159,261,149,242,125,241,114,251,110,253,102,251,95,253,75,253,70,247,65,246,49,248,36,252,34,253,21,268,15,388,13,401,27,413,36,435,40,462,39,466,38,463,32,471,27,475,17,477,14,481,27,485,30,488,34,485,39,483,46,482,66,475,78,476,87,475,94,477,111,482,114,483,119,481,123,477,127,476,130"; //Арена сражений
        $coord[3] = "204,322,244,317,260,315,299,324,314,319,318,319,321,331,355,326,355,320,359,317,367,311,369,294,373,285,379,286,381,267,384,241,377,237,375,234,377,212,381,192,372,175,371,181,324,176,322,159,302,159,301,172,297,183,293,207,233,208,229,198,225,199,218,231,217,236,200,253,198,268,198,294,201,299,201,317"; //госпиталь
        $coord[4] = "437,224,451,206,462,205,467,199,473,206,493,205,514,178,534,201,552,197,562,256,558,256,561,264,565,274,571,278,566,278,570,292,572,300,558,299,572,312,576,318,575,323,574,325,574,329,573,335,568,338,563,337,556,343,540,344,524,332,518,327,515,330,510,331,505,328,483,330,475,309,452,312,451,300,441,301,444,286,438,274,440,243,441,234,439,227"; //таверна
        $coord[5] = "29,324,42,321,46,324,54,322,56,319,73,318,72,311,75,304,87,302,93,302,92,306,97,307,113,307,117,301,123,299,123,295,122,287,116,284,111,286,111,274,119,272,121,267,136,270,154,255,150,245,145,239,143,229,140,226,136,229,125,225,124,220,118,220,114,193,105,190,99,196,100,219,83,220,82,215,76,209,74,207,70,211,67,218,65,221,48,221,31,221,23,225,22,241,20,264,27,281,25,286,23,303,26,316"; //мастерская
        $coord[6] = "593,212,605,208,619,208,619,198,631,202,637,208,645,216,633,224,623,228,611,228,617,220,605,216";//жилой квартал
        $coord[7] = "175,290,171,306,167,318,159,312,159,320,165,332,171,342,179,332,187,320,189,310,179,316,177,304"; //деловой квартал
        $coord[8] = "387,205,391,207,399,210,408,210,415,207,419,202,417,193,416,184,418,179,415,172,405,161,405,148,402,154,397,153,391,151,398,159,403,162,402,164,395,171,388,177,390,183,388,193"; //Беседка путников
        $coord[9] = "424,202,424,188,426,180,427,173,428,169,444,161,442,158,430,155,446,152,445,147,447,148,447,164,457,170,459,171,461,179,463,198,464,208,450,211,442,212,434,210,427,207"; //Лавка странника
        $coord[10] = "608,186,517,179,509,170,514,6,585,-1,612,0,642,42,641,119,639,162,623,176";//Казино
        $coord[11] = "499,175,496,193,474,193,472,172,485,149,509,156";//квест
        $open = $open ?? varcheck($_POST['open']) ?? varcheck($_GET['open']) ?? '';
	echo'
<map name="links">
  <AREA id="loc_28" SHAPE="POLYGON" ' . ((date("H") > 7 or $prem[0] >= 0) ? 'HREF="main.php?get=3&go=28&vcode=' . scode() . '"' : 'HREF="#" onclick="javascript:ErrorStr(\'CityOut\');"') . ' COORDS="' . $coord[0] . '" onmouseover="tooltip(this,\'<b>Выход из города</b>\')" onmouseout="hide_info(this)">
  <AREA id="loc_3" SHAPE="POLYGON" ' . (($player['level'] >= 5) ? 'HREF="main.php?get=3&go=3&vcode=' . scode() . '"' : 'HREF="#" onclick="javascript:ErrorStr(\'master\');"') . ' COORDS="' . $coord[5] . '" onmouseover="tooltip(this,\'<b>Мастерская</b>\')" onmouseout="hide_info(this)">  
  <AREA id="loc_2" SHAPE="POLYGON" SHAPE="POLYGON" href="' . ($open ? '#' : 'main.php?get=3&go=2&vcode=' . scode()) . '" COORDS="' . $coord[1] . '" onmouseover="tooltip(this,\'<b>Оружейная Лавка</b>\')" onmouseout="hide_info(this)">  
  <AREA id="loc_6" SHAPE="POLYGON" HREF="main.php?get=3&go=6&vcode=' . scode() . '" COORDS="' . $coord[2] . '" onmouseover="tooltip(this,\'<b>Арена сражений</b>\')" onmouseout="hide_info(this)">  
  <AREA id="loc_4" SHAPE="POLYGON" HREF="main.php?get=3&go=4&vcode=' . scode() . '" COORDS="' . $coord[3] . '" onmouseover="tooltip(this,\'<b>Госпиталь</b>\')" onmouseout="hide_info(this)">  
  <AREA id="loc_5" SHAPE="POLYGON" HREF="' . ($closed ? '#' : 'main.php?get=3&go=5&vcode=' . scode()) . '" COORDS="' . $coord[4] . '" onmouseover="tooltip(this,\'<b>Таверна(Тех.Работы)</b>\')" onmouseout="hide_info(this)">   
  <AREA id="loc_112" SHAPE="POLYGON" HREF="main.php?get=3&go=112&vcode=' . scode() . '" COORDS="' . $coord[5] . '" onmouseover="tooltip(this,\'<b>Новогодняя лавка</b>\')" onmouseout="hide_info(this)">  
  <AREA id="loc_17" SHAPE="POLYGON" HREF="main.php?get=2&go=17&vcode=' . scode() . '" COORDS="' . $coord[6] . '" onmouseover="tooltip(this,\'<b>Перейти в жилой квартал</b>\')" onmouseout="hide_info(this)">  
  <AREA id="loc_16" SHAPE="POLYGON" HREF="main.php?get=2&go=16&vcode=' . scode() . '" COORDS="' . $coord[7] . '" onmouseover="tooltip(this,\'<b>Перейти в деловой квартал</b>\')" onmouseout="hide_info(this)">  
  <AREA id="loc_44" SHAPE="POLYGON" HREF="' . ($open ? '#' : 'main.php?get=3&go=44&vcode=' . scode()) . '" coords="' . $coord[8] . '" onmouseover="tooltip(this,\'<b>Лавка Репутации<b>\')" onmouseout="hide_info(this)" />  
  <AREA id="loc_45" SHAPE="POLYGON" ' . (($player['level'] >= 5) ? 'HREF="main.php?get=3&go=45&vcode=' . scode() . '"' : 'HREF="#" onclick="javascript:ErrorStr(\'lavka\');"') . ' coords="' . $coord[9] . '" onmouseover="tooltip(this,\'<b>Лавка странника</b>\')" onmouseout="hide_info(this)" />
  <AREA id="loc_1601" SHAPE="POLYGON" HREF="main.php?get=3&go=1601&vcode=' . scode() . '" COORDS="' . $coord[10] . '" onmouseover="tooltip(this,\'<b>Гильдия мастеров</b>\')" onmouseout="hide_info(this)">
</map>
<table cellpadding="0" cellspacing="0" border="0" align="center" width="760">
<tr><td>
<div class="block info">
	<div class="header">
		<span>Городская Площадь</span>
	</div>
<table cellpadding="0" cellspacing="0" border="0" align="center" width="50%">
            <td width="645" height="347" style="position:relative;"  background="img/image/cities/city1'.(!(date("H")<21 && date("H")>6)?'_night':'').'.gif?v1" usemap="#links"><img src="img/image/1x1.gif" width="645" height="347" border="0" usemap="#links" />
      </tr>
      <tr>
        <td bgcolor="#cccccc"><table cellpadding="2" cellspacing="1" border="0" align="center" width="100%">
          <tr>';
		  $osada = mysqli_fetch_array(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `config` WHERE `osada` LIMIT 1;"));
		  if($_GET['StartTrane']){
	if($player['level'] < 33){
		TraneAttack($player,array(5556,5555,5556,5555,5556,5555,660,660,663,663,663,662,662,662,665,665,665,664,664,664,22,22,22,8,8,8));
	}	
}


if($msg){
echo "<SCRIPT>MessBoxDiv('".$msg."',0,0,0,0);</SCRIPT>";
}
            if($player['hp']<$player['hp_all']*0.6){
                echo '<td width=100% bgcolor=#f5f5f5><div align=center><b><font class=nickname><font color=#cc0000>Вы слишком ослаблены для боев!</font></font></b></div></td>';
			}else
			if($osada['osada']>'0'){
            if($osada['osada']<='1'){
            if($player['level'] < 33){
                echo ' <td width="100%" bgcolor="#f5f5f5"><div align=center><b><font class=nickname><font color=#cc0000>&quot;<a href="main.php?StartTrane=1"><font color=#cc0000><b>Вмешаться</b></font></a>&quot; и ты попадешь в бой , Осада длиться меньше минуты</div></td>';
          }}}else{
                echo '<td width=100% bgcolor=#f5f5f5><div align=center><b><font class=nickname><font color=#cc0000>Поздравляю с победой , стой на стражи и жди нового нападения.!</font></font></b></div></td>';
		  }
		  echo'</table></td>
      </tr>
    </table></td>
  </tr>
</table>
        <td bgcolor="#cccccc"><table cellpadding="2" cellspacing="1" border="0" align="center" width="100%">
    </table></td>
  </tr>
</table>';
//осада
		break;
			case'16':
                $coord[0] = "199,1,193,11,187,21,185,29,195,25,197,35,199,45,205,55,207,25,218,30,214,20,209,11"; //Перейти на городскую площадь
                $coord[1] = "75,334,118,335,143,335,169,327,178,316,178,296,180,265,180,242,178,218,151,214,151,209,137,201,131,198,130,186,132,182,126,174,120,164,117,156,115,156,114,164,108,169,105,178,107,187,110,194,110,199,104,198,103,187,106,186,71,165,56,180,44,187,48,196,46,204,35,241,30,250,23,259,29,317,34,325,50,330,60,332"; //Магазин Подарков
                $coord[2] = "92,13,108,-2,117,-2,139,18,145,18,148,28,154,27,154,33,174,35,178,77,173,84,176,97,186,102,190,111,184,116,174,119,176,127,175,131,173,132,174,139,176,139,176,148,173,148,172,154,175,155,173,167,168,170,167,173,167,184,173,186,176,193,173,197,165,202,152,203,147,196,141,194,138,197,104,197,76,198,62,201,48,203,35,198,36,192,39,188,45,184,43,162,38,160,39,143,34,129,33,125,33,120,35,115,39,115,41,109,41,98,46,96,51,85,50,55,55,54,58,52,59,24,74,24,81,14,85,12"; //Дом ценителей
                $coord[3] = "445,281,455,274,457,285,464,286,463,273,483,277,497,283,499,276,539,275,537,231,542,227,543,209,550,209,542,159,530,151,517,117,499,145,496,147,482,124,472,103,471,96,469,96,466,105,452,125,444,133,434,148,419,115,415,126,408,143,402,152,390,160,390,200,386,210,394,212,392,230,399,230,394,254,402,254,406,275,417,275,420,280,431,278,437,278"; //Ярмарка
                $coord[4] = "278,142,293,140,301,144,310,145,321,141,336,141,339,131,355,130,356,119,363,112,365,56,367,49,345,27,342,27,341,23,315,6,312,7,310,4,298,10,291,16,287,20,278,19,272,26,252,47,250,53,251,56,251,68,253,74,253,92,256,102,258,129,274,134,278,136"; //Банк
                $coord[5] = "626,5,640,36,662,34,662,5,642,5"; //Дворец Бракосочетаний
                $coord[6] = "253,216,269,225,294,225,311,213,312,204,310,187,294,176,287,176,286,165,283,162,280,160,280,155,278,155,275,164,275,177,271,177,255,187,253,192,250,203";//Телепорт в дом
                $coord[7] = "663,149,636,152,620,156,615,162,601,156,582,153,584,162,591,168,584,174,577,177,553,178,542,157,551,149,549,129,539,118,540,95,548,92,548,75,556,75,556,74,577,78,586,69,591,80,606,84,611,79,614,78,619,70,624,73,625,76,637,73,643,67,647,72,656,70,660,63,663,64,666,109";//Мэрия города
                $coord[8] = "590,176,602,174,612,174,620,172,613,160,630,168,638,176,646,184,634,188,626,192,609,196,618,186,606,182"; //Закрыто
$closed=1;
	echo'
<map name="links">
  <AREA id="loc_1" SHAPE="POLYGON" HREF="main.php?get=2&go=1&vcode=' . scode() . '" COORDS="' . $coord[0] . '" onmouseover="tooltip(this,\'<b>Перейти на городскую площадь</b>\')" onmouseout="hide_info(this)">
  <AREA id="loc_20" SHAPE="POLYGON" HREF="main.php?get=3&go=20&vcode=' . scode() . '" COORDS="' . $coord[1] . '" onmouseover="tooltip(this,\'<b>Магазин Подарков</b>\')" onmouseout="hide_info(this)">
  <AREA id="loc_34" SHAPE="POLYGON" HREF="main.php?get=3&go=34&vcode=' . scode() . '" COORDS="' . $coord[2] . '" onmouseover="tooltip(this,\'<b>Дом Ценителей</b>\')" onmouseout="hide_info(this)">
	<AREA id="loc_35" SHAPE="POLYGON" HREF="main.php?get=3&go=35&vcode=' . scode() . '" COORDS="' . $coord[3] . '" onmouseover="tooltip(this,\'<b>Дворец Бракосочетаний</b>\')" onmouseout="hide_info(this)">
  <AREA id="loc_21" SHAPE="POLYGON" HREF="main.php?get=3&go=21&vcode=' . scode() . '" COORDS="' . $coord[4] . '" onmouseover="tooltip(this,\'<b>Банк</b>\')" onmouseout="hide_info(this)">
  <AREA id="loc_50" SHAPE="POLYGON" href="' . ($closed == 0 ? '#' : 'main.php?get=3&go=50&vcode=' . scode()) . '" COORDS="' . $coord[5] . '" onmouseover="tooltip(this,\'<b>Дворец Бракосочетаний</b>\')" onmouseout="hide_info(this)">
  <AREA id="loc_1223" SHAPE="POLYGON" href="main.php?get=3&go=1223&vcode=' . scode() . '" COORDS="' . $coord[7] . '" onmouseover="tooltip(this,\'<b>Лавка компенсации</b>\')" onmouseout="hide_info(this)">  
  <AREA id="loc_18" SHAPE="POLYGON" HREF="' . ($closed == 0 ? '#' : 'main.php?get=2&go=18&vcode=' . scode()) . '" COORDS="' . $coord[8] . '" onmouseover="tooltip(this,\'<b>Квартал знаний</b>\')" onmouseout="hide_info(this)">
</map>
<table cellpadding="0" cellspacing="0" border="0" align="center" width="760">
  <tr>
    <td><div class="block info">
	<div class="header">
		<span>Деловой Квартал</span>
	</div>
        <table cellpadding="0" cellspacing="0" border="0" align="center" width="645">
          <tr>
            <td width="645" height="347" style="position:relative;"  background="img/image/cities/city2'.(!(date("H")<21 && date("H")>6)?'_night':'').'.gif?v1"><img src="img/image/1x1.gif" width="645" height="347" border="0" usemap="#links" /></td>
          </tr>
        </table>
</table>
	';
			break;
			case'17':
                $coord[1] = "500,136,531,134,531,121,533,121,533,102,536,101,533,86,539,84,539,45,520,44,511,31,501,45,474,45,473,54,457,59,456,34,449,44,450,58,437,63,422,75,404,54,389,25,387,31,379,31,380,44,377,50,375,49,375,43,377,38,372,32,366,17,362,32,354,41,328,14,320,30,307,29,308,43,297,44,281,23,273,32,266,33,266,46,253,55,251,50,252,46,235,18,221,17,207,36,197,37,195,44,198,45,196,51,190,52,183,58,181,69,178,72,179,134,183,138,191,140,195,137,212,138,211,143,248,136,352,135,353,127,379,126,382,138,396,140,407,142,422,134,423,101,429,103,449,129,483,122,484,129,496,127"; //Жилые Cтроения
                $coord[2] = "33,220,37,197,42,193,44,174,48,171,51,157,90,157,98,151,103,143,123,158,124,167,128,169,166,170,168,148,190,152,195,155,220,153,228,148,229,141,236,143,239,151,246,153,258,167,256,182,251,201,243,208,241,225,245,226,244,245,247,247,245,271,241,274,236,295,237,304,242,313,239,329,241,357,108,354,62,348,47,347,19,336,20,314,14,312,13,296,7,295,9,270,17,269,19,250,24,246,31,239,35,234"; //Городской РынокРынок
                $coord[3] = "56,140,40,136,26,136,32,124,16,130,10,138,2,144,14,152,24,158,36,158,30,148,44,144"; //Перейти на городскую площадь
                $coord[5] = "645,150,633,138,617,132,621,144,593,144,619,156,611,164,627,164,637,158"; //перейти в квартал закона
                $coord[6] = "538,262,482,255,482,232,480,231,481,202,478,198,482,178,476,178,480,151,484,151,484,135,515,121,540,141,538,158,544,158,544,153,591,153,594,170,591,173,591,180,596,185,602,228,597,252,585,262"; //Арсенал
                $coord[7] = "47,131,30,123,11,97,15,89,24,65,34,65,39,63,41,58,45,43,67,44,65,24,68,3,78,10,83,28,85,39,115,39,141,38,147,49,160,63,170,79,174,101,155,113,138,120,117,128,96,134,72,135"; //драгоценные сундуки
                $coord[8] = "400,266,390,269,381,279,372,276,366,272,355,278,341,278,328,286,321,279,315,273,288,280,281,274,264,275,259,256,256,243,266,241,269,225,275,216,273,197,286,192,294,186,307,191,303,182,309,174,304,165,309,157,316,147,340,92,344,83,342,75,346,68,352,72,353,79,361,103,363,110,369,121,374,136,381,161,391,189,408,209,416,205,419,230,423,239,436,251"; //Элка

//церковь
$coord[999]="141,126,137,139,123,140,105,143,95,142,91,134,76,135,68,131,59,133,50,127,41,125,37,121,27,122,27,99,9,94,16,84,19,76,15,74,18,70,21,61,29,61,31,66,36,63,46,63,46,36,68,41,67,26,63,24,62,16,70,0,77,1,79,9,83,10,86,15,82,21,82,25,86,39,108,41,137,36,136,30,140,30,144,55,153,54,152,41,155,41,158,56,175,74,175,78,170,83,174,106,171,110,158,114,156,120,147,123,145,124";

$closed=1;
				echo'
<map name="links">
  <AREA id="loc_26" SHAPE="POLYGON" href="main.php?get=3&go=26&vcode=' . scode() . '" COORDS="' . $coord[1] . '" onmouseover="tooltip(this,\'<b>Заброшенный дом</b><br>Тут находятся монстры.\')" onmouseout="hide_info(this)">
  <AREA id="loc_1" SHAPE="POLYGON" HREF="main.php?get=2&go=1&vcode=' . scode() . '" COORDS="' . $coord[3] . '" onmouseover="tooltip(this,\'<b>Перейти на городскую площадь</b>\')" onmouseout="hide_info(this)">
	<AREA id="loc_1002" SHAPE="POLYGON" href="main.php?get=3&go=1002&vcode=' . scode() . '" COORDS="' . $coord[2] . '" onmouseover="tooltip(this,\'<b>Ярмарка диковинок</b>\')" onmouseout="hide_info(this)">
  <AREA id="loc_19" SHAPE="POLYGON" HREF="main.php?get=2&go=19&vcode=' . scode() . '" COORDS="' . $coord[5] . '" onmouseover="tooltip(this,\'<b>Перейти в квартал закона</b>\')" onmouseout="hide_info(this)">
  <AREA id="loc_111" SHAPE="POLYGON" HREF="main.php?get=3&go=111&vcode=' . scode() . '" coords="' . $coord[6] . '" onmouseover="tooltip(this,\'<b>Арсенал</b>\')" onmouseout="hide_info(this)">
  <AREA id="loc_150" SHAPE="POLYGON" HREF="' . ($closed ? '#' : 'main.php?get=3&go=150&vcode=' . scode()) . '" COORDS="' . $coord[8] . '" onmouseover="tooltip(this,\'<b>Новогодняя Ель Закрыто</b>\')" onmouseout="hide_info(this)">
   <AREA id="loc_1203" SHAPE="POLYGON" HREF="main.php?get=3&go=1203&vcode=' . scode() . '" coords="' . $coord[7] . '" onmouseover="tooltip(this,\'<b>драгоценные сундуки</b>\')" onmouseout="hide_info(this)">
</map>
<table cellpadding="0" cellspacing="0" border="0" align="center" width="760">
  <tr>
    <td><div class="block info">
	<div class="header">
		<span>Жилой квартал</span>
	</div>
        <table cellpadding="0" cellspacing="0" border="0" align="center" width="645">
          <tr>
            <td width="645" height="347" style="position:relative;"  background="img/image/cities/city3'.(!(date("H")<21 && date("H")>6)?'_night':'').'.gif?v1"><img src="img/image/1x1.gif" width="645" height="347" border="0" usemap="#links" /></td>
          </tr>
        </table>
</table>
			';
						break;
			case'18':
                $coord[0] = "468,29,470,41,473,50,475,55,476,56,478,55,480,50,481,39,481,28,486,31,488,32,490,31,491,28,489,23,484,16,478,9,472,3,471,3,468,6,464,12,462,17,459,25,457,30,458,32,463,32,465,31"; //стрелка вверх
                $coord[1] = "6,173,13,163,20,159,31,154,33,155,33,158,31,164,44,165,56,167,59,168,59,170,58,171,52,174,41,175,37,177,35,179,38,183,38,185,38,186,35,188,27,186,15,180,9,176,7,175,6,174"; //стрелка вбок
//$coord[2]="413,305,403,314,390,320,375,322,357,319,345,312,334,301,331,290,332,279,343,270,351,263,359,259,366,254,362,246,361,241,365,233,371,229,378,226,384,228,388,232,390,238,390,246,387,250,385,254,390,258,398,263,406,269,411,276,414,282,415,295,414,301";  //центральная хрень
                $coord[3] = "278,101,265,117,263,123,266,187,262,188,262,193,253,188,254,183,224,175,222,176,228,187,193,181,191,176,188,173,186,177,186,180,176,182,175,176,171,177,170,184,148,188,147,178,144,178,143,184,144,189,133,190,132,186,126,183,126,189,126,195,109,198,104,190,101,184,100,184,96,159,98,150,98,138,95,123,86,130,78,132,85,168,87,171,89,167,90,162,93,162,95,162,97,185,95,186,96,201,105,209,97,211,98,222,92,233,89,225,85,226,85,240,80,246,86,284,90,285,94,302,120,313,126,311,141,315,148,319,163,315,175,315,192,312,199,313,205,311,228,297,237,294,237,283,250,263,268,235,272,227,271,204,271,188,268,186,267,167,270,167,273,164,281,175,278,139,266,129,267,124,276,111";  //военная школа
                $coord[4] = "483,330,472,227,492,215,500,215,519,183,536,185,560,159,572,159,578,183,583,190,609,196,637,332";  //Магазин Вершители Зла
$coord[5]=""; 

$closed=1;
	echo'
<map name="links">
  <AREA SHAPE="POLYGON" HREF="main.php?get=2&go=17&vcode=' . scode() . '" COORDS="' . $coord[0] . '" onmouseover="tooltip(this,\'<b>Перейти в жилой квартал</b>\')" onmouseout="hide_info(this)">
  <AREA SHAPE="POLYGON" HREF="main.php?get=2&go=16&vcode=' . scode() . '" COORDS="' . $coord[1] . '" onmouseover="tooltip(this,\'<b>Перейти в деловой квартал</b>\')" onmouseout="hide_info(this)">
  <AREA SHAPE="POLYGON" href="' . ($closed ? '#' : 'main.php?get=3&go=41&vcode=' . scode()) . '" COORDS="' . $coord[2] . '" onmouseover="tooltip(this,\'<b>Библиотека</b><br>находится в разработке, скоро все будет.\')" onmouseout="hide_info(this)">
  <AREA SHAPE="POLYGON" href="main.php?get=3&go=27&vcode=' . scode() . '" COORDS="' . $coord[3] . '" onmouseover="tooltip(this,\'<b>Военная Школа</b>\')" onmouseout="hide_info(this)">
  <AREA SHAPE="POLYGON" href="main.php?get=3&go=1223&vcode=' . scode() . '" COORDS="' . $coord[4] . '" onmouseover="tooltip(this,\'<b>Магазин Вершители Зла</b>\')" onmouseout="hide_info(this)">
  <AREA SHAPE="POLYGON" href="' . ($closed ? '#' : 'main.php?get=3&go=40&vcode=' . scode()) . '" COORDS="' . $coord[5] . '" onmouseover="tooltip(this,\'<b>Школа Магии</b><br>находится в разработке, скоро все будет.\')" onmouseout="hide_info(this)">
</map>
<table cellpadding="0" cellspacing="0" border="0" align="center" width="760">
  <tr>
    <td><div class="block info">
	<div class="header">
		<span>Квартал Знаний</span>
	</div>
        <table cellpadding="0" cellspacing="0" border="0" align="center" width="645">
          <tr>
            <td width="645" height="347" style="position:relative;"  background="img/image/cities/city4'.(!(date("H")<21 && date("H")>6)?'_night':'').'.jpg?v1"><img src="img/image/1x1.gif" width="645" height="347" border="0" usemap="#links" /></td>
          </tr>
        </table>
</table>';
						break;
			case'19':
                $coord[0] = "3,212,15,202,23,196,31,194,29,206,43,204,59,210,45,214,29,216,37,226,25,228,13,222"; //Перейти в жилой квартал
                $coord[1] = "30,187,118,184,122,176,149,176,160,182,165,182,176,186,218,186,223,185,229,181,236,181,242,179,243,178,268,177,271,187,365,187,364,172,369,168,371,163,372,155,374,100,372,90,365,86,364,50,357,50,323,48,319,42,315,47,307,47,301,41,297,48,287,44,283,49,279,48,273,42,268,42,268,48,261,49,260,31,260,14,236,13,210,-1,174,0,156,12,139,15,130,49,125,48,123,38,119,44,107,40,104,47,96,47,89,40,85,45,77,42,74,47,37,54,16,113,17,119,27,177,28,180"; //Обитель Закона
                $coord[2] = "404,238,460,240,463,257,435,256,407,255"; //Виселица
                $coord[3] = "404,276,456,274,462,256,404,255,403,264"; //Гильотина
                $coord[4] = "412,315,415,310,435,310,436,316,445,315,446,310,472,309,475,317,485,316,488,312,506,313,515,318,520,312,525,313,532,323,545,326,556,328,559,322,563,316,577,311,585,317,601,315,605,308,612,266,612,256,601,236,595,236,590,216,597,206,602,200,603,181,602,161,598,157,595,152,591,151,591,154,586,150,586,146,578,142,576,146,572,113,558,143,553,143,551,139,542,142,542,147,538,149,536,145,529,150,525,162,519,180,518,185,511,185,508,179,506,174,504,169,497,167,494,165,488,166,478,168,472,174,467,184,466,198,470,203,467,222,462,230,464,240,471,247,482,251,491,250,484,268,476,269,467,268,457,268,442,272,433,272,432,278,423,288,409,292,406,293,410,302"; //Тюрьма
                $coord[5] = "386,96,383,113,382,136,382,168,390,170,394,173,424,174,432,180,447,181,461,180,500,173,524,163,532,141,528,110,523,106,521,96,508,92,496,95,486,98,455,98,456,78,447,64,445,49,443,65,432,78,431,96,413,96,385,91,384,93"; //Академия служителей
                $open = $open ?? varcheck($_POST['open']) ?? varcheck($_GET['open']) ?? '';
$closed=1;
echo'
<map name="links">
  <AREA id="loc_17" SHAPE="POLYGON" HREF="main.php?get=2&go=17&vcode=' . scode() . '" COORDS="' . $coord[0] . '" onmouseover="tooltip(this,\'<b>Перейти в жилой квартал</b>\')" onmouseout="hide_info(this)">
  <AREA id="loc_1000" SHAPE="POLYGON" ' . (($player['clan_id'] == 'Life' or $player['clan_id'] == 'Служители порядка' or $player['clan_id'] == 'Верховная Инквизиция' or $player['clan_id'] == 'Мэрия города') ? 'HREF="main.php?get=3&go=1000&vcode=' . scode() . '"' : 'HREF="javascript:ErrorStr(\'zakon\');"') . ' COORDS="' . $coord[1] . '" onmouseover="tooltip(this,\'<b>Обитель Закона</b>\')" onmouseout="hide_info(this)">
  <AREA id="loc_25" SHAPE="POLYGON" href="' . ($closed == 0 ? '#' : 'main.php?get=3&go=25&vcode=' . scode()) . '" COORDS="' . $coord[2] . '" onmouseover="tooltip(this,\'<b>Виселица</b>\')" onmouseout="hide_info(this)">
  <AREA id="loc_47" SHAPE="POLYGON" href="' . ($closed == 0 ? '#' : 'main.php?get=3&go=47&vcode=' . scode()) . '" COORDS="' . $coord[3] . '" onmouseover="tooltip(this,\'<b>Гильотина</b>\')" onmouseout="hide_info(this)">
  <AREA id="loc_33" SHAPE="POLYGON" ' . (($player['clan_id'] == 'Life') ? 'href="main.php?get=3&go=33&vcode=' . scode() . '" ' : (($player['clan_id'] == 'Служители порядка') ? 'href="main.php?get=3&go=33&vcode=' . scode() . '" ' : '')) . 'COORDS="' . $coord[4] . '" onmouseover="tooltip(this,\'<b>Тюрьма</b>\')" onmouseout="hide_info(this)">
  <area id="loc_46" SHAPE="POLYGON" href="' . ($open ? '#' : 'main.php?get=3&go=46&vcode=' . scode()) . '" coords="' . $coord[5] . '" onmouseover="tooltip(this,\'<b>Академия служителей</b><br>находится в разработке, скоро все будет.\')" onmouseout="hide_info(this)" />
</map>
<table cellpadding="0" cellspacing="0" border="0" align="center" width="760">
  <tr>
    <td><div class="block info">
	<div class="header">
		<span>Квартал Закона</span>
	</div>
        <table cellpadding="0" cellspacing="0" border="0" align="center" width="616">
          <tr>
            <td width="616" height="347" style="position:relative;"   background="img/image/cities/city5'.(!(date("H")<21 && date("H")>6)?'_night':'').'.gif?v1">
			  <img src="img/image/1x1.gif" width="645" height="347" border="0" usemap="#links" />
			</td>
          </tr>
        </table>
</table>
			';
	}
}
?>