<?php
include('functions.php');

checkSession();
$_SESSION = array();
session_destroy();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>注销</title>
    <link href="css/main.css" rel="stylesheet">
</head>

<body>
    <p>注销成功！点击此处 <a href="login.php">登录</a></p>
    <?php include('footer.php');?>
</body>

</html>