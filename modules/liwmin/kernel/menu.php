<?php

function GetMenuArray()
{
  return  Array(
       'users'=>Array(
            'name'=>'������������',
            'icon'=>'images/cms_icons/cms_UsersManagement.gif',
            'pages'=>Array(
                'user_list'=>Array('������ �������������', 1),
                'report'=>Array('����� �� ����������', 1),
                'mass_message_list'=>Array('�������� ���������', 1),
				'sendmail_list'=>Array('�������� ���������', 1),
                'service_list'=>Array('������� �������', 1),
                'smile_collection_list'=>Array('������ �������', 1),
                'present_category_list'=>Array('��������� ��������', 131072),
                'present_list'=>Array('�������', 131072),
            )
        ),
        'quest'=>Array(
            'name'=>'������',
            'icon'=>'images/cms_icons/cms_SystemSettings.gif',
            'pages'=>Array(
                'quest_group_list'=>Array('��������� �������', 2),
                'quest_list'=>Array('������', 2),
                'quest_image_list'=>Array('�������� �������', 2),
                'place_list'=>Array('�����', 16384),
                'labyrinth_list'=>Array('���������', 8),
                'labyrinth_schedule'=>Array('���������� ����������', 1),
            )
        ),
        
        'tools'=>Array(
            'name'=>'�������',
            'icon'=>'images/cms_icons/cms_SiteStructure.gif',
            'pages'=>Array(
                'ability_list'=>Array('������', 1),
                'resource_type_list'=>Array('���� ��������', 1),
                'resource_group_list'=>Array('������ ��������', 32),
                'resource_list'=>Array('�������', 32),
                'item_list'=>Array('�����������', 64),
                'recipe_list'=>Array('�������', 128),
            )
        ),
        
        'weapons'=>Array(
            'name'=>'������',
            'icon'=>'images/cms_icons/cms_SiteStructure.gif',
            'pages'=>Array(
                'attack_list'=>Array('������ ������', 1), 
                'weapon_list'=>Array('������ ������', 256), 
                'weapon_category_list'=>Array('��������� ������', 1),
                'weapon_property_list'=>Array('��������� ������', 1),
                'dealers_custom_item_list'=>Array('����������� ���� �������', 262144),
            )
        ),
        
        'bots'=>Array(
            'name'=>'����',
            'icon'=>'images/cms_icons/cms_SiteStructure.gif',
            'pages'=>Array(
                'bot_class_list'=>Array('������� �����', 512), 
                //'bot_slots_list'=>Array('����� �����', 2), 
                'bot_list'=>Array('������ �����', 1024), 
                'bot_koef'=>Array('����������� ������ �����', 1024), 
                'bot_game_add'=>Array('���������� � ����', 1), 
                'fight_statistics'=>Array('������������� � ����', 1), 
            )
        ),
        
        'world'=>Array(
            'name'=>'����� ����',
            'icon'=>'images/cms_icons/cms_SystemSettings.gif',
            'pages'=>Array(
                'world_map'=>Array('����� �����', 2048), 
                'bot_map'=>Array('����� �����', 4096), 
                'resource_group_map'=>Array('����� ��������', 8192), 
                //'tree_map'=>Array('����� ��������', 8192),
                'world_map_zone_list'=>Array('����', 1), 
                'world_map_object_list'=>Array('�������', 1), 
                'world_map_config'=>Array('������', 1), 
                'world_map_upload'=>Array('�������� � ����������', 1), 
            )
        ),
        
        'forts'=>Array(
            'name'=>'�����',
            'icon'=>'images/cms_icons/cms_SystemSettings.gif',
            'pages'=>Array(
                'fort_list'=>Array('�����', 1), 
                'fort_class_list'=>Array('������ ������', 1), 
                'fort_service_list'=>Array('�������', 1), 
                'fort_service_class_list'=>Array('������ ��������', 1), 
            )
        ),
        
        'bank'=>Array(
            'name'=>'�����',
            'icon'=>'images/cms_icons/cms_SystemSettings.gif',
            'pages'=>Array(
                'bank_list'=>Array('������ ������', 1), 
                'bank_branch_list'=>Array('������ ���������', 1), 
            )
        ),
        
        'mine'=>Array(
            'name'=>'�����',
            'icon'=>'images/cms_icons/cms_SystemSettings.gif',
            'pages'=>Array(
                'mine_list'=>Array('������ ����', 32768), 
            )
        ),
        
        'forum'=>Array(
            'name'=>'�����',
            'icon'=>'images/cms_icons/cms_SystemSettings.gif',
            'pages'=>Array(
                'forum_list'=>Array('Forum', 2), 
            )
        ),
        
        'other'=>Array(
            'name'=>'������',
            'icon'=>'images/cms_icons/cms_SystemSettings.gif',
            'pages'=>Array(
                'faq_list'=>Array('FAQ', 2), 
                'log_analyzer'=>Array('������ �����', 2), 
                'payments'=>Array('������', 65536), 
                 'payments_dd_dnv'=>Array('��� ������� (DNV)', 65536), 
                'payments_dd_usd'=>Array('��� ������� (USD)', 65536), 
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

?>