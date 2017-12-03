<div class="block skill">
	<div class="header">
		<span>
			Кено
		</span>
	</div>
	<center>
<?PHP
$keno_numbers = array (
        "0" => "",
        "1" => "",
        "2" => "",
        "3" => "",
        "4" => "",
        "5" => "",
        "6" => "",
        "7" => "",
        "8" => "",
        "9" => "",
        "10" => "",
        "11" => "",
        "12" => "",
        "13" => "",
        "14" => "",
        "15" => "",
        "16" => "",
        "17" => "",
        "18" => "",
        "19" => "");

$player_numbers = array (
        "0" => "$n1",
        "1" => "$n2",
        "2" => "$n3",
        "3" => "$n4",
        "4" => "$n5",
        "5" => "$n6",
        "6" => "$n7",
        "7" => "$n8",
        "8" => "$n9",
        "9" => "$n10");


if ($action == "play")
{
        $i = 0;
        while ($i < 20)
        {
                $temp = rand(1,80);
                if (!in_array($temp,$keno_numbers))
                {
                        $keno_numbers[$i] = $temp;
                        $i++;
                }
        } 
        sort($keno_numbers);
        sort($player_numbers);
}
$i = 0;
$points = 0;
while ($i < 20)
{
        if (in_array($keno_numbers[$i],$player_numbers))
                $points++;
        $i++;
}
echo "<TABLE>";
$i = 0;
$n = 1;
while ($i < 8)
{
        if ($i % 2 == 1)
                echo "  <TR BGCOLOR=\"#C1C2F5\">";
        else
                echo "  <TR BGCOLOR=\"#E7E7E7\">";

        $j = 0;
        while ($j < 10)
        {

                if (in_array($n, $keno_numbers))
                        echo "<TD BGCOLOR=\"#ECBCBC\">";
                else
                        echo "<TD>";
                echo "<FONT FACE=\"verdana, arial, helvetica\" SIZE=2>";
                if (in_array ($n, $player_numbers))
                        echo "<B> &nbsp; $n &nbsp; </B>";
                else
                        echo " &nbsp; $n &nbsp; ";
                echo "</FONT></TD>";
                $j++;
                $n++;
        }
        $i++;
}
echo "</TABLE>";

if ($action == "play")
{
        echo "<B>Выпали такие номера:</B><BR>";
        echo "<TABLE BORDER=0><TR>";
        $w = 0;
        while ($w < 20)
        {  if ($w % 2 == 1)
                {echo "<TD ALIGN=CENTER STYLE=\"WIDTH:25\">$keno_numbers[$w]</TD>";
                $w++;
                if ($w % 10 == 0)
                        echo "</TD></TR><TR>";}
           else {echo "<TD ALIGN=CENTER STYLE=\"WIDTH:25\">$keno_numbers[$w]</TD>";
                $w++;
                if ($w % 10 == 0)
                        echo "</TD></TR><TR>";}
        }
        echo "</TR></TABLE>";
        echo "<B>Вы выбрали:</B><BR>";
        $w = 0;
        while ($w < 10)
        {
                echo " &nbsp; $player_numbers[$w]";
                $w++;
                if ($w % 10 == 0)
                        echo "<BR>";
        }
        echo "<B>Вы угадали <font color=red>$points</font> из десяти!</B>";
}

