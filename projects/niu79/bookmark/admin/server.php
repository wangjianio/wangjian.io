<?php
namespace wangjian\wangjianio\projects\niu79\bookmark;

require_once '../includes/config.php';
require_once '../includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/Log.php';


// Login
if ($_GET['action'] === 'login') {
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === USERNAME && $password === PASSWORD) {
        
        $_SESSION['username'] = $username;
        
        $log->logPV('/projects/niu79/bookmark/', 'login', null, 'success');
        $log->logUV('/projects/niu79/bookmark/', 'visit', 'index');
        $log->logPV('/projects/niu79/bookmark/', 'visit', 'index');
        $arr['login_result'] = true;
    } else {
        $log->logPV('/projects/niu79/bookmark/', 'login', null, 'fail');
        $arr['login_result'] = false;
    }

    echo json_encode($arr);
}


// Logout
if ($_GET['action'] === 'logout') {
    $session->checkSession();

    $_SESSION = array();
    session_destroy();

    header('location: login');
}


// Setting
if ($_GET['action'] === 'setting') {
    $session->checkSession();

    $new_username = $_POST['username'];
    $new_password = $_POST['password'];

    $new_display = $_POST['display'];
    $new_title = $_POST['title'];
    $new_tip = $_POST['tip'];


    // Username
    if ($new_username) {
        
        $string = file_get_contents('../includes/config.php');
        
        $pattern = "/define\('USERNAME', '.*?'\);/";
        $replacement = "define('USERNAME', '$new_username');";
        $string = preg_replace($pattern, $replacement, $string);
        
        if (file_put_contents('../includes/config.php', $string)) {
            $log->logPV('/projects/niu79/bookmark/', 'setting', 'username', 'success');
            $arr['username_result'] = true;
        } else {
            $log->logPV('/projects/niu79/bookmark/', 'setting', 'username', 'fail');
            $arr['username_result'] = false;
        }
    }

    // Password
    if ($new_password) {
        
        $string = file_get_contents('../includes/config.php');
        
        $pattern = "/define\('PASSWORD', '.*?'\);/";
        $replacement = "define('PASSWORD', '$new_password');";
        $string = preg_replace($pattern, $replacement, $string);
        
        if (file_put_contents('../includes/config.php', $string)) {
            $log->logPV('/projects/niu79/bookmark/', 'setting', 'password', 'success');
            $arr['password_result'] = true;
        } else {
            $log->logPV('/projects/niu79/bookmark/', 'setting', 'password', 'fail');
            $arr['password_result'] = false;
        }
    }

    // Display
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
    
    // Title
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
    
    // Tip
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


// Delete
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


// Upload
if ($_GET['action'] === 'upload') {
    $session->checkSession();

    $upload_dir = "../images/";
    $is_all_ok = -1;

    if (!is_dir($upload_dir)) {
        if (!mkdir($upload_dir, 0777, true)) {
            echo '文件夹创建失败';
        }
    }

    if (empty($_FILES)) { 
        $arr['error'] = '<p>未知错误，请重试。</p>';
        $arr['result'] = false;
        echo json_encode($arr); 
        exit;
    }

    foreach ($_FILES["file"]["error"] as $key => $error) {
        
        $file_name = $_FILES["file"]["name"][$key];
        $tmp_file = $_FILES["file"]["tmp_name"][$key];
        $upload_file = $upload_dir . $file_name;
        
        if ($error == UPLOAD_ERR_OK) {
            $mime_content_type = mime_content_type($tmp_file);
            if ($mime_content_type == 'image/jpeg' || $mime_content_type == 'image/png') {
                if (move_uploaded_file($tmp_file, $upload_file)) {
                    $is_all_ok++;
                    $log->logPV('/projects/niu79/bookmark/', 'upload', $file_name, 'success');
                } else {
                    $arr['error'][$key] = "<p>{$_FILES['file']['error']['0']}</p>";
                    $log->logPV('/projects/niu79/bookmark/', 'upload', $_FILES['file']['error']['0'], 'fail');
                }
            } else {
                $arr['error'][$key] = "<p>$file_name 上传失败：文件类型有误，仅支持 jpg/jpeg/png 格式的图片。如扩展名没问题，请使用相关软件重新导出再试。</p>";
                $log->logPV('/projects/niu79/bookmark/', 'upload', $mime_content_type, 'fail');
            }
        } elseif ($error = 2) {
            $arr['error'][$key] = "<p>$file_name 上传失败：文件太大，请上传小于 2M 的文件。</p>";
            $log->logPV('/projects/niu79/bookmark/', 'upload', '文件过大', 'fail');
        } else {
            $arr['error'][$key] = "<p>$file_name 上传失败，错误代码：$error 。</p>";
            $log->logPV('/projects/niu79/bookmark/', 'upload', "错误代码：$error", 'fail');
        }
    }

    // echo $key;
    // echo $is_all_ok;

    if ($is_all_ok == $key) {
        $arr['result'] = true;
        echo json_encode($arr);
    } else {
        $arr['result'] = false;
        echo json_encode($arr);
    }
    
}
