<?php
namespace lopedever\money;

include dirname(__DIR__) . '/includes/Common.php';
include dirname(__DIR__) . '/includes/database/Database.php';

if (empty($_POST['new_cate'])) {
    $common->redirectTo('/php/money/category/index.php?c=支出');
    exit;
} else if (preg_match("/-/", $_POST['new_cate'])) {
    $common->redirectTo('/php/money/category/index.php?c=支出');
    exit;
}

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
    } elseif (empty($cate_3)) {
        $cate_3 = $_POST['new_cate'];
        $sql = "INSERT INTO $table ({$t_type}_1, {$t_type}_2, {$t_type}_3) VALUES (?, ?, ?)";
        if ($stmt = $database->mysqli->prepare($sql)) {
            $stmt->bind_param("sss", $cate_1, $cate_2, $cate_3);
        }
    } elseif (empty($cate_4)) {
        $cate_4 = $_POST['new_cate'];
        $sql = "INSERT INTO $table ({$t_type}_1, {$t_type}_2, {$t_type}_3, {$t_type}_4) VALUES (?, ?, ?, ?)";
        if ($stmt = $database->mysqli->prepare($sql)) {
            $stmt->bind_param("ssss", $cate_1, $cate_2, $cate_3, $cate_4);
        }
    } elseif (empty($cate_5)) {
        $cate_5 = $_POST['new_cate'];
        $sql = "INSERT INTO $table ({$t_type}_1, {$t_type}_2, {$t_type}_3, {$t_type}_4, {$t_type}_5) VALUES (?, ?, ?, ?, ?)";
        if ($stmt = $database->mysqli->prepare($sql)) {
            $stmt->bind_param("sssss", $cate_1, $cate_2, $cate_3, $cate_4, $cate_5);
        }
    }

    $stmt->execute();
    $stmt->close();

    $database->mysqli->close();

    $back_url = '/php/money/category/index.php?'.$_SERVER['QUERY_STRING'];
    header("Location: $back_url");
}