<?php

/**
 * Created by PhpStorm.
 * User: wqz19970129
 * Date: 2018/3/2
 * Time: 14:02
 */
class GrandController extends  Controller
{//获取所有的数据
   public function index(){
       //接收数据
       //处理数据
       $grand=new GrandModel();
       $rows=$grand->getAll();
       $this->assign('rows',$rows);
       //显示页面
       $this->display('index');
   }
   //等级的修改
   public function edit(){
       if($_SERVER['REQUEST_METHOD']=='POST'){
           //接收数据
           $data=$_POST;
           $grand=new GrandModel();
           $grand->editSave($data);
           $this->red('index.php?p=Admin&c=Grand&a=index');
           //处理数据
       }else{
           $id=$_GET['grand_id'];
           //显示页面
           $grand=new GrandModel();
           $row=$grand->getOne($id);
           $this->assign($row);
           $this->display('edit');
       }
   }
}