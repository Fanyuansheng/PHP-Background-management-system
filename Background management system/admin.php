<?php
session_start();
if(isset($_SESSION['userID'])){
    $name=$_SESSION['userName'];

    require 'admin.html';
}else{
    die("<script>alert('你尚未登录或登录信息已失效，请重新登录！');location.href='login.html'</script>");
}
?>