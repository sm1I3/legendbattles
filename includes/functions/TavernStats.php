<?php

function TavernStats($descr){
    $st = $descr[2] ? ' (' . ($descr[2] / 60) . ' ч)' : '';
	switch($descr[0]){
        case 'LI':
            echo '&nbsp;Лимит: <B>' . (!$descr[1] ? 'без ограничений' : $descr[1] . ' шт') . '</B>' . $st . '<br>';
            break;
        case 'EFF':
            echo '&nbsp;<font color=#CC0000><B>Побочный эффект</B> (через <B>' . ($descr[1] / 60) . '</B> ч):</font><br>';
            break;
        case 'HP':
            echo '&nbsp;Восстановление HP: +<B>' . $descr[1] . '</B>' . $st . '<br>';
            break;
        case 'MP':
            echo '&nbsp;Восстановление MP: +<B>' . $descr[1] . '</B>' . $st . '<br>';
            break;
        case 'US':
            echo '&nbsp;Усталость: -<B>' . $descr[1] . '</B>' . $st . '<br>';
            break;
        case 'R_ST':
            echo '&nbsp;Случайный стат: +<B>' . $descr[1] . '</B>' . $st . '<br>';
            break;
        case 'R_MF':
            echo '&nbsp;Случайный МФ: +<B>' . $descr[1] . '</B>' . $st . '<br>';
            break;
        case 'RB_ST':
            echo '&nbsp;Случайный стат: ' . ($descr[4] == '1' ? '+' : '-') . '<B>' . $descr[1] . '-' . $descr[3] . '</B>' . $st . '<br>';
            break;
        case 'RB_MF':
            echo '&nbsp;Случайный МФ: ' . ($descr[4] == '1' ? '+' : '-') . '<B>' . $descr[1] . '-' . $descr[3] . '</B>' . $st . '<br>';
            break;
        case'1':
            echo '&nbsp;Удар: <B>' . $descr[1] . '</B>' . $st . '<br>';
            break;
        case'5':
            echo '&nbsp;Уловка: +<B>' . $descr[1] . '</B>' . $st . '<br>';
            break;
        case'6':
            echo '&nbsp;Точность: +<B>' . $descr[1] . '</B>' . $st . '<br>';
            break;
        case'7':
            echo '&nbsp;Сокрушение: +<B>' . $descr[1] . '</B>' . $st . '<br>';
            break;
        case'8':
            echo '&nbsp;Стойкость: +<B>' . $descr[1] . '</B>' . $st . '<br>';
            break;
        case'9':
            echo '&nbsp;Класс брони: <B>' . $descr[1] . '</B>' . $st . '<br>';
            break;
        case'10':
            echo '&nbsp;Пробой брони: +<B>' . $descr[1] . '</B>' . $st . '<br>';
            break;
        case'11':
            echo '&nbsp;Пробой колющим ударом: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'12':
            echo '&nbsp;Пробой режущим ударом: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'13':
            echo '&nbsp;Пробой проникающим ударом: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'14':
            echo '&nbsp;Пробой пробивающим ударом: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'15':
            echo '&nbsp;Пробой рубящим ударом: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'16':
            echo '&nbsp;Пробой карающим ударом: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'17':
            echo '&nbsp;Пробой отсекающим ударом: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'18':
            echo '&nbsp;Пробой дробящим ударом: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'19':
            echo '&nbsp;Защита от колющих ударов: +<B>' . $descr[1] . '</B>' . $st . '<br>';
            break;
        case'20':
            echo '&nbsp;Защита от режущих ударов: +<B>' . $descr[1] . '</B>' . $st . '<br>';
            break;
        case'21':
            echo '&nbsp;Защита от проникающих ударов: +<B>' . $descr[1] . '</B>' . $st . '<br>';
            break;
        case'22':
            echo '&nbsp;Защита от пробивающих ударов: +<B>' . $descr[1] . '</B>' . $st . '<br>';
            break;
        case'23':
            echo '&nbsp;Защита от рубящих ударов: +<B>' . $descr[1] . '</B>' . $st . '<br>';
            break;
        case'24':
            echo '&nbsp;Защита от карающих ударов: +<B>' . $descr[1] . '</B>' . $st . '<br>';
            break;
        case'25':
            echo '&nbsp;Защита от отсекающих ударов: +<B>' . $descr[1] . '</B>' . $st . '<br>';
            break;
        case'26':
            echo '&nbsp;Защита от дробящих ударов: +<B>' . $descr[1] . '</B>' . $st . '<br>';
            break;
        case'27':
            echo '&nbsp;НР: +<B>' . $descr[1] . '</B>' . $st . '<br>';
            break;
        case'28':
            echo '&nbsp;Очки действия: +<B>' . $descr[1] . '</B>' . $st . '<br>';
            break;
        case'29':
            echo '&nbsp;Мана: +<B>' . $descr[1] . '</B>' . $st . '<br>';
            break;
        case'30':
            echo '&nbsp;Мощь: +<B>' . $descr[1] . '</B>' . $st . '<br>';
            break;
        case'31':
            echo '&nbsp;Проворность: +<B>' . $descr[1] . '</B>' . $st . '<br>';
            break;
        case'32':
            echo '&nbsp;Везение: +<B>' . $descr[1] . '</B>' . $st . '<br>';
            break;
        case'33':
            echo '&nbsp;Здоровье: +<B>' . $descr[1] . '</B>' . $st . '<br>';
            break;
        case'34':
            echo '&nbsp;Разум: +<B>' . $descr[1] . '</B>' . $st . '<br>';
            break;
        case'35':
            echo '&nbsp;Сноровка: +<B>' . $descr[1] . '</B>' . $st . '<br>';
            break;
        case'36':
            echo '&nbsp;Владение мечами: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'37':
            echo '&nbsp;Владение топорами: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'38':
            echo '&nbsp;Владение дробящим оружием: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'39':
            echo '&nbsp;Владение ножами: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'40':
            echo '&nbsp;Владение метательным оружием: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'41':
            echo '&nbsp;Владение алебардами и копьями: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'42':
            echo '&nbsp;Владение посохами: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'43':
            echo '&nbsp;Владение экзотическим оружием: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'44':
            echo '&nbsp;Владение двуручным оружием: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'45':
            echo '&nbsp;Магия огня: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'46':
            echo '&nbsp;Магия воды: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'47':
            echo '&nbsp;Магия воздуха: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'48':
            echo '&nbsp;Магия земли: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'49':
            echo '&nbsp;Сопротивление магии огня: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'50':
            echo '&nbsp;Сопротивление магии воды: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'51':
            echo '&nbsp;Сопротивление магии воздуха: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'52':
            echo '&nbsp;Сопротивление магии земли: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'53':
            echo '&nbsp;Воровство: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'54':
            echo '&nbsp;Осторожность: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'55':
            echo '&nbsp;Скрытность: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'56':
            echo '&nbsp;Наблюдательность: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'57':
            echo '&nbsp;Торговля: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'58':
            echo '&nbsp;Странник: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'59':
            echo '&nbsp;Рыболов: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'60':
            echo '&nbsp;Лесоруб: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'61':
            echo '&nbsp;Ювелирное дело: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'62':
            echo '&nbsp;Самолечение: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'63':
            echo '&nbsp;Оружейник: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'64':
            echo '&nbsp;Доктор: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'65':
            echo '&nbsp;Самолечение: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'66':
            echo '&nbsp;Быстрое восстановление маны: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'67':
            echo '&nbsp;Лидерство: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'68':
            echo '&nbsp;Алхимия: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'69':
            echo '&nbsp;Развитие горного дела: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
        case'70':
            echo '&nbsp;Травничество: +<B>' . $descr[1] . '%</B>' . $st . '<br>';
            break;
	}
	return $str_params;
}