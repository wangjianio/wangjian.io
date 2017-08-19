<?php
namespace wangjian\wangjianio\projects\money;

$title = '类别管理';
$nav_type = 'money';
$subnav_type = 'category';

$extra_css  = '<link rel="stylesheet" href="/node_modules/bootstrap-treeview/src/css/bootstrap-treeview.css">';
$extra_js   = '<script src="/node_modules/bootstrap-treeview/src/js/bootstrap-treeview.js"></script>';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
    <div class="container">

      <div class="row">
        <div class="col-sm-6">
          <div class="page-header">
            <h1>支出</h1>
          </div>
          <div id="tree_out"></div>
        </div><!-- col -->

        <div class="col-sm-6">
          <div class="page-header">
            <h1>收入</h1>
          </div>
          <div id="tree_in"></div>
        </div><!-- col -->
      </div><!-- row -->

    </div><!-- .container -->

    <script>
        $(document).ready(function () {
          $.ajax({
            type: "GET",
            url: "json?type=out",
            dataType: "json",
            success: function (response) {
              $('#tree_out').treeview({
                data: response,
                expandIcon: 'glyphicon glyphicon-chevron-right',
                collapseIcon: 'glyphicon glyphicon-chevron-down',
              });
            },
          });

          $.ajax({
            type: "GET",
            url: "json?type=in",
            dataType: "json",
            success: function (response) {
              $('#tree_in').treeview({
                data: response,
                expandIcon: 'glyphicon glyphicon-chevron-right',
                collapseIcon: 'glyphicon glyphicon-chevron-down',
              });
            },
          });
        });
    </script>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
