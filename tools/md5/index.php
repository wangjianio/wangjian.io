<?php
$title = 'MD5';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php-includes/header.php';
?>

<?php
$md5 = md5(Admin);
echo $md5;
?>


<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/php-includes/footer.php';
