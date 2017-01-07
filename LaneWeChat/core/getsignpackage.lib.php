<?php
namespace LaneWeChat\Core;
/**
 * 多媒体的上传与下载 本接口将会被删除,请替换为source.lib.php
 * Created by Lane.
 * User: lane
 * Date: 14-8-11
 * Time: 上午9:51
 * E-mail: lixuan868686@163.com
 * WebSite: http://www.lanecn.com
 */
class GetSignPackage{
  public function __construct() {
   // $this->appId = $appId;
    //$this->appSecret = $appSecret;
  } 
 
  public static function getSignPackage($url='') {
    $jsapiTicket = $this->getJsApiTicket();

    // 注意 URL 一定要动态获取，不能 hardcode.
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
      $completePath = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
   //暂时写写死
      $url = $url ? $url : $completePath;
    $timestamp = time();
    $nonceStr = $this->createNonceStr();

    // 这里参数的顺序要按照 key 值 ASCII 码升序排序
    $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

    $signature = sha1($string);

    $signPackage = array(
      "appId"     => $this->appId,
      "nonceStr"  => $nonceStr,
      "timestamp" => $timestamp,
      "url"       => $url,
      "signature" => $signature,
      "rawString" => $string
    );
    return $signPackage; 
  }

  private function createNonceStr($length = 16) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
  }

  public function getJsApiTicket() {
    // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
    $data = json_decode($this->get_php_file("jsapi_ticket.php"));
    if ($data->expire_time < time()) {
      $accessToken = AccessToken::getAccessToken();
      // 如果是企业号用以下 URL 获取 ticket
      // $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
      $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
      $res = json_decode($this->httpGet($url));
      $ticket = $res->ticket;
      if ($ticket) {
        $data->expire_time = time() + 7000;
        $data->jsapi_ticket = $ticket;
        $this->set_php_file("jsapi_ticket.php", json_encode($data));
      }
    } else {
      $ticket = $data->jsapi_ticket;
    }

    return $ticket;
  }

 

  private function httpGet($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
    // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, true);
    curl_setopt($curl, CURLOPT_URL, $url);

    $res = curl_exec($curl);
    curl_close($curl);

    return $res;
  }

  private function get_php_file($filename) {
    return trim(substr(file_get_contents($filename), 15));
  }
  private function set_php_file($filename, $content) {
    $fp = fopen($filename, "w");
    fwrite($fp, "<?php exit();?>" . $content);
    fclose($fp);
  }    
  public static function upload($filename, $type){
        //获取ACCESS_TOKEN
        $accessToken = AccessToken::getAccessToken();
        $queryUrl = 'http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token='.$accessToken.'&type='.$type;
        $data = array();
        $data['media'] = Curl::addFile($filename);
        return Curl::callWebServer($queryUrl, $data, 'POST', 1 , 0);
    }

    /**
     * 下载多媒体文件
     * @param $mediaId 多媒体ID
     * @return 头信息如下
     *
     * HTTP/1.1 200 OK
     * Connection: close
     * Content-Type: image/jpeg
     * Content-disposition: attachment; filename="MEDIA_ID.jpg"
     * Date: Sun, 06 Jan 2013 10:20:18 GMT
     * Cache-Control: no-cache, must-revalidate
     * Content-Length: 339721
     * curl -G "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=ACCESS_TOKEN&media_id=MEDIA_ID"
     */
    public static function download($mediaId){
        //获取ACCESS_TOKEN
        $accessToken = AccessToken::getAccessToken();
        $queryUrl = 'http://file.api.weixin.qq.com/cgi-bin/media/get?access_token='.$accessToken.'&media_id='.$mediaId;
        return Curl::callWebServer($queryUrl, '', 'GET', 0);
    }
}
