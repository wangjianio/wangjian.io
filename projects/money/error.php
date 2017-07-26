<?php
namespace lopedever\money;

if (!isset($_GET['errno'])) {
    header("Location: index.php");
    exit;
}

$title = '遇到错误';
$nav_type = 'money';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

  <div class='container'>
    <div class="page-header">
      <h1>遇到错误</h1>
    </div>
    <div class="jumbotron">
      <h1>
      <?php
      switch ($_GET['errno']) {
          case '1451':
              echo '此类别已被占用，不能删除。';
              break;
        
          default:
              echo '未知错误。';
              break;
      }
      ?>
      </h1>
      <p>...</p>
      <p><a class="btn btn-primary btn-lg" href="javascript:history.back(-1)" role="button">返回</a></p>
    </div><!-- .jumbotron -->
  </div><!-- .container -->

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
