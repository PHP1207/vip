<?php

/**
 * Created by PhpStorm.
 * User: wqz19970129
 * Date: 2018/2/28
 * Time: 9:20
 */
class UsersModel extends Model
{
    public function login_check($data){
        if(empty($data['captcha'])){
            //self::red('index.php?p=Home&c=login&a=login','验证码为空','2');
            $this->error="验证码为空";
            return false;
        }
        if(empty($data['username'])){
            $this->error="用户名为空";
            return false;
        }
        if(empty($data['password'])){
            $this->error="用户名为空";
            return false;
        }
        $sql="select * from users where username='{$data['username']}'";
        $users=$this->db->fetchRow($sql);
        if($users['username'] !=$data['username']){
            $this->error="用户名不存在";
            return false;
        }
        $password=md5($data['password']);
        $userspwd=$users['password'];
        if($userspwd != $password){
            $this->error="密码不正确";
            return false;
        }
        return $users;
 }
    public function ipw($id,$password){
            $sql="select * from users where user_id='{$id}'";
            $row=$this->db->fetchRow($sql);
            $pwd=md5($row['password']);
            if($password !=$pwd ){
                $this->error="密码不正确";
                return false;
            }
            return $row;
     }
    public function add($data){
         $pwd=md5($data['password']);
         $sql="insert into users set 
    username='{$data['username']}',
    realname='{$data['realname']}',
    password='{$pwd}',
    sex='{$data['sex']}',
    telephone='{$data['telephone']}',
    remark='{$data['remark']}',
    photo='{$data['photo']}',
    thumb='{$data['thumb']}'
    ";
         $this->db->execute($sql);
     }
    public function getOne($id){
         $sql="select * from users where user_id='{$id}'";
         return $this->db->fetchRow($sql);
     }
    public function getcolumn($id){
        $sql="select realname from users where user_id='{$id}'";
        return $this->db->fetchColumn($sql);
    }
    //获取所有的信息
    public function getAll($search,$page){
        $where='';
        if(!empty($search)){
            $where=" where ".$search;
        }
        $pageSize=3;//总页数
        $sql_count="select count(*) from users $where";
        $count=$this->db->fetchColumn($sql_count);
        $totalPage=ceil($count/$pageSize);
        $page=$page>$totalPage?$totalPage:$page;
        $page=$page<1?1:$page;
        $start=($page-1)*$pageSize;
        $limit=" limit  $start,$pageSize";
        $sql="select * from users $where $limit";
        //var_dump($sql);die;
        $rows=$this->db->fetchAll($sql);
        return ['list'=>$rows,'totalPage'=>$totalPage,'pageSize'=>$pageSize,'count'=>$count,'page'=>$page];
    }

