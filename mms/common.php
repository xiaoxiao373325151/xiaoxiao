<?php
/**
*
*/
//开启seccion
session_start(); 
//错误处理
error_reporting(E_ALL^E_NOTICE^E_STRICT);
//设置默认时区
date_default_timezone_set("PRC");
try {
    $pdo=new PDO("mysql:host=localhost;dbname=web13","root","");
}catch (PDOException $e){
    /*  echo "<pre>";
     var_dump($e);
     echo "</pre>"; */
    echo "链接mysqul服务器错误".$e->getMessage();
};
//设置操作数据库的字符集
$pdo->query("set names utf8");
?>