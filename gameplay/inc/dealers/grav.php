<?
echo'
<table cellpadding=0 cellspacing=0 border=0 width=100%>
<tr><td><FIELDSET name=field_dealers id=field_dealers><LEGEND align=center><b> <font color=gray>У Вас с собой '.$player[baks].' $</font> </b></LEGEND><table cellpadding=3 cellspacing=1 border=0 width=100% bgcolor=#e0e0e0>

';
echo'<form method=POST><select name=item>';
	while($row = mysqli_fetch_assoc($dditems)){
		echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
	}
	echo'</select></form>';
echo'</FIELDSET>';
		
?>
