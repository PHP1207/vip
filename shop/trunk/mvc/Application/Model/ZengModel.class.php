<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/2 0002
 * Time: 0:04
 */
class ZengModel extends Model
{
   //查询所有的数据
    public function getAll(){
        //写sql
        $sql="select * from zeng";
        //执行
        $rows=$this->db->fetchAll($sql);
        //返回值
        return $rows;
    }
    //添加赠送规则
    public function add_save($data){
        if($data['money']==''){
            $this->error='充值金额不能为空!';
            return false;
        }
        if($data['ad_money']==''){
            $this->error='赠送金额不能为空!';
            return false;
        }
        //写sql
        $sql="insert into zeng set money={$data['money']},ad_money={$data['ad_money']}";
        //执行
        return $this->db->execute($sql);
    }
    //删除
    public function delete($id){

        //写sql
        $sql="delete from zeng where id={$id}";
        //执行
        return $this->db->execute($sql);
    }
    //修改回显
    public function edit($id){
        //写sql
        $sql="select * from zeng where id={$id}";
        //执行
        $row=$this->db->fetchRow($sql);
        //返回值
        return $row;
    }
    //修改保存
    public function edit_save($data){
        if($data['money']==''){
            $this->error='充值金额不能为空!';
            return false;
        }
        if($data['ad_money']==''){
            $this->error='赠送金额不能为空!';
            return false;
        }
        //写sql
        $sql="update zeng set money='{$data['money']}',ad_money='{$data['ad_money']}' where id={$data['id']}";
        //执行
       return $this->db->execute($sql);
    }
}