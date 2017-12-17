<?php
/**
 * method: post
 * 只接受 15 或 18 位的 idNumber
 */
if (!$_POST['idNumber']) exit;

$id = $_POST['idNumber'];

switch (strlen($id)) {
    case 15:
    case 18:
        if (!preg_match("/(^\d{17}(\d|X|x)$)|(^\d{15}$)/", $id)) {
            $arr['error'] = '身份证号格式有误';
        } else {
            $page = file_get_contents("http://cet.jlste.com.cn/cet/query/qry/$id");

            preg_match('/<td>考生姓名<\/td>\s<td>(.*)<\/td>/', $page, $name);
            preg_match('/<td>身份证号<\/td>\s<td>(.*)<\/td>/', $page, $id_no);
            preg_match('/<td>准考证号<\/td>\s<td>(.*)<\/td>/', $page, $cet_no);

            if (empty($cet_no)) {
                $arr['error'] = '没有查到信息';
            } else {
                $arr['data']['name'] = $name[1];
                $arr['data']['idNumber'] = $id_no[1];
                $arr['data']['certificate'] = $cet_no[1];
            }
        }
        break;

    default:
        $arr['error'] = '身份证号应为 15 或 18 位';        
        break;
}

$arr['error'] ? $arr['result'] = false : $arr['result'] = true;

echo json_encode($arr);