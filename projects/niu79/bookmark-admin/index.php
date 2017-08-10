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
<html lang="zh-CN">

  <head>
    <meta charset="utf-8">
    <title>管理主页</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
      function inputCheck(loginForm) {
        if (edit_title.title.value == "") {
          alert("请输入标题!");
          loginForm.title.focus();
          return (false);
        }
      }
    </script>
    <style>
      body {
        padding-top: 70px;
      }

    </style>
  </head>

  <body>
    <header>
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <a class="navbar-brand" href>管理界面</a>
          <a class="navbar-brand navbar-right pull-right" href="logout">注销</a>
        </div>
      </nav>
    </header>

    <div class="container">
      <div class="row">
        <div class="col-md-8">

            <h2>书签管理</h2><hr>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>文件名称</th>
                <th>文件预览</th>
                <th>操作</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <td id="preview" colspan="2"><a href="../bookmark" target="_blank">查看今日书签</a></td>
                <td><a href="upload.php">新增</a></td>
              </tr>
            </tfoot>
            <?php $index->showFileName('../bookmark/images'); ?>
          </table>


          <div class="page-header">
            <h2>彩虹卡说明设置</h2>
          </div>
          <form name="edit_tip" method="post" action="edit_tip.php">
            <div class="form-group">
              <label>是否显示：</label>
              <label class="radio-inline">
                <input name="show" type="radio" value="true" <?php echo $checked1; ?>>是
              </label>
              <label class="radio-inline">
                <input name="show" type="radio" value="false" <?php echo $checked0; ?>>否
              </label>
            </div>
            <div class="form-group">
              <label for="tip">提示文字：</label>
              <textarea class="form-control" id="tip" name="tip" rows="3" placeholder="请输入提示文字，回车换行..."><?php echo TIP; ?></textarea>
            </div>
            <button class="btn btn-default" type="submit">保存</button>
          </form>


          <div class="page-header">
            <h2>标题设置</h2>
          </div>
          <form class="form-inline" name="edit_title" method="post" action="edit_title.php" onsubmit="return inputCheck(this)">
            <div class="form-group">
              <label for="title">请输入页面标题（必填）：</label>
              <input class="form-control" id="title" name="title" type="text" value="<?php echo TITLE; ?>">
            </div>
            <button class="btn btn-default" type="submit">保存</button>
          </form>


        </div>
        <div class="col-md-4">

          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">最近消息：</h3>
            </div>
            <ul class="list-group">
              <li class="list-group-item">您好，原来的网站速度太慢，现在已经搬到新服务器上了，仅保留了8月10号一天的图片。</li>
              <li class="list-group-item">新的后台网址为 https://wangjian.io/projects/niu79/bookmark-admin/ 请保存记好。</li>
              <li class="list-group-item list-group-item-danger">新的书签网址为 https://wangjian.io/projects/niu79/bookmark/ 请尽快到微信后台更改。</li>
              <li class="list-group-item">对给您带来的不便表示歉意。如有疑问可联系微信 17604700916。</li>
            </ul>
            <div class="panel-footer text-right">2017年8月10日</div>
          </div>

        </div>

      </div>
    </div>

  </body>

</html>
