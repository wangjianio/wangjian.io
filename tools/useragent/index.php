<?php
$title = 'User Agent';
$nav_type = 'ua';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

    <div class="container">
      <div class="page-header">
        <h1>当前浏览器设定的 User Agent</h1>
      </div>
      <p><?php echo $_SERVER['HTTP_USER_AGENT']; ?></p>
    </div><!-- .container -->

    <!-- /*echo '<br />';
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
    }*/-->

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
