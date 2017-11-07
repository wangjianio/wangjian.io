<!doctype html>
<html lang="zh-CN">

<head>
  <title>POI 管家 - v1.1</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="/node_modules/bootstrap-v4/dist/css/bootstrap.min.css">
  <style>
    body {
      font-family: Helvetica;
    }

    .card {
      min-height: 480px;
      margin: 0 16px;
      margin-top: 40px;
    }

    .content {
      margin: 0 auto;
      min-width: 60%;
      padding-bottom: 64px;
    }

    #table-rule td, #table-rule th {
      padding-left: 8px;
    }

    h1 {
      margin: 64px 0;
    }

    .desc {
      margin: 64px 0 32px 0;
    }

    .btn {
      cursor: pointer;
      margin: 4px 0;
    }

    @media (max-width: 575px) {
      .card {
        border: none;
        margin-top: 0;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col card">
        <div class="content">
          <h1 class="text-center">
            <img class="align-top" src="logo.png" height="48px" style="margin-right: 16px">POI 管家
          </h1>
          <div class="row">
            <div class="col-sm">
              <button class="btn btn-primary btn-block" id="btn-import" type="button">选择表格</button>
              <button class="btn btn-block btn-primary" id="btn-restart" style="display: none">继续优化</button>
            </div>
            <div class="col-sm">
              <button class="btn btn-block btn-primary" id="btn-run" type="button">开始优化</button>
              <a class="btn btn-block btn-success" id="btn-download" download style="display: none">优化完成，点击下载</a>
            </div>
            <div class="col-sm">
              <a class="btn btn-primary btn-block" href="template.csv" download>下载模板</a>
            </div>
          </div>
          <p class="desc">
            <b>使用说明：</b>选择表格后点击「开始优化」，稍等片刻即可下载处理后的文件。
            <br>
            <b>字段说明：</b>每行依次为：关键词，POI1，POI2，POI3 ...
            <br>
            <b>格式说明：</b>使用 Excel 另存为 <code>CSV UTF-8 (逗号分隔)</code> 格式。
          </p>
          <table class="table table-sm table-hover table-bordered text-center">
            <thead>
              <tr>
                <th>时间</th>
                <th>导入表</th>
                <th>优化记录</th>
              </tr>
            </thead>
            <tbody>
<?php
$dir = 'result_file';
$file_list = scandir($dir, 1);

foreach ($file_list as &$file_name) {
    if ($file_name != '.' && $file_name != '..' && $file_name != '.DS_Store') {
        $file_path = "result_file/$file_name";

        $str_datetime = substr($file_name, 1, 14);
        $datetime = date('Y-m-d H:i:s', strtotime($str_datetime));

        $showname = substr($file_name, 16);
        $filename = substr($file_name, 1);

        echo <<<TBODY
        <tr>
            <td>$datetime</td>
            <td><a href="original_file/O$filename" download>$showname</a></td>
            <td><a href="result_file/R$filename" download>下载</a></td>
        </tr>
TBODY;
    }
}
unset($file_name);
?>
            </tbody>
          </table>
          <table class="table table-sm table-hover table-bordered" id="table-rule">
            <thead>
              <tr>
                <th width="50%">正则</th>
                <th>替换</th>
              </tr>
            </thead>
            <tbody id="tbody-rule">
    
            </tbody>
          </table>
        </div>

        <form name="form" enctype="multipart/form-data">
          <input name="MAX_FILE_SIZE" type="hidden" value="20000000">
          <input class="d-none" id="input" name="file" type="file" accept="text/csv">
        </form>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container -->


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="/node_modules/bootstrap-v4/assets/js/vendor/popper.min.js"></script>
  <script src="/node_modules/bootstrap-v4/dist/js/bootstrap.min.js"></script>
  <script>
    $(function () {
      $.ajax({
        url: 'rule',
        dataType: 'json',
        success: function (resp) {
          parseJSON(resp);
        }
      })
    })



    $('#btn-import').on('click', function () {
      $('#input').click();
    })

    $('#input').on('change', function () {
      var file_name = $(this).get(0).files[0].name;
      $('#btn-import').text(file_name);
    })

    $('#btn-run').on('click', function () {
      var form_data = new FormData(document.forms.namedItem('form'));
      $.ajax({
        url: "server?action=upload",
        type: "post",
        data: form_data,
        dataType: "json",
        processData: false,
        contentType: false,
        beforeSend: function () {
          if (checkFile()) {
            $('#btn-run, #btn-import').attr('disabled', 'disabled');
            $('#btn-run, #btn-import').css('cursor', 'not-allowed');
            $('#btn-run').text('正在优化...');
          } else {
            return false;
          }
        },
        success: function (resp) {
          if (resp.result) {
            $('#btn-import, #btn-run').remove();
            $('#btn-download').attr('href', resp.result_link);
            $('#btn-restart, #btn-download').show();
            prependRow('tbody', resp.datetime, resp.original_link, resp.file_name, resp.result_link);
            $('#tr-new').fadeIn('slow');
            alert('优化完成！');
          }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
          // alert(XMLHttpRequest.status);
          // alert(XMLHttpRequest.readyState);
          // alert(textStatus);
          alert('error');
        }
      })
    })

    $('#btn-restart').on('click', function () {
      location.reload();
    })

    function checkFile() {
      return $('#input').get(0).files.length;      
    }

    function prependRow(target, datetime, original_link, file_name, result_link) {
      $(target).prepend('<tr id="tr-new" style="display: none"><td>' + datetime + '</td><td><a href="' + original_link + '" download>' + file_name + '</a></td><td><a href="' + result_link + '" download>下载</a></td></tr>');
    }

    function parseJSON(json) {
      for (var key in json) {
        if (json.hasOwnProperty(key)) {
          var pattern = json[key][0];
          var replacement = json[key][1];
          
          $('#tbody-rule').append('\
            <tr>\
              <td>' + pattern + '</td>\
              <td>' + replacement + '</td>\
            </tr>');
        }
      }
    }

  </script>
</body>

</html>