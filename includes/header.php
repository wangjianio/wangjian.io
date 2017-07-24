<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/NavSelector.php'; ?>
<!DOCTYPE html>
<html lang="zh-CN">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title; ?></title>

    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/styles/footer.css">
    <?php echo $extra_css; ?>
    <script src="/scripts/jquery-3.2.1.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script src="/clipboard/dist/clipboard.min.js"></script>
    <?php echo $extra_js; ?>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--
    <style>
      .dropdown:hover .dropdown-menu {
        display: block;
        margin-top: 0;
      }
    </style>
    -->
  </head>

  <body>
    <nav class="navbar navbar-inverse navbar-static-top">
      <div class="container">

        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false"
            aria-controls="navbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/index">Wang Jian IO</a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">

<?php $nav_selector->printRightNav($nav_type); ?>

<?php $nav_selector->printLeftNav($nav_type, $subnav_type); ?>

        </div>
      </div>
    </nav>

    <div class="container">
