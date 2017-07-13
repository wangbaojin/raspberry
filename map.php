<?php
  $longitude = $_GET['longitude'];
  $latitude = $_GET['latitude'];
?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
		<meta name="apple-touch-fullscreen" content="YES" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<meta name = "format-detection" content = "telephone=no">
		<title>快乐的蛋－兑换</title>
    <style>
        body{
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: 0;
        }
        iframe{
            width: 100%;
            height: 100%;
        }
       
    </style>
</head>
<body>
<iframe id="test" src='https://m.amap.com/picker/?center=<?php echo $longitude.",".$latitude;?>&key=608d75903d29ad471362f8c58c550daf'></iframe>

    <script>
        (function(){
            var iframe = document.getElementById('test').contentWindow;
            document.getElementById('test').onload = function(){
                iframe.postMessage('hello','https://m.amap.com/picker/');
            };
            window.addEventListener("message", function(e){
                alert('您选择了:' + e.data.name + ',' + e.data.location)
                localStorage.setItem("map",JSON.stringify({"address":e.data.name}))
                window.history.back();
            }, false);
        }())
    </script>
    
<script type='text/javascript'>
	var mock = {
		log: function(result) {
			window.parent.setIFrameResult('log', result);
		}
	}
	console = mock;
	window.Konsole = {
		exec: function(code) {
			code = code || '';
			try {
				var result = window.eval(code);
				window.parent.setIFrameResult('result', result);
			} catch (e) {
				window.parent.setIFrameResult('error', e);
			}
		}
	}
</script><script type='text/javascript'>
	var mock = {
		log: function(result) {
			window.parent.setIFrameResult('log', result);
		}
	}
	console = mock;
	window.Konsole = {
		exec: function(code) {
			code = code || '';
			try {
				var result = window.eval(code);
				window.parent.setIFrameResult('result', result);
			} catch (e) {
				window.parent.setIFrameResult('error', e);
			}
		}
	}
</script></body>
</html>
