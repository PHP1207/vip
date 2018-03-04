<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/2 0002
 * Time: 13:54
 */
class NumberController extends PlatformController
{
   //显示积分商城
    public function index(){
        //接收数据
        //处理数据
        $number=new NumberModel();
        $rows=$number->getAll();
        //分配数据
        $this->assign('rows',$rows);
        //显示页面
        $this->display('index');
    }
    //添加商品
    public function add(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //接收数据
//            var_dump($_FILES);die;
            $data=$_POST;
            //处理数据
            if(!empty($_FILES['logo'])){
                $upload=new UploadTool();
                $logo=$upload->upload($_FILES['logo'],'number');
                //赋值
                $data['logo']=$logo;
                $img=new ImageTool();
                $img->thmub($data['logo'],100,100);
            }
            $add_save=new NumberModel();
            $rs=$add_save->add_save($data);
            //显示页面
            if($rs===false){
                self::red('index.php?p=Admin&c=Number&a=add',$add_save->getError(),3);
            }
            self::red('index.php?p=Admin&c=Number&a=index');
        }else{
            //接收数据
            //处理数据
            //显示页面
            $this->display();
        }
    }
    //删除商品
    public function delete(){
        //接收数据
        $id=$_GET['id'];
        //处理数据
        $delete=new NumberModel();
        $rs=$delete->delete($id);
        //显示页面
        if($rs===false){
            self::red('index.php?p=Admin&c=Number&a=index','删除失败!',3);
        }
        self::red('index.php?p=Admin&c=Number&a=index');
    }
}