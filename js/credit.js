var d,txt,txt2,el_sum,el_us;el_sr;
d = document;


function writeuslov(e){	
	el_us = d.getElementById("cr_uslov");
	el_sum = d.getElementById("cr_sum_hid").value;
	d.getElementById("cr_srok_hid").value = e;	
	if(el_sum > 0){
		switch(e){
			 case "0": 
				txt="����� �������: "+(parseInt(el_sum)*parseInt(pl_lvl)*100)+" LR<br>�������� ���� �������."; 
				txt2="";
			 break;
			 case "1": 
				txt="����� �������: "+(parseInt(el_sum)*parseInt(pl_lvl)*100)+" LR<br>���� �������: 1 ������"; 
				txt2 = "�������� �� �������: 10%.<br>������������ ������: "+Math.round(parseInt(el_sum)*parseInt(pl_lvl)*100*1.1)+" LR.<br>����� ����� � �������: "+Math.round(parseInt(el_sum)*parseInt(pl_lvl)*100*1.1)+" LR.<input type=hidden name=post_id value=88><input type=hidden name=act value=1><br><input type=submit class=lbut value=\" ����� ������ \" >";				
			 break;
			 case "2": 
				txt2 = "�������� �� �������: 20%.<br>������������ ������: "+Math.round(parseInt(el_sum)*parseInt(pl_lvl)*100*1.2/2)+" LR.<br>����� ����� � �������: "+Math.round(parseInt(el_sum)*parseInt(pl_lvl)*100*1.2)+" LR.<input type=hidden name=post_id value=88><input type=hidden name=act value=1><br><input type=submit class=lbut value=\" ����� ������ \" >";	
			 break;
			 case "3": 
				txt="����� �������: "+(parseInt(el_sum)*parseInt(pl_lvl)*100)+" LR<br>���� �������: 4 ������";
				txt2 = "�������� �� �������: 40%.<br>������������ ������: "+Math.round(parseInt(el_sum)*parseInt(pl_lvl)*100*1.4/4)+" LR.<br>����� ����� � �������: "+Math.round(parseInt(el_sum)*parseInt(pl_lvl)*100*1.4)+" LR.<input type=hidden name=post_id value=88><input type=hidden name=act value=1><br><input type=submit class=lbut value=\" ����� ������ \" >";			
			 break;			 
			 case "4": 
				txt="����� �������: "+(parseInt(el_sum)*parseInt(pl_lvl)*100)+" LR<br>���� �������: 8 ������"; 
				txt2 = "�������� �� �������: 80%.<br>������������ ������: "+Math.round(parseInt(el_sum)*parseInt(pl_lvl)*100*1.8/8)+" LR.<br>����� ����� � �������: "+Math.round(parseInt(el_sum)*parseInt(pl_lvl)*100*1.8)+" LR.<input type=hidden name=post_id value=88><input type=hidden name=act value=1><br><input type=submit class=lbut value=\" ����� ������ \" >";
			 break;
		}			
		el_us.innerHTML = txt+"<br>"+txt2;
	}
	else{
		switch(e){
			 case "0": txt="�������� ����� � ���� �������."; break;
			 case "1": txt="�������� ����� �������.<br>���� �������: 1 ������"; break;
			 case "2": txt="�������� ����� �������.<br>���� �������: 2 ������"; break;
			 case "3": txt="�������� ����� �������.<br>���� �������: 4 ������"; break;
			 case "4": txt="�������� ����� �������.<br>���� �������: 8 ������"; break;
		}	
		el_us.innerHTML = txt;
	}
}
function writesum(e){
	el_sr = d.getElementById("cr_srok_hid").value;
	d.getElementById("cr_sum_hid").value = e;
	writeuslov(el_sr);
	
}
 
 