<?php
$title = '您访问的页面不存在';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';

echo <<<H1
    <div class="page-header hidden-xs" style="opacity: 0">
      <h1>404</h1>
    </div>
    <div class="jumbotron">
      <h1>$title</h1>
      <p>...</p>
      <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
    </div>
H1;

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
