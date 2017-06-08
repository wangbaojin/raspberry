<?php
        $orderid=$_GET['orderid'];
        $appid='wx95e15975233070a9';//主公众号id
        $mch_id=1303065401;//主商户id
        $device_info="WEB";
        $package="Sign=WXPay";
        $body= '养鸡管家';
        $key='3825ff906d74e7f502a300766d6173c8';
        //var_dump($_GET);
        $total_fee=$_GET['total_fee'];//金额
        $prepay_id=getprepay_id($total_fee,$orderid);
        //echo $prepay_id;
        $sign_1="appid=wx95e15975233070a9&noncestr=md5(time() . mt_rand(0,1000))&package=$package&partnerid=1303065401&prepayid=$prepay_id&timestamp=time()"; 
        $sign_2="$sign_1&key=3825ff906d74e7f502a300766d6173c8";
        $sign=strtoupper(md5($sign_2));
        $response_arr = array('appid'=>$appid,'noncestr'=>md5(time() . mt_rand(0,1000)),'package'=>'Sign=WXPay','partnerid'=>$mch_id,'prepayid'=>$prepay_id,'timestamp'=>time(),'sign'=>$sign);
        $response_json= json_encode($response_arr);
        echo $response_json;

    function getprepay_id($total_fee,$orderid){

        $nonce_str=createNonceStr();
        $out_trade_no=$orderid;
        $stringA="appid=wx95e15975233070a9&attach=支付测试&body=点餐支付&device_info=WEB&mch_id=1303065401&nonce_str=".$nonce_str."&notify_url=http://www.weixin.qq.com/wxpay/pay.php&out_trade_no=".$out_trade_no."&spbill_create_ip=14.23.150.211&total_fee=".$total_fee."&trade_type=APP"; 
        $sign=strtoupper(md5($stringA."&key=3825ff906d74e7f502a300766d6173c8"));
        $URL="https://api.mch.weixin.qq.com/pay/unifiedorder";
         $post_data="<xml>
            <appid>wx95e15975233070a9</appid>
            <attach>养鸡管家</attach>
            <body>养鸡管家</body>
            <device_info>WEB</device_info>
            <mch_id>1303065401</mch_id>
            <nonce_str>".$nonce_str."</nonce_str>
            <notify_url>http://www.weixin.qq.com/wxpay/pay.php</notify_url>
            <out_trade_no>".$out_trade_no."</out_trade_no>
            <spbill_create_ip>14.23.150.211</spbill_create_ip>
            <total_fee>".$total_fee."</total_fee>
            <trade_type>APP</trade_type>
            <sign>".$sign."</sign>
        </xml>";



     if ( !extension_loaded('curl') ) {
     trigger_error("You need cURL loaded to use this class", E_USER_ERROR);}
     else{

              $header[] = "Content-type: text/xml";      //定义content-type为xml,注意是数组
              $ch = curl_init ($URL);
              curl_setopt($ch, CURLOPT_URL, $URL);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
              curl_setopt($ch, CURLOPT_HTTPHEADER,$header); //防止出现验证错误
              curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
              curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
              curl_setopt($ch, CURLOPT_POST, 1);
              curl_setopt($ch,CURLOPT_POSTFIELDS, $post_data);
              $response = curl_exec($ch);
              //var_dump($response);
              $xml= simplexml_load_string($response);
               echo    $prepay_id= $xml->prepay_id;
             // echo $URL=$xml->code_url;
              curl_close($ch);
     }
     return $prepay_id;
    }



   function createNonceStr($length = 16) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
  }





?>
