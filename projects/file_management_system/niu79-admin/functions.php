<?php
function checkSession() {
    session_start();
    if (!isset($_SESSION['admin_id'])) {
        header("location:login.php");
        exit();
    }
}
?>