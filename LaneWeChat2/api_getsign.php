<?php
include 'lanewechat.php';
$sign = \LaneWeChat\Core\GetSignPackage::getSignPackage($_GET['url']);
echo json_encode($sign); 
