<?php
$title = '主页';
$nav_type = 'index';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
    <div class="jumbotron">
      <div class="container" style="max-width: 970px">
        <h1>主页</h1>
        <p>This example is a quick exercise to illustrate how the default, static and fixed to top navbar work. It includes
          the responsive CSS and HTML, so it also adapts to your viewport and device.</p>
        <p>To see the difference between static and fixed top navbars, just scroll.</p>
        <p>
          <a class="btn btn-lg btn-primary" href="/" role="button">View navbar docs &raquo;</a>
        </p>
      </div>
    </div>
    

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
