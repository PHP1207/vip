<?php

/**
 * Created by PhpStorm.
 * User: wqz19970129
 * Date: 2018/2/28
 * Time: 21:35
 */
class OrderModel extends Model
{
 public function add($data){
//    var_dump($data);die;
     //$time=time();
     $sql="insert into `order`
set 
realname='{$data['realname']}',
phone='{$data['telephone']}',
barber='{$data['barber']}',
content='{$data['content']}',
`data`='{$data['data']}'
";
     //var_dump($sql);die;
$this->db->execute($sql);
 }
 public function delete($realname){
     $sql="delete from `order` where realname='{$realname}' ";
     $this->db->execute($sql);
 }
 //连表查询
    public function getAll(){
     $sql="select * from `member`";
     $rows=$this->db->fetchAll($sql);
     //var_dump($rows);die;
        //连表
        foreach ($rows as &$fff){
            $fff['member']=$this->db->fetchColumn("select username from member where member_id='{$fff['member_id']}'");
            return $rows;
        }
    }
    //后的页面显示
    public function getAll1($page,$search){
        $where = '';
        if(!empty($stau)){
            $where=' where '.$search;
        }
        //每页显示多少条
        $pageSize=3;
        //总记录数
        $sql_count="select count(*) from `order` $where";
        //执行
        $count=$this->db->fetchColumn($sql_count);
        //总页数
        $totalPage=ceil($count/$pageSize);
        //从哪里开始查
        $page=$page>$totalPage?$totalPage:$page;
        $page=$page<1?1:$page;
        $sta=($page-1)*$pageSize;
        $limit="limit $sta,$pageSize";
        //写sql
        $sql="select * from `order` $where $limit";
        //执行
        //var_dump($sql);die;
        $rows=$this->db->fetchAll($sql);
        //var_dump($rows);die;
        //返回
        return ['list'=>$rows,'count'=>$count,'pageSize'=>$pageSize,'page'=>$page,'totalPage'=>$totalPage];
    }
    public function update($data){
        if($data['status']==0){
            $sql="update `order` set `status`=1 where order_id='{$data['order_id']}'";
            $this->db->execute($sql);
        }else{
            $sql="update `order` set `status`=0 where order_id='{$data['order_id']}'";
            $this->db->execute($sql);
        }
    }
    //后台修改回复
    public function add1($data){
        $sql="update `order` set 
reply='{$data['reply']}'
where order_id='{$data['order_id']}' ";
        $this->db->execute($sql);
    }
    //这是前台获取预约
    public function getAll2($realname){
     $sql="select * from `order` where realname='{$realname}'";
     //var_dump($sql);die;
     return $row=$this->db->fetchAll($sql);
     //var_dump($row);die;
    }
}