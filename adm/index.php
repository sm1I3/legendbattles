<? require('kernel/before.php'); ?>
<? session_start();?>
<HTML>
<HEAD>
<LINK href="/css/game.css" rel=STYLESHEET type=text/css>
<META Http-Equiv=Content-Type Content="text/html; charset=windows-1251">
<META Http-Equiv=Cache-Control Content=No-Cache>
<META Http-Equiv=Pragma Content=No-Cache>
<META Http-Equiv=Expires Content=0>
<?php
if($_GET['addid'] == 'm0neditor'){
?>
<script>
document.write('<div id="darker" style="display:none;"><table cellspacing="0" cellpadding="0" width="300" style="position:relative;width:300px;left:50%;top:50%;margin-left:-150px;margin-top:-105px;">  <tr>    <td style="width:18px;height:18px;"><div style="position:absolute; width:30px; height:30px; background:url(http://img.w.wenl.ru/image/closebox.png) no-repeat;right:0px;top:0px;cursor:pointer;" onclick="ShowForm();">&nbsp;</div><img src="http://img.w.wenl.ru/image/FormUp/left_top.png" width="18" height="18"></td>    <td style="height:18px;background-image:url(\'http://img.w.wenl.ru/image/FormUp/top.png\');"></td>    <td style="width:18px;height:18px;"><img src="http://img.w.wenl.ru/image/FormUp/right_top.png" width="18" height="18"></td>  </tr>  <tr>    <td style="width:18px;background-image:url(\'http://img.w.wenl.ru/image/FormUp/left.png\');"></td>    <td style="background-image:url(\'http://img.w.wenl.ru/image/FormUp/bg.png\');" align="center"><div id="ContentError"></div></td>    <td style="width:18px;background-image:url(\'http://img.w.wenl.ru/image/FormUp/right.png\');"></td>  </tr>  <tr>    <td style="width:18px;height:18px;"><img src="http://img.w.wenl.ru/image/FormUp/left_bottom.png" width="18" height="18"></td>    <td style="height:18px;background-image:url(\'http://img.w.wenl.ru/image/FormUp/bottom.png\');"></td>    <td style="width:18px;height:18px;"><img src="http://img.w.wenl.ru/image/FormUp/right_bottom.png" width="18" height="18"></td>  </tr></table></div>');
</script>
<?php
}else{
	echo'<SCRIPT src="./js/FormUp_v01.js"></SCRIPT>';
}
?>
<SCRIPT LANGUAGE="JavaScript" src="/js/signs.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" src="/ch/ch_list_v2.js"></SCRIPT>
</HEAD>
<BODY bgcolor=#FFFFFF topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0>

<style type="text/css">
<!--
.style1 {font-size: 18px}
-->
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
        <td><table width=100% cellpadding=1 cellspacing=0>
          <tr>
            <td bgcolor=#CCCCCC><table width=100% cellpadding=10 cellspacing=0>
              <tr>
                <td bgcolor=#FFFFFF><?php
				if(is_file(DROOT."/includes/addons/admin-action/".preg_replace('/[^a-zA-Z0-9]/','',$_GET['addid']).".php"))
					include(DROOT."/includes/addons/admin-action/".preg_replace('/[^a-zA-Z0-9]/','',$_GET['addid']).".php");
				else
					echo"<font class=freetxt><div align=center><font color=#cc0000><b>Выберите раздел</b></font></div></font>";
				?></td>
              </tr>
            </table>
</body>
</html>	
<? require('kernel/after.php'); ?>