<?php

function GetMenuArray()
{
  return  Array(
       'users'=>Array(
           'name' => 'Пользователи',
            'icon'=>'images/cms_icons/cms_UsersManagement.gif',
            'pages'=>Array(
                'user_list' => Array('Список пользователей', 1),
                'tz' => Array('Отчёт по работникам', 1),
                'online' => Array('Онлайн', 1),
                'sendmail_list' => Array('Рассылка сообщений', 1),
                'service_list' => Array('Платные сервисы', 1),
                'player' => Array('Персонаж', 1),
                'present_category_list' => Array('Категории подарков', 131072),
                'present_list' => Array('Подарки', 131072),
            )
        ),
        'quest'=>Array(
            'name' => 'Квесты',
            'icon'=>'images/cms_icons/cms_SystemSettings.gif',
            'pages'=>Array(
                'quest_group_list' => Array('Категории квестов', 2),
                'quest_list' => Array('Квесты', 2),
                'quest_image_list' => Array('Картинки квестов', 2),
                'place_list' => Array('Места', 16384),
                'labyrinth_list' => Array('Лабиринты', 8),
                'labyrinth_schedule' => Array('Расписание лабиринтов', 1),
            )
        ),
        
        'tools'=>Array(
            'name' => 'Ресурсы',
            'icon'=>'images/cms_icons/cms_SiteStructure.gif',
            'pages'=>Array(
                'chests' => Array('Сундуки', 1),
                'chests2' => Array('Сундуки отк', 1),
                'resource_group_list' => Array('Группы ресурсов', 32),
                'resource_list' => Array('Ресурсы', 32),
                'item_list' => Array('Инструменты', 64),
                'alhim' => Array('Рецепты', 128),
            )
        ),
        
        'weapons'=>Array(
            'name' => 'Оружие',
            'icon'=>'images/cms_icons/cms_SiteStructure.gif',
            'pages'=>Array(
                'ref_system' => Array('Рефералка', 1),
                'player_items' => Array('Удаление вещей', 256),
                'weapon_category_list' => Array('Категории оружия', 1),
                'weapon_property_list' => Array('Параметры оружия', 1),
                'tavern' => Array('Таверна', 262144),
            )
        ),
        
        'bots'=>Array(
            'name' => 'Боты',
            'icon'=>'images/cms_icons/cms_SiteStructure.gif',
            'pages'=>Array(
                'bot_class_list' => Array('Шаблоны ботов', 512),
                //'bot_slots_list'=>Array('Слоты ботов', 2), 
                'bot_list' => Array('Список ботов', 1024),
                'bot_koef' => Array('Коэффициент уровня ботов', 1024),
                'bot_game_add' => Array('Добавление в игру', 1),
                'dumper' => Array('Бекап', 1),
            )
        ),
        
        'world'=>Array(
            'name' => 'Карта мира',
            'icon'=>'images/cms_icons/cms_SystemSettings.gif',
            'pages'=>Array(
                'world_map' => Array('Общая карта', 2048),
                'bot_map' => Array('Карта ботов', 4096),
                'resource_group_map' => Array('Карта ресурсов', 8192),
                //'tree_map'=>Array('Карта деревьев', 8192),
                'world_map_zone_list' => Array('Зоны', 1),
                'world_map_object_list' => Array('Объекты', 1),
                'world_map_config' => Array('Конфиг', 1),
                'world_map_upload' => Array('Загрузка и обновление', 1),
            )
        ),
        
        'forts'=>Array(
            'name' => 'Замки',
            'icon'=>'images/cms_icons/cms_SystemSettings.gif',
            'pages'=>Array(
                'fort_list' => Array('Замки', 1),
                'fort_class_list' => Array('Классы замков', 1),
                'fort_service_list' => Array('Сервисы', 1),
                'fort_service_class_list' => Array('Классы сервисов', 1),
            )
        ),
        
        'bank'=>Array(
            'name' => 'Банки',
            'icon'=>'images/cms_icons/cms_SystemSettings.gif',
            'pages'=>Array(
                'bank_list' => Array('Список банков', 1),
                'bank_branch_list' => Array('Список отделений', 1),
            )
        ),
        
        'mine'=>Array(
            'name' => 'Шахты',
            'icon'=>'images/cms_icons/cms_SystemSettings.gif',
            'pages'=>Array(
                'mine_list' => Array('Список шахт', 32768),
            )
        ),
        
        'forum'=>Array(
            'name' => 'Форум',
            'icon'=>'images/cms_icons/cms_SystemSettings.gif',
            'pages'=>Array(
                'forum_list'=>Array('Forum', 2), 
            )
        ),
        
        'other'=>Array(
            'name' => 'Прочее',
            'icon'=>'images/cms_icons/cms_SystemSettings.gif',
            'pages'=>Array(
                'faq_list'=>Array('FAQ', 2),
                'log_analyzer' => Array('Анализ логов', 2),
                'payments' => Array('Оплаты', 65536),
                'curs' => Array('Дилер', 65536),
                'player-actions' => Array('Логи Персонажа', 65536),
            )
        ),
        
       
    ); 
    
    
}

function buildMenu() {
    GLOBAL $CUser;
    
    $menu = GetMenuArray();
    
    $menu_html='<table width="175"   cellpadding="0" cellspacing="0">
            <tbody>
              ';
    foreach($menu as $section=>$prop)
    {
        $shtml = '<tr>
                <td width="1%"><img src="'.$prop['icon'].'" width="18" height="18" hspace="3" title="'.$prop['name'].'" /></td>
                <td nowrap="nowrap" class="cms_liner"><a href="#" class="cms_menu1" title="'.$prop['name'].'" onclick="menuClick(\''.$section.'\')" >'.$prop['name'].'</a></td>
              </tr>
              <tr>
                <td></td>
                <td align="left" nowrap="nowrap">
                    <div id="div_'.$section.'" '.(isset($_COOKIE) && isset($_COOKIE['menu_'.$section]) && $_COOKIE['menu_'.$section]=='Y'?'style="display: none;"':'').' >
                    <ul>';
              
        $i = 0;
        $phtml = '';
        foreach($prop['pages'] as $page=>$opt)
        {
            if ($opt[1]=='' || userHasPermission($opt[1]))
            {
                $i++;
                $phtml.= '<li><a href="'.$page.'.php'.($section=='stats'?"?set_default=Y":"").'" title="'.$opt[0].'"><img src="images/dotgreen.gif" width="3" height="3" hspace="5" vspace="2" />'.$opt[0].'</a></li>';
            }
        }
        
        if ($i>0)
        $menu_html.= $shtml.$phtml.'</ul></div></td>
              </tr>';
    }
    $menu_html.='</tbody>
          </table><br /><br />
          ';
    
    return $menu_html;
}

echo buildMenu();

