<?php
namespace Home\Controller;
use Think\Controller;
class WxController extends Controller {
    public function index()
    {
        //scope=snsapi_base 实例
        $appid='wx2327e2520ea021e2';
        $redirect_uri = urlencode ( 'http://www.barry0220.com/wx/getUserInfo' );
        $url ="https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_base&state=1#wechat_redirect";
        header("Location:".$url);

    }

    public function test()
    {
        $this -> display();
    }

    public function getUserInfo()
    {

        $appid = "wx2327e2520ea021e2";
        $secret = "683e58332894682a93426a98cc39ded9";
        $code = $_GET["code"];

        //第一步:取全局access_token
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$secret";
        $token = getJson($url);

        //第二步:取得openid
        $oauth2Url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code";
        $oauth2 = getJson($oauth2Url);

        //第三步:根据全局access_token和openid查询用户信息
        $access_token = $token["access_token"];
        $openid = $oauth2['openid'];
        $get_user_info_url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access_token&openid=$openid&lang=zh_CN";
        $userinfo = getJson($get_user_info_url);

        //打印用户信息
          print_r($userinfo);

        function getJson($url){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            return json_decode($output, true);
        }

    }

}