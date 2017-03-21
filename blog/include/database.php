<?php
$ini = parse_ini_file("blog.ini");

$mysqli = new mysqli($ini[HOSTNAME], $ini[USERNAME], $ini[PASSWORD], $ini[DATABASE]);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: $mysqli->connect_error";
} else if (!$mysqli->set_charset("utf8")) {
    echo "Error loading character set utf8: $mysqli->error";
}

date_default_timezone_set('Asia/Shanghai');
?>