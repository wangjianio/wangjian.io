<?php
$title = 'MD5 值生成器';
$nav_type = 'md5';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
    <div class="container">
      <div class="page-header">
        <h1><?php echo $title; ?></h1>
      </div>

      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8">
          <div class="input-group input-group-lg">
            <input class="form-control" id="input" name="string" type="text" placeholder="直接输入字符串">
            <div class="input-group-btn">
              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">MD5 <span class="caret"></span></button>
              <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </div><!-- .input-group-btn -->
          </div>
          <div class="panel panel-default" style="margin-top: 20px">
            <div class="panel-body" id="result">
              d41d8cd98f00b204e9800998ecf8427e
            </div>
          </div>
        </div><!-- .col -->
      </div><!-- .row -->
    </div><!-- .container -->

  <script>

    $(document).ready(function () {
      $('#input').focus();

      $('#input').bind('input propertychange', function () {
        var str = $('#input').val();
        var str = encodeURIComponent(str);
        var url = 'md5?str=' + str;
        $('#result').load(url);
      })

    });


  </script>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
