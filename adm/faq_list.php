<?php

require('kernel/before.php');

if (!userHasPermission(2)) {
    header('Location: index.php');
    die();
}


$query = 'select * from faq_pages order by sort_order asc';

$pages = 'd = new dTree(\'d\'); d.add(0,-1,\'FAQ\');';
$res = mysqli_query($GLOBALS['db_link'], $query, $db);
while ($row = mysqli_fetch_assoc($res))
{
    $pages .= 'd.add('.$row['page_id'].','.(isset($row['parent_page_id'])?$row['parent_page_id']:'0').',\''.$row['title'].'\',\'faq_edit.php?page_id='.$row['page_id'].'\');';
    /*
        d.add(6,5,'Node 1.1.1.1','example01.html');
        d.add(7,0,'Node 4','example01.html');
        d.add(8,1,'Node 1.2','example01.html');
        d.add(9,0,'My Pictures','example01.html','Pictures I\'ve taken over the years','','','img/imgfolder.gif');
        d.add(10,9,'The trip to Iceland','example01.html','Pictures of Gullfoss and Geysir');
        d.add(11,9,'Mom\'s birthday','example01.html');
        d.add(12,0,'Recycle Bin','example01.html','','','img/trash.gif');
    */
}
$pages .= 'document.write(d);';

$_SESSION['pages']['bot_list'] = $_SERVER['REQUEST_URI'];

?>
<h3>FAQ</h3>
<script type="text/javascript" src="jscript/dtree.js"></script>
<style>
.dtree {
    font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
    font-size: 11px;
    color: #666;
    white-space: nowrap;
}
.dtree img {
    border: 0px;
    vertical-align: middle;
}
.dtree a {
    color: #333;
    text-decoration: none;
}
.dtree a.node, .dtree a.nodeSel {
    white-space: nowrap;
    padding: 1px 2px 1px 2px;
}
.dtree a.node:hover, .dtree a.nodeSel:hover {
    color: #333;
    text-decoration: underline;
}
.dtree a.nodeSel {
    background-color: #c0d2ec;
}
.dtree .clip {
    overflow: hidden;
}
</style>

<div id="results">
    <script language="javascript">
        <?=$pages?>
    </script>
</div>
 
<br />
    <img src="images/cms_icons/cms_add.gif" alt="Добавить бота"/><a href="faq_edit.php" title="Добавить страницу">Добавить
    страницу</a> &nbsp;
<br />

<? require('kernel/after.php'); ?>