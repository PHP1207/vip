<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/1 0001
 * Time: 12:00
 */
class UploadTool
{
     //私有属性保存错误信息
    private $error;
    //返回错误信息
    public function getError(){
       return $this->error;
    }
    public function upload($file,$type){
       //判断上传文件是否成功
        if($file['error']!=0){
            $this->error='上传文件失败!';
            return false;
        }
        //判断文件上传格式
        $geshi=['image/jpeg','image/png','image/gif'];
        if(!in_array($file['type'],$geshi)){
            $this->error='该格式赞不支持!';
            return false;
        }
        //判断文件大小
        $num=2*1024*1024;
        if($file['size']>$num){
            $this->error='图片过大!';
            return false;
        }
        //判断文件格式
        if(@getimagesize($file['tmp_name'])===false){
            $this->error='文件格式不对!';
            return false;
        }
        //>>5判断上传文件是通过http上传
        if(!is_uploaded_file($file['tmp_name'])){
            $this->error='不是通过http上传!';
            return false;
        }
        //处理文件上传的名字
        //创建目录
        $dir="./Uploads/{$type}/".date("Ymd").'/';
        if(!is_dir($dir)){//判断目录文件是否存在
            mkdir($dir,0777,true);
        }
        $fileUrl=uniqid().strrchr($file['name'],'.');
        //处理上传文件
        if(!move_uploaded_file($file['tmp_name'],$dir.$fileUrl)){
            $this->error='上传失败!';
            return false;
        }else{
            $this->error='上传成功!';
            return $dir.$fileUrl;
        }
    }
}