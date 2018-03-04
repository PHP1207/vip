<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/1 0001
 * Time: 15:24
 */
class HistoryController extends PlatformController
{
   //显示日志表
    public function index(){
        //接收数据
        $user_id=$_GET['user_id']??'';
        $page=$_GET['page']??1;
        $data=$_REQUEST;
        $stau=[];
        if(!empty($data['remainder'])){
            $stau[]="remainder like '%{$data['remainder']}%'";
        }
        unset($_REQUEST['page']);
        $url_name=http_build_query($_REQUEST);
        //处理数据
        $history=new HistoryModel();
        $rows=$history->getAll($page,$stau,$user_id);
        $rows['url_name']=$url_name;
        foreach($rows['list'] as $key=>&$row){
//             var_dump($row);die;
            $user=new HistoryModel();
            $r=$user->user($row['user_id']);
//            var_dump($r);die;
            $row['username']=$r['username'];
        }
//        var_dump($rows['list']);die;
        extract($rows);
        //分配数据
        $this->assign($rows);
        //显示页面
        $this->display('index');
    }
    //删除
    public function delete(){
        //接收数据
        $history_id=$_GET['history_id'];
        //处理数据
        $delete=new HistoryModel();
        $rs=$delete->delete($history_id);
        //显示页面
        if($rs===false){
            self::red('index.php?p=Admin&c=History&a=index','删除失败!',3);
        }
        self::red('index.php?p=Admin&c=History&a=index');
    }
}