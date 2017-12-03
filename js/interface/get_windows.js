d = document;
window.timer;

function message_window (type,header,message,buttons,address) {
	d.getElementById('popup').style.display = '';
	d.getElementById('back').style.width = '100%';
	d.getElementById('back').style.height = d.body.scrollHeight+'px';
	d.getElementById('popup').style.width = '100%';
	d.getElementById('popup').style.height = '100%';
	d.getElementById('back').style.display = '';
	d.getElementById('popup').style.top = d.body.scrollTop;

	if (type=='alert') { font = '#AA0000' }
	else if (type=='success') { font = '#009900' }
	else if (type=='confirm') { font = '#333333' }
	else if (type=='ereage') { font = '#009900' }

	buttons = buttons.split('|');
	buts = '<table border=0><tr>';
	for (a=0,b=buttons.length;a<b;a++){

		if (buttons[a]=='accept') {
			addr = address.split('|');
			if (addr[0]=='click') {buts += '<td><div id="use_it"><a href="javascript:void(0);" id="use_it" onclick="'+addr[1]+'"><img src=interface/prim.gif border=0></a></div></td>'}
			else if (addr[0]=='href') {	buts += '<td><div id="use_it"><a href="javascript:void(0);" id="use_it" onclick="d.location=\''+addr[1]+'\'"><img src=interface/prim.gif border=0></a></div></td>' }
		}
		else if (buttons[a]=='cancel') { buts += '<td><div id="use_cancel"><a href="javascript:void(0);" id="use_cancel" onclick="close_window();"><img src=interface/cancel.gif border=0></a></div></td>' }
		else if (buttons[a]=='ereage') {buts += '<td><div id="ereage"><a href="?" id="ereage"><img src=interface/ok.gif></a></div></td>'}
		else if (buttons[a]=='ok') { //buts += '<td><div id="use_ok"><a href="javascript:void(0);" id="use_ok" onclick="close_window();"></a></div></td>' }

			addr = address.split('|');
			if (addr.length>1 && addr[0]=='click') { buts += '<td><div id="use_ok"><a href="javascript:void(0);" id="use_ok" onclick="'+addr[0]+'"><img src=interface/ok.gif border=0></a></div></td>' }
			else {
			//buts += '<td><div id="use_ok"><a href="?" id="use_ok"><img src=interface/ok.gif></a></div></td>' }
			  buts += '<td><div id="use_ok"><a href="javascript:void(0);" id="use_ok" onclick="close_window();"><img src=interface/ok.gif></a></div></td>' }

	    }
	}
	buts += '</tr></table>';
	d.getElementById('popup').innerHTML = '<table width=100% height=100% border=0><tr><td align=center valign=middle style="padding-left:5px;"><table style="vertical-align:top;" background="http://img.legendbattles.ru/images/bg2.gif" cellspacing="0" cellpadding=0><tr height=5><td width=5 style="background-image:url(/interface/priroda1.gif); background-repeat:no-repeat;"></td><td style="background-image:url(/interface/priroda2.gif); background-repeat:repeat-x;"></td><td width=5 style="background-image:url(/interface/priroda3.gif); background-repeat:no-repeat;"></td></tr><tr><td width=5 style="background-image:url(/interface/priroda8.gif); background-repeat:repeat-y;"></td>'+
'<td valign="top" style="padding:5px;" id="popup_content"><center><font style="font-size:14px; font-weight:900; color:'+font+';">'+header+'</font></center><div style="font-size:12px; padding-top:5px; padding-bottom:5px;">'+message+'</div><center>'+buts+'</center></td><td width=5 style="background-image:url(/interface/priroda4.gif); background-repeat:repeat-y;"></td></tr><tr height=5><td width=5 style="background-image:url(/interface/priroda7.gif); background-repeat:no-repeat;"></td><td style="background-image:url(/interface/priroda6.gif); background-repeat:repeat-x;"></td><td width=5 style="background-image:url(/interface/priroda5.gif); background-repeat:no-repeat;"></td></tr></table></td></tr></table>';
}

function close_window () {
	d.getElementById('popup').style.display = 'none';
	d.getElementById('back').style.display = 'none';
}

