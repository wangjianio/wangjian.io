<?php 
include 'include/database.php';
$title = "lopedever's blog";
$is_root = TRUE;
include 'include/header.php';
?>
    <h1 class="index-title">文章列表</h1>
    <ul>
<?php
for ($article_id=100; $article_id>=0; $article_id--) {
    $article_query = $mysqli->query("SELECT * FROM article WHERE id = $article_id");
    $article_info = mysqli_fetch_array($article_query);
    $article_title = $article_info['title'];
    $add_date = date('Y-m-d', strtotime($article_info['add_datetime']));
    $datetime = date('c', strtotime($article_info['add_datetime']));
    
    if (!$article_info['id'] == '' && $article_info['valid']) {
?>
      <li class="index-add-time">发布于：<time datetime="<?php echo $datetime;?>"><?php echo $add_date;?></time></li>
      <li class="index-article-title"><a href="article/<?php echo $article_id;?>"><?php echo $article_title;?></a></li>
<?php
    }
}
?>
    </ul>
<?php include 'include/footer.php';?>
