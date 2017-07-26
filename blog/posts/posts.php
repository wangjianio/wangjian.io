<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$nav_type = 'blog';
$subnav_type = 'posts';
$extra_css = '<link rel="stylesheet" href="/styles/blog.css">';

$id = $_GET['id'];

$file_list = scandir('source');

foreach ($file_list as &$file_name) {

    if ($file_name != '.' && $file_name != '..' && $file_name != '.DS_Store') {

        if (preg_match("/20\d{6}\.$id\.\d\.\d\..+/", $file_name)) {
            $post_info = preg_split("/\./", $file_name);

            $valid = $post_info[2];
            $title = $post_info[4];

            require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';

            $file_m_date = date('Y-m-d', filemtime("source/$file_name"));

            if ($valid) {
                echo <<<H1
                <div class="container">
                  <div class="page-header">
                    <h1>$title</h1>
                  </div>
                <p class="text-right">编辑于：<time datetime="$file_m_date">$file_m_date</time></p>
H1;

            $post_content = file_get_contents("source/$file_name");

            $Parsedown = new Parsedown();
            $Parsedown->setUrlsLinked(false);
            echo $Parsedown->text($post_content);

            } else {
                $url = "/404";
                echo "<script>window.location.href='$url'</script>"; 
            }
        }
    }
}
unset($file_name);

echo '</div><!-- .container -->';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
