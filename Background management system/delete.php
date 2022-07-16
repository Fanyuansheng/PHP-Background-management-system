<?php
header("Content-type:text/html;charset=utf-8");
$id = $_GET["id"];
$sql = "DELETE FROM `student` WHERE userId=$id";
$link= require_once"conn6.php";
$res=mysqli_query($link,$sql);
if ($res) {
    echo"<script>alert('数据删除成功！');location.href='list.php'</script>";
}else{
    echo"<script>alert('数据删除失败！')</script>";
}
?>