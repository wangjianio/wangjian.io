---
title: JavaScript 中的 !!
date: 2017-08-25
---

有的时候我们会看到类似这样的代码：

```
var foo；
var bar = !!foo;
```

嗯？那两个叹号什么鬼， `bar` 的结果又是什么呢？

你可能会说，负负得正， `bar` 就等于 `foo` 喽，其实并不是这么简单。

## 先说结论：

`!!foo` 的作用是将 `foo` 转换为 boolean 类型，类似 `var bar = new Boolean(foo)`。

## 再说过程：

`!foo` 会先将 `foo` 转化为 boolean 类型并取非， `!!foo` 则将得到的布尔值还原。

## 类似的写法还有：

```
// 强制转换为 Boolean 用 !!
var bool = !!"c";
console.log(typeof bool); // boolean

// 强制转换为 Number 用 + 或 -
var num = +"1234";
console.log(typeof num); // number

// 强制转换为 String 用 "" +
var str = "" + 1234;
console.log(typeof str); // string

```

## 顺便复习一下 ECMAScript 的类型转换（to boolean）

| Argument Type | Result                                   |
| ------------- | ---------------------------------------- |
| Undefined     | Return **false**.                        |
| Null          | Return **false**.                        |
| Boolean       | Return argument.                         |
| Number        | If argument is +0, -0, or NaN, return **false**; otherwise return **true**. |
| String        | If argument is the empty String (its length is zero), return **false**; otherwise return **true**. |
| Symbol        | Return **true**.                         |
| Object        | Return **true**.                         |

