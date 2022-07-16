<?php
header("Content-type:text/html;charset=utf-8");
session_start();
//$link=mysqli_connect("127.0.0.1","root","720128","student")or die('数据库连接失败!'.mysqli_error($link));
   
if(isset($_SESSION["userID"])){

    $name=$_SESSION["userID"];
    $link = require_once "conn6.php";
    //定义每页显示的数据量
    $pageSize = 6;
    
    //查询总记录数
    $sql = "SELECT COUNT(*) cnt FROM student";
    $cntRes = mysqli_query($link, $sql);
    $cntRow = mysqli_fetch_assoc($cntRes);
    $cnt = $cntRow["cnt"];
    //向上取整得到总的页数
    $maxPage = ceil($cnt / $pageSize);
    //获取传递的页码并判断$page值的合法性
    $page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
    $page = $page > $maxPage ? $maxPage : $page;
    $page = $page < 1 ? 1 : $page;
    //计算读取数据的偏移量
    $offset = ($page - 1) * $pageSize;
    //分页的sql语句
    $sql = "SELECT * FROM student ";

   if(!empty($_GET["keyword"])){
    $keyword = $_GET["keyword"];
    //where子句前有一个空格分隔查询语句和筛选条件
    $sql .="WHERE userName LIKE '%$keyword%'";
}
    $sql.="ORDER BY userID limit $offset,$pageSize";
    $res = mysqli_query($link, $sql);
    $dataArr = array();
    $dataArr = mysqli_fetch_all($res, MYSQLI_ASSOC);
//加载视图模板
require_once "list.html";
}else{
    die("<script>alert('你尚未登录或登录信息已失效，请重新登录！');location.href='login.html'</script>");
}

?>