<?php
namespace wangjian\wangjianio\projects\niu79\bookmark;

include '../includes/config.php';
include '../includes/functions.php';
include '../includes/log.php';

$session->checkSession();


if (SHOW) {
  $active1 = 'active';
  $checked1 = 'checked';
  $collapse = 'in';
} else {
  $active0 = 'active';
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
    <style>
      body {
        padding-top: 70px;
      }

      #logout {
        cursor: pointer;
      }

      .flex-baseline {
        display: flex;
        align-items: baseline;
      }

      .flex-center {
        display: flex;
        align-items: center;
      }

      .flex-none {
        flex: none;
      }

      .flex-1 {
        flex: 1;
      }

    </style>
  </head>

  <body>
    <header>
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <a class="navbar-brand" href>管理界面</a>
          <a class="navbar-brand navbar-right pull-right" id="logout">注销</a>
        </div>
      </nav>
    </header>

    <div class="container">
      <div class="row">
        <div class="col-md-8">

          <h2>书签管理</h2>
          <hr>
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
            <h2>设置</h2>
          </div>

          <div class="form-group flex-baseline">
            <label class="control-label" for="title">页面标题：</label>
            <input class="form-control flex-1" id="title" name="title" type="text" placeholder="必填" autocomplete="off" value="<?php echo TITLE; ?>">
          </div>

          <div class="form-group flex-center">
            <label class="control-label" for="tip" style="margin: 0">提示文字：</label>
            <div class="flex-1">

              <div class="btn-group btn-group-justified" data-toggle="buttons">
                <label class="btn btn-default <?php echo $active1; ?>">
                  <input name="show" type="radio" value="true" autocomplete="off" <?php echo $checked1; ?>> 显示
                </label>
                <label class="btn btn-default <?php echo $active0; ?>">
                  <input name="show" type="radio" value="false" autocomplete="off" <?php echo $checked0; ?>> 隐藏
                </label>
              </div>

            </div>
          </div>

          <div class="form-group collapse <?php echo $collapse; ?>">
            <label class="control-label sr-only">提示文字：</label>
            <textarea class="form-control" id="tip" name="tip" rows="3" placeholder="请输入提示文字，回车换行..."><?php echo TIP; ?></textarea>
          </div>

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

    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <!-- js 动态显示内容 -->
          </div>
        </div>
      </div>
    </div>
  </body>
  <script>
    $(document).ready(function () {

      $('input[name=show]').change(function () {
        var show = $(this).val();

        $.ajax({
          type: "post",
          url: "server?action=setting",
          dataType: "json",
          data: { "show": show },
          success: function (json) {
            if (json.show_result) {
              if (show == 'true') {
                $('.collapse').collapse('show')
              } else {
                $('.collapse').collapse('hide')
              }
              $('.modal').modal('show');
              $('.modal-body').text('修改成功');
              setTimeout("$('.modal').modal('hide')", 1000);
            } else {
              $('.modal').modal('show');
              $('.modal-body').text('修改失败');
            }
          },
          error: function (XMLHttpRequest, textStatus, errorThrown) {
            // alert(XMLHttpRequest.status);
            // alert(XMLHttpRequest.readyState);
            // alert(textStatus);
            $('.modal').modal('show');
            $('.modal-body').text('ERROR');
          }
        });
      });


      var old_title = $('input[name=title]').val();
      $('input[name=title]').blur(function () {
        var title = $(this).val();

        if (title !== old_title) {
          $.ajax({
            type: "post",
            url: "server?action=setting",
            dataType: "json",
            data: { "title": title },
            success: function (json) {
              if (json.title_result) {
                old_title = title;
                $('.modal').modal('show');
                $('.modal-body').text('修改成功');
                setTimeout("$('.modal').modal('hide')", 1000);
              } else {
                $('.modal').modal('show');
                $('.modal-body').text('修改失败');
              }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
              // alert(XMLHttpRequest.status);
              // alert(XMLHttpRequest.readyState);
              // alert(textStatus);
              $('.modal').modal('show');
              $('.modal-body').text('ERROR');
            }
          });
        }
      });


      var old_tip = $('textarea').val();
      $('textarea').blur(function () {
        var tip = $(this).val();

        if (tip !== old_tip) {
          $.ajax({
            type: "post",
            url: "server?action=setting",
            dataType: "json",
            data: { "tip": tip },
            success: function (json) {
              if (json.tip_result) {
                old_tip = tip;
                $('.modal').modal('show');
                $('.modal-body').text('修改成功');
                setTimeout("$('.modal').modal('hide')", 1000);
              } else {
                $('.modal').modal('show');
                $('.modal-body').text('修改失败');
              }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
              // alert(XMLHttpRequest.status);
              // alert(XMLHttpRequest.readyState);
              // alert(textStatus);
              $('.modal').modal('show');
              $('.modal-body').text('ERROR');
            }
          });
        }
      });


      $('#logout').click(function () {
        $('.modal').modal('show');
        $('.modal-body').text('注销成功');
        setTimeout('window.location.href = "server?action=logout"', 1000);
      });


    });
  </script>

</html>
