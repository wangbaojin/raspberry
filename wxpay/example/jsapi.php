<?php 
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
$input->SetBody("保险/商品订单");
$input->SetAttach("绑铭农信");
$input->SetOut_trade_no($_GET['order_sn']);
$input->SetTotal_fee($_GET['total_fee']*100);
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetGoods_tag("WXG");
$input->SetNotify_url("http://pay.yangjiguanjia.com/wxpay/example/notify.php");
$input->SetTrade_type("JSAPI");
$input->SetOpenid($openId);
$order = WxPayApi::unifiedOrder($input);
//echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
//printf_info($order);
$jsApiParameters = $tools->GetJsApiParameters($order);

//获取共享收货地址js函数参数
$editAddress = $tools->GetEditAddressParameters();

//③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
/**
 * 注意：
 * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
 * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
 * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
 */
?>

<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<meta name = "format-detection" content = "telephone=no">
	<title>确认订单</title>
	<script src="assets/js/rem.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/reset.css"/>
	<style type="text/css">
			header{width: 100%;height: 1.2rem;border: 1px solid #e5e5e5;overflow: hidden;position: relative;background: white;}
			header p{text-align: center;padding-top:.28rem;font-size: .26rem;color: #808080;width: 100%;}
			.clock{text-align: center;width: 100%;font-size: 0;}
			.clock span{display: inline-block;width: .26rem;height: .32rem;background: #333333;
			font-size: .3rem;color: white;text-align: center;line-height: .32rem;}
			.clock .center{color: black;font-size: .3rem;text-align: center;line-height:.32rem;
			width: .26rem;height: .32rem;background: white;}
			.ge{margin-left: .1rem;}
			.bai{margin-left: .1rem;}
			.duoduo img{display: block;width: .7rem;}
			.duoduo{position: absolute;left: 2.12rem;top: .32rem;}
			
			section{overflow: hidden;}
			section .orderInfo{width: 100%;height: 1.8rem;border-bottom: 1px solid #e5e5e5;background: #fcfcfc;box-sizing: border-box;overflow: hidden;}
			dl{overflow: hidden;margin: .4rem 0 0 .3rem;}
			dl dt{float: left;}
			dl dt img{width: 1rem;display: block;height: 1rem;border-radius: .01rem;display: none;}
			dl dd{margin-left: .2rem;font-size: .4rem;color: #fe3057;float: left;}
			dl .orderNum{font-size: .28rem;color: #808080;margin-top: .1rem;}
			
			section .wx{width: 100%;height: 1rem;border-top:1px solid #e5e5e5;border-bottom: 1px solid #e5e5e5;
			padding: 0 .3rem;overflow: hidden;box-sizing: border-box;background: white;margin-top: .2rem;}
			.wx .left{float: left;font-size: .32rem;color: #808080;line-height: 1rem;}
			.left img{width: .5rem;margin-top: .3rem;display: inline-block;}
			.left .txt{margin-left: .2rem;}
			.wx .right{float: right;}
			.right img{width: .36rem;margin-top: .3rem;}
			
			section .thank{margin-top: .5rem;font-size: .24rem;color: #77aaf0;margin-left: .3rem;}			
		
			.btn{width: 100%;height: 1rem;box-sizing: border-box;border-bottom: 1px solid #e5e5e5;border-top: 1px solid #e5e5e5;
			text-align: center;line-height: 1rem;color: #fec627;background: white;position: absolute;bottom: 0;font-size: .34rem;}
	</style>
</head>
<body>
    <!--<br/>
    <font color="#9ACD32"><b>该笔订单支付金额为<span style="color:#f00;font-size:50px">1分</span>钱</b></font><br/><br/>
	<div align="center">
		<button style="width:210px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;" type="button" onclick="callpay()" >立即支付</button>
	</div>-->
		<header>
			<p>支付剩余时间</p>
			<div class="clock">
				<span class="qian">1</span>
				<span class="bai">5</span>
				<span class="center">:</span>
				<span class="shi">0</span>
				<span class="ge">0</span>
			</div>
			<div class="duoduo"><img src="assets/img/duoduo.png"/></div>
		</header>
		<section>
			<div class="orderInfo">
				<dl>
					<dt>
						<img src="assets/img/yuhunliao.jpg" class="yuhunliao"/>
						<img src="assets/img/baoxian.jpg" class="baoxian"/>
					</dt>
					<dd>
						<p>¥<span class="price"></span></p>
						<p class="orderNum">订单号: <span class="num"></span></p>
					</dd>
					
				</dl>
			</div>
			<div class="wx">
				<div class="left">
					<span class="wxLogo"><img src="assets/img/wxPay.png"/></span><span class="txt">微信支付</span>
				</div>
				<div class="right">
					<img src="assets/img/choose.png"/>
				</div>
			</div>
			<p class="thank">* 感谢您在养鸡管家购物，欢迎再次光临</p>
		</section>
		<div class="btn"  onclick="callpay()">确认支付</div>
		<script src="assets/js/zepto.min.js" type="text/javascript" charset="utf-8"></script>
		<!--<script src="assets/js/zepto.tap.js" type="text/javascript" charset="utf-8"></script>-->
	    <script type="text/javascript">
   			var ge=0;
			var shi=0;
			var bai=5;
			var qian=1;
			if(<?php echo $_GET['goods_type']; ?>==1){
				$(".baoxian").css("display","block")
			}else{
				$(".yuhunliao").css("display","block")
			}
			$(".price").html("<?php echo $_GET['total_fee']; ?>");
			$(".num").html("<?php echo $_GET['order_sn']; ?>")
			clearInterval(time);
			var time=setInterval(function(){
			
				ge--;
				if(ge<0){
					shi--;
					ge=9	
					if(shi<0){
						bai--;
						shi=5
						if(bai<0){
							qian--;
							bai=9
							
						}
					}
				}
				$(".ge").html(ge);
				$(".shi").html(shi);
				$(".bai").html(bai);
				$(".qian").html(qian);
				if(ge==0&&shi==0&bai==0&qian==0){
					clearInterval(time)
				}
			},1000)
	//调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			<?php echo $jsApiParameters; ?>,
			//回调
                        function(res){
                                  
				WeixinJSBridge.log(res.err_msg);
                                /*if(res.err_msg == "get_brand_wcpay_request:ok")                                  {   

                                   location.href="http://www.yangjiguanjia.com/Keeper";
                                 }else{   

                                     location.href="default.aspx?n=payment&action=error";
                                 }*/  
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
	<!--<script type="text/javascript">
	//获取共享地址
	function editAddress()
	{
		WeixinJSBridge.invoke(
			'editAddress',
			<?php echo $editAddress; ?>,
			function(res){
				var value1 = res.proviceFirstStageName;
				var value2 = res.addressCitySecondStageName;
				var value3 = res.addressCountiesThirdStageName;
				var value4 = res.addressDetailInfo;
				var tel = res.telNumber;
				
				alert(value1 + value2 + value3 + value4 + ":" + tel);
			}
		);
	}
	
	window.onload = function(){
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', editAddress, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', editAddress); 
		        document.attachEvent('onWeixinJSBridgeReady', editAddress);
		    }
		}else{
			editAddress();
		}
	};
	
	</script>-->
</body>
</html>
