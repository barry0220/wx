<?php
class WxpayModel extends Model{
    private $appId;
    private $appSecret;
    private $wxapi;
    public function __construct() {
        $this->appId = APPID;
        $this->appSecret = APPSECRET;
    }
    
    public function route($fun,$param = ''){
		@require_once "oauth2.model.php";
		$this->wxapi = new Wxapi();
		switch ($fun){
			case 'userinfo':
				return $this->userinfo($param);
				break;
			case 'wxpacket':
				return $this->wxpacket($param);
				break;
			case 'wxpackets':
			    return $this->wxpackets($param);
			    break;
			default:
				exit("Error_fun");
		}
    }
    /**
     * 用户信息
     * 
     */	
	private function userinfo($param){ 
		$get = $param['param'];
		$code = $param['code'];	
		if($get=='access_token' && !empty($code)){
			$json = $this->wxapi->get_access_token($code);
			if(!empty($json)){
				$userinfo = $this->wxapi->get_user_info($json['access_token'],$json['openid']);
				return $userinfo;
			}
		}else{
			$this->wxapi->get_authorize_url('http://127.0.0.1/index.php?param=access_token','STATE');
		}
	}
    /**
     * 微信红包
     * 
     */		
	private function wxpacket($param){
		return $this->wxapi->pay($param['openid'],$param['worth']=100);
	}
	
	private function wxpackets($param){
	    return $this->wxapi->pay($param['openid'],$param['worth'],$param['wishing'],$param['act_name'],$param['send_name']);
	}
  
}