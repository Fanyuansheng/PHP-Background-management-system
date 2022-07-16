<?php
if(!$_POST){
    session_start();
    unset($_SESSION['userID']);
   // session_destroy(); 
    require_once 'doLogin.php';
}else{
    echo "使用post请求错误";
}
?>