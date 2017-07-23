<?php
include('database.php');
include('functions.php');

checkSession();

$user_id = $_GET['user_id'];
$user_file_id = $_GET['user_file_id'];

if (!$user_id || !$user_file_id) {  
    exit('编号有误！');  
}

if ($mysqli->query("UPDATE user SET file_$user_file_id = '' WHERE id = '$user_id'")) {
    header("location:index.php");
} else {
    echo 'ERROR: (', $mysqli->errno, ')', $mysqli->error;
}
?>