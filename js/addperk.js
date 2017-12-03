function AddPerk(pe_class) 
{
    var fr = parseInt(document.saveperk.currnav.value);
    if(fr > 0) 
    {
        var pe_class_fin = 'f['+pe_class+']';
	var nstatus = parseInt(document.saveperk[pe_class_fin].value);
	if(!nstatus) 
	{
	    fr--;
	    var pe_class_div = 'p'+pe_class;
        document.all(pe_class_div).innerHTML = '<b>да</b>';
	    document.saveperk[pe_class_fin].value = 1;
	    document.saveperk.currnav.value = fr;
        document.all("frpediv").innerHTML = 'Возможные новые навыки: ' + fr;
        }
    }
}

function RemovePerk(pe_class) 
{
    var pe_class_fin = 'f['+pe_class+']';
    var now = parseInt(document.saveperk[pe_class_fin].value);
    if(now == 1) 
    {
        var fr = parseInt(document.saveperk.currnav.value) + 1;
	var pe_class_div = 'p'+pe_class;
        document.all(pe_class_div).innerHTML = 'нет';
	document.saveperk[pe_class_fin].value = 0;
	document.saveperk.currnav.value = fr;
        document.all("frpediv").innerHTML = 'Возможные новые навыки: ' + fr;
    }
}