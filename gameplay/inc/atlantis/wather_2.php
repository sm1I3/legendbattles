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
          <legend align="center"><b><font color="gray">Городская Площадь</font></b></legend>
        <table cellpadding="0" cellspacing="0" border="0" align="center" width="645">
          <tr>
            <td width="760" height="228" style="position:relative;" background="/img/image/cities/wather_2.jpg" usemap="#links"><img src="/img/image/cities/wather_2.jpg" width="760" height="228" border="0" usemap="#links" /></td>
          </tr>
        </table>
      </fieldset>
    </font></td>
  </tr>
</table>
<map name="links" id="links">
    <area shape="poly"
          coords="403,69,385,78,366,84,342,87,326,87,304,82,280,80,264,76,256,72,249,65,241,58,235,51,231,47,225,43,217,41,209,41,215,24,222,17,246,18,269,22,285,28,288,37,299,39,318,37,349,41,364,52,376,54,389,47,408,54,408,62"
          href="main.php?get=3&go=103&vcode=<?php echo scode(); ?>"
          onmouseover="tooltip(this,'<b>Церковная Площядь</b>')" onmouseout="hide_info(this)"/>
    <area shape="poly"
          coords="280,199,293,200,300,201,315,199,326,199,335,201,343,200,354,201,370,203,382,202,394,202,399,205,409,205,414,226,276,225"
          href="main.php?get=3&go=101&vcode=<?php echo scode(); ?>"
          onmouseover="tooltip(this,'<b>Вход в Подводное Царство</b>')" onmouseout="hide_info(this)"/>
</map>
<SCRIPT language="JavaScript">
NewLinksView();
</SCRIPT>
