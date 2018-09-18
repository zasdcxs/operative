<?php
/**
 * 首页
 */
namespace app\index\controller;
use think\Controller;
use think\Db;
class Index extends controller
{
    /**
     * 构造函数：登陆检查
     */
    function _initialize() {
       logincheck();
    }
    /**
     * 首页
     */
    public function index()
    {
        $this->assign('username',session('username'));
        return $this->fetch();
    }
    /**
     * 列表界面
     */
    public function alist()
    {
        $x=db('wuye')->select();
        //print_r($x);
        $this->assign('username',session('username'));
        $this->assign('x',json_encode($x));
        return $this->fetch();
    }
    /**
     * 详细界面
     */
    public function detail()
    {
        $this->assign('username',session('username'));
        return $this->fetch();
    }
    /**
     * 更新数据界面
     */
    public function updata()
    {
        $this->assign('username',session('username'));
        return $this->fetch();
    }
}
