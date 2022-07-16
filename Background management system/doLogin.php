<?php
header("Content-type:text/html;charset=utf-8");
if($_POST){
    session_start();
    $code=isset($_POST['captcha'])?trim($_POST['captcha']):'';
    
    if(empty($_SESSION['captcha'])){     //判断session中是否存在验证码
        $ErrorMeg='验证码错误，请重新输入！';
     //   echo '验证码错误，请重新输入';
        require_once 'login.html';
        return ;
    }

    //比较用户提交的验证码和session中的是否相同,忽略大小写
    if(strtolower($code)!=strtolower($_SESSION['captcha'])){
       $ErrorMeg=('验证码错误，请重新输入！');
        require_once 'login.html';
        return;
    }
    unset($_SESSION['captcha']);  
    
    //获取用户填写的信息
    $ID=$_POST["userID"];
    $pwd=$_POST["userPwd"];
    $link=mysqli_connect("127.0.0.1","root","720128","student")or die('数据库连接失败!'.mysqli_error($link));
    mysqli_query($link,'set names utf8');
    //根据用户名查询用户密码对应的盐值
    $sql="SELECT userPwd,userName,salt FROM student WHERE userID=?";
    $stmt =mysqli_prepare($link,$sql);
    mysqli_stmt_bind_param($stmt,"s",$ID);
    $res=mysqli_stmt_execute($stmt);
    //从编译对象中获取结果集
    $res=mysqli_stmt_get_result($stmt);
    $userData=mysqli_fetch_assoc($res);
    //判断结果
    if(empty ($userData)){
        echo"<script>alert('用户名不存在！');history.go(-1)</script>";
    }else{
        $pwdDB=$userData["userPwd"];
        $salt=$userData["salt"];
        if($pwdDB!=md5($pwd.$salt)){
            echo"<script>alert('用户密码错误!');history.go(-1)</script>";
        }else{
            //验证通过，保存session，之后跳转到用户页面
            session_start();
            $_COOKIE['userID']=$ID;
            $_SESSION["userID"]=$ID;
            $_SESSION["userName"]=$userData["userName"];
            echo"<script>location.href='admin.php'</script>";
        }
    }
}else{
    
    require_once 'login.html';
  //  echo"<script>alert('数据传递错误！');history.go(-1)</script>";
}
?>