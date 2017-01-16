<?php

   include "../../lanewechat.php"; 
   $b = $_GET['order_sn']; 
   $redirect_uri = 'LaneWeChat/yangjiguanjia/send_happyegg/receive_info.php';
   \LaneWeChat\Core\WeChatOAuth::getCode($redirect_uri, $b, $scope='snsapi_base');
   $code = $_GET['code'];
   $a = \LaneWeChat\Core\WeChatOAuth::getAccessTokenAndOpenId($code);
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
		<title>快乐的蛋</title>
		<script src="assets/js/rem.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" type="text/css" href="assets/css/reset.css"/>
		<link rel="stylesheet" type="text/css" href="assets/css/weui.min.css"/>
		<link href="https://unpkg.com/animate.css@3.5.1/animate.min.css" rel="stylesheet" type="text/css">
		<style type="text/css">
			#example-1 li{display: flex;width: 100%;}
			#example-1 span{flex: 1;text-align: center;}
			html,body{width: 100%;height: 100%;}
			#app{width: 100%;height: 100%;}
	        .container{
	        	z-index: 999;
	            text-align: center;
	            width: 100%;
	            /*max-width: 960px;*/
	            margin: 0 auto;
	            padding: 0 5px;
	            height: 100%;
	            position: absolute;
	            top: 0;
	        }
		    #hongbao{
		        height: 9rem;
		        background: #A5423A;
		        width: 6rem;
		        left: 0;
		        top: 0;
		        border-radius: 10px;
		        margin: .2rem auto 0;
		 
		        -webkit-animation-delay: 0.6s;
		        -moz-animation-delay: 0.6s;
		        -o-animation-delay: 0.6s;
		        animation-delay: 0.6s;
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
	        
	        #got{
	        	 -webkit-animation-delay: 1s;
		        -moz-animation-delay: 1s;
		        -o-animation-delay: 1s;
		        animation-delay: 1s;
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
        
        	#box{-webkit-animation-delay: 2s;
        	-moz-animation-delay: 2s;
        	-o-animation-delay: 2s;
        	animation-delay: 2s;}
        	.get_box{position: relative;width: 100%;height: 100%;
        	}
        	.success_bg{width: 100%;display: block;height: 100%;position: absolute;z-index: 98;
        	}
        	.caidai{display: inline-block;width: 6rem;position: absolute;top: .9rem;left: .75rem;z-index: 99;
        	}
		
			
			.success_info{width: 4.4rem;height: 5.36rem;border-radius: .1rem;font-family: "微软雅黑";color: #ffffff;
			background: #ff1400;margin:0 auto;font-size: .2rem;z-index: 999;}
			.text_box{width: 100%;text-align: center;}
			.text_box img{display: inline-block;width: 3.1rem;margin: 0 auto;margin-top: .58rem;}
			.success_info p{width: 100%;text-align: center;}
			.goods_info{font-size: .42rem;font-weight: bold;font-family: "微软雅黑";}
			.hope{font-size: .34rem;margin-top: .3rem;}
			
			.big_box{width: 100%;position: absolute;top: .55rem;z-index: 9999;}
			.go_btn{text-align: center;margin-top: .74rem;}
			.go_btn a{display: inline-block;width: 3.92rem;height: .86rem;line-height: .86rem;font-size: .36rem;color: #fd2c1a;
			font-family: "微软雅黑";background: #ffff00;border-radius: .1rem;text-align: center;}
			
			.show_none{position: relative;width: 100%;height: 100%;}
			.show_none .none_bg{width: 100%;display: inline-block;height: 100%;;}
			.none{width: 5.2rem;display: inline-block;}
			.none_box{width: 100%;text-align: center;position: absolute;top: 2.1rem;}
			.show_none p{width: 100%;position: absolute;font-size: .22rem;bottom: .36rem;text-align: center;}
			.show_none a{color: #ffd339;}
		</style>
	</head>
        <body>
        <div id="app">
			<div v-if="show_none" class="show_none">
				<img src="assets/img/none_bg.jpg" class="none_bg"/>
				<div class="none_box">
					<img src="assets/img/none.png" class="none" v-bind:class="{ animated: show_none, 'bounceInRight': show_none }"/>
				</div>
				<p><a href="share_egg.php?order_sn=<?php echo $order_sn;?>">看看大家的手气></a></p>
			</div>
			<div v-if="show_get" class="show_none">
				<img src="assets/img/already_get_bg.jpg" class="none_bg"/>
				<div class="none_box">
					<img src="assets/img/already_get_text.png" class="none" v-bind:class="{ animated: show_get, 'bounceInRight': show_get }"/>
				</div>
			</div>
			<div v-if="show_nochance" class="show_none">
				<img src="assets/img/no_chance_bg.jpg" class="none_bg"/>
				<div class="none_box" style="top: 4.1rem;">
					<img src="assets/img/no_chance.png" class="none" v-bind:class="{ animated: show_nochance, 'bounceInRight': show_nochance }"/>
				</div>
			</div>
			<div v-if="show" style="width: 100%;height: 100%;">
				
					<div class="get_box" id="got" >
						<img src="assets/img/success.png" class="success_bg" v-bind:class="{ animated: show, 'fadeIn': show }"/>
						<img src="assets/img/caidai.png" class="caidai" v-bind:class="{ animated: show, 'fadeIn': show }"/>
						<div class="big_box" v-bind:class="{ animated: show, 'fadeInUp': show }">
							<div class="success_info">
								<div class="text_box">
									<img src="assets/img/get.png" class="get"/>
								</div>
								<p class="hope" >恭喜您抢到</p>
								<p class="goods_info">38元鸡蛋一提</p>
								<div class="go_btn" >
						            <a href="javascript:void(0);" @click="go">前去领奖</a>
						        </div>
							</div>
						</div>
					</div>
				
				
					<!--<div class="container" id="container">
				        <div v-bind:class="{ animated: active, 'fadeOutUp': active }"  id="hongbao">
				            <div class="topcontent">
				                <div class="avatar">
				                        
				                </div>
				                <h2 style="font-size: 26px;color: white;">老王</h2>
				                <span class="text" style="font-size: 22px;">给你发了一个红包</span>
				                <div class="description" style="color:white;font-weight: bold;font-size: 20px;">恭喜发财 大吉大利</div>
				            </div>
				            <div id="chai" v-bind:class="{ rotate: isOpen }" @click="open">
				            	開
				            </div>
				        </div>
				    </div>-->
			</div>
			
	    </div>
		<script src="assets/js/vue.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="assets/js/vue-resource.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="assets/js/commom.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
		<script type="text/javascript">
                 
			var app = new Vue({
			  el: '#app',
			  data: {
			 	isOpen:false,
			 	show:false,
			 	active:false,
			 	show_got:false,
			 	condition:false,
			 	message:"",
			 	show_none:false,
			 	show_get:false,
			 	show_nochance:false
			  },
			  created:function(){
			  		var _this=this;
			  		
			  		localStorage.setItem("order_number",JSON.stringify({"order_sn":"<?php echo $order_sn;?>"}))
					this.$http.post(validate.url+"/Api/WxHappyEgg/addCatchLog",{order_sn:"<?php echo $order_sn;?>",open_id:"<?php echo $a['openid']; ?>"},{emulateJSON:true}).then(
			            function (res) {
			                // 处理成功的结果
//			                alert(res.body.code)
//			                alert(res.body.error)
//			                alert(typeof(res.body.error))
			                if(res.body.code==1){ //抢到红包
			                	_this.show=true;
			                }else if(res.body.code==0){
			                	//alert(res.body.error)
			                	if(res.body.error==5006){  //已经抢过
			                		_this.show_get=true;
			                	}else if(res.body.error==5007){		//已经抢光
			                		_this.show_none=true;
			                	}else if(res.body.error==5008){
			                		_this.show_nochance=true;
			                	}else if(res.body.error==5010){  //判断抢到红包 但是没填地址
			                		_this.show_get=true;
        			         		setTimeout(function(){
					         			alert("您还没有填写收货地址，快去填写收货地址吧！")
					         			location.href="write_info.php"
					         		},1000)
			                	}else{
			                		alert(res.body.msg)
			                	}
			                	
			                	
			                }
			               
			            },function (res) {
			            	// 处理失败的结果
			            	alert("请求失败")
			            }
			        )
				    var url=location.href.split("&")[0]+"%26"+location.href.split("&")[1]
					//alert(url)
			  		_this.$http.get(validate.url+'/LaneWeChat/api_getsign.php?url='+url).then(function(res){
	         			//alert(res.body)
                        res=JSON.parse(res.body)
			         	wx.config({
		                    debug: false,
		                    appId: res.appId,
		                    timestamp: res.timestamp,
		                    nonceStr: res.nonceStr,
		                    signature: res.signature,
		                    jsApiList: ['hideAllNonBaseMenuItem']
		                });
		                wx.ready(function () {
		                    wx.hideAllNonBaseMenuItem();
		                });
			        },function(response){
			        	console.info(response);
			        });
	         },
	         methods:{
	         	
	         	open:function(){
	         		//var vm=this
	         		this.isOpen=true;
	         		this.active=true;

	         	},
	         	go:function(){
	         		
	         		location.href="write_info.php"
	         	}
	         }
			})
		</script>
	</body>
</html>