function send_out(user) {
    message_window('confirm', 'Исключение персонажа', 'Вы действительно хотите выгнать персонажа <b>' + user + '</b> из ордена?', 'accept|cancel', 'href|main.php?go_out=' + user + '&gopers=clan&action=addon')
}

function sended_out(user) {
    message_window('success', 'Персонаж исключен', 'Персонаж <b>' + user + '</b> исключен из состава ордена.<br>С Вашего счета списано <b>200 <img src=images/money.gif></b>.', 'ok', '')
}

function got_in(user) {
    message_window('success', 'Персонаж принят', 'Персонаж <b>' + user + '</b> принят в состав ордена.<br>С Вашего счета списано <b>200 <img src=images/money.gif></b>.', 'ok', '')
}

function new_head(user) {
    message_window('success', 'Новый Глава', 'Персонаж <b>' + user + '</b> успешно назначен на должность Главы Ордена.', 'ok', '')
}

function sell_give(user) {
    message_window('success', 'Покупка', 'Вы удачно купили <b>' + info[0] + '</b>.', 'ok', '')
}
function proc_error (number) {
	switch (number) {
        case 1:
            text = 'Такого персонажа не существует.';
            break;
        case 2:
            text = 'Такого персонажа не существует или <br>персонаж находится в другом ордене.';
            break;
        case 3:
            text = 'Персонаж не находится в ордене.';
            break;
        default:
            text = 'Неизвестная ошибка. Обновите верхний фрейм.';
            break;
    }
    message_window('alert', 'Ошибка!', text, 'ok', '');
}

function init_timer (time) {
	//info = time.split('|');
	var info = time;
	//window.timer = parseInt(info[0]);
    message_window('success', 'Травничество', info[1] + '', 'ok', '');//click|javascript:void()
	//work_timer ();
}

function work_timer () {
	if (window.timer>0) {
        document.getElementById("internal_timer").innerHTML = '<center> еще ' + window.timer + ' сек.</center>';
		window.timer = window.timer - 1;
		setTimeout("work_timer ("+window.timer+");",1000);
	}
	else {
		close_window();
	}
}

// Помощь
//Биржа, подвал
function b0_help() {
    text = '<div style="width:450px;"><p align=justify>В лавке Алхимика можно купить все инструменты, которые необходимы для варки зелий.<br>&bull; <b>Дистиллятор</b> необходим для варки зелий и заготовки алхимических отваров<br>&bull; <b>Ступка</b> пригодится для изготовления толченых компонентов для зелий<br>&bull; <b>Баночка для зелий</b> необходима чтобы хранить готовое алхимическое зелье<br>&bull; <b>Баночка для настоев</b> необходима целителям - для хранения отваров и готовых целебных зелий.</div>';
    message_window('success', 'Лавка Алхимика', text, 'ok', '');
}

//Биржа, 1-й этаж
function b1_help() {
    text = '<div style="width:450px;"><p align=justify>&bull; <b>Скупка ресурсов:</b> Здесь Вы можете совершать моментальную скупку/продажу ресурсов, если они есть/нужны складу биржи.<br>&bull; <b>Рынок ресурсов:</b> Здесь вы можете выставить свои ресурсы на продажу, за нужную вам цену, предложив его другим игрокам.</div>';
    message_window('success', 'Биржа, 1-й этаж', text, 'ok', '');
}

//Биржа, 2-й этаж
function b3_help() {
    text = '<div style="width:450px;"><p align=justify>В лавке Алхимика можно купить все инструменты, которые необходимы для варки зелий.<br>&bull; <b>Дистиллятор</b> необходим для варки зелий и заготовки алхимических отваров<br>&bull; <b>Ступка</b> пригодится для изготовления толченых компонентов для зелий<br>&bull; <b>Баночка для зелий</b> необходима чтобы хранить готовое алхимическое зелье<br>&bull; <b>Баночка для настоев</b> необходима целителям - для хранения отваров и готовых целебных зелий.</div>';
    message_window('success', 'Лавка Алхимика', text, 'ok', '');
}

