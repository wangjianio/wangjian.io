<?php
namespace wangjian\wangjianio\includes;

class NavSelector
{
    public function printRightNav($nav_type = null)
    {
        switch ($nav_type) {
            case 'index':
                $index = ' class="active"';
                break;
            case 'blog':
                $blog = ' class="active"';
                break;

            // Projects
            case 'cet':
                $projects = ' active';
                $cet = ' class="active"';
                break;
            case 'file':
                $projects = ' active';
                $file = ' class="active"';
                break;
            case 'od':
                $projects = ' active';
                $od = ' class="active"';
                break;
            case 'tl12306':
                $projects = ' active';
                $tl12306 = ' class="active"';
                break;
            case 'money':
                $projects = ' active';
                $money = ' class="active"';
                break;

            // Tools
            case 'ip':
                $tools = ' active';
                $ip = ' class="active"';
                break;
            case 'md5':
                $tools = ' active';
                $md5 = ' class="active"';
                break;
            case 'time':
                $tools = ' active';
                $time = ' class="active"';
                break;
            case 'ua':
                $tools = ' active';
                $ua = ' class="active"';
                break;

            case 'about':
                $about = ' class="active"';
                break;

            default:
                # code...
                break;
        }

        echo <<<UL
          <ul class="nav navbar-nav navbar-right">
            <li$index><a href="/index">主页</a></li>
            <li$blog><a href="/blog/">博客</a></li>

            <li class="dropdown$projects">
              <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" onselectstart="return false">项目<span class="caret"></span></a>
              <ul class="dropdown-menu">
              <li$od><a href="/projects/od_pronunciation/">Oxford Dictionaries 英语发音</a></li>
              <li$cet><a href="/projects/cet_jilin/">吉林英语四六级准考证号查询</a></li>
              <li role="separator" class="divider"></li>
              <li class="dropdown-header">Beta</li>
                <li$file><a href="/projects/file_management_system/">文件管理系统</a></li>
                <li$tl12306><a href="/projects/12306/">12306 信息处理</a></li>
                <li$money><a href="/projects/money/">Money - 个人财务管理</a></li>
              </ul>
            </li>

            <li class="dropdown$tools">
              <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" onselectstart="return false">工具<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li$ip><a href="/tools/ip/">IP</a></li>
                <li$md5><a href="/tools/md5/">MD5</a></li>
                <li$time><a href="/tools/time/">Time</a></li>
                <li$ua><a href="/tools/useragent/">User Agent</a></li>
              </ul>
            </li>

            <li$about><a href="/about">关于</a></li>
          </ul>
UL;

    }

    public function printLeftNav($nav_type = null, $subnav_type = null)
    {
        if ($nav_type == 'blog') {
            switch ($subnav_type) {
                case 'posts':
                    echo <<<UL
                    <ul class="nav navbar-nav">
                      <li><a href="/blog/index">返回文章列表</a></li>
                    </ul>
UL;
                    break;
                
                default:
                    # code...
                    break;
            }
        }

        if ($nav_type == 'money') {
            switch ($subnav_type) {
                case 'index':
                    $money_index = ' class="active"';
                    break;
                case 'account':
                    $money_account = ' class="active"';
                    break;
                case 'transaction':
                    $money_transaction = ' class="active"';
                    break;
                case 'category':
                    $money_category = ' class="active"';
                    break;
                case 'login':
                    return;
                    // no break;
                
                default:
                    # code...
                    break;
            }
            echo <<<UL
          <ul class="nav navbar-nav">
            <li$money_index><a href="/projects/money/index">主页</a></li>
            <li$money_account><a href="/projects/money/account/">账户详情</a></li>
            <li$money_transaction><a href="/projects/money/transaction/">交易记录</a></li>
            <li$money_category><a href="/projects/money/category/">类别管理</a></li>
            <li$money_login><a href="/projects/money/logout">注销</a></li>
          </ul>
UL;
        }
    }
}

$nav_selector = new NavSelector;
