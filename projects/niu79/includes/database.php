<?php
namespace lopedever\niu79\bookmark;

/**
 * Database configuration.
 */
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'niu79');
define('DB_PASSWORD', 'HHyyTHw9jbc4P39t');
define('DB_DATABASE', 'niu79');

/**
 * Connect to the database.
 */
$mysqli = new \mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: $mysqli->connect_error";
} else if (!$mysqli->set_charset("utf8")) {
    echo "Error loading character set utf8: $mysqli->error";
}
