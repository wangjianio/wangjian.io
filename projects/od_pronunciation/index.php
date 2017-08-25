<?php
$title = 'Oxford Dictionaries 英语发音';
$nav_type = 'od';

$word_id = $_GET['word_id'];

$extra_css = '<style>.glyphicon-play-circle, .glyphicon-play-circle:hover { text-decoration: none; cursor: pointer; }</style>';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

    <div class="container">
      <div class="page-header">
        <h1><?php echo $title; ?></h1>
      </div>
      <div class="row">
        <div class="col-md-8">
          <div class="input-group input-group-lg" id="input_group">
            <input class="form-control" name="word_id" type="text" placeholder="输入单词" autocomplete="off" value="<?php echo $word_id; ?>">
            <div class="input-group-btn">                
              <button class="btn btn-primary" id="submit_btn" type="button">查询</button>
            </div>
          </div>

          <br>
          
          <div class="alert alert-dismissible" id="alert" role="alert" style="display: none">
            <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
            <p id="alert_text"></p>
          </div>

          <div id="result" style="display: none">
            <h2 id="word"></h2>
            <table class="table">
              <thead>
                <tr>
                  <th>词性</th>
                  <th>音标</th>
                  <th>发音</th>
                </tr>
              </thead>
              <tfoot>
              </tfoot>
              <tbody>
              </tbody>
            </table>
          </div>
        </div><!-- col -->

        <div class="col-md-4">
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">说明：</h3>
            </div>
            <ul class="list-group">
              <li class="list-group-item">基于牛津大学出版社的 <a href="https://developer.oxforddictionaries.com" target="_blank">Oxford Dictionaries API</a> 制作，主要用来快速学习单词发音。</li>
              <li class="list-group-item">目前仅显示英式发音，美式发音会在将来支持。</li>
              <li class="list-group-item">由于 API 速度原因，查询时稍微有点慢，请耐心等待。</li>
            </ul>
            <!-- <div class="panel-footer text-right small">2017年8月24日</div> -->
          </div>
        </div>

      </div><!-- row -->
    </div><!-- container -->

    <script>
      $(function () {
        
        $('#submit_btn').click(function () {
          var word_id = $('input[name="word_id"]').val();
          $.ajax({
            type: 'get',
            url: 'json',
            dataType: 'json',
            data: {
              'word_id': word_id
            },
            beforeSend: function () {
              disableBtn();
              var pattern = /^[a-z -]+$/i;
              if (pattern.test(word_id)) {
                autoFadeInAlert('info', '正在查询，请稍后...');
              } else {
                autoFadeInAlert('danger', '请勿使用除字母 A-Z（不分大小写）、连字符（-）以外的其他字符。');
                setTimeout(function() {
                  enableBtn();
                }, 500);
                return false;
              }
              $('#result').hide();
              $('tbody').empty();
            },
            success: function (response) {
              enableBtn();
              if (response.error) {
                autoFadeInAlert('warning', response.error);
              } else {
                var results = response.results;
                $('#alert').hide();
                // 二级标题，API 自动调整大小写
                $('#word').text(results[0].word);
                
                // 表格内容
                $.each(results[0].lexicalEntries, function(index, value) {
                  var lexicalCategory = value.lexicalCategory;
                  var phoneticSpelling = value.pronunciations[0].phoneticSpelling;
                  var audioFile = value.pronunciations[0].audioFile;
                  $('tbody').append('<tr><td>'+lexicalCategory+'</td><td>'+phoneticSpelling+'</td><td><a class="glyphicon glyphicon-play-circle" onclick="this.firstElementChild.play();"><audio src="'+audioFile+'"></audio></a></td></tr>');
                }); // each
                
                // 全部准备完毕再显示
                $('#result').fadeIn();
              }
            },
            error: function () {
              autoFadeInAlert('warning', 'error');
            }
          }); // ajax
        }); // click

        // 关闭警告框
        $('button.close').on('click', function () {
          $('#alert').fadeOut();
        });

        // 当 input 处于 focus 状态时才监听 enter 键抬起，其他情况不监听
        $('input').on('focus', function () {
          $(this).on('keyup', function (event) {
            // keycode13 为 enter 键，同时 button 需为可用状态
            if (event.keyCode === 13 && btn_valid) {
              // 处罚 button 点击事件
              $('#submit_btn').click();
            }
          });
        });

      });

      // 定义 button 是否可用，在调用 click 函数之前检查
      var btn_valid = true;
      
      // 使 button 失效
      function disableBtn() {
        // 使鼠标点击失效，但不能禁止 click 函数
        $('#submit_btn').attr('disabled', 'disabled');
        // 使 button 状态为不可用，用于 enter 键的 keyup 事件
        btn_valid = false;
      }
      
      // 使 button 可用
      function enableBtn() {
        // 使鼠标点击生效，对 click 函数无影响
        $('#submit_btn').removeAttr('disabled');    
        // 使 button 状态为可用，用于 enter 键到 keyup 事件
        btn_valid = true;
      }

      /** 
       * 自动显示 alert 框，即如果有警告框存在，先隐藏再显示，否则直接显示
       * 
       * @param {alert_type} 警告类型 [success|info|warning|danger]
       * @param {alert_text} 提示文字
       */
      function autoFadeInAlert(alert_type, alert_text) {

        if ($('#alert').css('display') == 'none') {
          $('#alert').attr('class', 'alert alert-' + alert_type + ' alert-dismissible');
          $('#alert_text').text(alert_text);
        // } else if ($('#alert').hasClass('alert-' + alert_type)) {
        } else {
          $('#alert').fadeOut();
          setTimeout(function() {
            $('#alert').attr('class', 'alert alert-' + alert_type + ' alert-dismissible');
            $('#alert_text').text(alert_text);
          }, 500);
        }
        
        $('#alert').fadeIn();
        autoFocusInput(alert_type);
      }
      
      // 根据情况 focus 和更改 input 样式
      function autoFocusInput(alert_type) {
        if (alert_type === 'danger') {
          $('#input_group').attr('class', 'input-group input-group-lg has-error');
          $('input').focus();
        } else if (alert_type  === 'info' || alert_type  === 'warning') {
          $('#input_group').attr('class', 'input-group input-group-lg');
        }
      }
      
    
    </script>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
