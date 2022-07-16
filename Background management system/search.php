<?php
$sql = "SELECT * FROM `student`";
//判断是否通过表单提交搜索信息，如需搜索则拼接搜索条件
if(!empty($_GET["keyword"])){
    $keyword = $_GET["keyword"];
    //where子句前有一个空格分隔查询语句和筛选条件
    $sql .="WHERE userName LIKE '%$keyword%'";
}
//加载数据库连接文件
$link = require_once "conn6.php";
//转义字符串中的特殊字符
mysqli_real_escape_string($link,$sql);
$res = mysqli_query($link,$sql);
//定义数据数组
$dataArr = array();
$dataArr = mysqli_fetch_all($res,MYSQLI_ASSOC);
//加载视图模板
require_once "admin.html";
?>
