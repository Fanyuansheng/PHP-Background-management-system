<?php
//设置文档的编码格式
header("Content-type:text/html;charset=utf-8");
if(!empty($_POST)){
    //获取用户数据
    $userID = $_POST["userID"];
    $userName = $_POST["userName"];
    $Gender = $_POST["Gender"];
    $Class = $_POST["Class"];
    $Number = $_POST["Number"];
    $link = require_once "conn6.php";
    //拼接insert语句
    $sql = "INSERT into `student`(userID,userName,Gender,Class,`Number`,userPwd,salt)
     VALUES ('$userID','$userName','$Gender','$Class','$Number','','')";
    
    echo $sql;
    $res =mysqli_query($link,$sql);
    if ($res) {
        echo "<script>alert('注册成功');location.href= 'list.php'</script>";
    }else{
        echo"<script>alert('注册失败！')</script>";
    }
}else{
    //没有提交表单，加载表单页面
    require_once 'reginate.html';
}
