<?php
$title = 'OLD';
$nav_type = 'old';

$word_id = $_GET['word_id'];

$extra_css = '<style>.glyphicon-play-circle, .glyphicon-play-circle:hover { text-decoration: none; cursor: pointer; }</style>';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

    <div class="container">
      <div class="page-header">
        <h1>OLD</h1>
      </div>
      <div class="row">
        <div class="col-md-8">
          <div class="input-group input-group-lg">
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
                enableBtn();
                autoFadeInAlert('danger', '请勿使用除字母 A-Z（不分大小写）、连字符（-）以外的其他字符。');
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

        $('button.close').on('click', function () {
          $('#alert').fadeOut();
        });

        $('input').on('focus', function () {
          $(this).on('keyup', function (event) {
            if (event.keyCode === 13) {
              $('#submit_btn').click();
            }
          });
        });

      });

      function disableBtn() {
        $('#submit_btn').attr('disabled', 'disabled');
      }

      function enableBtn() {
        $('#submit_btn').removeAttr('disabled');        
      }

      function autoFadeInAlert(alert_type, alert_text) {
        if ($('#alert').css('display') == 'none') {
          $('#alert').attr('class', 'alert alert-' + alert_type + ' alert-dismissible');
          $('#alert_text').text(alert_text);
        } else {
          $('#alert').fadeOut();
          setTimeout(function() {
            $('#alert').attr('class', 'alert alert-' + alert_type + ' alert-dismissible');
            $('#alert_text').text(alert_text);
          }, 500);
        }
        $('#alert').fadeIn();
      }
      
    
    </script>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
