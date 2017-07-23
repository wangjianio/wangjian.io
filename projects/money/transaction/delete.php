<?php
namespace lopedever\money;

include dirname(__DIR__) . '/includes/Common.php';
include dirname(__DIR__) . '/includes/database/Database.php';

if (!isset($_GET['id'])) {
    $common->redirectTo('/php/money/transaction/index.php');
    exit;
} else if (!is_numeric($_GET['id'])) {
    $common->redirectTo('/php/money/transaction/index.php');
    exit;
} else {
    $t_id = $_GET['id'];
}

$username = 'money_root';
$database->connect($username);

$sql = "DELETE FROM transaction WHERE t_id = ?";
if ($stmt = $database->mysqli->prepare($sql)) {
    $stmt->bind_param("i", $t_id);
    $stmt->execute();
    $stmt->close();
}

$database->mysqli->close();

header("Location: index.php");
