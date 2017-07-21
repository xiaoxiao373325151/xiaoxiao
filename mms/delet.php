<?php
/**
*
*/
include 'common.php';
if ($_GET['id']){
    $sql="delete from member where id=".$_GET['id'];
    //echo "$sql";
    $result=$pdo->exec($sql);
    if ($result){
       header("location:getall.php");
    }else {
        echo "<script>alert('删除失败')；location.href='getall.php'";
    }
}else {
    //跳转页面  没有id的话就直接回到首页
    header("location:getall.php");
}
?>