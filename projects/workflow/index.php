<?php
header("location: 12306");
$title = 'Workflow';
$nav_type = 'workflow';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<!-- <div class="container" style="background: linear-gradient(to bottom right, #885AFF 0%, #1749E5 100%);"> -->
    <div class="container">
      <div class="page-header">
        <h1><?php echo $title; ?></h1>
      </div>


    </div><!-- container -->

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
