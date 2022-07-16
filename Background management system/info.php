<?php
$link = require_once "conn6.php";
if ($_POST) {
    $img = $_FILES['file'];
    if ($_FILES["file"]["size"] != 0) {
        // if (strcmp($img['type'] ,"image/jpg") or strcmp($img['type'] ,"image/jpeg") )
        // {      
        //     echo $img['type'];
        //     echo '类型错误';
        //     return;
        // }
        $NewPath = @"D://img//" . $img['name'];
        copy($img['tmp_name'], $NewPath);
    }
    $data = $_POST;
    //注意set后面有一个空格
    $sql = "UPDATE `student` SET ";
    //遍历$data，实现自动拼接
    foreach ($data as $k => $v) {
        if ($k != 'file')
            $sql .= "$k='$v',";
    }
    if ($_FILES["file"]["size"] != 0) {
        $sql .= "imgData='$NewPath'";
    }
    //去除最右侧多余的逗号
    $sql = rtrim($sql, ",");
    $id = $_POST["userID"];
    $sql .= "  WHERE userID='$id'";
    // $link = require_once "conn6.php";
    $res = mysqli_query($link, $sql);
    // echo $res;    
    if ($res) {
        //require_once 'list.php';
        echo "<script>alert('数据修改成功!');location.href='info.php'</script>";
    } else {
        echo "<script>alert('数据修改失败！')</script>";
    }
} else {
    session_start();
    $user_id = $_SESSION['userID'];
    $user_id = '00000002';
    $sql = "SELECT * FROM `student` WHERE userID=$user_id";
    // echo $sql;
    $res =  mysqli_query($link, $sql);
    $data = mysqli_fetch_assoc($res);
    //echo $data['imgData'];
    $img = imgBase64Encode($data['imgData']);
    require_once 'info.html';
}
/**
 * 图片base64编码
 * @param string $img
 * @param bool $imgHtmlCode
 * author 江南极客
 * @return string
 */
function imgBase64Encode($img = '', $imgHtmlCode = true)
{
    //如果是本地文件
    if (strpos($img, 'http') === false && !file_exists($img)) {
        return $img;
    }
    //获取文件内容
    $file_content = file_get_contents($img);
    if ($file_content === false) {
        return $img;
    }
    $imageInfo = getimagesize($img);
    $prefiex = '';
    if ($imgHtmlCode) {
        $prefiex = 'data:' . $imageInfo['mime'] . ';base64,';
    }
    $base64 = $prefiex . chunk_split(base64_encode($file_content));
    return $base64;
}
