<?php
include('database.php');

session_start();

if (isset($_SESSION['admin_id'])) {
    header('location:index.php');
    exit();
} else if (!isset($_POST['submit'])) {
    header('location:login.php');
    exit();
}

$username = htmlspecialchars($_POST['username']);
$password = MD5($_POST['password']);

if (!$check = $mysqli->query("SELECT id FROM admin WHERE username='$username' AND password='$password'")) {
    echo 'ERROR: (', $mysqli->errno, ')', $mysqli->error;
}
if ($result = mysqli_fetch_array($check)) {
    $_SESSION['admin_id'] = $result['id'];
    echo $username . ' 欢迎你！3 秒后进入 <a href="index.php">管理中心</a><br>';
    echo '<meta http-equiv="refresh" content="3; url=index.php">'; 
    exit();
} else {
    exit('登录失败！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
}
?>