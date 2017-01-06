<?php

   include "../../lanewechat.php";
   $redirect_uri = 'LaneWeChat/yangjiguanjia/send_happyegg/write_info.php';
   \LaneWeChat\Core\WeChatOAuth::getCode($redirect_uri, $state=1, $scope='snsapi_userinfo');
   $code = $_GET['code'];
   $a = \LaneWeChat\Core\WeChatOAuth::getAccessTokenAndOpenId($code);
   $user_info = \LaneWeChat\Core\WeChatOAuth::getUserInfo($a['access_token'],$a['openid'],$lang='zh_CN');
   echo $user_info['nickname'];
   echo $user_info['headimgurl'];
   echo $user_info['openid'];
?>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
		<meta name="apple-touch-fullscreen" content="YES" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<meta name = "format-detection" content = "telephone=no">
		<title>快乐的蛋</title>
		<script src="assets/js/rem.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" type="text/css" href="assets/css/reset.css"/>
		<link rel="stylesheet" type="text/css" href="assets/css/weui.min.css"/>
		<style type="text/css">
			#example-1 li{display: flex;width: 100%;}
			#example-1 span{flex: 1;text-align: center;}
		
	       
		</style>
	</head>
	<body>
		<div id="app">
				<div v-if="active">
					<div id="box" v-bind:class="{  animated: active,fadeOut: active }">
						<p style="font-size: 30px;color: dodgerblue;text-align: center;margin-top: 40%;font-weight: 600;" id="got" v-bind:class="{ animated: active, 'bounceInRight': active }">手速可以啊，小伙子</p>
					</div>
				</div>
				
				<div v-if="show">
					<div class="container" id="container">
				        <div v-bind:class="{ animated: active, 'fadeOutUp': active }"  id="hongbao">
				            <div class="topcontent">
				                <div class="avatar">
				                    <!--<img src="http://placehold.it/80x80" alt="" width="80" height="80">-->
				                    
				                </div>
				                <h2 style="font-size: 26px;color: white;">老王</h2>
				                <span class="text" style="font-size: 22px;">给你发了一个红包</span>
				                <div class="description" style="color:white;font-weight: bold;font-size: 20px;">恭喜发财 大吉大利</div>
				            </div>
				            <div id="chai" v-bind:class="{ rotate: isOpen }" @click="open">
				            	開
				                <!--<span style="font-size: 26px;font-weight: 600;"></span>-->
				            </div>
				        </div>
				    </div>
				</div>
		
			<p style="text-align: center;font-size: .4rem;margin-top: .2rem;">这是张宇给您送的蛋蛋哦!</p>
			<p style="font-size: .36rem;margin: .2rem 0;">新年快乐啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊！</p>
			<div class="weui-cells weui-cells_form">
	            <div class="weui-cell">
	                <div class="weui-cell__hd"><label class="weui-label">配送地址</label></div>
	                <div class="weui-cell__bd">
	                    <input class="weui-input" type="text" placeholder="请输入配送地址" v-model="address">
	                </div>
	            </div>
	            <div class="weui-cell weui-cell_vcode">
	                <div class="weui-cell__hd">
	                    <label class="weui-label">手机号</label>
	                </div>
	                <div class="weui-cell__bd">
	                    <input class="weui-input" type="tel" placeholder="请输入手机号" v-model="tel">
	                </div>
	                <div class="weui-cell__ft">
	                    <button class="weui-vcode-btn">获取验证码</button>
	                </div>
	            </div>
	            <div class="weui-cell">
	                <div class="weui-cell__hd"><label class="weui-label">验证码</label></div>
	                <div class="weui-cell__bd">
	                    <input class="weui-input" type="number" placeholder="请输入手机验证码" v-model="code">
	                </div>
	            </div>
	            <div class="weui-cell">
	                <div class="weui-cell__hd"><label class="weui-label">姓名</label></div>
	                <div class="weui-cell__bd">
	                    <input class="weui-input" type="text" placeholder="请输入您的姓名" v-model="name">
	                </div>
	            </div>
	        </div>
	        <div class="button-sp-area" style="width: 80%;margin: 1rem auto .2rem;">
	            <a href="javascript:void(0);" class="weui-btn weui-btn_plain-primary" @click="submit">提交</a>
	        </div>	
	    </div>
		<script src="assets/js/vue.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="assets/js/vue-resource.min.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			var app = new Vue({
			  el: '#app',
			  data: {
			 	name:"",
			 	address:"",
			 	tel:"",
			 	code:"",
			 	isOpen:false,
			 	show:true,
			 	active:false,
			 	show_got:false
			 	
			  },
			  created:function(){
//              var url="json.jsp";
//				this.$http.get(url).then(function(data){
//                  //var json=data.body;
//                  //this.data=eval("(" + json +")");
//              },function(response){
//                  //console.info(response);
//              })
	         },
	         methods:{
	         	submit:function(){
	         		this.$http.post("test.php",{name:this.name,address:this.address,tel:this.tel,code:this.code},{emulateJSON:true}).then(
			            function (res) {
			                // 处理成功的结果
			                alert(res.body);
			            },function (res) {
			            	// 处理失败的结果
			            }
			        )
	         	},
	         	open:function(){
	         		var vm=this
	         		this.isOpen=true;
	         		this.active=true;
	         		
//	         		setTimeout(function(){
//	         			vm.animation_name="bounce";
//	         		},600)
	         	}
	         }
			})
		</script>
	</body>
</html>
