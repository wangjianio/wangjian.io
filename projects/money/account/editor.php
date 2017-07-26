<?php
namespace lopedever\money;

include dirname(__DIR__) . '/includes/account/EditAccount.php';

$a_type = $_GET['a_type'];

switch ($a_type) {
    case 'asset':
        $col_name = 'asset_balance';
        break;
    case 'credit':
        $col_name = 'credit_debt';
        $col_name_2 = 'credit_limit';
        break;
    case 'debit':
        $col_name = 'debit_balance';
        break;

    default:
        exit('Error.account.editor.' . __LINE__);
        break;
}

/**
 * 修改 account_type 表的 description 列。
 */
$username = 'money_table_account_type';
$database->connect($username);
$description = $_POST['a_type_description'];

$sql = "UPDATE account_type SET description = ? WHERE a_type = ?";

if ($stmt = $database->mysqli->prepare($sql)) {

        $stmt->bind_param("ss", $description, $a_type);

        $stmt->execute();
        $stmt->close();
}

$database->mysqli->close();

/**
 * 修改 account 表的各账户数据。
 */
$arr = $_POST[$a_type];

foreach ($arr as &$value) {
    $post_info[] = $value;
}
unset($value);

$count = count($post_info);
$username = 'money_table_account_update';
$database->connect($username);

for ($i = 0; $i < $count; $i++) {

    if (is_int((int)$post_info[$i]['a_id'])) {
        $sql_a_id = $post_info[$i]['a_id'];
    }

    $sql_a_name = $post_info[$i]['a_name'];

    if (is_float((float)$post_info[$i][$col_name])) {
        $sql_col_name = $post_info[$i][$col_name];
    }

    if ($a_type == 'credit') {
        if (is_float((float)$post_info[$i][$col_name_2])) {
            $sql_col_name_2 = $post_info[$i][$col_name_2];
        }
        $sql = "UPDATE account SET a_name = ?, $col_name = ?, $col_name_2 = ? WHERE a_id = ?";
    } else {
        $sql = "UPDATE account SET a_name = ?, $col_name = ? WHERE a_id = ?";
    }

    if ($stmt = $database->mysqli->prepare($sql)) {

        if ($a_type == 'credit') {
            $stmt->bind_param("sddi", $sql_a_name, $sql_col_name, $sql_col_name_2, $sql_a_id);
        } else {
            $stmt->bind_param("sdi", $sql_a_name, $sql_col_name, $sql_a_id);
        }

        $stmt->execute();
        $stmt->close();
    }

}

$database->mysqli->close();

header('Location: /projects/money/account/');
