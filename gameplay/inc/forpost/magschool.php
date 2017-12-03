<?


?>
<table cellpadding=0 cellspacing=0 border=0 align=center width=760>
<tr><td><img src=/img/image/1x1.gif width=1 height=10></td></tr>
<tr><td ><?$locname = mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT * FROM `loc` WHERE `id`='".$player['loc']."' LIMIT 1;"));?><fieldset><legend align="center"><b><font color="gray"><?=$locname['loc'];?></font></b></legend><img src=/img/image/gameplay/school/msch_msch.jpg width=760 height=255 border=0></fieldset></td></tr>
<tr><td><img src=/img/image/1x1.gif width=1 height=1></td></tr>
<tr><td bgcolor=#CCCCCC>
<table cellpadding=2 cellspacing=1 border=0 align=center width=100%>
<tr>
    <td width=18% bgcolor=#f5f5f5>
        <div align=center><a
                    href=main.php?get_id=56&act=10&go=build&pl=tower1&vcode=7e47141206f06786297f0e68c7a2044c><font
                        class=zaya><b>Башня Воды</b></font></a></div>
    </td>
    <td width=18% bgcolor=#f5f5f5>
        <div align=center><a
                    href=main.php?get_id=56&act=10&go=build&pl=tower2&vcode=6136293ff2600c84191bbb9762a72898><font
                        class=zaya><b>Башня Воздуха</b></font></a></div>
    </td>
    <td width=18% bgcolor=#f5f5f5>
        <div align=center><font class=zaya><b>Регистратура</b></font></div>
    </td>
    <td width=10% bgcolor=#f5f5f5>
        <div align=center><font class=zaya><b>Склад</b></font></div>
    </td>
    <td width=18% bgcolor=#f5f5f5>
        <div align=center><a
                    href=main.php?get_id=56&act=10&go=build&pl=tower3&vcode=5e107c16c30059f3148e971f8ed191da><font
                        class=zaya><b>Башня Огня</b></font></a></div>
    </td>
    <td width=18% bgcolor=#f5f5f5>
        <div align=center><a
                    href=main.php?get_id=56&act=10&go=build&pl=tower4&vcode=725c0c82d5528c773a306ae31ea0c35f><font
                        class=zaya><b>Башня Земли</b></font></a></div>
    </td>
</tr>
</table>
</td></tr><tr><td><img src=/img/image/1x1.gif width=1 height=3></td></tr>
<table>
    <tr>
        <td><b><i>
                    <div align=center><font color="#ff0000">Школа магии находится в разработке....</font></div>
                </i></b></td>
    </tr>
</table>
</table>
<SCRIPT language='JavaScript'>
NewLinksView();
</SCRIPT>