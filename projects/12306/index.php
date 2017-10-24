<?php
$title = '12306 信息查询';
$nav_type = 'tl12306';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';

$current_date = date('Y-m-d');
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
              <input class="form-control" id="train_date" name="train_date" type="date" placeholder="<?php echo $current_date; ?>" value="<?php echo $current_date; ?>">
            </div>
            <div class="col-sm-12" style="margin: 5px 0 15px 0">
              <button class="btn btn-primary btn-block" type="button">查询</button>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="panel panel-default">
              <div class="panel-body">
                Basic panel example
              </div>
            </div>
          </div>
        </div>

      </form>
    </div><!-- container -->
  </body>
</html>
