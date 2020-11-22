---
title: encodeHTML
date: 2018-08-29
---

js 对 HTML 进行编解码

```javascript
function encodeHTML(html) {
  const div = document.createElement('div');
  div.appendChild(document.createTextNode(html));

  return div.innerHTML;
}

function decodeHTML(text) {
  const div = document.createElement('div');
  div.innerHTML = text;

  return div.textContent || div.innerText;
}
```



参考：

https://blog.csdn.net/cuixiping/article/details/7846806