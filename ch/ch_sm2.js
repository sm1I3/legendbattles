var smiles=['000','029','030','077','126','127','131','155','156','267','297','319','350','353','354','357','358','368','376','385','386','414','417','457','459','469','473','474','477','552','558','560','570','574','575','576','579','950','951','952','953','954','955','956','957','958','959','960','002','003','004','008','009','011','012','013','014','015','016','021','023','024','025','027','028','031','032','623','624','625','626','627','628','629','630','631','632','633','634','635','636','637','638','639','640','641','642','643','644','645','646','647','648','650','651','652','653','654','655','656','657'];

function insert_smile(numberofsmile) {
	var SmileData = window.opener.parent.frames['ch_buttons'].document;
	SmileData.FBT.text.focus();
	SmileData.FBT.text.value = SmileData.FBT.text.value + ' :' + numberofsmile + ': ';
}

function view_smiles(){
	document.write("<FONT class=freetxt><b>Примечание</b>. Разрешено не более 3 смайлов в одном сообщении.<br>");
	document.write("<center><a href=# onclick='window.close()'><font class=nickname><b>Закрыть</b></font></a></center><br>");
	for(csm=0; csm<smiles.length; csm++){
		document.write("<a href=# onclick=\"insert_smile('"+smiles[csm]+"')\"><img src='/img/chat/smiles/smiles_"+smiles[csm]+".gif' border=0></a> ");
	}
}