<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/28 0028
 * Time: 16:10
 */
class PlansController extends PlatformController
{
   //显示套餐列表
    public function index(){
        //接收数据
        $page=$_GET['page']??1;
        $data=$_REQUEST;
        $stau=[];
        if(!empty($data['name'])){
            $stau[]="name like '%{$data['name']}%'";
        }
        if(!empty($data['money'])){
            $stau[]="money like '%{$data['money']}%'";
        }
        unset($_REQUEST['page']);
        $url_name=http_build_query($_REQUEST);
        //处理数据
        $plans=new PlansModel();
        $rows=$plans->getAll($page,$stau);
        $rows['url_name']=$url_name;
        extract($rows);
        //分配数据
        $this->assign($rows);
        //显示页面
        $this->display('index');
    }
    //添加套餐
    public function add(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //接收数据
            $data=$_POST;
            //处理数据
            $add_save=new PlansModel();
           $rs=$add_save->add_save($data);
           if($rs===false){
               self::red('index.php?p=Admin&c=Plans&a=add',$add_save->getError(),3);
           }
           self::red('index.php?p=Admin&c=Plans&a=index');
        }else{
            //接收数据
            //处理数据
            //显示页面
            $this->display('add');
        }
    }
    //删除
    public function delete(){
        //接收数据
        $id=$_GET['id'];
        //处理数据
        $delete=new PlansModel();
        $rs=$delete->delete($id);
        if($rs===false){
            self::red('index.php?p=Admin&c=Plans&a=index','删除错误',3);
        }
        self::red('index.php?p=Admin&c=Plans&a=index');
    }
    //修改
    public function edit(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
             //接收数据
            $data=$_POST;
            //处理数据
            $edit_save=new PlansModel();
            $rs=$edit_save->edit_save($data);
            //显示页面
            if($rs===false){
                self::red('index.php?p=Admin&c=Plans&a=edit&id='.$data['plan_id'],$edit_save->getError(),3);
            }
            self::red('index.php?p=Admin&c=Plans&a=index');
        }else{
            //接收数据
            $plan_id=$_GET['id'];
            //处理数据
            $edit=new PlansModel();
            $row=$edit->edit($plan_id);
            //分配数据
            $this->assign($row);
            //显示页面
            $this->display('edit');
        }
    }
}