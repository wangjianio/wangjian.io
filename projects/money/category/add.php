<?php
namespace wangjian\wangjianio\projects\money;

require_once dirname(__DIR__) . '/includes/Common.php';
require_once dirname(__DIR__) . '/includes/Database.php';

if (empty($_POST['new_cate'])) {
    $common->redirectTo('/projects/money/category/index?c=支出');
    exit;
} else if (preg_match("/-/", $_POST['new_cate'])) {
    $common->redirectTo('/projects/money/category/index?c=支出');
    exit;
}

$c = preg_split("/-/", $_GET['c']);

$type = $c[0];
$cate_1 = $c[1];
$cate_2 = $c[2];
$cate_3 = $c[3];


if (!isset($_GET['c'])) {
    $common->redirectTo('/projects/money/category/index?c=支出');
} elseif ($type != '支出' && $type != '收入') {
    $common->redirectTo('/projects/money/category/index?c=支出');
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
        $cate_1 = $_POST['new_cate'];
        $sql = "INSERT INTO $table ({$t_type}_1) VALUES (?)";
        if ($stmt = $database->mysqli->prepare($sql)) {
            $stmt->bind_param("s", $cate_1);
        }
    } elseif (empty($cate_2)) {
        $cate_2 = $_POST['new_cate'];
        $sql = "INSERT INTO $table ({$t_type}_1, {$t_type}_2) VALUES (?, ?)";
        if ($stmt = $database->mysqli->prepare($sql)) {
            $stmt->bind_param("ss", $cate_1, $cate_2);
        }
    } else {
        $cate_3 = $_POST['new_cate'];
        $sql = "INSERT INTO $table ({$t_type}_1, {$t_type}_2, {$t_type}_3) VALUES (?, ?, ?)";
        if ($stmt = $database->mysqli->prepare($sql)) {
            $stmt->bind_param("sss", $cate_1, $cate_2, $cate_3);
        }
    }

    $stmt->execute();
    $stmt->close();

    $database->mysqli->close();

    $back_url = '/projects/money/category/index?'.$_SERVER['QUERY_STRING'];
    header("Location: $back_url");
}