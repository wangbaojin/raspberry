<?php
include 'lanewechat.php';
//设置菜单
$menuList = array(
    array('id'=>'1', 'pid'=>'',  'name'=>'订购', 'type'=>'view', 'code'=>'https://weidian.com/?userid=982057465&wfr=wx'),
    array('id'=>'2', 'pid'=>'',  'name'=>'蛋.生活', 'type'=>'view', 'code'=>'www.yangjiguanjia.com'),
    array('id'=>'3', 'pid'=>'',  'name'=>'撩.蛋', 'type'=>'view', 'code'=>'www.yangjiguanjia.com'),

);
\LaneWeChat\Core\Menu::setMenu($menuList);
