var d,txt,txt2,el_sum_hid,el_sum,el_us,el_sr,err,sum,sum2;
d = document;


function writevklad(e){	
	el_us = d.getElementById("vk_uslov");
	el_sum_hid = d.getElementById("vk_sum_hid").value;
	d.getElementById("vk_type_hid").value = e;	
	el_sum = d.getElementById("vk_sum");
	switch(e){
		case "0": 
			txt='Тип вклада не выбран'; 
			el_sum.type == "text" ? el_sum.setAttribute("type","hidden") : "";
			el_sum.value=" Введите сумму вклада ";			
		break;			
		case "1":
			txt="Тип вклада: срочный.<br>Проценты по вкладу: 1% в день.<br>Срок вклада: 5 дней.<br>Начисление процентов: в конце срока.<br>Досрочное изъятие средств: да.<br>Максимальная сумма вклада: 10000 LR.";  
			el_sum.setAttribute("type","text");
		break;
		case "2": 
			txt="Тип вклада: краткосрочный.<br>Проценты по вкладу: 1.1% в день.<br>Срок вклада: 10 дней.<br>Начисление процентов: в конце срока.<br>Досрочное изъятие средств: да.<br>Максимальная сумма вклада: 20000 LR.";  
			el_sum.setAttribute("type","text");
		break;
		case "3": 
			txt="Тип вклада: долгосрочный.<br>Проценты по вкладу: 1.2% в день.<br>Срок вклада: 30 дней.<br>Начисление процентов: в конце срока.<br>Досрочное изъятие средств: да.<br>Максимальная сумма вклада: 100000 LR.";  
			el_sum.setAttribute("type","text");
		break;
	}
	el_us.innerHTML = txt+"<br>"+txt2;
}

function chvk(){
	sum = d.getElementById("vk_sum").value;
	txt2='';
	settype('sum', 'integer');
	if(sum != ""){		
		switch(d.getElementById("vk_type_hid").value){
				case "0": sum=0; err=0; break;
				case "1": sum <= 10000 ? err=0 : err=1; sum2=Math.round(sum/100*5+sum); break;
				case "2": sum <= 20000 ? err=0 : err=1; sum2=Math.round(sum/100*1.1*10+sum); break;
				case "3": sum <= 100000 ? err=0 : err=1; sum2=Math.round(sum/100*1.2*30+sum); break;
			}
			if(err==1){
				alert("Сумма вклада превышает максимально возможную по данному типу вклада.");
				d.getElementById("vk_sum").value = " Введите сумму вклада ";
			}
			else{
				txt2 = mon >= sum ? "<input type=hidden name=post_id value=91><input type=submit class=lbut value=\"Сделать вклад  [ "+sum+" LR ]\"><br><b>Вы получите: "+sum2+" LR</b>" : "<input type=button class=lbut value=\" Недостаточно средств \">";
				d.getElementById("vk_sum_hid").value = sum;
			}
	}	
	writevklad(d.getElementById("vk_type_hid").value);
}
	
	function settype (vr, type) {
    // Set the type of the variable  
    // 
    // version: 1109.2015
    // discuss at: http://phpjs.org/functions/settype
    // +   original by: Waldo Malqui Silva
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +    revised by: Brett Zamir (http://brett-zamir.me)
    // %        note 1: Credits to Crockford also
    // %        note 2: only works on global variables, and "vr" must be passed in as a string
    // *     example 1: foo = '5bar';
    // *     example 1: settype('foo', 'integer');
    // *     results 1: foo === 5
    // *     returns 1: true
    // *     example 2: foo = true;
    // *     example 2: settype('foo', 'string');
    // *     results 2: foo === '1'
    // *     returns 2: true
    var is_array = function (arr) {
        return typeof arr === 'object' && typeof arr.length === 'number' && !(arr.propertyIsEnumerable('length')) && typeof arr.splice === 'function';
    };
    var v, mtch, i, obj;
    v = this[vr] ? this[vr] : vr;
 
    try {
        switch (type) {
        case 'boolean':
            if (is_array(v) && v.length === 0) {
                this[vr] = false;
            } else if (v === '0') {
                this[vr] = false;
            } else if (typeof v === 'object' && !is_array(v)) {
                var lgth = false;
                for (i in v) {
                    lgth = true;
                }
                this[vr] = lgth;
            } else {
                this[vr] = !! v;
            }
            break;
        case 'integer':
            if (typeof v === 'number') {
                this[vr] = parseInt(v, 10);
            } else if (typeof v === 'string') {
                mtch = v.match(/^([+\-]?)(\d+)/);
                if (!mtch) {
                    this[vr] = 0;
                } else {
                    this[vr] = parseInt(v, 10);
                }
            } else if (v === true) {
                this[vr] = 1;
            } else if (v === false || v === null) {
                this[vr] = 0;
            } else if (is_array(v) && v.length === 0) {
                this[vr] = 0;
            } else if (typeof v === 'object') {
                this[vr] = 1;
            }
 
            break;
        case 'float':
            if (typeof v === 'string') {
                mtch = v.match(/^([+\-]?)(\d+(\.\d+)?|\.\d+)([eE][+\-]?\d+)?/);
                if (!mtch) {
                    this[vr] = 0;
                } else {
                    this[vr] = parseFloat(v, 10);
                }
            } else if (v === true) {
                this[vr] = 1;
            } else if (v === false || v === null) {
                this[vr] = 0;
            } else if (is_array(v) && v.length === 0) {
                this[vr] = 0;
            } else if (typeof v === 'object') {
                this[vr] = 1;
            }
            break;
        case 'string':
            if (v === null || v === false) {
                this[vr] = '';
            } else if (is_array(v)) {
                this[vr] = 'Array';
            } else if (typeof v === 'object') {
                this[vr] = 'Object';
            } else if (v === true) {
                this[vr] = '1';
            } else {
                this[vr] += '';
            } // numbers (and functions?)
            break;
        case 'array':
            if (v === null) {
                this[vr] = [];
            } else if (typeof v !== 'object') {
                this[vr] = [v];
            }
            break;
        case 'object':
            if (v === null) {
                this[vr] = {};
            } else if (is_array(v)) {
                for (i = 0, obj = {}; i < v.length; i++) {
                    obj[i] = v;
                }
                this[vr] = obj;
            } else if (typeof v !== 'object') {
                this[vr] = {
                    scalar: v
                };
            }
            break;
        case 'null':
            delete this[vr];
            break;
        }
        return true;
    } catch (e) {
        return false;
    }
}



 
 