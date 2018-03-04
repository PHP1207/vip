<?php

/**
 * Created by PhpStorm.
 * User: wqz19970129
 * Date: 2018/2/28
 * Time: 11:38
 */
class ArticleController extends PlatformController
{
    //登陆后显示的
    public function people(){
        @session_start();
        $username=$_SESSION['users']['username'];
        //var_dump($username);die;
        $this->assign('username',$username);
        $thumb=$_SESSION['users']['thumb'];
        //var_dump($username);die;
        $this->assign('thumb',$thumb);

        $display=new ArticleModel();
        $rows=$display->getAll1();
        //显示页面
        $this->assign('rows',$rows);
        //处理数据
        //显示页面
        $this->display('work2');
    }
    //未登录现实的
    public function index(){
        //接收数据
        $display=new ArticleModel();
        $rows=$display->getAll1();
        //显示页面
        $this->assign('rows',$rows);
        //处理数据
        //显示页面
        $this->display('work');
    }
    public function content(){
        //接收数据
        $id=$_GET['article_id'];
        $content=new ArticleModel();
        $row=$content->getOne($id);
        //处理数据
        $this->assign($row);
        $this->display('work01');
    }
    public function content1(){
        //接收数据
        @session_start();
        $username=$_SESSION['users']['username'];
        //var_dump($username);die;
        $this->assign('username',$username);
        $thumb=$_SESSION['users']['thumb'];
        //var_dump($username);die;
        $this->assign('thumb',$thumb);
        @session_start();
        $user_id=$_SESSION['users']['user_id'];
        $this->assign('user_id',$user_id);
        $id=$_GET['article_id'];
        $content=new ArticleModel();
        $row=$content->getOne($id);
        //处理数据
        $this->assign($row);
        $this->display('work2-1');
    }
    public function content2(){
        //接收数据
        @session_start();
        $username=$_SESSION['users']['username'];
        //var_dump($username);die;
        $this->assign('username',$username);
        $thumb=$_SESSION['users']['thumb'];
        //var_dump($username);die;
        $this->assign('thumb',$thumb);
        @session_start();
        $user_id=$_SESSION['users']['user_id'];
        $this->assign('user_id',$user_id);
        $id=$_GET['article_id'];
        $content=new ArticleModel();
        $row=$content->getOne($id);
        //处理数据
        $this->assign($row);
        $this->display('work2-2');
    }
}