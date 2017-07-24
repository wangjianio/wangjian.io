<?php 
include 'assets/include.php';
$title = "博客";
$nav_type = 'blog';
$extra_css = '<link rel="stylesheet" href="styles/index.css">';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';

echo <<<H1
  <div class="container">
    <div class="page-header">
      <h1>文章列表</h1>
    </div>
H1;

echo '<ul class="list-unstyled">';

for ($article_id=10; $article_id>=0; $article_id--) {
    $article_title = $ini[$article_id]['title'];
    $add_date = date('Y-m-d', strtotime($ini[$article_id]['add_datetime']));
    $add_datetime = date('c', strtotime($ini[$article_id]['add_datetime']));
    
    if ($ini[$article_id]['valid']) {
        echo <<<LI
            <li class="h3">
              <small>发布于：<time datetime="$add_datetime">$add_date</time></small>
              <br>
              <a href="article/$article_id">$article_title</a>
            </li>
LI;
    }
}

echo '</ul>';
    echo '</div><!-- .container -->';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
