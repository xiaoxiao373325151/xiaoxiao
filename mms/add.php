<?php
/**
*
*/
//把common.php这个文件引入进来
include 'common.php';

if ($_POST['send']){
    $searchSql="select * 
                from   member
                where  username='".$_POST['username']."'";
    $searchResult=$pdo->query($searchSql);
    $oneUser=$searchResult->fetchAll(PDO::FETCH_OBJ);
    var_dump($oneUser[0]);
    //终止代码执行
    //exit();
    //判断用户名存在的话  那么直接返回修改页面重新填写
    if ($oneUser[0]){
        echo "<script>
             alert('用户名已存在，请重试！');
             history.go(-1);
              </script>";
        return false;
    }
    //添加数据
    //sql语句  用户名 密码 邮箱是字符串 时间是一个变量需要使用   ..  分割 
    $sql="insert into member(username,pwd,email,regTime)
          values
          (
          '".$_POST['username']."',
          '".md5($_POST['pwd'])."',
          '".$_POST['email']."',
          '".date('Y-m-d H:i:s')."'
          )";
    $result=$pdo->exec($sql);
    echo "$result";
    if ($result){
        //echo "OK";
        echo "<script>
               alert('数据添加成功');
               location.href='getall.php';
               </script>";
    }else {
        echo "not OK";
    }
};
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
	background-color: #a8a8a8;
}
.reg input{
	margin-top:5px;
	width:95%;
}
.addBtn{
	border-radius:10px;
	background:#73c8f7;
	border:none;
	height:30px;
	width:50px;
}
</style>
<form action="" method="post" class="reg">
   <input type="text" name="username" placeholder="请输入用户名"><br>
   <input type="password" name="pwd" placeholder="请输入密码"><br>
   <input type="text" name="email" placeholder="请输入邮箱" class="email"><br>
   <input type="submit" value="submit" name="send" class="addBtn">
</form>
 <script>
 var addBtn=document.querySelector(".addBtn");
 //console.log(addBtn);
 addBtn.addEvenListener("click",function(){
	 //阻止默认动作 不让提交下去
     evt.preventDefault(); 
	 });
 </script>