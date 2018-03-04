<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/2 0002
 * Time: 0:04
 */
class ZengController extends PlatformController
{
    //显示赠送规则
    public function index(){
        //接收数据
        //处理数据
        $zeng=new ZengModel();
        $rows=$zeng->getAll();
        //分配数据
        $this->assign('rows',$rows);
        //显示页面
        $this->display('index');
    }
    //添加赠送规则
    public function add(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //接收数据
            $data=$_POST;
            //处理数据
            $add_save=new ZengModel();
            $rs=$add_save->add_save($data);
            //显示页面
            if($rs===false){
               self::red('index.php?p=Admin&c=Zeng&a=add',$add_save->getError(),3);
            }
            self::red('index.php?p=Admin&c=Zeng&a=index');
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
        $delete=new ZengModel();
        $rs=$delete->delete($id);
        //显示页面
        if($rs===false){
            self::red('index.php?p=Admin&c=Zeng&a=index','删除失败!',3);
        }
        self::red('index.php?p=Admin&c=Zeng&a=index');
    }
    //修改
    public function edit(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //接收数据
            $data=$_POST;
            //处理数据
            $edit_save=new ZengModel();
            $rs=$edit_save->edit_save($data);
            //显示页面
            if($rs===false){
                self::red('index.php?p=Admin&c=Zeng&a=edit&id='.$data['id'],$edit_save->getError(),3);
            }
            self::red('index.php?p=Admin&c=Zeng&a=index');
        }else{
            //接收数据
            $id=$_GET['id'];
            //接收数据
            $edit=new ZengModel();
            $row=$edit->edit($id);
//            var_dump($row);die;
            //分配数据
            $this->assign($row);
            //处理数据
            $this->display('edit');
        }
    }
}