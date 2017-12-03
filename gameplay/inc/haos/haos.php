<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/jquery.MetaData.js"></script>
<script type="text/javascript" src="/js/jquery.maphilight.min.js"></script>
<script>
    $(function () {
        $("img[usemap]").maphilight();
    });

    function hilightlinkover(id) {
        $("#loc_" + id).mouseover();
    }

    function hilightlinkout(id) {
        $("#loc_" + id).mouseout();
    }
</script>
<table cellpadding="0" cellspacing="0" border="0" align="center" width="760">
    <tr>
        <td><font class="proce">
                <fieldset>
                    <legend align="center"><b><font color="gray">Врата Хаоса</font></b></legend>
                    <table cellpadding="0" cellspacing="0" border="0" align="center" width="645">
                        <tr>
                            <td width="760" height="228" style="position:relative;"
                                background="http://img.legendbattles.ru/image/cities/haos1.png" usemap="#links"><img
                                        src="http://img.LegendBattles.ru/image/1x1.gif" width="760" height="228"
                                        border="0" usemap="#links"/></td>
                        </tr>
                    </table>
                </fieldset>
            </font></td>
    </tr>
</table>
<map name="links" id="links">
    <area shape="poly" coords="69,163,64,158,56,137,48,134,43,139,40,148,40,163,47,168,56,168,63,167"
          href="main.php?main.php?get=3&go=1224&vcode=<?php echo scode(); ?>"
          onmouseover="tooltip(this,'<b>Пещера ГунглВО армии Хаоса</b>')" onmouseout="hide_info(this)"/>
    <area shape="poly"
          coords="575,194,573,168,579,156,596,138,587,177,604,192,607,170,619,151,616,137,626,114,633,116,639,128,645,117,659,126,657,141,669,183,681,201,696,198,697,180,688,156,673,135,676,127,697,154,707,176,703,204,687,210,644,210,604,208,586,203"
          href="main.php?get=3&go=28&vcode=<?php echo scode(); ?>" onmouseover="tooltip(this,'<b>покинуть инст</b>')"
          onmouseout="hide_info(this)"/>
</map>
<SCRIPT language="JavaScript">
    NewLinksView();
</SCRIPT>