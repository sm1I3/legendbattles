function smile_open(page, e)
{
    e = e || window.event;
    var x = e.screenX - 150;
    var y = e.screenY - 580;
    var page = "/ch/smile"+page+".html";
    var sFeatures = 'dialogLeft:'+x+'px;dialogTop:'+y+'px;dialogHeight:550px;dialogWidth:450px;help:no;status:no;unadorned:yes';
    if (window.showModelessDialog){
		window.showModelessDialog (page, window, sFeatures);
	}else{
		window.open (page,"","width=450, height=350, alwaysRaised=yes");
	}
	
}

var map_en = ['s`h', 'S`h', 'S`H', 's`Х', 'sh`', 'Sh`', 'SH`', "'o", 'yo', "'O", 'Yo', 'YO', 'zh', 'w', 'Zh', 'ZH', 'W', 'ch', 'Ch', 'CH', 'sh', 'Sh', 'SH', 'e`', 'E`', "'u", 'yu', "'U", 'Yu', "YU", "'a", 'ya', "'A", 'Ya', 'YA', 'a', 'A', 'b', 'B', 'v', 'V', 'g', 'G', 'd', 'D', 'e', 'E', 'z', 'Z', 'i', 'I', 'j', 'J', 'k', 'K', 'l', 'L', 'm', 'M', 'n', 'N', 'o', 'O', 'p', 'P', 'r', 'R', 's', 'S', 't', 'T', 'u', 'U', 'f', 'F', 'h', 'H', 'c', 'C', '`', 'y', 'Y', "'"];
var map_ru = ['сх', 'Сх', 'СХ', 'сХ', 'щ', 'Щ', 'Щ', 'ё', 'ё', 'Ё', 'Ё', 'Ё', 'ж', 'ж', 'Ж', 'Ж', 'Ж', 'ч', 'Ч', 'Ч', 'ш', 'Ш', 'Ш', 'э', 'Э', 'ю', 'ю', 'Ю', 'Ю', 'Ю', 'я', 'я', 'Я', 'Я', 'Я', 'а', 'А', 'б', 'Б', 'в', 'В', 'г', 'Г', 'д', 'Д', 'е', 'Е', 'з', 'З', 'и', 'И', 'й', 'Й', 'к', 'К', 'л', 'Л', 'м', 'М', 'н', 'Н', 'о', 'О', 'п', 'П', 'р', 'Р', 'с', 'С', 'т', 'Т', 'у', 'У', 'ф', 'Ф', 'х', 'Х', 'ц', 'Ц', 'ъ', 'ы', 'Ы', 'ь'];

function convert(str)
{
  for (var i = 0; i <map_en.length; ++i)
    while (str.indexOf (map_en[i]) >= 0)
      str = str.replace (map_en[i], map_ru[i]);
  return str;
}

function submit_msg()
{
  var re, pr, tmail, tmail2;
  tmail = /^([\-]?\w+)(\.?\w+[\+\-]?)*\@\w+(\.\w+)+$/;
  tmail2 =/_+/;

  re = /^((?:\%?\<[^\>]{2,20}\>\s?)+)(.*?)$/;
  var email;

  if (parent.latrus === 1)
  {
      var msg = [];
    msg = re.exec(document.FBT.text.value);

    if (msg)
    {
      strarr = msg[2].split(' ');

      for (var j = 0; j < strarr.length; j++)
      {
        email = tmail.test (strarr[j]) && !tmail2.test (strarr[j]);
        if (strarr[j].indexOf("http://") < 0 &&
	    strarr[j] !== "%clan%" &&
            strarr[j].indexOf("www.") < 0 && !email)
        {
          strarr[j] = convert (strarr[j]);
        }
      }
      msg[2] = strarr.join(' ');
      document.FBT.text.value = msg[1]+msg[2];
    }
    else
    {
      strarr = document.FBT.text.value.split(' ');
      for (var j = 0; j < strarr.length; j++)
      {
        email = tmail.test (strarr[j]) && !tmail2.test (strarr[j]);
        if (strarr[j].indexOf("http://") < 0 &&
	    strarr[j] !== "%clan%" &&
            strarr[j].indexOf("www.") < 0 && !email)
        {
          strarr[j] = convert (strarr[j]);
        }
      }
      document.FBT.text.value = strarr.join(' ');
    }
  }
}

function use_action(usetype){
    parent.frames['main_top'].location='/main.php?useaction='+usetype;
}
useaction = function(usetype){
    parent.$('#basic-modal-content').html('<iframe src="/main.php?useaction=' + usetype + '" id="useaction" name="useaction" scrolling="auto" style="width:1050px;height:600px;" frameborder="0"></iframe>');
    parent.ShowModal();
};

useactions = function(usetype){
    parent.$('#basic-modal-content').html('<iframe src="/gameplay/ajax/addons-action.php" id="useaction" name="useaction" scrolling="auto" style="width:1050px;height:600px;" frameborder="0"></iframe>');
    parent.ShowModal();
};