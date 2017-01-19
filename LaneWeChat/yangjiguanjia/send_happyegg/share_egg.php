<?php

   include "../../lanewechat.php";
   $b = $_GET['order_sn']; 
   $redirect_uri = 'LaneWeChat/yangjiguanjia/send_happyegg/share_egg.php';
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
		<style type="text/css">
			html,body{background: #e7610f;}
			.bg img{width: 100%;display: inline-block;}
			.top_box{position: relative;font-size: 0;width: 100%;}
			.top{position: absolute;top: 0;left: 0;text-align: center;width: 100%;}
			.top .total{font-size: .46rem;color: #222222;margin-top: .4rem;font-family: "微软雅黑";}
			.top .left{margin-top:;font-size: .46rem;font-weight: bold;font-family: "微软雅黑";line-height: .7rem;}
			.left span{font-size: .72rem;color: #fc4700;}
			.btn_box{margin-top: .2rem;}
			.btn_box a{display: inline-block;width: 5rem;height: 1rem;line-height: 1rem;font-size: .32rem;color: #ffffff;
			font-family: "微软雅黑";background: #fb4700;border-radius: .1rem;}
			.got_info{font-size: .28rem;color: #222222;margin-top: .2rem;}
			.got_info span{color: #fc4700;}
			
			.got_list{font-size: 0;width: 100%;padding:0 .5rem;box-sizing: border-box;}
			#example-1 ul{width: 100%;}
			#example-1 li{width: 100%;box-sizing: border-box;border-bottom: 1px solid #ca5309;font-size: .2rem;
			height: 1.4rem;overflow: hidden;}
		    .tx{display: block;border-radius: 50%;width: .7rem;height: .7rem;background: white;
		    margin-top: .4rem;float: left;overflow: hidden;}
			.tx img{width: 100%;border-radius: 50%;}
			.info_box{margin-left: .2rem;color: #222222;display: block;float: left;margin-top: .26rem;}
			.info_box .name{font-size: .28rem;margin-top: .1rem;display: block;}
			.info_box .time{font-size: .2rem;display: block;}
			.condition{float: right;}
			.condition img{width: 1.16rem;display: inline-block;margin-top: .1rem;}
			.delete_btn{display: inline-block;width: 1.07rem;height: .6rem;line-height: .6rem;text-align: center;
			color: #ffffff;font-family: "微软雅黑";font-size: .24rem;background: #bba051;border-radius: .4rem;margin-top: .4rem;}
			.time_left{font-size: .22rem;color: #ffffff;line-height: 1.4rem;font-family: "微软雅黑";}
		
			.bg_box{width: 100%;height: 100%;}
			.direct{position: fixed;top: 0;z-index: 999;height: 100%;}
			.direct img{width: 100%;height: 100%;display: inline-block;}
			.know{position: fixed;top: 30%;right:1rem;width: 1.93rem;z-index: 999;}
			.know img{width: 100%;display: inline-block;}
			
			
		</style>
	</head>
	<body>
		<div id="app">
			<div class="bg_box" v-if="flag" >
				<div class="direct"><img src="assets/img/direct.png"/></div>
				<div class="know" @click="know"><img src="assets/img/know.png"/></div>
			</div>
			<div class="top_box">
				<div class="bg">
					<div v-if="status == 1">
						<img src="assets/img/bg.jpg" />
					</div>
					<div v-else-if="status == 0">
					  <img src="assets/img/bg2.jpg" />
					</div>
				</div>
				<div class="top" v-if="status == 1">
					<p class="total">送出{{ total_amount }}个鸡蛋礼包</p>
					<p class="left">剩余<span>{{ last_amount }}</span>个</p>
			        <div class="btn_box">
			            <a href="javascript:void(0);" class="send_btn" @click="send">继续赠送好友</a>
			        </div> 
					<p class="got_info">已有<span>{{ catched_amount }}</span>人抢到红包，看看大家手气如何</p>
				</div>
				
			</div>
			<div class="got_list">
				<ul id="example-1">
				  <li v-for="(item, index) in items">
				  	<!--<floor  v-for="(item, index) in items" v-bind:item="item" v-bind:index="index" v-bind:name="{{item.name}}" v-bind:time="{{item.time}}" v-bind:condition="{{item.condition}}"></floor>-->
				    <span class="tx"><img v-bind:src="item.pic"></span>
				    <div class="info_box">
				    	<span class="name">{{ item.nick_name }}({{ item.real_name }})</span>
				    	<span class="time">{{ item.create_time }}</span>
				    </div>
				    <div class="condition">
				    	<div v-if="item.status == 1&&item.last_time == 0">
						  <img src="assets/img/got.png"/>
						</div>
						<div v-else-if="item.status == 0">
						  <img src="assets/img/err.png"/>
						</div>
						<div v-if="status == 1">
							<div v-if="item.status == 1&&item.last_time>0">
							  <span class="time_left">({{ item.last_time }}s后自动领取)</span>
							  <a href="javascript:void(0);" class="delete_btn" @click="refuse(item.receive_id,index)">拒绝</a>
							</div>	
						</div>
				    </div>
				   
				    <!--<span>第{{index+1}}楼</span><span>剩余{{ item.time_left }}s</span> <span>{{ item.time }}</span> <span>{{ item.condition | condition }}</span>
				    <div class="delete_btn">
				    	<a href="javascript:void(0);" class="weui-btn weui-btn_mini weui-btn_primary" @click.stop.prevent="sure(item.name)">拒绝</a>
				    </div>-->
				  </li>
				</ul>
			</div>
			
	    </div>
	    <template id="myComponent" >
            <span>{{ time_left }}</span>
        </template>
		<script src="assets/js/vue.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="assets/js/vue-resource.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="assets/js/commom.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
		<script type="text/javascript">
			Vue.component('floor',{
	            template: '#myComponent',
	            props:["name","time","condition"]
	        })
			var app = new Vue({
			  el: '#app',
			  data: {
			    items:[
			    	
			    ],
			    flag:false,
			    total_amount:"",
			    last_amount:"",
			    catched_amount:"",
			    status:null,
			    title:"",
			    desc:"",
			    amount:null,
			    unit_price:null
			   
			  },
			  filters:{
			  	condition:function(value){
			  		if(value==1){
			  			return "已领取"
			  		}else if(value==0){
			  			return "未领取"
			  		}
			  	},
			  	time:function(value){
			  		var _this=this;
				  	var time=setInterval(function(){
				  		_this.time_left--
				  		if(_this.time_left<0){
				  		   clearInterval(time)
				  		   _this.time_left="end";
				  		}
				  	},1000)
			  	}
			  },
			  methods:{
			  	refuse:function(value,index){
			  		var _this=this
			  		this.$http.post(validate.url+"/Api/WxHappyEgg/setCatchLogStatus",{order_sn:"<?php echo $order_sn;?>",open_id:"<?php echo $a['openid']; ?>",receive_id:value},{emulateJSON:true}).then(
			            function (res) {
			                // 处理成功的结果
			                if(res.body.code==1){
			                	alert(res.body.msg)
//			                	alert(index)
//			                	alert(_this.items[index].status)
			                	
				  				_this.items[index].status=0;		   
			                }else if(res.body.code==0){
			                	alert(res.body.msg)
			                }
			               
			            },function (res) {
			            	// 处理失败的结果
			            	alert("请求失败")
			            }
			        )
			  	},
			  
			  	time_left:function(index){
			  			var _this=this;
			  			var time=setInterval(function () {
			  				//Vue.set(_this.list[i],'time',count);<br>			           
			  				_this.items[index].last_time--;		            
				  			if(_this.items[index].last_time<0){		            	
				  				clearInterval(time)			            	
				  				_this.items[index].last_time=0;		            	
				  				_this.items[index].status=1;		     
				  			}
			  			}, 1000)	
			  	},
			  	send:function(){
			  		this.flag=true;
			  	},
			  	know:function(){
			  		this.flag=false
			  	}
			  },
			  created:function(){
			  		var _this=this;
				    //alert(location.href)
				    //请求抢红包详情
			      	
					_this.$http.post(validate.url+"/Api/WxHappyEgg/getCatchInfo",{order_sn:"<?php echo $order_sn;?>",open_id:"<?php echo $a['openid']; ?>"},{emulateJSON:true}).then(
			            function (res) {
			                // 处理成功的结果
			                //alert(JSON.stringify(res.body))
			                if(res.body.code==1){
			                	//alert(res.body.result.status)
			                	if(res.body.result.status==1){  //判断是购买人进入红包详情 还是其他人
			                		_this.status=1;
//			                		_this.my=true;
//			                		_this.others=false
			                	}else if(res.body.result.status==0){
			                		_this.status=0;
//			                		_this.my=false;
//			                		_this.others=true;
			                	}
			                	_this.total_amount=res.body.result.total_amount;
			                	_this.unit_price=res.body.result.unit_price;
			                	
			                	if(_this.total_amount==1){
			                		_this.desc="小小福蛋，拳拳心意，慢慢祝福，大大惊喜，还不打开看看，记得填收件地址哦。"
			                		if(_this.unit_price==39.6){
			                			_this.title="送你1份快乐的蛋，祝您鸡年大吉"
			                		}else if(_this.unit_price==950.6){
			                			_this.title="送你1份半年套餐-快乐的蛋，祝您鸡年大吉"
			                		}else if(_this.unit_price==1900.8){
			                			_this.title="送你1份整年套餐-快乐的蛋，祝您鸡年大吉"
			                		}
			                		
			                	}else if(_this.total_amount==5||_this.total_amount==10){
			                		_this.desc="小小福蛋传心意，快乐健康一整年，我的祝福，请您一定要收下！记得填收件地址哦。"
			                		if(_this.unit_price==39.6){
			                			_this.title="送"+_this.total_amount+"份快乐的蛋，祝您鸡年大吉"
			                		}else if(_this.unit_price==950.6){
			                			_this.title="送"+_this.total_amount+"份半年套餐-快乐的蛋，祝您鸡年大吉"
			                		}else if(_this.unit_price==1900.8){
			                			_this.title="送"+_this.total_amount+"份整年套餐-快乐的蛋，祝您鸡年大吉"
			                		}
			                	}else{
			                		_this.desc="过年了！我送大家"+_this.total_amount+"份健康快乐的蛋，每份有惊喜，快来抢！记得填收件地址哦。"
			                		if(_this.unit_price==39.6){
			                			_this.title="送大家"+_this.total_amount+"份快乐福蛋，全年的快乐都有了"
			                		}else if(_this.unit_price==950.6){
			                			_this.title="送大家"+_this.total_amount+"份半年套餐-快乐福蛋，全年的快乐都有了"
			                		}else if(_this.unit_price==1900.8){
			                			_this.title="送大家"+_this.total_amount+"份整年套餐-快乐福蛋，全年的快乐都有了"
			                		}
			                	}
			                	
			                	_this.last_amount=res.body.result.last_amount;
			                	_this.catched_amount=res.body.result.catched_amount;
			                	_this.items=res.body.result.catch_info;
			                	
						  		for(var i=0;i<_this.items.length;i++){
						  			var index=i;
						  			if(_this.items[i].status==1){
						  				_this.time_left(index)
						  			}
						  		}
			                }else if(res.body.code==0){
			                	
			                }
			               
			            },function (res) {
			            	// 处理失败的结果
			            	alert("请求失败")
			            }
			        )
				    
				    if(_this.status=1){
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
			                    jsApiList: ['onMenuShareAppMessage']
			                });
			                wx.ready(function () {
			                    wx.onMenuShareAppMessage({
			                    	title: _this.title, // 分享标题
								    desc: _this.desc, // 分享描述
								    link: 'http://weixin.yangjiguanjia.com/LaneWeChat/yangjiguanjia/send_happyegg/receive_info.php?order_sn='+"<?php echo $order_sn;?>", // 分享链接
								    imgUrl: 'http://weixin.yangjiguanjia.com/LaneWeChat/yangjiguanjia/send_happyegg/assets/img/imgurl.jpg', // 分享图标
								    type: 'link', // 分享类型,music、video或link，不填默认为link
								    dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
			                        success: function () { 
			                            // 用户确认分享后执行的回调函数
			                            //alert("分享成功了！")
			                            _this.flag=false;    
			                        },
			                        cancel: function () { 
			                            // 用户取消分享后执行的回调函数
			                            _this.flag=false;
			                            alert("不分享朋友会收不到你的祝福哦！")
			                        }
			                    });
			                });
				        },function(response){
				        	console.info(response);
				        });
				    }	    
			  }
			  
			})
		</script>
	</body>
</html>
