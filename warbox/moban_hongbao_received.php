<?php
        include 'lanewechat.php';
        date_default_timezone_set('PRC');  
        $data = array(
             'first'=>array('value'=>'恭喜……成功抢到礼品', 'color'=>'#0A0A0A'),
             'keyword1'=>array('value'=>$_GET['nick_name'], 'color'=>'#173177'),
             'keyword2'=>array('value'=>"一份".$_GET['unit_price']."元快乐的蛋", 'color'=>'#173177'),
             'keyword3'=>array('value'=>date("Y/m/d H:i:s",time()), 'color'=>'#173177'),
             'remark'=>array('value'=>'点击查看商品详情。', 'color'=>'#173177')
        );

        //$touser 接收方的OpenId。
        //$templateId 模板Id。在公众平台线上模板库中选用模板获得ID
        //$url URL 点击查看的时候跳转到URL。
        //$topcolor 顶部颜色，可以为空。默认是红色
        $touser = $_GET['open_id'];
        $templateId = "S7cNdtiV2EfwhQK_UPisTlNESry0Qp9JVlFQ9hV66SI";
        $url = "http://weixin.yangjiguanjia.com/LaneWeChat/yangjiguanjia/send_happyegg/egg_details.php?order_sn=".$_GET['order_sn'];
        \LaneWeChat\Core\TemplateMessage::sendTemplateMessage($data, $touser, $templateId, $url, $topcolor='#FF0000');

