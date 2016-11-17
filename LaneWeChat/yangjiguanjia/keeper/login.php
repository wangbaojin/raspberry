<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<title>登录</title>
	<script type="text/javascript">

		if(localStorage.getItem("person")){
			location.replace("index.html")
		}
	</script>
	<script src="assets/js/rem.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/reset.css"/>
	<link rel="stylesheet" type="text/css" href="assets/css/weui.css"/>
	<style type="text/css">
		html,body{width: 100%;height: 100%;background: #fdf8e5;}
		section .login_box{padding: 0 .5rem;margin-top: 1.3rem;}
		.login_box input{
			box-sizing: border-box;
			display: inline-block;
			width: 100%;
			font-size: .28rem;
			line-height:.66rem;
			border-bottom: 1px solid #c9c3b2;padding-left: .2rem;}
		section{font-size: 0;overflow: hidden;}
		#pwd{
			margin-top: .5rem;width: 3.7rem;
		}
		#invite{
			margin-top: .5rem;
		}
		section .mes{width: 2.6rem;height: .7rem;text-align: center;line-height: .7rem;border-radius: .1rem;
			color: white;background: #fbc525;display: inline-block;font-size: .32rem;float: right;margin-top: .5rem;}
		section .login-btn{width: 100%;border: 1px solid #fbc525;height: .8rem;text-align: center;
			line-height: .8rem;color: #fbc525;font-size: .32rem;display: block;margin-top: 2.5rem;
			border-radius: .1rem;}

		section p{font-size: .24rem;color: #666666;width: 100%;margin-top: .3rem;overflow: hidden;height: ;}
		p img{width: .2rem;display: inline-block;}
		p span{display: block;overflow: hidden;float: left;margin-top: .085rem;}
		p .item{color: #6f9bd5;}

		.check .disagree{display: none;}

		.bottom{width: 100%;text-align: center;font-size: .22rem;color: #666666;position: absolute;
			bottom: .3rem;}
	</style>
</head>
<body>
<?php
    
   include "../../lanewechat.php";
   $redirect_uri = 'LaneWeChat/yangjiguanjia/keeper/login.php';
   \LaneWeChat\Core\WeChatOAuth::getCode($redirect_uri, $state=1, $scope='snsapi_base');
   $code = $_GET['code'];
   $a = \LaneWeChat\Core\WeChatOAuth::getAccessTokenAndOpenId($code);
   //echo $a['openid'];
 
?>
<section>
	<div class="login_box">
		<input type="tel" placeholder="手机号码" id="login-phone"/>
		<input type="tel" placeholder="验证码" id="pwd"/>
		<input type="hidden" id="wx_openid"/>
		<a href="javascript:void(0)" class="mes" id="mes">发送验证码</a>
		<a href="javascript:void(0)" class="login-btn" id="sendBtn">登录</a>
		<p>
			<span class="check"><img src="assets/images/agree.png" class="agree"/><img src="assets/images/disagree.png" class="disagree"/></span>
			&nbsp;我已阅读并同意<a class="item" href="javascript:void(0)">使用条款和隐私政策</a>
		</p>
	</div>
</section>
<div class="bottom">
	养鸡管家入口
</div>
<div id="loadingToast" class="weui_loading_toast" style="display:none;">
	<div class="weui_mask_transparent"></div>
	<div class="weui_toast">
		<div class="weui_loading">
			<div class="weui_loading_leaf weui_loading_leaf_0"></div>
			<div class="weui_loading_leaf weui_loading_leaf_1"></div>
			<div class="weui_loading_leaf weui_loading_leaf_2"></div>
			<div class="weui_loading_leaf weui_loading_leaf_3"></div>
			<div class="weui_loading_leaf weui_loading_leaf_4"></div>
			<div class="weui_loading_leaf weui_loading_leaf_5"></div>
			<div class="weui_loading_leaf weui_loading_leaf_6"></div>
			<div class="weui_loading_leaf weui_loading_leaf_7"></div>
			<div class="weui_loading_leaf weui_loading_leaf_8"></div>
			<div class="weui_loading_leaf weui_loading_leaf_9"></div>
			<div class="weui_loading_leaf weui_loading_leaf_10"></div>
			<div class="weui_loading_leaf weui_loading_leaf_11"></div>
		</div>
		<p class="weui_toast_content" style="color: #FFFFFF;">登录中！</p>
	</div>
</div>

<script src="assets/js/zepto.min.js" type="text/javascript" charset="utf-8"></script>
<script src="assets/js/zepto.tap.js" type="text/javascript" charset="utf-8"></script>
<script src="assets/js/common.js" type="text/javascript" charset="utf-8"></script>
<script src="assets/js/md5-min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
	
	var phone=$("#login-phone"),pwd=$("#pwd"),send=$("#sendBtn"),mes=$("#mes")
	var count = 60;
	var flag=true;
	var check = true;
	$("#wx_openid").val("<?php echo $a['openid']; ?>")
	$(".check").on("tap",function(){
		if(check){
			$(".disagree").css("display","inline-block")
			$(".agree").css("display","none")
			check=false
		}else if(check==false){
			$(".disagree").css("display","")
			$(".agree").css("display","")
			check=true;
		}
	})
	$(".item").on("tap",function(){
		location.href="userrProtol.html"
	})
	mes.on("tap",function(event){

		if(!validate.phone(phone.val())){
			alert("请输入正确的手机号！") 
		}else{
			if(flag){
				flag=false;
				event.preventDefault();
				GetNumber()
				var params={};
				params.mobile=$.trim(phone.val());
//						$.post("http://api1.yangjiguanjia.com:18002//User/sendSmsCode",params,function(data){
//									alert(data.msg);
//						});

				var version="1.2.2";
				params.timestamp=new Date().getTime();
				var signature=hex_md5(version+"mobile="+params.mobile+"&timestamp="+params.timestamp+"&version=1.2.2"+"Tv,cM02kjf^lWoU")
				params.signature=signature;
				params.version=version;

				$.ajax({
					type: 'post',
					url: 'http://weixin.yangjiguanjia.com/Api/User/sendSmsCode',
					data:params,
					success: function(data){
						//alert(data.msg)
					},
					error: function(data){
						alert(data)
					}
				})



			}

		}
	})

	function GetNumber() {
		mes.css("background","#cccccc");
		mes.html( "重新发送("+count +"s)");
		count--;
		if (count >= 0) {
			setTimeout(GetNumber, 1000);
		}
		else {
			mes.css("background","");
			mes.html("发送验证码");
			count=60;
			flag=true;
		}
	}
	send.on("tap",function(event){
		event.preventDefault();
		var params={};
		params.mobile=$.trim(phone.val());
		params.timestamp=new Date().getTime();
		params.code=$.trim(pwd.val());
		params.keeper=1;
		var version="1.2.2";
		var signature=hex_md5(version+"code="+params.code+"&keeper="+params.keeper+"&mobile="+params.mobile+"&timestamp="+params.timestamp+"&version=1.2.2"+"Tv,cM02kjf^lWoU")
		//alert(signature)
		params.signature=signature;
		params.version=version;
		params.wechat_id=$("#wx_openid").val();

		if(!validate.phone(params.mobile)){
			alert("请输入正确的手机号！")
			return
		}
		if(params.code==""){
			alert("请输入验证码！")
			return
		}
		if(check==false){
			alert("请同意使用条款和隐私政策！")
			return
		}
		$.post("http://weixin.yangjiguanjia.com/Api/User/login",params,function(data){
			$('#loadingToast').show();
			if(data.code===1){
				localStorage.setItem("person",JSON.stringify({"mobile":params.mobile,"id":data.result.id}))
				setTimeout(function(){
					$('#loadingToast').hide();
				},500)
				setTimeout(function(){
					location.href="index.html";
				},1000)

			}else{
				alert(data.msg);
				$('#loadingToast').hide();
			}
		})
	})
</script>
</body>
</html>
