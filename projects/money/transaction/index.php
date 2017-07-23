<?php
namespace lopedever\money;

include dirname(__DIR__) . '/includes/transaction/PrintTransData.php';
?>
<!DOCTYPE html>
<html>

<head>
  <title>交易</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../styles/transaction/index.css">
  <script>
      function showFilter() {
          document.getElementById("filter-option").style.display = "block";
          document.getElementById("filter-text").innerHTML = "[收起]";
          document.getElementById("filter-text").onclick = hideFilter;
      }

      function hideFilter() {
          document.getElementById("filter-option").style.display = "none";
          document.getElementById("filter-text").innerHTML = "[筛选]";
          document.getElementById("filter-text").onclick = showFilter;
      }
  </script>
</head>

<body>

<?php include dirname(__DIR__) . '/includes/header.php'; ?>

  <div class="content">
    <h2>交易记录</h2>
    <a class="filter-text" id="filter-text" href="javascript:void(0)" onclick="hideFilter()">[收起]</a>

<?php
include dirname(__DIR__) . '/includes/transaction/PrintTransFilter.php';
$print_trans_data->printTable();
?>

  </div>

</body>

</html>
