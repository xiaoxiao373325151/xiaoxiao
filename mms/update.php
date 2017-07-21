<?php
/**
*
*/
include 'common.php';
if ($_GET['id']){
    $sql="select * from member where id=".$_GET['id'];
    //echo "$sql";
    $result=$pdo->query($sql);
    $data=$result->fetchAll(PDO::FETCH_OBJ);
    //var_dump($data[0]);
    if($data[0]==null){
        echo "数据不存在";
    }
    //如果点击了提交按钮的话
    if ($_POST['send']){
        /* 如果没有修改，$pwd的值就是原来的密码
         * 如果修改了，$pwd的值就是加密后的值
         *  */
        if ($_POST['pwd2']==$_POST['pwd']){
            $pwd=$_POST['pwd'];
        }else {
            $pwd=md5($_POST['pwd']);
        }
        //var_dump($_POST);
        $sql="update member set 
                                username='".$_POST['username']."',
                                pwd='".$pwd."',
                                email='".$_POST['email']."'
              where id=".$_GET['id'];
        //echo "$sql";
        $result=$pdo->exec($sql);
        if ($result){
            echo "修改成功";
            echo "<script>alert('修改成功');location.href='getall.php';</script>";
        }else if ($result==0){
            echo "没有修改";
        }else {
            echo "修改失败";
        }
    }
}else {
    //没有id的话 跳转到首页去
    header("location:getall.php");
}
?>
<style>
.reg{
	border:1px solid #ddd;
	position:absolute;
	padding:15px;
	left:0;
	right:0;
	top:0;
	bottom:0;
	margin:auto;
	width:205px;
	height:110px;
	box-shadow:0 0 3px #ddd;
}
.reg input{
	margin-top:5px;
	width:95%;
}
</style>
<form action="" method="post" class="reg">
  <!--  第一个input是保存原来的密码 -->
   <input type="hidden" name="pwd2" value=<?php echo $data[0]->pwd; ?>>
   <input type="text" name="username" value=<?php echo $data[0]->username; ?>><br>
   <input type="password" name="pwd" value=<?php echo $data[0]->pwd; ?>><br>
   <input type="text" name="email" value=<?php echo $data[0]->email; ?>><br>
   <input type="submit" value="submit" name="send">
</form>