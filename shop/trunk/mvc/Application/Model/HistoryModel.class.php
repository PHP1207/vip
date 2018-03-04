<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/1 0001
 * Time: 15:25
 */
class HistoryModel extends Model
{
   //查询所有的消费记录
    public function getAll($page,$stau,$user_id){
        $where='';
        if ($user_id!=''){
            $where="where user_id={$user_id} ";
        }
        if(!empty($stau)){
            $where=' where '.implode(' and ',$stau);
        }
//        var_dump($where);die;
        //每页显示多少条
        $pageSize=3;
        //获取总记录数
        $sql_count="select count(*) from history $where";
        //执行
        $count=$this->db->fetchColumn($sql_count);
        //获取总页数
        $totalPage=ceil($count/$pageSize);
        //获取开始位置
        $sta=($page-1)*$pageSize;
        $page<1?1:$page;
        $page>$totalPage?$totalPage:$page;
        $limit="limit $sta,$pageSize";
        //写sql
        $sql="select * from history $where order by `time` DESC $limit";
        //执行
        $rows=$this->db->fetchAll($sql);
        //返回值
        return ['list'=>$rows,'page'=>$page,'pageSize'=>$pageSize,'count'=>$count,'totalPage'=>$totalPage];
    }
    //查询user
    public function user($user_id){
        //写sql
        $sql="select * from users where user_id={$user_id} ";
        //执行
        $row=$this->db->fetchRow($sql);
//        var_dump($row);die;
        //返回值
        return $row;
    }
    //删除
    public function delete($history_id){
        //写sql
        $sql="delete from history where history_id={$history_id}";
        //执行
        return $this->db->execute($sql);
    }
}