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
        $content=new DingModel();
        $con=$content->content();
        foreach ($con as &$value){
            $hu=new DingModel();
            $row=$hu->hu($value['id']);
            $value['hui']=$row;
        }
//        var_dump($con);die;
        //分配数据
        $this->assign('con',$con);
        //显示页面
        $this->display('index');
    }
    //添加评论
    public function add(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //接收数据
            $data=$_POST;
            //处理数据
            $add_save=new DingModel();
            $rs=$add_save->add_save($data);
            //显示页面
            if($rs===false){
                self::red('index.php?p=Home&c=Ding&a=add','评论失败!',3);
            }
            self::red('index.php?p=Home&c=Ding&a=index');
        }else{
            //接收数据
            //处理数据
            //显示页面
//            echo 1;die;
            $this->display('add');
        }
    }
    //回复
    public function hui(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //接收数据
            $data=$_POST;
            //处理数据
            $hui=new DingModel();
            $rs=$hui->hui($data);
            //显示页面
            if($rs===false){
                self::red('index.php?p=Home&c=Ding&a=hui&id'.$data['id'],$hui->getError(),3);
            }
            self::red('index.php?p=Home&c=Ding&a=index');
        }else{
            //接收数据
            //处理数据
            //显示页面
            $this->display('hui');
        }
    }
}