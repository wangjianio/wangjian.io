<?php
namespace wangjian\wangjianio\projects\niu79\bookmark;

require_once '../includes/config.php';
require_once '../includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/Log.php';

if ($_GET['action'] === 'login') {
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === USERNAME && $password === PASSWORD) {
        
        $_SESSION['username'] = $username;
        
        $log->logPV('/projects/niu79/bookmark/', 'login', null, 'success');
        $log->logPV('/projects/niu79/bookmark/', 'visit', 'index');
$log->logUV('/projects/niu79/bookmark/', 'visit', 'index');
        $arr['login_result'] = true;
    } else {
        $log->logPV('/projects/niu79/bookmark/', 'login', null, 'fail');
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

    $new_display = $_POST['display'];
    $new_title = $_POST['title'];
    $new_tip = $_POST['tip'];

    if ($new_display === 'show' || $new_display === 'hide') {
        
        $string = file_get_contents('../includes/config.php');
        
        $pattern = "/define\('TIP_DISPLAY', '.*?'\);/";
        $replacement = "define('TIP_DISPLAY', '$new_display');";
        $string = preg_replace($pattern, $replacement, $string);
        
        if (file_put_contents('../includes/config.php', $string)) {
            $log->logPV('/projects/niu79/bookmark/', 'setting', 'display', 'success');
            $arr['display_result'] = true;
        } else {
            $log->logPV('/projects/niu79/bookmark/', 'setting', 'display', 'fail');
            $arr['display_result'] = false;
        }
    }
    
    if ($new_title) {
        
        $string = file_get_contents('../includes/config.php');
        
        $pattern = "/define\('TITLE', '.*?'\);/";
        $replacement = "define('TITLE', '$new_title');";
        $string = preg_replace($pattern, $replacement, $string);
        
        if (file_put_contents('../includes/config.php', $string)) {
            $log->logPV('/projects/niu79/bookmark/', 'setting', 'title', 'success');
            $arr['title_result'] = true;
        } else {
            $log->logPV('/projects/niu79/bookmark/', 'setting', 'title', 'fail');
            $arr['title_result'] = false;
        }
    }
    
    if ($new_tip) {
        $string = file_get_contents('../includes/config.php');
        
        $pattern = "/define\('TIP_CONTENT', '(.|\n)*?'\);/";
        $replacement = "define('TIP_CONTENT', '$new_tip');";
        $string = preg_replace($pattern, $replacement, $string);
        
        if (file_put_contents('../includes/config.php', $string)) {
            $log->logPV('/projects/niu79/bookmark/', 'setting', 'tip', 'success');
            $arr['tip_result'] = true;
        } else {
            $log->logPV('/projects/niu79/bookmark/', 'setting', 'tip', 'fail');
            $arr['tip_result'] = false;
        }
    }
    
    echo json_encode($arr);
    
}

if ($_GET['action'] === 'delete') {
    $session->checkSession();
    
    $file_name = $_GET['file_name'];
    $file = "../images/$file_name";
    
    if ($file_name && file_exists($file) && unlink($file)) {
        $log->logPV('/projects/niu79/bookmark/', 'delete', $file_name, 'success');
        header('location: index');
    } else {
        $log->logPV('/projects/niu79/bookmark/', 'delete', $file_name, 'fail');
        exit('删除失败');
    }
}
