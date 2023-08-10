# PHP-Background-management-system
<p align="center">
    <h1 align="center">用PHP和layui搭建的学生后台管理系统</h1>
</p><br>
    
* 服务器来自于[阿里云](https://cn.aliyun.com/)<br>
* 找到bug算我输好吧🤸‍♀️🤸‍♂️<br>
* 喜欢的可以点个小星星🤞<br>
* [layui官网](https://www.layuiweb.com)&[PHP官网](https://www.php.net/)<br>
## PHP手写验证码
```php
<?php
$imgWidth=70;
$imgHeight=22;
$charLen=5;
$fontSize=5;
//保存验证码字符串
$code='';
//生成字符集数组，不需要0，避免与字母0冲突
$charArr=array_merge(range(1,9),range('A','Z'),range('a','z'));
$endIndex=count($charArr)-1;
//获取指定长度的验证码字符串
for($i=0;$i<$charLen;$i++){
    $code.=$charArr[mt_rand(0,$endIndex)];
}
session_start();//启动会话
$_SESSION['captcha']=$code;//将验证码字符串保存到session中
$img=imagecreatetruecolor($imgWidth,$imgHeight);//创建一个空白画布
$bgColor=imagecolorallocate($img,200,200,200);//为画布分配颜色
imagefill($img,0,0,$bgColor);//填充背景色
//设置字符串颜色
$strColor=imagecolorallocate($img,mt_rand(0,100),mt_rand(0,100),mt_rand(0,100));
for($i=0;$i<$charLen;$i++){
    //设定字符串位置
    $x=floor($imgWidth/$charLen)*$i+3;
    $y=rand(0,5);
    imagechar($img,$fontSize,$x,$y,$code[$i],$starColor);
}
//绘制一些干扰点
for($i=0;$i<80;$i++){
    //为画布分配随机颜色
    $color=imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
    imagesetpixel($img,mt_rand(0,$imgWidth),mt_rand(0,$imgHeight),$color);
}
//绘制一些干扰线段
for($i=0;$i<4;$i++){
    $color=imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
    //在$img图像山随机画一条直线
    imageline(
        $img,
        mt_rand(0,$imgWidth-1),mt_rand(0,$imgHeight-1),
        mt_rand(0,$imgWidth-1),mt_rand(0,$imgHeight-1),
        $color
    );
}
//为画布绘制矩形边框
$rectColor=imagecolorallocate($img,150,150,150);
imagerectangle($img,0,0,$imgWidth-1,$imgHeight-1,$rectColor);
//输出图片内容
header('Content-type:image/png');
imagepng($img);//输出图片
//销毁画布
imagedestroy($img);
?>
 ```
