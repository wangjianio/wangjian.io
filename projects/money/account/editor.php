<?php
namespace wangjian\wangjianio\projects\money;

require_once dirname(__DIR__) . '/includes/EditAccount.php';

// echo '<pre>';
// print_r($_POST);

// exit;

$a_type = $_GET['a_type'];
$description = $_POST['a_type_description'];

$col_name_1 = $account_info->col_name[$a_type];
$col_name_2 = $account_info->col_name['credit_2'];

if ($a_type == 'asset' || $a_type == 'credit' || $a_type == 'debit') {

    /**
    * 修改 account_type 表的 description 列。
    */
    if (isset($description)) {
        $username = 'money_root';
        $database->connect($username);

        $sql = "UPDATE account_type SET description = ? WHERE a_type = ?";

        if ($stmt = $database->mysqli->prepare($sql)) {
                $stmt->bind_param("ss", $description, $a_type);
                $stmt->execute();
                $stmt->close();
        }

        $database->mysqli->close();
    }


    /**
    * 修改 account 表的各账户数据。
    */
    if ($_POST[$a_type]) {

        // 重新排序数组方便遍历
        $arr = $_POST[$a_type];
        foreach ($arr as &$value) {
            $post_info[] = $value;
        }
        unset($value);

        $count = count($post_info);

        $username = 'money_root';
        $database->connect($username);
        
        for ($i = 0; $i < $count; $i++) {

            if (is_int((int)$post_info[$i]['a_id'])) {
                $sql_a_id = $post_info[$i]['a_id'];
            }

            if ($post_info[$i]['delete'] == '1') {
                $sql_valid = '0';
            } else {
                $sql_valid = '1';
            }

            $sql_a_name = $post_info[$i]['a_name'];

            if (is_float((float)$post_info[$i][$col_name_1])) {
                $sql_money_1 = $post_info[$i][$col_name_1];
            }

            if (is_float((float)$post_info[$i][$col_name_2])) {
                $sql_money_2 = $post_info[$i][$col_name_2];
            }

            $sql = "UPDATE account SET a_name = ?, $col_name_1 = ?, $col_name_2 = ?, valid = ? WHERE a_id = ?";

            if ($stmt = $database->mysqli->prepare($sql)) {
                $stmt->bind_param("sddii", $sql_a_name, $sql_money_1, $sql_money_2, $sql_valid, $sql_a_id);
                $stmt->execute();
                $stmt->close();
            }
        }
        $database->mysqli->close();
    }

    /**
    * 新增账户。
    */
    if ($_POST['new']) {

        $count = count($_POST['new']);

        $username = 'money_root';
        $database->connect($username);
        
        for ($i = 0; $i < $count; $i++) {

            if (!$sql_a_name = $_POST['new'][$i]['account_name']) {
                continue;
            }

            if (is_float((float)$_POST['new'][$i]['money_1'])) {
                $sql_money_1 = $_POST['new'][$i]['money_1'];
            }

            if (is_float((float)$_POST['new'][$i]['money_2'])) {
                $sql_money_2 = $_POST['new'][$i]['money_2'];
            }

            $sql = "INSERT INTO account (a_name, a_type, $col_name_1, $col_name_2) VALUES (?, ?, ?, ?)";

            if ($stmt = $database->mysqli->prepare($sql)) {
                $stmt->bind_param("ssdd", $sql_a_name, $a_type, $sql_money_1, $sql_money_2);
                $stmt->execute();
                $stmt->close();
            }
        }
        $database->mysqli->close();
    }

}

header('Location: /projects/money/account/');
