<?php

/*快乐的蛋过年红包支付*/

ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ERROR);
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require_once 'log.php';

//初始化日志
$logHandler= new CLogFileHandler("../logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);

//打印输出数组信息
function printf_info($data)
{
    foreach($data as $key=>$value){
        echo "<font color='#00ff55;'>$key</font> : $value <br/>";
    }
}

//①、获取用户openid
$tools  = new JsApiPay();
$openId = $tools->GetOpenid();
//②、统一下单
$input = new WxPayUnifiedOrder();
$input->SetBody("商品订单");
$input->SetAttach("快乐的蛋");
$input->SetOut_trade_no($_GET['order_sn']);
$input->SetTotal_fee($_GET['total_fee']*100);
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetGoods_tag("WXG");
$input->SetNotify_url("http://weixin.yangjiguanjia.com/wxpay/example/notify2.php");
$input->SetTrade_type("JSAPI");
$input->SetOpenid($openId);
$order = WxPayApi::unifiedOrder($input);

$jsApiParameters = $tools->GetJsApiParameters($order);

//获取共享收货地址js函数参数
$editAddress = $tools->GetEditAddressParameters();

//php调起微信支付的JS
echo "<script type='text/javascript'>callpay();</script>";

//③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
/**
 * 注意：
 * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
 * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
 * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
 */

?>
<html xmlns="http://www.w3.org/1999/html">
<body>

    <script src="assets/js/zepto.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="assets/js/zepto.tap.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
	//调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			<?php echo $jsApiParameters; ?>,
			//回调
                        function(res){
                                  
				WeixinJSBridge.log(res.err_msg);
                                if(res.err_msg == "get_brand_wcpay_request:ok")                                  {   

                                   location.href="http://weixin.yangjiguanjia.com/LaneWeChat/yangjiguanjia/keeper/orderManage.html";
                                 }else{   

                                     location.href="http://weixin.yangjiguanjia.com/LaneWeChat/yangjiguanjia/keeper/orderManage.html";
                                 }  
				//alert(res.err_code+res.err_desc+res.err_msg);
			}
		);
	}

	function callpay()
	{
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
		        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
		    }
		}else{
		    jsApiCall();
		}
	}
    </script>
</body>
</html>
