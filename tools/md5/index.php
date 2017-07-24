<?php
$title = 'MD5';
$nav_type = 'md5';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<?php
$md5 = md5(Admin);
echo $md5;
?>


<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
