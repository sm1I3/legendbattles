var ownid, weacode, edicode, outcode;

function clan_private()
{
       top.frames['ch_buttons'].FBT.text.focus();
       top.frames['ch_buttons'].FBT.text.value = '%clan% ' + top.frames['ch_buttons'].FBT.text.value;
}

function pv_init(fownid,fweacode,fedicode,foutcode)
{
       ownid = fownid;
       weacode = fweacode;
       edicode = fedicode;
       outcode = foutcode;
}

function pv_sostav(pr,sign,nick,lev,signst,sstatus,plnx,plid)
{
       var priv = '<img src=http://image.guild-honor.ru/1x1.gif width=11 height=12 align=absmiddle>';
       var all_si = '';
       var slink = '';

    if (weacode && pr == 0) slink += '<a href=?useaction=clan-action&addid=1&get_id=29&clan_act=1&vcode=' + weacode + '&plid=' + plid + '>Снять вещи</a>&nbsp;&nbsp;';
    if (edicode) slink += '<a href=?useaction=clan-action&addid=1&get_id=29&clan_act=5&vcode=' + edicode + '&plid=' + plid + '>Редактировать</a>&nbsp;&nbsp;';
    if (outcode) slink += '<a href="javascript: if(confirm(\'Выгнать представителя власти?\')) { location=\'main.php?useaction=clan-action&addid=1&get_id=29&clan_act=4&vcode=' + outcode + '&plid=' + plid + '\' }">Выгнать</a>';

       switch(signst)
       {
       	      case 9:
       	      slink = '';
                  var ssta = '<font color=#CC0000>Глава Института Власти</font>';
	      break;
       	      default:
       	      if(ownid == plid) slink = '';
	      var ssta = sstatus;
       }
       
       if(pr == 1) priv = '<a href="javascript:top.say_private(\''+nick+'\')"><img src=http://image.guild-honor.ru/chat/private.gif width=11 height=12 border=0 align=absmiddle></a>';
       all_si += '<img src=http://image.guild-honor.ru/signs/'+sign+' width=15 height=12 border=0 align=absmiddle>';
       document.write('<tr><td><font class=nickname>'+priv+'&nbsp;'+all_si+' <b>'+nick+'</b>['+lev+']<a href="pinfo.cgi?'+nick+'" target=_blank><img src=http://image.guild-honor.ru/chat/info.gif width=11 height=12 border=0 align=absmiddle></a></td><td><font class=nickname>&nbsp;&nbsp;<b>'+ssta+'</b></td><td nowrap><font class=hpfont>&nbsp;&nbsp;'+plnx+'</font></td><td><font class=text>&nbsp;&nbsp;'+slink+'</td></tr>');
}