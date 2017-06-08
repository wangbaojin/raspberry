<?php
include 'lanewechat.php';
//设置菜单
$menuList = array(
    array('id'=>'1', 'pid'=>'',  'name'=>'warbox', 'type'=>'view', 'code'=>'http://weixin.yangjiguanjia.com/warbox/warbox/warbox.html'),
    array('id'=>'2', 'pid'=>'',  'name'=>'红包约战', 'type'=>'view', 'code'=>'http://weixin.yangjiguanjia.com/warbox/wxpay/example/jsapi.php'),
    array('id'=>'3', 'pid'=>'',  'name'=>'个人中心', 'type'=>'view', 'code'=>'http://weixin.yangjiguanjia.com/warbox/warbox/warbox.html'),
    //array('id'=>'4', 'pid'=>'',  'name'=>'软件下载的','type'=>'view', 'code'=>'http://a.app.qq.com/o/simple.jsp?pkgname=org.shengchuan.yjgj'),
   // array('id'=>'5', 'pid'=>'', 'name'=>'保险验标', 'type'=>'view', 'code'=>'https://m1.huoban.com/app_share/form/create_item?encrypt_app_id=002315ef6aa21d4f5983922090892116'),
);
\LaneWeChat\Core\Menu::setMenu($menuList);
