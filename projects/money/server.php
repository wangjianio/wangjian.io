<?php
namespace wangjian\wangjianio\projects\money;

require_once __DIR__ . '/includes/Database.php';
$database = new Database;

$username = 'money_root';
$database->connect($username);
$mysqli = $database->mysqli;

// Login
if ($_GET['action'] === 'login') {
    session_start();
    
    $post_username = $_POST['username'];
    $post_password = md5($_POST['password']);
    
    $sql = "SELECT u_id, password FROM user WHERE username = ?";
    
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("s", $post_username);
        $stmt->execute();
        $stmt->bind_result($u_id, $select_password);
        $stmt->fetch();
    
        if ($post_password === $select_password) {
            
            $_SESSION['u_id'] = $u_id;
            
            $arr['results'] = 'success';
        } else {
            $arr['results'] = 'fail';
        }
        $stmt->close();
    }

    echo json_encode($arr);
}

// Logout
if ($_GET['action'] === 'logout') {
    // 初始化会话。
    // 如果要使用会话，别忘了现在就调用：
    session_start();
    
    // 重置会话中的所有变量
    $_SESSION = array();
    
    // 如果要清理的更彻底，那么同时删除会话 cookie
    // 注意：这样不但销毁了会话中的数据，还同时销毁了会话本身
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    // 最后，销毁会话
    session_destroy();

    // 跳转到登录界面
    header('location: login');
}

$mysqli->close();
