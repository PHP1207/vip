<?php

/**
 * Created by PhpStorm.
 * User: wqz19970129
 * Date: 2018/2/28
 * Time: 11:48
 */
class ArticleModel extends  Model
{
    //获取所有的信息
    public function getAll1(){
        $sql="select * from article";
        return $this->db->fetchAll($sql);
    }
 public function getAll($stau,$page){
     //        var_dump($stau);die;
     //每页显示
     $where = '';
     if(!empty($stau)){
         $where=' where '.$stau;
     }
     //每页显示多少条
     $pageSize=3;
     //总记录数
     $sql_count="select count(*) from article $where";
     //执行
     $count=$this->db->fetchColumn($sql_count);
     //总页数
     $totalPage=ceil($count/$pageSize);
     //从哪里开始查
     $sta=($page-1)*$pageSize;
     $limit="limit $sta,$pageSize";
     //写sql
     $sql="select * from article $where $limit";
     //执行
     //var_dump($sql);die;
     $rows=$this->db->fetchAll($sql);
     //返回
     return ['list'=>$rows,'count'=>$count,'pageSize'=>$pageSize,'page'=>$page,'totalPage'=>$totalPage];
 }
 //获取单独的信息
    public function getOne($id){
        $sql="select * from article where article_id='{$id}'";
        return $this->db->fetchRow($sql);
    }
    //添加活动
    public function add($data){
        $sql="insert into article set 
  title='{$data['title']}',
  content='{$data['content']}',
  start='{$data['start']}',
  `end`='{$data['end']}'
";
 $this->db->execute($sql);
    }
    //删除
    public function delete($id){
    $sql="delete from article where article_id='{$id}'";
    $this->db->execute($sql);
    }
    public function getOne1($id){
        $sql="select * from article where article_id='{$id}'";
        return $this->db->fetchRow($sql);
    }
    public function edit($data){
        $sql="update article set 
  title='{$data['title']}',
  content='{$data['content']}',
  start='{$data['start']}',
  `end`='{$data['end']}'
  where article_id='{$data['article_id']}'
";
        $this->db->execute($sql);
    }
}