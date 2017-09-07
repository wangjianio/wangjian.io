<?php
namespace wangjian\wangjianio\projects\money;

require_once dirname(__DIR__) . '/includes/Common.php';
require_once dirname(__DIR__) . '/includes/Database.php';

if (!isset($_GET)) exit;
if (!isset($_POST)) exit;

// 检查 Session
$common = new Common;
$common->checkSession();
$u_id = $_SESSION['u_id'];

$action = $_GET['action'];

$c_id           = $_POST['c_id'];
$t_type_id      = $_POST['t_type_id'];
$new_old_cate   = $_POST['new_old_cate'];
$new_root_cate  = $_POST['new_root_cate'];
$new_child_cate = $_POST['new_child_cate'];

$database = new Database;
$username = 'money_root';
$database->connect($username);
$mysqli = $database->mysqli;

// Delete
if ($action === 'delete') {

    if (is_numeric($c_id)) {
        
        $sql = "DELETE FROM category WHERE u_id = ? AND (c_id = ? OR parent_id = ?)";
        
        if ($stmt = $mysqli->prepare($sql)) {
            
            $stmt->bind_param("iii", $u_id, $c_id, $c_id);
            $stmt->execute();
            $stmt->close();
        }
        
        if (!$mysqli->errno) {
            $arr['result'] = 'success';
        } else {
            $arr['result'] = $mysqli->error;
        }

    } else {
        $arr['result'] = 'id 不是整数';
    }

    echo json_encode($arr);

}


// Add root
if ($action === 'add') {
    if ($t_type_id == 1 || $t_type_id == 2) {

        $sql = "INSERT INTO category (u_id, t_type_id, c_name, parent_id) VALUES (?, ?, ?, 0)";
        
        if ($stmt = $mysqli->prepare($sql)) {
            
            $stmt->bind_param("iis", $u_id, $t_type_id, $new_root_cate);
            $stmt->execute();
            $stmt->close();
        }
        
        if (!$mysqli->errno) {
            $arr['result'] = 'success';
        } else {
            $arr['result'] = $mysqli->error;
        }
    } else {
        $arr['result'] = 'type 有误';
    }

    echo json_encode($arr);
}



if ($action === 'edit') {
    if ($t_type_id == 1 || $t_type_id == 2) {
        if (is_numeric($c_id)) {
            if(!empty($new_old_cate)) {
                $sql = "UPDATE category SET c_name = ? WHERE u_id = ? AND c_id = ?";
                
                if ($stmt = $mysqli->prepare($sql)) {
                    $stmt->bind_param("sii", $new_old_cate, $u_id, $c_id);
                    $stmt->execute();
                    
                    if (!$mysqli->errno) {
                        $flag = true;
                    } else {
                        $flag = false;                    
                    }
                }

                if (!empty($new_child_cate)) {
                    $sql = "INSERT INTO category (u_id, t_type_id, c_name, parent_id) VALUES (?, ?, ?, ?)";
                    
                    if ($stmt = $mysqli->prepare($sql)) {
                        $stmt->bind_param("iisi", $u_id, $t_type_id, $new_child_cate, $c_id);
                        $stmt->execute();
                        
                        if (!$mysqli->errno) {
                            $flag = true;                    
                        } else {
                            $flag = false;                    
                        }
                    }
                }
                
                $stmt->close();
                
                if ($flag) {
                    $arr['result'] = 'success';                
                } else {
                    $arr['result'] = $mysqli->error;
                }
            
            } else {
                $arr['result'] = '类别名为空';
            }
        } else {
            $arr['result'] = 'id 有误';
        }
    } else {
        $arr['result'] = 'type 有误';
    }

    echo json_encode($arr);
}


$mysqli->close();
