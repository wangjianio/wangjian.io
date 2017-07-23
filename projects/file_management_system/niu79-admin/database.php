<?php
include('config.php');

$mysqli = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: $mysqli->connect_error";
} else if (!$mysqli->set_charset("utf8")) {
    echo "Error loading character set utf8: $mysqli->error";
}
?>