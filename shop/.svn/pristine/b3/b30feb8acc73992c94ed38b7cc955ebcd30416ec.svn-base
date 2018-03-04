<?php

/**
 * Created by PhpStorm.
 * User: wqz19970129
 * Date: 2018/3/2
 * Time: 14:11
 */
class GrandModel extends Model
{
    //得到所有等级信息
 public function getAll(){
     $sql="select * from grand";
     return $this->db->fetchAll($sql);
 }
 //等到对应额等级修改
    public function getOne($id){
     $sql="select * from grand where grand_id='{$id}'";
     return $this->db->fetchRow($sql);
    }
//保存
public function editSave($data){
        $sql="update grand set 
grand='{$data['grand']}',
discount='{$data['discount']}',
money='{$data['money']}'
where grand_id='{$data['grand_id']}'
";
        $this->db->execute($sql);
}
}