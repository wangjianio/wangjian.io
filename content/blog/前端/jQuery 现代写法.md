---
title: jQuery 现代写法
date: 2017-08-25
---


## .ready()

1.  `$( handler )`
2.  `$( document ).ready( handler )`
3.  `$( "document" ).ready( handler )`
4.  `$( "img" ).ready( handler )`
5.  `$().ready( handler )`

以上写法都对，但只推荐使用第 1 种写法。

### 示例：

```
$(function() {
  $( "p" ).text( "The DOM is now loaded and can be manipulated." );
});

```

## .live() .delegate() -> .on()

老版本用法

```
$( "a.offsite" ).live( "click", function() {
  alert( "Goodbye!" ); // jQuery 1.3+
});
$( document ).delegate( "a.offsite", "click", function() {
  alert( "Goodbye!" ); // jQuery 1.4.3+
});

```

现代用法

```
$( document ).on( "click", "a.offsite", function() {
  alert( "Goodbye!" );  // jQuery 1.7+
});

```

## .die() -> .off()

老版本用法

```
$( "p" ).die();

```

现代用法

```
$( "p" ).off();

```