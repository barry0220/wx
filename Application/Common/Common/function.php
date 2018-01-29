<?php
header("Content-Type:text/html;charset=utf-8");
//**
//* @param string $str
//* @param string $str2
//* 10001  成功
//* 10002  失败
//* 10003  参数缺少
//* */
function json($str='10001',$str2=''){
    if ($str != '10001') {
        $arr['status']=$str;
        $arr['error']=$str2;
        exit(json_encode($arr));
    }

    if ($str=='10001') {

        if ($str2 == '') {

            $arr['status']=$str;

        }else{
            $arr['status']=$str;
            $arr['result']=$str2;
        }

        exit(json_encode($arr));
    }
}
/**
 * Created by PhpStorm.
 * User: php
 * Date: 2016/12/13
 * Time: 16:35
 */
//需要删除的图片的地址，执行删除 默认需要截取文件地址 如不需要$t=0
function ShanTu( $old_url,$t=1){
    if($t == 1){
        $http = "http://".HTTP_HOST;
        $old_url = ltrim($old_url,$http);
    }
    @unlink($old_url);
}
//格式化打印数据
function k($a){
    echo "<pre>";
    var_dump($a);
    echo "</pre>";
}
//图片上传 $id=子文件名 $d=文件保存目录
function Tu($id,$d='../Dang/',$ge=array('jpg', 'gif', 'png', 'jpeg')){
    $upload = new \Think\Upload();        							//实例化上传类
    $upload->exts      =  $ge;  	// 设置附件上传类型
    $upload->savePath  = $d;                                    	// 设置附件上传目录
    $upload->subName   = $id;										//设置子文件名为：中心ID
    $info   =   $upload->upload();                                	// 上传文件
    return $info;
}
//多图上传数据拼接 收到二维数组，key=字段名 同字段多个地址拼成字符串
function shuDuoC($info,$id){
    foreach ($info as $v){
        $t = $v['savename'];
        $w = "/Dang/$id/$t";
        $k = $v['key'];
        $kk[] = $k;
        $ss[] = array($k,$w);
    }
    $img = array_unique($kk);
    foreach ($ss as $vvv){
        foreach ($img as $ttt => $v){
            if($v == $vvv['0']){
                $i[$v][]=$vvv['1'];
                $data[$v] = implode(',',$i[$v]);
                continue;
            }
        }
    }
    return $data;
}
//处理中心详情数据拼接地址 返回二维数组
function shuDuoX($data){
    foreach ($data[0] as $k=>$v){
        for ($a=1;$a<22;$a++){
            if($v){
                if("img".$a == $k){
                    $w = explode(",",$v);
                    for ($b=0;$b<count($w);$b++){
                        $ww[$b] = "http://".HTTP_HOST.$w[$b];
                        continue;
                    }
                    $data[0][$k] = $ww;
                    continue;
                }
            }
        }
    }
    return $data[0];
}
function jilu($r="会员管理系统"){
    $a['controller'] = CONTROLLER_NAME;
    $a['view'] = ACTION_NAME;
    $a['user_id'] =  session('mg_id');
    $a['username'] =  session('a_name');
    $a['status'] =  1;
    $a['source'] =  $r;

    $w = M('operation_log')->add($a);
    return $w;
}
//TP分页 $m实例化的模型（要查询的表） $where查询条件 $pagesize=每页条数
function getpage(&$m,$where,$pagesize=10){
    $m1=clone $m;//浅复制一个模型
    $count = $m->where($where)->count();//连惯操作后会对join等操作进行重置
    $m=$m1;//为保持在为定的连惯操作，浅复制一个模型
    $p=new Think\Page($count,$pagesize);
    $p->lastSuffix=false;
    $p->setConfig('header','<li class="rows" style="list-style: none;float: left;">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
    $p->setConfig('prev','上一页');
    $p->setConfig('next','下一页');
    $p->setConfig('last','末页');
    $p->setConfig('first','首页');
    $p->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');

    $p->parameter=I('get.');

    $m->limit($p->firstRow,$p->listRows);

    return $p;
}
//使用bootstrap样式 替换 TP原有样式
function bootstrap_page_style($page_html){
    if ($page_html) {
        $page_show = str_replace('<div>','<nav><ul class="pagination" style="width: 100%">' ,$page_html);
        $page_show = str_replace('</div>','</ul></nav>',$page_show);
        $page_show = str_replace('<span class="current">','<li class="active"><a>',$page_show);
        $page_show = str_replace('</span>','</a></li>',$page_show);
        $page_show = str_replace(array('<a class="num"','<a class="prev"','<a class="next"','<a class="end"','<a class="first"'),'<li><a',$page_show);
        $page_show = str_replace('</a>','</a></li>',$page_show);
    }
    return $page_show;
}
//自定义翻页代码 $m=模型 $where=查询条件 $t=第几页 $pagesize=每页显示记录数
function getfanye(&$m,$where,$t,$pagesize=10){
    if(!$t['p']){
        $t['p']=1;
        $ps = 1;
    }else{
        $ps = $t['p']-1;
    }

    $m1=clone $m;//浅复制一个模型
    $count = $m->where($where)->count();//连惯操作后会对join等操作进行重置
    $m=$m1;//为保持在为定的连惯操作，浅复制一个模型
    $pages = ceil($count/$pagesize);
    $start = ($t['p']-1)*$pagesize;
    $m->limit($start,$pagesize);
    $t['pages'] = $pages;
    $t['count'] = $count;

    if($t['p']<$pages){
        $px = $t['p']+1;
    }else{
        $px = $pages;
    }
    $t[url][1] = $t[url][0]."/p/1";              //首页跳转
    $t[url][2] = $t[url][0]."/p/{$ps}";          //上一页跳转
    $t[url][3] = $t[url][0]."/p/{$px}";          //下一页跳转
    $t[url][4] = $t[url][0]."/p/{$pages}";       //尾页跳转
    $t[url][5] = $t[url][0]."/p/";               //选跳转
//    $weii = "http://".HTTP_HOST;
    $t[url][6] = $t[url][0];               //选跳转
    return $t;
}
//Excel表导入
function importExcel($url,$a,$b = '',$c = 0) {
    vendor("PHPExcel.PHPExcel");                //使用TP自带方法导入 Excel表导入|导出类

    $extension = strtolower(pathinfo($url, PATHINFO_EXTENSION));    //获取Excel表的后缀
    //判断导入表格后缀格式
    if($extension == 'xlsx') {
        $objReader =\PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel =$objReader->load($url, $encode = 'utf-8');
    }else if($extension == 'xls'){
        $objReader =\PHPExcel_IOFactory::createReader('Excel5');
        $objPHPExcel =$objReader->load($url, $encode = 'utf-8');
    }

    $sheet = $objPHPExcel->getSheet($c);            //默认：导入Excel表中的第一个表
    $highestRow = $sheet->getHighestRow();          //取得总行数
    $highestColumn = $sheet->getHighestColumn();    //取得总列数




    //根据总行数循环添加，$i =2 (从第二行开始添加，默认不添加第一行标题)
    for($i = 2; $i <= $highestRow; $i++){
        //对应Excel表里和数据库表的字段
        foreach ($a as $k=> $v) {
            $data[$k] = $objPHPExcel->getActiveSheet()->getCell($v.$i)->getValue();
        }
        //数据库表中的固定数据
        if(!empty($b)){
            foreach ($b as $k=>$v){
                $data[$k] = $v;
            }
        }
        $info = M('wx_user')->add($data);
    }
    //导入成功返回导入数量，失败返回false
    if($info){
        return ($highestRow-1);
    }else{
        return false;
    }
}
//微信消息推送
function wxts($data){
    $jssdk = new \Think\JSSDK("wx437115d1dddee775", "04052e7135e34a276e78d6866a379168");
    $appid = "wx437115d1dddee775";
    $secret = "04052e7135e34a276e78d6866a379168";
    $token = $jssdk->getAccessToken();
    //根据openid和access_token查询用户信息
    // $openid = 'oWprtwKhrTeUJYR7bkn_lcCgTLnI';
    setcookie("access_token",$token,time()+7200);
    $data_string=json_encode($data);
    $url='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$token;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
    );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    $result = curl_exec($ch);
    $error=json_decode($result,true);
    if($error['errcode']!=0){
        $get_token_url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$secret;
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$get_token_url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        $res = curl_exec($ch);
        curl_close($ch);
        $json_obj = json_decode($res,true);
        //根据openid和access_token查询用户信息
        $token = $json_obj['access_token'];
        setcookie("access_token",$token,time()+7200);
        $url='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$token;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        $result = curl_exec($ch);
    }
    return $result;

}

/*
 * 手机号验证函数
 * */
function match_phone($phonenumber){
    if (empty($phonenumber)){
        return false;
    }else{
        if(preg_match("/^1[34578]{1}\d{9}$/",$phonenumber)){
            return true;
        }else{
            return false;
        }
    }
}



/*
 *  文件上传
 *
 * */
function upload()
{
    $upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize   =     3145728 ;// 设置附件上传大小
    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
    $upload->savePath  =     ''; // 设置附件上传（子）目录
    // 上传文件
    $info   =   $upload->upload();
    if(!$info) {// 上传错误提示错误信息
        return false;
    }else{// 上传成功
        return $info;
    }
}

/**
 * 打印输出
 **/
function dd($info){
    echo "<pre>";
    print_r($info);
    die;
}

function ddd($info){
    echo "<pre>";
    print_r($info);
}


/*
 *
 *
 * */

