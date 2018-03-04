<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/28 0028
 * Time: 23:01
 */
class CodesController extends PlatformController
{
    //显示代金卷页面
    public function index(){
        //接收数据
        //处理数据
        $codes=new CodesModel();
        $rows=$codes->getAll();
        foreach ($rows as $key=>$v){
            $users=new CodesModel();
            $row=$users->users($v['user_id']);
            $rows[$key]['username']=$row['username'];
        }
        //分配数据
        $this->assign('rows',$rows);
        //显示页面
        $this->display('index');
    }
    //显示添加表单和保存
    public function add(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
             //接收数据
            $data=$_POST;
            //处理数据
            $add_save=new CodesModel();
            $rs=$add_save->add_save($data);
            //显示页面
            if($rs===false){
                self::red('index.php?p=Admin&c=Codes&a=add',$add_save->getError(),3);
            }
            self::red('index.php?p=Admin&c=Codes&a=index');
        }else{
            //接收数据
            //处理数据
            $add=new CodesModel();
            $rows=$add->add();
            //分配数据
            $this->assign('rows',$rows);
            //显示页面
            $this->display('add');
        }
    }
    //删除
    public function delete(){
        //接收数据
        $code_id=$_GET['code_id'];
        //处理数据
        $delete=new CodesModel();
        $rs=$delete->delete($code_id);
        //显示页面
        if($rs===false){
            self::red('index.php?p=Admin&c=Codes&a=index','删除失败!',3);
        }
        self::red('index.php?p=Admin&c=Codes&a=index');
    }
    //修改功能
    public function edit(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
           //接收数据
            $data=$_POST;
           //处理数据
            $edit_save=new CodesModel();
            $rs=$edit_save->edit_save($data);
            //显示页面
            if($rs===false){
                self::red('index.php?p=Admin&c=Codes&a=edit&code_id='.$data['code_id'],$edit_save->getError(),3);
            }
            self::red('index.php?p=Admin&c=Codes&a=index');
        }else{
            //接收数据
            $code_id=$_GET['code_id'];
            //处理数据
            $edit=new CodesModel();
            $row=$edit->edit($code_id);
            //分配数据
            $add=new CodesModel();
            $rows=$add->add();
            //分配数据
            $this->assign('rows',$rows);
            $this->assign($row);
            //显示页面
            $this->display('edit');
        }
    }
}