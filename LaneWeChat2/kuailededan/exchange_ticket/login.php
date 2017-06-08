<?php


   include "../../lanewechat.php"; 
   $b = $_GET['num'];
   $redirect_uri = 'LaneWeChat2/kuailededan/exchange_ticket/login.php';
   \LaneWeChat\Core\WeChatOAuth::getCode($redirect_uri, $b, $scope='snsapi_userinfo');
   $code = $_GET['code'];
   $a = \LaneWeChat\Core\WeChatOAuth::getAccessTokenAndOpenId($code);
   $user_info = \LaneWeChat\Core\WeChatOAuth::getUserInfo($a['access_token'],$a['openid'],$lang='zh_CN'); 
   $order_sn = $_GET['state'];
     

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

			body{background-color: #e5eef2;}
			.banner{width: 100%;height: auto;}
			.common_form{height: 0.8rem;padding: 0.1rem 0.2rem;}
			.icon{height: 0.48rem;}
			.mr{margin-right: 0.18rem;}
			.weui-cell:before{border-top: 1px solid #e5e5e5;}
			.weui-cells{font-size: 0.34rem;}
			.fontcolor{color:#353535;}

		</style>
	</head>
	<body>
	
		<div id="app">

			<img class="banner" src="assets/img/ex_banner.png" alt="">
			<div style="margin-top: 0.4rem;" class="weui-cells weui-cells_form">
	            <div class="weui-cell common_form" id="">
	                <div class="weui-cell__hd mr"><img class="icon" src="assets/img/card.png" alt=""></div>
	                <div class="weui-cell__bd">
	                    <!-- <span class="num">{{num}}</span> -->
	                    <input class="weui-input fontcolor" v-model="num" type="number" placeholder="请输入卡号">
	                </div>
	            </div>
	            <div class="weui-cell common_form" id="">
	                <div class="weui-cell__hd mr"><img class="icon" src="assets/img/code.png" alt=""></div>
	                <div class="weui-cell__bd">
	                    <input class="weui-input fontcolor" v-model="password" type="number" pattern="[0-9]*" placeholder="请输入卡券密码">
	                </div>
	            </div>
	            <div class="weui-cell common_form" id="">
		            <div class="weui-cell__hd mr"><img class="icon" src="assets/img/number.png" alt=""></div>
	                <div class="weui-cell__bd">
	                    <input class="weui-input fontcolor" v-model="yzcode" type="tel" placeholder="请输入验证码">
	                    <img @click="change_img" style="height:0.9rem;position: absolute;top: 0;right: 0;" v-bind:src="yz_img">

	                </div>
	            </div>
	        </div>
	        <div class="button-sp-area">

	        		<img @click="exchange" style="width: 6.9rem;margin:0.4rem auto 0.2rem;" src="assets/img/button.png" alt="">
	        		<p style="font-size: 0.22rem;color: #888;margin-left: 0.3rem;">*输入卡券仅代表验证，提交订单才会致卡券被使用</p>
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
			     password:"",
			     yzcode:"",
			     yz_img:"http://weixin.yangjiguanjia.com/deliveryLogGetVerify",
			     card_tp:""

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

			  		}else if(_this.yzcode==""){
			  			alert("请输入验证码")
			  			return
			  		}
			  		 this.$http.post(validate.url+"/deliveryLogCheckCard",{card_no:_this.num,card_pw:_this.password,open_id:"<?php echo $a['openid']; ?>"},{emulateJSON:true}).then(
			              function (res) {
			                 if(res.body.code==1){
			                 		_this.card_tp=res.body.result.card_tp;
									_this.$http.post(validate.url+"/deliveryLogCheck_verify",{code:_this.yzcode},{emulateJSON:true}).then(
											function(res){
												if(res.body.code==1){
													localStorage.setItem("exchange_info",JSON.stringify({"order_sn":_this.num,"card_tp":_this.card_tp,"nick_name":"<?php echo $user_info['nickname'];?>","pic":"<?php echo $user_info['headimgurl']; ?>"}))
			                  							location.href="write_info.php"
												}else{
													alert("验证码错误")
												}
											}
										)
			                  }else{
			                  		alert(res.body.error)
			                  }
			                
			              },function (res){
			              		// 处理失败的结果
			             	 	alert("请求失败!")
			              }
			        )
			  	},
			  	change_img:function(){
			  		this.yz_img="http://weixin.yangjiguanjia.com/deliveryLogGetVerify"+Math.random();
			  	}
			  },
			   created:function(){
			   	this.num="<?php echo $order_sn;?>"
			   }

			})
		</script>
	</body>
</html>

