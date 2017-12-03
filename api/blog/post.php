<?php
date_default_timezone_set('Asia/Shanghai');

// 没有参数时返回列表
// 有 id 参数时返回文章
if (!$_GET) {
    $file_list = array_reverse(scandir('posts'));
    
    foreach ($file_list as $file_name) {
        if (preg_match("/\d{6}\.\d+\.\d\.\d\..+/", $file_name)) {
            $post_info = explode('.', $file_name);
            
            // $arr['showInIndex'] = $post_info[3];
            // $arr['valid']       = $post_info[2];
            // $arr['editDate'] = date('Y-m-d', filemtime("posts/$file_name"));
            if ($post_info[2] && $post_info[3]) {
    
                $arr['id']       = $post_info[1];
                $arr['pubDate']  = date('Y-m-d', strtotime($post_info[0]));
                $arr['title']    = $post_info[4];
    
                $json[] = $arr;
            }
    
        }
    }
    
    echo json_encode($json);
} else if ($_GET['id']) {

    if ($file_name = getFileNameById($_GET['id'], 1)) {

        $arr['title'] = getTitleByFileName($file_name);
        $arr['editDate'] = getFileEditDateByFileName($file_name);
        $arr['content'] = getContentByFileName($file_name);
    
        echo json_encode($arr);
    }

}


function getFileNameById($id, $valid)
{
    $file_list = scandir('posts');
    return implode(preg_grep("/^\d+\.$id\.$valid\..*/", $file_list));
}

function getTitleByFileName($file_name)
{
    preg_match("/^\d+\.\d+\.\d\.\d\.(.*)\.[html|md]/", $file_name, $title);
    return $title[1];
}

function getFileEditDateByFileName($file_name)
{
    return date('Y-m-d', filemtime("posts/$file_name"));
}

function getContentByFileName($file_name)
{
    return file_get_contents("posts/$file_name");    
}
