<?php
$title = '关于';
$nav_type = 'about';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
    <div class="container">
      <div class="page-header">
        <h1><?php echo $title; ?></h1>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8">
          <p>根据自己需要，做的小网站。</p>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
          <h2>特别感谢</h2>
          <ul class="list-unstyled">
            <li><a href="http://httpd.apache.org" target="_blank">Apache HTTP Server Project</a></li>
            <li><a href="http://getbootstrap.com" target="_blank">Bootstrap</a></li>
            <li><a href="https://github.com/jonmiles/bootstrap-treeview" target="_blank">Bootstrap Tree View</a></li>
            <li><a href="https://github.com/silviomoreto/bootstrap-select" target="_blank">Bootstrap-select</a></li>
            <li><a href="https://github.com/zenorocha/clipboard.js" target="_blank">clipboard.js</a></li>
            <li><a href="https://getcomposer.org" target="_blank">Composer</a></li>
            <li><a href="https://github.com/xdan/datetimepicker" target="_blank">DateTimePicker</a></li>
            <li><a href="https://git-scm.com" target="_blank">Git</a></li>
            <li><a href="https://github.com" target="_blank">GitHub</a></li>
            <li><a href="http://glyphicons.com" target="_blank">GLYPHICONS</a></li>
            <li><a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript" target="_blank">JavaScript</a></li>
            <li><a href="https://jquery.com" target="_blank">jQuery</a></li>
            <li><a href="https://www.npmjs.com" target="_blank">npm</a></li>
            <li><a href="http://parsedown.org" target="_blank">Parsedown</a></li>
            <li><a href="http://php.net" target="_blank">PHP</a></li>
            <li><a href="https://www.w3.org" target="_blank">W3C</a></li>
          </ul>
        </div>
      </div>
    </div><!-- .container -->

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
