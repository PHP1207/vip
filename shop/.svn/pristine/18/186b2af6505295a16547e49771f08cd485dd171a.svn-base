<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/28 0028
 * Time: 23:02
 */
class CodesModel extends Model
{
  //查询所有数据
    public function getAll(){
        //写sql语句
        $sql="select * from codes";
        //执行
        $rows=$this->db->fetchAll($sql);
        return $rows;
    }
    public function users($id){
//        var_dump($id);die;
        //写sql
        $sql="select * from users where user_id={$id}";
        //执行
        $row=$this->db->fetchRow($sql);
       //返回
        return $row;
    }
  //查询会员表
    public function add(){
        //写sql
        $sql="select * from users";
        //执行
        $rows=$this->db->fetchAll($sql);
        //返回
        return $rows;
    }
    //保存添加数据
    public function add_save($data){
        if(empty($data['code'])){
            $this->error='代码不能为空';
        }
        if(empty($data['money'])){
            $this->error='金额不能为空!';
            return false;
        }
        //写sql语句
        $sql="insert into codes set code='{$data['code']}',user_id={$data['user_id']},money={$data['money']}";
        //执行
       return $this->db->execute($sql);
    }
    //删除
    public function delete($code_id){
        //写sql
        $sql="delete from codes where code_id={$code_id}";
        //执行
         return $this->db->execute($sql);
    }
    //修改回显功能
    public function edit($code_id){
        //写sql
        $sql="select * from codes where code_id={$code_id}";
        //执行
       $row=$this->db->fetchRow($sql);
       //返回
        return $row;
    }
    //修改保存
    public function edit_save($data){
        if(empty($data['code'])){
            $this->error='代码不能为空';
        }
        if(empty($data['money'])){
            $this->error='金额不能为空!';
            return false;
        }
        //写sql
        $sql="update codes set code='{$data['code']}',user_id={$data['user_id']},money={$data['money']} where code_id={$data['code_id']}";
        //执行
       return $this->db->execute($sql);
    }
}