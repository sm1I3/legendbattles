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
        <legend align="center"><b><font color="gray">Портал</font></b></legend>
        <table cellpadding="0" cellspacing="0" border="0" align="center" width="645">
          <tr>
            <td width="760" height="228" style="position:relative;" background="/img/image/cities/haos0.png" usemap="#links"><img src="/img/image/cities/haos0.png" width="760" height="228" border="0" usemap="#Map" /></td>
          </tr>
        </table>
      </fieldset>
    </font></td>
  </tr>
</table>
<map name="Map" id="Map">
  <area shape="poly" coords="129,132,148,142,169,148,186,147,215,147,234,147,297,147,322,142,295,84,292,58,281,58,274,104,271,80,263,83,260,109,230,116,213,116,205,111,196,115,188,105,182,51,170,48,156,100,146,116" href="main.php?get=3&go=1225&vcode=<?php echo scode(); ?>" onmouseover="tooltip(this,'<b>Портал хаоса</b>')" onmouseout="hide_info(this)" />
</map>
<SCRIPT language="JavaScript">
NewLinksView();
</SCRIPT>
