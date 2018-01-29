<?php
namespace Home\Controller;
use Think\Controller;
class UserinfoController extends Controller {
    /***
     * 获取用户个人信息
     */
    public function index()
    {
        //获取当前用户的openid
        $open_id = I('get.open_id');
        //根据openid查询相关用户信息
        $userinfo = M('a_user')->where(['open_id'=>$open_id])->find();

        $this -> ajaxReturn($userinfo,'JSON');

    }

    /**
     * 执行增加影响力
     **/
    public function checkEffect()
    {
        $open_id = I('get.open_id');    //获取当前用户的openid
        $parent_id = I('get.patent_id');    //获取当前用户点击链接的parentid
        //获取当前用户的父ID
        $parent = M('a_user')->where(['open_id'=>$open_id])->find()['parent_id'];
        //如果当前用户不存在parent_id 修改并且给父ID执行增加影响力
        if($parent == 0){
            M('a_user')->where(['open_id'=>$open_id])->save(['parent_id'=>$parent_id]); //修改父ID
            $effect = M('a_user')->where(['open_id'=>$parent_id])->find()['effect'];    //获取当前影响力
            M('a_user')->where(['open_id'=>$parent_id])->save(['effect'=>$effect+1]);   //修改影响力

        }
    }

}