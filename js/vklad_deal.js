var d,txt,txt2,el_sum_hid,el_sum,el_us,el_sr,err,sum,sum2,el_type1,el_type2;
d = document;


function writevklad(e){
	el_type1 = d.getElementById("vk_type1");
	d.getElementById("vk_type1_hid").value = e;	
	el_us = d.getElementById("vk_uslov");
	switch(e){
		case '0':
			el_type1.innerHTML = '';
			el_us.innerHTML = '�������� ��� ������.';
		break;
		case '1': 
			el_type1.innerHTML = '<select onChange="write_next(this.value);chvk();" ><option value=0 selected>�������� ��� ������</option><option value=1 >�����������</option><option value=2 >��������</option></select>';
			el_us.innerHTML = '�������� ��� ������.';
		break;
		case '2': 
			el_type1.innerHTML = '<select onChange="write_next(this.value);chvk();" ><option value=0 selected>�������� ��� ������</option><option value=1 >��������</option><option value=2 >Gold</option></select>';
			el_us.innerHTML = '�������� ��� ������.';
		break;
	}
}

function write_next(e){
	el_us = d.getElementById("vk_uslov");
	el_type1 = d.getElementById("vk_type1_hid").value;
	el_sum_hid = d.getElementById("vk_sum_hid").value;
	d.getElementById("vk_type2_hid").value = e;	
	el_sum = d.getElementById("vk_sum");
	switch(el_type1){
	case '0': break;
	case '1': 
			switch(e){
			case "0": 
				txt='��� ������ �� ������'; 
				el_sum.type == "text" ? el_sum.setAttribute("type","hidden") : "";
				el_sum.value=" ������� ����� ������ ";			
			break;			
			case "1":
				txt="��� ������: �����������.<br>�������� �� ������: 0.2% � ����.<br>���� ������: 30 ����.<br>���������� ���������: � ����� �����.<br>��������� ������� �������: ���.<br>������������ ����� ������: 250 $.";  
				el_sum.setAttribute("type","text");
			break;
			case "2": 
				txt="��� ������: ��������.<br>�������� �� ������: 0.4% � ����.<br>���� ������: 40 ����.<br>���������� ���������: � ����� �����.<br>��������� ������� �������: ���.<br>������������ ����� ������: 500 $.";  
				el_sum.setAttribute("type","text");
			break;
		}
	break;	
	case '2': 
			switch(e){
			case "0": 
				txt='��� ������ �� ������'; 
				el_sum.type == "text" ? el_sum.setAttribute("type","hidden") : "";
				el_sum.value=" ������� ����� ������ ";			
			break;			
			case "1":
				txt="��� ������: �������.<br>�������� �� ������: 0.3% � ����.<br>���� ������: 60 ����.<br>���������� ���������: � ����� �����.<br>��������� ������� �������: ���.<br>������������ ����� ������: 150 DLR.";  
				el_sum.setAttribute("type","text");
			break;
			case "2": 
				txt="��� ������: �������������.<br>�������� �� ������: 0.5% � ����.<br>���� ������: 80 ����.<br>���������� ���������: � ����� �����.<br>��������� ������� �������: ���.<br>������������ ����� ������: 500 DLR.";  
				el_sum.setAttribute("type","text");
			break;
		}
	break;	
	}
	el_us.innerHTML = txt+"<br>"+txt2;
}

function chvk(){
	sum = d.getElementById("vk_sum").value;
	txt2='';
	settype('sum', 'integer');
	if(sum != ""){	
		switch(d.getElementById("vk_type1_hid").value){
			case '0': break;
			case '1':
				switch(d.getElementById("vk_type2_hid").value){
					case "0": sum=0; err=0; break;
					case "1": (sum <= 250 && sum > 0) ? err=0 : err=1; sum2=Math.round(sum/400*0.2*30+sum); break;
					case "2": (sum <= 500 && sum > 0) ? err=0 : err=1; sum2=Math.round(sum/400*0.4*40+sum); break;
				}
			if(err==1){
				sum < 0 ? alert("����� ������ ������ ���� ������ 0.") : alert("����� ������ ��������� ����������� ��������� �� ������� ���� ������.");
				d.getElementById("vk_sum").value = " ������� ����� ������ ";
			}
			else{
				txt2 = mon_baks >= sum ? "<input type=hidden name=post_id value=99><input type=submit class=lbut value=\"������� �����  [ "+sum+" $ ]\"><br><b>�� ��������: "+sum2+" $</b>" : "<input type=button class=lbut value=\" ������������ ������� \">";
				d.getElementById("vk_sum_hid").value = sum;
			}
			break;
			case '2':
				switch(d.getElementById("vk_type2_hid").value){
						case "0": sum=0; err=0; break;
						case "1": (sum <= 150 && sum > 0)? err=0 : err=1; sum2=Math.round(sum/400*0.3*60+sum); break;
						case "2": (sum <= 500 && sum > 0) ? err=0 : err=1; sum2=Math.round(sum/400*0.5*80+sum); break;
					}
				if(err==1){
					sum < 0 ? alert("����� ������ ������ ���� ������ 0.") : alert("����� ������ ��������� ����������� ��������� �� ������� ���� ������.");
					d.getElementById("vk_sum").value = " ������� ����� ������ ";
				}
				else{
					txt2 = mon_dd >= sum ? "<input type=hidden name=post_id value=99><input type=submit class=lbut value=\"������� �����  [ "+sum+" DLR ]\"><br><b>�� ��������: "+sum2+" DLR</b>" : "<input type=button class=lbut value=\" ������������ ������� \">";
					d.getElementById("vk_sum_hid").value = sum;
				}
			break;
		}
	}	
	write_next(d.getElementById("vk_type2_hid").value);
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
	

 
 