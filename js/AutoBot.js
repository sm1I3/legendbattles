var ab = false;

/* Функции клиента */
function AutoFight(){// Система боя
	if(ab == true){		
		switch(parent.frames['main_top'].fight_ty[4]){
			case 0:
				AutoUdar();
				AutoBlock();
				parent.frames['main_top'].CountOD();
				parent.frames['main_top'].StartAct();
			break;
			case 2:
				var inputs = parent.frames['main_top'].document.getElementsByTagName('input');
				for(var i = 0; i < (inputs.length); i++){
					if(inputs[i].value == 'Завершить бой'){
						inputs[i].click();
					}
				}
			break;
		}
	}
}
/* Функции Авто-Бой JavaScript by Guild of Honor */
function AutoSelectGo(){// быстрые кнопки аутоудара
	AutoUdar();
	AutoBlock();
	parent.frames['main_top'].CountOD();
	parent.frames['main_top'].StartAct();
}
function AutoSelect(){// быстрые кнопки выбора удара
	AutoUdar();
	AutoBlock();
	parent.frames['main_top'].CountOD();
}
function AutoUdar(){// выбераем удар
	var StartUdar = rand(0,1);
	
	for(var i=0;i<4;i++){
		parent.frames['main_top'].document.getElementById("u" + i).options[0].selected = true;
	}
	
	var cs = parent.frames['main_top'].param_ow[16][0];
	
	switch(cs){
		case 1:// простой
			parent.frames['main_top'].document.getElementById("u" + rand(0,3)).options[1].selected = true;// Простой
		break;
		case 2:// прицельный
			parent.frames['main_top'].document.getElementById("u" + rand(0,3)).options[2].selected = true;// Прицельный
		break;
		case 3:// простой + прицельный
			var udar = udComb2(StartUdar,(2+StartUdar));
			parent.frames['main_top'].document.getElementById("u" + udar[0]).options[1].selected = true;// Простой
			parent.frames['main_top'].document.getElementById("u" + udar[1]).options[2].selected = true;// Прицельный
		break;
		case 4:// 2 простых
			var udar = udComb2(StartUdar,(2+StartUdar));
			parent.frames['main_top'].document.getElementById("u" + udar[0]).options[1].selected = true;// Простой
			parent.frames['main_top'].document.getElementById("u" + udar[1]).options[1].selected = true;// Простой
		break;
		case 5:// 2 прицельных
			var udar = udComb2(StartUdar,(2+StartUdar));
			parent.frames['main_top'].document.getElementById("u" + udar[0]).options[2].selected = true;// Прицельный
			parent.frames['main_top'].document.getElementById("u" + udar[1]).options[2].selected = true;// Прицельный
		break;
		case 6:// 2 прицельных + простой
			var udar = udComb3(StartUdar,(2+StartUdar));
			parent.frames['main_top'].document.getElementById("u" + udar[0]).options[2].selected = true;// Прицельный
			parent.frames['main_top'].document.getElementById("u" + udar[1]).options[2].selected = true;// Прицельный
			parent.frames['main_top'].document.getElementById("u" + udar[2]).options[1].selected = true;// Простой
		break;
		
		case 7:// Маг 1
		var point = "u" + rand(0,3);
			parent.frames['main_top'].document.getElementById(point).options[3].selected = true;
			setMana(point,50);
		break;
		case 8:// Маг 2
			parent.frames['main_top'].document.getElementById("u" + rand(0,3)).options[4].selected = true;
		break;
		case 9:// Маг 1 + Маг 2
			var udar = udComb2(StartUdar,(2+StartUdar));
			parent.frames['main_top'].document.getElementById("u" + udar[0]).options[3].selected = true;
			parent.frames['main_top'].document.getElementById("u" + udar[1]).options[4].selected = true;
		break;
		case 10:// 2 Маг 1
			var udar = udComb2(StartUdar,(2+StartUdar));
			parent.frames['main_top'].document.getElementById("u" + udar[0]).options[3].selected = true;
			parent.frames['main_top'].document.getElementById("u" + udar[1]).options[3].selected = true;
		break;
		case 11:// 2 Маг 2
			var udar = udComb2(StartUdar,(2+StartUdar));
			parent.frames['main_top'].document.getElementById("u" + udar[0]).options[4].selected = true;
			parent.frames['main_top'].document.getElementById("u" + udar[1]).options[4].selected = true;
		break;
		case 12:// 2 Маг 2 + Маг 1
			var udar = udComb3(StartUdar,(2+StartUdar));
			parent.frames['main_top'].document.getElementById("u" + udar[0]).options[4].selected = true;
			parent.frames['main_top'].document.getElementById("u" + udar[1]).options[4].selected = true;
			parent.frames['main_top'].document.getElementById("u" + udar[2]).options[3].selected = true;
		break;
	}
}
function AutoBlock(){// блокируемся
	var BlockId = rand(0,3);

	for(var i=0;i<4;i++){
		parent.frames['main_top'].document.getElementById("b" + i).options[0].selected = true;
	}

	switch(parent.frames['main_top'].param_ow[16][1]){
		case 1:// блок 1 точки
			parent.frames['main_top'].document.getElementById("b" + BlockId).options[1].selected = true;// Простой
		break;
		case 2:// блок 2 точек
			var SubBlock = 2;
			if(BlockId < 2){
				SubBlock = rand(2,3);
			}
			parent.frames['main_top'].document.getElementById("b" + BlockId).options[SubBlock].selected = true;// Простой
		break;
		case 3:// блок 3 точек со щитом
			BlockId = rand(0,1);
			parent.frames['main_top'].document.getElementById("b" + BlockId).options[1].selected = true;// Простой
		break;
	}
}
function udComb2(miNc,maXc){// теория вероятности на 2 цыфры
	var a, b, s = [];
	for (a = miNc; a <= maXc; a++) {
	    for (b = miNc; b <= maXc; b++) {
	        if (b == a)
	            continue;
	            s.push([a,b].join(''));
	    };
	};
	return s[rand(0,(s.length-1))];
}
function udComb3(miNc,maXc){// теория вероятности на 3 цыфры
	var a, b, c, s = [];
	for (a = miNc; a <= maXc; a++) {
	    for (b = miNc; b <= maXc; b++) {
	        if (b == a)
	            continue;
	        for (c = miNc; c <= maXc; c++) {
	            if (c == a || c == b)
	                continue;
	                s.push([a,b,c].join(''));
	        };
	    };
	};
	return s[rand(0,(s.length-1))];
}

function setMana(n,col)
{
	var inputs = parent.frames['main_top'].document.getElementsByTagName('input');
		for(var i = 0; i < (inputs.length); i++){
			if(inputs[i].name == 'mbu' + n){
				inputs[i].value = col;
		}
	}
}
function rand(min,max){// аналог rand() в php
	return Math.floor(Math.random() * (max - min + 1)) + min;
}