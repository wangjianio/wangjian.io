<?php
namespace wangjian\wangjianio\projects\money;

require_once dirname(__DIR__) . '/includes/Common.php';
require_once dirname(__DIR__) . '/includes/Database.php';

$new_cate_name = $_POST['new_cate'];

$c = preg_split("/-/", $_GET['c']);

$type = $c[0];
$cate_1 = $c[1];
$cate_2 = $c[2];
$cate_3 = $c[3];

if (!isset($_GET['c'])) {
    $common->redirectTo('/php/money/category/index.php?c=支出');
} elseif ($type != '支出' && $type != '收入') {
    $common->redirectTo('/php/money/category/index.php?c=支出');
} else {

    switch ($type) {
        case '收入':
            $t_type = 'in';
            break;
        case '支出':
            $t_type = 'out';
            break;

        default:
            exit;
            break;
    }

    $table = "category_$t_type";

    $username = 'money_root';
    $database->connect($username);

    if (empty($cate_1)) {
        $common->redirectTo('/php/money/category/index.php?c=支出');
    } else if (empty($cate_2)) {
        $sql = "UPDATE $table SET {$t_type}_1 = ? WHERE {$t_type}_1 = ?";
        if ($stmt = $database->mysqli->prepare($sql)) {
            $stmt->bind_param("ss", $new_cate_name, $cate_1);
        }
    } else if (empty($cate_3)) {
        $sql = "UPDATE $table SET {$t_type}_2 = ? WHERE {$t_type}_1 = ? AND {$t_type}_2 = ?";
        if ($stmt = $database->mysqli->prepare($sql)) {
            $stmt->bind_param("sss", $new_cate_name, $cate_1, $cate_2);
        }
    } else {
        $sql = "UPDATE $table SET {$t_type}_3 = ? WHERE {$t_type}_1 = ? AND {$t_type}_2 = ? AND {$t_type}_3 = ?";
        if ($stmt = $database->mysqli->prepare($sql)) {
            $stmt->bind_param("ssss", $new_cate_name, $cate_1, $cate_2, $cate_3);
        }
    }


    $stmt->execute();
    $mysql_errno = $database->mysqli->errno;
    $stmt->close();

    $database->mysqli->close();

    if ($mysql_errno) {
        header("Location: /php/money/error.php?errno=$mysql_errno");
    } else {
        $back_url = '/php/money/category/index.php?'.$_SERVER['QUERY_STRING'];
        $back_url = preg_replace("/-[^-]+$/", '', $back_url);
        header("Location: $back_url");
    }

}