<?php
namespace wangjian\wangjianio\projects\niu79\bookmark;

require_once '../includes/config.php';
require_once '../includes/functions.php';
require_once '../includes/log.php';



if ($_GET['action'] === 'login') {
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === USERNAME && $password === PASSWORD) {
        $_SESSION['username'] = $username;

        $arr['success'] = true;
        echo json_encode($arr);
    } else {
        $arr['success'] = false;
        echo json_encode($arr);
    }

}
