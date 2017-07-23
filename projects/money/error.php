<?php
namespace lopedever\money;

if (!isset($_GET['errno'])) {
    header("Location: index.php");
    exit;
}

?>
<!DOCTYPE html>
<html>

<head>
  <title>错误</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="styles/index.css">
  <style>
    p {
      text-align: center;
      margin: 16px 0 8px 0;
    }

    .error-tip {
      margin-top: 80px;
      padding: 8px;
      border: 1px solid gray;
    }
  </style>
</head>

<body>

<?php include __DIR__ . '/includes/header.php';?>

  <div class='content'>

    <div class="error-tip">
      <?php
      switch ($_GET['errno']) {
        case '1451':
          echo '<p>此类别已被占用，不能删除。</p>';
          break;
        
        default:
          echo '<p>未知错误。</p>';
          break;
      }
      ?>
      <p><a href="javascript:history.back(-1)">返回</a></p>
    </div>
  </div>
</body>

</html>
