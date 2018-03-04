<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/26 0026
 * Time: 10:27
 */
class ImageTool
{
   //私有的属性保存错误的信息
    private $error;
    //共有的调用属性的方法
    public function getError(){
        return $this->error;
    }
    //制作缩略图
    public function thmub($src,$thmub_wdith,$thmub_hegit){
        if(!is_file($src)){
            $this->error='图片不能为空!';
            return false;
        }
        //获取原图片的宽高
        $kuangao=getimagesize("{$src}");
        list($src_wdith,$src_hegit)=$kuangao;
        //获取原图片的类型
        $mime=$kuangao['mime'];
        //拼接方法名
        $suxxff=explode('/',$mime)[1];
        $fu='imagecreatefrom'.$suxxff;
        $src_image=$fu($src);
        //创建画布
        $thmub_image=imagecreatetruecolor($thmub_wdith,$thmub_hegit);
        //补白
//        选择颜色
        $color=imagecolorallocate($thmub_image,255,255,255);
        //填充颜色
        imagefill($thmub_image,0,0,$color);
        //将原图片放到新图上
        $num=max($src_wdith/$thmub_wdith,$src_hegit/$src_hegit);
        $w=$src_wdith/$num;
        $h=$src_hegit/$num;
        imagecopyresampled($thmub_image,$src_image,($thmub_wdith-$w)/2,($thmub_hegit-$h)/2,0,0,$w,$h,$src_wdith,$src_hegit);
        //拼接上传函数
        $thmub_patch='image'.$suxxff;
        $info=pathinfo($src);
        $Url=$info['dirname'].'/'.$info['filename'].'.'.$thmub_wdith.'X'.$thmub_hegit.'.'.$info['extension'];
//        var_dump($Url);die;
        $thmub_patch($thmub_image,$Url);
        //销毁图片
        imagedestroy($src_image);
        imagedestroy($thmub_image);
        //返回值
        return $Url;
    }
}