<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/28 0028
 * Time: 13:53
 */
class LoginController extends Controller
{
   //显示登录页面
    public function Login(){
        //接收数据
        //处理数据
        //显示页面
        $this->display('login');
    }
    //验证登录信息
    public function chexd(){
        //接收数据
        $data=$_POST;
//        var_dump($data);die;
        $chexd=new MemberModel();
        $row=$chexd->chexd($data);
        if($row===false){
            self::red('index.php?p=Admin&c=Login&a=login',$chexd->getError(),3);
        }
        $che=new MemberModel();
        $che->che($row['member_id']);
            self::red('index.php?p=Admin&c=Member&a=index');
    }
    //退出
    public function logout(){
        @session_start();
        unset($_SESSION['user']);
        setcookie('member_id',null,-1,'/');
        setcookie('password',null,-1,'/');
        self::red('index.php?p=Admin&c=Login&a=login');
    }
}