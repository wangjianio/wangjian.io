<?php
namespace wangjian\wangjianio\projects\money;

require_once dirname(__DIR__) . '/includes/Common.php';
require_once dirname(__DIR__) . '/includes/Database.php';

// 检查 Session
$common = new Common;
$common->checkSession();

$u_id = $_SESSION['u_id'];
$page = $_GET['page'];


if (is_numeric($page) && $page > 0) {
    $page = intval($page);
    $start_row = ($page - 1) * 10;
    $sql_limit = "LIMIT $start_row,20";
}

// 连接数据库
$database = new Database;
$username = 'money_root';
$database->connect($username);
$mysqli = $database->mysqli;

$sql = "SELECT t_id, t_type, a_name, t_datetime, t_money, c_name, t_location, t_agent, t_remark 
        FROM view_transaction 
        WHERE u_id = ? 
        ORDER BY t_datetime DESC 
        $sql_limit";

if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param("i", $u_id);
    $stmt->execute();
    $stmt->bind_result($t_id, $t_type, $a_name, $t_datetime, $t_money, $c_name, $t_location, $t_agent, $t_remark);
    
    while ($stmt->fetch()) {
        
        $tmp['t_id'] = $t_id;
        $tmp['t_type'] = $t_type;
        $tmp['a_name'] = $a_name;
        $tmp['t_datetime'] = $t_datetime;
        $tmp['t_money'] = $t_money;
        $tmp['c_name'] = $c_name;
        $tmp['t_location'] = $t_location;
        $tmp['t_agent'] = $t_agent;
        $tmp['t_remark'] = $t_remark;

        
        $arr[] = $tmp;
    }

    $stmt->close();
}

echo json_encode($arr);

$mysqli->close();
