<?php
// ini_set('display_errors', true);
// error_reporting(E_ALL);

require_once('database.php');
$database = new Database;
$database->connect();
$mysqli = $database->mysqli;

$sql = "SELECT pattern, replacement FROM rule";

if ($stmt = $mysqli->prepare($sql)) {
    $stmt->execute();
    $stmt->bind_result($pattern, $replacement);

    while ($stmt->fetch()) {
        $tmp[0] = $pattern;
        $tmp[1] = $replacement;
        $arr[] = $tmp;        
    }

    $stmt->close();    
}

echo json_encode($arr);

$mysqli->close();
