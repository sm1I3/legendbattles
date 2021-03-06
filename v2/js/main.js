var COMMON_DATA = {};
var TEMPLATE_PATH = '';

function templateArt(data) {
    var html = '', skills = '', skill = {}, itemData = '', count = 0;
    if (data.kind) {
        itemData += '<span class="b-common-alt__data-item"><img src="' + TEMPLATE_PATH + '/images/icons/alt/kind.gif" /> ' + data.kind + '</span>';
    }
    if (data.lev) {
        itemData += '<span class="b-common-alt__data-item"><img src="' + TEMPLATE_PATH + '/images/icons/alt/level.gif" /> ' + data.lev.title + ' <b class="text-red-2">' + data.lev.value + '</b></span>';
    }
    if (data.dur) {
        itemData += '<span class="b-common-alt__data-item"><img src="' + TEMPLATE_PATH + '/images/icons/alt/dur.gif" /> <span class="text-red-2">' + data.dur + '</span>/' + data.dur_max + '</span>';
    }
    if (data.trend) {
        itemData += '<span class="b-common-alt__data-item"><img src="' + TEMPLATE_PATH + '/images/icons/alt/trend.gif" /> ' + data.trend + '</span>';
    }
    if (data.price) {
        itemData += '<span class="b-common-alt__data-item"><b class="text-red-2">' + data.price + '</b></span>';
    }
    if (data.exp) {
        skills += '<tr class="' + (count % 2 == 0 ? 'even' : 'odd') + '">';
        skills += '<td class="b-common-alt__skills-title">' + data.exp.title + '</td>';
        skills += '<td class="b-common-alt__skills-value text-green"><b>' + data.exp.value + '</b></td>';
        skills += '</tr>';
        count++;
    }
    if (data.skills && data.skills.length) {
        for (var i = 0, len = data.skills.length; i < len; i++) {
            skill = data.skills[i];
            skills += '<tr class="' + (count % 2 == 0 ? 'even' : 'odd') + '">';
            skills += '<td class="b-common-alt__skills-title">' + skill.title + '</td>';
            skills += '<td class="b-common-alt__skills-value text-red-2">' + skill.value + '</td>';
            skills += '</tr>';
            count++;
        }
    }
    if (data.skills_e && data.skills_e.length) {
        for (var i = 0, len = data.skills_e.length; i < len; i++) {
            skill = data.skills_e[i];
            skills += '<tr class="' + (count % 2 == 0 ? 'even' : 'odd') + '">';
            skills += '<td class="b-common-alt__skills-title">' + skill.title + '</td>';
            skills += '<td class="b-common-alt__skills-value">' + skill.value + '</td>';
            skills += '</tr>';
            count++;
        }
    }
    if (data.set) {
        skills += '<tr class="' + (count % 2 == 0 ? 'even' : 'odd') + '">';
        skills += '<td class="b-common-alt__skills-title">' + data.set.title + '</td>';
        skills += '<td class="b-common-alt__skills-value">' + data.set.value + '</td>';
        skills += '</tr>';
        count++;
    }
    if (data.nogive) {
        skills += '<tr class="' + (count % 2 == 0 ? 'even' : 'odd') + '">';
        skills += '<td colspan="2" class="b-common-alt__skills-title text-red-2"><b>' + data.nogive + '</b></td>';
        skills += '</tr>';
        count++;
    }
    if (data.nosell) {
        skills += '<tr class="' + (count % 2 == 0 ? 'even' : 'odd') + '">';
        skills += '<td colspan="2" class="b-common-alt__skills-title text-green"><b>' + data.nosell + '</b></td>';
        skills += '</tr>';
        count++;
    }
    if (data.noweight) {
        skills += '<tr class="' + (count % 2 == 0 ? 'even' : 'odd') + '">';
        skills += '<td colspan="2" class="b-common-alt__skills-title text-grey"><b>' + data.noweight + '</b></td>';
        skills += '</tr>';
        count++;
    }
    if (data.desc) {
        skills += '<tr class="' + (count % 2 == 0 ? 'even' : 'odd') + '">';
        skills += '<td colspan="2" class="b-common-alt__skills-title">' + data.desc + '</td>';
        skills += '</tr>';
        count++;
    }
    html = ['<div class="b-common-alt">', '<table cellspacing="0">', '<tr>', '<td colspan="3" class="b-common-alt__title" style="background: red">', '<h2 class="b-common-alt__title-inner" style="color: ' + data.color + ';">' + data.title + '</h2>', '</td>', '</tr>', '<tr>', '<td class="side">&nbsp;</td>', '<td class="b-common-alt__body">', '<div class="b-common-alt__body-inner">', '<div class="b-common-alt__info">', '<div class="b-common-alt__image">', '<img src="' + data.picture + '" alt="" />', '</div>', '<div class="b-common-alt__data">', itemData, '<span class="b-common-alt__data-item">&nbsp;</span>', '</div>', '</div>', '<table class="b-common-alt__skills">', skills, '</table>', '</div>', '</td>', '<td class="side">&nbsp;</td>', '</tr>', '</table>', '</div>'].join('');
    return html;
}

