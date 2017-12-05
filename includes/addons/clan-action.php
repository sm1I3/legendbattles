<?php
$sign = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `clans` WHERE `clan_id` = '".$pers['clan_id']."'"));
function sclonch($id){
	$sclon=array("0","darks.gif","lights.gif","sumers.gif","chaoss.gif","light.gif","dark.gif","sumer.gif","chaos.gif","angel.gif");
    $desc = array("0", "Дети Тьмы", "Дети Света", "Дети Сумерек", "Дети Хаоса", "Истинный Свет", "Истинная Тьма", "Нейтральные Сумерки", "Абсолютный Хаос", "Ангел");
	if($id!='0'){
		return "<img src=/img/image/signs/".$sclon[$id]." width=15 height=12 border=0 align=absmiddle title='".$desc[$id]."'>";
	}
}
$_GET['addid'] = $_GET['addid']?$_GET['addid']:'1';
?>
<HEAD>
    <LINK href="./css/game.css" rel=STYLESHEET type=text/css>
    <LINK href="./css/stl.css" rel=STYLESHEET type=text/css>
    <meta content="text/html; charset=UTF-8" http-equiv=Content-type>
    <META Http-Equiv=Cache-Control Content=no-cache>
    <meta http-equiv=PRAGMA content=NO-CACHE>
    <META Http-Equiv=Expires Content=0>
    <SCRIPT src="/js/ajax.js"></SCRIPT>
<SCRIPT src="./js/FormUp_v01.js"></SCRIPT>
</HEAD><body bgcolor=#ffffff topmargin=0 bottommargin=0 marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0 link=#336699 alink=#336699 vlink=#336699>
	<div id="overDiv" style="position:absolute;visibility:hidden;z-index:1000;"></div>
	<div id="header">
        <table cellpadding=4 cellspacing=0 border=0 width=100%>
            <tr>
                <td><font class=nickname><b><?php echo sclonch($sign['clan_sclon']); ?><img
                                    src=/img/image/signs/<?php echo $sign['clan_gif']; ?> width=15 height=12 border=0
                                    align=absmiddle
                                    title="<?php echo $sign['clan_name']; ?>"> <?php echo $sign['clan_name']; ?>
                        </b></font></td>
                <td align="right"><input type=button class=lbut onClick="location='main.php'" value="Вернуться"></td>
                <td>
                    <div align=right>
                        <script language="JavaScript">
</script>
</div></td></tr></table>
</div><br><br>
<table width="90%" cellpadding="10" cellspacing="0" align="center">
  <tr>
    <td><table width="100%" cellpadding="0" cellspacing="2">
      <tr>
        <td bgcolor="#cccccc"><table cellpadding="1" cellspacing="1" width="100%" border="0">
          <tr>
              <td bgcolor="#<?php echo(($_GET['addid'] == 1) ? 'FFFFFF' : 'F0F0F0'); ?>" width="25%">
                  <div align="center"><a href="?useaction=clan-action&addid=1" class="nickname"><font
                                  class="nickname"><b>Состав <?php echo $sign['clan_name']; ?></b></font></a></div>
              </td>
              <td bgcolor="#<?php echo(($_GET['addid'] == 2) ? 'FFFFFF' : 'F0F0F0'); ?>" width="25%">
                  <div align="center"><a href="?useaction=clan-action&addid=2" class="nickname"><font class=nickname><b>Денежная
                                  казна, Бонусы</b></font></a></div>
              </td>
              <td bgcolor="#<?php echo(($_GET['addid'] == 3) ? 'FFFFFF' : 'F0F0F0'); ?>" width="25%">
                  <div align="center"><a href="?useaction=clan-action&addid=3&fullinf=0" class="nickname"><font
                                  class=nickname><b>Казна</b></font></a></div>
              </td>
              <td bgcolor="#<?php echo(($_GET['addid'] == 4) ? 'FFFFFF' : 'F0F0F0'); ?>" width="25%">
                  <div align="center"><a href="?useaction=clan-action&addid=4" class="nickname"><font class=nickname><b>Документы</b></font></a>
                  </div>
              </td>
			</tr>
                <td bgcolor="#<?php echo(($_GET['addid'] == 5) ? 'FFFFFF' : 'F0F0F0'); ?>" width="25%">
                    <div align="center"><a href="?useaction=clan-action&addid=5" class="nickname"><font
                                    class=nickname><b>Альянс</b></font></a></div>
                </td>
                <td bgcolor="#<?php echo(($_GET['addid'] == 6) ? 'FFFFFF' : 'F0F0F0'); ?>" width="25%">
                    <div align="center"><a href="?useaction=clan-action&addid=6" class="nickname"><font
                                    class=nickname><b>Клановые счет</b></font></a></div>
                </td>
                <td bgcolor="#<?php echo(($_GET['addid'] == 7) ? 'FFFFFF' : 'F0F0F0'); ?>" width="25%">
                    <div align="center"><a href="?useaction=clan-action&addid=7" class="nickname"><font
                                    class=nickname><b>Клановые ресурсы</b></font></a></div>
                </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" cellpadding="1" cellspacing="0">
          <tr>
            <td bgcolor="#CCCCCC"><table width="100%" cellpadding="5" cellspacing="0">
              <tr>
                <td bgcolor="#FFFFFF"><?php 
				if(is_file(DROOT."/includes/addons/clan-action/".intval($_GET['addid']).".php")){
					include(DROOT."/includes/addons/clan-action/".intval($_GET['addid']).".php");
				}
				?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
