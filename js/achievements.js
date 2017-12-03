function table1_onclick() {
    document.getElementById('table1_p').style.display='';
    document.getElementById('table2_p').style.display='none';
    document.getElementById('table3_p').style.display='none';
    document.getElementById('table4_p').style.display='none';
}
function table2_onclick() {
    document.getElementById('table1_p').style.display='none';
    document.getElementById('table2_p').style.display='';
    document.getElementById('table3_p').style.display='none';
    document.getElementById('table4_p').style.display='none';
}
function table3_onclick() {
    document.getElementById('table1_p').style.display='none';
    document.getElementById('table2_p').style.display='none';
    document.getElementById('table3_p').style.display='';
    document.getElementById('table4_p').style.display='none';
}
function table4_onclick() {
    document.getElementById('table1_p').style.display='none';
    document.getElementById('table2_p').style.display='none';
    document.getElementById('table3_p').style.display='none';
    document.getElementById('table4_p').style.display='';
}

function doneAchieve(achievements) {
     //PVP
     if(achievements[0]>=1) {
     document.getElementById('1_1').className = 'img_progress2';
     }
     if(achievements[0]>=2) {
     document.getElementById('1_2').className = 'img_progress2';
     }
     if(achievements[0]>=3) {
     document.getElementById('1_3').className = 'img_progress2';
     }
     if(achievements[0]>=4) {
     document.getElementById('1_4').className = 'img_progress2';
     }
     if(achievements[0]>=5) {
     document.getElementById('1_5').className = 'img_progress2';
     }
     if(achievements[0]>=6) {
     document.getElementById('1_6').className = 'img_progress2';
     }
     if(achievements[0]>=7) {
     document.getElementById('1_7').className = 'img_progress2';
     }
     if(achievements[0]>=8) {
     document.getElementById('1_8').className = 'img_progress2';
     }
     if(achievements[0]>=9) {
     document.getElementById('1_9').className = 'img_progress2';
     }
     if(achievements[0]>=10) {
     document.getElementById('1_10').className = 'img_progress2';
     }
		 //Охотник за головами
     if(achievements[1]>=1) {
     document.getElementById('2_1').className = 'img_progress2';
     }
     if(achievements[1]>=2) {
     document.getElementById('2_2').className = 'img_progress2';
     }
     if(achievements[1]>=3) {
     document.getElementById('2_3').className = 'img_progress2';
     }
     if(achievements[1]>=4) {
     document.getElementById('2_4').className = 'img_progress2';
     }
     if(achievements[1]>=5) {
     document.getElementById('2_5').className = 'img_progress2';
     }
     if(achievements[1]>=6) {
     document.getElementById('2_6').className = 'img_progress2';
     }
     if(achievements[1]>=7) {
     document.getElementById('2_7').className = 'img_progress2';
     }
     if(achievements[1]>=8) {
     document.getElementById('2_8').className = 'img_progress2';
     }
     if(achievements[1]>=9) {
     document.getElementById('2_9').className = 'img_progress2';
     }
     if(achievements[1]>=10) {
     document.getElementById('2_10').className = 'img_progress2';
     }
		 //Охотник за головами
     if(achievements[2]>=1) {
     document.getElementById('3_1').className = 'img_progress2';
     }
     if(achievements[2]>=2) {
     document.getElementById('3_2').className = 'img_progress2';
     }
     if(achievements[2]>=3) {
     document.getElementById('3_3').className = 'img_progress2';
     }
     if(achievements[2]>=4) {
     document.getElementById('3_4').className = 'img_progress2';
     }
     if(achievements[2]>=5) {
     document.getElementById('3_5').className = 'img_progress2';
     }
     if(achievements[2]>=6) {
     document.getElementById('3_6').className = 'img_progress2';
     }
     if(achievements[2]>=7) {
     document.getElementById('3_7').className = 'img_progress2';
     }
     if(achievements[2]>=8) {
     document.getElementById('3_8').className = 'img_progress2';
     }
     if(achievements[2]>=9) {
     document.getElementById('3_9').className = 'img_progress2';
     }
     if(achievements[2]>=10) {
     document.getElementById('3_10').className = 'img_progress2';
     }
    	//Разбойник
     if(achievements[3]>=1) {
     document.getElementById('11_1').className = 'img_progress2';
     }
     if(achievements[3]>=2) {
     document.getElementById('11_2').className = 'img_progress2';
     }
     if(achievements[3]>=3) {
     document.getElementById('11_3').className = 'img_progress2';
     }
     if(achievements[3]>=4) {
     document.getElementById('11_4').className = 'img_progress2';
     }
     if(achievements[3]>=5) {
     document.getElementById('11_5').className = 'img_progress2';
     }
     if(achievements[3]>=6) {
     document.getElementById('11_6').className = 'img_progress2';
     }
     if(achievements[3]>=7) {
     document.getElementById('11_7').className = 'img_progress2';
     }
     if(achievements[3]>=8) {
     document.getElementById('11_8').className = 'img_progress2';
     }
     if(achievements[3]>=9) {
     document.getElementById('11_9').className = 'img_progress2';
     }
     if(achievements[3]>=10) {
     document.getElementById('11_10').className = 'img_progress2';
     }
		 //Разбойник
     if(achievements[4]>=1) {
     document.getElementById('12_1').className = 'img_progress2';
     }
     if(achievements[4]>=2) {
     document.getElementById('12_2').className = 'img_progress2';
     }
     if(achievements[4]>=3) {
     document.getElementById('12_3').className = 'img_progress2';
     }
     if(achievements[4]>=4) {
     document.getElementById('12_4').className = 'img_progress2';
     }
     if(achievements[4]>=5) {
     document.getElementById('12_5').className = 'img_progress2';
     }
     if(achievements[4]>=6) {
     document.getElementById('12_6').className = 'img_progress2';
     }
     if(achievements[4]>=7) {
     document.getElementById('12_7').className = 'img_progress2';
     }
     if(achievements[4]>=8) {
     document.getElementById('12_8').className = 'img_progress2';
     }
     if(achievements[4]>=9) {
     document.getElementById('12_9').className = 'img_progress2';
     }
     if(achievements[4]>=10) {
     document.getElementById('12_10').className = 'img_progress2';
     }
		 		 //Разбойник
     if(achievements[5]>=1) {
     document.getElementById('13_1').className = 'img_progress2';
     }
     if(achievements[5]>=2) {
     document.getElementById('13_2').className = 'img_progress2';
     }
     if(achievements[5]>=3) {
     document.getElementById('13_3').className = 'img_progress2';
     }
     if(achievements[5]>=4) {
     document.getElementById('13_4').className = 'img_progress2';
     }
     if(achievements[5]>=5) {
     document.getElementById('13_5').className = 'img_progress2';
     }
     if(achievements[5]>=6) {
     document.getElementById('13_6').className = 'img_progress2';
     }
     if(achievements[5]>=7) {
     document.getElementById('13_7').className = 'img_progress2';
     }
     if(achievements[5]>=8) {
     document.getElementById('13_8').className = 'img_progress2';
     }
     if(achievements[5]>=9) {
     document.getElementById('13_9').className = 'img_progress2';
     }
     if(achievements[5]>=10) {
     document.getElementById('13_10').className = 'img_progress2';
     }
		 		 		 //Разбойник
     if(achievements[6]>=1) {
     document.getElementById('14_1').className = 'img_progress2';
     }
     if(achievements[6]>=2) {
     document.getElementById('14_2').className = 'img_progress2';
     }
     if(achievements[6]>=3) {
     document.getElementById('14_3').className = 'img_progress2';
     }
     if(achievements[6]>=4) {
     document.getElementById('14_4').className = 'img_progress2';
     }
     if(achievements[6]>=5) {
     document.getElementById('14_5').className = 'img_progress2';
     }
     if(achievements[6]>=6) {
     document.getElementById('14_6').className = 'img_progress2';
     }
     if(achievements[6]>=7) {
     document.getElementById('14_7').className = 'img_progress2';
     }
     if(achievements[6]>=8) {
     document.getElementById('14_8').className = 'img_progress2';
     }
     if(achievements[6]>=9) {
     document.getElementById('14_9').className = 'img_progress2';
     }
     if(achievements[6]>=10) {
     document.getElementById('14_10').className = 'img_progress2';
     }
		 
		 		 		 		 //Разбойник
     if(achievements[7]>=1) {
     document.getElementById('4_1').className = 'img_progress2';
     }
     if(achievements[7]>=2) {
     document.getElementById('4_2').className = 'img_progress2';
     }
     if(achievements[7]>=3) {
     document.getElementById('4_3').className = 'img_progress2';
     }
     if(achievements[7]>=4) {
     document.getElementById('4_4').className = 'img_progress2';
     }
     if(achievements[7]>=5) {
     document.getElementById('4_5').className = 'img_progress2';
     }
     if(achievements[7]>=6) {
     document.getElementById('4_6').className = 'img_progress2';
     }
     if(achievements[7]>=7) {
     document.getElementById('4_7').className = 'img_progress2';
     }
     if(achievements[7]>=8) {
     document.getElementById('4_8').className = 'img_progress2';
     }
     if(achievements[7]>=9) {
     document.getElementById('4_9').className = 'img_progress2';
     }
     if(achievements[7]>=10) {
     document.getElementById('4_10').className = 'img_progress2';
     }
		 
		 		 		 		 //Разбойник
     if(achievements[8]>=1) {
     document.getElementById('5_1').className = 'img_progress2';
     }
     if(achievements[8]>=2) {
     document.getElementById('5_2').className = 'img_progress2';
     }
     if(achievements[8]>=3) {
     document.getElementById('5_3').className = 'img_progress2';
     }
     if(achievements[8]>=4) {
     document.getElementById('5_4').className = 'img_progress2';
     }
     if(achievements[8]>=5) {
     document.getElementById('5_5').className = 'img_progress2';
     }
     if(achievements[8]>=6) {
     document.getElementById('5_6').className = 'img_progress2';
     }
     if(achievements[8]>=7) {
     document.getElementById('5_7').className = 'img_progress2';
     }
     if(achievements[8]>=8) {
     document.getElementById('5_8').className = 'img_progress2';
     }
     if(achievements[8]>=9) {
     document.getElementById('5_9').className = 'img_progress2';
     }
     if(achievements[8]>=10) {
     document.getElementById('5_10').className = 'img_progress2';
     }
		 		 		 		 //Разбойник
     if(achievements[9]>=1) {
     document.getElementById('6_1').className = 'img_progress2';
     }
     if(achievements[9]>=2) {
     document.getElementById('6_2').className = 'img_progress2';
     }
     if(achievements[9]>=3) {
     document.getElementById('6_3').className = 'img_progress2';
     }
     if(achievements[9]>=4) {
     document.getElementById('6_4').className = 'img_progress2';
     }
     if(achievements[9]>=5) {
     document.getElementById('6_5').className = 'img_progress2';
     }
     if(achievements[9]>=6) {
     document.getElementById('6_6').className = 'img_progress2';
     }
     if(achievements[9]>=7) {
     document.getElementById('6_7').className = 'img_progress2';
     }
     if(achievements[9]>=8) {
     document.getElementById('6_8').className = 'img_progress2';
     }
     if(achievements[9]>=9) {
     document.getElementById('6_9').className = 'img_progress2';
     }
     if(achievements[9]>=10) {
     document.getElementById('6_10').className = 'img_progress2';
     }
		 		 		 		 		 //Разбойник
     if(achievements[10]>=1) {
     document.getElementById('7_1').className = 'img_progress2';
     }
     if(achievements[10]>=2) {
     document.getElementById('7_2').className = 'img_progress2';
     }
     if(achievements[10]>=3) {
     document.getElementById('7_3').className = 'img_progress2';
     }
     if(achievements[10]>=4) {
     document.getElementById('7_4').className = 'img_progress2';
     }
     if(achievements[10]>=5) {
     document.getElementById('7_5').className = 'img_progress2';
     }
     if(achievements[10]>=6) {
     document.getElementById('7_6').className = 'img_progress2';
     }
     if(achievements[10]>=7) {
     document.getElementById('7_7').className = 'img_progress2';
     }
     if(achievements[10]>=8) {
     document.getElementById('7_8').className = 'img_progress2';
     }
     if(achievements[10]>=9) {
     document.getElementById('7_9').className = 'img_progress2';
     }
     if(achievements[10]>=10) {
     document.getElementById('7_10').className = 'img_progress2';
     }
		 	 		 		 		 //Разбойник
     if(achievements[11]>=1) {
     document.getElementById('8_1').className = 'img_progress2';
     }
     if(achievements[11]>=2) {
     document.getElementById('8_2').className = 'img_progress2';
     }
     if(achievements[11]>=3) {
     document.getElementById('8_3').className = 'img_progress2';
     }
     if(achievements[11]>=4) {
     document.getElementById('8_4').className = 'img_progress2';
     }
     if(achievements[11]>=5) {
     document.getElementById('8_5').className = 'img_progress2';
     }
     if(achievements[11]>=6) {
     document.getElementById('8_6').className = 'img_progress2';
     }
     if(achievements[11]>=7) {
     document.getElementById('8_7').className = 'img_progress2';
     }
     if(achievements[11]>=8) {
     document.getElementById('8_8').className = 'img_progress2';
     }
     if(achievements[11]>=9) {
     document.getElementById('8_9').className = 'img_progress2';
     }
     if(achievements[11]>=10) {
     document.getElementById('8_10').className = 'img_progress2';
     }
		 
		 		 	 		 		 		 //Разбойник
     if(achievements[12]>=1) {
     document.getElementById('9_1').className = 'img_progress2';
     }
     if(achievements[12]>=2) {
     document.getElementById('9_2').className = 'img_progress2';
     }
     if(achievements[12]>=3) {
     document.getElementById('9_3').className = 'img_progress2';
     }
     if(achievements[12]>=4) {
     document.getElementById('9_4').className = 'img_progress2';
     }
     if(achievements[12]>=5) {
     document.getElementById('9_5').className = 'img_progress2';
     }
     if(achievements[12]>=6) {
     document.getElementById('9_6').className = 'img_progress2';
     }
     if(achievements[12]>=7) {
     document.getElementById('9_7').className = 'img_progress2';
     }
     if(achievements[12]>=8) {
     document.getElementById('9_8').className = 'img_progress2';
     }
     if(achievements[12]>=9) {
     document.getElementById('9_9').className = 'img_progress2';
     }
     if(achievements[12]>=10) {
     document.getElementById('9_10').className = 'img_progress2';
     }
		 		 		 	 		 		 		 //Разбойник
     if(achievements[13]>=1) {
     document.getElementById('20_1').className = 'img_progress2';
     }
     if(achievements[13]>=2) {
     document.getElementById('20_2').className = 'img_progress2';
     }
     if(achievements[13]>=3) {
     document.getElementById('20_3').className = 'img_progress2';
     }
     if(achievements[13]>=4) {
     document.getElementById('20_4').className = 'img_progress2';
     }
     if(achievements[13]>=5) {
     document.getElementById('20_5').className = 'img_progress2';
     }
     if(achievements[13]>=6) {
     document.getElementById('20_6').className = 'img_progress2';
     }
     if(achievements[13]>=7) {
     document.getElementById('20_7').className = 'img_progress2';
     }
     if(achievements[13]>=8) {
     document.getElementById('20_8').className = 'img_progress2';
     }
     if(achievements[13]>=9) {
     document.getElementById('20_9').className = 'img_progress2';
     }
     if(achievements[13]>=10) {
     document.getElementById('20_10').className = 'img_progress2';
     }
		 
		 		 		 		 	 		 		 		 //Разбойник
     if(achievements[14]>=1) {
     document.getElementById('30_1').className = 'img_progress2';
     }
     if(achievements[14]>=2) {
     document.getElementById('30_2').className = 'img_progress2';
     }
     if(achievements[14]>=3) {
     document.getElementById('30_3').className = 'img_progress2';
     }
     if(achievements[14]>=4) {
     document.getElementById('30_4').className = 'img_progress2';
     }
     if(achievements[14]>=5) {
     document.getElementById('30_5').className = 'img_progress2';
     }
     if(achievements[14]>=6) {
     document.getElementById('30_6').className = 'img_progress2';
     }
     if(achievements[14]>=7) {
     document.getElementById('30_7').className = 'img_progress2';
     }
     if(achievements[14]>=8) {
     document.getElementById('30_8').className = 'img_progress2';
     }
     if(achievements[14]>=9) {
     document.getElementById('30_9').className = 'img_progress2';
     }
     if(achievements[14]>=10) {
     document.getElementById('30_10').className = 'img_progress2';
     }
		 		 		 		 		 	 		 		 		 //Разбойник
     if(achievements[15]>=1) {
     document.getElementById('40_1').className = 'img_progress2';
     }
     if(achievements[15]>=2) {
     document.getElementById('40_2').className = 'img_progress2';
     }
     if(achievements[15]>=3) {
     document.getElementById('40_3').className = 'img_progress2';
     }
     if(achievements[15]>=4) {
     document.getElementById('40_4').className = 'img_progress2';
     }
     if(achievements[15]>=5) {
     document.getElementById('40_5').className = 'img_progress2';
     }
     if(achievements[15]>=6) {
     document.getElementById('40_6').className = 'img_progress2';
     }
     if(achievements[15]>=7) {
     document.getElementById('40_7').className = 'img_progress2';
     }
     if(achievements[15]>=8) {
     document.getElementById('40_8').className = 'img_progress2';
     }
     if(achievements[15]>=9) {
     document.getElementById('40_9').className = 'img_progress2';
     }
     if(achievements[15]>=10) {
     document.getElementById('40_10').className = 'img_progress2';
     }
		 		 		 		 		 	 		 		 		 //Разбойник
     if(achievements[16]>=1) {
     document.getElementById('50_1').className = 'img_progress2';
     }
     if(achievements[16]>=2) {
     document.getElementById('50_2').className = 'img_progress2';
     }
     if(achievements[16]>=3) {
     document.getElementById('50_3').className = 'img_progress2';
     }
     if(achievements[16]>=4) {
     document.getElementById('50_4').className = 'img_progress2';
     }
     if(achievements[16]>=5) {
     document.getElementById('50_5').className = 'img_progress2';
     }
     if(achievements[16]>=6) {
     document.getElementById('50_6').className = 'img_progress2';
     }
     if(achievements[16]>=7) {
     document.getElementById('50_7').className = 'img_progress2';
     }
     if(achievements[16]>=8) {
     document.getElementById('50_8').className = 'img_progress2';
     }
     if(achievements[16]>=9) {
     document.getElementById('50_9').className = 'img_progress2';
     }
     if(achievements[16]>=10) {
     document.getElementById('50_10').className = 'img_progress2';
     }
		 		 		 		 		 	 		 		 		 //Разбойник
     if(achievements[17]>=1) {
     document.getElementById('60_1').className = 'img_progress2';
     }
     if(achievements[17]>=2) {
     document.getElementById('60_2').className = 'img_progress2';
     }
     if(achievements[17]>=3) {
     document.getElementById('60_3').className = 'img_progress2';
     }
     if(achievements[17]>=4) {
     document.getElementById('60_4').className = 'img_progress2';
     }
     if(achievements[17]>=5) {
     document.getElementById('60_5').className = 'img_progress2';
     }
     if(achievements[17]>=6) {
     document.getElementById('60_6').className = 'img_progress2';
     }
     if(achievements[17]>=7) {
     document.getElementById('60_7').className = 'img_progress2';
     }
     if(achievements[17]>=8) {
     document.getElementById('60_8').className = 'img_progress2';
     }
     if(achievements[17]>=9) {
     document.getElementById('60_9').className = 'img_progress2';
     }
     if(achievements[17]>=10) {
     document.getElementById('60_10').className = 'img_progress2';
     }
		 		 		 		 		 	 		 		 		 //Разбойник
     if(achievements[18]>=1) {
     document.getElementById('80_1').className = 'img_progress2';
     }
     if(achievements[18]>=2) {
     document.getElementById('80_2').className = 'img_progress2';
     }
     if(achievements[18]>=3) {
     document.getElementById('80_3').className = 'img_progress2';
     }
     if(achievements[18]>=4) {
     document.getElementById('80_4').className = 'img_progress2';
     }
     if(achievements[18]>=5) {
     document.getElementById('80_5').className = 'img_progress2';
     }
     if(achievements[18]>=6) {
     document.getElementById('80_6').className = 'img_progress2';
     }
     if(achievements[18]>=7) {
     document.getElementById('80_7').className = 'img_progress2';
     }
     if(achievements[18]>=8) {
     document.getElementById('80_8').className = 'img_progress2';
     }
     if(achievements[18]>=9) {
     document.getElementById('80_9').className = 'img_progress2';
     }
     if(achievements[18]>=10) {
     document.getElementById('80_10').className = 'img_progress2';
     }
		 		 		 		 		 	 		 		 		 //Разбойник
     if(achievements[19]>=1) {
     document.getElementById('100_1').className = 'img_progress2';
     }
     if(achievements[19]>=2) {
     document.getElementById('100_2').className = 'img_progress2';
     }
     if(achievements[19]>=3) {
     document.getElementById('100_3').className = 'img_progress2';
     }
     if(achievements[19]>=4) {
     document.getElementById('100_4').className = 'img_progress2';
     }
     if(achievements[19]>=5) {
     document.getElementById('100_5').className = 'img_progress2';
     }
     if(achievements[19]>=6) {
     document.getElementById('100_6').className = 'img_progress2';
     }
     if(achievements[19]>=7) {
     document.getElementById('100_7').className = 'img_progress2';
     }
     if(achievements[19]>=8) {
     document.getElementById('100_8').className = 'img_progress2';
     }
     if(achievements[19]>=9) {
     document.getElementById('100_9').className = 'img_progress2';
     }
     if(achievements[19]>=10) {
     document.getElementById('100_10').className = 'img_progress2';
     }
		 	 		 		 		 		 	 		 		 		 //Разбойник
     if(achievements[20]>=1) {
     document.getElementById('150_1').className = 'img_progress2';
     }
     if(achievements[20]>=2) {
     document.getElementById('150_2').className = 'img_progress2';
     }
     if(achievements[20]>=3) {
     document.getElementById('150_3').className = 'img_progress2';
     }
     if(achievements[20]>=4) {
     document.getElementById('150_4').className = 'img_progress2';
     }
     if(achievements[20]>=5) {
     document.getElementById('150_5').className = 'img_progress2';
     }
     if(achievements[20]>=6) {
     document.getElementById('150_6').className = 'img_progress2';
     }
     if(achievements[20]>=7) {
     document.getElementById('150_7').className = 'img_progress2';
     }
     if(achievements[20]>=8) {
     document.getElementById('150_8').className = 'img_progress2';
     }
     if(achievements[20]>=9) {
     document.getElementById('150_9').className = 'img_progress2';
     }
     if(achievements[20]>=10) {
     document.getElementById('150_10').className = 'img_progress2';
     }
}