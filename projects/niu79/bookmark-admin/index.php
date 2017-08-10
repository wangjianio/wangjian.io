<?php
namespace wangjian\wangjianio\projects\niu79\bookmark;

include '../includes/config.php';
include '../includes/functions.php';
include '../includes/log.php';

$session->checkSession();


if (SHOW) {
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
  <link rel="stylesheet" href="../styles/admin.css">
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

  <p><font color="red">您好，原来的网站速度太慢，现在已经搬到新服务器上了，仅保留了 8 月 10 号一天的图片</font></p>
  <p><font color="red">新的后台网址为 <font color="green">http://wangjian.io/projects/niu79/bookmark-admin/</font> 请保存记好</font></p>
  <p><font color="red">新的书签网址为 <font color="green">http://wangjian.io/projects/niu79/bookmark/</font> 请尽快到微信后台更改</font></p>
  <p>对给您带来的不便表示歉意。如有疑问可联系微信 17604700916</p>

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
      <p><label>是否显示：<input name="show" type="radio" value="true" <?php echo $checked1; ?>>是 <input name="show" type="radio" value="false" <?php echo $checked0; ?>>否</label></p>
      <p><label>提示文字：<br><textarea name="tip" rows="5" placeholder="请输入提示文字，回车换行......"><?php echo TIP; ?></textarea></label></p>
      <input name="submit" type="submit">
    </fieldset>
  </form>

  <hr>

  <form name="edit_title" method="post" action="edit_title.php" onsubmit="return inputCheck(this)">
    <fieldset>
      <legend>设置标题：</legend>
      <p><label>请输入页面标题（必填）：<input name="title" type="text" value="<?php echo TITLE; ?>"></label></p>
      <label><input name="submit" type="submit"></label>
    </fieldset>
  </form>      

</body>

</html>
