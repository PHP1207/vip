<?php

/**
 * Created by PhpStorm.
 * User: wqz19970129
 * Date: 2018/3/1
 * Time: 15:43
 */
class OrderController extends Controller
{
  public function index(){
      //接收数据
      //$status=$_GET['status']==0?1:0;
      $search='';
      if(!empty($_REQUEST['realname'])){
       $search.=" realname like '{$_REQUEST['realname']}'";
      }
      //var_dump($_REQUEST['realname']);die;
      unset($_REQUEST['page']);//删除
      $url_name=http_build_query($_REQUEST);
      $page=$_GET['page']??1;
      $order=new OrderModel();
      $rows=$order->getAll1($page,$search);
      $rows['url_name']=$url_name;
      //var_dump($rows);die;
      extract($rows);
      $this->assign($rows);
      //处理数据
      //显示页面
      $this->display('index');
  }
  //修改状态
  public function update(){
      //接收数据
      $data=$_GET;
      //处理数据
      $update=new OrderModel();
      $update->update($data);
      //显示页面
      $this->red('index.php?p=Admin&c=Order&a=index');
  }
  //给他回复
  public function add(){
      if($_SERVER['REQUEST_METHOD']=='POST'){
          //接收数据
          $data=$_POST;
          //处理数据
          $update=new OrderModel();
          $update->add1($data);
          //显示页面
          $this->red('index.php?p=Admin&c=Order&a=index');
      }else{
          //显示页面
          $id=$_GET['order_id'];
          $this->assign('id',$id);
          $this->display('add1');
      }
  }
}