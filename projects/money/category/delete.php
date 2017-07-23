<?php
namespace lopedever\money;

include dirname(__DIR__) . '/includes/Common.php';
include dirname(__DIR__) . '/includes/database/Database.php';

$c = preg_split("/-/", $_GET['c']);

$type = $c[0];
$cate_1 = $c[1];
$cate_2 = $c[2];
$cate_3 = $c[3];
$cate_4 = $c[4];
$cate_5 = $c[5];

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
        $sql = "DELETE FROM $table WHERE {$t_type}_1 = ?";
        if ($stmt = $database->mysqli->prepare($sql)) {
            $stmt->bind_param("s", $cate_1);
        }
    } else if (empty($cate_3)) {
        $sql = "DELETE FROM $table WHERE {$t_type}_1 = ? AND {$t_type}_2 = ?";
        if ($stmt = $database->mysqli->prepare($sql)) {
            $stmt->bind_param("ss", $cate_1, $cate_2);
        }
    } else if (empty($cate_4)) {
        $sql = "DELETE FROM $table WHERE {$t_type}_1 = ? AND {$t_type}_2 = ? AND {$t_type}_3 = ?";
        if ($stmt = $database->mysqli->prepare($sql)) {
            $stmt->bind_param("sss", $cate_1, $cate_2, $cate_3);
        }
    } else if (empty($cate_5)){
        $sql = "DELETE FROM $table WHERE {$t_type}_1 = ? AND {$t_type}_2 = ? AND {$t_type}_3 = ? AND {$t_type}_4 = ?";
        if ($stmt = $database->mysqli->prepare($sql)) {
            $stmt->bind_param("ssss", $cate_1, $cate_2, $cate_3, $cate_4);
        }
    } else {
        $sql = "DELETE FROM $table WHERE {$t_type}_1 = ? AND {$t_type}_2 = ? AND {$t_type}_3 = ? AND {$t_type}_4 = ? AND {$t_type}_5 = ?";
        if ($stmt = $database->mysqli->prepare($sql)) {
            $stmt->bind_param("sssss", $cate_1, $cate_2, $cate_3, $cate_4, $cate_5);
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