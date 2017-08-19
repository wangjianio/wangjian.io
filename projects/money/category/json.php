<?php
namespace wangjian\wangjianio\projects\money;

require_once dirname(__DIR__) . '/includes/Database.php';

$database = new Database;

$type = $_GET['type'];
if ($type !== 'out' && $type !== 'in') { exit; }

$username = 'money_root';
$database->connect($username);

$mysqli = $database->mysqli;

$sql = "SELECT id, category, parent_id FROM category_new WHERE type = '$type'";

if ($stmt = $mysqli->prepare($sql)) {

    $stmt->execute();
    $stmt->bind_result($id, $category, $parent_id);

    while ($stmt->fetch()) {

        $tmp['id'] = $id;
        $tmp['text'] = $category;
        $tmp['parent_id'] = $parent_id;

        $data[] = $tmp;
    }

    // https://www.phpflow.com/php/treeview-using-bootstrap-treeview-php-mysql/
    // Build array of item references:
	foreach($data as $key => &$item) {
        $itemsByReference[$item['id']] = &$item;
        // Children array:
        $itemsByReference[$item['id']]['nodes'] = array();
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

	// Encode:
	echo json_encode($data);

    $stmt->close();
}

$mysqli->close();

