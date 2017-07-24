<?php
$title = '时间';
$nav_type = 'time';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
    <div class="container">
<?php
date_default_timezone_set('Asia/Shanghai');

echo
    date('c'), '<br>',
    date('Ymd'), '<br>';

?>
</div><!-- .container -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
