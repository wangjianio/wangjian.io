<?php
$title = '吉林省 CET 准考证号查询';
$nav_type = 'cet';
$id = htmlspecialchars($_GET['id']);
$extra_css = '<link rel="stylesheet" href="styles/index.css">';
$extra_js = '<script src="scripts/index.js"></script>';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="page-header">
        <h1><?php echo $title; ?></h1>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8">
      <form method="get" onSubmit="return checkInput(this)">
        <div class="input-group input-group-lg">
          <input name="id" type="text" class="form-control" placeholder="输入身份证号" value="<?php echo $id; ?>">
          <span class="input-group-btn">
            <button class="btn btn-primary" type="submit">查询</button>
          </span>
        </div>
      </form>
      <div class="alert alert-danger" id="alert0" role="alert">请输入身份证号！</div>
      <div class="alert alert-danger" id="alert1" role="alert">身份证格式有误，请核对后重试。</div>
      <div class="alert alert-warning" id="alert2" role="alert">没有查找到信息，请确认身份证号。</div>
    </div>

<?php
switch (strlen($id)) {
    case 0:
        break;

    case 15:
    case 18:
        if (!preg_match("/(^\d{17}(\d|X|x)$)|(^\d{15}$)/", $id)) {
            echo "<script>autoAlert('alert1')</script>";
        } else {
            $page = file_get_contents("http://cet.jlste.com.cn/cet/query/qry/$id");

            preg_match('/<td>考生姓名<\/td>\s<td>(.*)<\/td>/', $page, $name);
            preg_match('/<td>身份证号<\/td>\s<td>(.*)<\/td>/', $page, $id_no);
            preg_match('/<td>准考证号<\/td>\s<td>(.*)<\/td>/', $page, $cet_no);

            if (empty($cet_no)) {
                echo "<script>autoAlert('alert2')</script>";
            } else {
                echo <<<RESULT_TABLE
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-7">
                  <table class="table table-hover table-bordered">
                    <tr>
                      <td>考生姓名：</td>
                      <td id="name">$name[1]<button class="btn btn-default btn-xs btn-custom-copy pull-right" data-clipboard-target="#name">复制</button></td>
                    </tr>
                    <tr>
                      <td>身份证号：</td>
                      <td id="idNo">$id_no[1]<button class="btn btn-default btn-xs btn-custom-copy pull-right" data-clipboard-target="#idNo">复制</button></td>
                    </tr>
                    <tr>
                      <td>准考证号：</td>
                      <td id="cetNo">$cet_no[1]<button class="btn btn-default btn-xs btn-custom-copy pull-right" data-clipboard-target="#cetNo">复制</button></td>
                    </tr>
                  </table>
                </div>
RESULT_TABLE;
            }
        }
        break;

    default:
        echo "<script>autoAlert('alert1')</script>";
        break;
}

echo <<<AAA

</div>
<script src="scripts/copy.js"></script>
</div><!-- .container -->
AAA;

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
