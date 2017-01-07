<?php
include 'lanewechat.php';

$sign = \LaneWeChat\Core\GetSignPackage::getSignPackage("http://weixin.yangjiguanjia.com/LaneWeChat/yangjiguanjia/send_happyegg/share_egg.html");
var_dump($sign); 
