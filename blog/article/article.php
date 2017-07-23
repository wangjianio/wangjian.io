<?php
include '../assets/include.php';
$id = $_GET['id'];

$title = $ini[$id]['title'];
$file_m_date = date('Y-m-d', filemtime('source/'.$id.'.html'));
$file_m_datetime = date('c', filemtime('source/'.$id.'.html'));

include $path['header'];
if ($ini[$id]['valid']) {
?>
    <h1><?php echo $title; ?></h1>
    <p class="article-edit-time">编辑于：<time datetime="<?php echo $file_m_datetime; ?>"><?php echo $file_m_date; ?></time></p>
<?php
include "source/$id.html";
} else {
    $url = "/404.html";
    echo "<script>window.location.href='$url'</script>"; 
}
include $path['footer'];
