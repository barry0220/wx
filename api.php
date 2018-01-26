<?php
/**
 * wechat php test
 */
header('Content-type:text');
//define your token
//定义TOKEN密钥
define("TOKEN", "weixin");
//实例化微信对象
$wechatObj = new wechatCallbackapiTest();
//验证成功后注释掉valid方法
//$wechatObj->valid();
//开启自动回复功能
$wechatObj->responseMsg();
//定义类文件
class wechatCallbackapiTest
{
    //实现valid验证方法：实现对接微信公众平台
    public function valid()
    {
        //通过GET请求接收随机字符串
        $echoStr = $_GET["echostr"];
        //调用checkSignature方法进行用户（开发者）数字签名验证
        //valid signature , option
        if($this->checkSignature()){
            //如果成功，则返回接收到的随机字符串
            echo $echoStr;
            //并退出
            exit;
        }
    }

    public function responseMsg()
    {
        //get post data, May be due to the different environments
        //接收用户端（客户）发送过来的XML数据
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        //extract post data
        //判断XML数据是否为空
        if (!empty($postStr)){
            /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
               the best way is to check the validity of xml by yourself */
            libxml_disable_entity_loader(true);
            //通过simplexml进行xml解析     PHP中有两大类可以完成对XML的解析，1.PHP的Dom模型2.通过simplexml模型
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            //手机端
            $fromUsername = $postObj->FromUserName;
            //微信公众平台
            $toUsername = $postObj->ToUserName;
            //接收用户发送的关键词
            $keyword = trim($postObj->Content);
            //时间戳
            $time = time();
            //文本发送模板
            $textTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Content><![CDATA[%s]]></Content>
                            <FuncFlag>0</FuncFlag>
                            </xml>";
            //判断用户发送关键词是否为空
            if(!empty( $keyword ))
            {
                //回复类型，如果为"text",代表文本类型
                $msgType = "text";
                //回复内容
                $contentStr = "Welcome to wechat world!";
                //格式化字符串（对xml进行格式化操作，把里面相关的变量格式化成字符串）
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                //把XML数据返回给手机端
                echo $resultStr;
            }
            //如果用户发送的关键词为空，则返回下列字符串
            else{
                echo "Input something...";
            }

        }else {
            echo "";
            exit;
        }
    }

    //定义checkSignature方法
    private function checkSignature()
    {
        // you must define TOKEN by yourself

        //判断TOKEN密钥是否定义
        if (!defined("TOKEN")) {
            //如果没有定义则抛出异常，返回'TOKEN is not defined!'字符串
            throw new Exception('TOKEN is not defined!');
        }
        //接收微信加密签名
        $signature = $_GET["signature"];
        //接收时间戳信息
        $timestamp = $_GET["timestamp"];
        //接收随机数
        $nonce = $_GET["nonce"];
        //把TOKEN常量赋值给$token变量
        $token = TOKEN;
        //把相关参数组装为数组（密钥文件、时间戳、随机数）
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        //通过字典法进行排序
        sort($tmpArr, SORT_STRING);
        //把排序后的数组转化为字符串
        $tmpStr = implode( $tmpArr );
        //通过哈希算法对字符串进行加密操作
        $tmpStr = sha1( $tmpStr );
        //与加密签名进行对比
        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
}

?>