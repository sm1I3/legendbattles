function AddStat(st_class) 
{
	var fr = parseInt(document.savestat.freestats.value);
	if(fr > 0) 
	{
		var st_class_div = 'st'+st_class;
		var st_class_hid = 'h'+st_class;
		var st_class_fin = 'f'+((st_class=='3')?4:((st_class=='4')?3:st_class));
		alert(st_class_fin+" "+st_class_hid);
		var ns = parseInt(document.savestat[st_class_fin].value) + 1;
		document.all(st_class_div).innerHTML = '<font class=nickname><b>&nbsp;'+ns+'</b>';
		document.savestat[st_class_fin].value = ns;
		fr--;
		document.savestat.freestats.value = fr;
        document.all("frdiv").innerHTML = 'Повышения: ' + fr;
	}
}

function RemoveStat(st_class) 
{
	var fr = parseInt(document.savestat.freestats.value);
	var maxfr = parseInt(document.savestat.maxfstats.value);
	if(fr < maxfr) 
	{
		var st_class_div = 'st'+st_class;
		var st_class_hid = 'h'+st_class;
		var st_class_fin = 'f'+((st_class=='3')?4:((st_class=='4')?3:st_class));
		var ns = parseInt(document.savestat[st_class_fin].value) - 1;
		var min = parseInt(document.savestat[st_class_hid].value);
		if(ns >= min) 
		{
			document.all(st_class_div).innerHTML = '<font class=nickname><b>&nbsp;'+ns+'</b>';
			document.savestat[st_class_fin].value = ns;
			fr++;
			document.savestat.freestats.value = fr;
            document.all("frdiv").innerHTML = 'Повышения: ' + fr;
		}
	}
}

var d = document;

function AddStats(StatsID)
{
	var FrObj = d.getElementById("freestats");
	var fr = parseInt(FrObj.value);
	if(fr > 0)
	{
		fr--;
		var CAObj = d.getElementById("f"+((StatsID==3)?4:((StatsID==4)?3:StatsID)));
		var curValue = parseInt(d.getElementById("h"+StatsID).value);
		var curAdd = parseInt(CAObj.value) + 1;
		d.getElementById("st"+StatsID).innerHTML = (curValue + curAdd)+"<sup>(<font color=#009D29>+"+curAdd+"</font>)</sup>";
		FrObj.value = fr;
		CAObj.value = curAdd;
        d.getElementById("frdiv").innerHTML = 'Повышения: ' + fr;
	}
}

function RemStats(StatsID)
{
	var CAObj = d.getElementById("f"+((StatsID==3)?4:((StatsID==4)?3:StatsID)));
	var curAdd = parseInt(CAObj.value);
	if(curAdd > 0)
	{
		curAdd--;
		var FrObj = d.getElementById("freestats");
		var curValue = parseInt(d.getElementById("h"+StatsID).value);
		var fr = parseInt(FrObj.value) + 1;
		d.getElementById("st"+StatsID).innerHTML = (curValue + curAdd)+(curAdd > 0 ? "<sup>(<font color=#009D29>+"+curAdd+"</font>)</sup>" : "");	
		FrObj.value = fr;
		CAObj.value = curAdd;
        d.getElementById("frdiv").innerHTML = 'Повышения: ' + fr;
	}
}

function SaveStats()
{
d.getElementById("FSaveStats").submit();
}