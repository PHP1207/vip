<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/2 0002
 * Time: 15:02
 */
class InteModel extends Model
{
   //查询会员积分
    public function getAll($page,$stau){
        //写sql
        $where = '';
        if(!empty($stau)){
            $where=' where '.implode(' and ',$stau);
        }
        //每页显示多少条
        $pageSize=3;
        //总记录数
        //写sql
        $sql_count="select count(*) from inte $where";
        //执行
        $count=$this->db->fetchColumn($sql_count);
        //获取总页数
        $totalPage=ceil($count/$pageSize);
        //从那里开始查
        $sta=($page-1)*$pageSize;
        $page<1?1:$page;
        $page>$totalPage?$totalPage:$page;
        $limit="limit $sta,$pageSize";
        //写sql语句
        $sql="select * from inte $where order by id DESC $limit";
        //执行
        $rows=$this->db->fetchAll($sql);
        //返回值
        return ['list'=>$rows,'count'=>$count,'page'=>$page,'pageSize'=>$pageSize,'totalPage'=>$totalPage];
    }
    //根据user_id查询用户
    public function user($user_id){
        //写sql
        $sql="select * from users where user_id={$user_id}";
        //执行
        $row=$this->db->fetchRow($sql);
        //返回值
        return $row;
    }
    //删除
    public function delete($id){
        //写sql
        $sql="delete from inte where id={$id}";
        //执行
        return $this->db->execute($sql);
    }
}