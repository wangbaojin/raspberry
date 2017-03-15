<?php

   include "../../lanewechat.php";
   $redirect_uri = 'LaneWeChat2/kuailededan/exchange_ticket/login.php';
   \LaneWeChat\Core\WeChatOAuth::getCode($redirect_uri, $state=1, $scope='snsapi_base');
   $code = $_GET['code'];
   $a = \LaneWeChat\Core\WeChatOAuth::getAccessTokenAndOpenId($code);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
		<meta name="apple-touch-fullscreen" content="YES" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<meta name = "format-detection" content = "telephone=no">
		<title>快乐的蛋－兑换</title>
		<script src="assets/js/rem.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" type="text/css" href="assets/css/reset.css"/>
		<link rel="stylesheet" type="text/css" href="https://res.wx.qq.com/open/libs/weui/1.1.0/weui.min.css"/>
		<style type="text/css">
			
		</style>
	</head>
	<body>
	
		<div id="app">
			<div class="weui-cells__title" style="margin-top: 30px;">快乐的蛋卡劵兑换</div>
			<div class="weui-cells weui-cells_form">
	            <div class="weui-cell" id="">
	                <div class="weui-cell__hd"><label class="weui-label">卡号</label></div>
	                <div class="weui-cell__bd">
	                    <span class="num">{{num}}</span>
	                </div>
	            </div>
	            <div class="weui-cell" id="">
	                <div class="weui-cell__hd"><label class="weui-label">密码</label></div>
	                <div class="weui-cell__bd">
	                    <input class="weui-input" v-model="password" type="number" pattern="[0-9]*" placeholder="请输入兑换码">
	                </div>
	            </div>
	        </div>
	        <div class="button-sp-area">
	        		<a style="width: 70%;margin-top: 30px;" href="javascript:void(0);" id="create" class="weui-btn weui-btn_plain-primary" @click="exchange">兑换</a>
			</div>
			<div class="weui-footer weui-footer_fixed-bottom">
	            <p class="weui-footer__links">
	                <a href="http://www.yangjiguanjia.com" class="weui-footer__link">邦铭农信科技(北京)有限公司</a>
	            </p>
	            <p class="weui-footer__text">Copyright &copy; 2016-2017  </p>
	        </div>
	    </div>
		<script src="assets/js/vue.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="assets/js/vue-resource.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="assets/js/commom.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			var app = new Vue({
			  el: '#app',
			  data: {
			     num:"您的卡劵卡号",
			     password:""
			  },
			  methods:{
			  	
			  	exchange:function(){
			  		var _this=this;
	         		if(_this.num==""){
			  			alert("您的卡号不正确")
			  			return
			  		}else if(_this.password==""){
			  			alert("请输入密码")
			  			return
			  		}
			  		this.$http.post(validate.url+"/Api/DeliveryLog/checkCard",{card_no:_this.num,card_pw:_this.password,open_id:"<?php echo $a['openid']; ?>"},{emulateJSON:true}).then(
			            function (res) {
			                if(res.body.code==1){
			                		localStorage.setItem("exchange_info",JSON.stringify({"order_sn":_this.nun,"password":_this.password,open_id:"<?php echo $a['openid']; ?>"}))
			                		alert(res.body.msg);
			                		location.href="write_info.php"
			                }else{
			                		alert(res.body.msg)
			                }
			                
			            },function (res){
			            		// 处理失败的结果
			           	 	alert("请求失败!")
			            }
			        )
			  	}
			  },
			  created:function(){
			  	var _this=this,url=location.href;
			  	_this.num=url.split("num=")[1]
			  }
			})
		</script>
	</body>
</html>

