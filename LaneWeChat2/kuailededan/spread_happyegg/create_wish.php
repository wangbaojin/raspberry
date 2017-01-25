<?php

   include "../../lanewechat.php"; 
   $b = $_GET['come_from']; 
   $redirect_uri = 'LaneWeChat2/kuailededan/spread_happyegg/create_wish.php';
   \LaneWeChat\Core\WeChatOAuth::getCode($redirect_uri, $b, $scope='snsapi_userinfo');
   $code = $_GET['code'];
   $a = \LaneWeChat\Core\WeChatOAuth::getAccessTokenAndOpenId($code);
   $user_info = \LaneWeChat\Core\WeChatOAuth::getUserInfo($a['access_token'],$a['openid'],$lang='zh_CN'); 
   $come_from = $_GET['state'];
    
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
		<style type="text/css">
			html,body{width: 100%;height: 100%;}
			#app{width: 100%;height: 100%;}
			.bg{position: absolute;top: 0;left: 0;width: 100%;height: 100%;z-index: 9;}
			.bg img{width: 100%;height: 100%;}
			
			.voice_btn{position: absolute;top: .46rem;right: .24rem;z-index: 99;}
			.voice_btn img{display: inline-block;width: .5rem;height: .5rem;}
		
			.btn_box{width: 100%;height: 2.25rem;position: absolute;bottom: .6rem;z-index: 999;text-align: center;}
			.btn_box a{display: inline-block;width: 5.8rem;height: 1rem;line-height: 1rem;text-align: center;
			color: #f33920;background: #fdd001;font-size: .32rem;font-family: "微软雅黑";margin: 0 auto;border-radius: .1rem;}
			.bottom_box{width: 5.8rem;height: 1rem;line-height: 1rem;text-align: center;overflow: hidden;
			margin: .22rem auto 0;}
			.bottom_box .create_btn{width: 100%;height: 1rem;line-height: 1rem;display: inline-block;float: left;background: #fc4602;
			color: white;}
			.bottom_box .reset_btn{width: 2.8rem;height: 1rem;line-height: 1rem;display: inline-block;float: left;background: #dbdbdb;
			color: #8a8a8a;float: right;}
			
			.duoduo_box{position: absolute;width: 100%;top: 3.4rem;text-align: center;z-index: 999;font-size: 0;}
			.duoduo_box img{display: inline-block;width: 4.5rem;height: auto;}
		</style>
	</head>
	<body>
		<div id="app">
			<audio src="assets/audio/wish_1.mp3" id="musicBox"></audio>
			<div class="bg">
				<img src="assets/img/create_bg.jpg"/>
			</div>
			<div class="voice_btn" v-if="voice_btn">
				<img src="assets/img/voice.png" @click="close_voice"/>
			</div>
			<div v-else class="voice_btn" >
			  	<img src="assets/img/no_voice.png" @click="close_voice"/>
			</div>
			<div class="duoduo_box">
				<img v-bind:src="duoduo_src"/>
			</div>
			<div class="btn_box" style="font-size: 0;">
				<div class="box">
					<a class="wish" href="javascript:void(0)" @click="choose_wish">{{wish}}</a>
					<div class="bottom_box">
						<a class="create_btn" href="javascript:void(0)" @click="create_wish">立即生成</a>
						
					</div>
				</div>
			</div>
			<div>
		        <div class="weui-mask" id="iosMask"  v-bind:style="styleObject"  @click.stop="cancel_wish"></div>
		        <div class="weui-actionsheet" v-bind:class="{ 'weui-actionsheet_toggle': choose_flag }" id="iosActionsheet">
		            <div class="weui-actionsheet__menu">
		                <div class="weui-actionsheet__cell" style="padding: 8px 0;font-size: 14px;"  v-for="(item, index) in items" @click="select(index)">
		                	{{item.wish}}
		                </div>
		            </div>
		            <div class="weui-actionsheet__action">
		                <div class="weui-actionsheet__cell"  style="padding: 8px 0;font-size: 14px;" id="iosActionsheetCancel" @click="choose_wish">取消</div>
		            </div>
		        </div>
		    </div>
			
	    </div>
		<script src="assets/js/vue.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="assets/js/vue-resource.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="assets/js/commom.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
		history.pushState({page : 'state1'},'state','#state1');
		history.pushState({page : 'state2'},'state','#state2');
			
			window.onpopstate = function(event) {
		      if (event.state.page === 'state1') {
		        //WeixinJSBridge.call('closeWindow');
		        WeixinJSBridge.invoke('closeWindow',{},function(res){

				    //alert(res.err_msg);
				
				});
		      }
		    }
			var app = new Vue({
			  el: '#app',
			  data: {
				choose_flag:false,
				styleObject:{
					"display":"none",
					"z-index":990
				},
				items:[
				 { wish: '鸡年大吉' },
      			 { wish: '鸡鸡鸡...' },
      			 { wish: '必成大器' },
      			 { wish: '丰胸化吉' },
      			 { wish: '一吻解千愁' },
      			 { wish: '财运亨通' },
      			 { wish: '阖家幸福' },
      			 { wish: '前程似锦' },
      			 { wish: '茁壮成长' },
      			 { wish: '健康长寿' }
      			],
      			wish:"请选择您的祝福",
      			voice_btn:true,
      			wish_index:1,
      			duoduo_src:"assets/img/duoduo_1.gif"
			  },
			  methods:{
					choose_wish:function(){
						if(!this.choose_flag){
							this.styleObject.display="block";
							this.choose_flag=true;
						}else{
							this.styleObject.display="none";
							this.choose_flag=false;
						}
					},
					select:function(index){
						this.wish=this.items[index].wish;
						this.styleObject.display="none";
						this.choose_flag=false;
						this.wish_index=index+1
						if(index>=0&&index<3){
							
							this.duoduo_src="assets/img/duoduo_2.gif"
						}else if(index==3||index==4){
							this.duoduo_src="assets/img/duoduo_3.gif"
						}else{
							this.duoduo_src="assets/img/duoduo_1.gif"
						}
						
						var Media=document.getElementById("musicBox");
						if(this.voice_btn){
							Media.src="assets/audio/wish_"+(index+1)+".mp3"
							Media.play();
						}
						
					},
					close_voice:function(){
						var Media=document.getElementById("musicBox");
						this.voice_btn=!this.voice_btn
						if(this.voice_btn){
							Media.play();
						}else{
							Media.pause();
						}
						
					},
					cancel_wish:function(){
						this.styleObject.display="none";
						this.choose_flag=false;
					},
					create_wish:function(){
						if(this.wish=="请选择您的祝福"){
							alert("请选择您的祝福语")
							return
						}
						this.$http.post(validate.url+"/Api/NewYearGift/addWish",{nickname:"<?php echo $user_info['nickname'];?>",pic:"<?php echo $user_info['headimgurl']; ?>",openid:"<?php echo $a['openid']; ?>",wish_type:this.wish_index},{emulateJSON:true}).then(
				            function (res) {
				                // 处理成功的结果
				                console.log(JSON.stringify(res.body))
				                if(res.body.code==1){
				                	//alert(res.body.result.user_name)
				                	//alert(res.body.result.wish_word)
				                	localStorage.setItem("wish_sender",JSON.stringify({"nickname":"<?php echo $user_info['nickname'];?>","wish_type":this.wish_index,"openid":"<?php echo $a['openid']; ?>","pic":"<?php echo $user_info['headimgurl']; ?>","wish_id":res.body.result.wish_id,"come_from":"<?php echo $come_from;?>"}))
				                	alert(res.body.msg);
				                	location.href="send_wish.html"
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
			  	
			  
			  }
			})
		</script>
	</body>
</html>
