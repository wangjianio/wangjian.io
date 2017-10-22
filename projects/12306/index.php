<?php
$title = '12306';
$nav_type = 'tl12306';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';

$current_date = date('Y-m-d');
?>
    <div class="container">
      <div class="page-header">
        <h1>12306 信息</h1>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <form method="get" action="server">
            <div class="form-group">
              <label for="train_code">车次：</label>
              <input class="form-control" id="train_code" name="train_code" type="text" placeholder="G1">
            </div>
            <div class="form-group">
              <label for="from_station_name">出发站：</label>
              <input class="form-control" id="from_station_name" name="from_station_name" type="text" placeholder="北京南">
            </div>
            <div class="form-group">
              <label for="to_station_name">到达站：</label>
              <input class="form-control" id="to_station_name" name="to_station_name" type="text" placeholder="上海虹桥">
            </div>
            <div class="form-group">
              <label for="train_date">出发日期：</label>
              <input class="form-control" id="train_date" name="train_date" type="date" placeholder="<?php echo $current_date; ?>" value="<?php echo $current_date; ?>">
            </div>
            
            <button type="submit" class="btn btn-primary">提交</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
