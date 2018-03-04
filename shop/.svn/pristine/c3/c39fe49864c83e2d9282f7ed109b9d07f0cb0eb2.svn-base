<?php

/**
 * Created by PhpStorm.
 * User: wqz19970129
 * Date: 2018/2/28
 * Time: 9:13
 */
class UsersController extends PlatformController
{
    public function index(){
        //接收数据
        //处理数据
        //显示页面
        $this->display('contact');
    }
    public function reg(){
     //接收数据
     $data=$_POST;
     //上传图片
     $file=$_FILES['logo'];
     $image=new UploadTool();
     $rs=$image->upload($file,'Users/');
     if($rs===false){
         self::red('index.php?p=Home&c=Users&a=index',$image->getError(),'2');
     }
     $data['photo']=$rs;
     //制作缩略图
     $upload=new ImageTool();
     $a=$upload->thmub($rs,100,100);
     if($a===false){
         self::red('index.php?p=Home&c=Users&a=index',$upload->getError(),'2');
     }
     $data['thumb']=$a;
     //处理数据
     $user=new UsersModel();
     $user->add($data);
     //显示页面
     self::red('index.php?p=Home&c=login&a=login');
 }
}