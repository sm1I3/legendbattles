<div style="position:absolute; left:-2px; top:-2px; z-index: 65200; width:0px; height:0px;" id="zcenter"></div>
<div id="back" style="position: absolute; left: 0; top: 0; width: 100%; z-index: 50;"></div>
<div style="padding-left:39px; text-align:left; padding-top:0px;" id="draw_pers_info"></div>
<div style="position: absolute; left: 0; top: 0; width: 100%; z-index: 50;" id="popup"></div>
<html>
<META content="text/html; charset=windows-1251" Http-Equiv=Content-type>
<META Http-Equiv=Cache-Control Content=no-cache>
<META Http-Equiv=PRAGMA content=NO-CACHE>
<META Http-Equiv=Expires Content=0>
<HEAD>
<script type="text/javascript" src="js/interface/get_windows2.js?"></script>
<LINK href=./css/info_loc.css rel=STYLESHEET type=text/css>
</HEAD>
<body>
<script LANGUAGE="JavaScript">

function getRandomArbitary(min, max)
	{
	  return Math.random() * (max - min) + min;
	}




// �������� ���������
var speed = 70
// ������������� �� 1 ���.
var pause = 1100
var timerID = null
var wireRunning = false
var cc = new Array()



cc[0] = "������� ������";
cc[1] = "���� ���������� ���.";
cc[2] = "� ����������� ����� ��������,";
cc[3] = "�������� ���� �������� ����� ������ �������";
cc[4] = "����� ���� ��� �������� ��� ����  �����";

var currentMessage = 0
var offset = 0
// ������������� ����� ���������
function stopWire() {
                if (wireRunning)
                clearTimeout(timerID)
                wireRunning = false

}
// ��������
function startWire() {
                stopWire()
                showWire()
}
function showWire() {
                var text = cc[currentMessage]
                if (offset < text.length) {
                                if (text.charAt(offset) == " ")
                                                offset++
                                var partialMessage = text.substring(0, offset + 1)
                document.wireForm.wireField.value = partialMessage
                                offset++
                timerID = setTimeout("showWire()", speed)
        wireRunning = true
        ///alert(1);
        } else {
               offset = 0
               currentMessage++
                if (currentMessage == cc.length)
                        currentMessage = 0
                timerID = setTimeout("showWire()", pause)

           if (currentMessage == 0 && offset == 0){
                // ������������� ������� =)
                stopWire();
                // ��������� ����.
                close_window();
                // ��������� ����
                message_window ('success','','������ ������ ����� ���� ������� - � ������, ��� �������� ����. <a href=?starik=senk><img src="http://smayly.ru/gallery/anime/FeiXin/41.gif"></a>','cancel','');

        wireRunning = true
        }
        }
}



</SCRIPT>

<TABLE cellpadding=0 cellspacing=0 width=100%><TR><TD>
<table cellpadding=0 cellspacing=0 border=0 align=center width=760><tr valign=top><td>


<table width=100% cellspacing=0 border=0 cellpadding=0>
<td valign=top>
  <tr>
    <td><div class="block info">
	<div class="header">
		<span>������ �������</span>
	</div>
<img  src='https://w1.dwar.ru/info/pictures/image/eldrik.jpg' width='190' height='171'>
<?if ($player["level"]<5)
echo "������ ������� - ������� ��� ���������� (���������� ���� 5-� ������� � ����) ";
else if($player["time_prz"]<time())
echo "�������� ��������, � ������� ������� ������ ���� ��������� ��������� ��������� - �������, ������� ������ �� ���������� ���� ������� �������� � ����� ��� ����� ��������� ������. �������� ������� �� �������� ������ ������, ������� � �������� ������ �� ��� ���, ������ ��� �� ��������.. <a href=?starik=1> ��������� </a>";
else {
echo "������ ������� � ������ �� ������ ��������, ��������� ����� <b>".tp($player["time_prz"] - time())."</b>";?>
</FIELDSET>
          </tr>
        </table>
    </font></td>
  </tr>
</table>
<?
}
/*
if ($player["time_prz"]<time()){
echo "����� ������ - ������� ����, �� ��� �, ������ ���� ������. <a href=?starik=1> ����� </a>";
}else{
echo "������ ����� �� ������ ��������, ��������� ����� <b>".tp($player["time_prz"] - time())."</b>";
}
*/

## ���� �������� ���������� �������� � ������� =)
if ($_GET["starik"] == 1 and $pers["time_prz"]<time() and $player["level"]>=5){
$secrets = '������������� � 2016 ����<br><FORM NAME="wireForm"><input type="text" style="height:45px;" class="but_view" name="wireField" value=" ��������� ������������ " size=100 onFocus="if (!wireRunning) { startWire() }"></FORM>';
}


## ��������� �������.
if ($_GET["starik"] == 'senk' and $player["time_prz"]<time() and $player["level"]>=5){
$prz_time = (time()+8640000000);
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2570',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
mysqli_query($GLOBALS['db_link'],"INSERT INTO `invent` (`protype` ,`pl_id` ,`used` ,`iznos` ,`dolg` ,`price` ,`dd_price`) VALUES ('2735',  '".$player['id']."',  '0',  '0',  '1',  '1',  '0');");
$res = "�� ���������� � ������� <b>��������� ��������(50 ��) ������� �����������</b> !";
chmsg("top.frames['chmain'].add_msg('<font class=massm>&nbsp;&nbsp;<b>������ �������</b>&nbsp;&nbsp;</font>   <font color=000000><b><font color=#cc0000>��������! </font></b>".$res.".<BR>'+'');",$player['login']);
mysqli_query($GLOBALS['db_link'],"UPDATE `user` SET `time_prz`='".$prz_time."' WHERE `id`='".$player["id"]."' LIMIT 1");
echo "<script>location='main.php';</script>";
}

?>





<td width=0 valign=top style="width: 100%;">
<table width=80% cellspacing=0 cellpadding=0  border=0 style="width: 100;">
<tr><td align=center>





</div>
</table></td></table></tr></td></table>
</td></tr></table></TD></TR></TABLE>

<script type="text/javascript">
<? if (isset($secrets) && !empty($secrets)){?>
message_window ('success','','<?=$secrets?>','cancel','')
<? } ?>
</script>