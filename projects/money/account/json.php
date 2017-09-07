<?php
namespace wangjian\wangjianio\projects\money;

require_once dirname(__DIR__) . '/includes/Common.php';
require_once dirname(__DIR__) . '/includes/Database.php';

// 检查 Session
$common = new Common;
$common->checkSession();

$u_id = $_SESSION['u_id'];

// 连接数据库
$database = new Database;
$username = 'money_root';
$database->connect($username);
$mysqli = $database->mysqli;

$sql = "SELECT a_id, a_name, a_type_id, money_1, money_2 FROM account WHERE u_id = ? AND valid = 1";

if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param("i", $u_id);
    $stmt->execute();
    $stmt->bind_result($a_id, $a_name, $a_type_id, $money_1, $money_2);
    
    while ($stmt->fetch()) {
        
        $tmp['a_id'] = $a_id;
        $tmp['a_name'] = $a_name;
        $tmp['a_type_id'] = $a_type_id;
        $tmp['money_1'] = $money_1;
        $tmp['money_2'] = $money_2;
        
        $arr[] = $tmp;
    }

    $stmt->close();
}



echo json_encode($arr);

$mysqli->close();
