<?php

   include "../../lanewechat.php";
   $redirect_uri = 'LaneWeChat2/kuailededan/send_happyegg/write_info.php';
   \LaneWeChat\Core\WeChatOAuth::getCode($redirect_uri, $state=1, $scope='snsapi_base');
   $code = $_GET['code'];
   $a = \LaneWeChat\Core\WeChatOAuth::getAccessTokenAndOpenId($code);
  // $user_info = \LaneWeChat\Core\WeChatOAuth::getUserInfo($a['access_token'],$a['openid'],$lang='zh_CN');
// echo $user_info['nickname'];
// echo $user_info['headimgurl'];
// echo $user_info['openid'];
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
			html,body{background: #ffe500;width: 100%;}
			.box{margin:.4rem .4rem 0 .4rem;box-sizing: border-box;
			position: relative;}
			 img{width: 100%;display: inline-block;}
			.write_box{z-index: 999;box-sizing: border-box;margin: 0 auto;position: absolute;top: 0;text-align: center;
			font-size: 0;padding: 0 .3rem;width: 100%;margin-top: .15rem;overflow: hidden;}
	        .tx{margin: .8rem auto .4rem;width: 100%;}
	        .tx img{width: 1rem;height: 1rem;display: inline-block;margin: 0 auto;border-radius: 50%;}
			.write_box input,.write_box p{display: block;font-size: .28rem;
			color: #bbbbbb;line-height: .6rem;width: 100%;}
			.small_box{width: 4.28rem;float: left;margin-bottom: .42rem;
			height: .6rem;position: relative;}
			.small_box:after{content: "";position: absolute;
			left: 0;bottom: 0;width: 100%;height: 1px;background-color: #e4c600;
			-webkit-transform: scaleY(.5);transform:scaleY(.5);}
			.input_box{float: left;}
			.input_box span{display: block;float: left;margin: .07rem .22rem 0 .6rem;}
			.input_box img{width: .42rem;display: inline-block;}
			
			.submit1_btn{box-sizing: border-box;width:100%;height: 1rem;float: left;margin-top: .3rem;}
			.submit1_btn a{width: 5rem;height: 1rem;line-height: 1rem;text-align: center;color: #ffffff;
			font-size: .32rem;background: #fc4602;display: inline-block;margin:0 auto ;
			border-radius: .1rem;font-family: "微软雅黑";}
			.weui-picker{	font-size: 15px;
					    position: fixed;
					    width: 100%;
					    left: 0;
					    bottom: 0;
					    z-index: 5000;
					    -webkit-backface-visibility: hidden;
					    backface-visibility: hidden;
					    -webkit-transform: translateY(100%);
					    transform: translateY(100%);
					    -webkit-transition: -webkit-transform .3s;
					    transition: -webkit-transform .3s;
					    transition: transform .3s;
					    transition: transform .3s,-webkit-transform .3s;
		}
		</style>
	</head>
	<body>
		<div id="app">
			<div class="box">
				<img src="assets/img/bg_write.png"/>
				<div class="write_box">
					<div class="tx">
						<img v-bind:src="pic"/>
					</div>
					<div class="input_box">
						<span><img src="assets/img/name.png"/></span>
						<div class="small_box">
							<input class="name" type="text" placeholder="联系人" v-model="name">
						</div>
						

					</div>
					
					<div class="input_box">
						<span><img src="assets/img/tel.png"/></span>
						<div class="small_box">
                			<input class="tel" type="tel" placeholder="联系电话" v-model="tel">
                		</div>
                	</div>
                	
                	<div class="input_box">
						<span><img src="assets/img/address.png"/></span>
						<div class="small_box">
							<input class="address" type="text" placeholder="配送地址" v-model="address">
						</div>
					</div>
					<div class="input_box">
						<span style="width: .42rem;"></span>
						<div class="small_box">
							<input class="address" type="text" placeholder="详细楼号/门牌号等" v-model="address_detail">
						</div>
					</div>
					<div class="input_box">
						<span><img src="assets/img/date.png"/></span>
   	             		<div class="small_box">
   	             			<p style="margin-bottom: 0;text-align: left;" @click="chosedate">{{date}}</p>
                		</div>
                	</div>
                	
					<div class="submit1_btn" >
			            <a href="javascript:void(0);"  @click="submit">提交</a>
			        </div>
				</div>
			</div>	
	        	
	    </div>
	     <script type="text/html" id="tpl_home">
    	</script>
    	<script type="text/html" id="tpl_picker">
    	</script>
		<script src="assets/js/vue.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="assets/js/vue-resource.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="assets/js/commom.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
		<script src="assets/js/weui.min.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			var app = new Vue({
			  el: '#app',
			  data: {
			 	name:"",
			 	address:"",
			 	tel:"",
			 	code:"",
			 	date:"配送日期",
			 	pic:"",
			 	address_detail:""
			 	
			  },
			  created:function(){
					var _this=this;
					_this.pic=JSON.parse(localStorage.getItem("order_number")).pic;
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
		                    jsApiList: ['getLocation']
		                });
		                wx.ready(function () {
		                    wx.getLocation({
							    type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
							    success: function (res) {
							    	
							        var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
							        var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
							  		
							  		_this.$http.get(validate.url+'/getAddressInfo/geocoder/v2/?location='+latitude+','+longitude+'&output=json&pois=1&ak=0r5h4bhrVoUjEvrNc8Lx0NLUcP9xiaQo&coordtype=wgs84ll').then(function(res){
					                    
					                    res=JSON.parse(res.body)
					                  
					                    if(res.status==0){
					                    	
					                    	_this.address=res.result.formatted_address;
					                    }else{
					                    	alert("定位失败！")
					                    }
					                    
					                },function(response){
					                    //console.info(response);
					            		alert("请求出错!")
					                })
							    }
							});
		                });
		                wx.error(function(res){
						    alert("验证失败!")
						})
			        },function(response){
			        	console.info(response);
			        });
	          },
	          methods:{
	         	submit:function(){
	         		var _this=this;
	         		if(this.name==""){
			  			alert("请输入姓名")
			  			return
			  		}else if(this.address==""){
			  			alert("请输入地址")
			  			return
			  		}else if(!validate.phone(_this.tel)){
			  			alert("请输入正确的手机号")
			  			return
			  		}else if(this.address_detail==""){
			  			alert("请输入详细楼号、门牌号等")
			  			return
			  		}else if(this.date=="配送日期"){
			  			alert("请选择您的配送日期")
			  			return
			  		}
			  		
			  		var order_sn=JSON.parse(localStorage.getItem("order_number")).order_sn;
			  		var nick_name=JSON.parse(localStorage.getItem("order_number")).nick_name;
			  		var pic=JSON.parse(localStorage.getItem("order_number")).pic;
	         		this.$http.post(validate.url+"/Api/WxHappyEgg/saveReceiver",{real_name:this.name,address:this.address+this.address_detail,tel:this.tel,nike_name:nick_name,pic:pic,open_id:"<?php echo $a['openid']; ?>",order_sn:order_sn,receive_time:this.date},{emulateJSON:true}).then(
			            function (res) {
			                // 处理成功的结果
			                //console.log(JSON.stringify(res.body))
			                if(res.body.code==1){
			                	//alert(res.body.result.user_name)
			                	//alert(res.body.result.wish_word)
			                	localStorage.setItem("order_sender",JSON.stringify({"user_name":res.body.result.user_name,"wish_word":res.body.result.wish_word}))
			                	alert(res.body.msg);
			                	location.href="wish_egg.html"
			                }else{
			                	alert(res.body.msg)
			                }
			                
			            },function (res){
			            	// 处理失败的结果
			            	alert("请求失败!")
			            }
			        )
	         	},
	         	chosedate:function(){
			  		_this=this;
			  		weui.datePicker({
            			start: 2017,
            			end: new Date().getFullYear(),
	            		onChange: function (result) {
	                		//console.log(result);
	                		month=result[1]+1;
	                		_this.date=result[0]+'-'+month+'-'+result[2];
	            		},
	            		onConfirm: function (result) {
	                		//console.log(result);
	            		}
        			});
			  	}
		      }
			})
		</script>
	</body>
</html>
