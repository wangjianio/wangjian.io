<?php
namespace wangjian\wangjianio\projects\money;

require_once dirname(__DIR__) . '/includes/Common.php';
require_once dirname(__DIR__) . '/includes/Database.php';

// 确定 t_type_id，或者跳转
$type = $_GET['type'];

switch ($type) {
    case 'out':
    $t_type_id = 1;
    break;
    case 'in':
    $t_type_id = 2;
    break;
    
    default:
    header('location: index');
    break;
}

// 检查 Session
$common = new Common;
$common->checkSession();

$u_id = $_SESSION['u_id'];

// 连接数据库
$database = new Database;
$username = 'money_root';
$database->connect($username);
$mysqli = $database->mysqli;

$sql = "SELECT c_id, c_name, parent_id FROM category WHERE t_type_id = ? AND u_id = ? ORDER BY parent_id";

if ($stmt = $mysqli->prepare($sql)) {

    $stmt->bind_param("ii", $t_type_id, $u_id);
    $stmt->execute();
    $stmt->bind_result($c_id, $c_name, $parent_id);

    while ($stmt->fetch()) {

        $tmp['c_id'] = $c_id;
        $tmp['text'] = $c_name;
        $tmp['parent_id'] = $parent_id;

        $data[] = $tmp;
    }

    // https://www.phpflow.com/php/treeview-using-bootstrap-treeview-php-mysql/
    // Build array of item references:
	foreach($data as $key => &$item) {
        $itemsByReference[$item['c_id']] = &$item;
        // Children array:
        $itemsByReference[$item['c_id']]['nodes'] = array();
        // $itemsByReference[$item['c_id']]['tags'] = ['edit'];
	}

	// Set items as children of the relevant parent item.
	foreach($data as $key => &$item)  {
	//echo "<pre>";print_r($itemsByReference[$item['parent_id']]);die;
        if($item['parent_id'] && isset($itemsByReference[$item['parent_id']])) {
            $itemsByReference [$item['parent_id']]['nodes'][] = &$item;
		}
    }
    
	// Remove items that were added to parents elsewhere:
	foreach($data as $key => &$item) {
        if(empty($item['nodes'])) {
            unset($item['nodes']);
        }
        if($item['parent_id'] && isset($itemsByReference[$item['parent_id']])) {
            unset($data[$key]);
        }
    }
    // echo '<pre>';
    // print_r($data);
	echo json_encode($data);
    // echo '<pre>';

    $stmt->close();
}

$mysqli->close();
