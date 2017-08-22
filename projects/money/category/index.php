<?php
namespace wangjian\wangjianio\projects\money;

require_once dirname(__DIR__) . '/includes/Common.php';

$title = '类别管理';
$nav_type = 'money';
$subnav_type = 'category';

$extra_css  = '<link rel="stylesheet" href="/node_modules/bootstrap-treeview/src/css/bootstrap-treeview.css">';
$extra_css  = '<style>h1 a, h1 a:hover { color: #333; }</style>';
$extra_js   = '<script src="/node_modules/bootstrap-treeview/src/js/bootstrap-treeview.js"></script>';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';

$common = new Common;

$type = $_GET['c'];

if (!isset($type)) {
    $common->redirectTo('/projects/money/category/index?c=out');
    exit;
} elseif ($type !== 'out' && $type !== 'in') {
    $common->redirectTo('/projects/money/category/index?c=out');
    exit;
}
?>
    <div class="container">

      <div class="page-header">
        <h1>
<?php
    if ($type === 'out') {
        echo <<< PAGE_HEADER
        <a href="index?c=out">支出</a>
          <small>
            <a href="index?c=in">收入</a>
          </small>
PAGE_HEADER;
    } elseif ($type === 'in') {
        echo <<< PAGE_HEADER
        <small>
          <a href="index?c=out">支出</a>
        </small>
        <a href="index?c=in">收入</a>
PAGE_HEADER;
    }
?>
        </h1>
      </div>

      <div class="row">
        <div class="col-sm-7">
          <div id="tree"></div>
        </div><!-- col -->

        <div class="col-sm-5">
          <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                  <label class="h4" for="new_cate_input" style="margin-bottom: 15px">新增根类别：</label>
                  <input class="form-control" id="new_cate_input" type="text" placeholder="请输入类别名" autocomplete="off">
                </div>
                <hr>
                <button class="btn btn-success btn-block" id="submit_btn" type="button">提交</button>
            </div>
          </div>
        </div>
      </div><!-- row -->
    </div><!-- .container -->


    <script>
        $(document).ready(function () {
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
                  cate_id = data.id;
                  cate_name = data.text;
                  $('.panel-body').load('form?id=' + data.id);
                },
              });
              placeFooter();
            },
          });

          $('#submit_btn').click(function () {
            var new_cate = $('#new_cate_input').val();
            $.ajax({
              type: "post",
              url: "server?action=add",
              dataType: "json",
              data: {
                'type': '<?php echo $type; ?>',
                'new_cate': new_cate,
                'parent_id': '0'
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
          })

        });
    </script>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
