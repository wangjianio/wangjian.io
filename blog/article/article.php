<?php
include '../assets/include.php';
$nav_type = 'blog';
$subnav_type = 'article';
$extra_css = '<link rel="stylesheet" href="/blog/styles/article.css">';
$id = $_GET['id'];

$title = $ini[$id]['title'];
$file_m_date = date('Y-m-d', filemtime('source/'.$id.'.html'));
$file_m_datetime = date('c', filemtime('source/'.$id.'.html'));

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';

if ($ini[$id]['valid']) {
    echo <<<H1
  <div class="container">
    <div class="page-header">
      <h1>$title</h1>
    </div>
    <p class="text-right">编辑于：<time datetime="$file_m_datetime">$file_m_date</time></p>
H1;

include "source/$id.html";

} else {
    $url = "/404";
    echo "<script>window.location.href='$url'</script>"; 
}
    echo '</div><!-- .container -->';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
