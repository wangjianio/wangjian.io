---
title: 将网页 footer 固定在底部
date: 2017-07-24
---

网页制作中可能会有这样的需求：

在网页内容无法装满整个浏览器窗口时，页脚固定在浏览器底部；

在网页内容比浏览器窗口高时，页脚在全部内容最下面。

## 使用 CSS 中的单位 vh

```html
<!DOCTYPE html>
<html>
  <head>
    <style>
      html,
      body {
        margin: 0;
        padding: 0;
      }
      
      header,
      footer {
        height: 100px;
      }
      
      content {
        min-height: calc(100vh - 200px);
      }
    </style>
  </head>
  <body>
    <header>header</header>
    <content>content</content>
    <footer>footer</footer>
  </body>
</html>
```

## 使用 Bootstrap 和 jQuery

[点此查看实例](/example/1)

```html
<!DOCTYPE html>
<html>

  <head>

    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="jquery-3.2.1.min.js"></script>

    <script>
      function placeFooter() {
        var footerHeight = $("footer").outerHeight();

        if ($(document).height() + footerHeight != $(window).height()) {
          $("footer").removeClass("navbar-fixed-bottom");
        }

        if ($(document).height() == $(window).height()) {
          $("footer").addClass("navbar-fixed-bottom");
        }
      }

      $(document).ready(placeFooter);
      window.onresize = placeFooter;
    </script>

  </head>

  <body>
    <div style="width:100%; height:400px; border:10px solid gray">content</div>
    <footer style="width:100%; height:100px; border:10px solid gray">footer</footer>
  </body>

</html>

```

### 说明：

[.outerHeight()](http://api.jquery.com/outerHeight/)

![1](/images/blog/6/1.jpg)