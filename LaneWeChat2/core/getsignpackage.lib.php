<?php
namespace LaneWeChat\Core;
/**
 * 获取JSSDK接口所需要得签名包
 * Created by cp3
 * User: cp3
 * Date: 17-1-7
 * Time: 上午9:51
 * E-mail: wangbaojin1006@163.com
 */
class GetSignPackage
{


    public static function getSignPackage($url = '')
    {
        $jsapiTicket = GetSignPackage::getJsApiTicket();


        // 注意 URL 一定要动态获取，不能 hardcode.
    //    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
      //  $completePath = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        //暂时写写死
        $url = $url ? $url : $completePath;
        
        $timestamp = time();
        $nonceStr = GetSignPackage::createNonceStr();

        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

        $signature = sha1($string);

        $signPackage = array(
            "appId" => WECHAT_APPID,
            "nonceStr" => $nonceStr,
            "timestamp" => $timestamp,
            "url" => $url,
            "signature" => $signature,
            "rawString" => $string
        );
        return $signPackage;
    }

    public static function createNonceStr($length = 16)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    public static function getJsApiTicket()
    {
        // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
        $accessToken = AccessToken::getAccessToken();
        // 如果是企业号用以下 URL 获取 ticket
        // $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
        $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
        $res = json_decode(Curl::callWebServer($url, '', 'GET', 0));
        return $res->ticket;
    }



}
