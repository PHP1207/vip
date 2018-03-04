<?php
date_default_timezone_set('PRC');
/**
 * Created by PhpStorm.
 * User: wqz19970129
 * Date: 2018/1/28
 * Time: 16:38
 */
class PlatformController extends Controller
{
    public function __construct()
    {//判断是否存在
       if(!isset($_SESSION['users'])){
           //判断是否有cookie
           if(isset($_COOKIE['user_id']) && isset($_COOKIE['password'])){
               //将cookie里面的值存起来
               $id=$_COOKIE['user_id'];
               $password=$_COOKIE['password'];
               //调用方法
               $manger=new UsersModel();
               $rs=$manger->ipw($id,$password);
               if($rs===false){
                   self::red('index.php?p=Home&c=Login&a=login');
               }
               @session_start();
               $_SESSION['users']=$rs;
               return ;
           }
          self::red('index.php?p=Home&c=Login&a=login');
       }
    }
}