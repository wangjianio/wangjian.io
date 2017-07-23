<?php
include('database.php');
include('functions.php');

checkSession();

$user_id = $_GET['id'];

// Warning: 有编号也不一定对
if (!$user_id) {
    exit('编号有误！');
}

if ($mysqli->query("DELETE FROM user WHERE id = '$user_id'")) {
    header("location:index.php");
} else {
    echo "ERROR: (" . $mysqli->errno . ") " . $mysqli->error;
}
?>