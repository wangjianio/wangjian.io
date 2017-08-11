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

        $arr['login_result'] = true;
    } else {
        $arr['login_result'] = false;
    }

    echo json_encode($arr);
}

if ($_GET['action'] === 'logout') {
    $session->checkSession();

    $_SESSION = array();
    session_destroy();

    header('location: login');
}


if ($_GET['action'] === 'setting') {
    $session->checkSession();

    $new_show = $_POST['show'];
    $new_title = $_POST['title'];
    $new_tip = $_POST['tip'];

    if ($new_show === 'true' || $new_show === 'false') {
        $string = file_get_contents('../includes/config.php');
    
        $pattern = "/define\('SHOW', .*?\);/";
        $replacement = "define('SHOW', $new_show);";
        $string = preg_replace($pattern, $replacement, $string);
    
        if (file_put_contents('../includes/config.php', $string)) {
            $arr['show_result'] = true;
        } else {
            $arr['show_result'] = false;
        }
    }

    if ($new_title) {
        $string = file_get_contents('../includes/config.php');
    
        $pattern = "/define\('TITLE', '.*?'\);/";
        $replacement = "define('TITLE', '$new_title');";
        $string = preg_replace($pattern, $replacement, $string);
    
        if (file_put_contents('../includes/config.php', $string)) {
            $arr['title_result'] = true;
        } else {
            $arr['title_result'] = false;
        }
    }
    
    if ($new_tip) {
        $string = file_get_contents('../includes/config.php');
    
        $pattern = "/define\('TIP', '(.|\n)*?'\);/";
        $replacement = "define('TIP', '$new_tip');";
        $string = preg_replace($pattern, $replacement, $string);
    
        if (file_put_contents('../includes/config.php', $string)) {
            $arr['tip_result'] = true;
        } else {
            $arr['tip_result'] = false;
        }
    }
    
    echo json_encode($arr);
    
}

if ($_GET['action'] === 'delete') {
    $session->checkSession();

    $file_name = $_GET['file_name'];
    $file = "../images/$file_name";

    if (!$file_name || !file_exists($file) || !unlink($file)) {
        exit('删除失败');
    } else {
        // $arr['delete_result'] = true;
        header('location: index');
    }

    // echo json_encode($arr);
}
