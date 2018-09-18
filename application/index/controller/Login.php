<?php
/**
 * 登陆页面
 */
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db;
use think\Session;
class Login extends controller
{

    /**
     * 引导界面
     */
    public function index()
    {
        if(session('uid')){
            $this->error('已登陆！！！','/');
        }
        return $this->fetch();
    }
    /**
     * 用户登录
     */
    public function login()
    {
        $param = input('post.');
        //print_r($param);
        if(empty($param)){
            $this->error('非法操作CODE:00001','index/login/index');
        }
        if(empty($param['username'])){
        
            $this->error('用户名不能为空','index/login/index');
        }
         
        if(empty($param['passwd'])){
        
            $this->error('密码不能为空');
        }
         
        // 验证用户名
        $has = db('users')->where('username', $param['username'])->find();
        if(empty($has)){
        
            $this->error('用户名密码错误');
        }
         
        // 验证密码
        if($has['passwd'] != $param['passwd']){
        
            $this->error('用户名密码错误');
        }
         
        // 记录用户登录信息,为避免多重登陆设置username+time验证
        $logincheck=$has['username'].time();
        $request = request()->ip();
        db('users')->where('uid',$has['uid'])->update(['logincheck' => $logincheck,'ip'=>$request]);
        session('uid', $has['uid']);
        session('logincheck', $logincheck);
        session('username', $has['username']);
        $this->redirect(url('/'));
       
}
/**
 * 用户注销
 */
public function logout()
{
    // 清楚所有session
    session(null);
    $this->success('正在退出登录...', '/');
}

}
