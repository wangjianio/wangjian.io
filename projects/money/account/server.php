<?php
namespace wangjian\wangjianio\projects\money;

// echo '<pre>';
// print_r($_POST);
// exit;

require_once dirname(__DIR__) . '/includes/Common.php';
require_once dirname(__DIR__) . '/includes/Database.php';

// 检查 Session
$common = new Common;
$common->checkSession();
$u_id = $_SESSION['u_id'];

$action = $_GET['action'];
$a_type_id = $_GET['a_type_id'];

if (($action === 'edit') && ($a_type_id == 1 || $a_type_id == 2 || $a_type_id == 3)) {

    // ini_set('display_errors', true);
    // error_reporting(E_ALL);
    
    // 连接数据库
    $database = new Database;
    $username = 'money_root';
    $database->connect($username);
    $mysqli = $database->mysqli;


    // 如果有新账户，则处理，否则跳过
    if(isset($_POST['new'])) {
        foreach ($_POST['new'] as $arr_post) {
    
            if (is_numeric($arr_post['money_1'])) {
                $money_1 = $arr_post['money_1'];
            }
    
            if (isset($arr_post['money_2'])) {
                if (is_numeric($arr_post['money_2']) && $a_type_id == 2) {
                    $money_2 = $arr_post['money_2'];
                }
            }
            
            $a_name  = $arr_post['a_name'];
    
            $sql = "INSERT INTO account (u_id, a_name, a_type_id, money_1, money_2) VALUES (?, ?, ?, ?, ?)";
            if ($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param("isidd", $u_id, $a_name, $a_type_id, $money_1, $money_2);
                $stmt->execute();
                $stmt->close();
            }
        }

        // 处理后销毁无用数据
        unset($arr_post);
        unset($_POST['new']);
    }


    // 处理老账户数据
    foreach ($_POST as $arr_post) {
        if (is_numeric($arr_post['a_id'])) {
            $a_id = $arr_post['a_id'];
        }

        if ($arr_post['valid'] == 1 || $arr_post['valid'] == 0) {
            $valid = $arr_post['valid'];
        }

        if (is_numeric($arr_post['money_1'])) {
            $money_1 = $arr_post['money_1'];
        }

        if (isset($arr_post['money_2'])) {
            if (is_numeric($arr_post['money_2']) && $a_type_id == 2) {
                $money_2 = $arr_post['money_2'];
            }
        }
        
        $a_name  = $arr_post['a_name'];

        $sql = "UPDATE account SET a_name = ?, money_1 = ?, money_2 = ?, valid = ? WHERE u_id = ? AND a_id = ? AND a_type_id = ? AND valid = 1";
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("sddiiii", $a_name, $money_1, $money_2, $valid, $u_id, $a_id, $a_type_id);
            $stmt->execute();
            $stmt->close();
        }
    }
    unset($arr_post);

    $mysqli->close();
}

header('location: index');
