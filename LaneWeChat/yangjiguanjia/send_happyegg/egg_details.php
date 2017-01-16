<?php

   include "../../lanewechat.php"; 
   $b = $_GET['order_sn']; 
   $redirect_uri = 'LaneWeChat/yangjiguanjia/send_happyegg/egg_details.php';
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
			
		</style>
	</head>
	<body>
		<div id="app">
				
	    </div>
		<script src="assets/js/vue.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="assets/js/vue-resource.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="assets/js/commom.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			var app = new Vue({
			  el: '#app',
			  data: {
				
			  },
			  created:function(){
//              var url="json.jsp";
//				this.$http.get(url).then(function(data){
//                  //var json=data.body;
//                  //this.data=eval("(" + json +")");
//              },function(response){
//                  //console.info(response);
//              })
				var _this=this;
				
		  		localStorage.setItem("order_number",JSON.stringify({"order_sn":"<?php echo $order_sn;?>"}))
				this.$http.post(validate.url+"/Api/WxHappyEgg/",{order_sn:"<?php echo $order_sn;?>",open_id:"<?php echo $a['openid']; ?>"},{emulateJSON:true}).then(
		            function (res) {
		                // 处理成功的结果
		                if(res.body.code==1){
			                
		                }else if(res.body.code==0){
		                	//alert(res.body.error)
		               	
	                    }else{
	                		alert(res.body.msg)
	                    }
		                	
		                
		            },function (res) {
		            	// 处理失败的结果
		            	alert("请求失败")
		            }
		        )
	          },
	          methods:{

	          }
			})
		</script>
	</body>
</html>
