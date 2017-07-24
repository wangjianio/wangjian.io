<?php
namespace lopedever\niu79\bookmark;

include '../includes/config.php';
include '../includes/database.php';
include '../includes/functions.php';
include '../includes/log.php';

/**
 * 检查是否用 Post 方式得到正确的参数，否则结束脚本并给出错误信息。
 */
if (!$_POST['title']) {
    exit(请输入标题！);
}

$title = $_POST['title'];

/**
 * 更新数据库信息。
 */
if (!$query = $mysqli->query("UPDATE rainbow_card SET title = '$title' WHERE id = 0")) {
    echo "ERROR: (" . $mysqli->errno . ") " . $mysqli->error;
} else {
    echo '设置成功！3 秒后 <a href="index.php">返回</a><br>';
    echo '<meta http-equiv="refresh" content="3; url=index.php">'; 
}
