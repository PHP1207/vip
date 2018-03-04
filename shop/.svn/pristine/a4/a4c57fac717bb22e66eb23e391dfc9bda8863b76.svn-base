<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/3 0003
 * Time: 16:08
 */
class DingController extends PlatformController
{
    //显示订单列表
    public function index(){
        //接收数据
        $page=$_GET['page']??1;
        $data=$_REQUEST;
        $stau=[];
        if(!empty($data['name'])){
            $stau[]="`name`='{$data['name']}'";
        }
        unset($_REQUEST['page']);
        $url_name=http_build_query($_REQUEST);
        //处理数据
        $ding=new DingModel();
        $rows=$ding->getAll($page,$stau);
        $rows['url_name']=$url_name;
        extract($rows);
        //分配数据
        $this->assign($rows);
        //显示页面
        $this->display('index');
    }
    //处理订单
    public function status(){
        //接收数据
        $id=$_GET['id'];
        //处理数据
        $status=new DingModel();
        $rs=$status->status($id);
        //显示页面
        if($rs===false){
            self::red('index.php?p=Admin&c=Ding&a=index','处理失败!',3);
        }
        self::red('index.php?p=Admin&c=Ding&a=index');
    }
}