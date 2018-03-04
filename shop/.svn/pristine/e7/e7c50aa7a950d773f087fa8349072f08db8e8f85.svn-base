<?php

/**
 * Created by PhpStorm.
 * User: wqz19970129
 * Date: 2018/2/27
 * Time: 22:39
 */
class LoginController extends  Controller
{
 public function login(){
     //接收数据
     //处理数据
     //显示页面
     $this->display('index');
 }
 public function login_check(){
     //接收数据
     $data=$_POST;
     //验证码
     @session_start();
     if($_SESSION['random_code'] !=$data['captcha']){
         $this->red('index.php?p=Home&c=login&a=login','验证码不正确','2');
     }
     //处理数据
     $users=new UsersModel();
     $rs=$users->login_check($data);
     if($rs===false){
         self::red('index.php?p=Home&c=Login&a=login',$users->getError(),'2');
     }
     @session_start();
     $_SESSION['users']=$rs;
     //显示页面
   if(isset($data['remember'])){
      setcookie('user_id',$rs['user_id'],time()+24*7200,"/");
      setcookie('password',md5($rs['password']),time()+24*7200,"/");
  }
     self::red('index.php?p=Home&c=Article&a=people');
 }
 public function logout(){
     //接收数据
     @session_start();
     unset($_SESSION['users']);
     setcookie('user_id',null,-1,'/');
     setcookie('password',null,-1,'/');
     //处理数据
     //显示页面
     self::red('index.php?p=Home&c=Login&a=login');
 }
}