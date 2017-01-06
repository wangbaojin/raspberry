 <?php

   include "../../lanewechat.php";
   $redirect_uri = 'LaneWeChat/yangjiguanjia/send_happyegg/receive_info.php';
   \LaneWeChat\Core\WeChatOAuth::getCode($redirect_uri, $state=1, $scope='snsapi_base');
   $code = $_GET['code'];
   $a = \LaneWeChat\Core\WeChatOAuth::getAccessTokenAndOpenId($code);
  //echo $a['openid'];
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
        
		</style>
	</head>
        <body>
        <div id="app">
			<div v-if="active">
				<div id="box" v-bind:class="{  animated: active,fadeOut: active }">
					<p style="font-size: 30px;color: dodgerblue;text-align: center;margin-top: 40%;font-weight: 600;" id="got" v-bind:class="{ animated: active, 'bounceInRight': active }">手速可以啊,小伙子</p>
				</div>
			</div>
			<div v-if="condition">
				
					<p style="font-size: 30px;color: dodgerblue;text-align: center;margin-top: 40%;font-weight: 600;" id="err" v-bind:class="{ animated: condition, 'bounceInRight': condition }">{{message}}</p>
				
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
			
	    </div>
		<script src="assets/js/vue.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="assets/js/vue-resource.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="assets/js/commom.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
                 //alert("<?php echo $a['openid'];?>");
			var app = new Vue({
			  el: '#app',
			  data: {
			 	name:"",
			 	address:"",
			 	tel:"",
			 	code:"",
			 	isOpen:false,
			 	show:false,
			 	active:false,
			 	show_got:false,
			 	condition:false,
			 	message:""
			  },
			  created:function(){
			  		var _this=this
					this.$http.post(validate.url+"/Api/WxHappyEgg/addCatchLog",{order_sn:"2017010514061787472",open_id:"<?php echo $a['openid']; ?>"},{emulateJSON:true}).then(
			            function (res) {
			                // 处理成功的结果
			                if(res.body.code==1){
			                	_this.show=true;
			                }else if(res.body.code==0){
			                	_this.message=res.body.msg;
			                	_this.condition=true;
			                }
			               
			            },function (res) {
			            	// 处理失败的结果
			            	alert("请求失败")
			            }
			        )
	         },
	         methods:{
	         	
	         	open:function(){
	         		//var vm=this
	         		this.isOpen=true;
	         		this.active=true;
	         		setTimeout(function(){
	         			alert("快去填写收货地址吧！")
	         			location.href="write_info.php"
	         		},2500)
	         	}
	         }
			})
		</script>
	</body>
</html>
