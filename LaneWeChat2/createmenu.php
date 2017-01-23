<?php
include 'lanewechat.php';
//设置菜单
$menuList = array(
    array('id'=>'1', 'pid'=>'',  'name'=>'订购', 'type'=>'view', 'code'=>'https://weidian.com/?userid=982057465&wfr=wx'),
    array('id'=>'2', 'pid'=>'',  'name'=>'鸡蛋常识', 'type'=>'', 'code'=>'key_1'),
    array('id'=>'3', 'pid'=>'2',  'name'=>'15天的蛋还能吃吗', 'type'=>'view', 'code'=>'http://mp.weixin.qq.com/s?__biz=MzIwNjU1MTA4MQ==&mid=2247483721&idx=2&sn=01d3f95957b22652d130a6b5d5252653&scene=18#wechat_redirect'),
    array('id'=>'4', 'pid'=>'2',  'name'=>'藏在鸡蛋里的杀手', 'type'=>'view', 'code'=>'http://mp.weixin.qq.com/s?__biz=MzIwNjU1MTA4MQ==&mid=2247483721&idx=3&sn=83b892c1bb6ecc3e93f73572a4c31c99&scene=18#wechat_redirect'),
    array('id'=>'5', 'pid'=>'',  'name'=>'新春送礼', 'type'=>'view', 'code'=>'http://weixin.yangjiguanjia.com/LaneWeChat2/kuailededan/send_happyegg/buy_egg.html'),

);
\LaneWeChat\Core\Menu::setMenu($menuList);
