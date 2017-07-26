<?php
namespace lopedever\money;

echo <<<START
<div class="collapse in" id="filterOption">
  <div class="well">
  <ul class="list-inline">
  类　型：
START;

switch ($_GET['type']) {
    case '支出':
        echo <<<LI_OUT
        <li><a href="{$_SERVER['PHP_SELF']}">全部</a></li>
        <li>支出</li>
        <li><a href="{$_SERVER['PHP_SELF']}?type=收入">收入</a></li>
LI_OUT;
        break;
    case '收入':
        echo <<<LI_IN
        <li><a href="{$_SERVER['PHP_SELF']}">全部</a></li>
        <li><a href="{$_SERVER['PHP_SELF']}?type=支出">支出</a></li>
        <li>收入</li>
LI_IN;
        break;
    
    default:
        echo <<<LI_ALL
        <li>全部</li>
        <li><a href="{$_SERVER['PHP_SELF']}?type=支出">支出</a></li>
        <li><a href="{$_SERVER['PHP_SELF']}?type=收入">收入</a></li>
LI_ALL;
        break;
}

echo <<<END
  </ul>

  <ul class="list-inline">
  账　户：
  <li>aa</li>
  </ul>
  </div>
</div>
END;
