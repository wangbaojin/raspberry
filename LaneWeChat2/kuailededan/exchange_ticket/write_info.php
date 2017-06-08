<?php

   include "../../lanewechat.php";
   $redirect_uri = 'LaneWeChat2/kuailededan/exchange_ticket/write_info.php';
<<<<<<< HEAD

    \LaneWeChat\Core\WeChatOAuth::getCode($redirect_uri, $state=1, $scope='snsapi_base');

=======
    \LaneWeChat\Core\WeChatOAuth::getCode($redirect_uri, $state=1, $scope='snsapi_base');
>>>>>>> be461f6e1692fa4e98f8fc8069c3a4aa42ffbf1d
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
		<link rel="stylesheet" type="text/css" href="assets/css/normalize.css"/>
		<link rel="stylesheet" type="text/css" href="assets/css/stylesheet.css"/>
		<link rel="stylesheet" type="text/css" href="https://res.wx.qq.com/open/libs/weui/1.1.0/weui.min.css"/>
		<style type="text/css">
			.weui-picker{	font-size: 15px;}
			.banner{width: 100%;height: auto;}
			.common_form{height: 0.8rem;padding: 0.1rem 0.2rem;}
			.icon{height: 0.48rem;margin-right: 0.16rem;}
			.weui-cell:before {content: " ";position: absolute;left: 0;top: 0;right: 0;height: 1px;border-top: 1px solid #e5e5e5;color: #e5e5e5;-webkit-transform-origin: 0 0;transform-origin: 0 0;-webkit-transform: scaleY(.5);transform: scaleY(.5);left: 0.76rem;}
			.weui-cell__hd{font-size: 0.34rem;color:#353535;}
			.sex{width: 1rem;display: inline-block;margin-right: 1rem;margin-left: 0.16rem;color: #353535;}
			.weui-cells{font-size: 0.34rem;}
			.weui-icon-warn:before{content: "\EA0B";}
			.weui-cell_warn .weui-icon-warn {display: inline-block;}
			.fontcolor{color:#353535;}
			.date{width: 93%;display: inline-block;}
			/*.weui-icon-warn{font-size: 0.18rem;}*/
			.notice{height: 0.5rem;line-height: 0.5rem;background-color: #000;opacity: 0.5;width: 3rem;border-radius: 0.3rem;position: absolute;top: -0.8rem;left: 50%;margin-left: -1.5rem;font-size: 0.22rem;color:#fff;text-align: center;}
			.weui-picker__indicator {
    				height: 31px;
    				top: 107px;	
			}
			.weui-picker{font-size:18px;}
			.weui-picker__group{display: none;}
<<<<<<< HEAD

=======
>>>>>>> be461f6e1692fa4e98f8fc8069c3a4aa42ffbf1d
		</style>
	</head>
	<body>
	
		<div id="app">
<<<<<<< HEAD

=======
>>>>>>> be461f6e1692fa4e98f8fc8069c3a4aa42ffbf1d
			<img class="banner" src="assets/img/ex_banner.png" alt="">
			<div style="margin-top: 0.4rem;" class="weui-cells weui-cells_form">
	            <div class="weui-cell common_form" id="">
	                <div class="weui-cell__hd mr"><img class="icon" src="assets/img/name.png" alt=""></div>
	                <div class="weui-cell__bd">
	                    <input class="weui-input fontcolor" v-model="name" type="text" placeholder="请填写您的姓名">
<<<<<<< HEAD
	                </div>
	            </div>
	            <div style="padding-left: 0.76rem;" class="weui-cell common_form" id="">
	                <div @click="choose_sex(0)" class="weui-cell__hd mr">
	                	<img style="display: inline-block;height: 0.4rem;" v-bind:src="tick" alt="">
	                	<label class="weui-label sex">先生</label>
	                </div>
	                <div @click="choose_sex(1)" class="weui-cell__hd mr">
	                	<img style="display: inline-block;height: 0.4rem;" v-bind:src="square" alt="">
	                	<label class="weui-label sex">女士</label>
	                </div>
	            </div>
=======
	                </div>
	            </div>
	            <div style="padding-left: 0.76rem;" class="weui-cell common_form" id="">
	                <div @click="choose_sex(0)" class="weui-cell__hd mr">
	                	<img style="display: inline-block;height: 0.4rem;" v-bind:src="tick" alt="">
	                	<label class="weui-label sex">先生</label>
	                </div>
	                <div @click="choose_sex(1)" class="weui-cell__hd mr">
	                	<img style="display: inline-block;height: 0.4rem;" v-bind:src="square" alt="">
	                	<label class="weui-label sex">女士</label>
	                </div>
	            </div>
>>>>>>> be461f6e1692fa4e98f8fc8069c3a4aa42ffbf1d
	            <div class="weui-cell common_form" id="">
	                <div class="weui-cell__hd mr"><img class="icon" src="assets/img/tel.png" alt=""></div>
	                <div @click="icon_dis" class="weui-cell__bd">
	                    <input style="width: 90%;" class="weui-input fontcolor" v-model="tel" type="tel"  placeholder="请输入手机号码">
	                </div>
	                <div class="weui-cell__ft">
                    		<i v-bind:style="{display:icon}" class="weui-icon-warn"></i>
                	</div>
	            </div>
				<div id="picker5" class="weui-cell common_form" id="" @click="choose_add">
	                <div class="weui-cell__hd mr"><img class="icon" src="assets/img/location.png" alt=""></div>
	                <div class="weui-cell__bd">
	                    <span v-bind:style="{color:font_color}" class="date">{{address}}</span>
	                    <!-- <input class="weui-input fontcolor" v-model="address" type="text" placeholder="请填写地址"> -->
	                    <img style="height: 0.36rem;display: inline-block;margin-top: 0.05rem;" src="assets/img/arrow.png" alt="">
	                </div>
	            </div>
	            <div class="weui-cell common_form" id="">
	                <div class="weui-cell__hd mr"><img class="icon" src="assets/img/address.png" alt=""></div>
	                <div class="weui-cell__bd">
	                    <input class="weui-input fontcolor" v-model="address_details" type="text" placeholder="请精确填写至门牌号">
	                </div>
	            </div>
	            <div class="weui-cell common_form" id="datePicker" @click="choose_date">
	                <div class="weui-cell__hd mr"><img class="icon" src="assets/img/address.png" alt=""></div>
	                <div class="weui-cell__bd">
	                    <span v-bind:style="{color:fontcolor}" class="date">{{date}}</span>
	                    <img style="height: 0.36rem;display: inline-block;margin-top: 0.05rem;" src="assets/img/arrow.png" alt="">
	                </div>
	            </div>

	        </div>
	        <p style="font-size: 0.22rem;color: #888;margin-right: 0.3rem;text-align: right;margin-top: 0.2rem;">*每周日配送，共计{{send_num}}次</p>
	        <div style="position: relative;" class="button-sp-area">
	        		 <p v-show="notice" class="notice">*请正确填写电话号码</p>
	        		<img @click="sure" style="width: 6.9rem;margin:0.4rem auto 0.2rem;" src="assets/img/button_2.png" alt="">
			</div>
<<<<<<< HEAD

=======
>>>>>>> be461f6e1692fa4e98f8fc8069c3a4aa42ffbf1d
	    </div>
		<script src="assets/js/vue.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="assets/js/vue-resource.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="assets/js/weui.min.js" type="text/javascript" charset="utf-8"></script>
<<<<<<< HEAD

=======
>>>>>>> be461f6e1692fa4e98f8fc8069c3a4aa42ffbf1d
		<script src="assets/js/picker.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="assets/js/commom.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
		<script src="assets/js/city.js" type="text/javascript" charset="utf-8"></script>
		<script src="assets/js/index.js" type="text/javascript" charset="utf-8"></script>
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
<<<<<<< HEAD

=======
>>>>>>> be461f6e1692fa4e98f8fc8069c3a4aa42ffbf1d
			var app = new Vue({
			  el: '#app',
			  data: {
			    name:"",
			 	address:"请填写地址",
			 	address_details:"",
			 	tel:"",
			 	date:"请选择配送日期",
			 	order_sn:null,
			 	tick:"assets/img/tick.png",
			 	square:"assets/img/square.png",
			 	icon:"none",
			 	fontcolor:"#b2b2b2",
			 	font_color:"#b2b2b2",
			 	notice:false,
			 	card_tp:"",
			 	send_num:"",
			 	city:""
			  },
			  methods:{
			  	choose_date:function(){
			  		this.fontcolor="#353535";
			  		_this=this;
			  		weui.datePicker({
            			start: 2017,
            			end: new Date().getFullYear(),
	            		onChange: function (result) {
	                		//console.log(result);
	                		month=result[1]+1;
	                		_this.date=result[0]+'-'+_this.judge(month)+'-'+_this.judge(result[2]);
	            		},
	            		onConfirm: function (result) {
	                		//console.log(result);
	            		}
					});	
			  	},
			  	choose_sex:function(index){
			  		_this=this;
			  		if(index==0){
			  			_this.tick="assets/img/tick.png";
			  			_this.square="assets/img/square.png";
			  		}else{
			  			_this.tick="assets/img/square.png";
			  			_this.square="assets/img/tick.png";
			  		}
			  	},
			  	choose_add:function(){
			  		_this=this;
			  		this.font_color="#353535";
			  		picker.show();
			  		picker.on('picker.valuechange', function (selectedVal, selectedIndex) {
<<<<<<< HEAD
=======
  						console.log(nameEl.innerText)
>>>>>>> be461f6e1692fa4e98f8fc8069c3a4aa42ffbf1d
  						_this.address=nameEl.innerText;
					});
			  	},
			  	icon_dis:function(){
			  		this.icon="none";
			  		this.notice=false;
			  	},
<<<<<<< HEAD

=======
>>>>>>> be461f6e1692fa4e98f8fc8069c3a4aa42ffbf1d
			  	sure:function(){
	         		var _this=this;
	         		if(this.name==""){
			  			alert("请输入姓名")
			  			return
			  		}else if(this.address==""){
			  			alert("请输入地址")
			  			return
<<<<<<< HEAD

=======
>>>>>>> be461f6e1692fa4e98f8fc8069c3a4aa42ffbf1d
			  		}else if(this.address_details==""){
			  			alert("请输入门牌号")
			  			return
			  		}else if(!validate.phone(_this.tel)){
			  			_this.icon="block";
			  			_this.notice=true;
			  			return
			  		}else if(this.date=="请选择配送日期"){
			  			alert("请选择您的配送日期")
			  			return
			  		}
			  		var nick_name=JSON.parse(localStorage.getItem("exchange_info")).nick_name;
					var pic=JSON.parse(localStorage.getItem("exchange_info")).pic;
					this.order_sn=JSON.parse(localStorage.getItem("exchange_info")).order_sn;
<<<<<<< HEAD
			  		this.$http.post(validate.url+"/deliveryLogAdd",{tel:_this.tel,real_name:_this.name,address:_this.address+_this.address_details,open_id:"<?php echo $a['openid']; ?>",order_sn:_this.order_sn,delivery_time:_this.date,nick_name:nick_name,pic:pic},{emulateJSON:true}).then(
=======
			  		this.$http.post(validate.url+"/deliveryLogAdd",{tel:_this.tel,real_name:_this.name,address:_this.address,open_id:"<?php echo $a['openid']; ?>",order_sn:_this.order_sn,delivery_time:_this.date,nick_name:nick_name,pic:pic},{emulateJSON:true}).then(
>>>>>>> be461f6e1692fa4e98f8fc8069c3a4aa42ffbf1d
			            function (res) {
			                if(res.body.code==1){
			                		alert("兑换成功")
			                		localStorage.setItem("user_info",JSON.stringify({"order_sn":_this.order_sn,"address":_this.address+_this.address_details,"date":_this.date,"tel":_this.tel,"name":_this.name,"send_num":_this.send_num}))
			                		location.href="success.html"
			                }else{
			                		alert(res.body.error)
<<<<<<< HEAD

=======
>>>>>>> be461f6e1692fa4e98f8fc8069c3a4aa42ffbf1d
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
<<<<<<< HEAD

				this.card_tp=JSON.parse(localStorage.getItem("exchange_info")).card_tp;
				if(_this.card_tp==1){
					_this.send_num=2;
				}else if(_this.card_tp==2){
					_this.send_num=4;
				}else if(_this.card_tp==3){
=======
				this.card_tp=JSON.parse(localStorage.getItem("exchange_info")).card_tp;
				if(_this.card_tp==3){
					_this.send_num=2;
				}else if(_this.card_tp==1){
					_this.send_num=4;
				}else if(_this.card_tp==2){
>>>>>>> be461f6e1692fa4e98f8fc8069c3a4aa42ffbf1d
					_this.send_num=10;
				}else if(_this.card_tp==4){
					_this.send_num=20;
				}
			    var url=location.href.split("&")[0]+"%26"+location.href.split("&")[1];
<<<<<<< HEAD

=======
>>>>>>> be461f6e1692fa4e98f8fc8069c3a4aa42ffbf1d
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
						    	
						        latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
						        longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
<<<<<<< HEAD

=======
>>>>>>> be461f6e1692fa4e98f8fc8069c3a4aa42ffbf1d
						  		
						  		_this.$http.get(validate.url+'/getAddressInfo/geocoder/v2/?location='+latitude+','+longitude+'&output=json&pois=1&ak=0r5h4bhrVoUjEvrNc8Lx0NLUcP9xiaQo&coordtype=wgs84ll').then(function(res){
				                    
				                    res=JSON.parse(res.body)
				                  
				                    if(res.status==0){
				                    	
				                    		_this.address=res.result.formatted_address;
<<<<<<< HEAD

=======
				                    		//_this.city=_this.address.substr(0,2)
				                    		// if(_this.city=="黑龙江"){
				                    		// 	_this.city="黑龙江"
				                    		// }
				                    		
>>>>>>> be461f6e1692fa4e98f8fc8069c3a4aa42ffbf1d
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