//Биржа, 3-й этаж
function b3_help() {
    text = '<div style="width:450px;"><p align=justify>В лавке Алхимика можно купить все инструменты, которые необходимы для варки зелий.<br>&bull; <b>Дистиллятор</b> необходим для варки зелий и заготовки алхимических отваров<br>&bull; <b>Ступка</b> пригодится для изготовления толченых компонентов для зелий<br>&bull; <b>Баночка для зелий</b> необходима чтобы хранить готовое алхимическое зелье<br>&bull; <b>Баночка для настоев</b> необходима целителям - для хранения отваров и готовых целебных зелий.</div>';
    message_window('success', 'Арена', text, 'ok', '');
}

//Домик целителя
function celitel_1() {
    text = '<div style="width:450px;"><p align=justify>В хижине целителя можно купить все инструменты, которые необходимы для варки зелий.<br>&bull; <b>Дистиллятор</b> необходим для варки зелий и заготовки алхимических отваров<br>&bull; <b>Ступка</b> пригодится для изготовления толченых компонентов для зелий<br>&bull; <b>Баночка для зелий</b> необходима чтобы хранить готовое алхимическое зелье<br>&bull; <b>Баночка для настоев</b> необходима целителям - для хранения отваров и готовых целебных зелий.</div>';
    message_window('success', 'Хижина целителя', text, 'ok', '');
}

//Таверна, переброс параметров
function taverna_2() {
    text = '<div style="width:450px;"><p align=justify>В этой комнате Вы сможете перенести свои параметры в другие с помощью колдовства. <br>&bull; Например: Силу в здоровье.<br> стоимость переброса одного параметра: 50 <img src=images/money.gif>.</div>';
    message_window('success', 'Загадочная комната', text, 'ok', '');
}

//Таверна, переброс умений
function taverna_3() {
    text = '<div style="width:450px;"><p align=justify>В этой комнате Вы сможете перенести свои боевые умения в другие с помощью колдовства. <br>&bull; Например: Владения ножами во Владения щитами.<br> стоимость переброса одного умения: 50 <img src=images/money.gif>.</div>';
    message_window('success', 'Комната славы', text, 'ok', '');
}

// Замок
function city() {
    text = '<div style="width:450px;"><p align=justify><b> Раздел локация :</b> показывает какие в данном месте присутствуют здания, в которые можно войти.<br><b> Раздел перемещение : </b>показывает доступные для посещения улицы<br>&bull; <b><i> Для перемещения по улицам и вход в здания, кликните по нужной Вам кнопке, или выберите здание на картинке. </b></i></div>';
    message_window('success', 'Замок(улица)', text, 'ok', '');
}

// Лавка подарков
function pr_shop() {
    text = '<div style="width:450px;"><p align=justify> Сувенирная лавка для души, посылайте друзьям и любимым цветы и игрушки.</div>';
    message_window('success', 'Сувенирная лавка', text, 'ok', '');
}

// Помощь для хелповой карты
function help_map() {
    text = '<div style="width:450px;"><p align=justify> <b>Пояснение: Обведенные цветом те или иные клетки означают:</b><br /><font color="#d60000"><b>Красный - Текущее местоположение.</b></font><br /><font color="#600000"><b>Тёмно-красный - Можно переходить.</b></font><br /><font><b>Безцветный - Перехода несуществует. </b></font> <br /> Эта карта помошник, дабы вы не потерялись и нашли именно то, что Вам нужно. Все переходы осущевствляются мгновенно, ходить можно везде.</div>';
    message_window('success', 'Природная местность', text, 'ok', '');
}

// Шахта 1
function mine1() {
    text = '<div style="width:450px;"><p align=justify> <b>Пояснение: Обведенные цветом те или иные клетки означают:</b><br /><font color="#d60000"><b>Красный - Текущее местоположение.</b></font><br /><font color="#600000"><b>Тёмно-красный - Можно переходить.</b></font><br /><font><b>Безцветный - Перехода несуществует. </b></font> <br /> Эта карта помошник, дабы вы не потерялись и нашли именно то, что Вам нужно. Все переходы осущевствляются мгновенно, ходить можно везде.</div>';
    message_window('success', 'Природная местность', text, 'ok', '');
}