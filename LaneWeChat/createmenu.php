<?php
include 'lanewechat.php';
//设置菜单
$menuList = array(
    array('id'=>'1', 'pid'=>'',  'name'=>'我的管家', 'type'=>'', 'code'=>'key_1'),
    array('id'=>'2', 'pid'=>'1',  'name'=>'申请成为管家', 'type'=>'view', 'code'=>'http://form.mikecrm.com/NPyyic'),
    array('id'=>'3', 'pid'=>'1',  'name'=>'管家登录', 'type'=>'view', 'code'=>'http://weixin.yangjiguanjia.com/LaneWeChat/yangjiguanjia/keeper/login.php'),
    array('id'=>'4', 'pid'=>'',  'name'=>'软件下载', 'type'=>'view', 'code'=>'http://a.app.qq.com/o/simple.jsp?pkgname=org.shengchuan.yjgj'),
    array('id'=>'5', 'pid'=>'', 'name'=>'保险验标', 'type'=>'view', 'code'=>'https://m1.huoban.com/app_share/form/create_item?encrypt_app_id=002315ef6aa21d4f5983922090892116'),
);
\LaneWeChat\Core\Menu::setMenu($menuList);
