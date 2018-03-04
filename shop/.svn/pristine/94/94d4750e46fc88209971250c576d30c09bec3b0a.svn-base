<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/27 0027
 * Time: 22:15
 */
class GroupModel extends Model
{
   //查询部门管理表的所有数据
    public function getAll($page,$stau){
        $where='';
//        var_dump($stau);die;
        if(!empty($stau)){
//            echo 1;die;
            $where=' where '.implode(' and ',$stau);
        }
//        var_dump($where);die;
        //每页显示多少条
        $pageSize=3;
        //总记录数
        $sql_count="select count(*) from `group` $where";
        //执行
        $count=$this->db->fetchColumn($sql_count);
        //总页数
        $totalPage=ceil($count/$pageSize);
        //从那里开始查
        $sta=($page-1)*$pageSize;
        $limit="limit $sta,$pageSize";
        //写sql语句
        $sql="select * from `group` $where $limit";
        //执行sql
        $rows=$this->db->fetchAll($sql);
        //返回值
        return ['list'=>$rows,'count'=>$count,'page'=>$page,'pageSize'=>$pageSize,'totalPage'=>$totalPage];
    }
    //保存添加数据
    public function add_save($data){
        if($data['name']==''){
            $this->error='部门名称不能为空!';
            return false;
        }
        //写sql语句
        $sql="insert into `group` set `name`='{$data['name']}'";
        //执行
        return $this->db->execute($sql);
    }
    //删除数据
    public function del($id){
        //写sql
        $sql="select `member_id` from `group` where group_id={$id}";
        //执行
        $num=$this->db->fetchColumn($sql);
//        var_dump($num);
         if($num!==null){
             $this->error='该部门下有工不能删除!';
             return false;
         }
        //返回值
        return $num;
    }
    public function delete($id){
        //写sql语句
        $sql="delete from `group` where `group_id`={$id}";
        //执行
        return $this->db->execute($sql);
    }
    //修改回显
    public function edit($id){
        //写sql语句
        $sql="select * from `group` where group_id={$id}";
        //执行
        $row=$this->db->fetchRow($sql);
        //返回值
        return $row;
    }
    //修改保存
    public function edit_save($data){
        //写sql语句
        $sql="update `group` set name='{$data['name']}' where group_id={$data['id']}";
        //执行
        return $this->db->execute($sql);
    }
}