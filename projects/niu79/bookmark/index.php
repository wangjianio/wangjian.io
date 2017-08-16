<?php
namespace wangjian\wangjianio\projects\niu79\bookmark;

require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/Log.php';


$log->logUV('/projects/niu79/bookmark/', 'visit', 'index');
$log->logPV('/projects/niu79/bookmark/', 'visit', 'index');

/**
 * 如果没有 Get 参数则日期默认为当前日期；
 * 如果有 Get 参数则日期为指定日期，参数有误则无法显示；
 * 恶意参数无效。
 */
if (!$_GET) {
    $date = date('Ymd');
} elseif (count($_GET) != 1) {
    exit;
} else {
    $date = key($_GET);
}

$img_src = "images/$date.jpg";
?>
<!DOCTYPE html>
<html lang="zh-CN">

  <head>
    <title><?php echo TITLE; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

    <style>
      p {
        white-space: pre;
        line-height: 1.5;
      }

      .tip {
        max-width: 640px;
      }
    </style>
  </head>

  <body>
    <div class="container">
      <img class="img-responsive center-block" alt="bookmark" src="<?php echo $img_src; ?>">
<?php
if (TIP_DISPLAY === 'show') {
?>
      <div class="center-block tip">
        <p class="text-muted">彩虹卡说明：</p>
        <p class="text-muted"><?php echo TIP_CONTENT; ?></p>
      </div>
<?php
}
?>
    </div>

  </body>

</html>
