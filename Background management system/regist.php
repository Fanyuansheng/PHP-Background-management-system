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
    // $sql="select * from userID=?";
    $link = require_once "conn6.php";
    // $stmt =mysqli_prepare($link,$sql);
    // mysqli_stmt_bind_param($stmt,"s",$userID);
    // $res=mysqli_stmt_execute($stmt);
    // //从编译对象中获取结果集
    // $res=mysqli_stmt_get_result($stmt);
    // $userData=mysqli_fetch_assoc($res);
    // if(empty($userData)){  
    //     echo '添加失败，学号重复';
    //     return;
    // }
    //拼接insert语句
    $sql = "INSERT into `student`(userID,userName,Gender,Class,`Number`,userPwd,salt,imgData)
     VALUES ('$userID','$userName','$Gender','$Class','$Number','','','')";
    echo $sql;
    $res =mysqli_query($link,$sql);
    if ($res) {
        echo "<script>alert('数据添加成功！');location.href= 'list.php'</script>";
    }else{
        echo"<script>alert('数据添加失败！')</script>";
    }
}else{
    //没有提交表单，加载表单页面
    require_once'regForm.html';
}
