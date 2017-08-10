<?php
namespace wangjian\wangjianio\projects\niu79\bookmark;

include '../includes/config.php';
include '../includes/functions.php';
include '../includes/log.php';

$session->checkSession();

$_SESSION = array();
session_destroy();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>注销</title>
    <link rel="stylesheet" href="../styles/admin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <p>注销成功！点击此处 <a href="login.html">登录</a></p>
</body>

</html>
