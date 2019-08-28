---
title: JavaScript 类型
date: 2018-03-12
---

虽然 NaN 是 Not a Number 的缩写，但它是一个数字，只是这个数字与任何一个数字都不想等，即使它自己。

```javascript
typeof NaN // 'number'

NaN === NaN // false
NaN == NaN // false
```



字符串 `'0'` 转换成布尔值为 true，因为字符串的布尔值是由字符串的 length 决定的。只有空字符串 `''` 为 false。

`'0' == true`  的结果为 `false` 是因为使用 `==` 比较时会先将等号两边的表达式转换成相同类型，在本例中 `true` 会被转换为数字 `1`，`'0'` 会被转换为数字 `0`，所以导致结果为 `false`

```javascript
Boolean('0') // true

'0' == true // false
```



Object 类型的比较则是比较其引用的是不是同一个值，如果引用不一样，即使结构相同，也会得出 `false`。

```javascript
{} == {} // false
[] == [] // false
```

