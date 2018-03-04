<?php

/**
 * Created by PhpStorm.
 * User: wqz19970129
 * Date: 2018/1/29
 * Time: 10:39
 */
class CaptchaController extends Controller
{
    public function index()
    {
        //生成随机字符串
        $a=mt_rand(0,10);
        $b=mt_rand(0,10);
        $arr=['+-*'];
        $str=implode("",$arr);
        $h=str_shuffle($str);
        $c=substr($h,-1,1);
        $str="$a"."$c"."$b"."=";
       if($c=='+'){
           $rs=$a+$b;
       }elseif ($c=='-'){
           $rs=$a-$b;
       }
       elseif ($c=='*'){
           $rs=$a*$b;
       }
        //$str="23456789ABCDEFGHJZLMNOPQRSTUVWSYZ";
        //打乱
        //$str=str_shuffle($str);
        //截取字符串
        $random_code=$str;
        //保存在session中并判断是否与传过来的一样
        @session_start();
        $_SESSION['random_code']=$rs;
        //画图准备画布
        //$image_src="./public/captcha/captcha_bg".mt_rand(1,5).".jpg";
        $image_src = imagecreatefromjpeg('./public/Home/captcha/test .jpg');
        //获取所有信息
        $getsize=getimagesize('./public/Home/captcha/test .jpg');
        //var_dump($getimage);
        //存值
        list($weight,$height)=$getsize;
        //创建画布
        $image=imagecreatetruecolor(150,27);
        //写字随机产生两种颜色
        $white=imagecolorallocate($image,255,255,255);
        $black=imagecolorallocate($image,0,0,0);
        $color=[$white,$black];
        shuffle($color);//打乱数组
        //写字
        imagecopyresampled($image,$image_src,0,0,0,0,150,27,150,27);

        imagestring($image,5,60,5,$random_code,$color[0]);
        //画矩形
        //imagerectangle($image,0,0,$weight,$height,$white);
        //混淆
        for($i=0;$i<=50;++$i){
            $random_color=imagecolorallocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
            imagesetpixel($image,mt_rand(0,$weight),mt_rand(0,$height),$random_color);
        }
        for($i=0;$i<=2;++$i){
            $random_color=imagecolorallocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
            imageline($image,mt_rand(0,$weight),mt_rand(0,$height),mt_rand(0,$weight),mt_rand(0,$height),$random_color);
        }
        //显示头部的信息
        header("Content-Type:image/jpeg");
        //保存图片
        imagejpeg($image);
        //销毁图片
        imagedestroy($image);
    }
}
