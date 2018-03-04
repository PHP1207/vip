<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/2 0002
 * Time: 13:54
 */
class NumberController extends PlatformController
{
   //显示积分商城
    public function index(){
        //接收数据
        //处理数据
        //查询个个人积分
        @session_start();
        $Inte=new NumberModel();
        $row=$Inte->inte($_SESSION['users']['user_id']);
        //分配数据
        $this->assign($row);
        $number=new NumberModel();
        $rows=$number->getAll();
        //分配数据
        $this->assign('rows',$rows);
        //显示页面
        $this->display('index');
    }
    //兑现
    public function dui(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
             //接收数据
            $data=$_POST;
            //处理数据
            //查询用户积分
            @session_start();
            $Inte=new NumberModel();
            $row=$Inte->inte($_SESSION['users']['user_id']);
            //查询该商品积分
            $number=new NumberModel();
            $num=$number->number($data['id']);
//            var_dump($num);die;
            //兑换
            $add_save=new NumberModel();
            $rs=$add_save->save($data,$row,$_SESSION['users']['user_id'],$num);
            //显示页面
            if($rs===false){
                self::red('index.php?p=Home&c=Number&a=index',$add_save->getError(),3);
            }
            self::red('index.php?p=Home&c=Number&a=index');
        }else{
            //接收数据
            //处理数据
            //显示页面
            $this->display('dui');
        }
    }
}