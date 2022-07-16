<?php
header("Content-type:text/html;charset=utf-8");
if (!empty($_POST)) {
    //获取用户数据
    $data = $_POST;
    //注意set后面有一个空格
    $sql = "UPDATE `student` SET ";
    //遍历$data，实现自动拼接
    foreach ($data as $k => $v) {
        $sql .= "$k='$v',";
    } 
    //去除最右侧多余的逗号
    $sql = rtrim($sql,",");
    $id = $_POST["userID"];
    $sql .= " WHERE userID=$id";
    echo $sql;
    $link = require_once "conn6.php";
    $res = mysqli_query($link, $sql);
     echo $res;
    if ($res) {
      //require_once 'list.php';
      
        echo "<script>alert('数据修改成功!');location.href='list.php'</script>";
    } else {
        echo "<script>alert('数据修改失败！')</script>";
    }
} else {
    //没有提交表单，加载表单页面并显示原始数据信息
    $id = $_GET["id"];
    $sql = "SELECT * FROM `student` WHERE userID=$id";
   // echo $sql;
    $link = require_once"conn6.php";
    $res =  mysqli_query($link, $sql);
    $data = mysqli_fetch_assoc($res);
    require_once 'modify.html';
}
