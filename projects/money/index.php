<?php
namespace lopedever\money;

include __DIR__ . '/includes/config.php';
include __DIR__ . '/includes/database/database.php';
include __DIR__ . '/includes/index/PrintIndexTransData.php';
include __DIR__ . '/includes/index/PrintAddTransForm.php';

$year = date('Y');
$month = date('n');
switch ($month) {
  case '1':
    $month = '一月';
    break;
  case '2':
    $month = '二月';
    break;
  case '3':
    $month = '三月';
    break;
  case '4':
    $month = '四月';
    break;
  case '5':
    $month = '五月';
    break;
  case '6':
    $month = '六月';
    break;
  case '7':
    $month = '七月';
    break;
  case '8':
    $month = '八月';
    break;
  case '9':
    $month = '九月';
    break;
  case '10':
    $month = '十月';
    break;
  case '11':
    $month = '十一月';
    break;
  case '12':
    $month = '十二月';
    break;
  
  default:
    break;
}
$week = date('N');
switch ($week) {
  case '1':
    $week = '星期一';
    break;
  case '2':
    $week = '星期二';
    break;
  case '3':
    $week = '星期三';
    break;
  case '4':
    $week = '星期四';
    break;
  case '5':
    $week = '星期五';
    break;
  case '6':
    $week = '星期六';
    break;
  case '7':
    $week = '星期日';
    break;
  
  default:
    break;
}
$day = date('d');
?>

<!DOCTYPE html>
<html>

<head>
  <title>主页</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="styles/index.css">
  <link rel="stylesheet" href="styles/jquery.datetimepicker.css">
  <script src="scripts/jquery-3.2.1.min.js"></script>
  <script src="scripts/jquery.datetimepicker.full.min.js"></script>
  <script src="scripts/svg.js"></script>
  <script src="scripts/common.js"></script>
  <script>
  // 弹出隐藏层
  function showDiv(hideDiv) {
      document.getElementById(hideDiv).style.display = 'block';
  }

  // 关闭弹出层
  function hideDiv(hideDiv) {
      document.getElementById(hideDiv).style.display = 'none';
  }

  function getNowFormatDate() {
      // yyyy-MM-dd HH:MM:SS
      var date = new Date();
      var seperator1 = "-";
      var seperator2 = ":";
      var month = date.getMonth() + 1;
      var strDate = date.getDate();
      if (month >= 1 && month <= 9) {
          month = "0" + month;
      }
      if (strDate >= 0 && strDate <= 9) {
          strDate = "0" + strDate;
      }
      var currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDate
          + " " + date.getHours() + seperator2 + date.getMinutes()
          //+ seperator2 + date.getSeconds();
      return currentdate;
  }
  </script>
</head>

<body>

<?php
include __DIR__ . '/includes/header.php';

echo "<div class='content'>";
echo "<div class='left-div'>";

echo <<<H2
        <h2 class="date">
          <span class="day">$day</span>
          <span class="week">$week</span>
          <span class="month">$month $year</span>
        </h2>
        <a class="add" href="javascript:void(0)" onclick="showDiv('hideDiv')">
          <img class="svg" src="assets/add.svg">
        </a>
H2;

$print_index_trans_data->printTable();

echo "</div>";
    
?>
    <div class="right-div">
      <h2>概况</h2>
      <table class="general">
        <thead>
          <tr>
            <th>借记账户</th>
            <th class="money">980.32</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>工商银行</td>
            <td class="money">100.11</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>


  <div id="hideDiv">
    <div id="bgDiv">
      <div id="editDiv">
        <?php $print_add_trans_form->printAddTransForm(); ?>
        <div class="button">
          <span class="submit" onclick="submitForm('addTransForm')">保存</span>
          <span class="close" onclick="hideDiv('hideDiv')">关闭</span>
        </div>
      </div>
    </div>
  </div>
  <script>
    $.datetimepicker.setLocale('zh');
    $('#datetimepicker').datetimepicker({
        value: getNowFormatDate(),
        step: 1
    });
  </script>
</body>

</html>
