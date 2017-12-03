var d,txt,txt2,el_sum,el_us;el_sr;
d = document;


function writeuslov(e){	
	el_us = d.getElementById("cr_uslov");
	el_sum = d.getElementById("cr_sum_hid").value;
	d.getElementById("cr_srok_hid").value = e;	
	if(el_sum > 0){
		switch(e){
			 case "0": 
				txt="Сумма кредита: "+(parseInt(el_sum)*parseInt(pl_lvl)*100)+" LR<br>Выберите срок кредита."; 
				txt2="";
			 break;
			 case "1": 
				txt="Сумма кредита: "+(parseInt(el_sum)*parseInt(pl_lvl)*100)+" LR<br>Срок кредита: 1 неделя"; 
				txt2 = "Проценты по кредиту: 10%.<br>Еженедельный платеж: "+Math.round(parseInt(el_sum)*parseInt(pl_lvl)*100*1.1)+" LR.<br>Общая сумма к выплате: "+Math.round(parseInt(el_sum)*parseInt(pl_lvl)*100*1.1)+" LR.<input type=hidden name=post_id value=88><input type=hidden name=act value=1><br><input type=submit class=lbut value=\" Взять кредит \" >";				
			 break;
			 case "2": 
				txt2 = "Проценты по кредиту: 20%.<br>Еженедельный платеж: "+Math.round(parseInt(el_sum)*parseInt(pl_lvl)*100*1.2/2)+" LR.<br>Общая сумма к выплате: "+Math.round(parseInt(el_sum)*parseInt(pl_lvl)*100*1.2)+" LR.<input type=hidden name=post_id value=88><input type=hidden name=act value=1><br><input type=submit class=lbut value=\" Взять кредит \" >";	
			 break;
			 case "3": 
				txt="Сумма кредита: "+(parseInt(el_sum)*parseInt(pl_lvl)*100)+" LR<br>Срок кредита: 4 недели";
				txt2 = "Проценты по кредиту: 40%.<br>Еженедельный платеж: "+Math.round(parseInt(el_sum)*parseInt(pl_lvl)*100*1.4/4)+" LR.<br>Общая сумма к выплате: "+Math.round(parseInt(el_sum)*parseInt(pl_lvl)*100*1.4)+" LR.<input type=hidden name=post_id value=88><input type=hidden name=act value=1><br><input type=submit class=lbut value=\" Взять кредит \" >";			
			 break;			 
			 case "4": 
				txt="Сумма кредита: "+(parseInt(el_sum)*parseInt(pl_lvl)*100)+" LR<br>Срок кредита: 8 недель"; 
				txt2 = "Проценты по кредиту: 80%.<br>Еженедельный платеж: "+Math.round(parseInt(el_sum)*parseInt(pl_lvl)*100*1.8/8)+" LR.<br>Общая сумма к выплате: "+Math.round(parseInt(el_sum)*parseInt(pl_lvl)*100*1.8)+" LR.<input type=hidden name=post_id value=88><input type=hidden name=act value=1><br><input type=submit class=lbut value=\" Взять кредит \" >";
			 break;
		}			
		el_us.innerHTML = txt+"<br>"+txt2;
	}
	else{
		switch(e){
			 case "0": txt="Выберите сумму и срок кредита."; break;
			 case "1": txt="Выберите сумму кредита.<br>Срок кредита: 1 неделя"; break;
			 case "2": txt="Выберите сумму кредита.<br>Срок кредита: 2 недели"; break;
			 case "3": txt="Выберите сумму кредита.<br>Срок кредита: 4 недели"; break;
			 case "4": txt="Выберите сумму кредита.<br>Срок кредита: 8 недель"; break;
		}	
		el_us.innerHTML = txt;
	}
}
function writesum(e){
	el_sr = d.getElementById("cr_srok_hid").value;
	d.getElementById("cr_sum_hid").value = e;
	writeuslov(el_sr);
	
}
 
 