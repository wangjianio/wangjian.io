<?php
include('database.php');
include('functions.php');

checkSession();

if (!$_POST['name'] || !$_POST['gender'] || !$_POST['tel'] || !$_POST['id_number']) {
    exit(缺少信息！);
}

$name = $_POST['name'];
$gender = $_POST['gender'];
$tel = $_POST['tel'];
$id_number = $_POST['id_number'];

if ($mysqli->query("INSERT INTO user (name, gender, tel, id_number) VALUES ('$name', '$gender', '$tel', '$id_number')")) {
    header("location:index.php");
} else {
    echo "ERROR: (" . $mysqli->errno . ") " . $mysqli->error;
}
?>