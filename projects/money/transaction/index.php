<?php
namespace wangjian\wangjianio\projects\money;

require_once dirname(__DIR__) . '/includes/TransData.php';

$title = '交易记录';
$nav_type = 'money';
$subnav_type = 'transaction';

$extra_css = '<link rel="stylesheet" href="../styles/transaction.css">';
$extra_js = '<script src="../scripts/transaction.js"></script>';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<div class="container">
    <div class="page-header">
      <h1>交易记录
      <small><button class="btn btn-xs btn-primary" type="button" data-toggle="collapse" data-target="#filterOption" aria-expanded="false" aria-controls="filterOption">
        筛选
      </button></small></h1>
    </div>

<?php
include_once 'filter.php';
$trans_data->printTable();
?>

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
    </div><!-- .container -->

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
