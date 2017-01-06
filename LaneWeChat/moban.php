<?php
        include 'lanewechat.php';

        $data = array(
             'first'=>array('value'=>'您好，您送出的快乐的蛋1920一份成功领取', 'color'=>'#0A0A0A'),
             'keyword1'=>array('value'=>'邓星', 'color'=>'#CCCCCC'),
             'keyword2'=>array('value'=>'1920元快乐的蛋一份', 'color'=>'#CCCCCC'),
             'keyword3'=>array('value'=>'2017年1月6日', 'color'=>'#CCCCCC'),
             'remark'=>array('value'=>'请及时确认，15分钟内可以点击详情收回礼品哦', 'color'=>'#173177')
        );

        //$touser 接收方的OpenId。
        //$templateId 模板Id。在公众平台线上模板库中选用模板获得ID
        //$url URL 点击查看的时候跳转到URL。
        //$topcolor 顶部颜色，可以为空。默认是红色
        $touser = "oQUJpvzcHlw2lzghUpuMIv92S06k";
        $templateId = "S7cNdtiV2EfwhQK_UPisTlNESry0Qp9JVlFQ9hV66SI";
        $url = "http://www.yangjiguanjia.com";
        \LaneWeChat\Core\TemplateMessage::sendTemplateMessage($data, $touser, $templateId, $url, $topcolor='#FF0000');

