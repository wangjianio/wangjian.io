---
title: JS 语言类型
date: 2018-04-03
---


string

number

boolean

null

undefined

object



```javascript
typeof null; // 'object'
```

原理：为 js 的 bug，js 中二进制前 3 位都是 0 的话会被判定为 object，null 的二进制全是 0，所以前 3 位也是 0。



## 内置对象

String

Number

Boolean

Object

Function

Array

Date

RegExp

Error