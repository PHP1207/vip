<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/28 0028
 * Time: 15:24
 */
class PlatformController extends Controller
{
    public function __construct()
    {
        @session_start();
        if(empty($_SESSION['user'])){
            if($_COOKIE['member_id']??''!='' && $_COOKIE['password']??''!=''){
                //接收数据
                $member_id=$_COOKIE['member_id'];
                $password=$_COOKIE['password'];
                //处理
                $cookie=new MemberModel();
                $rs=$cookie->cookie($member_id,$password);
                if($rs===false){
                    self::red('index.php?p=Admin&c=Login&a=login');
                }
                self::red('index.php?p=Admin&c=Member&a=index');
            }
            self::red('index.php?p=Admin&c=Login&a=login');
        }
    }
}