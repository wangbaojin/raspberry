<?php
        include 'lanewechat.php';
        date_default_timezone_set('PRC'); 
        $total_price = $_GET['unit_price']*$_GET['amount']; 
        $data = array(
             'first'=>array("亲，您购买的商品支付成功", 'color'=>'#0A0A0A'),
             'keyword1'=>array('value'=>$_GET['unit_price']."元快乐的蛋礼包", 'color'=>'#0A0A0A'),
             'keyword2'=>array('value'=>$_GET['amount']."份", 'color'=>'#0A0A0A'),
             'keyword3'=>array('value'=>$total_price."元", 'color'=>'#0A0A0A'),
	     'keyword4'=>array('value'=>date("Y/m/d H:i",time()), 'color'=>'#0A0A0A'),
	     'keyword5'=>array('value'=>$_GET['order_sn'], 'color'=>'#0A0A0A'),
             'remark'=>array('value'=>'点击详情页并将其分享给好友，5分钟内可以点击详情收回礼品哦', 'color'=>'#173177')
        );

        //$touser 接收方的OpenId。
        //$templateId 模板Id。在公众平台线上模板库中选用模板获得ID
        //$url URL 点击查看的时候跳转到URL。
        //$topcolor 顶部颜色，可以为空。默认是红色
        $touser = $_GET['open_id'];
        $templateId = "pzPeJ2nZZTahw3mjOfLS2Wfg2xwlGBiaM6ZO2GCae58";
        $url = "http://weixin.yangjiguanjia.com/LaneWeChat2/kuailededan/send_happyegg/share_egg.php?order_sn=".$_GET['order_sn'];
        \LaneWeChat\Core\TemplateMessage::sendTemplateMessage($data, $touser, $templateId, $url, $topcolor='#FF0000');

