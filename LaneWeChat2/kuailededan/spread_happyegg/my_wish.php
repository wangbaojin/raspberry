<?php

   include "../../lanewechat.php";
   $redirect_uri = 'LaneWeChat2/kuailededan/spread_happyegg/my_wish.php';
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
		<title>快乐的蛋</title>
		<script src="assets/js/rem.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" type="text/css" href="assets/css/reset.css"/>
		<style type="text/css">
			.wx_head{height: 1rem;width: 1rem;border-radius: 50%;position:absolute;top: .5rem;left: 50%;margin-left: -0.5rem;}
			.process{height: .24rem;width: 2.4rem;background-color: red;border-radius: 5px;position: absolute;left: 50%;top: 1.78rem;margin-left: -1.2rem;}
			.process_y{height: .24rem;background-color: yellow;border-radius:5px 0 0 5px;position: absolute;left: 0;top: 0;}
			.small_egg{position: absolute;top: -0.15rem;width: 0.4rem;}
			.myfdlb{font-size: .32rem;font-family:"黑体";font-weight: bold;height: .8rem;line-height: .8rem;color: #363636;width: 100%;padding-left: .28rem;border-bottom: 0.5px solid #d7d7d7;}
			.ul_p{font-size: .3rem;font-family:"黑体";font-weight: bold;height: .7rem;line-height: .7rem;color: #363636;width: 100%;padding-left: .28rem;}
			.dian{height: .13rem;width: .13rem;border-radius: 50%;background-color: #8a8a8a;margin-left: .5rem;}
			.phb{font-size: .30rem;font-family:"黑体";font-weight: bold;height: .8rem;line-height: .8rem;color: #363636;width: 100%;padding-left: .28rem;}
			.dian_small{height: .12rem;width: .12rem;background-color: #dbdbdb;border-radius: 50%;float: left;margin-top: 0.25rem;margin-left: .5rem;margin-right: .36rem;}
			.friend_name{font-family: "黑体";font-size: .28rem;font-weight: bold;color:#363636;height: .7rem;line-height: .7rem;float: left;width: 1.5rem;
			display:block;white-space:nowrap; overflow:hidden; text-overflow:ellipsis;}
			.friend_ul{width: 100%;border-bottom: 0.2rem solid #eeeeee;padding-bottom: .6rem;}
			.friend_ul li{height: 0.7rem;box-sizing: border-box;font-size: 0;}
			.send_fudai{font-family: "黑体";font-size: .28rem;color:#363636;height: .7rem;line-height: .7rem;float: left;}
			.send_img{float: right;margin-top: .1rem;margin-left: .1rem;}
			.friend_time{float: right;margin-right:.5rem;font-size: .26rem;color: #8a8a8a;font-family: "黑体";height: .7rem;line-height: .7rem;}
			.send_div{float: left;margin-left: .18rem;}
			.date_div{height: .7rem;width: 100%;}
			.li_all{height: 1rem;border-top: 0.5px solid #d7d7d7;padding-left: .28rem;}
			.medal{float: left;height: .6rem;margin-top: .25rem;margin-right: .2rem;}
			.ranking{font-size: .3rem;height: 1rem;line-height: 1rem;float: left;width: .6rem;text-align: center;margin-right: 0.2rem;}
			.tx_all{float: left;height: .6rem;width: .6rem;margin-top: .2rem;margin-right: .1rem;}
			.name_all{font-size: .28rem;font-family: "黑体";color: #363636;}
			.wish_all{font-size: .26rem;font-family: "黑体";color: #8a8a8a;height: .3rem;}
			.egg_all{float: right;font-size: .26rem;font-family: "黑体";color: #363636;margin-right: .5rem;margin-top: .35rem;}
			.egg_ruler{height: 0.2rem;position: absolute;left: 50%;width: 2.4rem;margin-left: -1.2rem;top: 2.2rem;font-size: .2rem;font-family: "微软雅黑";color: #fff;font-style:italic;}
			.egg_num{float: left;margin-left: 0.1rem;}
			.prompt{color: #8a8a8a;font-size: .28rem;font-family: "黑体";font-weight: normal;margin-right: 0.1rem;}
			.exchange{height: 0.6rem;width: 1.2rem;background-color: #dbdbdb;display: inline-block;font-size: .28rem;color: #8a8a8a;font-family:'微软雅黑';line-height: 0.6rem;text-align: center;border-radius: 0.2rem;font-weight: normal;}
			.exchange_btn{background-color: #0d9eea;color: #fff;}
		
			.continue_send{width: 100%;text-align: center;position: fixed;opacity: 0.9;bottom: .1rem;}
			.continue_send a{display: inline-block;width: 2.8rem;height: .8rem;line-height: .8rem;text-align: center;
			border-radius: .4rem;background: #fed100;font-size: .28rem;font-family: "微软雅黑";color: #f6370b;opacity: 0.8;}
		</style>
	</head>
	<body style="height: 100%;">
		<div style="height: 100%;" id="app">
			<div style="position: relative;">
				<img src="assets/img/phb_top.jpg" alt="">
				<img class="wx_head" v-bind:src="tximgurl" alt="">
				<div class="process">
					<div v-bind:style="{width:width_y+'rem'}" class="process_y"></div>
					<img v-if="egg_num!=24" class="small_egg" v-bind:style="{left:posi_left+'rem'}" src="assets/img/phb_bigegg.png" alt="">
					<img style="position: absolute;right: -0.6rem;top: -0.5rem;width: 1rem;" src="assets/img/phb_gift.png" alt="">
				</div>
				<div class="egg_ruler">
					<p v-if="egg_num == 0" style="float: left;">0</p>
					<p v-if="egg_num<24" class="egg_num" v-bind:style="{marginLeft:posi_left+'rem'}">{{egg_num}}</p>
					<p style="float: right;margin-right:-0.3rem;">24</p>
				</div>
			</div>
			<div class="myfdlb">
				我的福蛋礼包
				<span class="prompt">(满24枚可兑换一提快乐的蛋)</span>
				<a @click="exchange" v-bind:class="{'exchange_btn':style_flag}" class="exchange" href="javascript:void(0)">兑换</a>
			</div>
			<ul class="friend_ul">
				<li v-for="item in items">
					<p class="dian_small"></p>
					<p class="friend_name">{{item.nickname}}</p>
					<div class="send_div">
						<p class="send_fudai">赠送您一枚福蛋</p>
						<img class="send_img" src="assets/img/phb_egg.png" alt="">
					</div>
					<p class="friend_time">{{item.add_time}}</p>
				</li>
			</ul>
			<div class="phb">排行榜</div>
			<ul style="width: 100%;padding-bottom:.5rem;">
				<li class="li_all" v-for="(item,index) in items_all">
					<img v-if="index<3" class="medal" v-bind:src="'assets/img/'+index+'st.png'" alt="">
					<p v-if="index>=3" class="ranking">{{ index+1 }}</p>
					<img class="tx_all" v-bind:src="item.pic" alt="">
					<div style="height: 1rem;float: left;line-height: 1rem;">
						<p class="name_all">{{item.nickname}}</p>
						<!-- <p class="wish_all">{{index}}份祝福</p> -->
					</div>
					<p class="egg_all">{{item.egg_num}}枚鸡蛋</p>
				</li>
			</ul>
			<div class="continue_send">
				<a href="create_wish.php">继续赠送好友祝福</a>
			</div>
	    </div>
		<script src="assets/js/vue.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="assets/js/vue-resource.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="assets/js/commom.js" type="text/javascript" charset="utf-8"></script> 
		<script type="text/javascript">
			var app = new Vue({
			  el: '#app',
			  data: {
			  	posi_left:'',
			  	width_y:'',
			  	tximgurl:'',
			  	egg_num:'1',
			  	style_flag:false,
			  	btn_status:'',
			  	items:[
			  		
			  	],
			  	items_all:[
			  		
			  	]

			  },
			  methods:{
			  	exchange:function(){
			  		if(this.btn_status==4){
			  			location.href="write_address.html"
			  		}else{
			  			alert('还未集齐不可兑换')
			  		}
			  	}
			  },
			  created:function(){
			  	var _this=this;
			  	this.$http.post(validate.url+"/Api/NewYearGift/userInfo",{openid:"<?php echo $a['openid']; ?>"},{emulateJSON:true}).then(
		            function (res) {
		                // 处理成功的结果
		                console.log(JSON.stringify(res.body))
		                if(res.body.code==1){
							_this.tximgurl=res.body.result.userInfo.pic;
							_this.egg_num=res.body.result.userInfo.egg_num;
							_this.items=res.body.result.log;
							_this.items_all=res.body.result.rank;
							_this.btn_status=res.body.result.exchange.status;
							_this.posi_left=_this.egg_num*0.078;
							localStorage.setItem("wish_info",JSON.stringify({"openid":res.body.result.userInfo.openid,"pic":res.body.result.userInfo.pic}))
							if(_this.egg_num<=23){
								_this.width_y=_this.egg_num*0.078;
							}else{
								_this.width_y=2.3;
							}
							if(res.body.result.exchange.status==4){
								_this.style_flag=true;
							}

		                }else{
		                	alert(res.body.msg)
		                }
		                
		            },function (res){
		            	// 处理失败的结s果
		            	alert("请求失败!")
		            }
		        )
			  }
			})
		</script>
	</body>
</html>