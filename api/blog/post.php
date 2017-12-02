<?php
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
