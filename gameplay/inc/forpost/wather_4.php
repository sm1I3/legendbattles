<?php
if($_GET['StartTrane']){
	if($player['level'] > 15){
		TraneAttack($player,array(1597,1598,1597,1598,1599));
	}	
}
?>
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/jquery.MetaData.js"></script>
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
</script>
<table cellpadding="0" cellspacing="0" border="0" align="center" width="760">
  <tr>
    <td><font class="proce">
      <fieldset>
          <legend align="center"><b><font color="gray">Молитвенный Дом</font></b></legend>
        <table cellpadding="0" cellspacing="0" border="0" align="center" width="645">
          <tr>
            <td width="760" height="228" style="position:relative;" background="/img/image/cities/wather_4.jpg" usemap="#links"><img src="/img/image/cities/wather_4.jpg" width="760" height="228" border="0" usemap="#Map" /></td>
          </tr>
        </table>
      </fieldset>
    </font></td>
  </tr>
</table>
<map name="Map" id="Map">
    <area shape="poly"
          coords="356,71,358,80,354,88,352,98,352,114,352,137,353,149,352,156,350,162,345,167,335,170,303,181,314,181,326,180,336,179,344,177,343,182,342,189,347,192,351,188,360,181,366,178,376,174,379,168,380,147,383,171,386,173,393,175,397,181,401,187,405,189,408,193,416,192,415,187,409,181,413,178,419,177,429,179,437,182,444,185,452,185,455,180,445,177,432,173,426,170,413,165,407,163,405,160,405,111,404,106,404,98,401,86,400,80,401,73,407,80,412,85,413,92,411,100,411,110,412,120,414,129,415,137,418,129,419,122,422,123,426,129,427,137,427,146,426,154,427,158,433,151,436,143,434,134,435,125,434,120,432,113,429,108,427,102,425,93,423,87,421,80,419,76,416,70,413,67,419,65,424,65,420,58,413,55,408,51,399,49,393,47,389,45,389,43,395,43,404,43,412,42,419,39,427,36,429,32,422,33,417,36,411,37,406,36,402,33,402,31,410,21,403,24,397,28,393,30,391,28,392,26,388,26,383,25,378,25,374,26,371,26,367,25,367,28,365,28,360,28,356,25,350,22,349,26,353,29,354,34,348,36,343,36,337,35,330,34,351,42,353,45,352,48,348,51,341,57,335,61,332,68,333,73,336,67,340,62,343,69,338,78,338,86,335,93,332,103,328,112,325,122,325,130,325,145,326,154,332,158,331,146,333,134,334,127,338,126,342,132,340,139,344,142,347,124,345,117,347,105,346,99,348,89,348,81,350,74"
          href="main.php?StartTrane=true&vcode=<?php echo scode(); ?>"
          onmouseover="tooltip(this,'<b>Призыв монстров</b>')" onmouseout="hide_info(this)"/>
    <area shape="poly"
          coords="584,226,591,221,595,216,598,214,598,207,606,207,611,202,611,197,616,190,623,189,628,185,629,175,634,171,640,167,647,165,655,163,660,160,667,157,676,153,682,153,687,155,690,158,693,159,699,162,699,169,695,175,690,180,690,184,695,187,702,190,706,190,711,190,716,190,722,188,730,184,736,179,727,174,720,172,731,173,738,170,741,166,747,161,752,158,758,157,765,232"
          href="main.php?get=3&go=103&vcode=<?php echo scode(); ?>"
          onmouseover="tooltip(this,'<b>Выход на Церковную Площядь</b>')" onmouseout="hide_info(this)"/>
</map>
<SCRIPT language="JavaScript">
NewLinksView();
</SCRIPT>