    public function money($user_id){
        //写sql
        $sql="select `money` from users where user_id={$user_id}";
        //执行
        $money=$this->db->fetchColumn($sql);
//        var_dump($money);die;
        //返回值
        return $money;
    }
    public function delete($id){
        $sql="delete from users where user_id='{$id}'";
        $this->db->execute($sql);
    }
    //修改
    public function editSave($data){
        if($_FILES['logo']['error']!=0){
            $sql="update users set 
realname='{$data['realname']}',
sex='{$data['sex']}',
telephone='{$data['telephone']}',
remark='{$data['remark']}'
where user_id='{$data['user_id']}'
";
            //var_dump($sql);die;
            $this->db->execute($sql);
        }else{
            $sql="update users set 
realname='{$data['realname']}',
sex='{$data['sex']}',
telephone='{$data['telephone']}',
remark='{$data['remark']}',
photo='{$data['photo']}',
thumb='{$data['thumb']}'
where user_id='{$data['user_id']}'
";
            $this->db->execute($sql);
        }
    }
    //查询所有会员
    public function user(){
        //写sql
        $sql="select * from users";
        //执行
       $rows=$this->db->fetchAll($sql);
//       var_dump($row);die;
       //返回
        return $rows;
    }
    //保存充值金额
    public function user_save($data,$mon,$val){
    //查询vip等级
        //写sql
        $sql_vip="select `is_vip` from users where user_id={$data['user_id']}";
        //执行
        $vip=$this->db->fetchColumn($sql_vip);
//        var_dump($vip);die;
        foreach ($val as $v){
            if($data['money']>=$v['money']){
                $m=$v['ad_money'];
            }
        }
        if($data['money']==0){
            $this->error='充值金额不能为0!';
            return false;
        }
        if($vip<=1){
            if($data['money']>=2000){
                $is_vip=1;
            }
        }
        if($vip<=2){
            if($data['money']>=5000){
                $is_vip=2;
            }
        }
            if($data['money']>=10000){
                $is_vip=3;
            }
        $num=$mon+$data['money'];
        $nu=$num+($m??0);
        if(($is_vip??'')==''){
            //写sql
            $sql="update users set money={$nu}
 where user_id={$data['user_id']}";
            //执行
            return $this->db->execute($sql);
        }else{
//            var_dump($is_vip);die;
            //写sql
            $sql="update users set money={$nu},
 is_vip='{$is_vip}'
 where user_id={$data['user_id']}";
            //执行
            return $this->db->execute($sql);
        }
    }
    public function history($data,$money){
        //写sql
        $time=time();
        $sql="insert into history set user_id='{$data['user_id']}',`type`=1,amount={$data['money']},content=1,`time`='{$time}',remainder=$money";
        //执行
        $this->db->execute($sql);
    }
    //查询套餐数据
    public function group(){
        //写sql
        $sql="select * from Plans";
        //执行
        $rows=$this->db->fetchAll($sql);
        //返回值
        return $rows;
    }
    //添加代金券
    public function codes($user_id){
        //写sql
        $time=time();
        $num=mt_rand(500,1000);
        $sql="insert into codes set code={$time},user_id={$user_id},money={$num}";
        //执行
        $this->db->execute($sql);
    }
    //查询套餐数据
    public function member(){
        //写sql
        $sql="select * from member";
        //执行
        $rows=$this->db->fetchAll($sql);
        //返回值
        return $rows;
    }
    //查询是否是vip
    public function vip($user_id){
        //写sql
        $sql="select `is_vip` from users where user_id={$user_id}";
        //执行
        $vip1=$this->db->fetchColumn($sql);
        //返回值
        return $vip1;
    }
    //消费
    public function hist1($user_id){
        //写sql
        $sql="select `money` from users where user_id={$user_id}";
        //执行
        $money=$this->db->fetchColumn($sql);
//        var_dump($money);die;
        //返回值
        return $money;
    }
    //查询代金卷上的钱
    public function code($data){
       $sql="select money from codes where code='{$data['code']}'";
        return $a=$this->db->fetchColumn($sql);
       //var_dump($a);die;
    }
    public function his($data,$money){
//        var_dump($data['money']);die;
         if($data['money']>=($money/2)){
             $this->error='会员的余额必须大于套餐金额才能消费!';
             return false;
         }
        //写sql语句
        $time=time();
        $sql="insert into history set member_id={$data['member_id']},user_id='{$data['user_id']}',`type`=0,amount={$data['money']},content=0,`time`={$time},remainder={$money}-{$data['money']}";
//        var_dump($sql);die;
        //执行
       return $this->db->execute($sql);
    }
    public function user_money($user_id,$money,$mon,$a){
        //写sql
        //var_dump($mon);die;
        //1.情况如果优待金券且套餐不大于券可以再次使用2.当套餐小于时套餐中扣除且也在金额中用3没有代金券
        /*$sql_code="select status from codes where user_id={$user_id}";
        $status=$this->db->fetchColumn($sql_code);*/
        if(!empty($a) && $mon<=$a){
                $sql="update codes set money={$a}-{$mon} where user_id={$user_id}";
                //var_dump($sql);die;
                 $this->db->execute($sql);
                $sql1="update codes set status=1 where user_id={$user_id}";
                $this->db->execute($sql1);

        }elseif (!empty($a) && $mon>$a){
            $sql="update codes set money={$a}-{$mon} where user_id={$user_id}";
            $this->db->execute($sql);
            $sql="select money from codes where user_id={$user_id}";
            $c=$this->db->fetchColumn($sql);
            //var_dump($c);die;
            $sql2="update users set money={$money}+{$c} where user_id={$user_id}";
            //执行
            //var_dump($sql2);die;
            $this->db->execute($sql2);
            $sql3="update codes set money=0 where user_id={$user_id}";
            $this->db->execute($sql3);
            //var_dump($sql);die;
            $sql3="select money from codes where user_id={$user_id}";
            $h=$this->db->fetchColumn($sql3);
            if($h==0){
                $a="delete from codes where user_id={$user_id}";
                $this->db->execute($a);
            }
            $sql1="update codes set status=1 where user_id={$user_id}";
            $this->db->execute($sql1);
            //var_dump($sql);die;
        }else{
            $sql="update users set money={$money}-{$mon} where user_id={$user_id}";
            //执行
            $this->db->execute($sql);
        }
    }
    //添加积分
    public function inte($user_id,$money){
            $inte=$money;
          //写sql语句
          //查询该用户有没有积分
          $sql_number="select `number` from Inte where user_id={$user_id} GROUP BY id DESC  limit 1";
          //执行
          $number=$this->db->fetchRow($sql_number);
          if($number['number']==''){
              $num=0;
          }else{
              $num=$number['number'];
          }
//          var_dump($num);
          $n=$num+$inte;
//          var_dump($n);die;
         //写sql
        $sql="insert into inte set `number`={$n},user_id={$user_id}";
//        var_dump($sql);die;
        //执行
        $rs=$this->db->execute($sql);
        return $rs;
    }
}