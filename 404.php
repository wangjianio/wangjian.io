<?php
$title = '您访问的页面不存在';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

  <div class="container">
    <div class="page-header">
      <h1>404</h1>
    </div>
    <div class="jumbotron">
      <h1>您访问的页面不存在</h1>
      <p>...</p>
      <p><a class="btn btn-primary btn-lg" href="/index" role="button">返回主页</a></p>
    </div><!-- .jumbotron -->
  </div><!-- .container -->

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
