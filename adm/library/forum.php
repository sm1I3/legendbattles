<?php
if (isset($_GET['test']))
{
    
    function frm_get_categ_list(&$arr)
    {
        $arr = array(
            array(1,'Общение','img1'),
            array(2,'Вопросы','img1'),
            array(3,'Разборки','img1'),
            array(4,'FAQ','img1'),
        );
        return ;
    }
    
    function frm_get_forum_list($cat, &$arr)
    {
        $c = array(
            1 => array(
                array(1,'Зачем эта игра','img1', 'описание 1', 1, 2),
                array(2,'Почему играть в эту игру','img2', 'описание 2', 3, 4),
            ),
            2 => array(
                array(3,'Кто кого затроллил','img1', 'описание 1', 1, 2),
                array(4,'Почему меня затроллили','img2', 'описание 2', 3, 4),
            ),
            3 => array(
                array(5,'Убить всех людей','img1', 'описание 1', 1, 2),
                array(6,'игру','img2', 'описание 2', 3, 4),
            ),
            4 => array(
                array(7,'Для МСа','img1', 'описание 1', 1, 2),
                array(8,'Меня забанили памагите!!1!','img2', 'описание 2', 3, 4),
            ),
        );
        $arr = $c[$cat];
    }
    
    function frm_add_categ($name, $img, $priority) { return 1; }
    function frm_edit_categ($id, $name, $img, $priority) { return 1; }
    
    function frm_get_categ_info($id, &$categ)
    {
        $arr = array(
            1 => array('Общение','img1',10),
            2 => array('Вопросы','img1',20),
            3 => array('Разборки','img1',30),
            4 => array('FAQ','img1',40),
        );
        $categ = $arr[$id];
        return ;
    }
    
    function frm_get_forum_info($id, &$forum)
    {
        $c = array(
            1 => array(1,'Зачем эта игра','img1', 'описание 1', 1, 0,0),
            2 => array(1,'Почему играть в эту игру','img2', 'описание 2', 3, 0,1),
            3 => array(2,'Кто кого затроллил','img1', 'описание 1', 1, 1,0),
            4 => array(2,'Почему меня затроллили','img2', 'описание 2',  4,1,1),
            5 => array(3,'Убить всех людей','img1', 'описание 1', 1, 0,0),
            6 => array(3,'игру','img2', 'описание 2', 3, 0,1),
            7 => array(4,'Для МСа','img1', 'описание 1', 1, 1,0),
            8 => array(4,'Меня забанили памагите!!1!','img2', 'описание 2', 3, 1,1),
        );
        $forum = array_merge($c[$id], array(
            10,5,6,100,150,4
        ));
    }
    
    function frm_add_forum()
    {
        return 1;
    }
    
    function frm_edit_forum()
    {
        return 1;
    }
}
?>