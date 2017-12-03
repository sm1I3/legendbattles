var d = document;

function ClearSelect(oListBox,Protect)
{
    var leng = oListBox.options.length - 1;
    for(i=leng; i>=0; i--) if(i != Protect) oListBox.remove(i);
}

function AddOption(oListBox,name,value,selected)
{
    var oOption = d.createElement("option");
    oOption.appendChild(d.createTextNode(name));
    oOption.setAttribute("value",value);
    if(selected > 0) oOption.setAttribute("selected","true"); 
    oListBox.appendChild(oOption);
}

function AddTD(Obj)
{
	var i,j,oTD;
	for(i=1; i<Obj.length; i++)
	{
		oTD = Obj[0].insertCell(i - 1);
		for(j=0; j<Obj[i].length; j++) 
		{
			switch(Obj[i][j][0])
			{
				case 0: oTD.innerHTML = Obj[i][j][1]; break;
				case 1: oTD.bgColor = Obj[i][j][1]; break;
				case 2: oTD.align = Obj[i][j][1]; break;
				case 3: oTD.width = Obj[i][j][1]; break;
				case 4: oTD.height = Obj[i][j][1]; break;
				case 5: oTD.className = Obj[i][j][1]; break;
				case 6: oTD.colSpan = Obj[i][j][1]; break;
			}
		}
	}
}

function AddButton(Obj)
{
	var Butt = '<input type=button class="'+Obj[0][0]+'" onclick="location=\'';
	for(var i=0; i<Obj[1].length; i++) Butt += (i ? '&' : '?')+Obj[1][i][0]+'='+Obj[1][i][1]; 
	Butt += '\'" value="'+Obj[0][1]+'"'+(Obj[0][2] ? '' : ' DISABLED')+'>';
	return Butt;	
}