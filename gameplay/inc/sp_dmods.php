<?php
$dmodarr = array(1=>'���� �����',2=>'���� �����',3=>'���������',4=>'�������');
switch($dmod[0]){
	case 1: echo $dmodarr[$dmod[0]].': <b><font color="#B00000">'.$dmod[1].'</b></font><br>'; break;
	case 2: echo $dmodarr[$dmod[0]].': <b><font color="#000099">'.$dmod[1].'</b></font><br>'; break;
	case 3: echo $dmodarr[$dmod[0]].': <b><font color="#6633CC">'.$dmod[1].'</b></font><br>'; break;
	case 4: echo $dmodarr[$dmod[0]].': <b><font color="#FFBB88">'.$dmod[1].'</b></font><br>'; break;
}
?>