<?php
namespace wangjian\wangjianio\projects\niu79\bookmark;

include '../includes/config.php';
include '../includes/functions.php';
include '../includes/log.php';

session_start();

if (isset($_SESSION['session'])) {
    header('location:index.php');
    exit();
} else if (!isset($_POST['submit'])) {
    header('location:login.html');
    exit();
}

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

if ($username === USERNAME & $password === PASSWORD) {
    $_SESSION['username'] = $username;
    //$log->logLogin();
    echo '登录成功！3 秒后进入 <a href="index.php">管理中心</a><br>';
    echo '<meta http-equiv="refresh" content="3; url=index.php">'; 
    exit();
} else {
    exit('登录失败！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
}
