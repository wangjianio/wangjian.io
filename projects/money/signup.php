<?php
namespace wangjian\wangjianio\projects\money;

require_once __DIR__ . '/includes/Common.php';
$common = new Common;

session_start();

$title = 'Money - 登录';
$nav_type = 'money';
$subnav_type = 'login';

$extra_css = '<style>body { background: url("images/notebook-2637726_1920.jpg") center fixed; background-size: cover; } footer, .panel { background-color: rgba(255, 255, 255, 0.8); }</style>';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
    <div class="container">
      <div class="row">
        <div class="col-sm-5 col-md-7">
        </div>
        <div class="col-sm-7 col-md-5" style="margin-top: 48px">
          <div class="panel panel-default">
            <div class="panel-body">

              <div class="page-header">
                <h1>新用户注册</h1>
              </div>

              <div class="form-group">
                <input class="form-control input-lg" id="email" type="text" placeholder="请输入邮箱" autocomplete="off">
                <input class="form-control input-lg" id="phone" type="text" placeholder="请输入手机号" autocomplete="off" style="display: none">
              </div>

              <div class="form-group">
                <input class="form-control input-lg" id="password" type="password" placeholder="请设置密码" autocomplete="off">
              </div>
              <div class="form-group">
                <input class="form-control input-lg" id="password-repeat" type="password" placeholder="再输入一次密码" autocomplete="off">
              </div>

              <button class="btn btn-success btn-block btn-lg" id="btn-signup" type="button">注册</button>
              
              <hr>

              <div class="alert" id="alert" role="alert" style="display: none">
                <p id="alert-text"></p>
              </div>

              <div class="pull-left" onselectstart="return false">
                <span id="signup-with-phone" style="display: none"><a style="cursor: pointer">使用手机号注册</a></span>
                <span id="signup-with-email" style="display: none"><a style="cursor: pointer">使用邮箱注册</a></span>
              </div>
              <div class="pull-right">
                <span><a href="login">登录</a></span>
              </div>

            </div><!-- panel-body -->
          </div><!-- panel -->
        </div><!-- col -->
      </div><!-- row -->
    </div><!-- container -->

    <script>
      $(function () {

        $(document).keypress(function (e) {
          if (e.which == 13) {
            $('#btn-login').click();
          }
        });

        $('#signup-with-phone').on('click', function () {
            $('#email').hide();
            $('#phone').show();
            $(this).hide();
            $(this).siblings().show();
        });

        $('#signup-with-email').on('click', function () {
            $('#phone').hide();
            $('#email').show();
            $(this).hide();
            $(this).siblings().show();
        });

        $('#btn-login').on('click', function () {

          var username = $('#username').val();
          var password = $('#password').val();

          if (!username) {
            $('#password').parent().removeClass('has-error');
            $('#username').parent().addClass('has-error');
            $('#username').focus();
          } else if (!password) {
            $('#password').parent().addClass('has-error');
            $('#password').focus();
          } else {

            $.ajax({
              type: "post",
              url: "server?action=login",
              dataType: "json",
              data: { "username": username, "password": password },
              beforeSend: function () {
                autoShowAlert('info', '正在登录，请稍后...');
              },
              success: function (json) {
                if (json.results == 'success') {
                  autoShowAlert('success', '登录成功！');
                  
                  setTimeout(function() {
                    window.location.href = 'index';
                  }, 500);
                } else {
                  autoShowAlert('danger', '用户名或密码错误，请重试。');
                }
              },
              error: function (XMLHttpRequest, textStatus, errorThrown) {
                // alert(XMLHttpRequest.status);
                // alert(XMLHttpRequest.readyState);
                // alert(textStatus);
                autoShowAlert('danger', 'error');
              }
            }); // ajax
          } // else

        }); // click
        

        /** 监听输入框，内容改变时恢复正常样式 */
        $('input').on('input propertychange', function () {
          var username = $('#username').val();
          var password = $('#password').val();

          if (username) {
            $('#username').parent().removeClass('has-error');
          }

          if (password) {
            $('#password').parent().removeClass('has-error');
          }
        }); // input


      }); // ready


      /** 
       * 自动显示 alert 框
       * 
       * @param {alert_type} 警告类型 [success|info|warning|danger]
       * @param {alert_text} 提示文字
       */
      function autoShowAlert(alert_type, alert_text) {

        $('#alert').attr('class', 'alert alert-' + alert_type);
        $('#alert-text').text(alert_text);
        
        $('#alert').show();
      }

    </script>

<?php if (!empty($_SESSION['u_id'])) { ?>
    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            您已登陆，即将跳转到主页。
          </div>
        </div>
      </div>
    </div>

    <script>
      $(function () {
        $('#modal').modal('show');
        setTimeout(function() {
          window.location.href = 'index';
        }, 2000);
      });

      $('#modal').on('hidden.bs.modal', function () {
        window.location.href = 'index';
      });
    </script>
<?php } ?>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
