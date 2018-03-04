<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/28 0028
 * Time: 14:19
 */
class CapcthaController
{
   public function capctha(){
       //随机生成字符串
       $str="ZXCVBNMKJHGFDSAPOUYTREWQ23456789";
       //随机打乱
       $str1=str_shuffle($str);
       //随机截取
       $string=substr($str1,1,4);
//       var_dump($string);die;
       //保存到session中
       @session_start();
       $_SESSION['yan']=$string;
       //创建画布
       $wdith=130;
       $hegit=30;
       $image=imagecreatetruecolor($wdith,$hegit);
//       填充颜色
       $color=imagecolorallocate($image,255,255,255);
       imagefill($image,0,0,$color);
       //写字
       $col=imagecolorallocate($image,mt_rand(0,10),mt_rand(0,10),mt_rand(0,10));
       imagestring($image,5,$wdith/2.6,$hegit/3,$string,$col);
       header('Content-Type: image/jpeg');
       imagejpeg($image);
       imagedestroy($image);
   }
}