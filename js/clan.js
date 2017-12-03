var ownid, salign, sign, weacode, edicode, outcode;

function clan_private(clanid)
{
       parent.frames['ch_buttons'].document.FBT.text.focus();
       parent.frames['ch_buttons'].document.FBT.text.value = '%<'+clanid+'> ' + parent.frames['ch_buttons'].document.FBT.text.value;
}

function clan_init(fownid,fsalign,fsign,fweacode,fedicode,foutcode)
{
       ownid = fownid;
       salign = fsalign;
       sign = fsign;
       weacode = fweacode;
       edicode = fedicode;
       outcode = foutcode;
}
ShowForm = function(edicode,plid){
	AjaxGet('clan_ajax.php?act=get&plid='+plid+'&vcode='+edicode);	
}
SubmitForm = function(edicode,plid){
	AjaxGet('clan_ajax.php?act=edit&plid='+$('plid').value+'&clan_d='+$('clan_d').value+'&access_1='+$('access_1').value+'&access_2='+$('access_2').value+'&access_3='+$('access_3').value+'&access_4='+$('access_4').value);
	FormPopUp('darker');
	$('user_'+$('plid').value).innerHTML = $('clan_d').value;
}
StateReady = function(){
	switch(arr_res[0]){
		case'OK':
		str_pr = arr_res[1].split('|');
		var s = '<form onSubmit="SubmitForm();return false;">';
		s += '<table cellpadding="0" cellspacing="1" width="100%" border="0">';
		s += '<tr>';
            s += '<td>Звание:</td>';
		s += '<td><input type="text" name="clan_d" id="clan_d" class="LogintextBox" value="'+str_pr[1]+'" /></td>';
		s += '</tr>';
		s += '<tr>';
            s += '<td>Казна:</td>';
            s += '<td><select name="access_1" id="access_1" style="width:150px;">  <option value="1" ' + ((str_pr[2] == '1') ? 'selected="selected"' : '') + '>Да</option>  <option value="0" ' + ((str_pr[2] == '0') ? 'selected="selected"' : '') + '>Нет</option></select></td>';
		s += '</tr>';
		s += '<tr>';
            s += '<td>Упр. Казны:</td>';
            s += '<td><select name="access_2" id="access_2" style="width:150px;">  <option value="1" ' + ((str_pr[3] == '1') ? 'selected="selected"' : '') + '>Да</option>  <option value="0" ' + ((str_pr[3] == '0') ? 'selected="selected"' : '') + '>Нет</option></select></td>';
		s += '</tr>';
		s += '<tr>';
            s += '<td>Ред. Клана:</td>';
            s += '<td><select name="access_3" id="access_3" style="width:150px;">  <option value="1" ' + ((str_pr[4] == '1') ? 'selected="selected"' : '') + '>Да</option>  <option value="0" ' + ((str_pr[4] == '0') ? 'selected="selected"' : '') + '>Нет</option></select></td>';
		s += '</tr>';
		s += '<tr>';
            s += '<td>Управление:</td>';
            s += '<td><select name="access_4" id="access_4" style="width:150px;">  <option value="1" ' + ((str_pr[5] == '1') ? 'selected="selected"' : '') + '>Да</option>  <option value="0" ' + ((str_pr[5] == '0') ? 'selected="selected"' : '') + '>Нет</option></select></td>';
		s += '</tr>';
		s += '<tr>';
            s += '<td colspan="2" align="center"><input type="hidden" name="plid" id="plid" value="' + str_pr[0] + '" /><input type="submit" class="lbut" value="Редактировать" /></td>';
		s += '</tr>';
		s += '</table>';
		s += '</form>';
		$('ContentPopUp').innerHTML = s;
		break;
	}
}
function sh_fight(fid)
{
    if (parseInt(fid) > 0) return '  <a href="./logs.php?fid=' + fid + '" target=_blank><b>в бою</b></a> ';
     else return '';
}
function clan_sostav(pr,nick,lev,signst,sstatus,plnx,plid,fightid)
{
       var alar = new Array("","darks","lights","sumers","chaoss","light","dark","sumer","chaos","angel");
       var priv = '<img src=/img/image/1x1.gif width=11 height=12 align=absmiddle>';
       var all_si = '';
       var slink = '';
	   var onoff = '';

    //if(weacode && pr==0) slink += '<input type=button class=lbut onClick="use_action=\'clan-action&addid=1&get_id=29&clan_act=1&vcode='+weacode+'&plid='+plid+'\'" value=" Снять вещи ">&nbsp;&nbsp;';
    if (edicode) slink += '<input type=button class=lbut onClick="javascript:FormPopUp(\'darker\'); ShowForm(\'' + edicode + '\',\'' + plid + '\');" value=" Редактировать ">&nbsp;&nbsp;';//,
    if (outcode) slink += '<input type=button class=lbut onClick="javascript: if(confirm(\'Выгнать персонажа за 100 Бронзы?\')) { location=\'?useaction=clan-action&addid=1&get_id=29&clan_act=2&vcode=' + outcode + '&plid=' + plid + '\' }" value=" Выгнать [ 100  Бронзы ] ">';
	   
       switch(signst)
       {
              case 8:
   	      slink = '';
                  var ssta = '<font color=#CC0000>Глава семьи</font>';
	      break;
       	      case 9:
       	      slink = '';
                  var ssta = '<font color=#CC0000>Глава клана</font>';
	      break;
       	      default:
       	      if(ownid == plid) slink = '';
	      var ssta = sstatus;
       }
       
       if(pr == 1) {priv = '<a href="javascript:parent.say_private(\''+nick+'\')"><img src=/img/image/chat/private.gif width=11 height=12 border=0 align=absmiddle></a>'; onoff = '<font color="#009933"><b>online</b></font>';}
    if (pr == 0) {
        onoff = '<font color=#CC0000><b>offline</b></font>';
        plnx = '<font color=gray>Неизвестно</font>';
    }
       if(salign > 0) all_si = '<img src=/img/image/signs/'+alar[salign]+'.gif width=15 height=12 border=0> ';
       all_si += '<img src=/img/image/signs/'+sign+' width=15 height=12 border=0 align=absmiddle>';
       document.write('<tr align=center><td align=left class=nickname bgcolor=white><font class=nickname>'+priv+'&nbsp;'+all_si+' <b>'+nick+'</b>['+lev+']<a href="ipers.php?'+nick+'" target=_blank><img src=/img/image/chat/info.gif width=11 height=12 border=0 align=absmiddle></a></td><td align=left class=nickname bgcolor=white><font class=nickname align=center>&nbsp;&nbsp;<b id="user_'+plid+'">'+ssta+'</b></td><td align=center class=nickname bgcolor=white>'+onoff+'</td><td align=left class=nickname bgcolor=white><font class=freetxt align=center>&nbsp;&nbsp;<b>'+plnx+'</b>&nbsp;'+sh_fight(fightid)+'</font></td><td align=center class=nickname bgcolor=white><font class=text>&nbsp;&nbsp;'+slink+'</td></tr>');
}