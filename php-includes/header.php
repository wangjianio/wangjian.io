<!DOCTYPE html>
<html lang="zh-CN">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title; ?></title>

    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
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

    <script>
        $(document).ready(function($) {
          var name = window.location.pathname.split("/", "3");
          var menuClass = ".nav-" + name[1];
          var submenuClass = ".nav-" + name[1] + "-" + name[2];
          $("nav li" + menuClass).addClass('active');
          $("nav li" + submenuClass).addClass('active');
        });
    </script>

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

          <ul class="nav navbar-nav navbar-right">
            <li class="nav-index"><a href="/index">主页</a></li>
            <li class="nav-blog"><a href="/blog/">博客</a></li>

            <li class="dropdown nav-projects">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">项目<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <!--<li role="separator" class="divider"></li>-->
                <li class="dropdown-header">Beta</li>
                <li class="nav-projects-file_management_system"><a href="/projects/file_management_system/">文件管理系统</a></li>
                <li class="nav-projects-old_pronunciation"><a href="/projects/old_pronunciation/">OLD 英语发音</a></li>
                <li class="nav-projects-12306"><a href="/projects/12306/">12306 信息处理</a></li>
                <li class="nav-projects-money"><a href="/projects/money/">Money - 个人财物管理</a></li>
                <li class="nav-projects-cet_jilin"><a href="/projects/cet_jilin/">吉林英语四六级准考证号查询</a></li>
              </ul>
            </li>

            <li class="dropdown nav-tools">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">工具<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="nav-tools-ip"><a href="/tools/ip/">IP</a></li>
                <li class="nav-tools-md5"><a href="/tools/md5/">MD5</a></li>
                <li class="nav-tools-time"><a href="/tools/time/">Time</a></li>
                <li class="nav-tools-useragent"><a href="/tools/useragent/">User Agent</a></li>
              </ul>
            </li>

            <li class="nav-about"><a href="/about">关于</a></li>
          </ul>

          <ul class="nav navbar-nav">
            <li><a href="./">Static top</a></li>
          </ul>

        </div>
      </div>
    </nav>

    <div class="container">
