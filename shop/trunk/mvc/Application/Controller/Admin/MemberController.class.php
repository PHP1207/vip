<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/27 0027
 * Time: 23:31
 */
class MemberController extends PlatformController
{
   //显示员工表
    public function index(){
        //接收数据
          $page=$_GET['page']??1;
          $data=$_REQUEST;
          $stau=[];
          if($data['username']??''!=''){
              $stau[]="username like '%{$data['username']}%'";
          }
          if($data['realname']??''!=''){
              $stau[]="realname like '%{$data['realname']}%'";
          }
          if(isset($data['sex'])){
              $stau[]="sex={$data['sex']}";
          }
          if($data['telephone']??''!=''){
              $stau[]="telephone like '%{$data['telephone']}%'";
          }
          unset($_REQUEST['page']);
          $url_name=http_build_query($_REQUEST);
        //处理数据
        $member=new MemberModel();
        $rows=$member->getAll($stau,$page);
            foreach ($rows['list'] as $key=>&$val){
                $group=new MemberModel();
                $row=$group->group($val['group_id']);
                $val['name']=$row['name'];
            }
        //分配数据
        $rows['url_name']=$url_name;
        extract($rows);
//        var_dump($list);die;
        $this->assign($rows);

        //显示页面
        $this->display('index');
    }
    //添加员工表
    public function add(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
          //接收数据
            $data=$_POST;
//            var_dump($data);die;
          //处理数据
            $upload=new UploadTool();
            $logo=$upload->upload($_FILES['photo'],'member');
            //赋值
            $data['photo']=$logo;
            //制作缩略图
            $image=new ImageTool();
            $img=$image->thmub($data['photo'],50,50);
            //赋值
            $data['photo']=$img;
            $add_save=new MemberModel();
            $rs=$add_save->add_save($data);
          //显示页面
            if($rs===false){
                self::red('index.php?p=Admin&c=Member&a=add',$add_save->getError(),3);
            }
            $group_update=new MemberModel();
            $group_update->update($data['group_id']);
             self::red('index.php?p=Admin&c=Member&a=index');
        }else{
            //接收数据
            //处理数据
            $add=new MemberModel();
            $rows=$add->add();
            //分配数据
            $this->assign('rows',$rows);
            //显示页面
            $this->display('add');
        }
    }
    //删除员工
    public function delete(){
        //接收数据
        $id=$_GET['id'];
        //处理数据
        $delete=new MemberModel();
        $rs=$delete->delete($id);
        //显示页面
        if($rs===false){
            self::red('index.php?p=Admin&c=Member&a=index','删除失败!',3);
        }
        self::red('index.php?p=Admin&c=Member&a=index');
    }
    //修改
    public function edit(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
             //接收数据
            $data=$_POST;
             //处理数据
            if($_FILES['photo']['error']===0){
                $upload=new UploadTool();
                $logo=$upload->upload($_FILES['photo'],'member');
                //赋值
                $data['photo']=$logo;
                //制作缩略图
                $image=new ImageTool();
                $img=$image->thmub($data['photo'],50,50);
                //赋值
                $data['photo']=$img;
            }
            $edit_save=new MemberModel();
            $rs=$edit_save->edit_save($data);
            //显示页面
            if($rs===false){
                self::red('index.php?p=Admin&c=Member&a=edit&id='.$data['member_id'],$edit_save->getError(),3);
            }
            self::red('index.php?p=Admin&c=Member&a=index');
        }else{
            //接收数据
            $id=$_GET['id'];
            //处理数据
            $edit=new MemberModel();
            $row=$edit->edit($id);
            $add=new MemberModel();
            $rows=$add->add();
            $row['rows']=$rows;
            //分配数据
            $this->assign($row);
            //显示页面
            $this->display('edit');
        }
    }
}