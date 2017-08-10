<?php
namespace wangjian\wangjianio\projects\niu79\bookmark;

require_once '../includes/config.php';
require_once '../includes/functions.php';
require_once '../includes/log.php';

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
<html>

<head>
  <title><?php echo TITLE; ?></title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../styles/user.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
  <div class="content">

    <div class="card">
      <img src="<?php echo $img_src; ?>">
    </div>

<?php
/**
 * 显示内容。
 */
if (SHOW) {
?>
    <div class="tip">
      <p class="tip-title">彩虹卡说明：</p>
      <p class="tip-content"><?php echo TIP; ?></p>
    </div>
<?php
}
?>

  </div>

</body>

</html>
