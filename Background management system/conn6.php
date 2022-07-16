<?php
header("Content-type:text/html;charset=utf-8");
$host = "127.0.0.1";
$username = "root";
$password = "720128";
$database = "student";
$charset = "utf8";
@$link = mysqli_connect($host,$username,$password,$database);
if (!$link){
    die("数据库服务器连接失败！<br/>错误号:".mysqli_connect_errno()."<br/>错误信息:".mysqli_connect_error());
}
// echo"数据库服务器连接成功！";
mysqli_set_charset($link,$charset);
return $link;
?>