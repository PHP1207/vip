<?php

/**
 * Created by PhpStorm.
 * User: wqz19970129
 * Date: 2018/3/1
 * Time: 21:59
 */
class ListModel extends  Model
{
    //获取钱
 public function getAll(){
     $sql="select * from `users` order by money DESC limit 0,3";
     return $rows=$this->db->fetchAll($sql);
     //var_dump($rows);die;
    //return $rows;
 }
    //消费金额
    public function getAll1(){
        $sql1="select distinct sum(amount) from `history` GROUP BY user_id order by sum(amount) DESC limit 3";
        $rows = $this->db->fetchAll($sql1);
        //var_dump($rows);die;
        $sql="select user_id,sum(amount) from  `history` GROUP BY user_id order by sum(amount) DESC limit 0,3";
        //SELECT DISTINCT  count(member_id) as count from histories GROUP BY member_id ORDER BY count DESC limit 3;
        $rows=$this->db->fetchAll($sql);
        foreach ($rows as &$row){
             $a=$this->db->fetchAll("select user_id,sum(amount) from  `history` GROUP BY user_id HAVING sum(amount)='{$row['sum(amount)']}' limit 3");
            //var_dump($a);die;
            foreach ($a as &$b){
                $b['realname']=$this->db->fetchColumn("select realname from `users` where user_id='{$b['user_id']}'");
            }
            $row['sum'] = $a;
            //var_dump($rows);die;
        }
        return $rows;
    }
    //服务次数
    public function getAll2()
    {
        $sql = "select DISTINCT count(member_id) from  `history` GROUP BY member_id order by count(member_id) DESC limit 3";
        //SELECT DISTINCT  count(member_id) as count from histories GROUP BY member_id ORDER BY count DESC limit 3;
        $rows = $this->db->fetchAll($sql);
        //$sql1="select member_id,count(member_id) from  `history` GROUP BY member_id HAVING count(member_id)=";
        foreach ($rows as &$row) {
            $a = $this->db->fetchAll("select DISTINCT member_id,count(member_id) from  `history` GROUP BY member_id HAVING `count(member_id)`='{$row['count(member_id)']}' limit 3");
            //var_dump($a);die;
            foreach ($a as &$b) {
                $b['realname'] = $this->db->fetchColumn("select realname from `member` where member_id='{$b['member_id']}'");
            }
            $row['count'] = $a;
        }
        //var_dump($row['member_id']);die;
//        var_dump($rows);die;
        return $rows;
    }
}
/*$sql="select member_id,count(member_id) from  `history` GROUP BY member_id order by count(member_id) DESC limit 0,3";
//SELECT DISTINCT  count(member_id) as count from histories GROUP BY member_id ORDER BY count DESC limit 3;
$rows=$this->db->fetchAll($sql);
foreach ($rows as &$row){
    $row['realname']=$this->db->fetchColumn("select realname from `member` where member_id='{$row['member_id']}' ");
    //var_dump($rows);die;
}
return $rows;
//var_dump($rows);die;
}*/
/*$sql="select DISTINCT count(member_id) from  `history` GROUP BY member_id order by count(member_id) DESC limit 3";
//SELECT DISTINCT  count(member_id) as count from histories GROUP BY member_id ORDER BY count DESC limit 3;
$rows=$this->db->fetchAll($sql);
//$sql1="select member_id,count(member_id) from  `history` GROUP BY member_id HAVING count(member_id)=";
foreach ($rows as &$row){
    $row['member_id']=$this->db->fetchColumn("select DISTINCT member_id,count(member_id) from  `history` GROUP BY member_id HAVING count(member_id)='{$row['count(member_id)']}' ");
    //var_dump($row['member_id']);die;
    $row['realname']=$this->db->fetchColumn("select realname from `member` where member_id='{$row['member_id']}'");
}
//var_dump($row['member_id']);die;
//return $rows;
var_dump($rows);die;
}*/