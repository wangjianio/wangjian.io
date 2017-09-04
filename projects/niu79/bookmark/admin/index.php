<?php
namespace wangjian\wangjianio\projects\niu79\bookmark;

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/Log.php';
include '../includes/config.php';
include '../includes/functions.php';

$session->checkSession();

$log->logPV('/projects/niu79/bookmark/', 'visit', 'admin');
$log->logUV('/projects/niu79/bookmark/', 'visit', 'admin');

if (TIP_DISPLAY === 'show') {
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
    <title>管理界面</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <style>
      body {
        padding-top: 70px;
      }

      #logout, #upload {
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

      li {
        overflow-wrap: break-word;
      }

      .action {
        width: 4em;
        text-align: right;
        font-weight: normal;
      }

      .glyphicon-eye-close, .glyphicon-eye-open {
        position: absolute;
        top: 9px;
        right: 25px;
      }
      
      .glyphicon-eye-close:hover, .glyphicon-eye-open:hover {
        text-decoration: none;
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

          <table class="table table-condensed">
            <thead>
              <tr>
                <th>文件名称</th>
                <th class="action" colspan="2"><a href="../" target="_blank">查看今日书签</a></th>
              </tr>
            </thead>
            <tbody>
              <?php $index->showFileName('../images'); ?>
            </tbody>
          </table>

           <!-- Collapse -->
          <!-- <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    未使用
                  </a>
                </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                  。
                </div>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>文件名称</th>
                          <th class="action">操作</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <td colspan="2"><a href="../" target="_blank">查看今日书签</a></td>
                        </tr>
                      </tfoot>
                      <tbody>
                        <?php $index->showFileName('../images'); ?>
                      </tbody>
                    </table>
              </div>
            </div>

            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false"
                    aria-controls="collapseTwo">
                    已过期
                  </a>
                </h4>
              </div>
              <div class="panel-collapse collapse" id="collapseTwo" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute,
                  non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                  sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                  helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher
                  vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably
                  haven't heard of them accusamus labore sustainable VHS.
                </div>
              </div>
            </div>

          </div> -->


          <form name="upload_form" method="post" enctype="multipart/form-data">            
            <input name="MAX_FILE_SIZE" type="hidden" value="2000000">

            <div class="form-group">
              <label for="file_input">上传新文件</label>
              <div class="input-group">
                <div class="form-control" tabindex="-1">
                  <div id="file_prompt">未选择文件</div>
                </div>
                <span class="input-group-btn">
                  <button class="btn btn-default hidden" id="btn_reset" type="button"><span class="glyphicon glyphicon-trash"></span> 清除</button>
                  <button class="btn btn-default hidden" id="btn_submit" type="button"><span class="glyphicon glyphicon-upload"></span> 上传</button>
                  <button class="btn btn-primary" id="btn_choose" type="button"><span class="glyphicon glyphicon-folder-open"></span> 选择</button>
                </span>
              </div>
              <input class="hidden" id="file_input" name="file[]" type="file" multiple accept="image/jpeg,image/png">
              <p class="help-block">支持多选，请将单个文件大小限制在 2M 以内（支持 jpg/jpeg/png 格式）</p>
            </div>
          </form>

          <div class="alert alert-success hidden" role="alert"></div>          
          <div class="alert alert-danger hidden" role="alert"></div>          
          <div class="alert alert-info hidden" role="alert"></div>      

          <div class="page-header">
            <h2>简单统计</h2>
          </div>
          <table class="table table-condensed">
            <thead>
              <tr>
                <th>日期</th>
                <th class="text-right">PV</th>
                <th class="text-right">UV</th>
              </tr>
            </thead>
            <tbody>
              <?php $index->printStatisticTableBody(); ?>
            </tbody>
          </table>


          <div class="page-header">
            <h2>设置</h2>
          </div>

          <div class="row form-inline">
            <div class="form-group col-sm-6">
              <div class="flex-baseline">
                <label for="username">用户名：</label>
                <input class="form-control flex-1" id="username" name="username" type="text" placeholder="必填" autocomplete="off" value="<?php echo USERNAME; ?>">
              </div>
            </div>

            <div class="form-group col-sm-6">
              <div class="flex-baseline">
                <label for="password">密码：</label>
                <input class="form-control  flex-1" id="password" name="password" type="password" placeholder="必填" autocomplete="off" value="<?php echo PASSWORD; ?>">
                <a class="glyphicon glyphicon-eye-open text-muted" onselectstart="return false" role="button" data-placement="top" data-toggle="popover" data-trigger="hover"></a>
              </div>
            </div>
          </div>


          <hr>

          <div class="form-group flex-baseline">
            <label class="control-label" for="title">页面标题：</label>
            <input class="form-control flex-1" id="title" name="title" type="text" placeholder="必填" autocomplete="off" value="<?php echo TITLE; ?>">
          </div>

          <div class="form-group flex-center">
            <label class="control-label" for="tip" style="margin: 0">提示文字：</label>
            <div class="flex-1">

              <div class="btn-group btn-group-justified" data-toggle="buttons">
                <label class="btn btn-default <?php echo $active1; ?>">
                  <input name="display" type="radio" value="show" autocomplete="off" <?php echo $checked1; ?>> 显示
                </label>
                <label class="btn btn-default <?php echo $active0; ?>">
                  <input name="display" type="radio" value="hide" autocomplete="off" <?php echo $checked0; ?>> 隐藏
                </label>
              </div>

            </div>
          </div>

          <div class="form-group collapse <?php echo $collapse; ?>">
            <label class="control-label sr-only">提示文字：</label>
            <textarea class="form-control" id="tip" name="tip" rows="3" placeholder="请输入提示文字，回车换行..."><?php echo TIP_CONTENT; ?></textarea>
          </div>

        </div>

        <div class="col-md-4">

          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">最近消息：</h3>
            </div>
            <ul class="list-group">
              <li class="list-group-item">现在可以更改用户名和密码了，还是建议修改一下的。</li>
              <li class="list-group-item">可能会有 bug，不过只有 IE 没有测试过，遇到问题就用 Chrome、Firefox 或者国产浏览器的极速模式吧。</li>
            </ul>
            <div class="panel-footer text-right small">2017年8月16日</div>
            <ul class="list-group text-muted">
              <li class="list-group-item">您好，原来的网站速度太慢，现在已经搬到新服务器上了，仅保留了8月10号一天的图片。</li>
              <li class="list-group-item">新的后台网址为 https://wangjian.io/projects/niu79/bookmark/admin/ 请保存记好。</li>
              <li class="list-group-item">新的书签网址为 https://wangjian.io/projects/niu79/bookmark/ 请尽快到微信后台更改。</li>
              <li class="list-group-item">对给您带来的不便表示歉意。如有疑问可联系微信 17604700916。</li>
            </ul>
            <div class="panel-footer text-right small">2017年8月10日</div>
          </div>

          <?php if ($_SERVER['REMOTE_ADDR'] === '::1') {
            echo '<a class="btn btn-primary btn-block" href="https://wangjian.io/projects/niu79/bookmark/admin/" target="_blank">线上版</a>';
          } ?>

        </div>

      </div>
    </div>

    <div class="modal fade bs-example-modal-sm" id="prompt_modal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-body" id="prompt_text">
            <!-- js 动态显示内容 -->
          </div>
        </div>
      </div>
    </div>
  </body>

  <script>
    $(document).ready(function () {

      // Username
      var old_username = $('input[name=username]').val();
      $('input[name=username]').blur(function () {
        var username = $(this).val();

        if (username !== old_username) {
          $.ajax({
            type: "post",
            url: "server?action=setting",
            dataType: "json",
            data: { "username": username },
            success: function (json) {
              if (json.username_result) {
                old_username = username;
                $('#prompt_modal').modal('show');
                $('#prompt_text').text('修改成功');
                setTimeout('window.location.reload()', 1000);                                
              } else {
                $('#prompt_modal').modal('show');
                $('#prompt_text').text('修改失败');
              }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
              // alert(XMLHttpRequest.status);
              // alert(XMLHttpRequest.readyState);
              // alert(textStatus);
              $('#prompt_modal').modal('show');
              $('#prompt_text').text('ERROR');
            }
          });
        }
      });

      // Password
      var old_password = $('input[name=password]').val();
      $('input[name=password]').blur(function () {
        var password = $(this).val();

        if (password !== old_password) {
          $.ajax({
            type: "post",
            url: "server?action=setting",
            dataType: "json",
            data: { "password": password },
            beforeSend: function () {
            },
            success: function (json) {
              if (json.password_result) {
                old_password = password;
                $('#prompt_modal').modal('show');
                $('#prompt_text').text('修改成功');
                setTimeout('window.location.reload()', 1000);                
              } else {
                $('#prompt_modal').modal('show');
                $('#prompt_text').text('修改失败');
              }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
              // alert(XMLHttpRequest.status);
              // alert(XMLHttpRequest.readyState);
              // alert(textStatus);
              $('#prompt_modal').modal('show');
              $('#prompt_text').text('ERROR');
            }
          });
        }
      });

      // Tip display
      $('input[name=display]').change(function () {
        var display = $(this).val();

        $.ajax({
          type: "post",
          url: "server?action=setting",
          dataType: "json",
          data: { "display": display },
          success: function (json) {
            if (json.display_result) {
              if (display == 'show') {
                $('.collapse').collapse('show')
              } else {
                $('.collapse').collapse('hide')
              }
              $('#prompt_modal').modal('show');
              $('#prompt_text').text('修改成功');
              setTimeout("$('.modal').modal('hide')", 1000);
            } else {
              $('.modal').modal('show');
              $('#prompt_text').text('修改失败');
            }
          },
          error: function (XMLHttpRequest, textStatus, errorThrown) {
            // alert(XMLHttpRequest.status);
            // alert(XMLHttpRequest.readyState);
            // alert(textStatus);
            $('#prompt_modal').modal('show');
            $('#prompt_text').text('ERROR');
          }
        });
      });

      // Title
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
                $('#prompt_modal').modal('show');
                $('#prompt_text').text('修改成功');
                setTimeout("$('#prompt_modal').modal('hide')", 1000);
              } else {
                $('#prompt_modal').modal('show');
                $('#prompt_text').text('修改失败');
              }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
              // alert(XMLHttpRequest.status);
              // alert(XMLHttpRequest.readyState);
              // alert(textStatus);
              $('#prompt_modal').modal('show');
              $('#prompt_text').text('ERROR');
            }
          });
        }
      });

      // Tip content
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
                $('#prompt_modal').modal('show');
                $('#prompt_text').text('修改成功');
                setTimeout("$('#prompt_modal').modal('hide')", 1000);
              } else {
                $('#prompt_modal').modal('show');
                $('#prompt_text').text('修改失败');
              }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
              // alert(XMLHttpRequest.status);
              // alert(XMLHttpRequest.readyState);
              // alert(textStatus);
              $('#prompt_modal').modal('show');
              $('#prompt_text').text('ERROR');
            }
          });
        }
      });

      // Logout
      $('#logout').click(function () {
        $('#prompt_modal').modal('show');
        $('#prompt_text').text('注销成功');
        setTimeout('window.location.href = "server?action=logout"', 1000);
      });
      
      // 弹出选择框
      $('#btn_choose').click(function () {
        $('#file_input').click();
      });

      // 选择文件后
      $('#file_input').change(function () {
        var file_num = $(this).get(0).files.length;
        var first_file_name = $(this).get(0).files[0].name;
      
        // 显示额外按钮
        $('#btn_reset').removeClass('hidden');
        $('#btn_submit').removeClass('hidden');
        
        // 隐藏所有 alert
        $('.alert').addClass('hidden');
        
        // 使 sumbit 按钮可用
        $('#btn_submit').removeAttr('disabled');        

        // 更改提示文字
        if (file_num === 1) {
          $('#file_prompt').text(first_file_name);
        } else {
          $('#file_prompt').text('已选择 ' + file_num + ' 个文件');
        }

        // 根据情况禁用 submit
        if (!checkFileSize()) {
          $('#btn_submit').attr('disabled', 'disabled');
        }
      });

      // Reset
      $('#btn_reset').click(function () {
        $('form[name=upload_form]')[0].reset();
        $('#file_prompt').text('未选择文件');

        $('#btn_reset').addClass('hidden');
        $('#btn_submit').addClass('hidden');
        $('.alert').addClass('hidden');
      });

      // Submit
      $('#btn_submit').click(function () {
        var form_data = new FormData(document.forms.namedItem('upload_form'));
        $.ajax({
          url: "server?action=upload",
          type: "POST",
          data: form_data,
          dataType: "json",          
          processData: false,
          contentType: false,
          beforeSend: function () {
            var i = checkFileSize();
            if (i) {
              $("form[name='upload_form']").find('.btn').attr('disabled', 'disabled');          
              showAlert('info', '正在上传...');
            } else {
              return i;
            }
          },
          success: function (json) {
            if (json.result) {
              showAlert('success', '所有文件上传成功');
              setTimeout('window.location.reload()', 1000);
            } else {
              showAlert('danger', json.error);
            }
          },
          error: function (XMLHttpRequest, textStatus, errorThrown) {
            // alert(XMLHttpRequest.status);
            // alert(XMLHttpRequest.readyState);
            // alert(textStatus);
            showAlert('danger', 'error');
          }
        });
      });

    });
    
    function showAlert(type, msg) {
      $('.alert').addClass('hidden');
      $('.alert-' + type).html(msg);
      $('.alert-' + type).removeClass('hidden');
    }

    function checkFileSize() {
      var i = true;
      $.each($('#file_input').get(0).files, function (index, item) {
        if (item.size > 2097152) {
          i = false;
          showAlert('danger', '文件过大，请将单个文件大小限制在 2M 以内。');      
        }
      });
      return i;
    }

    $(function () {
      $('[data-toggle="popover"]').popover()
    })

    $('[data-toggle="popover"]').hover(function () {
      var str = $('input[type="password"]').val();
      $(this).attr('data-content', str);
    }, function () {
      
    });
  </script>

</html>
