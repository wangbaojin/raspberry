<?php
ini_set('date.timezone','Asia/Shanghai');
error_reporting(E_ERROR);

require_once "../lib/WxPay.Api.php";
require_once "../lib/WxPay.Notify.php";
require_once "../../lib/db.class.php";
require_once "../../lib/alipay.config.php";
require_once 'log.php';

//初始化日志
$logHandler= new CLogFileHandler("../logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);

class PayNotifyCallBack extends WxPayNotify
{
	//查询订单
	public function Queryorder($transaction_id)
	{
		$input = new WxPayOrderQuery();
		$input->SetTransaction_id($transaction_id);
		$result = WxPayApi::orderQuery($input);
		Log::DEBUG("query:" . json_encode($result));
		if(array_key_exists("return_code", $result)
			&& array_key_exists("result_code", $result)
			&& $result["return_code"] == "SUCCESS"
			&& $result["result_code"] == "SUCCESS")
		{
			return true;
		}
		return false;
	}
	
	//重写回调处理函数
	public function NotifyProcess($data, &$msg)
	{
		Log::DEBUG("call back:" . json_encode($data));
		$notfiyOutput = array();
	        $db = new db(DB_HOST,DB_USER,DB_PW,DB_NAME);	
		if(!array_key_exists("transaction_id", $data)){
			$msg = "输入参数不正确";
			return false;
		}
		//查询订单，判断订单真实性
		if(!$this->Queryorder($data["transaction_id"])){
			$msg = "订单查询失败";
			return false;
		}
                //处理支付回调操作数据库的逻辑
                //订单号
                $out_trade_no = $data['out_trade_no'];
	        
                $db->exec("UPDATE ".DB_TABLEPRE."order SET status=1,payable=".$data['total_fee']."/100,pay_time=".time().",updated_at=".time().",pay_type='weixin',callback_data='".json_encode($data)."' WHERE order_sn='".$data['out_trade_no']."'"); 
              
                if(preg_match('/^3488.*$/',$out_trade_no)) {
                    //以3488开头的订单，即挂了分期，付了首付的订单
                   $sql = "select * from ".DB_TABLEPRE."order WHERE order_sn =".$out_trade_no."";  
                   
                   foreach($db->query($sql) as $value) 
                   { 
                       $bill_sn =  $value["bill_sn"]; 
                   }  
                   $db->exec("UPDATE ".DB_TABLEPRE."bill SET firstpay_status=1,update_at='".time()."' WHERE bill_sn='".$bill_sn."'");     
            
                }
                              
         	return true;
	}
}

Log::DEBUG("begin notify");

$notify = new PayNotifyCallBack();
$notify->Handle(true);
