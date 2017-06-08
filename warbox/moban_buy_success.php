<?php
        include 'lanewechat.php';
        date_default_timezone_set('PRC');  
        $data = array(
             'name'=>array('value'=>$_GET['amount']."份".$_GET['unit_price']."元快乐的蛋", 'color'=>'#0A0A0A'),
             'remark'=>array('value'=>'点击详情页并将其分享给好友，5分钟内可以点击详情收回礼品哦', 'color'=>'#173177')
        );

        //$touser 接收方的OpenId。
        //$templateId 模板Id。在公众平台线上模板库中选用模板获得ID
        //$url URL 点击查看的时候跳转到URL。
        //$topcolor 顶部颜色，可以为空。默认是红色
        $touser = $_GET['open_id'];
        $templateId = "Vp2AJxqGisKLZAdIn6ad2sSz6tdf_iaxZETxIRMKrDE";
        $url = "http://weixin.yangjiguanjia.com/LaneWeChat/yangjiguanjia/send_happyegg/share_egg.php?order_sn=".$_GET['order_sn'];
        \LaneWeChat\Core\TemplateMessage::sendTemplateMessage($data, $touser, $templateId, $url, $topcolor='#FF0000');

