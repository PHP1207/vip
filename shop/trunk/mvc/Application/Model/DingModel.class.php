<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/3 0003
 * Time: 16:09
 */
class DingModel extends Model
{
   //查询所有的订单数据
    public function getAll($page,$stau){
        $where='';
        if(!empty($stau)){
            $where=' where '.implode(' and ',$stau);
        }
        //每页显示多少条
        $pageSize=3;
        //查询总记录数
        $sql_count="select count(*) from ding $where";
        //执行
        $count=$this->db->fetchColumn($sql_count);
        //获取总页数
        $totalPage=ceil($count/$pageSize);
        //获取起始位置
        $sta=($page-1)*$pageSize;
        $page<1?1:$page;
        $page>$totalPage?$totalPage:$page;
        $limit="limit $sta,$pageSize";
        //写sql
        $sql="select * from ding $where $limit";
        //执行
        $rows=$this->db->fetchAll($sql);
        //返回值
        return ['list'=>$rows,'page'=>$page,'pageSize'=>$pageSize,'count'=>$count,'totalPage'=>$totalPage];
    }
    //处理订单
    public function status($id){
        //写sql语句
        $sql="update ding set status=1,is_status=1 where id={$id}";
        //执行
        return $this->db->execute($sql);
    }
    //添加评论
    public function add_save($data){
        $time=time();
        //写sql
        $sql="insert into content set content='{$data['content']}',`name`='{$data['name']}',`time`={$time}";
        //执行
        return $this->db->execute($sql);
    }
    //查询所有评论
    public function content(){
        //写sql
        $sql="select * from content";
        //执行
        $con=$this->db->fetchAll($sql);
        //返回值
        return $con;
    }
    //回复
    public function hui($data){
        if($data['name']==''){
            $this->error='回复人不能为空!';
            return false;
        }
        if($data['content']==''){
            $this->error='回复内容不能为空!';
            return false;
        }
        $time=time();
        //写sql
        $sql="insert into hui set con_id={$data['id']},cont='{$data['content']}',`name`='{$data['name']}',`time`={$time}";
        //执行sql
        return $this->db->execute($sql);
    }
    //查询回复内容
    public function hu($id){
        //写sql
        $sql="select * from hui where con_id={$id}";
        //执行
        $row=$this->db->fetchAll($sql);
        //返回值
        return $row;
    }
}