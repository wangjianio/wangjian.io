<?php
namespace wangjian\wangjianio\projects\money;

require_once dirname(__DIR__) . '/includes/Database.php';

if (!isset($_GET)) exit;
if (!isset($_POST)) exit;

$action = $_GET['action'];
$id = $_POST['id'];
$type = $_POST['type'];
$new_old_cate = $_POST['new_old_cate'];
$new_root_cate = $_POST['new_root_cate'];
$new_child_cate = $_POST['new_child_cate'];
$parent_id = $_POST['parent_id'];

$database = new Database;
$username = 'money_root';
$database->connect($username);
$mysqli = $database->mysqli;


if ($action === 'delete') {

    if (is_numeric($id)) {
        
        $sql = "DELETE FROM category WHERE id = ?";
        
        if ($stmt = $mysqli->prepare($sql)) {
            
            $stmt->bind_param("i", $id);
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


if ($action === 'add') {
    if ($type === 'out' || $type === 'in') {
        if (is_numeric($parent_id)) {
    
            $sql = "INSERT INTO category (type, category, parent_id) VALUES (?, ?, ?)";
            
            if ($stmt = $mysqli->prepare($sql)) {
                
                $stmt->bind_param("ssi", $type, $new_root_cate, $parent_id);
                $stmt->execute();
                $stmt->close();
            }
            
            if (!$mysqli->errno) {
                $arr['result'] = 'success';
            } else {
                $arr['result'] = $mysqli->error;
            }
        } else {
            $arr['result'] = 'parent id 有误';
        }
    } else {
        $arr['result'] = 'type 有误';
    }

    echo json_encode($arr);
}

if ($action === 'edit') {
    if ($type === 'out' || $type === 'in') {
        if (is_numeric($id)) {
            if(!empty($new_old_cate)) {
                $sql = "UPDATE category SET category = ? WHERE id = ?";
                
                if ($stmt = $mysqli->prepare($sql)) {
                    $stmt->bind_param("si", $new_old_cate, $id);
                    $stmt->execute();
                    
                    if (!$mysqli->errno) {
                        $flag = true;
                    } else {
                        $flag = false;                    
                    }
                }

                if (!empty($new_child_cate)) {
                    $sql = "INSERT INTO category (type, category, parent_id) VALUES (?, ?, ?)";
                    
                    if ($stmt = $mysqli->prepare($sql)) {
                        $stmt->bind_param("ssi", $type, $new_child_cate, $id);
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
