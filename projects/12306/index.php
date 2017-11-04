<?php
$title = '12306 信息查询';
$nav_type = 'tl12306';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';

$current_hour = date('H');

if ($current_hour < 12) {
  $train_date_default = date('Y-m-d');
} else {
  $train_date_default = date('Y-m-d', strtotime("+1 day"));
}

?>
    <div class="container">
      <div class="page-header">
        <h1><?php echo $title; ?></h1>
      </div>

      <form method="get" action="server">

        <div class="row">
          <div class="col-sm-6" style="padding: 0">
            <div class="form-group col-sm-6">
              <label for="from_station_name">出发站：</label>
              <input class="form-control" id="from_station_name" name="from_station_name" type="text" placeholder="北京南">
            </div>
            <div class="form-group col-sm-6">
              <label for="to_station_name">到达站：</label>
              <input class="form-control" id="to_station_name" name="to_station_name" type="text" placeholder="上海虹桥">
            </div>
            <div class="form-group col-sm-6">
              <label for="train_code">车次：</label>
              <input class="form-control" id="train_code" name="train_code" type="text" placeholder="G1">
            </div>
            <div class="form-group col-sm-6">
              <label for="train_date">出发日期：</label>
              <input class="form-control" id="train_date" name="train_date" type="date" placeholder="<?php echo $train_date_default; ?>" value="<?php echo $train_date_default; ?>" autocomplete="off">
            </div>
            <div class="col-sm-12" style="margin: 5px 0 15px 0">
              <button class="btn btn-primary btn-block" id="btn-submit" type="button">查询</button>
            </div>
          </div>

          <div class="col-sm-6" id="result-panel" style="display: none">
            <div class="panel panel-default">
              <div class="panel-body" id="result-panel-body">
              </div>
            </div>
          </div>
        </div>

      </form>
    </div><!-- container -->
    <script>
      
      $(function () {
        
        $('#btn-submit').on('click', function () {
          var from_station_name = $('#from_station_name').val();
          var to_station_name = $('#to_station_name').val();
          var train_code = $('#train_code').val();
          var train_date = $('#train_date').val();
          $.ajax({
            type: 'get',
            url: 'server',
            dataType: 'json',
            data: {
              'action': 'query',
              'from_station_name': from_station_name,
              'to_station_name': to_station_name,
              'train_code': train_code,
              'train_date': train_date
            },
            beforeSend: function () {
            },
            success: function (response) {
              $('#result-panel').fadeIn();
              $('#result-panel-body').append('<p>出 发：' + response.start_datetime + '</p>');
              $('#result-panel-body').append('<p>到 达：' + response.arrive_datetime + '</p>');
              $('#result-panel-body').append('<p>历 时：' + response.last_time + '</p>');
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
              alert(XMLHttpRequest.status);
              alert(XMLHttpRequest.readyState);
              alert(textStatus);
            }
          })
        });
      });
    </script>
  </body>
</html>
