<!DOCTYPE html>
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
		<link href="https://unpkg.com/animate.css@3.5.1/animate.min.css" rel="stylesheet" type="text/css">
		<style type="text/css">
			#example-1 li{display: flex;width: 100%;}
			#example-1 span{flex: 1;text-align: center;}
		
        .container{
        	z-index: 999;
            text-align: center;
            width: 100%;
            /*max-width: 960px;*/
            margin: 0 auto;
            padding: 0 5px;
            background-color: rgba(0,0,0,0.3);
            height: 100%;
            position: absolute;
            top: 0;
        }
        .hongbao{
            height: 9rem;
            background: #A5423A;
            width: 6rem;
            left: 0;
            top: 0;
            border-radius: 10px;
            margin: .2rem auto 0;
        }
        .topcontent{
            height: 280px;
            border: 1px solid #BD503A;
            background-color: #BD503A;
            border-radius: 10px 10px 50% 50% / 10px 10px 15% 15%;
            box-shadow: 0px 4px 0px -1px rgba(0,0,0,0.2);
        }
        .avatar{
            position: relative;
        }
        .avatar span{
            position: absolute;
            top: 10px;
            right: 15px;
            -webkit-transform: rotate(45deg);
                -ms-transform: rotate(45deg);
                    transform: rotate(45deg);
            font-size: 2em;
            font-weight: bolder;
        }
        #close{
            color: rgba(0,0,0,0.5);
        }
        .avatar img{
            border: 1px solid #BD503A;
            border-radius: 50%;
            overflow: hidden;
            margin-top: 10%;
        }
        .topcontent h2{
            margin: 15px 0;
        }
        .text{
            color: #999;
        }
        .description{
            margin: 15px 0;
            font-size: .16rem;
            font-weight: 600;
        }
        #chai{
        	
            width: 2rem;
            height: 2rem;
            border: 1px solid #FFA73A;
            background-color: #FFA73A;
            border-radius: 50%;
            color: #fff;
            font-size: .2rem;
            display: inline-block;
            margin-top: -50px;
            box-shadow: 0px 4px 0px 0px rgba(0, 0, 0, 0.2);
            font-size: 26px;font-weight: 600;line-height: 100px;
        }
        #chai span{
            margin-top: 35px;
            display: inline-block;
            line-height: 70px;
        }
        .rotate{
            -webkit-animation: anim .6s alternate;
                -ms-animation: anim .6s alternate;
                    animation: anim .6s alternate;
        }
        @-webkit-keyframes anim {
            from { -webkit-transform: rotateY(0deg); }
            to { -webkit-transform: rotateY(360deg); }
        }
        @-ms-keyframes anim {
            from { -ms-transform: rotateY(0deg); }
            to { -ms-transform: rotateY(360deg); }
        }
        @keyframes anim {
            from { transform: rotateY(0deg); }
            to { transform: rotateY(360deg); }
        }
        
        
        .bounce-enter-active {
		  animation: bounce-in .5s;
		}
		.bounce-leave-active {
		  animation: bounce-out .5s;
		}
		@keyframes bounce-in {
		  0% {
		    transform: scale(0);
		  }
		  50% {
		    transform: scale(1.5);
		  }
		  100% {
		    transform: scale(1);
		  }
		}
		@keyframes bounce-out {
		  0% {
		    transform: scale(1);
		  }
		  50% {
		    transform: scale(1.5);
		  }
		  100% {
		    transform: scale(0);
		  }
		}
        
		</style>
	</head>
	<body>
        <?php

             include "../../lanewechat.php";
             $redirect_uri = 'LaneWeChat/yangjiguanjia/keeper/login.php';
             \LaneWeChat\Core\WeChatOAuth::getCode($redirect_uri, $state=1, $scope='snsapi_base');
             $code = $_GET['code'];
             $a = \LaneWeChat\Core\WeChatOAuth::getAccessTokenAndOpenId($code);
            // var_dump($a);

        ?>
		<div id="app">
			<transition v-bind:name="animation_name">
				<div v-if="show">
					<div class="container" id="container">
				        <div class="hongbao">
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
			</transition>
			<p style="text-align: center;font-size: .32rem;margin-top: .2rem;">这是张宇给您送的蛋蛋哦!</p>
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
			 	animation_name:""
			 	
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
	         		setTimeout(function(){
	         			vm.animation_name="bounce";
	         		},600)
	         	}
	         }
			})
		</script>
	</body>
</html>
