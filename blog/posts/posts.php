<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$ini = parse_ini_file('posts.ini', TRUE);

$nav_type = 'blog';
$subnav_type = 'posts';
$extra_css = '<link rel="stylesheet" href="/styles/blog.css">';

$id = $_GET['id'];

$title = $ini[$id]['title'];

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';

$file_m_date = date('Y-m-d', filemtime('source/'.$id.'.md'));
$file_m_datetime = date('c', filemtime('source/'.$id.'.md'));


if ($ini[$id]['valid']) {
    echo <<<H1
  <div class="container">
    <div class="page-header">
      <h1>$title</h1>
    </div>
    <p class="text-right">编辑于：<time datetime="$file_m_datetime">$file_m_date</time></p>
H1;

$post_content = file_get_contents("source/$id.md");

$Parsedown = new Parsedown();
$Parsedown->setUrlsLinked(false);
echo $Parsedown->text($post_content);

} else {
    $url = "/404";
    echo "<script>window.location.href='$url'</script>"; 
}
    echo '</div><!-- .container -->';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
