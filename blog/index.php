<?php 
$title = "文章列表";
$nav_type = 'blog';
$extra_css = '<link rel="stylesheet" href="/styles/blog.css">';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';


echo <<<H1
  <div class="container">
    <div class="page-header">
      <h1>$title</h1>
    </div>
    <ul class="list-unstyled">
H1;


$file_list = scandir('posts/source');
rsort($file_list);


foreach ($file_list as &$file_name) {

    if ($file_name != '.' && $file_name != '..' && $file_name != '.DS_Store') {

        if (preg_match("/(20\d{6})\.(\d)\.(\d)\.(\d)\..+/", $file_name)) {
            $post_info = preg_split("/\./", $file_name);

            $post_date  = $post_info[0];
            $post_id    = $post_info[1];
            $post_valid = $post_info[2];
            $post_index = $post_info[3];
            $post_title = $post_info[4];

            $post_date = date('Y-m-d', strtotime($post_date));

            if ($post_valid && $post_index) {
                echo <<<LI
                    <li class="h3">
                    <small>发布于：<time datetime="$post_date">$post_date</time></small>
                    <br>
                    <a href="posts/$post_id">$post_title</a>
                    </li>
LI;
            }
        }
    }
}

unset($file_name);


echo '</ul>';
echo '</div><!-- .container -->';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
