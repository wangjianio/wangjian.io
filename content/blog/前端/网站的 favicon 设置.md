---
title: 网站的 favicon 设置
date: 2017-08-17
---


# 网站的 favicon 设置

很多网站都有好看的图标，在不同的浏览器有不同的显示方式，今天我们聊聊如何给自己的网站配置图标。

推荐的格式为 .ico、.png、.gif，其中 .ico 格式浏览器支持最完善，.png 和 .gif 只有 IE 5 - IE 10 不支持，其他的浏览器都在非常早的版本就提供了支持。

.ico 文件可以使用 16×16、32×32、48×48 和 64×64 像素大小的图片，

## macOS Safari（使用 10.1.2 测试）

首先 Safari 会根据 `<link>` 标签查找相应的文件，如果不写，会在根目录下按

```
1、/apple-touch-icon-precomposed.png
2、/apple-touch-icon.png
3、/favicon.ico

```

顺序依次查找，1 和 2 用在个人收藏页面和阅读列表边栏，3 用在书签边栏、共享链接边栏和地址和搜索栏。

### 固定标签页

```
<link rel="mask-icon" href="website_icon.svg" color="red">

```

[https://developer.apple.com/library/content/documentation/AppleApplications/Reference/SafariWebContent/pinnedTabs/pinnedTabs.html](https://developer.apple.com/library/content/documentation/AppleApplications/Reference/SafariWebContent/pinnedTabs/pinnedTabs.html)

## Chrome、Firefox、Edge、IE

仅使用 `favicon.ico`，显示在标签页、收藏夹、书签栏、地址栏、历史记录等等能显示图标的地方。