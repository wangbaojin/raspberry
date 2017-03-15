<?php

   include "../../lanewechat.php";
   $redirect_uri = 'LaneWeChat2/kuailededan/exchange_ticket/write_info.php';
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
		<title>快乐的蛋－兑换</title>
		<script src="assets/js/rem.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" type="text/css" href="assets/css/reset.css"/>
		<link rel="stylesheet" type="text/css" href="https://res.wx.qq.com/open/libs/weui/1.1.0/weui.min.css"/>
		<style type="text/css">
			.weui-picker{	font-size: 15px;}
		</style>
	</head>
	<body>
	
		<div id="app">
			<div class="weui-cells__title" style="margin-top: 30px;">快乐的蛋信息填写</div>
			<div class="weui-cells weui-cells_form">
	            <div class="weui-cell" id="">
	                <div class="weui-cell__hd"><label class="weui-label">姓名</label></div>
	                <div class="weui-cell__bd">
	                    <input class="weui-input" v-model="name" type="text" placeholder="请填写您的姓名">
	                </div>
	            </div>
	            <div class="weui-cell" id="">
	                <div class="weui-cell__hd"><label class="weui-label">手机</label></div>
	                <div class="weui-cell__bd">
	                    <input class="weui-input" v-model="tel" type="tel"  placeholder="请输入手机号码">
	                </div>
	            </div>
	            <div class="weui-cell" id="">
	                <div class="weui-cell__hd"><label class="weui-label">地址</label></div>
	                <div class="weui-cell__bd">
	                    <input class="weui-input" v-model="address" type="text" placeholder="请填写您的收货地址">
	                </div>
	            </div>
	            
	            <div class="weui-cell" id="datePicker" @click="choose_date">
	                <div class="weui-cell__hd"><label class="weui-label">日期</label></div>
	                <div class="weui-cell__bd">
	                    <span class="date" style="color: lightgray;">{{date}}</span>
	                </div>
	            </div>
	        </div>
	        <div class="button-sp-area">
	        		<a style="width: 70%;margin-top: 30px;" href="javascript:void(0);" id="create" class="weui-btn weui-btn_plain-primary" @click="sure">确定</a>
			</div>
			<div class="weui-footer weui-footer_fixed-bottom">
	            <p class="weui-footer__links">
	                <a href="tel:010-84599723" class="weui-footer__link" style="font-size: 18px;">010-84599723</a>
	            </p>
	            <p class="weui-footer__text">邦铭农信科技(北京)有限公司  </p>
	        </div>
	    </div>
		<script src="assets/js/vue.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="assets/js/vue-resource.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="assets/js/weui.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="assets/js/commom.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
		<script type="text/javascript">
			var app = new Vue({
			  el: '#app',
			  data: {
			    name:"",
			 	address:"",
			 	tel:"",
			 	date:"请选择配送日期",
			 	order_sn:null
			  },
			  methods:{
			  	choose_date:function(){
			  		var _this=this;
			  		weui.datePicker({
					    start: new Date(),
					    end: "2017-"+_this.judge(new Date().getMonth()+2)+"-1",
					    //defaultValue: [3],
					    cron: '* * 6',
					    onChange: function(result){
					       _this.date=Number(result[0].value+_this.judge(result[1].value)+_this.judge(result[2].value));   
					    },
					    onConfirm: function(result){
					        _this.date=Number(result[0].value+_this.judge(result[1].value)+_this.judge(result[2].value));
					        
					    },
					    id: 'datePicker'
					});	
			  	},
			  	sure:function(){
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
			  		}else if(this.date=="配送日期"){
			  			alert("请选择您的配送日期")
			  			return
			  		}
			  		this.$http.post(validate.url+"/Api/DeliveryLog/add",{tel:_this.tel,real_name:_this.name,address:_this.address,open_id:"<?php echo $a['openid']; ?>",order_sn:_this.order_sn},{emulateJSON:true}).then(
			            function (res) {
			                if(res.body.code==1){
			                		alert(res.body.msg)
			                }else{
			                		alert(res.body.msg)
			                }
			                
			            },function (res){
			            		// 处理失败的结果
			           	 	alert("请求失败!")
			            }
			        )
			  	},
			  	judge:function(num){
			  		if(num<10){
						return "0"+num;
					}else{
						return ""+num;
					}
			  	}
			  },
			  created:function(){
			  	var _this=this;
				this.order_sn=JSON.parse(localStorage.getItem("exchange_info")).order_sn;
			    var url=location.href.split("&")[0]+"%26"+location.href.split("&")[1];
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
			  }
			})
		</script>
	</body>
</html>

