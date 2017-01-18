<?php
		
        $info['mch_billno'] = "1353451202201611101234567891";
        $info['wecha_id']   = "oQUJpv9D5n8VOY79S4kjB6jxn5Qc";
        $info['reward'] = 0.01;

			$sign=MD5('act_name=养鸡管家提成红包&client_ip=127.0.0.1&mch_billno='.$info['mch_billno'].'&mch_id=1353451202&nonce_str=5K8264ILTKCH16CQ2502SI8ZNMTM67VS&re_openid='.$info['wecha_id'].'&remark=1&send_name=邦铭农信&total_amount='.($info['reward']*100).'&total_num=1&wishing=1&wxappid=wxae085b95829a51af&key=947b95fbbadea48a58dfd1b08612bf7c');
			$vals="<xml>
				<act_name>养鸡管家提成红包</act_name>
				<client_ip>127.0.0.1</client_ip>
				<mch_billno>".$info['mch_billno']."</mch_billno>
				<mch_id>1353451202</mch_id>
				<nonce_str>5K8264ILTKCH16CQ2502SI8ZNMTM67VS</nonce_str>
				<re_openid>".$info['wecha_id']."</re_openid>
				<remark>1</remark>
				<send_name>邦铭农信</send_name>
				<total_amount>".($info['reward']*100)."</total_amount>
				<total_num>1</total_num>
				<wishing>1</wishing>
				<wxappid>wxae085b95829a51af</wxappid>
				<sign>".$sign."</sign>
			</xml>";

			 	$data = curl_post_ssl('https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack',$vals);
	
			
	
function curl_post_ssl($url, $vars, $second=30,$aHeader=array())
	{
		$ch = curl_init();
		//超时时间
		curl_setopt($ch,CURLOPT_TIMEOUT,$second);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
		//这里设置代理，如果有的话
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);	
		
		//cert 与 key 分别属于两个.pem文件
		curl_setopt($ch,CURLOPT_SSLCERT,'../cert/apiclient_cert.pem');
 		curl_setopt($ch,CURLOPT_SSLKEY,'../cert/apiclient_key.pem');
 		curl_setopt($ch,CURLOPT_CAINFO,'../cert/rootca.pem');
	

		if( count($aHeader) >= 1 ){
			curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
		}
	 
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$vars);
		$data = curl_exec($ch);
		var_dump($data);
		$info = simplexml_load_string($data);
		
		return $info->result_code;
	}
?>





