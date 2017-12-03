<?php
if($_GET['StartTrane']){
	if($player['level'] > 10){
		TraneAttack($player,array(2698,2699,2698,2698,2699,2699,2699,2699,2699,2699));
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
        <legend align="center"><b><font color="gray">Врата Хаоса</font></b></legend>
        <table cellpadding="0" cellspacing="0" border="0" align="center" width="645">
          <tr>
            <td width="760" height="228" style="position:relative;" background="http://img.legendbattles.ru/image/cities/haos2.png" usemap="#links"><img src="http://img.legendbattles.ru/image/cities/haos2.png" width="760" height="228" border="0" usemap="#Map" /></td>
          </tr>
        </table>
      </fieldset>
    </font></td>
  </tr>
</table>
<map name="Map" id="Map">
  <area shape="poly" coords="114,165,195,152,202,140,181,121,177,108,186,95,182,86,174,94,170,89,160,88,147,68,153,57,143,57,125,56,114,32,88,19,75,19,92,36,95,54,85,56,78,55,74,59,64,54,67,65,58,87,44,90,41,97,28,85,22,91,34,101,32,114,31,124,18,137,57,157"  href="main.php?StartTrane=true&vcode=<?php echo scode(); ?>" onmouseover="tooltip(this,'<b>Заглянуть в Хижину</b>')" onmouseout="hide_info(this)" />
</map>
<SCRIPT language="JavaScript">
NewLinksView();
</SCRIPT>