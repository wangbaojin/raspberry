<?php
include 'lanewechat.php';
//设置菜单
$menuList = array(
    array('id'=>'1', 'pid'=>'',  'name'=>'订购', 'type'=>'view', 'code'=>'https://weidian.com/?userid=982057465&wfr=wx'),
    array('id'=>'2', 'pid'=>'',  'name'=>'福蛋到家', 'type'=>'view', 'code'=>'http://weixin.yangjiguanjia.com/LaneWeChat2/kuailededan/spread_happyegg/create_wish.php'),
    array('id'=>'3', 'pid'=>'',  'name'=>'新春送礼', 'type'=>'view', 'code'=>'http://weixin.yangjiguanjia.com/LaneWeChat2/kuailededan/send_happyegg/buy_egg.html'),

);
\LaneWeChat\Core\Menu::setMenu($menuList);
