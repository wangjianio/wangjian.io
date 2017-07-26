<?php
$title = '各种格式的时间';
$nav_type = 'time';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
  <div class="container">
    <div class="page-header">
      <h1><?php echo $title; ?></h1>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-8">
        <div class="panel panel-default">
          <div class="panel-body">
            <time><?php echo date('c'); ?></time><br>
            <time><?php echo date('Ymd'); ?></time>
          </div>
        </div>
      </div><!-- .col -->
    </div><!-- .row -->
  </div><!-- .container -->

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