echo "<TABLE BORDER=0>";
echo "<tr><td><FORM METHOD=post ACTION=\"main.php?mselect=33&action=play&". time(). "\">Введите любые 10 чисел от 1 и до 80:</td></tr>";
echo "<tr><td><INPUT TYPE=text SIZE=3 MAXLENGTH=2 NAME=n1 VALUE=\"$player_numbers[0]\"> &nbsp;";
echo "<INPUT TYPE=text SIZE=3 MAXLENGTH=2 NAME=n2 VALUE=\"$player_numbers[1]\"> &nbsp;";
echo "<INPUT TYPE=text SIZE=3 MAXLENGTH=2 NAME=n3 VALUE=\"$player_numbers[2]\"> &nbsp;";
echo "<INPUT TYPE=text SIZE=3 MAXLENGTH=2 NAME=n4 VALUE=\"$player_numbers[3]\"> &nbsp;";
echo "<INPUT TYPE=text SIZE=3 MAXLENGTH=2 NAME=n5 VALUE=\"$player_numbers[4]\"> &nbsp;";
echo "<INPUT TYPE=text SIZE=3 MAXLENGTH=2 NAME=n6 VALUE=\"$player_numbers[5]\"> &nbsp;";
echo "<INPUT TYPE=text SIZE=3 MAXLENGTH=2 NAME=n7 VALUE=\"$player_numbers[6]\"> &nbsp;";
echo "<INPUT TYPE=text SIZE=3 MAXLENGTH=2 NAME=n8 VALUE=\"$player_numbers[7]\"> &nbsp;";
echo "<INPUT TYPE=text SIZE=3 MAXLENGTH=2 NAME=n9 VALUE=\"$player_numbers[8]\"> &nbsp;";
echo "<INPUT TYPE=text SIZE=3 MAXLENGTH=2 NAME=n10 VALUE=\"$player_numbers[9]\"> &nbsp;</td></tr>";
echo "<tr><td align=center><INPUT TYPE=submit VALUE=\"Сыграть\"></FORM></td></tr>";
//Выграши
if(isset($points)){
	switch($points){
	case'1':
	mysqli_query($GLOBALS['db_link'],"INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('".time()."','sys','".addslashes("top.frames['chmain'].add_msg('<font class=massm>&nbsp;Кено&nbsp;</font>     <font color=FF9900><b> Вы угадали 1 из 10 .</b></font><font color=000000><b> Игрок  ".$player['login']." получает</b></font><BR>'+'');")."');");
	break;
		case'2':
		mysqli_query($GLOBALS['db_link'],"INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('".time()."','sys','".addslashes("top.frames['chmain'].add_msg('<font class=massm>&nbsp;Кено&nbsp;</font>     <font color=FF9900><b>Вы угадали 2 из 10.</b></font><font color=FF0000><b> Игрок   ".$player['login']." получает</b></font><BR>'+'');")."');");
	break;
		case'3':
		mysqli_query($GLOBALS['db_link'],"INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('".time()."','sys','".addslashes("top.frames['chmain'].add_msg('<font class=massm>&nbsp;Кено&nbsp;</font>     <font color=FF9900><b>Вы угадали 3 из 10.</b></font><font color=FF9900><b> Игрок   ".$player['login']." получает</b></font><BR>'+'');")."');");
	break;
		case'4':
		mysqli_query($GLOBALS['db_link'],"INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('".time()."','sys','".addslashes("top.frames['chmain'].add_msg('<font class=massm>&nbsp;Кено&nbsp;</font>     <font color=FF9900><b>Вы угадали 4 из 10.</b></font><font color=FF9900><b> Игрок  ".$player['login']." получает</b></font><BR>'+'');")."');");
	break;
		case'5':
		mysqli_query($GLOBALS['db_link'],"INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('".time()."','sys','".addslashes("top.frames['chmain'].add_msg('<font class=massm>&nbsp;Кено&nbsp;</font>     <font color=FF9900><b>Вы угадали 5 из 10.</b></font><font color=FF9900><b> Игрок  ".$player['login']." получает</b></font><BR>'+'');")."');");
	break;
		case'6':
	mysqli_query($GLOBALS['db_link'],"INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('".time()."','sys','".addslashes("top.frames['chmain'].add_msg('<font class=massm>&nbsp;Кено&nbsp;</font>     <font color=FF9900><b>Вы угадали 6 из 10.</b></font><font color=FF9900><b> Игрок   ".$player['login']." получает</b></font><BR>'+'');")."');");
	break;
		case'7':
		mysqli_query($GLOBALS['db_link'],"INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('".time()."','sys','".addslashes("top.frames['chmain'].add_msg('<font class=massm>&nbsp;Кено&nbsp;</font>     <font color=FF9900><b>Вы угадали 7 из 10.</b></font><font color=FF9900><b> Игрок   ".$player['login']." получает</b></font><BR>'+'');")."');");
	break;
		case'8':
		mysqli_query($GLOBALS['db_link'],"INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('".time()."','sys','".addslashes("top.frames['chmain'].add_msg('<font class=massm>&nbsp;Кено&nbsp;</font>     <font color=FF9900><b>Вы угадали 8 из 10.</b></font><font color=FF9900><b> Игрок   ".$player['login']." получает</b></font><BR>'+'');")."');");
	break;
		case'9':
		mysqli_query($GLOBALS['db_link'],"INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('".time()."','sys','".addslashes("top.frames['chmain'].add_msg('<font class=massm>&nbsp;Кено&nbsp;</font>     <font color=FF9900><b>Вы угадали 9 из 10.</b></font><font color=FF9900><b> Игрок   ".$player['login']." получает</b></font><BR>'+'');")."');");
	break;
		case'10':
		mysqli_query($GLOBALS['db_link'],"INSERT INTO `chat` (`time`,`login`,`msg`) VALUES ('".time()."','sys','".addslashes("top.frames['chmain'].add_msg('<font class=massm>&nbsp;Кено&nbsp;</font>     <font color=FF9900><b>Вы угадали 10 из 10.</b></font><font color=FF9900><b> Игрок   ".$player['login']." получает</b></font><BR>'+'');")."');");
	break;
}
}
?>
	</div>