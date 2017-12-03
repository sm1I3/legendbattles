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
          <legend align="center"><b><font color="gray">Церковная Площядь</font></b></legend>
        <table cellpadding="0" cellspacing="0" border="0" align="center" width="645">
          <tr>
            <td width="760" height="228" style="position:relative;" background="/img/image/cities/wather_3.jpg" usemap="#links"><img src="/img/image/cities/wather_3.jpg" width="760" height="228" border="0" usemap="#Map" /></td>
          </tr>
        </table>
      </fieldset>
    </font></td>
  </tr>
</table>
<map name="Map" id="Map">
    <area shape="poly" coords="665,182,669,177,676,174,682,174,685,177,693,177,697,180,693,184,676,184,669,184"
          href="main.php?get=3&go=102&vcode=<?php echo scode(); ?>"
          onmouseover="tooltip(this,'<b>Городская Площадь</b>')" onmouseout="hide_info(this)"/>
    <area shape="poly"
          coords="725,178,730,172,737,169,745,170,753,173,758,179,758,182,757,187,749,187,756,193,747,194,737,194,729,193,727,190,730,187,722,188,717,188,711,187,713,182,718,179"
          href="main.php?get=3&go=102&vcode=<?php echo scode(); ?>"
          onmouseover="tooltip(this,'<b>Городская Площадь</b>')" onmouseout="hide_info(this)"/>
    <area shape="poly"
          coords="424,81,430,74,429,67,430,60,436,52,437,45,443,36,444,28,448,22,454,16,462,7,468,16,466,19,470,25,469,29,474,34,475,43,479,48,480,54,479,62,484,65,488,70,489,74,496,75,504,77,510,79,515,80,519,78,519,82,527,85,531,89,540,87,537,92,541,99,543,102,559,102,547,107,546,114,546,120,556,123,558,113,562,120,564,129,564,139,566,148,567,140,572,132,574,124,575,113,580,120,581,128,584,134,583,140,582,148,580,155,582,159,581,168,585,170,589,163,593,151,593,158,590,169,588,174,595,175,601,170,603,175,599,181,598,186,601,190,609,189,609,194,601,197,592,194,584,194,574,195,568,198,549,198,538,199,523,198,509,198,497,198,490,199,484,206,478,208,468,208,462,207,455,207,442,206,433,205,428,202,420,203,405,203,391,203,385,203,375,203,366,199,361,196,350,197,342,194,332,195,325,196,315,197,303,197,289,195,282,194,275,190,272,184,273,175,279,176,290,171,298,167,311,168,320,168,334,169,328,167,333,169,327,168,329,165,325,169,326,166,319,165,316,162,308,160,301,160,308,155,318,147,329,149,336,150,342,153,345,147,344,140,348,133,348,127,350,118,356,106,358,115,362,123,363,133,364,138,368,129,367,119,373,113,374,104,377,98,377,93,380,88,384,78,387,68,391,60,397,70,400,78,403,85,405,90,412,86"
          href="main.php?get=3&go=104&vcode=<?php echo scode(); ?>" onmouseover="tooltip(this,'<b>Молитвенный Дом</b>')"
          onmouseout="hide_info(this)"/>
</map>
<SCRIPT language="JavaScript">
NewLinksView();
</SCRIPT>
