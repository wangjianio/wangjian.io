<?php
namespace lopedever\niu79\bookmark;

include '../includes/config.php';
include '../includes/database.php';
include '../includes/functions.php';
include '../includes/log.php';

$session->checkSession();

/**
 * 从数据库中获取标题的值及是否显示卡片的值，以默认选中。
 */
if (!$query = $mysqli->query("SELECT * FROM rainbow_card WHERE id = 0")) {
    echo "ERROR: (" . $mysqli->errno . ") " . $mysqli->error;
} else {
    $info = mysqli_fetch_array($query);
}

if ($info['is_show']) {
  $checked1 = 'checked';
} else {
  $checked0 = 'checked';
}

?>
<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <title>管理主页</title>
  <link href="css/main.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script>
    function inputCheck(loginForm) {
        if (edit_title.title.value == "") {
            alert("请输入标题!");
            loginForm.title.focus();
            return (false);
        }
    }
</script>
</head>

<body>

  <p>你好啊，哈哈哈～<a href="logout.php">注销</a></p>

  <hr>

  <table>

    <tr>
      <th>文件名称</th>
      <th>文件预览</th>
      <th>操作</th>
    </tr>

<?php $index->showFileName('../bookmark/images'); ?>

    <tr>
      <td id="preview" colspan="2"><a href="../bookmark" target="_blank">查看今日书签</a></td>
      <td><a href="upload.php">新增</a></td>
  </table>

  <hr>

  <form name="edit_tip" method="post" action="edit_tip.php">
    <fieldset>
      <legend>彩虹卡说明设置：</legend>
      <p><label>是否显示：<input name="is_show" type="radio" value="1" <?php echo $checked1; ?>>是 <input name="is_show" type="radio" value="0" <?php echo $checked0; ?>>否</label></p>
      <p><label>提示文字：<br><textarea name="content" rows="5" placeholder="请输入提示文字，回车换行......"><?php echo $info['content']; ?></textarea></label></p>
      <label><input name="submit" type="submit"></label>
    </fieldset>
  </form>

  <hr>

  <form name="edit_title" method="post" action="edit_title.php" onsubmit="return inputCheck(this)">
    <fieldset>
      <legend>设置标题：</legend>
      <p><label>请输入页面标题（必填）：<input name="title" type="text" value="<?php echo $info['title']; ?>"></label></p>
      <label><input name="submit" type="submit"></label>
    </fieldset>
  </form>      

</body>

</html>
