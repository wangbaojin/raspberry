<?php

   include "../../lanewechat.php"; 
   $b = $_GET['wish_id']; 
   $redirect_uri = 'LaneWeChat2/kuailededan/spread_happyegg/get_wish.php';
   \LaneWeChat\Core\WeChatOAuth::getCode($redirect_uri, $b, $scope='snsapi_userinfo');
   $code = $_GET['code'];
   $a = \LaneWeChat\Core\WeChatOAuth::getAccessTokenAndOpenId($code);
   $user_info = \LaneWeChat\Core\WeChatOAuth::getUserInfo($a['access_token'],$a['openid'],$lang='zh_CN'); 
   $wish_id = $_GET['state'];
     
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
		<link rel="stylesheet" type="text/css" href="assets/css/animate.min.css"/>
		<style type="text/css">
			html,body,#app,.bg,.guess_box,.guess_error_box,.guess_success_box{width: 100%;height: 100%;}
			#app{position: relative;}
			.bg img{display: inline-block;width: 100%;height: 100%;}
			.left_bag img,.right_bag img{display: inline-block;width: 1.9rem;}
			.left_bag{position: absolute;top: 2.18rem;left: .8rem;}
			.right_bag{position: absolute;top: 2.18rem;right: .64rem;}	
			
			.left_box{position: absolute;width: 1.35rem;text-align: center;top: 5rem;left: .98rem;font-size: 0;}
			.guess_box{min-height: 11rem;}
			.right_box{position: absolute;width: 1.35rem;text-align: center;top: 5rem;right: .8rem;font-size: 0;}
			.top{display: inline-block;width: .75rem;margin-bottom: .28rem;-webkit-animation:arrowUp 0.8s infinite;z-index: 999;}
			.bottom{display: inline-block;width: 100%;}
			@-webkit-keyframes arrowUp{
				0%{		
					-webkit-transform: translateY(0px);
				}
				50%{
					
					-webkit-transform: translateY(-10px);
				}
				100%{	
					-webkit-transform: translateY(0px);
				}
			}
			.err_box p{text-align: center;font-size: 26px;color: dimgrey;position: absolute;top: 0;left: 0;width: 100%;}
		
			.guess_error_box,.guess_success_box{position: absolute;top: 0;left: 0;font-size: 0;min-height: 11rem;}
		
		
			.success_info{width: 6.28rem;height: 7rem;border-radius: .1rem;font-family: "微软雅黑";color: #ffffff;
			margin:0 auto;font-size: .2rem;z-index: 999;position: relative;}
			.text_box{width: 100%;text-align: center;position: absolute;top: .38rem;z-index: 99;}
			.text_box img{display: inline-block;width: 3.1rem;margin: 0 auto;}
			.success_info p{width: 100%;text-align: center;min-height: .34rem;}
			.goods_info{text-align: center;width: 100%;position: absolute;top: 1.24rem;z-index: 9;}
			.goods_info img{display: inline-block;width: 4.28rem;}
			.hope{font-size: .34rem;margin-top: 1.68rem;}
			.mask{width: 100%;height: 100%;background: #000000;opacity: 0.5;position: absolute;top: 0;left: 0;z-index: 1;border-radius: .1rem;}
			.small{position: absolute;width: 100%;height: 100%;top: 0;left: 0;z-index: 99;}
			.btn_box{width: 6rem;height: .84rem;line-height: .84rem;text-align: center;overflow: hidden;
			margin: .22rem auto 0;}
			
			.btn_box .my_btn{width: 2.92rem;height: .84rem;line-height: .84rem;display: inline-block;float: left;background: #ffcf10;
			color: #ff4130;font-size: .32rem;}
			.btn_box .sendwish_btn{width: 2.92rem;height: .84rem;line-height: .84rem;display: inline-block;float: left;background: #47a6ff;
			color: #ffff00;float: right;font-size: .32rem;}
			
			
			.big_box{width: 100%;position: absolute;top: .55rem;z-index: 9999;-webkit-animation-delay: 1s;
		        -moz-animation-delay: 1s;-o-animation-delay: 1s;animation-delay: 1s;}
			.go_btn{text-align: center;margin-top: 2.3rem;}
			.go_btn a{display: inline-block;width: 4.6rem;height: .84rem;line-height: .84rem;font-size: .32rem;color: #ffff00;
			font-family: "微软雅黑";background: #ff5647;border-radius: .1rem;text-align: center;margin-bottom: .16rem;position: relative;}
			.go_btn a img{position: absolute;width: 5.86rem;display: inline-block;top: .08rem;left: .08rem;height: .7rem;}
			.go_btn .btn_box a img{width: 2.77rem;height: .7rem;}
		
			.error_info{width: 5rem;height: 5.68rem;border-radius: .1rem;font-family: "微软雅黑";color: #ffffff;
			margin:0 auto;font-size: .2rem;z-index: 999;position: relative;}
			.text_box_error{width: 100%;text-align: center;position: absolute;top: 1rem;z-index: 99;}
			.text_box_error img{display: inline-block;width: 3.1rem;margin: 0 auto;}
			.error_info p{width: 100%;text-align: center;}
			.hope_error{font-size: .46rem;margin-top: 2.8rem;}
			.mask{width: 100%;height: 100%;background: #000000;opacity: 0.5;position: absolute;top: 0;left: 0;z-index: 1;}
			.big_boxerror{width: 100%;position: absolute;top: .55rem;z-index: 9999;-webkit-animation-delay: 1s;
		        -moz-animation-delay: 1s;-o-animation-delay: 1s;animation-delay: 1s;}
		    .voice_btn{position: absolute;top: .46rem;right: .24rem;z-index: 99;}
			.voice_btn img{display: inline-block;width: .5rem;height: .5rem;}
			.rule_vocie{-webkit-animation:mymove 2s 2;}
			@-webkit-keyframes mymove
			{
			from {-webkit-transform: rotateY(0deg);}
			to {-webkit-transform: rotateY(360deg);}
			}
		</style>
	</head>
	<body>
		<div id="app">
			<audio src="assets/audio/rule.mp3"  id="rule_music"></audio>
			<audio src="assets/audio/wish_1.mp3" id="musicBox"></audio>
			<div v-if="voice">
				<div class="voice_btn" v-if="voice_btn">
					<img class="rule_vocie" src="assets/img/rule.png" @click="close_voice"/>
				</div>
				<div v-else class="voice_btn" >
			  		<img src="assets/img/rule_close.png" @click="close_voice"/>
				</div>
			</div>
			<div class="guess_box" v-bind:class="{ animated: flag_common, 'fadeOut': error , 'fadeOut': success }" >
				<div class="bg">
					<img src="assets/img/getwish_bg.jpg" class="getwish_bg"/>
				</div>
				<div class="left_bag" >
					<img src="assets/img/left_bag.png" @click="judge(0)"/>
				</div>
				<div class="right_bag">
					<img src="assets/img/right_bag.png" @click="judge(1)"/>
				</div>
				<div class="left_box">
					<img src="assets/img/direct.png" class="top"/>
					<img src="assets/img/left_btn.png" class="bottom"/>
				</div>
				<div class="right_box">
					<img src="assets/img/direct.png" class="top"/>
					<img src="assets/img/right_btn.png" class="bottom"/>
				</div>
			</div>
			
			<div class="guess_error_box" v-bind:class="{ animated: error, 'fadeIn': error }"  v-if="error" >
				<div class="bg">
					<img src="assets/img/none_bg.jpg" class="getwish_bg"/>
				</div>
				<div class="big_boxerror" v-bind:class="{ animated: error, 'bounceInDown': error }">
					<div class="error_info">
						<div class="mask"></div>
						<div class="small">
							<div class="text_box_error">
								<img src="assets/img/error_txt.png" class="get"/>
							</div>
							<p class="hope_error" >您没有猜中!</p>
							<div class="go_btn" style="margin-top: .8rem;">
					            <a href="javascript:void(0);" @click="guess_agin">
					            	<img src="assets/img/shinning.png" style="width: 4.4rem;"/>
					            	再猜一次
					            </a>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			
			
			<!--<div class="guess_success_box" v-bind:class="{ animated: success, 'fadeInUp': success }"  v-if="success">
				<div class="bg">
					<img src="assets/img/success.gif" class="getwish_bg"/>
				</div>
				
			</div>-->
			<div class="guess_success_box" v-bind:class="{ animated: success, 'fadeIn': success }"  v-if="success" >
				<div class="bg">
					<img src="assets/img/success.gif" class="getwish_bg"/>
				</div>
				<div class="big_box" v-bind:class="{ animated: success, 'bounceInDown': success }">
					<div class="success_info">
						<div class="mask"></div>
						<div class="small">
							<div class="text_box">
								<img src="assets/img/success_txt.png" class="get"/>
							</div>
							<p class="hope" >{{ msg }}</p>
							<p class="goods_info"><img src="assets/img/egg_pag.png"/></p>
							<div class="go_btn" >
					            <a href="javascript:void(0);" @click="play" class="listen" style="width: 6rem;margin-bottom: 0;margin-top: .4rem;">
					            	<img src="assets/img/shinning.png"/>
					            	听好友的祝福
					            </a>
					            <div class="btn_box">
					            	<a href="my_wish.php" class="my_btn" >
						            	<img src="assets/img/shinning.png"/>
						            	我的福袋
						            </a>
						            <a href="create_wish.php" class="sendwish_btn" >
						           		<img src="assets/img/shinning.png"/>
						            	我也要送祝福
						            </a>
					            </div>
					           
					        </div>
						</div>
						
					</div>
				</div>
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
				flag:null,
				error:false,
				wish_type:null,
				success:false,
				flag_common:false,
				wish_id:null,
				voice_btn:true,
				msg:"",
				voice:true
			  },
			  methods:{
					random:function(min, max){
					  return min + Math.floor(Math.random() * (max - min + 1));
					},
					judge:function(index){
						var _this=this
						if(index==this.flag){
							this.flag_common=true
							this.success=true
							this.voice=false
//							var Media=document.getElementById("musicBox");
//							Media.src="assets/audio/wish_"+this.wish_type+".mp3"
//							Media.play();
							var state="<?php echo $wish_id;?>";
							var wish_id=state.split("_")[0];
							var come_from=state.split("_")[1]
							
							this.$http.post(validate.url+"/Api/NewYearGift/getWish",{nickname:"<?php echo $user_info['nickname'];?>",pic:"<?php echo $user_info['headimgurl']; ?>",openid:"<?php echo $a['openid']; ?>",wish_id:wish_id,come_from:come_from},{emulateJSON:true}).then(
					            function (res) {
					                // 处理成功的结果
					                //alert(JSON.stringify(res.body))
					                if(res.body.code==1){
					                	//alert(res.body.result.wish_type)
										_this.wish_type=res.body.result.wish_type
										this.$http.post(validate.url+"/Api/NewYearGift/getGift",{nickname:"<?php echo $user_info['nickname'];?>",pic:"<?php echo $user_info['headimgurl']; ?>",openid:"<?php echo $a['openid']; ?>",wish_id:wish_id,come_from:come_from},{emulateJSON:true}).then(
								            function (res) {
								                if(res.body.code==1){
													_this.msg="恭喜您获得福蛋一枚"
													
								                }else if(res.body.code==0){
								                	_this.msg=""
								                }
								                
								            },function (res){
								            	// 处理失败的结s果
								            	alert("请求失败!")
								            }
								        )
					                }else{
					                	alert(res.body.msg)
					                }
					                
					            },function (res){
					            	// 处理失败的结s果
					            	alert("请求失败!")
					            }
					        )
							
						}else{
							this.flag_common=true
							this.error=true
							this.voice=false
//							setTimeout(function(){
//								_this.error=false	
//							},1500)
						}
					},
					guess_agin:function(){
						this.error=false
						this.voice=true
					},
					play:function(){
						var Media=document.getElementById("musicBox");
						Media.src="assets/audio/wish_"+this.wish_type+".mp3"
						Media.play();
					},
					close_voice:function(){
						var Media=document.getElementById("rule_music");
						this.voice_btn=!this.voice_btn
						if(this.voice_btn){
							Media.play();
						}else{
							Media.pause();
						}
						
					},
					audioAutoPlay:function(){
//						    var  audio= document.getElementById("rule_music");  
//  						
//  						document.addEventListener("WeixinJSBridgeReady", function () {  
//          					audio.play();  
//  						}, false);  
    						
					}
			  },
			  created:function(){
			  	var _this=this;
			  	this.flag=this.random(0,1)
			  	var  audio= document.getElementById("rule_music");  
				document.addEventListener("WeixinJSBridgeReady", function () {  
					audio.play();  
				}, false); 
			  	
			  	
			  	var url=location.href.split("&")[0]+"%26"+location.href.split("&")[1]
			  	var state="<?php echo $wish_id;?>";
				var wish_id=state.split("_")[0];
				var come_from=state.split("_")[1]
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
	                    jsApiList: ['onMenuShareAppMessage','onMenuShareTimeline']
	                });
	                wx.ready(function () {
	                    wx.onMenuShareAppMessage({
	                    	title: "<?php echo $user_info['nickname'];?>"+"送上的私密祝福，点击收听", // 分享标题
						    desc: "敬业福没诚意 来点实际的！不用浇水 福蛋送上门 快乐多多！", // 分享描述
						    link: 'http://weixin.yangjiguanjia.com/LaneWeChat2/kuailededan/spread_happyegg/get_wish.php?wish_id='+wish_id+"_"+come_from, // 分享链接
						    imgUrl: 'http://weixin.yangjiguanjia.com/LaneWeChat2/kuailededan/spread_happyegg/assets/img/imgurl_spread.jpg', // 分享图标
						    type: 'link', // 分享类型,music、video或link，不填默认为link
						    dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
	                        success: function () { 
	                          
	                          location.href="my_wish.php"
	                        },
	                        cancel: function () { 
	                          
	                        }
	                    });
	                    wx.onMenuShareTimeline({
	                    	title: "<?php echo $user_info['nickname'];?>"+"送上的私密祝福，点击收听", // 分享标题
						   
						    link: 'http://weixin.yangjiguanjia.com/LaneWeChat2/kuailededan/spread_happyegg/get_wish.php?wish_id='+wish_id+"_"+come_from, // 分享链接
						    imgUrl: 'http://weixin.yangjiguanjia.com/LaneWeChat2/kuailededan/spread_happyegg/assets/img/imgurl_spread.jpg', // 分享图标
						    
	                        success: function () { 
	                          
	                          location.href="my_wish.php"
	                        },
	                        cancel: function () { 
	                            
	                        }
	                    });
	                });
		        },function(response){
		        	console.info(response);
		        });
				
			  }
			})
		</script>
	</body>
</html>

