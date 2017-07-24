<?php
namespace lopedever\niu79\bookmark;

include '../includes/config.php';
include '../includes/database.php';
include '../includes/functions.php';
include '../includes/log.php';

/**
 * 如果没有 Get 参数则日期默认为当前日期；
 * 如果有 Get 参数则日期为指定日期，参数有误则无法显示；
 * 恶意参数无效。
 */
if (!isset($_GET['date'])) {
    $date = date('Ymd');
} else {
    $date = $_GET['date'];
}

$img_src = "images/$date.jpg";

/**
 * 通过数据库得到‘彩虹卡说明’的数据，再根据情况显示或隐藏；
 * 有错误则输出错误。
 */
if (!$query = $mysqli->query("SELECT * FROM rainbow_card")) {
    echo "ERROR: (" . $mysqli->errno . ") " . $mysqli->error;
} else {
    $rainbow_card_info = mysqli_fetch_array($query);
}

$is_show = $rainbow_card_info['is_show'];
$content = $rainbow_card_info['content'];
$title   = $rainbow_card_info['title'];
?>
<!DOCTYPE html>
<html>

<head>
  <title><?php echo $title; ?></title>  
  <meta charset="utf-8">
  <link href="css/main.css" rel="stylesheet">
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
if ($is_show == 1) {
?>
    <div class="tip">
      <p class="tip-title">彩虹卡说明：</p>
      <p class="tip-content"><?php echo $content; ?></p>
    </div>
<?php
}
?>

  </div>

</body>

</html>
