<?php
namespace lopedever\money;

include dirname(__DIR__) . '/includes/Common.php';
include dirname(__DIR__) . '/includes/database/Database.php';

$t_type = $_POST['t_type'];
$a_name = $_POST['a_name'];
$t_datetime = $_POST['t_datetime'];
$t_money = $_POST['t_money'];
$category = $_POST['category'];
$t_location = $_POST['t_location'];
$t_agent = $_POST['t_agent'];
$t_remark = $_POST['t_remark'];


$username = 'money_root';
$database->connect($username);

$sql = "INSERT INTO transaction (t_type, a_name, t_datetime, t_money, out_1, t_location, t_agent, t_remark) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
if ($stmt = $database->mysqli->prepare($sql)) {
    $stmt->bind_param("ssssssss", $t_type, $a_name, $t_datetime, $t_money, $category, $t_location, $t_agent, $t_remark);
    $stmt->execute();
    $mysql_errno = $database->mysqli->errno;
    $stmt->close();
}

$database->mysqli->close();

if ($mysql_errno) {
    header("Location: /php/money/error.php?errno=$mysql_errno");
} else {
    header("Location: /php/money/index.php");
}