// ** I18N

// Calendar EN language
// Author: Mihai Bazon, <mihai_bazon@yahoo.com>
// Encoding: any
// Distributed under the same terms as the calendar itself.

// For translators: please use UTF-8 if possible.  We strongly believe that
// Unicode is the answer to a real internationalized world.  Also please
// include your contact information in the header, as can be seen above.

// full day names
Calendar._DN = new Array
("Воскресение",
 "Понедельник",
 "Вторник",
 "Среда",
 "Четверг",
 "Пятница",
 "Суббота",
 "Воскресение");

// Please note that the following array of short day names (and the same goes
// for short month names, _SMN) isn't absolutely necessary.  We give it here
// for exemplification on how one can customize the short day names, but if
// they are simply the first N letters of the full name you can simply say:
//
//   Calendar._SDN_len = N; // short day name length
//   Calendar._SMN_len = N; // short month name length
//
// If N = 3 then this is not needed either since we assume a value of 3 if not
// present, to be compatible with translation files that were written before
// this feature.

// short day names
Calendar._SDN = new Array
("Вс",
 "Пн",
 "Вт",
 "Ср",
 "Чт",
 "Пт",
 "Сб",
 "Вс");

// First day of the week. "0" means display Sunday first, "1" means display
// Monday first, etc.
Calendar._FD = 1;

// full month names
Calendar._MN = new Array
("Январь",
 "Февраль",
 "Март",
 "Апрель",
 "Май",
 "Июнь",
 "Июль",
 "Август",
 "Сентябрь",
 "Октябрь",
 "Ноябрь",
 "Декабрь");

// short month names
Calendar._SMN = new Array
("Янв",
 "Фев",
 "Мар",
 "Апр",
 "Май",
 "Июн",
 "Июл",
 "Авг",
 "Сен",
 "Окн",
 "Ноя",
 "Дек");

// tooltips
Calendar._TT = {};
Calendar._TT["INFO"] = "Информация о календаре";

Calendar._TT["ABOUT"] =
"Выбор даты:\n" +
"- Используйте кнопки \xab, \xbb чтобы выбрать год\n" +
"- Используйте кнопки  " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " чтобы выбрать месяц\n" +
"- Hold mouse button on any of the above buttons for faster selection.";
Calendar._TT["ABOUT_TIME"] = "\n\n" +
"Выбор времени:\n" +
"- Нажмите на часы или минуты чтобы увеличить значение\n" +
"- или удерживая Shift нажмите чтобы уменьшить значение\n" +
"- или нажмите и перетащите для быстрого выбора значения.";

Calendar._TT["PREV_YEAR"] = "";//"Пред. год (зажмите для входа в меню)";
Calendar._TT["PREV_MONTH"] = "";//"Пред. месяц (зажмите для входа в меню)";
Calendar._TT["GO_TODAY"] = "Сегодня";
Calendar._TT["NEXT_MONTH"] = "";//"След. месяц (зажмите для входа в меню)";
Calendar._TT["NEXT_YEAR"] = "";//"След. год (зажмите для входа в меню)";
Calendar._TT["SEL_DATE"] = "Выбор даты";
Calendar._TT["DRAG_TO_MOVE"] = "";//"Перетащите чтобы переместить";
Calendar._TT["PART_TODAY"] = " (Сегодня)";

// the following is to inform that "%s" is to be the first day of week
// %s will be replaced with the day name.
Calendar._TT["DAY_FIRST"] = "%s первым";

// This may be locale-dependent.  It specifies the week-end days, as an array
// of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
// means Monday, etc.
Calendar._TT["WEEKEND"] = "0,6";

Calendar._TT["CLOSE"] = "Закрыть";
Calendar._TT["TODAY"] = "Сегодня";
Calendar._TT["TIME_PART"] = "";//"(Shift-)Кликните или перетащите чтобы изменить значение";

// date formats
Calendar._TT["DEF_DATE_FORMAT"] = "%Y-%m-%d";
Calendar._TT["TT_DATE_FORMAT"] = "%a, %b %e";

Calendar._TT["WK"] = "wk";
Calendar._TT["TIME"] = "Время:";
