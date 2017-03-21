<?php
include '../include/database.php';

$id = $_GET['id'];

$article_query = $mysqli->query("SELECT * FROM article WHERE id = $id");
$article_info = mysqli_fetch_array($article_query);
$title = $article_info['title'];
$edit_date = date('Y-m-d', strtotime($article_info['edit_datetime']));
$datetime = date('c', strtotime($article_info['edit_datetime']));

include '../include/header.php';
if ($article_info['valid']) {
?>
    <h1><?php echo $title; ?></h1>
    <p class="article-edit-time">编辑于：<time datetime="<?php echo $datetime; ?>"><?php echo $edit_date; ?></time></p>
<?php
include 'a'.$id.'.html';
} else {
    echo '文章不存在';
}
include '../include/footer.php';
?>