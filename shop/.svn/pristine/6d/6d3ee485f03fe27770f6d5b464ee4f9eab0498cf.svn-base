<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/27 0027
 * Time: 22:14
 */
class GroupController extends PlatformController
{
    //显示部门管理
    public function group(){
        //接收数据
        $page=$_GET['page']??1;
        $data=$_REQUEST;
        $stau=[];
        if(!empty($data['name'])){
//            echo 1;die;
            $stau[]="`name` like '%{$data['name']}%'";
        }
        unset($_REQUEST['page']);
        $url_name=http_build_query($_REQUEST);
        //处理数据
        $group=new GroupModel();
        $rows=$group->getAll($page,$stau);
        $rows['url_name']=$url_name;
        //分配数据
        $this->assign($rows);
        //显示页面
        $this->display('group');
    }
    //添加部门
    public function add(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //接收数据
            $data=$_POST;
            //处理数据
            $add_save=new GroupModel();
            $rs=$add_save->add_save($data);
            //显示页面
            if($rs===false){
                self::red('index.php?p=Admin&c=group&a=add',$add_save->getError(),3);
            }
            self::red('index.php?p=Admin&c=group&a=group');
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
        $del=new GroupModel();
        $rs=$del->del($id);
//        var_dump($rs);die;
        if($rs!==null){
            self::red('index.php?p=Admin&c=group&a=group',$del->getError(),3);
        }
        $delete=new GroupModel();
        $rs=$delete->delete($id);
        //显示页面
        if($rs===false){
            self::red('index.php?p=Admin&c=group&a=group');
        }
        self::red('index.php?p=Admin&c=group&a=group');
    }
    //修改
    public function edit(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //接收数据
            $data=$_POST;
            //处理数据
            $edit_save=new GroupModel();
            $rs=$edit_save->edit_save($data);
            //显示页面
            if($rs===false){
                self::red('index.php?p=Admin&c=group&a=edit&id='.$data['id'],'修改失败',3);
            }
            self::red('index.php?p=Admin&c=group&a=group');
        }else{
            //接收数据
            $id=$_GET['id'];
            //处理数据
            $edit=new GroupModel();
            $row=$edit->edit($id);
            //分配数据
            $this->assign($row);
            //显示页面
            $this->display('edit');
        }
    }
}