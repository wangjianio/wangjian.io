<?php
$title = '关于';
$nav_type = 'about';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';

echo <<<H1
  <div class="container">
    <div class="page-header">
      <h1>$title</h1>
    </div>
  </div><!-- .container -->
H1;

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';