function openPopup(popup, shader, interval) {
    var $popup = $(popup), $shader = !shader ? $('.b-popup-shader') : $(shader),
        interval = (interval === undefined) ? 500 : parseInt(interval),
        $close = $popup.find('span[data-button="close"]');
    if (!$popup[0]) {
        if (console.error) {
            console.error('No popup found');
            return false;
        }
    }
    $popup.css({
        'display': 'block',
        'margin-left': '-' + ($popup.width() / 2) + 'px',
        'margin-top': '-' + ($popup.height() / 2) + 'px'
    });
    $shader.fadeIn(interval);
    $close.on('click', function () {
        closePopup($popup, $shader, interval);
    });
    $shader.on('click', function () {
        closePopup($popup, $shader, interval);
    });
    $(document).on('keyup', function (e) {
        if (e.keyCode == 27) {
            closePopup($popup, $shader, interval);
        }
    });
    return false;
}

function closePopup(popup, shader, interval) {
    var $popup = $(popup), $shader = !shader ? $('.b-popup-shader') : $(shader),
        interval = (interval === undefined) ? 500 : parseInt(interval);
    if (!$popup[0]) {
        if (console.error) {
            console.error('No popup found');
            return false;
        }
    }
    $popup.hide();
    $shader.fadeOut(interval);
    $(document).unbind('keyup');
    return false;
}

function changePopup(popup1, popup2, shader) {
    closePopup(popup1, shader, 0);
    return openPopup(popup2, shader, 0);
}

function fixYellow() {
    if (navigator.userAgent.toLowerCase().indexOf('chrome') > -1) {
        $.each($("input[type=text], input[type=password]"), function () {
            $(this).clone(true).appendTo($(this).parent());
            $(this).remove();
        });
    }
}

$(function () {
    Cufon.replace('span[data-font="PTSans"]', {
        color: '-linear-gradient(#ffff99, #fea143, #c54500)',
        textShadow: '#000 1px 1px'
    });
    Cufon.replace('span[data-font="PTSansBlack"]', {textShadow: 'rgba(255, 255, 255, 0.5) 1px 1px'});
    $('input, select').styler();
    $('input[type="text"], input[type="password"]').bind('focus blur', function () {
        $(this).parents('.b-common-form__field').toggleClass('focus');
    });
    if ($.fn.powerTip) {
        $('*[data-object]').powerTip({
            followMouse: true,
            fadeInTime: 0,
            fadeOutTime: 0,
            closeDelay: 0
        }).data('powertip', function () {
            var $this = $(this), data = COMMON_DATA[$this.data('object')], callback = 'debugTemplate';
            if (!data) return;
            if (data._template) {
                callback = data._template;
            }
            return window[callback](data);
        });
    }
    window.setTimeout(fixYellow, 100);
});

function RegFormSubmit() {
    var ReponseText = '';
    $.ajax({
        type: "POST",
        url: "/gameplay/reg/ajax_reg.php",
        cache: false,
        data: {
            "reg-user": $("#login").val(),
            "reg-email": $("#email").val(),
            "reg-sexuser": $("#sex").val(),
            "reg-bday": $("#bday").val()
        },
        success: function (response) {
            response = response.split('@');
            if (response[0] === 'OK') {
                $('#regError').html('Регистрация завершена.<br />Ваш пароль: <font color="red"><b>' + response[1] + '</b></font>');
            } else {
                response = response.split('@');
                switch (response[1]) {
                    case'1':
                        $('#regError').html('Ошибка: Введите корректный Логин.');
                        break;
                    case'2':
                        $('#regError').html('Ошибка: Логин содержит запретные смиволы.');
                        break;
                    case'3':
                        $('#regError').html('Ошибка: Логин уже занят.');
                        break;
                    case'4':
                        $('#regError').html('Ошибка: Введите корректный E-mail.');
                        break;
                    case'5':
                        $('#regError').html('Ошибка! Введите дату рождения.');
                        break;
                    case'6':
                        $('#regError').html('Ошибка: Укажите свой пол.');
                        break;
                }
            }
        }
    });
}