<?php
namespace wangjian\wangjianio\projects\money;

require_once dirname(__DIR__) . '/includes/TransData.php';

$title = '交易记录';
$nav_type = 'money';
$subnav_type = 'transaction';

$page = $_GET['page'];
if (is_numeric($page) && $page > 0) {
  $page = intval($page);
} else {
  $page = 1;
}

$extra_css = '<link rel="stylesheet" href="../styles/money.css">';
$extra_css .= '<link rel="stylesheet" href="../styles/transaction.css">';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<div class="container">
  <div class="page-header">
    <h1>交易记录
      <small>
        <button class="btn btn-xs btn-primary" type="button" data-toggle="collapse" data-target="#filterOption" aria-expanded="false" aria-controls="filterOption">
          筛选
        </button>
      </small>
    </h1>
  </div><!-- page-header -->
  
<?php //include_once 'filter.php'; ?>

<table class="table table-hover table-condensed">
  <thead>
    <tr>
      <th class="type">类型</th>
      <th class="account">账户</th>
      <th class="datetime">时间</th>
      <th class="money">金额</th>
      <th class="category">类别</th>
      <th class="location">地点</th>
      <th class="agent">相关人</th>
      <th class="remark">备注</th>
      <th class="action">操作</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>

  <nav aria-label="Page navigation">
    <ul class="pagination">
      <li>
        <a href="#" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      <li><a href="#">1</a></li>
      <li><a href="#">2</a></li>
      <li><a href="#">3</a></li>
      <li><a href="#">4</a></li>
      <li><a href="#">5</a></li>
      <li>
        <a href="#" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
  </nav>
  
</div><!-- container -->

<script>
  $(function () {
    $.ajax({
      url: "json?page=<?php echo $page; ?>",
      dataType: "json",
      success: function (response) {
        json_transaction = response;
        parseJSON(json_transaction);
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert(XMLHttpRequest.status);
        alert(XMLHttpRequest.readyState);
        alert(textStatus);
      }
    });
  }); // ready


  function parseJSON(json) {

    for (var key in json) {
      if (json.hasOwnProperty(key)) {

        var t_id = json[key].t_id;
        var t_type = json[key].t_type;
        var a_name = json[key].a_name;
        var t_datetime = json[key].t_datetime;
        var t_money = json[key].t_money;
        var c_name = json[key].c_name;
        var t_location = json[key].t_location;
        var t_agent = json[key].t_agent;
        var t_remark = json[key].t_remark;

        c_name?1:c_name='';
        t_location?1:t_location='';
        t_location?1:t_location='';
        t_agent?1:t_agent='';
        t_remark?1:t_remark='';

        $('tbody').append('\
          <tr>\
            <td>' + t_type + '</td>\
            <td>' + a_name + '</td>\
            <td>' + t_datetime + '</td>\
            <td>' + t_money + '</td>\
            <td>' + c_name + '</td>\
            <td>' + t_location + '</td>\
            <td>' + t_agent + '</td>\
            <td>' + t_remark + '</td>\
            <td><a href="' + t_id + '">编辑</a> <a href="">删除</a></td>\
          </tr>\
        ');
      }
    }
  }
</script>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
