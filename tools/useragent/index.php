<?php
$title = 'User Agent';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php-includes/header.php';
?>


<?php
    echo $_SERVER['HTTP_USER_AGENT'];
    /*echo '<br />';
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE) {
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE) {
            if (strpos($_SERVER['HTTP_USER_AGENT'], 'Edge') !== FALSE) {
                echo '正在使用Edge。';
            } else {
                echo '正在使用Chrome。';
            } 
        } else {
            echo '正在使用Safari。';
        }
    } else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE) {
        echo '正在使用Firefox。';
    } else if ((strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE)) {
        echo '正在使用Internet Explorer。';
    }*/
?>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/php-includes/footer.php';
