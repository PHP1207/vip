<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/2 0002
 * Time: 15:02
 */
class InteController extends PlatformController
{
    //显示积分列表
   public function index(){
       //接收数据
       $page=$_GET['page']??1;
       $data=$_REQUEST;
       $stau=[];
       if(!empty($data['number'])){
           $stau[]="number={$data['number']}";
       }
       unset($_REQUEST['page']);
       $url_name=http_build_query($_REQUEST);
       //处理数据
       $inte=new InteModel();
       $rows=$inte->getAll($page,$stau);
       foreach($rows['list'] as $key=>&$val){
           $user=new InteModel();
           $row=$user->user($val['user_id']);
           $val['username']=$row['username'];
       }
//       var_dump($rows['list']);die;
       $rows['url_name']=$url_name;
       extract($rows);
       $this->assign($rows);
       //显示页面
       $this->display('index');
   }
   //删除
    public function delete(){
       //接收数据
        $id=$_GET['id'];
       //处理数据
        $delete=new InteModel();
        $rs=$delete->delete($id);
       //显示页面
        if($rs===false){
            self::red('index.php?p=Home&c=Inte&a=index','删除失败!',3);
        }
        self::red('index.php?p=Home&c=Inte&a=index');
    }
}