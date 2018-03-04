<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/28 0028
 * Time: 16:11
 */
class PlansModel extends Model
{
    //查询所有数据
    public function getAll($page,$stau){
        $where='';
        if (!empty($stau)){
            $where =' where '.implode(' and ',$stau);
        }
        //每页显示多少条
        $pageSize=3;
        //总计录数
        $sql_count="select count(*) from plans $where";
        //执行
        $count=$this->db->fetchColumn($sql_count);
        //总页数
        $totalPage=ceil($count/$pageSize);
        //从哪里开始查
        $sta=($page-1)*$pageSize;
        $page<1?1:$page;
        $page>$totalPage?$totalPage:$page;
        $limit="limit $sta,$pageSize";
        //写sql
        $sql="select * from plans $where $limit";
        //执行
        $rows=$this->db->fetchAll($sql);
        //返回数据
        return ['list'=>$rows,'page'=>$page,'pageSize'=>$pageSize,'totalPage'=>$totalPage,'count'=>$count];
    }
    //添加保存
    public function add_save($data){
        if(empty($data['name'])){
            $this->error='套餐名称不能为空!';
            return false;
        }
        if(empty($data['des'])){
            $this->error='描述不能为空!';
            return false;
        }
        if(empty($data['money'])){
            $this->error='金额不能为空!';
            return false;
        }
        if(empty($data['status'])){
            $this->error='状态不能为空!';
            return false;
        }
        //写sql
        $sql="insert into plans set `name`='{$data['name']}',des='{$data['des']}',money='{$data['money']}',status='{$data['status']}'";
        //执行
       return $this->db->execute($sql);
    }
    //删除
    public function delete($id){
//        var_dump($id);die;
        //写sql
        $sql="delete from plans where plan_id={$id}";
        //执行
        return $this->db->execute($sql);
    }
    //修改回显
    public function edit($id){
        //写sql
        $sql="select * from plans where plan_id={$id}";
        //执行
        $row=$this->db->fetchRow($sql);
        //返回值
        return $row;
    }
    //修改保存
    public function edit_save($data){
        if(empty($data['name'])){
            $this->error='套餐名称不能为空!';
            return false;
        }
        if(empty($data['des'])){
            $this->error='描述不能为空!';
            return false;
        }
        if(empty($data['money'])){
            $this->error='金额不能为空!';
            return false;
        }
        if(empty($data['status'])){
            $this->error='状态不能为空!';
            return false;
        }
        //写sql语句
        $sql="update plans set `name`='{$data['name']}',des='{$data['des']}',money='{$data['money']}',status='{$data['status']}' where plan_id={$data['plan_id']}";
        //执行
       return $this->db->execute($sql);
    }
}