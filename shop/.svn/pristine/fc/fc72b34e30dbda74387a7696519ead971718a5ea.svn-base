<?php

/**
 * Created by PhpStorm.
 * User: wqz19970129
 * Date: 2018/2/28
 * Time: 15:14
 */
class ArticleController extends  Controller
{
 public function index(){
     $page=$_GET['page']??1;
     $data=$_REQUEST;
     //var_dump($data);die();
     $stau='';
     if($data['title']??''!=''){
         $stau.="title like '%{$data['title']}%'";
     }
     unset($_REQUEST['page']);
     $url_name=http_build_query($_REQUEST);
     //处理数据
     $member=new ArticleModel();
     $rows=$member->getAll($stau,$page);

     //分配数据
     $rows['url_name']=$url_name;
     extract($rows);
//        var_dump($list);die;
     $this->assign($rows);
     //显示页面
     $this->display('index');
 }
 public function add(){
     if($_SERVER['REQUEST_METHOD']=='POST'){
         //处理数据
         $data=$_POST;
         $article=new ArticleModel();
         $article->add($data);
         //显示页面
         $this->red('index.php?p=Admin&c=Article&a=index');
     }else{
         //处理数据
         //显示页面
         $this->display('add');
     }
 }
 public function delete(){
     //显示数据
     $id=$_GET['article_id'];
     //处理数据
     //var_dump($id);die;
     $article=new ArticleModel();
     $article->delete($id);
     //显示页面
     $this->red('index.php?p=Admin&c=Article&a=index');
 }
 //修改回显
 public function edit(){
     if($_SERVER['REQUEST_METHOD']=='POST'){
         //处理数据
         $data=$_POST;
         $article=new ArticleModel();
         $article->edit($data);
         //显示页面
         $this->red('index.php?p=Admin&c=Article&a=index');
     }else{
         //处理数据
         $id=$_GET['article_id'];
         $article=new ArticleModel();
         $row=$article->getOne1($id);
         $this->assign($row);
         //显示页面
         $this->display('edit');
     }
 }
}