<?php
namespace wangjian\wangjianio\projects\money;

require_once dirname(__DIR__) . '/includes/Common.php';

$title = '类别管理';
$nav_type = 'money';
$subnav_type = 'category';

$extra_css  = '<link rel="stylesheet" href="/node_modules/bootstrap-treeview/src/css/bootstrap-treeview.css">';
$extra_css .= '<link rel="stylesheet" href="../styles/money.css">';
$extra_js   = '<script src="/node_modules/bootstrap-treeview/src/js/bootstrap-treeview.js"></script>';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';

$common = new Common;

$type = $_GET['type'];

if (!isset($type)) {
    $common->redirectTo('/projects/money/category/out');
    exit;
} elseif ($type !== 'out' && $type !== 'in') {
    $common->redirectTo('/projects/money/category/out');
    exit;
}
?>
    <div class="container">

      <div class="page-header">
        <h1>
<?php
    if ($type === 'out') {
        echo <<< PAGE_HEADER
        <a href="out">支出</a>
          <small>
            <a href="in">收入</a>
          </small>
PAGE_HEADER;
    } elseif ($type === 'in') {
        echo <<< PAGE_HEADER
        <small>
          <a href="out">支出</a>
        </small>
        <a href="in">收入</a>
PAGE_HEADER;
    }
?>
        </h1>
      </div>

      <div class="row">
        <div class="col-sm-7">
          <div id="tree"></div>
        </div><!-- col -->

        <div class="col-sm-5 sticky">
          <div class="panel panel-default">
            <div class="panel-body" id="default_panel">
              <div class="form-group">
                <label class="h4" for="new_root_cate_input" style="margin-bottom: 15px">新增根类别：</label>
                <input class="form-control" id="new_root_cate_input" type="text" placeholder="请输入类别名" autocomplete="off">
              </div>
              <hr>
              <button class="btn btn-success btn-block" id="default_submit_btn" type="button">提交</button>
            </div>
            <div class="panel-body" id="selected_panel" style="display: none">
            </div>
          </div>
        </div>
      </div><!-- row -->
      
    </div><!-- .container -->
    
    <!-- <p id="test" style="position: fixed; top: 100px; left:20px;">placeholder</p> -->

    <script>
        $(function () {
          $.ajax({
            type: "GET",
            url: "tree_view_json?type=<?php echo $type; ?>",
            dataType: "json",
            success: function (response) {
              $('#tree').treeview({
                data: response,
                expandIcon: 'glyphicon glyphicon-chevron-right',
                collapseIcon: 'glyphicon glyphicon-chevron-down',
                onNodeSelected: function (event, data) {
                  // 全局变量
                  cate_id = data.id;
                  cate_name = data.text;
                  $('#default_panel').hide();
                  $('#selected_panel').show();
                  $('#selected_panel').load('form?id=' + data.id);
                },
                onNodeUnselected: function (event, data) {
                  $('#selected_panel').hide();  
                  $('#default_panel').show();                                  
                },
              });
            },
          });
          
          var timeoutID;

          $('#default_submit_btn').on('click', function () {
            var new_cate = $('#new_root_cate_input').val();
            $.ajax({
              type: "post",
              url: "server?action=add",
              dataType: "json",
              data: {
                'type': '<?php echo $type; ?>',
                'new_root_cate': new_cate,
                'parent_id': '0'
              },
              beforeSend: function () {
                if (!new_cate) {
                  clearTimeout(timeoutID);
                  $('#new_root_cate_input').parent().addClass('has-error');
                  $('#new_root_cate_input').focus();
                  timeoutID = setTimeout(function() {
                    $('#new_root_cate_input').parent().removeClass('has-error');
                  }, 1000);
                  return false;
                }
              },
              success: function (response) {
                if (response.result === 'success') {
                  location.reload();
                } else {
                  alert(response.result);
                }
              },
              error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert(XMLHttpRequest.status);
                alert(XMLHttpRequest.readyState);
                alert(textStatus);
              }
            });
          });

      }); // ready

    </script>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
