<?php
/**
*
*/
include 'common.php';
//总记录数
$total=$pdo->query("select * from member")->rowCount();
//echo $total;
//没一页显示的数据条数
$pagesize=3;
$pageTotal=ceil($total/$pagesize);
//给page定义一个数字   随着鼠标的点击而变换  如果page有值的话就是那个值  没值的话就直接是page=1
if ($_GET['page']){
    $page=$_GET['page'];
    //当前页大于总页数的话就等于总页数
    if ($page>=$pageTotal){
        $page=$pageTotal;
    }
}else {
    $page=1;
}
//查询sql语句
$sql="select * from member order by id desc limit ".($page-1)*$pagesize.",".$pagesize;
//返回的数据 是一个临时的表  结果集
$result=$pdo->query($sql);
$date=$result->fetchAll(PDO::FETCH_OBJ);
echo "<table border='1' algin='center' width=95% cellpadding=0 cellspacing=0>";
echo "<tr><th>用户名</th><th>邮箱</th><th>注册时间</th><th>操作</th><tr>";
//$value  对象，  代表的是没一条数据
foreach ($date as $key=>$value){
    /* var_dump($value->username); */
    echo "<tr>";
    echo "<td>".$value->username."</td>";
    echo "<td>".$value->email."</td>";
    echo "<td>".$value->regTime."</td>";
    echo "<td>
              <a href='update.php?id=".$value->id."'>修改</a>&nbsp;&nbsp;&nbsp;
              <a href='delet.php?id=".$value->id."'>删除</a>
         </td>";
    echo "</tr>";
}
echo "<tr><td colspan='4'><a href='add.php'>添加数据</a></td></tr>";    
echo "</table>";
echo "<div class='page'>";
echo "<ul>";
echo "<li><a href='?page=".($page-1)."'>上一页</a></li>";
echo "<li><a href='?page=".($page+1)."'>下一页</a></li>";
echo "<li><input type='text' value='".$page."' class='changepage'></li>";
echo "<li><span class='present'>".$page."</span>/".$pageTotal."</li>";
echo "</ul>";
echo "</dic>"
/*//如果数据填写正确 那么现实的是一个对象
 *  echo "<pre>";
var_dump($result);
echo "</pre>"; */

/* //以对象的方式输出
 * echo "<pre>";
var_dump($result->fetchAll(PDO::FETCH_OBJ));
echo "</pre>"; */
?>
<style>
.page{
	border:1ps soild black
}
.page ul{
	text-align:center;
}
.page ul li{
	display:inline-block;
	margin-left:5px;
}
.present{
	color:red;
}
.changepage{
	width:30px;
	text-align:center;
}
</style>
<script>
var changepage=document.querySelect(".changepage");
changepage.addEventListener("keyup",function(){
	location.href="getall.php?page="+this.value;
	
})
</script>


















