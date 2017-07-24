<?php
$title = '时间';
$nav_type = 'time';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<?php
date_default_timezone_set('Asia/Shanghai');

echo
    date('c'), '<br>',
    date('Ymd'), '<br>';

?>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
